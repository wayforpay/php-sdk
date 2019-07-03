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