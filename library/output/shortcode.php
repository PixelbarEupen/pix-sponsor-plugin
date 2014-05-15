<?php


	function pix_sponsor_func($atts){
		
		/******************************/
		/*** EXTRACT ALL SHORTCODES ***/
		/******************************/
		extract(shortcode_atts( array(
				'bannerplatz' => '',
				'limit' => -1,
				'large_col' => 4,
				'medium_col' => 4,
				'small_col' => 4,
				'cycle' => get_option('add_cycle'),
				'animation' => get_option('cycle_animation'),
				'timeout' => get_option('cycle_timeout'),
				'show_pager' => get_option('cycle_show_pager'),
				'pause_on_hover' => get_option('cycle_pause_on_hover'),
				'number_per_slide' => get_option('number_of_sponsors_to_cycle')
			), $atts )
		);
		
		
		//SET CORRECT NUMBERS (12 IS THE DEFAULT FOUNDATION GRID)
		if($cycle):
			switch($number_per_slide){
				
				case 2:
					$large_col = 12/2;
					$medium_col = 12/2;
					$small_col = 12/2;
					break;
				
				case 3:
				case 6:
				case 9:
				case 15:
					$large_col = 12/3;
					$medium_col = 12/3;
					$small_col = 12/3;
					break;
					
				case 4:
				case 8:
				case 12:
				case 16:
					$large_col = 12/4;
					$medium_col = 12/4;
					$small_col = 12/4;
					break;
					
				
			}
		else:
			$large_col = 12/$large_col;
			$medium_col = 12/$medium_col;
			$small_col = 12/$small_col;
		endif;
		
		
		//SET ARGS FOR THE WP QUERY
		$args = array(
			'post_type'	=>	'banner',
			'bannerplatz' => $bannerplatz,
			'posts_per_page' => $limit
		);
		$query_banner = new WP_Query( $args );
		
		
		
		/******************************************/
		/*** CHECK IF CYCLE IS ACTIVATED OR NOT ***/
		/*** IF YES, OUTPUT IS CYCLE-SLIDESHOW  ***/
		/*** DIV WITH PARAMETERS. IF NOT, THE   ***/
		/*** PRINT DIV WITHOUT PARAMETERS		***/
		/******************************************/
		if($cycle):
			$output = '<div class="sponsors cycle-slideshow"'; //DIV REMAINS OPEN (BECAUSE THE CYCLE SETTINGS)
				
				//SET THE CYCLE OPTIONS
				$output .= 'data-cycle-fx="'.$animation.'"';
				$output .= 'data-cycle-slides="> .cycle-divider"';
				$output .= 'data-cycle-timeout="'.$timeout.'"';
				if($pause_on_hover):
					$output .= 'data-cycle-pause-on-hover="'.$pause_on_hover.'"';
				endif;
				if($show_pager):
					$output .= 'data-cycle-pager="#pix_plugin_slider"';
					$output .= 'data-cycle-prev="#prev"';
					$output .= 'data-cycle-next="#next"';
				endif;
				
			$output .= '>'; //CLOSE .CYCLE-SLIDESHOW DIV
			
			$output .= '<div class="cycle-divider">'; //OPEN THE .CYCLE-DIVIDER DIV
		else:
			$output = '<div class="sponsors">'; //define output var
		endif;
		$i = 1; //SET ITERATOR
		$end = count((array)$query_banner->posts); //GET AMOUNT OF FOUND BANNERS
		
		/********************************/
		/*********** THE LOOP ***********/
		/********************************/	
		while ( $query_banner->have_posts() ): $query_banner->the_post();
						
			
			$img = wp_get_attachment_image_src(get_post_thumbnail_id(),'medium');
			
			$output .= '<div class="column large-'.$large_col.' medium-'.$medium_col.' small-'.$small_col.'">';
				
				$value = get_post_meta( get_the_ID(), '_pix_url', true );
					
				if($value) { $output .= '<a  href="'.$value.'" title="'.get_the_title().'">'; }
				
					$output .= '<img src="'.$img[0].'" alt="'.get_the_title().'" />';
				
				if($value) { $output .= '</a>'; }

			$output .= '</div>';
			
			
			//IF CYCLE IS ACTIVATED, CHECK FOR THE DIVIDER
			if($cycle):	
				$quotient = $i / $number_per_slide;
				if(is_int($quotient) AND $i != $end):
					$output .= '</div><div class="cycle-divider">';
				endif;
			endif;
			
			
			$i++;
		endwhile;
		
		//IF CYCLE IS ACTIVATED, CLOSE THE .CYCLE-DIVIDER DIV
		if($cycle):
			$output .= '</div>'; //end of cycle-divider
		endif;
		
		$output .= '</div>';
		wp_reset_postdata();
		
		return $output;
		
	}
	
	add_shortcode('sponsoren','pix_sponsor_func');

?>