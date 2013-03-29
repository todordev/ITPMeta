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

jimport( 'joomla.application.component.controlleradmin' );

/**
 * ITPMeta URLs Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
  */
class ItpMetaControllerUrls extends JControllerAdmin {
    
    private    $defaultLink = 'index.php?option=com_itpmeta';
    
    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';
    
    /**
     * Proxy for getModel.
     * @since   1.6
     */
    public function getModel($name = 'Url', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
    
    /**
	 * Remove items.
	 * 
	 * @return  void
	 * @since   11.1
	 */
	public function delete() {
	    
	    $app       = JFactory::getApplication();
        /** @var $app JAdministrator **/
	    
	    $cid       = $app->input->post->get("cid", array(), "array");
	    $modelTags = $this->getModel("Tag");
	    
	    try {
	        $modelTags->deleteByUrlId($cid);
	        parent::delete();
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $msg  = JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($cid));
        $this->setRedirect(JRoute::_($this->defaultLink."&view=urls", false), $msg);
	    
	}
	
	/**
	 * Disable autoupdate
	 * 
	 * @return  void
	 */
	public function dautoupdate() {
	    
	    $app       = JFactory::getApplication();
        /** @var $app JAdministrator **/
	    
	    $cid       = $app->input->post->get("cid", array(), "array");
	    $model     = $this->getModel();
	    
	    try {
	        $model->updateAutoupdate($cid, 0);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $msg  = JText::plural($this->text_prefix . '_N_ITEMS_AUTOUPDATE_DISABLED', count($cid));
        $this->setRedirect(JRoute::_($this->defaultLink."&view=urls", false), $msg);
	    
	}
	
	/**
	 * Enable autoupdate
	 * 
	 * @return  void
	 */
	public function eautoupdate() {
	    
	    $app       = JFactory::getApplication();
        /** @var $app JAdministrator **/
	    
	    $cid       = $app->input->post->get("cid", array(), "array");
	    $model     = $this->getModel();
	    
	    try {
	        $model->updateAutoupdate($cid, 1);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $msg  = JText::plural($this->text_prefix . '_N_ITEMS_AUTOUPDATE_ENABLED', count($cid));
        $this->setRedirect(JRoute::_($this->defaultLink."&view=urls", false), $msg);
	    
	}
	
    public function backToDashboard() {
        $this->setRedirect( JRoute::_($this->defaultLink, false) );
    }
    
}