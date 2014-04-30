<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerlegacy');

/**
 * Dashboard Controller
 *
 * @package     ITPMeta
 * @subpackage  Component
 */
class ItpMetaController extends JControllerLegacy
{
    protected $option;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->getCmd("option");
    }

    public function display($cachable = false, $urlparams = array())
    {
        $document = JFactory::getDocument();
        /** @var $document JDocumentHtml * */

        // Add component style
        $document->addStyleSheet('../media/' . $this->option . '/css/style.css');

        $viewName = $this->input->getCmd('view', 'dashboard');
        $this->input->set("view", $viewName);

        parent::display();

        return $this;
    }
}
