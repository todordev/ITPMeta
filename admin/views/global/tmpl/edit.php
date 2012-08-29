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
<div id="itpm-left-side-form">
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
<a class="itp-tag-btn" data-tag="ogdescription" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_DESCRIPTION");?>"><?php echo JText::_("COM_ITPMETA_TAG_DESCRIPTION");?></a>
<a class="itp-tag-btn" data-tag="ogimage" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE");?></a>
<a class="itp-tag-btn" data-tag="ogaudio" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUDIO");?></a>
<a class="itp-tag-btn" data-tag="ogvideo" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO");?></a>
<a class="itp-tag-btn" data-tag="ogtype" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
<a class="itp-tag-btn" data-tag="ogurl" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_URL");?>"><?php echo JText::_("COM_ITPMETA_TAG_URL");?></a>
<a class="itp-tag-btn" data-tag="ogsite_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SITE_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_SITE_NAME");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_LOCATION"), 'opengraph_location'); ?>

<a class="itp-tag-btn" data-tag="oglatitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LATITUDE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LATITUDE");?></a>
<a class="itp-tag-btn" data-tag="oglongitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LONGITUDE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LONGITUDE");?></a>
<a class="itp-tag-btn" data-tag="ogstreetaddress" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_STREET_ADDRESS");?>"><?php echo JText::_("COM_ITPMETA_TAG_STREET_ADDRESS");?></a>
<a class="itp-tag-btn" data-tag="oglocality" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LOCALITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_LOCALITY");?></a>
<a class="itp-tag-btn" data-tag="ogregion" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_REGION");?>"><?php echo JText::_("COM_ITPMETA_TAG_REGION");?></a>
<a class="itp-tag-btn" data-tag="ogpostal_code" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_POSTAL_CODE");?>"><?php echo JText::_("COM_ITPMETA_TAG_POSTAL_CODE");?></a>
<a class="itp-tag-btn" data-tag="ogcountry_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_COUNTRY_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_COUNTRY_NAME");?></a>
<a class="itp-tag-btn" data-tag="oglocale" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LOCALE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LOCALE");?></a>
<a class="itp-tag-btn" data-tag="oglocale_alternate" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LOCALE_ALTERNATE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LOCALE_ALTERNATE");?></a>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_CONTACT_INFORMATION"), 'opengraph_contact_info'); ?>

<a class="itp-tag-btn" data-tag="ogemail" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MAIL");?>"><?php echo JText::_("COM_ITPMETA_TAG_MAIL");?></a>
<a class="itp-tag-btn" data-tag="ogphone_number" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PHONE_NUMBER");?>"><?php echo JText::_("COM_ITPMETA_TAG_PHONE_NUMBER");?></a>
<a class="itp-tag-btn" data-tag="ogfax_number" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_FAX_NUMBER");?>"><?php echo JText::_("COM_ITPMETA_TAG_FAX_NUMBER");?></a>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO"), 'opengraph_audio'); ?>

<a class="itp-tag-btn" data-tag="ogaudio" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUDIO");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_title" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TITLE");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_artist" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTIST");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTIST");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_album" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ALBUM");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO"), 'opengraph_video'); ?>

<a class="itp-tag-btn" data-tag="ogvideo" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_height" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_HEIGHT");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_width" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_WIDTH");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_secure_url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_SECURE_URL");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_SECURE_URL");?></a>

<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_WEBSITES"), 'websites'); ?>
<a class="itp-tag-btn" data-tag="ogwebsite" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_WEBSITE");?>"><?php echo JText::_("COM_ITPMETA_TAG_WEBSITE");?></a>
<a class="itp-tag-btn" data-tag="ogblog" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BLOG");?>"><?php echo JText::_("COM_ITPMETA_TAG_BLOG");?></a>
<a class="itp-tag-btn" data-tag="ogarticle" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_ACTIVITIES"), 'activities'); ?>
<a class="itp-tag-btn" data-tag="ogactivity" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ACTIVITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_ACTIVITY");?></a>
<a class="itp-tag-btn" data-tag="ogsport" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SPORT");?>"><?php echo JText::_("COM_ITPMETA_TAG_SPORT");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_BUSINESS"), 'business'); ?>
<a class="itp-tag-btn" data-tag="ogbar" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BAR");?>"><?php echo JText::_("COM_ITPMETA_TAG_BAR");?></a>
<a class="itp-tag-btn" data-tag="ogcompany" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_COMPANY");?>"><?php echo JText::_("COM_ITPMETA_TAG_COMPANY");?></a>
<a class="itp-tag-btn" data-tag="ogcafe" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_CAFE");?>"><?php echo JText::_("COM_ITPMETA_TAG_CAFE");?></a>
<a class="itp-tag-btn" data-tag="oghotel" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_HOTEL");?>"><?php echo JText::_("COM_ITPMETA_TAG_HOTEL");?></a>
<a class="itp-tag-btn" data-tag="ogrestaurant" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_RESTAURANT");?>"><?php echo JText::_("COM_ITPMETA_TAG_RESTAURANT");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_GROUPS"), 'groups'); ?>
<a class="itp-tag-btn" data-tag="ogcause" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_CAUSE");?>"><?php echo JText::_("COM_ITPMETA_TAG_CAUSE");?></a>
<a class="itp-tag-btn" data-tag="ogsports_league" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SPORTS_LEAGUE");?>"><?php echo JText::_("COM_ITPMETA_TAG_SPORTS_LEAGUE");?></a>
<a class="itp-tag-btn" data-tag="ogsports_team" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SPORTS_TEAM");?>"><?php echo JText::_("COM_ITPMETA_TAG_SPORTS_TEAM");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_ORGANIZATIONS"), 'organizations'); ?>
<a class="itp-tag-btn" data-tag="ogband" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BAND");?>"><?php echo JText::_("COM_ITPMETA_TAG_BAND");?></a>
<a class="itp-tag-btn" data-tag="oggovernment" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_GOVERNMENT");?>"><?php echo JText::_("COM_ITPMETA_TAG_GOVERNMENT");?></a>
<a class="itp-tag-btn" data-tag="ognon_profit" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_NON_PROFIT");?>"><?php echo JText::_("COM_ITPMETA_TAG_NON_PROFIT");?></a>
<a class="itp-tag-btn" data-tag="ogschool" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SCHOOL");?>"><?php echo JText::_("COM_ITPMETA_TAG_SCHOOL");?></a>
<a class="itp-tag-btn" data-tag="oguniversity" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_UNIVERSITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_UNIVERSITY");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_PEOPLE"), 'people'); ?>
<a class="itp-tag-btn" data-tag="ogactor" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ACTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_ACTOR");?></a>
<a class="itp-tag-btn" data-tag="ogathlete" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ATHLETE");?>"><?php echo JText::_("COM_ITPMETA_TAG_ATHLETE");?></a>
<a class="itp-tag-btn" data-tag="ogauthor" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUTHOR");?></a>
<a class="itp-tag-btn" data-tag="ogdirector" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_DIRECTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_DIRECTOR");?></a>
<a class="itp-tag-btn" data-tag="ogmusician" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSICIAN");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSICIAN");?></a>
<a class="itp-tag-btn" data-tag="ogpolitician" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_POLITICIAN");?>"><?php echo JText::_("COM_ITPMETA_TAG_POLITICIAN");?></a>
<a class="itp-tag-btn" data-tag="ogpublic_figure" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PUBLIC_FIGURE");?>"><?php echo JText::_("COM_ITPMETA_TAG_PUBLIC_FIGURE");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_PLACES"), 'places'); ?>
<a class="itp-tag-btn" data-tag="ogcity" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_CITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_CITY");?></a>
<a class="itp-tag-btn" data-tag="ogcountry" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_COUNTRY");?>"><?php echo JText::_("COM_ITPMETA_TAG_COUNTRY");?></a>
<a class="itp-tag-btn" data-tag="oglandmark" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LANDMARK");?>"><?php echo JText::_("COM_ITPMETA_TAG_LANDMARK");?></a>
<a class="itp-tag-btn" data-tag="ogstate_province" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_STATE_PROVINCE");?>"><?php echo JText::_("COM_ITPMETA_TAG_STATE_PROVINCE");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_PRODUCTS_ENTERTAINMENT"), 'products_entertainment'); ?>
<a class="itp-tag-btn" data-tag="ogalbum" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ALBUM");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
<a class="itp-tag-btn" data-tag="ogbook" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK");?></a>
<a class="itp-tag-btn" data-tag="ogdrink" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_DRINK");?>"><?php echo JText::_("COM_ITPMETA_TAG_DRINK");?></a>
<a class="itp-tag-btn" data-tag="ogfood" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_FOOD");?>"><?php echo JText::_("COM_ITPMETA_TAG_FOOD");?></a>
<a class="itp-tag-btn" data-tag="ogproduct" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PRODUCT");?>"><?php echo JText::_("COM_ITPMETA_TAG_PRODUCT");?></a>
<a class="itp-tag-btn" data-tag="ogsong" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SONG");?>"><?php echo JText::_("COM_ITPMETA_TAG_SONG");?></a>
<a class="itp-tag-btn" data-tag="ogmovie" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MOVIE");?>"><?php echo JText::_("COM_ITPMETA_TAG_MOVIE");?></a>
<a class="itp-tag-btn" data-tag="ogtv_show" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SHOW");?>"><?php echo JText::_("COM_ITPMETA_TAG_SHOW");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_GAMES"), 'games'); ?>
<a class="itp-tag-btn" data-tag="oggame" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_GAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_GAME");?></a>
<a class="itp-tag-btn" data-tag="oggame_achievement" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_GAME_ACHIEVEMENT");?>"><?php echo JText::_("COM_ITPMETA_TAG_GAME_ACHIEVEMENT");?></a>
<a class="itp-tag-btn" data-tag="game_points" data-tag-title="<?php echo JText::_("COM_ITPMETA_GAME_POINTS");?>"><?php echo JText::_("COM_ITPMETA_TAG_GAME_POINTS");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_FACEBOOK"), 'facebook'); ?>
<a class="itp-tag-btn" data-tag="fbadmins" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_ADMINS");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_TAG_ADMINS");?></a>
<a class="itp-tag-btn" data-tag="fbappid" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_APP_ID");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_TAG_APP_ID");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_SEO"), 'seo'); ?>
<a class="itp-tag-btn" data-tag="seo_canonical" data-tag-title="<?php echo JText::_("COM_ITPMETA_SEO_CANONICAL");?>"><?php echo JText::_("COM_ITPMETA_TAG_CANONICAL");?></a>
<?php echo $pane->endPanel(); ?>

<?php 
}
echo $pane->endPane();

?>
</div>
