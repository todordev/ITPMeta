<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;
?>
<?php if(!empty( $this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
<?php else : ?>
<div id="j-main-container">
<?php endif;?>
    <div class="span8">&nbsp;</div>
	<div class="span4">
        <a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank"><img src="../media/com_itpmeta/images/extension_logo.png" alt="<?php echo JText::_("COM_ITPMETA");?>" /></a>
        <a href="http://itprism.com" title="<?php echo JText::_("COM_ITPMETA_ITPRISM_PRODUCT");?>" target="_blank"><img src="../media/com_itpmeta/images/product_of_itprism.png" alt="<?php echo JText::_("COM_ITPMETA_ITPRISM_PRODUCT");?>" /></a>
        <p><?php echo JText::_("COM_ITPMETA_YOUR_VOTE"); ?></p>
        <p><?php echo JText::_("COM_ITPMETA_SPONSORSHIP"); ?></p>
        <p><?php echo JText::_("COM_ITPMETA_SUBSCRIPTION"); ?></p>
        
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_INSTALLED_VERSION");?></td>
                    <td><?php echo $this->version->getMediumVersion();?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_RELEASE_DATE");?></td>
                    <td><?php echo $this->version->releaseDate?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_ITPRISM_LIBRARY_VERSION");?></td>
                    <td><?php echo $this->itprismVersion;?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_COPYRIGHT");?></td>
                    <td><?php echo $this->version->copyright;?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_LICENSE");?></td>
                    <td><?php echo $this->version->license;?></td>
                </tr>
            </tbody>
        </table>
	</div>
</div>