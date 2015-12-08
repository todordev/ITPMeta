<?php
/**
 * @package      ItpMeta\Statistics
 * @subpackage   URLs
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Statistics\Urls;

use Prism\Database\ArrayObject;

defined('JPATH_PLATFORM') or die;

/**
 * This class loads urls with scripts.
 *
 * @package         ItpMeta\Statistics
 * @subpackage      URLs
 */
class Scripts extends ArrayObject
{
    /**
     * Load items that contains scripts.
     *
     * <code>
     * $options = array(
     *     "limit" => 5
     * );
     *
     * $latest = new ItpMeta\Statistics\Urls\Scripts(JFactory::getDbo());
     * $latest->load($options);
     *
     * foreach ($latest as $item) {
     *    echo $item["uri"];
     * }
     * </code>
     *
     * @param array $options
     */
    public function load($options = array())
    {
        $limit = (!array_key_exists('limit', $options)) ? 5 : (int)$options['limit'];

        $query = $this->db->getQuery(true);

        $query
            ->select('a.id, a.uri')
            ->from($this->db->quoteName('#__itpm_urls', 'a'))
            ->where('(a.after_body_tag IS NOT NULL) OR (a.before_body_tag IS NOT NULL)')
            ->order('a.id DESC');

        $this->db->setQuery($query, 0, (int)$limit);

        $this->items = (array)$this->db->loadAssocList();
    }
}
