<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
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
        
        // Get the data from the form
        $itemId  = $this->input->post->get('pk', 0, 'uint');
        $content = $this->input->post->get('value', "", "raw");
        $content = htmlentities($content, ENT_QUOTES, "UTF-8");
        
        // Fix Magic Quotes
        if(get_magic_quotes_gpc()) {
            $content = stripslashes($content);
        }
        
        jimport("itprism.response.json");
        $response = new ITPrismResponseJson();
        
        $model   = $this->getModel();
        
        if (!$itemId OR !$content) {
             
            $response = array(
            	"success" => false,
                "title"=> JText::_( 'COM_ITPMETA_FAIL' ),
                "text" => JText::_( 'COM_ITPMETA_ERROR_SYSTEM' ),
            );
            
            $response
                ->setTitle(JText::_('COM_ITPMETA_FAIL'))
                ->setText(JText::_('COM_ITPMETA_ERROR_SYSTEM'))
                ->failure();
                
            echo $response;
            JFactory::getApplication()->close();
        }
        
        // Save the item
        try {
            
            $data = $model->saveAjax($itemId, $content);
            
        } catch (Exception $e) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }
        
        $response
            ->setTitle(JText::_('COM_ITPMETA_SUCCESS'))
            ->setText(JText::_('COM_ITPMETA_TAG_SAVED'))
            ->setData($data)
            ->success();
            
        echo $response;
        JFactory::getApplication()->close();
        
    }
    
}