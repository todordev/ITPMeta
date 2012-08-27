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

// no direct access
defined('_JEXEC') or die;

jimport('joomla.html.pane');
jimport('joomla.application.component.view');

class ItpMetaViewUrl extends JView {
    
    protected $state;
    protected $item;
    protected $form;
    
    protected $documentTitle;
    protected $option;
    
    public function __construct($config) {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }
    
    
    /**
     * Display the view
     */
    public function display($tpl = null){
        
        $this->state  = $this->get('State');
        $this->item   = $this->get('Item');
        $this->form   = $this->get('Form');

        $this->params = $this->state->get("params");
         
        // Prepare actions, behaviors, scritps and document
        $this->addToolbar();
        $this->setDocument();
        
        parent::display($tpl);
    }
    
    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar(){
        
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);
        $this->documentTitle= $isNew ? JText::_('COM_ITPMETA_ADD_URL')
                                      : JText::_('COM_ITPMETA_EDIT_URL');

        JToolBarHelper::apply('url.apply');
        JToolBarHelper::save2new('url.save2new');
        JToolBarHelper::save('url.save');
        
        if(!$isNew){
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CANCEL');
            JToolBarHelper::title($this->documentTitle, 'itp-edit-url');
        }else{
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CLOSE');
            JToolBarHelper::title($this->documentTitle, 'itp-new-url');
        }
        
    }

    protected function setDocument() {
        
        // Add behaviors
        JHTML::_('behavior.framework');
        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.formvalidation');
        JHTML::_('behavior.modal');
        
        // Add styles
        $this->document->addStyleSheet('../media/'.$this->option.'/js/messageclass/message.css');
        
        // Add JS libraries
        $this->document->addScript('../media/'.$this->option.'/js/messageclass/message.js');
        
        // Add scripts
        $this->document->addScript('../media/'.$this->option.'/js/admin/url.js');
        
        
    }
    
}