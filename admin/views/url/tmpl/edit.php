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
    <form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="url-form" class="form-validate">
        <div class="width-100 fltlft">
            <fieldset class="adminform">
                <legend><?php echo JText::_("COM_ITPMETA_URL_DATA"); ?></legend>
                <ul class="adminformlist">
                    <li><?php echo $this->form->getLabel('uri'); ?>
                    <?php echo $this->form->getInput('uri'); ?></li>
                    <li><?php echo $this->form->getLabel('published'); ?>
                    <?php echo $this->form->getInput('published'); ?></li>
                    <li><?php echo $this->form->getLabel('id'); ?>
                    <?php echo $this->form->getInput('id'); ?></li>
                </ul>
            </fieldset>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
    
    <?php if(!$this->itemId) { ?>
    <div class="clearfix"></div>
    <p class="sticky"><?php echo JText::_("COM_ITPMETA_NOTE_NO_TAGS")?></p>
    <?php }?>
</div>

<div class="clearfix"></div>

<?php if(!empty($this->itemId)) { ?>
    
<div class="">
    <div class="itpmeta-tags-toolbar-title">
        <h2><?php echo JText::_("COM_ITPMETA_TAGS")?></h2>
    </div>
    
    <div class="itpmeta-tags-toolbar">
        <a class="btn btn-success btn-small" href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=tag&layout=edit'); ?>" id="js-btn-add-tag">
            <?php echo JText::_("JTOOLBAR_NEW")?>
        </a>
        <a class="btn btn-small" href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=tag&layout=edit'); ?>" id="js-btn-edit-tag">
            <?php echo JText::_("JTOOLBAR_EDIT")?>
        </a>
        <a class="btn btn-danger btn-small" href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=tag&layout=edit'); ?>" id="js-btn-delete-tag">
            <?php echo JText::_("JTOOLBAR_REMOVE")?>
        </a>
    </div>
</div>

<div class="">
    <?php echo $this->loadTemplate("tags");?>
</div>
<?php }?>