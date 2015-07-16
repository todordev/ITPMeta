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

jimport('joomla.html.pane');

class ItpMetaViewUrl extends JViewLegacy
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

    protected $item;
    protected $items;
    protected $form;

    protected $itemId;

    protected $documentTitle;
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

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $app = JFactory::getApplication();
        /** @var $app JApplicationAdministrator */

        $this->state = $this->get('State');
        $this->item  = $this->get('Item');
        $this->form  = $this->get('Form');

        $this->params = $this->state->get("params");

        // Get URL ID
        $this->itemId = $this->state->get($this->getName() . ".id");
        $app->setUserState("url.id", $this->itemId);

        // Prepare actions, behaviors, scripts and document
        $this->addToolbar();
        $this->setDocument();

        // Prepare Tags List
        if (!empty($this->itemId)) {
            $modelTags   = JModelLegacy::getInstance("Tags", "ItpMetaModel", array('ignore_request' => false));
            $this->items = $modelTags->getItems();

            $this->prepareSorting($modelTags);
            $this->prepareTagsList();
        }

        parent::display($tpl);
    }

    /**
     * Prepare sortable fields, sort values and filters.
     *
     * @param ItpMetaModelTags $modelTags
     */
    protected function prepareSorting($modelTags)
    {
        $tagsState = $modelTags->getState();

        // Prepare filters
        $this->listOrder = $this->escape($tagsState->get('list.ordering'));
        $this->listDirn  = $this->escape($tagsState->get('list.direction'));
        $this->saveOrder = (strcmp($this->listOrder, 'a.ordering') != 0) ? false : true;

        if ($this->saveOrder) {
            $this->saveOrderingUrl = 'index.php?option=' . $this->option . '&task=tags.saveOrderAjax&format=raw';
            JHtml::_('sortablelist.sortable', 'tagsList', 'tagsForm', strtolower($this->listDirn), $this->saveOrderingUrl);
        }

    }

    protected function prepareTagsList()
    {
        // Load language string in JavaScript
        JText::script('COM_ITPMETA_EDIT_CONTENT');
        JText::script('COM_ITPMETA_ERROR_MAKE_SELECTION');
        JText::script('COM_ITPMETA_DELETE_ITEMS_QUESTION');
        JText::script('COM_ITPMETA_INFO_DISABLE_AUTOUPDATE');
        JText::script('COM_ITPMETA_ADDITIONAL_INFORMATION');

        // Scripts
        JHTML::_("Prism.ui.pnotify");
        JHTML::_("Prism.ui.bootstrap2Editable");

        $this->document->addScript('../media/' . $this->option . '/js/admin/tags.js');
    }

    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $isNew               = ($this->item->id == 0);
        $this->documentTitle = $isNew ? JText::_('COM_ITPMETA_ADD_URL') : JText::_('COM_ITPMETA_EDIT_URL');

        JToolBarHelper::apply('url.apply');
        JToolBarHelper::save2new('url.save2new');
        JToolBarHelper::save('url.save');
        JToolBarHelper::divider();

        if (!$isNew) {

            // Add custom buttons
            $bar = JToolBar::getInstance('toolbar');

            // Go to script manager
            $link = JRoute::_('index.php?option=com_itpmeta&view=scripts&layout=edit', false);
            $bar->appendButton('Link', 'cog', JText::_("COM_ITPMETA_SCRIPTS"), $link);

            JToolBarHelper::divider();
        }

        if (!$isNew) {
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CANCEL');
            JToolBarHelper::title($this->documentTitle);
        } else {
            JToolBarHelper::cancel('url.cancel', 'JTOOLBAR_CLOSE');
            JToolBarHelper::title($this->documentTitle);
        }

    }

    protected function setDocument()
    {
        // Add scripts
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.formvalidation');
        JHtml::_('formbehavior.chosen', 'select');

        JHtml::_('Prism.ui.joomlaHelper');

        $this->document->addScript('../media/' . $this->option . '/js/admin/utilities.js');
        $this->document->addScript('../media/' . $this->option . '/js/admin/' . $this->getName() . '.js');
    }
}
