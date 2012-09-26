/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
*/


function getTag(name){
	  
	var val = "";
	
	switch(name){

		/* Basic */
		case "ogtitle":
			val = '<meta property="og:title" content="{PAGE_TITLE}" />';
			break;
		
		case "ogdescription":
			val = '<meta property="og:description" content="{PAGE_DESCRIPTION}" />';
			break;
			
		case "ogimage":
			val = '<meta property="og:image" content="{IMAGE_URL}" />';
			break;
			
		case "ogaudio":
			val = '<meta property="og:audio" content="{AUDIO_URL_MP3_ONLY}" />';
			break;
			
		case "ogvideo":
			val = '<meta property="og:video" content="{VIDEO_URL_SWF_ONLY}" />';
			break;
		case "ogtype":
			val = '<meta property="og:type" content="{TYPE}" />';
		break;
		case "ogurl":
			val = '<meta property="og:url" content="{URL}" />';
		break;
		case "ogsite_name":
			val = '<meta property="og:site_name" content="{SITE_NAME}"/>';
		break;	
		
		/* Location */
		case "oglatitude":
			val = '<meta property="og:latitude" content="{EXAMPLE: 37.416343}"/>';
			break;
		case "oglongitude":
			val = '<meta property="og:longitude" content="{EXAMPLE: -122.153013}"/>';
			break;
		case "ogstreetaddress":
			val = '<meta property="og:street-address" content="{EXAMPLE: 1601 S California Ave}"/>';
			break;
		case "oglocality":
			val = '<meta property="og:locality" content="{EXAMPLE: Palo Alto}"/>';
			break;
		case "ogregion":
			val = '<meta property="og:region" content="{EXAMPLE: CA}"/>';
			break;
		case "ogpostal_code":
			val = '<meta property="og:postal-code" content="{EXAMPLE: 94304}"/>';
			break;
		case "ogcountry_name":
			val = '<meta property="og:country-name" content="{EXAMPLE: USA}"/>';
			break;	
		case "oglocale":
			val = '<meta property="og:locale" content="{EXAMPLE: en_GB}"/>';
			break;	
		case "oglocale_alternate":
			val = '<meta property="og:locale:alternate" content="{EXAMPLE: fr_FR}"/>';
			break;
		
		/* Contact information */
		case "ogemail":
			val = '<meta property="og:email" content="{EXAMPLE: me@example.com}"/>';
			break;	
		case "ogphone_number":
			val = '<meta property="og:phone_number" content="{EXAMPLE: 650-123-4567}"/>';
			break;	
		case "ogfax_number":
			val = '<meta property="og:fax_number" content="{EXAMPLE: +1-415-123-4567}"/>';
			break;	
			
			
		/* Article */
		case "ogarticle":
			val = '<meta property="og:type" content="article" />';
		break;
		case "ogarticle_published_time":
			val = '<meta property="article:published_time" content="{DATETIME}"> ';
		break;
		case "ogarticle_modified_time":
			val = '<meta property="article:modified_time" content="{DATETIME}"> ';
		break;
		case "ogarticle_expiration_time":
			val = '<meta property="article:expiration_time" content="{DATETIME}">';
		break;
		case "ogarticle_author":
			val = '<meta property="article:author" content="{URL_TO_AUTHOR_OBJECT}">';
		break;
		case "ogarticle_section":
			val = '<meta property="article:section" content="{SECTION_OF_ARTICLE}">';
		break;
		case "ogarticle_tag":
			val = '<meta property="article:tag" content="{KEYWORD}">';
		break;
		
		/* Book */
		case "ogbook":
			val = '<meta property="og:type" content="book" />';
		break;
		case "ogbook_release_date":
			val = '<meta property="book:release_date" content="{DATETIME}"> ';
		break;
		case "ogbook_author":
			val = '<meta property="book:author" content="{WHO_WROTE_THIS}">';
		break;
		case "ogbook_isbn":
			val = '<meta property="book:isbn" content="{ISBN_NUMBER}"> ';
		break;
		case "ogbook_tag":
			val = '<meta property="book:tag" content="{KEYWORD}">';
		break;
		
		
		/* Image */
		case "ogimage_width":
			val = '<meta property="og:image:width" content="{SIZE}" />';
		break;
		case "ogimage_height":
			val = '<meta property="og:image:height" content="{SIZE}" />';
		break;
		
		/* Audio */
		case "ogaudio_title":
			val = '<meta property="og:audio:title" content="{EXAMPLE: Amazing Song}" />';
		break;
		case "ogaudio_artist":
			val = '<meta property="og:audio:artist" content="{EXAMPLE: Amazing Band}" />';
		break;
		case "ogaudio_album":
			val = '<meta property="og:audio:album" content="{EXAMPLE: Amazing Album}" />';
		break;
		case "ogaudio_type":
			val = '<meta property="og:audio:type" content="{EXAMPLE: application/mp3}" />';
		break;
		
		/* Video */
		case "ogvideo_height":
			val = '<meta property="og:video:height" content="{EXAMPLE: 640}" />';
		break;
		case "ogvideo_width":
			val = '<meta property="og:video:width" content="{EXAMPLE: 385}" />';
		break;
		case "ogvideo_type":
			val = '<meta property="og:video:type" content="{EXAMPLE: application/x-shockwave-flash}" />';
		break;
		case "ogvideo_secure_url":
			val = '<meta property="og:video:secure_url" content="{EXAMPLE: https://secure.example.com/awesome.swf}" />';
		break;
		case "ogvideo_release_date":
			val = '<meta property="video:release_date" content="{DATETIME}">';
		break;
		case "ogvideo_actor":
			val = '<meta property="video:actor"	content="{URL_TO_PROFILE}">';
		break;
		case "ogvideo_actor_role":
			val = '<meta property="video:actor:role" content="{ROLE_IN_MOVE}" />';
		break;
		case "ogvideo_duration":
			val = '<meta property="video:duration" content="{RUNTIME_IN_SECS}" />';
		break;
		case "ogvideo_director":
			val = '<meta property="video:director" content="{URL_TO_PROFILE}" />';
		break;
		case "ogvideo_writer":
			val = '<meta property="video:writer" content="{URL_TO_PROFILE}" />';
		break;
		case "ogvideo_series":
			val = '<meta property="video:series" content="{URL_TO_VIDEO_TV_SHOW}" />';
		break;
		case "ogvideo_tag":
			val = '<meta property="video:tag" content="{KEYWORD}" />';
		break;
		
		/* Profile */
		case "ogprofile":
			val = '<meta property="og:type" content="profile" />';
		break;
		case "ogprofile_first_name":
			val = '<meta property="profile:first_name" content="{FIRST_NAME}" />';
		break;
		case "ogprofile_last_name":
			val = '<meta property="profile:last_name" content="{LAST_NAME}" />';
		break;
		case "ogprofile_username":
			val = '<meta property="profile:username" content="{USERNAME}" />';
		break;
		case "ogprofile_gender":
			val = '<meta property="profile:gender" content="{MALE_OR_FEMALE}" />';
		break;
		case "ogprofile_fbprofile_id":
			val = '<meta property="fb:profile_id" content="{THIRD_PARTY_FB_UID}" />';
		break;
		
		/* Websites */
		case "ogwebsite":
			val = '<meta property="og:type" content="website" />';
		break;
		case "ogblog":
			val = '<meta property="og:type" content="blog" />';
		break;
		
		/* Websites */
		case "ogactivity":
			val = '<meta property="og:type" content="activity" />';
		break;
		case "ogsport":
			val = '<meta property="og:type" content="sport" />';
		break;
		
		/* Business */
		case "ogbar":
			val = '<meta property="og:type" content="bar" />';
		break;
		case "ogcompany":
			val = '<meta property="og:type" content="company" />';
		break;
		case "ogcafe":
			val = '<meta property="og:type" content="cafe" />';
		break;
		case "oghotel":
			val = '<meta property="og:type" content="hotel" />';
		break;
		case "ogrestaurant":
			val = '<meta property="og:type" content="restaurant" />';
		break;
		
		/* Groups */
		case "ogcause":
			val = '<meta property="og:type" content="cause" />';
		break;
		case "ogsports_league":
			val = '<meta property="og:type" content="sports_league" />';
		break;
		case "ogsports_team":
			val = '<meta property="og:type" content="sports_team" />';
		break;
		
		/* Organizations */
		case "ogband":
			val = '<meta property="og:type" content="band" />';
		break;
		case "oggovernment":
			val = '<meta property="og:type" content="government" />';
		break;
		case "ognon_profit":
			val = '<meta property="og:type" content="non_profit" />';
		break;
		case "ogschool":
			val = '<meta property="og:type" content="school" />';
		break;
		case "oguniversity":
			val = '<meta property="og:type" content="university" />';
		break;
		
		/* People */
		case "ogactor":
			val = '<meta property="og:type" content="actor" />';
		break;
		case "ogathlete":
			val = '<meta property="og:type" content="athlete" />';
		break;
		case "ogauthor":
			val = '<meta property="og:type" content="author" />';
		break;
		case "ogdirector":
			val = '<meta property="og:type" content="director" />';
		break;
		case "ogmusician":
			val = '<meta property="og:type" content="musician" />';
		break;
		case "ogpolitician":
			val = '<meta property="og:type" content="politician" />';
		break;
		case "ogpublic_figure":
			val = '<meta property="og:type" content="public_figure" />';
		break;
		
		/* Places */
		case "ogcity":
			val = '<meta property="og:type" content="city" />';
		break;
		case "ogcountry":
			val = '<meta property="og:type" content="country" />';
		break;
		case "oglandmark":
			val = '<meta property="og:type" content="landmark" />';
		break;
		case "ogstate_province":
			val = '<meta property="og:type" content="state_province" />';
		break;
		
		/* Products and Entertainment */
		case "ogalbum":
			val = '<meta property="og:type" content="album" />';
		break;
		case "ogbook":
			val = '<meta property="og:type" content="book" />';
		break;
		case "ogdrink":
			val = '<meta property="og:type" content="drink" />';
		break;
		case "ogfood":
			val = '<meta property="og:type" content="food" />';
		break;
		case "ogproduct":
			val = '<meta property="og:type" content="product" />';
		break;
		case "ogsong":
			val = '<meta property="og:type" content="song" />';
		break;
		case "ogmovie":
			val = '<meta property="og:type" content="movie" />';
		break;
		case "ogtv_show":
			val = '<meta property="og:type" content="tv_show" />';
		break;
		
		
		/* Games */
		case "oggame":
			val = '<meta property="og:type" content="game" />';
		break;
		case "oggame_achievement":
			val = '<meta property="og:type" content="game.achievement" />';
		break;
		case "game_points":
			val = '<meta property="game:points" content="{POINTS FOR ACHIEVEMENT}" />';
		break;
		
		
		/* Facebook */
		case "fbadmins":
			val = '<meta property="fb:admins" content="{USER_ID1, USER_ID2}"/>';
		break;
		case "fbappid":
			val = '<meta property="fb:app_id" content="{1234567}"/>';
		break;
		case "fbcustom":
			val = '<meta property="YOUR_PROPERTY" content="{CUSTOM_CONTENT}"/>';
		break;	
		
		/* Facebook restrictions */
		case "fbrestrictions_country_allowed":
			val = '<meta property="og:restrictions:country:allowed" content="{EXP: US}" />';
		break;
		case "fbrestrictions_country_disallowed":
			val = '<meta property="og:restrictions:country:disallowed" content="{EXP: BG}" />';
		break;
		case "fbrestrictions_age":
			val = '<meta property="og:restrictions:age" content="{EXAMPLE: 13+}"/>';
		break;
		case "fbrestrictions_content":
			val = '<meta property="og:restrictions:content" content="{EXAMPLE: alcohol}"/>';
		break;
		
		/* SEO */
		case "seo_canonical":
			val = '<link rel="canonical" href="{URL}" />';
		break;	
		
		default:
			break;
	}
  
  return val;
  
}