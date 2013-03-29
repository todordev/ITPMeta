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

jimport('joomla.application.component.modellist');

class ItpMetaModelTags extends JModel {
    
    
	/**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param   type    The table type to instantiate
     * @param   string  A prefix for the table class name. Optional.
     * @param   array   Configuration array for model. Optional.
     * @return  JTable  A database object
     * @since   1.6
     */
    public function getTable($type = 'Tag', $prefix = 'ItpMetaTable', $config = array()){
        return JTable::getInstance($type, $prefix, $config);
    }
    
   /**
     * Build an SQL query to load the list data.
     *
     * @return  JDatabaseQuery
     * @since   1.6
     */
    public function getItems($urlId) {
        
        $db     = $this->getDbo();
        /** @var $db JDatabaseMySQLi **/
        $query  = $db->getQuery(true);

        // Select the required fields from the table.
        $query
            ->select('id, title, tag, content, output')
            ->from('`#__itpm_tags`')
            ->where('url_id='.(int)$urlId)
            ->order("ordering ASC");

        $db->setQuery($query);
        $results = $db->loadAssocList();
        
        if(!$results) {
            $results = array();
        }
        
        return $results;
    }
    
    /**
     * 
     * Save the new order of tag
     * @param array $order
     */
    public function saveOrder($order) {
        
        $i = 1;
        foreach( $order as $itemId ) {
            
            // Load item data
            $row = $this->getTable();
            $row->load($itemId);
            
            if(!empty($row->id)) {
                $row->set("ordering", $i);
                $row->store();
                $i++;
            }
            
        }
        
    }
    
}