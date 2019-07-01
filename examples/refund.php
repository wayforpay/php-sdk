<?php

require_once __DIR__ . '/../vendor/autoload.php';

use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Wizard\RefundWizard;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = RefundWizard::get($credential)
    ->setOrderReference('R000000006')
    ->setAmount(35)
    ->setCurrency('USD')
    ->setComment('Test comment')
    ->getRequest()
    ->send();

echo 'Reason Code: ' . $response->getReason()->getCode() . PHP_EOL;
echo 'Order status: ' . $response->getTransactionStatus() . PHP_EOL;