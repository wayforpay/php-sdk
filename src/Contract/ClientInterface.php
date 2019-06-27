<?php


namespace WayForPay\SDK\Contract;


interface ClientInterface
{
    /**
     * @param TransactionRequestInterface $transactionRequest
     * @return ResponseInterface
     */
    public function send(TransactionRequestInterface $transactionRequest);
}