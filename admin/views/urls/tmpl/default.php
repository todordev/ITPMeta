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
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta&view=urls'); ?>" method="post" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_ITPMETA_SEARCH_IN_TITLE'); ?>" />
            <button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
            <button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
        <div class="filter-select fltrt">
            <select name="filter_published" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
                <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true);?>
            </select>
           
        </div>
    </fieldset>
    <div class="clr"> </div>
    
    <table class="adminlist">
       <thead>
        <tr>
            <th width="15">
                <input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
            </th>
            <th class="title">
                <?php echo JHtml::_('grid.sort',  'COM_ITPMETA_URL', 'a.uri', $this->listDirn, $this->listOrder); ?>
            </th>
            <th width="30"><?php echo JHtml::_('grid.sort',  'JPUBLISHED', 'a.published', $this->listDirn, $this->listOrder); ?></th>
            <th width="15"><?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'a.id', $this->listDirn, $this->listOrder); ?></th>
        </tr>
       </thead>
    <tfoot>
        <tr>
            <td colspan="4">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($this->items as $i => $item) {?>
        <tr class="row<?php echo $i % 2; ?>">
            <td class="center">
                <?php echo JHtml::_('grid.id', $i, $item->id); ?>
            </td>
            <td >
                <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=url&layout=edit&id=".$item->id);?>" ><?php echo $item->uri; ?></a>
            </td>
            <td align="center">
                <?php echo JHtml::_('jgrid.published', $item->published, $i, "urls."); ?>
            </td>
            <td align="center">
                <?php echo $item->id;?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>

<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
<?php echo JHtml::_('form.token'); ?>

</form>