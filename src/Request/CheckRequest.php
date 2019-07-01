<?php

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\CheckResponse;

/**
 * Class CheckRequest
 * @package WayForPay\SDK\Request
 * @method CheckResponse send()
 */
class CheckRequest extends ApiRequest
{
    /**
     * @var string
     */
    private $orderReference;

    public function __construct(AccountSecretCredential $credential, $orderReference)
    {
        parent::__construct($credential);

        $this->orderReference = $orderReference;
    }

    public function getSignatureFieldsRequired()
    {
        return array_merge(parent::getSignatureFieldsRequired(), array(
            'orderReference',
        ));
    }

    public function getSignatureFieldsValues($charset = self::DEFAULT_CHARSET)
    {
        return array_merge(parent::getSignatureFieldsValues($charset), array(
            'orderReference' => $this->orderReference,
        ));
    }

    public function getTransactionType()
    {
        return 'CHECK_STATUS';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'orderReference' => $this->orderReference
        ));
    }

    /**
     * @param array $data
     * @return ResponseInterface|CheckResponse
     * @throws \Exception
     */
    public function getResponse(array $data)
    {
        return new CheckResponse($data);
    }
}