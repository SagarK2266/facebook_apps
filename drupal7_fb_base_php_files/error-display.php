<?php
include_once('include_files.php');
printFormattedArray($_SERVER); exit;
echo "<center><br><br>Ooops... We have encountered a technical issue...<br>";
echo "Kindly <b><a href='#' onclick=\"top.location.href='".FacebookConfiguration::CANVAS_PAGE_URL ."'\">click here</a></b> to reload the application<br><br>";
echo "If you stll face problem,<br>";
echo "Please contact us at";getCustomerMailLink();
?>
<br/>
<br/>
We have a known issue of application not working in Safari browser on Mac.
<br/>
We regret the inconvenience
<br/>
Kindly try other browser
<br/>
<br><br><br><input type="button" value="Reload Application" onclick="top.location.href='<?php echo FacebookConfiguration::CANVAS_PAGE_URL ?>'"/>
<?
function getCustomerMailLink()
{
	?>
	<b><a href="mailto:<?php echo CUSTOMER_CARE_EMAIL; ?>"><?php echo CUSTOMER_CARE_EMAIL; ?></a></b>
	<?php
}
?>