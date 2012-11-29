<?php
include_once('include_files.php');

//Get the parameters
$fromname = trim($_REQUEST['fromname']);
$receivernumber = trim($_REQUEST['receivernumber']);
$message = trim($_REQUEST['message']);

//Send the message.
$status = sendMessage($fromname, $receivernumber, $message);

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

?>