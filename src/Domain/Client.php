<?php

namespace WayForPay\SDK\Domain;

class Client
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $nameFirst;

    /**
     * @var string
     */
    private $nameLast;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * Client constructor.
     * @param string $nameFirst
     * @param string $nameLast
     * @param string $email
     * @param string $phone
     * @param string $country
     * @param string|null $id
     * @param string|null $ip
     * @param string|null $address
     * @param string|null $city
     * @param string|null $state
     * @param string|null $zip
     */
    public function __construct(
        $nameFirst,
        $nameLast,
        $email,
        $phone,
        $country,
        $id = null,
        $ip = null,
        $address = null,
        $city = null,
        $state = null,
        $zip = null
    ) {
        $this->id = strval($id);
        $this->nameFirst = strval($nameFirst);
        $this->nameLast = strval($nameLast);
        $this->email = strval($email);
        $this->phone = strval($phone);
        $this->country = strval($country);
        $this->ip = strval($ip);
        $this->address = strval($address);
        $this->city = strval($city);
        $this->state = strval($state);
        $this->zip = strval($zip);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * @return string
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getZip()
    {
        return $this->zip;
    }
}