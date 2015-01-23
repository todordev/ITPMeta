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
 * for managing SocialCommunity (com_socialcommunity)
 */
class ItpMetaExtensionSocialcommunity extends ItpMetaExtension
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

            case "profile":
                $this->data = $this->getProfileData($id);
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
     * Extract data about user profile.
     *
     * @param int $userId
     *
     * @return array
     */
    protected function getProfileData($userId)
    {
        $data  = array();

        $query = $this->db->getQuery(true);

        $query
            ->select("a.name AS title, a.bio AS metadesc, a.image_small AS image")
            ->from($this->db->quoteName("#__itpsc_profiles", "a"))
            ->where("a.id = " . (int)$userId);

        $this->db->setQuery($query);
        $result = $this->db->loadAssoc();

        if (!empty($result)) {

            $data["title"]    = $result["title"];

            $data["created"]  = "";
            $data["modified"] = "";

            // Generate meta description
            $data["metadesc"] = $this->prepareMetaDesc($result["metadesc"]);

            // Generate image
            $params        = JComponentHelper::getParams("com_socialcommunity");
            $imagesFolder  = $params->get("images_directory", "images/profiles");

            $data["image"] = JUri::root().$imagesFolder.$result["image"];

            unset($result);
        }

        return $data;
    }
}
