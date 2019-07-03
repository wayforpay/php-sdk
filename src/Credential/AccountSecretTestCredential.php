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

namespace WayForPay\SDK\Credential;

class AccountSecretTestCredential extends AccountSecretCredential
{
    public function __construct()
    {
        parent::__construct('test_merch_n1', 'flk3409refn54t54t*FNJRET');
    }
}