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
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="tagForm" id="scripts-form" class="form-validate" autocomplete="off">
    <div class="width-50 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_("COM_ITPMETA_EDIT_SCRIPT"); ?></legend>
            <div class="clearfix"></div>
            <?php echo $this->form->getLabel('after_body_tag'); ?>
            <div class="clearfix"></div>
            <?php echo $this->form->getInput('after_body_tag'); ?>
            
            <div class="clearfix"></div>
            <?php echo $this->form->getLabel('before_body_tag'); ?>
            <div class="clearfix"></div>
            <?php echo $this->form->getInput('before_body_tag'); ?>
            
		</fieldset>
	</div>
    <div class="clearfix"></div>
    <?php echo $this->form->getInput('id'); ?>
    <input type="hidden" name="task" value="" id="task"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
