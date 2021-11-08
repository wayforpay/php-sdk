<?php
/*
 * This file is part of the WayForPay project.
 *
 * @link https://github.com/wayforpay/php-sdk
 *
 * @author Vladimir Konchakovsky <vova.konchakovsky@gmail.ua>
 * @copyright Copyright 2021 WayForPay
 * @license   https://opensource.org/licenses/MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WayForPay\SDK\Response;

/**
 * Class SettleResponse
 * @package WayForPay\SDK\Response
 */
class SettleResponse extends Response
{
    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var string
     */
    private $transactionStatus;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string|int
     */
    private $authCode;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $processingDate;

    /**
     * @var string
     */
    private $cardPan;

    /**
     * @var string
     */
    private $cardType;

    /**
     * @var string
     */
    private $issuerBankCountry;

    /**
     * @var string
     */
    private $issuerBankName;

    /**
     * @var string
     */
    private $recToken;

    /**
     * @var float
     */
    private $fee;

    /**
     * @var string
     */
    private $paymentSystem;


    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->orderReference = $data['orderReference'];
        $this->transactionStatus = $data['transactionStatus'];
        $this->authCode = $data['authCode'];
        $this->amount = $data['amount'];
        $this->currency = $data['currency'];
        $this->createdDate = \DateTime::createFromFormat('U', $data['createdDate']);
        $this->processingDate = \DateTime::createFromFormat('U', $data['processingDate']);
        $this->cardPan = $data['cardPan'];
        $this->cardType = $data['cardType'];
        $this->issuerBankCountry = $data['issuerBankCountry'];
        $this->issuerBankName = $data['issuerBankName'];
        $this->recToken = $data['recToken'];
        $this->fee = floatval($data['fee']);
        $this->paymentSystem = $data['paymentSystem'];
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int|string
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return \DateTime
     */
    public function getProcessingDate()
    {
        return $this->processingDate;
    }

    /**
     * @return string
     */
    public function getCardPan()
    {
        return $this->cardPan;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @return string
     */
    public function getIssuerBankCountry()
    {
        return $this->issuerBankCountry;
    }

    /**
     * @return string
     */
    public function getIssuerBankName()
    {
        return $this->issuerBankName;
    }

    /**
     * @return string
     */
    public function getRecToken()
    {
        return $this->recToken;
    }

    /**
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @return string
     */
    public function getPaymentSystem()
    {
        return $this->paymentSystem;
    }
}