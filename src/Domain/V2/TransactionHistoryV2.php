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

namespace WayForPay\SDK\Domain\V2;

use DateTime;
use DateTimeZone;
use WayForPay\SDK\Domain\TransactionHistory;

class TransactionHistoryV2 extends TransactionHistory
{
    /**
     * @var bool|null
     */
    public $regularCreated;

    /**
     * @var bool|null
     */
    public $regularCheckout;

    /**
     * @var string|null
     */
    public $deliveryAddress;

    /**
     * @var string|null
     */
    public $deliveryPhone;

    /**
     * @var string|null
     */
    public $deliveryName;

    /**
     * @var array|null
     */
    public $products;

    /**
     * @var array|null
     */
    public $clientFields;

    /**
     * @param array $data
     * @return TransactionHistory
     * @throws \Exception
     */
    public static function fromArray(array $data)
    {
        $required = array(
            'transactionType',
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
            $data['transactionType'],
            $data['orderReference'],
//            new DateTime('@' . $data['createdDate']),
            (new DateTime('@' . $data['createdDate']))->setTimezone(new DateTimeZone(date_default_timezone_get())),
            $data['amount'],
            $data['currency'],
            $data['transactionStatus'],
//            new DateTime('@' . $data['processingDate']),
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
            isset($data['settlementDate']) ? (new DateTime('@' . $data['settlementDate']))->setTimezone(new DateTimeZone(date_default_timezone_get())) : null,
            isset($data['settlementAmount']) ? $data['settlementAmount'] : null,
            isset($data['regularCreated']) ? boolval($data['regularCreated']) : null,
            isset($data['regularCheckout']) ? boolval($data['regularCheckout']) : null,
            isset($data['deliveryAddress']) ? $data['deliveryAddress'] : null,
            isset($data['deliveryPhone']) ? $data['deliveryPhone'] : null,
            isset($data['deliveryName']) ? $data['deliveryName'] : null,
            isset($data['products']) ? $data['products'] : null,
            isset($data['clientFields']) ? $data['clientFields'] : null
        );
    }

    public function __construct(
        $type,
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
        DateTime $settlementDate = null,
        $settlementAmount = null,
        $regularCreated = null,
        $regularCheckout = null,
        $deliveryAddress = null,
        $deliveryPhone = null,
        $deliveryName = null,
        $products = null,
        $clientFields = null
    ) {
        parent::__construct(
            $type,
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
            $baseCurrency,
            $settlementDate,
            $settlementAmount
        );

        $this->regularCreated  = $regularCreated;
        $this->regularCheckout = $regularCheckout;
        $this->deliveryAddress = $deliveryAddress;
        $this->deliveryPhone   = $deliveryPhone;
        $this->deliveryName    = $deliveryName;
        $this->products        = $products;
        $this->clientFields    = $clientFields;
    }

    /**
     * @return bool|null
     */
    public function getRegularCreated()
    {
        return $this->regularCreated;
    }

    /**
     * @return bool|null
     */
    public function getRegularCheckout()
    {
        return $this->regularCheckout;
    }

    /**
     * @return string|null
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @return string|null
     */
    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    /**
     * @return string|null
     */
    public function getDeliveryName()
    {
        return $this->deliveryName;
    }

    /**
     * @return array|null
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return array|null
     */
    public function getClientFields()
    {
        return $this->clientFields;
    }
}
