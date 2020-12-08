<?php
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
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
 *  @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *  @version  Release: $Revision: 13573 $
 *  
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class PayPalTools
{
    protected $name = null;

    public function __construct($module_name)
    {
        $this->name = $module_name;
    }

    public function moveTopPayments($position)
    {
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $hook_payment = (int) Hook::get('payment');
        } else {
            $hook_payment = (int) Hook::getIdByName('payment');
        }

        $module_instance = Module::getInstanceByName($this->name);

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $module_info = Hook::getModuleFromHook($hook_payment, $module_instance->id);
        } else {
            $module_info = Hook::getModulesFromHook($hook_payment, $module_instance->id);
        }

        if ((isset($module_info['position']) && (int) $module_info['position'] > (int) $position) ||
            (isset($module_info['m.position']) && (int) $module_info['m.position'] > (int) $position)) {
            return $module_instance->updatePosition($hook_payment, 0, (int) $position);
        }

        return $module_instance->updatePosition($hook_payment, 1, (int) $position);
    }

    public function moveRightColumn($position)
    {
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $hook_right = (int) Hook::get('rightColumn');
        } else {
            $hook_right = (int) Hook::getIdByName('rightColumn');
        }

        $module_instance = Module::getInstanceByName($this->name);

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $module_info = Hook::getModuleFromHook($hook_right, $module_instance->id);
        } else {
            $module_info = Hook::getModulesFromHook($hook_right, $module_instance->id);
        }

        if ((isset($module_info['position']) && (int) $module_info['position'] > (int) $position) ||
            (isset($module_info['m.position']) && (int) $module_info['m.position'] > (int) $position)) {
            return $module_instance->updatePosition($hook_right, 0, (int) $position);
        }

        return $module_instance->updatePosition($hook_right, 1, (int) $position);
    }
}