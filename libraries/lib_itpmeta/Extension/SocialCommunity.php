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
 * for managing SocialCommunity (com_socialcommunity)
 *
 * @package      ItpMeta
 * @subpackage   Extensions
 */
class SocialCommunity extends Base
{
    protected $uri;
    protected $data;

    /**
     * Return meta data about page provided from Social Community.
     *
     * <code>
     * $options = array(
     *    "id" => 1
     * );
     *
     * $extension = new ItpMeta\Extension\SocialCommunity("/my-page", $options);
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
        $id = ArrayHelper::getValue($options, 'id');

        switch ($this->view) {

            case 'profile':
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
            ->select('a.name AS title, a.bio AS metadesc, a.image_small AS image')
            ->from($this->db->quoteName('#__itpsc_profiles', 'a'))
            ->where('a.id = ' . (int)$userId);

        $this->db->setQuery($query);
        $result = (array)$this->db->loadAssoc();

        if (!empty($result)) {
            $data['title']    = $result['title'];

            $data['created']  = '';
            $data['modified'] = '';

            // Generate meta description
            $data['metadesc'] = $this->prepareMetaDesc($result['metadesc']);

            // Generate image
            $params        = \JComponentHelper::getParams('com_socialcommunity');
            $imagesFolder  = $params->get('images_directory', 'images/profiles');

            $data['image'] = \JUri::root().$imagesFolder.$result['image'];

            unset($result);
        }

        if (!is_array($data)) {
            $data = array();
        }

        return $data;
    }
}
