<?php

namespace WayForPay\SDK\Domain;

class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $count;

    /**
     * Product constructor.
     * @param string $name
     * @param float $price
     * @param int $count
     */
    public function __construct($name, $price, $count)
    {
        $this->name = strval($name);
        $this->price = floatval($price);
        $this->count = intval($count);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}