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

// No direct access
defined('_JEXEC') or die;
$modalRel = "{handler: 'iframe',  size: {x: 600, y: 550}}";
?>
<?php if(!empty($this->items)){?>
    <?php foreach($this->items as $tag){?>
    <div class="itpm-tag-item" >
    	<div id="itpmtag_<?php echo $tag["id"]; ?>">
            <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=tag&tmpl=component&tag=ogtitle&id=".$tag["id"])?>" class="itpm-url-tag" rel="<?php echo $modalRel;?>">
            <?php echo JString::substr($this->escape($tag["output"]),0,255);?>...
            </a>
            <div class="itpm-tag-actions">
                <img 
                src="../media/com_itpmeta/images/remove.png" 
                alt="<?php JText::_("COM_ITPMETA_DELETE");?>"
                class="remove_tag"
                data-tag-id="<?php echo $tag["id"]; ?>"
                />
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <?php }?>
<?php }?>