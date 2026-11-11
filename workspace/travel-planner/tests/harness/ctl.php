<?php
/* The checks' hand on the harness: start a world, be someone, set what the outside world says, run the daily reading. */
if ( isset( $_GET['world'] ) ) { setcookie( 'gtp_w', $_GET['world'], 0, '/' ); $_COOKIE['gtp_w'] = $_GET['world']; }
if ( isset( $_GET['be'] ) ) { setcookie( 'gtp_as', $_GET['be'], 0, '/' ); $_COOKIE['gtp_as'] = $_GET['be']; }
require __DIR__ . '/wp.php';
if ( isset( $_GET['fresh'] ) ) { h_put( array() ); }
foreach ( (array) ( $_GET['set'] ?? array() ) as $k => $v ) { h_set( $k, json_decode( $v, true ) ?? $v ); }
$out = array( 'world' => h_world(), 'as' => h_as() );
if ( isset( $_GET['option'] ) ) { update_option( $_GET['option'], json_decode( (string) $_GET['value'], true ) ); }
if ( isset( $_GET['do'] ) && 'read' === $_GET['do'] ) { $out['read'] = gtp_notices_read(); }
if ( isset( $_GET['do'] ) && 'cron' === $_GET['do'] ) { do_action( 'init' ); $out['cron'] = wp_next_scheduled( GTP_NOTICES_HOOK ); }
/* The daily run itself, as WordPress's cron fires it: the reading, then whatever else hangs on it. */
if ( isset( $_GET['do'] ) && 'daily' === $_GET['do'] ) { do_action( GTP_NOTICES_HOOK ); }
if ( isset( $_GET['do'] ) && 'init' === $_GET['do'] ) { do_action( 'init' ); }
$out['state']    = gtp_notices_state();
$out['current']  = gtp_notices_current();
$out['settings'] = gtp_settings( true );
$out['mail']     = h_get( '__mail', array() );
$out['purged']   = h_get( '__purged', array() );
$out['kinsta']   = h_get( '__kinsta', null );
$out['asked']    = h_get( '__asked', array() );
$out['project']  = array( 'ewell' => gtp_project( 51.349933, -0.2606402 ), 'home' => gtp_project( gtp_setting( 'lat' ), gtp_setting( 'lng' ) ) );
$out['ours']     = gtp_our_diseases();
$out['vaccines'] = gtp_vaccines();
header( 'Content-Type: application/json' );
echo json_encode( $out, JSON_UNESCAPED_UNICODE );
