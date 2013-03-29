<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITPMeta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Script file of VipPortfolio component
 */
class pkg_itpMetaInstallerScript {
    
    /**
     * method to install the component
     *
     * @return void
     */
    public function install($parent) {
    }
    
    /**
     * method to uninstall the component
     *
     * @return void
     */
    public function uninstall($parent) {
    }
    
    /**
     * method to update the component
     *
     * @return void
     */
    public function update($parent) {
    }
    
    /**
     * method to run before an install/update/uninstall method
     *
     * @return void
     */
    public function preflight($type, $parent) {
    }
    
    /**
     * method to run after an install/update/uninstall method
     *
     * @return void
     */
    public function postflight($type, $parent) {
        
        if(strcmp($type, "install") == 0) {
            
            if(!defined("ITPMETA_COMPONENT_ADMINISTRATOR")) {
                define("ITPMETA_COMPONENT_ADMINISTRATOR", JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR ."com_itpmeta");
            }
            
            // Register Component helpers
            JLoader::register("ItpMetaInstallHelper", ITPMETA_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR."helpers".DIRECTORY_SEPARATOR."installer.php");
        
            $this->bootstrap    = JPath::clean( JPATH_SITE.DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."com_itpmeta".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."bootstrap.min.css" );
        
            $style = '<style>'.file_get_contents($this->bootstrap).'</style>';
            echo $style;
            
            // Start table with the information
            ItpMetaInstallHelper::startTable();
        
            // Requirements
            ItpMetaInstallHelper::addRowHeading(JText::_("COM_ITPMETA_MINIMUM_REQUIREMENTS"));
            
            // Display result about verification for cURL library
            $title  = JText::_("COM_ITPMETA_CURL_LIBRARY");
            $info   = "";
            if( !extension_loaded('curl') ) {
                $info   = JText::_("COM_ITPMETA_CURL_INFO");
                $result = array("type" => "important", "text" => JText::_("JOFF"));
            } else {
                $result = array("type" => "success"  , "text" => JText::_("JON"));
            }
            ItpMetaInstallHelper::addRow($title, $result, $info);
            
            // Display result about verification Magic Quotes
            $title  = JText::_("COM_ITPMETA_MAGIC_QUOTES");
            $info   = "";
            if( get_magic_quotes_gpc() ) {
                $info   = JText::_("COM_ITPMETA_MAGIC_QUOTES_INFO");
                $result = array("type" => "important", "text" => JText::_("JON"));
            } else {
                $result = array("type" => "success"  , "text" => JText::_("JOFF"));
            }
            ItpMetaInstallHelper::addRow($title, $result, $info);
            
            // Installed extensions
            ItpMetaInstallHelper::addRowHeading(JText::_("COM_ITPMETA_INSTALLED_EXTENSIONS"));
            
            // System - ITPMeta
            $result = array("type" => "success"  , "text" => JText::_("COM_ITPMETA_INSTALLED"));
            ItpMetaInstallHelper::addRow(JText::_("COM_ITPMETA_SYSTEM_ITPMETA"), $result, JText::_("COM_ITPMETA_PLUGIN"));
            
            // System - ITPMeta - Tags
            $result = array("type" => "success"  , "text" => JText::_("COM_ITPMETA_INSTALLED"));
            ItpMetaInstallHelper::addRow(JText::_("COM_ITPMETA_SYSTEM_ITPMETA_TAGS"), $result, JText::_("COM_ITPMETA_PLUGIN"));
            
            // End table
            ItpMetaInstallHelper::endTable();
            
        }
        
        echo JText::sprintf("COM_ITPMETA_MESSAGE_ENABLE_PLUGINS", JRoute::_("index.php?option=com_plugins&view=plugins&filter_search=itpmeta"));
    }
}
