<?php
/**
 * The data pack (data/): what the guidance says, read by a person's hand.
 *
 * Nothing here is a pharmacy's. The pack is built from NaTHNaC's
 * TravelHealthPro country pages into facts and our own sentences
 * (workspace/travel-planner/build_pack.py), dated, and shipped with the
 * plugin; the browser fetches a country's file when it is chosen.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** A file of the pack, decoded, or an empty array. */
function gtp_data( $name ) {
	static $cache = array();
	if ( isset( $cache[ $name ] ) ) { return $cache[ $name ]; }
	$file = GTP_DIR . '/data/' . $name . '.json';
	$data = is_readable( $file ) ? json_decode( (string) file_get_contents( $file ), true ) : null;
	return $cache[ $name ] = is_array( $data ) ? $data : array();
}

/** When the pack was built and read, its source and its licence line. */
function gtp_pack() {
	return gtp_data( 'pack' );
}

/** Every country TravelHealthPro has a page for: name, slug, whether it has a card. */
function gtp_countries() {
	$d = gtp_data( 'countries' );
	return is_array( $d['countries'] ?? null ) ? $d['countries'] : array();
}

/** The vaccines the cards name: id => name, doses, timing, lead, included_in. */
function gtp_catalogue() {
	return gtp_data( 'vaccines' );
}

/** How many days old the pack's reading is, or null when it carries no date. */
function gtp_pack_age_days() {
	$read = (string) ( gtp_pack()['read']['oldest'] ?? '' );
	$then = $read ? strtotime( $read . ' 00:00:00 UTC' ) : false;
	return $then ? (int) floor( ( time() - $then ) / DAY_IN_SECONDS ) : null;
}

/**
 * A latitude and longitude as a point in the map's frame.
 *
 * The map is Natural Earth's land in the Robinson projection, fitted to a
 * frame 1000 wide; data/map.json carries how it was fitted (`fit`), so a
 * pharmacy's own point is worked out from its address and no map is drawn
 * per site. The table is Robinson's own, at every five degrees.
 */
function gtp_project( $lat, $lng ) {
	$map = gtp_data( 'map' );
	$fit = $map['fit'] ?? null;
	if ( ! is_array( $fit ) || ! is_numeric( $lat ) || ! is_numeric( $lng ) ) { return null; }
	$rx = array( 1.0000, 0.9986, 0.9954, 0.9900, 0.9822, 0.9730, 0.9600, 0.9427, 0.9216, 0.8962, 0.8679, 0.8350, 0.7986, 0.7597, 0.7186, 0.6732, 0.6213, 0.5722, 0.5322 );
	$ry = array( 0.0000, 0.0620, 0.1240, 0.1860, 0.2480, 0.3100, 0.3720, 0.4340, 0.4958, 0.5571, 0.6176, 0.6769, 0.7346, 0.7903, 0.8435, 0.8936, 0.9394, 0.9761, 1.0000 );
	$lat = (float) $lat;
	$lng = (float) $lng;
	$a   = min( abs( $lat ), 89.999 ) / 5.0;
	$i   = min( (int) floor( $a ), 17 );
	$t   = $a - $i;
	$x   = ( $rx[ $i ] + ( $rx[ $i + 1 ] - $rx[ $i ] ) * $t ) * 0.8487 * deg2rad( $lng );
	$y   = ( $ry[ $i ] + ( $ry[ $i + 1 ] - $ry[ $i ] ) * $t ) * 1.3523;
	if ( $lat < 0 ) { $y = -$y; }
	return array(
		'x' => round( $fit['pad'] + ( $x - $fit['x0'] ) * $fit['scale'], 1 ),
		'y' => round( $fit['pad'] + ( $fit['y1'] - $y ) * $fit['scale'], 1 ),
	);
}

/**
 * The vaccines as this pharmacy gives them: the pack's facts with the
 * settings' supply and price laid over. This is the one place a price meets
 * a vaccine, and the browser draws exactly what it is handed.
 *
 *   status  given | not | ask     (a vaccine nobody has set is "ask")
 *   price   a dose's, or null     (given with no price reads "Ask us")
 */
function gtp_vaccines() {
	$set = (array) gtp_setting( 'vaccines', array() );
	$out = array();
	foreach ( gtp_catalogue() as $id => $v ) {
		$mine = is_array( $set[ $id ] ?? null ) ? $set[ $id ] : array();
		$out[ $id ] = array(
			'name'        => (string) ( $v['name'] ?? $id ),
			'doses'       => max( 1, (int) ( $v['doses'] ?? 1 ) ),
			'timing'      => (string) ( $v['timing'] ?? '' ),
			'lead'        => is_array( $v['lead'] ?? null ) ? $v['lead'] : null,
			'included_in' => (string) ( $v['included_in'] ?? '' ),
			'status'      => (string) ( $mine['status'] ?? 'ask' ),
			'price'       => $mine['price'] ?? null,
			'child_price' => $mine['child_price'] ?? null,
			'note'        => (string) ( $mine['note'] ?? '' ),
		);
	}
	/* Yellow fever is given only by a registered centre: a pharmacy that is
	   not one never shows a price for it, whatever its table says. */
	if ( isset( $out['yellow-fever'] ) && ! gtp_setting( 'yf_centre' ) && 'given' === $out['yellow-fever']['status'] ) {
		$out['yellow-fever']['status']      = 'ask';
		$out['yellow-fever']['price']       = null;
		$out['yellow-fever']['child_price'] = null;
	}
	return $out;
}

/** The diseases this pharmacy vaccinates against, as NaTHNaC's notices name them (lower case). */
function gtp_our_diseases() {
	$by = array(
		'hepatitis-a'             => array( 'hepatitis a' ),
		'hepatitis-b'             => array( 'hepatitis b' ),
		'typhoid'                 => array( 'typhoid' ),
		'tetanus-dtp'             => array( 'tetanus', 'diphtheria', 'polio', 'cvdpv', 'wpv' ),
		'polio'                   => array( 'polio', 'cvdpv', 'wpv' ),
		'cholera'                 => array( 'cholera' ),
		'dengue'                  => array( 'dengue' ),
		'chikungunya'             => array( 'chikungunya' ),
		'japanese-encephalitis'   => array( 'japanese encephalitis' ),
		'rabies'                  => array( 'rabies' ),
		'yellow-fever'            => array( 'yellow fever' ),
		'measles-mmr'             => array( 'measles', 'mumps', 'rubella' ),
		'menacwy'                 => array( 'meningococcal', 'meningitis' ),
		'tick-borne-encephalitis' => array( 'tick-borne encephalitis', 'tick borne encephalitis' ),
		'tuberculosis-bcg'        => array( 'tuberculosis' ),
	);
	$out = array();
	foreach ( gtp_vaccines() as $id => $v ) {
		if ( 'given' === $v['status'] && isset( $by[ $id ] ) ) { $out = array_merge( $out, $by[ $id ] ); }
	}
	return array_values( array_unique( $out ) );
}

/** Whether a notice's disease is one this pharmacy vaccinates against. */
function gtp_is_ours( $disease ) {
	$d = strtolower( (string) $disease );
	foreach ( gtp_our_diseases() as $needle ) {
		if ( false !== strpos( $d, $needle ) ) { return true; }
	}
	return false;
}
