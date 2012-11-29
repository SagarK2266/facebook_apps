<?php
/*
 * This code will be executed before drupal code is loaded.
 */
include_once('../common/config.php');
include_once('../common/constant.inc.php');
include_once('../common/commonfunctions.php');
include_once('fb-app-data.php');

if(isNonFacebookDeployment())
{
	//header("location: friends_load_data.php");
	include_once('friends-load-data.php');
	exit;
}
$app_id = FacebookConfiguration::APP_ID;
/* //Below code was not found usefull.
$user = $facebook->getUser();
echo $user; exit;
if ($user)
{
  try
  {   
  	$user_profile = $facebook->api('/me');
  }
  catch (FacebookApiException $e)
  {
    error_log($e);
    $user = null;
  }
}*/

$UserAccessToken = $facebook->getExtendedAccessToken();
if($UserAccessToken == false)
{
	$UserAccessToken = $facebook->getAccessToken();
}

/*
* Checks that the app is installed first time.
*/
$appInstallationData = getAppInstallationDetails($UserAccessToken);
if($appInstallationData != "true")
{ 
	$appAuthScope = APP_AUTH_SCOPE.",".EXT_AUTH_SCOPE_INSTALL;
	SetSessionVal(SESSION_FIRST_TIME_INSTALLATION, 'true', $serialize=true);
}
else
{
	$appAuthScope = APP_AUTH_SCOPE;
	SetSessionVal(SESSION_FIRST_TIME_INSTALLATION, 'false', $serialize=true);
}

if(AppConfig::PERMISSION_EMAIL_ADDRESS == 'true')
{
	$appAuthScope .= ",".EMAIL_APP_AUTH_SCOPE;
}

$my_url = FacebookConfiguration::CANVAS_PAGE_URL . "fb_sms_index.php";
$url = 'https://www.facebook.com/dialog/oauth?scope='.$appAuthScope.'&redirect_uri='.urlencode($my_url).'&client_id='.$app_id;

//echo $url; exit;
?>
<html>
<head>
<script type="text/javascript">
function redirect(url)
{
    top.location = url
}
</script>
</head>
<body onload="redirect('<?php echo $url ?>')">
</body>
</html>
