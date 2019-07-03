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

class TransactionHistory extends TransactionBase
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var DateTime|null
     */
    private $settlementDate;

    /**
     * @var float|null
     */
    private $settlementAmount;

    /**
     * @var float|null
     */
    private $refundAmount;

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
            isset($data['settlementDate']) ? new DateTime('@' . $data['settlementDate']) : null,
            isset($data['settlementAmount']) ? $data['settlementAmount'] : null
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
        $settlementAmount = null
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

        $this->type = strval($type);
        $this->settlementDate = $settlementDate;
        $this->settlementAmount = $settlementAmount;
    }


    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return DateTime|null
     */
    public function getSettlementDate()
    {
        return $this->settlementDate;
    }

    /**
     * @return float|null
     */
    public function getSettlementAmount()
    {
        return $this->settlementAmount;
    }

    /**
     * @return float|null
     */
    public function getRefundAmount()
    {
        return $this->refundAmount;
    }
}