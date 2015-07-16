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
 * Url controller class.
 *
 * @package        ITPMeta
 * @subpackage     Component
 * @since          1.6
 */
class ItpMetaControllerUrl extends Prism\Controller\Form\Backend
{
    public function save($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Gets the data from the form
        $data   = $this->input->post->get('jform', array(), 'array');
        $itemId = JArrayHelper::getValue($data, "id", 0, "int");

        $redirectData = array(
            "task" => $this->getTask(),
            "id"   => $itemId
        );

        $model = $this->getModel();

        // Validate the posted data.
        // Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($data, false);
        /** @var $form JForm * */

        if (!$form) {
            throw new Exception($model->getError());
        }

        // Test if the data is valid.
        $validData = $model->validate($form, $data);
        $itemId    = JArrayHelper::getValue($validData, "id");

        // Check for validation errors.
        if ($validData === false) {
            $this->displayNotice($form->getErrors(), $redirectData);

            return;
        }

        // Check for existing URI
        $uri = JArrayHelper::getValue($validData, "uri");
        if (!$itemId and $model->isUriExist($uri)) {
            $this->displayWarning(JText::_("COM_ITPMETA_ERROR_URI_EXISTS"), array("view" => $this->view_list));

            return;
        }

        // Fix magic quotes
        if (get_magic_quotes_gpc()) {
            $validData["after_body_tag"]  = stripslashes($validData["after_body_tag"]);
            $validData["before_body_tag"] = stripslashes($validData["before_body_tag"]);
        }

        try {

            $itemId             = $model->save($validData);
            $redirectData["id"] = $itemId;

        } catch (Exception $e) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $this->displayMessage(JText::_('COM_ITPMETA_URL_SAVED'), $redirectData);
    }
}
