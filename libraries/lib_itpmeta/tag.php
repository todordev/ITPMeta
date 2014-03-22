<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
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
    
    protected $pattern = "/{.*}/iU";
    
    public function setDb(JDatabase $db) {
        $this->db = $db;
        return $this;
    }
    
    /**
     * This method replaces indicators with values.
     *
     * Example:
     * The indicator {TITLE} will be replaced with "My title".
     *
     * @return string
     */
    public function generateOutput() {
        
	    // Count indicators in a string.
	    $numMatchs = preg_match_all($this->pattern, $this->tag, $matches);
	    
	    if(2 == $numMatchs) { // Replace values of tags which contains two indicators.
	        
	        $rows = preg_split("/\n/", $this->content);
	        
	        if(2 == count($rows)) {
	            
	            $line1        = $rows[0];
	            $line2        = $this->clean($rows[1]);
	            
	            $tag          = preg_replace($this->pattern, $line1, $this->tag, 1); // First value
	            $this->output = preg_replace($this->pattern, $line2, $this->tag, 1); // Second value
	            
	        } else {
	            
	            $line1        = $this->clean($rows[0]);
	            $this->output = preg_replace($this->pattern, $line1, $this->tag, 1);
	        }
	        
	    } else { // Replace values of tags which contains one indicators.
	        
	        $this->output = preg_replace($this->pattern, $this->clean($this->content), $this->tag, 1);
	    }
	    
    }
    
    public function load() {
    
        $query  = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id")
            ->from($this->db->quoteName("#__itpm_tags", "a"))
            ->where("a.id = ". (int)$this->id);
    
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
    
        if(!empty($result)) {
            $this->bind($result);
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
    
    public function save() {
        
		// Save the new tag
        $query  = $this->db->getQuery(true);
        
        $query
            ->set($this->db->quoteName("name")    ."=" .$this->db->quote($this->name))
            ->set($this->db->quoteName("type")    ."=" .$this->db->quote($this->type))
            ->set($this->db->quoteName("title")   ."=" .$this->db->quote($this->title))
            ->set($this->db->quoteName("tag")     ."=" .$this->db->quote($this->tag))
            ->set($this->db->quoteName("content") ."=" .$this->db->quote($this->content))
            ->set($this->db->quoteName("output")  ."=" .$this->db->quote($this->output))
            ->set($this->db->quoteName("url_id")  ."=" .(int)$this->url_id);
            
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
        $this->db->execute();
        
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
		    ->from($this->db->quoteName("#__itpm_tags", "a"))
		    ->where("a.url_id =". $this->url_id);
		
	    $this->db->setQuery($query, 0, 1);
		$max    = $this->db->loadResult();
        
		if(!$max) { $max = 0; }
		$max    = $max+1;
		
		return $max;
    }
    
    public function setContent($content) {
        $this->content = $content;
        $this->generateOutput();
        return $this;
    }
    
}

