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

namespace WayForPay\SDK\Handler;


use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\TransactionService;
use WayForPay\SDK\Exception\JsonParseException;
use WayForPay\SDK\Exception\SignatureException;
use WayForPay\SDK\Helper\SignatureHelper;
use WayForPay\SDK\Response\ServiceResponse;

class ServiceUrlHandler
{
    const STATUS_ACCEPT = 'accept';

    /**
     * @var AccountSecretCredential
     */
    private $credential;

    public function __construct(AccountSecretCredential $credential)
    {
        $this->credential = $credential;
    }

    /**
     * @return ServiceResponse
     * @throws \Exception
     */
    public function parseRequestFromGlobals()
    {
        return $this->parseRequestFromArray($_REQUEST);
    }

    /**
     * @return ServiceResponse
     * @throws \Exception
     */
    public function parseRequestFromPostRaw()
    {
        $data = \json_decode(file_get_contents('php://input'), TRUE);

        if ($data === null) {
            throw new JsonParseException(\json_last_error_msg(), \json_last_error());
        }

        return $this->parseRequestFromArray($data);
    }

    /**
     * @param array $data
     * @return ServiceResponse
     * @throws \Exception
     */
    public function parseRequestFromArray(array $data)
    {
        $response = new ServiceResponse($data);

        $transaction = $response->getTransaction();
        $expectedSignature = SignatureHelper::calculateSignature(
            array(
                $this->credential->getAccount(),
                $transaction->getOrderReference(),
                $transaction->getAmount(),
                $transaction->getCurrency(),
                $transaction->getAuthCode(),
                $transaction->getCardPan(),
                $transaction->getStatus(),
                $response->getReason()->getCode()
            ),
            $this->credential->getSecret()
        );

        if (!isset($data['merchantSignature'])
            || $expectedSignature !== $data['merchantSignature']
        ) {
            throw new SignatureException(
                'Response signature mismatch: expected ' . $expectedSignature .
                ', got ' . (isset($data['merchantSignature']) ? $data['merchantSignature'] :  '')
            );
        }

        return $response;
    }

    /**
     * @param TransactionService $transaction
     * @return string
     */
    public function getSuccessResponse(TransactionService $transaction)
    {
        $time = time();
        return \json_encode(array(
            'orderReference' => $transaction->getOrderReference(),
            'status' => self::STATUS_ACCEPT,
            'time' => $time,
            'signature' => SignatureHelper::calculateSignature(
                array(
                    $transaction->getOrderReference(),
                    self::STATUS_ACCEPT,
                    $time
                ),
                $this->credential->getSecret()
            )
        ));
    }
}