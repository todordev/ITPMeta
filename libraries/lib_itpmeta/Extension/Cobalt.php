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
 * This class provides functionality
 * for managing Cobalt (com_cobalt) meta data.
 *
 * @package ItpMeta
 * @subpackage   Extensions
 */
class Cobalt extends Base
{
    /**
     * Return meta data about page provided by Cobalt.
     *
     * <code>
     * $options = array(
     *    "id" => 1,
     *    "section_id" => 2,
     *    "cat_id" => 3,
     *    "user_id" => 4,
     *    "ucat_id" => 5
     * );
     *
     * $extension = new ItpMeta\Extension\Cobalt("/my-page", $options);
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
        $view = '';
        $data = array();

        $id         = ArrayHelper::getValue($options, 'id');
        $sectionId  = ArrayHelper::getValue($options, 'section_id');
        $categoryId = ArrayHelper::getValue($options, 'cat_id');

        $userId     = ArrayHelper::getValue($options, 'user_id');

        $userCategoryId = ArrayHelper::getValue($options, 'ucat_id');

        // If missing ID I have to get information from menu item.
        if (!is_null($id)) {
            $view = 'item';
        } elseif (!is_null($sectionId) and !is_null($userCategoryId)) { // It is user category
            $view = 'usercategory';
        } elseif (!is_null($sectionId) and !is_null($categoryId)) { // It is category
            $view = 'category';
        } elseif (!is_null($sectionId) and is_null($categoryId) and is_null($userId)) { // It is section
            $view = 'section';
        } elseif (!is_null($sectionId) and !is_null($userId)) { // It is author profile
            $view = 'author';
        }

        switch ($view) {

            case 'item':
                $data = $this->getItemData($id);
                break;

            case 'category':
                $data = $this->getCobaltCategoryData($categoryId);
                break;

            case 'usercategory':
                $data = $this->getUserCategoryData($userCategoryId);
                break;

            case 'section':
                $data = $this->getSectionData($sectionId);
                break;

            case 'author':
                $data = $this->getAuthorData($userId, $sectionId);
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
     * Extract data about category.
     *
     * @param int $categoryId
     *
     * @return array
     */
    protected function getCobaltCategoryData($categoryId)
    {
        $data = array();

        if (!$categoryId) {
            return $data;
        }

        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.title, a.description, a.metadesc, a.image, a.created_time AS created, a.modified_time AS modified')
            ->from($this->db->quoteName('#__js_res_categories', 'a'))
            ->where('a.id=' . (int)$categoryId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            foreach ($result as $key => $value) {
                $data[$key] = $value;
            }
            unset($results);

            $data['metadesc'] = $this->clean($data['metadesc']);

            // Generate meta description from textarea or HTML field.
            if (!$data['metadesc'] and !empty($this->genMetaDesc)) {
                $data['metadesc'] = $this->prepareMetaDesc($data['description']);
            }

        }

        return $data;
    }

    /**
     * Extract data about category.
     *
     * @param int $userId
     * @param int $sectionId
     *
     * @return array
     */
    protected function getAuthorData($userId, $sectionId)
    {
        $data = array();

        if (!$userId) {
            return $data;
        }

        $query = $this->db->getQuery(true);
        $query
            ->select('a.name, b.name AS section')
            ->from($this->db->quoteName('#__users', 'a'))
            ->from($this->db->quoteName('#__js_res_sections', 'b'))
            ->where('a.id = ' . (int)$userId)
            ->where('b.id = ' . (int)$sectionId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {
            $data['title']    = \JText::sprintf('LIB_ITPMETA_VIEW_USER_TITLE', $result['name']);
            $data['metadesc'] = \JText::sprintf('LIB_ITPMETA_VIEW_SECTION_USER_METADESC', $result['section'], $result['name']);
        }

        return $data;
    }

    /**
     * Extract data about user category.
     *
     * @param int $categoryId
     *
     * @return array
     */
    protected function getUserCategoryData($categoryId)
    {
        $data = array();

        if (!$categoryId) {
            return $data;
        }

        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.name AS title, a.description, a.params, a.ctime AS created, a.mtime AS modified')
            ->from($this->db->quoteName('#__js_res_category_user', 'a'))
            ->where('a.id=' . (int)$categoryId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            $params = ArrayHelper::getValue($result, 'params');
            unset($result['params']);

            foreach ($result as $key => $value) {
                $data[$key] = $value;
            }

            $params = json_decode($params, true);

            $data['metadesc'] = ArrayHelper::getValue($params, 'meta_descr');
            $data['image']    = ArrayHelper::getValue($params, 'image');
            unset($params);
            unset($result);

            $data['metadesc'] = $this->clean($data['metadesc']);

            // Generate meta description from textarea or HTML field.
            if (!$data['metadesc'] and !empty($this->genMetaDesc)) {
                $data['metadesc'] = $this->prepareMetaDesc($data['description']);
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
    protected function getItemData($itemId)
    {
        $data = array();

        if (!$itemId) {
            return $data;
        }

        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.title, a.meta_descr AS metadesc, a.ctime AS created, a.mtime AS modified')
            ->from($this->db->quoteName('#__js_res_record', 'a'))
            ->where('a.id=' . (int)$itemId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {

            // Prepare data
            foreach ($result as $key => $value) {
                $data[$key] = \JString::trim($value);
            }
            unset($results);

            $data['metadesc'] = $this->clean($data['metadesc']);

            // Get images
            $data['image'] = $this->getItemImage($itemId);

            // Generate meta description from textarea or HTML field.
            if (!$data['metadesc'] and !empty($this->genMetaDesc)) {
                $data['metadesc'] = $this->getItemDescription($itemId);
            }

        }

        return $data;
    }

    /**
     * Get image of an item from database.
     *
     * @param integer $itemId
     *
     * @return NULL|string
     */
    protected function getItemImage($itemId)
    {
        $imageData = array();

        // Get images
        $query = $this->db->getQuery(true);
        $query
            ->select('a.field_label AS title, a.field_value AS image')
            ->from($this->db->quoteName('#__js_res_record_values', 'a'))
            ->where('a.record_id  = ' . (int)$itemId)
            ->where('a.field_type = ' . $this->db->quote('image'));

        $this->db->setQuery($query);
        $results = (array)$this->db->loadAssocList();

        if (!empty($results)) {
            $imageData = array_shift($results);
            unset($results);
        }

        return ArrayHelper::getValue($imageData, 'image');
    }

    /**
     * Generate meta description from textarea or HTML fields.
     *
     * @param integer $itemId
     *
     * @return string
     */
    protected function getItemDescription($itemId)
    {
        $metaDesc = '';

        // Get images
        $query = $this->db->getQuery(true);
        $query
            ->select('a.field_type AS type, a.field_value AS text')
            ->from($this->db->quoteName('#__js_res_record_values', 'a'))
            ->where('a.record_id  = ' . (int)$itemId)
            ->where('(a.field_type = ' . $this->db->quote('html') . ' OR ' . 'a.field_type = ' . $this->db->quote('textarea') . ')');

        $this->db->setQuery($query);
        $results = (array)$this->db->loadAssocList();

        if (!empty($results)) {

            $htmlFields     = array();
            $textAreaFields = array();

            foreach ($results as $value) {
                if (strcmp('html', $value['type']) === 0) {
                    $htmlFields[] = $value;
                } else {
                    $textAreaFields[] = $value;
                }
            }

            // Generate meta description from HTML field.
            foreach ($htmlFields as $value) {
                $metaDesc = $this->prepareMetaDesc($value['text']);
                if (!empty($metaDesc)) {
                    break;
                }
            }

            // Generate meta description from TextArea field.
            if (!$metaDesc) {

                foreach ($textAreaFields as $value) {
                    $metaDesc = $this->prepareMetaDesc($value['text']);
                    if (!empty($metaDesc)) {
                        break;
                    }
                }

            }

            unset($htmlFields, $textAreaFields, $results);
        }

        return $metaDesc;
    }

    /**
     * Extract data about section.
     *
     * @param int $sectionId
     *
     * @return array
     */
    protected function getSectionData($sectionId)
    {
        $data = array();

        if (!$sectionId) {
            return $data;
        }

        $query = $this->db->getQuery(true);
        $query
            ->select('a.id, a.title, a.description')
            ->from($this->db->quoteName('#__js_res_sections', 'a'))
            ->where('a.id=' . (int)$sectionId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {
            $data['title'] = ArrayHelper::getValue($result, 'title');

            $description = ArrayHelper::getValue($result, 'description');

            $metaDesc         = \JString::substr(\JString::trim(strip_tags($description)), 0, 160);
            $data['metadesc'] = $metaDesc;
        }

        return $data;
    }
}
