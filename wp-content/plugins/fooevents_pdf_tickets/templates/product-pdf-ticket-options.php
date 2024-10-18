<?php
/**
 * PDF Ticket theme options tempate
 *
 * @link https://www.fooevents.com
 * @package fooevents-pdf-tickets
 */

?>
<p><b><?php esc_attr_e( 'PDF settings', 'woocommerce-events' ); ?></b></p>
<div class="options_group">
	<div style="padding-left: 30px; padding-right: 30px;">
		<p class="form-field">
			<label><?php esc_attr_e( 'Email text:', 'fooevents-pdf-tickets' ); ?></label>
			<?php wp_editor( $fooevents_pdf_tickets_email_text, 'FooEventsPDFTicketsEmailText' ); ?>
		</p>
	</div>
</div>
<div class="options_group">
	<p class="form-field">
		<label><?php esc_attr_e( 'Ticket footer text:', 'fooevents-pdf-tickets' ); ?></label>
		<textarea name="FooEventsTicketFooterText" id="FooEventsTicketFooterText"><?php echo esc_attr( $fooevents_ticket_footer_text ); ?></textarea>
	</p>
</div>
<?php wp_nonce_field( 'fooevents_pdf_tickets_options', 'fooevents_pdf_tickets_options_nonce' ); ?>
