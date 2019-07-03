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

namespace WayForPay\SDK\Client;

use anlutro\cURL\cURL;
use anlutro\cURL\Request;
use WayForPay\SDK\Contract\RequestInterface;
use WayForPay\SDK\Contract\RequestTransformerInterface;
use WayForPay\SDK\Contract\ResponseInterface;

class CurlRequestTransformer implements RequestTransformerInterface
{
    /**
     * @param RequestInterface $transactionRequest
     * @return ResponseInterface
     */
    public function transform(RequestInterface $transactionRequest)
    {
        $endpoint = $transactionRequest->getEndpoint();

        $curl = new cURL();

        $request = $curl->newRequest(
            $endpoint->getMethod(),
            $endpoint->getUrl(),
            array_filter($transactionRequest->getTransactionData()),
            Request::ENCODING_JSON
        );

        $response = $curl->sendRequest($request);

        return $transactionRequest->getResponse(\json_decode($response->body, true) ?: array());
    }
}