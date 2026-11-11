<?php
/**
 * [travel_planner]: where are you going?
 *
 * One bold object, the world map with the pharmacy on it, and one box over
 * every country TravelHealthPro has a page for. Choose one and the trip card
 * lands beneath it (assets/planner.js): the country drawn from Natural
 * Earth, the route from the pharmacy on the map, "When do you fly?" and the
 * day to start each course by, two counts, the vaccines as cards you swipe
 * on a phone, the certificate, malaria and the day's outbreak notices, and
 * the way out, which is always a booking.
 *
 * The server hands the script everything a pharmacy decides (what it gives,
 * what a dose costs, where it books) and the script draws exactly that: the
 * pack it fetches holds no price. Without the script the box is not shown,
 * so nobody is offered a control that does nothing, and the section is its
 * heading, a line and the booking.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** The pharmacy's colours as custom properties on the section. Every value was validated as #rrggbb on its way in. */
function gtp_style_attr() {
	$s    = gtp_settings();
	$vars = array(
		'--gtp-dark'   => $s['color_dark'],
		'--gtp-dark2'  => $s['color_dark2'],
		'--gtp-accent' => $s['color_accent'],
		'--gtp-pin'    => $s['color_pin'],
		'--gtp-tint'   => $s['color_tint'],
	);
	$css = '';
	foreach ( $vars as $k => $v ) {
		if ( preg_match( '/^#[0-9a-f]{6}$/', (string) $v ) ) { $css .= $k . ':' . $v . ';'; }
	}
	return 'style="' . esc_attr( $css ) . '"';
}

function gtp_enqueue_style() {
	wp_enqueue_style( 'gtp-planner', gtp_url( 'assets/planner.css' ), array(), gtp_asset_version( 'assets/planner.css' ) );
}

/**
 * This site's own page about a country, when the settings name one and it
 * is there to be read: a path on this site is linked only while its page is
 * published, so the planner never sends anyone to a draft.
 */
function gtp_guide_url( $slug ) {
	$guides = (array) gtp_setting( 'guides', array() );
	$url    = (string) ( $guides[ $slug ] ?? '' );
	if ( '' === $url ) { return ''; }
	if ( '/' === $url[0] ) {
		$full = home_url( $url );
		$id   = function_exists( 'url_to_postid' ) ? (int) url_to_postid( $full ) : 0;
		if ( ! $id || 'publish' !== get_post_status( $id ) ) { return ''; }
		return $full;
	}
	return $url;
}

/** What the script is handed: this pharmacy's answers, and nobody else's. */
function gtp_planner_config( $book ) {
	$countries = array();
	foreach ( gtp_countries() as $c ) {
		if ( empty( $c['name'] ) || empty( $c['slug'] ) ) { continue; }
		$row = array( 'name' => (string) $c['name'], 'slug' => (string) $c['slug'] );
		if ( ! empty( $c['planner'] ) ) { $row['planner'] = true; }
		/* Other names the box answers to: "Bali" for their Indonesia page, "United States" for their USA. */
		if ( ! empty( $c['aka'] ) && is_array( $c['aka'] ) ) { $row['aka'] = array_values( array_map( 'strval', $c['aka'] ) ); }
		$url = gtp_guide_url( $row['slug'] );
		if ( '' !== $url ) { $row['url'] = $url; }
		$countries[] = $row;
	}
	$notices = array();
	foreach ( gtp_notices_current() as $n ) {
		if ( '' === (string) $n['slug'] ) { continue; }
		$notices[] = array( 'date' => $n['date'], 'day' => gtp_day( $n['date'] ), 'disease' => $n['disease'], 'slug' => $n['slug'] );
	}
	$pack = gtp_pack();
	return array(
		'base'         => gtp_url( 'data/' ),
		'book'         => $book,
		'phone'        => (string) gtp_setting( 'phone' ),
		'pharmacy'     => (string) gtp_setting( 'pharmacy' ),
		'countries'    => $countries,
		'vaccines'     => gtp_vaccines(),
		'notices'      => $notices,
		'yf'           => gtp_setting( 'yf_centre' ) ? (string) gtp_setting( 'yf_line' ) : '',
		'consultation' => (string) gtp_setting( 'consultation_line' ),
		'licence'      => (string) ( $pack['licence'] ?? '' ),
	);
}

function gtp_planner_shortcode( $atts = array() ) {
	if ( ! gtp_visible() ) { return ''; }
	$a = shortcode_atts( array(
		'book'    => '',
		'eyebrow' => 'Trip planner',
		'heading' => 'Where are you going?',
		'lead'    => 'Any country. See what the guidance recommends for your trip, what each vaccine costs here and how far ahead to book, then book it in one go.',
		'id'      => 'trip-planner',
	), $atts, 'travel_planner' );

	$book = trim( (string) $a['book'] );
	if ( ! preg_match( '~^(#[A-Za-z0-9_-]+|/(?!/)\S*|https://\S+)$~', $book ) ) { $book = (string) gtp_setting( 'booking_url' ); }
	$phone  = (string) gtp_setting( 'phone' );
	$config = gtp_planner_config( $book );
	if ( ! $config['countries'] ) { return ''; }

	$map  = gtp_data( 'map' );
	$home = gtp_project( gtp_setting( 'lat' ), gtp_setting( 'lng' ) );
	$id   = preg_replace( '/[^A-Za-z0-9_-]/', '', (string) $a['id'] );
	$id   = '' !== $id ? $id : 'trip-planner';

	gtp_enqueue_style();
	wp_enqueue_script( 'gtp-planner', gtp_url( 'assets/planner.js' ), array(), gtp_asset_version( 'assets/planner.js' ), true );

	$guides = array_values( array_filter( $config['countries'], function ( $c ) { return ! empty( $c['url'] ); } ) );

	ob_start();
	?>
	<section class="gtp" id="<?php echo esc_attr( $id ); ?>" <?php echo gtp_style_attr(); // phpcs:ignore WordPress.Security.EscapeOutput -- built from validated colours ?> aria-labelledby="<?php echo esc_attr( $id ); ?>-heading" data-gtp>
		<?php if ( ! gtp_setting( 'enabled' ) ) : ?>
		<p class="gtp__preview" role="status" data-gtp-preview>
			<strong>Preview.</strong> Only people signed in to edit this site can see the travel planner.
			Switch it on in Travel Planner &rsaquo; Settings once the prices and wording are approved.
		</p>
		<?php endif; ?>

		<div class="gtp__stage">
			<?php if ( ! empty( $map['land'] ) && ! empty( $map['frame']['width'] ) ) : ?>
			<svg class="gtp__world" viewBox="0 0 <?php echo (int) $map['frame']['width']; ?> <?php echo (int) $map['frame']['height']; ?>"
				preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false" data-gtp-world>
				<path class="gtp__land" d="<?php echo esc_attr( $map['land'] ); ?>"/>
				<g data-gtp-route></g>
				<?php if ( $home ) : ?>
				<circle class="gtp__home" cx="<?php echo (float) $home['x']; ?>" cy="<?php echo (float) $home['y']; ?>" r="5"
					data-gtp-home data-x="<?php echo (float) $home['x']; ?>" data-y="<?php echo (float) $home['y']; ?>"/>
				<?php endif; ?>
				<circle class="gtp__pin" r="6" data-gtp-pin hidden/>
			</svg>
			<?php endif; ?>

			<div class="gtp__wrap gtp__stage-inner">
				<p class="gtp__eyebrow"><?php echo esc_html( $a['eyebrow'] ); ?></p>
				<h2 class="gtp__heading" id="<?php echo esc_attr( $id ); ?>-heading"><?php echo esc_html( $a['heading'] ); ?></h2>
				<p class="gtp__lead"><?php echo esc_html( $a['lead'] ); ?></p>

				<?php /* Shown by the script, which is the only thing that makes it do anything. */ ?>
				<div class="gtp__box" data-gtp-box hidden>
					<label class="gtp__label" for="<?php echo esc_attr( $id ); ?>-country">Where are you going?</label>
					<div class="gtp__field">
						<svg class="gtp__field-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
						<input id="<?php echo esc_attr( $id ); ?>-country" class="gtp__input" type="text" role="combobox"
							aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>-list" aria-autocomplete="list"
							autocomplete="off" autocapitalize="off" spellcheck="false"
							placeholder="Type a country" data-gtp-input>
						<ul id="<?php echo esc_attr( $id ); ?>-list" class="gtp__list" role="listbox" aria-label="Countries" data-gtp-list hidden></ul>
					</div>
				</div>

				<?php if ( $guides ) : ?>
				<nav class="gtp__quick" aria-label="Travel guides">
					<span class="gtp__quick-label">Guides</span>
					<?php foreach ( $guides as $g ) : ?>
					<a class="gtp__quick-link" href="<?php echo esc_url( $g['url'] ); ?>" data-gtp-pick="<?php echo esc_attr( $g['slug'] ); ?>"><?php echo esc_html( $g['name'] ); ?></a>
					<?php endforeach; ?>
				</nav>
				<?php endif; ?>

				<noscript>
					<p class="gtp__noscript">
						Tell us where you're going when you book, and the pharmacist goes through what your trip needs.
						<?php if ( '' !== $book ) : ?><a href="<?php echo esc_url( $book ); ?>">Book a travel consultation</a><?php endif; ?>
						<?php if ( '' !== $phone ) : ?> or call <a href="<?php echo esc_attr( 'tel:' . preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>.<?php endif; ?>
					</p>
				</noscript>
			</div>
		</div>

		<div class="gtp__answer" data-gtp-result aria-live="polite" hidden></div>

		<script type="application/json" data-gtp-config><?php echo wp_json_encode( $config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ); // phpcs:ignore WordPress.Security.EscapeOutput -- JSON in a data block ?></script>
	</section>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'travel_planner', 'gtp_planner_shortcode' );
