<?php

namespace WayForPay\SDK\Credential;

class AccountPasswordCredential
{
    private $account;

    private $password;

    public function __construct($account, $password)
    {
        $this->account = strval($account);
        $this->password = strval($password);
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
    public function getPassword()
    {
        return $this->password;
    }
}