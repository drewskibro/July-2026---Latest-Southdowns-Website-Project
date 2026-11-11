<?php
/**
 * The outbreak notices: NaTHNaC's, read once a day, with a person's hand as
 * the backup.
 *
 * TravelHealthPro publishes an outbreak search for exactly this purpose:
 * "disease outbreaks and other incidents considered to be of relevance to
 * UK travellers". Once a day the site reads it (one request, every disease)
 * and keeps, for each notice, its date, its disease, its country and any
 * region it names, with the address of that country's TravelHealthPro page.
 * It keeps none of the notice's words and none of its figures: those are
 * theirs, a script can misread them, and a reader who wants them is one
 * link from the source.
 *
 * The reader names itself honestly to their server and reads no more than
 * it says. When it cannot read (their page moved, their server said no) it
 * says so once by email, the last good reading stands with its date, and
 * after GTP_NOTICES_STALE days without one the automatic notices are no
 * longer shown: an old list is never passed off as today's. Nothing here
 * tries a second way in.
 *
 * The backup is a person (Travel Planner > Notices): add a notice by hand,
 * hide one, read again now, or pause the reader altogether. A notice added
 * by hand is shown whatever the reader is doing, until it is taken off.
 *
 * A new notice is emailed, never on the first reading: by default only
 * for a disease this pharmacy vaccinates against, because that is the one
 * it can act on.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const GTP_NOTICES_OPTION = 'gtp_notices';
const GTP_NOTICES_HOOK   = 'gtp_read_notices';
const GTP_NOTICES_STALE  = 30;    // days without a good reading before the automatic notices are hidden
const GTP_NOTICES_KEEP   = 120;   // days a notice is kept
const GTP_NOTICES_SHOWN  = 90;    // days a notice counts as current on a country's card
const GTP_NOTICES_FLOOR  = 5;     // fewer notices than this in a reading is their page having changed, not a quiet month

/** Their search: every disease, every country, the last month (the last six on the first reading). */
function gtp_notices_url( $first = false ) {
	$url = 'https://travelhealthpro.org.uk/outbreaks-search.php?period=' . ( $first ? '6' : '1' ) . '&coun=All&dis=All';
	return (string) apply_filters( 'gtp_notices_url', $url, $first );
}

function gtp_notices_now() {
	return (int) apply_filters( 'gtp_notices_now', time() );
}

/** Everything kept: the notices read, the ones added by hand, the ones hidden, and how the reader last fared. */
function gtp_notices_state() {
	$s = get_option( GTP_NOTICES_OPTION, array() );
	$s = is_array( $s ) ? $s : array();
	return array_merge( array(
		'items'   => array(),   // key => date, disease, country, slug, regions, url (and group, when NaTHNaC files one notice under several countries)
		'manual'  => array(),   // id  => the same, added by a person
		'hidden'  => array(),   // keys a person has taken off
		'seen'    => array(),   // keys already emailed or first read
		'read'    => '',        // the last good reading, 'Y-m-d H:i'
		'tried'   => '',        // the last attempt
		'failing' => '',        // since when it has not been readable
	), $s );
}

function gtp_notices_save( $state ) {
	update_option( GTP_NOTICES_OPTION, $state, false );
}

/** Their page, or '' when it could not be had. One polite request, named for what it is. */
function gtp_notices_fetch( $url ) {
	$fetcher = apply_filters( 'gtp_notices_fetcher', null );
	if ( is_callable( $fetcher ) ) { return (string) call_user_func( $fetcher, $url ); }
	$host = (string) wp_parse_url( home_url(), PHP_URL_HOST );
	$r    = wp_remote_get( $url, array(
		'timeout'    => 30,
		'user-agent' => trim( gtp_setting( 'pharmacy' ) . ' website (' . $host . '), one read a day of the outbreak notices' ),
	) );
	if ( is_wp_error( $r ) || 200 !== (int) wp_remote_retrieve_response_code( $r ) ) { return ''; }
	return (string) wp_remote_retrieve_body( $r );
}

/**
 * Their page, as notices: date, disease, country, regions and the country's
 * own TravelHealthPro address. A notice's paragraph is never read.
 *
 * `ok` is false when the page does not read as their search (too few
 * notices to be a month of the world's outbreaks): the last good reading
 * stands.
 */
function gtp_notices_parse( $html ) {
	$items = array();
	$cards = preg_split( '~<div class="outbreak_post news-card">~', (string) $html );
	array_shift( $cards );
	foreach ( $cards as $card ) {
		/* A card carries its earlier updates further down; only its own head counts. */
		$head = explode( 'Outbreak updates', $card, 2 )[0];
		if ( ! preg_match( '~<h3[^>]*>(.*?)</h3>~s', $head, $h ) ) { continue; }
		$heading = trim( html_entity_decode( wp_strip_all_tags( $h[1] ), ENT_QUOTES, 'UTF-8' ) );
		/* "Dengue in Brazil", "Ebola disease in a traveller from DRC": the disease is what comes before " in ". */
		$disease = trim( explode( ' in ', $heading, 2 )[0] );
		if ( '' === $disease || strlen( $disease ) > 80 ) { continue; }
		if ( ! preg_match( '~<small>\s*([^<]+?)\s*</small>~', $head, $dm ) ) { continue; }
		$d = DateTime::createFromFormat( '!j F Y', trim( $dm[1] ) );
		if ( ! $d ) { continue; }
		if ( ! preg_match( '~<div class="outbreak_country">(.*?)</div>~s', $head, $cm ) ) { continue; }
		if ( ! preg_match( '~<a\s[^>]*href="([^"]*)"[^>]*>(.*?)</a>~s', $cm[1], $am ) ) { continue; }
		$date = $d->format( 'Y-m-d' );
		if ( '' === trim( $am[1] ) ) {
			/* A notice filed under several countries ("in France ex DRC"): their
			   list opens from a button with no address and names each country
			   with its page. It is kept once for each country it names, so each
			   one's card has it, and the button's own label is never a country. */
			$named = array();
			if ( preg_match_all( '~<a\s[^>]*href="(https://travelhealthpro\.org\.uk/countries/([a-z0-9-]+))/?"[^>]*>(.*?)</a>~s', $cm[1], $lm, PREG_SET_ORDER ) ) {
				foreach ( $lm as $l ) {
					$name = trim( html_entity_decode( wp_strip_all_tags( $l[3] ), ENT_QUOTES, 'UTF-8' ) );
					if ( '' !== $name && strlen( $name ) <= 60 ) { $named[ $l[2] ] = array( 'name' => $name, 'url' => $l[1] ); }
				}
			}
			ksort( $named );
			$group = $date . '|' . strtolower( $disease ) . '|' . implode( '+', array_keys( $named ) );
			foreach ( $named as $slug => $c ) {
				$items[ $date . '|' . strtolower( $disease ) . '|' . $slug ] = array(
					'date'    => $date,
					'disease' => $disease,
					'country' => $c['name'],
					'slug'    => (string) $slug,
					'regions' => array(),
					'url'     => $c['url'],
					'group'   => $group,
				);
			}
			continue;
		}
		/* "Thailand +": the plus opens the regions it names. */
		$country = trim( preg_replace( '~\s*\+\s*$~', '', html_entity_decode( wp_strip_all_tags( $am[2] ), ENT_QUOTES, 'UTF-8' ) ) );
		if ( '' === $country ) { continue; }
		/* Only TravelHealthPro's own country page is linked or matched to a card. */
		$url  = '';
		$slug = '';
		if ( preg_match( '~^https://travelhealthpro\.org\.uk/countries/([a-z0-9-]+)/?$~', $am[1], $um ) ) {
			$url  = $am[1];
			$slug = $um[1];
		}
		$regions = array();
		if ( preg_match_all( '~<span class="city_tooltip">\s*([^<]+?)\s*</span>~', $cm[1], $rm ) ) {
			foreach ( $rm[1] as $r ) {
				$r = trim( html_entity_decode( $r, ENT_QUOTES, 'UTF-8' ) );
				if ( '' !== $r && strlen( $r ) <= 60 ) { $regions[] = $r; }
			}
		}
		$key           = $date . '|' . strtolower( $disease ) . '|' . ( $slug ? $slug : strtolower( $country ) );
		$items[ $key ] = array(
			'date'    => $date,
			'disease' => $disease,
			'country' => $country,
			'slug'    => $slug,
			'regions' => array_slice( array_values( array_unique( $regions ) ), 0, 6 ),
			'url'     => $url,
		);
	}
	return array( 'ok' => count( $items ) >= GTP_NOTICES_FLOOR, 'items' => $items );
}

function gtp_notices_alert_to() {
	$to = (string) gtp_setting( 'alert_email' );
	return (string) apply_filters( 'gtp_notices_alert_to', '' !== $to ? $to : get_option( 'admin_email' ) );
}

/** "3 November 2026" */
function gtp_day( $iso ) {
	$t = strtotime( (string) $iso . ' 12:00:00 UTC' );
	return $t ? gmdate( 'j F Y', $t ) : (string) $iso;
}

/**
 * Notices as a reader meets them: one row a notice. A notice NaTHNaC files
 * under several countries is kept once for each (so each country's card has
 * it) and read as one row naming them all, in `places`.
 */
function gtp_notices_rows( $items ) {
	$out = array();
	$at  = array();
	foreach ( (array) $items as $n ) {
		$g     = (string) ( $n['group'] ?? '' );
		$place = array( 'name' => (string) $n['country'], 'url' => (string) $n['url'] );
		if ( '' !== $g && isset( $at[ $g ] ) ) {
			$out[ $at[ $g ] ]['places'][] = $place;
			continue;
		}
		if ( '' !== $g ) { $at[ $g ] = count( $out ); }
		$n['places'] = array( $place );
		$out[]       = $n;
	}
	return $out;
}

/**
 * "Dengue in Brazil (Bahia)". A notice filed under several countries says
 * where a case was found and where it came from, and only NaTHNaC's own
 * words say which is which, so it is named with its countries and no "in":
 * "Ebola disease (DRC, France)".
 */
function gtp_notice_words( $n ) {
	$places = (array) ( $n['places'] ?? array() );
	if ( count( $places ) > 1 ) {
		return $n['disease'] . ' (' . implode( ', ', array_column( $places, 'name' ) ) . ')';
	}
	$where = (string) $n['country'];
	if ( ! empty( $n['regions'] ) ) { $where .= ' (' . implode( ', ', (array) $n['regions'] ) . ')'; }
	return $n['disease'] . ' in ' . $where;
}

/**
 * Read their search and keep what it says. Returns what was done, for the
 * screen and the checks: 'paused', 'first read', 'read', 'read, N new',
 * 'read, N new, alerted', 'unreadable, alerted' or 'unreadable'.
 */
function gtp_notices_read( $force = false ) {
	if ( gtp_setting( 'reader_paused' ) && ! $force ) { return 'paused'; }
	$state = gtp_notices_state();
	$now   = gtp_notices_now();
	$stamp = wp_date( 'Y-m-d H:i', $now );
	$first = '' === $state['read'];
	$state['tried'] = $stamp;

	$parsed = gtp_notices_parse( gtp_notices_fetch( gtp_notices_url( $first ) ) );
	if ( ! $parsed['ok'] ) {
		$told = '' !== $state['failing'];
		if ( ! $told ) { $state['failing'] = $stamp; }
		gtp_notices_save( $state );
		if ( $told ) { return 'unreadable'; }
		wp_mail(
			gtp_notices_alert_to(),
			'[' . gtp_setting( 'pharmacy' ) . '] The outbreak notices could not be read',
			"The travel planner reads NaTHNaC's outbreak notices once a day, and today their page could not be read as their outbreak search.\n\n"
			. "Nothing on the site is broken. The last good reading (" . ( $state['read'] ? $state['read'] : 'none yet' ) . ") stays on show with its date, and is hidden after " . GTP_NOTICES_STALE . " days without a new one.\n\n"
			. "What to do: open their search and see whether it has moved or changed. Until the reader works again, a notice can be added by hand.\n\n"
			. 'Their search: ' . gtp_notices_url() . "\n" . admin_url( 'admin.php?page=gtp-notices' ) . "\n\n"
			. "This is sent once, not every day."
		);
		return 'unreadable, alerted';
	}

	/* A good reading: what it holds joins what is kept; what has aged out goes. */
	$cut   = gmdate( 'Y-m-d', $now - GTP_NOTICES_KEEP * DAY_IN_SECONDS );
	$items = array_merge( (array) $state['items'], $parsed['items'] );
	foreach ( $items as $k => $n ) { if ( (string) $n['date'] < $cut ) { unset( $items[ $k ] ); } }
	uasort( $items, function ( $a, $b ) { return strcmp( $b['date'] . $a['country'], $a['date'] . $b['country'] ); } );

	$new = array();
	foreach ( $parsed['items'] as $k => $n ) {
		if ( ! in_array( $k, (array) $state['seen'], true ) ) { $new[ $k ] = $n; }
	}
	$state['items']   = $items;
	$state['seen']    = array_slice( array_values( array_unique( array_merge( array_keys( $new ), (array) $state['seen'] ) ) ), 0, 600 );
	$state['hidden']  = array_values( array_intersect( (array) $state['hidden'], array_merge( array_keys( $items ), array_keys( (array) $state['manual'] ) ) ) );
	$state['read']    = $stamp;
	$state['failing'] = '';
	gtp_notices_save( $state );

	if ( $first ) { return 'first read'; }
	if ( ! $new ) { return 'read'; }

	$new  = gtp_notices_rows( $new );
	$mode = (string) gtp_setting( 'alerts', 'ours' );
	$tell = array();
	foreach ( $new as $n ) {
		if ( 'all' === $mode || ( 'ours' === $mode && gtp_is_ours( $n['disease'] ) ) ) { $tell[] = $n; }
	}
	if ( ! $tell ) { return 'read, ' . count( $new ) . ' new'; }
	$lines = array();
	foreach ( $tell as $n ) {
		$urls    = array_filter( array_column( $n['places'], 'url' ) );
		$lines[] = '- ' . gtp_notice_words( $n ) . ', ' . gtp_day( $n['date'] ) . ( $urls ? ': ' . implode( ' ', $urls ) : '' );
	}
	wp_mail(
		gtp_notices_alert_to(),
		'[' . gtp_setting( 'pharmacy' ) . '] ' . ( 1 === count( $tell ) ? 'A new outbreak notice: ' . gtp_notice_words( $tell[0] ) : count( $tell ) . ' new outbreak notices' ),
		"NaTHNaC has published " . ( 1 === count( $tell ) ? 'a new outbreak notice' : 'new outbreak notices' )
		. ( 'ours' === $mode ? ' for a disease you vaccinate against' : '' ) . ":\n\n" . implode( "\n", $tell ? $lines : array() ) . "\n\n"
		. "The travel planner already shows " . ( 1 === count( $tell ) ? 'it' : 'them' ) . ", by date and country, on each country's card. It shows none of NaTHNaC's figures or words: read the notice on TravelHealthPro before you write or post about it.\n\n"
		. admin_url( 'admin.php?page=gtp-notices' )
	);
	return 'read, ' . count( $new ) . ' new, alerted';
}

/** Whether the automatic notices can still be shown: a good reading within GTP_NOTICES_STALE days. */
function gtp_notices_fresh( $state = null ) {
	$state = $state ? $state : gtp_notices_state();
	if ( '' === $state['read'] ) { return false; }
	$then = strtotime( $state['read'] );
	return $then && ( gtp_notices_now() - $then ) <= GTP_NOTICES_STALE * DAY_IN_SECONDS + HOUR_IN_SECONDS * 30;
}

/**
 * The notices on show, newest first: the reader's while its reading is
 * fresh, a person's always, none a person has hidden, none older than
 * $days. Each says whether a person added it (`manual`).
 */
function gtp_notices_current( $days = GTP_NOTICES_SHOWN ) {
	$state = gtp_notices_state();
	$cut   = gmdate( 'Y-m-d', gtp_notices_now() - (int) $days * DAY_IN_SECONDS );
	$out   = array();
	$rows  = gtp_notices_fresh( $state ) ? (array) $state['items'] : array();
	foreach ( $rows as $k => $n ) { $out[ $k ] = $n + array( 'manual' => false, 'key' => $k ); }
	foreach ( (array) $state['manual'] as $k => $n ) { $out[ $k ] = $n + array( 'manual' => true, 'key' => $k ); }
	foreach ( $out as $k => $n ) {
		if ( in_array( $k, (array) $state['hidden'], true ) || (string) $n['date'] < $cut ) { unset( $out[ $k ] ); }
	}
	uasort( $out, function ( $a, $b ) { return strcmp( $b['date'] . $a['country'], $a['date'] . $b['country'] ); } );
	return array_values( $out );
}

/* ---- a person's hand ---------------------------------------------------- */

/** Add a notice by hand. Returns its key, or '' with nothing kept when it is not a notice. */
function gtp_notices_add( $in ) {
	$date    = trim( (string) ( $in['date'] ?? '' ) );
	$disease = trim( wp_strip_all_tags( (string) ( $in['disease'] ?? '' ) ) );
	$slug    = preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) ( $in['slug'] ?? '' ) ) );
	$d       = DateTime::createFromFormat( '!Y-m-d', $date );
	$country = '';
	foreach ( gtp_countries() as $c ) { if ( $c['slug'] === $slug ) { $country = (string) $c['name']; break; } }
	if ( ! $d || '' === $disease || strlen( $disease ) > 80 || '' === $country ) { return ''; }
	/* Not a date still to come: a notice is of something that has happened. */
	if ( $d->format( 'Y-m-d' ) > gmdate( 'Y-m-d', gtp_notices_now() + DAY_IN_SECONDS ) ) { return ''; }
	$state = gtp_notices_state();
	$key   = 'hand|' . $d->format( 'Y-m-d' ) . '|' . strtolower( $disease ) . '|' . $slug;
	$state['manual'][ $key ] = array(
		'date'    => $d->format( 'Y-m-d' ),
		'disease' => $disease,
		'country' => $country,
		'slug'    => $slug,
		'regions' => array(),
		'url'     => 'https://travelhealthpro.org.uk/countries/' . $slug,
	);
	gtp_notices_save( $state );
	return $key;
}

/** Take a notice off the site, or put it back. A notice added by hand is removed for good. */
function gtp_notices_hide( $key, $hide = true ) {
	$state = gtp_notices_state();
	$key   = (string) $key;
	if ( isset( $state['manual'][ $key ] ) && $hide ) {
		unset( $state['manual'][ $key ] );
	} elseif ( isset( $state['items'][ $key ] ) ) {
		$state['hidden'] = $hide
			? array_values( array_unique( array_merge( (array) $state['hidden'], array( $key ) ) ) )
			: array_values( array_diff( (array) $state['hidden'], array( $key ) ) );
	} else {
		return false;
	}
	gtp_notices_save( $state );
	return true;
}

/* ---- the daily reading -------------------------------------------------- */

function gtp_notices_schedule() {
	if ( ! wp_next_scheduled( GTP_NOTICES_HOOK ) ) {
		/* Not on the hour, when everybody's jobs run, and not at once: a site being set up has enough to do. */
		wp_schedule_event( time() + 20 * MINUTE_IN_SECONDS, 'daily', GTP_NOTICES_HOOK );
	}
}
function gtp_notices_unschedule() {
	wp_clear_scheduled_hook( GTP_NOTICES_HOOK );
}
add_action( GTP_NOTICES_HOOK, 'gtp_notices_read' );
add_action( 'init', 'gtp_notices_schedule' );

/* ---- [travel_notices] --------------------------------------------------- */

/**
 * The latest notices as a list: date, disease, country, each linked to that
 * country's TravelHealthPro page. `count` of them (6), `diseases="ours"` to
 * keep to what this pharmacy vaccinates against. Nothing is drawn when there
 * is nothing to say.
 */
function gtp_notices_shortcode( $atts = array() ) {
	if ( ! gtp_visible() ) { return ''; }
	$a    = shortcode_atts( array( 'count' => 6, 'diseases' => 'all', 'heading' => 'Latest outbreak notices' ), $atts, 'travel_notices' );
	$rows = gtp_notices_rows( gtp_notices_current() );
	if ( 'ours' === $a['diseases'] ) {
		$rows = array_values( array_filter( $rows, function ( $n ) { return gtp_is_ours( $n['disease'] ); } ) );
	}
	$rows = array_slice( $rows, 0, max( 1, min( 30, (int) $a['count'] ) ) );
	if ( ! $rows ) { return ''; }
	$state = gtp_notices_state();
	gtp_enqueue_style();
	ob_start();
	?>
	<section class="gtp gtp-notices" <?php echo gtp_style_attr(); // phpcs:ignore WordPress.Security.EscapeOutput -- built from validated colours ?> aria-labelledby="gtp-notices-title" data-gtp-notices>
		<div class="gtp__wrap">
			<h2 class="gtp__notices-title" id="gtp-notices-title"><?php echo esc_html( $a['heading'] ); ?></h2>
			<ul class="gtp__notices-list">
				<?php foreach ( $rows as $n ) : ?>
				<li class="gtp__notice" data-gtp-notice="<?php echo esc_attr( $n['key'] ); ?>">
					<time class="gtp__notice-date" datetime="<?php echo esc_attr( $n['date'] ); ?>"><?php echo esc_html( gtp_day( $n['date'] ) ); ?></time>
					<span class="gtp__notice-words">
						<strong><?php echo esc_html( $n['disease'] ); ?></strong><?php
						/* One country: "in Brazil (Bahia)". Several: the countries NaTHNaC names, and no "in". */
						$several = count( $n['places'] ) > 1;
						echo $several ? ': ' : ' in ';
						foreach ( $n['places'] as $i => $place ) {
							echo $i ? ', ' : '';
							if ( $place['url'] ) : ?><a href="<?php echo esc_url( $place['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $place['name'] ); ?></a><?php
							else :
								echo esc_html( $place['name'] );
							endif;
						}
						if ( ! $several && ! empty( $n['regions'] ) ) { echo esc_html( ' (' . implode( ', ', (array) $n['regions'] ) . ')' ); } ?>
					</span>
				</li>
				<?php endforeach; ?>
			</ul>
			<p class="gtp__notices-source">
				Notices published by NaTHNaC on TravelHealthPro<?php echo $state['read'] ? esc_html( ', read on ' . gtp_day( substr( $state['read'], 0, 10 ) ) ) : ''; ?>.
				Each links to their page for that country. <?php echo esc_html( (string) ( gtp_pack()['licence'] ?? '' ) ); ?>
			</p>
		</div>
	</section>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'travel_notices', 'gtp_notices_shortcode' );
