<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITPMeta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;

/**
 * It is the component helper class
 */
class ItpMetaTags {
	
    protected $db;
    protected $uri;
    protected $tags = array();
    
    public function __construct(ITPMetaUri $uri) {
        
        $this->db  = JFactory::getDbo();
        $this->uri = $uri;
        
        if(!empty($uri->id)) {
            $this->load();
        }
    }
    
    /**
     * Load tags for specific url
     * 
     */
    public function load() {
        
        // Load tags
        $query  = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id")
            ->from($this->db->quoteName("#__itpm_tags") . " AS a")
            ->where("a.url_id = " . (int)$this->uri->id);
    
        $this->db->setQuery($query);
        $results = $this->db->loadAssocList();
        
        foreach( $results as $result ) {
            $tag = new ITPMetaTag();
            $tag->bind($result);
            $this->tags[] = $tag;
        }
        
    }
	
    public function getTag($name) {
    
        $tag = null;
    
        foreach($this->tags as $tagObject) {
            $tagName = $tagObject->getName();
            if(strcmp($name, $tagName) == 0) {
                $tag = $tagObject;
                break;
            }
        }
    
        return $tag;
    
    }
    
    public function getTags() {
        return $this->tags;
    }
	
   
}