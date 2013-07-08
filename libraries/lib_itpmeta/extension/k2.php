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

jimport("itpmeta.extension");

/**
 * This helper provides functionality 
 * for K2 (com_k2)
 *
 */
class ItpMetaExtensionK2 extends ItpMetaExtension {

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
    
    public function getData() {
        
        $app        = JFactory::getApplication();
        /** @var $app JSite **/
        
        // Parse the URL
        $router     = $app->getRouter();
        $parsed     = $router->parse($this->uri);
        
        $id         = JArrayHelper::getValue($parsed, "id", 0, "int");
        $task       = JArrayHelper::getValue($parsed, "task");
        
        // I am using $view because I could change it to "tag".
        // So, I don't want to replace the original property.
        $view       = $this->view;
        
        // If missing ID I have to get information from menu item.
        if(!$id) {
            if( strcmp("tag", $task) == 0 ) { 
                $view = "tag";
            } else {
                $view = null;
            }
        }
        
        switch($view) {
            
            case "item":
                $data = $this->getItemData($id);
                break;
            case "itemlist":
                
                $layout = JArrayHelper::getValue($parsed, "layout");
                if(strcmp("category", $layout) == 0) {
                    $data = $this->getCategoryData($id);
                }
                
                if(strcmp("user", $layout) == 0) {
                    $data = $this->getUserData($id);
                }
                break;

            case "tag":
                $data = $this->getDataByMenuItem($this->menuItemId);
                $tag  = JArrayHelper::getValue($parsed, "tag");
                $tag  = htmlentities($tag, ENT_QUOTES, 'UTF-8');
                $data["title"] = JText::sprintf("PLG_SYSTEM_ITPMETA_K2_DISPLAYING_TAG", $tag);
                break;
                
            default: // Get menu item
                if(!empty($this->menuItemId)) {
                    $data = $this->getDataByMenuItem($this->menuItemId);
                }
                break;
                
        } 
        
        return $data;
    }
    
	/**
     * 
     * Extract data about category
     */
    public function getCategoryData($categoryId) {
        
        if(!$categoryId) {
            return null;
        }
        
        $data   = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.id, a.name AS title, a.params, a.image")
            ->from($this->db->quoteName("#__k2_categories"). " AS a")
            ->where("a.id=".(int)$categoryId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {
            
            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
            
            $params           = json_decode($data["params"], true);
            $data["metadesc"] = JArrayHelper::getValue($params, "catMetaDesc");
            $data["created"]  = null;
            $data["modified"] = null;
            
            if(!empty($data["image"])) {
                $data["image"]    = "media/k2/categories/".$data["image"];
            }
        }
        
        return $data;
        
    }
    
    public function getUserData($userId) {
        
        if(!$userId) {
            return null;
        }
        
        $data   = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.id, a.userName AS title, a.description, a.image")
            ->from($this->db->quoteName("#__k2_users"). " AS a")
            ->where("a.userId = ".(int)$userId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {
            
            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
            
            $description      = JString::trim(strip_tags($data["description"]));
            $data["metadesc"] = JString::substr($description, 0, 150);
            $data["created"]  = null;
            $data["modified"] = null;
            
            if(!empty($data["image"])) {
                $data["image"]    = "media/k2/users/".$data["image"];
            }
        }
        
        return $data;
        
    }
    
	/**
     * Extract data about item
     */
    public function getItemData($itemId) {
        
        if(!$itemId) {
            return null;
        }
        
        $data   = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.id, a.title, a.metadesc, a.created, a.modified")
            ->from($this->db->quoteName("#__k2_items"). " AS a")
            ->where("a.id=".(int)$itemId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {

            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
            
            $data["image"] = "";
            $image         = "media/k2/items/cache/".md5("Image".$itemId)."_S.jpg";
            
            if(is_file(JPATH_ROOT.DIRECTORY_SEPARATOR.$image)) {
                $data["image"] = $image;
            }
            
        }
        
        return $data;
        
    }
    
    
}

