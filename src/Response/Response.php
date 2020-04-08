<?php
/*
 * This file is part of the WayForPay project.
 *
 * @link https://github.com/wayforpay/php-sdk
 *
 * @author Vladislav Lyshenko <vladdnepr1989@gmail.com>
 * @copyright Copyright 2019 WayForPay
 * @license   https://opensource.org/licenses/MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WayForPay\SDK\Response;

use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Domain\Reason;
use WayForPay\SDK\Exception\ApiException;
use WayForPay\SDK\Exception\InvalidFieldException;

class Response implements ResponseInterface
{
    /**
     * @var Reason
     */
    private $reason;

    /**
     * Response constructor.
     * @param array $data
     * @throws InvalidFieldException
     * @throws ApiException
     */
    public function __construct(array $data)
    {
        if (!isset($data['reason'])) {
            throw new InvalidFieldException('Field `reason` required');
        }

        if (!isset($data['reasonCode'])) {
            throw new InvalidFieldException('Field `reason` required');
        }

        $this->reason = new Reason($data['reasonCode'], $data['reason']);

        if (!$this->reason->isOK()) {
//            throw new ApiException($this->reason);
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
