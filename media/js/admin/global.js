/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
*/

jQuery(document).ready(function() {
	
	 Joomla.submitbutton = function(task) {
        if (task == 'global.cancel' || document.formvalidator.isValid(document.id('global-form'))) {
            Joomla.submitform(task, document.getElementById('global-form'));
        }
    }
    
});