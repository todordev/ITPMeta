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

jimport('joomla.application.component.view');

class ITPMetaViewEmpty extends JViewLegacy {
    
    public function display($tpl = null) {
        $this->version =   new ItpMetaVersion();
        parent::display($tpl);
    }
    
}