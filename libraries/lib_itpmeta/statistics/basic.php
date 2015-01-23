<?php
/**
 * @package      ITPMeta
 * @subpackage   Library
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

/**
 * This class generates basic statistics.
 *
 * @package         Statistics
 */
class ITPMetaStatisticsBasic
{
    /**
     * Database driver
     *
     * @var JDatabaseDriver
     */
    protected $db;

    /**
     * Set database object.
     *
     * @param JDatabaseDriver $db
     */
    public function __construct(JDatabaseDriver $db)
    {
        $this->db = $db;
    }

    /**
     * This method returns a number of all urls.
     *
     * @return int
     */
    public function getTotalUrls()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select("COUNT(*)")
            ->from($this->db->quoteName("#__itpm_urls", "a"));

        $this->db->setQuery($query);
        $result = $this->db->loadResult();

        if (!$result) {
            $result = 0;
        }

        return $result;
    }

    /**
     * This method returns a number of all tags.
     *
     * @return int
     */
    public function getTotalTags()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select("COUNT(*)")
            ->from($this->db->quoteName("#__itpm_tags", "a"));

        $this->db->setQuery($query);
        $result = $this->db->loadResult();

        if (!$result) {
            $result = 0;
        }

        return $result;
    }

    /**
     * This method returns a number of all global tags.
     *
     * @return int
     */
    public function getTotalGlobalTags()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select("COUNT(*)")
            ->from($this->db->quoteName("#__itpm_global_tags", "a"));

        $this->db->setQuery($query);
        $result = $this->db->loadResult();

        if (!$result) {
            $result = 0;
        }

        return $result;
    }
}
