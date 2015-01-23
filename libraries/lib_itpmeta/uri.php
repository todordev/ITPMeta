<?php
/**
 * @package      ITPrism Libraries
 * @subpackage   ITPrism Initializators
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

class ITPMetaUri
{
    /**
     * Database driver.
     *
     * @var JDatabaseDriver
     */
    protected $db;

    protected $id;
    protected $uri;
    protected $after_body_tag = null;
    protected $before_body_tag = null;
    protected $published = 0;
    protected $autoupdate = 1;
    protected $menu_id = 0;
    protected $parent_menu_id = 0;
    protected $primary_url = 0;

    protected $tags = array();

    protected $notOverridden = array();

    protected static $instances = array();

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    public function setDb(JDatabaseDriver $db)
    {
        $this->db = $db;
    }

    /**
     * Create and return URI object.
     *
     * @param string          $uri
     * @param JDatabaseDriver $db
     *
     * @return NULL|ITPMetaUri
     */
    public static function getInstance($uri, JDatabaseDriver $db)
    {
        // Generate hash index
        $index = md5($uri);

        if (empty(self::$instances[$index])) {

            $item = new ITPMetaUri();
            $item->setDb($db);
            $item->setUri($uri);
            $item->loadByUri();

            self::$instances[$index] = $item;

        }

        return self::$instances[$index];
    }

    /**
     * Load data for the URI from database.
     */
    public function load()
    {
        $query = $this->db->getQuery(true);
        $query
            ->select("a.id, a.uri, a.after_body_tag, a.before_body_tag, a.published, a.autoupdate")
            ->from($this->db->quoteName("#__itpm_urls", "a"))
            ->where("a.id = " . (int)$this->id);

        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();

        if (!empty($result)) {
            $this->bind($result);
        }
    }

    /**
     * Load data for the URI from database.
     */
    public function loadByUri()
    {
        $query = $this->db->getQuery(true);
        $query
            ->select("a.id, a.uri, a.after_body_tag, a.before_body_tag, a.published, a.autoupdate")
            ->from($this->db->quoteName("#__itpm_urls", "a"))
            ->where("a.uri = " . $this->db->quote($this->uri));

        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();

        if (!empty($result)) {
            $this->bind($result);
        }
    }

    public function bind(array $data, $ignored = array())
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $ignored)) {
                $this->$key = $value;
            }
        }
    }

    public function getTags($force = false)
    {
        if (!empty($this->tags) and !$force) {
            return $this->tags;
        }

        if (!empty($this->id) and $this->isPublished()) { // Get all tags ( global and URI )
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
    				a.url_id = " . (int)$this->id . "
             	)
        
             	ORDER BY
					tmp_ordering, ordering ASC
        
             	";

        } else { // Get only global tags

            $query = $this->db->getQuery(true);
            $query
                ->select("a.output, a.name")
                ->from($this->db->quoteName("#__itpm_global_tags", "a"))
                ->where("a.published = 1")
                ->order("a.ordering ASC");
        }

        $this->db->setQuery($query);
        $result_ = $this->db->loadObjectList();

        // Prepare results. Replace global tags with the tags of current URI
        // if there are same ones.
        $result = array();
        foreach ($result_ as $row) {
            if (!empty($row->name)) {

                // Check for existing value in the array for not overridden values
                if (!in_array($row->name, $this->notOverridden)) {
                    $result[$row->name] = $row;
                } else {
                    $result[] = $row;
                }

            } else {
                $result[] = $row;
            }
        }
        unset($result_);

        $this->tags = $result;

        return $this->tags;
    }

    public function getId()
    {
        return $this->id;
    }

    public function isAutoupdate()
    {
        return (bool)$this->autoupdate;
    }

    public function isPublished()
    {
        return (bool)$this->published;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    public function getScript($type)
    {
        switch ($type) {

            case "after":
                return $this->after_body_tag;
                break;

            case "before":
                return $this->before_body_tag;
                break;
        }

        return null;
    }

    public function save()
    {
        // Prepare script tags
        $afterBodyTag = JString::trim($this->after_body_tag);
        $afterBodyTag = (!empty($afterBodyTag)) ? $this->db->quote($afterBodyTag) : "NULL";

        $beforeBodyTag = JString::trim($this->before_body_tag);
        $beforeBodyTag = (!empty($beforeBodyTag)) ? $this->db->quote($beforeBodyTag) : "NULL";

        $query = $this->db->getQuery(true);
        $query
            ->set("uri             = " . $this->db->quote($this->uri))
            ->set("after_body_tag  = " . $afterBodyTag)
            ->set("before_body_tag = " . $beforeBodyTag)
            ->set("published       = " . (int)$this->published)
            ->set("autoupdate      = " . (int)$this->autoupdate)
            ->set("menu_id         = " . (int)$this->menu_id)
            ->set("parent_menu_id  = " . (int)$this->parent_menu_id)
            ->set("primary_url     = " . (int)$this->primary_url);

        if (!$this->id) { // Insert a new record
            $query
                ->insert($this->db->quoteName("#__itpm_urls"));

            $this->db->setQuery($query);
            $this->db->execute();

            $this->id = $this->db->insertid();

        } else { // Update a record
            $query
                ->update($this->db->quoteName("#__itpm_urls"))
                ->where($this->db->quoteName("id") . " = " . (int)$this->id);

            $this->db->setQuery($query);
            $this->db->execute();
        }
    }

    /**
     * Set the tags that won't be overridden.
     *
     * @param array $data
     */
    public function setNotOverridden(array $data)
    {
        $this->notOverridden = $data;
    }
}
