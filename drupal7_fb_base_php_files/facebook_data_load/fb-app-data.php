<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements
 * Contains the functions to set the facebook data in the session.
 * Data may be online data or offline data.
 */

include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'src'.DS.'facebook.php');
//Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => FacebookConfiguration::APP_ID,
  'secret' => FacebookConfiguration::ACCESS_TOKEN,
  'fileUpload' => true,
));

function getAppInstallationDetails($access_token)
{
	/*
	 * Checks that the app is installed first time.
	 */

	$appInstallationUrl = "https://graph.facebook.com/me?fields=installed&access_token=$access_token";
	$appInstallationDetails = GetFacebookFileContent($appInstallationUrl);	
	$appInstallationDataObject = json_decode($appInstallationDetails, true);
	$installed = isset($appInstallationDataObject['installed'])?$appInstallationDataObject['installed']:'';
	
	return $installed;
}

function GetFacebookFileContent($url)
{
	//TODO – Log information conditionally in GetFacebookFileContent function
	$response = GetFileContent($url);
	return $response;
}

function authenticateUser($user, $facebook)
{
	if($user == "")
	{
		$user = $facebook->getUser($user);
	}
}

?>