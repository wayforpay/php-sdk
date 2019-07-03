<?php

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Client\CurlClient;
use WayForPay\SDK\Contract\ClientInterface;
use WayForPay\SDK\Contract\EndpointInterface;
use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Contract\SignatureAbleInterface;
use WayForPay\SDK\Contract\TransactionRequestInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Reason;
use WayForPay\SDK\Endpoint\ApiEndpoint;
use WayForPay\SDK\Exception\ApiException;
use WayForPay\SDK\Exception\SignatureException;

abstract class ApiRequest implements TransactionRequestInterface
{
    const FIELDS_DELIMITER  = ';';
    const DEFAULT_CHARSET   = 'utf8';
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
            'merchantSignature' => $this->getSignature(
                $this->getRequestSignatureFieldsRequired(),
                $this->getRequestSignatureFieldsValues()
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

    public function getRequestSignatureFieldsValues($charset = self::DEFAULT_CHARSET)
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
            $expected = $this->getSignature(
                $signatureRequired,
                array_intersect_key($data, array_flip($signatureRequired))
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

    /**
     * @param array $fieldsRequired
     * @param array $fieldsValues
     * @return string
     */
    protected function getSignature(array $fieldsRequired, array $fieldsValues)
    {
        $data = array();
        $error = array();

        foreach ($fieldsRequired as $item) {
            if (array_key_exists($item, $fieldsValues)) {
                $value = $fieldsValues[$item];
                if (is_object($value) && $value instanceof SignatureAbleInterface) {
                    $data[] = $value->getConcatenatedString(self::FIELDS_DELIMITER);
                } elseif (is_array($value)) {
                    $data[] = implode(self::FIELDS_DELIMITER, $value);
                } else {
                    $data[] = (string) $value;
                }
            } else {
                $error[] = $item;
            }
        }

        /*if ( $this->_charset != self::DEFAULT_CHARSET) {
            if (!function_exists('iconv')) {
                throw new \RuntimeException('iconv extension required');
            }

            foreach($data as $key => $value) {
                $data[$key] = iconv($this->_charset, self::DEFAULT_CHARSET, $data[$key]);
            }
        }*/

        if (!empty($error)) {
            throw new \InvalidArgumentException('Missed signature field(s): ' . implode(', ', $error) . '.');
        }

        return $data ?
            hash_hmac('md5', implode(self::FIELDS_DELIMITER, $data), $this->credential->getSecret()) :
            false;
    }
}