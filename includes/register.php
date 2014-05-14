<?php 
	
	/*
	
		THIS FILE REGISTERS THE NECESSARY JS AND CSS FILES FOR USE WITH THIS PLUGIN.
		ADDITIONALLY, IT ENQUEUES THE JQUERY PLUGIN, IF IT ISNT ALREADY
	
	*/
	
	
	//REGISTER NECESSARY FILES
		function sponsors_register_files(){	
			wp_register_style( 'sponsors-css', plugins_url( '/css/sponsors.css' , dirname(__FILE__ )));
			wp_enqueue_style( 'sponsors-css' );
		}
		add_action( 'wp_enqueue_scripts', 'sponsors_register_files', 100 );
