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

namespace WayForPay\SDK\Wizard;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Request\InvoiceRequest;

class InvoiceWizard extends RequestWizard
{
    /**
     * @var AccountSecretCredential
     */
    protected $credential;

    /**
     * @var string
     */
    protected $orderReference;

    /**
     * /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var ProductCollection
     */
    protected $products;

    /**
     * @var DateTime
     */
    protected $orderDate;

    /**
     * @var string
     */
    protected $merchantDomainName;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var PaymentSystems
     */
    protected $paymentSystems;

    /**
     * @var string
     */
    protected $serviceUrl;

    /**
     * @var int
     */
    protected $holdTimeout;

    /**
     * @var int
     */
    protected $orderTimeout;

    /**
     * @var int
     */
    protected $orderLifetime;

    /**
     * @var string
     */
    protected $language;

    protected $propertyRequired = array(
        'merchantDomainName',
        'orderReference',
        'orderDate',
        'amount',
        'currency',
        'products',
    );

    /**
     * @param AccountSecretCredential $credential
     *
     * @return InvoceWizard
     */
    public static function get(AccountSecretCredential $credential)
    {
        return new self($credential);
    }

    public function __construct(AccountSecretCredential $credential)
    {
        $this->credential = $credential;
    }

    /**
     * @param string $orderReference
     *
     * @return InvoiceWizard
     */
    public function setOrderReference($orderReference)
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @param float $amount
     *
     * @return InvoiceWizard
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $currency
     *
     * @return InvoiceWizard
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param ProductCollection $products
     *
     * @return InvoiceWizard
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @param DateTime $orderDate
     *
     * @return InvoiceWizard
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @param string $merchantDomainName
     *
     * @return InvoiceWizard
     */
    public function setMerchantDomainName($merchantDomainName)
    {
        $this->merchantDomainName = $merchantDomainName;
        return $this;
    }

    /**
     * @param Client $client
     *
     * @return InvoiceWizard
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param PaymentSystems $paymentSystems
     *
     * @return InvoiceWizard
     */
    public function setPaymentSystems($paymentSystems)
    {
        $this->paymentSystems = $paymentSystems;
        return $this;
    }

    /**
     * @param string $serviceUrl
     *
     * @return InvoiceWizard
     */
    public function setServiceUrl($serviceUrl)
    {
        $this->serviceUrl = $serviceUrl;
        return $this;
    }

    /**
     * @param int $holdTimeout
     *
     * @return InvoiceWizard
     */
    public function setHoldTimeout($holdTimeout)
    {
        $this->holdTimeout = $holdTimeout;
        return $this;
    }

    /**
     * @param int $orderTimeout
     *
     * @return InvoiceWizard
     */
    public function setOrderTimeout($orderTimeout)
    {
        $this->orderTimeout = $orderTimeout;
        return $this;
    }

    /**
     * @param int $orderLifetime
     *
     * @return InvoiceWizard
     */
    public function setOrderLifetime($orderLifetime)
    {
        $this->orderLifetime = $orderLifetime;
        return $this;
    }

    /**
     * @param string $language
     *
     * @return InvoiceWizard
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return RefundRequest
     */
    public function getRequest()
    {
        $this->check();

        return new InvoiceRequest(
            $this->credential,
            $this->orderReference,
            $this->amount,
            $this->currency,
            $this->products,
            $this->orderDate,
            $this->merchantDomainName,
            $this->client,
            $this->paymentSystems,
            $this->serviceUrl,
            $this->holdTimeout,
            $this->orderTimeout,
            $this->orderLifetime,
            $this->language
        );
    }
}
