<?php

require_once __DIR__ . '/../vendor/autoload.php';

use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Wizard\TransactionListWizard;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = TransactionListWizard::get($credential)
    ->setDateBegin(new \DateTime('-1 hour'))
    ->setDateEnd(new \DateTime())
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
}