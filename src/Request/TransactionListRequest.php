<?php

namespace WayForPay\SDK\Request;

use DateTime;
use WayForPay\SDK\Contract\ResponseInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Response\TransactionListResponse;

/**
 * Class TransactionListRequest
 * @package WayForPay\SDK\Request
 * @method TransactionListResponse send()
 */
class TransactionListRequest extends ApiRequest
{
    /**
     * @var DateTime
     */
    private $dateBegin;

    /**
     * @var DateTime
     */
    private $dateEnd;

    public function __construct(AccountSecretCredential $credential, DateTime $dateBegin, DateTime $dateEnd)
    {
        parent::__construct($credential);

        $this->dateBegin = $dateBegin;
        $this->dateEnd = $dateEnd;
    }

    public function getSignatureFieldsRequired()
    {
        return array_merge(parent::getSignatureFieldsRequired(), array(
            'dateBegin',
            'dateEnd',
        ));
    }

    public function getSignatureFieldsValues($charset = self::DEFAULT_CHARSET)
    {
        return array_merge(parent::getSignatureFieldsValues($charset), array(
            'dateBegin' => $this->dateBegin->getTimestamp(),
            'dateEnd' => $this->dateEnd->getTimestamp(),
        ));
    }

    public function getTransactionType()
    {
        return 'TRANSACTION_LIST';
    }

    public function getTransactionData()
    {
        return array_merge(parent::getTransactionData(), array(
            'dateBegin' => $this->dateBegin->getTimestamp(),
            'dateEnd' => $this->dateEnd->getTimestamp()
        ));
    }

    /**
     * @param array $data
     * @return ResponseInterface|TransactionListResponse
     * @throws \Exception
     */
    public function getResponse(array $data)
    {
        return new TransactionListResponse($data);
    }
}