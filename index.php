<?php
	
	/*	
	Plugin Name: Pixelbar Sponsor Plugin
	Author: Adrian Lambertz
	Description: Erweitert Wordpress um eine Sponsor-Rubrik, in der einzelne Logos inkl. Verknüpfungen zu deren Websites platziert werden können.
	Plugin URI: https://github.com/PixelbarEupen/pix-sponsor-plugin
	Version: 0.1.2
	GitHub Plugin URI: https://github.com/PixelbarEupen/pix-sponsor-plugin
	GitHub Access Token: 6ca583973da0e33ee1a6c90c3e4920e6143369ca
	*/

	
	/******************************************************************************************/
	/************************* DO NOT CHANGE ANYTHING AFTER THIS LINE *************************/
	
	
	//DEFINE PLUGIN HTTP PATH
	define('HTTP_PIX_SPONSOR_PATH', plugins_url('pix-sponsor-plugin',dirname(__FILE__)));
	
	//DEFINE PLUGIN UNIX PATH
	define('UNIX_PIX_SPONSOR_PATH', dirname(__FILE__));
	
	//INCLUDE USED SCRIPTS AND STYLES
	include(UNIX_PIX_SPONSOR_PATH.'/library/register/scripts-styles.php');

	//INCLUDE CUSTOM POST TYPE SCRIPT
	include(UNIX_PIX_SPONSOR_PATH.'/library/register/sponsor-post-type.php');

	//INCLUDE CUSTOM META BOX SCRIPT
	include(UNIX_PIX_SPONSOR_PATH.'/library/register/meta-boxes.php');

	//INCLUDE BACKEND SCRIPT
	include(UNIX_PIX_SPONSOR_PATH.'/library/admin/backend.php');
	
	//INCLUDE SHORTCODE HANDLER
	include(UNIX_PIX_SPONSOR_PATH.'/library/output/shortcode.php');
	

?>
