<?php


namespace WayForPay\SDK\Contract;


use WayForPay\SDK\Domain\Reason;

interface ResponseInterface
{
    /**
     * @return Reason
     */
    public function getReason();
}