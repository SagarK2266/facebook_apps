<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

/*
 * This file should have all facebook related wrapper functions related to friend information
 */
function getFriendList($user, $facebook)
{
	$friends = $facebook->api('/'.$user.'/friends');
	$friendList = $friends['data'];
	//showFriendLoadProgress($friendCount, $friendIndex, $progressbar);
	return $friendList;
}

function loadFriendsData($friendIdListCurrent, $UserAccessToken)
{
	$userInfoURL = "https://graph.facebook.com/" . 
		"?ids=$friendIdListCurrent" . 
		"&access_token=".$UserAccessToken;
		
	$friendsData = GetFileContent($userInfoURL);	

	$friendsDataObject = json_decode($friendsData, true);
	return $friendsDataObject; 
}

function getFriendsData($UserAccessToken, $friendList)
{
	//TODO - Kalpana - Priority 3
	//The current code works only for first 500 friends
	//Add an issue to modify the code to get information for more than 500 friends

	$friendsData = array();
	$friendsDataCurrent = "";
	$separator = "";
	$friendIndex = 0;
	$friendIdListCurrent = "";
	$friendIdList = "";
	//print_r($friendList);
	$friendCount = count($friendList);
	//echo "friendCount: $friendCount<br/>"; 
	//return $friendsData;
	//load FRIEND_LOAD_DATA_LOT friend id at a time and show progress 
	foreach ($friendList as $friend)
	{
		$friendIndex ++;
		$friendIdListCurrent = $friendIdListCurrent . $separator . $friend['id'] ;
		$separator = ",";
		//echo ($friendIndex % FRIEND_LOAD_DATA_LOT);
		//printNewLine();
		if ((($friendIndex % FRIEND_LOAD_DATA_LOT) == 0) || $friendIndex == $friendCount )
		{
			
			//echo "value of  friendIdListCurrent: ";
			//print_r($friendIdListCurrent);
			$friendsDataCurrent = loadFriendsData($friendIdListCurrent, $UserAccessToken);
			//$friendsData = array_merge($friendsData, $friendsDataCurrent);
			try			
			{
				if(is_array($friendsData) && is_array($friendsDataCurrent))
				{
					$friendsData = $friendsData + $friendsDataCurrent;	//Here + is array union operator
				}
				/*//Intentionally generate exception for some user.
				$userInfo = getUserInfoFromSession();
				$userId = $userInfo['id'];
				if($userId == "100003700883923") 
				{
					throw new Exception("Exception in fb-friend.php");
				}
				*/
			}
			catch(Exception $e)
			{
				$userInfo = getUserInfoFromSession();
				$userId = $userInfo['id'];				
				$traceLog = "Error occured in getFriendsData: ".$e->getMessage() . ": User = " . $userId . ": Friend Count = " . $friendCount . ": Friend Index = " . $friendIndex;
				appendToAutoPublishLog("$traceLog<br/>",$postOutSideApp=true);
				continue;
			}	
			$friendIdList = $friendIdList . "," . $friendIdListCurrent;
/*			if($progressbar != "")
			{
				showFriendLoadProgress($friendCount, $friendIndex, $progressbar);
			}
*/			$separator = "";
			$friendIdListCurrent = "";
		}
	}	
	return $friendsData;
}

?>
