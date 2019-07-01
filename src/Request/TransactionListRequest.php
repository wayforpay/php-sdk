<?php

namespace WayForPay\SDK\Request;

use DateTime;
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

    public function getRequestSignatureFieldsRequired()
    {
        return array_merge(parent::getRequestSignatureFieldsRequired(), array(
            'dateBegin',
            'dateEnd',
        ));
    }

    public function getRequestSignatureFieldsValues($charset = self::DEFAULT_CHARSET)
    {
        return array_merge(parent::getRequestSignatureFieldsValues($charset), array(
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

    public function getResponseClass()
    {
        return TransactionListResponse::getClass();
    }
}