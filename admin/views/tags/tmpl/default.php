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
<?php if(!empty($this->items)) {?>
<table class="table table-striped" id="tagsList">
    <tbody>
        <?php foreach ($this->items as $i => $item) { ?>
        <tr>
            <td>
                <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tag&layout=edit&id=".$item->getId()."&url_id=".(int)$this->urlId);?>" >
                    <?php echo $this->escape($item->getTitle()); ?>
                </a>
                <div class="small"><?php echo $this->escape($item->getType()); ?></div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php }?>