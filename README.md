# WayForPay PHP SDK (PHP >= 5.3)
[![License](https://img.shields.io/github/license/wayforpay/php-sdk.svg)](https://github.com/wayforpay/php-sdk) [![Code size](https://img.shields.io/github/languages/code-size/wayforpay/php-sdk.svg)](https://github.com/wayforpay/php-sdk) [![Dependabot Status](https://api.dependabot.com/badges/status?host=github&repo=wayforpay/php-sdk)](https://dependabot.com)

[![Scrutinizer Build Status](https://img.shields.io/scrutinizer/build/g/wayforpay/php-sdk.svg?label=Scrutinizer&logo=scrutinizer)](https://scrutinizer-ci.com/g/wayforpay/php-sdk/build-status/master) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/wayforpay/php-sdk/master.svg?logo=scrutinizer)](https://scrutinizer-ci.com/g/wayforpay/php-sdk/?branch=master) [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/wayforpay/php-sdk/master.svg?logo=scrutinizer)](https://scrutinizer-ci.com/g/wayforpay/php-sdk/?branch=master)

[![Travis Build Status](https://img.shields.io/travis/wayforpay/php-sdk/master.svg?label=Travis&logo=travis)](https://travis-ci.org/wayforpay/php-sdk) [![Travis PHP versions](https://img.shields.io/travis/php-v/wayforpay/php-sdk.svg?logo=travis)](https://travis-ci.org/wayforpay/php-sdk)

[![Latest Stable Version](https://img.shields.io/packagist/v/wayforpay/php-sdk.svg)](https://packagist.org/packages/wayforpay/php-sdk) [![Packagist PHP version](https://img.shields.io/packagist/php-v/wayforpay/php-sdk.svg)](https://packagist.org/packages/wayforpay/php-sdk)

PHP SDK for payment system [WayForPay](https://wayforpay.com).

## Table Of Contents


- [WayForPay documentation](#wayforpay-documentation)
- [How to use](#how-to-use)
  - [Wizard](#wizard)
    - [Transactions List](#transactions-list)
    - [Charge](#charge)
    - [Complete 3DS](#complete-3ds)
- [Contributing](#contributing)


## WayForPay documentation
* [English](https://wiki.wayforpay.com/display/WADE/Wayforpay+Api+documentations+ENG)
* [Ukrainian](https://wiki.wayforpay.com/display/WADU/Wayforpay+Api+documentations+UA)
* [Russian](https://wiki.wayforpay.com/display/AD/Api+documentation)

## How to use
### Wizard
#### Transactions List

```php
<?php

use WayForPay\SDK\Wizard\TransactionListWizard;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Credential\AccountSecretCredential;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = TransactionListWizard::get($credential)
    ->setDateBegin(new \DateTime('2019-06-20'))
    ->setDateEnd(new \DateTime('2019-06-26'))
    ->getRequest()
    ->send();
```

Response will be instance of `TransactionListResponse`. Transactions can be retrieved via
`getTransactionList` method.

#### Charge

```php
<?php

use WayForPay\SDK\Wizard\ChargeWizard;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Transaction;
use WayForPay\SDK\Request\ChargeRequest;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Domain\CardToken;
use WayForPay\SDK\Domain\Card;
use WayForPay\SDK\Domain\Client;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = ChargeWizard::get($credential)
    ->setOrderReference(sha1(microtime(true)))
    ->setAmount(0.01)
    ->setCurrency('USD')
    ->setOrderDate(new \DateTime())
    ->setMerchantDomainName('https://google.com')
    ->setMerchantTransactionType(Transaction::MERCHANT_TRANSACTION_TYPE_SALE)
    ->setMerchantTransactionSecureType(ChargeRequest::MERCHANT_TRANSACTION_SECURE_TYPE_AUTO)
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
    ->setCard(new Card('5276999765600381', '2021', '05', '237', 'JOHN DOU'))
    //->setCardToken(new CardToken('1aa11aaa-1111-11aa-a1a1-0000a00a00aa'))
    ->getRequest()
    ->send();
```

Response will be instance of `ChargeResponse`. Transaction can be retrieved via
`getTransaction` method.

#### Complete 3DS

```php
<?php

use WayForPay\SDK\Wizard\Complete3DSWizard;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Credential\AccountSecretCredential;

// Use test credential or yours
$credential = new AccountSecretTestCredential();
//$credential = new AccountSecretCredential('account', 'secret');

$response = Complete3DSWizard::get($credential)
    ->setAuthTicket('authTicket')
    ->setD3Md('d3md')
    ->setD3Pares('d3pares')
    ->getRequest()
    ->send();
```

Response will be instance of `Complete3DSResponse`. Transaction can be retrieved via
`getTransaction` method.

## Contributing
See [contributing note](./CONTRIBUTING.md)