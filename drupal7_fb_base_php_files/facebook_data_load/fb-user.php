<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

/*
 * This file should have all facebook wrapper functions related to user information
 */
function getUserInfo($user, $facebook)
{
	printFormattedArray($facebook);	echo $user;
	//$userInfo = $facebook->api('/'.$user);
	$userInfo = $facebook->api('/me');
	printFormattedArray($userInfo); exit;
	
	return $userInfo;
}

function getUserData($UserAccessToken, $userId)
{
	$getUserDataUrl = 'https://graph.facebook.com/'.$userId.'?access_token='.$UserAccessToken;
	$userData = GetFileContent($getUserDataUrl);
	$userData = json_decode($userData, true);	
	return $userData;
}
?>