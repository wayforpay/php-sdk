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

namespace WayForPay\SDK\Wizard;

abstract class BaseWizard
{
    protected $propertyRequired = array();

    /**
     * @throws \InvalidArgumentException
     */
    protected function check()
    {
        $missed = array();
        $calls = array();

        foreach ($this->propertyRequired as $property) {
            if (!isset($this->$property) || empty($this->$property)) {
                $missed[] = $property;
                $calls[] = 'set' . ucfirst($property) . '(...)';
            }
        }

        if ($missed) {
            throw new \InvalidArgumentException(
                'Some arguments missed: ' . implode(', ', $missed) .
                '. Check next methods are called: ' . PHP_EOL . PHP_EOL . implode(PHP_EOL, $calls)
            );
        }
    }
}