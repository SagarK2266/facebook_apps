<?php

			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

function IsAutoPublishPermitted()
{
	
}
/*
function PermissionReleationshipStatusAvailable()
{
	return (PERMISSION_RELATIONSHIP_STATUS == 'true');
}

function CheckForDirectSharing($facebook, $specialInternalUsers)
{
	//check if we need to show custom dialog for special case
	$submitMsg = "autoshare";	
	if(SHOW_SHARING_CUSTOM_DIALOG == 'true')
	{
		$submitMsg = "";
	}
	if(IsSpecialInternalUsers($facebook, $specialInternalUsers))
	{
		$submitMsg = "";
	}
	return $submitMsg;
}

function IsSpecialInternalUsers($facebook, $specialInternalUsers, $uid = "")
{
	if($uid == "")
	{
		$uid = $facebook->getUser();
	}
	
	if(in_array($uid, $specialInternalUsers))
	{ 
	 	return true;
	}
	else 
	{	
		return false;
	}
}

function IsTestUser($uid)
{
	$appId = FacebookConfiguration::APP_ID;	
	$appAccessToken = FacebookConfiguration::ACCESS_TOKEN;
   	$testUsers = GetTestUsersList($appId, $appAccessToken);   	
   	$testUser = CheckCurrentUserIsTestUser($uid,$testUsers);
   	return $testUser;
}

function GetTestUsersList($appId, $appAccessToken)
{
	$url = "https://graph.facebook.com/$appId/accounts/test-users?access_token=$appId|$appAccessToken&limit=500";
	$testUsers = GetFileContent($url);
	$testUsersArray = json_decode($testUsers, true);	
	return $testUsersArray;
}

function CheckCurrentUserIsTestUser($uid,$testUsers)
{
	$testUserIndex = 0;
	$userIsTestUser = '';
	foreach($testUsers as $testUser)
	{
		for($user = $testUserIndex;$user < count($testUser);$user++)
		{
			if(isset($testUser[$user]['id']))
			{
				if($testUser[$user]['id'] == $uid)
				{					
					return "true";					
				}
			}
		}
	}	
} */

function checkAppUserPermissions($user_perm, $access_token)
{
	//This Function can be used for to check the available permission.
	$userPermissionsUrl = "https://api.facebook.com/method/users.hasAppPermission?ext_perm=$user_perm&access_token=$access_token&format=json";	
	$userPublishPerm = GetFileContent($userPermissionsUrl);	
	return $userPublishPerm;
}

?>