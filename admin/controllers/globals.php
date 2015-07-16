<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

/**
 * Global Tags controller class.
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
 */
class ItpMetaControllerGlobals extends JControllerAdmin
{
    public function getModel($name = 'Global', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }
}
