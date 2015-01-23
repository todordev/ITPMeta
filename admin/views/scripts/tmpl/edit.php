<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;
?>
<div class="row-fluid">
	<div class="span6 form-vertical">
    	<form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="scriptForm" id="scripts-form" class="form-validate" autocomplete="off">
    
            <fieldset>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('after_body_tag'); ?></div>
                	<div class="controls"><?php echo $this->form->getInput('after_body_tag'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('before_body_tag'); ?></div>
                	<div class="controls"><?php echo $this->form->getInput('before_body_tag'); ?></div>
                </div>
        	</fieldset>
        	
        	<?php echo $this->form->getInput('id'); ?>
            <input type="hidden" name="task" value="" id="task"/>
            <?php echo JHtml::_('form.token'); ?>
    	</form>
	</div>
</div>
