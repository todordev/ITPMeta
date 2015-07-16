<?php
/**
 * @package      ItpMeta
 * @subpackage   Extensions
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

namespace ItpMeta\Extension;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality
 * for managing Joomla! Content (com_content)
 *
 * @package ItpMeta
 * @subpackage   Extensions
 */
class Content extends Base
{
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;

    protected $data = array();

    /**
     * Return meta data about page provided by Joomla! Content.
     *
     * <code>
     * $options = array(
     *    "id" => 1
     * );
     *
     * $extension = new ItpMeta\Extension\Content("/my-page", $options);
     *
     * $metaData = $extension->getData($options);
     * </code>
     *
     * @param array $options
     *
     * @return array
     */
    public function getData($options = array())
    {
        $data = array();

        $id = \JArrayHelper::getValue($options, "id");

        switch ($this->view) {

            case "article":
                $data = $this->getArticleData($id);
                break;

            case "category":
                $data = $this->getCategoryData($id);
                break;

            default: // Get menu item
                if (!empty($this->menuItemId)) {
                    $data = $this->getDataByMenuItem($this->menuItemId);
                }
                break;
        }

        if (!is_array($data)) {
            $data = array();
        }

        return $data;
    }

    /**
     * Extract data about article.
     *
     * @param int $articleId
     *
     * @return array
     */
    protected function getArticleData($articleId)
    {
        if (!$articleId) {
            return null;
        }

        $excluded = array("images", "introtext", "fulltext");
        $data     = array();

        $query = $this->db->getQuery(true);

        $query
            ->select("a.title, a.introtext, a.fulltext, a.images, a.metadesc, a.created, a.modified")
            ->from($this->db->quoteName("#__content", "a"))
            ->where("a.id = " . (int)$articleId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            foreach ($result as $key => $value) {
                if (!in_array($key, $excluded)) {
                    $data[$key] = $value;
                }
            }

            $data["image"] = "";
            $images        = json_decode($result["images"], true);
            if (isset($images["image_intro"]) and !empty($images["image_intro"])) {
                $data["image"] = $images["image_intro"];
            }

            if (isset($images["image_fulltext"]) and !empty($images["image_fulltext"])) {
                $data["image"] = $images["image_fulltext"];
            }

            // Generate description
            if (!$data["metadesc"] and !empty($this->genMetaDesc)) {

                $data["metadesc"] = $this->prepareMetaDesc($result["introtext"]);

                if (!$data["metadesc"]) {
                    $data["metadesc"] = $this->prepareMetaDesc($result["fulltext"]);
                }

            }

            unset($result);
        }

        return $data;
    }
}
