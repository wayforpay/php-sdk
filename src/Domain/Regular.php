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

class Regular
{
    const DELIMITER = ';';

    const BEHAVIOR_NONE = 'none';
    const BEHAVIOR_DEFAULT = 'default';
    const BEHAVIOR_PRESET = 'preset';

    const MODE_CLIENT = 'client';
    const MODE_NONE = 'none';
    const MODE_ONCE = 'once';
    const MODE_DAYLY = 'daily';
    const MODE_WEEKLY = 'weekly';
    const MODE_QUARTERLY = 'quarterly';
    const MODE_MONTHLY = 'monthly';
    const MODE_HALFYEARLY = 'halfyearly';
    const MODE_YEARLY = 'yearly';

    /**
     * @var array
     */
    private $modes;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var DateTime
     */
    private $dateNext;

    /**
     * @var DateTime
     */
    private $dateEnd;

    /**
     * @var int
     */
    private $count;

    /**
     * @var bool
     */
    private $on;

    /**
     * @var string
     */
    private $behavior;

    /**
     * Regular constructor.
     * @param array $modes
     * @param float $amount
     * @param DateTime $dateNext
     * @param DateTime $dateEnd
     * @param int $count
     * @param bool $on
     * @param string $behavior
     */
    public function __construct(
        array $modes,
        $amount = null,
        DateTime $dateNext = null,
        DateTime $dateEnd = null,
        $count = null,
        $on = null,
        $behavior = null
    ) {
        if ($behavior && $behavior == self::BEHAVIOR_PRESET) {
            if (!$modes) {
                throw new \InvalidArgumentException('Modes is required');
            }

            if (!$amount) {
                throw new \InvalidArgumentException('Amount is required');
            }

            if (!$dateNext) {
                throw new \InvalidArgumentException('Date next is required');
            }

            if (!$dateEnd && !$count) {
                throw new \InvalidArgumentException('Date end or count are required');
            }
        }

        $this->modes = $modes;
        $this->amount = floatval($amount);
        $this->dateNext = $dateNext;
        $this->dateEnd = $dateEnd;
        $this->count = intval($count);
        $this->on = boolval($on);
        $this->behavior = $behavior;
    }

    /**
     * @return mixed
     */
    public function getModes()
    {
        return $this->modes;
    }

    /**
     * @return string
     */
    public function getModesAsString()
    {
        return implode(self::DELIMITER, $this->getModes());
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return DateTime
     */
    public function getDateNext()
    {
        return $this->dateNext;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return bool
     */
    public function isOn()
    {
        return $this->on;
    }

    /**
     * @return string
     */
    public function getBehavior()
    {
        return $this->behavior;
    }
}