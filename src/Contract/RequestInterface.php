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

namespace WayForPay\SDK\Contract;


interface RequestInterface
{
    /**
     * @return array
     */
    public function getTransactionData();

    /**
     * @return string
     */
    public function getTransactionType();

    /**
     * @return EndpointInterface
     */
    public function getEndpoint();

    /**
     * @param EndpointInterface $endpoint
     */
    public function setEndpoint(EndpointInterface $endpoint);

    /**
     * @param array $data
     * @return ResponseInterface
     */
    public function getResponse(array $data);
}