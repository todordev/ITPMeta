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
     * Constructor.
     *
     * @param   array   An optional associative array of configuration settings.
     * @see     JController
     * @since   1.6
     */
    public function __construct($config = array()) {
        
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'content', 'a.content',
                'output', 'a.output'
            );
        }
        
        parent::__construct($config);
    }
    
   /**
     * Build an SQL query to load the list data.
     *
     * @return  JDatabaseQuery
     * @since   1.6
     */
    public function getItems() {
        
        // Create a new query object.
        $db     = $this->getDbo();
        /** @var $db JDatabaseMySQLi **/
        $query  = $db->getQuery(true);

        // Select the required fields from the table.
        $query
            ->select('id, content, output')
            ->from('`#__itpm_tags`')
            ->where('url_id='.(int)$this->state->get('id'));

        $db->setQuery($query);
        $results = $db->loadAssocList();
        
        if(!$results) {
            $results = array();
        }
        
        return $results;
    }
    
}