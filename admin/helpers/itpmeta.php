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
 * It is the component helper class
 */
class ItpMetaHelper {
	
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 * @since	1.6
	 */
	public static function addSubmenu($vName = 'dashboard') {
	    
	    JSubMenuHelper::addEntry(
			JText::_('COM_ITPMETA_DASHBOARD'),
			'index.php?option=com_itpmeta&view=dashboard',
			$vName == 'dashboard'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_ITPMETA_GLOBALS_TAGS'),
			'index.php?option=com_itpmeta&view=globals',
			$vName == 'globals'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_ITPMETA_URLS_MANAGER'),
			'index.php?option=com_itpmeta&view=urls',
			$vName == 'urls'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_ITPMETA_PLUGINS'),
			'index.php?option=com_plugins&view=plugins&filter_search=itpmeta',
			$vName == 'plugins'
		);
	
	}
	
	public static function getTags($uriId = null){
	
	    $db = JFactory::getDBO();
	
	    $query = $db->getQuery(true);
	    $query
    	    ->select("a.id, a.title, a.type")
    	    ->from($db->quoteName("#__itpm_tags") . " AS a")
    	    ->where("url_id = " .(int)$uriId)
    	    ->order("a.ordering ASC");
	
	    $db->setQuery($query);
	    $results = $db->loadObjectList();
	
	    return $results;
	
	}
   
    public static function getOutput($content, $tag) {
	    
	    $pattern = "/{.*}/i";
	    return preg_replace($pattern, $content, $tag);
	    
	}
	
}