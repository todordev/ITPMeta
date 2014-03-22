/**
 * JavaScript Helper
 */
var ItpMetaHelper = {
		
	displayMessageSuccess: function(title, text) {
		
	    jQuery.pnotify({
	        title: title,
	        text: text,
	        icon: "icon-ok",
	        type: "success",
        });
	},
	displayMessageFailure: function(title, text) {
		
		jQuery.pnotify({
	        title: title,
	        text: text,
	        icon: 'icon-warning',
	        type: "error",
        });
	},
	displayMessageInfo: function(title, text) {
		
		jQuery.pnotify({
	        title: title,
	        text: text,
	        icon: 'icon-info',
	        type: "info",
        });
	}
}