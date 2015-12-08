<?php
/**
 * @package      ItpMeta
 * @subpackage   Initializator
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

if (!defined('ITPMETA_PATH_COMPONENT_ADMINISTRATOR')) {
    define('ITPMETA_PATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR .'/components/com_itpmeta');
}

if (!defined('ITPMETA_PATH_COMPONENT_SITE')) {
    define('ITPMETA_PATH_COMPONENT_SITE', JPATH_SITE .'/components/com_itpmeta');
}

if (!defined('ITPMETA_PATH_LIBRARY')) {
    define('ITPMETA_PATH_LIBRARY', JPATH_LIBRARIES .'/Itpmeta');
}

JLoader::registerNamespace('Itpmeta', JPATH_LIBRARIES);

// Register component helpers
JLoader::register('ItpMetaHelper', ITPMETA_PATH_COMPONENT_ADMINISTRATOR .'/helpers/itpmeta.php');

// Load HTML helper
JHtml::addIncludePath(ITPMETA_PATH_COMPONENT_ADMINISTRATOR . '/helpers/html');

// Load library language
$lang = JFactory::getLanguage();
$lang->load('lib_itpmeta', ITPMETA_PATH_COMPONENT_SITE);
