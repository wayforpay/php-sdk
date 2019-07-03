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


class Reason
{
    const CODE_OK = 1100;

    const CODE_DECLINED_TO_CARD_ISSUER = 1101;
    const CODE_BAD_CVV2 = 1102;
    const CODE_EXPIRED_CARD = 1103;
    const CODE_INSUFFICIENT_FUNDS = 1104;
    const CODE_INVALID_CARD = 1105;
    const CODE_EXCEED_WITHDRAWAL_FREQUENCY = 1106;
    const CODE_3DS_FAIL = 1108;
    const CODE_FORMAT_ERROR = 1109;
    const CODE_INVALID_CURRENCY = 1110;
    const CODE_DUPLICATE_ORDER_ID = 1112;
    const CODE_INVALID_SIGNATURE = 1113;
    const CODE_FRAUD = 1114;
    const CODE_PARAMETER_MISSING = 1115;
    const CODE_TOKEN_NOT_FOUND = 1116;
    const CODE_API_NOT_ALLOWED = 1117;
    const CODE_MERCHANT_RESTRICTION = 1118;
    const CODE_AUTHENTICATION_UNAVAILABLE = 1120;
    const CODE_ACCOUNT_NOT_FOUND = 1121;
    const CODE_GATE_DECLINED = 1122;
    const CODE_REFUND_NOT_ALLOWED = 1123;
    const CODE_CARDHOLDER_SESSION_EXPIRED = 1124;
    const CODE_CARDHOLDER_CANCELLED_REQUEST = 1125;
    const CODE_ILLEGAL_ORDER_STATE = 1126;
    const CODE_ORDER_NOT_FOUND = 1127;
    const CODE_REFUND_LIMIT_EXCEEDED = 1128;
    const CODE_SCRIPT_ERROR = 1129;
    const CODE_INVALID_AMOUNT = 1130;
    const CODE_TRANSACTION_IN_PROCESSING = 1131;
    const CODE_TRANSACTION_DELAYED = 1132;
    const CODE_INVALID_COMMISSION = 1133;
    const CODE_TRANSACTION_PENDING = 1134;
    const CODE_CARD_LIMITS_FAILED = 1135;
    const CODE_MERCHANT_BALANCE_SMALL = 1136;
    const CODE_INVALID_CONFIRMATION_AMOUNT = 1137;
    const CODE_REFUND_IN_PROCESSING = 1138;
    const CODE_EXTERNAL_DECLINE_WHILE_CREDIT = 1139;
    const CODE_EXCEED_WITHDRAWAL_FREQUENCY_WHILE_CREDIT = 1140;
    const CODE_PARTIAL_VOID_NOT_SUPPORTED = 1141;
    const CODE_REFUSED_CREDIT = 1142;
    const CODE_INVALID_PHONE_NUMBER = 1143;
    const CODE_TRANSACTION_AWAITING_DELIVERY = 1144;
    const CODE_TRANSACTION_AWAITING_DECISION = 1145;
    const CODE_RESTRICTED_CARD = 1146;
    const CODE_CLIENT_NOT_FOUND = 1147;
    const CODE_CLIENT_NOT_LINKED = 1148;
    const CODE_CLIENT_LOCKED = 1149;

    const CODE_OK_REGULAR = 4100;

    const CODE_WAIT_3DS_DATA = 5100;

    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    public function __construct($code, $message)
    {
        $this->code = intval($code);
        $this->message = strval($message);
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    public function isOK()
    {
        return $this->code == self::CODE_OK ||
            $this->code == self::CODE_OK_REGULAR ||
            $this->isWaiting3DS();
    }

    public function isWaiting3DS()
    {
        return $this->code == self::CODE_WAIT_3DS_DATA;
    }
}