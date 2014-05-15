	<?php
	
	/*
		
		THIS FILE GENERATES THE OUTPUT OF THE SETTINGS PAGE.
	
	*/
	
	?>


	<div class="wrap">
		<h2>Pixelbar Sponsoren Plugin</h2>
		
		<form method="post" action="options.php">
			<?php 
				settings_fields( 'pix-sponsors-settings' ); 
				do_settings_sections( 'pix-sponsors-settings' );
			?>
			
			<div class="table-holder">
				<h3><div class="dashicons dashicons-images-alt"></div> Cycle</h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Cycle Funktionalität aktivieren</th>
						<td>
							<input id="add_cycle" type="checkbox" value="1" <?php if ( get_option('add_cycle')) echo 'checked="checked"'; ?> name="add_cycle" />
						</td>
						<hr />
					</tr>
				</table>
				<table class="form-table show-when-checked">	
					<tr valign="top">
						<th scope="row">Anzahl Sponsoren</th>
						<td>
							<input type="number" value="<?php echo get_option('number_of_sponsors_to_cycle'); ?>" min="1" max="16" name="number_of_sponsors_to_cycle" />
							<p class="description">Anzahl Sponsoren, die pro Slide angezeigt werden (von einem bis zu 16). Beachte, dass das 12-Grid Layout nicht alle ungeraden Zahlen zulässt (5 Sponsoren wären z.B. nicht möglich)</p>
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Animation</th>
						<td>
							<select name="cycle_animation">
							  <?php $animations = array('fade','scrollHorz'); ?>
							  <?php foreach ($animations as $animation): ?>
							    <?php if( $animation == get_option('cycle_animation')){ $sel = 'selected'; } else { $sel = ''; } ?>
							    <option <?php echo $sel; ?> value="<?php echo $animation ?>"><?php echo $animation ?></option>
							  <?php endforeach; ?>
							</select>
							<p class="description">'fade' verblasst die einzelnen Slides, während 'scrollHorz' horizontal die Slides nach links und rechts slidet.</p>
		
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Timeout</th>
						<td>
							<input value="<?php echo get_option('cycle_timeout'); ?>" name="cycle_timeout" type="number" min="0" max="100000"/>
							<p class="description">Zeit die zwischen den einzelnen Slides vergeht. In Millisekunden. (1000 = 1 Sekunde) 0 stoppt den Slider.</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Zeige vor und zurück Buttons</th>
						<td>
							<input name="cycle_show_pager" type="checkbox" value="1" <?php if ( get_option('cycle_show_pager')) echo 'checked="checked"'; ?> name="cycle-show-pager" />
							<p class="description">Sollen die Pager angezeigt werden? Beachte, dass ein Pager aktiv sein sollte, sobald der Timeout auf 0 gesetzt wurde.</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Pause beim Hovern</th>
						<td>
							<input name="cycle_pause_on_hover" type="checkbox" value="1" <?php if ( get_option('cycle_pause_on_hover')) echo 'checked="checked"'; ?> name="cycle-pause" />
							<p class="description">Soll die Slideshow anhalten, sobald mit der Maus über sie gehovert wird?</p>
						</td>
					</tr>
				</table>
			</div>
			
			<div class="table-holder">
				<h3><div class="dashicons dashicons-desktop"></div> CSS</h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Lade CSS</th>
						<td>
							<input id="load_css" type="checkbox" value="1" <?php if ( get_option('load_css')) echo 'checked="checked"'; ?> name="load_css" />
							<p class="description">Das CSS reduziert sich auf Abstände und Breitenangaben.</p>
						</td>
						<hr />
					</tr>
				</table>
			</div>

			
			<?php submit_button(); ?>
		</form>
		
		
		<script type="text/javascript">
			jQuery(document).ready(function($){
				var checked = $('#add_cycle').attr('checked'),
					table   = $('.show-when-checked');
				
				if(checked === 'checked'){
					table.show();
				} else {
					table.hide();
				}
				
				$('#add_cycle').on('change', function(){
					
					checked = $(this).attr('checked')
					
					if(checked === 'checked'){
						table.fadeIn();
					} else {
						table.fadeOut();
					}
					
				});		
			});
		</script>
	</div>