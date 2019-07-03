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
use WayForPay\SDK\Contract\SignatureAbleInterface;
use WayForPay\SDK\Domain\Product;

class ProductCollection extends ArrayList implements SignatureAbleInterface
{
    public function add($item)
    {
        if (!$item instanceof Product) {
            throw new \InvalidArgumentException('Expect Product, got ' . get_class($item));
        }

        return parent::add($item);
    }

    /**
     * @param string $delimiter
     * @return string
     */
    public function getConcatenatedString($delimiter)
    {
        return implode($delimiter, $this->getNames()) . $delimiter .
            implode($delimiter, $this->getCounts()) . $delimiter .
            implode($delimiter, $this->getPrices());
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
        return $this->map(function (Product $product) {
            return $product->getName();
        })->values();
    }

    /**
     * @return int[]
     */
    public function getCounts()
    {
        return $this->map(function (Product $product) {
            return $product->getCount();
        })->values();
    }

    /**
     * @return float[]
     */
    public function getPrices()
    {
        return $this->map(function (Product $product) {
            return $product->getPrice();
        })->values();
    }
}