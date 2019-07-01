<?php

namespace WayForPay\SDK\Request;

use DateTime;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Card;
use WayForPay\SDK\Domain\CardToken;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Transaction;
use WayForPay\SDK\Response\ChargeResponse;

/**
 * Class ChargeRequest
 * @package WayForPay\SDK\Request
 * @method ChargeResponse send()
 */
class ChargeRequest extends ApiRequest
{
    const MERCHANT_AUTH_TYPE = 'SimpleSignature';

    private $merchantAuthTypeAllowed = array(
        self::MERCHANT_AUTH_TYPE
    );

    const MERCHANT_TRANSACTION_SECURE_TYPE_AUTO = 'AUTO';
    const MERCHANT_TRANSACTION_SECURE_TYPE_3DS = '3DS';
    const MERCHANT_TRANSACTION_SECURE_TYPE_NON3DS = 'NON3DS';

    private $merchantTransactionSecureTypeAllowed = array(
        self::MERCHANT_TRANSACTION_SECURE_TYPE_AUTO,
        self::MERCHANT_TRANSACTION_SECURE_TYPE_3DS,
        self::MERCHANT_TRANSACTION_SECURE_TYPE_NON3DS,
    );

    private $merchantTransactionTypeAllowed = array(
        Transaction::MERCHANT_TRANSACTION_TYPE_SALE,
        Transaction::MERCHANT_TRANSACTION_TYPE_AUTH,
    );

    /**
     * @var string
     */
    private $merchantAuthType;

    /**
     * @var string
     */
    private $merchantDomainName;

    /**
     * @var string
     */
    private $merchantTransactionType;

    /**
     * @var string
     */
    private $merchantTransactionSecureType;

    /**
     * @var string
     */
    private $serviceUrl;

    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var DateTime
     */
    private $orderDate;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var int
     */
    private $holdTimeout;

    /**
     * @var Card|null
     */
    private $card;

    /**
     * @var CardToken|null
     */
    private $recToken;

    /**
     * @var ProductCollection
     */
    private $products;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $socialUri;

    /**
     * ChargeRequest constructor.
     * @param AccountSecretCredential $credential
     * @param Card|CardToken $card
     * @param string $orderReference
     * @param float $amount
     * @param string $currency
     * @param Client $client
     * @param ProductCollection $products
     * @param DateTime $orderDate
     * @param string $merchantDomainName
     * @param string $merchantTransactionType
     * @param string $merchantTransactionSecureType
     * @param string $serviceUrl
     * @param int $holdTimeout
     * @param string $merchantAuthType
     * @param string $socialUri
     */
    public function __construct(
        AccountSecretCredential $credential,
        $card,
        $orderReference,
        $amount,
        $currency,
        Client $client,
        ProductCollection $products,
        DateTime $orderDate,
        $merchantDomainName,
        $merchantTransactionType,
        $merchantTransactionSecureType,
        $serviceUrl = null,
        $holdTimeout = null,
        $merchantAuthType = null,
        $socialUri = null
    ) {
        parent::__construct($credential);

        if ($card instanceof Card) {
            $this->card = $card;
        } elseif ($card instanceof CardToken) {
            $this->recToken = $card;
        } else {
            throw new \InvalidArgumentException('Card or CardToken required');
        }

        if (!in_array($merchantTransactionType, $this->merchantTransactionTypeAllowed)) {
            throw new \InvalidArgumentException(
                'Unexpected transaction type, expected ' . implode(', ', $this->merchantTransactionTypeAllowed)
                . ', got ' . $merchantTransactionType
            );
        }

        if (!in_array($merchantTransactionSecureType, $this->merchantTransactionSecureTypeAllowed)) {
            throw new \InvalidArgumentException(
                'Unexpected transaction secure type, expected ' . implode(', ', $this->merchantTransactionSecureTypeAllowed)
                . ', got ' . $merchantTransactionSecureType
            );
        }

        if ($merchantAuthType && !in_array($merchantAuthType, $this->merchantAuthTypeAllowed)) {
            throw new \InvalidArgumentException(
                'Unexpected auth type, expected ' . implode(', ', $this->merchantAuthTypeAllowed)
                . ', got ' . $merchantAuthType
            );
        }

        if (strlen($currency) !== 3) {
            throw new \InvalidArgumentException('Currency must contain 3 chars');
        }

        $this->merchantAuthType = strval($merchantAuthType);
        $this->merchantDomainName = strval($merchantDomainName);
        $this->merchantTransactionType = strval($merchantTransactionType);
        $this->merchantTransactionSecureType = strval($merchantTransactionSecureType);
        $this->serviceUrl = strval($serviceUrl);
        $this->orderReference = strval($orderReference);
        $this->orderDate = $orderDate;
        $this->amount = floatval($amount);
        $this->currency = strtoupper(strval($currency));
        $this->holdTimeout = intval($holdTimeout);
        $this->products = $products;
        $this->client = $client;
        $this->socialUri = strval($socialUri);
    }

    public function getRequestSignatureFieldsRequired()
    {
        return array_merge(parent::getRequestSignatureFieldsRequired(), array(
            'merchantDomainName',
            'orderReference',
            'orderDate',
            'amount',
            'currency',
            'products'
        ));
    }

    public function getRequestSignatureFieldsValues($charset = self::DEFAULT_CHARSET)
    {
        return array_merge(parent::getRequestSignatureFieldsValues($charset), array(
            'merchantDomainName' => $this->merchantDomainName,
            'orderReference' => $this->orderReference,
            'orderDate' => $this->orderDate->getTimestamp(),
            'amount' => $this->amount,
            'currency' => $this->currency,
            'products' => $this->products
        ));
    }

    public function getResponseSignatureFieldsRequired()
    {
        return array(
            'merchantAccount',
            'orderReference',
            'amount',
            'currency',
            'authCode',
            'cardPan',
            'transactionStatus',
            'reasonCode',
        );
    }

    public function getTransactionType()
    {
        return 'CHARGE';
    }

    public function getTransactionData()
    {
        $data = array_merge(parent::getTransactionData(), array(
            'merchantAuthType' => $this->merchantAuthType,
            'merchantDomainName' => $this->merchantDomainName,
            'merchantTransactionType' => $this->merchantTransactionType,
            'merchantTransactionSecureType' => $this->merchantTransactionSecureType,
            'serviceUrl' => $this->serviceUrl,
            'orderReference' => $this->orderReference,
            'orderDate' => $this->orderDate->getTimestamp(),
            'amount' => $this->amount,
            'currency' => $this->currency,
            'holdTimeout' => $this->holdTimeout,
            'socialUri' => $this->socialUri,
            'clientAccountId' => $this->client->getId(),
            'clientFirstName' => $this->client->getNameFirst(),
            'clientLastName' => $this->client->getNameLast(),
            'clientEmail' => $this->client->getEmail(),
            'clientPhone' => $this->client->getPhone(),
            'clientCountry' => $this->client->getCountry(),
            'clientIpAddress' => $this->client->getIp(),
            'clientAddress' => $this->client->getAddress(),
            'clientCity' => $this->client->getCity(),
            'clientState' => $this->client->getState(),
            'productName' => $this->products->getNames(),
            'productPrice' => $this->products->getPrices(),
            'productCount' => $this->products->getCounts(),
        ));

        if ($this->card) {
            $data = array_merge($data, array(
                'card' => $this->card->getCard(),
                'expMonth' => sprintf('%02d', $this->card->getMonth()),
                'expYear' => strval($this->card->getYear()),
                'cardCvv' => strval($this->card->getCvv()),
                'cardHolder' => strval($this->card->getHolder()),
            ));
        } elseif ($this->recToken) {
            $data = array_merge($data, array(
                'recToken' => $this->recToken->getToken(),
            ));
        } else {
            throw new \RuntimeException('Card or token required');
        }

        return array_filter($data);
    }

    public function getResponseClass()
    {
        return ChargeResponse::getClass();
    }
}