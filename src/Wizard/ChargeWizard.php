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
use WayForPay\SDK\Domain\Card;
use WayForPay\SDK\Domain\CardToken;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Request\ChargeRequest;

class ChargeWizard extends RequestWizard
{
    /**
     * @var AccountSecretCredential
     */
    protected $credential;

    /**
     * @var Card
     */
    protected $card;

    /**
     * @var CardToken
     */
    protected $cardToken;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ProductCollection
     */
    protected $products;

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
     * @var string
     */
    protected $merchantAuthType;

    /**
     * @var string
     */
    protected $serviceUrl;

    /**
     * @var int
     */
    protected $holdTimeout;

    /**
     * @var string
     */
    protected $socialUri;

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
     * @return ChargeRequest
     */
    public function getRequest()
    {
        $this->check();

        return new ChargeRequest(
            $this->credential,
            $this->card ? $this->card : $this->cardToken,
            $this->orderReference,
            $this->amount,
            $this->currency,
            $this->products,
            $this->orderDate,
            $this->merchantDomainName,
            $this->merchantTransactionType,
            $this->merchantTransactionSecureType,
            $this->client,
            $this->serviceUrl,
            $this->holdTimeout,
            $this->merchantAuthType,
            $this->socialUri
        );
    }

    /**
     * @param Card $card
     * @return ChargeWizard
     */
    public function setCard($card)
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @param CardToken $cardToken
     * @return ChargeWizard
     */
    public function setCardToken($cardToken)
    {
        $this->cardToken = $cardToken;
        return $this;
    }

    /**
     * @param Client $client
     * @return ChargeWizard
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param ProductCollection $products
     * @return ChargeWizard
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @param string $orderReference
     * @return ChargeWizard
     */
    public function setOrderReference($orderReference)
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @param float $amount
     * @return ChargeWizard
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $currency
     * @return ChargeWizard
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param DateTime $orderDate
     * @return ChargeWizard
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @param string $merchantDomainName
     * @return ChargeWizard
     */
    public function setMerchantDomainName($merchantDomainName)
    {
        $this->merchantDomainName = $merchantDomainName;
        return $this;
    }

    /**
     * @param string $merchantTransactionType
     * @return ChargeWizard
     */
    public function setMerchantTransactionType($merchantTransactionType)
    {
        $this->merchantTransactionType = $merchantTransactionType;
        return $this;
    }

    /**
     * @param string $merchantTransactionSecureType
     * @return ChargeWizard
     */
    public function setMerchantTransactionSecureType($merchantTransactionSecureType)
    {
        $this->merchantTransactionSecureType = $merchantTransactionSecureType;
        return $this;
    }

    /**
     * @param string $merchantAuthType
     * @return ChargeWizard
     */
    public function setMerchantAuthType($merchantAuthType)
    {
        $this->merchantAuthType = $merchantAuthType;
        return $this;
    }

    /**
     * @param string $serviceUrl
     * @return ChargeWizard
     */
    public function setServiceUrl($serviceUrl)
    {
        $this->serviceUrl = $serviceUrl;
        return $this;
    }

    /**
     * @param int $holdTimeout
     * @return ChargeWizard
     */
    public function setHoldTimeout($holdTimeout)
    {
        $this->holdTimeout = $holdTimeout;
        return $this;
    }

    /**
     * @param string $socialUri
     * @return ChargeWizard
     */
    public function setSocialUri($socialUri)
    {
        $this->socialUri = $socialUri;
        return $this;
    }
}