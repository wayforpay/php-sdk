<?php

namespace WayForPay\SDK\Domain;

class CardToken
{
    /**
     * @var string
     */
    private $token;

    /**
     * CardToken constructor.
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = strval($token);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}