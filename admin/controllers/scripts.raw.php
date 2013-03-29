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

/**
 * Url controller class.
 *
 * @package		ITPrism Components
 * @subpackage	ITPMeta
 * @since		1.6
 */
class ItpMetaControllerScripts extends JControllerForm {
    
    // Check the table in so it can be edited.... we are done with it anyway
    private $defaultLink = 'index.php?option=com_itpmeta';
    
    /**
     * Save an item
     *
     */
    public function save() {
        
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Initialize variables
        $msg     = "";
        $link    = "";
        
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
        
        // Test if the data is valid.
        $validData = $model->validate($form, $data);
        
        // Validate Item ID
        $itemId    = JArrayHelper::getValue($validData, "url_id", 0, "int");
        if (!$itemId) {
             
            $response = array(
            	"success" => false,
                "title"=> JText::_( 'COM_ITPMETA_FAIL' ),
                "text" => JText::_( 'COM_ITPMETA_ERROR_SYSTEM' ),
            );
                
            echo json_encode($response);
            JFactory::getApplication()->close();
        }
        
        // Fix magic quotes
        if(get_magic_quotes_gpc()) {
            $validData["after_body_tag"]   = stripslashes($validData["after_body_tag"]);
            $validData["before_body_tag"]  = stripslashes($validData["before_body_tag"]);
        }
        
        try {
            $itemId  = $model->save($validData);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'COM_ITPMETA_SCRIPTS_SAVED' ),
            "data" => array(
                "item_id"  => (int)$itemId
            )
        );
            
        echo json_encode($response);
        JFactory::getApplication()->close();
        
    }
    
}