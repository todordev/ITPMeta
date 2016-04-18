<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Tags Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
 */
class ItpmetaControllerTags extends JControllerAdmin
{
    public function getModel($name = 'Tag', $prefix = 'ItpmetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    /**
     * Method to save the submitted ordering values for records via AJAX.
     *
     * @throws  Exception
     * @return  void
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

        // Save the item
        try {
            $model->saveorder($pks, $order);
        } catch (Exception $e) {
            JLog::add($e->getMessage());
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
