<?php
define('EXT_AUTH_SCOPE_INSTALL', 'publish_stream,user_photos,friends_photos, publish_actions');
define('EXT_AUTH_SCOPE', 'publish_stream');
define('EMAIL_APP_AUTH_SCOPE', 'email');
define('PUBLISH_ACTIONS_EXT_AUTH_SCOPE', 'publish_actions');
define('OFFLINE_ACCESS_EXT_AUTH_SCOPE', 'offline_access');
define('AUTO_POST_AUTH_SCOPE', 'publish_stream');
define('TODAYS_DATE', ''); //define('TODAYS_DATE', '06/31/2012');
if (AppConfig::PERMISSION_RELATIONSHIP_STATUS == 'true')
{
	define('APP_AUTH_SCOPE', 'user_birthday,friends_birthday,friends_relationships,friends_interests,user_relationships,user_interests,offline_access');
}
else
{
	define('APP_AUTH_SCOPE', 'user_birthday,friends_birthday,offline_access');
}

/*
define('POST_ON_WALL_DESC', 'Ever wonder about the trivia of the friend information. Maniac ways to see the demographics fact of various factors and aspects of the data. The application presents the most fun way to know the trivia of friends demographics info across tons of facet never seen before. Check the numbers churned in various ways and experience the lighter side of numerology and astrology. Most elite way to see the group of friends having common characteristics.');
define('POST_BIRTHDAY_ON_WALL_DESC', 'Wishing you all the best in the year to come. May your days be filled with sunshine and beautiful colors and may your nights be filled with comforting dreams and wishes to come.');
define('POST_ON_WALL_CAPTION', 'www.paramss.com');
define('CUSTOMER_CARE_EMAIL', 'psspl_emp@paramss.com');
define('APP_REQUEST_MESSAGE','Experience fun-filled journey from Trivia to Mania - Param Software Services');
define('APP_BIRTHDAY_MESSAGE','Wishing you the happiest of birthdays; Hope this is your best year yet.');
define('APP_BELATED_BIRTHDAY_MESSAGE','No excuse is good enough for missing your birthday!  A very Happy Belated Birthday.');
define('APP_ADVANCE_BIRTHDAY_MESSAGE','Wishing you health, happiness and love on your special day and always. Happy Birthday In Advance.');
define('APP_REQUEST_WALL_PICTURE', 'http://paramss.com/fb/images/ftdm/publish-feed.jpg');
define('IMAGE_PATH', 'http://paramss.com/fb/friends-trivia-demographics-mania/');
define('APP_BIRTHDAY_WALL_PICTURE', 'http://paramss.com/fb/images/ftdm/postonwall/set000/birthday.jpg');
define('TEMPORARY_STRING', '@#~#@');
*/
define('FILENAME_USER_INFO', './_data/user-info.dat'); //getcwd().
define('FILENAME_FRIEND_LIST', './_data/friend-list.dat');
define('FILENAME_FRIEND_INFO', './_data/friend-info.dat');
/*
define('EMAIL_TO', 'sagarkelkar1234@gmail.com');
*/

/*
 * Session constants.
*/
define('SESSION_FIRST_TIME_INSTALLATION', '');

define('SESSION_USER_INFO', 'SESSION_userInfo');
define('SESSION_FRIEND_LIST', 'SESSION_friendList');
define('SESSION_FRIENDS_DATA_ALL', 'SESSION_friendDataAll');
define('SESSION_USER_ACCESS_TOKEN', 'SESSION_userAccessToken');
define('SESSION_TRACE_APP_LOAD', 'TraceAppLoad');
define('SESSION_userDbAction', 'userDbAction');	//TRack that user record was updated or inserted.
define('SESSION_FIRST_TIME_INSTALLATION', 'appInstallation'); // used to store the first time app installation

?>