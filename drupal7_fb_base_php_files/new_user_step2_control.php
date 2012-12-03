<?php
/*
 * Get the verification code from database and the one entered by user.
 * If both are equal then update the database as a verified user.
 * else
 * update the database for the number of attempts.
 * if number of attempts exceeds 5 then assign the verification code as expired and show message to the user.
 *
 * So all the interaction will happen betweeen the step2 and the step2_control page.
 */

include_once('include_files.php');
include_once(CUSTOM_PHP_FILES . 'common'.DS.'config_db.inc.php');
include_once(CUSTOM_PHP_FILES . 'common'.DS.'mysql_class'.DS.'Database.class.php');

$verification_code = trim(getParameterValue('verification-code'));
$userInfo = getUserInfoFromSession();

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
$sql = "SELECT * FROM facebook_user where fb_id={$userInfo['id']} LIMIT 0 , 1";
$userDbRecord = $db->query($sql);

if($verification_code == $userDbRecord['verification_code'])
{
	echo "User is verified.";
}
else
{
	echo "User is not verified.";
}
