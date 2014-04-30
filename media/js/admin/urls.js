/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

jQuery(document).ready(function() {
	
	// Validation script
    Joomla.submitbutton = function(task){
    	
    	// Enable or Disable auto-update.
    	if (task == 'urls.enableau' || task == 'urls.disableau') {

    		if(!hasSelectedItems()) {
    			alert(Joomla.JText._("COM_ITPMETA_ERROR_NO_ITEM_SELECTED"));
    		} else {
    			Joomla.submitform(task, document.getElementById('adminForm'));
    		}
    		
    	// Submit form
        } else {
        	Joomla.submitform(task, document.getElementById('adminForm'));
        }
    	
    };
    
	jQuery("#urlsList").on("click", ".js-btn-tags-list", function(event){
		
		event.preventDefault();
		
		var url = jQuery(this).attr("href");
		
		jQuery.ajax({
			type: "GET",
			url: url,
			dataType: "text html"
		}).done(function(response){
			
			jQuery("#js-tags-list-body").html(response);
			jQuery('#js-tags-list-modal').modal('show');
			
		});
		
	});
	
	jQuery("#js-tags-list-close-btn").on("click", function(){
		jQuery('#js-tags-list-modal').modal('hide');
	});
	
	/**
     * Check for selected items.
     */
    function hasSelectedItems() {
    	
    	var hasSelectedItems = false;
    	
    	// Look for selected resources.
    	var checkBoxes  = jQuery("#adminForm").find("input:checkbox");
		jQuery.each(checkBoxes, function( index, value ) {
			
			if(jQuery(value).is(":checked")) {
				hasSelectedItems = true;
			}
			
		});
		
		return hasSelectedItems;
    }
    
});