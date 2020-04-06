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

namespace WayForPay\SDK\Request;

use DateTime;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\PaymentSystems;
use WayForPay\SDK\Response\InvoiceResponse;

/**
 * Class InvoiceRequest
 *
 * @package WayForPay\SDK\Request
 * @method InvoiceResponse send()
 */
class InvoiceRequest extends ApiRequest
{
    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var ProductCollection
     */
    private $products;

    /**
     * @var DateTime
     */
    private $orderDate;

    /**
     * @var string
     */
    private $merchantDomainName;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var PaymentSystems
     */
    private $paymentSystems;

    /**
     * @var string
     */
    private $serviceUrl;

    /**
     * @var int
     */
    private $holdTimeout;

    /**
     * @var int
     */
    private $orderTimeout;

    /**
     * @var int
     */
    private $orderLifetime;

    /**
     * @var string
     */
    private $language;


    public function __construct(
        AccountSecretCredential $credential,
        $orderReference,
        $amount,
        $currency,
        ProductCollection $products,
        DateTime $orderDate,
        $merchantDomainName,
        Client $client = null,
        PaymentSystems $paymentSystems = null,
        $serviceUrl = null,
        $holdTimeout = null,
        $orderTimeout = null,
        $orderLifetime = null,
        $language = null
    )
    {
        parent::__construct($credential);

        $this->orderReference = strval($orderReference);
        $this->amount = floatval($amount);
        $this->currency = strval($currency);
        $this->products = $products;
        $this->orderDate = $orderDate;
        $this->merchantDomainName = strval($merchantDomainName);
        $this->client = $client ?: new Client();
        $this->paymentSystems = $paymentSystems ?: new PaymentSystems();
        $this->serviceUrl = strval($serviceUrl);
        $this->holdTimeout = intval($holdTimeout);
        $this->orderTimeout = intval($orderTimeout);
        $this->orderLifetime = intval($orderLifetime);
        $this->language = strval($language);
    }

    public function getRequestSignatureFieldsValues()
    {
        return array_merge(parent::getRequestSignatureFieldsValues(), array(
            'merchantDomainName' => $this->merchantDomainName,
            'orderReference'     => $this->orderReference,
            'orderDate'          => $this->orderDate->getTimestamp(),
            'amount'             => $this->amount,
            'currency'           => $this->currency,
            'products'           => $this->products,
        ));
    }

    public function getResponseSignatureFieldsRequired()
    {
        return array();
    }

    public function getTransactionType()
    {
        return 'CREATE_INVOICE';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'merchantDomainName'   => $this->merchantDomainName,
            'language'             => $this->language,
            'serviceUrl'           => $this->serviceUrl,
            'orderReference'       => $this->orderReference,
            'orderDate'            => $this->orderDate->getTimestamp(),
            'amount'               => $this->amount,
            'currency'             => $this->currency,
            'holdTimeout'          => $this->holdTimeout,
            'orderTimeout'         => $this->orderTimeout,
            'productName'          => $this->products->getNames(),
            'productPrice'         => $this->products->getPrices(),
            'productCount'         => $this->products->getCounts(),
            'clientFirstName'      => $this->client->getNameFirst(),
            'clientLastName'       => $this->client->getNameLast(),
            'clientEmail'          => $this->client->getEmail(),
            'clientPhone'          => $this->client->getPhone(),
            'paymentSystems'       => $this->paymentSystems->getListAsString(),
            'defaultPaymentSystem' => $this->paymentSystems->getDefault(),
        ));
    }

    public function getResponseClass()
    {
        return InvoiceResponse::getClass();
    }
}
