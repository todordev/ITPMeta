<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Scripts controller class.
 *
 * @package        ITPMeta
 * @subpackage     Component
 * @since          1.6
 */
class ItpMetaControllerScripts extends Prism\Controller\Form\Backend
{
    public function save($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Gets the data from the form
        $data   = $this->input->post->get('jform', array(), 'array');
        $itemId = JArrayHelper::getValue($data, "id");
        $model  = $this->getModel();

        $redirectData = array(
            "task" => $this->getTask(),
            "id"   => $itemId
        );

        // Validate the posted data.
        // Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($data, false);
        /** @var $form JForm * */

        if (!$form) {
            throw new Exception($model->getError());
        }

        // Test if the data is valid.
        $validData = $model->validate($form, $data);

        // Fix magic quotes
        if (get_magic_quotes_gpc()) {
            $validData["after_body_tag"]  = stripslashes($validData["after_body_tag"]);
            $validData["before_body_tag"] = stripslashes($validData["before_body_tag"]);
        }

        try {
            $model->save($validData);
        } catch (Exception $e) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $this->displayMessage(JText::_('COM_ITPMETA_SCRIPTS_SAVED'), $redirectData);
    }

    /**
     *
     * Prepare redirect link.
     * If has clicked apply, will be redirected to edit form and will be loaded the item data
     * If has clicked save2new, will be redirected to edit form, and you will be able to add a new record
     * If has clicked save, will be redirected to the list of items
     *
     * @param array $data
     *
     * @return string
     */
    protected function prepareRedirectLink($data)
    {
        $task = $this->getTask();
        $link = $this->defaultLink;

        $itemId = JArrayHelper::getValue($data, "id");

        // Prepare redirection
        switch ($task) {
            case "apply":
                $link .= "&view=scripts&layout=edit";
                break;

            default:
                $link .= "&view=url&layout=edit&id=" . (int)$itemId;
                break;
        }

        return $link;
    }

    /**
     * Cancel operation
     */
    public function cancel($key = null)
    {
        $urlId = JFactory::getApplication()->getUserState("url.id", 0);
        $this->setRedirect(JRoute::_($this->defaultLink . "&view=url&layout=edit&id=" . $urlId, false));
    }
}
