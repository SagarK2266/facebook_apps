<?php
include_once('_session.php');
/*
 * Functions related to the SMS.
*/
function sendMessage($fromname, $receivernumber, $message)
{ 
   require_once 'Way2SMS-API/way2sms-api.php';
   $way2smsConfigArray = unserialize(way2smsConfigArray);
   $username = array_rand($way2smsConfigArray);
   $password = $way2smsConfigArray[$username];
   $message = "From $fromname: ". $message;
   $sentSmsStatus = sendWay2SMS ($username , $password , $receivernumber, $message);
   //$sentSmsStatus =  Array (0 => Array ('phone' => '9767025625', 'msg' => "From Sagar: test", 'result' => 1 ) ) ;
   //print_r($sentSmsStatus[0]['result']);
   if(is_array($sentSmsStatus) && isset($sentSmsStatus[0]['result']))
   {
   	$status = $sentSmsStatus[0]['result'];
   }
   else
   {
   	$status = false;
   }
   return $status;
}

/*
 * Functions related to the .
*/

function getParameterValue($paramName)
{
	$parameterValue = "";
	if(isset($_POST[$paramName]))
	{
		$parameterValue = $_POST[$paramName];
	}
	if($parameterValue == "")
	{
		if (isset($_GET[$paramName])) 
		{
			$parameterValue = $_GET[$paramName];   	 		
		}
	}
	return $parameterValue;
}

/*
 * Functions related to getting data from a url.
*/
function GetFileContent($url) 
{
	//2BeChanged-For local deployment, uncomment below line file_get_contents
	//and comment GetXMLFileContent line as curl does not work locally
  	$file_contents = file_get_contents($url);
  	//$file_contents = GetXMLFileContent($url);
	return $file_contents;
}

function GetXMLFileContent($url) 
{
    $ch = curl_init($url);
    $timeout = 10;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode < "300") 
    {
        $file_contents = curl_exec($ch);
    }
    else 
    {
        $file_contents = "";
    }
   
    return $file_contents;

}

function GetHTTPProtocol()
{
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
	{
		return "https";
	}
	else
	{
		return "http";
	}	
}

/*
 * Functions related check the condition.
*/
function isNonFacebookDeployment()
{
	return AppConfig::NON_FACEBOOK_DEPLOYMENT;
}

/*Misc*/
function printFormattedArray($dataArray, $label='', $return=false)
{
	$stringData = "<pre>$label <br/>".print_r($dataArray, true)."</pre>";
	if($return == true)
	{
		return $stringData;
	}
	else
	{
		echo $stringData;
	}
}

function getMicroTime()
{
	$t = microtime(true);
	$micro = sprintf("%06d",($t - floor($t)) * 1000000);
	$d = new DateTime( myDate('Y-m-d H:i:s.'.$micro,$t) );
	$microTime = $d->format("Y-m-d H:i:s.u");
	return $microTime;
}

function myDate($format, $timestamp='')
{
	$myDate = '';
	if($timestamp == '')
	{
		if(TODAYS_DATE == "")
		{
			$myDate = date($format);
		}
		else
		{
			$myDate = date($format, strtotime(TODAYS_DATE));
		}
	}
	else
	{
		$myDate = date($format, $timestamp);
	}
	return $myDate;
}

?>