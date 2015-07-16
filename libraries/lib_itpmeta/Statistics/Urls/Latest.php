<?php
/**
 * @package      ItpMeta\Statistics
 * @subpackage   URLs
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

namespace ItpMeta\Statistics\Urls;

use Prism\Database\ArrayObject;

defined('JPATH_PLATFORM') or die;

/**
 * This class loads latest urls.
 *
 * @package         ItpMeta\Statistics
 * @subpackage      URLs
 */
class Latest extends ArrayObject
{
    /**
     * Load latest items ordering by creation date.
     *
     * <code>
     * $options = array(
     *     "limit" => 5
     * );
     * 
     * $latest = new ItpMeta\Statistics\Urls\Latest(JFactory::getDbo());
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
        $limit = !isset($options["limit"]) ? 5 : (int)$options["limit"];

        $query = $this->db->getQuery(true);

        $query
            ->select("a.id, a.uri")
            ->from($this->db->quoteName("#__itpm_urls", "a"))
            ->order("a.id DESC");

        $this->db->setQuery($query, 0, (int)$limit);

        $this->items = (array)$this->db->loadAssocList();
    }
}
