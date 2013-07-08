<?php
/**
 * @package      ITPMeta
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php if(!empty($this->items)) {?>
<table class="table table-striped" id="tagsList">
    <tbody>
        <?php foreach ($this->items as $i => $item) { ?>
        <tr>
            <td class="nowrap">
                <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tag&layout=edit&id=".$item->id."&url_id=".(int)$this->urlId);?>" >
                    <?php echo $this->escape($item->title); ?>
                </a>
                <div class="small"><?php echo $this->escape($item->type); ?></div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php }?>