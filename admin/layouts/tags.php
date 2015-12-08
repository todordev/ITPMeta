<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;?>
<div class="span6" id="itmp-tags">
    <?php echo JHtml::_('bootstrap.startAccordion', 'slide-tags', array('active' => 'opengraph_basic')); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_BASIC"), 'opengraph_basic'); ?>
    <a class="itp-tag-btn" data-tag="ogtitle" data-tag-type="og:title" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TITLE");?></a>
    <a class="itp-tag-btn" data-tag="ogdescription" data-tag-type="og:description" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_DESCRIPTION");?>"><?php echo JText::_("COM_ITPMETA_TAG_DESCRIPTION");?></a>
    <a class="itp-tag-btn" data-tag="ogimage" data-tag-type="og:image" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE");?></a>
    <a class="itp-tag-btn" data-tag="ogaudio" data-tag-type="og:audio" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUDIO");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo" data-tag-type="og:video" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO");?></a>
    <a class="itp-tag-btn" data-tag="ogtype" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
    <a class="itp-tag-btn" data-tag="ogurl" data-tag-type="og:url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_URL");?>"><?php echo JText::_("COM_ITPMETA_TAG_URL");?></a>
    <a class="itp-tag-btn" data-tag="ogsite_name" data-tag-type="og:site_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SITE_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_SITE_NAME");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_LOCATION"), 'opengraph_location'); ?>
    <a class="itp-tag-btn" data-tag="oglatitude" data-tag-type="og:latitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LATITUDE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LATITUDE");?></a>
    <a class="itp-tag-btn" data-tag="oglongitude" data-tag-type="og:longitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LONGITUDE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LONGITUDE");?></a>
    <a class="itp-tag-btn" data-tag="ogstreetaddress" data-tag-type="og:street-address" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_STREET_ADDRESS");?>"><?php echo JText::_("COM_ITPMETA_TAG_STREET_ADDRESS");?></a>
    <a class="itp-tag-btn" data-tag="oglocality" data-tag-type="og:locality" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LOCALITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_LOCALITY");?></a>
    <a class="itp-tag-btn" data-tag="ogregion" data-tag-type="og:region" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_REGION");?>"><?php echo JText::_("COM_ITPMETA_TAG_REGION");?></a>
    <a class="itp-tag-btn" data-tag="ogpostal_code" data-tag-type="og:postal-code" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_POSTAL_CODE");?>"><?php echo JText::_("COM_ITPMETA_TAG_POSTAL_CODE");?></a>
    <a class="itp-tag-btn" data-tag="ogcountry_name" data-tag-type="og:country-name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_COUNTRY_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_COUNTRY_NAME");?></a>
    <a class="itp-tag-btn" data-tag="oglocale" data-tag-type="og:locale" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LOCALE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LOCALE");?></a>
    <a class="itp-tag-btn" data-tag="oglocale_alternate" data-tag-type="og:locale:alternate" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_LOCALE_ALTERNATE");?>"><?php echo JText::_("COM_ITPMETA_TAG_LOCALE_ALTERNATE");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_CONTACT_INFORMATION"), 'opengraph_contact_info'); ?>
    <a class="itp-tag-btn" data-tag="ogemail" data-tag-type="og:email" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MAIL");?>"><?php echo JText::_("COM_ITPMETA_TAG_MAIL");?></a>
    <a class="itp-tag-btn" data-tag="ogphone_number" data-tag-type="og:phone_number" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PHONE_NUMBER");?>"><?php echo JText::_("COM_ITPMETA_TAG_PHONE_NUMBER");?></a>
    <a class="itp-tag-btn" data-tag="ogfax_number" data-tag-type="og:fax_number" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_FAX_NUMBER");?>"><?php echo JText::_("COM_ITPMETA_TAG_FAX_NUMBER");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_TAB"), 'opengraph_article'); ?>
    <a class="itp-tag-btn" data-tag="ogarticle" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_published_time" data-tag-type="article:published_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_PUBLISHED_TIME");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_PUBLISHED_TIME");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_modified_time" data-tag-type="article:modified_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_MODIFIED_TIME");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_MODIFIED_TIME");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_expiration_time" data-tag-type="article:expiration_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_EXPIRATION_TIME");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_EXPIRATION_TIME");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_author" data-tag-type="article:author" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_AUTHOR");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_publisher" data-tag-type="article:publisher" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_ARTICLE_PUBLISHER_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PUBLISHER");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_section" data-tag-type="article:section" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_SECTION");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTICLE_SECTION");?></a>
    <a class="itp-tag-btn" data-tag="ogarticle_tag" data-tag-type="article:tag" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTICLE_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE_TAB"), 'opengraph_image'); ?>
    <a class="itp-tag-btn" data-tag="ogimage" data-tag-type="og:image" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE");?></a>
    <a class="itp-tag-btn" data-tag="ogimage_width" data-tag-type="og:image:width" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE_WIDTH");?></a>
    <a class="itp-tag-btn" data-tag="ogimage_height" data-tag-type="og:image:height" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_IMAGE_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TAG_IMAGE_HEIGHT");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_TAB"), 'opengraph_profile'); ?>
    <a class="itp-tag-btn" data-tag="ogprofile" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE");?></a>
    <a class="itp-tag-btn" data-tag="ogprofile_first_name" data-tag-type="profile:first_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_FIRST_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_FIRST_NAME");?></a>
    <a class="itp-tag-btn" data-tag="ogprofile_last_name" data-tag-type="profile:last_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_LAST_NAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_LAST_NAME");?></a>
    <a class="itp-tag-btn" data-tag="ogprofile_username" data-tag-type="profile:username" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_USERNAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_USERNAME");?></a>
    <a class="itp-tag-btn" data-tag="ogprofile_gender" data-tag-type="profile:gender" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_GENDER");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_GENDER");?></a>
    <a class="itp-tag-btn" data-tag="ogprofile_fbprofile_id" data-tag-type="fb:profile_id" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PROFILE_PROFILE_ID");?>"><?php echo JText::_("COM_ITPMETA_TAG_PROFILE_PROFILE_ID");?></a>
    <a class="itp-tag-btn" data-tag="fbadmins" data-tag-type="fb:admins" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_ADMINS");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_TAG_ADMINS");?></a>
    <a class="itp-tag-btn" data-tag="fbappid" data-tag-type="fb:app_id" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_APP_ID");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_TAG_APP_ID");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TAB"), 'opengraph_audio'); ?>
    <a class="itp-tag-btn" data-tag="ogaudio" data-tag-type="og:audio" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUDIO");?></a>
    <a class="itp-tag-btn" data-tag="ogaudio_title" data-tag-type="og:audio:title" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TITLE");?></a>
    <a class="itp-tag-btn" data-tag="ogaudio_artist" data-tag-type="og:audio:artist" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ARTIST");?>"><?php echo JText::_("COM_ITPMETA_TAG_ARTIST");?></a>
    <a class="itp-tag-btn" data-tag="ogaudio_album" data-tag-type="og:audio:album" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_ALBUM_TAG_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
    <a class="itp-tag-btn" data-tag="ogaudio_type" data-tag-type="og:audio:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUDIO_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TAB"), 'opengraph_video'); ?>
    <a class="itp-tag-btn" data-tag="ogvideo" data-tag-type="og:video" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_TAG_VIDEO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_url" data-tag-type="og:video:url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_URL");?>"><?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_URL_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_width" data-tag-type="og:video:width" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_WIDTH");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_height" data-tag-type="og:video:height" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_HEIGHT");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_type" data-tag-type="og:video:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TAG_TYPE");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_secure_url" data-tag-type="og:video:secure_url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_SECURE_URL");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_SECURE_URL");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_release_date" data-tag-type="video:release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_RELEASE_DATE");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_RELEASE_DATE");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_actor" data-tag-type="video:actor" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_ACTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_ACTOR");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_actor_role" data-tag-type="video:actor:role" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_ACTOR_ROLE");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_ACTOR_ROLE");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_duration" data-tag-type="video:duration" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_DURATION");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_DURATION");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_director" data-tag-type="video:director" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_DIRECTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_DIRECTOR");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_writer" data-tag-type="video:writer" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_WRITER");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_WRITER");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_series" data-tag-type="video:series" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_SERIES");?>"><?php echo JText::_("COM_ITPMETA_TAG_VIDEO_SERIES");?></a>
    <a class="itp-tag-btn" data-tag="ogvideo_tag" data-tag-type="video:tag" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_VIDEO_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_MUSIC"), 'opengraph_music'); ?>
    <a class="itp-tag-btn" data-tag="ogmusic_song" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SONG_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_SONG");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_album" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ALBUM_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_playlist" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PLAYLIST_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_PLAYLIST");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_radio_station" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_RADIO_STATION_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_RADIO_STATION");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_duration" data-tag-type="music:duration" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_DURATION_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_DURATION");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_album" data-tag-type="music:album" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_album_disc" data-tag-type="music:album:disc" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_DISC_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM_DISC");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_album_url" data-tag-type="music:album:url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_URL_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM_URL");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_album_track" data-tag-type="music:album:track" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_ALBUM_TRACK_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_ALBUM_TRACK");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_musician" data-tag-type="music:musician" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSICIAN_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSICIAN");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_song" data-tag-type="music:song" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_song_disc" data-tag-type="music:song:disc" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_DISC_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG_DISC");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_song_url" data-tag-type="music:song:url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_URL_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG_URL");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_song_track" data-tag-type="music:song:track" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_TRACK_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_SONG_TRACK");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_release_date" data-tag-type="music:release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_RELEASE_DATE_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_RELEASE_DATE");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_creator" data-tag-type="music:creator" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_CREATOR_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSIC_CREATOR");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_song_count" data-tag-type="music:song_count" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_COUNT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_SONG_COUNT");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_preview_url" data-tag-type="music:preview_url:url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_PREVIEW_URL_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_PREVIEW_URL");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_preview_secure_url" data-tag-type="music:preview_url:secure_url" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_PREVIEW_SECURE_URL_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_PREVIEW_SECURE_URL");?></a>
    <a class="itp-tag-btn" data-tag="ogmusic_music_preview_type" data-tag-type="music:preview_url:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_PREVIEW_TYPE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSIC_PREVIEW_TYPE");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPENGRAPH_BOOK_TAB"), 'opengraph_book'); ?>
    <a class="itp-tag-btn" data-tag="ogbooks_book" data-tag-type="books:book" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_release_date" data-tag-type="books:release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_RELEASE_DATE");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_RELEASE_DATE");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_author" data-tag-type="books:author" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_AUTHOR");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_isbn" data-tag-type="books:isbn" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_ISBN");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK_ISBN");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_tag" data-tag-type="books:tag" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK_TAG");?>"><?php echo JText::_("COM_ITPMETA_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_gender" data-tag-type="books:gender" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_GENDER");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_GENDER_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_genre" data-tag-type="books:genre" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_GENRE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_GENRE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_initial_release_date" data-tag-type="books:initial_release_date" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_INITIAL_RELEASE_DATE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_INITIAL_RELEASE_DATE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_page_count" data-tag-type="books:page_count" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_PAGE_COUNT");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_PAGE_COUNT_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_sample" data-tag-type="books:sample" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_SAMPLE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_SAMPLE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_language_locale" data-tag-type="books:language:locale" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_LANGUAGE_LOCALE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_LANGUAGE_LOCALE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_language_alternate" data-tag-type="books:language:alternate" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_LANGUAGE_ALTERNATE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_LANGUAGE_ALTERNATE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_rating_value" data-tag-type="books:rating:value" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_RATING_VALUE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_RATING_VALUE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_rating_scale" data-tag-type="books:rating:scale" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_RATING_SCALE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_RATING_SCALE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_rating_normalized_value" data-tag-type="books:rating:normalized_value" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_RATING_NORMALIZED_VALUE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_RATING_NORMALIZED_VALUE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_official_site" data-tag-type="books:official_site" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_OFFICIAL_SITE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_OFFICIAL_SITE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogbooks_official_site" data-tag-type="books:canonical_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_CANONICAL_NAME");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_BOOK_CANONICAL_NAME_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPENGRAPH_TYPES_BUSINESS"), 'business'); ?>
    <a class="itp-tag-btn" data-tag="ogbusiness" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_TITLE");?>"><?php echo JText::_("COM_ITPMETA_BUSINESS");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_street_address" data-tag-type="business:contact_data:street_address" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_STREET_ADDRESS_TITLE");?>"><?php echo JText::_("COM_ITPMETA_STREET_ADDRESS");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_locality" data-tag-type="business:contact_data:locality" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_LOCALITY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_LOCALITY");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_region" data-tag-type="business:contact_data:region" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_REGION_TITLE");?>"><?php echo JText::_("COM_ITPMETA_REGION");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_postal_code" data-tag-type="business:contact_data:postal_code" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_POSTAL_CODE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_POSTAL_CODE");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_country_name" data-tag-type="business:contact_data:country_name" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_COUNTRY_NAME_TITLE");?>"><?php echo JText::_("COM_ITPMETA_COUNTRY_NAME");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_email" data-tag-type="business:contact_data:email" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_EMAIL_TITLE");?>"><?php echo JText::_("COM_ITPMETA_EMAIL");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_phone_number" data-tag-type="business:contact_data:phone_number" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_PHONE_NUMBER_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PHONE_NUMBER");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_fax_number" data-tag-type="business:contact_data:fax_number" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_FAX_NUMBER_TITLE");?>"><?php echo JText::_("COM_ITPMETA_FAX_NUMBER");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_website" data-tag-type="business:contact_data:website" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_WEBSITE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_WEBSITE");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_hours_day" data-tag-type="business:hours:day" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_HOURS_DAY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_HOURS_DAY");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_hours_start" data-tag-type="business:hours:start" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_HOURS_START_TITLE");?>"><?php echo JText::_("COM_ITPMETA_HOURS_START");?></a>
    <a class="itp-tag-btn" data-tag="ogbusiness_hours_end" data-tag-type="business:hours:end" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_BUSINESS_HOURS_END_TITLE");?>"><?php echo JText::_("COM_ITPMETA_HOURS_END");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPENGRAPH_TYPES_PRODUCT"), 'product'); ?>
    <a class="itp-tag-btn" data-tag="ogproduct" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PRODUCT");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_agegroup" data-tag-type="product:age_group" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_AGE_GROUP_TITLE");?>"><?php echo JText::_("COM_ITPMETA_AGE_GROUP");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_availability" data-tag-type="product:availability" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_AVAILABILITY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_AVAILABILITY");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_brand" data-tag-type="product:brand" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_BRAND_TITLE");?>"><?php echo JText::_("COM_ITPMETA_BRAND");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_category" data-tag-type="product:category" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_CATEGORY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_CATEGORY");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_color" data-tag-type="product:color" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_COLOR_TITLE");?>"><?php echo JText::_("COM_ITPMETA_COLOR");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_condition" data-tag-type="product:condition" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_CONDITION_TITLE");?>"><?php echo JText::_("COM_ITPMETA_CONDITION");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_ean" data-tag-type="product:ean" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_EAN_TITLE");?>"><?php echo JText::_("COM_ITPMETA_EAN");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_expiration_time" data-tag-type="product:expiration_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_EXPIRATION_TIME_TITLE");?>"><?php echo JText::_("COM_ITPMETA_EXPIRATION_TIME");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_isbn" data-tag-type="product:isbn" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_ISBN_TITLE");?>"><?php echo JText::_("COM_ITPMETA_ISBN");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_material" data-tag-type="product:material" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_MATERIAL_TITLE");?>"><?php echo JText::_("COM_ITPMETA_MATERIAL");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_mfrpartno" data-tag-type="product:mfr_part_no" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_MFRPARTNO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_MFRPARTNO");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_pattern" data-tag-type="product:pattern" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_PATTERN_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PATTERN");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_plural_title" data-tag-type="product:plural_title" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_PLURAL_TITLE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PLURAL_TITLE");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_priceamount" data-tag-type="product:price:amount" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_PRICE_AMOUNT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PRICE_AMOUNT");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_pricecurrency" data-tag-type="product:price:currency" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_PRICE_CURRENCY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PRICE_CURRENCY");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_product_link" data-tag-type="product:product_link" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_PRODUCT_LINK_TITLE");?>"><?php echo JText::_("COM_ITPMETA_PRODUCT_LINK");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_retailer" data-tag-type="product:retailer" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_RETAILER_TITLE");?>"><?php echo JText::_("COM_ITPMETA_RETAILER");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_retailer_category" data-tag-type="product:retailer_category" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_RETAILER_CATEGORY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_RETAILER_CATEGORY");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_retailer_part_no" data-tag-type="product:retailer_part_no" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_RETAILER_PART_NO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_RETAILER_PART_NO");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_sale_price_amount" data-tag-type="product:sale_price:amount" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SALE_PRICE_AMOUNT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SALE_PRICE_AMOUNT");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_sale_price_currency" data-tag-type="product:sale_price:currency" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SALE_PRICE_CURRENCY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SALE_PRICE_CURRENCY");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_sale_price_dates_start" data-tag-type="product:sale_price_dates:start" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SALE_PRICE_DATES_START_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SALE_PRICE_DATES_START");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_sale_price_dates_end" data-tag-type="product:sale_price_dates:end" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SALE_PRICE_DATES_END_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SALE_PRICE_DATES_END");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_shipping_cost_amount" data-tag-type="product:shipping_cost:amount" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SHIPPING_COST_AMOUNT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SHIPPING_COST_AMOUNT");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_shipping_cost_currency" data-tag-type="product:shipping_cost:currency" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SHIPPING_COST_CURRENCY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SHIPPING_COST_CURRENCY");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_shipping_weight_value" data-tag-type="product:shipping_weight:value" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SHIPPING_WEIGHT_VALUE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SHIPPING_WEIGHT_VALUE");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_shipping_weight_units" data-tag-type="product:shipping_weight:units" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SHIPPING_WEIGHT_UNITS_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SHIPPING_WEIGHT_UNITS");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_size" data-tag-type="product:size" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_SIZE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SIZE");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_target_gender" data-tag-type="product:target_gender" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_TARGET_GENDER_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TARGET_GENDER");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_upc" data-tag-type="product:upc" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_UPC_TITLE");?>"><?php echo JText::_("COM_ITPMETA_UPC");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_weight_value" data-tag-type="product:weight:value" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_WEIGHT_VALUE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_WEIGHT_VALUE");?></a>
    <a class="itp-tag-btn" data-tag="ogproduct_weight_units" data-tag-type="product:weight:units" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_PRODUCT_WEIGHT_UNITS_TITLE");?>"><?php echo JText::_("COM_ITPMETA_WEIGHT_UNITS");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_WEBSITES"), 'websites'); ?>
    <a class="itp-tag-btn" data-tag="ogwebsite" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_WEBSITE");?>"><?php echo JText::_("COM_ITPMETA_TAG_WEBSITE");?></a>
    <a class="itp-tag-btn" data-tag="ogblog" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BLOG");?>"><?php echo JText::_("COM_ITPMETA_TAG_BLOG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_ACTIVITIES"), 'activities'); ?>
    <a class="itp-tag-btn" data-tag="ogactivity" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ACTIVITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_ACTIVITY");?></a>
    <a class="itp-tag-btn" data-tag="ogsport" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SPORT");?>"><?php echo JText::_("COM_ITPMETA_TAG_SPORT");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_GROUPS"), 'groups'); ?>
    <a class="itp-tag-btn" data-tag="ogcause" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_CAUSE");?>"><?php echo JText::_("COM_ITPMETA_TAG_CAUSE");?></a>
    <a class="itp-tag-btn" data-tag="ogsports_league" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SPORTS_LEAGUE");?>"><?php echo JText::_("COM_ITPMETA_TAG_SPORTS_LEAGUE");?></a>
    <a class="itp-tag-btn" data-tag="ogsports_team" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SPORTS_TEAM");?>"><?php echo JText::_("COM_ITPMETA_TAG_SPORTS_TEAM");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_ORGANIZATIONS"), 'organizations'); ?>
    <a class="itp-tag-btn" data-tag="ogband" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BAND");?>"><?php echo JText::_("COM_ITPMETA_TAG_BAND");?></a>
    <a class="itp-tag-btn" data-tag="oggovernment" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_GOVERNMENT");?>"><?php echo JText::_("COM_ITPMETA_TAG_GOVERNMENT");?></a>
    <a class="itp-tag-btn" data-tag="ognon_profit" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_NON_PROFIT");?>"><?php echo JText::_("COM_ITPMETA_TAG_NON_PROFIT");?></a>
    <a class="itp-tag-btn" data-tag="ogschool" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SCHOOL");?>"><?php echo JText::_("COM_ITPMETA_TAG_SCHOOL");?></a>
    <a class="itp-tag-btn" data-tag="oguniversity" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_UNIVERSITY");?>"><?php echo JText::_("COM_ITPMETA_TAG_UNIVERSITY");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_PEOPLE"), 'people'); ?>
    <a class="itp-tag-btn" data-tag="ogactor" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ACTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_ACTOR");?></a>
    <a class="itp-tag-btn" data-tag="ogathlete" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ATHLETE");?>"><?php echo JText::_("COM_ITPMETA_TAG_ATHLETE");?></a>
    <a class="itp-tag-btn" data-tag="ogauthor" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_AUTHOR");?></a>
    <a class="itp-tag-btn" data-tag="ogdirector" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_DIRECTOR");?>"><?php echo JText::_("COM_ITPMETA_TAG_DIRECTOR");?></a>
    <a class="itp-tag-btn" data-tag="ogmusician" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MUSICIAN");?>"><?php echo JText::_("COM_ITPMETA_TAG_MUSICIAN");?></a>
    <a class="itp-tag-btn" data-tag="ogpolitician" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_POLITICIAN");?>"><?php echo JText::_("COM_ITPMETA_TAG_POLITICIAN");?></a>
    <a class="itp-tag-btn" data-tag="ogpublic_figure" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_PUBLIC_FIGURE");?>"><?php echo JText::_("COM_ITPMETA_TAG_PUBLIC_FIGURE");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPENGRAPH_TYPES_PLACE"), 'place'); ?>
    <a class="itp-tag-btn" data-tag="ogplacelatitude" data-tag-type="place:location:latitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_LOCATION_LATITUDE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_LOCATION_LATITUDE");?></a>
    <a class="itp-tag-btn" data-tag="ogplacelongitude" data-tag-type="place:location:longitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_LOCATION_LONGITUDE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_LOCATION_LONGITUDE");?></a>
    <a class="itp-tag-btn" data-tag="ogplacealtitude" data-tag-type="place:location:altitude" data-tag-title="<?php echo JText::_("COM_ITPMETA_LOCATION_ALTITUDE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_LOCATION_ALTITUDE");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_PRODUCTS_ENTERTAINMENT"), 'products_entertainment'); ?>
    <a class="itp-tag-btn" data-tag="ogalbum" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_ALBUM");?>"><?php echo JText::_("COM_ITPMETA_TAG_ALBUM");?></a>
    <a class="itp-tag-btn" data-tag="ogbook" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_BOOK");?>"><?php echo JText::_("COM_ITPMETA_TAG_BOOK");?></a>
    <a class="itp-tag-btn" data-tag="ogdrink" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_DRINK");?>"><?php echo JText::_("COM_ITPMETA_TAG_DRINK");?></a>
    <a class="itp-tag-btn" data-tag="ogfood" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_FOOD");?>"><?php echo JText::_("COM_ITPMETA_TAG_FOOD");?></a>
    <a class="itp-tag-btn" data-tag="ogsong" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SONG");?>"><?php echo JText::_("COM_ITPMETA_TAG_SONG");?></a>
    <a class="itp-tag-btn" data-tag="ogmovie" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_MOVIE");?>"><?php echo JText::_("COM_ITPMETA_TAG_MOVIE");?></a>
    <a class="itp-tag-btn" data-tag="ogtv_show" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_SHOW");?>"><?php echo JText::_("COM_ITPMETA_TAG_SHOW");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_OPEN_GRAPH_TYPES_GAMES"), 'games'); ?>
    <a class="itp-tag-btn" data-tag="oggame" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_GAME");?>"><?php echo JText::_("COM_ITPMETA_TAG_GAME");?></a>
    <a class="itp-tag-btn" data-tag="oggame_achievement" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPEN_GRAPH_GAME_ACHIEVEMENT");?>"><?php echo JText::_("COM_ITPMETA_TAG_GAME_ACHIEVEMENT");?></a>
    <a class="itp-tag-btn" data-tag="game_points" data-tag-type="game:points" data-tag-title="<?php echo JText::_("COM_ITPMETA_GAME_POINTS");?>"><?php echo JText::_("COM_ITPMETA_TAG_GAME_POINTS");?></a>
    <a class="itp-tag-btn" data-tag="game_secret" data-tag-type="game:secret" data-tag-title="<?php echo JText::_("COM_ITPMETA_GAME_SECRET");?>"><?php echo JText::_("COM_ITPMETA_GAME_SECRET_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS"), 'facebook_restrictions'); ?>
    <a class="itp-tag-btn" data-tag="fbrestrictions_country_allowed" data-tag-type="og:restrictions:country:allowed" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_COUNTRY_ALLOWED");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_COUNTRY_ALLOWED");?></a>
    <a class="itp-tag-btn" data-tag="fbrestrictions_country_disallowed" data-tag-type="og:restrictions:country:disallowed" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_COUNTRY_DISALLOWED");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_COUNTRY_DISALLOWED");?></a>
    <a class="itp-tag-btn" data-tag="fbrestrictions_age" data-tag-type="og:restrictions:age" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_AGE");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_AGE");?></a>
    <a class="itp-tag-btn" data-tag="fbrestrictions_content" data-tag-type="og:restrictions:content" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_CONTENT");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_RESTRICTIONS_TAG_CONTENT");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_TWITTER_CARD"), 'twitter_card'); ?>
    <a class="itp-tag-btn" data-tag="twitter_card_title" data-tag-type="twitter:title" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_TITLE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_description" data-tag-type="twitter:description" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_DESCRIPTION");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_DESCRIPTION_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_url" data-tag-type="twitter:url" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_URL");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_URL_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image" data-tag-type="twitter:image" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_src" data-tag-type="twitter:image:src" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_SRC");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_SRC_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_summary" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SUMMARY");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SUMMARY_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_summary_large_image" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SUMMARY_LARGE_IMAGE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SUMMARY_LARGE_IMAGE");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_photo" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PHOTO_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PHOTO_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_gallery" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_GALLERY_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_GALLERY");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_product" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PRODUCT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PRODUCT");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_app" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_APP_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_APP");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_player" data-tag-type="twitter:card" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_TWITTER_CARD_ADVANCED"), 'twitter_card_advanced'); ?>
    <a class="itp-tag-btn" data-tag="twitter_card_site" data-tag-type="twitter:site" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SITE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SITE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_site_id" data-tag-type="twitter:site:id" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SITE_ID");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_SITE_ID_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_creater" data-tag-type="twitter:creator" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_CREATER");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_CREATER_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_creater_id" data-tag-type="twitter:creator:id" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_CREATER_ID");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_CREATER_ID_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_width" data-tag-type="twitter:image:width" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_WIDTH_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_height" data-tag-type="twitter:image:height" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_HEIGHT_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_player_url" data-tag-type="twitter:player" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_URL");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_URL_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_player_width" data-tag-type="twitter:player:width" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_WIDTH");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_WIDTH_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_player_height" data-tag-type="twitter:player:height" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_HEIGHT");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_HEIGHT_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_player_stream" data-tag-type="twitter:player:stream" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_STREAM");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_STREAM_TAG");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_player_stream_content_type" data-tag-type="twitter:player:stream:content_type" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_STREAM_CONTENT_TYPE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_PLAYER_STREAM_CONTENT_TYPE");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_0" data-tag-type="twitter:image0" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_0_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_0");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_1" data-tag-type="twitter:image1" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_1_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_1");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_2" data-tag-type="twitter:image2" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_2_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_2");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_image_3" data-tag-type="twitter:image3" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_3_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_IMAGE_3");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_data_1" data-tag-type="twitter:data1" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_DATA_1_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_DATA_1");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_data_2" data-tag-type="twitter:data2" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_DATA_2_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_DATA_2");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_label_1" data-tag-type="twitter:label1" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_LABEL_1_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_LABEL_1");?></a>
    <a class="itp-tag-btn" data-tag="twitter_card_label_2" data-tag-type="twitter:label2" data-tag-title="<?php echo JText::_("COM_ITPMETA_TWETTER_CARD_LABEL_2_TITLE");?>"><?php echo JText::_("COM_ITPMETA_TWETTER_CARD_LABEL_2");?></a>

    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_DUBLIN_CORE"), 'dublin_core'); ?>
    <a class="itp-tag-btn" data-tag="dublin_core_title" data-tag-type="DC:site" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_TITLE");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_TITLE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_description" data-tag-type="DC:description" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_DESCRIPTION");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_DESCRIPTION_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_creator" data-tag-type="DC:creator" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_CREATOR");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_CREATOR_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_format" data-tag-type="DC:format" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_FORMAT");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_FORMAT_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_subject" data-tag-type="DC:subject" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_SUBJECT");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_SUBJECT_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_publisher" data-tag-type="DC:publisher" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_PUBLISHER");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_PUBLISHER_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_identifier" data-tag-type="DC:identifier" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_IDENTIFIER");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_IDENTIFIER_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_language" data-tag-type="DC:language" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_LANGUAGE");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_LANGUAGE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_date" data-tag-type="DC:date" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_DATE");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_DATE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_date_modified" data-tag-type="DC:date.modified" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_DATE_MODIFIED");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_DATE_MODIFIED_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_type" data-tag-type="DC:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_TYPE");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_TYPE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_source" data-tag-type="DC:source" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_SOURCE");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_SOURCE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_relation" data-tag-type="DC:relation" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_RELATION");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_RELATION_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_coverage" data-tag-type="DC:coverage" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_COVERAGE");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_COVERAGE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="dublin_core_rights" data-tag-type="DC:rights" data-tag-title="<?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_RIGHTS");?>"><?php echo JText::_("COM_ITPMETA_DUBLIN_CORE_RIGHTS_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_GOOGLE"), 'google'); ?>
    <a class="itp-tag-btn" data-tag="google_notranslate" data-tag-type="google:notranslate" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLE_NOTRANSLATE");?>"><?php echo JText::_("COM_ITPMETA_GOOGLE_NOTRANSLATE_TAG");?></a>
    <a class="itp-tag-btn" data-tag="google_site_verification" data-tag-type="google:site-verification" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLE_SITE_VERIFICATION");?>"><?php echo JText::_("COM_ITPMETA_GOOGLE_SITE_VERIFICATION_TAG");?></a>
    <a class="itp-tag-btn" data-tag="google_plus_author" data-tag-type="rel:author" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLE_PLUS_AUTHOR");?>"><?php echo JText::_("COM_ITPMETA_GOOGLE_PLUS_AUTHOR_TAG");?></a>
    <a class="itp-tag-btn" data-tag="google_plus_publisher" data-tag-type="rel:publisher" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLE_PLUS_PUBLISHER");?>"><?php echo JText::_("COM_ITPMETA_GOOGLE_PLUS_PUBLISHER_TAG");?></a>
    <a class="itp-tag-btn" data-tag="google_alternate" data-tag-type="rel:alternate" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLE_ALTERNATE");?>"><?php echo JText::_("COM_ITPMETA_GOOGLE_ALTERNATE_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_BING"), 'bing'); ?>
    <a class="itp-tag-btn" data-tag="bing_site_verification" data-tag-type="msvalidate.01" data-tag-title="<?php echo JText::_("COM_ITPMETA_BING_SITE_VERIFICATION");?>"><?php echo JText::_("COM_ITPMETA_BING_SITE_VERIFICATION_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_ALEXA"), 'alexa'); ?>
    <a class="itp-tag-btn" data-tag="alexa_site_verification" data-tag-type="alexaVerifyID" data-tag-title="<?php echo JText::_("COM_ITPMETA_ALEXA_SITE_VERIFICATION");?>"><?php echo JText::_("COM_ITPMETA_ALEXA_SITE_VERIFICATION_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_ROBOTS"), 'robots'); ?>
    <a class="itp-tag-btn" data-tag="robots" data-tag-type="robots" data-tag-title="<?php echo JText::_("COM_ITPMETA_ROBOTS_TITLE");?>"><?php echo JText::_("COM_ITPMETA_ROBOTS_TAG");?></a>
    <a class="itp-tag-btn" data-tag="googlebot" data-tag-type="googlebot" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLEBOT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_GOOGLEBOT_TAG");?></a>
    <a class="itp-tag-btn" data-tag="googlebot_news" data-tag-type="googlebot-news" data-tag-title="<?php echo JText::_("COM_ITPMETA_GOOGLEBOT_NEWS_TITLE");?>"><?php echo JText::_("COM_ITPMETA_GOOGLEBOT_NEWS_TAG");?></a>
    <a class="itp-tag-btn" data-tag="slurp" data-tag-type="Slurp" data-tag-title="<?php echo JText::_("COM_ITPMETA_SLURP_TITLE");?>"><?php echo JText::_("COM_ITPMETA_SLURP_TAG");?></a>
    <a class="itp-tag-btn" data-tag="bingbot" data-tag-type="bingbot" data-tag-title="<?php echo JText::_("COM_ITPMETA_BINGBOT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_BINGBOT_TAG");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_SEO"), 'seo'); ?>
    <a class="itp-tag-btn" data-tag="seo_canonical" data-tag-type="canonical" data-tag-title="<?php echo JText::_("COM_ITPMETA_SEO_CANONICAL");?>"><?php echo JText::_("COM_ITPMETA_TAG_CANONICAL");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.addSlide', 'slide-tags', JText::_("COM_ITPMETA_MISC"), 'misc'); ?>
    <a class="itp-tag-btn" data-tag="refresh" data-tag-type="refresh" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_REFRESH_TAG_TITLE");?>"><?php echo JText::_("COM_ITPMETA_REFRESH");?></a>
    <a class="itp-tag-btn" data-tag="opengraph" data-tag-type="rel:opengraph" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_OPENGRAPH_TAG_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH");?></a>
    <a class="itp-tag-btn" data-tag="origin" data-tag-type="rel:origin" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_ORIGIN_TAG_TITLE");?>"><?php echo JText::_("COM_ITPMETA_ORIGIN");?></a>
    <a class="itp-tag-btn" data-tag="ogdeterminer" data-tag-type="og:determiner" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_DETERMINER");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_DETERMINER_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogupdatedtime" data-tag-type="og:updated_time" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_UPDATED_TIME");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_UPDATED_TIME_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogseealso" data-tag-type="og:see_also" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_SEE_ALSO");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_SEE_ALSO_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogttl" data-tag-type="og:ttl" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_TTL");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_TTL_TAG");?></a>
    <a class="itp-tag-btn" data-tag="ogobject" data-tag-type="og:type" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_OBJECT_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OBJECT");?></a>
    <a class="itp-tag-btn" data-tag="fbcustom" data-tag-type="custom" data-tag-title="<?php echo JText::_("COM_ITPMETA_FACEBOOK_CUSTOM");?>"><?php echo JText::_("COM_ITPMETA_FACEBOOK_TAG_CUSTOM");?></a>
    <a class="itp-tag-btn" data-tag="ogquick_election" data-tag-type="quick_election.election" data-tag-title="<?php echo JText::_("COM_ITPMETA_OPENGRAPH_QUICK_ELECTION_TITLE");?>"><?php echo JText::_("COM_ITPMETA_OPENGRAPH_QUICK_ELECTION");?></a>
    <?php echo JHtml::_('bootstrap.endSlide'); ?>
    
    <?php echo JHtml::_('bootstrap.endAccordion'); ?>
</div>