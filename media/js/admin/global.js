/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

jQuery(document).ready(function() {
	
	 Joomla.submitbutton = function(task) {
        if (task == 'global.cancel' || document.formvalidator.isValid(document.getElementById('global-form'))) {
            Joomla.submitform(task, document.getElementById('global-form'));
        }
    };

    jQuery("#js-tag-form-wrapper").stick_in_parent({
        offset_top: 100
    });

});