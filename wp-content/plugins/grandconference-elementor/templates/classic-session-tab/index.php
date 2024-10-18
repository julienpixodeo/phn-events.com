<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
?>
<div class="session-tab-wrapper speaker-thumb-<?php echo esc_attr($settings['image_dimension']); ?>" data-widget-id="<?php echo esc_attr($widget_id); ?>" data-expand="<?php echo esc_attr($settings['expand']); ?>">
<?php
	$shortcode = '[ppb_session_tab thumbnail="'.esc_attr($settings['image_dimension']).'" widget_id="'.esc_attr($widget_id).'" ';
	
	if(isset($settings['filterable']) && !empty($settings['filterable']))
	{
		$filterable = 'yes';
		if($settings['filterable'] != 'yes')
		{
			$filterable = 'no';
		}
		
		$shortcode.= 'filterable="'.$filterable.'" ';
	}
	else 
	{
		$shortcode.= 'filterable="no" ';
	}
	
	$shortcode.= '][/ppb_session_tab]';
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
</div>
<br class="clear"/>