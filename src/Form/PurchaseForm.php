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

namespace WayForPay\SDK\Form;

use DateTime;
use PFBC\Form;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Contract\EndpointInterface;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Avia;
use WayForPay\SDK\Domain\CardToken;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Delivery;
use WayForPay\SDK\Domain\MerchantTypes;
use WayForPay\SDK\Domain\PaymentSystems;
use WayForPay\SDK\Domain\Regular;
use WayForPay\SDK\Endpoint\ApiEndpoint;
use WayForPay\SDK\Endpoint\PayEndpoint;
use WayForPay\SDK\Helper\SignatureHelper;

class PurchaseForm
{
    private $merchantAuthTypeAllowed = array(
        MerchantTypes::AUTH_SIMPLE_SIGNATURE,
    );

    private $merchantTransactionSecureTypeAllowed = array(
        MerchantTypes::TRANSACTION_SECURE_AUTO,
    );

    private $merchantTransactionTypeAllowed = array(
        MerchantTypes::TRANSACTION_AUTO,
        MerchantTypes::TRANSACTION_SALE,
        MerchantTypes::TRANSACTION_AUTH,
    );

    /**
     * @var EndpointInterface
     */
    private $endpoint;

    /**
     * @var AccountSecretCredential
     */
    private $credential;

    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var ProductCollection
     */
    private $products;

    /**
     * @var DateTime
     */
    private $orderDate;

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
     * @var Client
     */
    private $client;

    /**
     * @var Delivery
     */
    private $delivery;

    /**
     * @var Avia
     */
    private $avia;

    /**
     * @var Regular
     */
    private $regular;

    /**
     * @var CardToken
     */
    private $token;

    /**
     * @var PaymentSystems
     */
    private $paymentSystems;

    /**
     * @var string
     */
    private $serviceUrl;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var int
     */
    private $holdTimeout;

    /**
     * @var int
     */
    private $orderTimeout;

    /**
     * @var int
     */
    private $orderLifetime;

    /**
     * @var string
     */
    private $merchantAuthType;

    /**
     * @var string
     */
    private $socialUri;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $orderNo;

    /**
     * @var float
     */
    private $alternativeAmount;

    /**
     * @var string
     */
    private $alternativeCurrency;

    public function __construct(
        AccountSecretCredential $credential,
        $orderReference,
        $amount,
        $currency,
        ProductCollection $products,
        DateTime $orderDate,
        $merchantDomainName,
        $merchantTransactionType = null,
        $merchantTransactionSecureType = null,
        Client $client = null,
        Delivery $delivery = null,
        Avia $avia = null,
        Regular $regular = null,
        CardToken $token = null,
        PaymentSystems $paymentSystems = null,
        $serviceUrl = null,
        $returnUrl = null,
        $holdTimeout = null,
        $orderTimeout = null,
        $orderLifetime = null,
        $merchantAuthType = null,
        $socialUri = null,
        $language = null,
        $orderNo = null,
        $alternativeAmount = null,
        $alternativeCurrency = null
    ) {
        $this->credential = $credential;
        $this->orderReference = strval($orderReference);
        $this->amount = floatval($amount);
        $this->currency = strval($currency);
        $this->products = $products;
        $this->orderDate = $orderDate;
        $this->merchantDomainName = strval($merchantDomainName);
        $this->merchantTransactionType = strval($merchantTransactionType);
        $this->merchantTransactionSecureType = strval($merchantTransactionSecureType);
        $this->client = $client ?: new Client();
        $this->delivery = $delivery ?: new Delivery();
        $this->avia = $avia ?: new Avia();
        $this->regular = $regular;
        $this->token = $token;
        $this->paymentSystems = $paymentSystems ?: new PaymentSystems();
        $this->serviceUrl = strval($serviceUrl);
        $this->returnUrl = strval($returnUrl);
        $this->holdTimeout = intval($holdTimeout);
        $this->orderTimeout = intval($orderTimeout);
        $this->orderLifetime = intval($orderLifetime);
        $this->merchantAuthType = strval($merchantAuthType);
        $this->socialUri = strval($socialUri);
        $this->language = strval($language);
        $this->orderNo = strval($orderNo);
        $this->alternativeAmount = floatval($alternativeAmount);
        $this->alternativeCurrency = strval($alternativeCurrency);
    }

    public function getData()
    {
        return array(
            'merchantAccount' => $this->credential->getAccount(),
            'merchantDomainName' => $this->merchantDomainName,
            'merchantTransactionType' => $this->merchantTransactionType,
            'merchantTransactionSecureType' => $this->merchantTransactionSecureType,
            'merchantSignature' => SignatureHelper::calculateSignature(
                array(
                    'merchantAccount' => $this->credential->getAccount(),
                    'merchantDomainName' => $this->merchantDomainName,
                    'orderReference' => $this->orderReference,
                    'orderDate' => $this->orderDate->getTimestamp(),
                    'amount' => $this->amount,
                    'currency' => $this->currency,
                    'products' => $this->products
                ),
                $this->credential->getSecret()
            ),
            'language' => $this->language,
            'returnUrl' => $this->returnUrl,
            'serviceUrl' => $this->serviceUrl,
            'orderReference' => $this->orderReference,
            'orderDate' => $this->orderDate->getTimestamp(),
            'orderNo' => $this->orderNo,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'alternativeAmount' => $this->alternativeAmount,
            'alternativeCurrency' => $this->alternativeCurrency,
            'holdTimeout' => $this->holdTimeout,
            'orderTimeout' => $this->orderTimeout,
            'orderLifetime' => $this->orderLifetime,
            'recToken' => $this->token ? $this->token->getToken() : '',
            'productName' => $this->products->getNames(),
            'productPrice' => $this->products->getPrices(),
            'productCount' => $this->products->getCounts(),
            'socialUri' => $this->socialUri,

            'clientAccountId' => $this->client->getId(),
            'clientFirstName' => $this->client->getNameFirst(),
            'clientLastName' => $this->client->getNameLast(),
            'clientAddress' => $this->client->getAddress(),
            'clientCity' => $this->client->getCity(),
            'clientState' => $this->client->getState(),
            'clientZipCode' => $this->client->getZip(),
            'clientCountry' => $this->client->getCountry(),
            'clientEmail' => $this->client->getEmail(),
            'clientPhone' => $this->client->getPhone(),

            'deliveryFirstName' => $this->delivery->getNameFirst(),
            'deliveryLastName' => $this->delivery->getNameLast(),
            'deliveryAddress' => $this->delivery->getAddress(),
            'deliveryCity' => $this->delivery->getCity(),
            'deliveryState' => $this->delivery->getState(),
            'deliveryZipCode' => $this->delivery->getZip(),
            'deliveryCountry' => $this->delivery->getCountry(),
            'deliveryEmail' => $this->delivery->getEmail(),
            'deliveryPhone' => $this->delivery->getPhone(),

            'aviaDepartureDate' => $this->avia->getDepartureDate() ? $this->avia->getDepartureDate()->getTimestamp() : null,
            'aviaLocationNumber' => $this->avia->getLocationNumber(),
            'aviaLocationCodes' => $this->avia->getLocationCodes(),
            'aviaFirstName' => $this->avia->getNameFirst(),
            'aviaLastName' => $this->avia->getNameLast(),
            'aviaReservationCode' => $this->avia->getReservationCode(),

            'regularMode' => $this->regular ? $this->regular->getModesAsString() : null,
            'regularAmount' => $this->regular ? $this->regular->getAmount() : null,
            'dateNext' => $this->regular && $this->regular->getDateNext() ?
                $this->regular->getDateNext()->format('d.m.Y') :
                null,
            'dateEnd' => $this->regular && $this->regular->getDateEnd() ?
                $this->regular->getDateEnd()->format('d.m.Y') :
                null,
            'regularCount' => $this->regular ? $this->regular->getCount() : null,
            'regularOn' => $this->regular ? intval($this->regular->isOn()) : null,

            'paymentSystems' => $this->paymentSystems->getListAsString(),
            'defaultPaymentSystem' => $this->paymentSystems->getDefault(),
        );
    }

    /**
     * @return EndpointInterface|ApiEndpoint
     */
    public function getEndpoint()
    {
        if (!$this->endpoint) {
            $this->endpoint = new PayEndpoint();
        }

        return $this->endpoint;
    }

    /**
     * @param EndpointInterface $endpoint
     * @return PurchaseForm
     */
    public function setEndpoint(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getAsString($submitText = 'Pay', $buttonClass = 'btn btn-primary')
    {
        $endpoint = $this->getEndpoint();

        $form = sprintf(
            '<form method="%s" action="%s" accept-charset="utf-8">',
            $endpoint->getMethod(),
            $endpoint->getUrl()
        );

        foreach (array_filter($this->getData()) as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $field) {
                    $form .= sprintf(
                        '<input type="hidden" name="%s" value="%s" />',
                        $key . '[]',
                        htmlspecialchars($field)
                    );
                }
            } else {
                $form .= sprintf(
                    '<input type="hidden" name="%s" value="%s" />',
                    $key,
                    htmlspecialchars($value)
                );
            }
        }

        $form .= sprintf(
            '<input type="submit" value="%s" class="%s">',
            $submitText,
            $buttonClass
        );

        $form .= '</form>';

        return $form;
    }

    public function getWidget($callbackJsFunction = null, $buttonText = 'Pay', $buttonClass = 'btn btn-primary')
    {
        return $this->getWidgetExternalScript() .
            $this->getWidgetInitScript($callbackJsFunction) .
            $this->getWidgetButton($buttonText, $buttonClass);
    }

    public function getWidgetExternalScript()
    {
        return sprintf(
            '<script defer async id="widget-wfp-script" language="javascript" type="text/javascript" onload="wfpInit()" src="%s"></script>',
            'https://secure.wayforpay.com/server/pay-widget.js'
        );
    }

    public function getWidgetInitScript($callbackJsFunction = null)
    {
        return sprintf(
            '<script type="text/javascript">
                var wayforpay = null;
                var wfpPay = function () {
                    wayforpay.run(%s);
                }
                var wfpInit = function() {      
                    wayforpay = new Wayforpay();
                    
                    window.addEventListener("message", %s);
                    
                    function receiveMessage(event)
                    {
                        if(event.data == "WfpWidgetEventClose"       // при закрытии виджета пользователем
                           || event.data == "WfpWidgetEventApproved" // при успешном завершении операции
                           || event.data == "WfpWidgetEventDeclined" // при неуспешном завершении
                           || event.data == "WfpWidgetEventPending"  // транзакция на обработке
                        ) {
                            console.log(event.data);
                        }
                    }
                }
            </script>',
            \json_encode(array_filter($this->getData())),
            $callbackJsFunction ? $callbackJsFunction : "receiveMessage"
        );
    }

    public function getWidgetButton($buttonText = 'Pay', $buttonClass = 'btn btn-primary')
    {
        return sprintf(
            '<button class="%s" type="button" onclick="wfpPay();">%s</button>',
            $buttonClass,
            $buttonText
        );
    }
}
