<?php

namespace WayForPay\SDK\Response;

use WayForPay\SDK\Domain\Transaction;

class Complete3DSResponse extends Response
{
    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->transaction = Transaction::fromArray($data);
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}