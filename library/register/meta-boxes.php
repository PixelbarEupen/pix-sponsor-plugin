<?php
	
		/*
		
			THIS FILE IS REGISTERS THE ADDITIONAL METABOXES	
		*/
		
	


//POST TYPE			


	add_action( 'add_meta_boxes', 'pix_sponsor_url_meta_box' );

	// backwards compatible (before WP 3.0)
	// add_action( 'admin_init', 'title_pager_meta_box', 1 );
	
	/* Do something with the data entered */
	add_action( 'save_post', 'pix_sponsor_save_postdata' );
	
	
	if ( ! function_exists('pix_sponsor_url_meta_box') ) {
	
		/* Adds a box to the main column on the Post and Page edit screens */
		function pix_sponsor_url_meta_box() {
		    $screens = array( 'banner' );
		    foreach ($screens as $screen) {
		        add_meta_box(
		            'pix_sponsor_url',
		            __( 'URL des Sponsors', 'pix_sponsor_plugin' ),
		            'pix_sponsor_inner_box',
		            $screen
		        );
		    }
		}
		
	}

	if ( ! function_exists('pix_sponsor_inner_box') ) {
	
		/* Prints the box content */
		function pix_sponsor_inner_box( $post ) {
		
		  // Use nonce for verification
		  wp_nonce_field( plugin_basename( __FILE__ ), 'pix_sponsor_noncename' );
		
		  // The actual fields for data entry
		  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
		  $value = get_post_meta( $post->ID, '_pix_url', true );
		  echo '<label for="pix_sponsor_url_field">';
		       _e("Gebe hier die URL der Website des Sponsors ein, auf die geleitet wird, sobald der Besucher auf die Werbefläche klickt.", 'pix_sponsor_plugin' );
		  echo '</label> ';
		  echo '<input type="text" id="pix_sponsor_url_field" name="pix_sponsor_url_field" value="'.esc_attr($value).'" size="25" />';
		}
	
	}
	
	if ( ! function_exists('pix_sponsor_save_postdata') ) {
	
		/* When the post is saved, saves our custom data */
		function pix_sponsor_save_postdata( $post_id ) {
			
			
		  // First we need to check if the current user is authorised to do this action. 
		  if(isset($_POST['post_type'])){
			  if ( 'banner' == $_POST['post_type'] ) {
			    if ( ! current_user_can( 'edit_page', $post_id ) )
			        return;
			  } else {
			    if ( ! current_user_can( 'edit_post', $post_id ) )
			        return;
			  }
		  }
		
		  // Secondly we need to check if the user intended to change this value.
		  if ( ! isset( $_POST['pix_sponsor_noncename'] ) || ! wp_verify_nonce( $_POST['pix_sponsor_noncename'], plugin_basename( __FILE__ ) ) )
		      return;
		
		  // Thirdly we can save the value to the database
		
		  //if saving in a custom table, get post_ID
		  $post_ID = $_POST['post_ID'];
		  //sanitize user input
		  $mydata = sanitize_text_field( $_POST['pix_sponsor_url_field'] );
		
		  // Do something with $mydata 
		  // either using 
		  add_post_meta($post_ID, '_pix_url', $mydata, true) or
		    update_post_meta($post_ID, '_pix_url', $mydata);
		  // or a custom table (see Further Reading section below)
		}
	
	}