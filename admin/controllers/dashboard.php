<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * ITPMeta dashboard Controller.
 *
 * @package     ITPMeta
 * @subpackage  Component
 */
class ItpmetaControllerDashboard extends JControllerLegacy
{
    private $defaultLink = 'index.php?option=com_itpmeta';

    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';
    
    public function getModel($name = 'Dashboard', $prefix = 'ItpmetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    public function backToDashboard()
    {
        $this->setRedirect(JRoute::_($this->defaultLink . '&view=dashboard', false));
    }
}
