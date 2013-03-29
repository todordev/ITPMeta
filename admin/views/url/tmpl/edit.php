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
?>
<div id="itpm-left-side-form">
    <form action="<?php echo JRoute::_('index.php?option=com_itpmeta'); ?>" method="post" name="adminForm" id="url-form" class="form-validate">
        <div class="width-100 fltlft">
            <fieldset class="adminform">
                <legend><?php echo JText::_("COM_ITPMETA_URL_DATA"); ?></legend>
                <ul class="adminformlist">
                    <li><?php echo $this->form->getLabel('uri'); ?>
                    <?php echo $this->form->getInput('uri'); ?></li>
                    <li><?php echo $this->form->getLabel('published'); ?>
                    <?php echo $this->form->getInput('published'); ?></li>
                    <li><?php echo $this->form->getLabel('id'); ?>
                    <?php echo $this->form->getInput('id'); ?></li>
                </ul>
            </fieldset>
        </div>
        <div class="clr"></div>
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
    
    <?php if(!empty($this->itemId)) { ?>
	<div class="clr"></div>
    <div id="itpm-tags-box">
        <h1><?php echo JText::_("COM_ITPMETA_TAGS")?></h1>
        <div id="itmp-tags-list">
        </div>
    </div>
    <div class="clr"></div>
    <?php } else {?>
    <p class="sticky"><?php echo JText::_("COM_ITPMETA_NOTE_NO_TAGS")?></p>
    <?php }?>
</div>

<?php if(!empty($this->itemId)) { ?>
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

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_TAB"), 'opengraph_profile'); ?>
<a class="itp-tag-btn" data-tag="ogprofile" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE");?></a>
<a class="itp-tag-btn" data-tag="ogprofile_first_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_FIRST_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_FIRST_NAME");?></a>
<a class="itp-tag-btn" data-tag="ogprofile_last_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_LAST_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_LAST_NAME");?></a>
<a class="itp-tag-btn" data-tag="ogprofile_username" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_USERNAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_USERNAME");?></a>
<a class="itp-tag-btn" data-tag="ogprofile_gender" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_GENDER");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_GENDER");?></a>
<a class="itp-tag-btn" data-tag="ogprofile_fbprofile_id" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_FACEBOOK_ID");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_FACEBOOK_ID");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_TAB"), 'opengraph_article'); ?>
<a class="itp-tag-btn" data-tag="ogarticle" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE");?></a>
<a class="itp-tag-btn" data-tag="ogarticle_published_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_PUBLISHED_TIME");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_PUBLISHED_TIME");?></a>
<a class="itp-tag-btn" data-tag="ogarticle_modified_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_MODIFIED_TIME");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_MODIFIED_TIME");?></a>
<a class="itp-tag-btn" data-tag="ogarticle_expiration_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_EXPIRATION_TIME");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_EXPIRATION_TIME");?></a>
<a class="itp-tag-btn" data-tag="ogarticle_author" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_AUTHOR");?></a>
<a class="itp-tag-btn" data-tag="ogarticle_section" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_SECTION");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_SECTION");?></a>
<a class="itp-tag-btn" data-tag="ogarticle_tag" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_TAG");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_TAB"), 'opengraph_book'); ?>
<a class="itp-tag-btn" data-tag="ogbook" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK");?></a>
<a class="itp-tag-btn" data-tag="ogbook_release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_RELEASE_DATE");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_RELEASE_DATE");?></a>
<a class="itp-tag-btn" data-tag="ogbook_isbn" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_ISBN");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_ISBN");?></a>
<a class="itp-tag-btn" data-tag="ogbook_author" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_AUTHOR");?></a>
<a class="itp-tag-btn" data-tag="ogbook_tag" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_TAG");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE_TAB"), 'opengraph_image'); ?>
<a class="itp-tag-btn" data-tag="ogimage" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE");?></a>
<a class="itp-tag-btn" data-tag="ogimage_width" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE_WIDTH");?></a>
<a class="itp-tag-btn" data-tag="ogimage_height" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE_HEIGHT");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_SWITCH_TITLE"), 'opengraph_audio'); ?>
<a class="itp-tag-btn" data-tag="ogaudio" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUDIO");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_title" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TITLE");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_artist" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTIST");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTIST");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_album" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ALBUM");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
<a class="itp-tag-btn" data-tag="ogaudio_type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_SWITCH_VIDEO_TITLE"), 'opengraph_video'); ?>
<a class="itp-tag-btn" data-tag="ogvideo" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_height" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_HEIGHT");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_width" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_WIDTH");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_secure_url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_SECURE_URL");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_SECURE_URL");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_RELEASE_DATE");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_RELEASE_DATE");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_actor" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_ACTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_ACTOR");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_actor_role" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_ACTOR_ROLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_ACTOR_ROLE");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_duration" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_DURATION");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_DURATION");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_director" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_DIRECTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_DIRECTOR");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_writer" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_WRITER");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_WRITER");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_series" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_SERIES");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_SERIES");?></a>
<a class="itp-tag-btn" data-tag="ogvideo_tag" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_TAG");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_MUSIC"), 'opengraph_music'); ?>
<a class="itp-tag-btn" data-tag="ogmusic_song" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SONG_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_SONG");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_album" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ALBUM_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_playlist" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PLAYLIST_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_PLAYLIST");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_radio_station" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_RADIO_STATION_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_RADIO_STATION");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_duration" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_DURATION_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_DURATION");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_album" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_album_disc" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_DISC_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM_DISC");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_album_track" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_TRACK_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM_TRACK");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_musician" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSICIAN_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSICIAN");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_song" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_song_disc" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_DISC_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG_DISC");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_song_track" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_TRACK_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG_TRACK");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_RELEASE_DATE_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_RELEASE_DATE");?></a>
<a class="itp-tag-btn" data-tag="ogmusic_music_creator" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_CREATOR_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_CREATOR");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_WEBSITES"), 'websites'); ?>
<a class="itp-tag-btn" data-tag="ogwebsite" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_WEBSITE");?>"><?php echo JText::_("COM_ITPMETA_TAG_WEBSITE");?></a>
<a class="itp-tag-btn" data-tag="ogblog" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BLOG");?>"><?php echo JText::_("COM_ITPMETA_TAG_BLOG");?></a>
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
<a class="itp-tag-btn" data-tag="fbcustom" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_CUSTOM");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_TAG_CUSTOM");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS"), 'facebook_restrictions'); ?>
<a class="itp-tag-btn" data-tag="fbrestrictions_country_allowed" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_COUNTRY_ALLOWED");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_COUNTRY_ALLOWED");?></a>
<a class="itp-tag-btn" data-tag="fbrestrictions_country_disallowed" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_COUNTRY_DISALLOWED");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_COUNTRY_DISALLOWED");?></a>
<a class="itp-tag-btn" data-tag="fbrestrictions_age" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_AGE");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_AGE");?></a>
<a class="itp-tag-btn" data-tag="fbrestrictions_content" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_CONTENT");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_CONTENT");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_SEO"), 'seo'); ?>
<a class="itp-tag-btn" data-tag="seo_canonical" data-tag-title="<?php echo JText::_("COM_ITPMETA_SEO_CANONICAL");?>"><?php echo JText::_("COM_ITPMETA_TAG_CANONICAL");?></a>
<?php echo $pane->endPanel(); ?>

<?php echo $pane->startPanel(JText::_("COM_ITPMETA_MISC"), 'misc'); ?>
<a class="itp-tag-btn" data-tag="refresh" data-tag-title="<?php echo JText::_("COM_ITPMETA_REFRESH");?>"><?php echo JText::_("COM_ITPMETA_REFRESH_TAG");?></a>
<?php echo $pane->endPanel(); ?>

<?php 
}
echo $pane->endPane();

?>
</div>
<?php }?>

<div id="itpm-tags-form" style="display: none;">
	<div id="sq-box">
	</div>
</div>

<div id="itpm-scritps-form" style="display: none;">
	<div id="sq-scripts-box">
	</div>
</div>