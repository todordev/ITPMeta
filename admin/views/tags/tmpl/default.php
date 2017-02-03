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