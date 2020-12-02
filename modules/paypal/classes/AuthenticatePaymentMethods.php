<?php
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author 2007-2019 PayPal
 *  @author 2007-2013 PrestaShop SA <contact@prestashop.com>
 *  @author 2014-2019 202 ecommerce <tech@202-ecommerce.com>
 *  @copyright PayPal
 *  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  
 */

class AuthenticatePaymentMethods
{

    public static function getPaymentMethodsByIsoCode($iso_code)
    {
        // WPS -> Web Payment Standard
        // HSS -> Web Payment Pro / Integral Evolution
        // ECS -> Express Checkout Solution
        // PPP -> PAYPAL PLUS
        // PVZ -> Braintree / Payment VZero

        $payment_method = array(
            'DE'=>array(PPP),
            'ES'=>array(HSS),
            'FR'=>array(HSS, PVZ),
            'IT'=>array(HSS),
            'VA'=>array(HSS),
            'GB'=>array(HSS),
            'HK'=>array(HSS),
            'JP'=>array(HSS),
            'AU'=>array(HSS),
        );
        $return = isset($payment_method[$iso_code]) ? $payment_method[$iso_code] : array();

        if (Configuration::get('VZERO_ENABLED')) {
            $return[] = PVZ;
        }
        array_push($return, WPS, ECS);
        return $return;
    }

    public static function authenticatePaymentMethodByCountry($iso_code)
    {
        return self::getPaymentMethodsByIsoCode($iso_code);
    }
}
