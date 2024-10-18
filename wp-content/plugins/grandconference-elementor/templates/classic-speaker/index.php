<?php
	$widget_id = $this->get_id();
?>
<div class="speaker-classic-wrapper">
<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$shortcode = '[ppb_speaker_classic widget_id="'.esc_attr($widget_id).'" ';
	
	if(isset($settings['speakercat']) && !empty($settings['speakercat']))
	{
		$shortcode.= 'speakercat="'.$settings['speakercat'].'" ';
	}
	
	if(isset($settings['columns']['size']) && !empty($settings['columns']['size']))
	{
		$shortcode.= 'columns="'.$settings['columns']['size'].'" ';
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$shortcode.= 'items="'.$settings['items']['size'].'" ';
	}
	
	if(isset($settings['effect']) && !empty($settings['effect']))
	{
		$shortcode.= 'effect="'.$settings['effect'].'" ';
	}
	
	$shortcode.= '][/ppb_speaker_classic]';
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
</div>
<br class="clear"/>