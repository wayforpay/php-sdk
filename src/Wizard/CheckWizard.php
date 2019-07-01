<?php


namespace WayForPay\SDK\Wizard;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Request\CheckRequest;

class CheckWizard extends BaseWizard
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