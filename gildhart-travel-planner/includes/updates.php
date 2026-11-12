<?php
/**
 * Updates: the plugin updates itself, like any plugin from wordpress.org.
 *
 * WordPress (5.8 and later) reads a plugin's `Update URI` header and asks the
 * filter update_plugins_<that address's host> whether there is a newer
 * version and where its zip is. Ours answers from one small file in
 * Gildhart's public updates repository (GTP_UPDATE_INFO). WordPress then
 * shows "Update available" in Plugins like any other plugin, and, while
 * automatic updates are on (the default, so each month's guidance reaches
 * every site with nobody touching it), installs it by itself. Travel Planner >
 * Settings turns automatic updates off; WordPress's own Update button still
 * works either way.
 *
 * The file is read at most every six hours, and only when WordPress checks
 * for updates (twice a day, or from Dashboard > Updates). An update whose zip
 * is anywhere but that repository is refused; a file that cannot be read, or
 * does not make sense, offers nothing and says nothing. The plugin's own
 * pages never wait on it.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const GTP_SLUG        = 'gildhart-travel-planner';
const GTP_UPDATE_INFO = 'https://raw.githubusercontent.com/Gildhart-pharmodigital/travel-planner-updates/main/travel-planner/info.json';
const GTP_UPDATE_ZIPS = 'https://raw.githubusercontent.com/Gildhart-pharmodigital/travel-planner-updates/main/travel-planner/';
const GTP_UPDATE_HOST = 'raw.githubusercontent.com';
const GTP_UPDATE_KEY  = 'gtp_update_info';

/** Whether this site takes updates from Gildhart at all (a site that deploys the plugin some other way can say no). */
function gtp_updates_enabled() {
	return (bool) apply_filters( 'gtp_updates_enabled', true );
}

/** This plugin's file as WordPress names it: gildhart-travel-planner/gildhart-travel-planner.php. */
function gtp_plugin_file() {
	return function_exists( 'plugin_basename' ) ? plugin_basename( GTP_FILE ) : basename( GTP_DIR ) . '/' . basename( GTP_FILE );
}

/**
 * The latest release, as the updates repository describes it: version,
 * package (its zip), requires, requires_php, released, changelog. An empty
 * array when the file cannot be read or does not make sense.
 */
function gtp_update_info( $fresh = false ) {
	$cached = get_transient( GTP_UPDATE_KEY );
	if ( ! $fresh && is_array( $cached ) ) { return $cached; }
	$r    = wp_remote_get( GTP_UPDATE_INFO, array(
		'timeout'    => 10,
		'user-agent' => 'Travel Planner by Gildhart/' . GTP_VERSION . ' (update check)',
	) );
	$info = array();
	if ( ! is_wp_error( $r ) && 200 === (int) wp_remote_retrieve_response_code( $r ) ) {
		$info = gtp_clean_update_info( json_decode( (string) wp_remote_retrieve_body( $r ), true ) );
	}
	/* A good answer is kept six hours; a failed one is asked again within the hour. */
	set_transient( GTP_UPDATE_KEY, $info, $info ? 6 * HOUR_IN_SECONDS : HOUR_IN_SECONDS );
	return $info;
}

/** The updates file, made safe: a version, and a zip in our own repository for exactly that version, or nothing. */
function gtp_clean_update_info( $d ) {
	if ( ! is_array( $d ) ) { return array(); }
	$version = (string) ( $d['version'] ?? '' );
	$package = (string) ( $d['package'] ?? '' );
	if ( ! preg_match( '/^\d+\.\d+\.\d+$/', $version ) ) { return array(); }
	if ( $package !== GTP_UPDATE_ZIPS . GTP_SLUG . '-' . $version . '.zip' ) { return array(); }
	$ver = function ( $v, $fallback ) { return preg_match( '/^\d+(\.\d+){0,2}$/', (string) $v ) ? (string) $v : $fallback; };
	return array(
		'version'      => $version,
		'package'      => $package,
		'requires'     => $ver( $d['requires'] ?? '', '6.0' ),
		'requires_php' => $ver( $d['requires_php'] ?? '', '7.4' ),
		'released'     => preg_match( '/^\d{4}-\d{2}-\d{2}$/', (string) ( $d['released'] ?? '' ) ) ? (string) $d['released'] : '',
		'changelog'    => function_exists( 'wp_kses_post' ) ? wp_kses_post( (string) ( $d['changelog'] ?? '' ) ) : strip_tags( (string) ( $d['changelog'] ?? '' ), '<ul><li><p><strong><em><code><h4>' ),
		'url'          => 'https://github.com/Gildhart-pharmodigital/travel-planner-updates',
	);
}

/** A newer version WordPress already knows of (from its own last check), or ''. Asks nobody. */
function gtp_update_known() {
	$t = function_exists( 'get_site_transient' ) ? get_site_transient( 'update_plugins' ) : null;
	$u = is_object( $t ) && isset( $t->response[ gtp_plugin_file() ] ) ? (object) $t->response[ gtp_plugin_file() ] : null;
	$v = $u ? (string) ( $u->new_version ?? '' ) : '';
	return '' !== $v && version_compare( $v, GTP_VERSION, '>' ) ? $v : '';
}

/** Whether WordPress on this site may install updates by itself at all (a host can turn that off). */
function gtp_wp_installs_updates() {
	if ( defined( 'AUTOMATIC_UPDATER_DISABLED' ) && AUTOMATIC_UPDATER_DISABLED ) { return false; }
	if ( function_exists( 'wp_is_file_mod_allowed' ) && ! wp_is_file_mod_allowed( 'automatic_updater' ) ) { return false; }
	return ! apply_filters( 'automatic_updater_disabled', false );
}

/** WordPress asks: is there an update for this plugin, and where? */
add_filter( 'update_plugins_' . GTP_UPDATE_HOST, function ( $update, $plugin_data, $plugin_file ) {
	if ( gtp_plugin_file() !== $plugin_file || ! gtp_updates_enabled() ) { return $update; }
	/* "Check again" in Dashboard > Updates asks the file itself, not the copy kept for six hours. */
	$info = gtp_update_info( ! empty( $_GET['force-check'] ) && current_user_can( 'update_plugins' ) ); // phpcs:ignore WordPress.Security.NonceVerification -- a read, as WordPress's own check is
	if ( ! $info ) { return $update; }
	/* The same version or older is still answered: WordPress then files it as
	   "up to date", which is what shows the automatic-updates switch in Plugins. */
	return array(
		'slug'         => GTP_SLUG,
		'version'      => $info['version'],
		'url'          => $info['url'],
		'package'      => $info['package'],
		'requires'     => $info['requires'],
		'requires_php' => $info['requires_php'],
	);
}, 10, 3 );

/** "View details" in Plugins: the release notes, from the same file. */
add_filter( 'plugins_api', function ( $res, $action, $args ) {
	if ( 'plugin_information' !== $action || ! is_object( $args ) || GTP_SLUG !== ( $args->slug ?? '' ) || ! gtp_updates_enabled() ) { return $res; }
	$info = gtp_update_info();
	return (object) array(
		'name'          => 'Travel Planner by Gildhart',
		'slug'          => GTP_SLUG,
		'version'       => $info['version'] ?? GTP_VERSION,
		'author'        => '<a href="https://gildhart.com">Gildhart</a>',
		'homepage'      => 'https://gildhart.com',
		'requires'      => $info['requires'] ?? '6.0',
		'requires_php'  => $info['requires_php'] ?? '7.4',
		'last_updated'  => $info['released'] ?? '',
		'download_link' => $info['package'] ?? '',
		'sections'      => array(
			'description' => '<p>"Where are you going?" for a pharmacy\'s travel clinic: any country, the vaccines the UK guidance lists for it, what each costs a dose here, how far ahead to book, and the day\'s outbreak notices. Every answer ends at a booking.</p>',
			'changelog'   => ( $info['changelog'] ?? '' ) ? $info['changelog'] : '<p>No release notes could be read just now.</p>',
		),
	);
}, 10, 3 );

/** Automatic updates on by default, so the monthly guidance arrives by itself; the settings can turn them off. */
add_filter( 'auto_update_plugin', function ( $update, $item ) {
	if ( is_object( $item ) && isset( $item->plugin ) && gtp_plugin_file() === $item->plugin && gtp_updates_enabled() ) {
		return (bool) gtp_setting( 'auto_update', true );
	}
	return $update;
}, 10, 2 );
