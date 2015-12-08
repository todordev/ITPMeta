<?php
/**
 * @package      ItpMeta
 * @subpackage   Tags
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Tag;

use Prism;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for managing meta tags.
 *
 * @package      ItpMeta
 * @subpackage   Tags
 */
class Tag extends Base implements Prism\Database\TableInterface
{
    /**
     * Load tag data from database.
     *
     * <code>
     * $keys = array(
     *      "id" => 1,
     *      "name" => "og_image"
     * )
     *
     * $tag   = new ItpMeta\Tag(\JFactory::getDbo());
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
            ->from($this->db->quoteName('#__itpm_tags', 'a'));

        if ($name !== null or $name !== '') {
            $query->where('a.name = ' . $this->db->quote($name));
        } else {
            $query->where('a.id = ' . (int)$id);
        }

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        $this->bind($result);
    }

    /**
     * Store tag data to database.
     *
     * <code>
     * $keys = array(
     *      "id" => 1,
     * )
     *
     * $tag   = new ItpMeta\Tag(\JFactory::getDbo());
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
            ->set($this->db->quoteName('name') . '=' . $this->db->quote($this->name))
            ->set($this->db->quoteName('type') . '=' . $this->db->quote($this->type))
            ->set($this->db->quoteName('title') . '=' . $this->db->quote($this->title))
            ->set($this->db->quoteName('tag') . '=' . $this->db->quote($this->tag))
            ->set($this->db->quoteName('content') . '=' . $this->db->quote($this->content))
            ->set($this->db->quoteName('output') . '=' . $this->db->quote($this->output))
            ->set($this->db->quoteName('url_id') . '=' . (int)$this->url_id);

        if ($this->id !== null and $this->id > 0) { // UPDATE
            $query
                ->update($this->db->quoteName('#__itpm_tags'))
                ->where($this->db->quoteName('id') . '=' . (int)$this->id);

        } else { // INSERT

            $query
                ->insert($this->db->quoteName('#__itpm_tags'));

            // Get max ordering
            $max = $this->getMaxOrdering();
            $query->set($this->db->quoteName('ordering') . '=' . $max);
        }

        $this->db->setQuery($query);
        $this->db->execute();

        if (!$this->id) {
            $this->id = $this->db->insertid();
        }

        return $this;
    }

    /**
     * Calculate max ordering of the record.
     */
    protected function getMaxOrdering()
    {
        $query = $this->db->getQuery(true);
        $query
            ->select('MAX(a.ordering)')
            ->from($this->db->quoteName('#__itpm_tags', 'a'))
            ->where('a.url_id =' . $this->url_id);

        $this->db->setQuery($query, 0, 1);
        $max = (int)$this->db->loadResult();

        return ++$max;
    }

    /**
     * Set new content and generate a tag based that content.
     *
     * <code>
     * $keys = array(
     *      "id" => 1,
     * )
     *
     * $tag   = new ItpMeta\Tag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * $tag->setContent("http://itprism.com/images/picture.png");
     * </code>
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->generateOutput();

        return $this;
    }
}
