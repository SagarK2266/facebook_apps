<?php
/*
 * Send the verification code.
 * redirect user to the next page only if the sms is sent properly.
 */

include_once('include_files.php');

//Get the parameters
$fromname = AppConfig::APP_MESSAGE_FROM;
$receivernumber = trim(getParameterValue('user-mobile'));
$verification_code = rand(1,2000);
$message = 'Your verification code: '.$verification_code.' \n Enjoy Free SMS.';

//Send the message.
$status = sendMessage($fromname, $receivernumber, $message);

if($status == true)
{
   //update database;
   updateVerificationCode($verification_code, $receivernumber);
   header('location: new_user_step2.php');
}
else
{
   //send user back to try again;
   header('location: new_user_step1.php?error=true');
}

function updateVerificationCode($verification_code, $receivernumber)
{
	$userInfo = getUserInfoFromSession(); //$userInfo['id']
	$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$sql = "UPDATE ".USER_TABLE."
 			 SET verification_code = '$verification_code',
 			 mobile_number = '$receivernumber'
 			 WHERE fb_id = '" . $userInfo['id'] . "'";
	$db->query($sql);
}
?>