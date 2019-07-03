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

use DateTime;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Avia;
use WayForPay\SDK\Domain\CardToken;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Delivery;
use WayForPay\SDK\Domain\PaymentSystems;
use WayForPay\SDK\Domain\Regular;
use WayForPay\SDK\Form\PurchaseForm;

class PurchaseWizard extends BaseWizard
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
     * @var string
     */
    protected $merchantTransactionType;

    /**
     * @var string
     */
    protected $merchantTransactionSecureType;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Delivery
     */
    protected $delivery;

    /**
     * @var Avia
     */
    protected $avia;

    /**
     * @var Regular
     */
    protected $regular;

    /**
     * @var CardToken
     */
    protected $token;

    /**
     * @var PaymentSystems
     */
    protected $paymentSystems;

    /**
     * @var string
     */
    protected $serviceUrl;

    /**
     * @var string
     */
    protected $returnUrl;

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
    protected $merchantAuthType;

    /**
     * @var string
     */
    protected $socialUri;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $orderNo;

    /**
     * @var float
     */
    protected $alternativeAmount;

    /**
     * @var string
     */
    protected $alternativeCurrency;

    protected $propertyRequired = array(
        'orderReference', 'amount', 'currency',
        'products', 'orderDate',
        'merchantDomainName',
    );

    /**
     * @param AccountSecretCredential $credential
     * @return self
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
     * @return PurchaseWizard
     */
    public function setOrderReference($orderReference)
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @param float $amount
     * @return PurchaseWizard
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $currency
     * @return PurchaseWizard
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param ProductCollection $products
     * @return PurchaseWizard
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @param DateTime $orderDate
     * @return PurchaseWizard
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @param string $merchantDomainName
     * @return PurchaseWizard
     */
    public function setMerchantDomainName($merchantDomainName)
    {
        $this->merchantDomainName = $merchantDomainName;
        return $this;
    }

    /**
     * @param string $merchantTransactionType
     * @return PurchaseWizard
     */
    public function setMerchantTransactionType($merchantTransactionType)
    {
        $this->merchantTransactionType = $merchantTransactionType;
        return $this;
    }

    /**
     * @param string $merchantTransactionSecureType
     * @return PurchaseWizard
     */
    public function setMerchantTransactionSecureType($merchantTransactionSecureType)
    {
        $this->merchantTransactionSecureType = $merchantTransactionSecureType;
        return $this;
    }

    /**
     * @param Client $client
     * @return PurchaseWizard
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param Delivery $delivery
     * @return PurchaseWizard
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @param Avia $avia
     * @return PurchaseWizard
     */
    public function setAvia($avia)
    {
        $this->avia = $avia;
        return $this;
    }

    /**
     * @param Regular $regular
     * @return PurchaseWizard
     */
    public function setRegular($regular)
    {
        $this->regular = $regular;
        return $this;
    }

    /**
     * @param CardToken $token
     * @return PurchaseWizard
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param PaymentSystems $paymentSystems
     * @return PurchaseWizard
     */
    public function setPaymentSystems($paymentSystems)
    {
        $this->paymentSystems = $paymentSystems;
        return $this;
    }

    /**
     * @param string $serviceUrl
     * @return PurchaseWizard
     */
    public function setServiceUrl($serviceUrl)
    {
        $this->serviceUrl = $serviceUrl;
        return $this;
    }

    /**
     * @param string $returnUrl
     * @return PurchaseWizard
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * @param int $holdTimeout
     * @return PurchaseWizard
     */
    public function setHoldTimeout($holdTimeout)
    {
        $this->holdTimeout = $holdTimeout;
        return $this;
    }

    /**
     * @param int $orderTimeout
     * @return PurchaseWizard
     */
    public function setOrderTimeout($orderTimeout)
    {
        $this->orderTimeout = $orderTimeout;
        return $this;
    }

    /**
     * @param int $orderLifetime
     * @return PurchaseWizard
     */
    public function setOrderLifetime($orderLifetime)
    {
        $this->orderLifetime = $orderLifetime;
        return $this;
    }

    /**
     * @param string $merchantAuthType
     * @return PurchaseWizard
     */
    public function setMerchantAuthType($merchantAuthType)
    {
        $this->merchantAuthType = $merchantAuthType;
        return $this;
    }

    /**
     * @param string $socialUri
     * @return PurchaseWizard
     */
    public function setSocialUri($socialUri)
    {
        $this->socialUri = $socialUri;
        return $this;
    }

    /**
     * @param string $language
     * @return PurchaseWizard
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param string $orderNo
     * @return PurchaseWizard
     */
    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;
        return $this;
    }

    /**
     * @param float $alternativeAmount
     * @return PurchaseWizard
     */
    public function setAlternativeAmount($alternativeAmount)
    {
        $this->alternativeAmount = $alternativeAmount;
        return $this;
    }

    /**
     * @param string $alternativeCurrency
     * @return PurchaseWizard
     */
    public function setAlternativeCurrency($alternativeCurrency)
    {
        $this->alternativeCurrency = $alternativeCurrency;
        return $this;
    }

    /**
     * @return PurchaseForm
     */
    public function getForm()
    {
        $this->check();

        return new PurchaseForm(
            $this->credential,
            $this->orderReference,
            $this->amount,
            $this->currency,
            $this->products,
            $this->orderDate,
            $this->merchantDomainName,
            $this->merchantTransactionType,
            $this->merchantTransactionSecureType,
            $this->client,
            $this->delivery,
            $this->avia,
            $this->regular,
            $this->token,
            $this->paymentSystems,
            $this->serviceUrl,
            $this->returnUrl,
            $this->holdTimeout,
            $this->orderTimeout,
            $this->orderLifetime,
            $this->merchantAuthType,
            $this->socialUri,
            $this->language,
            $this->orderNo,
            $this->alternativeAmount,
            $this->alternativeCurrency
        );
    }
}