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
	
	jQuery("#jform_content").on("keyup", function(event) {
		
	    var pattern   = new RegExp("{.*}");
	    var str       = new String(jQuery(this).val());
	    
	    // Get the tag 
	    var tag       = jQuery("#jform_tag").val();
	    
	    // Update output
	    var outputStr = tag.replace(pattern, str.stripTags().clean().replace(/"/g, "&quot;"));
	    jQuery("#jform_output").val(outputStr);
	    
    });
	
});