<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */


//include_once('./comp/userinfo_bs.php');
//include_once('constant.inc');
include_once('fb-friend.php');
include_once('fb-user.php');

function CheckAndUpdateUserDatabase($user_id, $access_token, $facebook)
{
	//$serverinfo = new serverinfo_bs();
	$userData = array();
	$access_token_action = "none";
	$userInfoAvailable = '';   
	$curDate = myDate('Y-m-d H:i:s'); //today's date 
	$todaysDate = myDate('Y-m-d', strtotime($curDate));	
	$friendList = getFriendList($user_id, $facebook);
	$friendListCount = count($friendList);
	$userInfo = getUserInfo($user_id, $facebook);
	$email = $userInfo['email']; 
	//check offline_access_permission, publish_stream_permission, public_actions_permissions.
	$publish_stream_perm = checkAppUserPermissions(EXT_AUTH_SCOPE, $access_token);
	$public_actions_perm = checkAppUserPermissions(PUBLISH_ACTIONS_EXT_AUTH_SCOPE, $access_token);
	$offline_access_perm = checkAppUserPermissions(OFFLINE_ACCESS_EXT_AUTH_SCOPE, $access_token);
	if($serverinfo != NULL)	
	{    	
		foreach ($serverinfo->serverInfoDataArray as $userDataArray)	    
		{

			if (in_array($user_id, $userDataArray, true))
			{
				$access_token_updated_on = $userDataArray["access_token_updated_on"];
				$access_token_updated_on = date('Y-m-d', strtotime($access_token_updated_on));
				$userInfoAvailable = "true";
				if($access_token_updated_on < ACCESS_PERMISSION_UPDATED_ON)
				{
					$access_token_action = "update";
				}		
				$todaysDate = date('Y-m-d', strtotime($curDate));				
				$access_token_updated_on = strtotime(date("Y-m-d", strtotime($access_token_updated_on)) . " +".ACCESS_TOKEN_UPDTE_DURATION." day");		
				$new_access_token_on = date("Y-m-d",$access_token_updated_on);
				
				if($todaysDate > $new_access_token_on)
				{
					//'time to store new access token
					$access_token_action = "update";
				}             
			}        
		}  
	}    
	if($userInfoAvailable != "true")
	{		
		$serverinfo->InsertDbObject($user_id,$access_token,'0000-00-00','0000-00-00','0',$curDate,'0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00');
		$serverinfo->UpdateInstalledOn($user_id);
		$serverinfo->UpdateFriendCount($user_id, $friendListCount);	
		$serverinfo->UpdateLastVisitedOn($user_id);
		$serverinfo->UpdateDistributionCollagePost($user_id, '0000-00-00');
		$serverinfo->UpdateSpBdaysBouquet($user_id, '0000-00-00');
		$serverinfo->updateTraitsPostChoicePage($user_id, 'null');
		$serverinfo->UpdateAgeTraits($user_id, '0000-00-00');
		$serverinfo->UpdateExtendedPermission($user_id,$publish_stream_perm,$public_actions_perm,$offline_access_perm);
		$serverinfo->UpdateEmailAddress($user_id, $email);
		return $dbAction = 'insert';
	}
	if($userInfoAvailable == "true")
	{
		$serverinfo->UpdateVisitCount($user_id);
		$serverinfo->UpdateVisitDayCount($user_id, $todaysDate);
		$serverinfo->UpdateLastVisitedOn($user_id);
	}	
	if ($access_token_action == "update")
	{
		//update access token in database and update access_token_updated_on with today's date		
		$serverinfo->ModifyDbObjectAccessToken($user_id, $access_token, $curDate);
		$serverinfo->UpdateFriendCount($user_id, $friendListCount);
		$serverinfo->UpdateEmailAddress($user_id, $email);
		// modify offline_access_permission, publish_stream_permission, public_actions_permissions in DB
		$serverinfo-> UpdateExtendedPermission($user_id,$publish_stream_perm,$public_actions_perm,$offline_access_perm);
		return $dbAction = 'update'; 
	}	
}

?>