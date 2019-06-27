<?php

namespace WayForPay\SDK\Client;

use Guzzle\Http\Client;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use WayForPay\SDK\Contract\ClientInterface;
use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Contract\TransactionRequestInterface;

class GuzzleClient implements ClientInterface
{
    /**
     * @param TransactionRequestInterface $transactionRequest
     * @return ResponseInterface
     */
    public function send(TransactionRequestInterface $transactionRequest)
    {
        $endpoint = $transactionRequest->getEndpoint();

        $client = new Client($endpoint->getUrl());

        /** @var EntityEnclosingRequestInterface $request */
        $request = $client->createRequest($endpoint->getMethod());
        $request->setBody(
            \json_encode($transactionRequest->getTransactionData()),
            'application/json'
        );

        $response = $request->send();

        return $transactionRequest->getResponse($response->json());
    }
}