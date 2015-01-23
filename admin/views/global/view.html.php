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

class ItpMetaViewGlobal extends JViewLegacy
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
    protected $form;

    protected $documentTitle;
    protected $option;

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
        $this->state = $this->get('State');
        $this->item  = $this->get('Item');
        $this->form  = $this->get('Form');

        $this->params = $this->state->get("params");

        // Prepare actions, behaviors, scripts and document
        $this->addToolbar();
        $this->setDocument();

        parent::display($tpl);
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
        $this->documentTitle = $isNew ? JText::_('COM_ITPMETA_ADD_GLOBAL_TAG') : JText::_('COM_ITPMETA_EDIT_GLOBAL_TAG');

        JToolBarHelper::apply('global.apply');
        JToolBarHelper::save2new('global.save2new');
        JToolBarHelper::save('global.save');

        if (!$isNew) {
            JToolBarHelper::cancel('global.cancel', 'JTOOLBAR_CANCEL');
            JToolBarHelper::title($this->documentTitle);
        } else {
            JToolBarHelper::cancel('global.cancel', 'JTOOLBAR_CLOSE');
            JToolBarHelper::title($this->documentTitle);
        }

    }

    protected function setDocument()
    {
        // Add behaviors
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.formvalidation');
        JHtml::_('formbehavior.chosen', 'select');

        // Add scripts
        $this->document->addScript('../media/' . $this->option . '/js/admin/utilities.js');
        $this->document->addScript('../media/' . $this->option . '/js/admin/tag_form.js');
        $this->document->addScript('../media/' . $this->option . '/js/admin/global.js');

    }
}
