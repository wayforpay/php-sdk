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

use DateTime;

class Avia
{
    /**
     * @var string
     */
    private $departureDate;

    /**
     * @var string
     */
    private $locationNumber;

    /**
     * @var string
     */
    private $locationCodes;

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
    private $reservationCode;

    public function __construct(
        DateTime $departureDate = null,
        $locationNumber = null,
        $locationCodes = null,
        $nameFirst = null,
        $nameLast = null,
        $reservationCode = null
    ) {
        $this->departureDate = $departureDate;
        $this->locationNumber = strval($locationNumber);
        $this->locationCodes = strval($locationCodes);
        $this->nameFirst = strval($nameFirst);
        $this->nameLast = strval($nameLast);
        $this->reservationCode = strval($reservationCode);
    }

    /**
     * @return DateTime
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * @return string
     */
    public function getLocationNumber()
    {
        return $this->locationNumber;
    }

    /**
     * @return string
     */
    public function getLocationCodes()
    {
        return $this->locationCodes;
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
    public function getReservationCode()
    {
        return $this->reservationCode;
    }
}