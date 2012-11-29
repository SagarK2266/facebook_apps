<?php
function writeSerializedValue($data, $fileName)
{
	$filecontents = serialize($data);
	$fileHandle = fopen($fileName, 'w');
	fwrite($fileHandle, $filecontents);
	fclose($fileHandle);
}

function readSerializedValue($fileName) 
{
	$fh = fopen($fileName, 'r');
	$data = fgets($fh);
	fclose($fh);
	return unserialize($data);
}

function storeUserInfo($userInfo)
{
	writeSerializedValue($userInfo, FILENAME_USER_INFO);
}

function storeFriendList($friendList)
{
	writeSerializedValue($friendList, FILENAME_FRIEND_LIST);
}

function storeFriendInfo($friendsData)
{
	writeSerializedValue($friendsData, FILENAME_FRIEND_INFO);
}

function readUserInfo()
{
	return readSerializedValue(FILENAME_USER_INFO);
}

function readFriendList()
{
	return readSerializedValue(FILENAME_FRIEND_LIST);
}

function readFriendInfo()
{
	return readSerializedValue(FILENAME_FRIEND_INFO);
}

function getDataOfFriend($friendId, $friendsData)
{
	$currentFriendData ='';
	if(is_array($friendsData))
	{
		foreach($friendsData as $key=>$friend)
		{
			if($friend['id']==$friendId)
			{
				$currentFriendData = $friend;
				break;	
			}
		}
	}
	return $currentFriendData;
}
?>