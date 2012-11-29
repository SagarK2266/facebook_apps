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
	if(!strpos($_SERVER['REQUEST_URI'], 'friend-list-index.php') && !strpos($_SERVER['REQUEST_URI'], 'friends-load-data.php') && !strpos($_SERVER['REQUEST_URI'], 'index.php') && !strpos($_SERVER['REQUEST_URI'], 'fb-auto-publish.php'))
	{
		if($userInfo == "")
		{
			?>
			<script> location.href='<?php echo FacebookConfiguration::THE_FACEBOOK_URL.'/error-display.php' ?>'</script>
			<?php
			exit;
		}
	}
	return $userInfo;
}

function getFriendsDataFromSession()
{
	$friendsData = GetSessionVal(SESSION_FRIENDS_DATA_CURRENT, $deserialize = true);
if(!strpos($_SERVER['REQUEST_URI'], 'friend-list-index.php') && !strpos($_SERVER['REQUEST_URI'], 'friends-load-data.php') && !strpos($_SERVER['REQUEST_URI'], 'index.php') && !strpos($_SERVER['REQUEST_URI'], 'fb-auto-publish.php'))
	{
		if($friendsData == "")
		{
			?>
			<script> location.href='<?php echo FacebookConfiguration::THE_FACEBOOK_URL.'/error-display.php' ?>'</script>
			<?php
			exit;
		}
	}
	return $friendsData;
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