<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITPMeta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die;
?>
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="tag-form" class="form-validate" autocomplete="off">

<fieldset>
	<div class="fltrt">
		<img src="../media/com_itpmeta/images/ajax-loader.gif" style="display: none;" id="ajax_loader" />
		<button type="button" id="apply_btn"><?php echo JText::_('JAPPLY');?></button>
		<button type="button" id="save_btn"><?php echo JText::_('JSAVE');?></button>
		<button type="button" id="close_btn"><?php echo JText::_('JCANCEL');?></button>
	</div>
	<div class="configuration" >
		<?php echo JText::_("COM_ITPMETA_TAG_MANAGER") ?>
	</div>
</fieldset>
<div id="system-message-container1" style="display:none;">
    <dl id="system-message">
    <dt class="message"><?php echo JText::_("COM_ITPMETA_MESSAGE");?></dt>
        <dd class="message" id="message_style">
        	<ul>
        		<li id="message_container"></li>
        	</ul>
        </dd>
    </dl>
</div>

    <div class="width-100 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_("COM_ITPMETA_ADD_EDIT_TAG"); ?></legend>
<?php 
switch($this->tag) {
    
    case "ogtitle":
        $this->tagValue = '<meta property="og:title" content="{PAGE_TITLE}" />';
        echo $this->loadTemplate("one");
        break;
        
    default:
        echo JText::_("COM_ITPMETA_INVALID_TAG");
        break;
} ?>
		</fieldset>
	</div>
    <div class="clr"></div>
    <input type="hidden" name="task" value="" id="task"/>
    <input type="hidden" name="format" value="raw" />
    <?php echo JHtml::_('form.token'); ?>
</form>