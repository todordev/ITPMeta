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
 * for managing UserIdeas (com_userideas)
 */
class ItpMetaExtensionUserideas extends ItpMetaExtension
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

        $id     = JArrayHelper::getValue($parsed, "id");

        switch ($this->view) {

            case "category":
                $this->data = $this->getCategoryData($id);
                break;

            case "items":
                $this->data = $this->getDefaultData();
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
     * Prepare item data for view details.
     *
     * @param int $itemId
     *
     * @return array
     */
    protected function getDetailsData($itemId)
    {
        $data = array();

        if (!empty($itemId)) {

            // Get item data.
            $data = $this->getItem($itemId);

            // If it is a menu item, get menu item meta data.
            $menuItem   = $this->getMenuItem($this->menuItemId);

            // Use menu item title and description, if the items is set to a menu item.
            if ((strcmp("details", $menuItem->query["view"])) == 0 and ($itemId == (int)$menuItem->query["id"])) {

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

            if (!$data) {
                $data = array();
            }
        }

        return $data;
    }

    /**
     * Extract data about item.
     *
     * @param int $itemId
     *
     * @return array
     */
    protected function getItem($itemId)
    {
        $data  = array();

        $query = $this->db->getQuery(true);

        $query
            ->select("a.title, a.description AS metadesc, a.record_date AS created")
            ->from($this->db->quoteName("#__uideas_items", "a"))
            ->where("a.id = " . (int)$itemId);

        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();

        if (!empty($result)) {

            $data["title"]    = $result["title"];

            $data["created"]  = $result["created"];
            $data["modified"] = "";
            $data["image"]    = "";

            // Generate meta description
            $data["metadesc"] = $this->prepareMetaDesc($result["metadesc"]);

            unset($result);
        }

        return $data;
    }
}
