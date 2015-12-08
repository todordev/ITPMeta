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
 * for managing Crowdfunding (com_crowdfunding)
 *
 * @package      ItpMeta
 * @subpackage   Extensions
 */
class Crowdfunding extends Base
{
    protected $uri;

    /**
     * Return meta data about page provided from Crowdfunding Platform.
     *
     * <code>
     * $options = array(
     *    "id" => 1,
     *    "screen" => "default",
     *    "user_id" => 2
     * );
     *
     * $extension = new ItpMeta\Extension\Crowdfunding("/my-page", $options);
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
        $id     = ArrayHelper::getValue($options, 'id');
        $screen = ArrayHelper::getValue($options, 'screen');
        $userId = ArrayHelper::getValue($options, 'user_id');

        $data   = array();

        switch ($this->view) {

            case 'category':
                $data = $this->getCategoryData($id);
                break;

            case 'backing':
                $data = $this->getDefaultProjectData($id);
                break;

            case 'embed':
                $data = $this->getDefaultProjectData($id);
                break;

            case 'project':
                if (!$userId) {
                    $data = $this->getRaiseData();
                }
                break;

            case 'details':
                $data = $this->getDetailsData($id, $screen);
                break;

            case 'discover':
            case 'featured':
            case 'categories':
            default: // Get data from menu item.
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
     * Extract data about raising capital page ( Intro Article ).
     *
     * @return array
     */
    protected function getRaiseData()
    {
        // Get intro article
        $params     = \JComponentHelper::getParams('com_crowdfunding');
        $articleId  = $params->get('project_intro_article', 0);

        $data       = array();

        if (!empty($articleId)) {

            $query = $this->db->getQuery(true);

            $query
                ->select('a.title, a.introtext, a.fulltext, a.images, a.metadesc, a.created, a.modified')
                ->from($this->db->quoteName('#__content', 'a'))
                ->where('a.id = ' . (int)$articleId);

            $this->db->setQuery($query);
            $result = (array)$this->db->loadAssoc();

            if (!empty($result)) {

                $excluded = array('images', 'introtext', 'fulltext');

                foreach ($result as $key => $value) {
                    if (!in_array($key, $excluded)) {
                        $data[$key] = $value;
                    }
                }

                $data['image'] = '';
                $images        = json_decode($result['images'], true);
                if (isset($images['image_intro']) and !empty($images['image_intro'])) {
                    $data['image'] = $images['image_intro'];
                }

                if (isset($images['image_fulltext']) and !empty($images['image_fulltext'])) {
                    $data['image'] = $images['image_fulltext'];
                }

                // Generate description
                if (!$data['metadesc'] and !empty($this->genMetaDesc)) {

                    $data['metadesc'] = $this->prepareMetaDesc($result['introtext']);

                    if (!$data['metadesc']) {
                        $data['metadesc'] = $this->prepareMetaDesc($result['fulltext']);
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
     * @param string $screen
     *
     * @return array
     */
    protected function getDetailsData($projectId, $screen = "")
    {
        $data = array();

        if (!empty($projectId)) {

            $data = $this->getProjectData($projectId);

            if (!empty($data)) {

                // If it is a menu item, get menu item meta data.
                $menuItem   = $this->getMenuItem($this->menuItemId);
                if ((strcmp('details', $menuItem->query['view'])) == 0 and ($projectId == (int)$menuItem->query['id'])) {

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

                // If it is one of the following screens
                $doc = \JFactory::getDocument();

                $projectScreens = array('updates', 'comments', 'funders');

                // If it is screens updates, comments or funders, use document title.
                if (in_array($screen, $projectScreens)) {
                    $data['title'] = $doc->getTitle();
                }

                if (!$data['metadesc']) {
                    $data['metadesc'] = $doc->getDescription();
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

                $doc = \JFactory::getDocument();
                $data['title'] = $doc->getTitle();

                if (!$data['metadesc']) {
                    $data['metadesc'] = $doc->getDescription();
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
                ->select('a.title, a.short_desc AS metadesc, a.image, a.created')
                ->from($this->db->quoteName('#__crowdf_projects', 'a'))
                ->where('a.id = ' . (int)$projectId);

            $this->db->setQuery($query);
            $result = (array)$this->db->loadAssoc();

            if (!empty($result)) {

                $data['title']    = $result['title'];

                $data['created']  = $result['created'];
                $data['modified'] = '';

                // Generate meta description
                $data['metadesc'] = $this->prepareMetaDesc($result['metadesc']);

                // Generate image
                $params       = \JComponentHelper::getParams('com_crowdfunding');
                $imagesFolder = $params->get('images_directory', 'images/crowdfunding');

                $data['image']  = \JUri::root().$imagesFolder.'/'.$result['image'];

                unset($result);
            }

        }

        return $data;
    }
}
