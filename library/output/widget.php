<?php

class pix_sponsor_plugin extends WP_Widget {

	/****************************/
	/**** WIDGET CONSTRUCTOR ****/
	/****************************/
	function pix_sponsor_plugin() {
		parent::WP_Widget(false, $name = __('Sponsor Widget', 'Pixelbar Sponsor Plugin') );
	}


	/******************************/
	/**** WIDGET FORM CREATION ****/
	/******************************/
	function form($instance) {	
		// Check values
		
		
		$add_cycle = (get_option('add_cycle') == 1) ? 'on' : '';
		$show_pager = (get_option('cycle_show_pager') == 1) ? 'on' : '';
		$pause_on_hover = (get_option('cycle_pause_on_hover') == 1) ? 'on' : '';

		$bannerplatz = (isset($instance['bannerplatz'])) ? esc_attr($instance['bannerplatz']) : '';
		$limit = (isset($instance['limit'])) ? esc_attr($instance['limit']) : -1;
		$add_cycle = (isset($instance['add_cycle'])) ? esc_attr($instance['add_cycle']) : $add_cycle;
		$number = (isset($instance['n_o_s'])) ? esc_attr($instance['n_o_s']) : get_option('number_of_sponsors_to_cycle');
		$animation = (isset($instance['animation'])) ? esc_attr($instance['animation']) : get_option('cycle_animation');
		$timeout = (isset($instance['timeout'])) ? esc_attr($instance['timeout']) : get_option('cycle_timeout');
		$show_pager = (isset($instance['show_pager'])) ? esc_attr($instance['show_pager']) : $show_pager;
		$pause_on_hover = (isset($instance['pause_on_hover'])) ? esc_attr($instance['pause_on_hover']) : $pause_on_hover;
		

	?>
		
		<p>
			<label for="<?php echo $this->get_field_id('bannerplatz'); ?>"><?php _e('Bannerplatz:', 'Pixelbar Sponsor Plugin'); ?></label>
			<select id="<?php echo $this->get_field_id('bannerplatz'); ?>" name="<?php echo $this->get_field_name('bannerplatz'); ?>">
			  <?php $bannerplaetze = get_terms('bannerplatz'); print_r($bannerplaetze); ?>
			  <?php foreach ($bannerplaetze as $plaetze): ?>
			    <option <?php if($bannerplatz == $plaetze->name){ echo 'selected'; } ?>  value="<?php echo $plaetze->name ?>"><?php echo $plaetze->name ?></option>
			  <?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Anzahl Sponsoren die Insgesamt angezeigt werden sollen. -1 gibt alle aus.', 'Pixelbar Sponsor Plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" min="-1" max="1000000" />
		</p>
		
		<hr />
		<p>
			<label for="<?php echo $this->get_field_id('add_cycle'); ?>">
				<?php _e('Cycle aktivieren', 'Pixelbar Sponsor Plugin'); ?>
			</label>
			<input class="checkbox" type="checkbox" <?php checked($add_cycle, 'on'); ?> id="<?php echo $this->get_field_id('add_cycle'); ?>" name="<?php echo $this->get_field_name('add_cycle'); ?>" />
		</p>
		<div id="<?php echo $this->get_field_id('show_when_checked'); ?>">
			<p>
				<label for="<?php echo $this->get_field_id('n_o_s'); ?>"><?php _e('Anzahl Sponsoren pro Slide:', 'Pixelbar Sponsor Plugin'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('n_o_s'); ?>" name="<?php echo $this->get_field_name('n_o_s'); ?>" type="number" value="<?php echo $number; ?>" min="1" max="16" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Animation:', 'Pixelbar Sponsor Plugin'); ?></label>
				<select id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>">
				  <?php $animations = array('fade','scrollHorz'); ?>
				  <?php foreach ($animations as $ani): ?>
				    <option <?php if($animation == $ani){ echo 'selected'; } ?>  value="<?php echo $ani ?>"><?php echo $ani ?></option>
				  <?php endforeach; ?>
				</select>

			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('timeout'); ?>"><?php _e('Dauer zwischen Slides', 'Pixelbar Sponsor Plugin'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('timeout'); ?>" name="<?php echo $this->get_field_name('timeout'); ?>" type="number" value="<?php echo $timeout; ?>" min="0" max="100000" step="100" />
				<p class="description"><?php _e('In Millisekunden (1000 = 1 Sekunde). 0 stoppt den Slider.', 'Pixelbar Sponsor Plugin'); ?></p>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('show_pager'); ?>">
					<?php _e('Cycle Pager anzeigen', 'Pixelbar Sponsor Plugin'); ?>
				</label>
				<input class="checkbox" type="checkbox" <?php checked($show_pager, 'on'); ?> id="<?php echo $this->get_field_id('show_pager'); ?>" name="<?php echo $this->get_field_name('show_pager'); ?>" />
				<p class="description"><?php _e('Sollen die Pager angezeigt werden? Beachte, dass ein Pager aktiv sein sollte, sobald der Timeout auf 0 gesetzt wurde.', 'Pixelbar Sponsor Plugin'); ?></p>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('pause_on_hover'); ?>">
					<?php _e('Pause on Hover', 'Pixelbar Sponsor Plugin'); ?>
				</label>
				<input class="checkbox" type="checkbox" <?php checked($pause_on_hover, 'on'); ?> id="<?php echo $this->get_field_id('pause_on_hover'); ?>" name="<?php echo $this->get_field_name('pause_on_hover'); ?>" />
			</p>
			
			<p class="description">
				<?php _e('Diese obenstehenden Einstellungen betreffen das Widget nur, wenn auch die Cycling-Animation aktiviert ist.', 'Pixelbar Sponsor Plugin'); ?>
			</p>
		</div>
		<hr />
		
		<?php
			/**************************************/
			/**** JAVASCRIPT FOR USE IN WIDGET ****/
			/**************************************/
		?>
		<script type="text/javascript">
			jQuery(function($){
				
				
				
				var checked = $('#<?php echo $this->get_field_id('add_cycle'); ?>').attr('checked'),
					table   = $('#<?php echo $this->get_field_id('show_when_checked'); ?>');
				
				if(checked === 'checked'){
					table.show();
				} else {
					table.hide();
				}
				
				$('#<?php echo $this->get_field_id('add_cycle'); ?>').on('change', function(){
					checked = $(this).attr('checked')
					
					if(checked === 'checked'){
						table.fadeIn();
					} else {
						table.fadeOut();
					}
					
				});	
				
				
				
					
			});
		</script>
		
		
		<?php
	}
	
	
	/*************************/
	/**** UPDATE FUNCTION ****/
	/*************************/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
	      // Fields
	      $instance['bannerplatz'] = strip_tags($new_instance['bannerplatz']);
	      $instance['limit'] = strip_tags($new_instance['limit']);
	      $instance['add_cycle'] = strip_tags($new_instance['add_cycle']);
	      $instance['animation'] = strip_tags($new_instance['animation']);
	      $instance['n_o_s'] = strip_tags($new_instance['n_o_s']);
	      $instance['timeout'] = strip_tags($new_instance['timeout']);
	      $instance['show_pager'] = strip_tags($new_instance['show_pager']);
	      $instance['pause_on_hover'] = strip_tags($new_instance['pause_on_hover']);
	     return $instance;
	}


	/************************/
	/**** WIDGET DISPLAY ****/
	/************************/
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$bannerplatz = $instance['bannerplatz'];
		$limit = $instance['limit'];
		$add_cycle = ($instance['add_cycle'] == 'on') ? true : false;
		$animation = $instance['animation'];
		$number = $instance['n_o_s'];
		$timeout = $instance['timeout'];
		$show_pager = ($instance['show_pager'] == 'on') ? 'true' : 'false';
		$pause_on_hover = ($instance['pause_on_hover'] == 'on') ? 'true' : 'false';


		// Display the widget

		echo do_shortcode('[sponsoren 
								cycle="'.$add_cycle.'"
								animation="'.$animation.'"
								timeout="'.$timeout.'"
								show_pager="'.$show_pager.'"
								pause_on_hover="'.$pause_on_hover.'"
								number_per_slide="'.$number.'"
								bannerplatz="'.$bannerplatz.'"
								limit="'.$limit.'"
							]');


	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("pix_sponsor_plugin");'));

?>