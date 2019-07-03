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

use DateTime;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\TransactionListResponse;

/**
 * Class TransactionListRequest
 * @package WayForPay\SDK\Request
 * @method TransactionListResponse send()
 */
class TransactionListRequest extends ApiRequest
{
    /**
     * @var DateTime
     */
    private $dateBegin;

    /**
     * @var DateTime
     */
    private $dateEnd;

    public function __construct(AccountSecretCredential $credential, DateTime $dateBegin, DateTime $dateEnd)
    {
        parent::__construct($credential);

        $this->dateBegin = $dateBegin;
        $this->dateEnd = $dateEnd;
    }

    public function getRequestSignatureFieldsValues()
    {
        return array_merge(parent::getRequestSignatureFieldsValues(), array(
            'dateBegin' => $this->dateBegin->getTimestamp(),
            'dateEnd' => $this->dateEnd->getTimestamp(),
        ));
    }

    public function getTransactionType()
    {
        return 'TRANSACTION_LIST';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'dateBegin' => $this->dateBegin->getTimestamp(),
            'dateEnd' => $this->dateEnd->getTimestamp()
        ));
    }

    public function getResponseClass()
    {
        return TransactionListResponse::getClass();
    }
}