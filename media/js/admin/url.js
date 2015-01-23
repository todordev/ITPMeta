/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev < http://itprism.com >. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

jQuery(document).ready(function() {
	
	// Verify URL data when submit the form
	Joomla.submitbutton = function(task) {
		if (task == 'url.cancel' || document.formvalidator.isValid(document.getElementById('url-form'))) {
            Joomla.submitform(task, document.getElementById('url-form'));
        }
    };
	
	/**
	 * Attach event to "Edit" button.
	 */
	jQuery("#js-btn-edit-tag").on("click", function(event){
		event.preventDefault();
	
		if (document.tagsForm.boxchecked.value == 0) {
			alert(Joomla.JText._("COM_ITPMETA_ERROR_MAKE_SELECTION"));
		} else { 
			
			var url = jQuery(this).attr("href");
			var itemIds = jQuery("#tagsForm").find(".tags-cid");
			
			var id = 0;
			
			jQuery.each(itemIds, function(index, value) {
				
				if(jQuery(value).is(":checked")) {
					id = jQuery(value).val();
					return false;
				}
			});
			
			if(id > 0) {
				window.location.href = url+"&id="+id;
			}
		}
		
	});
	
	/**
	 * Attach event to "Remove" button.
	 */
	jQuery("#js-btn-delete-tag").on("click", function(event){
		event.preventDefault();
	
		if (document.tagsForm.boxchecked.value == 0) {
			alert(Joomla.JText._("COM_ITPMETA_ERROR_MAKE_SELECTION"));
		} else { 
			
			if (confirm(Joomla.JText._("COM_ITPMETA_DELETE_ITEMS_QUESTION"))) {
				Joomla.submitform('tags.delete', document.getElementById('tagsForm'));
			}
		}
		
	});
});