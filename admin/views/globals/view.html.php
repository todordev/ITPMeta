<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

class ITPMetaViewGlobals extends JViewLegacy
{
    /**
     * @var JDocumentHtml
     */
    public $document;

    /**
     * @var Joomla\Registry\Registry
     */
    protected $state;

    protected $items;
    protected $pagination;

    protected $option;

    protected $listOrder;
    protected $listDirn;
    protected $saveOrder;
    protected $saveOrderingUrl;
    protected $sortFields;

    protected $sidebar;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }

    public function display($tpl = null)
    {
        $this->state      = $this->get('State');
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        $this->prepareSorting();

        // Add submenu
        ItpMetaHelper::addSubmenu($this->getName());

        // Prepare actions
        $this->addToolbar();
        $this->addSidebar();
        $this->setDocument();

        parent::display($tpl);
    }

    /**
     * Prepare sortable fields, sort values and filters.
     */
    protected function prepareSorting()
    {
        // Prepare filters
        $listOrder = $this->escape($this->state->get('list.ordering'));
        $listDirn  = $this->escape($this->state->get('list.direction'));
        $saveOrder = (strcmp($listOrder, 'a.ordering') != 0) ? false : true;

        $this->listOrder = $listOrder;
        $this->listDirn  = $listDirn;
        $this->saveOrder = $saveOrder;

        if ($this->saveOrder) {
            $this->saveOrderingUrl = 'index.php?option='.$this->option.'&task='.$this->getName().'.saveOrderAjax&format=raw';
            JHtml::_('sortablelist.sortable', $this->getName().'List', 'adminForm', strtolower($listDirn), $this->saveOrderingUrl);
        }

        $this->sortFields = array(
            'a.ordering'  => JText::_('JGRID_HEADING_ORDERING'),
            'a.published' => JText::_('JSTATUS'),
            'a.title'     => JText::_('JGLOBAL_TITLE'),
            'a.id'        => JText::_('JGRID_HEADING_ID')
        );

    }

    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar()
    {
        // Set toolbar items for the page
        JToolBarHelper::title(JText::_('COM_ITPMETA_GLOBAL_TAGS_MANAGER'));

        JToolBarHelper::addNew('global.add');
        JToolBarHelper::editList('global.edit');
        JToolBarHelper::divider();
        JToolBarHelper::publishList("globals.publish");
        JToolBarHelper::unpublishList("globals.unpublish");
        JToolBarHelper::divider();
        JToolBarHelper::deleteList(JText::_("COM_ITPMETA_DELETE_ITEMS_QUESTION"), "globals.delete");
        JToolBarHelper::divider();
        JToolBarHelper::custom('dashboard.backToDashboard', "dashboard", "", JText::_("COM_ITPMETA_DASHBOARD"), false);
    }

    /**
     * Add a menu on the sidebar of page
     */
    protected function addSidebar()
    {
        JHtmlSidebar::setAction('index.php?option=' . $this->option . '&view=' . $this->getName());

        JHtmlSidebar::addFilter(
            JText::_('JOPTION_SELECT_PUBLISHED'),
            'filter_state',
            JHtml::_('select.options', JHtml::_('jgrid.publishedOptions', array("archived" => false, "trash" => false)), 'value', 'text', $this->state->get('filter.state'), true)
        );

        $this->sidebar = JHtmlSidebar::render();
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $this->document->setTitle(JText::_('COM_ITPMETA_GLOBAL_TAGS_MANAGER'));

        // Scripts
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.multiselect');
        JHtml::_('formbehavior.chosen', 'select');

        JHtml::_("Prism.ui.joomlaList");
    }
}
