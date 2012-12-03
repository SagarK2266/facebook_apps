<?php
//TODO : Write a php script which will create this file and contents will be written so that site can be run in drupal mode when required.
require 'drupal_mode_flag.php';
//require '../drupal7_fb_base_php_files/common/config.php';

/*CONSTANT TO HAVE BETTER PATH IN THE CODE*/
if(!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}
if(!defined('FB_SMS_FOLDER'))
{
	define('FB_SMS_FOLDER', 'drupal7_fb_base');
}
if(!defined('FB_SMS_CORE_FILES_FOLDER'))
{
	define('FB_SMS_CORE_FILES_FOLDER', FB_SMS_FOLDER.'_php_files');
}
if(!defined('CUSTOM_PHP_FILES'))
{
	define('CUSTOM_PHP_FILES', $_SERVER["DOCUMENT_ROOT"].DS.FB_SMS_CORE_FILES_FOLDER.DS);
}
if(!defined('CUSTOM_PHP_FILES_HTTP_PATH'))
{
	define('CUSTOM_PHP_FILES_HTTP_PATH', 'http://test.lcl/'.FB_SMS_CORE_FILES_FOLDER.'/');
}

if(DRUPAL_MODE == 'off')
{
 	$url = '../drupal7_fb_base_php_files/facebook_data_load/index.php';
 	include_once($url);
}
else
{

/** Original code of this file. *******

 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
menu_execute_active_handler();

}
