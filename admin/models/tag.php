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

jimport('joomla.application.component.modeladmin');

class ItpMetaModelTag extends JModelAdmin {
    
    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';
    
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
     * Method to get the record form.
     *
     * @param   array   $data       An optional array of data for the form to interogate.
     * @param   boolean $loadData   True if the form is to load its own data (default case), false if not.
     * @return  JForm   A JForm object on success, false on failure
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true){
        // Initialise variables.
        $app = JFactory::getApplication();
        
        // Get the form.
        $form = $this->loadForm($this->option.'.tag', 'tag', array('control' => 'jform', 'load_data' => $loadData));
        if(empty($form)){
            return false;
        }
        
        return $form;
    }
    
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed   The data for the form.
     * @since   1.6
     */
    protected function loadFormData(){
        
        $app = JFactory::getApplication();
		/** @var $app JAdministrator **/
        
        // Check the session for previously entered form data.
        $data = $app->getUserState($this->option.'.edit.tag.data', array());
        if(empty($data)){
            $data = $this->getItem();
        }
        
        $urlId = $app->input->get("url_id", null);
        if($urlId AND empty($data->url_id)) {
            $data->url_id = $urlId;
        }
        
        if(!empty($data->id)) {
            $data->tag_id   = $data->id;
        }
        
        return $data;
    }

	/**
     * Save an item
     * 
     * @param $data        All data for the category in an array
     * @return integer Item ID
     */
    public function save($data){
        
        $id         = JArrayHelper::getValue($data, "tag_id", null);
        $name       = JArrayHelper::getValue($data, "name", "");
        $title      = JArrayHelper::getValue($data, "title", "");
        $tag        = JArrayHelper::getValue($data, "tag", "");
        $content    = JArrayHelper::getValue($data, "content", "");
        $output     = JArrayHelper::getValue($data, "output", "");
        $urlId      = JArrayHelper::getValue($data, "url_id", 0);
        
        // Load item data
        $row = $this->getTable();
        $row->load($id);
        
        $row->set("name",        $name);
        $row->set("title",       $title);
        $row->set("tag",         $tag);
        $row->set("content",     $content);
        $row->set("output",      $output);
        $row->set("url_id",      $urlId);
        
        // Prepare the row for saving
		$this->prepareTable($row);
		
        $row->store();
        
        return $row->id;
    
    }
    
	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable(&$table) {
	    
        // get maximum order number
		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db     = JFactory::getDbo();
				$query  = $db->getQuery(true);
				$query
				    ->select("MAX(ordering)")
				    ->from("#__itpm_tags")
				    ->where("url_id =".$table->url_id);
				
			    $db->setQuery($query, 0, 1);
				$max   = $db->loadResult();

				$table->ordering = $max+1;
			}
		}
        
	}
    
    /**
     * 
     * Delete tags based on URL id
     * @param array $pks URLs ids
     */
    public function deleteByUrlId(&$pks) {
        
        JArrayHelper::toInteger($pks);
        
        if(!empty($pks)) {
            
            $db     = $this->getDbo();
            /** @var $db JDatabaseMySQLi **/
            
            $query  = $db->getQuery(true);
    
            // Select the required fields from the table.
            $query
                ->delete()
                ->from($db->quoteName('#__itpm_tags'))
                ->where('url_id IN ('.implode(",", $pks).')');
    
            $db->setQuery($query);
            $db->query();
        }
        
    }
    
	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param	object	A record object.
	 *
	 * @return	array	An array of conditions to add to add to ordering queries.
	 * @since	1.6
	 */
	protected function getReorderConditions($table){
		$condition = array();
		$condition[] = 'url_id = '.(int) $table->url_id;
		return $condition;
	}
	
}