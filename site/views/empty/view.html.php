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

class ITPMetaViewEmpty extends JViewLegacy
{
    public function display($tpl = null)
    {
        $this->version = new ItpMetaVersion();
        parent::display($tpl);
    }
}
