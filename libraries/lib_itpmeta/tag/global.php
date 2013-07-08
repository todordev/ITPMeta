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

jimport("itprism.itpmeta.base");

class ITPMetaGlobalTag extends ITPMetaTagBase{
    
    protected $id;
    protected $title;
    protected $tag;
    protected $content;
    protected $output;
    
    protected $pattern = "/{.*}/i";
    
	public function __construct($name = null, $content = null) {
        parent::__construct($name);
        
        $this->content = $content;
        if(!empty($content)) {
            $this->output = $this->getOutput();
        }
    }
    
    public function loadByName($name) {
        
        $db     = JFactory::getDbo();
        $query  = $db->getQuery(true);
        $query
            ->select("a.id, a.name, a.title, a.tag, a.content, a.output")
            ->from($db->quoteName("#__itpm_globla_tags") . " AS a")
            ->where("a.name = ". $db->quote($name));
            
        $db->setQuery($query);
        $result = $db->loadAssoc();
        if(!empty($result)) {
            $this->bind($result);
        }
    }
    
    public function bind($data) {
        
        $params =  get_object_vars($this);
        $params =  array_keys($params);
        
        foreach($data as $key => $value) {
            if(in_array($key, $params)) {
                $this->$key = $value;
            }
        }
        
    }
    
    public function save() {
        
        $db     = JFactory::getDbo();
        $query  = $db->getQuery(true);
        
        $query
            ->set("name    =" .$db->quote($this->getName()))
            ->set("title   =" .$db->quote($this->getTitle()))
            ->set("tag 	   =" .$db->quote($this->getTag()))
            ->set("content =" .$db->quote($this->getContent()))
            ->set("output  =" .$db->quote($this->getOutput()));
            
        if(!empty($this->id)) { // UPDATE
            $query
                ->update($db->quoteName("#__itpm_global_tags"))
                ->where($db->quoteName("id") ."=". (int)$this->id);
        } else { // INSERT
            $query
                ->insert($db->quoteName("#__itpm_global_tags"));
        }
        
        $db->setQuery($query);
        $db->query();
        
    }
    
    public function getOutput() {
        $this->output = preg_replace($this->pattern, $this->content, $this->tag);
        return $this->output;
    }
    
    public function setOutput($output) {
        $this->output = $output;
        return $this;
    }
    
	public function _toString() {
        return $this->getTag();
    }
    
}

