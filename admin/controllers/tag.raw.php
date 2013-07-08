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
	
    public function saveAjax() {
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        // Get the data from the form
        $itemId  = $app->input->post->get('pk', 0, 'uint');
        $content = $app->input->post->get('value', "", "raw");
        $content = htmlentities($content, ENT_QUOTES, "UTF-8");
        
        $model   = $this->getModel();
        
        if (!$itemId OR !$content) {
             
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
            $validData["content"] = stripslashes($content);
        }
        
        // Save the item
        try {
            $data = $model->saveAjax($itemId, $content);
        } catch ( Exception $e ) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $response = array(
        	"success" => true,
            "title"   => JText::_( 'COM_ITPMETA_SUCCESS' ),
            "text"    => JText::_( 'COM_ITPMETA_TAG_SAVED' ),
            "data"    => $data
        );
            
        echo json_encode($response);
        JFactory::getApplication()->close();
        
    }
    
}