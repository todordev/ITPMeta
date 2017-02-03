<?php
/**
 * @package      Itpmeta
 * @subpackage   Tags
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Tag;

use Prism\Database;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for managing a list of meta tags.
 *
 * @package      Itpmeta
 * @subpackage   Tags
 */
class Tags extends Database\Collection
{
    /**
     * Load tags for specific url.
     *
     * <code>
     * $options = array(
     *      "uri_id" => 1
     * )
     *
     * $tag   = new Itpmeta\Tag\Tags(\JFactory::getDbo());
     * $tag->load($options);
     * </code>
     *
     * @param array $options
     *
     * @throws \RuntimeException
     */
    public function load(array $options = array())
    {
        $uriId = array_key_exists('uri_id', $options) ? (int)$options['uri_id'] : 0;

        if ($uriId > 0) {
            $query = $this->db->getQuery(true);
            $query
                ->select('a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id')
                ->from($this->db->quoteName('#__itpm_tags', 'a'))
                ->where('a.url_id = ' . (int)$uriId);

            $this->db->setQuery($query);
            $this->items = (array)$this->db->loadAssocList();
        }
    }

    /**
     * Return tag object by its name.
     *
     * <code>
     * $options = array(
     *      "uri_id" => 1
     * )
     *
     * $tag   = new Itpmeta\Tag\Tags(\JFactory::getDbo());
     * $tag->load($options);
     *
     * $tagObject = $tag->getTag('og_image');
     * </code>
     *
     * @param string $name
     *
     * @return Tag
     */
    public function getTag($name)
    {
        $tag = null;

        foreach ($this->items as $item) {
            /* @var $tagObject Tag */

            if (strcmp($name, $item['name']) === 0) {
                $tag = new Tag($this->db);
                $tag->bind($item);
                break;
            }
        }

        return $tag;
    }

    /**
     * Return array with Tag object.
     *
     * <code>
     * $options = array(
     *      "uri_id" => 1
     * )
     *
     * $tag   = new Itpmeta\Tag\Tags(\JFactory::getDbo());
     * $tag->load($options);
     *
     * $tags = $tag->getTags();
     * </code>
     *
     * @return array
     */
    public function getTags()
    {
        $tags = array();

        foreach ($this->items as $item) {
            $tag = new Tag($this->db);
            $tag->bind($item);
            $tags[] = $tag;
        }

        return $tags;
    }
}
