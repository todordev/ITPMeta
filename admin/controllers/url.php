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

jimport('itprism.controller.form.backend');

/**
 * Url controller class.
 *
 * @package		ITPrism Components
 * @subpackage	ITPMeta
 * @since		1.6
 */
class ItpMetaControllerUrl extends ITPrismControllerFormBackend {
    
    /**
     * Save an item
     */
    public function save() {
        
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Gets the data from the form
        $data    = $app->input->post->get('jform', array(), 'array');
        $itemId  = JArrayHelper::getValue($data, "id", 0, "int");
        
        $redirectData = array(
            "task" => $this->getTask(),
            "id"   => $itemId
        );
        
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
        $itemId    = JArrayHelper::getValue($validData, "id");

        // Check for validation errors.
        if ($validData === false) {
            $this->displayNotice($form->getErrors(), $redirectData);
            return;
        }
            
        // Check for existing URI
        $uri = JArrayHelper::getValue($validData, "uri");
        if(!$itemId AND $model->isUriExist($uri)) {
            $this->displayWarning(JText::_("COM_ITPMETA_ERROR_URI_EXISTS"), array("view" => $this->view_list));
            return;
        }
        
        // Fix magic quotes
        if(get_magic_quotes_gpc()) {
            $validData["after_body_tag"] = stripslashes($validData["after_body_tag"]);
            $validData["before_body_tag"]  = stripslashes($validData["before_body_tag"]);
        }
        
        try {
            
            $itemId = $model->save($validData);
            $redirectData["id"] = $itemId;
            
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $this->displayMessage(JText::_('COM_ITPMETA_URL_SAVED'), $redirectData);
        
    }
    
}