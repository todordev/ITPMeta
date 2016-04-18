<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<tr>
    <th width="1%" class="hidden-phone">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>
	<th width="1%" style="min-width:55px" class="nowrap center">
		<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $this->listDirn, $this->listOrder); ?>
	</th>
	<th width="1%" style="min-width:55px" class="nowrap center hidden-phone">
	    <?php echo JHtml::_('grid.sort', 'COM_ITPMETA_AUTOUPDATE', 'a.autoupdate', $this->listDirn, $this->listOrder); ?>
	</th>
    <th class="title">
        <?php echo JHtml::_('grid.sort',  'COM_ITPMETA_URI_STRING', 'a.uri', $this->listDirn, $this->listOrder); ?>
    </th>
    <th class="hidden-phone" style="min-width:70px">&nbsp;</th>
    <th width="1%" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $this->listDirn, $this->listOrder); ?>
	</th>
</tr>
	  