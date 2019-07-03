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

namespace WayForPay\SDK\Request;

use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\Complete3DSResponse;

/**
 * Class Complete3DSRequest
 * @package WayForPay\SDK\Request
 * @method Complete3DSResponse send()
 */
class Complete3DSRequest extends ApiRequest
{
    /**
     * @var string
     */
    private $authTicket;

    /**
     * @var string
     */
    private $d3Md;

    /**
     * @var string
     */
    private $d3Pares;

    public function __construct(AccountSecretCredential $credential, $authTicket, $d3Md, $d3Pares)
    {
        parent::__construct($credential);

        $this->authTicket = strval($authTicket);
        $this->d3Md = strval($d3Md);
        $this->d3Pares = strval($d3Pares);
    }

    public function getTransactionType()
    {
        return 'COMPLETE_3DS';
    }

    public function getTransactionData()
    {
        return array(
            'apiVersion' => self::API_VERSION,
            'transactionType' => $this->getTransactionType(),
            'authorization_ticket' => $this->authTicket,
            'd3ds_md' => $this->d3Md,
            'd3ds_pares' => $this->d3Pares,
        );
    }

    public function getResponseClass()
    {
        return Complete3DSResponse::getClass();
    }
}