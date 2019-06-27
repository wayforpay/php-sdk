<?php

namespace WayForPay\SDK\Credential;

class AccountSecretCredential
{
    private $account;

    private $secret;

    public function __construct($account, $secret)
    {
        $this->account = strval($account);
        $this->secret = strval($secret);
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }
}