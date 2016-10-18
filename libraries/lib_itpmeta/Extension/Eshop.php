<?php
/**
 * @package      Itpmeta
 * @subpackage   Extensions
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Extension;

use Joomla\Utilities\ArrayHelper;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality
 * for managing EShop(com_eshop)
 *
 * @package Itpmeta
 * @subpackage   Extensions
 */
class Eshop extends Base
{
    protected $uri;

    protected $data = array();

    /**
     * Return meta data about page provided by EShop.
     *
     * <code>
     * $options = array(
     *    "id" => 1
     * );
     *
     * $extension = new Itpmeta\Extension\Eshop("/my-page", $options);
     *
     * $metaData = $extension->getData($options);
     * </code>
     *
     * @param array $options
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Exception
     * @return array
     */
    public function getData(array $options = array())
    {
        $data = array();

        $id = ArrayHelper::getValue($options, 'id');

        switch ($this->view) {
            case 'product':
                $data = $this->getProductData($id);
                break;

            case 'category':
                $data = $this->getCategoryData($id);
                break;

            default: // Get menu item
                if ((int)$this->menuItemId > 0) {
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
     * Extract data about product.
     *
     * @param int $productId
     *
     * @throws \RuntimeException
     * @return array
     */
    protected function getProductData($productId)
    {
        $productId = (int)$productId;
        if (!$productId) {
            return null;
        }

        $data  = array();

        $query = $this->db->getQuery(true);

        $query
            ->select(
                'a.product_image, a.created_date, a.modified_date, ' .
                'b.product_name, b.product_short_desc, b.product_desc, b.product_page_title, b.meta_desc'
            )
            ->from($this->db->quoteName('#__eshop_products', 'a'))
            ->leftJoin($this->db->quoteName('#__eshop_productdetails', 'b') . ' ON a.id = b.id')
            ->where('a.id = ' . (int)$productId);

        $this->db->setQuery($query, 0, 1);
        $result = (array)$this->db->loadAssoc();

        if (count($result) > 0) {
            $data['title']      = $result['product_page_title'] ?: $result['product_name'];
            $data['metadesc']   = $result['meta_desc'];
            $data['created']    = $result['created_date'];
            $data['modified']   = $result['modified_date'];
            $data['image']      = $result['product_image'];

            $imageUri  = 'media/com_eshop/products/';

            if ($data['image'] and \JFile::exists(JPATH_ROOT .DIRECTORY_SEPARATOR. $imageUri. $data['image'])) {
                if (!class_exists('EshopHelper')) {
                    \JLoader::register('EshopHelper', JPATH_ROOT .'/components/com_eshop/helpers/helper.php');
                }
                
                if (\EshopHelper::getConfigValue('product_use_image_watermarks')) {
                    $watermarkImage = \EshopHelper::generateWatermarkImage($imageUri.$data['image']);
                    $data['image']  = $watermarkImage;
                } else {
                    $data['image']  = $imageUri.$data['image'];
                }
            } else {
                $data['image'] = '';
            }

            // Generate description
            if (!$data['metadesc'] and $this->genMetaDesc) {
                $data['metadesc'] = $this->prepareMetaDesc($result['product_short_desc']);

                if (!$data['metadesc']) {
                    $data['metadesc'] = $this->prepareMetaDesc($result['product_desc']);
                }
            }

            unset($result);
        }

        return $data;
    }

    /**
     * Extract data about product.
     *
     * @param int $categoryId
     * @param string $viewName
     *
     * @throws \RuntimeException
     * @return array
     */
    protected function getCategoryData($categoryId, $viewName = 'category')
    {
        $categoryId = (int)$categoryId;
        if (!$categoryId) {
            return null;
        }

        $data  = array();

        $query = $this->db->getQuery(true);

        $query
            ->select(
                'a.category_image, a.created_date, a.modified_date, ' .
                'b.category_name, b.category_desc, b.category_page_title, b.meta_desc'
            )
            ->from($this->db->quoteName('#__eshop_categories', 'a'))
            ->leftJoin($this->db->quoteName('#__eshop_categorydetails', 'b') . ' ON a.id = b.id')
            ->where('a.id = ' . (int)$categoryId);

        $this->db->setQuery($query, 0, 1);
        $result = (array)$this->db->loadAssoc();

        if (count($result) > 0) {
            $data['title']      = $result['category_page_title'] ?: $result['category_name'];
            $data['metadesc']   = $result['meta_desc'];
            $data['created']    = $result['created_date'];
            $data['modified']   = $result['modified_date'];
            $data['image']      = $result['category_image'];

            $imageUri  = 'media/com_eshop/categories/';

            if ($data['image'] and \JFile::exists(JPATH_ROOT .DIRECTORY_SEPARATOR. $imageUri. $data['image'])) {
                if (!class_exists('EshopHelper')) {
                    \JLoader::register('EshopHelper', JPATH_ROOT .'/components/com_eshop/helpers/helper.php');
                }

                if (\EshopHelper::getConfigValue('category_use_image_watermarks')) {
                    $watermarkImage = \EshopHelper::generateWatermarkImage($imageUri.$data['image']);
                    $data['image']  = $watermarkImage;
                } else {
                    $data['image']  = $imageUri.$data['image'];
                }
            } else {
                $data['image'] = '';
            }

            // Generate description
            if (!$data['metadesc'] and $this->genMetaDesc) {
                $data['metadesc'] = $this->prepareMetaDesc($result['category_desc']);
            }

            unset($result);
        }

        return $data;
    }
}
