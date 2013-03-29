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

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class ItpMetaControllerTag extends JControllerForm {
    
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Tag', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
	
	/**
     * Save an item
     *
     */
    public function save() {
        
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Get the data from the form
        $data    = $app->input->post->get('jform', array(), 'array');
        $model   = $this->getModel();
        
        // Validate the posted data.
        // Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($data, false);
        /** @var $form JForm **/
       
        if (!$form) {
            throw new Exception($model->getError());
        }
        
        // Validate the data
        $validData = $model->validate($form, $data);
        if ($validData === false) {
             
            $response = array(
            	"success" => false,
                "title"=> JText::_( 'COM_ITPMETA_FAIL' ),
                "text" => JText::_( 'COM_ITPMETA_ERROR_SYSTEM' ),
            );
                
            echo json_encode($response);
            JFactory::getApplication()->close();
        }
        
        // Validate URL ID
        $urlId = JArrayHelper::getValue($validData, "url_id");
        if (!$urlId) {
             
            $response = array(
            	"success" => false,
                "title"=> JText::_( 'COM_ITPMETA_FAIL' ),
                "text" => JText::_( 'COM_ITPMETA_ERROR_SYSTEM' ),
            );
                
            echo json_encode($response);
            JFactory::getApplication()->close();
        }
        
        // Fix Magic Quotes
        if(get_magic_quotes_gpc()) {
            $validData["content"] = stripslashes($validData["content"]);
            $validData["output"]  = stripslashes($validData["output"]);
            $validData["tag"]     = stripslashes($validData["tag"]);
            $validData["title"]   = stripslashes($validData["title"]);
        }
        
        // Save the item
        try {
            $itemId = $model->save($validData);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'COM_ITPMETA_TAG_SAVED' ),
            "data" => array(
                "item_id"  => (int)$itemId,
                "url_id"   => (int)$urlId
            )
        );
            
        echo json_encode($response);
        JFactory::getApplication()->close();
        
    }
    

    public function remove() {
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Initialize variables
        $itemId  = $app->input->post->get("id");
        $pks     = array($itemId);
        
        try {
            
            $model = $this->getModel();
            $model->delete($pks);
            
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception($e->getMessage());
        }
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'COM_ITPMETA_TAG_DELETED' ),
            "data" => array("item_id"=>$itemId)
        );
        
        echo json_encode($response);
        JFactory::getApplication()->close();
    }
    
}