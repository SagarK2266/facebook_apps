<?php
			/***********Lib File***********/
/* Note: Do not modify this file for the application specific requirements */

include_once('config.php');
include_once('browser.php');

$browser = new Browser();
if($browser->getBrowser() == "Firefox")
{
	$height = 'height:500px;';
}
else
{
	$height = 'height:100%;';
}

if(!($browser->getBrowser() == "Internet Explorer" && $browser->getVersion()=='8.0'))
{
?>
<iframe scrolling="yes" id="" name="" class="fb_ltr" style="<?php echo $height;?>"
src="https://www.facebook.com/plugins/comments.php?api_key=<?php echo FacebookConfiguration::APP_ID ?>&amp;
href=<?php echo FacebookConfiguration::CANVAS_PAGE_URL ?>&amp;locale=en_US&amp;numposts=10&amp;sdk=joey&amp;width=740"></iframe>
<?php
}
?>