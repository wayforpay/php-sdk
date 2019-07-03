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