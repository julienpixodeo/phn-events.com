<?php
/**
 * Event terminology settings template
 *
 * @link https://www.fooevents.com
 * @package woocommerce_events
 */

?>
<div id="fooevents_terminology" class="panel woocommerce_options_panel">
	<div class="options_group">
		<p><h2><b><?php esc_attr_e( 'Event Terminology', 'woocommerce-events' ); ?></b></h2></p>
		<p class="form-field fooevents-custom-text-inputs">
			<span><?php esc_attr_e( 'Singular', 'woocommerce-events' ); ?></span>
			<span><?php esc_attr_e( 'Plural', 'woocommerce-events' ); ?></span>
		</p>
		<p class="form-field fooevents-custom-text-inputs">
			<label><?php esc_attr_e( 'Attendee:', 'woocommerce-events' ); ?></label>
			<input type="text" id="WooCommerceEventsAttendeeOverride" name="WooCommerceEventsAttendeeOverride" value="<?php echo esc_attr( $woocommerce_events_attendee_override ); ?>"/>
			<input type="text" id="WooCommerceEventsAttendeeOverridePlural" name="WooCommerceEventsAttendeeOverridePlural" value="<?php echo esc_attr( $woocommerce_events_attendee_override_plural ); ?>"/>
			<img class="help_tip" data-tip="<?php esc_attr_e( "Change 'Attendee' to your own custom text for this event.", 'woocommerce-events' ); ?>" src="<?php echo esc_attr( plugins_url() ); ?>/woocommerce/assets/images/help.png" height="16" width="16" />
		</p>
		<p class="form-field fooevents-custom-text-inputs">
			<label><?php esc_attr_e( 'Event Details:', 'woocommerce-events' ); ?></label>
			<input type="text" id="WooCommerceEventsEventDetailsOverride" name="WooCommerceEventsEventDetailsOverride" value="<?php echo esc_attr( $woocommerce_events_event_details_override ); ?>"/>
			<img class="help_tip" data-tip="<?php esc_attr_e( "Change 'Event Details' to your own custom text for this event.", 'woocommerce-events' ); ?>" src="<?php echo esc_attr( plugins_url() ); ?>/woocommerce/assets/images/help.png" height="16" width="16" />
		</p>
		<p class="form-field fooevents-custom-text-inputs">
			<label><?php esc_attr_e( 'Book ticket:', 'woocommerce-events' ); ?></label>
			<input type="text" id="WooCommerceEventsTicketOverride" name="WooCommerceEventsTicketOverride" value="<?php echo esc_attr( $woocommerce_events_ticket_override ); ?>"/>
			<input type="text" id="WooCommerceEventsTicketOverridePlural" name="WooCommerceEventsTicketOverridePlural" value="<?php echo esc_attr( $woocommerce_events_ticket_override_plural ); ?>"/>
			<img class="help_tip" data-tip="<?php esc_attr_e( "Change 'Book ticket' to your own custom text for this event.", 'woocommerce-events' ); ?>" src="<?php echo esc_attr( plugins_url() ); ?>/woocommerce/assets/images/help.png" height="16" width="16" />
		</p>
		<?php echo $multiday_term; ?>
		<?php echo $bookings_term_options; ?>
		<?php echo $seating_term_options; ?>
	</div>
</div>
