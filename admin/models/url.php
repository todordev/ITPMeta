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

class ItpMetaModelUrl extends JModelAdmin
{
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param   string $type   The table type to instantiate
     * @param   string $prefix A prefix for the table class name. Optional.
     * @param   array  $config Configuration array for model. Optional.
     *
     * @return  JTable  A database object
     * @since   1.6
     */
    public function getTable($type = 'Url', $prefix = 'ItpMetaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param   array   $data     An optional array of data for the form to interrogate.
     * @param   boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return  JForm   A JForm object on success, false on failure
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm($this->option . '.url', 'url', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed   The data for the form.
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.url.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }


    /**
     * Save an item
     *
     * @param array $data All data for the category in an array
     *
     * @return int
     */
    public function save($data)
    {
        $id         = JArrayHelper::getValue($data, "id", null);
        $uri        = JArrayHelper::getValue($data, "uri", "");
        $published  = JArrayHelper::getValue($data, "published", 0);
        $autoupdate = JArrayHelper::getValue($data, "autoupdate", 0);

        // Load item data
        $row = $this->getTable();
        $row->load($id);

        $row->set("uri", $uri);
        $row->set("published", $published);
        $row->set("autoupdate", $autoupdate);

        $row->store();

        return $row->get("id");
    }

    public function isUriExist($uri)
    {
        $db = $this->getDbo();
        /* @var $db JDatabaseDriver */

        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query
            ->select('COUNT(*)')
            ->from($db->quoteName('#__itpm_urls', "a"))
            ->where('a.uri=' . $db->quote($uri));

        $db->setQuery($query, 0, 1);

        return (bool)$db->loadResult();
    }

    public function updateAutoupdate($pks, $state)
    {
        $pks = (array)$pks;
        $pks = Joomla\Utilities\ArrayHelper::toInteger($pks);

        $state = (!$state) ? 0 : 1;

        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->update($db->quoteName("#__itpm_urls", "a"))
            ->set("a.autoupdate = " . (int)$state)
            ->where("a.id IN (" . implode(",", $pks) . ")");

        $db->setQuery($query);
        $db->execute();

        return true;
    }
}
