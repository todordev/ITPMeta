<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ITPMetaViewTags extends JViewLegacy
{
    protected $urlId;
    protected $items;

    public function display($tpl = null)
    {
        $app = JFactory::getApplication();
        /** @var $app JApplicationAdministrator * */

        $this->urlId = $app->input->get->get("url_id");

        jimport("itpmeta.tags");
        $this->items = new ItpMetaTags($this->urlId);
        $this->items->setDb(JFactory::getDbo());
        $this->items->load();

        parent::display($tpl);
    }
}
