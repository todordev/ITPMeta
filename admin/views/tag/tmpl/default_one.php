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

<div class="clr"></div>
<?php echo $this->form->getLabel('content'); ?>
<div class="clr"></div>
<?php echo $this->form->getInput('content'); ?>

<div class="clr"></div>
<?php echo $this->form->getLabel('tag'); ?>
<div class="clr"></div>
<?php echo $this->form->getInput('tag', null, $this->tagValue); ?>

<div class="clr"></div>
<?php echo $this->form->getLabel('output'); ?>
<div class="clr"></div>
<?php echo $this->form->getInput('output'); ?>

<div class="clr"></div>
<ul class="adminformlist">
    <li><?php echo $this->form->getLabel('id'); ?>
    <?php echo $this->form->getInput('id'); ?></li>
    <li><?php echo $this->form->getInput('url_id'); ?></li>
</ul>
        