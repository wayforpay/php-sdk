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

namespace WayForPay\SDK\Response;

use Easy\Collections\ArrayList;
use WayForPay\SDK\Collection\TransactionHistoryCollection;
use WayForPay\SDK\Domain\Transaction;
use WayForPay\SDK\Domain\TransactionHistory;

class TransactionListResponse extends Response
{
    /**
     * @var ArrayList
     */
    private $transactionList;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (!isset($data['transactionList'])) {
            throw new \InvalidArgumentException('Field `reason` required');
        }

        $this->transactionList = new TransactionHistoryCollection();

        foreach ($data['transactionList'] as $transaction) {
            $this->transactionList->add(TransactionHistory::fromArray($transaction));
        }
    }

    /**
     * @return TransactionHistoryCollection|Transaction[]
     */
    public function getTransactionList()
    {
        return $this->transactionList;
    }
}