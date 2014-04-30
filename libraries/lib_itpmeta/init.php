<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

if (!defined("ITPMETA_PATH_COMPONENT_ADMINISTRATOR")) {
    define("ITPMETA_PATH_COMPONENT_ADMINISTRATOR", JPATH_ADMINISTRATOR .DIRECTORY_SEPARATOR. "components" .DIRECTORY_SEPARATOR. "com_itpmeta");
}

if (!defined("ITPMETA_PATH_LIBRARY")) {
    define("ITPMETA_PATH_LIBRARY", JPATH_LIBRARIES .DIRECTORY_SEPARATOR. "itpmeta");
}

// Import libraries
jimport('joomla.utilities.arrayhelper');

// Register component constants
JLoader::register("ITPMetaConstants", ITPMETA_PATH_LIBRARY .DIRECTORY_SEPARATOR. "constants.php");

// Register component libraries
JLoader::register("ItpMetaVersion", ITPMETA_PATH_LIBRARY .DIRECTORY_SEPARATOR. "version.php");

// Register component helpers
JLoader::register("ItpMetaHelper", ITPMETA_PATH_COMPONENT_ADMINISTRATOR .DIRECTORY_SEPARATOR. "helpers" .DIRECTORY_SEPARATOR. "itpmeta.php");

// Register libraries
JLoader::register("ItpMetaExtension", ITPMETA_PATH_LIBRARY .DIRECTORY_SEPARATOR. "extension.php");
JLoader::register("ItpMetaTags", ITPMETA_PATH_LIBRARY .DIRECTORY_SEPARATOR. "tags.php");
JLoader::register("ItpMetaTag", ITPMETA_PATH_LIBRARY .DIRECTORY_SEPARATOR. "tag.php");
JLoader::register("ITPMetaUri", ITPMETA_PATH_LIBRARY .DIRECTORY_SEPARATOR. "uri.php");

// Load library language
$lang = JFactory::getLanguage();
$lang->load('lib_itpmeta', ITPMETA_PATH_LIBRARY);
