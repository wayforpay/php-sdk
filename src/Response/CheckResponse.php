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