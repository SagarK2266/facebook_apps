<?php
/* IE fix for iframe */
if(!headers_sent())
{
	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
}
ini_set('log_errors',"On");
ini_set('error_log',"_error.log");
//ini_set('display_errors', "Off");

error_reporting(-1); 
date_default_timezone_set('Asia/Calcutta'); 
if (!isset($_SESSION)) 
{
	session_start();
}

//Add only facebook related constants.
class FacebookConfiguration 
{
	const APP_ID = "284004578387380";
	const ACCESS_TOKEN = "2091a3e5a11255a9fed1cf47c87a6e0c";
	const CANVAS_PAGE_URL = "http://apps.facebook.com/284004578387380/";
	const THE_FACEBOOK_URL = 'http://localhost/drupal7_fb_base/';	
}

//Add only app related constants.
class AppConfig
{
	const NON_FACEBOOK_DEPLOYMENT = false;	//true: means off-line deployment
	const STORE_SERIALIZED_DATA = true;	//true: Store facebook data in the serialized files
	const LIVE_DEPLOYMENT = false;
	const APP_MESSAGE_FROM = "fbsms";
	const PERMISSION_RELATIONSHIP_STATUS = false;
	const PERMISSION_EMAIL_ADDRESS = false;
	//const SHOW_INTERNAL_PAGES = false;
}
define('LANDING_PAGE', FacebookConfiguration::THE_FACEBOOK_URL.'index1.php');

//class SMSConfig{
/* $way2smsConfig is an array of usernames as key and passwords as values.
 * Any one of them will be randomly used for sending message.
 * 
*/
define('way2smsConfigArray',  serialize(array(
'9767025625'=>'9764144266',
//'9767025626'=>'9764144265',
//'9767025627'=>'9764144267',
)));
//}

if(!defined('FB_SMS_FOLDER'))
{
	define('FB_SMS_FOLDER', 'drupal7_fb_base');
	define('CUSTOM_PHP_FILES', $_SERVER["DOCUMENT_ROOT"].'/'.FB_SMS_FOLDER.'_php_files/');
}
?>