<?php
/**
 * @package      ITPrism Libraries
 * @subpackage   ITPrism Initializators
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPrism Library is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

class ITPMetaUri {
    
    /**
     * @var JDatabaseMySQLi
     */
    protected $db;
    
    public $id;
    public $uri;
    public $after_body_tag    = null;
    public $before_body_tag   = null;
    public $published         = 0;
    public $autoupdate        = 1;
    public $menu_id           = 0;
    public $parent_menu_id    = 0;
    public $primary_url       = 0;
    
    protected $tags              = array();
    
    protected static $instances = array();
    
	public function __construct($uri) {
        
        $this->db  = JFactory::getDbo();
        $this->uri = $uri;
        
        $this->load();
        
    }
    
    public static function getInstance($uri)  {
    
        // Generate hash index
        $index = md5($uri);
        
        if (empty(self::$instances[$index])){
            $item = new ITPMetaUri($uri);
            self::$instances[$index] = $item;
        }
    
        return self::$instances[$index];
    }
    
    public function load() {
        
        $query  = $this->db->getQuery(true);
        $query
            ->select("a.id, a.uri, a.after_body_tag, a.before_body_tag, a.published, a.autoupdate")
            ->from($this->db->quoteName("#__itpm_urls") . " AS a")
            ->where("a.uri = " .$this->db->quote($this->uri));
            
        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();
        
        if(!empty($result)) {
            $this->bind($result);
        }
        
    }
    
    public function bind(array $uri) {
        foreach($uri as $key => $value) {
            $this->$key = $value;
        }
    }
    
    public function getTags($force = false) {
        
        if(!empty($this->tags) AND !$force) {
            return $this->tags;
        }
        
        if(!empty($this->id) AND $this->published) { // Get all tags ( global and URI )
            $query = "
            	( SELECT
            		a.output, a.ordering, a.name, 0 AS tmp_ordering
        		FROM
        			`#__itpm_global_tags` AS a
    			WHERE
    				a.published = 1
				)
        
    			UNION
    
            	( SELECT
            		a.output, a.ordering, a.name, 1 AS tmp_ordering
        		FROM
        			`#__itpm_tags` AS a
    			WHERE
    				a.url_id = ". (int)$this->id ."
             	)
        
             	ORDER BY
					tmp_ordering, ordering ASC
        
             	";
        
        } else { // Get only global tags
        
            $query = $this->db->getQuery(true);
            $query
                ->select("a.output, a.name")
                ->from($this->db->quoteName("#__itpm_global_tags") . " AS a")
                ->where("a.published = 1")
                ->order("a.ordering ASC");
        }
        
        $this->db->setQuery($query);
        $result_ = $this->db->loadObjectList();
        
        // Prepare results. Replace global tags with the tags of current URI
        // if there are same ones.
        $result = array();
        foreach( $result_ as $row ) {
            if(!empty($row->name)) {
                $result[$row->name] = $row;
            } else {
                $result[] = $row;
            }
        }
        
        $this->tags = $result;
        
        return $this->tags;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function isAutoupdate() {
        return (bool)$this->autoupdate;
    }
    
    public function isPublished() {
        return (bool)$this->published;
    }
    
    public function save() {
        
       $this->db = JFactory::getDBO();
       /** @var $this->db JDatabaseMySQLi **/
       $query = $this->db->getQuery(true);
       $query
           ->set("uri             = ". $this->db->quote($this->uri))
           ->set("after_body_tag  = ". $this->db->quote($this->after_body_tag))
           ->set("before_body_tag = ". $this->db->quote($this->before_body_tag))
           ->set("published       = ". (int)$this->published)
           ->set("autoupdate      = ". (int)$this->autoupdate)
           ->set("menu_id         = ". (int)$this->menu_id)
           ->set("parent_menu_id  = ". (int)$this->parent_menu_id)
           ->set("primary_url     = ". (int)$this->primary_url);
       
       if(!$this->id) { // Insert a new record
           $query
               ->insert($this->db->quoteName("#__itpm_urls"));
           
           $this->db->setQuery($query);
           $this->db->query();
           
           $this->id = $this->db->insertid ();
               
       } else { // Update a record
           $query
               ->update($this->db->quoteName("#__itpm_urls"))
               ->where($this->db->quoteName("id") ." = " . (int)$this->id);
           
           $this->db->setQuery($query);
           $this->db->query();
       }
       
    }
    
    /**
     * Check for existing URI
     * 
     * @param string $uri
     * @return boolean
     */
    public function isUriExists() {
        return (!$this->id) ? false : true;
    }
}

