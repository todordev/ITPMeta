<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITPMeta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;

/**
 * ITPMeta Html Helper
 *
 * @package		ITPrism Components
 * @subpackage	ITPMeta
 * @since		1.6
 */
abstract class JHtmlItpMeta {
    
	/**
	 * Returns an array of standard published state filter options.
	 *
	 * @param   array  $config  An array of configuration options.
	 *                          This array can contain a list of key/value pairs where values are boolean
	 *                          and keys can be taken from 'enabled', 'disabled', 'all'.
	 *                          These pairs determine which values are displayed.
	 *
	 * @return  string  The HTML code for the select tag
	 *
	 * @since   11.1
	 */
	public static function enabledOptions($config = array()) {
	    
		// Build the active state filter options.
		$options = array();
		if (!array_key_exists('enabled', $config) || $config['enabled'])
		{
			$options[] = JHtml::_('select.option', '1', 'JENABLED');
		}
		if (!array_key_exists('disabled', $config) || $config['disabled'])
		{
			$options[] = JHtml::_('select.option', '0', 'JDISABLED');
		}
		if (!array_key_exists('all', $config) || $config['all'])
		{
			$options[] = JHtml::_('select.option', '*', 'JALL');
		}
		return $options;
	}
	
    public static function autoupdateState($state, $i) {
		    
	    switch($state) {
	        case 1:
	            $text   = JText::_("COM_ITPMETA_DISABLE_AUTOUPDATE");
	            $task   = "urls.dautoupdate";
	            $class  = "publish";
	            break;

	        default:
	            $text   = JText::_("COM_ITPMETA_ENABLE_AUTOUPDATE");
	            $task   = "urls.eautoupdate";
	            $class  = "unpublish";
	            break;
	    }
	    
		$html[] = '<a class="jgrid"';
		$html[] = ' href="javascript:void(0);" onclick="return listItemTask(\'cb' . $i . '\',\'' . $task . '\')"';
		$html[] = ' title="' . addslashes(htmlspecialchars($text, ENT_COMPAT, 'UTF-8')) . '">';
		$html[] = '<span class="state '.$class.'">';
		$html[] = $text ? ('<span class="text">' . $text . '</span>') : '';
		$html[] = '</span>';
		$html[] = '</a>';
		
		return implode($html);
	}
	
	/**
	 * Method to sort a column in a grid
	 *
	 * @param   string  $title          The link title
	 * @param   string  $order          The order field for the column
	 * @param   string  $direction      The current direction
	 * @param   string  $selected       The selected ordering
	 * @param   string  $task           An optional task override
	 * @param   string  $new_direction  An optional direction for the new column
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public static function sort($title, $order, $direction = 'asc', $selected = 0, $task = null, $new_direction = 'asc', $form = "") {
	    
	    $direction = strtolower($direction);
	    $images = array('sort_asc.png', 'sort_desc.png');
	    $index = intval($direction == 'desc');
	
	    if ($order != $selected)
	    {
	        $direction = $new_direction;
	    }
	    else
	    {
	        $direction = ($direction == 'desc') ? 'asc' : 'desc';
	    }
	
	    $html = '<a href="#" onclick="Joomla.tableOrdering(\'' . $order . '\',\'' . $direction . '\',\'' . $task . '\'';
	    
	    if(!empty($form)) {
	        $html .= ", document.getElementById('".$form."')";
	    }
	    
	    $html .= ');return false;" title="'. JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN') . '">';
	    
	    $html .= JText::_($title);
	
	    if ($order == $selected)
	    {
	        $html .= JHtml::_('image', 'system/' . $images[$index], '', null, true);
	    }
	
	    $html .= '</a>';
	
	    return $html;
	}
	
	
	/**
	 * Return the icon to move an item UP.
	 *
	 * @param   integer  $i          The row index.
	 * @param   boolean  $condition  True to show the icon.
	 * @param   string   $task       The task to fire.
	 * @param   string   $alt        The image alternative text string.
	 * @param   boolean  $enabled    An optional setting for access control on the action.
	 * @param   string   $checkbox   An optional prefix for checkboxes.
	 *
	 * @return  string   Either the icon to move an item up or a space.
	 *
	 * @since   11.1
	 */
	public function orderUpIcon($i, $condition = true, $task = 'orderup', $alt = 'JLIB_HTML_MOVE_UP', $enabled = true, $limitStart) {
	    
	    if (($i > 0 || ($i + $limitStart > 0)) && $condition) {
	        return self::orderUp($i, $task, '', $alt, $enabled, "cb");
	    } else {
	        return '&#160;';
	    }
	}
	
	/**
	 * Return the icon to move an item DOWN.
	 *
	 * @param   integer  $i          The row index.
	 * @param   integer  $n          The number of items in the list.
	 * @param   boolean  $condition  True to show the icon.
	 * @param   string   $task       The task to fire.
	 * @param   string   $alt        The image alternative text string.
	 * @param   boolean  $enabled    An optional setting for access control on the action.
	 * @param   string   $checkbox   An optional prefix for checkboxes.
	 *
	 * @return  string   Either the icon to move an item down or a space.
	 *
	 * @since   11.1
	 */
	public function orderDownIcon($i, $condition = true, $task = 'orderdown', $alt = 'JLIB_HTML_MOVE_DOWN', $enabled = true, $limitStart, $total) {
	    
	    if (($i < $total - 1 || $i + $limitStart < $total - 1) && $condition) {
	        return self::orderDown($i, $task, '', $alt, $enabled, "cb");
	    } else {
	        return '&#160;';
	    }
	}
	
	
	/**
	 * Creates a order-up action icon.
	 *
	 * @param   integer       $i         The row index.
	 * @param   string        $task      An optional task to fire.
	 * @param   string|array  $prefix    An optional task prefix or an array of options
	 * @param   string        $text      An optional text to display
	 * @param   boolean       $enabled   An optional setting for access control on the action.
	 * @param   string        $checkbox  An optional prefix for checkboxes.
	 *
	 * @return  string  The required HTML.
	 *
	 * @since   11.1
	 */
	public static function orderUp($i, $task = 'orderup', $prefix = '', $text = 'JLIB_HTML_MOVE_UP', $enabled = true, $checkbox = 'cb')
	{
	    if (is_array($prefix))
	    {
	        $options = $prefix;
	        $text = array_key_exists('text', $options) ? $options['text'] : $text;
	        $enabled = array_key_exists('enabled', $options) ? $options['enabled'] : $enabled;
	        $checkbox = array_key_exists('checkbox', $options) ? $options['checkbox'] : $checkbox;
	        $prefix = array_key_exists('prefix', $options) ? $options['prefix'] : '';
	    }
	    return self::action($i, $task, $prefix, $text, $text, $text, false, 'uparrow', 'uparrow_disabled', $enabled, true, $checkbox);
	}
	
	/**
	 * Creates a order-down action icon.
	 *
	 * @param   integer       $i         The row index.
	 * @param   string        $task      An optional task to fire.
	 * @param   string|array  $prefix    An optional task prefix or an array of options
	 * @param   string        $text      An optional text to display
	 * @param   boolean       $enabled   An optional setting for access control on the action.
	 * @param   string        $checkbox  An optional prefix for checkboxes.
	 *
	 * @return  string  The required HTML.
	 *
	 * @since   11.1
	 */
	public static function orderDown($i, $task = 'orderdown', $prefix = '', $text = 'JLIB_HTML_MOVE_DOWN', $enabled = true, $checkbox = 'cb')
	{
	    if (is_array($prefix))
	    {
	        $options = $prefix;
	        $text = array_key_exists('text', $options) ? $options['text'] : $text;
	        $enabled = array_key_exists('enabled', $options) ? $options['enabled'] : $enabled;
	        $checkbox = array_key_exists('checkbox', $options) ? $options['checkbox'] : $checkbox;
	        $prefix = array_key_exists('prefix', $options) ? $options['prefix'] : '';
	    }
	
	    return self::action($i, $task, $prefix, $text, $text, $text, false, 'downarrow', 'downarrow_disabled', $enabled, true, $checkbox);
	}
	
	
	/**
	 * Returns an action on a grid
	 *
	 * @param   integer       $i               The row index
	 * @param   string        $task            The task to fire
	 * @param   string|array  $prefix          An optional task prefix or an array of options
	 * @param   string        $text            An optional text to display
	 * @param   string        $active_title    An optional active tooltip to display if $enable is true
	 * @param   string        $inactive_title  An optional inactive tooltip to display if $enable is true
	 * @param   boolean       $tip             An optional setting for tooltip
	 * @param   string        $active_class    An optional active HTML class
	 * @param   string        $inactive_class  An optional inactive HTML class
	 * @param   boolean       $enabled         An optional setting for access control on the action.
	 * @param   boolean       $translate       An optional setting for translation.
	 * @param   string        $checkbox	       An optional prefix for checkboxes.
	 *
	 * @return string         The Html code
	 *
	 * @since   11.1
	 */
	public static function action($i, $task, $prefix = '', $text = '', $active_title = '', $inactive_title = '', $tip = false, $active_class = '',
	$inactive_class = '', $enabled = true, $translate = true, $checkbox = 'cb')
	{
	    if (is_array($prefix))
	    {
	        $options = $prefix;
	        $text = array_key_exists('text', $options) ? $options['text'] : $text;
	        $active_title = array_key_exists('active_title', $options) ? $options['active_title'] : $active_title;
	        $inactive_title = array_key_exists('inactive_title', $options) ? $options['inactive_title'] : $inactive_title;
	        $tip = array_key_exists('tip', $options) ? $options['tip'] : $tip;
	        $active_class = array_key_exists('active_class', $options) ? $options['active_class'] : $active_class;
	        $inactive_class = array_key_exists('inactive_class', $options) ? $options['inactive_class'] : $inactive_class;
	        $enabled = array_key_exists('enabled', $options) ? $options['enabled'] : $enabled;
	        $translate = array_key_exists('translate', $options) ? $options['translate'] : $translate;
	        $checkbox = array_key_exists('checkbox', $options) ? $options['checkbox'] : $checkbox;
	        $prefix = array_key_exists('prefix', $options) ? $options['prefix'] : '';
	    }
	    if ($tip)
	    {
	        JHtml::_('behavior.tooltip');
	    }
	    if ($enabled)
	    {
	        $html[] = '<a class="jgrid' . ($tip ? ' hasTip' : '') . '"';
	        $html[] = ' href="javascript:void(0);" onclick="return ItpMetaHelper.listItemTask(\'' . $checkbox . $i . '\',\'' . $prefix . $task . '\')"';
	        $html[] = ' title="' . addslashes(htmlspecialchars($translate ? JText::_($active_title) : $active_title, ENT_COMPAT, 'UTF-8')) . '">';
	        $html[] = '<span class="state ' . $active_class . '">';
	        $html[] = $text ? ('<span class="text">' . ($translate ? JText::_($text):$text) . '</span>') : '';
	        $html[] = '</span>';
	        $html[] = '</a>';
	    }
	    else
	    {
	        $html[] = '<a class="jgrid' . ($tip ? ' hasTip' : '') . '"';
	        $html[] = ' title="' . addslashes(htmlspecialchars($translate ? JText::_($inactive_title) : $inactive_title, ENT_COMPAT, 'UTF-8')) . '">';
	        $html[] = '<span class="state ' . $inactive_class . '">';
	        $html[] = $text ? ('<span class="text">' . ($translate ? JText::_($text) : $text) . '</span>') :'';
	        $html[] = '</span>';
	        $html[] = '</a>';
	    }
	    return implode($html);
	}
	
	/**
	 * Method to create an icon for saving a new ordering in a grid
	 *
	 * @param   array   $rows   The array of rows of rows
	 * @param   string  $image  The image
	 * @param   string  $task   The task to use, defaults to save order
	 *
	 * @return  string
	 *
	 * @since   11.1
	 */
	public static function order($rows, $image = 'filesave.png', $task = 'saveorder') {
	    
	    $href = '<a href="javascript:ItpMetaHelper.saveOrder(' . (count($rows) - 1) . ', \'' . $task . '\')" class="saveorder" title="'. JText::_('JLIB_HTML_SAVE_ORDER') . '"></a>';
	
	    return $href;
	}
	
}
