<?php
include_once(CUSTOM_PHP_FILES.'include_files.php');
$userInfo = getUserInfoFromSession();
$fromname = "Sagar";//$userInfo['name'];
?>
<table align="left" border="1" >
	<thead>
		<tr>
			<td scope="col">
			<a class="active" href="../drupal7_fb_base_php_files/ajaxCrude/sent_sms.php" target="mid_div" title="Sent SMS">Sent SMS</a></td>
			<td scope="col">
				<span style="color:#800080;"><span style="background-color:#ee82ee;">My SMS Collection</span></span></td>
			<td scope="col">
				<a class="active" href="../drupal7_fb_base_php_files/scheduled-sms.php?displayValidationMessages=false" target="mid_div" title="Scheduled SMS">Scheduled SMS</a></td>
			<td scope="col">
				<a class="active" href="../drupal7_fb_base_php_files/group-sms.php" target="mid_div" title="Group SMS">Group SMS</a></td>
		</tr>
		<tr>
			<td scope="col">
			<a class="active" href="../drupal7_fb_base_php_files/send_sms.php?displayValidationMessages=false" target="mid_div" title="Send Message form">Send Message</a></td>
			<td scope="col">
				<span style="color:#800080;"><span style="background-color:#ee82ee;">App SMS Collection</span></span></td>
			<td scope="col">
				<a class="active" href="../drupal7_fb_base_php_files/ajaxCrude/manage-contacts.php" target="mid_div" title="Manage Contacts">Manage Contacts</a></td>
			<td scope="col">
				<a class="active" href="../drupal7_fb_base_php_files/about-us.php" target="mid_div" title="Help">About  Us</a></td>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>