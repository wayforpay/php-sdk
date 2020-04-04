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

namespace WayForPay\SDK\Response;

class InvoiceResponse extends Response
{
	/**
	 * @var string
	 */
	private $invoiceUrl;

	/**
	 * @var string
	 */
	private $qrCode;

	/**
	 * @var bool
	 */
	public $noCheckSignature = true;

	public function __construct(array $data)
	{
		parent::__construct($data);

        $this->qrCode = $data['qrCode'];
        $this->invoiceUrl = $data['invoiceUrl'];
	}

	/**
	 * @return string
	 */
	public function getInvoiceUrl()
	{
		return $this->invoiceUrl;
	}

	/**
	 * @return string
	 */
	public function getQrCode()
	{
		return $this->qrCode;
	}
}
