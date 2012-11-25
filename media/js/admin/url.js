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
        if (task == 'url.cancel' || document.formvalidator.isValid(document.id('url-form'))) {
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
			
			// Get title and code from tag attributes
			var tagTitle = this.get("data-tag-title");
			var tagType  = this.get("data-tag");
			
			// Load the form that we use to add tags
			new Request.HTML({
				url: "index.php?option=com_itpmeta&view=tag&tmpl=component&url_id="+urlId,
				update: "sq-box",
				onSuccess: function() {
					
					// Make tag field readonly
					document.id("jform_tag").set("readonly", "readonly");
					
					// Set the title
					document.id("jform_title").value = tagTitle;
	
					// Get the tag code
					var tag = getTag(tagType);
					document.id("jform_tag").value    = tag;
					document.id("jform_output").value = tag;
					document.id("jform_name").value   = tagType;
					
					// Cleare fields
					document.id("jform_content").value = "";
					
					// Set event to the content field
					document.id("jform_content").addEvent("keyup", function(event) {
						
						var tag       = document.id("jform_tag").value;
					    var output    = document.id("jform_output");
					    
					    var pattern   = new RegExp("{.*}");
					    var str       = new String(this.value);
					    output.value  = tag.replace(pattern, str.stripTags().clean());
					    
				    });
					
					// Set event to the button "Save"
					document.id("apply_btn").addEvent("click", function(event) {
						event.preventDefault();
						var close = false;
						Tags.saveTag(close);
						
				    });
					
					// Set event to the button "Save and close"
					document.id("save_btn").addEvent("click", function(event) {
						event.preventDefault();
						var close = true;
						Tags.saveTag(close);
				    });
					
					// Set event to the button "Close"
				    document.id("close_btn").addEvent("click", function(event) {
				    	SqueezeBox.close();
				    })
					
				    // Open the form in modal window
					SqueezeBox.open(document.id("sq-box"), {
						handler: 'adopt',
						onClose: function() {
							
							// Hide the form
							document.id("itpm-tags-form").hide();
							
							// Create a new element which is wrapper of the form
							// In this box, we put the form when we load it.
							var sqBox = new Element("div", {
								id: "sq-box"
							});
							
							// Some hacks to remove all elements and create a new wrapper
							document.id("itpm-tags-form").empty();
							document.id("itpm-tags-form").adopt(sqBox);
						},
						onOpen: function() {
							
							// Display the form
							document.id("itpm-tags-form").show();
						}
					}); 
					
				}
			}).get();
			 
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
						var icon = 'message_class_ok.png';
					} else {
						var icon = 'message_class_warning.png';
					}
					new Message({
						iconPath: '/media/com_itpmeta/images/',
						icon: icon,
						title: response.title,
						message: response.text
					}).say();
					
			    }
			});
		    
		    myRequest.send();
		    
		});
		
		// Assign modal box to tags list
	    document.id("itmp-tags-list").addEvent("click:relay(.itpm-url-tag)", function(event) {
	    	
	    	event.preventDefault();
	    	var url = document.id(this).get("href");
	
	    	// Load the form that we use to add tags
			new Request.HTML({
				url: url,
				update: "sq-box",
				onSuccess: function() {
					
					// Make tag field readonly
					document.id("jform_tag").set("readonly", "readonly");
					
					// Set event to the content field
					document.id("jform_content").addEvent("keyup", function(event) {
						
						var tag       = document.id("jform_tag").value;
					    var output    = document.id("jform_output");
					    
					    var pattern   = new RegExp("{.*}");
					    var str       = new String(this.value);
					    output.value  = tag.replace(pattern, str.stripTags().clean());
					    
				    });
					
					// Set event to the button "Save"
					document.id("apply_btn").addEvent("click", function(event) {
						event.preventDefault();
						var close = false;
						Tags.saveTag(close);
						
				    });
					
					// Set event to the button "Save and close"
					document.id("save_btn").addEvent("click", function(event) {
						event.preventDefault();
						var close = true;
						Tags.saveTag(close);
				    });
					
					// Set event to the button "Close"
				    document.id("close_btn").addEvent("click", function(event) {
				    	SqueezeBox.close();
				    })
					
				    // Open the form in modal window
					SqueezeBox.open(document.id("sq-box"), {
						handler: 'adopt',
						onClose: function() {
							
							// Hide the form
							document.id("itpm-tags-form").hide();
							
							// Create a new element which is wrapper of the form
							// In this box, we put the form when we load it.
							var sqBox = new Element("div", {
								id: "sq-box"
							});
							
							// Some hacks to remove all elements and create a new wrapper
							document.id("itpm-tags-form").empty();
							document.id("itpm-tags-form").adopt(sqBox);
						},
						onOpen: function() {
							
							// Display the form
							document.id("itpm-tags-form").show();
						}
					}); 
					
				}
			}).get(); 
			
	    });
	    
    }
});

/**
 * Tags object that contains methods used for tags 
 */
var Tags = {
	
	loadTags: function (urlId) {
		
		new Request.HTML({
			url: 'index.php?option=com_itpmeta&view=tags',
			format: "raw",
			update: "itmp-tags-list"
		}).get("url_id="+urlId);
		
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
			    	document.id("message_container").set("html", Joomla.JText._("ITP_ERROR_SYSTEM", "System error!"));
			    	document.id("message_style").set("class", "message error");
					document.id("system-message-container1").show();
			    }
			    
			}).send();
		    
		}
		
	}
}

