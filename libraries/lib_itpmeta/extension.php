<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_PLATFORM') or die;

abstract class ItpMetaExtension {

    /**
     * @var JSite
     */
    protected $db;
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;
    
    protected $data;
    
    public function __construct($uri, $options) {
        $this->db         = JFactory::getDbo();
        $this->uri        = $uri;
        $this->view       = JArrayHelper::getValue($options, "view");
        $this->task       = JArrayHelper::getValue($options, "task");
        $this->menuItemId = JArrayHelper::getValue($options, "menu_item_id");
    }
    
    public static function getDataByMenuItem($menuItemId) {
        
        $data              = array();
        
        $app               = JFactory::getApplication();
        $menu              = $app->getMenu();
        
        $menuItem          = $menu->getItem($menuItemId);
        
        $data["id"]        = null;
        $data["created"]   = null;
        $data["modified"]  = null;
        
        $data["title"]     = (!$menuItem->params->get("page_title")) ? $menuItem->title : $menuItem->params->get("page_title");
        $data["metadesc"]  = $menuItem->params->get("menu-meta_description");
        $data["image"]     = $menuItem->params->get("menu_image");
        
        return $data;
        
    }
    
    abstract public function getData();
}

