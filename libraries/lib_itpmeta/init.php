<?php
/**
 * @package      Itpmeta
 * @subpackage   Initializator
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
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
JLoader::register('ItpmetaHelper', ITPMETA_PATH_COMPONENT_ADMINISTRATOR .'/helpers/itpmeta.php');

// Load HTML helper
JHtml::addIncludePath(ITPMETA_PATH_COMPONENT_ADMINISTRATOR . '/helpers/html');

// Load library language
$lang = JFactory::getLanguage();
$lang->load('lib_itpmeta', ITPMETA_PATH_COMPONENT_SITE);

JLog::addLogger(
    array(
        'text_file' => 'com_itpmeta.errors.php'
    ),
    // Sets messages of specific log levels to be sent to the file
    JLog::CRITICAL + JLog::EMERGENCY + JLog::ALERT + JLog::ERROR + JLog::WARNING,
    // The log category/categories which should be recorded in this file
    // In this case, it's just the one category from our extension, still
    // we need to put it inside an array
    array('com_itpmeta')
);
