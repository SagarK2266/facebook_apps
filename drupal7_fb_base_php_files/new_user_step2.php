<?php
/*
 * Get the users mobile number and send the verification code.
 */
?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="./css/all-iframe-common.css" />
<script type="text/javascript" src="./scripts/jquery-1.3.1.min.js"></script>
<script type="text/javascript"></script>
</head>
<body>
<form accept-charset="UTF-8" action="new_user_step2_control.php" id="new_user_step1.php" method="post">
    <div>
        <fieldset class="form-wrapper" id="edit-sms">
            <legend><span class="fieldset-legend">Step-2</span></legend>
            <div class="fieldset-wrapper">
                <div class="form-item form-type-textfield form-item-verification-code">
                    <label>Enter the verification code which is sent to your phone*</label>
                    <input class="form-text required" name="verification-code" id="edit-verification-code" maxlength="20" size="30" type="text" value="xxxx" />
                    <div class="notice">
                        Please enter verification code.</div>
                </div>
            </div>
            <input class="form-submit" type="submit" value="Send" />
            <p/>
        </fieldset>
        </div>
</form>
</body>
</html>