<?php

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\RufundResponse;

/**
 * Class RefundRequest
 * @package WayForPay\SDK\Request
 * @method RufundResponse send()
 */
class RefundRequest extends ApiRequest
{
    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $comment;

    public function __construct(
        AccountSecretCredential $credential,
        $orderReference,
        $amount,
        $currency,
        $comment
    ) {
        parent::__construct($credential);

        $this->orderReference = $orderReference;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->comment = $comment;
    }

    public function getSignatureFieldsRequired()
    {
        return array_merge(parent::getSignatureFieldsRequired(), array(
            'orderReference',
            'amount',
            'currency'
        ));
    }

    public function getSignatureFieldsValues($charset = self::DEFAULT_CHARSET)
    {
        return array_merge(parent::getSignatureFieldsValues($charset), array(
            'orderReference' => $this->orderReference,
            'amount' => $this->amount,
            'currency' => $this->currency
        ));
    }

    public function getTransactionType()
    {
        return 'REFUND';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'orderReference' => $this->orderReference,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'comment' => $this->comment
        ));
    }

    /**
     * @param array $data
     * @return ResponseInterface|RufundResponse
     * @throws \Exception
     */
    public function getResponse(array $data)
    {
        return new RufundResponse($data);
    }
}