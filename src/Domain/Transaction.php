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

namespace WayForPay\SDK\Domain;

use DateTime;

class Transaction extends TransactionBase
{
    /**
     * @var string
     */
    private $merchantTransactionType;

    /**
     * @var string
     */
    private $authCode;

    /**
     * @var string
     */
    private $authTicket;

    /**
     * @var CardToken
     */
    private $recToken;

    /**
     * @var string
     */
    private $d3AcsUrl;

    /**
     * @var string
     */
    private $d3Md;

    /**
     * @var string
     */
    private $d3Pareq;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @param array $data
     * @return Transaction
     * @throws \Exception
     */
    public static function fromArray(array $data)
    {
        $required = array(
            'merchantTransactionType',
            'authCode',
            'authTicket',
            'recToken',
            'd3AcsUrl',
            'd3Md',
            'd3Pareq',
            'returnUrl',

            'orderReference',
            'createdDate',
            'amount',
            'currency',
            'transactionStatus',
            'processingDate',
            'reasonCode',
            'reason',
        );

        if ($fieldsMissed = array_diff($required, array_keys($data))) {
            throw new \InvalidArgumentException(
                'Transaction data have missed fields: ' . implode(', ', $fieldsMissed)
            );
        }

        return new self(
            $data['merchantTransactionType'],
            $data['orderReference'],
            new DateTime('@' . $data['createdDate']),
            $data['amount'],
            $data['currency'],
            $data['transactionStatus'],
            new DateTime('@' . $data['processingDate']),
            $data['reasonCode'],
            $data['reason'],
            isset($data['email']) ? $data['email'] : null,
            isset($data['phone']) ? $data['phone'] : null,
            isset($data['paymentSystem']) ? $data['paymentSystem'] : null,
            isset($data['cardPan']) ? $data['cardPan'] : null,
            isset($data['cardType']) ? $data['cardType'] : null,
            isset($data['issuerBankCountry']) ? $data['issuerBankCountry'] : null,
            isset($data['issuerBankName']) ? $data['issuerBankName'] : null,
            isset($data['fee']) ? $data['fee'] : null,
            isset($data['baseAmount']) ? $data['baseAmount'] : null,
            isset($data['baseCurrency']) ? $data['baseCurrency'] : null,
            isset($data['authCode']) ? $data['authCode'] : null,
            isset($data['authTicket']) ? $data['authTicket'] : null,
            isset($data['recToken']) ? $data['recToken'] : null,
            isset($data['d3AcsUrl']) ? $data['d3AcsUrl'] : null,
            isset($data['d3Md']) ? $data['d3Md'] : null,
            isset($data['d3Pareq']) ? $data['d3Pareq'] : null,
            isset($data['returnUrl']) ? $data['returnUrl'] : null
        );
    }

    public function __construct(
        $merchantTransactionType,
        $orderReference,
        DateTime $createdDate,
        $amount, $currency,
        $status, DateTime
        $processingDate,
        $reasonCode,
        $reason,
        $email = null,
        $phone = null,
        $paymentSystem = null,
        $cardPan = null,
        $cardType = null,
        $issuerBankCountry = null,
        $issuerBankName = null,
        $fee = null,
        $baseAmount = null,
        $baseCurrency = null,
        $authCode = null,
        $authTicket = null,
        $recToken = null,
        $d3AcsUrl = null,
        $d3Md = null,
        $d3Pareq = null,
        $returnUrl = null
    ) {
        parent::__construct(
            $orderReference,
            $createdDate,
            $amount,
            $currency,
            $status,
            $processingDate,
            $reasonCode,
            $reason,
            $email,
            $phone,
            $paymentSystem,
            $cardPan,
            $cardType,
            $issuerBankCountry,
            $issuerBankName,
            $fee,
            $baseAmount,
            $baseCurrency
        );

        $this->merchantTransactionType = strval($merchantTransactionType);
        $this->authCode = strval($authCode);
        $this->authTicket = strval($authTicket);
        $this->recToken = $recToken ? new CardToken($recToken) : null;
        $this->d3AcsUrl = strval($d3AcsUrl);
        $this->d3Md = strval($d3Md);
        $this->d3Pareq = strval($d3Pareq);
        $this->returnUrl = strval($returnUrl);
    }

    /**
     * @return string
     */
    public function getMerchantTransactionType()
    {
        return $this->merchantTransactionType;
    }

    /**
     * @return string
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @return string
     */
    public function getAuthTicket()
    {
        return $this->authTicket;
    }

    /**
     * @return CardToken
     */
    public function getRecToken()
    {
        return $this->recToken;
    }

    /**
     * @return string
     */
    public function getD3AcsUrl()
    {
        return $this->d3AcsUrl;
    }

    /**
     * @return string
     */
    public function getD3Md()
    {
        return $this->d3Md;
    }

    /**
     * @return string
     */
    public function getD3Pareq()
    {
        return $this->d3Pareq;
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }
}