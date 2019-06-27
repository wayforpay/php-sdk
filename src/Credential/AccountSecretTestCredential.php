<?php

namespace WayForPay\SDK\Credential;

class AccountSecretTestCredential extends AccountSecretCredential
{
    public function __construct()
    {
        parent::__construct('test_merch_n1', 'flk3409refn54t54t*FNJRET');
    }
}