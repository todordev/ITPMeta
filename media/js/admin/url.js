window.addEvent('domready', function() {
	
	 Joomla.submitbutton = function(task) {
        if (task == 'url.cancel' || document.formvalidator.isValid(document.id('url-form'))) {
            Joomla.submitform(task, document.getElementById('url-form'));
        }
    }
	 
	var urlId = document.id("jform_id").get("value");
	if(urlId) {
		window.loadTags(urlId);
	}
	
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
    
});

/**
 * A method that load the list with tags
 */
window.loadTags = function (urlId) {
	
	var myHTMLRequest = new Request.HTML({
		url: 'index.php?option=com_itpmeta&view=tags',
		format: "raw",
		update: "itmp-tags-list",
		onSuccess: function() {
			SqueezeBox.initialize({});
			SqueezeBox.assign($$('a.itpm-url-tag'), {
				parse: 'rel'
			});
		}
	}).get("id="+urlId);
	
}
