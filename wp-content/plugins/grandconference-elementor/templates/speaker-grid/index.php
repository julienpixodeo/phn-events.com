<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();

	//Get spacing class
	$spacing_class = '';
	if($settings['spacing'] != 'yes')
	{
		$spacing_class = 'has-no-space';
	}
	else 
	{
		$spacing_class = 'wide-space';
	}
		
	$column_class = 3;
	
	$thumb_image_name = 'grandconference-gallery-grid';
	if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
	{
		//If display original dimension and less initial items then display higher resolution image
		if($settings['image_dimension'] == 'medium_large' && $settings['ini_item']['size'] < 3)
		{
			$settings['image_dimension'] = 'large';
		}
		
		$thumb_image_name = $settings['image_dimension'];
	}
		
	//Start displaying gallery columns
	switch($settings['columns']['size'])
	{
		case 1:
		   	$column_class = 'grandconference-one-cols';
		   	$thumb_image_name = 'original';
		break;
		   	
		case 2:
		   	$column_class = 'grandconference-two-cols';
		break;
		   	
		case 3:
		default:
		   	$column_class = 'grandconference-three-cols';
		break;
		   	
		case 4:
		   	$column_class = 'grandconference-four-cols';
		break;
		   	
		case 5:
		   	$column_class = 'grandconference-five-cols';
		break;
	}
	
	//Get all team contents
	$speaker_order = 'ASC';
	$speaker_order_by = 'menu_order';
	switch($settings['order'])
	{
		case 'default':
			$speaker_order = 'ASC';
			$speaker_order_by = 'menu_order';
		break;
		
		case 'newest':
			$speaker_order = 'DESC';
			$speaker_order_by = 'post_date';
		break;
		
		case 'oldest':
			$speaker_order = 'ASC';
			$speaker_order_by = 'post_date';
		break;
		
		case 'title':
			$speaker_order = 'ASC';
			$speaker_order_by = 'title';
		break;
		
		case 'random':
			$speaker_order = 'ASC';
			$speaker_order_by = 'rand';
		break;
	}
	
	//Get team items
	$args = array(
		'order' => $speaker_order,
		'orderby' => $speaker_order_by,
		'post_type' => array('speaker'),
	);
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$args['speakercat'] = $settings['cat'];
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$args['numberposts'] = $settings['items']['size'];
	}
	
	$slides = get_posts($args);
	$count_slides = count($slides);
	
	if(!empty($slides))
	{
?>
<div class="grandconference-gallery-grid-content-wrapper layout-<?php echo esc_attr($column_class); ?> <?php echo esc_attr($spacing_class); ?>">
<?php		
		$last_class = '';
		$count = 1;
		
		foreach ( $slides as $slide ) 
		{
			$member_ID = $slide->ID;
			$speaker_desciption = get_post_meta($member_ID, 'speaker_desciption', true);
			$speaker_link = get_permalink($member_ID);
			
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}
			
			//Get customer picture
			if(has_post_thumbnail($member_ID, 'thumbnail'))
			{
				$image_id = get_post_thumbnail_id($member_ID);
				$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
				
				//Get image meta data
				$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
				$speaker_link = get_permalink($member_ID);
			}
?>
		<div class="gallery-grid-item static-hover <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?>"">
			<div class="speaker-grid-image">
				<a href="<?php echo esc_url($speaker_link); ?>">
					<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
				</a>
			</div>
			<?php
				//Display title and excerpt
				if(!empty($slide->post_title))
				{
			?>
				<div class="speaker-grid-content">
					<div class="overflow-inner">
						<div class="overflow-text">
							<h3 class="speaker-grid-title">
								<a href="<?php echo esc_url($speaker_link); ?>">
									<?php echo esc_html($slide->post_title); ?>
								</a>
							</h3>
							<div class="speaker-grid-subtitle"><?php echo esc_html($speaker_desciption); ?></div>
						</div>
					</div>
				</div>
			<?php
				}

			$count++;
		?>
		</div>
		<?php
		}
?>
	<?php
		if($settings['spacing'] == 'yes')
		{
	?>
	<br class="clear"/>
	<?php
		}
	?>
</div>
<?php
	}
?>