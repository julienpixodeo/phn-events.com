<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	$redirect_to_page = get_permalink( get_the_ID() );
	if(isset($settings['action']) && !empty($settings['action']))
	{
		$redirect_to_page = get_permalink($settings['action']);
	}
	
	$keyword = '';
	if(isset($_GET['keyword']) && !empty($_GET['keyword']))
	{
		$keyword = $_GET['keyword'];
	}
	if(isset($_GET['s']) && !empty($_GET['s']))
	{
		$keyword = $_GET['s'];
	}
	
	$start_date = '';
	if(isset($_GET['start_date']))
	{
		$start_date = $_GET['start_date'];
	}
	
	//Get number of selected fields to calculate column size
	$count_fields = count($settings['fields']);
	switch($count_fields)
	{
		case 1:
		default:
			$column_class = 'grandconference-two-cols';
		break;
		
		case 2:
			$column_class = 'grandconference-three-cols';
		break;
		   
		case 3:
			$column_class = 'grandconference-four-cols';
		break;
		   
		case 4:
			$column_class = 'grandconference-five-cols';
		break;
	}
	
	if(!empty($count_fields))
	{
?>
<div class="tg-event-search-wrapper"> 	
	<form id="tg-event-search-form-<?php echo esc_attr($widget_id); ?>" class="tg-event-search-form <?php if(isset($settings['autocomplete']) && $settings['autocomplete'] == 'yes') { ?>autocomplete-form<?php } ?>" method="get" action="<?php echo esc_url($redirect_to_page); ?>" data-result="autocomplete-<?php echo esc_attr($widget_id); ?>">
		<?php
			if(in_array('keyword', $settings['fields']))
			{
		?>
			<div class="input-group <?php echo esc_attr($column_class); ?>">
				<input type="text" name="keyword" placeholder="<?php echo __( 'Search Event', 'grandconference-elementor' ); ?>" autocomplete="off" value="<?php echo esc_attr($keyword); ?>"/>
				<?php
					if(isset($settings['autocomplete']) && $settings['autocomplete'] == 'yes')
					{
				?>
					<div id="autocomplete-<?php echo esc_attr($widget_id); ?>" class="autocomplete" data-mousedown="false"></div>
		    	<?php
			    	}
			    	
			    	if (function_exists('icl_object_id')) {
				?>
			    	<input id="lang" name="lang" type="hidden" value="<?php echo esc_attr(ICL_LANGUAGE_CODE); ?>"/>
				<?php
					}
				?>
			</div>
		<?php
			}
			
			if(in_array('category', $settings['fields']))
			{
				$event_cats = grandconference_get_event_cat();
		?>
			<div class="input-group <?php echo esc_attr($column_class); ?>">
				<select id="cat" name="cat">
						<option value=""><?php echo __( 'Select Category', 'grandconference-elementor' ); ?></option>
					<?php
						foreach($event_cats as $key => $event_cat)	
						{
							if(!empty($key)) 
							{
					?>
							<option value="<?php echo esc_attr($key); ?>" <?php if(isset($_GET['cat']) && $_GET['cat']==$key) { ?>selected<?php } ?>><?php echo esc_attr($event_cat); ?></option>
					<?php
							}	
						}
					?>
				</select>
			</div>
		<?php
			}
			
			if(in_array('category', $settings['fields']))
			{
				$event_locations = grandconference_get_event_location();
		?>
			<div class="input-group <?php echo esc_attr($column_class); ?>">
				<select id="location" name="location">
						<option value=""><?php echo __( 'Select Location', 'grandconference-elementor' ); ?></option>
					<?php
						foreach($event_locations as $key => $event_location)	
						{
							if(!empty($key)) 
							{
					?>
							<option value="<?php echo esc_attr($key); ?>" <?php if(isset($_GET['location']) && $_GET['location']==$key) { ?>selected<?php } ?>><?php echo esc_attr($event_location); ?></option>
					<?php
							}	
						}
					?>
				</select>
			</div>
		<?php
			}
			
			if(in_array('date', $settings['fields']))
			{
			?>
				<div class="input-group <?php echo esc_attr($column_class); ?>">
					<input type="date" name="start_date" placeholder="<?php echo __( 'Select Start Date', 'grandconference-elementor' ); ?>" autocomplete="off" value="<?php echo esc_attr($start_date); ?>"/>
				</div>
		<?php
			}
		?>
		
		<div class="input-group-button <?php echo esc_attr($column_class); ?> last">
			<input type="submit" value="<?php echo __( 'Search', 'grandconference-elementor' ); ?>"/>
		</div>
	</form>
</div><br class="clear"/>
<?php
	}
?>