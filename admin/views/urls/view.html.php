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

class ITPMetaViewUrls extends JViewLegacy
{
    /**
     * @var JDocumentHtml
     */
    public $document;

    /**
     * @var Joomla\Registry\Registry
     */
    protected $state;
    protected $params;

    protected $items;
    protected $pagination;

    protected $numbers;

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

        $this->numbers = $this->get("Numbers");

        // Load HTML helper
        JHtml::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'html');

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
     *
     * Prepare sortable fields, sort values and filters.
     */
    protected function prepareSorting()
    {
        // Prepare filters
        $this->listOrder = $this->escape($this->state->get('list.ordering'));
        $this->listDirn  = $this->escape($this->state->get('list.direction'));
        $this->saveOrder = (strcmp($this->listOrder, 'a.ordering') != 0) ? false : true;

        $this->sortFields = array(
            'a.published'  => JText::_('JSTATUS'),
            'a.autoupdate' => JText::_('COM_ITPMETA_AUTOUPDATE'),
            'a.uri'        => JText::_('COM_ITPMETA_URI_STRING'),
            'a.id'         => JText::_('JGRID_HEADING_ID')
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
        JToolBarHelper::title(JText::_('COM_ITPMETA_URLS_MANAGER'));

        JToolBarHelper::addNew('url.add');
        JToolBarHelper::editList('url.edit');
        JToolBarHelper::divider();
        JToolBarHelper::publishList("urls.publish");
        JToolBarHelper::unpublishList("urls.unpublish");
        JToolbarHelper::divider();
        JToolbarHelper::custom('urls.enableau', "ok", "", JText::_("COM_ITPMETA_URLS_ENABLE_AU"), false);
        JToolbarHelper::custom('urls.disableau', "ban-circle", "", JText::_("COM_ITPMETA_URLS_DISABLE_AU"), false);
        JToolBarHelper::divider();
        JToolBarHelper::deleteList(JText::_("COM_ITPMETA_DELETE_ITEMS_QUESTION"), "urls.delete");
        JToolBarHelper::divider();
        JToolBarHelper::custom('dashboard.backToDashboard', "dashboard", "", JText::_("COM_ITPMETA_DASHBOARD"), false);
    }

    /**
     *
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

        JHtmlSidebar::addFilter(
            JText::_('COM_ITPMETA_SELECT_AUTOUPDATE'),
            'filter_autoupdate',
            JHtml::_('select.options', JHtml::_('itpmeta.enabledOptions'), 'value', 'text', $this->state->get('filter.autoupdate'), true)
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
        $this->document->setTitle(JText::_('COM_ITPMETA_URLS_MANAGER_TITLE'));

        // Load language string in JavaScript
        JText::script('COM_ITPMETA_ERROR_NO_ITEM_SELECTED');

        // Add behaviors
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.multiselect');
        JHtml::_('formbehavior.chosen', 'select');

        JHtml::_("Prism.ui.joomlaList");
        $this->document->addScript('../media/' . $this->option . '/js/admin/' . $this->getName() . '.js');
    }
}
