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

class ItpMetaViewGlobal extends JView {
    
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
         
        $this->version = new ItpMetaVersion();
        
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
        $this->documentTitle= $isNew ? JText::_('COM_ITPMETA_ADD_GLOBAL_TAG')
                                     : JText::_('COM_ITPMETA_EDIT_GLOBAL_TAG');
                                      
        JToolBarHelper::apply('global.apply');
        JToolBarHelper::save2new('global.save2new');
        JToolBarHelper::save('global.save');
    
        if(!$isNew){
            JToolBarHelper::cancel('global.cancel', 'JTOOLBAR_CANCEL');
            JToolBarHelper::title($this->documentTitle, 'itp-edit-global');
        }else{
            JToolBarHelper::cancel('global.cancel', 'JTOOLBAR_CLOSE');
            JToolBarHelper::title($this->documentTitle, 'itp-new-global');
        }
        
    }

    protected function setDocument() {
        
        $version = $this->version->getShortVersion();
        
        // Add behaviors
        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.formvalidation');
        
        // Add scripts
        $this->document->addScript('../media/'.$this->option.'/js/jquery.js?v='.$version);
        
        $this->document->addScript('../media/'.$this->option.'/js/admin/utilities.js?v='.$version);
        $this->document->addScript('../media/'.$this->option.'/js/admin/tag_form.js?v='.$version);
        $this->document->addScript('../media/'.$this->option.'/js/admin/global.js?v='.$version);
        
        
    }
    
}