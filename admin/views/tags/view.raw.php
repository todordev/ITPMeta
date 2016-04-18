<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

class ItpmetaViewTags extends JViewLegacy
{
    protected $urlId;
    protected $items;

    public function display($tpl = null)
    {
        $app = JFactory::getApplication();
        /** @var $app JApplicationAdministrator */

        $this->urlId = $app->input->get->get('url_id');

        $this->items = new Itpmeta\Tag\Tags(JFactory::getDbo());
        $this->items->load(array('uri_id' => $this->urlId));

        parent::display($tpl);
    }
}
