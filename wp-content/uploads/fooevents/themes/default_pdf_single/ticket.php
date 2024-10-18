<?php
if ( empty( $ticket['WooCommerceEventsTicketButtonColor'] ) || $ticket['WooCommerceEventsTicketButtonColor'] == 1 || $ticket['name'] == __( 'Preview Event', 'woocommerce-events' ) ) {
		$ticket['WooCommerceEventsTicketButtonColor'] = '#55AF71';
}

if ( empty( $ticket['WooCommerceEventsTicketBackgroundColor'] ) || $ticket['WooCommerceEventsTicketBackgroundColor'] == 1 || $ticket['name'] == __( 'Preview Event', 'woocommerce-events' ) ) {
	$ticket['WooCommerceEventsTicketBackgroundColor'] = '#55AF71';
}

if ( empty( $ticket['WooCommerceEventsTicketTextColor'] ) || $ticket['WooCommerceEventsTicketTextColor'] == 1 ) {
	$ticket['WooCommerceEventsTicketTextColor'] = '#ffffff';
}
?>

<?php if ( ! empty( $ticket['ticketNumber'] ) && $ticket['ticketNumber'] > 1 ) : ?>
	<div style="page-break-before: always;"></div>  
<?php endif; ?>

<br /><br />
 <!--[if mso]>
<table border="0" width="600" align="center" style="max-width: 600px;margin:0 auto; border-collapse: collapse;"><tr><td width="300">
<![endif]-->
<div style="page-break-inside: avoid;float:left;text-align:center; width:50%;max-width:300px;font-family:<?php echo $font_family; ?>;font-size: 14px;line-height:18px; margin-top:10px;">
    <?php if(!empty($ticket['WooCommerceEventsTicketLogo'])) :?>
        <img src="<?php echo $ticket['WooCommerceEventsTicketLogo']; ?>" alt="" width="150px"/><br /><br /><br />
    <?php endif; ?>
    <?php if($ticket['WooCommerceEventsTicketDisplayBarcode'] != 'off') :?>
        <img src="<?php echo $barcodeURL; ?>" alt="Barcode: <?php echo $ticket['TicketNumberTicketOutput']; ?>" width="150px" />
        <br /><br />
        <?php echo $ticket['TicketNumberTicketOutput']; ?>
    <?php endif; ?>  
</div>
<!--[if mso]>
</td><td width="300">
<![endif]-->
<div style="page-break-inside: avoid;width:50%; vertical-align:middle;float:left;border-left: solid 2px <?php echo $ticket['WooCommerceEventsTicketBackgroundColor']; ?>;padding-left:20px;max-width:278px;font-family:<?php echo $font_family; ?>;font-size: 14px;line-height:18px;">
	<h1 style="font-weight: normal;padding:0;margin:0 0 10px;font-size: 20px;line-height: 24px;"><?php echo $ticket['name']; ?></h1>
	<br />
	<?php if ( $ticket['WooCommerceEventsTicketDisplayDateTime'] != 'off' ) : ?>

		<?php if ( ( isset( $ticket['WooCommerceEventsBookingSlot'] ) || isset( $ticket['WooCommerceEventsBookingDate'] ) ) && $ticket['WooCommerceEventsTicketDisplayBookings'] != 'off' ) : ?>

			<strong>
				<?php echo $ticket['WooCommerceEventsBookingDate']; ?>
			</strong>
			<br />
			<strong>
				<?php echo $ticket['WooCommerceEventsBookingSlot']; ?>
			</strong>

		<?php else : ?> 

			<strong>
			<?php
			if ( ! empty( $ticket['WooCommerceEventsSelectDate'] ) && ! empty( $ticket['WooCommerceEventsSelectDate'][0] )
				&& $ticket['WooCommerceEventsType'] == 'select' ) :

						$x = 0;
				foreach ( $ticket['WooCommerceEventsSelectDate'] as $selectDate ) :
					if ( $selectDate != '' ) :
						if ( $x > 0 ) {
							echo ', ';
						}
						echo $selectDate;
					endif;
					$x++;
						endforeach;

					else :

						if ( ! empty( $ticket['WooCommerceEventsDate'] ) ) :
							echo $ticket['WooCommerceEventsDate'];
							if ( ! empty( $ticket['WooCommerceEventsEndDate'] ) ) :
								echo ' - ' . $ticket['WooCommerceEventsEndDate'];
endif;
						endif;

					endif;
					?>

			</strong>

			<strong>
				<?php echo $ticket['WooCommerceEventsHour']; ?>:<?php echo $ticket['WooCommerceEventsMinutes']; ?><?php echo ( ! empty( $ticket['WooCommerceEventsPeriod'] ) ) ? $ticket['WooCommerceEventsPeriod'] : ''; ?>
				<?php echo ( ! empty( $ticket['WooCommerceEventsTimeZone'] ) ) ? ' ' . $ticket['WooCommerceEventsTimeZone'] : ''; ?>
				<?php if ( $ticket['WooCommerceEventsHourEnd'] != '00' ) : ?>
				- <?php echo $ticket['WooCommerceEventsHourEnd']; ?>:<?php echo $ticket['WooCommerceEventsMinutesEnd']; ?><?php echo ( ! empty( $ticket['WooCommerceEventsEndPeriod'] ) ) ? $ticket['WooCommerceEventsEndPeriod'] : ''; ?>
					<?php echo ( ! empty( $ticket['WooCommerceEventsTimeZone'] ) ) ? ' ' . $ticket['WooCommerceEventsTimeZone'] : ''; ?>
				<?php endif; ?>
			</strong> 

		<?php endif; ?> 
		<br />                
	<?php endif; ?>

	<!-- BOOKING DETAILS -->

	<?php if ( ( isset( $ticket['WooCommerceEventsBookingSlot'] ) && ! empty( $ticket['WooCommerceEventsBookingSlot'] ) ) || ( isset( $ticket['WooCommerceEventsBookingDate'] ) && ! empty( $ticket['WooCommerceEventsBookingDate'] ) ) ) : ?>
		<?php if ( $ticket['WooCommerceEventsTicketDisplayBookings'] != 'off' ) : ?>
			<strong><?php echo $ticket['WooCommerceEventsBookingsSlotTerm']; ?>:</strong> <?php echo $ticket['WooCommerceEventsBookingSlot']; ?><br />
			<strong><?php echo $ticket['WooCommerceEventsBookingsDateTerm']; ?>:</strong> <?php echo $ticket['WooCommerceEventsBookingDate']; ?><br />
		<?php endif; ?> 
	<?php endif; ?>            
	<?php if ( ! empty( $ticket['WooCommerceEventsLocation'] ) ) : ?>
		<strong><?php _e( 'Location:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsLocation']; ?><br />
	<?php endif; ?>
	<?php if ( ! empty( $ticket['WooCommerceEventsDirections'] ) ) : ?>
		<strong><?php _e( 'Directions:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsDirections']; ?>
	<?php endif; ?>
	<br /><br />

	<strong><?php _e( 'Ticket Number:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['TicketNumberTicketOutput']; ?><br />
	
	<?php if ( $ticket['WooCommerceEventsTicketPurchaserDetails'] != 'off' ) : ?>
		<strong><?php _e( 'Ticket Holder:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsAttendeeName']; ?> <?php echo $ticket['WooCommerceEventsAttendeeLastName']; ?><br />
	
		<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeTelephone'] ) ) : ?>
			<strong><?php _e( 'Telephone Number:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsAttendeeTelephone']; ?><br />
		<?php endif; ?>
	
		<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeCompany'] ) ) : ?>
			<strong><?php _e( 'Company:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsAttendeeCompany']; ?><br />
		<?php endif; ?>
	
		<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeDesignation'] ) ) : ?>
			<strong><?php _e( 'Designation:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsAttendeeDesignation']; ?><br />
		<?php endif; ?>
	<?php endif; ?>
	

	<!-- SEATING --> 
	
	<?php if ( ! empty( $ticket['fooevents_seating_options_array'] ) ) : ?>
		<?php echo '<strong>' . $ticket['fooevents_seating_options_array']['row_name_label'] . ':</strong> ' . $ticket['fooevents_seating_options_array']['row_name']; ?><br />
		<?php echo '<strong>' . $ticket['fooevents_seating_options_array']['seat_number_label'] . ':</strong> ' . $ticket['fooevents_seating_options_array']['seat_number']; ?><br />
	<?php endif; ?>
	
	<?php if ( ! empty( $ticket['WooCommerceEventsVariations'] ) ) : ?>
		<?php foreach ( $ticket['WooCommerceEventsVariations'] as $variationName => $variationValue ) : ?>
			<?php echo '<strong>' . $variationName . ':</strong> ' . $variationValue; ?><br />
		<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if ( $ticket['WooCommerceEventsTicketDisplayPrice'] != 'off' ) : ?>
	<strong><?php _e( 'Price:', 'woocommerce-events' ); ?></strong> <?php echo $ticket['WooCommerceEventsPrice']; ?><br />
	<?php endif; ?>  
	
	<?php if ( ! empty( $ticket['fooevents_custom_attendee_fields_options_array'] ) && ( isset( $ticket['WooCommerceEventsIncludeCustomAttendeeDetails'] ) && $ticket['WooCommerceEventsIncludeCustomAttendeeDetails'] != 'off' ) ) : ?>
		<?php foreach ( $ticket['fooevents_custom_attendee_fields_options_array'] as $custom_attendee_fields ) : ?>
			<?php echo '<strong>' . $custom_attendee_fields['label'] . ':</strong> ' . $custom_attendee_fields['value']; ?><br />
		<?php endforeach; ?>
	<?php endif; ?> 
	<br />

	<?php if ( ! empty( $ticket['WooCommerceEventsTicketText'] ) || ( ! empty( $ticket['WooCommerceEventsTicketDisplayZoom'] ) && $ticket['WooCommerceEventsTicketDisplayZoom'] != 'off' && ! empty( $ticket['WooCommerceEventsZoomText'] ) ) ) : ?>
		<p style="font-size:12px;color:#777777">
			<?php if ( ! empty( $ticket['WooCommerceEventsTicketText'] ) ) : ?>
				<?php echo nl2br( $ticket['WooCommerceEventsTicketText'] ); ?>
			<?php endif; ?>
			<?php if ( ( ! empty( $ticket['WooCommerceEventsTicketDisplayZoom'] ) && $ticket['WooCommerceEventsTicketDisplayZoom'] != 'off' && ! empty( $ticket['WooCommerceEventsZoomText'] ) ) ) : ?>
				<?php echo nl2br( $ticket['WooCommerceEventsZoomText'] ); ?>
			<?php endif; ?>
		</p>
	<?php endif; ?>
	<br />
	
	<?php if ( $ticket['WooCommerceEventsTicketAddCalendar'] != 'off' ) : ?>
	<!--[if mso]>
	<table border="0" width="300" bgcolor="<?php echo $ticket['WooCommerceEventsTicketButtonColor']; ?>" align="center" style="max-width: 300px;margin:0 auto; border-collapse: collapse;text-align:center"><tr><td align="center" style="text-align:center">
		<table bgcolor="<?php echo $ticket['WooCommerceEventsTicketButtonColor']; ?>" style="border-collapse: collapse;" border="0" align="center" width="300"><tr><td>&nbsp;</td></tr></table>
	<![endif]-->
		<a style="background-color:<?php echo $ticket['WooCommerceEventsTicketButtonColor']; ?>;text-align:center;padding: 10px 15px;display:block;font-family:<?php echo $font_family; ?>;line-height:16px;border: 0;outline: none;text-decoration: none;color: <?php echo $ticket['WooCommerceEventsTicketTextColor']; ?> !important;font-size: 16px;" href="<?php echo site_url(); ?>/wp-admin/admin-ajax.php?action=fooevents_ics&event=<?php echo $ticket['WooCommerceEventsProductID']; ?>&ticket=<?php echo $ticket['ID']; ?>">
		<font color="<?php echo $ticket['WooCommerceEventsTicketTextColor']; ?>"><?php _e( 'Add to calendar', 'woocommerce-events' ); ?></font>
		</a>
	<!--[if mso]>
		<table bgcolor="<?php echo $ticket['WooCommerceEventsTicketButtonColor']; ?>" style="border-collapse: collapse;" border="0" align="center" width="300"><tr><td>&nbsp;</td></tr></table>
	</td></tr></table>
	<![endif]-->
	<?php endif; ?> 
	<br />
</div>
<div style="clear:both"></div>
<!--[if mso]>
</td></tr></table>
<table border="0" align="center" width="600" style="border-collapse: collapse;"><tr><td cellpadding="50" >&nbsp;</td></tr></table>
<![endif]-->

<br />
<div style="width:100%;border-top: 1px solid #eee;max-width:600px;font-family:<?php echo $font_family; ?>;">
	<?php if ( ! empty( $ticket['FooEventsTicketFooterText'] ) ) : ?>
	<!--[if mso]>
		<table border="0" align="center" width="600" style="border-collapse: collapse;"><tr><td cellpadding="50" >&nbsp;</td></tr></table>
	<![endif]-->
		<p style="text-align:center;font-size:12px;color:#777;margin:0;padding:20px 30px;line-height:15px;"><?php echo $ticket['FooEventsTicketFooterText']; ?></p>
	<?php endif; ?>
</div>
