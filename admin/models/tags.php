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

class ItpMetaModelTags extends JModelList
{
    /**
     * Constructor.
     *
     * @param   array  $config An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'title', 'a.title',
                'ordering', 'a.ordering'
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
        $app = JFactory::getApplication();
        /* @var $app JApplicationAdministrator */

        // Load the parameters.
        $params = JComponentHelper::getParams('com_itpmeta');
        $this->setState('params', $params);

        // URL ID
        $value = $app->getUserStateFromRequest("url.id", "id", 0, "int");
        $this->setState('filter.url_id', $value);

        // List state information.
        parent::populateState('a.ordering', 'asc');
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
        $id .= ':' . $this->getState('filter.url_id');

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
                'a.id, a.title, a.type, a.tag, a.content, a.output, a.ordering'
            )
        );
        $query->from($db->quoteName("#__itpm_tags", "a"));

        // Filter by URL ID
        $urlId = $this->getState('filter.url_id');
        $query->where('a.url_id = ' . (int)$urlId);

        // Add the list ordering clause.
        $orderString = $this->getOrderString();
        $query->order($db->escape($orderString));

        return $query;
    }

    protected function getOrderString()
    {
        $orderCol  = $this->getState('list.ordering');
        $orderDirn = $this->getState('list.direction');

        return $orderCol . ' ' . $orderDirn;
    }
}
