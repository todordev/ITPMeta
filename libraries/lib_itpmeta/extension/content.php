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
 * This class provides functionality 
 * for managing Joomla! Content (com_content)
 */
class ItpMetaExtensionContent extends ItpMetaExtension {

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
        
        $data   = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.id, a.title, a.params, a.metadesc, a.created_time AS created, a.modified_time AS modified")
            ->from($this->db->quoteName("#__categories"). " AS a")
            ->where("a.id=".(int)$categoryId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {
            
            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
            
            $params         = json_decode($data["params"]);
            $data["image"]  = $params->image;
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
        
        $data   = array();
        
        $query  = $this->db->getQuery(true);
        
        $query
            ->select("a.id, a.title, a.images, a.metadesc, a.created, a.modified")
            ->from($this->db->quoteName("#__content"). " AS a")
            ->where("a.id=".(int)$articleId);
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {

            foreach($result as $key => $value) {
                $data[$key] = $value;
            }
            
            $data["image"] = "";
            $images        = json_decode($data["images"], true);
            if(isset($images["image_intro"]) AND !empty($images["image_intro"])) {
                $data["image"] = $images["image_intro"];
            }
            
            if(isset($images["image_fulltext"]) AND !empty($images["image_fulltext"])) {
                $data["image"] = $images["image_fulltext"];
            }
        }
        
        return $data;
        
    }
    
}

