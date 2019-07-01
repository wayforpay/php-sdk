<?php

namespace WayForPay\SDK\Client;

use anlutro\cURL\cURL;
use anlutro\cURL\Request;
use WayForPay\SDK\Contract\ClientInterface;
use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Contract\TransactionRequestInterface;

class CurlClient implements ClientInterface
{
    /**
     * @param TransactionRequestInterface $transactionRequest
     * @return ResponseInterface
     */
    public function send(TransactionRequestInterface $transactionRequest)
    {
        $endpoint = $transactionRequest->getEndpoint();

        $curl = new cURL();

        $request = $curl->newRequest(
            $endpoint->getMethod(),
            $endpoint->getUrl(),
            $transactionRequest->getTransactionData(),
            Request::ENCODING_JSON
        );

        $response = $curl->sendRequest($request);

        return $transactionRequest->getResponse(\json_decode($response->body, true) ?: array());
    }
}