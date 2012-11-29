<?php
/*
 * Get the users mobile number and send the verification code.
 */
include_once('./common/config.php');
include_once('./common/commonfunctions.php');
$error = getParameterValue('error');
?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="./css/all-iframe-common.css" />
<script type="text/javascript" src="./scripts/jquery-1.3.1.min.js"></script>
<script type="text/javascript"></script>
</head>
<body>
<form accept-charset="UTF-8" action="new_user_step1_control.php" id="new_user_step1.php" method="post">
<?php if ($error == true):
echo "<div class='notice'>Error occured while sending verification code. Please try again.</div>";
endif;
 ?>
    <div>
        <fieldset class="form-wrapper" id="edit-sms">
            <legend><span class="fieldset-legend">Step-1</span></legend>
            <div class="fieldset-wrapper">
                <div class="form-item form-type-textfield form-item-user-mobile">
                    <label>Enter your mobile number*</label> <input class="form-text required" id="user-mobile" maxlength="20" name="user-mobile" size="20" type="text" value="9767025625" />
                    <div class="notice">
                        Please enter your Mobile Number.</div>
                </div>
            </div>
            <input class="form-submit" type="submit" value="Send" />
            <p/>
               <div class="description">
                        A verification code will be sent to your number which has to be provided in the next step.</div>
        </fieldset>
        </div>
</form>
</body>
</html>