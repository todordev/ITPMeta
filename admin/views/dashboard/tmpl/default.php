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
<div class="row-fluid">
    <div class="span8">&nbsp;</div>
	<div class="span4">
        <a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank"><img src="../media/com_itpmeta/images/extension_logo.png" alt="<?php echo JText::_("COM_ITPMETA");?>" /></a>
        <a href="http://itprism.com" title="<?php echo JText::_("COM_ITPMETA_ITPRISM_PRODUCT");?>" target="_blank"><img src="../media/com_itpmeta/images/product_of_itprism.png" alt="<?php echo JText::_("COM_ITPMETA_ITPRISM_PRODUCT");?>" /></a>
        <p id="itp-vote-link" ><?php echo JText::_("COM_ITPMETA_YOUR_VOTE"); ?></p>
        <p id="itp-vote-link" ><?php echo JText::_("COM_ITPMETA_SUBSCRIPTION"); ?></p>
        
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