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

// no direct access
defined('_JEXEC') or die;
?>
<?php foreach ($this->items as $i => $item) {
    $ordering  = ($this->listOrder == 'a.ordering');
?>
<tr class="row<?php echo $i % 2; ?>">
    <td class="center">
        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
    </td>
    <td >
        <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=global&layout=edit&id=".$item->id);?>" ><?php echo $this->escape($item->title); ?></a>
        <div class="small"><?php echo $this->escape($item->type); ?></div>
    </td>
    <td >
        <?php echo JString::substr($this->escape($item->output), 0, 128)."..."; ?>
    </td>
    <td class="order">
        <?php
            $disabled = $this->saveOrder ?  '' : 'disabled="disabled"';
            if($this->saveOrder) {
            if ($this->listDirn == 'asc') {
                $showOrderUpIcon = (isset($this->items[$i-1]) AND (!empty($this->items[$i-1]->ordering)) AND ( $item->ordering >= $this->items[$i-1]->ordering )) ;
                $showOrderDownIcon = (isset($this->items[$i+1]) AND ($item->ordering <= $this->items[$i+1]->ordering));
            ?>
                <span><?php echo $this->pagination->orderUpIcon($i, $showOrderUpIcon, 'globals.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, $showOrderDownIcon, 'globals.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
            <?php } elseif ($this->listDirn == 'desc') {
                $showOrderUpIcon = (isset($this->items[$i-1]) AND ($item->ordering <= $this->items[$i-1]->ordering));
                $showOrderDownIcon = (isset($this->items[$i+1]) AND (!empty($this->items[$i+1]->ordering)) AND ($item->ordering >= $this->items[$i+1]->ordering)); 
            ?>
                <span><?php echo $this->pagination->orderUpIcon($i, $showOrderUpIcon, 'globals.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, $showOrderDownIcon, 'globals.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
            <?php } 
        }?>
        <input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />
    </td>
    <td class="center">
        <?php echo JHtml::_('jgrid.published', $item->published, $i, "globals."); ?>
    </td>
    <td class="center">
        <?php echo $item->id;?>
    </td>
</tr>
<?php } ?>
	  