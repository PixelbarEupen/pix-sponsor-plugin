<?php 
	
	/*
	
		THIS FILE REGISTERS THE NECESSARY JS AND CSS FILES FOR USE WITH THIS PLUGIN.
		ADDITIONALLY, IT ENQUEUES THE JQUERY PLUGIN, IF IT ISNT ALREADY
	
	*/
	
	
	//REGISTER NECESSARY FILES
		function pix_sponsors_register_css(){	
			if(get_option('load_css')):
				wp_register_style( 'sponsors-css', HTTP_PIX_SPONSOR_PATH.'/assets/css/sponsors.css');
				wp_enqueue_style( 'sponsors-css' );
			endif;
		}
		add_action( 'wp_enqueue_scripts', 'pix_sponsors_register_css', 100 );
		
		
		//REGISTER NECESSARY FILES
		function pix_sponsors_register_js(){

			wp_enqueue_script('jquery');
						
			if(get_option('add_cycle')):
				wp_register_script( 'cycle2', HTTP_PIX_SPONSOR_PATH .'/assets/js/cycle.js');
				wp_enqueue_script( 'cycle2' );
			endif;
		}
		add_action( 'wp_enqueue_scripts', 'pix_sponsors_register_js', 100 );
