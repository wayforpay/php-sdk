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

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\SettleResponse;

/**
 * Class SettleRequest
 * @package WayForPay\SDK\Request
 * @method SettleResponse send()
 */
class SettleRequest extends ApiRequest
{
    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;


    public function __construct(
        AccountSecretCredential $credential,
        $orderReference,
        $amount,
        $currency
    ) {
        parent::__construct($credential);

        $this->orderReference = $orderReference;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getRequestSignatureFieldsValues()
    {
        return array_merge(parent::getRequestSignatureFieldsValues(), array(
            'orderReference' => $this->orderReference,
            'amount' => $this->amount,
            'currency' => $this->currency
        ));
    }

    public function getResponseSignatureFieldsRequired()
    {
        return array(
            'merchantAccount',
            'orderReference',
            'transactionStatus',
            'reasonCode',
        );
    }

    public function getTransactionType()
    {
        return 'SETTLE';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'orderReference' => $this->orderReference,
            'amount' => $this->amount,
            'currency'  => $this->currency
        ));
    }

    public function getResponseClass()
    {
        return SettleResponse::getClass();
    }
}