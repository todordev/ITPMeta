<?php
/**
 * @package      ItpMeta
 * @subpackage   Tags
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Tag;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for generating global tags.
 *
 * @package      ItpMeta
 * @subpackage   Tags
 */
class GlobalTag extends Tag
{
    /**
     * Load data about global tags from database.
     *
     * <code>
     * $keys = array(
     *      "id" => 1,
     *      "name" => "og_image"
     * )
     *
     * $tag   = new ItpMeta\Tag\GlobalTag(\JFactory::getDbo());
     * $tag->load($keys);
     * </code>
     *
     * @param array $keys
     * @param array $options
     */
    public function load($keys, $options = array())
    {
        $id    = (!array_key_exists('id', $keys)) ? 0 : (int)$keys['id'];
        $name  = (!array_key_exists('name', $keys)) ? null : $keys['name'];

        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id')
            ->from($this->db->quoteName('#__itpm_global_tags', 'a'));

        if ($name !== null and $name !== '') {
            $query->where('a.name = ' . $this->db->quote($name));
        } else {
            $query->where('a.id = ' . (int)$id);
        }

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        $this->bind($result);
    }

    /**
     * Store data of global tag to database.
     *
     * <code>
     * $keys = array(
     *      "id" => 1,
     * )
     *
     * $tag   = new ItpMeta\GlobalTag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * $tag->setContent("http://itprism.com/images/picture.png");
     * $tag->store();
     * </code>
     *
     * @return self
     */
    public function store()
    {
        $query = $this->db->getQuery(true);

        $query
            ->set('name    =' . $this->db->quote($this->getName()))
            ->set('title   =' . $this->db->quote($this->getTitle()))
            ->set('tag 	   =' . $this->db->quote($this->getTag()))
            ->set('content =' . $this->db->quote($this->getContent()))
            ->set('output  =' . $this->db->quote($this->getOutput()));

        if ($this->id !== null and $this->id > 0) { // UPDATE
            $query
                ->update($this->db->quoteName('#__itpm_global_tags'))
                ->where($this->db->quoteName('id') . '=' . (int)$this->id);
        } else { // INSERT
            $query
                ->insert($this->db->quoteName('#__itpm_global_tags'));

            // Get max ordering
            $max = $this->getMaxOrdering();
            $query->set($this->db->quoteName('ordering') . '=' . $max);
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
            ->select('MAX(a.ordering)')
            ->from($this->db->quoteName('#__itpm_global_tags', 'a'));

        $this->db->setQuery($query, 0, 1);
        $max = (int)$this->db->loadResult();

        return ++$max;
    }
}
