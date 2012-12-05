<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

function GetSessionVal($session_name, $deserialize=false)
{
	if(isset($_SESSION[$session_name]))
	{
		$value = $_SESSION[$session_name];
		if($deserialize == true)
		{
			$value = unserialize($value);
		}
	}
	else
	{
		$value = "";
	}
	return $value;

}

function SetSessionVal($session_name, $value, $serialize=false)
{
	if($serialize == true)
	{
		$value = serialize($value);
	}
	$_SESSION[$session_name] = $value;
}

function getUserInfoFromSession()
{
	$userInfo = GetSessionVal(SESSION_USER_INFO, $deserialize = true);
	if(!allowBlankSession())
	{
		if($userInfo == "")
		{
			?>
			<script> location.href='<?php echo CUSTOM_PHP_FILES_HTTP_PATH.'error-display.php' ?>'</script>
			<?php
			exit;
		}
	}
	return $userInfo;
}

function getFriendsDataFromSession()
{
	$friendsData = GetSessionVal(SESSION_FRIENDS_DATA_ALL, $deserialize = true);
	if(!allowBlankSession())
	{
		if($friendsData == "")
		{
			?>
			<script> location.href='<?php echo CUSTOM_PHP_FILES_HTTP_PATH.'error-display.php' ?>'</script>
			<?php
			exit;
		}
	}
	return $friendsData;
}

function allowBlankSession()
{
	/*Allow to have blank user info or friends info on this pages. and not display error page even if that is null.
	 * */
	$allow = false;
	$allowBlankUserAndFriendInfoPages = array('fb_sms_index.php',  'friends-load-data.php' , 'index.php', 'fb-auto-publish.php');
	foreach ($allowBlankUserAndFriendInfoPages as $page)
	{
		if(strpos($_SERVER['REQUEST_URI'], $page))
		{
			$allow = true;
			break;
		}
	}
	return $allow;
}

function traceAppLoad($str, $append = true)
{
	if($append == true)
	{
		$current = getSessionVal(SESSION_TRACE_APP_LOAD,  $serialize = true);
		$current .= "<br/>";
	}
	else
	{
		$current = "";
	}
	$current = $current . getMicroTime() . ":" . $str;
	setSessionVal(SESSION_TRACE_APP_LOAD, $current, $serialize = true);
}

?>