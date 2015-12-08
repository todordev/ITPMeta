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

/**
 * Dashboard Controller
 *
 * @package     ITPMeta
 * @subpackage  Component
 */
class ItpMetaController extends JControllerLegacy
{
    protected $option;

    public function display($cachable = false, $urlparams = array())
    {
        $this->option = JFactory::getApplication()->input->getCmd('option');
        
        $document = JFactory::getDocument();
        /** @var $document JDocumentHtml */

        // Add component style
        $document->addStyleSheet('../media/' . $this->option . '/css/backend.style.css');

        $viewName = $this->input->getCmd('view', 'dashboard');
        $this->input->set('view', $viewName);

        parent::display();

        return $this;
    }
}
