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
	public function getModel($name = 'Tag', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true))
	{
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
        
        // Initialize variables
        $itemId  = $app->input->getInt("id");
        $urlId   = $app->input->getInt("url_id");
        
        // Gets the data from the form
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
                "text" => JText::_( 'ITP_ERROR_SYSTEM' ),
            );
                
            echo json_encode($response);
            return;
        }
        
        // Validate URL ID
        $ulrId = JArrayHelper::getValue($validData, "url_id");
        if (!$ulrId) {
             
            $response = array(
            	"success" => false,
                "title"=> JText::_( 'COM_ITPMETA_FAIL' ),
                "text" => JText::_( 'ITP_ERROR_SYSTEM' ),
            );
                
            echo json_encode($response);
            return;
        }
        
        // Save the item
        try {
            $itemId = $model->save($validData);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('ITP_ERROR_SYSTEM'));
        }
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'COM_ITPMETA_TAG_SAVED' ),
            "data" => array(
                "id"    => (int)$itemId,
                "url_id"=> (int)$ulrId
            )
        );
            
        echo json_encode($response);
        return;
        
    }
    

    public function remove() {
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Initialize variables
        $itemId  = $app->input->post->get("id");
        
        try {
            
            // Get the model
            $model = $this->getModel();
            $model->delete($itemId);
            
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception($e->getMessage());
        }
        
//        $this->success = true;
//        $this->title   = JText::_( 'COM_ITPMETA_SUCCESS' );
//        $this->text    = JText::_( 'COM_ITPMETA_TAG_DELETED' );
//        $this->data    = array("item_id"=>$itemId);
        
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'COM_ITPMETA_TAG_DELETED' ),
            "data" => array("item_id"=>$itemId)
        );
        
        echo json_encode($response);
        
    }
    
}