<?php
include_once('include_files.php'); 

$userInfo = getUserInfoFromSession();
$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect($new_link=true);

$userInfoDbRecord = getUserInfoDbRecord($db, $userInfo['id']='100001302804650');
//If user has a verified mobile number then redirect to the send sms page else ask him to verify the mobile number.
if($userInfoDbRecord['is_verified_number'] == true)
{
	$loadUrl = "/drupal7_fb_base_php_files/send_sms.php?displayValidationMessages=false";
}
else
{
	$loadUrl = "/drupal7_fb_base_php_files/new_user_step1.php";
}
?>
<p>
	<iframe class="mid_div" id="mid_div" iframe="" name="mid_div" src="<?php echo $loadUrl ?>"></iframe></p>