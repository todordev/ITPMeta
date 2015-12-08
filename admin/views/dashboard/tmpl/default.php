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
<?php if(!empty( $this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
<?php else : ?>
<div id="j-main-container">
<?php endif;?>
    <div class="span8">
        <!--  Row 1 -->
        <div class="row-fluid dashboard-stats">
            <div class="span8">
                <h3 class="latest">
                    <?php echo JText::_("COM_ITPMETA_LATEST");?>
                </h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo JText::_("COM_ITPMETA_URI");?></th>
                        <th><?php echo JText::_("COM_ITPMETA_LINK");?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 0, $max = count($this->latest); $i < $max; $i++) {?>
                        <tr>
                            <td style="max-width: 10px;"><?php echo $i + 1;?></td>
                            <td>
                                <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=urls&filter_search=id:".(int)$this->latest[$i]["id"]);?>">
                                    <?php echo JHtmlString::truncate(strip_tags($this->latest[$i]["uri"]), 96, Itpmeta\Constants::NO_SPLIT); ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $this->domain.$this->latest[$i]["uri"];?>"  target="_blank">
                                    <i class="btn icon-link"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="span4">
                <h3 class="basic-stats">
                    <?php echo JText::_("COM_ITPMETA_BASIC_INFORMATION");?>
                </h3>
                <table class="table">
                    <tbody>
                    <tr>
                        <th><?php echo JText::_("COM_ITPMETA_TOTAL_URLS");?></th>
                        <td><?php echo $this->totalUrls; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo JText::_("COM_ITPMETA_TOTAL_URL_TAGS");?></th>
                        <td><?php echo $this->totalTags; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo JText::_("COM_ITPMETA_TOTAL_GLOBAL_TAGS");?></th>
                        <td><?php echo $this->totalGlobalTags; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /Row 1 -->
        <!--  Row 2 -->
        <div class="row-fluid dashboard-stats">
            <div class="span8">
                <h3 class="with-scripts">
                    <?php echo JText::_("COM_ITPMETA_URLS_WITH_SCRIPTS");?>
                </h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo JText::_("COM_ITPMETA_URI");?></th>
                        <th><?php echo JText::_("COM_ITPMETA_LINK");?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 0, $max = count($this->urlsScripts); $i < $max; $i++) {?>
                        <tr>
                            <td><?php echo $i + 1;?></td>
                            <td>
                                <a href="<?php echo JRoute::_("index.php?option=com_itpmeta&view=urls&filter_search=id:".(int)$this->urlsScripts[$i]["id"]);?>" >
                                    <?php echo JHtmlString::truncate(strip_tags($this->urlsScripts[$i]["uri"]), 96, Itpmeta\Constants::NO_SPLIT); ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $this->domain.$this->urlsScripts[$i]["uri"];?>"  target="_blank">
                                    <i class="btn icon-link"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /Row 2 -->
    </div>
	<div class="span4">
        <a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank"><img src="../media/com_itpmeta/images/extension_logo.png" alt="<?php echo JText::_("COM_ITPMETA");?>" /></a>
        <a href="http://itprism.com" title="<?php echo JText::_("COM_ITPMETA_ITPRISM_PRODUCT");?>" target="_blank"><img src="../media/com_itpmeta/images/product_of_itprism.png" alt="<?php echo JText::_("COM_ITPMETA_ITPRISM_PRODUCT");?>" /></a>
        <p><?php echo JText::_("COM_ITPMETA_YOUR_VOTE"); ?></p>
        <p><?php echo JText::_("COM_ITPMETA_SUBSCRIPTION"); ?></p>
        
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_INSTALLED_VERSION");?></td>
                    <td><?php echo $this->version->getShortVersion();?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_RELEASE_DATE");?></td>
                    <td><?php echo $this->version->releaseDate?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_("COM_ITPMETA_PRISM_LIBRARY_VERSION");?></td>
                    <td><?php echo $this->prismVersion;?></td>
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

        <?php if (!empty($this->prismVersionLowerMessage)) {?>
            <p class="alert alert-warning"><i class="icon-warning"></i> <?php echo $this->prismVersionLowerMessage; ?></p>
        <?php } ?>
        <p class="alert alert-info"><i class="icon-info"></i> <?php echo JText::_("COM_ITPMETA_HOW_TO_UPGRADE"); ?></p>
	</div>
</div>