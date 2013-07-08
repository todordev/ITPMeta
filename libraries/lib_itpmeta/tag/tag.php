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

jimport("itpmeta.tag.base");

class ITPMetaTag extends ITPMetaTagBase {
    
    protected $db;
    
    protected $id;
    protected $name;
    protected $type;
    protected $title;
    protected $tag;
    protected $content;
    protected $output;
    protected $ordering;
    protected $url_id;
    
    protected $pattern = "/{.*}/i";
    
	public function __construct($name = null, $content = null) {
	    
        parent::__construct($name);
        
        $this->db = JFactory::getDbo();
        
        $this->content = $content;
        if(!empty($content)) {
            $this->output = $this->getOutput();
        }
        
    }
    
    public function loadByName($name) {
        
        $query  = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id")
            ->from($this->db->quoteName("#__itpm_tags") . " AS a") 
            ->where("a.name = ". $this->db->quote($name));
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        if(!empty($result)) {
            $this->bind($result);
        }
    }
    
    public function bind($data) {
        
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
        
    }
    
    public function save() {
        
		// Save the new tag
        $query  = $this->db->getQuery(true);
        
        $query
            ->set("name      =" .$this->db->quote($this->name))
            ->set("type      =" .$this->db->quote($this->type))
            ->set("title     =" .$this->db->quote($this->title))
            ->set("tag 	     =" .$this->db->quote($this->tag))
            ->set("content   =" .$this->db->quote($this->content))
            ->set("output    =" .$this->db->quote($this->output))
            ->set("url_id    =" .(int)$this->url_id);
            
        if(!empty($this->id)) { // UPDATE
            $query
                ->update($this->db->quoteName("#__itpm_tags"))
                ->where($this->db->quoteName("id") ."=". (int)$this->id);
        } else { // INSERT
            $query
                ->insert($this->db->quoteName("#__itpm_tags"));
                
            // Get max ordering
            $max     = $this->getMaxOrdering();
            $query->set($this->db->quoteName("ordering") ."=". $max);
        }
        
        $this->db->setQuery($query);
        $this->db->query();
        
        if(empty($this->id)) {
            $this->id = $this->db->insertid();
        }
        
    }
    
    /**
     * The method calculate max ordering of the record
     */
    protected function getMaxOrdering() {
        
        $query  = $this->db->getQuery(true);
		$query
		    ->select("MAX(a.ordering)")
		    ->from($this->db->quoteName("#__itpm_tags") . " AS a")
		    ->where("a.url_id =". $this->url_id);
		
	    $this->db->setQuery($query, 0, 1);
		$max    = $this->db->loadResult();
        
		if(!$max) { $max = 0; }
		$max    = $max+1;
		
		return $max;
    }
    
    public function getOutput() {
        $this->output = preg_replace($this->pattern, $this->content, $this->tag);
        return $this->output;
    }
    
    public function setOutput($output) {
        $this->output = $output;
        return $this;
    }
    
	/**
     * @return integer $urlId
     */
    public function getUrlId() {
        return $this->url_id;
    }

	/**
     * @param integer $urlId
     */
    public function setUrlId($urlId) {
        $this->url_id = (int)$urlId;
        return $this;
    }
    
	public function _toString() {
        return $this->getTag();
    }
    
}

