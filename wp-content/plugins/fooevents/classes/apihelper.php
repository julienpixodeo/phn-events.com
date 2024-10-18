<?php
/**
 * API helper
 *
 * @link https://www.fooevents.com
 * @package woocommerce-events
 */

/**
 * Append additional data to output upon successful signin
 *
 * @param array $output output.
 */
function fooevents_append_output_data( $output ) {

	if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'is_plugin_active_for_network' ) || ! function_exists( 'get_plugin_data' ) ) {

		require_once ABSPATH . '/wp-admin/includes/plugin.php';

	}

	// include config for plugin version.
	require_once WP_PLUGIN_DIR . '/fooevents/class-fooevents-config.php';

	$temp_config = new FooEvents_Config();

	$output['data']['plugin_version'] = (string) $temp_config->plugin_data['Version'];

	$output['data']['plugin_versions']['fooevents'] = array(
		'version' => $temp_config->plugin_data['Version'],
		'name'    => $temp_config->plugin_data['Name'],
	);

	if ( is_plugin_active( 'fooevents_multi_day/fooevents-multi-day.php' ) || is_plugin_active_for_network( 'fooevents_multi_day/fooevents-multi-day.php' ) ) {

		$output['data']['multiday_enabled'] = 'Yes';

		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/fooevents_multi_day/fooevents-multi-day.php' );

		$output['data']['plugin_versions']['multi_day'] = array(
			'version' => $plugin_data['Version'],
			'name'    => $plugin_data['Name'],
		);

	} else {

		$output['data']['multiday_enabled'] = 'No';

	}

	if ( is_plugin_active( 'fooevents_bookings/fooevents-bookings.php' ) || is_plugin_active_for_network( 'fooevents_bookings/fooevents-bookings.php' ) ) {

		$output['data']['bookings_enabled'] = 'Yes';

		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/fooevents_bookings/fooevents-bookings.php' );

		$output['data']['plugin_versions']['bookings'] = array(
			'version' => $plugin_data['Version'],
			'name'    => $plugin_data['Name'],
		);

	} else {

		$output['data']['bookings_enabled'] = 'No';

	}

	if ( is_plugin_active( 'fooevents_seating/fooevents-seating.php' ) || is_plugin_active_for_network( 'fooevents_seating/fooevents-seating.php' ) ) {

		$output['data']['seating_enabled'] = 'Yes';

		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/fooevents_seating/fooevents-seating.php' );

		$output['data']['plugin_versions']['seating'] = array(
			'version' => $plugin_data['Version'],
			'name'    => $plugin_data['Name'],
		);

	} else {

		$output['data']['seating_enabled'] = 'No';

	}

	if ( is_plugin_active( 'fooevents_custom_attendee_fields/fooevents-custom-attendee-fields.php' ) || is_plugin_active_for_network( 'fooevents_custom_attendee_fields/fooevents-custom-attendee-fields.php' ) ) {

		$output['data']['custom_attendee_fields_enabled'] = 'Yes';

		$plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/fooevents_custom_attendee_fields/fooevents-custom-attendee-fields.php' );

		$output['data']['plugin_versions']['custom_attendee_fields'] = array(
			'version' => $plugin_data['Version'],
			'name'    => $plugin_data['Name'],
		);

	} else {

		$output['data']['custom_attendee_fields_enabled'] = 'No';

	}

	// Get app settings.
	$output['data']['app_title'] = (string) get_option( 'globalWooCommerceEventsAppTitle', '' );
	$output['data']['app_logo']  = preg_replace_callback(
		'/[^\x20-\x7f]/',
		function ( $match ) {
			return rawurlencode( $match[0] );
		},
		(string) get_option( 'globalWooCommerceEventsAppLogo', '' )
	);

	$output['data']['app_color'] = (string) get_option( 'globalWooCommerceEventsAppColor', '' );

	if ( strpos( $output['data']['app_color'], '#' ) === false ) {
		$output['data']['app_color'] = '';
	}

	$output['data']['app_text_color'] = (string) get_option( 'globalWooCommerceEventsAppTextColor', '' );

	if ( strpos( $output['data']['app_text_color'], '#' ) === false ) {
		$output['data']['app_text_color'] = '';
	}

	$output['data']['app_background_color'] = (string) get_option( 'globalWooCommerceEventsAppBackgroundColor', '' );

	if ( strpos( $output['data']['app_background_color'], '#' ) === false ) {
		$output['data']['app_background_color'] = '';
	}

	$output['data']['app_signin_text_color'] = (string) get_option( 'globalWooCommerceEventsAppSignInTextColor', '' );

	if ( strpos( $output['data']['app_signin_text_color'], '#' ) === false ) {
		$output['data']['app_signin_text_color'] = '';
	}

	if ( is_plugin_active( 'fooevents_pos/fooevents-pos.php' ) || is_plugin_active_for_network( 'fooevents_pos/fooevents-pos.php' ) ) {

		$output['data']['pos_use_app_color'] = (string) ( 'yes' === get_option( 'globalWooCommerceEventsPOSUseAppColor', 'yes' ) ? 'Yes' : 'No' );

	}

	$output['data']['event_override']              = (string) get_option( 'globalWooCommerceEventsEventOverride', '' );
	$output['data']['event_override_plural']       = (string) get_option( 'globalWooCommerceEventsEventOverridePlural', '' );
	$output['data']['attendee_override']           = (string) get_option( 'globalWooCommerceEventsAttendeeOverride', '' );
	$output['data']['attendee_override_plural']    = (string) get_option( 'globalWooCommerceEventsAttendeeOverridePlural', '' );
	$output['data']['book_ticket_override']        = (string) get_option( 'globalWooCommerceEventsTicketOverride', '' );
	$output['data']['book_ticket_override_plural'] = (string) get_option( 'globalWooCommerceEventsTicketOverridePlural', '' );
	$output['data']['day_override']                = (string) get_option( 'WooCommerceEventsDayOverride', '' );
	$output['data']['day_override_plural']         = (string) get_option( 'WooCommerceEventsDayOverridePlural', '' );
	$output['data']['copy_override']               = (string) get_option( 'WooCommerceEventsCopyOverride', '' );
	$output['data']['copy_override_plural']        = (string) get_option( 'WooCommerceEventsCopyOverridePlural', '' );
	$output['data']['hide_personal_info']          = (string) get_option( 'globalWooCommerceEventsAppHidePersonalInfo', '' );
	$output['data']['tickets_per_request']         = (string) get_option( 'globalWooCommerceEventsAppTicketsPerRequest', 'all' );
	$output['data']['gmt_offset']                  = (string) get_option( 'gmt_offset' );

	return $output;
}

/**
 * Get all event info from post ID.
 *
 * @param WP_Post $event The WordPress post.
 *
 * @return array
 */
function get_fooevents_event_info( $event ) {
	$wp_date_format = get_option( 'date_format' );
	$date_format    = $wp_date_format . ' H:i';

	$temp_event = array();

	$event_meta = get_post_meta( $event->ID );

	$temp_event['WooCommerceEventsProductID']  = (string) $event->ID;
	$temp_event['WooCommerceEventsName']       = (string) $event->post_title;
	$temp_event['WooCommerceEventsDate']       = ! empty( $event_meta['WooCommerceEventsDate'] ) && '' !== (string) $event_meta['WooCommerceEventsDate'][0] ? (string) $event_meta['WooCommerceEventsDate'][0] : date( $wp_date_format, time() );
	$temp_event['WooCommerceEventsNumDays']    = ! empty( $event_meta['WooCommerceEventsNumDays'] ) && '' !== (string) $event_meta['WooCommerceEventsNumDays'][0] ? (string) $event_meta['WooCommerceEventsNumDays'][0] : '1';
	$temp_event['WooCommerceEventsHour']       = ! empty( $event_meta['WooCommerceEventsHour'] ) ? (string) $event_meta['WooCommerceEventsHour'][0] : '';
	$temp_event['WooCommerceEventsMinutes']    = ! empty( $event_meta['WooCommerceEventsMinutes'] ) ? (string) $event_meta['WooCommerceEventsMinutes'][0] : '';
	$temp_event['WooCommerceEventsPeriod']     = (string) strtoupper( str_replace( '.', '', $event_meta['WooCommerceEventsPeriod'][0] ) );
	$temp_event['WooCommerceEventsHourEnd']    = ! empty( $event_meta['WooCommerceEventsHourEnd'] ) ? (string) $event_meta['WooCommerceEventsHourEnd'][0] : '';
	$temp_event['WooCommerceEventsMinutesEnd'] = ! empty( $event_meta['WooCommerceEventsMinutesEnd'] ) ? (string) $event_meta['WooCommerceEventsMinutesEnd'][0] : '';
	$temp_event['WooCommerceEventsEndPeriod']  = (string) strtoupper( str_replace( '.', '', $event_meta['WooCommerceEventsEndPeriod'][0] ) );
	$temp_event['WooCommerceEventsTimeZone']   = ! empty( $event_meta['WooCommerceEventsTimeZone'] ) ? (string) $event_meta['WooCommerceEventsTimeZone'][0] : '';

	if ( (int) $temp_event['WooCommerceEventsNumDays'] > 1 ) {

		$temp_event['WooCommerceEventsEndDate'] = ! empty( $event_meta['WooCommerceEventsEndDate'] ) ? (string) $event_meta['WooCommerceEventsEndDate'][0] : date( $wp_date_format, time() );

		$multi_day_type = '';

		// Check if multiday event plugin is enabled.
		if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'is_plugin_active_for_network' ) ) {

			require_once ABSPATH . '/wp-admin/includes/plugin.php';

		}

		if ( is_plugin_active( 'fooevents_multi_day/fooevents-multi-day.php' ) || is_plugin_active_for_network( 'fooevents_multi_day/fooevents-multi-day.php' ) ) {

			$fooevents_multiday_events = new Fooevents_Multiday_Events();
			$multi_day_type            = $fooevents_multiday_events->get_multi_day_type( $event->ID );

		}

		if ( 'select' === $multi_day_type ) {

			$temp_event['WooCommerceEventsSelectDate'] = get_post_meta( $event->ID, 'WooCommerceEventsSelectDate', true );

			if ( '' !== get_post_meta( $event->ID, 'WooCommerceEventsSelectDateHour', true ) ) {
				$temp_event['WooCommerceEventsSelectDateHour']       = get_post_meta( $event->ID, 'WooCommerceEventsSelectDateHour', true );
				$temp_event['WooCommerceEventsSelectDateHourEnd']    = get_post_meta( $event->ID, 'WooCommerceEventsSelectDateHourEnd', true );
				$temp_event['WooCommerceEventsSelectDateMinutes']    = get_post_meta( $event->ID, 'WooCommerceEventsSelectDateMinutes', true );
				$temp_event['WooCommerceEventsSelectDateMinutesEnd'] = get_post_meta( $event->ID, 'WooCommerceEventsSelectDateMinutesEnd', true );
				$temp_event['WooCommerceEventsSelectDatePeriod']     = get_post_meta( $event->ID, 'WooCommerceEventsSelectDatePeriod', true );
				$temp_event['WooCommerceEventsSelectDatePeriodEnd']  = get_post_meta( $event->ID, 'WooCommerceEventsSelectDatePeriodEnd', true );
			} else {
				$temp_event['WooCommerceEventsSelectDateHour']       = array();
				$temp_event['WooCommerceEventsSelectDateHourEnd']    = array();
				$temp_event['WooCommerceEventsSelectDateMinutes']    = array();
				$temp_event['WooCommerceEventsSelectDateMinutesEnd'] = array();
				$temp_event['WooCommerceEventsSelectDatePeriod']     = array();
				$temp_event['WooCommerceEventsSelectDatePeriodEnd']  = array();

				$select_date_count = count( $temp_event['WooCommerceEventsSelectDate'] );

				for ( $i = 0; $i < $select_date_count; $i++ ) {
					$temp_event['WooCommerceEventsSelectDateHour'][]       = $temp_event['WooCommerceEventsHour'];
					$temp_event['WooCommerceEventsSelectDateHourEnd'][]    = $temp_event['WooCommerceEventsHourEnd'];
					$temp_event['WooCommerceEventsSelectDateMinutes'][]    = $temp_event['WooCommerceEventsMinutes'];
					$temp_event['WooCommerceEventsSelectDateMinutesEnd'][] = $temp_event['WooCommerceEventsMinutesEnd'];
					$temp_event['WooCommerceEventsSelectDatePeriod'][]     = $temp_event['WooCommerceEventsPeriod'];
					$temp_event['WooCommerceEventsSelectDatePeriodEnd'][]  = $temp_event['WooCommerceEventsEndPeriod'];
				}
			}

			if ( ! empty( $temp_event['WooCommerceEventsSelectDate'] ) ) {

				if ( '' !== $temp_event['WooCommerceEventsSelectDate'][0] ) {

					$temp_event['WooCommerceEventsDate'] = $temp_event['WooCommerceEventsSelectDate'][0];

				}

				if ( '' !== end( $temp_event['WooCommerceEventsSelectDate'] ) ) {

					$temp_event['WooCommerceEventsEndDate'] = end( $temp_event['WooCommerceEventsSelectDate'] );

				}

				$temp_event['WooCommerceEventsSelectDateTimestamp'] = array();

				$start_period_format = '' !== $event_meta['WooCommerceEventsPeriod'][0] ? ' A' : '';
				$start_period        = '' !== $event_meta['WooCommerceEventsPeriod'][0] ? ' ' . $event_meta['WooCommerceEventsPeriod'][0] : '';

				$timezone = null;

				if ( '' !== $temp_event['WooCommerceEventsTimeZone'] ) {

					try {

						$timezone = new DateTimeZone( $temp_event['WooCommerceEventsTimeZone'] );

					} catch ( Exception $e ) {

						$server_timezone = date_default_timezone_get();
						$timezone        = new DateTimeZone( $server_timezone );

					}
				}

				foreach ( $temp_event['WooCommerceEventsSelectDate'] as $select_date ) {

					$woocommerce_events_date = convert_month_to_english( $select_date );
					$select_date_full        = $woocommerce_events_date . ' ' . $temp_event['WooCommerceEventsHour'] . ':' . $temp_event['WooCommerceEventsMinutes'] . $start_period;

					$select_start_date = DateTime::createFromFormat( $date_format . $start_period_format, $select_date_full, $timezone );

					if ( false === $select_start_date ) {

						$timestamp = strtotime( $select_date_full );

						if ( false === $timestamp ) {

							$timestamp = (string) time();

						}

						try {

							$select_start_date = new DateTime( '@' . $timestamp, $timezone );

						} catch ( Exception $e ) {

							$select_start_date = new DateTime( 'now', $timezone );

						}
					}

					$temp_event['WooCommerceEventsSelectDateTimestamp'][] = (string) ( $select_start_date->getTimestamp() );

				}
			}
		}
	}

	// Start Date.
	$start_period_format                     = '' !== $event_meta['WooCommerceEventsPeriod'][0] ? ' A' : '';
	$start_period                            = '' !== $event_meta['WooCommerceEventsPeriod'][0] ? ' ' . $event_meta['WooCommerceEventsPeriod'][0] : '';
	$woocommerce_events_date                 = convert_month_to_english( $temp_event['WooCommerceEventsDate'] );
	$temp_event['WooCommerceEventsDateFull'] = $woocommerce_events_date . ' ' . $temp_event['WooCommerceEventsHour'] . ':' . $temp_event['WooCommerceEventsMinutes'] . $start_period;

	$timezone = null;

	if ( '' !== $temp_event['WooCommerceEventsTimeZone'] ) {

		try {

			$timezone = new DateTimeZone( $temp_event['WooCommerceEventsTimeZone'] );

		} catch ( Exception $e ) {

			$server_timezone = date_default_timezone_get();
			$timezone        = new DateTimeZone( $server_timezone );

		}
	}

	$start_date = DateTime::createFromFormat( $date_format . $start_period_format, $temp_event['WooCommerceEventsDateFull'], $timezone );

	if ( false === $start_date ) {

		$timestamp = strtotime( $temp_event['WooCommerceEventsDateFull'] );

		if ( false === $timestamp ) {

			$timestamp = (string) time();

		}

		try {

			$start_date = new DateTime( '@' . $timestamp, $timezone );

		} catch ( Exception $e ) {

			$start_date = new DateTime( 'now', $timezone );

		}
	}

	$temp_event['WooCommerceEventsDateTimestamp'] = (string) $event_meta['WooCommerceEventsDateTimestamp'][0];
	$temp_event['WooCommerceEventsDateDay']       = $start_date->format( 'd' );
	$temp_event['WooCommerceEventsDateMonth']     = wp_date( 'M', $temp_event['WooCommerceEventsDateTimestamp'], $timezone );
	$temp_event['WooCommerceEventsDateYear']      = $start_date->format( 'Y' );

	// End Date.
	if ( (int) $temp_event['WooCommerceEventsNumDays'] > 1 ) {

		$end_period_format                          = '' !== $event_meta['WooCommerceEventsEndPeriod'][0] ? ' A' : '';
		$end_period                                 = '' !== $event_meta['WooCommerceEventsEndPeriod'][0] ? ' ' . $event_meta['WooCommerceEventsEndPeriod'][0] : '';
		$woocommerce_events_end_date                = convert_month_to_english( $temp_event['WooCommerceEventsEndDate'] );
		$temp_event['WooCommerceEventsEndDateFull'] = $woocommerce_events_end_date . ' ' . $temp_event['WooCommerceEventsHourEnd'] . ':' . $temp_event['WooCommerceEventsMinutesEnd'] . $end_period;

		$end_date = DateTime::createFromFormat( $date_format . $end_period_format, $temp_event['WooCommerceEventsEndDateFull'], $timezone );

		if ( false === $end_date ) {

			$end_timestamp = strtotime( $temp_event['WooCommerceEventsEndDateFull'] );

			if ( false === $end_timestamp ) {

				$end_timestamp = (string) time();

			}

			try {

				$end_date = new DateTime( '@' . $end_timestamp, $timezone );

			} catch ( Exception $e ) {

				$end_date = new DateTime( 'now', $timezone );

			}
		}

		$temp_event['WooCommerceEventsEndDateTimestamp'] = (string) $event_meta['WooCommerceEventsEndDateTimestamp'][0];
		$temp_event['WooCommerceEventsEndDateDay']       = $end_date->format( 'd' );
		$temp_event['WooCommerceEventsEndDateMonth']     = date_i18n( 'M', $temp_event['WooCommerceEventsEndDateTimestamp'] );
		$temp_event['WooCommerceEventsEndDateYear']      = $end_date->format( 'Y' );

	}

	$event_image = get_the_post_thumbnail_url( $event->ID );

	if ( false === $event_image ) {

		$event_image = ! empty( $event_meta['WooCommerceEventsTicketLogo'] ) ? (string) $event_meta['WooCommerceEventsTicketLogo'][0] : '';

	}

	$temp_event['WooCommerceEventsTicketLogo']        = $event_image;
	$temp_event['WooCommerceEventsTicketHeaderImage'] = ! empty( $event_meta['WooCommerceEventsTicketHeaderImage'] ) ? (string) $event_meta['WooCommerceEventsTicketHeaderImage'][0] : '';
	$temp_event['WooCommerceEventsLocation']          = ! empty( $event_meta['WooCommerceEventsLocation'] ) ? (string) $event_meta['WooCommerceEventsLocation'][0] : '';
	$temp_event['WooCommerceEventsSupportContact']    = ! empty( $event_meta['WooCommerceEventsSupportContact'] ) ? (string) $event_meta['WooCommerceEventsSupportContact'][0] : '';
	$temp_event['WooCommerceEventsEmail']             = ! empty( $event_meta['WooCommerceEventsEmail'] ) ? (string) $event_meta['WooCommerceEventsEmail'][0] : '';
	$temp_event['WooCommerceEventsGPS']               = ! empty( $event_meta['WooCommerceEventsGPS'] ) ? (string) $event_meta['WooCommerceEventsGPS'][0] : '';
	$temp_event['WooCommerceEventsGoogleMaps']        = ! empty( $event_meta['WooCommerceEventsGoogleMaps'] ) ? (string) $event_meta['WooCommerceEventsGoogleMaps'][0] : '';
	$temp_event['WooCommerceEventsDirections']        = ! empty( $event_meta['WooCommerceEventsDirections'] ) ? (string) $event_meta['WooCommerceEventsDirections'][0] : '';
	$temp_event['WooCommerceEventsBackgroundColor']   = ! empty( $event_meta['WooCommerceEventsBackgroundColor'] ) ? (string) $event_meta['WooCommerceEventsBackgroundColor'][0] : '';

	if ( strpos( $temp_event['WooCommerceEventsBackgroundColor'], '#' ) === false ) {
		$temp_event['WooCommerceEventsBackgroundColor'] = '';
	}

	$temp_event['WooCommerceEventsTextColor'] = ! empty( $event_meta['WooCommerceEventsTextColor'] ) ? (string) $event_meta['WooCommerceEventsTextColor'][0] : '';

	if ( strpos( $temp_event['WooCommerceEventsTextColor'], '#' ) === false ) {
		$temp_event['WooCommerceEventsTextColor'] = '';
	}

	$attendee_term = ! empty( $event_meta['WooCommerceEventsAttendeeOverride'] ) ? (string) $event_meta['WooCommerceEventsAttendeeOverride'][0] : '';

	if ( empty( $attendee_term ) ) {

		$attendee_term = (string) get_option( 'globalWooCommerceEventsAttendeeOverride', true );

	}

	if ( ! empty( $attendee_term ) && 1 !== $attendee_term ) {

		$temp_event['WooCommerceEventsAttendeeOverride'] = $attendee_term;

	}

	$attendee_term_plural = ! empty( $event_meta['WooCommerceEventsAttendeeOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsAttendeeOverridePlural'][0] : '';

	if ( empty( $attendee_term_plural ) ) {

		$attendee_term_plural = (string) get_option( 'globalWooCommerceEventsAttendeeOverridePlural', true );

	}

	if ( ! empty( $attendee_term_plural ) && 1 !== $attendee_term_plural ) {

		$temp_event['WooCommerceEventsAttendeeOverridePlural'] = $attendee_term_plural;

	}

	$day_term = ! empty( $event_meta['WooCommerceEventsDayOverride'] ) ? (string) $event_meta['WooCommerceEventsDayOverride'][0] : '';

	if ( empty( $day_term ) ) {

		$day_term = (string) get_option( 'WooCommerceEventsDayOverride', true );

	}

	if ( ! empty( $day_term ) && 1 !== $day_term ) {

		$temp_event['WooCommerceEventsDayOverride'] = $day_term;

	}

	$day_term_plural = ! empty( $event_meta['WooCommerceEventsDayOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsDayOverridePlural'][0] : '';

	if ( empty( $day_term_plural ) ) {

		$day_term_plural = (string) get_option( 'WooCommerceEventsDayOverridePlural', true );

	}

	if ( ! empty( $day_term_plural ) && 1 !== $day_term_plural ) {

		$temp_event['WooCommerceEventsDayOverridePlural'] = $day_term_plural;

	}

	$temp_event['WooCommerceEventsBookingsBookingDetailsOverride']       = ! empty( $event_meta['WooCommerceEventsBookingsBookingDetailsOverride'] ) ? (string) $event_meta['WooCommerceEventsBookingsBookingDetailsOverride'][0] : '';
	$temp_event['WooCommerceEventsBookingsBookingDetailsOverridePlural'] = ! empty( $event_meta['WooCommerceEventsBookingsBookingDetailsOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsBookingsBookingDetailsOverridePlural'][0] : '';

	$temp_event['WooCommerceEventsBookingsSlotOverride']       = ! empty( $event_meta['WooCommerceEventsBookingsSlotOverride'] ) ? (string) $event_meta['WooCommerceEventsBookingsSlotOverride'][0] : '';
	$temp_event['WooCommerceEventsBookingsSlotOverridePlural'] = ! empty( $event_meta['WooCommerceEventsBookingsSlotOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsBookingsSlotOverridePlural'][0] : '';

	$temp_event['WooCommerceEventsBookingsDateOverride']       = ! empty( $event_meta['WooCommerceEventsBookingsDateOverride'] ) ? (string) $event_meta['WooCommerceEventsBookingsDateOverride'][0] : '';
	$temp_event['WooCommerceEventsBookingsDateOverridePlural'] = ! empty( $event_meta['WooCommerceEventsBookingsDateOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsBookingsDateOverridePlural'][0] : '';

	$temp_event['WooCommerceEventsSeatingRowOverride']       = ! empty( $event_meta['WooCommerceEventsSeatingRowOverride'] ) ? (string) $event_meta['WooCommerceEventsSeatingRowOverride'][0] : '';
	$temp_event['WooCommerceEventsSeatingRowOverridePlural'] = ! empty( $event_meta['WooCommerceEventsSeatingRowOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsSeatingRowOverridePlural'][0] : '';

	$temp_event['WooCommerceEventsSeatingSeatOverride']       = ! empty( $event_meta['WooCommerceEventsSeatingSeatOverride'] ) ? (string) $event_meta['WooCommerceEventsSeatingSeatOverride'][0] : '';
	$temp_event['WooCommerceEventsSeatingSeatOverridePlural'] = ! empty( $event_meta['WooCommerceEventsSeatingSeatOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsSeatingSeatOverridePlural'][0] : '';

	$temp_event['WooCommerceEventsSeatingSeatingChartOverride']       = ! empty( $event_meta['WooCommerceEventsSeatingSeatingChartOverride'] ) ? (string) $event_meta['WooCommerceEventsSeatingSeatingChartOverride'][0] : '';
	$temp_event['WooCommerceEventsSeatingSeatingChartOverridePlural'] = ! empty( $event_meta['WooCommerceEventsSeatingSeatingChartOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsSeatingSeatingChartOverridePlural'][0] : '';

	$temp_event['WooCommerceEventsSeatingFrontOverride']       = ! empty( $event_meta['WooCommerceEventsSeatingFrontOverride'] ) ? (string) $event_meta['WooCommerceEventsSeatingFrontOverride'][0] : '';
	$temp_event['WooCommerceEventsSeatingFrontOverridePlural'] = ! empty( $event_meta['WooCommerceEventsSeatingFrontOverridePlural'] ) ? (string) $event_meta['WooCommerceEventsSeatingFrontOverridePlural'][0] : '';

	$event_type = 'single';

	if ( ! empty( $event_meta['WooCommerceEventsType'] ) ) {

		$event_type = $event_meta['WooCommerceEventsType'][0];

	} elseif ( (int) $temp_event['WooCommerceEventsNumDays'] > 1 ) {

		if ( ! empty( $event_meta['WooCommerceEventsMultiDayType'] ) ) {

			$event_type = $event_meta['WooCommerceEventsMultiDayType'][0];

		}
	}

	$temp_event['WooCommerceEventsType'] = $event_type;

	if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'is_plugin_active_for_network' ) ) {

		require_once ABSPATH . '/wp-admin/includes/plugin.php';

	}

	if ( ( is_plugin_active( 'fooevents_bookings/fooevents-bookings.php' ) || is_plugin_active_for_network( 'fooevents_bookings/fooevents-bookings.php' ) ) && 'bookings' === $event_type ) {

		$fooevents_bookings = new FooEvents_Bookings();

		$fooevents_bookings_options_serialized = $event_meta['fooevents_bookings_options_serialized'][0];
		$fooevents_bookings_options            = json_decode( $fooevents_bookings_options_serialized, true );

		$booking_slots = $fooevents_bookings->process_booking_options( $fooevents_bookings_options );

		foreach ( $booking_slots as $key => &$options ) {

			if ( isset( $options['add_date'] ) ) {
				$options['add_date_ids'] = array_keys( $options['add_date'] );

				foreach ( $options['add_date'] as $add_date_key => &$date_options ) {

					$date_options['stock'] = (string) $date_options['stock'];

					$slot_date = DateTime::createFromFormat( $date_format, $date_options['date'] . ' 12:00', new DateTimeZone( 'UTC' ) );

					$slot_timestamp = 0;

					if ( false === $slot_date ) {

						$slot_date      = convert_month_to_english( $date_options['date'] );
						$slot_timestamp = (string) strtotime( $slot_date . ' 12:00' );

					} else {
						$slot_timestamp = $slot_date->getTimestamp();
					}

					$date_options['date_timestamp'] = (string) $slot_timestamp;

				}
			} else {
				$options['add_date']     = array( '' => '' );
				$options['add_date_ids'] = array();
			}
		}

		$temp_event['WooCommerceEventsBookingOptionIDs'] = array_keys( $booking_slots );
		$temp_event['WooCommerceEventsBookingOptions']   = $booking_slots;

	}

	return $temp_event;
}

/**
 * Get all events as an array
 *
 * @param object $user user.
 * @return array $events_array
 */
function get_all_events( $user = null ) {

	$events_array = array();
	$args         = array(
		'post_type'        => 'product',
		'order'            => 'ASC',
		'suppress_filters' => true,
		'posts_per_page'   => -1,
		'post_status'      => array( 'publish', 'future' ),
		'meta_query'       => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'     => 'WooCommerceEventsEvent',
				'value'   => 'Event',
				'compare' => '=',
			),
		),
	);

	$app_events = get_option( 'globalWooCommerceEventsAppEvents', 'all' );

	if ( 'all' !== $app_events ) {
		$show_all_for_admin = get_option( 'globalWooCommerceEventsAppShowAllForAdmin' );

		if ( ! ( 'yes' === $show_all_for_admin && current_user_can( 'manage_options' ) ) ) {
			if ( 'user' === $app_events && null !== $user ) {
				$args['author'] = $user->ID;
			} elseif ( 'id' === $app_events ) {
				$app_event_ids = get_option( 'globalWooCommerceEventsAppEventIDs', array() );

				if ( ! empty( $app_events ) ) {
					$args['post__in'] = $app_event_ids;
				}
			}
		}
	}

	$query  = new WP_Query( $args );
	$events = $query->get_posts();

	foreach ( $events as &$event ) {

		$temp_event = get_fooevents_event_info( $event );

		$events_array[] = $temp_event;

		unset( $temp_event );

	}

	return $events_array;
}

/**
 * Get a single ticket's data
 *
 * @param string $ticket_id ticket ID.
 * @param bool   $hide_personal_info hide person informaiton.
 * @return array ticket_array
 */
function get_ticket_data( $ticket_id, $hide_personal_info ) {

	$temp_ticket = array();

	$temp_ticket['customerFirstName'] = '';
	$temp_ticket['customerLastName']  = '';
	$temp_ticket['customerEmail']     = '';
	$temp_ticket['customerPhone']     = '';
	$temp_ticket['customerID']        = '';

	$order_id = get_post_meta( $ticket_id, 'WooCommerceEventsOrderID', true );
	$order    = wc_get_order( $order_id );

	try {
		if ( false !== $order ) {

			$temp_ticket['customerFirstName'] = (string) $order->get_billing_first_name();
			$temp_ticket['customerLastName']  = (string) $order->get_billing_last_name();
			$temp_ticket['customerEmail']     = $hide_personal_info ? '***' : (string) $order->get_billing_email();
			$temp_ticket['customerPhone']     = $hide_personal_info ? '***' : (string) $order->get_billing_phone();
			$temp_ticket['customerID']        = (string) $order->get_customer_id();

			if ( '' === trim( $temp_ticket['customerFirstName'] ) ) {

				$temp_ticket['customerFirstName'] = get_post_meta( $ticket_id, 'WooCommerceEventsPurchaserFirstName', true );
				$temp_ticket['customerLastName']  = get_post_meta( $ticket_id, 'WooCommerceEventsPurchaserLastName', true );
				$temp_ticket['customerEmail']     = $hide_personal_info ? '***' : get_post_meta( $ticket_id, 'WooCommerceEventsPurchaserEmail', true );
				$temp_ticket['customerPhone']     = $hide_personal_info ? '***' : get_post_meta( $ticket_id, 'WooCommerceEventsPurchaserPhone', true );

			}

			if ( '' === trim( $temp_ticket['customerFirstName'] ) ) {

				$user = get_user_by( 'id', $order->get_customer_id() );

				if ( false !== $user ) {
					$temp_ticket['customerFirstName'] = $user->display_name;
				}
			}
		}

		$temp_ticket['WooCommerceEventsAttendeeName']        = (string) get_post_meta( $ticket_id, 'WooCommerceEventsAttendeeName', true );
		$temp_ticket['WooCommerceEventsAttendeeLastName']    = (string) get_post_meta( $ticket_id, 'WooCommerceEventsAttendeeLastName', true );
		$temp_ticket['WooCommerceEventsAttendeeEmail']       = $hide_personal_info ? '***' : (string) get_post_meta( $ticket_id, 'WooCommerceEventsAttendeeEmail', true );
		$temp_ticket['WooCommerceEventsAttendeeTelephone']   = $hide_personal_info ? '***' : (string) get_post_meta( $ticket_id, 'WooCommerceEventsAttendeeTelephone', true );
		$temp_ticket['WooCommerceEventsAttendeeCompany']     = $hide_personal_info ? '***' : (string) get_post_meta( $ticket_id, 'WooCommerceEventsAttendeeCompany', true );
		$temp_ticket['WooCommerceEventsAttendeeDesignation'] = $hide_personal_info ? '***' : (string) get_post_meta( $ticket_id, 'WooCommerceEventsAttendeeDesignation', true );
		$temp_ticket['WooCommerceEventsTicketID']            = (string) get_post_meta( $ticket_id, 'WooCommerceEventsTicketID', true );
		$temp_ticket['WooCommerceEventsStatus']              = (string) get_post_meta( $ticket_id, 'WooCommerceEventsStatus', true );
		$temp_ticket['WooCommerceEventsMultidayStatus']      = (string) get_post_meta( $ticket_id, 'WooCommerceEventsMultidayStatus', true );
		$temp_ticket['WooCommerceEventsTicketType']          = (string) get_post_meta( $ticket_id, 'WooCommerceEventsTicketType', true );
		$temp_ticket['WooCommerceEventsVariationID']         = (string) get_post_meta( $ticket_id, 'WooCommerceEventsVariationID', true );
		$temp_ticket['WooCommerceEventsProductID']           = (string) get_post_meta( $ticket_id, 'WooCommerceEventsProductID', true );

		$temp_ticket['WooCommerceEventsTicketIdentifierOutput'] = get_post_meta( $temp_ticket['WooCommerceEventsProductID'], 'WooCommerceEventsTicketIdentifierOutput', true );

		if ( empty( $temp_ticket['WooCommerceEventsTicketIdentifierOutput'] ) ) {

			$temp_ticket['WooCommerceEventsTicketIdentifierOutput'] = 'ticketid';

		}

		$ticket_number_formatted = (string) get_post_meta( $ticket_id, 'WooCommerceEventsTicketNumberFormatted', true );

		$temp_ticket['WooCommerceEventsTicketNumberFormatted'] = '';

		if ( 'ticketnumberformatted' === $temp_ticket['WooCommerceEventsTicketIdentifierOutput'] && ! empty( $ticket_number_formatted ) ) {

			$temp_ticket['WooCommerceEventsTicketNumberFormatted'] = $temp_ticket['WooCommerceEventsProductID'] . '-' . $ticket_number_formatted;

		}

		$ticket_num_days = (string) get_post_meta( $temp_ticket['WooCommerceEventsProductID'], 'WooCommerceEventsNumDays', true );

		$temp_ticket['WooCommerceEventsNumDays'] = '' === $ticket_num_days ? '1' : $ticket_num_days;

		$temp_ticket['WooCommerceEventsOrderID']         = (string) get_post_meta( $ticket_id, 'WooCommerceEventsOrderID', true );
		$temp_ticket['WooCommerceEventsTicketPrice']     = (string) get_post_meta( $ticket_id, 'WooCommerceEventsPrice', true );
		$temp_ticket['WooCommerceEventsTicketPriceText'] = (string) html_entity_decode( strip_tags( get_post_meta( $ticket_id, 'WooCommerceEventsPrice', true ) ), ENT_HTML5, 'UTF-8' );

		$temp_ticket['WooCommerceEventsBookingSlotID'] = (string) get_post_meta( $ticket_id, 'WooCommerceEventsBookingSlotID', true );
		$temp_ticket['WooCommerceEventsBookingSlot']   = (string) get_post_meta( $ticket_id, 'WooCommerceEventsBookingSlot', true );
		$temp_ticket['WooCommerceEventsBookingDate']   = (string) get_post_meta( $ticket_id, 'WooCommerceEventsBookingDate', true );

		$date_format = get_option( 'date_format' ) . ' H:i';

		$woocommerce_events_booking_date = DateTime::createFromFormat( $date_format, $temp_ticket['WooCommerceEventsBookingDate'] . ' 12:00', new DateTimeZone( 'UTC' ) );

		$temp_ticket['WooCommerceEventsBookingDateTimestamp'] = 0;

		if ( false === $woocommerce_events_booking_date ) {

			$woocommerce_events_booking_date = convert_month_to_english( $temp_ticket['WooCommerceEventsBookingDate'] );
			$timestamp                       = strtotime( $woocommerce_events_booking_date . ' 12:00' );

			if ( false === $timestamp ) {

				$timestamp = (string) time();

			}

			try {

				$booking_date = new DateTime( '@' . $timestamp, new DateTimeZone( 'UTC' ) );

			} catch ( Exception $e ) {

				$booking_date = new DateTime( 'now', new DateTimeZone( 'UTC' ) );

			}

			$temp_ticket['WooCommerceEventsBookingDateTimestamp'] = (string) $booking_date->getTimestamp();

		} else {

			$temp_ticket['WooCommerceEventsBookingDateTimestamp'] = (string) $woocommerce_events_booking_date->getTimestamp();

		}

		$woocommerce_events_variations_output = array();

		$temp_ticket['WooCommerceEventsVariationID'] = get_post_meta( $ticket_id, 'WooCommerceEventsVariationID', true );

		if ( ! empty( $temp_ticket['WooCommerceEventsVariationID'] ) ) {

			$variation_obj = new WC_Product_variation( $temp_ticket['WooCommerceEventsVariationID'] );
			$variations    = $variation_obj->get_attribute_summary();

			if ( ! empty( $variations ) ) {
				$variations = explode( ',', $variations );

				foreach ( $variations as $variation ) {

					$variation = explode( ': ', trim( $variation ) );
					$woocommerce_events_variations_output[ trim( $variation[0] ) ] = trim( $variation[1] );

				}
			}
		}

		$temp_ticket['WooCommerceEventsVariations'] = $woocommerce_events_variations_output;

		// Check if custom attendee fields plugin is enabled.
		if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'is_plugin_active_for_network' ) ) {

			require_once ABSPATH . '/wp-admin/includes/plugin.php';

		}

		// Custom Attendee Fields.
		$custom_values = array();

		if ( is_plugin_active( 'fooevents_custom_attendee_fields/fooevents-custom-attendee-fields.php' ) || is_plugin_active_for_network( 'fooevents_custom_attendee_fields/fooevents-custom-attendee-fields.php' ) ) {

			$fooevents_custom_attendee_fields = new Fooevents_Custom_Attendee_Fields();

			$fooevents_custom_attendee_fields_options = $fooevents_custom_attendee_fields->display_tickets_meta_custom_options_output( $ticket_id, $temp_ticket['WooCommerceEventsProductID'] );

			foreach ( $fooevents_custom_attendee_fields_options as $key => $field ) {

				$custom_values[ $field['label'] ] = $field['value'];

			}
		}

		$temp_ticket['WooCommerceEventsCustomAttendeeFields'] = $custom_values;

		// Seating.
		$ticket_meta = get_post_meta( $ticket_id );
		$row_name    = '';
		$seat_number = '';

		foreach ( $ticket_meta as $meta_key => $meta_value ) {

			if ( strpos( $meta_key, 'fooevents_seat_row_name_' ) !== false ) {

				$row_name = (string) $meta_value[0];

			} elseif ( strpos( $meta_key, 'fooevents_seat_number_' ) !== false ) {

				$seat_number = (string) $meta_value[0];

			}
		}

		$temp_ticket['WooCommerceEventsRowName']    = $row_name;
		$temp_ticket['WooCommerceEventsSeatNumber'] = $seat_number;

		$temp_ticket['WooCommerceEventsTicketExpirationType'] = (string) get_post_meta( $temp_ticket['WooCommerceEventsProductID'], 'WooCommerceEventsTicketExpirationType', true );

		if ( 'select' === get_post_meta( $temp_ticket['WooCommerceEventsProductID'], 'WooCommerceEventsTicketExpirationType', true ) && ! empty( get_post_meta( $temp_ticket['WooCommerceEventsProductID'], 'WooCommerceEventsTicketsExpireSelectTimestamp', true ) ) ) {
			$temp_ticket['WooCommerceEventsTicketExpireTimestamp'] = (string) get_post_meta( $temp_ticket['WooCommerceEventsProductID'], 'WooCommerceEventsTicketsExpireSelectTimestamp', true );
		} else {
			$temp_ticket['WooCommerceEventsTicketExpireTimestamp'] = (string) get_post_meta( $ticket_id, 'WooCommerceEventsTicketExpireTimestamp', true );
		}

		return $temp_ticket;

	} catch ( Exception $e ) {

		return array();

	}
}

/**
 * Get all tickets for an event as an array
 *
 * @param string $event_id event ID.
 * @return array ticketsArray
 */
function get_event_tickets( $event_id ) {

	global $woocommerce;
	$tickets_array         = array();
	$ticket_status_options = array();

	$event_id      = sanitize_text_field( $event_id );
	$ticket_offset = -1;

	if ( false !== strpos( $event_id, '_' ) ) {
		$event_id_values = explode( '_', $event_id );

		$event_id      = $event_id_values[0];
		$ticket_offset = (int) $event_id_values[1];
	}

	$hide_personal_info = get_option( 'globalWooCommerceEventsAppHidePersonalInfo', false );

	$global_woocommerce_hide_unpaid_tickets_app = get_option( 'globalWooCommerceHideUnpaidTicketsApp', true );

	if ( 'yes' === $global_woocommerce_hide_unpaid_tickets_app ) {

		$ticket_status_options = array(
			'key'     => 'WooCommerceEventsStatus',
			'compare' => '!=',
			'value'   => 'Unpaid',
		);

	}

	$tickets_per_request = get_option( 'globalWooCommerceEventsAppTicketsPerRequest', 'all' );

	$ticket_args = array(
		'post_type'        => array( 'event_magic_tickets' ),
		'posts_per_page'   => -1,
		'fields'           => 'ids',
		'suppress_filters' => true,
		'meta_query'       => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => 'WooCommerceEventsProductID',
				'value' => $event_id,
			),
			$ticket_status_options,
		),
	);

	if ( 'all' !== $tickets_per_request && (int) $tickets_per_request > 0 && $ticket_offset > -1 ) {
		$ticket_args['posts_per_page'] = (int) $tickets_per_request;
		$ticket_args['offset']         = $ticket_offset * (int) $tickets_per_request;
	}

	$events_query = new WP_Query( $ticket_args );
	$ticket_ids   = $events_query->get_posts();

	$order_event_slot_tickets = array();

	foreach ( $ticket_ids as $ticket_id ) {

		$temp_ticket = get_ticket_data( $ticket_id, $hide_personal_info );

		if ( ! empty( $temp_ticket ) ) {

			$tickets_array[] = $temp_ticket;

			if ( ! empty( $temp_ticket['WooCommerceEventsOrderID'] ) ) {
				if ( ! isset( $order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ] ) ) {
					$order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ] = array();
				}

				$order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ][] = (string) $temp_ticket['WooCommerceEventsTicketID'];
			}
		}

		unset( $temp_ticket );

	}

	foreach ( $tickets_array as &$temp_ticket ) {
		$temp_ticket['WooCommerceEventsOrderTickets'] = $order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ];
	}

	return $tickets_array;
}

/**
 * Get all updated tickets for an event as an array
 *
 * @param string $event_id event ID.
 * @param int    $since since.
 * @return array ticketsArray
 */
function get_event_updated_tickets( $event_id, $since ) {

	global $woocommerce;
	global $wpdb;

	$table_name          = $wpdb->prefix . 'fooevents_check_in';
	$postmeta_table_name = $wpdb->prefix . 'postmeta';

	$tickets_array         = array();
	$ticket_status_options = array();

	$event_id = sanitize_text_field( $event_id );
	$since    = sanitize_text_field( $since );

	$tickets = $wpdb->get_results(
		'
        SELECT * FROM ' . $table_name . '
        LEFT JOIN ' . $postmeta_table_name . ' ON
            ' . $table_name . '.tid = ' . $postmeta_table_name . '.post_id AND
            ' . $postmeta_table_name . ".meta_key = 'WooCommerceEventsTicketID'
        WHERE
            eid = " . $event_id . ' AND
            checkin >= ' . $since . '
		ORDER BY checkin DESC
    '
	);

	$updated_ticket_ids = array();

	foreach ( $tickets as $ticket ) {

		if ( in_array( (string) $ticket->tid . '_' . (string) $ticket->day, $updated_ticket_ids, true ) ) {
			continue;
		}

		$updated_ticket_ids[] = (string) $ticket->tid . '_' . (string) $ticket->day;

		$tickets_array[] = array(
			'WooCommerceEventsTicketID' => $ticket->meta_value,
			'WooCommerceEventsStatus'   => '' !== (string) $ticket->status ? (string) $ticket->status : 'Checked In',
			'Day'                       => (string) $ticket->day,
			'Updated'                   => (string) $ticket->checkin,
		);

	}

	return $tickets_array;
}

/**
 * Get a single ticket if it exists
 *
 * @param string $ticket_id ticket ID.
 * @return array ticket
 */
function get_single_ticket( $ticket_id ) {

	$ticket_id = sanitize_text_field( $ticket_id );

	$ticket_query_args = array(
		'post_type'        => array( 'event_magic_tickets' ),
		'suppress_filters' => true,
	);

	$ticket_id_parts = explode( '-', $ticket_id );

	if ( count( $ticket_id_parts ) === 2 ) {
		// Formatted ticket number.
		$ticket_query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'AND',
			array(
				'key'   => 'WooCommerceEventsProductID',
				'value' => $ticket_id_parts[0],
			),
			array(
				'key'   => 'WooCommerceEventsTicketNumberFormatted',
				'value' => $ticket_id_parts[1],
			),
		);
	} else {
		// Standard ticket number.
		$ticket_query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => 'WooCommerceEventsTicketID',
				'value' => $ticket_id_parts[0],
			),
		);
	}

	$ticket_query = new WP_Query( $ticket_query_args );

	$ticket_posts = $ticket_query->get_posts();

	$output = array();

	$hide_personal_info = get_option( 'globalWooCommerceEventsAppHidePersonalInfo', false );

	if ( ! empty( $ticket_posts ) ) {

		$ticket_post = $ticket_posts[0];

		$temp_ticket = get_ticket_data( $ticket_post->ID, $hide_personal_info );

		if ( ! empty( $temp_ticket ) ) {
			$ticket_status_options = array();

			$global_woocommerce_hide_unpaid_tickets_app = get_option( 'globalWooCommerceHideUnpaidTicketsApp', true );

			if ( 'yes' === $global_woocommerce_hide_unpaid_tickets_app ) {

				$ticket_status_options = array(
					'key'     => 'WooCommerceEventsStatus',
					'compare' => '!=',
					'value'   => 'Unpaid',
				);

			}

			$ticket_args = array(
				'post_type'        => array( 'event_magic_tickets' ),
				'posts_per_page'   => -1,
				'fields'           => 'ids',
				'suppress_filters' => true,
				'meta_query'       => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
					array(
						'key'   => 'WooCommerceEventsOrderID',
						'value' => $temp_ticket['WooCommerceEventsOrderID'],
					),
					$ticket_status_options,
				),
			);

			$tickets_query = new WP_Query( $ticket_args );
			$ticket_ids    = $tickets_query->get_posts();

			$order_event_slot_tickets = array();

			foreach ( $ticket_ids as $ticket_id ) {

				if ( ! empty( $temp_ticket['WooCommerceEventsOrderID'] ) ) {
					if ( ! isset( $order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ] ) ) {
						$order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ] = array();
					}

					$order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ][] = (string) get_post_meta( $ticket_id, 'WooCommerceEventsTicketID', true );
				}
			}

			$temp_ticket['WooCommerceEventsOrderTickets'] = $order_event_slot_tickets[ 'order_' . $temp_ticket['WooCommerceEventsOrderID'] . '_event_' . $temp_ticket['WooCommerceEventsProductID'] . '_slot_' . $temp_ticket['WooCommerceEventsBookingSlotID'] ];

			$output['data'] = $temp_ticket;

		} else {

			$output['status'] = 'error';

		}
	} else {

		$output['status'] = 'error';

	}

	return $output;
}

/**
 * Update ticket ID with the provided status
 *
 * @param int    $ticket_id ticket ID.
 * @param string $status status.
 */
function update_ticket_status( $ticket_id, $status ) {

	global $wpdb;
	$table_name = $wpdb->prefix . 'fooevents_check_in';

	$ticket_query_args = array(
		'post_type'        => array( 'event_magic_tickets' ),
		'suppress_filters' => true,
	);

	$ticket_id_parts = explode( '-', $ticket_id );

	if ( count( $ticket_id_parts ) === 2 ) {
		// Formatted ticket number.
		$ticket_query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'AND',
			array(
				'key'   => 'WooCommerceEventsProductID',
				'value' => $ticket_id_parts[0],
			),
			array(
				'key'   => 'WooCommerceEventsTicketNumberFormatted',
				'value' => $ticket_id_parts[1],
			),
		);
	} else {
		// Standard ticket number.
		$ticket_query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => 'WooCommerceEventsTicketID',
				'value' => $ticket_id_parts[0],
			),
		);
	}

	$ticket_query = new WP_Query( $ticket_query_args );
	$tickets      = $ticket_query->get_posts();
	$ticket       = $tickets[0];

	$event_id = get_post_meta( $ticket->ID, 'WooCommerceEventsProductID', true );

	$timestamp = current_time( 'timestamp' );

	if ( ! empty( $status ) ) {

		$status_changed = false;

		$current_status = get_post_meta( $ticket->ID, 'WooCommerceEventsStatus', true );

		if ( $current_status !== $status ) {

			$status_changed = true;

			update_post_meta( $ticket->ID, 'WooCommerceEventsStatus', strip_tags( $status ) );

		}

		// Check if multiday event plugin is enabled.
		if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'is_plugin_active_for_network' ) ) {

			require_once ABSPATH . '/wp-admin/includes/plugin.php';

		}

		if ( is_plugin_active( 'fooevents_multi_day/fooevents-multi-day.php' ) || is_plugin_active_for_network( 'fooevents_multi_day/fooevents-multi-day.php' ) ) {

			$woocommerce_events_num_days = (int) get_post_meta( $event_id, 'WooCommerceEventsNumDays', true );

			if ( $woocommerce_events_num_days > 1 ) {

				$woocommerce_events_multiday_status = array();

				for ( $day = 1; $day <= $woocommerce_events_num_days; $day++ ) {

					$woocommerce_events_multiday_status[ $day ] = strip_tags( $status );

					$wpdb->insert(
						$table_name,
						array(
							'tid'     => $ticket->ID,
							'eid'     => $event_id,
							'day'     => $day,
							'uid'     => get_current_user_id(),
							'status'  => $status,
							'checkin' => $timestamp,
						)
					);

				}

				$woocommerce_events_multiday_status = json_encode( $woocommerce_events_multiday_status );

				update_post_meta( $ticket->ID, 'WooCommerceEventsMultidayStatus', strip_tags( $woocommerce_events_multiday_status ) );

			} else {

				$wpdb->insert(
					$table_name,
					array(
						'tid'     => $ticket->ID,
						'eid'     => $event_id,
						'day'     => 1,
						'uid'     => get_current_user_id(),
						'status'  => $status,
						'checkin' => $timestamp,
					)
				);

			}
		} else {

			$wpdb->insert(
				$table_name,
				array(
					'tid'     => $ticket->ID,
					'eid'     => $event_id,
					'day'     => 1,
					'uid'     => get_current_user_id(),
					'status'  => $status,
					'checkin' => $timestamp,
				)
			);

		}

		if ( 'Checked In' === $status ) {
			do_action( 'fooevents_check_in_ticket', array( $ticket->ID, $status, time() ) );
		}

		return $status_changed ? 'Status updated' : 'Status unchanged';

	} else {

		return 'Status is required';

	}
}

/**
 * Update multiple ticket IDs with the provided statuses
 *
 * @param string $tickets_status status.
 */
function update_ticket_multiple_status( $tickets_status ) {

	$output = array();

	$tickets_status = json_decode( $tickets_status, true );

	if ( ! empty( $tickets_status ) ) {

		foreach ( $tickets_status as $temp_ticket_id => $status ) {

			if ( strpos( $temp_ticket_id, '_' ) !== false ) {

				$temp_ticket_array = explode( '_', $temp_ticket_id );

				$ticket_id = $temp_ticket_array[0];
				$day       = $temp_ticket_array[1];

				$output['message'][ $ticket_id ] = update_ticket_multiday_status( $ticket_id, $status, $day );

			} else {

				$output['message'][ $temp_ticket_id ] = update_ticket_status( $temp_ticket_id, strip_tags( $status ) );

			}
		}
	} else {

		$output['message'] = 'Status is required';

	}

	return $output;
}

/**
 * Update ticket ID status for a specified day in a multiday event
 *
 * @param int    $ticket_id ticket ID.
 * @param string $status status.
 * @param int    $day day.
 */
function update_ticket_multiday_status( $ticket_id, $status, $day ) {

	global $wpdb;
	$table_name = $wpdb->prefix . 'fooevents_check_in';

	$ticket_id = sanitize_text_field( $ticket_id );
	$status    = sanitize_text_field( $status );
	$day       = sanitize_text_field( $day );

	$ticket_query_args = array(
		'post_type'        => array( 'event_magic_tickets' ),
		'suppress_filters' => true,
	);

	$ticket_id_parts = explode( '-', $ticket_id );

	if ( count( $ticket_id_parts ) === 2 ) {
		// Formatted ticket number.
		$ticket_query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'AND',
			array(
				'key'   => 'WooCommerceEventsProductID',
				'value' => $ticket_id_parts[0],
			),
			array(
				'key'   => 'WooCommerceEventsTicketNumberFormatted',
				'value' => $ticket_id_parts[1],
			),
		);
	} else {
		// Standard ticket number.
		$ticket_query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => 'WooCommerceEventsTicketID',
				'value' => $ticket_id_parts[0],
			),
		);
	}

	$ticket_query = new WP_Query( $ticket_query_args );
	$tickets      = $ticket_query->get_posts();

	if ( ! empty( $tickets ) ) {
		$ticket   = $tickets[0];
		$event_id = get_post_meta( $ticket->ID, 'WooCommerceEventsProductID', true );

		$timestamp = current_time( 'timestamp' );

		if ( ! empty( $status ) ) {

			$wpdb->insert(
				$table_name,
				array(
					'tid'     => $ticket->ID,
					'eid'     => $event_id,
					'day'     => $day,
					'status'  => $status,
					'uid'     => get_current_user_id(),
					'checkin' => $timestamp,
				)
			);

		}

		$woocommerce_events_multiday_status = get_post_meta( $ticket->ID, 'WooCommerceEventsMultidayStatus', true );
		$woocommerce_events_multiday_status = json_decode( $woocommerce_events_multiday_status, true );

		$status_changed = $woocommerce_events_multiday_status[ $day ] !== $status;

		$woocommerce_events_multiday_status[ $day ] = $status;

		$all_days_same_status = true;

		foreach ( $woocommerce_events_multiday_status as $day => $multiday_status ) {

			if ( $multiday_status !== $status ) {

				$all_days_same_status = false;

				break;

			}
		}

		$woocommerce_events_multiday_status = wp_json_encode( $woocommerce_events_multiday_status );

		update_post_meta( $ticket->ID, 'WooCommerceEventsMultidayStatus', strip_tags( $woocommerce_events_multiday_status ) );

		if ( $all_days_same_status ) {

			update_post_meta( $ticket->ID, 'WooCommerceEventsStatus', strip_tags( $status ) );

		} else {

			update_post_meta( $ticket->ID, 'WooCommerceEventsStatus', 'Not Checked In' );

		}

		if ( 'Checked In' === $status ) {
			do_action( 'fooevents_check_in_ticket', array( $ticket->ID, $status, time() ) );
		}

		return $status_changed ? 'Status updated' : 'Status unchanged';
	} else {
		return 'Status not updated';
	}
}

/**
 * Output the name of a custom field
 *
 * @param string $field_name field name.
 */
function fooevents_output_custom_field_name( $field_name ) {

	$field_name = str_replace( 'fooevents_custom_', '', $field_name );
	$field_name = str_replace( '_', ' ', $field_name );
	$field_name = ucwords( $field_name );

	return $field_name;
}

/**
 * Array of month names for translation to English
 *
 * @param string $event_date event date.
 * @return string
 */
function convert_month_to_english( $event_date ) {

	$months = array(
		// French.
		'janvier'       => 'January',
		'février'       => 'February',
		'mars'          => 'March',
		'avril'         => 'April',
		'mai'           => 'May',
		'juin'          => 'June',
		'juillet'       => 'July',
		'aout'          => 'August',
		'août'          => 'August',
		'septembre'     => 'September',
		'octobre'       => 'October',

		// German.
		'Januar'        => 'January',
		'Februar'       => 'February',
		'März'          => 'March',
		'Mai'           => 'May',
		'Juni'          => 'June',
		'Juli'          => 'July',
		'Oktober'       => 'October',
		'Dezember'      => 'December',
		'Montag'        => '',
		'Dienstag'      => '',
		'Mittwoch'      => '',
		'Donnerstag'    => '',
		'Freitag'       => '',
		'Samstag'       => '',
		'Sonntag'       => '',

		// Spanish.
		'enero'         => 'January',
		'febrero'       => 'February',
		'marzo'         => 'March',
		'abril'         => 'April',
		'mayo'          => 'May',
		'junio'         => 'June',
		'julio'         => 'July',
		'agosto'        => 'August',
		'septiembre'    => 'September',
		'setiembre'     => 'September',
		'octubre'       => 'October',
		'noviembre'     => 'November',
		'diciembre'     => 'December',
		'novembre'      => 'November',
		'décembre'      => 'December',
		'lunes'         => '',
		'martes'        => '',
		'miércoles'     => '',
		'jueves'        => '',
		'viernes'       => '',
		'sábado'        => '',
		'domingo'       => '',

		// Catalan - Spain.
		'gener'         => 'January',
		'febrer'        => 'February',
		'març'          => 'March',
		'abril'         => 'April',
		'maig'          => 'May',
		'juny'          => 'June',
		'juliol'        => 'July',
		'agost'         => 'August',
		'setembre'      => 'September',
		'octubre'       => 'October',
		'novembre'      => 'November',
		'desembre'      => 'December',

		// Dutch.
		'januari'       => 'January',
		'februari'      => 'February',
		'maart'         => 'March',
		'april'         => 'April',
		'mei'           => 'May',
		'juni'          => 'June',
		'juli'          => 'July',
		'augustus'      => 'August',
		'september'     => 'September',
		'oktober'       => 'October',
		'november'      => 'November',
		'december'      => 'December',
		'maandag'       => '',
		'dinsdag'       => '',
		'woensdag'      => '',
		'donderdag'     => '',
		'vrijdag'       => '',
		'zaterdag'      => '',
		'zondag'        => '',

		// Italian.
		'Gennaio'       => 'January',
		'Febbraio'      => 'February',
		'Marzo'         => 'March',
		'Aprile'        => 'April',
		'Maggio'        => 'May',
		'Giugno'        => 'June',
		'Luglio'        => 'July',
		'Agosto'        => 'August',
		'Settembre'     => 'September',
		'Ottobre'       => 'October',
		'Novembre'      => 'November',
		'Dicembre'      => 'December',

		// Polish.
		'Styczeń'       => 'January',
		'Luty'          => 'February',
		'Marzec'        => 'March',
		'Kwiecień'      => 'April',
		'Maj'           => 'May',
		'Czerwiec'      => 'June',
		'Lipiec'        => 'July',
		'Sierpień'      => 'August',
		'Wrzesień'      => 'September',
		'Październik'   => 'October',
		'Listopad'      => 'November',
		'Grudzień'      => 'December',

		// Afrikaans.
		'Januarie'      => 'January',
		'Februarie'     => 'February',
		'Maart'         => 'March',
		'Mei'           => 'May',
		'Junie'         => 'June',
		'Julie'         => 'July',
		'Augustus'      => 'August',
		'Oktober'       => 'October',
		'Desember'      => 'December',

		// Turkish.
		'Ocak'          => 'January',
		'Şubat'         => 'February',
		'Mart'          => 'March',
		'Nisan'         => 'April',
		'Mayıs'         => 'May',
		'Haziran'       => 'June',
		'Temmuz'        => 'July',
		'Ağustos'       => 'August',
		'Eylül'         => 'September',
		'Ekim'          => 'October',
		'Kasım'         => 'November',
		'Aralık'        => 'December',

		// Portuguese.
		'janeiro'       => 'January',
		'fevereiro'     => 'February',
		'março'         => 'March',
		'abril'         => 'April',
		'maio'          => 'May',
		'junho'         => 'June',
		'julho'         => 'July',
		'agosto'        => 'August',
		'setembro'      => 'September',
		'outubro'       => 'October',
		'novembro'      => 'November',
		'dezembro'      => 'December',

		// Swedish.
		'Januari'       => 'January',
		'Februari'      => 'February',
		'Mars'          => 'March',
		'April'         => 'April',
		'Maj'           => 'May',
		'Juni'          => 'June',
		'Juli'          => 'July',
		'Augusti'       => 'August',
		'September'     => 'September',
		'Oktober'       => 'October',
		'November'      => 'November',
		'December'      => 'December',

		// Czech.
		'leden'         => 'January',
		'únor'          => 'February',
		'březen'        => 'March',
		'duben'         => 'April',
		'květen'        => 'May',
		'červen'        => 'June',
		'červenec'      => 'July',
		'srpen'         => 'August',
		'září'          => 'September',
		'říjen'         => 'October',
		'listopad'      => 'November',
		'prosinec'      => 'December',

		// Norwegian.
		'januar'        => 'January',
		'februar'       => 'February',
		'mars'          => 'March',
		'april'         => 'April',
		'mai'           => 'May',
		'juni'          => 'June',
		'juli'          => 'July',
		'august'        => 'August',
		'september'     => 'September',
		'oktober'       => 'October',
		'november'      => 'November',
		'desember'      => 'December',

		// Danish.
		'januar'        => 'January',
		'februar'       => 'February',
		'marts'         => 'March',
		'april'         => 'April',
		'maj'           => 'May',
		'juni'          => 'June',
		'juli'          => 'July',
		'august'        => 'August',
		'september'     => 'September',
		'oktober'       => 'October',
		'november'      => 'November',
		'december'      => 'December',

		// Finnish.
		'tammikuu'      => 'January',
		'helmikuu'      => 'February',
		'maaliskuu'     => 'March',
		'huhtikuu'      => 'April',
		'toukokuu'      => 'May',
		'kesäkuu'       => 'June',
		'heinäkuu'      => 'July',
		'elokuu'        => 'August',
		'syyskuu'       => 'September',
		'lokakuu'       => 'October',
		'marraskuu'     => 'November',
		'joulukuu'      => 'December',

		// Russian.
		'Январь'        => 'January',
		'Февраль'       => 'February',
		'Март'          => 'March',
		'Апрель'        => 'April',
		'Май'           => 'May',
		'Июнь'          => 'June',
		'Июль'          => 'July',
		'Август'        => 'August',
		'Сентябрь'      => 'September',
		'Октябрь'       => 'October',
		'Ноябрь'        => 'November',
		'Декабрь'       => 'December',

		// Icelandic.
		'Janúar'        => 'January',
		'Febrúar'       => 'February',
		'Mars'          => 'March',
		'Apríl'         => 'April',
		'Maí'           => 'May',
		'Júní'          => 'June',
		'Júlí'          => 'July',
		'Ágúst'         => 'August',
		'September'     => 'September',
		'Oktober'       => 'October',
		'Nóvember'      => 'November',
		'Desember'      => 'December',

		// Latvian.
		'janvāris'      => 'January',
		'februāris'     => 'February',
		'marts'         => 'March',
		'aprīlis'       => 'April',
		'maijs'         => 'May',
		'jūnijs'        => 'June',
		'jūlijs'        => 'July',
		'augusts'       => 'August',
		'septembris'    => 'September',
		'oktobris'      => 'October',
		'novembris'     => 'November',
		'decembris'     => 'December',

		// Lithuanian.
		'sausio'        => 'January',
		'vasario'       => 'February',
		'kovo'          => 'March',
		'balandžio'     => 'April',
		'gegužės'       => 'May',
		'birželio'      => 'June',
		'liepos'        => 'July',
		'rugpjūčio'     => 'August',
		'rugsėjo'       => 'September',
		'spalio'        => 'October',
		'lapkričio'     => 'November',
		'gruodžio'      => ' December',

		// Greek.
		'Ιανουάριος'    => 'January',
		'Φεβρουάριος'   => 'February',
		'Μάρτιος'       => 'March',
		'Απρίλιος'      => 'April',
		'Μάιος'         => 'May',
		'Ιούνιος'       => 'June',
		'Ιούλιος'       => 'July',
		'Αύγουστος'     => 'August',
		'Σεπτέμβριος'   => 'September',
		'Οκτώβριος'     => 'October',
		'Νοέμβρ��ος'    => 'November',
		'����εκέμβριος' => 'December',

		// Slovak - Slovakia.
		'január'        => 'January',
		'február'       => 'February',
		'marec'         => 'March',
		'apríl'         => 'April',
		'máj'           => 'May',
		'jún'           => 'June',
		'júl'           => 'July',
		'august'        => 'August',
		'september'     => 'September',
		'október'       => 'October',
		'november'      => 'November',
		'december'      => 'December',

		// Slovenian - Slovenia.
		'januar'        => 'January',
		'februar'       => 'February',
		'marec'         => 'March',
		'april'         => 'April',
		'maj'           => 'May',
		'junij'         => 'June',
		'julij'         => 'July',
		'avgust'        => 'August',
		'september'     => 'September',
		'oktober'       => 'October',
		'november'      => 'November',
		'december'      => 'December',

		// Romanian - Romania.
		'ianuarie'      => 'January',
		'februarie'     => 'February',
		'martie'        => 'March',
		'aprilie'       => 'April',
		'mai'           => 'May',
		'iunie'         => 'June',
		'iulie'         => 'July',
		'august'        => 'August',
		'septembrie'    => 'September',
		'octombrie'     => 'October',
		'noiembrie'     => 'November',
		'decembrie'     => 'December',

		// Croatian - Croatia.

		'siječanj'      => 'January',
		'veljača'       => 'February',
		'ožujak'        => 'March',
		'travanj'       => 'April',
		'svibanj'       => 'May',
		'lipanj'        => 'June',
		'srpanj'        => 'July',
		'kolovoz'       => 'August',
		'rujan'         => 'September',
		'listopad'      => 'October',
		'studeni'       => 'November',
		'prosinac'      => 'December',
	);

	$pattern     = array_keys( $months );
	$replacement = array_values( $months );

	foreach ( $pattern as $key => $value ) {

		$pattern[ $key ] = '/\b' . $value . '\b/iu';

	}

	$replaced_event_date = preg_replace( $pattern, $replacement, $event_date );

	$replaced_event_date = str_replace( ' de ', ' ', $replaced_event_date );

	return $replaced_event_date;
}
