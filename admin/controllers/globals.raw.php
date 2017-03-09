<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

/**
 * ITPMeta Global URLs Controller
 *
 * @package     ITPMeta
 * @subpackage  Component
 */
class ItpmetaControllerGlobals extends JControllerAdmin
{
    public function getModel($name = 'Global', $prefix = 'ItpmetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    /**
     * Method to save the submitted ordering values for records via AJAX.
     *
     * @throws  Exception
     * @since   3.0
     */
    public function saveOrderAjax()
    {
        $response = new Prism\Response\Json();

        // Get the input
        $pks   = $this->input->post->get('cid', array(), 'array');
        $order = $this->input->post->get('order', array(), 'array');

        // Sanitize the input
        $pks   = Joomla\Utilities\ArrayHelper::toInteger($pks);
        $order = Joomla\Utilities\ArrayHelper::toInteger($order);

        // Get the model
        $model = $this->getModel();
        /** @var ItpmetaModelGlobal $model */

        // Save the item
        try {
            $model->saveorder($pks, $order);
        } catch (Exception $e) {
            JLog::add($e->getMessage(), JLog::ERROR, 'com_itpmeta');
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $response
            ->success()
            ->setTitle(JText::_('COM_ITPMETA_SUCCESS'))
            ->setText(JText::_('JLIB_APPLICATION_SUCCESS_ORDERING_SAVED'));

        echo $response;
        JFactory::getApplication()->close();
    }
}
