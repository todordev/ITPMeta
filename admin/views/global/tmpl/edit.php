<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITP Meta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITP Meta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC') or die;
$itemId = $this->form->getValue('id');
?>
<div id="itpm-tags-form">
<form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="global-form" class="form-validate">
    <div class="width-100 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_("COM_ITPMETA_TAG_DATA"); ?></legend>
            
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('published'); ?>
                <?php echo $this->form->getInput('published'); ?></li>
                <li><?php echo $this->form->getLabel('title'); ?>
                <?php echo $this->form->getInput('title'); ?></li>
                <li><?php echo $this->form->getLabel('id'); ?>
                <?php echo $this->form->getInput('id'); ?></li>
            </ul>
            
            <div class="clr"></div>
            <?php echo $this->form->getLabel('content'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('content'); ?>
            
            <div class="clr"></div>
            <?php echo $this->form->getLabel('tag'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('tag'); ?>
            
            <div class="clr"></div>
            <?php echo $this->form->getLabel('output'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('output'); ?>

        </fieldset>
    </div>
    <div class="clr"></div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>
</div>

<div id="itmp-tags">
<?php
$pane =& JPane::getInstance('Sliders');
echo $pane->startPane('ITPMetaPane');

{
?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_BASIC"), 'opengraph_basic'); ?>
<a class="itp-tag-btn" data-tag="ogtitle" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TITLE");?></a>
<a class="itp-tag-btn" data-tag="ogdescription"><?php echo JText::_("COM_ITPMETA_TAG_DESCRIPTION");?></a>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogimage');">Image</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogaudio');">Audio</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogvideo');">Video</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogtype');">Type</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogurl');">URL</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Location', 'opengraph_location'); ?>

<div class="itp-tag-btn" onclick="document.itpmMeta.load('oglatitude');">Latitude</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oglongitude');">Longitude</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogstreetaddress');">Street Address</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oglocality');">Locality</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogregion');">Region</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogpostal-code');">Postal code</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogcountry-name');">Country name</div>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Contact Information', 'opengraph_contact_info'); ?>

<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogemail');">E-Mail</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogphone_number');">Phone Number</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogfax_number');">Fax Number</div>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Audio', 'opengraph_audio'); ?>

<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogaudio');">Audio</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogaudio_title');">Title</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogaudio_artist');">Artist</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogaudio_album');">Album</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogaudio_type');">Type</div>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Video', 'opengraph_video'); ?>

<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogvideo');">Video</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogimage');">Image</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogvideo_height');">Height</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogvideo_width');">Width</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogvideo_type');">Type</div>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Websites', 'websites'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogwebsite');">Website</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogblog');">Blog</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogarticle');">Article</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Activities', 'activities'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogactivity');">Activity</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogsport');">Sport</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Business', 'business'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogbar');">Bar</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogcompany');">Company</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogcafe');">Cafe</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oghotel');">Hotel</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogrestaurant');">Restaurant</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Groups', 'groups'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogcause');">Cause</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogsports_league');">Sports League</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogsports_team');">Sports Team</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Organizations', 'organizations'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogband');">Band</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oggovernment');">Government</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ognon_profit');">Non Profit</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogschool');">School</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oguniversity');">University</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - People', 'people'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogactor');">Actor</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogathlete');">Athlete</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogauthor');">Author</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogdirector');">Director</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogmusician');">Musician</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogpolitician');">Politician</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogpublic_figure');">Public Figure</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Places', 'places'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogcity');">City</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogcountry');">Country</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oglandmark');">Landmark</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogstate_province');">State Province</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Open Graph Types - Products and Entertainment', 'products_entertainment'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogalbum');">Album</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogbook');">Book</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogdrink');">Drink</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogfood');">Food</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('oggame');">Game</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogproduct');">Product</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogsong');">Song</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogmovie');">Movie</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogtv_show');">TV Show</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('Facebook', 'facebook'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('fbadmins');">Admins</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('fbappid');">App ID</div>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('ogsite_name');">Site Name</div>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel('SEO', 'seo'); ?>
<div class="itp-tag-btn" onclick="document.itpmMeta.load('seo_canonical');">Canonical</div>
<?php echo $pane->endPanel(); ?>

<?php 
}
echo $pane->endPane();

?>
</div>
