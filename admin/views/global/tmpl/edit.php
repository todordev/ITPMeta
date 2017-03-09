<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="row-fluid">
    <div class="span6" id="js-tag-form-wrapper">
        <form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="global-form" class="form-validate form-horizontal">
            <fieldset>
                <?php echo $this->form->renderField('title'); ?>
                <?php echo $this->form->renderField('published'); ?>
                <?php echo $this->form->renderField('id'); ?>
                <?php echo $this->form->renderField('type'); ?>
                <?php echo $this->form->renderField('content'); ?>
                <?php echo $this->form->renderField('tag'); ?>
                <?php echo $this->form->renderField('output'); ?>
            </fieldset>

            <?php echo $this->form->getInput('name'); ?>
            <input type="hidden" name="task" value=""/>
            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>

    <?php
    $layout = new JLayoutFile('tags');
    echo $layout->render();
    ?>
</div>
