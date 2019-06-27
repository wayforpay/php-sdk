<?php


namespace WayForPay\SDK\Exception;

use WayForPay\SDK\Domain\Reason;

class ApiException extends \RuntimeException
{
    public function __construct(Reason $reason)
    {
        parent::__construct($reason->getMessage(), $reason->getCode());
    }
}