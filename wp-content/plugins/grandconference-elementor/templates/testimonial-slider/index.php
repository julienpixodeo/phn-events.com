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
		$autoplay = 0;
		if($settings['autoplay'] == 'yes')
		{
			$autoplay = 1;
		}
		
		$timer = intval($settings['timer']['size']*1000);
?>
<div class="testimonials-slider-wrapper">
	<div class="testimonial-carousel owl-carousel" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>">
<?php
		$counter = 1;
	
		foreach ($slides as $key => $slide) 
		{
			$testimonial_ID = $slide->ID;
								
			//Get testimonial meta
			$testimonial_name = get_post_meta($testimonial_ID, 'testimonial_name', true);
			$testimonial_position = get_post_meta($testimonial_ID, 'testimonial_position', true);
			$testimonial_company_name = get_post_meta($testimonial_ID, 'testimonial_company_name', true);
			$testimonial_company_website = get_post_meta($testimonial_ID, 'testimonial_company_website', true);
?>
			<div class="testimonial-block">
				<div class="inner-box">
					<?php
						if(!empty($slide->post_content))
						{
					?>
					<div class="text"><?php echo esc_html($slide->post_content); ?></div>
					<?php
						}
					?>
					<div class="info-box">
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
						<div class="thumb">
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
						</div>
						<?php
							}
						?>
						<?php
							 if(!empty($testimonial_name))
							 {
						?>
							 <h4 class="name"><?php echo esc_html($testimonial_name); ?></h4>
						<?php
							}
						?>
						<?php
							 if(!empty($testimonial_position))
							 {
								$client_position_html = '<span class="testimonial-client-position">'.$testimonial_position.'</span>';
								
								if(!empty($testimonial_company_website))
								{
									$client_position_html.= '<a href="'.esc_url($testimonial_company_website).'" target="_blank">';
								}
								
								$client_position_html.=$testimonial_company_name;
								
								if(!empty($testimonial_company_website))
								{
									$client_position_html.= '</a>';
								}
						?>
							<span class="designation"><?php echo $client_position_html; ?></span>
						<?php
							}
						?>
					</div>
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