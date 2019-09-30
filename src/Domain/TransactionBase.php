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
use WayForPay\SDK\Exception\InvalidFieldException;

class TransactionBase
{
    const STATUS_CREATED                = 'Created';
    const STATUS_IN_PROCESSING          = 'InProcessing';
    const STATUS_WAIT_AUTH_COMPLETE     = 'WaitingAuthComplete';
    const STATUS_APPROVED               = 'Approved';
    const STATUS_PENDING                = 'Pending';
    const STATUS_EXPIRED                = 'Expired';
    const STATUS_REFUNDED               = 'Refunded';
    const STATUS_VOIDED                 = 'Voided';
    const STATUS_DECLINED               = 'Declined';
    const STATUS_REFUND_IN_PROCESSING   = 'RefundInProcessing';

    private $statusAllowed = array(
        self::STATUS_CREATED,
        self::STATUS_IN_PROCESSING,
        self::STATUS_WAIT_AUTH_COMPLETE,
        self::STATUS_APPROVED,
        self::STATUS_PENDING,
        self::STATUS_EXPIRED,
        self::STATUS_REFUNDED,
        self::STATUS_VOIDED,
        self::STATUS_DECLINED,
        self::STATUS_REFUND_IN_PROCESSING,
    );

    const MERCHANT_TYPE_SALE = 'SALE';
    const MERCHANT_TYPE_AUTH = 'AUTH';

    /**
     * @var string
     */
    private $merchantType;

    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var DateTime
     */
    private $createdDate;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $status;

    /**
     * @var DateTime
     */
    private $processingDate;

    /**
     * @var Reason
     */
    private $reason;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $paymentSystem;

    /**
     * @var string|null
     */
    private $cardPan;

    /**
     * @var string|null
     */
    private $cardType;

    /**
     * @var string|null
     */
    private $issuerBankCountry;

    /**
     * @var string|null
     */
    private $issuerBankName;

    /**
     * @var float|null
     */
    private $fee;

    /**
     * @var int|null
     */
    private $baseAmount;

    /**
     * @var string|null
     */
    private $baseCurrency;

    /**
     * Transaction constructor.
     * @param string $orderReference
     * @param DateTime $createdDate
     * @param float $amount
     * @param string $currency
     * @param string $status
     * @param DateTime $processingDate
     * @param int $reasonCode
     * @param string $reason
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $paymentSystem
     * @param string|null $cardPan
     * @param string|null $cardType
     * @param string|null $issuerBankCountry
     * @param string|null $issuerBankName
     * @param float|null $fee
     * @param float|null $baseAmount
     * @param string|null $baseCurrency
     */
    public function __construct(
        $orderReference,
        DateTime $createdDate,
        $amount,
        $currency,
        $status,
        DateTime $processingDate,
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
        $baseCurrency = null
    ) {
        if (!in_array($status, $this->statusAllowed)) {
            throw new InvalidFieldException(
                'Unexpected transaction type `' . $status . '`, expect one of ' .
                implode(', ', $this->statusAllowed)
            );
        }

        $this->orderReference = strval($orderReference);
        $this->createdDate = $createdDate;
        $this->amount = floatval($amount);
        $this->currency = strval($currency);
        $this->status = strval($status);
        $this->processingDate = $processingDate;
        $this->reason = new Reason(intval($reasonCode), strval($reason));
        $this->email = strval($email);
        $this->phone = strval($phone);
        $this->paymentSystem = strval($paymentSystem);
        $this->cardPan = strval($cardPan);
        $this->cardType = strval($cardType);
        $this->issuerBankCountry = strval($issuerBankCountry);
        $this->issuerBankName = strval($issuerBankName);
        $this->fee = floatval($fee);

        $this->baseAmount = $baseAmount;
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
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
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return DateTime
     */
    public function getProcessingDate()
    {
        return $this->processingDate;
    }

    /**
     * @return Reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getPaymentSystem()
    {
        return $this->paymentSystem;
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
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @return int|null
     */
    public function getBaseAmount()
    {
        return $this->baseAmount;
    }

    /**
     * @return string|null
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * @return bool
     */
    public function isStatusCreated()
    {
        return $this->status == self::STATUS_CREATED;
    }

    /**
     * @return bool
     */
    public function isStatusInProcessing()
    {
        return $this->status == self::STATUS_IN_PROCESSING;
    }

    /**
     * @return bool
     */
    public function isStatusWaitAuthComplete()
    {
        return $this->status == self::STATUS_WAIT_AUTH_COMPLETE;
    }

    /**
     * @return bool
     */
    public function isStatusApproved()
    {
        return $this->status == self::STATUS_APPROVED;
    }

    /**
     * @return bool
     */
    public function isStatusPending()
    {
        return $this->status == self::STATUS_PENDING;
    }

    /**
     * @return bool
     */
    public function isStatusExpired()
    {
        return $this->status == self::STATUS_EXPIRED;
    }

    /**
     * @return bool
     */
    public function isStatusRefunded()
    {
        return $this->status == self::STATUS_REFUNDED;
    }

    /**
     * @return bool
     */
    public function isStatusVoided()
    {
        return $this->status == self::STATUS_VOIDED;
    }

    /**
     * @return bool
     */
    public function isStatusDeclined()
    {
        return $this->status == self::STATUS_DECLINED;
    }

    /**
     * @return bool
     */
    public function isStatusRefundInProcessing()
    {
        return $this->status == self::STATUS_REFUND_IN_PROCESSING;
    }
}