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

jimport("itprism.controller.form.backend");

/**
 * Tag controller class.
 *
 * @package		ITPrism Components
 * @subpackage	ITPMeta
 * @since		1.6
 */
class ItpMetaControllerTag extends ITPrismControllerFormBackend {
    
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

        // Check for validation errors.
        if ($validData === false) {
            $this->displayNotice($form->getErrors(), $redirectData);
            return;
        }
        
        // Fix magic quotes
        if(get_magic_quotes_gpc()) {
            $validData["content"] = stripslashes($validData["content"]);
            $validData["output"]  = stripslashes($validData["output"]);
            $validData["tag"]     = stripslashes($validData["tag"]);
            $validData["title"]   = stripslashes($validData["title"]);
        }
        
        try {
            
            $itemId = $model->save($validData);
            $redirectData["id"] = $itemId;
            
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $this->displayMessage(JText::_('COM_ITPMETA_TAG_SAVED'), $redirectData);
        
    }
    
	/**
     * 
     * Prepare redirect link. 
     * If has clicked apply, will be redirected to edit form and will be loaded the item data
     * If has clicked save2new, will be redirected to edit form, and you will be able to add a new record
     * If has clicked save, will be redirected to the list of items
     *
     * @param integer $itemId 
     */
    protected function prepareRedirectLink($data) {
        
        $task = $this->getTask();
        $link = $this->defaultLink;
        
        $itemId = JArrayHelper::getValue($data, "id");
        
        // Prepare redirection
        switch($task) {
            case "apply":
                $link .= "&view=".$this->view_item. $this->getRedirectToItemAppend($itemId);
                break;
                
            case "save2new":
                $link .= "&view=".$this->view_item. $this->getRedirectToItemAppend();
                break;
                
            default:
                
                $urlId = JFactory::getApplication()->getUserState("url.id");
                $link .= "&view=url&layout=edit&id=".$urlId;
                
                break;
        }
        
        return $link;
    }
    
    /**
     * Cancel operations
     */
    public function cancel(){
        
        $urlId = JFactory::getApplication()->getUserState("url.id");
        
        $this->setRedirect(JRoute::_($this->defaultLink . "&view=url&layout=edit&id=".$urlId, false));
    
    }
    
}