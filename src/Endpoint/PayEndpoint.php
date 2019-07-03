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

namespace WayForPay\SDK\Endpoint;

use WayForPay\SDK\Contract\EndpointInterface;

class PayEndpoint implements EndpointInterface
{
    public function getUrl()
    {
        return 'https://secure.wayforpay.com/pay';
    }

    public function getMethod()
    {
        return 'POST';
    }
}