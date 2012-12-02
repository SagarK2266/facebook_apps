<?php

include_once('include_files.php');
//include_once('facebook_data_load/fb-app-data.php');
//include_once('facebook_data_load/_handle_facebook_data.php');
//include_once('facebook_data_load/fb-permission.php');

/*$userInfo = getUserInfoFromSession(); printFormattedArray($userInfo); exit;*/

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
                    <label for="edit-fromname">From <span class="form-required" title="This field is required.">*</span></label> <input class="form-text required" id="edit-fromname" maxlength="20" name="fromname" size="20" type="text" value="First Name" />
                    <div class="notice">
                        Please enter your first name.</div>
                </div>
                <div class="form-item form-type-textfield form-item-receivernumber">
                    <label for="edit-receivernumber">To<span class="form-required" title="This field is required.">*</span> +91</label> <input class="form-text required" id="edit-receivernumber" maxlength="10" name="receivernumber" size="20" type="text" value="9767025625" />
                    <div class="notice">
                        Provide 10 digit mobile number.</div>
                </div>
                <div class="form-item form-type-textarea form-item-message">
                    <label for="edit-message">Message <span class="form-required" title="This field is required.">*</span></label>
                    <div class="form-textarea-wrapper resizable textarea-processed resizable-textarea">
                        <textarea class="form-textarea required" cols="40" id="edit-message" name="message" rows="6" maxlength="140" name="fromname" size="140">Enter your message</textarea>
                    </div>
                    <div class="notice" id="message-counter">
                    Message length 140 chars
                        </div>
                </div>
            </div>
            <input class="form-submit" type="submit" value="Send" />
        </fieldset>
        </div>
</form>
</body>
</html>