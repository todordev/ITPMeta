<?php
/**
 * @package      Crowdfunding
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<!--  Row 1 -->
<div class="row-fluid">
    <div class="span8">
        <div class="panel panel-default">
            <div class="panel-heading latest">
                <i class="icon-list"></i>
                <?php echo JText::_('COM_ITPMETA_LATEST'); ?>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo JText::_('COM_ITPMETA_URI');?></th>
                        <th><?php echo JText::_('COM_ITPMETA_LINK');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 0, $max = count($this->latest); $i < $max; $i++) {?>
                        <tr>
                            <td style="max-width: 10px;"><?php echo $i + 1;?></td>
                            <td>
                                <a href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=urls&filter_search=id:'.(int)$this->latest[$i]['id']);?>">
                                    <?php echo JHtmlString::truncate(strip_tags($this->latest[$i]['uri']), 96, Itpmeta\Constants::NO_SPLIT); ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $this->domain.$this->latest[$i]['uri'];?>"  target="_blank">
                                    <i class="btn icon-link"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="panel panel-default">
            <div class="panel-heading bgcolor-blue-light">
                <i class="icon-list"></i>
                <?php echo JText::_('COM_ITPMETA_BASIC_INFORMATION'); ?>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th><?php echo JText::_('COM_ITPMETA_TOTAL_URLS');?></th>
                        <td><?php echo $this->totalUrls; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo JText::_('COM_ITPMETA_TOTAL_URL_TAGS');?></th>
                        <td><?php echo $this->totalTags; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo JText::_('COM_ITPMETA_TOTAL_GLOBAL_TAGS');?></th>
                        <td><?php echo $this->totalGlobalTags; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Row 1 -->
<!--  Row 2 -->
<div class="row-fluid">
    <div class="span8">
        <div class="panel panel-default">
            <div class="panel-heading bgcolor-violet-light">
                <i class="icon-list"></i>
                <?php echo JText::_('COM_ITPMETA_URLS_WITH_SCRIPTS'); ?>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo JText::_('COM_ITPMETA_URI');?></th>
                        <th><?php echo JText::_('COM_ITPMETA_LINK');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 0, $max = count($this->urlsScripts); $i < $max; $i++) {?>
                        <tr>
                            <td><?php echo $i + 1;?></td>
                            <td>
                                <a href="<?php echo JRoute::_('index.php?option=com_itpmeta&view=urls&filter_search=id:'.(int)$this->urlsScripts[$i]['id']);?>" >
                                    <?php echo JHtmlString::truncate(strip_tags($this->urlsScripts[$i]['uri']), 96, Itpmeta\Constants::NO_SPLIT); ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $this->domain.$this->urlsScripts[$i]['uri'];?>"  target="_blank">
                                    <i class="btn icon-link"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="span4">
    </div>
</div>
<!-- /Row 2 -->