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
 * Tags Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
 */
class ItpMetaControllerTags extends Prism\Controller\Admin
{
    public function getModel($name = 'Tag', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    /**
     * Remove an item.
     *
     * @throws  Exception
     * @return  void
     *
     * @since   12.2
     */
    public function delete()
    {
        // Check for request forgeries
        JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));

        $app = JFactory::getApplication();
        /* @var $app JApplicationAdministrator */

        // Gets the data from the form
        $cid = $this->input->post->get('cid', array(), 'array');
        $cid = Joomla\Utilities\ArrayHelper::toInteger($cid);

        $urlId = $app->getUserState("url.id");

        $redirectData = array(
            "view"   => "url",
            "layout" => "edit",
            "id"     => $urlId
        );

        if (!$cid) {
            $this->displayWarning(JText::_("COM_ITPMETA_ERROR_INVALID_ITEMS"), $redirectData);

            return;
        }

        try {

            $model = $this->getModel();
            $model->delete($cid);

        } catch (Exception $e) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $msg = JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($cid));
        $this->displayMessage($msg, $redirectData);
    }
}
