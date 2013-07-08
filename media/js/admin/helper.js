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
		
	listItemTask: function(id, task) {
		
		var f = document.tagsForm;
		var cb = f[id];
		if (cb) {
			for (var i = 0; true; i++) {
				var cbx = f['cb'+i];
				if (!cbx)
					break;
				cbx.checked = false;
			} // for
			cb.checked = true;
			f.boxchecked.value = 1;
			
			jQuery("#tags-form-task").val(task);
			jQuery(f).submit();
		}
		return false;
		
	},
	saveOrder: function(n, task) {
		
		if (!task) {
			task = 'saveorder';
		}

		for (var j = 0; j <= n; j++) {
			var box = document.tagsForm['cb'+j];
			if (box) {
				if (box.checked == false) {
					box.checked = true;
				}
			} else {
				alert("You cannot change the order of items, as an item in the list is `Checked Out`");
				return;
			}
		}
		
		jQuery("#tags-form-task").val(task);
		jQuery(document.tagsForm).submit();
		
	}
	
}