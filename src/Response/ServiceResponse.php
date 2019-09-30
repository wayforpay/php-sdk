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

use WayForPay\SDK\Domain\TransactionService;

class ServiceResponse extends Response
{
    /**
     * @var TransactionService
     */
    private $transaction;

    /**
     * ServiceResponse constructor.
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->transaction = TransactionService::fromArray($data);
    }

    /**
     * @return TransactionService
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}