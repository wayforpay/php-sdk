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

namespace WayForPay\SDK\Domain;


interface MerchantTypes
{
    const AUTH_SIMPLE_SIGNATURE = 'SimpleSignature';
    const AUTH_TICKET = 'ticket';
    const AUTH_PASSWORD = 'password';

    const TRANSACTION_SECURE_AUTO = 'AUTO';
    const TRANSACTION_SECURE_3DS = '3DS';
    const TRANSACTION_SECURE_NON3DS = 'NON3DS';

    const TRANSACTION_AUTO = 'AUTO';
    const TRANSACTION_SALE = 'SALE';
    const TRANSACTION_AUTH = 'AUTH';
}