<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.extension");

/**
 * This class provides functionality
 * for managing ITP Donate (com_itpdonate)
 */
class ItpMetaExtensionItpdonate extends ItpMetaExtension
{
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;

    protected $data;

    public function getData()
    {
        $app = JFactory::getApplication();
        /** @var $app JApplicationSite */

        // Parse the URL
        $router = $app->getRouter();
        $parsed = $router->parse($this->uri);

        $id     = JArrayHelper::getValue($parsed, "id");

        switch ($this->view) {

            case "cause":
                $this->data = $this->getCategoryData($id, "cause");
                break;

            case "causes":
            case "sponsors":
            case "payment":
                $this->data = $this->getDefaultData();
                break;

            default: // Get menu item
                if (!empty($this->menuItemId)) {
                    $this->data = $this->getDataByMenuItem($this->menuItemId);
                }
                break;
        }

        return $this->data;
    }
}
