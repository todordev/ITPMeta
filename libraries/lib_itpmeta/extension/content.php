<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.extension");

/**
 * This class provides functionality
 * for managing Joomla! Content (com_content)
 */
class ItpMetaExtensionContent extends ItpMetaExtension
{
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;

    protected $data;

    public function getData()
    {
        $app = JFactory::getApplication();
        /** @var $app JApplicationSite */

        // Parse the URL
        $router = $app->getRouter();
        $parsed = $router->parse($this->uri);

        $id = JArrayHelper::getValue($parsed, "id");

        switch ($this->view) {

            case "article":
                $this->data = $this->getArticleData($id);
                break;

            case "category":
                $this->data = $this->getCategoryData($id);
                break;

            default: // Get menu item
                if (!empty($this->menuItemId)) {
                    $this->data = $this->getDataByMenuItem($this->menuItemId);
                }
                break;
        }

        return $this->data;
    }

    /**
     * Extract data about article
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
        $result = $this->db->loadAssoc();

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
