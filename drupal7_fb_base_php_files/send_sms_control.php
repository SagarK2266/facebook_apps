<?php
include_once('include_files.php');

//Get the parameters
$fromname = trim($_REQUEST['fromname']);
$receivernumber = trim($_REQUEST['receivernumber']);
$message = trim($_REQUEST['message']);

//Validate the values
if($fromname == "" || ($receivernumber == "" || !is_numeric($receivernumber) || strlen($receivernumber) !=10)|| $message == "" || $message == "Enter your message.")
{
	$url = "fromname=$fromname&receivernumber=$receivernumber&message=$message&";
	$url = 'send_sms.php?'.$url;
	//echo $url; exit;
	header('location:'.$url);
	exit;
}


//Send the message.
$status = sendMessage($fromname, $receivernumber, $message);

updateSmsDB($fromname, $receivernumber, $message, $status);

if($status == true)
{
   //drupal_set_message(t('SMS sent successfuly to: '. $receivernumber));
   echo 'SMS sent successfuly to: '. $receivernumber;
}
else
{
   //form_set_error('', t('Error occured while sending message, please try again!'));
   echo "Error occured while sending message.";
}

function updateSmsDB($fromname, $receivernumber, $message, $status)
{
	$userInfo = getUserInfoFromSession();
	$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$sql = "INSERT INTO `facebook_user_sms` (`sms_id`, `fb_id`, `receiver_number`, `message`, `carrier_name`, `carrier_number`, `is_delivered`, `ip_address`, `date_created`, `date_modifed`)
			VALUES (Null, '{$userInfo['id']}', '$receivernumber', '$message', 'idea', '9767025625', '$status', '{$_SERVER['REMOTE_ADDR']}', CURRENT_TIMESTAMP, '0000-00-00 00:00:00')";
	$db->query($sql);
}
?>