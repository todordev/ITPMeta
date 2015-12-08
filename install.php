<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

class pkg_itpMetaInstallerScript
{
    /**
     * Method to install the component
     *
     * @param mixed $parent
     *
     * @return void
     */
    public function install($parent)
    {
    }

    /**
     * Method to uninstall the component
     *
     * @param mixed $parent
     *
     * @return void
     */
    public function uninstall($parent)
    {
    }

    /**
     * Method to update the component
     *
     * @param mixed $parent
     *
     * @return void
     */
    public function update($parent)
    {
    }

    /**
     * Method to run before an install/update/uninstall method
     *
     * @param string $type
     * @param mixed $parent
     *
     * @return void
     */
    public function preflight($type, $parent)
    {
    }

    /**
     * Method to run after an install/update/uninstall method
     *
     * @param string $type
     * @param mixed $parent
     *
     * @return void
     */
    public function postflight($type, $parent)
    {
        if (!defined('ITPMETA_PATH_COMPONENT_ADMINISTRATOR')) {
            define('ITPMETA_PATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_itpmeta');
        }

        jimport('Prism.init');
        jimport('Itpmeta.init');

        // Register Component helpers
        JLoader::register('ItpMetaInstallHelper', ITPMETA_PATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'install.php');

        // Start table with the information
        ItpMetaInstallHelper::startTable();

        // Requirements
        ItpMetaInstallHelper::addRowHeading(JText::_('COM_ITPMETA_MINIMUM_REQUIREMENTS'));

        // Display result about verification for cURL library
        $title = JText::_('COM_ITPMETA_CURL_LIBRARY');
        $info  = '';
        if (!extension_loaded('curl')) {
            $info   = JText::_('COM_ITPMETA_CURL_INFO');
            $result = array('type' => 'important', 'text' => JText::_('JOFF'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JON'));
        }
        ItpMetaInstallHelper::addRow($title, $result, $info);

        // Display result about verification Magic Quotes
        $title = JText::_('COM_ITPMETA_MAGIC_QUOTES');
        $info  = '';
        if (get_magic_quotes_gpc()) {
            $info   = JText::_('COM_ITPMETA_MAGIC_QUOTES_INFO');
            $result = array('type' => 'important', 'text' => JText::_('JON'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JOFF'));
        }
        ItpMetaInstallHelper::addRow($title, $result, $info);

        // Display result about verification PHP version.
        $title = JText::_('COM_ITPMETA_PHP_VERSION');
        $info  = '';
        if (version_compare(PHP_VERSION, '5.3.0') < 0) {
            $result = array('type' => 'important', 'text' => JText::_('COM_ITPMETA_WARNING'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JYES'));
        }
        ItpMetaInstallHelper::addRow($title, $result, $info);

        // Display result about verification of installed Prism Library
        jimport('itprism.version');
        $title = JText::_('COM_ITPMETA_PRISM_LIBRARY');
        $info  = '';
        if (!class_exists('Prism\\Version')) {
            $info   = JText::_('COM_ITPMETA_PRISM_LIBRARY_DOWNLOAD');
            $result = array('type' => 'important', 'text' => JText::_('JNO'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JYES'));
        }
        ItpMetaInstallHelper::addRow($title, $result, $info);

        // Installed extensions
        ItpMetaInstallHelper::addRowHeading(JText::_('COM_ITPMETA_INSTALLED_EXTENSIONS'));

        // System - ITPMeta
        $result = array('type' => 'success', 'text' => JText::_('COM_ITPMETA_INSTALLED'));
        ItpMetaInstallHelper::addRow(JText::_('COM_ITPMETA_SYSTEM_ITPMETA'), $result, JText::_('COM_ITPMETA_PLUGIN'));

        // End table
        ItpMetaInstallHelper::endTable();

        echo JText::sprintf('COM_ITPMETA_MESSAGE_ENABLE_PLUGINS', JRoute::_('index.php?option=com_plugins&view=plugins&filter_search=itpmeta'));

        if (!class_exists('Prism\\Version')) {
            echo JText::_('COM_ITPMETA_MESSAGE_INSTALL_PRISM_LIBRARY');
        } else {

            if (class_exists('Itpmeta\\Version')) {
                $prismVersion     = new Prism\Version();
                $componentVersion = new Itpmeta\Version();
                if (version_compare($prismVersion->getShortVersion(), $componentVersion->requiredPrismVersion, '<')) {
                    echo JText::_('COM_ITPMETA_MESSAGE_INSTALL_PRISM_LIBRARY');
                }
            }
        }
    }
}
