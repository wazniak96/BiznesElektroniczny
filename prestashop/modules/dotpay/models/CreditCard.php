<?php
/**
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
*  @author    Dotpay Team <tech@dotpay.pl>
*  @copyright Dotpay
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

/**
 * Model of Credit Card
 */
class DotpayCreditCard extends ObjectModel
{
    /**
     *
     * @var int Card id in shop database
     */
    public $cc_id;
    
    /**
     *
     * @var int First order, which created an entry with card in database
     */
    public $order_id;
    
    /**
     *
     * @var int Id of customer, who is an owner of saved card
     */
    public $customer_id;
    
    /**
     *
     * @var string Masked number of saved card
     */
    public $mask;
    
    /**
     *
     * @var string Brand name
     */
    public $brand;
    
    /**
     *
     * @var string Card hash, unique in database
     */
    public $hash;
    
    /**
     *
     * @var string Unique card id, created by Dotpay after first successfull transacion
     */
    public $card_id;
    
    /**
     *
     * @var string Date when card was registering
     */
    public $register_date;
    
    /**
     *
     * @var DotpayCardBrand Object with card brand data
     */
    public $card_brand;
    
    public static $definition = array(
        'table' => 'dotpay_credit_cards',
        'primary' => 'cc_id',
        'fields' => array(
            'order_id' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'customer_id' => array('type' => self::TYPE_STRING, 'validate' => 'isUnsignedId', 'required' => true),
            'mask' => array('type' => self::TYPE_STRING, 'validate' => 'isMessage'),
            'brand' => array('type' => self::TYPE_STRING, 'validate' => 'isMessage'),
            'hash' => array('type' => self::TYPE_STRING, 'validate' => 'isMessage', 'required' => true),
            'card_id' => array('type' => self::TYPE_STRING, 'validate' => 'isMessage'),
            'register_date' => array('type' => self::TYPE_DATE),
        )
    );
    
    /**
     * Create table for this model
     * @return boolean
     */
    public static function create()
    {
        return Db::getInstance()->execute(
            'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.self::$definition['table'].'` (
                `cc_id` BIGINT(20) UNSIGNED NOT null AUTO_INCREMENT,
                `order_id` INT UNSIGNED NOT null,
                `customer_id` INT UNSIGNED NOT null,
                `mask` varchar(20) DEFAULT null,
                `brand` varchar(20) DEFAULT null,
                `hash` varchar(100) NOT null,
                `card_id` VARCHAR(128) DEFAULT null,
                `register_date` DATE DEFAULT null,
                PRIMARY KEY (`cc_id`),
                UNIQUE KEY `hash` (`hash`),
                UNIQUE KEY `cc_order` (`order_id`),
                UNIQUE KEY `card_id` (`card_id`),
                KEY `customer_id` (`customer_id`),
                CONSTRAINT fk_customer_id
                    FOREIGN KEY (customer_id)
                    REFERENCES `'._DB_PREFIX_.Customer::$definition['table'].'` (`'.Customer::$definition['primary'].'`)
                    ON DELETE CASCADE
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;'
        );
    }
    
    /**
     * Drop table for this model
     * @return boolean
     */
    public static function drop()
    {
        return Db::getInstance()->execute(
            'DROP TABLE IF EXISTS `'._DB_PREFIX_.self::$definition['table'].'`;'
        );
    }
    
    /**
     * Saves current object to database (add or update)
     * @param bool $null_values
     * @param bool $auto_date
     * 
     * @return bool Insertion result
     * @throws PrestaShopException
     */
    public function save($null_values = true, $auto_date = true)
    {
        $this->register_date = DotpayCreditCard::reverseDate($this->register_date);
        if ($this->hash == null) {
            $hash = $this->getUniqueCardHash();
            if ($hash) {
                $this->hash = $hash;
            } else {
                return false;
            }
        }
        return parent::save($null_values, $auto_date);
    }
    
    /**
     * Get all cards for customer
     * @param int $userId
     * @param boolean $empty
     * @return array
     */
    public static function getAllCardsForCustomer($userId, $empty = false)
    {
        $not = ($empty) ? '' : 'NOT';
        $ids = Db::getInstance()->ExecuteS(
            'SELECT cc_id as id
            FROM `'._DB_PREFIX_.self::$definition['table'].'` 
            WHERE customer_id = '.(int)$userId.' 
            AND 
            card_id IS '.$not.' null'
        );
        $cards = array();
        foreach ($ids as $id) {
            $cards[] = new DotpayCreditCard($id['id']);
        }
        return $cards;
    }
    
    /**
     * Returns details of credit card
     * @param int $order Order id
     * @return \DotpayCreditCard
     */
    public static function getCreditCardByOrder($order)
    {
        $card = Db::getInstance()->ExecuteS(
            'SELECT cc_id as id
            FROM `'._DB_PREFIX_.self::$definition['table'].'` 
            WHERE order_id = '.(int)$order
        );
        if (!count($card)) {
            return null;
        }
        return new DotpayCreditCard($card[0]['id']);
    }

    /**
     * Delete all cards for customer
     * @param int $userId
     * @param boolean $empty
     * @return boolean
     */
    public static function deleteAllCardsForCustomer($userId)
    {
        return Db::getInstance()->delete(self::$definition['table'], '`customer_id` = '.(int)$userId);
    }
    
    /**
     * Delete all cards for non existing customers
     * @return boolean
     */
    public static function deleteAllCardsForNonExistingCustomers()
    {
        return Db::getInstance()->execute(
            'DELETE 
            FROM `'._DB_PREFIX_.self::$definition['table'].'` 
            WHERE customer_id NOT IN (
                SELECT id_customer 
                FROM `'._DB_PREFIX_.Customer::$definition['table'].'`
            )'
        );
    }
    
    /**
     * Returns date in reverse order
     * @param string $date Source date
     * @return string
     */
    public static function reverseDate($date)
    {
        $tmp = explode('-', $date);
        return implode('-', array_reverse($tmp));
    }

    /**
     * Generate card hash for OneClick
     * @return string
     */
    private function generateCardHash()
    {
        $microtime = '' . microtime(true);
        $md5 = md5($microtime);

        $mtRand = mt_rand(0, 11);

        $md5Substr = Tools::substr($md5, $mtRand, 21);

        $a = Tools::substr($md5Substr, 0, 6);
        $b = Tools::substr($md5Substr, 6, 5);
        $c = Tools::substr($md5Substr, 11, 6);
        $d = Tools::substr($md5Substr, 17, 4);

        return "{$a}-{$b}-{$c}-{$d}";
    }
    
    /**
     * Check, if generated card hash is unique
     * @return string|boolean
     */
    private function getUniqueCardHash()
    {
        $count = 200;
        $result = false;
        do {
            $cardHash = $this->generateCardHash();
            $test = Db::getInstance()->ExecuteS(
                'SELECT count(*) as count  
                FROM `'._DB_PREFIX_.self::$definition['table'].'` 
                WHERE hash = \''.$cardHash.'\''
            );
            
            if ($test[0]['count'] == 0) {
                $result = $cardHash;
                break;
            }

            $count--;
        } while ($count);
        
        return $result;
    }
    
    /**
     * 
     * @param int|null $id Credit card object id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->register_date = DotpayCreditCard::reverseDate($this->register_date);
        $this->card_brand = new DotpayCardBrand($this->brand);
    }
}
