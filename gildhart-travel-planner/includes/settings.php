<?php
/**
 * What this pharmacy gives, charges and is: the settings.
 *
 * One option (gtp_settings). Until someone saves the settings screen, the
 * values are the plugin's own defaults overlaid with the site's file, if its
 * theme carries one (gildhart-travel-planner.json beside style.css): a site
 * built in git keeps its prices in git, and a site with no such file is set
 * up on the screen. Once saved in wp-admin, the saved settings are the
 * settings, and "Use the site's file again" forgets them.
 *
 * A vaccine is one of three things here, never two: given (with a price a
 * dose, or "Ask us" until there is one), not given, or ask us. A vaccine
 * nobody has said anything about is "Ask us": "Not given here" would be a
 * claim, and so would a price.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const GTP_OPTION = 'gtp_settings';

/** The plugin's own defaults: a planner that works, and promises nothing. */
function gtp_base_defaults() {
	return array(
		'enabled'           => false,          // false: only signed-in editors see the planner (preview)
		'pharmacy'          => function_exists( 'get_bloginfo' ) ? (string) get_bloginfo( 'name' ) : '',
		'booking_url'       => '',             // where every card's button goes: an anchor on the page or an address
		'phone'             => '',
		'lat'               => '',             // the pharmacy's point on the map; no point without both
		'lng'               => '',
		'consultation_line' => '',             // e.g. "The travel consultation is £20."
		'yf_centre'         => false,          // a registered yellow fever vaccination centre
		'yf_line'           => '',             // e.g. "Bosmere Pharmacy, Havant, is our registered yellow fever centre."
		'color_dark'        => '#12343b',
		'color_dark2'       => '#1d4d57',
		'color_accent'      => '#d9622b',
		'color_pin'         => '#f6b443',
		'color_tint'        => '#eef4f3',
		'alert_email'       => '',             // empty: the site's admin address
		'alerts'            => 'ours',         // ours: diseases we vaccinate against; all; none
		'reader_paused'     => false,
		'vaccines'          => array(),        // id => status, price, child_price, note
		'guides'            => array(),        // country slug => this site's page about it
	);
}

/** The site's own file, in its theme: decoded, or an empty array. */
function gtp_site_file() {
	$path = function_exists( 'get_stylesheet_directory' ) ? get_stylesheet_directory() . '/gildhart-travel-planner.json' : '';
	$path = (string) apply_filters( 'gtp_site_file', $path );
	if ( '' === $path || ! is_readable( $path ) ) { return array(); }
	$data = json_decode( (string) file_get_contents( $path ), true );
	return is_array( $data ) ? $data : array();
}

/** The defaults a site starts from: the plugin's, then its file's. */
function gtp_defaults() {
	$d = array_merge( gtp_base_defaults(), gtp_sanitize_settings( gtp_site_file(), gtp_base_defaults() ) );
	return (array) apply_filters( 'gtp_defaults', $d );
}

/** The settings in force. */
function gtp_settings( $fresh = false ) {
	static $cache = null;
	if ( null !== $cache && ! $fresh ) { return $cache; }
	$saved = get_option( GTP_OPTION, null );
	$cache = is_array( $saved ) ? array_merge( gtp_defaults(), gtp_sanitize_settings( $saved, gtp_defaults() ) ) : gtp_defaults();
	return $cache;
}

function gtp_setting( $key, $fallback = '' ) {
	$s = gtp_settings();
	return array_key_exists( $key, $s ) ? $s[ $key ] : $fallback;
}

/** Whether the settings in force were saved on the screen (true) or come from the file and defaults. */
function gtp_settings_saved() {
	return is_array( get_option( GTP_OPTION, null ) );
}

/** A colour as #rrggbb, or the fallback. */
function gtp_clean_color( $v, $fallback ) {
	$v = strtolower( trim( (string) $v ) );
	if ( preg_match( '/^#[0-9a-f]{3}$/', $v ) ) { $v = '#' . $v[1] . $v[1] . $v[2] . $v[2] . $v[3] . $v[3]; }
	return preg_match( '/^#[0-9a-f]{6}$/', $v ) ? $v : $fallback;
}

/** A price as a number, or null: "56", "98.50", "£35". Never negative, never a guess. */
function gtp_clean_price( $v ) {
	if ( null === $v || is_bool( $v ) ) { return null; }
	$v = trim( str_replace( array( '£', ',' ), '', (string) $v ) );
	if ( '' === $v || ! is_numeric( $v ) || (float) $v < 0 ) { return null; }
	return round( (float) $v, 2 );
}

/**
 * Anything handed in (the screen's form, the site's file, an import), made
 * into settings: every key known, every value its own type. Keys it does not
 * carry come from $base, so a file that sets three things leaves the rest.
 */
function gtp_sanitize_settings( $in, $base = null ) {
	$base = is_array( $base ) ? $base : gtp_base_defaults();
	$in   = is_array( $in ) ? $in : array();
	$out  = $base;
	$text = function ( $v ) { return trim( wp_strip_all_tags( (string) $v ) ); };

	foreach ( array( 'enabled', 'yf_centre', 'reader_paused' ) as $k ) {
		if ( array_key_exists( $k, $in ) ) { $out[ $k ] = ! empty( $in[ $k ] ) && 'false' !== $in[ $k ] && '0' !== $in[ $k ]; }
	}
	foreach ( array( 'pharmacy', 'phone', 'consultation_line', 'yf_line' ) as $k ) {
		if ( array_key_exists( $k, $in ) ) { $out[ $k ] = $text( $in[ $k ] ); }
	}
	if ( array_key_exists( 'booking_url', $in ) ) {
		$u = trim( (string) $in['booking_url'] );
		/* An anchor on the page, a path on the site, or an https address: nothing else. */
		$out['booking_url'] = preg_match( '~^(#[A-Za-z0-9_-]+|/(?!/)\S*|https://\S+)$~', $u ) ? $u : '';
	}
	foreach ( array( 'lat' => 90, 'lng' => 180 ) as $k => $max ) {
		if ( array_key_exists( $k, $in ) ) {
			$v         = trim( (string) $in[ $k ] );
			$out[ $k ] = ( is_numeric( $v ) && abs( (float) $v ) <= $max ) ? (string) (float) $v : '';
		}
	}
	foreach ( array( 'color_dark', 'color_dark2', 'color_accent', 'color_pin', 'color_tint' ) as $k ) {
		if ( array_key_exists( $k, $in ) ) { $out[ $k ] = gtp_clean_color( $in[ $k ], $base[ $k ] ); }
	}
	if ( array_key_exists( 'alert_email', $in ) ) {
		$e                  = trim( (string) $in['alert_email'] );
		$out['alert_email'] = ( '' !== $e && is_email( $e ) ) ? $e : '';
	}
	if ( array_key_exists( 'alerts', $in ) ) {
		$out['alerts'] = in_array( $in['alerts'], array( 'ours', 'all', 'none' ), true ) ? $in['alerts'] : 'ours';
	}

	if ( array_key_exists( 'vaccines', $in ) && is_array( $in['vaccines'] ) ) {
		$vax = array();
		foreach ( $in['vaccines'] as $id => $row ) {
			$id = preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) $id ) );
			if ( '' === $id || ! is_array( $row ) ) { continue; }
			$status = in_array( $row['status'] ?? '', array( 'given', 'not', 'ask' ), true ) ? $row['status'] : 'ask';
			$vax[ $id ] = array(
				'status'      => $status,
				'price'       => 'given' === $status ? gtp_clean_price( $row['price'] ?? null ) : null,
				'child_price' => 'given' === $status ? gtp_clean_price( $row['child_price'] ?? null ) : null,
				'note'        => $text( $row['note'] ?? '' ),
			);
		}
		$out['vaccines'] = $vax;
	}

	if ( array_key_exists( 'guides', $in ) ) {
		$guides = array();
		$rows   = $in['guides'];
		/* The screen sends lines of "thailand = /thailand-travel-vaccinations/"; a file sends a map. */
		if ( is_string( $rows ) ) {
			$map = array();
			foreach ( preg_split( '/\R/', $rows ) as $line ) {
				if ( false === strpos( $line, '=' ) ) { continue; }
				list( $slug, $url ) = array_map( 'trim', explode( '=', $line, 2 ) );
				$map[ $slug ] = $url;
			}
			$rows = $map;
		}
		foreach ( (array) $rows as $slug => $url ) {
			$slug = preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) $slug ) );
			$url  = trim( (string) $url );
			if ( '' !== $slug && preg_match( '~^(/(?!/)\S*|https://\S+)$~', $url ) ) { $guides[ $slug ] = $url; }
		}
		$out['guides'] = $guides;
	}
	return $out;
}

/** "£56", "£98.50": the pence only where there are any. */
function gtp_money( $n ) {
	if ( null === $n || '' === $n ) { return ''; }
	$n = (float) $n;
	return '£' . number_format( $n, floor( $n ) == $n ? 0 : 2 );
}

/**
 * Whether this visitor sees the planner. Switched off, it is a preview: the
 * people who can edit the site see it, with a line saying nobody else can,
 * and the public sees nothing at all.
 */
function gtp_visible() {
	if ( gtp_setting( 'enabled' ) ) { return true; }
	return function_exists( 'current_user_can' ) && current_user_can( 'edit_posts' );
}
