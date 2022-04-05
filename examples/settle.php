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

require_once __DIR__ . '/../vendor/autoload.php';

use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Wizard\SettleWizard;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = SettleWizard::get($credential)
    ->setOrderReference('R000000006')
    ->setAmount(35)
    ->setCurrency('USD')
    ->getRequest()
    ->send();

echo 'Reason Code: ' . $response->getReason()->getCode() . PHP_EOL;
echo 'Reason Message: ' . $response->getReason()->getMessage() . PHP_EOL;
echo 'Order status: ' . $response->getTransaction()->getStatus() . PHP_EOL;