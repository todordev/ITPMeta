<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITP Meta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITP Meta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;
?>
<div id="itpm-left-side-form">
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="global-form" class="form-validate">
    <div class="width-100 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_("COM_ITPMETA_TAG_DATA"); ?></legend>
            
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('title'); ?>
                <?php echo $this->form->getInput('title'); ?></li>
                <li><?php echo $this->form->getLabel('published'); ?>
                <?php echo $this->form->getInput('published'); ?></li>
                <li><?php echo $this->form->getLabel('id'); ?>
                <?php echo $this->form->getInput('id'); ?></li>
                <li><?php echo $this->form->getLabel('type'); ?>
                <?php echo $this->form->getInput('type'); ?></li>
            </ul>
            
            <div class="clearfix"></div>
            <?php echo $this->form->getLabel('content'); ?>
            <div class="clearfix"></div>
            <?php echo $this->form->getInput('content'); ?>
            
            <div class="clearfix"></div>
            <?php echo $this->form->getLabel('tag'); ?>
            <div class="clearfix"></div>
            <?php echo $this->form->getInput('tag'); ?>
            
            <div class="clearfix"></div>
            <?php echo $this->form->getLabel('output'); ?>
            <div class="clearfix"></div>
            <?php echo $this->form->getInput('output'); ?>

        </fieldset>
    </div>
    <?php echo $this->form->getInput('name'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>
</div>

<?php 
    $layoutPath = JPATH_COMPONENT_ADMINISTRATOR .DIRECTORY_SEPARATOR. "layouts" .DIRECTORY_SEPARATOR. "tags.php";
    include $layoutPath;
?>