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
use WayForPay\SDK\Request\Complete3DSRequest;

class Complete3DSWizard extends RequestWizard
{
    /**
     * @var AccountSecretCredential
     */
    protected $credential;

    /**
     * @var string
     */
    protected $authTicket;

    /**
     * @var string
     */
    protected $d3Md;

    /**
     * @var string
     */
    protected $d3Pares;

    protected $propertyRequired = array(
        'authTicket', 'd3Md', 'd3Pares'
    );

    /**
     * @param AccountSecretCredential $credential
     * @return Complete3DSWizard
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
     * @param string $authTicket
     * @return Complete3DSWizard
     */
    public function setAuthTicket($authTicket)
    {
        $this->authTicket = $authTicket;
        return $this;
    }

    /**
     * @param string $d3Md
     * @return Complete3DSWizard
     */
    public function setD3Md($d3Md)
    {
        $this->d3Md = $d3Md;
        return $this;
    }

    /**
     * @param string $d3Pares
     * @return Complete3DSWizard
     */
    public function setD3Pares($d3Pares)
    {
        $this->d3Pares = $d3Pares;
        return $this;
    }

    /**
     * @return Complete3DSRequest
     */
    public function getRequest()
    {
        $this->check();

        return new Complete3DSRequest($this->credential, $this->authTicket, $this->d3Md, $this->d3Pares);
    }
}