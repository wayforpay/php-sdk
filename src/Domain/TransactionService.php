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
use DateTimeZone;

class TransactionService extends TransactionBase
{
    /**
     * @var string
     */
    private $merchantAccount;

    /**
     * @var CardToken
     */
    private $recToken;

    /**
     * @var string
     */
    private $authCode;

    /**
     * @var string
     */
    private $repayUrl;

    /**
     * @var string
     */
    private $orderNo;

    /**
     * @param array $data
     * @return TransactionService
     * @throws \Exception
     */
    public static function fromArray(array $data)
    {
        $default = array(
            'merchantAccount' => '',
            'orderReference' => '',
            'merchantSignature' => '',
            'amount' => 0,
            'currency' => '',
            'authCode' => 0,
            'email' => '',
            'phone' => '',
            'createdDate' => 0,
            'processingDate' => 0,
            'cardPan' => '',
            'cardType' => '',
            'issuerBankCountry' => '',
            'issuerBankName' => '',
            'recToken' => '',
            'transactionStatus' => '',
            'reason' => '',
            'reasonCode' => 0,
            'fee' => 0,
            'paymentSystem' => '',
            'repayUrl' => '',
            'orderNo' => '',
        );

        $data = array_merge($default, $data);

        return new self(
            $data['orderReference'],
            (new DateTime('@' . $data['createdDate']))->setTimezone(new DateTimeZone(date_default_timezone_get())),
            $data['amount'],
            $data['currency'],
            $data['transactionStatus'],
            (new DateTime('@' . $data['processingDate']))->setTimezone(new DateTimeZone(date_default_timezone_get())),
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
            isset($data['merchantAccount']) ? $data['merchantAccount'] : null,
            isset($data['recToken']) ? $data['recToken'] : null,
            isset($data['authCode']) ? $data['authCode'] : null,
            isset($data['repayUrl']) ? $data['repayUrl'] : null,
            isset($data['orderNo']) ? $data['orderNo'] : null
        );
    }

    public function __construct(
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
        $merchantAccount = null,
        $recToken = null,
        $authCode = null,
        $repayUrl = null,
        $orderNo = null
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

        $this->merchantAccount = strval($merchantAccount);
        $this->recToken = $recToken ? new CardToken($recToken) : null;
        $this->authCode = strval($authCode);
        $this->repayUrl = strval($repayUrl);
        $this->orderNo  = strval($orderNo);
    }

    /**
     * @return string
     */
    public function getMerchantAccount()
    {
        return $this->merchantAccount;
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
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @return string
     */
    public function getRepayUrl()
    {
        return $this->repayUrl;
    }

    /**
     * @return string
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }
}
