<?php


namespace WayForPay\SDK\Wizard;

use WayForPay\SDK\Request\ApiRequest;

abstract class BaseWizard
{
    protected $propertyRequired = array();

    /**
     * @return ApiRequest
     */
    abstract public function getRequest();

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