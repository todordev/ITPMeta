/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
*/

jQuery(document).ready(function() {
	
	// Inline edit
	
	jQuery.fn.editable.defaults.mode = 'inline';
	jQuery.fn.editableform.buttons   = '<button type="submit" class="editable-submit">ok</button> <button type="button" class="editable-cancel">cancel</button>';
	
	jQuery('.itpm-editable').editable({
        type: 'textarea',
        url: 'index.php?option=com_itpmeta&task=tag.saveAjax&format=raw',
        title: Joomla.JText._('COM_ITPMETA_EDIT_CONTENT'),
        ajaxOptions: {
            type: 'post',
            dataType: 'text json',
        },
        display: function(value, response) {
        	
        	jQuery(this).text(response.data.content);
        	
        },
        success: function(response, newValue) {
        	
        	if(!response.success) {
        		return response.text;
        	}
        	
        	jQuery("#itpmo"+response.data.id).text(response.data.output);
        	
        }
        
    });
	
});