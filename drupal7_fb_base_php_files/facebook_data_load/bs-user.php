<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

include_once(CUSTOM_PHP_FILES . 'common'.DS.'config_db.inc.php');
include_once(CUSTOM_PHP_FILES . 'common'.DS.'mysql_class'.DS.'Database.class.php');


function CheckAndUpdateUserDatabase($user_id, $access_token, $facebook)
{
	//1) If user record not exists in database then insert that record
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$sql = "SELECT * FROM facebook_user where fb_id=$user_id LIMIT 0 , 1";
	$db->query($sql);
	if($db->affected_rows > 0)
	{
		$userInfoAvailable = "true"; //echo "Success! Number of users found: ". $db->affected_rows;
	}
	else
	{
		$userInfoAvailable = "false"; //echo "Error: No user found.";
	}
	$userInfo = getUserInfoFromSession();
	$friendInfo = getFriendsDataFromSession();
	$friendCount = count($friendInfo);
	if($userInfoAvailable == "false")
	{
		$sql = "INSERT INTO 'facebook_user' 
		('user_id', 'fb_id', 'email', 'fname', 'lname', 'name', 'mobile_number', 'birth_date', 'access_token', 'verification_code', 'is_verified_number', 'ip_address', 'date_created', 'date_modified', 'friend_count', 'app_permissions', 'last_visited_on','visit_count') VALUES 
		(NULL, '$user_id', '{$userInfo['email']}', '{$userInfo['first_name']}', '{$userInfo['last_name']}', '{$userInfo['name']}', '9767025625', '".date('Y-m-d', strtotime($userInfo['birthday']))."', '$access_token', '0', '0', '".$_SERVER['REMOTE_ADDR']."', CURRENT_TIMESTAMP, '0000-00-00 00:00:00', $friendCount, '', '0000-00-00', 1)";
		
		
		$sql = "INSERT INTO `facebook_user` (`user_id`, `fb_id`, `email`, `fname`, `lname`, `name`, `mobile_number`, `birth_date`, `access_token`, `verification_code`, `is_verified_number`, `ip_address`, `date_created`, `date_modified`, `friend_count`, `app_permissions`, `last_visited_on`, `visit_count`) VALUES
(NULL, '$user_id', '{$userInfo['email']}', '{$userInfo['first_name']}', '{$userInfo['last_name']}', '{$userInfo['name']}', '9767025625', '".date('Y-m-d', strtotime($userInfo['birthday']))."', '$access_token', '0', '0', '".$_SERVER['REMOTE_ADDR']."', NOW(), '0000-00-00 00:00:00', $friendCount, NULL, NOW(), 1)";
		$db->query($sql);
		$dbAction = 'insert';
	}
	
	//2) Update some database fields in any case.
	//a)check offline_access_permission, publish_stream_permission, public_actions_permissions are provided by the user.
	updateAppPermissions($db, $user_id, $access_token);
	//b)	
	updateLastVisitedOn($db, $user_id);
	/*//c) TODO: implement required code.
	updateVisitCount($db, $user_id);
		d) TODO: implement required code.
	$serverinfo->UpdateEmailAddress($user_id, $email);
	
	//3) TODO: Update access token in database. So that offline publish on wall will work.
	/*if($userInfoAvailable == "true")
	{
			$access_token_action = "none";
			$curDate = myDate('Y-m-d H:i:s'); //today's date
			$todaysDate = myDate('Y-m-d', strtotime($curDate));
		
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
		$serverinfo->UpdateExtendedPermission($user_id,$publish_stream_perm,$public_actions_perm,$offline_access_perm);
		return $dbAction = 'update'; 
	}*/	
	$db->close();
}

/*
 * Functions for the user database
 */
function updateAppPermissions($db, $user_id, $access_token)
{
	$publish_stream_perm = checkAppUserPermissions(EXT_AUTH_SCOPE, $access_token);
	$public_actions_perm = checkAppUserPermissions(PUBLISH_ACTIONS_EXT_AUTH_SCOPE, $access_token);
	$offline_access_perm = checkAppUserPermissions(OFFLINE_ACCESS_EXT_AUTH_SCOPE, $access_token);
	$permissions = '';
	//echo $publish_stream_perm . ' ' . $public_actions_perm . ' ' . $offline_access_perm;
	$permissions .= $publish_stream_perm ==1?'publish_stream_perm':' - ';
	$permissions .= $public_actions_perm ==1?',public_actions_perm':', -';
	$permissions .= $offline_access_perm ==1?',offline_access_perm':', -'; 
	$sql = "UPDATE ".USER_TABLE."
 			 SET app_permissions = '$permissions'
 			 WHERE fb_id = '" . $user_id . "'";	 
	$db->query($sql);
}

function updateLastVisitedOn($db, $user_id)
{
	$sql = "UPDATE ".USER_TABLE."
 			 SET last_visited_on = NOW()
 			 WHERE fb_id = '" . $user_id . "'";	
	$db->query($sql);
}

?>