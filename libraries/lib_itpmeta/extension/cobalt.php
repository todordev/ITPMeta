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
 * for Cobalt (com_cobalt)
 *
 */
class ItpMetaExtensionCobalt extends ItpMetaExtension {

    public function getData() {
        
        $app        = JFactory::getApplication();
        /** @var $app JSite **/
        
        // Parse the URL
        $router     = $app->getRouter();
        $parsed     = $router->parse($this->uri);
        
        $id          = JArrayHelper::getValue($parsed, "id");
        $sectionId   = JArrayHelper::getValue($parsed, "section_id");
        $categoryId  = JArrayHelper::getValue($parsed, "cat_id");
        
        $userCategoryId  = JArrayHelper::getValue($parsed, "ucat_id");
        
        // If missing ID I have to get information from menu item.
        if(!is_null($id)) {
            $view = "item";
        } else if (!is_null($sectionId) AND !is_null($userCategoryId)) { // It is user category
            $view = "usercategory";
        } else if (!is_null($sectionId) AND !is_null($categoryId)) { // It is category
            $view = "category";
        } else if (!is_null($sectionId) AND is_null($categoryId)) { // It is section
            $view = "section";
        }
        
        switch($view) {
            
            case "item":
                $data = $this->getItemData($id);
                break;
                
            case "category":
                $data = $this->getCategoryData($categoryId);
                break;
                
            case "usercategory":
                $data = $this->getUserCategoryData($userCategoryId);
                break;

            case "section":
                $data = $this->getSectionData($sectionId);
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
     * Extract data about category
     */
    public function getCategoryData($categoryId) {
        
        if(!$categoryId) {
            return null;
        }
    
        $data   = array();
    
        $query  = $this->db->getQuery(true);
        $query
            ->select("a.id, a.title, a.metadesc, a.image, a.created_time AS created, a.modified_time AS modified")
            ->from($this->db->quoteName("#__js_res_categories"). " AS a")
            ->where("a.id=".(int)$categoryId);
    
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
    
        if(!empty($result)) {
    
            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
    
        }
    
        return $data;
        
    }
    
    /**
     * Extract data about user category
     */
    public function getUserCategoryData($categoryId) {
    
        if(!$categoryId) {
            return null;
        }
    
        $data   = array();
    
        $query  = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name AS title, a.params, a.ctime AS created, a.mtime AS modified")
            ->from($this->db->quoteName("#__js_res_category_user"). " AS a")
            ->where("a.id=".(int)$categoryId);
    
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
    
        if(!empty($result)) {
    
            $params = JArrayHelper::getValue($result, "params");
            unset($result["params"]);
    
            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
    
            $params = json_decode($params, true);
    
            $data["metadesc"]  = JArrayHelper::getValue($params, "meta_descr");
            $data["image"]     = JArrayHelper::getValue($params, "image");
    
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
            ->select("a.id, a.title, a.meta_descr AS metadesc, a.ctime AS created, a.mtime AS modified, a.fields")
            ->from($this->db->quoteName("#__js_res_record"). " AS a")
            ->where("a.id=".(int)$itemId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {

            $imageData = array();
            
            $fields    = $result["fields"];
            unset($result["fields"]);
            
            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
            
            $fields = json_decode($fields, true);
            if(!empty($fields)) {
                
                foreach($fields as $field_) {
                    $field = @json_decode($field_, true);
                    if(is_array($field) AND isset($field["image"])) {
                        $imageData = $field;
                        break;
                    }
                }
            }
            
            $data["image"] = JArrayHelper::getValue($imageData, "image");
            
        }
        
        return $data;
        
    }
    
    
    /**
     * Extract data about section
     */
    public function getSectionData($sectionId) {
    
        if(!$sectionId) {
            return null;
        }
    
        $data   = array();
    
        $query  = $this->db->getQuery(true);
        $query
        ->select("a.id, a.title, a.description")
            ->from($this->db->quoteName("#__js_res_sections"). " AS a")
            ->where("a.id=".(int)$sectionId);
    
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
    
        if(!empty($result)) {
    
            $data["title"] = JArrayHelper::getValue($result, "title");
            
            $description   = JArrayHelper::getValue($result, "description");
            
            $metaDesc         = JString::substr(JString::trim(strip_tags($description)), 0, 160);
            $data["metadesc"] = $metaDesc;
    
        }
    
        return $data;
    
    }
    
}

