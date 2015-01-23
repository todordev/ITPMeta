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
<?php foreach ($this->items as $i => $item) {
    $number =  (isset($this->numbers[$item->id])) ? "(".$this->numbers[$item->id].")" : "(0)";
?>
<tr class="row<?php echo $i % 2; ?>">
    <td class="center hidden-phone">
        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
    </td>
    <td class="center">
        <?php echo JHtml::_('jgrid.published', $item->published, $i, "urls."); ?>
    </td>
    <td class="center hidden-phone">
        <?php echo JHtml::_('itpmeta.autoupdatestate', $item->autoupdate, $i); ?>
    </td>
    <td>
        <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=url&layout=edit&id=".$item->id);?>" ><?php echo $this->escape( $item->uri ); ?></a>
    </td>
    <td class="center hidden-phone">
        <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tags&format=raw&url_id=".(int)$item->id);?>" class="js-btn-tags-list">
            <img src="../media/com_itpmeta/images/tags_16.png" /> <?php echo JText::_('COM_ITPMETA_TAGS'); ?> <?php echo $number;?>
        </a>
    </td>
    <td class="center hidden-phone">
        <?php echo $item->id;?>
    </td>
</tr>
<?php } ?>