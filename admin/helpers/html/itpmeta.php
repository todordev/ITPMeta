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

/**
 * ITPMeta Html Helper
 *
 * @package        ITPrism Components
 * @subpackage     ITPMeta
 * @since          1.6
 */
abstract class JHtmlItpMeta
{
    /**
     * Returns an array of standard published state filter options.
     *
     * @param   array $config   An array of configuration options.
     *                          This array can contain a list of key/value pairs where values are boolean
     *                          and keys can be taken from 'enabled', 'disabled', 'all'.
     *                          These pairs determine which values are displayed.
     *
     * @return  string  The HTML code for the select tag
     *
     * @since   11.1
     */
    public static function enabledOptions($config = array())
    {
        // Build the active state filter options.
        $options = array();
        if (!array_key_exists('enabled', $config) || $config['enabled']) {
            $options[] = JHtml::_('select.option', '1', 'JENABLED');
        }
        if (!array_key_exists('disabled', $config) || $config['disabled']) {
            $options[] = JHtml::_('select.option', '0', 'JDISABLED');
        }
        if (!array_key_exists('all', $config) || $config['all']) {
            $options[] = JHtml::_('select.option', '*', 'JALL');
        }

        return $options;
    }

    public static function autoupdateState($state, $i)
    {
        switch ($state) {
            case 1:
                $text  = JText::_("COM_ITPMETA_DISABLE_AUTOUPDATE");
                $task  = "urls.disableau";
                $class = "publish";
                break;

            default:
                $text  = JText::_("COM_ITPMETA_ENABLE_AUTOUPDATE");
                $task  = "urls.enableau";
                $class = "unpublish";
                break;
        }

        $html[] = '<a class="btn btn-micro active"';
        $html[] = ' href="javascript:void(0);" onclick="return listItemTask(\'cb' . $i . '\',\'' . $task . '\')"';
        $html[] = ' title="' . addslashes(htmlspecialchars($text, ENT_COMPAT, 'UTF-8')) . '">';
        $html[] = '<i class="icon-' . $class . '"></i>';
        $html[] = '</a>';

        return implode($html);
    }

    public static function sort($title, $order, $direction = 'asc', $selected = 0, $task = null, $new_direction = 'asc', $tip = '', $form = "")
    {
        JHtml::_('behavior.tooltip');

        $direction = strtolower($direction);
        $icon      = array('arrow-up-3', 'arrow-down-3');
        $index     = (int)($direction == 'desc');

        if ($order != $selected) {
            $direction = $new_direction;
        } else {
            $direction = ($direction == 'desc') ? 'asc' : 'desc';
        }

        $html = '<a href="#" onclick="Joomla.tableOrdering(\'' . $order . '\',\'' . $direction . '\',\'' . $task . '\'';

        if (!empty($form)) {
            $html .= ",document.getElementById('" . $form . "')";
        }

        $html .= ');return false;" class="hasTip" title="' . JText::_($tip ? $tip : $title) . '::' . JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN') . '">';

        $html .= JText::_($title);

        if ($order == $selected) {
            $html .= ' <i class="icon-' . $icon[$index] . '"></i>';
        }

        $html .= '</a>';

        return $html;
    }
}
