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
use WayForPay\SDK\Request\CheckRequest;

class CheckWizard extends RequestWizard
{
    /**
     * @var AccountSecretCredential
     */
    protected $credential;

    /**
     * @var string
     */
    protected $orderReference;

    protected $propertyRequired = array('orderReference');

    /**
     * @param AccountSecretCredential $credential
     * @return CheckWizard
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
     * @return CheckWizard
     */
    public function setOrderReference($orderReference)
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @return CheckRequest
     */
    public function getRequest()
    {
        $this->check();

        return new CheckRequest($this->credential, $this->orderReference);
    }
}