<?php


namespace WayForPay\SDK\Collection;

use Easy\Collections\ArrayList;
use WayForPay\SDK\Domain\TransactionHistory;

class TransactionHistoryCollection extends ArrayList
{
    public function add($item)
    {
        if (!$item instanceof TransactionHistory) {
            throw new \InvalidArgumentException('Expect Transaction, got ' . get_class($item));
        }

        return parent::add($item);
    }
}