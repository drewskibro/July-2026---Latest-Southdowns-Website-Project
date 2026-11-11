<?php
/**
 * Just enough WordPress to run the Travel Planner plugin without WordPress.
 *
 * Options, mail and "now" live in one JSON file per world (cookie gtp_w), so
 * a check starts clean and two checks never share state. The visitor is who
 * the cookie gtp_as says: visitor, editor or admin. TravelHealthPro is never
 * asked: the reader's fetch is answered from fixtures/ (the store's __feed).
 */
define( 'ABSPATH', __DIR__ . '/' );
define( 'DAY_IN_SECONDS', 86400 );
define( 'HOUR_IN_SECONDS', 3600 );
define( 'MINUTE_IN_SECONDS', 60 );
define( 'GTP_HARNESS', true );
date_default_timezone_set( 'UTC' );

$GLOBALS['gtp_h'] = array( 'hooks' => array(), 'shortcodes' => array(), 'styles' => array(), 'scripts' => array() );

function h_world() { return preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) ( $_COOKIE['gtp_w'] ?? $_GET['w'] ?? 'default' ) ) ) ?: 'default'; }
function h_file() { return sys_get_temp_dir() . '/gtp-harness-' . h_world() . '.json'; }
function h_store() { $f = h_file(); $d = is_file( $f ) ? json_decode( (string) file_get_contents( $f ), true ) : array(); return is_array( $d ) ? $d : array(); }
function h_put( $d ) { file_put_contents( h_file(), json_encode( $d, JSON_UNESCAPED_UNICODE ) ); }
function h_get( $k, $default = null ) { $d = h_store(); return array_key_exists( $k, $d ) ? $d[ $k ] : $default; }
function h_set( $k, $v ) { $d = h_store(); $d[ $k ] = $v; h_put( $d ); }
function h_as() { return (string) ( $_COOKIE['gtp_as'] ?? $_GET['as'] ?? 'visitor' ); }

/* hooks */
function add_filter( $tag, $fn, $prio = 10, $n = 1 ) { $GLOBALS['gtp_h']['hooks'][ $tag ][ $prio ][] = $fn; return true; }
function add_action( $tag, $fn, $prio = 10, $n = 1 ) { return add_filter( $tag, $fn, $prio, $n ); }
function apply_filters( $tag, $value, ...$args ) {
	$h = $GLOBALS['gtp_h']['hooks'][ $tag ] ?? array(); ksort( $h );
	foreach ( $h as $fns ) { foreach ( $fns as $fn ) { $value = call_user_func_array( $fn, array_merge( array( $value ), $args ) ); } }
	return $value;
}
function do_action( $tag, ...$args ) {
	$h = $GLOBALS['gtp_h']['hooks'][ $tag ] ?? array(); ksort( $h );
	foreach ( $h as $fns ) { foreach ( $fns as $fn ) { call_user_func_array( $fn, $args ); } }
}
function register_activation_hook( $f, $fn ) {}
function register_deactivation_hook( $f, $fn ) {}

/* options */
function get_option( $k, $default = false ) { $o = h_get( 'options', array() ); return array_key_exists( $k, $o ) ? $o[ $k ] : ( 'admin_email' === $k ? 'owner@example.test' : $default ); }
function update_option( $k, $v, $autoload = null ) { $o = h_get( 'options', array() ); $o[ $k ] = $v; h_set( 'options', $o ); return true; }
function delete_option( $k ) { $o = h_get( 'options', array() ); unset( $o[ $k ] ); h_set( 'options', $o ); return true; }

/* shortcodes */
function add_shortcode( $tag, $fn ) { $GLOBALS['gtp_h']['shortcodes'][ $tag ] = $fn; }
function shortcode_exists( $tag ) { return isset( $GLOBALS['gtp_h']['shortcodes'][ $tag ] ); }
function shortcode_atts( $pairs, $atts, $tag = '' ) { $out = $pairs; foreach ( (array) $atts as $k => $v ) { if ( array_key_exists( $k, $pairs ) ) { $out[ $k ] = $v; } } return $out; }
function do_shortcode( $text ) {
	return preg_replace_callback( '/\[([a-z_]+)([^\]]*)\]/', function ( $m ) {
		if ( ! shortcode_exists( $m[1] ) ) { return $m[0]; }
		$atts = array();
		if ( preg_match_all( '/([a-z_]+)="([^"]*)"/', $m[2], $am, PREG_SET_ORDER ) ) { foreach ( $am as $a ) { $atts[ $a[1] ] = $a[2]; } }
		return (string) call_user_func( $GLOBALS['gtp_h']['shortcodes'][ $m[1] ], $atts );
	}, $text );
}

/* escaping and text */
function esc_html( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function esc_textarea( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $s ) { $s = (string) $s; return preg_match( '~^(https?://|/|#|tel:|mailto:)~', $s ) ? htmlspecialchars( $s, ENT_QUOTES, 'UTF-8' ) : ''; }
function wp_strip_all_tags( $s ) { return trim( strip_tags( preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', (string) $s ) ) ); }
function sanitize_text_field( $s ) { return trim( preg_replace( '/\s+/', ' ', strip_tags( (string) $s ) ) ); }
function wp_unslash( $v ) { return $v; }
function wp_json_encode( $v, $flags = 0 ) { return json_encode( $v, $flags ); }
function is_email( $e ) { return (bool) filter_var( $e, FILTER_VALIDATE_EMAIL ); }
function wp_parse_url( $u, $c = -1 ) { return parse_url( $u, $c ); }
function wp_date( $fmt, $ts = null ) { return gmdate( $fmt, null === $ts ? time() : $ts ); }

/* the site */
function get_bloginfo( $k = 'name' ) { return 'Harness Pharmacy'; }
function home_url( $p = '' ) { return 'http://' . ( $_SERVER['HTTP_HOST'] ?? '127.0.0.1' ) . $p; }
function admin_url( $p = '' ) { return '/' . ltrim( $p, '/' ); }
function plugins_url( $path, $file ) { return '/plugin/' . ltrim( $path, '/' ); }
function get_stylesheet_directory() { return h_get( '__no_site_file' ) ? '/nonexistent' : dirname( __DIR__, 4 ) . '/southdowns-pharmacy-theme'; }
function current_user_can( $cap ) { $as = h_as(); return 'admin' === $as || ( 'editor' === $as && 'edit_posts' === $cap ); }
function url_to_postid( $url ) { $p = parse_url( $url, PHP_URL_PATH ); $pub = h_get( '__published', array( '/thailand-travel-vaccinations/', '/india-travel-vaccinations/', '/kenya-travel-vaccinations/', '/cape-verde-travel-vaccinations/' ) ); return in_array( $p, $pub, true ) ? 100 + array_search( $p, $pub, true ) : 0; }
function get_post_status( $id ) { return $id ? 'publish' : false; }

/* assets */
function wp_enqueue_style( $h, $src = '', $deps = array(), $ver = false ) { $GLOBALS['gtp_h']['styles'][ $h ] = $src . '?ver=' . $ver; }
function wp_enqueue_script( $h, $src = '', $deps = array(), $ver = false, $foot = false ) { $GLOBALS['gtp_h']['scripts'][ $h ] = $src . '?ver=' . $ver; }
function h_styles() { foreach ( $GLOBALS['gtp_h']['styles'] as $h => $s ) { echo '<link rel="stylesheet" id="' . esc_attr( $h ) . '-css" href="' . esc_attr( $s ) . '">' . "\n"; } }
function h_scripts() { foreach ( $GLOBALS['gtp_h']['scripts'] as $h => $s ) { echo '<script id="' . esc_attr( $h ) . '-js" src="' . esc_attr( $s ) . '"></script>' . "\n"; } }

/* http, mail, cron */
function is_wp_error( $r ) { return false; }
function wp_remote_get( $url, $args = array() ) { return array( 'code' => 599, 'body' => '' ); }
function wp_remote_retrieve_response_code( $r ) { return $r['code'] ?? 0; }
function wp_remote_retrieve_body( $r ) { return $r['body'] ?? ''; }
function wp_mail( $to, $subject, $body ) { $m = h_get( '__mail', array() ); $m[] = array( 'to' => $to, 'subject' => $subject, 'body' => $body ); h_set( '__mail', $m ); return true; }
function wp_next_scheduled( $hook ) { return h_get( '__cron_' . $hook, false ); }
function wp_schedule_event( $ts, $rec, $hook ) { h_set( '__cron_' . $hook, array( $ts, $rec ) ); return true; }
function wp_clear_scheduled_hook( $hook ) { h_set( '__cron_' . $hook, false ); }

/* admin */
function add_menu_page( ...$a ) {}
function add_submenu_page( ...$a ) {}
function wp_die( $m = '', $t = '', $args = array() ) { http_response_code( (int) ( $args['response'] ?? 500 ) ); echo esc_html( $m ); exit; }
function check_admin_referer( $action ) { if ( ( $_POST['_wpnonce'] ?? '' ) !== 'nonce-' . $action ) { wp_die( 'The link you followed has expired.', '', array( 'response' => 403 ) ); } return 1; }
function wp_nonce_field( $action ) { echo '<input type="hidden" name="_wpnonce" value="nonce-' . esc_attr( $action ) . '">'; }
function add_query_arg( $args, $url ) { $q = http_build_query( $args ); return $q ? $url . ( false === strpos( $url, '?' ) ? '?' : '&' ) . $q : $url; }
function wp_safe_redirect( $url ) { header( 'Location: ' . $url, true, 302 ); }
function checked( $a, $b = true ) { if ( (string) $a === (string) $b || ( true === $b && $a ) ) { echo ' checked'; } }
function selected( $a, $b = true ) { if ( (string) $a === (string) $b ) { echo ' selected'; } }
function submit_button( $text = 'Save', $type = 'primary', $name = 'submit', $wrap = true ) { echo ( $wrap ? '<p class="submit">' : '' ) . '<button type="submit" class="button button-' . esc_attr( $type ) . '">' . esc_html( $text ) . '</button>' . ( $wrap ? '</p>' : '' ); }

/* The plugin, then the harness's stand-ins for the world outside it. */
require dirname( __DIR__, 4 ) . '/gildhart-travel-planner/gildhart-travel-planner.php';

add_filter( 'gtp_notices_now', function ( $now ) { $n = h_get( '__now' ); return $n ? (int) strtotime( $n . ' UTC' ) : $now; } );
add_filter( 'gtp_notices_fetcher', function () {
	return function ( $url ) {
		$asked = h_get( '__asked', array() ); $asked[] = $url; h_set( '__asked', $asked );
		$feed = (string) h_get( '__feed', 'ok' );
		if ( 'down' === $feed ) { return ''; }
		if ( 'changed' === $feed ) { return '<html><body><h1>NaTHNaC</h1><p>This page has moved.</p></body></html>'; }
		$f = dirname( __DIR__ ) . '/fixtures/outbreaks' . ( 'ok' === $feed ? '' : '-' . preg_replace( '/[^a-z0-9]/', '', $feed ) ) . '.html';
		return is_file( $f ) ? (string) file_get_contents( $f ) : '';
	};
} );
