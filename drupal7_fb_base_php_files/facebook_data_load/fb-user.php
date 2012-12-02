<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

/*
 * This file should have all facebook wrapper functions related to user information
 */
function getUserInfo($user, $facebook)
{
	$userInfo = $facebook->api("/$user");
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