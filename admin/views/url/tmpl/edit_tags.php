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
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta&view=url&layout=edit&id='.$this->itemId); ?>" method="post" name="tagsForm" id="tagsForm" autocomplete="off">
    	
        <table class="adminlist" id="tagsList">
            <thead>
                <tr>
                    <th width="3%">
                        <input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
                    </th>
                    <th class="title">
                        <?php echo JText::_("COM_ITPMETA_TITLE"); ?>
                    </th>
                    <th width="35%"><?php echo JText::_("COM_ITPMETA_CONTENT"); ?></th>
                    <th width="35%"><?php echo JText::_("COM_ITPMETA_OUTPUT"); ?></th>
                    <th width="10%">
                        <?php echo JHtml::_('itpmeta.sort',  'JGRID_HEADING_ORDERING', 'a.ordering', $this->listDirn, $this->listOrder, null, "asc", "tagsForm"); ?>
                        <?php if ($this->saveOrder) {?>
                        <?php echo JHtml::_('itpmeta.order',  $this->items, 'filesave.png', 'tags.saveorder'); ?>
                        <?php }?>
                    </th>
                    <th width="3%">
                        <?php echo JText::_("JGRID_HEADING_ID"); ?>
                    </th>
                </tr>

            </thead>
    	    <tfoot>
    	        <tr>
                	<td colspan="7">
                	&nbsp;
                	</td>
                </tr>
	        </tfoot>
    	    <tbody>
            <?php foreach ($this->items as $i => $item) {
                $ordering  = ($this->listOrder == 'a.ordering');
            ?>
            <tr class="row<?php echo $i % 2; ?>">
                <td class="center">
                    <input id="cb<?php echo $i;?>" type="checkbox" onclick="Joomla.isChecked(this.checked, document.getElementById('tagsForm'));" value="<?php echo $item->id;?>" name="cid[]" class="tags-cid">
                </td>
                <td >
                    <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tag&layout=edit&id=".$item->id);?>" ><?php echo $this->escape($item->title); ?></a>
                    <div class="small"><?php echo $this->escape($item->type); ?></div>
                </td>
                <td>
                    <div class="itpm-radius3 itpmeditable-box">
                        <div class="itpm-editable" data-pk="<?php echo $item->id;?>" >
                        <?php echo $this->escape($item->content); ?>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="itpm-radius3 itpmoutput-box" id="itpmo<?php echo $item->id;?>">
                    <?php echo $this->escape($item->output); ?>
                    </div>
                </td>
                <td class="order">
                    <?php
                        $disabled = $this->saveOrder ?  '' : 'disabled="disabled"';
                        if($this->saveOrder) {
                        if ($this->listDirn == 'asc') {
                            $showOrderUpIcon = (isset($this->items[$i-1]) AND (!empty($this->items[$i-1]->ordering)) AND ( $item->ordering >= $this->items[$i-1]->ordering )) ;
                            $showOrderDownIcon = (isset($this->items[$i+1]) AND ($item->ordering <= $this->items[$i+1]->ordering));
                        ?>
                            <span><?php echo JHtml::_("itpmeta.orderUpIcon", $i, $showOrderUpIcon, 'tags.orderup', 'JLIB_HTML_MOVE_UP', $ordering, $this->pagination->limitstart)?></span>
                            <span><?php echo JHtml::_("itpmeta.orderDownIcon", $i, $showOrderDownIcon, 'tags.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering, $this->pagination->limitstart, $this->pagination->total)?></span>
                            
                        <?php } elseif ($this->listDirn == 'desc') {
                            $showOrderUpIcon = (isset($this->items[$i-1]) AND ($item->ordering <= $this->items[$i-1]->ordering));
                            $showOrderDownIcon = (isset($this->items[$i+1]) AND (!empty($this->items[$i+1]->ordering)) AND ($item->ordering >= $this->items[$i+1]->ordering)); 
                        ?>
                            <span><?php echo JHtml::_("itpmeta.orderUpIcon", $i, $showOrderUpIcon, 'tags.orderdown', 'JLIB_HTML_MOVE_UP', $ordering, $this->pagination->limitstart)?></span>
                            <span><?php echo JHtml::_("itpmeta.orderDownIcon", $i, $showOrderDownIcon, 'tags.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering, $this->pagination->limitstart, $this->pagination->total)?></span>
                        <?php } 
                    }?>
                    <input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />
                </td>
                
                <td class="center"><?php echo $item->id;?></td>
            </tr>
            <?php } ?>
	        </tbody>
		</table>

        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="task" value="" id="tags-form-task"/>
        <input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
</form>
