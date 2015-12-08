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

class ItpMetaModelTag extends JModelAdmin
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
    public function getTable($type = 'Tag', $prefix = 'ItpMetaTable', $config = array())
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

        $value = $app->getUserStateFromRequest("url.id", "url_id");
        $this->setState($this->getName() . '.url_id', $value);
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
        $form = $this->loadForm($this->option . '.tag', 'tag', array('control' => 'jform', 'load_data' => $loadData));
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
        $app = JFactory::getApplication();
        /** @var $app JApplicationAdministrator * */

        // Check the session for previously entered form data.
        $data = $app->getUserState($this->option . '.edit.tag.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }

        // Set URL id
        if (empty($data->url_id)) {
            $data->url_id = $this->getState($this->getName() . ".url_id", 0);
        }

        return $data;
    }

    /**
     * Save an item
     *
     * @param array $data    All data for the category in an array.
     *
     * @return int
     */
    public function save($data)
    {
        $id      = JArrayHelper::getValue($data, "id");
        $name    = JArrayHelper::getValue($data, "name");
        $type    = JArrayHelper::getValue($data, "type");
        $title   = JArrayHelper::getValue($data, "title");
        $tag     = JArrayHelper::getValue($data, "tag");
        $content = JArrayHelper::getValue($data, "content");
        $output  = JArrayHelper::getValue($data, "output");
        $urlId   = JArrayHelper::getValue($data, "url_id");

        // Load item data
        $row = $this->getTable();
        $row->load($id);

        // Disable auto-update if there is a difference
        // between new and old values.
        $this->disableAutoupdate($row, $title, $content);

        // Save new data
        $row->set("title", $title);
        $row->set("name", $name);
        $row->set("type", $type);
        $row->set("tag", $tag);
        $row->set("content", $content);
        $row->set("output", $output);
        $row->set("url_id", $urlId);

        // Prepare the row for saving
        $this->prepareTable($row);

        $row->store();

        return $row->get("id");
    }

    /**
     * Prepare and sanitise the table prior to saving.
     *
     * @param JTable $table
     *
     * @since    1.6
     */
    protected function prepareTable($table)
    {
        // get maximum order number
        if (!$table->get("id")) {

            // Set ordering to the last item if not set
            if (!$table->get("ordering")) {
                $db    = $this->getDbo();
                $query = $db->getQuery(true);

                $query
                    ->select("MAX(a.ordering)")
                    ->from($db->quoteName("#__itpm_tags", "a"))
                    ->where("a.url_id =" . (int)$table->get("url_id"));

                $db->setQuery($query, 0, 1);
                $max = $db->loadResult();

                $table->set("ordering", $max + 1);
            }
        }

    }

    /**
     * Disable auto update if user edit the tag content.
     *
     * @param object $table
     * @param string $title
     * @param string $content
     */
    protected function disableAutoupdate($table, $title, $content)
    {
        if (!empty($table->id)) {

            $urlTable = $this->getTable("Url");
            $urlTable->load($table->url_id);

            if ($urlTable->get("autoupdate")) {

                if ((strcmp($title, $table->title) != 0) or (strcmp($content, $table->content) != 0)) {
                    $urlTable->set("autoupdate", Itpmeta\Constants::AUTOUPDATE_DISABLED);
                    $urlTable->store();

                    $app = JFactory::getApplication();
                    /* @var $app JApplicationAdministrator */

                    $app->enqueueMessage(JText::_("COM_ITPMETA_AUTOUPDATE_DISABLED"), "notice");
                }

            }
        }
    }

    /**
     * A protected method to get a set of ordering conditions.
     *
     * @param    object    $table A record object.
     *
     * @return    array    An array of conditions to add to add to ordering queries.
     * @since    1.6
     */
    protected function getReorderConditions($table)
    {
        $condition   = array();
        $condition[] = 'url_id = ' . (int)$table->get("url_id");

        return $condition;
    }

    /**
     * Delete tags based on URL id
     *
     * @param array $pks URLs ids
     */
    public function deleteByUrlId(&$pks)
    {
        $pks = Joomla\Utilities\ArrayHelper::toInteger($pks);

        if (!empty($pks)) {

            $db = $this->getDbo();
            /* @var $db JDatabaseDriver */

            $query = $db->getQuery(true);

            // Select the required fields from the table.
            $query
                ->delete()
                ->from($db->quoteName('#__itpm_tags'))
                ->where($db->quoteName('url_id') . ' IN (' . implode(",", $pks) . ')');

            $db->setQuery($query);
            $db->execute();
        }
    }

    /**
     * This method saves the content and
     * it is used from "inline" editing by AJAX.
     *
     * @param integer $itemId
     * @param string  $content
     *
     * @return object
     */
    public function saveAjax($itemId, $content)
    {
        $tag = new Itpmeta\Tag\Tag(JFactory::getDbo());
        $tag->load(array('id' => $itemId));

        if (!$tag->getId()) {
            return null;
        }

        $tag->setContent($content);
        $tag->store();

        // Prepare result that will be returned
        $result          = new stdClass();
        $result->id      = $tag->getId();
        $result->content = $tag->getContent();
        $result->output  = $tag->getOutput();

        // Get URL.
        $uri = new Itpmeta\Url\Uri(JFactory::getDbo());
        $uri->load(array('uri_id' => $tag->getUrlId()));

        $result->autoupdate = $uri->isAutoupdate();

        return $result;
    }
}
