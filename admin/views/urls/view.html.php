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

jimport('joomla.application.component.view');

class ITPMetaViewUrls extends JView {
    
    protected $items;
    protected $pagination;
    protected $state;
    
    protected $option;
    
    public function __construct($config) {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }
    
    public function display($tpl = null){
        
        $this->state      = $this->get('State');
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        
        $this->numbers    = $this->get("Numbers");
        
        // Prepare filters
        $this->listOrder  = $this->escape($this->state->get('list.ordering'));
        $this->listDirn   = $this->escape($this->state->get('list.direction'));
        
        $this->version    = new ItpMetaVersion();
        
        // Load HTML helpe
        JHtml::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'html');
        
        // Add submenu
        ItpMetaHelper::addSubmenu($this->getName());
        
        // Prepare actions
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
        
        // Set toolbar items for the page
        JToolBarHelper::title(JText::_('COM_ITPMETA_URLS_MANAGER'), 'itp-urls');
        
        JToolBarHelper::addNew('url.add');
        JToolBarHelper::editList('url.edit');
        JToolBarHelper::divider();
        JToolBarHelper::publishList("urls.publish");
        JToolBarHelper::unpublishList("urls.unpublish");
        JToolBarHelper::divider();
        JToolBarHelper::deleteList(JText::_("COM_ITPMETA_DELETE_ITEMS_QUESTION"), "urls.delete");
        JToolBarHelper::divider();
        JToolBarHelper::custom('dashboard.backToDashboard', "itp-dashboard-back", "", JText::_("COM_ITPMETA_DASHBOARD"), false);
    }

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() {
	    
	    $version = $this->version->getShortVersion();
	    
		$this->document->setTitle(JText::_('COM_ITPMETA_URLS_MANAGER_TITLE'));
		
		// Styles
		$this->document->addStylesheet('../media/'.$this->option.'/css/bootstrap.min.css');
		
        // Scripts
		JHTML::_('behavior.framework');
		JHtml::_('behavior.tooltip');
		
		$this->document->addScript('../media/'.$this->option.'/js/jquery.js');
		$this->document->addScript('../media/'.$this->option.'/js/noconflict.js');
        $this->document->addScript('../media/'.$this->option.'/js/bootstrap.min.js');
        $this->document->addScript('../media/'.$this->option.'/js/admin/'.$this->getName().'.js');
        
        
	}
	
}