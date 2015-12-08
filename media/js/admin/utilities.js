/**
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <http://itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
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
			val = '<meta property="og:locale:locale" content="{EXAMPLE: en_GB}"/>';
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
		case "ogarticle_publisher":
			val = '<meta property="article:publisher" content="{URL_TO_PUBLISHER_OBJECT}">';
			break;
		case "ogarticle_section":
			val = '<meta property="article:section" content="{SECTION_OF_ARTICLE}">';
		break;
		case "ogarticle_tag":
			val = '<meta property="article:tag" content="{KEYWORD}">';
		break;
		
		/* Books */
		case "ogbooks_book":
			val = '<meta property="og:type" content="books:book" />';
		break;
		case "ogbooks_release_date":
			val = '<meta property="books:release_date" content="{DATETIME}"> ';
		break;
		case "ogbooks_author":
			val = '<meta property="books:author" content="{WHO_WROTE_THIS}">';
		break;
		case "ogbooks_isbn":
			val = '<meta property="books:isbn" content="{ISBN_NUMBER}"> ';
		break;
		case "ogbooks_tag":
			val = '<meta property="books:tag" content="{KEYWORD}">';
		break;
        case "ogbooks_gender":
            val = '<meta property="books:gender" content="{Female|Male}">';
            break;
        case "ogbooks_official_site":
            val = '<meta property="books:official_site" content="{URL}">';
            break;
		case "ogbooks_genre":
			val = '<meta property="books:genre" content="{GENRE}">';
		break;
		case "ogbooks_initial_release_date":
			val = '<meta property="books:initial_release_date" content="{DATE}">';
		break;
		case "ogbooks_page_count":
			val = '<meta property="books:page_count" content="{COUNT}">';
		break;
		case "ogbooks_sample":
			val = '<meta property="books:sample" content="{URL}">';
		break;
		case "ogbooks_language_locale":
			val = '<meta property="books:language:locale" content="{LOCALE}">';
		break;
		case "ogbooks_language_alternate":
			val = '<meta property="books:language:alternate" content="{ALTERNATE}">';
		break;
		case "ogbooks_rating_value":
			val = '<meta property="books:rating:value" content="{VALUE}">';
		break;
		case "ogbooks_rating_scale":
			val = '<meta property="books:rating:scale" content="{SCALE}">';
		break;
		case "ogbooks_rating_normalized_value":
			val = '<meta property="books:rating:normalized_value" content="{VALUE}">';
		break;
        case "ogbooks_canonical_name":
			val = '<meta property="books:canonical_name" content="{NAME}">';
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
		case "ogvideo_url":
			val = '<meta property="og:video:url" content="{VIDEO_URL_SWF_ONLY}" />';
		break;
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
		case "fbadmins":
			val = '<meta property="fb:admins" content="{USER_ID1, USER_ID2}"/>';
		break;
		case "fbappid":
			val = '<meta property="fb:app_id" content="{1234567}"/>';
		break;
		
		/* Music */
		case "ogmusic_song":
			val = '<meta property="og:type" content="music.song" />';
		break;
		case "ogmusic_album":
			val = '<meta property="og:type" content="music.album" />';
		break;
		case "ogmusic_playlist":
			val = '<meta property="og:type" content="music.playlist" />';
		break;
		case "ogmusic_radio_station":
			val = '<meta property="og:type" content="music:radio_station" />';
			break;
		case "ogmusic_music_duration":
			val = '<meta property="music:duration" content="{DURATION}" />';
		break;
		case "ogmusic_music_album":
			val = '<meta property="music:album" content="{ALBUM}" />';
		break;
		case "ogmusic_music_album_disc":
			val = '<meta property="music:album:disc" content="{ALBUM_DISC}" />';
		break;
        case "ogmusic_music_album_url":
            val = '<meta property="music:album:url" content="{ALBUM_URL}" />';
            break;
		case "ogmusic_music_album_track":
			val = '<meta property="music:album:track" content="{ALBUM_TRACK}" />';
		break;
		case "ogmusic_musician":
			val = '<meta property="music:musician" content="{MUSICITAN}" />';
		break;
		case "ogmusic_music_song":
			val = '<meta property="music:song" content="{MUSIC_SONG}" />';
		break;
		case "ogmusic_music_song_disc":
			val = '<meta property="music:song:disc" content="{MUSIC_SONG_DISC}" />';
		break;
		case "ogmusic_music_song_track":
			val = '<meta property="music:song:track" content="{MUSIC_SONG_TRACK}" />';
		break;
        case "ogmusic_music_song_url":
            val = '<meta property="music:song:url" content="{MUSIC_SONG_URL}" />';
            break;
		case "ogmusic_music_release_date":
			val = '<meta property="music:release_date" content="{RELEASE_DATE}" />';
		break;
		case "ogmusic_music_creator":
			val = '<meta property="music:creator" content="{CREATOR}" />';
		break;
        case "ogmusic_music_song_count":
            val = '<meta property="music:song_count" content="{NUMBER}" />';
            break;
        case "ogmusic_music_preview_url":
            val = '<meta property="music:preview_url:url" content="{URL}" />';
            break;
        case "ogmusic_music_preview_secure_url":
            val = '<meta property="music:preview_url:secure_url" content="{SECURE_URL}" />';
            break;
        case "ogmusic_music_preview_type":
            val = '<meta property="music:preview_url:type" content="{TYPE}" />';
            break;
		
		/* Websites */
		case "ogwebsite":
			val = '<meta property="og:type" content="website" />';
		break;
		case "ogblog":
			val = '<meta property="og:type" content="blog" />';
		break;
		
		/* Activities */
		case "ogactivity":
			val = '<meta property="og:type" content="activity" />';
		break;
		case "ogsport":
			val = '<meta property="og:type" content="sport" />';
		break;
		
		/* Business */
		case "ogbusiness":
			val = '<meta property="og:type" content="business:business" />';
		break;
		case "ogbusiness_street_address":
			val = '<meta property="business:contact_data:street_address" content="{ADDRESS}" />';
		break;
		case "ogbusiness_locality":
			val = '<meta property="business:contact_data:locality" content="{LOCALITY}" />';
		break;
		case "ogbusiness_region":
			val = '<meta property="business:contact_data:region" content="{REGION}" />';
		break;
		case "ogbusiness_postal_code":
			val = '<meta property="business:contact_data:postal_code" content="{POSTAL_CODE}" />';
		break;
		case "ogbusiness_country_name":
			val = '<meta property="business:contact_data:country_name" content="{COUNTRY_NAME}" />';
			break;
		case "ogbusiness_email":
			val = '<meta property="business:contact_data:email" content="{EMAIL}" />';
			break;
		case "ogbusiness_phone_number":
			val = '<meta property="business:contact_data:phone_number" content="{PHONE_NUMBER}" />';
			break;
		case "ogbusiness_fax_number":
			val = '<meta property="business:contact_data:fax_number" content="{FAX_NUMBER}" />';
			break;
		case "ogbusiness_website":
			val = '<meta property="business:contact_data:website" content="{WEBSITE}" />';
			break;
		case "ogbusiness_hours_day":
			val = '<meta property="business:hours:day" content="{VALUE}" />';
			break;
		case "ogbusiness_hours_start":
			val = '<meta property="business:hours:start" content="{VALUE}" />';
			break;
		case "ogbusiness_hours_end":
			val = '<meta property="business:hours:end" content="{VALUE}" />';
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
		
		/* Place */
		case "ogplacelatitude":
			val = '<meta property="place:location:latitude" content="{LATITUDE}" />';
		break;
		case "ogplacelongitude":
			val = '<meta property="place:location:longitude" content="{LONGITUDE}" />';
		break;
		case "ogplacealtitude":
			val = '<meta property="place:location:altitude" content="{ALTITUDE}" />';
		break;
		
		/* Product */
		case "ogproduct":
			val = '<meta property="og:type" content="product" />';
		break;
		case "ogproduct_agegroup":
			val = '<meta property="product:age_group" content="{VALUE}" /> ';
			break;
		case "ogproduct_availability":
			val = '<meta property="product:availability" content="{VALUE}" /> ';
			break;
		case "ogproduct_brand":
			val = '<meta property="product:brand" content="{TEXT}" /> ';
			break;
		case "ogproduct_category":
			val = '<meta property="product:category" content="{CATEGORY}" /> ';
			break;
		case "ogproduct_color":
			val = '<meta property="product:color" content="{COLOR}" /> ';
			break;
		case "ogproduct_condition":
			val = '<meta property="product:condition" content="{CONDITION}" /> ';
			break;
		case "ogproduct_ean":
			val = '<meta property="product:ean" content="{EAN}" /> ';
			break;
		case "ogproduct_expiration_time":
			val = '<meta property="product:expiration_time" content="{TIME}" /> ';
			break;
		case "ogproduct_isbn":
			val = '<meta property="product:isbn" content="{ISBN}" /> ';
			break;
		case "ogproduct_material":
			val = '<meta property="product:material" content="{VALUE}" /> ';
			break;
		case "ogproduct_mfrpartno":
			val = '<meta property="product:mfr_part_no" content="{VALUE}" /> ';
			break;
		case "ogproduct_pattern":
			val = '<meta property="product:pattern" content="{VALUE}" /> ';
			break;
		case "ogproduct_plural_title":
			val = '<meta property="product:plural_title" content="{VALUE}" /> ';
			break;
		case "ogproduct_priceamount":
			val = '<meta property="product:price:amount" content="{AMOUNT}" /> ';
			break;
		case "ogproduct_pricecurrency":
			val = '<meta property="product:price:currency" content="{CURRENCY}" /> ';
			break;
		case "ogproduct_product_link":
			val = '<meta property="product:product_link" content="{VALUE}" /> ';
			break;
		case "ogproduct_retailer":
			val = '<meta property="product:retailer" content="{RETAILER}" /> ';
			break;
		case "ogproduct_retailer_category":
			val = '<meta property="product:retailer_category" content="{VALUE}" /> ';
			break;
		case "ogproduct_retailer_part_no":
			val = '<meta property="product:retailer_part_no" content="{VALUE}" /> ';
			break;
		case "ogproduct_sale_price_amount":
			val = '<meta property="product:sale_price:amount" content="{AMOUNT}" /> ';
			break;
		case "ogproduct_sale_price_currency":
			val = '<meta property="product:sale_price:currency" content="{CURRENCY}" /> ';
			break;
		case "ogproduct_sale_price_dates_start":
			val = '<meta property="product:sale_price_dates:start" content="{VALUE}" /> ';
			break;
		case "ogproduct_sale_price_dates_end":
			val = '<meta property="product:sale_price_dates:end" content="{VALUE}" /> ';
			break;
		case "ogproduct_shipping_cost_amount":
			val = '<meta property="product:shipping_cost:amount" content="{AMOUNT}" /> ';
			break;
		case "ogproduct_shipping_cost_currency":
			val = '<meta property="product:shipping_cost:currency" content="{CURRENCY}" /> ';
			break;
		case "ogproduct_shipping_weight_value":
			val = '<meta property="product:shipping_weight:value" content="{VALUE}" /> ';
			break;
		case "ogproduct_shipping_weight_units":
			val = '<meta property="product:shipping_weight:units" content="{VALUE}" /> ';
			break;
		case "ogproduct_size":
			val = '<meta property="product:size" content="{SIZE}" /> ';
			break;
		case "ogproduct_target_gender":
			val = '<meta property="product:target_gender" content="{VALUE}" /> ';
			break;
		case "ogproduct_upc":
			val = '<meta property="product:upc" content="{UPC}" /> ';
			break;
		case "ogproduct_weight_value":
			val = '<meta property="product:weight:value" content="{VALUE}" /> ';
			break;
		case "ogproduct_weight_units":
			val = '<meta property="product:weight:units" content="{UNITS}" /> ';
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
        case "game_secret":
            val = '<meta property="game:secret" content="{BOOLEAN}" />';
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
		
		/* Twitter basic */
		case "twitter_card_summary":
			val = '<meta name="twitter:card" content="summary" />';
		break;
        case "twitter_card_summary_large_image":
            val = '<meta name="twitter:card" content="summary_large_image" />';
            break;
        case "twitter_card_gallery":
            val = '<meta name="twitter:card" content="gallery" />';
            break;
        case "twitter_card_product":
            val = '<meta name="twitter:card" content="product" />';
            break;
        case "twitter_card_app":
            val = '<meta name="twitter:card" content="app" />';
            break;
		case "twitter_card_photo":
			val = '<meta name="twitter:card" content="photo" />';
		break;
		case "twitter_card_player":
			val = '<meta name="twitter:card" content="player" />';
		break;
		case "twitter_card_title":
			val = '<meta name="twitter:title" content="{MAX_70_SYMBOLS}" />';
		break;
		case "twitter_card_description":
			val = '<meta name="twitter:description" content="{DESCRIPTION}" />';
		break;
		case "twitter_card_url":
			val = '<meta name="twitter:url" content="{URL}" />';
		break;
		case "twitter_card_image":
			val = '<meta name="twitter:image" content="{URL}" />';
		break;
		case "twitter_card_image_src":
			val = '<meta name="twitter:image:src" content="{URL}" />';
		break;
		case "twitter_card_player_url":
			val = '<meta name="twitter:player" content="{HTTPS_URL}" />';
		break;
		
		/* Twitter advanced */
		case "twitter_card_site":
			val = '<meta name="twitter:site" content="{TWITTER_USERNAME}" />';
		break;
		case "twitter_card_site_id":
			val = '<meta name="twitter:site:id" content="{USER_TWITTER_ID}" />';
		break;
		case "twitter_card_creater":
			val = '<meta name="twitter:creator" content="{TWITTER_USERNAME}" />';
		break;
		case "twitter_card_creater_id":
			val = '<meta name="twitter:creator:id" content="{USER_TWITTER_ID}" />';
		break;
		case "twitter_card_image_width":
			val = '<meta name="twitter:image:width" content="{IMAGE_WIDTH}" />';
		break;
		case "twitter_card_image_height":
			val = '<meta name="twitter:image:height" content="{HEIGHT}" />';
		break;
		case "twitter_card_player_width":
			val = '<meta name="twitter:player:width" content="{WIDTH}" />';
		break;
		case "twitter_card_player_height":
			val = '<meta name="twitter:player:height" content="{HEIGHT}" />';
		break;
        case "twitter_card_player_stream":
            val = '<meta name="twitter:player:stream" content="{STREAM}" />';
            break;
		case "twitter_card_player_stream_content_type":
			val = '<meta name="twitter:player:stream:content_type" content="{CONTENT_TYPE}" />';
			break;
		case "twitter_card_image_0":
			val = '<meta name="twitter:image0" content="{URL}" />';
		break;
        case "twitter_card_image_1":
            val = '<meta name="twitter:image1" content="{URL}" />';
            break;
        case "twitter_card_image_2":
            val = '<meta name="twitter:image2" content="{URL}" />';
            break;
        case "twitter_card_image_3":
            val = '<meta name="twitter:image3" content="{URL}" />';
            break;
        case "twitter_card_data_1":
            val = '<meta name="twitter:data1" content="{URL}" />';
            break;
        case "twitter_card_data_2":
            val = '<meta name="twitter:data2" content="{URL}" />';
            break;
        case "twitter_card_label_1":
            val = '<meta name="twitter:label1" content="{URL}" />';
            break;
        case "twitter_card_label_2":
            val = '<meta name="twitter:label2" content="{URL}" />';
            break;
		
		/* Google */
		case "google_notranslate":
			val = '<meta name="google" content="notranslate" />';
		break;
		
		case "google_site_verification":
			val = '<meta name="google-site-verification" content="{CONTENT}" />';
		break;
		
		case "google_plus_author":
			val = '<link rel="author" href="{URL}" />';
		break;
		
		case "google_plus_publisher":
			val = '<link rel="publisher" href="{URL}" />';
		break;
		
		case "google_alternate":
			val = '<link rel="alternate" href="{HREF}" hreflang="{HREF_LANG}" />';
		break;
		
		/* Bing */
		case "bing_site_verification":
			val = '<meta name="msvalidate.01" content="{CODE}" />';
		break;
		
		/* Alexa */
		case "alexa_site_verification":
			val = '<meta name="alexaVerifyID" content="{CODE}" />';
		break;
		
		/* Robots */
		case "robots":
			val = '<meta name="robots" content="{CONTENT}" />';
		break;
		case "googlebot":
			val = '<meta name="googlebot" content="{CONTENT}" />';
		break;
		case "googlebot_news":
			val = '<meta name="googlebot-news" content="{CONTENT}" />';
		break;
		case "slurp":
			val = '<meta name="Slurp" content="{CONTENT}" />';
		break;
		case "bingbot":
			val = '<meta name="bingbot" content="{CONTENT}" />';
		break;
		
		/* SEO */
		case "seo_canonical":
			val = '<link rel="canonical" href="{URL}" />';
		break;	
		
		/* Misc */
		case "refresh":
			val = '<meta http-equiv="refresh" content="{SECONDS;URL=}" />';
		break;
		case "opengraph":
			val = '<link rel="opengraph" href="{DESTINATION_URL}" />';
			break;
		case "origin":
			val = '<link rel="origin" href="{SOURCE_URL}" />';
			break;
		case "ogdeterminer":
			val = '<meta property="og:determiner" content="{TEXT}" />';
			break;
		case "ogupdatedtime":
			val = '<meta property="og:updated_time" content="{DATE}" />';
			break;
		case "ogseealso":
			val = '<meta property="og:see_also" content="{URL}" />';
			break;
		case "ogttl":
			val = '<meta property="og:ttl" content="{SECONDS}" />';
			break;
		case "fbcustom":
			val = '<meta property="{YOUR_PROPERTY}" content="{CUSTOM_CONTENT}"/>';
		break;	
		case "ogobject":
			val = '<meta property="og:type"   content="object" />';
			break;
        case "ogquick_election":
            val = '<meta property="og:type"   content="quick_election.election" />';
            break;
		
		/* Dublin Core */
		case "dublin_core_title":
			val = '<meta name="DC.title" content="{TITLE}" />';
		break;
		case "dublin_core_description":
			val = '<meta name="DC.description" content="{DESCRIPTION}" />';
			break;
		case "dublin_core_creator":
			val = '<meta name="DC.creator" content="{NAME}" />';
			break;
		case "dublin_core_format":
			val = '<meta name="DC.format" scheme="IMT" content="{FORMAT}" />';
			break;
		case "dublin_core_subject":
			val = '<meta name="DC.subject" content="{SUBJECT}" />';
			break;
		case "dublin_core_publisher":
			val = '<meta name="DC.publisher" content="{PUBLISHER}" />';
			break;
		case "dublin_core_identifier":
			val = '<meta name="DC.identifier" content="{URL}" />';
			break;
		case "dublin_core_language":
			val = '<meta name="DC.language" scheme="RFC1766" content="{CODE}" />';
			break;
		case "dublin_core_date":
			val = '<meta name="DC.date" scheme="W3CDTF" content="{DATE}" />';
			break;
		case "dublin_core_date_modified":
			val = '<meta name="DC.date.modified" scheme="W3CDTF" content="{DATE}" />';
			break;
		case "dublin_core_type":
			val = '<meta name="DC.type" scheme="DCMIType" content="{TYPE}" />';
			break;
		case "dublin_core_source":
			val = '<meta name="DC.source" content="{SOURCE}" />';
			break;
		case "dublin_core_relation":
			val = '<meta name="DC.relation" content="{RELATION}" />';
			break;
		case "dublin_core_coverage":
			val = '<meta name="DC.coverage" content="{COVERAGE}" />';
			break;
		case "dublin_core_rights":
			val = '<meta name="DC.rights" content="{RIGHTS}" />';
			break;
		
		default:
			break;
	}
  
  return val;
}