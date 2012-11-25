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
class ItpMetaControllerGlobal extends JControllerForm {
    
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
        $itemId  = JArrayHelper::getValue($data, "id");
        
        $model   = $this->getModel();
        
        // Validate the posted data.
        // Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($data, false);
        /** @var $form JForm **/
       
        if (!$form) {
            throw new Exception($model->getError());
        }
        
        try {
            
            // Test if the data is valid.
            $validData = $model->validate($form, $data);
    
            // Check for validation errors.
            if ($validData === false) {
                
                $this->defaultLink .= "&view=".$this->view_item."&layout=edit";
            
                if($itemId) {
                    $this->defaultLink .= "&id=" . $itemId;
                } 
                
                $this->setMessage($model->getError(), "notice");
                $this->setRedirect(JRoute::_($this->defaultLink, false));
                return;
            }
            
            $itemId = $model->save($validData);

        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $msg  = JText::_('COM_ITPMETA_GLOBAL_TAG_SAVED');
        $link = $this->prepareRedirectLink($itemId);
        
        $this->setRedirect(JRoute::_($link, false), $msg);
        
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
    protected function prepareRedirectLink($itemId = 0) {
        
        $task = $this->getTask();
        $link = $this->defaultLink;
        
        // Prepare redirection
        switch($task) {
            case "apply":
                $link .= "&view=".$this->view_item."&layout=edit";
                if(!empty($itemId)) {
                    $link .= "&id=" . (int)$itemId; 
                }
                break;
                
            case "save2new":
                $link .= "&view=".$this->view_item."&layout=edit";
                break;
                
            default:
                $link .= "&view=".$this->view_list;
                break;
        }
        
        return $link;
    }
    
    /**
     * Cancel operations
     *
     */
    public function cancel(){
        
        $msg = "";
        $this->setRedirect(JRoute::_($this->defaultLink . "&view=".$this->view_list, false), $msg);
    
    }
    
}