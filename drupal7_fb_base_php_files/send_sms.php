<?php

include_once('include_files.php');
//include_once('facebook_data_load/fb-app-data.php');
//include_once('facebook_data_load/_handle_facebook_data.php');
//include_once('facebook_data_load/fb-permission.php');

$userInfo = getUserInfoFromSession();
//printFormattedArray($userInfo); exit;
$displayValidationMessages = trim(getParameterValue('displayValidationMessages'));
$fromname = trim(getParameterValue('fromname'));
$receivernumber = trim(getParameterValue('receivernumber'));
$message = trim(getParameterValue('message'));

if($fromname == "")
{
	$fromname=$userInfo['first_name'];
	$fromnameWasBlank=true;
}
else
{
	$fromnameWasBlank=false;
}
$message == ""? $message="Enter your message.":'';

?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="./css/all-iframe-common.css" />
<script type="text/javascript" src="./scripts/jquery-1.3.1.min.js">
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#edit-message').keyup(function () {
	    var left = 140 - $(this).val().length;
	    if (left < 0) {
	        left = 0;
	    }
	    $('#message-counter').text('Characters left: ' + left+'/140');
	    $('#message').text('');
	});

	$('#edit-receivernumber').keyup(function () {
	    $('#edit-receivernumber-notice').text('');
	});
});
</script>
</head>
<body>
<form accept-charset="UTF-8" action="send_sms_control.php" id="send-sms-tutorial-7" method="post">
    <div>
        <fieldset class="form-wrapper" id="edit-sms">
            <legend><span class="fieldset-legend">Enjoy free SMS</span></legend>
            <div class="fieldset-wrapper">
                <div class="form-item form-type-textfield form-item-fromname">
                    <label for="edit-fromname">From <span class="form-required" title="This field is required.">*</span></label> <input class="form-text required" id="edit-fromname" maxlength="20" name="fromname" size="20" type="text" value="<?php echo $fromname ?>" />
                    <div class="notice">
                    <?php
                    if($displayValidationMessages == '')
                    {
                    	echo ($fromnameWasBlank?  "This field can not be empty.":'<br/>');
                    	echo ($fromname == ""?  "Please enter your first name.":'');
                    }
                    else
                    {
                    	echo '<br/>';
                    }
                    ?></div>
                </div>
                <div class="form-item form-type-textfield form-item-receivernumber">
                    <label for="edit-receivernumber">To<span class="form-required" title="This field is required.">*</span> +91</label> <input class="form-text required" id="edit-receivernumber" maxlength="10" name="receivernumber" size="20" type="text" value="<?php echo $receivernumber ?>" />
                    <div class="notice" id="edit-receivernumber-notice">
                    <?php
                    if($displayValidationMessages == '')
                    {
                    	echo (($receivernumber == "" || !is_numeric($receivernumber) || strlen($receivernumber) !=10) ?  "Provide 10 digit mobile number.":'<br/>');
                    }
                    else
                    {
                    	echo '<br/>';
                    }
                    ?></div>
                </div>
                <div class="form-item form-type-textarea form-item-message">
                    <label for="edit-message">Message <span class="form-required" title="This field is required.">*</span></label>
                    <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea">
                        <textarea class="form-textarea required" cols="35" id="edit-message" name="message" rows="6" maxlength="140" name="fromname" onfocus="javascript:if( 'Enter your message.' == this.value ) this.value = ''; " ><?php echo $message ?></textarea>
                    </div>
                    <div class="notice" id='message'>
                    <?php
                    if($displayValidationMessages == '')
                    {
                    	echo ($message == "Enter your message."?  "Enter the message.":'<br/>');
                    }
                    else
                    {
                    	echo '<br/>';
                    }
                    ?></div>
                    <div class="fieldset-legend" id="message-counter"></span>
                </div>
            </div>
            <input class="form-submit" type="submit" value="Send" />
        </fieldset>
        </div>
</form>
</body>
</html>