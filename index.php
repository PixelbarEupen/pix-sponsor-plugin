<?php
	
	/*	
	Plugin Name: Pixelbar Sponsor Plugin
	Author: Adrian Lambertz
	Description: Erweitert Wordpress um eine Sponsor-Rubrik, in der einzelne Logos inkl. Verknüpfungen zu deren Websites platziert werden können.
	Plugin URI: https://github.com/PixelbarEupen/pix-sponsor-plugin
	Version: 0.1.1
	
	*/
	
	
	/* 	CONFIGURATION */
	
	
		
	/******************************************************************************************/
	/************************* DO NOT CHANGE ANYTHING AFTER THIS LINE *************************/
	
	include('includes/register.php');
	include('includes/register-sponsor-post-type.php');
	include('includes/register-meta-box.php');
	//include('includes/backend.php');
	
	
	//THE MAIN FUNCTION
	function pix_sponsor_func($atts = array('echo' => true, 'bannerplatz' => '')){
		
		//create var with defaults
		$echo = (isset($atts['echo'])) ? $atts['echo'] : true;
		$platz = (isset($atts['bannerplatz'])) ? $atts['bannerplatz'] : '';
		
		$args = array(
			'post_type'	=>	'banner',
			'bannerplatz' => $platz,
			'posts_per_page' => -1
		);
		
		
		$query_banner = new WP_Query( $args );
		
		
		$output = '<div class=" sponsors">'; //define output var
		while ( $query_banner->have_posts() ):
			$query_banner->the_post();
			
			$img = wp_get_attachment_image_src(get_post_thumbnail_id(),'medium');
			
			$output .= '<div class="column large-3 ">';
				
				$value = get_post_meta( get_the_ID(), '_pix_url', true );
				
				if($value) { $output .= '<a  href="'.$value.'" title="'.get_the_title().'">'; }
					$output .= '<img src="'.$img[0].'" alt="'.get_the_title().'" />';
				if($value) { $output .= '</a>'; }
			$output .= '</div>';
			
		endwhile;
		$output .= '</div>';
		wp_reset_postdata();
		
		
		
		if($echo):
			echo $output;
		else:
			return $output;
		endif;
		
	}
	
	?>