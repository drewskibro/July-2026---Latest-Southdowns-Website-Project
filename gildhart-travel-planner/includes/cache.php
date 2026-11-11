<?php
/**
 * The host's page cache: cleared when what the planner shows has changed.
 *
 * The planner's prices, its wording and the day's outbreak notices are in
 * the page's own HTML, and a host that caches pages (Kinsta keeps one a day)
 * would go on serving yesterday's. So the cache is cleared when they change,
 * and only then:
 *
 *   - the settings are saved, imported or set back to the site's file (WordPress
 *     says nothing when a save changes nothing, and neither does this);
 *   - what the notices put on the page is not what it was: a reading, a notice
 *     added or taken off by hand, or one ageing out or going stale, which the
 *     daily run notices even while the reader is paused;
 *   - a new version of the plugin, with a new pack, is first run.
 *
 * Clearing is one action, gtp_purge_pages, that any host or caching plugin can
 * answer. Kinsta is answered here, through its must-use plugin's own call:
 * global $kinsta_cache, whose kinsta_cache_purge is a Kinsta\Cache_Purge, and
 * purge_complete_caches( $force ), which clears the object cache, the page
 * cache (https://localhost/kinsta-clear-cache-all) and the CDN. $force is
 * true because this is a change a person or the reader made: without it the
 * call does nothing while the host's own "clear the cache on every edit"
 * switch is off (read in kinsta-mu-plugins 3.7.0, cache/class-cache-purge.php
 * and bootstrap.php). On any other host the action fires and nothing else
 * happens.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const GTP_SHOWN_OPTION   = 'gtp_notices_shown';    // a fingerprint of the notices last put on the page
const GTP_VERSION_OPTION = 'gtp_version_seen';     // the plugin version last run

/** Clear the host's page cache, once a request however many things changed. */
function gtp_purge_pages( $why = '' ) {
	static $done = false;
	if ( $done ) { return; }
	$done = true;
	do_action( 'gtp_purge_pages', (string) $why );
	global $kinsta_cache;
	if ( is_object( $kinsta_cache ) && isset( $kinsta_cache->kinsta_cache_purge ) && is_object( $kinsta_cache->kinsta_cache_purge )
		&& method_exists( $kinsta_cache->kinsta_cache_purge, 'purge_complete_caches' ) ) {
		$kinsta_cache->kinsta_cache_purge->purge_complete_caches( true );
	}
}

/* The settings: saved for the first time, saved again with a change, or set back to the file. */
add_action( 'add_option_' . GTP_OPTION, function () { gtp_purge_pages( 'settings' ); } );
add_action( 'update_option_' . GTP_OPTION, function () { gtp_purge_pages( 'settings' ); } );
add_action( 'delete_option_' . GTP_OPTION, function () { gtp_purge_pages( 'settings' ); } );

/** What the notices put on a page, as one short string: the planner's rows and [travel_notices]' alike. */
function gtp_notices_fingerprint() {
	$rows = array();
	foreach ( gtp_notices_current() as $n ) {
		$rows[] = array( $n['date'], $n['disease'], $n['country'], $n['slug'], $n['regions'] ?? array(), $n['group'] ?? '' );
	}
	return md5( (string) wp_json_encode( $rows ) );
}

/** Clear the cache when the notices on show are not the ones last shown. Returns whether it did. */
function gtp_notices_check_shown() {
	$now  = gtp_notices_fingerprint();
	$then = (string) get_option( GTP_SHOWN_OPTION, md5( '[]' ) );
	if ( $now === $then ) { return false; }
	update_option( GTP_SHOWN_OPTION, $now, false );
	gtp_purge_pages( 'notices' );
	return true;
}
/* Every save of the notices (a reading, a person's hand), and the daily run, which also sees time pass. */
add_action( 'gtp_notices_saved', 'gtp_notices_check_shown' );
add_action( GTP_NOTICES_HOOK, 'gtp_notices_check_shown', 20 );

/* A new version: its pack may say something new, so the pages that show it are made again. */
add_action( 'init', function () {
	if ( (string) get_option( GTP_VERSION_OPTION, '' ) === GTP_VERSION ) { return; }
	update_option( GTP_VERSION_OPTION, GTP_VERSION, false );
	gtp_purge_pages( 'version' );
} );
