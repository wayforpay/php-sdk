<?php

require_once __DIR__ . '/../vendor/autoload.php';

use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Exception\ApiException;
use WayForPay\SDK\Wizard\Complete3DSWizard;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

try {
    $response = Complete3DSWizard::get($credential)
        ->setAuthTicket('92ff4649bcef4e7a2d53837b557a74b5')
        ->setD3Md('19070111-387014')
        ->setD3Pares('111111')
        ->getRequest()
        ->send();

    echo 'Status: ' . $response->getTransaction()->getStatus() . PHP_EOL;
} catch (ApiException $e) {
    echo "Exception: {$e->getMessage()}\n";
}