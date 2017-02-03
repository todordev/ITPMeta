<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class pkg_itpmetaInstallerScript
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
        JLoader::register('ItpmetaInstallHelper', ITPMETA_PATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'install.php');

        // Start table with the information
        ItpmetaInstallHelper::startTable();

        // Requirements
        ItpmetaInstallHelper::addRowHeading(JText::_('COM_ITPMETA_MINIMUM_REQUIREMENTS'));

        // Display result about verification for cURL library
        $title = JText::_('COM_ITPMETA_CURL_LIBRARY');
        $info  = '';
        if (!extension_loaded('curl')) {
            $info   = JText::_('COM_ITPMETA_CURL_INFO');
            $result = array('type' => 'important', 'text' => JText::_('JOFF'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JON'));
        }
        ItpmetaInstallHelper::addRow($title, $result, $info);

        // Display result about verification Magic Quotes
        $title = JText::_('COM_ITPMETA_MAGIC_QUOTES');
        $info  = '';
        if (get_magic_quotes_gpc()) {
            $info   = JText::_('COM_ITPMETA_MAGIC_QUOTES_INFO');
            $result = array('type' => 'important', 'text' => JText::_('JON'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JOFF'));
        }
        ItpmetaInstallHelper::addRow($title, $result, $info);

        // Display result about verification PHP version.
        $title = JText::_('COM_ITPMETA_PHP_VERSION');
        $info  = '';
        if (version_compare(PHP_VERSION, '5.5.0') < 0) {
            $result = array('type' => 'important', 'text' => JText::_('COM_ITPMETA_WARNING'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JYES'));
        }
        ItpmetaInstallHelper::addRow($title, $result, $info);

        // Display result about MySQL Version.
        $title = JText::_('COM_ITPMETA_MYSQL_VERSION');
        $info  = '';
        $dbVersion = JFactory::getDbo()->getVersion();
        if (version_compare($dbVersion, '5.5.3', '<')) {
            $result = array('type' => 'important', 'text' => JText::_('COM_ITPMETA_WARNING'));
        } else {
            $result = array('type' => 'success', 'text' => JText::_('JYES'));
        }
        ItpmetaInstallHelper::addRow($title, $result, $info);

        // Display result about verification of installed Prism Library
        $info  = '';
        if (!class_exists('Prism\\Version')) {
            $title  = JText::_('COM_ITPMETA_PRISM_LIBRARY');
            $info   = JText::_('COM_ITPMETA_PRISM_LIBRARY_DOWNLOAD');
            $result = array('type' => 'important', 'text' => JText::_('JNO'));
        } else {
            $prismVersion   = new Prism\Version();
            $text           = JText::sprintf('COM_ITPMETA_CURRENT_V_S', $prismVersion->getShortVersion());

            if (class_exists('Itpmeta\\Version')) {
                $componentVersion = new Itpmeta\Version();
                $title            = JText::sprintf('COM_ITPMETA_PRISM_LIBRARY_S', $componentVersion->requiredPrismVersion);

                if (version_compare($prismVersion->getShortVersion(), $componentVersion->requiredPrismVersion, '<')) {
                    $info   = JText::_('COM_ITPMETA_PRISM_LIBRARY_DOWNLOAD');
                    $result = array('type' => 'warning', 'text' => $text);
                }

            } else {
                $title  = JText::_('COM_ITPMETA_PRISM_LIBRARY');
                $result = array('type' => 'success', 'text' => $text);
            }
        }
        ItpmetaInstallHelper::addRow($title, $result, $info);

        // Installed extensions
        ItpmetaInstallHelper::addRowHeading(JText::_('COM_ITPMETA_INSTALLED_EXTENSIONS'));

        // System - ITPMeta
        $result = array('type' => 'success', 'text' => JText::_('COM_ITPMETA_INSTALLED'));
        ItpmetaInstallHelper::addRow(JText::_('COM_ITPMETA_SYSTEM_ITPMETA'), $result, JText::_('COM_ITPMETA_PLUGIN'));

        // End table
        ItpmetaInstallHelper::endTable();

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
