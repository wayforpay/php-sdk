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

use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Wizard\PurchaseWizard;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$form = PurchaseWizard::get($credential)
    ->setOrderReference(sha1(microtime(true)))
    ->setAmount(0.01)
    ->setCurrency('USD')
    ->setOrderDate(new \DateTime())
    ->setMerchantDomainName('https://google.com')
    ->setClient(new Client(
        'John',
        'Dou',
        'john.dou@gmail.com',
        '+12025550152',
        'USA'
    ))
    ->setProducts(new ProductCollection(array(
        new Product('test', 0.01, 1)
    )))
    ->setReturnUrl('http://localhost:8000/examples/returnUrl.php')
    ->setServiceUrl('http://localhost:8000/examples/serviceUrl.php')
    ->getForm()
    ->getAsString();

echo '<html><body><h1>Pay Form</h1>' . $form . '</body></html>';