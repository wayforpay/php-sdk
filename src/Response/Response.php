<?php

namespace WayForPay\SDK\Response;

use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Domain\Reason;
use WayForPay\SDK\Exception\ApiException;

class Response implements ResponseInterface
{
    /**
     * @var Reason
     */
    private $reason;

    /**
     * Response constructor.
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        if (!isset($data['reason'])) {
            throw new \InvalidArgumentException('Field `reason` required');
        }

        if (!isset($data['reasonCode'])) {
            throw new \InvalidArgumentException('Field `reason` required');
        }

        $this->reason = new Reason($data['reasonCode'], $data['reason']);

        if (!$this->reason->isOK()) {
            throw new ApiException($this->reason);
        }
    }

    /**
     * @return Reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public static function getClass()
    {
        return get_called_class();
    }
}