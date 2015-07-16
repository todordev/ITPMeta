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

class ItpMetaControllerTag extends JControllerForm
{
    /**
     * Proxy for getModel.
     *
     * @param string $name
     * @param string $prefix
     * @param array $config
     *
     * @return ItpMetaModelTag
     * @since    1.6
     */
    public function getModel($name = 'Tag', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    public function saveAjax()
    {
        // Get the data from the form
        $itemId  = $this->input->post->get('pk', 0, 'uint');
        $content = $this->input->post->get('value', "", "raw");

        // Decode the content if there are encoded symbols.
        $content = html_entity_decode($content, ENT_QUOTES, "UTF-8");

        // Encode the content.
        $content = htmlentities($content, ENT_QUOTES, "UTF-8");

        // Fix Magic Quotes
        if (get_magic_quotes_gpc()) {
            $content = stripslashes($content);
        }

        $response = new Prism\Response\Json();

        $model = $this->getModel();

        if (!$itemId or !$content) {

            $response
                ->setTitle(JText::_('COM_ITPMETA_FAIL'))
                ->setText(JText::_('COM_ITPMETA_ERROR_SYSTEM'))
                ->failure();

            echo $response;
            JFactory::getApplication()->close();
        }

        // Save the item
        try {
            $data = $model->saveAjax($itemId, $content);
        } catch (Exception $e) {
            JLog::add($e->getMessage());
            throw new Exception(JText::_('COM_ITPMETA_ERROR_SYSTEM'));
        }

        $response
            ->setTitle(JText::_('COM_ITPMETA_SUCCESS'))
            ->setText(JText::_('COM_ITPMETA_TAG_SAVED'))
            ->setData($data)
            ->success();

        echo $response;
        JFactory::getApplication()->close();
    }
}
