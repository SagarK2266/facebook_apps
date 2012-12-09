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

$verification_code = trim(getParameterValue('verification-code'));
$userInfo = getUserInfoFromSession();

$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

$userInfoDbRecord = getUserInfoDbRecord($db, $userInfo['id']);

if($verification_code == $userInfoDbRecord['verification_code'])
{
	updateUserStatus();
	echo "You are now verified user. click here to start sending sms.";
	echo '<a href="send_sms.php">Send SMS</a>';
}
else
{
	//send user back to try again;	
	header('location: new_user_step2.php?error=true');	
}

function updateUserStatus()
{
	$userInfo = getUserInfoFromSession();
	$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$sql = "UPDATE ".USER_TABLE."
 			 SET is_verified_number = '1'
 			 WHERE fb_id = '" . $userInfo['id'] . "'";
	$db->query($sql);
}
