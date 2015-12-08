<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="row-fluid">
	<div class="span6 form-horizontal">
        <form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="url-form" class="form-validate">
            <fieldset>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('uri'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('uri'); ?></div>
					<span class="help-block"><?php echo JText::_("COM_ITPMETA_URI_HELP_BLOCK");?></span>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('published'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('published'); ?></div>
                </div>
                <div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('autoupdate'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('autoupdate'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
                </div>
            </fieldset>
            
            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
        
        <?php if(!$this->itemId) { ?>
        <div class="clearfix"></div>
        <p class="alert alert-info">
            <i class="icon-info"></i>
            <?php echo JText::_("COM_ITPMETA_NOTE_NO_TAGS")?>
        </p>
        <?php }?>
    </div>
    
</div>

<?php if(!empty($this->itemId)) { ?>
<div class="row_fluid" >
    
    <div class="span12">
        <div class="itpmeta-tags-toolbar-title">
            <h2><?php echo JText::_("COM_ITPMETA_TAGS")?></h2>
        </div>
        
        <div class="itpmeta-tags-toolbar">
            <a class="btn btn-success btn-small" href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=tag&layout=edit'); ?>" id="js-btn-add-tag">
                <i class="icon-new icon-white"></i>
                <?php echo JText::_("JTOOLBAR_NEW")?>
            </a>
            <a class="btn btn-small" href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=tag&layout=edit'); ?>" id="js-btn-edit-tag">
                <i class="icon-edit icon-white"></i>
                <?php echo JText::_("JTOOLBAR_EDIT")?>
            </a>
            <a class="btn btn-danger btn-small" href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=tag&layout=edit'); ?>" id="js-btn-delete-tag">
                <i class="icon-delete icon-white"></i>
                <?php echo JText::_("JTOOLBAR_REMOVE")?>
            </a>
        </div>
    </div>
</div>

<div class="row_fluid">
    <div class="span12">
        <?php echo $this->loadTemplate("tags");?>
    </div>
</div>
<?php }?>