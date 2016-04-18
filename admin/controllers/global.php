<?php
/**
 * @package      ITPMeta
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Global Tag controller class.
 *
 * @package       ITPMeta
 * @subpackage    Components
 * @since         1.6
 */
class ItpmetaControllerGlobal extends Prism\Controller\Form\Backend
{
    public function save($key = null, $urlVar = null)
    {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Gets the data from the form
        $data   = $this->input->post->get('jform', array(), 'array');
        $itemId = Joomla\Utilities\ArrayHelper::getValue($data, 'id', 0, 'int');

        $redirectData = array(
            'task' => $this->getTask(),
            'id'   => $itemId
        );

        $model = $this->getModel();

        // Validate the posted data.
        // Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($data, false);
        /* @var $form JForm */

        if (!$form) {
            throw new Exception(JText::_('COM_ITPMETA_ERROR_FORM_CANNOT_BE_LOADED'));
        }

        // Test if the data is valid.
        $validData = $model->validate($form, $data);

        // Check for validation errors.
        if ($validData === false) {
            $this->displayNotice($form->getErrors(), $redirectData);
            return;
        }

        try {
            $itemId             = $model->save($validData);
            $redirectData['id'] = $itemId;
        } catch (Exception $e) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $this->displayMessage(JText::_('COM_ITPMETA_GLOBAL_TAG_SAVED'), $redirectData);
    }
}
