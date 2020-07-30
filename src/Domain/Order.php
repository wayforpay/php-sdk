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

class Order extends TransactionBase
{
    /**
     * @var string
     */
    private $merchantAccount;

    /**
     * @var string
     */
    private $authCode;

    /**
     * @var float
     */
    private $refundAmount;

    /**
     * @var float|null
     */
    private $fee;

    /**
     * @var DateTime|null
     */
    private $settlementDate;

    /**
     * @var float|null
     */
    private $settlementAmount;

    /**
     * @param array $data
     * @return Order
     * @throws \Exception
     */
    public static function fromArray(array $data)
    {
        $required = array(
            'authCode',

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
            $data['orderReference'],
            new DateTime(empty($data['createdDate']) ? null : '@' . $data['createdDate']),
            $data['amount'],
            $data['currency'],
            $data['transactionStatus'],
            new DateTime(empty($data['processingDate']) ? null : '@' . $data['processingDate']),
            $data['reasonCode'],
            $data['reason'],
            isset($data['cardPan']) ? $data['cardPan'] : null,
            isset($data['cardType']) ? $data['cardType'] : null,
            isset($data['issuerBankCountry']) ? $data['issuerBankCountry'] : null,
            isset($data['issuerBankName']) ? $data['issuerBankName'] : null,
            isset($data['fee']) ? $data['fee'] : null,
            isset($data['baseAmount']) ? $data['baseAmount'] : null,
            isset($data['baseCurrency']) ? $data['baseCurrency'] : null,
            isset($data['authCode']) ? $data['authCode'] : null,
            isset($data['settlementDate']) && !empty($data['settlementDate']) ? new DateTime('@' . $data['settlementDate']) : null,
            isset($data['settlementAmount']) ? $data['settlementAmount'] : null,
            isset($data['refundAmount']) ? $data['refundAmount'] : null
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
        $cardPan = null,
        $cardType = null,
        $issuerBankCountry = null,
        $issuerBankName = null,
        $fee = null,
        $baseAmount = null,
        $baseCurrency = null,
        $authCode = null,
        DateTime $settlementDate = null,
        $settlementAmount = null,
        $refundAmount = null
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
            null,
            null,
            null,
            $cardPan,
            $cardType,
            $issuerBankCountry,
            $issuerBankName,
            $fee,
            $baseAmount,
            $baseCurrency
        );
        $this->authCode = $authCode;
        $this->settlementDate = $settlementDate;
        $this->settlementAmount = $settlementAmount;
        $this->refundAmount = $refundAmount;
    }
}
