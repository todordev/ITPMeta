<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * ITPMeta URLs Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
  */
class ItpMetaControllerGlobals extends JControllerAdmin {
    
    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';
    
    /**
     * Proxy for getModel.
     * @since   1.6
     */
    public function getModel($name = 'Global', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
    
	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 * @return  void
	 * @since   3.0
	 */
	public function saveOrderAjax() {
	    
		// Get the input
		$app     = JFactory::getApplication();
		$pks     = $app->input->post->get('cid', array(), 'array');
		$order   = $app->input->post->get('order', array(), 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the item
        try {
            $model->saveorder($pks, $order);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'JLIB_APPLICATION_SUCCESS_ORDERING_SAVED' ),
            "data" => array()
        );
            
        echo json_encode($response);
        
        JFactory::getApplication()->close();
		
	}
    
}