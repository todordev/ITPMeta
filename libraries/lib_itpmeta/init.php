<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_PLATFORM') or die;

if(!defined("ITPMETA_PATH_COMPONENT_ADMINISTRATOR")) {
    define("ITPMETA_PATH_COMPONENT_ADMINISTRATOR", JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR ."com_itpmeta");
}

if(!defined("ITPMETA_PATH_LIBRARY")) {
    define("ITPMETA_PATH_LIBRARY", JPATH_LIBRARIES . DIRECTORY_SEPARATOR. "itpmeta");
}

if(!defined("ITPRISM_PATH_LIBRARY")) {
    define("ITPRISM_PATH_LIBRARY", JPATH_LIBRARIES . DIRECTORY_SEPARATOR. "itprism");
}

// Import libraries
jimport('joomla.utilities.arrayhelper');

// Register Component libraries
JLoader::register("ItpMetaVersion", ITPMETA_PATH_LIBRARY . DIRECTORY_SEPARATOR . "version.php");

// Register Component helpers
JLoader::register("ItpMetaHelper",ITPMETA_PATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "itpmeta.php");
