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
 *
 */
class ItpMetaHelper {
	
    static $params = null;
    static $uri    = null;
    
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
			JText::_('COM_ITPMETA_MANAGE_URLS'),
			'index.php?option=com_itpmeta&view=urls',
			$vName == 'urls'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_ITPMETA_PLUGINS'),
			'index.php?option=com_plugins&view=plugins&filter_search=itpmeta',
			$vName == 'plugins'
		);
	
	}
	
    /**
     * Load tags for specific url
     * 
     * @param string    $url
     * @return array    Tags
     * 
     */
    public static function getTags($uriId = null){
        
        $db = JFactory::getDBO();
        
        if(!empty($uriId)) { // Get all tags ( global and URI )
            $query = "
            	( SELECT 
            		a.output, a.ordering, a.name, 0 AS tmp_ordering
        		FROM
        			`#__itpm_global_tags` AS a
    			WHERE
    				a.published = 1 
				)
    				
    			UNION
    			
            	( SELECT 
            		a.output, a.ordering, a.name, 1 AS tmp_ordering
        		FROM
        			`#__itpm_tags` AS a
    			WHERE
    				a.url_id = ". (int)$uriId ." 
             	)
             	
             	ORDER BY 
					tmp_ordering, ordering ASC
				
             	";
            
        } else { // Get only global tags

            $query = $db->getQuery(true);
            $query
                ->select("a.output, a.name")
                ->from($db->quoteName("#__itpm_global_tags") . " AS a")
                ->where("a.published = 1")
                ->order("a.ordering ASC");
        }
        
        $db->setQuery($query);
        $result_ = $db->loadObjectList();
        
        // Prepare results. Replace global tags with the tags of current URI
        // if there are same ones.
        $result = array();
        foreach( $result_ as $row ) {
            if(!empty($row->name)) {
                $result[$row->name] = $row;
            } else {
                $result[] = $row;
            }
        }
        
        return $result;
        
    }
    
    public static function getTagsByUriString($uriString) {
        
        $uri            = self::getUri($uriString);
        if(empty($uri->id)) { // It will only load global tags
            $tags       = self::getTags();
        } else {
            $tags       = self::getTags($uri->id);
        }
        
        return $tags;
    }
    
    public static function getUri($path) {
        
        if(!is_null(self::$uri)) {
            return self::$uri;
        }
        
        $db     = JFactory::getDbo();
        $query  = $db->getQuery(true);
        $query
            ->select("a.id, a.uri, a.after_body_tag, a.before_body_tag, a.published")
            ->from($db->quoteName("#__itpm_urls") ." AS a")
            ->where("a.published = 1")
            ->where("a.uri = " .$db->quote($path));
            
        $db->setQuery($query);
        self::$uri = $db->loadObject();
        
        return self::$uri;
    }
    
    public static function getParams() {
        
        if(self::$params == null) {
            self::$params = JComponentHelper::getParams('com_itpmeta');
        }
        
        return self::$params;
    }
   
    public static function getUriByUriId($uriId) {
       
       $db = JFactory::getDBO();
       /** @var $db JDatabaseMySQLi **/
       $query = $db->getQuery(true);
       
       $query
           ->select("id, uri")
           ->from("#__itpm_urls")
           ->where("id = ".$db->quote($uriId));
       
       $db->setQuery($query, 0, 1);
       $result = $db->loadObject();
       
       return $result;
   }
	
}