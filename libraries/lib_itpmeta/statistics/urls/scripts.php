<?php
/**
 * @package      ITPMeta
 * @subpackage   Library
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.statistics.items");

/**
 * This class loads urls with scripts.
 *
 * @package         Statistics
 * @subpackage      Items
 */
class ITPMetaStatisticsUrlsScripts extends ITPMetaStatisticsUrls implements Iterator, Countable, ArrayAccess
{

    protected $data = array();

    protected $position = 0;

    /**
     * Load items that contains scripts.
     *
     * <code>
     * $limit   = 5;
     * $db      = JFactory::getDbo();
     *
     * $mostVoted = new ITPMetaStatisticsUrlsScripts();
     * $mostVoted->setDb($db);
     * $mostVoted->load($limit);
     * </code>
     *
     * @param int $limit
     */
    public function load($limit = 5)
    {
        $query = $this->getQuery();

        $query
            ->where("(a.after_body_tag IS NOT NULL) OR (a.before_body_tag IS NOT NULL)")
            ->order("a.id DESC");

        $this->db->setQuery($query, 0, (int)$limit);

        $this->data = $this->db->loadAssocList();

        if (!$this->data) {
            $this->data = array();
        }

    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return (!isset($this->data[$this->position])) ? null : $this->data[$this->position];
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
        return isset($this->data[$this->position]);
    }

    public function count()
    {
        return (int)count($this->data);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
}
