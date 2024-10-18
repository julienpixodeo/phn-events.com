<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	//Get testimonial items
	$args = array(
		'order' => 'menu_order',
		'orderby' => 'ASC',
		'post_type' => array('testimonials'),
	);
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$args['testimonialcats'] = $cat;
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$args['numberposts'] = $settings['items']['size'];
	}
	
	$slides = get_posts($args);
	
	if(!empty($slides))
	{
		$pagination = 0;
		if($settings['pagination'] == 'yes')
		{
			$pagination = 1;
		}
		
		$autoplay = 0;
		if($settings['autoplay'] == 'yes')
		{
			$autoplay = 1;
		}
		
		$timer = intval($settings['timer']['size']*1000);
?>
<div class="testimonials-card-wrapper">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>">
<?php
		$counter = 1;
	
		foreach ($slides as $key => $slide) 
		{ 
			$testimonial_ID = $slide->ID;
					
			//Get testimonial meta
			$testimonial_name = get_post_meta($testimonial_ID, 'testimonial_name', true);
?>
			<div class="item">
				<div class="shadow-effect">	
					
		          	<?php
			          	if(!empty($slide->post_content))
						{
					?>
						<div class="testimonial-info-desc">
							<?php echo esc_html($slide->post_content); ?>
						</div>
					<?php
						}
					?>
					
					<?php
						//Get customer picture
						if(has_post_thumbnail($testimonial_ID, 'thumbnail'))
						{
							$image_id = get_post_thumbnail_id($testimonial_ID);
							$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
						}
						
						if(isset($image_url[0]) && !empty($image_url[0]))
						{
					?>
					<div class="testimonial-info-img">
						<img class="img-circle" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
					</div>
					<?php
						}
					?>
					
					<?php
					 	if(!empty($testimonial_name))
					 	{
					?>
					 	<div class="testimonial-name"><?php echo esc_html($testimonial_name); ?></div>
					<?php
					    }
					?>
			</div>
		</div>
<?php
			$counter++;
		}
?>
	</div>
</div>
<?php
	}
?>