<?php


namespace WayForPay\SDK\Contract;


interface SignatureAbleInterface
{
    /**
     * @param string $delimiter
     * @return string
     */
    public function getConcatenatedString($delimiter);
}