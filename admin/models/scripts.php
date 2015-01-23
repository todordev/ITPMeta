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

class ItpMetaModelScripts extends JModelAdmin
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
     * Stock method to auto-populate the model state.
     * @return  void
     * @since   12.2
     */
    protected function populateState()
    {
        parent::populateState();

        $app = JFactory::getApplication();
        /** @var $app JApplicationAdministrator * */

        $value = $app->getUserState("url.id");
        $this->setState($this->getName() . '.id', $value);
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
        $form = $this->loadForm($this->option . '.scripts', 'scripts', array('control' => 'jform', 'load_data' => $loadData));
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
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.scripts.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    /**
     * Save an item.
     *
     * @param array $data All data for the category in an array.
     *
     * @return int
     */
    public function save($data)
    {
        $id         = JArrayHelper::getValue($data, "id", null);
        $afterBody  = JArrayHelper::getValue($data, "after_body_tag");
        $beforeBody = JArrayHelper::getValue($data, "before_body_tag");

        if (!$afterBody) {
            $afterBody = null;
        }
        if (!$beforeBody) {
            $beforeBody = null;
        }

        // Load item data
        $row = $this->getTable();
        $row->load($id);

        $row->set("after_body_tag", $afterBody);
        $row->set("before_body_tag", $beforeBody);

        $row->store(true);

        return $row->get("id");
    }
}
