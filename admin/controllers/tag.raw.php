<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

class ItpmetaControllerTag extends JControllerForm
{
    /**
     * Proxy for getModel.
     *
     * @param string $name
     * @param string $prefix
     * @param array $config
     *
     * @return ItpmetaModelTag
     * @since    1.6
     */
    public function getModel($name = 'Tag', $prefix = 'ItpmetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    public function saveAjax()
    {
        $app     = JFactory::getApplication();

        // Get the data from the form
        $itemId  = $this->input->post->get('pk', 0, 'uint');
        $content = $this->input->post->get('value', '', 'raw');

        // Decode the content if there are encoded symbols.
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');

        // Encode the content.
        $content = htmlentities($content, ENT_QUOTES, 'UTF-8');

        $response = new Prism\Response\Json();

        $model = $this->getModel();
        /** @var ItpmetaModelTag $model */

        if (!$itemId or !$content) {
            $response
                ->setTitle(JText::_('COM_ITPMETA_FAIL'))
                ->setText(JText::_('COM_ITPMETA_ERROR_SYSTEM'))
                ->failure();

            echo $response;
            $app->close();
        }

        try {
            $data = $model->saveAjax($itemId, $content);
        } catch (Exception $e) {
            JLog::add($e->getMessage(), JLog::ERROR, 'com_itpmeta');
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $response
            ->setTitle(JText::_('COM_ITPMETA_SUCCESS'))
            ->setText(JText::_('COM_ITPMETA_TAG_SAVED'))
            ->setData($data)
            ->success();

        echo $response;
        $app->close();
    }
}
