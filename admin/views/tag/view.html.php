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

jimport('joomla.application.component.view');

class ITPMetaViewTag extends JView {
    
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
        
        $this->state  = $this->get('State');
        $this->item   = $this->get('Item');
        $this->form   = $this->get('Form');

        $this->params = $this->state->get("params");

        $this->tag    = $app->input->get("tag");
        $this->urlId  = $app->input->get("url_id");
        
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
    }

    protected function setDocument() {
        
        // Add behaviors
        JHTML::_('behavior.framework');
        JHtml::_('behavior.tooltip');
        JHtml::_('behavior.formvalidation');
        JHTML::_('behavior.modal');
        
        // Add scripts
        $this->document->addScript('../media/'.$this->option.'/js/admin/tag.js?_='.time());
        
    }
}
