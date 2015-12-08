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
 * This class provides functionality for managing a list of meta tags.
 *
 * @package      ItpMeta
 * @subpackage   Tags
 */
class Tags extends Prism\Database\ArrayObject
{
    /**
     * Load tags for specific url.
     *
     * @param array $options
     */
    public function load($options = array())
    {
        $uriId = (array_key_exists('uri_id', $options)) ? (int)$options['uri_id'] : 0;

        // Load tags
        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.name, a.type, a.title, a.tag, a.content, a.output, a.ordering, a.url_id')
            ->from($this->db->quoteName('#__itpm_tags', 'a'))
            ->where('a.url_id = ' . (int)$uriId);

        $this->db->setQuery($query);
        $results = (array)$this->db->loadAssocList();

        foreach ($results as $result) {
            $tag = new Tag($this->db);
            $tag->bind($result);
            $this->items[] = $tag;
        }
    }

    public function getTag($name)
    {
        $tag = null;

        foreach ($this->items as $tagObject) {
            /* @var $tagObject Tag */

            $tagName = $tagObject->getName();
            if (strcmp($name, $tagName) === 0) {
                $tag = $tagObject;
                break;
            }
        }

        return $tag;
    }
}
