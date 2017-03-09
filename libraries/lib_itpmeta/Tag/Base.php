<?php
/**
 * @package      Itpmeta
 * @subpackage   Tags
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Tag;

use Joomla\String\StringHelper;

defined('JPATH_PLATFORM') or die;

/**
 * The base class of a tag.
 *
 * @package      Itpmeta
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
     * Initialize the object.
     *
     * @param \JDatabaseDriver $db
     */
    public function __construct(\JDatabaseDriver $db = null)
    {
        $this->db = $db;
    }

    /**
     * This method replaces indicators with values.
     *
     * Example:
     * The placeholder {TITLE} will be replaced with "My title".
     *
     * <code>
     * $keys = array(
     *     "id" => 1,
     * );
     *
     * $tag   = new Itpmeta\Tag\Tag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * $tag->generateOutput();
     * </code>
     */
    protected function generateOutput()
    {
        // Count placeholder in the tag content.
        $numMatches = (int)preg_match_all($this->pattern, $this->tag, $matches);

        if (2 === $numMatches) { // Replace values of tags which contains two placeholders.
            $rows = explode(PHP_EOL, $this->content);

            if (count($rows) === 2) {
                $line1 = $rows[0];
                $line2 = $this->clean($rows[1]);

                $tag          = preg_replace($this->pattern, $line1, $this->tag, 1); // First value
                $this->output = preg_replace($this->pattern, $line2, $tag, 1); // Second value
            } else {
                $line1        = $this->clean($rows[0]);
                $this->output = preg_replace($this->pattern, $line1, $this->tag, 1);
            }
        
        // Replace values of tags which contains one placeholder.
        } else {
            $this->output = preg_replace($this->pattern, $this->clean($this->content), $this->tag, 1);
        }
    }
    
    /**
     * Get tag ID.
     *
     * @return int
     */
    public function getId()
    {
        return (int)$this->id;
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

        return $this;
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
     * <code>
     * $keys = array(
     *      "id" => 1,
     * )
     *
     * $tag   = new Itpmeta\Tag\Tag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * $tag->setContent("http://itprism.com/images/picture.png");
     * </code>
     *
     * @param string $content Tag content.
     * @param bool $generateOutput If true, generates the output string of the tag.
     *
     * @return self
     */
    public function setContent($content, $generateOutput = true)
    {
        $this->content = $content;

        if ($generateOutput) {
            $this->generateOutput();
        }

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
        if ($this->output === null) {
            $this->generateOutput();
        }

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
     * @return int
     */
    public function getUrlId()
    {
        return (int)$this->url_id;
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
     * $tag   = new Itpmeta\Tag\Tag(\JFactory::getDbo());
     * $tag->bind($data);
     * </code>
     *
     * @param array $data
     * @param array $ignored
     */
    public function bind($data, array $ignored = array())
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
     * $tag = new Itpmeta\Tag\Tag(\JFactory::getDbo());
     * $tag = $tag->clean($content);
     * </code>
     *
     * @param string $content
     * @return string
     */
    protected function clean($content)
    {
        return StringHelper::trim(preg_replace('/\r|\n/', ' ', $content));
    }

    /**
     * Returns the tag.
     *
     * <code>
     * $keys = array(
     *     "id" => 1,
     * );
     *
     * $tag   = new Itpmeta\Tag\Tag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * echo $tag;
     * </code>
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTag();
    }

    /**
     * Returns object data as array.
     *
     * <code>
     * $keys = array(
     *     "id" => 1,
     * );
     *
     * $tag   = new Itpmeta\Tag\Tag(\JFactory::getDbo());
     * $tag->load($keys);
     *
     * $tagAsArray = $tag->toArray();
     * </code>
     *
     * @param bool $full
     *
     * @return array
     */
    public function toArray($full = false)
    {
        if ($full) {
            return array(
                'id'        => $this->getId(),
                'name'      => $this->getName(),
                'title'     => $this->getTitle(),
                'type'      => $this->getType(),
                'tag'       => $this->getTag(),
                'content'   => $this->getContent(),
                'output'    => $this->getOutput(),
                'ordering'  => (int)$this->ordering,
                'url_id'    => $this->getUrlId()
            );
        } else {
            return array(
                'title'   => $this->getTitle(),
                'type'    => $this->getType(),
                'tag'     => $this->getTag(),
                'content' => $this->getContent(),
                'output'  => $this->getOutput()
            );
        }
    }
}
