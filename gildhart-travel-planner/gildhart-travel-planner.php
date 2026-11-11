<?php
/**
 * Plugin Name:       Travel Planner by Gildhart
 * Description:       "Where are you going?" for a pharmacy's travel clinic: any country, the vaccines the guidance lists for it, what each costs a dose here, how far ahead to book, and the day's outbreak notices. Every answer ends at a booking.
 * Version:           1.1.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Gildhart
 * Author URI:        https://gildhart.com
 * License:           GPL-2.0-or-later
 * Text Domain:       gildhart-travel-planner
 *
 * One pharmacy's travel desk, on any WordPress site, with nothing borrowed
 * from the theme around it.
 *
 *   [travel_planner]   the planner: the map, the box over every country, the trip card
 *   [travel_notices]   the latest outbreak notices, by date, disease and country
 *
 * Three things, kept apart because they change at different speeds and are
 * trusted differently:
 *
 *   data/        what the guidance says about each country, written in our
 *                own words from NaTHNaC's TravelHealthPro and dated. It ships
 *                with the plugin and changes only with a new version: a
 *                recommendation never moves on a site without a person
 *                having looked (workspace/travel-planner/build_pack.py).
 *   settings     what this pharmacy gives and charges, where it books, where
 *                it is: Travel Planner in wp-admin, or a file in the theme
 *                (gildhart-travel-planner.json) until someone saves there.
 *   notices      NaTHNaC's outbreak notices, read once a day: the date, the
 *                disease and the country, never their words or figures. A
 *                person can add, hide or correct one, and read again by hand.
 *
 * The rules a card keeps, each learned on the first site this ran on:
 * a price is one dose's, never a course's total; a vaccine is named by its
 * type, never a brand; nobody is told they don't need one; every card ends
 * at a booking; and everything dated says its date.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'GTP_VERSION', '1.1.0' );
define( 'GTP_FILE', __FILE__ );
define( 'GTP_DIR', __DIR__ );

require_once GTP_DIR . '/includes/settings.php';
require_once GTP_DIR . '/includes/data.php';
require_once GTP_DIR . '/includes/notices.php';
require_once GTP_DIR . '/includes/cache.php';
require_once GTP_DIR . '/includes/planner.php';
require_once GTP_DIR . '/includes/admin.php';

/** The plugin's address, for its own script, stylesheet and data. */
function gtp_url( $path = '' ) {
	return plugins_url( ltrim( (string) $path, '/' ), GTP_FILE );
}

/** A file's own version, so a new one is never served from an old cache. */
function gtp_asset_version( $path ) {
	$file = GTP_DIR . '/' . ltrim( (string) $path, '/' );
	return is_file( $file ) ? GTP_VERSION . '.' . filemtime( $file ) : GTP_VERSION;
}

register_activation_hook( __FILE__, 'gtp_notices_schedule' );
register_deactivation_hook( __FILE__, 'gtp_notices_unschedule' );
