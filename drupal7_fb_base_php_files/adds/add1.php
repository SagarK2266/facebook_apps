<?php
include_once('../include_files.php');
?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 spectrum(255, 255, 255);
});

 function spectrum(i, j , k){

    var hue = 'rgb(' + i + ',' + j + ',' + k + ')';
    $('h2').css( { color: hue });
    var i = i-1;
    if(i < 1) { var j = j-1; }
    if(j < 1) { var k = k-1; }
    if(k < 1) { var i = 255; var j = 255; var k = 255;}
    setTimeout ( "spectrum(" + i +"," + j + "," + k + ")", 2 );
 }

</script>
</head>
<body>
<?php
//JavaScript SDK code.
include_once(CUSTOM_PHP_FILES . 'common'.DS.'fb_js_sdk_must_include.php');
//End of JavaScript SDK code.
?>
<h2>Send free SMS from India to anywhere in India.</h2>
<div class="fb-like">
<?php include_once(CUSTOM_PHP_FILES.'common/fb-like.php'); ?>
</div>
<div class="fb-invite">
<?php include_once(CUSTOM_PHP_FILES.'common/fb-invite_friends.php'); ?>
</div>
</body>
</html>