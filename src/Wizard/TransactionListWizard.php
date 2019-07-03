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

use DateTime;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Request\TransactionListRequest;

class TransactionListWizard extends RequestWizard
{
    /**
     * @var AccountSecretCredential
     */
    protected $credential;

    /**
     * @var DateTime
     */
    protected $dateBegin;

    /**
     * @var DateTime
     */
    protected $dateEnd;

    protected $propertyRequired = array('dateBegin', 'dateEnd');

    /**
     * @param AccountSecretCredential $credential
     * @return TransactionListWizard
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
     * @param DateTime $dateBegin
     * @return TransactionListWizard
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;
        return $this;
    }

    /**
     * @param DateTime $dateEnd
     * @return TransactionListWizard
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    /**
     * @return TransactionListRequest
     */
    public function getRequest()
    {
        $this->check();

        return new TransactionListRequest($this->credential, $this->dateBegin, $this->dateEnd);
    }
}