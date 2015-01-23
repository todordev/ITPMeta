<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

class ITPMetaViewScripts extends JViewLegacy
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

        // Prepare actions, behaviors, scritps and document
        $this->addToolbar();
        $this->setDocument();

        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     * @since   1.6
     */
    protected function addToolbar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        JToolBarHelper::apply('scripts.apply');
        JToolBarHelper::save('scripts.save');
        JToolBarHelper::divider();
        JToolBarHelper::cancel('scripts.cancel', 'JTOOLBAR_CANCEL');
        JToolBarHelper::title(JText::_('COM_ITPMETA_EDIT_SCRIPT'));
    }

    protected function setDocument()
    {
        // Add scripts
        JHtml::_('bootstrap.tooltip');
        JHtml::_('behavior.formvalidation');
        JHtml::_('formbehavior.chosen', 'select');

        $this->document->addScript('../media/' . $this->option . '/js/admin/' . $this->getName() . '.js');
    }
}
