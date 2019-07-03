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

namespace WayForPay\SDK\Wizard;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Request\RefundRequest;

class RefundWizard extends RequestWizard
{
    /**
     * @var AccountSecretCredential
     */
    protected $credential;

    /**
     * @var string
     */
    protected $orderReference;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $comment;

    protected $propertyRequired = array('orderReference', 'amount', 'currency', 'comment');

    /**
     * @param AccountSecretCredential $credential
     * @return RefundWizard
     */
    public static function get(AccountSecretCredential $credential)
    {
        return new self($credential);
    }

    public function __construct(AccountSecretCredential $credential)
    {
        $this->credential = $credential;
    }

    /**
     * @param string $orderReference
     * @return RefundWizard
     */
    public function setOrderReference($orderReference)
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @param float $amount
     * @return RefundWizard
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $currency
     * @return RefundWizard
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param string $comment
     * @return RefundWizard
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return RefundRequest
     */
    public function getRequest()
    {
        $this->check();

        return new RefundRequest(
            $this->credential,
            $this->orderReference,
            $this->amount,
            $this->currency,
            $this->comment
        );
    }
}