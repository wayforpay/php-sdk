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

class RufundResponse extends Response
{
    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var string
     */
    private $transactionStatus;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->orderReference = $data['orderReference'];
        $this->transactionStatus = $data['transactionStatus'];
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }
}