<?php
include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'fb-app-data.php');
include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'fb-user.php');
include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'fb-friend.php');
include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'_handle_facebook_data.php');
include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'fb-permission.php');
include_once(CUSTOM_PHP_FILES.'facebook_data_load'.DS.'bs-user.php');


//Set access token to session
if(!isNonFacebookDeployment())
{
	$user = $facebook->getUser();
	if(!isset($user) || $user =="0")
	{
		$user = $facebook->getUser();
	}
	
	//TODO - Kalpana and Sagar - Priority 2
	//let's discuss code of authenticateUser... 
	//The idea is to make sure that user is logged in facebook
	// authenticate user
	authenticateUser($user, $facebook);
	
	$UserAccessToken = $facebook->getExtendedAccessToken();
	if($UserAccessToken == false)
	{
		$UserAccessToken = $facebook->getAccessToken();
	}
	//echo $UserAccessToken; exit;
	setSessionVal(SESSION_USER_ACCESS_TOKEN, $UserAccessToken, $serialize = true);
}

/*
 * Store the user info
 */
if(!isNonFacebookDeployment())
{
	$userInfo = getUserInfo($user, $facebook);
	if(AppConfig::STORE_SERIALIZED_DATA)
	{
		storeUserInfo($userInfo);
	}
}
else
{
	$userInfo = readUserInfo();
}
//$userInfo = AnalyzeUserData($userInfo); //No need to analyze users data
setSessionVal(SESSION_USER_INFO, $userInfo, $serialize = true);
$selfId = $userInfo['id'];
$userDataArray[$selfId]= $userInfo;

/*
 * Store the friend list
 */
if(!isNonFacebookDeployment())
{
	//TODO - Sagar - Priority 1
	//Below function is taking time.. 
	//So, we shall be putting some indication that we are loading friend list
	$friendList = getFriendList($user, $facebook);
	if(AppConfig::STORE_SERIALIZED_DATA)
	{
		storeFriendList($friendList);
	}
}
else
{
	$friendList = readFriendList();
}
$friendListCount = count($friendList);
setSessionVal(SESSION_FRIEND_LIST, $friendList, $serialize = true);

/*
 * Store the friend info
 */
if(!isNonFacebookDeployment())
{
	$friendsData = getFriendsData($UserAccessToken, $friendList); //No need to gather friends data
	if(AppConfig::STORE_SERIALIZED_DATA)
	{
		storeFriendInfo($friendsData);
	}
}
else
{
	$friendsData = readFriendInfo();
}

setSessionVal(SESSION_FRIENDS_DATA_ALL, $friendsData, $serialize = true);
traceAppLoad("Friends Data Stored in Session");

/* Update database. */
$dbAction = CheckAndUpdateUserDatabase($user, $UserAccessToken,$facebook);
SetSessionVal(SESSION_userDbAction, $dbAction);


/*
 * Auto publish on app load.
 * TODO: This should be done after the app is loaded. Use Ajax.
 */
if(IsAutoPublishPermitted($user) == true)
{

	/*traceAppLoad("before Auto Post for Login User");
	autoPostForLoginUser($facebook);
	traceAppLoad("After Auto Post for Login User");
	
	//Below code is for the Auto Post of FRIEND BIRTHDAY WISH.
	if(AUTO_POST_FRIEND_BIRTHDAY_WISH == "true")
	{
		postFriendsBirthdayWishForLoginUser($facebook);
	}*/
	
	/*if(FIRST_VISIT_AUTO_POST == "true")
	{
		firstVisitAutoPostForLoginUser($facebook);
	}*/
}
else
{
/*	$logString = "Auto Post on app load will not work for live user $user (".getFriendName($user).") from local deployment</br>";
	appendToAutoPublishLog($logString);*/
}

$landingPageFile = LANDING_PAGE;
traceAppLoad("Landing Page is " . $landingPageFile);
echo("<script> location.href='" . $landingPageFile . "'</script>");

?>