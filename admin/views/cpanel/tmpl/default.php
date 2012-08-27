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
<div id="itp-cpanel">
    <div class="itp-cpitem">
        <a rel="{handler: 'iframe', size: {x: 875, y: 550}, onClose: function() {}}" href="<?php echo JRoute::_("index.php?option=com_config&view=component&component=com_itpmeta&path=&tmpl=component");?>" class="modal">
            <img src="../media/com_itpmeta/images/settings_48.png" alt="<?php echo JText::_("COM_ITPMETA_SETTINGS");?>" />
            <span><?php echo JText::_("COM_ITPMETA_SETTINGS")?></span> 
        </a>
    </div>
    <div class="itp-cpitem">
        <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=globals");?>" >
            <img src="../media/com_itpmeta/images/globals_48.png" alt="<?php echo JText::_("COM_ITPMETA_GLOBALS_TAGS");?>" />
            <span><?php echo JText::_("COM_ITPMETA_GLOBALS_TAGS")?></span> 
        </a>
    </div>
    <div class="itp-cpitem">
        <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=urls");?>" >
            <img src="../media/com_itpmeta/images/urls_48.png" alt="<?php echo JText::_("COM_ITPMETA_MANAGE_URLS");?>" />
            <span><?php echo JText::_("COM_ITPMETA_MANAGE_URLS")?></span> 
        </a>
    </div>
</div>
<div id="itp-itprism">
    <a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank"><img src="../media/com_itpmeta/images/extension_logo.png" alt="<?php echo JText::_("COM_ITPMETA");?>" /></a>
    <a href="http://itprism.com" title="<?php echo JText::_("ITP_PRODUCT");?>" target="_blank"><img src="../media/com_itpmeta/images/product_of_itprism.png" alt="<?php echo JText::_("ITP_PRODUCT");?>" /></a>
    <p id="itp-vote-link" ><?php echo JText::_("COM_ITPMETA_YOUR_VOTE"); ?></p>
    <p id="itp-vote-link" ><?php echo JText::_("COM_ITPMETA_SPONSORSHIP"); ?></p>
    
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