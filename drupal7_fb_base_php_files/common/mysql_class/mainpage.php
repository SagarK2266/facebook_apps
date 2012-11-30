<?php

// every page needs to start with these basic things

// 1) pull in the file with the database class
require("Database.class.php");

// 2) create the $db object
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);

// 3) connect to the server
$db->connect();

#####
// 4) your main code would go here

$sql = "SELECT *
FROM `facebook_user`
LIMIT 0 , 30" ;
$db->query($sql);

if($db->affected_rows > 0){
	echo "Success! Number of users found: ". $db->affected_rows;
}
else{
	echo "Error: No user found.";
}

#####

// 5) and when finished, remember to close connection
$db->close();



//URL: http://test.lcl/drupal7_fb_base_php_files/common/mysql_class/mainpage.php
?>