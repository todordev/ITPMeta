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
     * Load Tags for specefic url
     * 
     * @param string    $url
     * @param boolean   $published
     * @return array    Tags
     */
    public static function getTags($url, $published = true){
        
        $db = JFactory::getDBO();
 
        $query = "
            SELECT 
                #__itpm_tags.*
            FROM 
                #__itpm_tags AS a
            INNER JOIN
                #__itpm_urls AS b
            ON
                b.id = a.url_id
            WHERE 
                b.url = " . $db->quote( $url );

        if($published){
           $query .= " AND b.published=1"; 
        }
        
        $db->setQuery($query);
        return $db->loadObjectList();
        
    }
   
}