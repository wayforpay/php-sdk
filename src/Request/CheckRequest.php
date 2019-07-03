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

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\CheckResponse;

/**
 * Class CheckRequest
 * @package WayForPay\SDK\Request
 * @method CheckResponse send()
 */
class CheckRequest extends ApiRequest
{
    /**
     * @var string
     */
    private $orderReference;

    public function __construct(AccountSecretCredential $credential, $orderReference)
    {
        parent::__construct($credential);

        $this->orderReference = $orderReference;
    }

    public function getRequestSignatureFieldsValues()
    {
        return array_merge(parent::getRequestSignatureFieldsValues(), array(
            'orderReference' => $this->orderReference,
        ));
    }

    public function getResponseSignatureFieldsRequired()
    {
        return array(
            'merchantAccount',
            'orderReference',
            'amount',
            'currency',
            'authCode',
            'cardPan',
            'transactionStatus',
            'reasonCode',
        );
    }

    public function getTransactionType()
    {
        return 'CHECK_STATUS';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'orderReference' => $this->orderReference
        ));
    }

    public function getResponseClass()
    {
        return CheckResponse::getClass();
    }
}