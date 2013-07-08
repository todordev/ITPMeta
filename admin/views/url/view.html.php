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
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        $this->state   = $this->get('State');
        $this->item    = $this->get('Item');
        $this->form    = $this->get('Form');

        $this->params  = $this->state->get("params");
        
        // Get URL ID
        $this->itemId  = $this->state->get($this->getName().".id");
        $app->setUserState("url.id", $this->itemId);
        
        $this->version = new ItpMetaVersion();
         
        // Prepare actions, behaviors, scritps and document
        $this->addToolbar();
        $this->setDocument();
        
        // Prepare Tags List
        if(!empty($this->itemId)) {
            $modelTags    = JModelLegacy::getInstance("Tags", "ItpMetaModel", array('ignore_request' => false));
            $this->items       = $modelTags->getItems();
            $this->pagination  = $modelTags->getPagination();
        
            $this->prepareTagsList($modelTags);
        
        }
        
        parent::display($tpl);
    }
    
    protected function prepareTagsList($modelTags) {
    
        $tagsState        = $modelTags->getState();
        
        // Prepare filters
        $this->listOrder  = $this->escape($tagsState->get('list.ordering'));
        $this->listDirn   = $this->escape($tagsState->get('list.direction'));
        $this->saveOrder  = (strcmp($this->listOrder, 'a.ordering') != 0 ) ? false : true;
        
        $version = $this->version->getShortVersion();
    
        // Load language string in JavaScript
        JText::script('COM_ITPMETA_EDIT_CONTENT');
        JText::script('COM_ITPMETA_ERROR_MAKE_SELECTION');
        JText::script('COM_ITPMETA_DELETE_ITEMS_QUESTION');
    
        // Load HTML helper
        JHtml::addIncludePath(ITPRISM_PATH_LIBRARY.'/ui/helpers');
        JHtml::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'html');
    
        // Styles
        $this->document->addStylesheet('../media/'.$this->option.'/css/bootstrap.min.css');
        
        // Scripts
        $this->document->addScript('../media/'.$this->option.'/js/bootstrap.min.js');
        
        JHTML::_("itprism.ui.pnotify");
        JHTML::_("itprism.ui.bootstrap_editable");
        
        $this->document->addScript('../media/'.$this->option.'/js/admin/tags.js?v='.$version);
        
    
    }
    
    
    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar(){
        
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);
        $this->documentTitle = $isNew  ? JText::_('COM_ITPMETA_ADD_URL')
                                       : JText::_('COM_ITPMETA_EDIT_URL');

        JToolBarHelper::apply('url.apply');
        JToolBarHelper::save2new('url.save2new');
        JToolBarHelper::save('url.save');
        JToolBarHelper::divider();
        
        if(!$isNew) {
            
            // Add custom buttons
    		$bar = JToolBar::getInstance('toolbar');
    		
    		// Go to script manager
    		$link = JRoute::_('index.php?option=com_itpmeta&view=scripts&layout=edit', false );
    		$bar->appendButton('Link', 'itp-scripts-32', JText::_("COM_ITPMETA_SCRIPTS"), $link);
    		
            JToolBarHelper::divider();
            
        }
        
        if(!$isNew){
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CANCEL');
            JToolBarHelper::title($this->documentTitle, 'itp-edit-url');
        }else{
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CLOSE');
            JToolBarHelper::title($this->documentTitle, 'itp-new-url');
        }
        
    }

    protected function setDocument() {
        
        $version = $this->version->getShortVersion();
        
        // Add scripts
        JHTML::_('behavior.framework');
        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.formvalidation');
        
        $this->document->addScript('../media/'.$this->option.'/js/jquery.js');
        $this->document->addScript('../media/'.$this->option.'/js/noconflict.js');
        $this->document->addScript('../media/'.$this->option.'/js/admin/utilities.js?v='.$version);
        $this->document->addScript('../media/'.$this->option.'/js/admin/helper.js?v='.$version);
        $this->document->addScript('../media/'.$this->option.'/js/admin/'.$this->getName().'.js?v='.$version);
        
    }
    
}