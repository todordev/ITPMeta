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
	
	 Joomla.submitbutton = function(task) {
        if (task == 'global.cancel' || document.formvalidator.isValid(document.id('global-form'))) {
            Joomla.submitform(task, document.getElementById('global-form'));
        }
    }
	 
	// Make tag field readonly
	document.id("jform_tag").set("readonly", "readonly");
	 
	document.id("itmp-tags").addEvent("click:relay(.itp-tag-btn)", function(event){
		event.preventDefault();

		var tagTitle = this.get("data-tag-title");
		var tagType  = this.get("data-tag");
		
		// Set the title
		document.id("jform_title").value = tagTitle;

		// Get the tag code
		var tag = getTag(tagType);
		document.id("jform_tag").value    = tag;
		document.id("jform_output").value = tag;
		document.id("jform_name").value   = tagType;
		
		// Cleare fields
		document.id("jform_content").value = "";
	});
	
	document.id("jform_content").addEvent("keyup", function(event) {
		
		var tag       = document.id("jform_tag").value;
	    var output    = document.id("jform_output");
	    
	    var pattern   = new RegExp("{.*}");
	    var str       = new String(this.value);
	    output.value  = tag.replace(pattern, str.stripTags().clean().replace(/"/g, "&quot;"));
	    
    });
    
});

	

	
