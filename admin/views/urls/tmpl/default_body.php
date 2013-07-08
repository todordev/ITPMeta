<?php
/**
 * @package      ITPrism Components
 * @subpackage   VipQuotes
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * VipQuotes is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;
?>
<?php foreach ($this->items as $i => $item) {
    if(isset($this->numbers[$item->id])) {
        $number =  "(".$this->numbers[$item->id].")";
    } else {
        $number = "(0)";
    }
    ?>
    <tr class="row<?php echo $i % 2; ?>">
        <td class="center">
            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
        </td>
        <td >
            <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=url&layout=edit&id=".$item->id);?>" ><?php echo $item->uri; ?></a>
        </td>
        <td class="center">
            <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tags&format=raw&url_id=".(int)$item->id);?>" class="js-btn-tags-list">
                <img src="../media/com_itpmeta/images/tags_16.png" /> <?php echo JText::_('COM_ITPMETA_TAGS'); ?> <?php echo $number;?>
            </a>
        </td>
        <td class="center">
            <?php echo JHtml::_('jgrid.published', $item->published, $i, "urls."); ?>
        </td>
        <td class="center">
            <?php echo $item->id;?>
        </td>
    </tr>
<?php } ?>