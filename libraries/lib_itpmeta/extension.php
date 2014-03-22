<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

abstract class ItpMetaExtension {

    protected $db;
    
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;
    
    protected $genMetaDesc = false;
    
    protected $data;
    
    abstract public function getData();
    
    public function __construct($uri, $options) {
        
        $this->uri         = $uri;
        $this->view        = JArrayHelper::getValue($options, "view");
        $this->task        = JArrayHelper::getValue($options, "task");
        $this->menuItemId  = JArrayHelper::getValue($options, "menu_item_id");
        $this->genMetaDesc = JArrayHelper::getValue($options, "generate_metadesc", false, "bool");
        
    }
    
    public function setDb(JDatabase $db) {
        $this->db = $db;
    }
    
    protected static function getDataByMenuItem($menuItemId) {
        
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
    
    protected function clean($content) {
        
        $content = strip_tags($content);
        
        return JString::trim(preg_replace('/\r|\n/', ' ', $content));
    }
    
    protected function prepareMetaDesc($content) {
    
        $minLength = 50;
        $length    = 160;
        $strLength = JString::strlen($content);
        
        $metaDesc  = "";
        
        $content   = $this->clean($content);
    
        if($minLength <= JString::strlen($content)) {
    
            if($strLength > $length) {
                $pos      = JString::strpos($content, ' ', $length);
                $metaDesc = JString::substr($content, 0, $pos);
            } else {
                $metaDesc = $content;
            }
        }
    
        return $metaDesc;
    
    }
}