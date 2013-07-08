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

jimport('itprism.controller.admin');

/**
 * Tags Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
  */
class ItpMetaControllerTags extends ITPrismControllerAdmin {
    
    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';
    
    /**
     * Proxy for getModel.
     * @since   1.6
     */
    public function getModel($name = 'Tag', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
    
    /**
     * Removes an item.
     * @return  void
     *
     * @since   12.2
     */
    public function delete() {
    
        // Check for request forgeries
        JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
    
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
    
        // Gets the data from the form
        $cid    = $app->input->post->get('cid', array(), 'array');
        JArrayHelper::toInteger($cid);
    
        $urlId  = $app->getUserState("url.id");
    
        $redirectData = array(
            "view"   => "url",
            "layout" => "edit",
            "id"     => $urlId
        );
    
        if(!$cid) {
            $this->displayWarning(JText::_("COM_ITPMETA_ERROR_INVALID_ITEMS"), $redirectData);
            return;
        }
    
        try {
    
            $model = $this->getModel();
            $model->delete($cid);
    
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
    
        $msg = JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($cid));
        $this->displayMessage($msg, $redirectData);
    
    }
    
    /**
     * Reorder items
     *
     */
    public function reorder() {
    
        // Check for request forgeries
        JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
    
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
    
        // Gets the data from the form
        $ids    = $app->input->post->get('cid', array(), 'array');
        $inc    = ($this->getTask() == 'orderup') ? -1 : +1;
        $urlId  = $app->getUserState("url.id");
        
        JArrayHelper::toInteger($ids);
    
        $redirectData = array(
            "view"   => "url",
            "layout" => "edit",
            "id"     => $urlId
        );
    
        if(!$ids) {
            $this->displayWarning(JText::_("COM_ITPMETA_ERROR_INVALID_ITEMS"), $redirectData);
            return;
        }
    
        try {
    
            $model = $this->getModel();
            $model->reorder($ids, $inc);
    
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
    
        $this->displayMessage(JText::_("COM_ITPMETA_SUCCESS_ORDERING_SAVED"), $redirectData);
    
    }
    
    /**
     * Save new order
     */
    public function saveorder() {
    
        // Check for request forgeries
        JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
    
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
    
        // Gets the data from the form
        $ids    = $app->input->post->get('cid', array(), 'array');
        $order  = $app->input->post->get('order', array(), 'array');
        
        JArrayHelper::toInteger($ids);
        JArrayHelper::toInteger($order);
    
        $urlId  = $app->getUserState("url.id");
    
        $redirectData = array(
            "view"   => "url",
            "layout" => "edit",
            "id"     => $urlId
        );
    
        if(!$ids OR !$order) {
            $this->displayWarning(JText::_("COM_ITPMETA_ERROR_INVALID_ITEMS"), $redirectData);
            return;
        }
    
        try {
    
            $model = $this->getModel();
            $model->saveorder($ids, $order);
    
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
    
        $this->displayMessage(JText::_("COM_ITPMETA_SUCCESS_ORDERING_SAVED"), $redirectData);
    
    }
    
    
}