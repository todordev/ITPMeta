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
 * for managing VirtueMart (com_virtuemart)
 *
 * @package ItpMeta
 * @subpackage   Extensions
 */
class Virtuemart extends Base
{
    protected $uri;

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
    public function getData(array $options = array())
    {
        $data = array();

        switch ($this->view) {

            case 'productdetails':
                $id = ArrayHelper::getValue($options, 'virtuemart_product_id', 0, 'int');
                $data = $this->getProductDetails($id);
                break;

            case 'category':
                $id = ArrayHelper::getValue($options, 'virtuemart_category_id', 0, 'int');
                $data = $this->getCategoryData($id);
                break;

            default: // Get menu item
                if ($this->menuItemId > 0) {
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
     * @param int $productId
     *
     * @return array
     */
    protected function getProductDetails($productId)
    {
        $data       = array(
            'title'    => '',
            'image'    => '',
            'metadesc' => ''
        );

        $productId = (int)$productId;
        
        if ($productId > 0) {

            $productModel = \VmModel::getModel('product');
            $product = $productModel->getProduct($productId, true, true, true);
            $productModel->addImages($product);
            
            if ($product->virtuemart_product_id > 0) {

                // Prepare the title.
                $data['title'] = \JString::trim($product->product_name);

                // Prepare the image.
                if ($product->file_url_thumb !== '') {
                    $data['image'] = \JUri::base() . $product->file_url_thumb;
                } elseif ($product->file_url !== '') {
                    $data['image'] = \JUri::base() . $product->file_url;
                }

                if (!$data['image'] and $this->extractImage) {
                    $data['image'] = $this->getImageFromContent($product->product_s_desc, $product->product_desc);
                }

                // Prepare description
                $data['metadesc'] = $this->prepareMetaDesc($product->metadesc);
                if (!$data['metadesc'] and $this->genMetaDesc) {

                    $data['metadesc'] = $this->prepareMetaDesc($product->product_s_desc);

                    if (!$data['metadesc']) {
                        $data['metadesc'] = $this->prepareMetaDesc($product->product_desc);
                    }
                }

                unset($result);
            }
        }

        return $data;
    }

    /**
     * Prepare data about category.
     *
     * @param int $categoryId
     * @param string $viewName
     *
     * @return array
     */
    protected function getCategoryData($categoryId, $viewName = 'category')
    {
        $data       = array(
            'title'    => '',
            'image'    => '',
            'metadesc' => ''
        );

        $categoryId = (int)$categoryId;

        if ($categoryId > 0) {

            $categoryModel = \VmModel::getModel('category');
            $category      = $categoryModel->getCategory($categoryId);

            $data['title'] = \JString::trim($category->category_name);

            if ($category->file_url_thumb !== '') {
                $data['image'] = \JUri::base() . $category->file_url_thumb;
            } elseif ($category->file_url !== '') {
                $data['image'] = \JUri::base() . $category->file_url;
            }


            // If it is a menu item, get menu item meta data.
            $menuItem   = $this->getMenuItem($this->menuItemId);
            
            // Use menu item title and description, if the items is set to a menu item.
            if ((strcmp($viewName, $menuItem->query['view']) === 0) and ($categoryId === (int)$menuItem->query['id'])) {

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

            // Generate meta description from category description.
            if (!$data['metadesc'] and $this->genMetaDesc) {
                $data['metadesc'] = $this->prepareMetaDesc($category->category_description);
            }

        }

        return $data;
    }
}
