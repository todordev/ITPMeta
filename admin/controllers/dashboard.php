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

jimport('joomla.application.component.controller');

/**
 * ITPMeta dashboard Controller.
 *
 * @package     ITPMeta
 * @subpackage  Component
 */
class ItpMetaControllerDashboard extends JControllerLegacy
{
    private $defaultLink = 'index.php?option=com_itpmeta';

    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';

    /**
     * Proxy for getModel.
     * @since   1.6
     */
    public function getModel($name = 'Dashboard', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    public function backToDashboard()
    {
        $this->setRedirect(JRoute::_($this->defaultLink . "&view=dashboard", false));
    }
}
