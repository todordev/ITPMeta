<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.extension");

/**
 * This class provides functionality
 * for managing CrowdFunding (com_crowdfunding)
 */
class ItpMetaExtensionCrowdfunding extends ItpMetaExtension
{
    protected $uri;
    protected $view;
    protected $task;
    protected $menuItemId;

    protected $data;

    public function getData()
    {
        $app = JFactory::getApplication();
        /** @var $app JApplicationSite * */

        // Parse the URL
        $router = $app->getRouter();
        $parsed = $router->parse($this->uri);

        $id = JArrayHelper::getValue($parsed, "id");

        switch ($this->view) {

            case "discover":
            case "featured":
                $this->data = $this->getDiscoverData($id);
                break;

            case "backing":
                $this->data = $this->getDefaultProjectData($id);
                break;

            case "embed":
                $this->data = $this->getDefaultProjectData($id);
                break;

            case "project":
                $userId = JFactory::getUser()->get("id");
                if(!$userId) {
                    $this->data = $this->getRaiseData();
                }
                break;

            case "details":
                $this->data = $this->getDetailsData($id);
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
     * Extract data about discover page or category.
     *
     * @param int $categoryId
     *
     * @return array
     */
    protected function getDiscoverData($categoryId)
    {
        if (!empty($categoryId)) {
            $data = $this->getCategoryData($categoryId);
        } else {
            $data = $this->getDataByMenuItem($this->menuItemId);
        }

        return $data;
    }


    /**
     * Extract data about raising capital page ( Intro Article ).
     *
     * @return array
     */
    protected function getRaiseData()
    {
        // Get intro article
        $params     = JComponentHelper::getParams("com_crowdfunding");
        $articleId  = $params->get("project_intro_article", 0);

        $data       = array();

        if (!empty($articleId)) {

            $query = $this->db->getQuery(true);

            $query
                ->select("a.title, a.introtext, a.fulltext, a.images, a.metadesc, a.created, a.modified")
                ->from($this->db->quoteName("#__content", "a"))
                ->where("a.id = " . (int)$articleId);

            $this->db->setQuery($query);
            $result = $this->db->loadAssoc();

            if (!empty($result)) {

                $excluded = array("images", "introtext", "fulltext");

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

        }

        return $data;
    }

    /**
     * Prepare project data for view details.
     *
     * @param int $projectId
     *
     * @return array
     */
    protected function getDetailsData($projectId)
    {
        $data = array();

        if (!empty($projectId)) {

            $data = $this->getProjectData($projectId);

            if (!empty($data)) {

                // If it is a menu item, get menu item meta data.
                $menuItem   = $this->getMenuItem($this->menuItemId);
                if ((strcmp("details", $menuItem->query["view"])) == 0 and ($projectId == (int)$menuItem->query["id"])) {

                    $menuItemData = $this->getDataByMenuItem($this->menuItemId);

                    // Get title
                    if (!empty($menuItemData["title"])) {
                        $data["title"] = $menuItemData["title"];
                    }

                    // Get meta description
                    if (!empty($menuItemData["metadesc"])) {
                        $data["metadesc"] = $menuItemData["metadesc"];
                    }

                }

                // If it is one of the following screens
                $doc = JFactory::getDocument();

                $screen         = JArrayHelper::getValue($parsed, "screen");
                $projectScreens = array("updates", "comments", "funders");

                // If it is screens updates, comments or funders, use document title.
                if (in_array($screen, $projectScreens)) {
                    $data["title"] = $doc->getTitle();
                }

                if (!$data["metadesc"]) {
                    $data["metadesc"] = $doc->getDescription();
                }

            } else {
                $data = array();
            }

        }

        return $data;
    }

    /**
     * Prepare project data.
     *
     * @param int $projectId
     *
     * @return array
     */
    protected function getDefaultProjectData($projectId)
    {
        $data = array();

        if (!empty($projectId)) {

            $data = $this->getProjectData($projectId);

            if (!empty($data)) {

                $doc = JFactory::getDocument();
                $data["title"] = $doc->getTitle();

                if (!$data["metadesc"]) {
                    $data["metadesc"] = $doc->getDescription();
                }

            } else {
                $data = array();
            }

        }

        return $data;
    }

    /**
     * Extract data about project.
     *
     * @param int $projectId
     *
     * @return array
     */
    protected function getProjectData($projectId)
    {
        $data        = array();

        if (!empty($projectId)) {

            $query = $this->db->getQuery(true);

            $query
                ->select("a.title, a.short_desc AS metadesc, a.image, a.created")
                ->from($this->db->quoteName("#__crowdf_projects", "a"))
                ->where("a.id = " . (int)$projectId);

            $this->db->setQuery($query);
            $result = $this->db->loadAssoc();

            if (!empty($result)) {

                $data["title"]    = $result["title"];

                $data["created"]  = $result["created"];
                $data["modified"] = "";

                // Generate meta description
                $data["metadesc"] = $this->prepareMetaDesc($result["metadesc"]);

                // Generate image
                $params       = JComponentHelper::getParams("com_crowdfunding");
                $imagesFolder = $params->get("images_directory", "images/crowdfunding");

                $data["image"]    = JUri::root().$imagesFolder."/".$result["image"];

                unset($result);
            }

        }

        return $data;
    }
}
