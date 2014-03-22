<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.extension");

/**
 * This class provides functionality 
 * for managing Joomla! Content (com_content)
 */
class ItpMetaExtensionContent extends ItpMetaExtension {

    protected $db;
    
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;
    
    protected $data;
    
    public function getData() {
        
        $app        = JFactory::getApplication();
        /** @var $app JSite **/
        
        // Parse the URL
        $router     = $app->getRouter();
        $parsed     = $router->parse($this->uri);
        
        $id         = JArrayHelper::getValue($parsed, "id");
        
        switch($this->view) {
            
            case "article":
                $this->data = $this->getArticleData($id);
                break;
                
            case "category":
                $this->data = $this->getCategoryData($id);
                break;
                
            default: // Get menu item
                if(!empty($this->menuItemId)) {
                    $this->data = $this->getDataByMenuItem($this->menuItemId);
                }
                break;
        } 
        
        return $this->data;
    }
    
	/**
     * Extract data about category
     */
    protected function getCategoryData($categoryId) {
        
        if(!$categoryId) {
            return null;
        }
        
        $excluded = array("params", "description");
        $data     = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.title, a.description, a.params, a.metadesc, a.created_time AS created, a.modified_time AS modified")
            ->from($this->db->quoteName("#__categories", "a"))
            ->where("a.id=".(int)$categoryId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {
            
            foreach($result as $key => $value) {
                if(!in_array($key, $excluded)) {
                    $data[$key] = $value;
                }
            }
            
            // Get image
            $params         = json_decode($result["params"]);
            $data["image"]  = null;
            
            if(!empty($params->image)) {
                $data["image"]  = $params->image;
            }
            
            if(!$data["metadesc"] AND !empty($this->genMetaDesc)) {
                $data["metadesc"] = $this->prepareMetaDesc($result["description"]);
            }
            
            unset($result);
        }
        
        return $data;
        
    }
    
	/**
     * Extract data about article
     */
    protected function getArticleData($articleId) {
        
        if(!$articleId) {
            return null;
        }
        
        $excluded = array("params", "description");
        $data   = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.title, a.introtext, a.fulltext, a.images, a.metadesc, a.created, a.modified")
            ->from($this->db->quoteName("#__content", "a"))
            ->where("a.id = ".(int)$articleId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {

            foreach($result as $key => $value) {
                if(!in_array($key, $excluded)) {
                    $data[$key] = $value;
                }
            }
            
            $data["image"] = "";
            $images        = json_decode($result["images"], true);
            if(isset($images["image_intro"]) AND !empty($images["image_intro"])) {
                $data["image"] = $images["image_intro"];
            }
            
            if(isset($images["image_fulltext"]) AND !empty($images["image_fulltext"])) {
                $data["image"] = $images["image_fulltext"];
            }
            
            // Generate description
            if(!$data["metadesc"] AND !empty($this->genMetaDesc)) {
                
                $data["metadesc"] = $this->prepareMetaDesc($result["introtext"]);
                
                if(!$data["metadesc"]) {
                    $data["metadesc"] = $this->prepareMetaDesc($result["fulltext"]);
                }
                
            }
            
            unset($result);
        }
        
        return $data;
        
    }
    
}

