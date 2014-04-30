<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.tag");

class ITPMetaTagGlobal extends ITPMetaTag
{
    protected $id;
    protected $title;
    protected $tag;
    protected $content;
    protected $output;

    public function load()
    {
        $query = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id")
            ->from($this->db->quoteName("#__itpm_global_tags", "a"))
            ->where("a.id = " . (int)$this->id);

        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();

        if (!empty($result)) {
            $this->bind($result);
        }
    }

    public function loadByName($name)
    {
        $query = $this->db->getQuery(true);
        $query
            ->select("a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering")
            ->from($this->db->quoteName("#__itpm_global_tags", "a"))
            ->where("a.name = " . $this->db->quote($name));

        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();

        if (!empty($result)) {
            $this->bind($result);
        }
    }

    public function save()
    {
        $query = $this->db->getQuery(true);

        $query
            ->set("name    =" . $this->db->quote($this->getName()))
            ->set("title   =" . $this->db->quote($this->getTitle()))
            ->set("tag 	   =" . $this->db->quote($this->getTag()))
            ->set("content =" . $this->db->quote($this->getContent()))
            ->set("output  =" . $this->db->quote($this->getOutput()));

        if (!empty($this->id)) { // UPDATE
            $query
                ->update($this->db->quoteName("#__itpm_global_tags"))
                ->where($this->db->quoteName("id") . "=" . (int)$this->id);
        } else { // INSERT
            $query
                ->insert($this->db->quoteName("#__itpm_global_tags"));

            // Get max ordering
            $max = $this->getMaxOrdering();
            $query->set($this->db->quoteName("ordering") . "=" . $max);

        }

        $this->db->setQuery($query);
        $this->db->execute();
    }

    /**
     * The method calculate max ordering of the record
     */
    protected function getMaxOrdering()
    {
        $query = $this->db->getQuery(true);
        $query
            ->select("MAX(a.ordering)")
            ->from($this->db->quoteName("#__itpm_global_tags", "a"));

        $this->db->setQuery($query, 0, 1);
        $max = $this->db->loadResult();

        if (!$max) {
            $max = 0;
        }
        $max = $max + 1;

        return $max;
    }
}
