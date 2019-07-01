<?php

namespace WayForPay\SDK\Response;

class RufundResponse extends Response
{
    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var string
     */
    private $transactionStatus;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->orderReference = $data['orderReference'];
        $this->transactionStatus = $data['transactionStatus'];
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }
}