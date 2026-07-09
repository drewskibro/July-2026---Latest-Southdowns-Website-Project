<?php
/**
 * ACF Local Field Group — Home Page (front-page.php)
 *
 * Location: the static front page (Settings → Reading).
 * Text fields pre-filled via default_value; repeaters pre-filled via the
 * load_value seed at the bottom. Images are upload fields (placeholder shows
 * until the client uploads). Awards cards come from Pharmacy Settings → Awards.
 *
 * Hero headings may contain a <span class="serif-accent">…</span> for the
 * italic accent — keep that markup if you want the styled word.
 */

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$slide = function ( $n, $heading, $subtext ) {
		return [
			[ 'key' => "field_home_s{$n}_heading", 'label' => "Slide {$n} — Heading", 'name' => "home_s{$n}_heading", 'type' => 'text', 'default_value' => $heading, 'instructions' => 'May contain a <span class="serif-accent">word</span> for the italic accent.' ],
			[ 'key' => "field_home_s{$n}_subtext", 'label' => "Slide {$n} — Sub-text", 'name' => "home_s{$n}_subtext", 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => $subtext ],
			[ 'key' => "field_home_s{$n}_image", 'label' => "Slide {$n} — Background Image", 'name' => "home_s{$n}_image", 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
		];
	};

	$hero_fields = array_merge(
		[ [ 'key' => 'field_home_tab_hero', 'label' => 'Hero Slider', 'name' => '', 'type' => 'tab' ], [ 'key' => 'field_home_hero_note', 'label' => 'Hero note', 'name' => '', 'type' => 'message', 'message' => 'Edit each slide\'s main heading, sub-text and background image below. The small badge, feature ticks and button labels are fixed in the design.' ] ],
		$slide( 1, '<span class="serif-accent">Same-day</span> travel vaccine &amp; blood test appointments', 'Book your vaccine or blood test appointment today online or call our friendly team for advice and more information.' ),
		$slide( 2, 'Medical <span class="serif-accent">weight loss</span> programme', 'Achieve your weight loss goals with our clinically supervised programme. GPhC registered pharmacists providing safe, effective treatments.' ),
		$slide( 3, '<span class="serif-accent">Comprehensive</span> blood testing', 'Same day blood test appointments available across 4 Hampshire locations. Vitamin B12 deficiency testing and full health screening.' )
	);

	acf_add_local_field_group( [
		'key'                   => 'group_home_page',
		'title'                 => 'Home Page Content',
		'position'              => 'acf_after_title',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'hide_on_screen'        => [ 'the_content' ],
		'location'              => [
			[ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ],
		],
		'fields' => array_merge( $hero_fields, [

			// ── Awards heading (cards = Pharmacy Settings → Awards) ──
			[ 'key' => 'field_home_tab_awards', 'label' => 'Awards', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_awards_eyebrow', 'label' => 'Eyebrow', 'name' => 'home_awards_eyebrow', 'type' => 'text', 'default_value' => 'Recognised for Excellence' ],
			[ 'key' => 'field_home_awards_heading', 'label' => 'Heading', 'name' => 'home_awards_heading', 'type' => 'text', 'default_value' => 'Nationally Award-Winning Pharmacy Group', 'instructions' => 'Award cards are edited under Pharmacy Settings → Awards.' ],

			// ── Treatments ──
			[ 'key' => 'field_home_tab_treat', 'label' => 'Popular Treatments', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_treat_eyebrow', 'label' => 'Eyebrow', 'name' => 'home_treat_eyebrow', 'type' => 'text', 'default_value' => 'Trusted by thousands across Hampshire' ],
			[ 'key' => 'field_home_treat_heading', 'label' => 'Heading', 'name' => 'home_treat_heading', 'type' => 'text', 'default_value' => 'Our Most Popular Treatments' ],
			[ 'key' => 'field_home_treat_intro', 'label' => 'Intro', 'name' => 'home_treat_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Comprehensive healthcare solutions tailored to your needs, delivered with care at our Hampshire locations.' ],
			[
				'key' => 'field_home_treatments', 'label' => 'Treatment Cards', 'name' => 'home_treatments', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Treatment',
				'sub_fields' => [
					[ 'key' => 'field_home_treat_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_home_treat_url', 'label' => 'Link', 'name' => 'url', 'type' => 'url' ],
					[ 'key' => 'field_home_treat_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
				],
			],

			// ── Search by Destination ──
			[ 'key' => 'field_home_tab_dest', 'label' => 'Vaccines by Destination', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_dest_heading', 'label' => 'Heading', 'name' => 'home_dest_heading', 'type' => 'text', 'default_value' => 'Search Vaccines by Destination' ],
			[ 'key' => 'field_home_dest_intro', 'label' => 'Intro', 'name' => 'home_dest_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'At Southdowns Pharmacy, we provide expert travel health services across Hampshire. Find the vaccines you need for your next adventure.' ],
			[
				'key' => 'field_home_dest_stats', 'label' => 'Stats', 'name' => 'home_dest_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat',
				'sub_fields' => [
					[ 'key' => 'field_home_dest_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_home_dest_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],
			[
				'key' => 'field_home_destinations', 'label' => 'Destinations', 'name' => 'home_destinations', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Destination',
				'sub_fields' => [
					[ 'key' => 'field_home_dest_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ],
					[ 'key' => 'field_home_dest_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
					[ 'key' => 'field_home_dest_sub', 'label' => 'Sub-text', 'name' => 'subtitle', 'type' => 'text' ],
				],
			],

			// ── Testimonials ──
			[ 'key' => 'field_home_tab_test', 'label' => 'Testimonials', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_test_eyebrow', 'label' => 'Eyebrow', 'name' => 'home_test_eyebrow', 'type' => 'text', 'default_value' => 'Trusted by Thousands' ],
			[ 'key' => 'field_home_test_heading', 'label' => 'Heading', 'name' => 'home_test_heading', 'type' => 'text', 'default_value' => 'What Our Patients Say' ],
			[ 'key' => 'field_home_test_intro', 'label' => 'Intro', 'name' => 'home_test_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Real experiences from real patients across our Hampshire locations.' ],
			[
				'key' => 'field_home_testimonials', 'label' => 'Testimonials', 'name' => 'home_testimonials', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Testimonial',
				'sub_fields' => [
					[ 'key' => 'field_home_test_initials', 'label' => 'Initials', 'name' => 'initials', 'type' => 'text' ],
					[ 'key' => 'field_home_test_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ],
					[ 'key' => 'field_home_test_loc', 'label' => 'Location', 'name' => 'location', 'type' => 'text' ],
					[ 'key' => 'field_home_test_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],
			[
				'key' => 'field_home_trust', 'label' => 'Trust Indicators', 'name' => 'home_trust', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Indicator',
				'sub_fields' => [
					[ 'key' => 'field_home_trust_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_home_trust_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],

			// ── Health Hub ──
			[ 'key' => 'field_home_tab_hub', 'label' => 'Health Hub', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_hub_eyebrow', 'label' => 'Eyebrow', 'name' => 'home_hub_eyebrow', 'type' => 'text', 'default_value' => 'Expert Advice' ],
			[ 'key' => 'field_home_hub_heading', 'label' => 'Heading (HTML)', 'name' => 'home_hub_heading', 'type' => 'text', 'default_value' => 'Latest from the <span class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Health Hub</span>' ],
			[
				'key' => 'field_home_articles', 'label' => 'Articles', 'name' => 'home_articles', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Article',
				'sub_fields' => [
					[ 'key' => 'field_home_art_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
					[ 'key' => 'field_home_art_cat', 'label' => 'Category', 'name' => 'category', 'type' => 'text' ],
					[ 'key' => 'field_home_art_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_home_art_excerpt', 'label' => 'Excerpt', 'name' => 'excerpt', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],

			// ── Popular Vaccines ──
			[ 'key' => 'field_home_tab_vac', 'label' => 'Popular Vaccines', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_vac_heading', 'label' => 'Heading', 'name' => 'home_vac_heading', 'type' => 'text', 'default_value' => 'Popular Vaccines' ],
			[ 'key' => 'field_home_vac_intro', 'label' => 'Intro', 'name' => 'home_vac_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Find out everything about these popular vaccines we can provide at Southdowns Pharmacy.' ],
			[
				'key' => 'field_home_vaccines', 'label' => 'Vaccines', 'name' => 'home_vaccines', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Vaccine',
				'sub_fields' => [
					[ 'key' => 'field_home_vac_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ],
					[ 'key' => 'field_home_vac_url', 'label' => 'Link', 'name' => 'url', 'type' => 'url' ],
				],
			],
			[ 'key' => 'field_home_vac_image', 'label' => 'Side Image', 'name' => 'home_vac_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],

			// ── Premium Products ──
			[ 'key' => 'field_home_tab_prod', 'label' => 'Premium Products', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_prod_eyebrow', 'label' => 'Eyebrow', 'name' => 'home_prod_eyebrow', 'type' => 'text', 'default_value' => 'Premium Collection' ],
			[ 'key' => 'field_home_prod_heading', 'label' => 'Heading', 'name' => 'home_prod_heading', 'type' => 'text', 'default_value' => 'Our Premium Products' ],
			[ 'key' => 'field_home_prod_intro', 'label' => 'Intro', 'name' => 'home_prod_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Discover our exclusive range of premium healthcare products, crafted with excellence.' ],
			[
				'key' => 'field_home_products', 'label' => 'Products', 'name' => 'home_products', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Product',
				'sub_fields' => [
					[ 'key' => 'field_home_prod_badge', 'label' => 'Badge', 'name' => 'badge', 'type' => 'text' ],
					[ 'key' => 'field_home_prod_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_home_prod_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
					[ 'key' => 'field_home_prod_url', 'label' => 'Link', 'name' => 'url', 'type' => 'url' ],
					[ 'key' => 'field_home_prod_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
				],
			],

			// ── Booking ──
			[ 'key' => 'field_home_tab_book', 'label' => 'Booking', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_home_book_eyebrow', 'label' => 'Eyebrow', 'name' => 'home_book_eyebrow', 'type' => 'text', 'default_value' => 'Book Online · Same-Day Availability' ],
			[ 'key' => 'field_home_book_heading', 'label' => 'Heading', 'name' => 'home_book_heading', 'type' => 'text', 'default_value' => 'Book Your Appointment' ],
			[ 'key' => 'field_home_book_intro', 'label' => 'Intro', 'name' => 'home_book_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Choose your location, service, and time. It only takes a minute.' ],

		] ),
	] );

} );

/**
 * Seed the Home Page repeaters with the current content (text only; images fall
 * back to the existing placeholders in the template).
 */
function home_repeater_defaults(): array {
	return [
		'home_treatments' => [
			[ 'title' => 'Weight Loss', 'url' => '', 'image' => false ],
			[ 'title' => 'Travel Health', 'url' => '', 'image' => false ],
			[ 'title' => 'Ear Wax Removal', 'url' => '', 'image' => false ],
		],
		'home_dest_stats' => [
			[ 'value' => '4', 'label' => 'Hampshire Locations' ],
			[ 'value' => '20+', 'label' => 'Vaccines Available' ],
			[ 'value' => 'Same', 'label' => 'Day Appointments' ],
			[ 'value' => '5★', 'label' => 'Rated Service' ],
		],
		'home_destinations' => [
			[ 'name' => 'Africa', 'image' => false, 'subtitle' => '5 recommended vaccines' ],
			[ 'name' => 'Australasia & Pacific', 'image' => false, 'subtitle' => '4 recommended vaccines' ],
			[ 'name' => 'Caribbean', 'image' => false, 'subtitle' => '4 recommended vaccines' ],
			[ 'name' => 'Central America', 'image' => false, 'subtitle' => '5 recommended vaccines' ],
			[ 'name' => 'Central Asia', 'image' => false, 'subtitle' => '7 recommended vaccines' ],
			[ 'name' => 'East Asia', 'image' => false, 'subtitle' => '6 recommended vaccines' ],
			[ 'name' => 'Europe & Russia', 'image' => false, 'subtitle' => '5 recommended vaccines' ],
			[ 'name' => 'Middle East', 'image' => false, 'subtitle' => '5 recommended vaccines' ],
			[ 'name' => 'North America', 'image' => false, 'subtitle' => '4 recommended vaccines' ],
			[ 'name' => 'South America & Antarctica', 'image' => false, 'subtitle' => '6 recommended vaccines' ],
		],
		'home_testimonials' => [
			[ 'initials' => 'SJ', 'name' => 'Sarah Johnson',    'location' => 'Emsworth Branch',          'quote' => '"Excellent service from start to finish. The pharmacist was incredibly knowledgeable about travel vaccines and made me feel completely at ease. Same day appointment was a lifesaver!"' ],
			[ 'initials' => 'MT', 'name' => 'Michael Thompson', 'location' => 'Rowlands Castle Branch',   'quote' => '"The weight loss programme has been life-changing. Professional, supportive, and results-driven. I\'ve lost 18kg in 4 months with their expert guidance."' ],
			[ 'initials' => 'EP', 'name' => 'Emma Patel',       'location' => 'Davies Pharmacy, Havant',  'quote' => '"Quick, efficient blood testing service. Results came back within 24 hours and the staff explained everything clearly. Highly recommend for anyone needing health checks."' ],
			[ 'initials' => 'DW', 'name' => 'David Williams',   'location' => 'Emsworth Branch',          'quote' => '"Fantastic ear wax removal service. Painless procedure and immediate relief. The practitioner was gentle and professional throughout. Worth every penny."' ],
			[ 'initials' => 'RC', 'name' => 'Rachel Chen',      'location' => 'Bosmere Pharmacy, Havant', 'quote' => '"As a frequent traveller, I rely on Southdowns for all my travel health needs. Yellow fever certification was processed immediately. Couldn\'t ask for better service."' ],
			[ 'initials' => 'JM', 'name' => 'James Mitchell',   'location' => 'Rowlands Castle Branch',   'quote' => '"The smoking cessation programme helped me quit after 15 years. Supportive team, effective treatment, and ongoing check-ins made all the difference. Smoke-free for 6 months now!"' ],
		],
		'home_trust' => [
			[ 'value' => '4.9/5', 'label' => 'Average Rating' ],
			[ 'value' => '400+', 'label' => '5-Star Reviews' ],
			[ 'value' => '10,000+', 'label' => 'Happy Patients' ],
		],
		'home_articles' => [
			[ 'image' => false, 'category' => 'Weight Loss', 'title' => 'Mounjaro vs Wegovy: What the Clinical Trials Actually Show', 'excerpt' => '"My GP mentioned Wegovy. But my friend lost loads of weight on Mounjaro. Are they the same thing? Should I ask for the other one?...' ],
			[ 'image' => false, 'category' => 'Weight Loss', 'title' => 'Mounjaro Side Effects: What to Expect at Your Monthly Review', 'excerpt' => "How Southdowns Pharmacy's face-to-face clinical support helps patients across Hampshire manage their weight loss journey with confidence..." ],
			[ 'image' => false, 'category' => 'Weight Loss', 'title' => "Why Most Hampshire Patients Wish They'd Started Mounjaro Sooner", 'excerpt' => 'The weight loss treatment that makes people say "I should have started this sooner" — now available across Hampshire...' ],
		],
		'home_vaccines' => [
			[ 'name' => 'Yellow Fever', 'url' => '' ],
			[ 'name' => 'Hepatitis A', 'url' => '' ],
			[ 'name' => 'Typhoid', 'url' => '' ],
			[ 'name' => 'Hepatitis B', 'url' => '' ],
			[ 'name' => 'Rabies', 'url' => '' ],
			[ 'name' => 'Cholera', 'url' => '' ],
			[ 'name' => 'Japanese Encephalitis', 'url' => '' ],
			[ 'name' => 'Meningitis (ACWY)', 'url' => '' ],
			[ 'name' => 'Tick Borne Encephalitis', 'url' => '' ],
			[ 'name' => 'Malaria Tablets', 'url' => '' ],
			[ 'name' => 'MMR (Measles, Mumps & Rubella)', 'url' => '' ],
			[ 'name' => 'Dengue Fever (Qdenga)', 'url' => '' ],
		],
		'home_products' => [
			[ 'badge' => 'PREMIUM',     'title' => 'Ear Wax Removal', 'desc' => 'Professional microsuction service for safe and effective ear cleaning', 'url' => '', 'image' => false ],
			[ 'badge' => 'BEST SELLER', 'title' => 'B12 Injections',  'desc' => 'Energy boost vitamin therapy to support your wellness journey',         'url' => '', 'image' => false ],
			[ 'badge' => 'EXCLUSIVE',   'title' => 'Travel Health',   'desc' => 'Complete vaccination packages for your next adventure',                 'url' => '', 'image' => false ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( home_repeater_defaults() ) as $field_name ) {
		add_filter( "acf/load_value/name={$field_name}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) {
				return $value;
			}
			$defaults = home_repeater_defaults();
			return $defaults[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
