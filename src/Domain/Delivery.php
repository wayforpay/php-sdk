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

namespace WayForPay\SDK\Domain;

class Delivery
{
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
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * Delivery constructor.
     * @param string|null $nameFirst
     * @param string|null $nameLast
     * @param string|null $address
     * @param string|null $city
     * @param string|null $state
     * @param string|null $zip
     * @param string|null $country
     * @param string|null $email
     * @param string|null $phone
     */
    public function __construct(
        $nameFirst = null,
        $nameLast = null,
        $address = null,
        $city = null,
        $state = null,
        $zip = null,
        $country = null,
        $email = null,
        $phone = null
    ) {
        $this->nameFirst = strval($nameFirst);
        $this->nameLast = strval($nameLast);
        $this->address = strval($address);
        $this->city = strval($city);
        $this->state = strval($state);
        $this->zip = strval($zip);
        $this->country = strval($country);
        $this->email = strval($email);
        $this->phone = strval($phone);
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
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
}