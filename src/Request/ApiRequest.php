<?php
/*
 * This file is part of the WayForPay project.
 *
 * @link https://github.com/wayforpay/php-sdk
 *
 * @author Vladislav Lyshenko <vladdnepr1989@gmail.com>
 * @copyright Copyright 2019 WayForPay
 * @license   https://opensource.org/licenses/MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Client\CurlClient;
use WayForPay\SDK\Contract\ClientInterface;
use WayForPay\SDK\Contract\EndpointInterface;
use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Contract\TransactionRequestInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Reason;
use WayForPay\SDK\Endpoint\ApiEndpoint;
use WayForPay\SDK\Exception\ApiException;
use WayForPay\SDK\Exception\SignatureException;
use WayForPay\SDK\Helper\SignatureHelper;

abstract class ApiRequest implements TransactionRequestInterface
{
    const API_VERSION = 1;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var EndpointInterface
     */
    private $endpoint;

    /**
     * @var AccountSecretCredential
     */
    private $credential;

    public function __construct(AccountSecretCredential $credential)
    {
        $this->credential = $credential;
    }

    public function getTransactionData()
    {
        return array(
            'transactionType' => $this->getTransactionType(),
            'merchantAccount' => $this->credential->getAccount(),
            'merchantSignature' => SignatureHelper::calculateSignature(
                $this->getRequestSignatureFieldsRequired(),
                $this->getRequestSignatureFieldsValues(),
                $this->credential->getSecret()
            ),
            'apiVersion' => self::API_VERSION,
        );
    }

    public function getRequestSignatureFieldsRequired()
    {
        return array(
            'merchantAccount',
        );
    }

    public function getRequestSignatureFieldsValues()
    {
        return array(
            'merchantAccount' => $this->credential->getAccount(),
        );
    }

    public function getResponseSignatureFieldsRequired()
    {
        return array();
    }

    /**
     * @return EndpointInterface|ApiEndpoint
     */
    public function getEndpoint()
    {
        if (!$this->endpoint) {
            $this->endpoint = new ApiEndpoint();
        }

        return $this->endpoint;
    }

    /**
     * @param EndpointInterface $endpoint
     * @return ApiRequest
     */
    public function setEndpoint(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return ClientInterface|CurlClient
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = new CurlClient();
        }

        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return ApiRequest
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function send()
    {
        try {
            return $this->getClient()->send($this);
        } catch (\Exception $e) {
            throw new ApiException(new Reason(-1, $e->getMessage()));
        }
    }

    abstract public function getResponseClass();

    /**
     * @param array $data
     * @return ResponseInterface
     * @throws \Exception
     */
    public function getResponse(array $data)
    {
        $class = $this->getResponseClass();
        $response = new $class($data);

        if ($signatureRequired = $this->getResponseSignatureFieldsRequired()) {
            $expected = SignatureHelper::calculateSignature(
                $signatureRequired,
                array_intersect_key($data, array_flip($signatureRequired)),
                $this->credential->getSecret()
            );

            if (!isset($data['merchantSignature'])
                || $expected !== $data['merchantSignature']
            ) {
                throw new SignatureException(
                    'Response signature mismatch: expected ' . $expected . ', got ' . $data['merchantSignature']
                );
            }
        }

        return $response;
    }
}