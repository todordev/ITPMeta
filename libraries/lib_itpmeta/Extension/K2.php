<?php
/**
 * @package      ItpMeta
 * @subpackage   Extensions
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Extension;

use Joomla\Utilities\ArrayHelper;

defined('JPATH_PLATFORM') or die;

/**
 * This helper provides functionality for K2 (com_k2).
 *
 * @package      ItpMeta
 * @subpackage   Extensions
 */
class K2 extends Base
{
    protected $uri;
    protected $data;

    /**
     * Return meta data about page provided from K2.
     *
     * <code>
     * $options = array(
     *    "id" => 1,
     *    "task" => "default"
     * );
     *
     * $extension = new ItpMeta\Extension\K2("/my-page", $options);
     *
     * $metaData = $extension->getData($options);
     * </code>
     *
     * @param array $options
     *
     * @return array
     */
    public function getData(array $options = array())
    {
        $data = array();

        $id   = ArrayHelper::getValue($options, 'id', 0, 'int');
        $task = ArrayHelper::getValue($options, 'task');

        // I am using $view because I could change it to 'tag'.
        // So, I don't want to replace the original property.
        $view = $this->view;

        switch ($task) {

            case 'user':
            case 'tag':
                $view = $task;
                break;

            case 'category':
                $view = $task;
                break;
        }

        switch ($view) {

            case 'item':
                $data = $this->getItemData($id);
                break;

            case 'category':
                $data = $this->getCategoryData($id, $view);
                break;

            case 'tag':
                $data = $this->prepareTagData($options);
                break;

            case 'user':
                $data = $this->getUserData($options);
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

    protected function prepareTagData($parsed)
    {
        $tagName = ArrayHelper::getValue($parsed, 'tag');
        $tagName = htmlentities($tagName, ENT_QUOTES, 'UTF-8');

        // Get menu item data.
        $data = $this->getDataByMenuItem($this->menuItemId);

        // Get menu item.
        $app      = \JFactory::getApplication();
        $menu     = $app->getMenu();
        $menuItem = $menu->getItem($this->menuItemId);

        // Get layout of current menu item.
        $layout = ArrayHelper::getValue($menuItem->query, 'layout');

        if (strcmp('tag', $layout) == 0) { // If it is a menu item of layout 'tag'.

            $title    = \JString::trim(ArrayHelper::getValue($data, 'title'));
            $metaDesc = \JString::trim(ArrayHelper::getValue($data, 'metadesc'));

            if (!$title) {
                $title = \JText::sprintf('LIB_ITPMETA_DISPLAYING_TAG', $tagName);
            }

            if (!$metaDesc) {
                $metaDesc = \JText::sprintf('LIB_ITPMETA_DISPLAYING_TAG_DESC', $tagName);
            }

        } else { // If it is not a menu item.

            $title    = \JText::sprintf('LIB_ITPMETA_DISPLAYING_TAG', $tagName);
            $metaDesc = \JText::sprintf('LIB_ITPMETA_DISPLAYING_TAG_DESC', $tagName);

        }

        $data['title']    = $title;
        $data['metadesc'] = $metaDesc;

        return $data;
    }

    /**
     * This method prepares K2 user data.
     *
     * @param $parsed
     *
     * @return array
     */
    protected function getUserData($parsed)
    {
        // Get menu item data.
        $data = $this->getDataByMenuItem($this->menuItemId);

        // Get menu item.
        $app      = \JFactory::getApplication();
        $menu     = $app->getMenu();
        $menuItem = $menu->getItem($this->menuItemId);

        // Get layout of current menu item.
        $layout = ArrayHelper::getValue($menuItem->query, 'layout');
        $userId = ArrayHelper::getValue($parsed, 'id', 0, 'int');

        $user = $this->getUser($userId);

        // Prepare title and meta description.
        if (strcmp('user', $layout) == 0) { // If there is a layout 'user', that is a menu item 'user'.
            $data['title']    = \JString::trim(ArrayHelper::getValue($data, 'title'));
            $data['metadesc'] = \JString::trim(ArrayHelper::getValue($data, 'metadesc'));

        } else { // Not menu item. Generate a title and meta description.

            $data['title'] = \JText::sprintf('LIB_ITPMETA_VIEW_USER_TITLE', $user['name']);

            if (!empty($user['metadesc'])) {
                $data['metadesc'] = $user['metadesc'];
            } else {
                $data['metadesc'] = \JText::sprintf('LIB_ITPMETA_VIEW_USER_METADESC', $user['name']);
            }

        }

        $data['image'] = ArrayHelper::getValue($user, 'image');
        unset($user);

        return $data;
    }

    protected function getUser($userId)
    {
        $data = array();

        $query = $this->db->getQuery(true);

        $query
            ->select('a.userName AS name, a.description , a.image')
            ->from($this->db->quoteName('#__k2_users', 'a'))
            ->where('a.userID = ' . (int)$userId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            $data['created']  = null;
            $data['modified'] = null;

            $data['name'] = $result['name'];

            // Prepare meta description.
            $data['metadesc'] = $this->prepareMetaDesc($result['description']);

            $data['image'] = null;
            if (!empty($result['image'])) {
                $data['image'] = 'media/k2/users/' . $result['image'];
            }

            unset($result);
        }

        return $data;
    }

    /**
     * Extract data about category.
     * 
     * @param int $categoryId
     * @param string $viewName
     *
     * @return array
     */
    protected function getCategoryData($categoryId, $viewName = "category")
    {
        $data = array();

        if (!$categoryId) {
            return $data;
        }

        $query = $this->db->getQuery(true);

        $query
            ->select('a.name AS title, a.description, a.params, a.image')
            ->from($this->db->quoteName('#__k2_categories', 'a'))
            ->where('a.id=' . (int)$categoryId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            $data['created']  = null;
            $data['modified'] = null;
            $data['title']    = $result['title'];

            // If it is a menu item, get menu item meta data.
            $menuItem   = $this->getMenuItem($this->menuItemId);

            // Use menu item title and description, if the items is set to a menu item.
            if (
                (strcmp('itemlist', $menuItem->query['view']) == 0 and strcmp($viewName, $menuItem->query['task']) == 0)
                and
                ($categoryId == (int)$menuItem->query['id'])) {

                $menuItemData = $this->getDataByMenuItem($this->menuItemId);

                // Get title
                if (!empty($menuItemData['title'])) {
                    $data['title'] = $menuItemData['title'];
                }

                // Get meta description
                if (!empty($menuItemData['metadesc'])) {
                    $data['metadesc'] = $menuItemData['metadesc'];
                }

            }

            // Prepare meta description.
            if (!empty($result['params'])) {
                $params = (array)json_decode($result['params'], true);
            }
            $data['metadesc'] = ArrayHelper::getValue($params, 'catMetaDesc');

            if (!$data['metadesc'] and !empty($this->genMetaDesc)) {
                $data['metadesc'] = $this->prepareMetaDesc($result['description']);
            }

            if (!empty($result['image'])) {
                $data['image'] = 'media/k2/categories/' . $result['image'];
            }

            unset($result);
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
    protected function getItemData($itemId)
    {
        $data = array();

        if (!$itemId) {
            return $data;
        }

        $query = $this->db->getQuery(true);

        $query
            ->select('a.title, a.introtext, a.fulltext, a.metadesc, a.created, a.modified')
            ->from($this->db->quoteName('#__k2_items', 'a'))
            ->where('a.id=' . (int)$itemId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            $data['title']    = $result['title'];
            $data['created']  = $result['created'];
            $data['modified'] = $result['modified'];
            $data['metadesc'] = $result['metadesc'];

            $data['image'] = '';
            $image         = 'media/k2/items/cache/' . md5('Image' . $itemId) . '_M.jpg';

            jimport('joomla.filesystem.file');
            if (\JFile::exists(JPATH_ROOT . DIRECTORY_SEPARATOR . $image)) {
                $data['image'] = $image;
            }

            if (!$data['image'] and $this->extractImage) {
                $data['image'] = $this->getImageFromContent($result['introtext'], $result['fulltext']);
            }

            if (!$data['metadesc'] and !empty($this->genMetaDesc)) {

                $data['metadesc'] = $this->prepareMetaDesc($result['introtext']);

                if (!$data['metadesc']) {
                    $data['metadesc'] = $this->prepareMetaDesc($result['fulltext']);
                }
            }

            unset($result);
        }

        return $data;
    }
}
