<?php
//Application common files
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'config.php');
include_once(CUSTOM_PHP_FILES . 'common'.DS.'commonfunctions.php');
include_once(CUSTOM_PHP_FILES . 'common'.DS.'constant.inc.php');
//include_once(CUSTOM_PHP_FILES . 'common'.DS.'permission.php');
//include_once(CUSTOM_PHP_FILES . 'common'.DS.'checkDirectInvocation.php');

//Database class and constants
include_once(CUSTOM_PHP_FILES . 'common'.DS.'config_db.inc.php');
include_once(CUSTOM_PHP_FILES . 'common'.DS.'mysql_class'.DS.'Database.class.php');

include_once(CUSTOM_PHP_FILES . 'ajax'.DS.'general-ajax-call.php');
?>