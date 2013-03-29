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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * ITPMeta URLs Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
  */
class ItpMetaControllerTags extends JControllerAdmin {
    
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
    public function getModel($name = 'Tags', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
    
    public function saveorder() {
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Get the data from the form
        $data    = $app->input->post->get('order', array(), 'array');
        $model   = $this->getModel();
        
        JArrayHelper::toInteger($data);
        
        // Validate the data
        if (!$data) {
             
            $response = array(
            	"success" => false,
                "title"=> JText::_( 'COM_ITPMETA_FAIL' ),
                "text" => JText::_( 'COM_ITPMETA_ERROR_SYSTEM' ),
            );
                
            echo json_encode($response);
            JFactory::getApplication()->close();
        }
        
        // Save the item
        try {
            $model->saveOrder($data);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $response = array(
        	"success" => true,
            "title"=> JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text" => JText::_( 'COM_ITPMETA_ORDER_SAVED' )
        );
            
        echo json_encode($response);
        JFactory::getApplication()->close();
        
    }
   
}