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

namespace WayForPay\SDK\Wizard;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Request\RefundRequest;
use WayForPay\SDK\Request\SettleRequest;

/**
 * Class SettleWizard
 * @package WayForPay\SDK\Wizard
 */
class SettleWizard extends RequestWizard
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


    protected $propertyRequired = array('orderReference', 'amount', 'currency');

    /**
     * @param AccountSecretCredential $credential
     * @return self
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
     * @return self
     */
    public function setOrderReference($orderReference)
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @param float $amount
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $currency
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }


    /**
     * @return SettleRequest
     */
    public function getRequest()
    {
        $this->check();

        return new SettleRequest(
            $this->credential,
            $this->orderReference,
            $this->amount,
            $this->currency
        );
    }
}