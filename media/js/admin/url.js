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
	// Verify URL data when submit the form
	Joomla.submitbutton = function(task) {
		
		if (task == 'url.scritps') {
			ItpMetaHelper.displayScriptsForm();
        } else if (task == 'url.cancel' || document.formvalidator.isValid(document.id('url-form'))) {
            Joomla.submitform(task, document.getElementById('url-form'));
        }
        
    }
	
	var itmpTags = document.id("itmp-tags");
    
    if(itmpTags) {
    	
		// Load tags of the URL
		var urlId = document.id("jform_id").get("value");
		if(urlId) {
			Tags.loadTags(urlId);
		}
		
		// Set default options of the modal box
	    SqueezeBox.initialize({
	    	size: {x: 600, y: 600}
	    });
    
	    // Set events to the tag buttons
		document.id("itmp-tags").addEvent("click:relay(.itp-tag-btn)", function(event){
			
			event.preventDefault();
			
			// Get the URL ID
			var urlId = document.id("jform_id").get("value");
			
			var url   = "index.php?option=com_itpmeta&view=tag&tmpl=component&url_id="+urlId;
	    	
	    	var options = {
    			url		 : url,
    			url_id   : urlId,
	    		tag_title: this.get("data-tag-title"),
	    		tag_type : this.get("data-tag")
	    	};
	    	
	    	ItpMetaHelper.displayTagForm(options); 
			 
		});
	
		// Set events to the buttons that remove tags
		document.id("itmp-tags-list").addEvent("click:relay(.remove_tag)", function(event) {
			
			var tagId = document.id(this).get("data-tag-id");
			var fields = "id="+tagId;
			
			// remove the tag
		    var myRequest = new Request({
			    url: "index.php?option=com_itpmeta&task=tag.remove",
			    method: "post",
			    format: "raw",
			    data: fields,
			    onSuccess: function(responseText){
			    	
			    	// Hide ajax loader
			    	var response = JSON.decode(responseText);
			    	if(response.success) {
			    		document.id("itpmtag_"+response.data.item_id).destroy();
						ItpMetaHelper.displayMessageSuccess(response.title, response.text);
					} else {
						ItpMetaHelper.displayMessageFailure(response.title, response.text);
					}
					
			    }
			});
		    
		    myRequest.send();
		    
		});
		
		// Assign modal box to tags list
	    document.id("itmp-tags-list").addEvent("click:relay(.itpm-url-tag)", function(event) {
	    	
	    	event.preventDefault();
	    	var tagId = document.id(this).get("data-tag-id");
	    	var url   = "index.php?option=com_itpmeta&view=tag&tmpl=component&id="+tagId;
	    	
	    	var options = {
	    		url: url,
	    		tag_id: tagId
	    	};
	    	
	    	ItpMetaHelper.displayTagForm(options); 
			
	    });
	    
    }
    
});


/**
 * Tags object that contains methods used for tags 
 */
var Tags = {
	
	loadTags: function (urlId) {
		
		jQuery("#itmp-tags-list").load("index.php?option=com_itpmeta&view=tags&format=raw&url_id="+urlId, 
			function(responseText, textStatus, XMLHttpRequest) {
			
				jQuery( "#itpm-tags-table tbody" ).tableDnD({
					dragHandle: ".dragHandle",
					serializeParamName: "order",
					onDrop: function(table, row) {
			            
			            var fields = jQuery.tableDnD.serialize();
			            
			            jQuery.ajax({
		            	  type: "POST",
		            	  url:  "index.php?option=com_itpmeta&task=tags.saveorder&format=raw",
		            	  data: fields
		            	});
			            
			        },
				});
				
			}
		);
		
	},
	
	saveTag: function ( close ) {
		
		var form   = document.id('tag-form');
		
		if(document.formvalidator.isValid(form)) {
			
			document.id("task").set("value", "tag.apply");
			var url    = form.get("action");
			var fields = form.toQueryString();
			
			// Save the tag
		    new Request({
			    url: url,
			    method: "post",
			    format: "raw",
			    data: fields,
			    onRequest: function() {
			    	// Hide ajax loader
			    	document.id("ajax_loader").show();
			    	
			    	// Hide and clear the system message
			    	document.id("system-message-container1").hide();
			    	document.id("message_container").set("html", "");
			    },
			    onSuccess: function(responseText){
			    	
			    	// Hide ajax loader
			    	document.id("ajax_loader").hide();
			    	
			    	// Parse response
			    	var response = JSON.decode(responseText);
			    	
			    	// Set message to the message box
			    	document.id("message_container").set("html", response.text);
			    	
			    	if(response.success) {
			    		
			    		// Set message type - success. Display the message.
			    		document.id("message_style").set("class", "message message");
						document.id("system-message-container1").show();
						
						// Set the tag ID to the form field
				    	document.id("jform_tag_id").value = response.data.item_id;
				    	
				    	// Load all tags
					    Tags.loadTags(response.data.url_id);
					    
					    // Close modal box
					    if(close) {
					    	SqueezeBox.close();
					    }
					    
					} else {
						// Set message type - error. Display the message.
						document.id("message_style").set("class", "message error");
						document.id("system-message-container1").show();
					}
					
			    },
			    onFailure: function(xhr) {
			    	
			    	// Prepare error message and display it.
			    	document.id("message_container").set("html", Joomla.JText._("COM_ITPMETA_ERROR_SYSTEM", "System error!"));
			    	document.id("message_style").set("class", "message error");
					document.id("system-message-container1").show();
			    }
			    
			}).send();
		    
		}
		
	}
}

