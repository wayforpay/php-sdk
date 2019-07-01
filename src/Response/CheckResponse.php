<?php

namespace WayForPay\SDK\Response;

use WayForPay\SDK\Domain\Order;

class CheckResponse extends Response
{
    /**
     * @var Order
     */
    private $order;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->order = Order::fromArray($data);
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }
}