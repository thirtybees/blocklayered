<?php
/**
 * Copyright (C) 2017-2018 thirty bees
 * Copyright (C) 2007-2016 PrestaShop SA
 *
 * thirty bees is an extension to the PrestaShop software by PrestaShop SA.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    thirty bees <modules@thirtybees.com>
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2017-2018 thirty bees
 * @copyright 2007-2016 PrestaShop SA
 * @license   Academic Free License (AFL 3.0)
 * PrestaShop is an internationally registered trademark of PrestaShop SA.
 */

if (!defined('_PS_VERSION_'))
	exit;

function upgrade_module_2_0_14($object)
{
	$return = true;
	if (check_index('layered_product_attribute', 'PRIMARY'))
	{
		$query  = 'ALTER TABLE `'._DB_PREFIX_.'layered_product_attribute` DROP PRIMARY KEY';
		$return = Db::getInstance()->execute($query);
	}

	$query = 'ALTER TABLE `'._DB_PREFIX_.'layered_product_attribute` ADD PRIMARY KEY (`id_attribute`, `id_product`, `id_shop`)';
	$return &= Db::getInstance()->execute($query);

	if (check_index('layered_product_attribute', 'id_attribute_group'))
	{
		$query = 'ALTER TABLE `'._DB_PREFIX_.'layered_product_attribute` DROP KEY `id_attribute_group`';
		$return &= Db::getInstance()->execute($query);
	}

	$query = 'ALTER TABLE `'._DB_PREFIX_.'layered_product_attribute` ADD UNIQUE KEY `id_attribute_group` (`id_attribute_group`,`id_attribute`,`id_product`,`id_shop`)';
	$return &= Db::getInstance()->execute($query);

	return $return;
}

function check_index($table, $key)
{
	$indexes = Db::getInstance()->executeS('SHOW INDEX FROM `'._DB_PREFIX_.$table.'` WHERE Key_name = \''.$key.'\'');
 	return (count($indexes) > 0);
}
