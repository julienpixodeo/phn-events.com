<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
?>
<div class="countdown-wrapper">
	<div id="clock<?php echo esc_attr($widget_id); ?>" class="countdown-clock" data-date="<?php echo esc_attr(date("Y-m-d", strtotime($settings['date']))); ?>"" data-weeks="<?php esc_html_e('weeks', 'grandconference-elementor' ); ?>" data-days="<?php esc_html_e('days', 'grandconference-elementor' ); ?>" data-hours="<?php esc_html_e('hours', 'grandconference-elementor' ); ?>" data-minutes="<?php esc_html_e('minutes', 'grandconference-elementor' ); ?>" data-seconds="<?php esc_html_e('seconds', 'grandconference-elementor' ); ?>">
	</div>
</div>