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
 * The base class of a tag.
 *
 * @package      ItpMeta
 * @subpackage   Tags
 */
abstract class Base
{
    protected $id;
    protected $name;
    protected $type;
    protected $title;
    protected $tag;
    protected $content;
    protected $output;
    protected $ordering;
    protected $url_id;

    protected $pattern = '/{.*}/iU';

    /**
     * Database driver.
     *
     * @var \JDatabaseDriver
     */
    protected $db;

    /**
     * This method replaces indicators with values.
     *
     * Example:
     * The placeholder {TITLE} will be replaced with "My title".
     *
     * <code>
     * $keys = array(
     *      "id" => 1,
     * )
     *
     * $tag   = new ItpMeta\ExtensionTag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * $tag->generateOutput();
     * </code>
     *
     * @return string
     */
    public function generateOutput()
    {
        // Count indicators in a string.
        $numMatches = (int)preg_match_all($this->pattern, $this->tag, $matches);

        if (2 === $numMatches) { // Replace values of tags which contains two indicators.

            $rows = preg_split("/\n/", $this->content);

            if (count($rows) === 2) {

                $line1 = $rows[0];
                $line2 = $this->clean($rows[1]);

                $tag          = preg_replace($this->pattern, $line1, $this->tag, 1); // First value
                $this->output = preg_replace($this->pattern, $line2, $tag, 1); // Second value

            } else {

                $line1        = $this->clean($rows[0]);
                $this->output = preg_replace($this->pattern, $line1, $this->tag, 1);
            }

        } else { // Replace values of tags which contains one indicators.
            $this->output = preg_replace($this->pattern, $this->clean($this->content), $this->tag, 1);
        }
    }

    /**
     * Initialize the object.
     *
     * @param \JDatabaseDriver $db
     */
    public function __construct(\JDatabaseDriver $db)
    {
        $this->db = $db;
    }

    /**
     * Get tag ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tag ID.
     *
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get tag name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set tag name.
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get tag type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tag type.
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get tag title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set tag title.
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get tag content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set tag content.
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get tag template.
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set tag template.
     *
     * @param string $tag
     * @return self
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag output.
     *
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Set tag output.
     *
     * @param string $output
     * @return self
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Get the ID of an URL where the tag belongs.
     *
     * @return string
     */
    public function getUrlId()
    {
        return $this->url_id;
    }

    /**
     * Set the ID of an URL where the tag belongs.
     *
     * @param int $urlId
     * @return self
     */
    public function setUrlId($urlId)
    {
        $this->url_id = (int)$urlId;

        return $this;
    }

    /**
     * Import data about tag to object parameters.
     *
     * <code>
     * $data = array(
     *  "title"  => "Title of og:image tag",
     *  "content" => "http://itprism.com/images/picture.png"
     * );
     *
     * $tag   = new ItpMeta\Tag(\JFactory::getDbo());
     * $tag->bind($data);
     * </code>
     *
     * @param array $data
     * @param array $ignored
     */
    public function bind($data, $ignored = array())
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $ignored, true)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Clean the content from new lines.
     *
     * <code>
     * $content = "....";
     *
     * $tag = new ItpMeta\Tag(\JFactory::getDbo());
     * $tag = $tag->clean($content);
     * </code>
     *
     * @param string $content
     * @return string
     */
    protected function clean($content)
    {
        return \JString::trim(preg_replace('/\r|\n/', ' ', $content));
    }

    /**
     * Returns the tag.
     *
     * <code>
     *
     * $tag   = new ItpMeta\Tag(\JFactory::getDbo());
     * $tag->load();
     * </code>
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTag();
    }
}
