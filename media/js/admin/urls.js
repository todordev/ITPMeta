/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
*/

window.addEvent('domready', function() {
	
	// Set default options of the modal box
    SqueezeBox.initialize({
    	size: {x: 600, y: 400}
    });
	
    document.id("adminForm").addEvent("click:relay(.itpm-tags-preview)", function(event) {
    	
    	event.preventDefault();
    	
    	var url = document.id(this).get("href");
    	
	    // Load the form that we use to add tags
		new Request.HTML({
			url: url,
			update: "sq-box",
			onSuccess: function() {
				
			    // Open the form in modal window
				SqueezeBox.open(document.id("sq-box"), {
					handler: 'adopt',
					onClose: function() {
						
						// Hide the form
						document.id("itpm-tags-list").hide();
						
						// Create a new element which is wrapper of the form
						// In this box, we put the form when we load it.
						var sqBox = new Element("div", {
							id: "sq-box"
						});
						
						// Some hacks to remove all elements and create a new wrapper
						document.id("itpm-tags-list").empty();
						document.id("itpm-tags-list").adopt(sqBox);
					},
					onOpen: function() {
						
						// Display the form
						document.id("itpm-tags-list").show();
					}
				}); 
				
			}
		}).get();
		
    });
	
});

