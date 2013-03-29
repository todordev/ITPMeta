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
?>
<?php if(!empty($this->items)){?>
	<table class="table table-striped table-hover table-bordered">
    <?php foreach($this->items as $tag){?>
    <tr id="itpmtag_<?php echo $tag["id"]; ?>">
    	<td>
        	<a data-tag-id="<?php echo $tag["id"];?>" href="#" class="itpm-url-tag" >
            <?php echo $this->escape($tag["title"]);?>
            </a>
    	</td>
    </tr>
    
    <?php }?>
    </table>
    
<?php }?>