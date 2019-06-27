<?php


namespace WayForPay\SDK\Contract;


interface EndpointInterface
{
    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getMethod();
}