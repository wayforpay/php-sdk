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

use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Wizard\InvoiceWizard;
use WayForPay\SDK\Exception\ApiException;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$client = new Client(
    'John',
    'Dou',
    'john.dou@gmail.com',
    '+12025550152',
    'USA'
);

$products = new ProductCollection(array(
    new Product('test', 0.01, 1),
));

try {
    $response = InvoiceWizard::get($credential)
        ->setOrderReference(sha1(microtime(true)))
        ->setAmount(0.01)
        ->setCurrency('USD')
        ->setOrderDate(new \DateTime)
        ->setMerchantDomainName('https://google.com')
        ->setClient($client)
        ->setProducts($products)
        ->setServiceUrl('http://localhost:8000/examples/serviceUrl.php')
        ->getRequest()
        ->send();

    echo 'Invoice URL: ' . $response->getInvoiceUrl() . PHP_EOL;
} catch (ApiException $e) {
    echo 'Exception: ' . $e->getMessage() . PHP_EOL;
}