<?php

/*

	THIS FILE CREATES THE BACKEND MENU ITEM AND THE REGISTERS THE USED SETTINGS.

*/


if(!function_exists('pix_sponsors_menu')):
	
	function pix_sponsors_menu(){
	    	//register menu element
	    	add_options_page('Sponsoren', 'Sponsoren', 'manage_options', 'sponsoren-menu', 'pix_sponsors_options');
	    	
	    	//call register settings function
			add_action( 'admin_init', 'pix_sponsors_register_settings' );
	}
	add_action('admin_menu','pix_sponsors_menu');
	
endif;


if(!function_exists('pix_sponsors_options')):	

	//this is the callback function from the menu element
	function pix_sponsors_options(){
	    	include(plugin_dir_path(__FILE__).'/options-page.php');
	    	
	}

endif;

	
if(!function_exists('pix_sponsors_register_settings')):

	function pix_sponsors_register_settings() {
	//register our settings
		
		register_setting( 'pix-sponsors-settings', 'load_css' );
		
		register_setting( 'pix-sponsors-settings', 'add_cycle' );
		register_setting( 'pix-sponsors-settings', 'cycle_animation' );
		register_setting( 'pix-sponsors-settings', 'cycle_timeout' );
		register_setting( 'pix-sponsors-settings', 'cycle_show_pager' );
		register_setting( 'pix-sponsors-settings', 'cycle_pause_on_hover' );
		register_setting( 'pix-sponsors-settings', 'number_of_sponsors_to_cycle' );
	}

endif;