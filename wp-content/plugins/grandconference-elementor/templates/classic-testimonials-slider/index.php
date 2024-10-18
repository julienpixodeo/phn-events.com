<?php
	$widget_id = $this->get_id();
	$settings = $this->get_settings();
	
	$timer_arr = $this->get_settings('timer');
	$timer = intval($timer_arr['size']) * 1000;
	$autoplay = 1;
	
	if($settings['autoplay'] != 'yes')
	{
		$timer = 0;
		$autoplay = 0;
	}
	
	$pagination = 0;
	if($settings['pagination'] == 'yes')
	{
		$pagination = 1;
	}
?>
<div class="testimonials-slider-wrapper" autoplay="<?php echo esc_attr($autoplay); ?>" timer="<?php echo esc_attr($timer); ?>" pagination="<?php echo esc_attr($pagination); ?>">
<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$shortcode = '[ppb_testimonial_slider widget_id="'.esc_attr($widget_id).'" ';
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$shortcode.= 'cat="'.$settings['cat'].'" ';
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$shortcode.= 'items="'.$settings['items']['size'].'" ';
	}
	
	$shortcode.= '][/ppb_testimonial_slider]';
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
</div>
<br class="clear"/>