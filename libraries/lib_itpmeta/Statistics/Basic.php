<?php
/**
 * @package      ItpMeta
 * @subpackage   Statistics
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Statistics;

defined('JPATH_PLATFORM') or die;

/**
 * This class generates basic statistics.
 *
 * @package      ItpMeta
 * @subpackage   Statistics
 */
class Basic
{
    /**
     * Database driver
     *
     * @var \JDatabaseDriver
     */
    protected $db;

    /**
     * Initialize the object.
     *
     * <code>
     * $statistics   = new ItpMeta\Statistics\Basic(\JFactory::getDbo());
     * </code>
     *
     * @param \JDatabaseDriver $db
     */
    public function __construct(\JDatabaseDriver $db)
    {
        $this->db = $db;
    }

    /**
     * This method returns a number of all urls.
     *
     * <code>
     * $statistics   = new ItpMeta\Statistics\Basic(\JFactory::getDbo());
     * echo $statistics->getTotalUrls();
     * </code>
     *
     * @return int
     */
    public function getTotalUrls()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select('COUNT(*)')
            ->from($this->db->quoteName('#__itpm_urls', 'a'));

        $this->db->setQuery($query);
        $result = (int)$this->db->loadResult();

        return $result;
    }

    /**
     * This method returns a number of all tags.
     *
     * <code>
     * $statistics   = new ItpMeta\Statistics\Basic(\JFactory::getDbo());
     * echo $statistics->getTotalTags();
     * </code>
     *
     * @return int
     */
    public function getTotalTags()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select('COUNT(*)')
            ->from($this->db->quoteName('#__itpm_tags', 'a'));

        $this->db->setQuery($query);
        $result = (int)$this->db->loadResult();

        return $result;
    }

    /**
     * This method returns a number of all global tags.
     *
     * <code>
     * $statistics   = new ItpMeta\Statistics\Basic(\JFactory::getDbo());
     * echo $statistics->getTotalGlobalTags();
     * </code>
     *
     * @return int
     */
    public function getTotalGlobalTags()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select('COUNT(*)')
            ->from($this->db->quoteName('#__itpm_global_tags', 'a'));

        $this->db->setQuery($query);
        $result = (int)$this->db->loadResult();

        return $result;
    }
}
