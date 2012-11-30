<?php 
include_once('../common/config.php');
include_once('../common/commonfunctions.php');
include_once('fb-app-data.php');  
//include_once('bs-user.php'); //TODO: Database operations 

$code = $_REQUEST["code"];
if(isset($_REQUEST["error"]))	//User Not Logged in to the facebook.
{
	$accessDeniedError = $_REQUEST["error"];
}
else
{
	$accessDeniedError = '';
}
if($accessDeniedError != "")
{
	$usersLinks = "http://www.facebook.com/";
	echo("<script>top.location.href='" . $usersLinks . "'</script>");	
}

if($code)
{
	include_once('friends-load-data.php');
}
else
{
   	//TODO: What if empty code?
}

?>