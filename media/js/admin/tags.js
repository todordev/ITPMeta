/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

jQuery(document).ready(function() {
	
	// Inline edit
	
	jQuery.fn.editable.defaults.mode = 'popup';

	jQuery('.itpm-editable').editable({
        type: 'textarea',
        url: 'index.php?option=com_itpmeta&task=tag.saveAjax&format=raw',
        title: Joomla.JText._('COM_ITPMETA_EDIT_CONTENT'),
        ajaxOptions: {
            type: 'post',
            dataType: 'text json'
        },
        display: function(value, response) {

            if (response && response.success) {
                jQuery(this).text(response.data.content);
            }
        	
        },
        success: function(response) {
        	
        	if (response.success) {

                jQuery("#itpmo"+response.data.id).text(response.data.output);

                PrismUIHelper.displayMessageSuccess(response.title, response.text);

                if (response.data.autoupdate) {
                    PrismUIHelper.displayMessageInfo(Joomla.JText._('COM_ITPMETA_ADDITIONAL_INFORMATION'), Joomla.JText._('COM_ITPMETA_INFO_DISABLE_AUTOUPDATE'));
                }

            }

        }
        
    });
	
});