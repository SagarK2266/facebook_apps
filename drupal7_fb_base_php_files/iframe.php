<?php
include_once('include_files.php'); 
/*$userInfo = getUserInfoFromSession();
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$userInfoDbRecord = getUserInfoDbRecord($db,$userInfo['id']);
 */

$loadUrl = "/drupal7_fb_base_php_files/send_sms.php";
?>
<p>
	<iframe class="mid_div" id="mid_div" iframe="" name="mid_div" src="<?php echo $loadUrl ?>"></iframe></p>