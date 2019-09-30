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


class PaymentSystems
{
    const DELIMITER = ';';

    const CARD = 'card';
    const PRIVAT24 = 'privat24';
    const LP_TERMINAL = 'lpTerminal';
    const BTC = 'btc';
    const BANK_CASH = 'bankCash';
    const CREDIT = 'credit';
    const PAY_PARTS = 'payParts';
    const QR_CODE = 'qrCode';
    const MASTER_PASS = 'masterPass';
    const VISA_CHECKOUT = 'visaCheckout';
    const GOOGLE_PAY = 'googlePay';
    const APPLE_PAY = 'applePay';
    const PAY_PARTS_MONO = 'payPartsMono';

    private $default;

    private $list;

    /**
     * PaymentSystems constructor.
     * @param $default
     * @param $list
     */
    public function __construct(array $list = array(), $default = null)
    {
        $this->default = strval($default);
        $this->list = $list;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @return string
     */
    public function getListAsString()
    {
        return implode(self::DELIMITER, $this->getList());
    }
}