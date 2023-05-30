<?php
function aatilpi_get_contact_data() {
    // contact data
	$arr_address=[__('Address', AATILPI_TEXTDOMAIN),'aatilpi_address','textarea',1,'yes',__('Fill in the address of the location', AATILPI_TEXTDOMAIN)];
	$arr_gps_coords=[__('Gps Coordinates', AATILPI_TEXTDOMAIN),'aatilpi_gps_coords','text',2,'yes',__('GPS coordinates seperated with a comma', AATILPI_TEXTDOMAIN)];
	$arr_phone=[__('Phone', AATILPI_TEXTDOMAIN),'aatilpi_phone','text',3,'yes',__('Your landline number', AATILPI_TEXTDOMAIN)];
	$arr_cellphone=[__('Cellphone', AATILPI_TEXTDOMAIN),'aatilpi_cellphone','text',4,'yes',__('Your cellphone number', AATILPI_TEXTDOMAIN)];
	$arr_fax=[__('Fax', AATILPI_TEXTDOMAIN),'aatilpi_fax','text',5,'yes',__('Your fax number', AATILPI_TEXTDOMAIN)];
	$arr_whatsapp=[__('Whatsapp', AATILPI_TEXTDOMAIN),'aatilpi_whatsapp','text',6,'yes',__('This is the number that will be used to send the message. It must be a full phone number in international format.<br>Omit any zeroes, brackets, or dashes when adding the phone number in international format.<br>Examples:<br>Use: 1XXXXXXXXXX<br>Don\'t use: +001-(XXX)XXXXXXX', AATILPI_TEXTDOMAIN)];
	$arr_e_mail=[__('E-mail', AATILPI_TEXTDOMAIN),'aatilpi_e_mail','text',7,'yes',__('Your e-mail address', AATILPI_TEXTDOMAIN)];
	$arr_ordering_link=[__('Ordering link', AATILPI_TEXTDOMAIN),'aatilpi_ordering_link','text',8,'yes',__('If you offer online ordering, enter the URL of your order page here (can be on this site or external) and a link to it will display in your contact card.', AATILPI_TEXTDOMAIN)];
	$arr_skype=[__('Skype', AATILPI_TEXTDOMAIN),'aatilpi_skype','text',9,'no',__('Your Skype account', AATILPI_TEXTDOMAIN)];
	$arr_viber=[__('Viber', AATILPI_TEXTDOMAIN),'aatilpi_viber','text',10,'no',__('Your Viber account', AATILPI_TEXTDOMAIN)];
	$arr_telegram=[__('Telegram', AATILPI_TEXTDOMAIN),'aatilpi_telegram','text',11,'no',__('Your Telegram account', AATILPI_TEXTDOMAIN)];
	$arr_wechat=[__('WeChat', AATILPI_TEXTDOMAIN),'aatilpi_wechat','text',12,'no',__('Your WeChat account', AATILPI_TEXTDOMAIN)];
	$arr_line=[__('Line', AATILPI_TEXTDOMAIN),'aatilpi_line','text',13,'no',__('Your Line account', AATILPI_TEXTDOMAIN)];
	$arr_kakao=[__('KakaoTalk', AATILPI_TEXTDOMAIN),'aatilpi_kakao','text',14,'no',__('Your KakaoTalk account', AATILPI_TEXTDOMAIN)];
	$arr_weibo=[__('Weibo', AATILPI_TEXTDOMAIN),'aatilpi_weibo','text',15,'no',__('Your Weibo account', AATILPI_TEXTDOMAIN)];
    return [$arr_address, $arr_gps_coords, $arr_phone, $arr_cellphone, $arr_fax, $arr_whatsapp, $arr_e_mail, $arr_ordering_link, $arr_skype, $arr_viber, $arr_telegram, $arr_wechat, $arr_line, $arr_kakao, $arr_weibo];
}

function aatilpi_get_legal_info() {
    // legal information
	$arr_VAT=[__('VAT', AATILPI_TEXTDOMAIN),'aatilpi_VAT','text',20,'yes',__('This is your VAT number', AATILPI_TEXTDOMAIN)];
	$arr_company_id=[__('Company ID', AATILPI_TEXTDOMAIN),'aatilpi_company_id','text',21,'yes',__('This is the company ID number with the goverment , can be the same as VAT like in Belgium', AATILPI_TEXTDOMAIN)];
	$arr_prof_id=[__('Professional ID', AATILPI_TEXTDOMAIN),'aatilpi_prof_id','text',22,'yes',__('If you are part of a professional organisation you can add these details here', AATILPI_TEXTDOMAIN)];
	$arr_bank_account=[__('Bank account', AATILPI_TEXTDOMAIN),'aatilpi_bank_account','text',23,'yes',__('This is the company bank account number', AATILPI_TEXTDOMAIN)];
	$arr_bank_bicswift=[__('BIC/SWIFT code', AATILPI_TEXTDOMAIN),'aatilpi_bank_bicswift','text',24,'yes',__('The BIC/SWIFT code of the bank', AATILPI_TEXTDOMAIN)];
    return [$arr_VAT, $arr_company_id, $arr_prof_id, $arr_bank_account, $arr_bank_bicswift];
}

function aatilpi_get_social_media() {
    // social media
	$arr_facebook=[__('Facebook', AATILPI_TEXTDOMAIN),'aatilpi_facebook','text',40,'no',__('Your Facebook page', AATILPI_TEXTDOMAIN)];
	$arr_twitter=[__('Twitter', AATILPI_TEXTDOMAIN),'aatilpi_twitter','text',41,'no',__('Your Twitter handle', AATILPI_TEXTDOMAIN)];
	$arr_instagram=[__('Instagram', AATILPI_TEXTDOMAIN),'aatilpi_instagram','text',42,'no',__('Your Instagram account', AATILPI_TEXTDOMAIN)];
	$arr_youtube=[__('YouTube', AATILPI_TEXTDOMAIN),'aatilpi_youtube','text',43,'no',__('Your YouTube page', AATILPI_TEXTDOMAIN)];
	$arr_reddit=[__('Reddit', AATILPI_TEXTDOMAIN),'aatilpi_reddit','text',44,'no',__('Your Reddit page', AATILPI_TEXTDOMAIN)];
	$arr_discord=[__('Discord', AATILPI_TEXTDOMAIN),'aatilpi_discord','text',45,'no',__('Your Discord page', AATILPI_TEXTDOMAIN)];
	$arr_twitch=[__('Twitch', AATILPI_TEXTDOMAIN),'aatilpi_twitch','text',46,'no',__('Your Twich page', AATILPI_TEXTDOMAIN)];
	$arr_snapchat=[__('Snapchat', AATILPI_TEXTDOMAIN),'aatilpi_snapchat','text',47,'no',__('Your Snapchat account', AATILPI_TEXTDOMAIN)];
	$arr_pinterest=[__('Pinterest', AATILPI_TEXTDOMAIN),'aatilpi_pinterest','text',48,'no',__('Your Pinterest page', AATILPI_TEXTDOMAIN)];
	$arr_linkedin=[__('LinkedIn', AATILPI_TEXTDOMAIN),'aatilpi_linkedin','text',49,'no',__('Your LinkedIn page', AATILPI_TEXTDOMAIN)];
	$arr_tumblr=[__('Tumblr', AATILPI_TEXTDOMAIN),'aatilpi_tumblr','text',50,'no',__('Your Tumblr page', AATILPI_TEXTDOMAIN)];
	$arr_flickr=[__('Flickr', AATILPI_TEXTDOMAIN),'aatilpi_flickr','text',51,'no',__('Your Flickr page', AATILPI_TEXTDOMAIN)];
	$arr_github=[__('GitHub', AATILPI_TEXTDOMAIN),'aatilpi_github','text',52,'no',__('Your GitHub page', AATILPI_TEXTDOMAIN)];
	$arr_bitbucket=[__('Bitbucket', AATILPI_TEXTDOMAIN),'aatilpi_bitbucket','text',53,'no',__('Your Bitbucket page', AATILPI_TEXTDOMAIN)];
	$arr_stackoverflow=[__('Stack Overflow', AATILPI_TEXTDOMAIN),'aatilpi_stackoverflow','text',54,'no',__('Your Stack Overflow page', AATILPI_TEXTDOMAIN)];
	$arr_medium=[__('Medium', AATILPI_TEXTDOMAIN),'aatilpi_medium','text',55,'no',__('Your Medium page', AATILPI_TEXTDOMAIN)];
	$arr_quora=[__('Quora', AATILPI_TEXTDOMAIN),'aatilpi_quora','text',56,'no',__('Your Quora page', AATILPI_TEXTDOMAIN)];
	$arr_vimeo=[__('Vimeo', AATILPI_TEXTDOMAIN),'aatilpi_vimeo','text',57,'no',__('Your Vimeo page', AATILPI_TEXTDOMAIN)];
	$arr_dribbble=[__('Dribbble', AATILPI_TEXTDOMAIN),'aatilpi_dribbble','text',58,'no',__('Your Dribbble page', AATILPI_TEXTDOMAIN)];
	$arr_behance=[__('Behance', AATILPI_TEXTDOMAIN),'aatilpi_behance','text',59,'no',__('Your Behance page', AATILPI_TEXTDOMAIN)];
	$arr_deviantart=[__('DeviantArt', AATILPI_TEXTDOMAIN),'aatilpi_deviantart','text',60,'no',__('Your DeviantArt page', AATILPI_TEXTDOMAIN)];
	$arr_foursquare=[__('Foursquare', AATILPI_TEXTDOMAIN),'aatilpi_foursquare','text',61,'no',__('Your Foursquare page', AATILPI_TEXTDOMAIN)];
    return [$arr_facebook, $arr_twitter, $arr_instagram, $arr_youtube, $arr_reddit, $arr_discord, $arr_twitch, $arr_snapchat, $arr_pinterest, $arr_linkedin, $arr_tumblr, $arr_flickr, $arr_github, $arr_bitbucket, $arr_stackoverflow, $arr_medium, $arr_quora, $arr_vimeo, $arr_dribbble, $arr_behance, $arr_deviantart, $arr_foursquare];
}

// Define additional arrays
define('AATILPI_CONTACT_DATA', aatilpi_get_contact_data());
define('AATILPI_LEGAL_INFO', aatilpi_get_legal_info());
define('AATILPI_SOCIAL_MEDIA', aatilpi_get_social_media());

function aatilpi_get_fields_array() {
    $contact_data = AATILPI_CONTACT_DATA;
    $legal_info = AATILPI_LEGAL_INFO;
    $social_media = AATILPI_SOCIAL_MEDIA;

    return array_merge($contact_data, $legal_info, $social_media);
}

define('AATILPI_FIELDS_ARRAY', aatilpi_get_fields_array());
