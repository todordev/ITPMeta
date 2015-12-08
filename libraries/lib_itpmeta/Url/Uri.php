<?php
/**
 * @package      ItpMeta
 * @subpackage   URLs
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Url;

use Prism;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for managing URIs.
 *
 * @package      ItpMeta
 * @subpackage   URLs
 */
class Uri extends Prism\Database\Table
{
    protected $id;
    protected $uri;
    protected $after_body_tag;
    protected $before_body_tag;
    protected $published = 0;
    protected $autoupdate = 1;
    protected $menu_id = 0;
    protected $parent_menu_id = 0;
    protected $primary_url = 0;

    protected $tags;

    protected $notOverridden = array();

    protected static $instances = array();

    /**
     * Create and return URI object.
     *
     * <code>
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = ItpMeta\Uri::getInstance(\JFactory::getDbo(), $keys);
     * </code>
     *
     * @param \JDatabaseDriver $db
     * @param array          $keys
     *
     * @return NULL|Uri
     */
    public static function getInstance(\JDatabaseDriver $db, $keys)
    {
        $uri   = (array_key_exists('uri', $keys)) ? $keys['uri'] : null;
        $uriId = (array_key_exists('uri_id', $keys)) ? $keys['uri_id'] : 0;

        // Generate hash index
        $index = !$uriId ? md5($uri) : $uriId;

        if (!array_key_exists($index, self::$instances)) {
            $item = new Uri($db);
            $item->load($keys);

            self::$instances[$index] = $item;
        }

        return self::$instances[$index];
    }

    /**
     * Load data for the URI from database.
     *
     * <code>
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     * </code>
     *
     * @param array $keys;
     * @param array $options;
     */
    public function load($keys, $options = array())
    {
        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.uri, a.after_body_tag, a.before_body_tag, a.published, a.autoupdate')
            ->from($this->db->quoteName('#__itpm_urls', 'a'));

        
        $uri   = (array_key_exists('uri', $keys)) ? $keys['uri'] : null;
        $uriId = (array_key_exists('uri_id', $keys)) ? (int)$keys['uri_id'] : 0;

        if ($uriId > 0) {
            $query->where('a.id = ' . (int)$uriId);
        } else {
            $query->where('a.uri = ' . $this->db->quote($uri));
        }

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        $this->bind($result);
    }

    /**
     * Return the tags associated with an URI.
     *
     * <code>
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     *
     * $tags = $uri->getTags();
     * </code>
     *
     * @param bool $force
     *
     * @return array
     */
    public function getTags($force = false)
    {
        if ($this->tags === null or $force) {

            if (!empty($this->id) and $this->isPublished()) { // Get all tags ( global and URI )
                $query = '
                    ( SELECT
                        a.output, a.ordering, a.name, 0 AS tmp_ordering
                    FROM
                        '. $this->db->quoteName('#__itpm_global_tags', 'a') . ' 
                    WHERE
                        a.published = 1
                    )
            
                    UNION
        
                    ( SELECT
                        a.output, a.ordering, a.name, 1 AS tmp_ordering
                    FROM
                        ' . $this->db->quoteName('#__itpm_tags', 'a') . ' 
                    WHERE
                        a.url_id = ' . (int)$this->id . '
                    )
            
                    ORDER BY
                        tmp_ordering, ordering ASC
            
                    ';

            } else { // Get only global tags

                $query = $this->db->getQuery(true);
                $query
                    ->select('a.output, a.name')
                    ->from($this->db->quoteName('#__itpm_global_tags', 'a'))
                    ->where('a.published = 1')
                    ->order('a.ordering ASC');
            }

            $this->db->setQuery($query);
            $result_ = (array)$this->db->loadObjectList();

            // Prepare results. Replace global tags with the tags of current URI
            // if there are same ones.
            $result = array();
            foreach ($result_ as $row) {
                if (!empty($row->name)) {

                    // Check for existing value in the array for not overridden values.
                    if (!in_array($row->name, $this->notOverridden, true)) {
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
        }

        return $this->tags;
    }

    /**
     * Return URI ID.
     *
     * <code>
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     *
     * if (!$uri->getId()) {
     * ...
     * }
     * </code>
     *
     * @return int
     */
    public function getId()
    {
        return (int)$this->id;
    }

    /**
     * Check if auto update option has been enabled.
     *
     * <code>
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     *
     * if (!$uri->isAutoupdate()) {
     * ...
     * }
     * </code>
     *
     * @return bool
     */
    public function isAutoupdate()
    {
        return (bool)$this->autoupdate;
    }

    /**
     * Check if the URI is published.
     *
     * <code>
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     *
     * if (!$uri->isPublished()) {
     * ...
     * }
     * </code>
     *
     * @return bool
     */
    public function isPublished()
    {
        return (bool)$this->published;
    }

    /**
     * Set URI value.
     *
     * <code>
     * $uriValue = "/my-page";
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->setUri($uriValue);
     * </code>
     *
     * @param $uri
     *
     * @return $this
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Return a script that belongs to an URI.
     *
     * <code>
     * $type = "after"; // It can be one from both - after or before.
     *
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     *
     * echo $uri->getScript($type);
     * </code>
     *
     * @param $type
     *
     * @return null
     */
    public function getScript($type)
    {
        switch ($type) {

            case 'after':
                return $this->after_body_tag;
                break;

            case 'before':
                return $this->before_body_tag;
                break;
        }

        return null;
    }

    /**
     * Save the data of the URI.
     *
     * <code>
     * $type = "after"; // It can be one from both - after or before.
     *
     * $data = array(
     *    "uri" => "/my-page",
     *    "after_body_tag" => "....",
     *    "before_body_tag" => "....",
     *    "published" => 1,
     *    "autoupdate" => 0,
     *    "menu_id" => 1,
     *    "parent_menu_id" => 2,
     *    "primary_url" => 0
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->bind($data);
     *
     * $uri->store();
     * </code>
     */
    public function store()
    {
        // Prepare script tags
        $afterBodyTag = \JString::trim($this->after_body_tag);
        $afterBodyTag = ($afterBodyTag !== '') ? $this->db->quote($afterBodyTag) : 'NULL';

        $beforeBodyTag = \JString::trim($this->before_body_tag);
        $beforeBodyTag = ($beforeBodyTag !== '') ? $this->db->quote($beforeBodyTag) : 'NULL';

        $query = $this->db->getQuery(true);
        $query
            ->set('uri             = ' . $this->db->quote($this->uri))
            ->set('after_body_tag  = ' . $afterBodyTag)
            ->set('before_body_tag = ' . $beforeBodyTag)
            ->set('published       = ' . (int)$this->published)
            ->set('autoupdate      = ' . (int)$this->autoupdate)
            ->set('menu_id         = ' . (int)$this->menu_id)
            ->set('parent_menu_id  = ' . (int)$this->parent_menu_id)
            ->set('primary_url     = ' . (int)$this->primary_url);

        if (!$this->id) { // Insert a new record
            $query
                ->insert($this->db->quoteName('#__itpm_urls'));

            $this->db->setQuery($query);
            $this->db->execute();

            $this->id = $this->db->insertid();

        } else { // Update a record
            $query
                ->update($this->db->quoteName('#__itpm_urls'))
                ->where($this->db->quoteName('id') . ' = ' . (int)$this->id);

            $this->db->setQuery($query);
            $this->db->execute();
        }
    }

    /**
     * Set the data that will not be overridden.
     *
     * <code>
     * $data = array(
     *    "uri" => "/my-page",
     *    "after_body_tag" => "....",
     *    "before_body_tag" => "....",
     *    "published" => 1,
     *    "autoupdate" => 0,
     *    "menu_id" => 1,
     *    "parent_menu_id" => 2,
     *    "primary_url" => 0
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->setNotOverridden($data);
     * </code>
     *
     * @param array $data
     */
    public function setNotOverridden(array $data)
    {
        $this->notOverridden = $data;
    }

    /**
     * Return the URI as string.
     *
     * $keys = array(
     *    "uri" => "/my-page"
     * );
     *
     * $uri = new ItpMeta\Uri::getInstance(\JFactory::getDbo());
     * $uri->load($keys);
     *
     * echo $uri;
     *
     * </code>
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->uri;
    }
}
