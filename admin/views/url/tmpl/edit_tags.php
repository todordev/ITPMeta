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
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta&view=url&layout=edit&id='.$this->itemId); ?>" method="post" name="tagsForm" id="tagsForm">
    	
        <table class="table table-striped" id="tagsList">
            <thead>
                <tr>
                	<th width="1%" class="nowrap center hidden-phone">
                		<?php echo JHtml::_('itpmeta.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $this->listDirn, $this->listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', "tagsForm"); ?>
                	</th>
                    <th width="1%" class="hidden-phone">
                		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                	</th>
                	<th class="title">
                        <?php echo JText::_("COM_ITPMETA_TITLE"); ?>
                    </th>
                    <th class="nowrap center hidden-phone">
                        <?php echo JText::_("COM_ITPMETA_CONTENT"); ?>
                    </th>
                    <th class="nowrap center hidden-phone">
                        <?php echo JText::_("COM_ITPMETA_OUTPUT"); ?>
                    </th>
                    <th width="1%" class="nowrap center hidden-phone">
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
            	<td class="order nowrap center hidden-phone">
            		<span class="sortable-handler hasTooltip">
            			<i class="icon-menu"></i>
            		</span>
            		<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="width-20 text-area-order " />
            	</td>
                <td class="center hidden-phone">
                    <input id="cb<?php echo $i;?>" type="checkbox" onclick="Joomla.isChecked(this.checked, document.getElementById('tagsForm'));" value="<?php echo $item->id;?>" name="cid[]" class="tags-cid">
                </td>
                <td class="nowrap">
                    <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tag&layout=edit&id=".$item->id);?>" ><?php echo $this->escape($item->title); ?></a>
                    <div class="small"><?php echo $this->escape($item->type); ?></div>
                </td>
                <td class="hidden-phone">
                	<div class="itpm-radius3 itpmeditable-box">
                        <div class="itpm-editable" data-pk="<?php echo $item->id;?>" ><?php echo nl2br($this->escape($item->content)); ?></div>
                    </div>
                </td>
                <td class="hidden-phone">
                	<div class="itpm-radius3 itpmoutput-box" id="itpmo<?php echo $item->id;?>">
                    <?php echo $this->escape($item->output); ?>
                    </div>
                </td>
                <td class="center hidden-phone">
                    <?php echo $item->id;?>
                </td>
            </tr>
            <?php } ?>
	        </tbody>
		</table>

        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" id="filter_order" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
</form>
