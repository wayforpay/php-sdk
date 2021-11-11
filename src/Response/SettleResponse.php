<?php
/*
 * This file is part of the WayForPay project.
 *
 * @link https://github.com/wayforpay/php-sdk
 *
 * @author Vladimir Konchakovsky <vova.konchakovsky@gmail.ua>
 * @copyright Copyright 2021 WayForPay
 * @license   https://opensource.org/licenses/MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WayForPay\SDK\Response;

use WayForPay\SDK\Domain\Transaction;
use WayForPay\SDK\Domain\TransactionBase;
use WayForPay\SDK\Domain\TransactionService;
use WayForPay\SDK\Domain\TransactionSettle;

/**
 * Class SettleResponse
 * @package WayForPay\SDK\Response
 */
class SettleResponse extends Response
{

    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->transaction = TransactionSettle::fromArray($data);
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

}