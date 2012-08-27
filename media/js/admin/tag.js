window.addEvent('domready', function() {
	
	document.id("apply_btn").addEvent("click", function(event) {
		event.preventDefault();
		var close = false;
		saveTag(close);
		
    });
    
	document.id("save_btn").addEvent("click", function(event) {
		event.preventDefault();
		var close = true;
		saveTag(close);
    });
	
    document.id("close_btn").addEvent("click", function(event) {
    	window.parent.SqueezeBox.close();
    })
    
    document.id("jform_content").addEvent("keyup", function(event) {
    	
    	var tag       = document.id("jform_tag").value;
	    var output    = document.id("jform_output");
	    
	    var pattern   = new RegExp("{.*}");
	    var str       = new String(this.value);
	    output.value  = tag.replace(pattern, str.stripTags().clean());
    	
    });
});

function saveTag( close ) {
	
	if(document.formvalidator.isValid(document.id('tag-form'))) {
		
		document.id("task").set("value", "tag.apply");
		var form   = document.id('tag-form');
		var url    = form.get("action");
		var fields = form.toQueryString();
		
		// Save the tag
	    var myRequest = new Request({
		    url: url,
		    method: "post",
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
		    	
		    	var response = JSON.decode(responseText);
		    	document.id("message_container").set("html", response.text);
		    	
		    	if(response.success) {
		    		
		    		document.id("message_style").set("class", "message message");
					document.id("system-message-container1").show();
			    	document.id("jform_id").value = response.data.id;
				    window.parent.loadTags(response.data.url_id);
				    
				    if(close) {
				    	window.parent.SqueezeBox.close();
				    }
				    
				} else {
					document.id("message_style").set("class", "message error");
					document.id("system-message-container1").show();
				}
				
		    }
		});
	    
	    myRequest.send();
	}
	
}