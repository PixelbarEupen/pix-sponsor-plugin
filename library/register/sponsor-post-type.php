<?php
	
		/*
		
			THIS FILE IS REGISTERS THE POST TYPE INCL. CUSTOM TAXONOMY			
		*/
		
	


//POST TYPE			
if ( ! function_exists('pix_register_sponsor_type') ) {

	// Register Custom Post Type
	function pix_register_sponsor_type() {
	
		$labels = array(
			'name'                => _x( 'Banner', 'Post Type General Name', 'Pixelbar Sponsor Plugin' ),
			'singular_name'       => _x( 'Banner', 'Post Type Singular Name', 'Pixelbar Sponsor Plugin' ),
			'menu_name'           => __( 'Banner', 'Pixelbar Sponsor Plugin' ),
			'parent_item_colon'   => __( 'Übergeordneter Banner', 'Pixelbar Sponsor Plugin' ),
			'all_items'           => __( 'Alle Banner', 'Pixelbar Sponsor Plugin' ),
			'view_item'           => __( 'Banner ansehen', 'Pixelbar Sponsor Plugin' ),
			'add_new_item'        => __( 'Neuen Banner hinzufügen', 'Pixelbar Sponsor Plugin' ),
			'add_new'             => __( 'Neuer Banner', 'Pixelbar Sponsor Plugin' ),
			'edit_item'           => __( 'Banner anpassen', 'Pixelbar Sponsor Plugin' ),
			'update_item'         => __( 'Banner aktualisieren', 'Pixelbar Sponsor Plugin' ),
			'search_items'        => __( 'Banner suchen', 'Pixelbar Sponsor Plugin' ),
			'not_found'           => __( 'Kein Banner gefunden.', 'Pixelbar Sponsor Plugin' ),
			'not_found_in_trash'  => __( 'Kein Banner im Papierkorb gefunden.', 'Pixelbar Sponsor Plugin' ),
		);
		$args = array(
			'label'               => __( 'ad', 'Pixelbar Sponsor Plugin' ),
			'description'         => __( 'Sponsor (Werbung) Post Typ für die Benutzung von Werbung auf der Website.', 'Pixelbar Sponsor Plugin' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'custom-fields', ),
			'taxonomies'          => array( 'bannerplatz' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-megaphone',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);
		register_post_type( 'banner', $args );
	
	}

// Hook into the 'init' action
add_action( 'init', 'pix_register_sponsor_type', 0 );

}


//TAXONOMY
if ( ! function_exists( 'pix_register_bannerplatz_taxonomy' ) ) {

	// Register Custom Taxonomy
	function pix_register_bannerplatz_taxonomy() {
	
		$labels = array(
			'name'                       => _x( 'Bannerplätze', 'Taxonomy General Name', 'Pixelbar Sponsor Plugin' ),
			'singular_name'              => _x( 'Bannerplatz', 'Taxonomy Singular Name', 'Pixelbar Sponsor Plugin' ),
			'menu_name'                  => __( 'Bannerplätze', 'Pixelbar Sponsor Plugin' ),
			'all_items'                  => __( 'Alle Bannerplätze', 'Pixelbar Sponsor Plugin' ),
			'parent_item'                => __( 'Übergeordneter Bannerplatz', 'Pixelbar Sponsor Plugin' ),
			'parent_item_colon'          => __( 'Übergeordnet', 'Pixelbar Sponsor Plugin' ),
			'new_item_name'              => __( 'Neuer Bannerplatz', 'Pixelbar Sponsor Plugin' ),
			'add_new_item'               => __( 'Neuer Bannerplatz', 'Pixelbar Sponsor Plugin' ),
			'edit_item'                  => __( 'Bannerplatz bearbeiten', 'Pixelbar Sponsor Plugin' ),
			'update_item'                => __( 'Bannerplatz aktualisieren', 'Pixelbar Sponsor Plugin' ),
			'separate_items_with_commas' => __( 'Trenne einzelnen Bannerplätze mit einem Komma', 'Pixelbar Sponsor Plugin' ),
			'search_items'               => __( 'Bannerplatz suchen', 'Pixelbar Sponsor Plugin' ),
			'add_or_remove_items'        => __( 'Bannerplätze hinzufügen oder entfernen', 'Pixelbar Sponsor Plugin' ),
			'choose_from_most_used'      => __( 'Wähle aus den meist genutzten Bannerplätzen', 'Pixelbar Sponsor Plugin' ),
			'not_found'                  => __( 'Keinen Bannerplatz gefunden', 'Pixelbar Sponsor Plugin' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => false,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => false,
		);
		register_taxonomy( 'bannerplatz', array( 'banner' ), $args );
	
	}
	
	// Hook into the 'init' action
	add_action( 'init', 'pix_register_bannerplatz_taxonomy', 0 );

}