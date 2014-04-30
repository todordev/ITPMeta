<?php
/**
 * @package      ITPMeta
 * @subpackage   Library
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

/**
 * This is a base class for urls statistics.
 *
 * @package         Statistics
 */
abstract class ITPMetaStatisticsUrls
{
    /**
     * Database driver
     *
     * @var JDatabaseDriver
     */
    protected $db;

    /**
     * This method sets database object.
     *
     * @param JDatabaseDriver $db
     */
    public function __construct(JDatabaseDriver $db)
    {
        $this->db = $db;
    }

    protected function getQuery()
    {
        $query = $this->db->getQuery(true);

        $query
            ->select("a.id, a.uri")
            ->from($this->db->quoteName("#__itpm_urls", "a"));

        return $query;
    }

    abstract public function load();
}
