<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class ItpmetaModelGlobal extends JModelAdmin
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
    public function getTable($type = 'global', $prefix = 'ItpmetaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param   array   $data     An optional array of data for the form to interogate.
     * @param   boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return  JForm   A JForm object on success, false on failure
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm($this->option.'.global', 'global', array('control' => 'jform', 'load_data' => $loadData));
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
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.global.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }


    /**
     * Save an item.
     *
     * @param array $data   All data for the category in an array
     *
     * @return int
     *
     */
    public function save($data)
    {
        $id        = Joomla\Utilities\ArrayHelper::getValue($data, 'id', 0, 'int');
        $name      = Joomla\Utilities\ArrayHelper::getValue($data, 'name', '');
        $type      = Joomla\Utilities\ArrayHelper::getValue($data, 'type', '');
        $title     = Joomla\Utilities\ArrayHelper::getValue($data, 'title', '');
        $tag       = Joomla\Utilities\ArrayHelper::getValue($data, 'tag', '');
        $content   = Joomla\Utilities\ArrayHelper::getValue($data, 'content', '');
        $output    = Joomla\Utilities\ArrayHelper::getValue($data, 'output', '');
        $published = Joomla\Utilities\ArrayHelper::getValue($data, 'published', 0, 'int');

        // Load item data
        $row = $this->getTable();
        $row->load($id);

        $row->set('title', $title);
        $row->set('name', $name);
        $row->set('type', $type);
        $row->set('tag', $tag);
        $row->set('content', $content);
        $row->set('output', $output);
        $row->set('published', $published);

        // Prepare the row for saving
        $this->prepareTable($row);

        $row->store();

        return $row->get('id');
    }

    protected function prepareTable($table)
    {
        // get maximum order number
        if ((int)$table->get('id') > 0 and !$table->get('ordering')) {
            $db    = $this->getDbo();
            $query = $db->getQuery(true);
            $query
                ->select('MAX(a.ordering)')
                ->from($db->quoteName('#__itpm_global_tags', 'a'));

            $db->setQuery($query, 0, 1);
            $max = $db->loadResult();

            $table->set('ordering', $max + 1);
        }
    }
}
