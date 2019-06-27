<?php

namespace WayForPay\SDK\Endpoint;

use WayForPay\SDK\Contract\EndpointInterface;

class ApiEndpoint implements EndpointInterface
{
    public function getUrl()
    {
        return 'https://api.wayforpay.com/api';
    }

    public function getMethod()
    {
        return 'POST';
    }
}