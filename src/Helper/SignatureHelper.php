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

namespace WayForPay\SDK\Helper;

use WayForPay\SDK\Contract\SignatureAbleInterface;

class SignatureHelper
{
    const FIELDS_DELIMITER  = ';';
    const DEFAULT_CHARSET   = 'utf8';

    /**
     * @param array $fieldsValues
     * @param string $secret
     * @return string
     */
    public static function calculateSignature(array $fieldsValues, $secret)
    {
        $data = array();

        foreach ($fieldsValues as $item => $value) {
            if (is_object($value) && $value instanceof SignatureAbleInterface) {
                $data[] = $value->getConcatenatedString(self::FIELDS_DELIMITER);
            } elseif (is_array($value)) {
                $data[] = implode(self::FIELDS_DELIMITER, $value);
            } else {
                $data[] = (string) $value;
            }
        }

        /*if ( $this->_charset != self::DEFAULT_CHARSET) {
            if (!function_exists('iconv')) {
                throw new \RuntimeException('iconv extension required');
            }

            foreach($data as $key => $value) {
                $data[$key] = iconv($this->_charset, self::DEFAULT_CHARSET, $data[$key]);
            }
        }*/

        return $data ?
            hash_hmac('md5', implode(self::FIELDS_DELIMITER, $data), $secret) :
            false;
    }
}