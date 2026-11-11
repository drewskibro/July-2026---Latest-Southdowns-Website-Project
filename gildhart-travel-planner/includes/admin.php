<?php
/**
 * Travel Planner in wp-admin: the settings, and the notices.
 *
 * Settings is what this pharmacy gives, charges and is. Notices is the
 * reader's last reading and a person's hand over it: read now, add a
 * notice, take one off. Both are for whoever manages the site; nothing here
 * is shown to a visitor.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_menu', function () {
	add_menu_page( 'Travel Planner', 'Travel Planner', 'manage_options', 'gtp-settings', 'gtp_admin_settings_page', 'dashicons-airplane', 58 );
	add_submenu_page( 'gtp-settings', 'Travel Planner settings', 'Settings', 'manage_options', 'gtp-settings', 'gtp_admin_settings_page' );
	add_submenu_page( 'gtp-settings', 'Outbreak notices', 'Notices', 'manage_options', 'gtp-notices', 'gtp_admin_notices_page' );
} );

function gtp_admin_guard( $action ) {
	if ( ! current_user_can( 'manage_options' ) ) { wp_die( 'Not allowed.', '', array( 'response' => 403 ) ); }
	check_admin_referer( $action );
}

function gtp_admin_back( $page, $args = array() ) {
	wp_safe_redirect( add_query_arg( $args, admin_url( 'admin.php?page=' . $page ) ) );
	exit;
}

/* ---- settings: saving ---------------------------------------------------- */

add_action( 'admin_post_gtp_save_settings', function () {
	gtp_admin_guard( 'gtp_save_settings' );
	$in = isset( $_POST['gtp'] ) && is_array( $_POST['gtp'] ) ? wp_unslash( $_POST['gtp'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- sanitised by gtp_sanitize_settings
	/* A box left unticked is not sent at all: say so, or the old value would stand. */
	foreach ( array( 'enabled', 'yf_centre', 'reader_paused' ) as $k ) { $in[ $k ] = ! empty( $in[ $k ] ); }
	if ( ! isset( $in['vaccines'] ) ) { $in['vaccines'] = array(); }
	if ( ! isset( $in['guides'] ) ) { $in['guides'] = ''; }
	update_option( GTP_OPTION, gtp_sanitize_settings( $in, gtp_defaults() ), false );
	gtp_admin_back( 'gtp-settings', array( 'gtp' => 'saved' ) );
} );

add_action( 'admin_post_gtp_reset_settings', function () {
	gtp_admin_guard( 'gtp_reset_settings' );
	delete_option( GTP_OPTION );
	gtp_admin_back( 'gtp-settings', array( 'gtp' => 'reset' ) );
} );

add_action( 'admin_post_gtp_import_settings', function () {
	gtp_admin_guard( 'gtp_import_settings' );
	$data = json_decode( (string) wp_unslash( $_POST['gtp_import'] ?? '' ), true ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- decoded then sanitised
	if ( ! is_array( $data ) ) { gtp_admin_back( 'gtp-settings', array( 'gtp' => 'import-failed' ) ); }
	update_option( GTP_OPTION, gtp_sanitize_settings( $data, gtp_defaults() ), false );
	gtp_admin_back( 'gtp-settings', array( 'gtp' => 'imported' ) );
} );

/* ---- notices: a person's hand -------------------------------------------- */

add_action( 'admin_post_gtp_notices_read', function () {
	gtp_admin_guard( 'gtp_notices_read' );
	gtp_admin_back( 'gtp-notices', array( 'gtp' => rawurlencode( gtp_notices_read( true ) ) ) );
} );

add_action( 'admin_post_gtp_notices_add', function () {
	gtp_admin_guard( 'gtp_notices_add' );
	$key = gtp_notices_add( array(
		'date'    => sanitize_text_field( wp_unslash( $_POST['date'] ?? '' ) ),
		'disease' => sanitize_text_field( wp_unslash( $_POST['disease'] ?? '' ) ),
		'slug'    => sanitize_text_field( wp_unslash( $_POST['slug'] ?? '' ) ),
	) );
	gtp_admin_back( 'gtp-notices', array( 'gtp' => '' !== $key ? 'added' : 'not-added' ) );
} );

add_action( 'admin_post_gtp_notices_toggle', function () {
	gtp_admin_guard( 'gtp_notices_toggle' );
	$ok = gtp_notices_hide( sanitize_text_field( wp_unslash( $_POST['key'] ?? '' ) ), ! empty( $_POST['hide'] ) );
	gtp_admin_back( 'gtp-notices', array( 'gtp' => $ok ? 'changed' : 'not-changed' ) );
} );

/* ---- the screens ---------------------------------------------------------- */

function gtp_admin_message() {
	$m = isset( $_GET['gtp'] ) ? sanitize_text_field( wp_unslash( $_GET['gtp'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- a message, nothing is changed
	if ( '' === $m ) { return; }
	$words = array(
		'saved'         => 'Settings saved.',
		'reset'         => 'The saved settings were forgotten: the site\'s file and the defaults are in force again.',
		'imported'      => 'Settings imported.',
		'import-failed' => 'That was not settings: nothing was changed.',
		'added'         => 'Notice added. It is on the site now.',
		'not-added'     => 'Not added: a notice needs a date that has happened, a disease and a country from the list.',
		'changed'       => 'Done.',
		'not-changed'   => 'Nothing was changed: that notice is no longer kept.',
	);
	$text = $words[ $m ] ?? ( 'The reader says: ' . $m . '.' );
	echo '<div class="notice notice-info is-dismissible" data-gtp-message><p>' . esc_html( $text ) . '</p></div>';
}

/** One warning, on these screens only: a pack older than this needs a person's look. */
function gtp_admin_pack_line() {
	$pack = gtp_pack();
	$age  = gtp_pack_age_days();
	$read = (string) ( $pack['read']['oldest'] ?? '' );
	echo '<p data-gtp-pack>What the guidance says about each country was read from TravelHealthPro on <strong>' . esc_html( $read ? gtp_day( $read ) : 'an unknown day' ) . '</strong>'
		. ' (' . (int) ( $pack['cards'] ?? 0 ) . ' countries). Every card says that date. It changes only with a new version of the plugin.</p>';
	if ( null !== $age && $age > 120 ) {
		echo '<div class="notice notice-warning inline" data-gtp-pack-old><p><strong>The country guidance is ' . (int) $age . ' days old.</strong> Ask for a refreshed version of the plugin.</p></div>';
	}
}

function gtp_admin_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$s     = gtp_settings( true );
	$vax   = gtp_catalogue();
	$mine  = (array) $s['vaccines'];
	$file  = gtp_site_file();
	$saved = gtp_settings_saved();
	$guides = '';
	foreach ( (array) $s['guides'] as $slug => $url ) { $guides .= $slug . ' = ' . $url . "\n"; }
	?>
	<div class="wrap" data-gtp-admin="settings">
		<h1>Travel Planner</h1>
		<?php gtp_admin_message(); ?>
		<p>Put the planner on a page with <code>[travel_planner]</code> and the latest outbreak notices with <code>[travel_notices]</code>.</p>
		<?php gtp_admin_pack_line(); ?>
		<p data-gtp-source-of-settings>
			<?php if ( $saved ) : ?>
				These settings were saved here<?php echo $file ? ', so the site\'s own file (gildhart-travel-planner.json in the theme) is not being read.' : '.'; ?>
			<?php elseif ( $file ) : ?>
				These settings come from the site's own file (gildhart-travel-planner.json in the theme). Saving here takes over from it.
			<?php else : ?>
				Nothing has been saved yet: these are the plugin's defaults.
			<?php endif; ?>
		</p>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="gtp_save_settings">
			<?php wp_nonce_field( 'gtp_save_settings' ); ?>

			<h2>On the site</h2>
			<table class="form-table" role="presentation">
				<tr><th scope="row">Planner</th><td>
					<label><input type="checkbox" name="gtp[enabled]" value="1" <?php checked( $s['enabled'] ); ?>> Show the planner to everyone</label>
					<p class="description">Unticked, it is a preview: only people signed in to edit the site can see it.</p>
				</td></tr>
				<tr><th scope="row"><label for="gtp-pharmacy">Pharmacy</label></th><td><input class="regular-text" id="gtp-pharmacy" name="gtp[pharmacy]" value="<?php echo esc_attr( $s['pharmacy'] ); ?>"></td></tr>
				<tr><th scope="row"><label for="gtp-book">Booking link</label></th><td>
					<input class="regular-text" id="gtp-book" name="gtp[booking_url]" value="<?php echo esc_attr( $s['booking_url'] ); ?>" placeholder="#book or /book-appointment/">
					<p class="description">Where every card's button goes: a section on the same page (#book), a page on this site (/book-appointment/) or a full https address.</p>
				</td></tr>
				<tr><th scope="row"><label for="gtp-phone">Phone</label></th><td><input class="regular-text" id="gtp-phone" name="gtp[phone]" value="<?php echo esc_attr( $s['phone'] ); ?>"></td></tr>
				<tr><th scope="row">On the map</th><td>
					<label>Latitude <input name="gtp[lat]" value="<?php echo esc_attr( $s['lat'] ); ?>" size="12"></label>
					<label>Longitude <input name="gtp[lng]" value="<?php echo esc_attr( $s['lng'] ); ?>" size="12"></label>
					<p class="description">The pharmacy's point, where every route starts. In Google Maps, right-click the pharmacy and copy the two numbers.</p>
				</td></tr>
				<tr><th scope="row"><label for="gtp-consult">Consultation line</label></th><td>
					<input class="large-text" id="gtp-consult" name="gtp[consultation_line]" value="<?php echo esc_attr( $s['consultation_line'] ); ?>" placeholder="The travel consultation is £20.">
					<p class="description">One sentence, under every card. Say only what is so.</p>
				</td></tr>
				<tr><th scope="row">Yellow fever</th><td>
					<label><input type="checkbox" name="gtp[yf_centre]" value="1" <?php checked( $s['yf_centre'] ); ?>> We are a registered yellow fever vaccination centre</label>
					<p><input class="large-text" name="gtp[yf_line]" value="<?php echo esc_attr( $s['yf_line'] ); ?>" placeholder="Our pharmacy is a registered yellow fever vaccination centre."></p>
					<p class="description">Unticked, no price is ever shown for yellow fever. The sentence is shown on a country whose guidance lists the vaccine.</p>
				</td></tr>
			</table>

			<h2>What we give, and what a dose costs</h2>
			<p>A price is for <strong>one dose</strong>: a card says "£56 a dose" for a course of more than one, and never a course's total. Leave a price empty and the card says "Ask us".</p>
			<table class="widefat striped" style="max-width:1100px" data-gtp-prices>
				<thead><tr><th>Vaccine</th><th>Doses</th><th>We</th><th>Price a dose (£)</th><th>Child price a dose (£)</th><th>A line under the price</th></tr></thead>
				<tbody>
				<?php foreach ( $vax as $id => $v ) :
					$row = is_array( $mine[ $id ] ?? null ) ? $mine[ $id ] : array( 'status' => 'ask', 'price' => null, 'child_price' => null, 'note' => '' ); ?>
					<tr>
						<td><strong><?php echo esc_html( $v['name'] ); ?></strong></td>
						<td><?php echo (int) $v['doses']; ?></td>
						<td><select name="gtp[vaccines][<?php echo esc_attr( $id ); ?>][status]">
							<option value="given" <?php selected( $row['status'], 'given' ); ?>>give it</option>
							<option value="not" <?php selected( $row['status'], 'not' ); ?>>don't give it</option>
							<option value="ask" <?php selected( $row['status'], 'ask' ); ?>>ask us</option>
						</select></td>
						<td><input name="gtp[vaccines][<?php echo esc_attr( $id ); ?>][price]" value="<?php echo esc_attr( null === $row['price'] ? '' : $row['price'] ); ?>" size="8" inputmode="decimal"></td>
						<td><input name="gtp[vaccines][<?php echo esc_attr( $id ); ?>][child_price]" value="<?php echo esc_attr( null === $row['child_price'] ? '' : $row['child_price'] ); ?>" size="8" inputmode="decimal"></td>
						<td><input class="regular-text" name="gtp[vaccines][<?php echo esc_attr( $id ); ?>][note]" value="<?php echo esc_attr( $row['note'] ); ?>"></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<h2>Our own pages about a country</h2>
			<p><textarea class="large-text code" rows="5" name="gtp[guides]" placeholder="thailand = /thailand-travel-vaccinations/"><?php echo esc_textarea( $guides ); ?></textarea></p>
			<p class="description">One a line: the country as TravelHealthPro's address names it, then this site's page. A page is linked only while it is published.</p>

			<h2>Colours</h2>
			<table class="form-table" role="presentation">
				<?php foreach ( array( 'color_dark' => 'The stage and the facts', 'color_dark2' => 'The stage\'s second colour', 'color_accent' => 'The booking button', 'color_pin' => 'The pins on the map', 'color_tint' => 'Soft panels' ) as $k => $label ) : ?>
				<tr><th scope="row"><label for="gtp-<?php echo esc_attr( $k ); ?>"><?php echo esc_html( $label ); ?></label></th><td><input type="color" id="gtp-<?php echo esc_attr( $k ); ?>" name="gtp[<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( $s[ $k ] ); ?>"> <code><?php echo esc_html( $s[ $k ] ); ?></code></td></tr>
				<?php endforeach; ?>
			</table>

			<h2>Outbreak notices</h2>
			<table class="form-table" role="presentation">
				<tr><th scope="row"><label for="gtp-email">Email new notices to</label></th><td><input class="regular-text" type="email" id="gtp-email" name="gtp[alert_email]" value="<?php echo esc_attr( $s['alert_email'] ); ?>" placeholder="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>"></td></tr>
				<tr><th scope="row">Email me about</th><td>
					<label><input type="radio" name="gtp[alerts]" value="ours" <?php checked( $s['alerts'], 'ours' ); ?>> diseases we vaccinate against</label><br>
					<label><input type="radio" name="gtp[alerts]" value="all" <?php checked( $s['alerts'], 'all' ); ?>> every notice</label><br>
					<label><input type="radio" name="gtp[alerts]" value="none" <?php checked( $s['alerts'], 'none' ); ?>> nothing</label>
				</td></tr>
				<tr><th scope="row">The daily reading</th><td><label><input type="checkbox" name="gtp[reader_paused]" value="1" <?php checked( $s['reader_paused'] ); ?>> Pause it (notices added by hand are still shown)</label></td></tr>
			</table>

			<?php submit_button( 'Save settings' ); ?>
		</form>

		<h2>Copy these settings to another site</h2>
		<p><textarea class="large-text code" rows="6" readonly data-gtp-export><?php echo esc_textarea( wp_json_encode( $s, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ); ?></textarea></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="gtp_import_settings">
			<?php wp_nonce_field( 'gtp_import_settings' ); ?>
			<p><textarea class="large-text code" rows="4" name="gtp_import" placeholder="Paste settings copied from another site"></textarea></p>
			<?php submit_button( 'Import settings', 'secondary' ); ?>
		</form>
		<?php if ( $saved ) : ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="gtp_reset_settings">
			<?php wp_nonce_field( 'gtp_reset_settings' ); ?>
			<?php submit_button( $file ? 'Use the site\'s file again' : 'Forget the saved settings', 'delete' ); ?>
		</form>
		<?php endif; ?>
	</div>
	<?php
}

function gtp_admin_notices_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$state  = gtp_notices_state();
	$fresh  = gtp_notices_fresh( $state );
	$hidden = (array) $state['hidden'];
	$rows   = array();
	foreach ( (array) $state['manual'] as $k => $n ) { $rows[ $k ] = $n + array( 'manual' => true ); }
	foreach ( (array) $state['items'] as $k => $n ) { $rows[ $k ] = $n + array( 'manual' => false ); }
	uasort( $rows, function ( $a, $b ) { return strcmp( $b['date'] . $a['country'], $a['date'] . $b['country'] ); } );
	$post = admin_url( 'admin-post.php' );
	?>
	<div class="wrap" data-gtp-admin="notices">
		<h1>Outbreak notices</h1>
		<?php gtp_admin_message(); ?>
		<p>Once a day the site reads NaTHNaC's outbreak notices on TravelHealthPro and keeps each one's date, disease and country. It shows none of their figures or words. A country's card lists its notices of the last <?php echo (int) GTP_NOTICES_SHOWN; ?> days.</p>

		<p data-gtp-reader>
			<?php if ( gtp_setting( 'reader_paused' ) ) : ?>
				<strong>The daily reading is paused</strong> (Settings). Notices added by hand are still shown.
			<?php elseif ( '' !== $state['failing'] ) : ?>
				<strong>Their page has not been readable since <?php echo esc_html( $state['failing'] ); ?>.</strong>
				<?php echo $fresh ? 'The last good reading is still on show.' : 'The last good reading is too old to show: only notices added by hand are on the site.'; ?>
			<?php elseif ( '' === $state['read'] ) : ?>
				Not read yet. It reads by itself within a day, or now with the button.
			<?php else : ?>
				Last read <strong><?php echo esc_html( $state['read'] ); ?></strong>: <?php echo count( (array) $state['items'] ); ?> notices kept.
			<?php endif; ?>
		</p>
		<form method="post" action="<?php echo esc_url( $post ); ?>" style="margin:0 0 24px">
			<input type="hidden" name="action" value="gtp_notices_read">
			<?php wp_nonce_field( 'gtp_notices_read' ); ?>
			<?php submit_button( 'Read now', 'secondary', 'submit', false ); ?>
		</form>

		<h2>Add a notice by hand</h2>
		<p>For when the reader cannot read their page, or misses one. Take the date, disease and country from NaTHNaC's own notice.</p>
		<form method="post" action="<?php echo esc_url( $post ); ?>" data-gtp-add>
			<input type="hidden" name="action" value="gtp_notices_add">
			<?php wp_nonce_field( 'gtp_notices_add' ); ?>
			<label>Date <input type="date" name="date" required max="<?php echo esc_attr( gmdate( 'Y-m-d' ) ); ?>"></label>
			<label>Disease <input name="disease" required maxlength="80" placeholder="Dengue"></label>
			<label>Country <select name="slug" required>
				<option value="">Choose</option>
				<?php foreach ( gtp_countries() as $c ) : ?>
				<option value="<?php echo esc_attr( $c['slug'] ); ?>"><?php echo esc_html( $c['name'] ); ?></option>
				<?php endforeach; ?>
			</select></label>
			<?php submit_button( 'Add notice', 'primary', 'submit', false ); ?>
		</form>

		<h2>The notices kept</h2>
		<table class="widefat striped" style="max-width:1000px" data-gtp-kept>
			<thead><tr><th>Date</th><th>Disease</th><th>Country</th><th>From</th><th>On the site</th><th></th></tr></thead>
			<tbody>
			<?php if ( ! $rows ) : ?><tr><td colspan="6">None yet.</td></tr><?php endif; ?>
			<?php foreach ( $rows as $k => $n ) :
				$off  = in_array( $k, $hidden, true );
				$show = ! $off && ( $n['manual'] || $fresh ); ?>
				<tr data-gtp-row="<?php echo esc_attr( $k ); ?>">
					<td><?php echo esc_html( gtp_day( $n['date'] ) ); ?></td>
					<td><?php echo esc_html( $n['disease'] ); ?></td>
					<td><?php if ( $n['url'] ) : ?><a href="<?php echo esc_url( $n['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $n['country'] ); ?></a><?php else : echo esc_html( $n['country'] ); endif; ?></td>
					<td><?php echo $n['manual'] ? 'added by hand' : 'NaTHNaC, read by the site'; ?></td>
					<td><?php echo $show ? 'shown' : ( $off ? 'taken off' : 'not shown: the reading is too old' ); ?></td>
					<td>
						<form method="post" action="<?php echo esc_url( $post ); ?>">
							<input type="hidden" name="action" value="gtp_notices_toggle">
							<input type="hidden" name="key" value="<?php echo esc_attr( $k ); ?>">
							<?php if ( ! $off ) : ?><input type="hidden" name="hide" value="1"><?php endif; ?>
							<?php wp_nonce_field( 'gtp_notices_toggle' ); ?>
							<button class="button-link" type="submit"><?php echo $n['manual'] ? 'Remove' : ( $off ? 'Put back' : 'Take off' ); ?></button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php
}
