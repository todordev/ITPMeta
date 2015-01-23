<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

class ItpMetaModelUrls extends JModelList
{
    /**
     * Constructor.
     *
     * @param   array   $config An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'uri', 'a.uri',
                'autoupdate', 'a.autoupdate',
                'published', 'a.published'
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param string $ordering
     * @param string $direction
     *
     * @since   1.6
     */
    protected function populateState($ordering = null, $direction = null)
    {
        // Load the filter state.
        $value = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $value);

        $value = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
        $this->setState('filter.state', $value);

        $value = $this->getUserStateFromRequest($this->context . '.filter.autoupdate', 'filter_autoupdate', '', 'string');
        $this->setState('filter.autoupdate', $value);

        // Load the parameters.
        $params = JComponentHelper::getParams('com_itpmeta');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.id', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string $id A prefix for the store id.
     *
     * @return  string      A store id.
     * @since   1.6
     */
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.state');
        $id .= ':' . $this->getState('filter.autoupdate');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  JDatabaseQuery
     * @since   1.6
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db    = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                'a.id, a.uri, a.published, a.autoupdate'
            )
        );
        $query->from($db->quoteName("#__itpm_urls", "a"));

        // Filter by state
        $published = $this->getState('filter.state');
        if (is_numeric($published)) {
            $query->where('a.published = ' . (int)$published);
        } elseif ($published === '') {
            $query->where('(a.published IN (0, 1))');
        }

        // Filter by Autoupdate state
        $autoupdate = $this->getState('filter.autoupdate');
        if (is_numeric($autoupdate)) {
            $query->where('a.autoupdate = ' . (int)$autoupdate);
        } elseif ($autoupdate === '') {
            $query->where('(a.autoupdate IN (0, 1))');
        }

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int)substr($search, 3));
            } else {
                $search = $db->quote('%' . $db->escape($search, true) . '%');
                $query->where('(a.uri LIKE ' . $search . ')');
            }
        }

        // Add the list ordering clause.
        $orderString = $this->getOrderString();
        $query->order($db->escape($orderString));

        return $query;
    }

    public function getNumbers()
    {
        // Get a storage key.
        $storeNumbers = $this->getStoreId("numbers");

        // Try to load the data from internal storage.
        if (isset($this->cache[$storeNumbers])) {
            return $this->cache[$storeNumbers];
        }

        // Get a storage key for current items
        $storeData = $this->getStoreId();

        // Try to load the data from internal storage.
        if (isset($this->cache[$storeData])) {
            $data = $this->cache[$storeData];
        } else {
            $data = $this->getItems();
        }

        $itemsIds = array();
        foreach ($data as $item) {
            $itemsIds[] = $item->id;
        }

        // Get the number of projects in categories
        $results = array();
        if (!empty($itemsIds)) {
            $db    = JFactory::getDbo();
            $query = $db->getQuery(true);

            $query
                ->select("a.url_id, COUNT(*) AS number")
                ->from($db->quoteName("#__itpm_tags", "a"))
                ->where("a.url_id IN (" . implode(",", $itemsIds) . ")")
                ->group("a.url_id");

            $db->setQuery($query);
            $results = $db->loadAssocList("url_id", "number");

            if (!$results) {
                $results = array();
            }
        }

        // Add the items to the internal cache.
        $this->cache[$storeNumbers] = $results;

        return $this->cache[$storeNumbers];
    }

    protected function getOrderString()
    {
        $orderCol  = $this->getState('list.ordering');
        $orderDirn = $this->getState('list.direction');

        return $orderCol . ' ' . $orderDirn;
    }
}
