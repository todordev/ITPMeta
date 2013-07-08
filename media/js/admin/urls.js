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
	
	jQuery("#adminForm").on("click", ".js-btn-tags-list", function(event){
		
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
	
	jQuery("#js-tags-list-close-btn").on("click", function(event){
		jQuery('#js-tags-list-modal').modal('hide');
	});
});