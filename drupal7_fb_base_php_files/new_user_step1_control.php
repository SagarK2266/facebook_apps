<?php
/*
 * Send the verification code.
 * redirect user to the next page only if the sms is sent properly.
 */

include_once('./common/config.php');
include_once('./common/commonfunctions.php');


//Get the parameters
$fromname = AppConfig::APP_MESSAGE_FROM;
$receivernumber = trim(getParameterValue('user-mobile'));
$verification_code = rand(1,2000);
$message = 'Your verification code: '.$verification_code.' \n Enjoy Free SMS.';

//Send the message.
$status = sendMessage($fromname, $receivernumber, $message);

if($status == true)
{
   //TODO: update database;
   header('location: new_user_step2.php');
}
else
{
   //send user back to try again;
   header('location: new_user_step1.php?error=true');
}
?>