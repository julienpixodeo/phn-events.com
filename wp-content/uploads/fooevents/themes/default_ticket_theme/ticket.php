
<!-- EVENT DETAILS -->
<?php if ( ( ! empty( $ticket['ticketNumber'] ) && $ticket['ticketNumber'] == 1 ) || ( $ticket['name'] == __( 'Preview Event', 'woocommerce-events' ) ) ) : ?>

	<?php if ( ! empty( $ticket['type'] ) && $ticket['type'] == 'PDF' ) : ?>
		<!-- PDF CONTAINER -->
		<div class="intro" style="padding: 30px; width: 100%; max-width: 640px; margin: 0 auto; font-size:14px; font-family: <?php echo $font_family; ?>; text-align: left">		
	<?php else : ?>
		<!-- EMAIL CONTAINER -->
		<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="border-collapse:collapse"><tr><td align="center" style="text-align:center">
		<table border="0" cellpadding="20" cellspacing="0" style="margin: 0 auto; width:100%; max-width: 640px;"><tr><td style="text-align:left">
	<?php endif; ?> 

		<!-- LOGO -->
			<?php if ( ! empty( $ticket['WooCommerceEventsTicketLogo'] ) ) : ?>
				<p>
					<img src="<?php echo $ticket['WooCommerceEventsTicketLogo']; ?>" alt="<?php echo $ticket['name']; ?>" style="width: auto; max-width:100%"/>
				</p>
			<?php endif; ?> 

		<!-- GRAPHIC -->
			<?php if ( ! empty( $ticket['WooCommerceEventsTicketHeaderImage'] ) ) : ?>
				<p>
					<img src="<?php echo $ticket['WooCommerceEventsTicketHeaderImage']; ?>" alt="<?php echo $ticket['name']; ?>" width="100%"/>
				</p>
			<?php endif; ?> 

		<!-- EVENT TITLE -->
			<h1 style="text-align: left"><?php echo $ticket['name']; ?></h1>			 

		<!-- TICKET TEXT -->
			<?php if ( ! empty( $ticket['WooCommerceEventsTicketText'] ) ) : ?>
				<?php echo nl2br( $ticket['WooCommerceEventsTicketText'] ); ?> 
			<?php endif; ?>

		<!-- LOCATION -->
			<?php if ( ! empty( $ticket['WooCommerceEventsLocation'] ) ) : ?> 
				<h3><?php _e( 'Location', 'woocommerce-events' ); ?></h3>
				<p><?php echo $ticket['WooCommerceEventsLocation']; ?></p>
			<?php endif; ?>

		<!-- DIRECTIONS -->
			<?php if ( ! empty( $ticket['WooCommerceEventsDirections'] ) ) : ?> 
				<h3><?php _e( 'Directions', 'woocommerce-events' ); ?></h3>
				<p><?php echo $ticket['WooCommerceEventsDirections']; ?></p>
			<?php endif; ?>

		<!-- CONTACT -->
			<?php if ( ! empty( $ticket['WooCommerceEventsSupportContact'] ) ) : ?>
				<h3><?php _e( 'Contact us for questions and concerns', 'woocommerce-events' ); ?></h3>
				<p><?php echo $ticket['WooCommerceEventsSupportContact']; ?></p>
			<?php endif; ?>

		<!-- PDF FOOTER TEXT-->
			<?php if ( ! empty( $ticket['FooEventsTicketFooterText'] ) ) : ?>
				<?php echo $ticket['FooEventsTicketFooterText']; ?>
			<?php endif; ?>		

		<!-- POWERED BY TEXT -->
			<?php if ( isset( $ticket['WooCommerceEventsDisplayPoweredby'] ) && $ticket['WooCommerceEventsDisplayPoweredby'] !== 'off' ) : ?>
				<p><?php echo esc_attr_e( 'Powered by', 'woocommerce-events' ); ?> <a href="https://www.fooevents.com/?ref=ticket"><?php echo esc_attr_e( 'FooEvents.com', 'woocommerce-events' ); ?></a></p>
			<?php endif; ?>  

	<?php if ( ! empty( $ticket['type'] ) && $ticket['type'] == 'PDF' ) : ?>
		<!-- PDF CONTAINER -->	 
		</div>
	<?php else : ?> 
		<!-- EMAIL CONTAINER -->
		</td></tr></table>
		</td></tr></table>
	<?php endif; ?>

<?php endif; ?>

<?php if ( $ticket['ticketNumber'] % 2 !== 0 ) : ?>
	<div style="page-break-before: always;"></div>
<?php endif; ?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="border-collapse:collapse">
	<tr>
		<td valign="top" style="text-align:center">
			<table border="0" cellpadding="20" cellspacing="0" style=" margin: 0 auto; width:100%; max-width: 640px;">
				<tr>
					<td style="text-align:left">
						<table border="0" cellpadding="15" cellspacing="0" width="100%" class="ticket" style="border: solid 1px #ddd; border-collapse:collapse; font-family: <?php echo $font_family; ?>;">	
							<!-- TICKET BODY  -->
							<tr>
								<td valign="top" align="center" role="presentation" class="wide" style="width:30%; border-right: dashed 1px #ddd; border-bottom: solid 1px #ddd; border-bottom-width: 0;">

									<!-- BARCODE OR QR CODE -->
									<?php if ( $ticket['WooCommerceEventsTicketDisplayBarcode'] != 'off' ) : ?>
										<img src="<?php echo $barcodeURL; ?>" style="width:100%; max-width: 184px;" /><br />
									<?php endif; ?>

									<!-- TICKET NUMBER -->
									#<?php echo $ticket['TicketNumberTicketOutput']; ?> <br />

									<!-- TICKET TYPE -->
									<?php if ( ! empty( $ticket['WooCommerceEventsTicketType'] ) ) : ?>
										<?php _e( 'Ticket Type:', 'woocommerce-events' ); ?>   
										<?php echo $ticket['WooCommerceEventsTicketType']; ?><br />
									<?php endif; ?>

									<!-- PRICE -->
									<?php if ( $ticket['WooCommerceEventsTicketDisplayPrice'] != 'off' ) : ?>
										<?php _e( 'Price:', 'woocommerce-events' ); ?>
										<?php
										if ( ! empty( $ticket['WooCommerceEventsPrice'] ) ) {
											echo $ticket['WooCommerceEventsPrice'];
										} elseif ( ! empty( $ticket['price'] ) ) {
											echo $ticket['price'];}
										?>
										<br />
									<?php endif; ?>

									<!-- VARIATIONS -->
									<?php if ( ! empty( $ticket['WooCommerceEventsVariations'] ) ) : ?>
										<?php foreach ( $ticket['WooCommerceEventsVariations'] as $variationName => $variationValue ) : ?>
											<?php if ( $variationName != 'Ticket Type' ) : ?>
												<?php echo $variationName; ?>:
												<?php echo $variationValue; ?><br />
											<?php endif; ?>
										<?php endforeach; ?>        
									<?php endif; ?>																								
								</td>
								<td valign="top" class="wide">

									<!-- TICKET DETAILS -->
									<table cellpadding="2" cellspacing="0" width="100%" style=" border-collapse:collapse; font-family: <?php echo $font_family; ?>">
										
									<!-- TITLE AND DATE -->
										<tr>
											<td valign="top" align="left" colspan="2">
											<h2 style="padding:0; margin:0"><?php echo $ticket['name']; ?></h2>
											<!-- EVENT DATE / TIME -->
											<?php if ( $ticket['WooCommerceEventsTicketDisplayDateTime'] != 'off' ) : ?>	
												<?php if ( $ticket['WooCommerceEventsType'] != 'bookings' ) : ?>
													
														<?php
														if ( ! empty( $ticket['WooCommerceEventsDate'] ) ) :
															echo $ticket['WooCommerceEventsDate'];
															if ( ! empty( $ticket['WooCommerceEventsEndDate'] ) ) :
																echo ' - ' . $ticket['WooCommerceEventsEndDate'];
															endif;
														endif;
														?>
														
														<?php if ( $ticket['WooCommerceEventsType'] !== 'select' || $ticket['WooCommerceEventsSelectGlobalTime'] == 'on' ) : ?>
															<?php echo $ticket['WooCommerceEventsHour']; ?>:<?php echo $ticket['WooCommerceEventsMinutes']; ?><?php echo ( ! empty( $ticket['WooCommerceEventsPeriod'] ) ) ? $ticket['WooCommerceEventsPeriod'] : ''; ?>
															<?php echo ( ! empty( $ticket['WooCommerceEventsTimeZone'] ) ) ? ' ' . $ticket['WooCommerceEventsTimeZone'] : ''; ?>
															<?php if ( $ticket['WooCommerceEventsHourEnd'] != '00' ) : ?>
															- <?php echo $ticket['WooCommerceEventsHourEnd']; ?>:<?php echo $ticket['WooCommerceEventsMinutesEnd']; ?><?php echo ( ! empty( $ticket['WooCommerceEventsEndPeriod'] ) ) ? $ticket['WooCommerceEventsEndPeriod'] : ''; ?>
																<?php echo ( ! empty( $ticket['WooCommerceEventsTimeZone'] ) ) ? ' ' . $ticket['WooCommerceEventsTimeZone'] : ''; ?>
															<?php endif; ?>
														<?php endif; ?>		
													
												<?php endif; ?> 
											<?php endif; ?> 	

											<!-- ADD TO CALENDAR BUTTON -->
											<?php if ( $ticket['WooCommerceEventsTicketAddCalendar'] != 'off' ) : ?>
												<span class="no-print">
													<br /><a href="<?php echo site_url(); ?>/wp-admin/admin-ajax.php?action=fooevents_ics&event=<?php echo $ticket['WooCommerceEventsProductID']; ?>&ticket=<?php echo $ticket['ID']; ?><?php echo ! empty( $ticket['WooCommerceEventsAttendeeEmail'] ) ? '&email=' . urlencode( $ticket['WooCommerceEventsAttendeeEmail'] ) : ''; ?>&ticket=<?php echo $ticket['ID']; ?>"><?php _e( 'Add to calendar', 'woocommerce-events' ); ?></a><br /><br />
												</span>
											<?php endif; ?> 
											</td>
										</tr>

									<!-- MULTI-DAY DETAILS -->
										<?php if ( $ticket['WooCommerceEventsTicketDisplayMultiDay'] == 'on' ) : ?>
											<?php $x = 1; ?>
											<?php $y = 0; ?>    
											<?php foreach ( $ticket['WooCommerceEventsSelectDate'] as $date ) : ?>
												<tr>
													<td valign="top">
														<label><?php printf( __( '%1$s %2$d: ', 'woocommerce-events' ), $ticket['dayTerm'], $x ); ?></label>
													</td>
													<td valign="top">
														<?php echo esc_attr( $date ); ?><br /> 
														<?php if ( ! empty( $ticket['WooCommerceEventsSelectDateHour'][ $y ] ) && ! empty( $ticket['WooCommerceEventsSelectDateMinutes'][ $y ] ) ) : ?>
															<?php echo $ticket['WooCommerceEventsSelectDateHour'][ $y ] . ':' . $ticket['WooCommerceEventsSelectDateMinutes'][ $y ]; ?><?php echo( isset( $ticket['WooCommerceEventsSelectDatePeriod'][ $y ] ) ) ? ' ' . $ticket['WooCommerceEventsSelectDatePeriod'][ $y ] : ''; ?>
														<?php endif; ?>
														<?php if ( ! empty( $ticket['WooCommerceEventsSelectDateHourEnd'][ $y ] ) && ! empty( $ticket['WooCommerceEventsSelectDateMinutesEnd'][ $y ] ) ) : ?>
															<?php echo ' - ' . $ticket['WooCommerceEventsSelectDateHourEnd'][ $y ] . ':' . $ticket['WooCommerceEventsSelectDateMinutesEnd'][ $y ]; ?><?php echo( isset( $ticket['WooCommerceEventsSelectDatePeriodEnd'][ $y ] ) ) ? ' ' . $ticket['WooCommerceEventsSelectDatePeriodEnd'][ $y ] : ''; ?>
														<?php endif; ?>
														<?php echo ( ! empty( $ticket['WooCommerceEventsTimeZone'] ) ) ? ' ' . $ticket['WooCommerceEventsTimeZone'] : ''; ?>
													</td>
												</tr>												
												<?php $x++; ?>
												<?php $y++; ?>
											<?php endforeach; ?>
										<?php endif; ?>

									<!-- BOOKING DETAILS -->                                      
										<?php if ( isset( $ticket['WooCommerceEventsBookingSlot'] ) || isset( $ticket['WooCommerceEventsBookingDate'] ) ) : ?>					
											<?php if ( $ticket['WooCommerceEventsTicketDisplayBookings'] != 'off' ) : ?>
												<tr>
													<td valign="top">
														<label><?php echo $ticket['WooCommerceEventsBookingsSlotTerm']; ?>:</label>
													</td>
													<td valign="top">
														<?php echo $ticket['WooCommerceEventsBookingSlot']; ?>
													</td>
												</tr>
												<tr>
													<td valign="top">
														<label><?php echo $ticket['WooCommerceEventsBookingsDateTerm']; ?>:</label> 
													</td>
													<td valign="top">
														<?php echo $ticket['WooCommerceEventsBookingDate']; ?>
													</td>
												</tr>
											<?php endif; ?> 
										<?php endif; ?> 	

									<!-- SEATING -->                                      
										<?php if ( ! empty( $ticket['fooevents_seating_options_array'] ) ) : ?>
											<tr>
												<td valign="top">
													<label><?php echo $ticket['fooevents_seating_options_array']['row_name_label']; ?>:</label>
												</td>
												<td valign="top">
													<?php echo $ticket['fooevents_seating_options_array']['row_name']; ?>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<label><?php echo $ticket['fooevents_seating_options_array']['seat_number_label']; ?>:</label>
												</td>
												<td valign="top">
													<?php echo $ticket['fooevents_seating_options_array']['seat_number']; ?>
												</td>
											</tr>
										<?php endif; ?>                                     
									
									<?php if ( $ticket['WooCommerceEventsTicketPurchaserDetails'] != 'off' ) : ?>

									<!-- ATTENDEE FIELDS -->                                  
										<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeName'] ) ) : ?>
											<tr>
												<td valign="top">
													<label><?php _e( 'Ticket Holder:', 'woocommerce-events' ); ?></label>  
												</td>
												<td valign="top">
													<?php echo $ticket['WooCommerceEventsAttendeeName']; ?> <?php echo $ticket['WooCommerceEventsAttendeeLastName']; ?>
												</td>
											</tr>
										<?php endif; ?>

										<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeTelephone'] ) ) : ?>
											<tr>
												<td valign="top">
													<label><?php _e( 'Telephone Number:', 'woocommerce-events' ); ?></label>  
												</td>
												<td valign="top">
													<?php echo $ticket['WooCommerceEventsAttendeeTelephone']; ?>
												</td>
											</tr>
										<?php endif; ?>

										<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeCompany'] ) ) : ?>
											<tr>
												<td valign="top">
													<label><?php _e( 'Company:', 'woocommerce-events' ); ?></label>     
												</td>
												<td valign="top">
													<?php echo $ticket['WooCommerceEventsAttendeeCompany']; ?>    
												</td>
											</tr>
										<?php endif; ?>

										<?php if ( ! empty( $ticket['WooCommerceEventsAttendeeDesignation'] ) ) : ?>
											<tr>
												<td valign="top">
													<label><?php _e( 'Designation:', 'woocommerce-events' ); ?></label>  
												</td>
												<td valign="top">
													<?php echo $ticket['WooCommerceEventsAttendeeDesignation']; ?>
												</td>
											</tr>
										<?php endif; ?>

									<?php endif; ?>

									<!-- CUSTOM ATTENDEE FIELDS -->
										<?php if ( ! empty( $ticket['fooevents_custom_attendee_fields_options_array'] ) && ( isset( $ticket['WooCommerceEventsIncludeCustomAttendeeDetails'] ) && $ticket['WooCommerceEventsIncludeCustomAttendeeDetails'] != 'off' ) ) : ?>
											<?php foreach ( $ticket['fooevents_custom_attendee_fields_options_array'] as $custom_attendee_fields ) : ?>
												<tr>
													<td valign="top">
														<label><?php echo $custom_attendee_fields['label']; ?>:</label>
													</td>
													<td valign="top">
														<?php echo $custom_attendee_fields['value']; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?> 

									<!-- ZOOM INFORMATION -->
										<?php if ( ! empty( $ticket['WooCommerceEventsTicketDisplayZoom'] ) && $ticket['WooCommerceEventsTicketDisplayZoom'] != 'off' && ! empty( $ticket['WooCommerceEventsZoomText'] ) ) : ?>
											<tr>
												<td valign="top">
													<label><?php _e( 'Zoom Details', 'woocommerce-events' ); ?>:</label>
												</td>
												<td valign="top">
													<?php echo $ticket['WooCommerceEventsZoomText']; ?>
												</td>
											</tr>
										<?php endif; ?>
									
									</table>
								</td>
							</tr>	
						</table>
					</td>
				</tr>				
			</table>
		</td>
	</tr>
</table>

