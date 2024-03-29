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
use WayForPay\SDK\Domain\V2\TransactionHistoryV2;
use WayForPay\SDK\Wizard\TransactionListWizard;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = TransactionListWizard::get($credential)
    ->setDateBegin(new \DateTime('-1 hour'))
    ->setDateEnd(new \DateTime())
    ->setApiVersion2()
    ->getRequest()
    ->send();

echo 'Reason Code: ' . $response->getReason()->getCode() . PHP_EOL;
foreach ($response->getTransactionList() as $transaction) {
    echo $transaction->getCreatedDate()->format('Y-m-d H:i:s') . "\t" .
        str_pad($transaction->getType(), 10, ' ') . "\t" .
        str_pad($transaction->getStatus(), 20, ' ') . "\t" .
        str_pad($transaction->getAmount() . ' ' . $transaction->getCurrency(), 20, ' ') .
        str_pad($transaction->getOrderReference(), 20, ' ') .
        PHP_EOL;
    if ($transaction instanceof TransactionHistoryV2) {
        echo 'PRODUCTS: ' . json_encode($transaction->getProducts(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
        if ($transaction->getRegularCreated()) {
            echo 'REGULAR CREATED: ' . $transaction->getRegularCreated() . PHP_EOL;
        }
        if ($transaction->getRegularCheckout()) {
            echo 'REGULAR PAYED:   ' . $transaction->getRegularCheckout() . PHP_EOL;
        }
        if ($transaction->getDeliveryAddress()) {
            echo 'DELIVERY:   ' . $transaction->getDeliveryAddress()
                . ' ' . $transaction->getDeliveryPhone()
                . ' ' . $transaction->getDeliveryName() . PHP_EOL;
        }
    }
}