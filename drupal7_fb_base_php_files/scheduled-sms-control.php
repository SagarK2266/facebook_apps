<?php
include_once('include_files.php');

//Get the parameters
$fromname = trim($_REQUEST['fromname']);
$receivernumber = trim($_REQUEST['receivernumber']);
$message = trim($_REQUEST['message']);

$month = trim($_REQUEST['cmb_month']);
$day = trim($_REQUEST['cmb_day']);
$year = trim($_REQUEST['cmb_year']);

$hour = trim($_REQUEST['txthour']);
$minute = trim($_REQUEST['txtminute']);

//echo "$month  $day  $year $hour $minute"; exit;
//Validate the values
$validValues=true;
if($fromname == "" || ($receivernumber == "" || !is_numeric($receivernumber) || strlen($receivernumber) !=10)|| $message == "" || $message == "Enter your message.")
{
	$validValues=false;
	$url = "fromname=$fromname&receivernumber=$receivernumber&message=$message&";
}
if($month == "0" || $day == "0" || $year == "0")
{
	$validValues=false;
	$month = trim($_REQUEST['cmb_month']);
	$day = trim($_REQUEST['cmb_day']);
	$year = trim($_REQUEST['cmb_year']);
	$url .= "&date=wrong&cmb_month=$month&cmb_day=$day&cmb_year=$year";
}
if($hour == "hh" || $year == "yy")
{
	$validValues=false;
	$url .= "&time=wrong&txthour=$hour&txtminute=$minute";
}

if($validValues==false)
{
	$url = 'scheduled-sms.php?'.$url;
	//echo $url; exit;
	header('location:'.$url);
	exit;
}
//Completed the validation code.

$scheduled_on = "$year-$month-$day $hour:$minute:00";//); //2012-12-04 01:00:00
//Store the record in the database.
$status = updateScheduleSmsDB($fromname, $receivernumber, $message, $scheduled_on);

if($status == true)
{
   //drupal_set_message(t('SMS sent successfuly to: '. $receivernumber));
   echo 'SMS scheduled successfully.';
}
else
{
   //form_set_error('', t('Error occured while sending message, please try again!'));
   echo "Error occured! Please try again.";
}

function updateScheduleSmsDB($fromname, $receivernumber, $message, $scheduled_on)
{
	$userInfo = getUserInfoFromSession();
	$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$sql = "INSERT INTO facebook_user_scheduled_sms VALUES (Null, '{$userInfo['id']}', '$receivernumber', '$message','$scheduled_on','0000-00-00 00:00:00', 'idea', '9767025625', '0', '{$_SERVER['REMOTE_ADDR']}', CURRENT_TIMESTAMP, '0000-00-00 00:00:00')";
	/*INSERT INTO facebook_user_scheduled_sms
	VALUES (
			1, '100001302804650', '9767025625', 'wdwefwd', '2012-12-04 01:00:00', '2012-12-04 01:00:00', 'idea', '9767025625', '1', '127.0.0.1', '2012-12-17 00:00:00', '0000-00-00 00:00:00'
	)*/
	$status = $db->query($sql);
	return $status;
}
?>