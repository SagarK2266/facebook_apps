<?php
/*
 * Intiate the  app from the core php files and then come back after loading live or offline data.
 * 
 */

$url = '../drupal7_fb_base_php_files/facebook_data_load/fb_sms_index.php?'.$_SERVER['QUERY_STRING'];
/*echo $url; exit;*/
header('location:'.$url);
?>