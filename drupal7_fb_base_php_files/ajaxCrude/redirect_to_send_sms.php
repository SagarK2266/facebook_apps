<?php
	include_once('../include_files.php');
	$sendToContactId = getParameterValue('sendToContactId');
	
	$db = new MyDatabase(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	
	$contactDbRecord = getContactDbRecord($db, $sendToContactId);
	header('location:'. CUSTOM_PHP_FILES_HTTP_PATH.'send_sms.php?displayValidationMessages=false&receivernumber='.$contactDbRecord['contact_number'] );
	exit;

function getContactDbRecord($db, $sendToContactId)
{
	$sql = "SELECT contact_number FROM facebook_user_contacts where contact_id=$sendToContactId";
	$result = $db->query($sql);
	$contactDbRecord = mysql_fetch_assoc($result);
	return $contactDbRecord;
}	
?>
