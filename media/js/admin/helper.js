/**
 * JavaScript Helper
 */
var ItpMetaHelper = {
		
	displayMessageSuccess: function(title, text) {
		new Message({
			iconPath: '../media/com_vipportfolio/images/',
			icon: 'message_class_ok.png',
			title: title,
			message: text
		}).say();
	},
	displayMessageFailure: function(title, text) {
		new Message({
			iconPath: '../media/com_vipportfolio/images/',
			icon: 'message_class_warning.png',
			title: title,
			message: text
		}).say();
	},
	displayScriptsForm: function() {
		
		var itemId = document.id("jform_id").get("value");
		
		// Load the form that we use to add tags
		new Request.HTML({
			url: "index.php?option=com_itpmeta&view=scripts&tmpl=component&url_id="+itemId,
			update: "sq-scripts-box",
			onSuccess: function() {
					
				// Set event to the button "Save"
				document.id("apply_btn").addEvent("click", function(event) {
					event.preventDefault();
					var close = false;
					ItpMetaHelper.saveScripts(close);
					
			    });
				
				// Set event to the button "Save and close"
				document.id("save_btn").addEvent("click", function(event) {
					event.preventDefault();
					var close = true;
					ItpMetaHelper.saveScripts(close);
			    });
				
				// Set event to the button "Close"
			    document.id("close_btn").addEvent("click", function(event) {
			    	SqueezeBox.close();
			    })
				
			    // Open the form in modal window
				SqueezeBox.open(document.id("sq-scripts-box"), {
					handler: 'adopt',
					onClose: function() {
						
						// Hide the form
						document.id("itpm-scritps-form").hide();
						
						// Create a new element which is wrapper of the form
						// In this box, we put the form when we load it.
						var sqBox = new Element("div", {
							id: "sq-scripts-box"
						});
						
						// Some hacks to remove all elements and create a new wrapper
						document.id("itpm-scritps-form").empty();
						document.id("itpm-scritps-form").adopt(sqBox);
						
					},
					onOpen: function() {
						// Display the form
						document.id("itpm-scritps-form").show();
					}
				}); 
				
			}
		}).get(); 
			
	},
	saveScripts: function(close) {
		
		var form   = document.id('url-scripts-form');
		
		if(document.formvalidator.isValid(form)) {
			
			document.id("task").set("value", "scripts.apply");
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
		
	},
	displayTagForm: function(options) {
		
		// Load the form that we use to add tags
		new Request.HTML({
			url: options.url,
			update: "sq-box",
			onSuccess: function() {
				
				// Make tag field readonly
				document.id("jform_tag").set("readonly", "readonly");
				
				// If there is no tag id, so we adding a new tag.
				// We must prepare fields
				if(!options.tag_id) {
					
					// Set the title
					document.id("jform_title").value = options.tag_title;
	
					// Get the tag code
					var tag = getTag(options.tag_type);
					document.id("jform_tag").value    = tag;
					document.id("jform_output").value = tag;
					document.id("jform_name").value   = options.tag_type;
					
					// Clear fields
					document.id("jform_content").value = "";
					
				}
				
				// Set event to the content field
				document.id("jform_content").addEvent("keyup", function(event) {
					
					var tag       = document.id("jform_tag").value;
				    var output    = document.id("jform_output");
				    
				    var pattern   = new RegExp("{.*}");
				    var str       = new String(this.value);
				    output.value  = tag.replace(pattern, str.stripTags().clean().replace(/"/g, "&quot;"));
				    
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
		
	}
		
}