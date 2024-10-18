<?php
	$widget_id = $this->get_id();
?>
<div class="ticket-wrapper">
<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$shortcode = '[ppb_ticket widget_id="'.esc_attr($widget_id).'" ';
	
	if(isset($settings['columns']['size']) && !empty($settings['columns']['size']))
	{
		$shortcode.= 'columns="'.$settings['columns']['size'].'" ';
	}
	
	$shortcode.= '][/ppb_ticket]';
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
</div>
<br class="clear"/>