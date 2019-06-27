<?php

namespace WayForPay\SDK\Endpoint;

use WayForPay\SDK\Contract\EndpointInterface;

class ApiRegularEndpoint implements EndpointInterface
{
    public function getUrl()
    {
        return 'https://api.wayforpay.com/regularApi';
    }

    public function getMethod()
    {
        return 'POST';
    }
}