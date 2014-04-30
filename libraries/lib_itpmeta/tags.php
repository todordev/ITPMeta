<?php
/**
 * @package      ITPMeta
 * @subpackage   Library
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

class ItpMetaTags implements Iterator, Countable, ArrayAccess
{
    protected $items = array();

    /**
     * Database driver.
     *
     * @var JDatabaseDriver
     */
    protected $db;

    protected $position = 0;

    protected $uriId;

    public function __construct($uriId = 0)
    {
        $this->uriId = (int)$uriId;
    }

    public function setDb(JDatabaseDriver $db)
    {
        $this->db = $db;
    }

    /**
     * Load tags for specific url
     */
    public function load()
    {

        // Load tags
        $query = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id")
            ->from($this->db->quoteName("#__itpm_tags", "a"))
            ->where("a.url_id = " . (int)$this->uriId);

        $this->db->setQuery($query);
        $results = $this->db->loadAssocList();

        foreach ($results as $result) {
            $tag = new ITPMetaTag();
            $tag->bind($result);
            $this->items[] = $tag;
        }

    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return (!isset($this->items[$this->position])) ? null : $this->items[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->items[$this->position]);
    }

    public function count()
    {
        return (int)count($this->items);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function getTag($name)
    {
        $tag = null;

        foreach ($this->items as $tagObject) {
            /* @var $tagObject ITPMetaTag */

            $tagName = $tagObject->getName();
            if (strcmp($name, $tagName) == 0) {
                $tag = $tagObject;
                break;
            }

        }

        return $tag;
    }
}
