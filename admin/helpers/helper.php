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

/**
 * It is the component helper class
 *
 */
class ItpMetaHelper {
	
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 * @since	1.6
	 */
	public static function addSubmenu($vName = 'cpanel') {
	    
	    JSubMenuHelper::addEntry(
			JText::_('COM_ITPMETA_CPANEL_TITLE'),
			'index.php?option=com_itpmeta&view=cpanel',
			$vName == 'cpanel'
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
	}
	
    /**
     * Load Tags for specefic url
     * 
     * @param string    $url
     * @param boolean   $published
     * @return array    Tags
     * 
     * @todo Do it with query object
     */
    public static function getTags($urlPath){
        
        $db = JFactory::getDBO();
        
        /*
        $query = $db->getQuery(true);
        $query
            ->select("output")
            ->from("#__itpm_tags AS a")
            ->join("LEFT", "#__itpm_urls AS b ON a.url_id = b.id")
            ->where("b.uri = ". $db->quote( $urlPath ))
            ->where("b.published = 1")
            ;
            
        $query2 = $db->getQuery(true);
        $query2
            ->select("output")
            ->from("#__itpm_global_tags")
            ->where("published = 1");

        $query->union($query2);
         */
        
        $query = "
        	( SELECT 
        		`output`
    		FROM
    			#__itpm_tags AS a
			LEFT JOIN
				#__itpm_urls AS b 
			ON 
				a.url_id = b.id
			WHERE
				b.uri = ". $db->quote( $urlPath ) . "
			AND
				b.published = 1 )
				
			UNION
			
			( SELECT 
        		`output`
    		FROM
    			#__itpm_global_tags
			WHERE
				published = 1 )
        ";
        
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;
        
    }
    
   
}