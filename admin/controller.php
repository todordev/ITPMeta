<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Dashboard Controller
 *
 * @package     ITPMeta
 * @subpackage  Component
 */
class ItpmetaController extends JControllerLegacy
{
    protected $option;

    public function display($cachable = false, $urlparams = array())
    {
        $this->option = JFactory::getApplication()->input->getCmd('option');
        
        $document = JFactory::getDocument();
        /** @var $document JDocumentHtml */

        // Add component style
        $document->addStyleSheet('../media/' . $this->option . '/css/backend.style.css');
        JHtml::_('Prism.ui.backendStyles');
        JHtml::_('Prism.ui.styles');

        $viewName = $this->input->getCmd('view', 'dashboard');
        $this->input->set('view', $viewName);

        parent::display();

        return $this;
    }
}
