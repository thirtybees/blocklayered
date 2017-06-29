<?php
/**
 * 2007-2016 PrestaShop
 *
 * Thirty Bees is an extension to the PrestaShop e-commerce software developed by PrestaShop SA
 * Copyright (C) 2017 Thirty Bees
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    Thirty Bees <modules@thirtybees.com>
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2017 Thirty Bees
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  PrestaShop is an internationally registered trademark & property of PrestaShop SA
 */

if (!defined('_TB_VERSION_')) {
    exit;
}

function upgrade_module_2_0_8($object)
{
    $return = Configuration::updateValue('PS_LAYERED_FILTER_PRICE_ROUNDING', 1);
    $query = 'ALTER TABLE `'._DB_PREFIX_.'layered_indexable_attribute_group_lang_value` CHANGE `url_name` `url_name` VARCHAR( 128 ) NULL DEFAULT NULL , CHANGE `meta_title` `meta_title` VARCHAR( 128 ) NULL DEFAULT NULL';
    $return &= Db::getInstance()->execute($query);

    $query = 'ALTER TABLE `'._DB_PREFIX_.'layered_indexable_attribute_lang_value` CHANGE `url_name` `url_name` VARCHAR( 128 ) NULL DEFAULT NULL , CHANGE `meta_title` `meta_title` VARCHAR( 128 ) NULL DEFAULT NULL';
    $return &= Db::getInstance()->execute($query);

    $query = 'ALTER TABLE `'._DB_PREFIX_.'layered_indexable_feature_lang_value` CHANGE `url_name` `url_name` VARCHAR( 128 ) NULL DEFAULT NULL , CHANGE `meta_title` `meta_title` VARCHAR( 128 ) NULL DEFAULT NULL';
    $return &= Db::getInstance()->execute($query);

    $query = 'ALTER TABLE `'._DB_PREFIX_.'layered_indexable_feature_value_lang_value` CHANGE `url_name` `url_name` VARCHAR( 128 ) NULL DEFAULT NULL , CHANGE `meta_title` `meta_title` VARCHAR( 128 ) NULL DEFAULT NULL';
    $return &= Db::getInstance()->execute($query);

    $query = 'ALTER TABLE `'._DB_PREFIX_.'layered_product_attribute` ADD PRIMARY KEY (`id_attribute`, `id_product`), DROP KEY `id_attribute`, ADD UNIQUE KEY `id_attribute_group` (`id_attribute_group`,`id_attribute`,`id_product`)';
    $return &= Db::getInstance()->execute($query);

    return $return;
}
