jQuery(document).ready(function() {

	// Make tag field readonly
	jQuery("#jform_tag").prop("readonly", true);
	 
	jQuery("#itmp-tags").on("click", ".itp-tag-btn", function(event){
		
		event.preventDefault();

		var tagTitle = jQuery(this).data("tag-title");
		var tagName  = jQuery(this).data("tag");
		var tagType  = jQuery(this).data("tag-type");
		
		// Set title
		jQuery("#jform_title").val(tagTitle);

		jQuery("#jform_name").val(tagName);
		jQuery("#jform_type").val(tagType);
		
		// Get tag code
		var tag = getTag(tagName);
		jQuery("#jform_tag").val(tag);
		jQuery("#jform_output").val(tag);
		
		// Clear fields
		jQuery("#jform_content").val("");
	});
	
	jQuery("#jform_content").on("keyup", function() {
		
	    var pattern   = new RegExp("{.*?}", "g");
	    var str       = jQuery(this).val();

		// Strip tags.
		var str   	  = jQuery("<div>" + str + "</div>").text();

	    // Get the tag
	    var tag       = jQuery("#jform_tag").val();
	    
	    // If there is no matches, return.
	    var matches   = tag.match(pattern);
	    if(!matches) {
	    	return;
	    }
	    
	    if(2 == matches.length) {
	    	
	    	// Prepare non greedy pattern
	    	var pattern  = new RegExp("{.*?}");
	    	var rows 	 = str.split("\n");

	    	// If there are two lines, replace both places.
	    	if(2 == rows.length ){
	    		
		    	var line1 = jQuery.trim(rows[0]);
		    	var line2 = jQuery.trim(rows[1]);
		    	
		    	var tag 	  = tag.replace(pattern, line1.replace(/"/g, "&quot;"));
		    	var outputStr = tag.replace(pattern, line2.replace(/"/g, "&quot;"));
		    	
	    	} else { // Replace only first place
	    		
	    		var line1 	  = rows[0];
	    		var outputStr = tag.replace(pattern, line1.replace(/"/g, "&quot;"));
	    	}
	    	
	    } else { // Replace only first place
	    	var outputStr = tag.replace(pattern, jQuery.trim(str).replace(/"/g, "&quot;"));
	    }
	    
	    // Update output
	    jQuery("#jform_output").val(outputStr);
	    
    });
	
});