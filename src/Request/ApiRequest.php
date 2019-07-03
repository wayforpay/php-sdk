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

use WayForPay\SDK\Client\CurlRequestTransformer;
use WayForPay\SDK\Contract\EndpointInterface;
use WayForPay\SDK\Contract\RequestInterface;
use WayForPay\SDK\Contract\RequestTransformerInterface;
use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Reason;
use WayForPay\SDK\Endpoint\ApiEndpoint;
use WayForPay\SDK\Exception\ApiException;
use WayForPay\SDK\Exception\SignatureException;
use WayForPay\SDK\Helper\SignatureHelper;

abstract class ApiRequest implements RequestInterface
{
    const API_VERSION = 1;

    /**
     * @var RequestTransformerInterface
     */
    private $transformer;

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
                $this->getRequestSignatureFieldsValues(),
                $this->credential->getSecret()
            ),
            'apiVersion' => self::API_VERSION,
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
     * @return RequestTransformerInterface|CurlRequestTransformer
     */
    public function getTransformer()
    {
        if (!$this->transformer) {
            $this->transformer = new CurlRequestTransformer();
        }

        return $this->transformer;
    }

    /**
     * @param RequestTransformerInterface $transformer
     * @return ApiRequest
     */
    public function setTransformer($transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function send()
    {
        try {
            return $this->getTransformer()->transform($this);
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

        if ($signatureRequired = array_flip($this->getResponseSignatureFieldsRequired())) {
            $expected = SignatureHelper::calculateSignature(
                array_intersect_key( // https://stackoverflow.com/a/17438222
                    array_replace($signatureRequired, $data),
                    $signatureRequired
                ),
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