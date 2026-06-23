<?php
/**
 * ACF Local Field Group — Travel Vaccine destination pages (shared).
 *
 * One field group serves all four near-identical destination templates:
 *   Cape Verde · India · Kenya · Thailand
 * Each PAGE stores its own values, so the client edits every country separately.
 *
 * Pre-fill: each field is seeded (via acf/load_value) from this file's
 * tv_defaults() keyed by the page's template — so the editor shows that
 * country's current content until the client overrides it.
 *
 * ⚠️ Most destination copy here is INTERIM placeholder content pending the
 * client's clinical brief, and prices are mostly "£TBC" (Thailand already had
 * real prices, preserved). Wiring it to ACF is what lets the client replace it
 * with reviewed content and real prices.
 *
 * Stays in code: SVG icons, category/timing colours (by index), branch cards
 * (sp_branch), and the booking links.
 */

/* ── Which templates this group targets, and their country key ── */
function tv_template_map(): array {
	return [
		'page-templates/page-cape-verde-travel-vaccines.php' => 'cape-verde',
		'page-templates/page-india-travel-vaccines.php'      => 'india',
		'page-templates/page-kenya-travel-vaccines.php'      => 'kenya',
		'page-templates/page-thailand-travel-vaccines.php'   => 'thailand',
	];
}

/* ── Resolve the current page's country dataset (used by the templates) ── */
function tv_data(): array {
	$slug = get_page_template_slug( get_the_ID() );
	$key  = tv_template_map()[ $slug ] ?? 'cape-verde';
	$all  = tv_defaults();
	return $all[ $key ] ?? reset( $all );
}

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$t  = fn( $key, $label, $name, $type = 'text', $extra = [] ) => array_merge( [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => $type ], $extra );
	$ta = [ 'rows' => 3, 'new_lines' => '' ];
	$rep = fn( $key, $label, $name, $subs, $btn = 'Add Row', $layout = 'table' ) => [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'repeater', 'layout' => $layout, 'button_label' => $btn, 'sub_fields' => $subs ];
	$sub = fn( $key, $label, $name, $type = 'text', $extra = [] ) => array_merge( [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => $type ], $extra );

	$location = [];
	foreach ( array_keys( tv_template_map() ) as $tpl ) {
		$location[] = [ [ 'param' => 'page_template', 'operator' => '==', 'value' => $tpl ] ];
	}

	acf_add_local_field_group( [
		'key' => 'group_travel_vaccines', 'title' => 'Travel Vaccines — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top',
		'location' => $location,
		'fields' => [
			// ── Hero ──
			[ 'key' => 'field_tv_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_hero_pill', 'Hero Pill', 'tv_hero_pill' ),
			$t( 'field_tv_hero_h1', 'Hero Heading', 'tv_hero_h1' ),
			$t( 'field_tv_hero_intro', 'Hero Intro', 'tv_hero_intro', 'textarea', $ta ),
			$t( 'field_tv_hero_btn1', 'Primary Button', 'tv_hero_btn1' ),
			$t( 'field_tv_hero_btn2', 'Secondary Button', 'tv_hero_btn2' ),
			$t( 'field_tv_hero_image', 'Hero Image', 'tv_hero_image', 'image', [ 'return_format' => 'url', 'preview_size' => 'medium' ] ),
			$rep( 'field_tv_hero_pills', 'Trust Pills', 'tv_hero_pills', [ $sub( 'field_tv_pill_text', 'Text', 'text' ) ], 'Add Pill' ),

			// ── Intro ──
			[ 'key' => 'field_tv_tab_intro', 'label' => 'Intro', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_intro_eyebrow', 'Eyebrow', 'tv_intro_eyebrow' ),
			$t( 'field_tv_intro_h2', 'Heading', 'tv_intro_h2' ),
			$t( 'field_tv_intro_p1', 'Paragraph 1', 'tv_intro_p1', 'textarea', $ta ),
			$t( 'field_tv_intro_p2', 'Paragraph 2', 'tv_intro_p2', 'textarea', $ta ),

			// ── Vaccines ──
			[ 'key' => 'field_tv_tab_vax', 'label' => 'Vaccines', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_vax_eyebrow', 'Eyebrow', 'tv_vax_eyebrow' ),
			$t( 'field_tv_vax_h2', 'Heading', 'tv_vax_h2' ),
			$t( 'field_tv_vax_intro', 'Intro', 'tv_vax_intro', 'textarea', $ta ),
			$rep( 'field_tv_vaccines', 'Vaccines', 'tv_vaccines', [
				$sub( 'field_tv_vax_cat', 'Category', 'category', 'text', [ 'instructions' => 'Groups the vaccine on the page. Use one of: Routine Vaccines, Recommended Vaccines, Required Vaccines, Entry Requirements, Antimalarial Protection.' ] ),
				$sub( 'field_tv_vax_name', 'Name', 'name' ),
				$sub( 'field_tv_vax_who', 'Who needs it', 'who', 'textarea', [ 'rows' => 2, 'new_lines' => '' ] ),
				$sub( 'field_tv_vax_doses', 'Doses', 'doses' ),
				$sub( 'field_tv_vax_desc', 'Description', 'desc', 'textarea', [ 'rows' => 3, 'new_lines' => '' ] ),
			], 'Add Vaccine', 'block' ),

			// ── Health Risks ──
			[ 'key' => 'field_tv_tab_risk', 'label' => 'Health Risks', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_risk_eyebrow', 'Eyebrow', 'tv_risk_eyebrow' ),
			$t( 'field_tv_risk_h2', 'Heading', 'tv_risk_h2' ),
			$t( 'field_tv_risk_intro', 'Intro', 'tv_risk_intro', 'textarea', $ta ),
			$rep( 'field_tv_risks', 'Risk Cards', 'tv_risks', [
				$sub( 'field_tv_risk_title', 'Title', 'title' ),
				$sub( 'field_tv_risk_desc', 'Description', 'desc', 'textarea', [ 'rows' => 3, 'new_lines' => '' ] ),
			], 'Add Risk', 'block' ),

			// ── Malaria ──
			[ 'key' => 'field_tv_tab_mal', 'label' => 'Malaria', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_mal_eyebrow', 'Eyebrow', 'tv_mal_eyebrow' ),
			$t( 'field_tv_mal_h2', 'Heading', 'tv_mal_h2' ),
			$t( 'field_tv_mal_intro', 'Intro', 'tv_mal_intro', 'textarea', $ta ),
			$rep( 'field_tv_malaria', 'Malaria Cards', 'tv_malaria', [
				$sub( 'field_tv_mal_title', 'Title', 'title' ),
				$sub( 'field_tv_mal_desc', 'Description', 'desc', 'textarea', [ 'rows' => 3, 'new_lines' => '' ] ),
			], 'Add Card', 'block' ),

			// ── How It Works ──
			[ 'key' => 'field_tv_tab_how', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_how_eyebrow', 'Eyebrow', 'tv_how_eyebrow' ),
			$t( 'field_tv_how_h2', 'Heading', 'tv_how_h2' ),
			$t( 'field_tv_how_intro', 'Intro', 'tv_how_intro', 'textarea', $ta ),
			$rep( 'field_tv_how_steps', 'Steps', 'tv_how_steps', [
				$sub( 'field_tv_how_title', 'Title', 'title' ),
				$sub( 'field_tv_how_desc', 'Description', 'desc', 'textarea', [ 'rows' => 3, 'new_lines' => '' ] ),
			], 'Add Step', 'block' ),

			// ── Timing ──
			[ 'key' => 'field_tv_tab_time', 'label' => 'Timing', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_time_eyebrow', 'Eyebrow', 'tv_time_eyebrow' ),
			$t( 'field_tv_time_h2', 'Heading', 'tv_time_h2' ),
			$t( 'field_tv_time_intro', 'Intro', 'tv_time_intro', 'textarea', $ta ),
			$rep( 'field_tv_timing', 'Timing Cards', 'tv_timing', [
				$sub( 'field_tv_time_tag', 'Tag', 'tag' ),
				$sub( 'field_tv_time_time', 'Time', 'time' ),
				$sub( 'field_tv_time_desc', 'Description', 'desc', 'textarea', [ 'rows' => 3, 'new_lines' => '' ] ),
			], 'Add Card', 'block' ),

			// ── Pricing ──
			[ 'key' => 'field_tv_tab_price', 'label' => 'Pricing', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_price_eyebrow', 'Eyebrow', 'tv_price_eyebrow' ),
			$t( 'field_tv_price_h2', 'Heading', 'tv_price_h2' ),
			$t( 'field_tv_price_intro', 'Intro', 'tv_price_intro', 'textarea', $ta ),
			$t( 'field_tv_pkg1_title', 'Package 1 Title', 'tv_pkg1_title' ),
			$t( 'field_tv_pkg1_price', 'Package 1 Price', 'tv_pkg1_price' ),
			$rep( 'field_tv_pkg1_items', 'Package 1 Items', 'tv_pkg1_items', [ $sub( 'field_tv_pkg1_item', 'Item', 'text' ) ], 'Add Item' ),
			$t( 'field_tv_pkg2_title', 'Package 2 Title', 'tv_pkg2_title' ),
			$t( 'field_tv_pkg2_price', 'Package 2 Price', 'tv_pkg2_price' ),
			$rep( 'field_tv_pkg2_items', 'Package 2 Items', 'tv_pkg2_items', [ $sub( 'field_tv_pkg2_item', 'Item', 'text' ) ], 'Add Item' ),
			$rep( 'field_tv_individual', 'Individual Prices', 'tv_individual', [
				$sub( 'field_tv_ind_name', 'Name', 'name' ),
				$sub( 'field_tv_ind_price', 'Price', 'price' ),
			], 'Add Line' ),
			$t( 'field_tv_price_info', 'Info Box', 'tv_price_info', 'textarea', $ta ),

			// ── Locations ──
			[ 'key' => 'field_tv_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_loc_eyebrow', 'Eyebrow', 'tv_loc_eyebrow' ),
			$t( 'field_tv_loc_h2', 'Heading', 'tv_loc_h2' ),
			$t( 'field_tv_loc_intro', 'Intro', 'tv_loc_intro', 'textarea', $ta ),
			$t( 'field_tv_loc_yf_note', 'Yellow Fever Note', 'tv_loc_yf_note', 'textarea', $ta ),
			$t( 'field_tv_loc_footer', 'Footer Line', 'tv_loc_footer', 'textarea', $ta ),

			// ── Why Us ──
			[ 'key' => 'field_tv_tab_why', 'label' => 'Why Us', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_why_eyebrow', 'Eyebrow', 'tv_why_eyebrow' ),
			$t( 'field_tv_why_h2', 'Heading', 'tv_why_h2' ),
			$rep( 'field_tv_why', 'Feature Cards', 'tv_why', [
				$sub( 'field_tv_why_title', 'Title', 'title' ),
				$sub( 'field_tv_why_desc', 'Description', 'desc', 'textarea', [ 'rows' => 3, 'new_lines' => '' ] ),
			], 'Add Feature', 'block' ),

			// ── FAQ ──
			[ 'key' => 'field_tv_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			$t( 'field_tv_faq_eyebrow', 'Eyebrow', 'tv_faq_eyebrow' ),
			$t( 'field_tv_faq_h2', 'Heading', 'tv_faq_h2' ),
			$t( 'field_tv_faq_intro', 'Intro', 'tv_faq_intro', 'textarea', $ta ),
			$rep( 'field_tv_faqs', 'FAQ Items', 'tv_faqs', [
				$sub( 'field_tv_faq_q', 'Question', 'question' ),
				$sub( 'field_tv_faq_a', 'Answer', 'answer', 'textarea', [ 'rows' => 4, 'new_lines' => '' ] ),
			], 'Add FAQ', 'block' ),

			// ── Final CTA ──
			[ 'key' => 'field_tv_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
			$rep( 'field_tv_cta_badges', 'Trust Badges', 'tv_cta_badges', [ $sub( 'field_tv_cta_badge', 'Text', 'text' ) ], 'Add Badge' ),
			$t( 'field_tv_cta_h2', 'Heading', 'tv_cta_h2', 'textarea', $ta ),
			$t( 'field_tv_cta_intro', 'Intro', 'tv_cta_intro', 'textarea', $ta ),
			$t( 'field_tv_cta_btn1', 'Primary Button', 'tv_cta_btn1' ),
			$t( 'field_tv_cta_btn2', 'Secondary Button', 'tv_cta_btn2' ),
			$rep( 'field_tv_trust', 'Trust Stats', 'tv_trust', [
				$sub( 'field_tv_trust_value', 'Value', 'value' ),
				$sub( 'field_tv_trust_label', 'Label', 'label' ),
			], 'Add Stat' ),
			$t( 'field_tv_disclaimer', 'Medical Disclaimer', 'tv_disclaimer', 'textarea', [ 'rows' => 4, 'new_lines' => '' ] ),
		],
	] );
} );

/* ── Per-country pre-fill seeding (editor + front-end) ── */
add_action( 'acf/init', function () {
	$names = [
		'tv_hero_pill','tv_hero_h1','tv_hero_intro','tv_hero_btn1','tv_hero_btn2','tv_hero_pills',
		'tv_intro_eyebrow','tv_intro_h2','tv_intro_p1','tv_intro_p2',
		'tv_vax_eyebrow','tv_vax_h2','tv_vax_intro','tv_vaccines',
		'tv_risk_eyebrow','tv_risk_h2','tv_risk_intro','tv_risks',
		'tv_mal_eyebrow','tv_mal_h2','tv_mal_intro','tv_malaria',
		'tv_how_eyebrow','tv_how_h2','tv_how_intro','tv_how_steps',
		'tv_time_eyebrow','tv_time_h2','tv_time_intro','tv_timing',
		'tv_price_eyebrow','tv_price_h2','tv_price_intro','tv_pkg1_title','tv_pkg1_price','tv_pkg1_items','tv_pkg2_title','tv_pkg2_price','tv_pkg2_items','tv_individual','tv_price_info',
		'tv_loc_eyebrow','tv_loc_h2','tv_loc_intro','tv_loc_yf_note','tv_loc_footer',
		'tv_why_eyebrow','tv_why_h2','tv_why',
		'tv_faq_eyebrow','tv_faq_h2','tv_faq_intro','tv_faqs',
		'tv_cta_badges','tv_cta_h2','tv_cta_intro','tv_cta_btn1','tv_cta_btn2','tv_trust','tv_disclaimer',
	];
	foreach ( $names as $n ) {
		add_filter( 'acf/load_value/name=' . $n, function ( $value, $post_id, $field ) {
			$empty = ( $value === null || $value === '' || $value === false || ( is_array( $value ) && empty( $value ) ) );
			if ( ! $empty ) return $value;
			$slug = get_page_template_slug( $post_id );
			$key  = tv_template_map()[ $slug ] ?? 'cape-verde';
			$all  = tv_defaults();
			return $all[ $key ][ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );

/* ════════════════════════════════════════════════════════════════
 * Per-country default content (interim placeholder — see header note).
 * Keys match ACF field names exactly so load_value can seed them.
 * ════════════════════════════════════════════════════════════════ */
function tv_defaults(): array {
	return [
		'cape-verde' => [
			'tv_hero_pill'  => 'Cape Verde Travel Health &middot; Hampshire',
			'tv_hero_h1'    => 'Cape Verde Travel Vaccinations in Hampshire',
			'tv_hero_intro' => 'Expert travel health advice and all essential vaccines for your Cape Verde trip. Same-day appointments available across all four of our Hampshire locations &mdash; no waiting lists, no delays.',
			'tv_hero_btn1'  => 'Book Cape Verde Travel Consultation',
			'tv_hero_btn2'  => 'Check What Vaccines You Need',
			'tv_hero_pills' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => 'Expert Pharmacist Advice' ], [ 'text' => '4 Hampshire Locations' ] ],
			'tv_hero_image' => 'https://images.unsplash.com/photo-1528181304800-259b08848526?w=1200&q=80&auto=format&fit=crop',
			'tv_intro_eyebrow' => 'Travel Health Advice',
			'tv_intro_h2'   => 'Essential Vaccinations for Cape Verde Travel',
			'tv_intro_p1'   => 'Planning a trip to Cape Verde from Hampshire? Our travel clinics across Emsworth, Havant and Rowlands Castle provide comprehensive vaccination services and expert travel health advice for Cape Verde travellers.',
			'tv_intro_p2'   => "Whether you're relaxing on the beaches of Sal and Boa Vista, exploring the mountains of Santo Antão, or visiting the islands of São Vicente and Santiago, we'll help ensure you're properly protected with the right vaccines and travel health advice. Our GPhC-registered pharmacists assess your specific itinerary and medical history to create a personalised vaccination plan tailored to your trip.",
			'tv_vax_eyebrow' => 'Vaccination Guide',
			'tv_vax_h2'     => 'Recommended Vaccines for Cape Verde',
			'tv_vax_intro'  => 'Our pharmacists will confirm exactly which vaccines you need based on your itinerary, activities and medical history.',
			'tv_vaccines'   => [
				[ 'category' => 'Routine Vaccines', 'name' => 'Hepatitis A', 'who' => 'All travellers', 'doses' => '1 dose (booster at 6&ndash;12 months)', 'desc' => 'Recommended for most travellers to Cape Verde. Spread through contaminated food and water, Hepatitis A can occur where sanitation standards vary, and a single dose provides long-term protection.' ],
				[ 'category' => 'Routine Vaccines', 'name' => 'Typhoid', 'who' => 'Travellers staying with friends or family, or visiting where sanitation may be limited', 'doses' => '1 dose', 'desc' => 'Spread through contaminated food and water. Vaccination may be advised depending on your accommodation, planned activities and the length of your stay. Our pharmacists will confirm whether it is recommended for your trip.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Hepatitis B', 'who' => 'Long stays, adventure travellers', 'doses' => '3 doses over 21 days (accelerated course available)', 'desc' => 'May be recommended for longer stays or if you could be exposed to blood or body fluids. Worth discussing with our pharmacists if you plan adventurous activities or an extended trip.' ],
				[ 'category' => 'Required Vaccines', 'name' => 'Yellow Fever (Conditional &mdash; Certificate May Be Required)', 'who' => 'Travellers arriving from a country with risk of Yellow Fever transmission', 'doses' => '1 dose (lifetime immunity)', 'desc' => 'Yellow Fever is not present in Cape Verde, but a valid ICVP certificate may be required if you are arriving from, or have recently travelled through, a country with risk of Yellow Fever transmission. Our pharmacists will check your full itinerary and advise whether vaccination and a certificate are needed for your trip.' ],
			],
			'tv_risk_eyebrow' => 'Risk Awareness',
			'tv_risk_h2'    => 'Health Risks When Travelling to Cape Verde',
			'tv_risk_intro' => 'Understanding potential health risks helps you prepare properly. Our pharmacists will assess your specific itinerary and activities to provide tailored advice.',
			'tv_risks'      => [
				[ 'title' => 'Mosquito-Borne Illness', 'desc' => 'Mosquito-borne illnesses such as dengue can occur in Cape Verde, particularly during and after the rainy season. Using DEET-based repellents, covering exposed skin and sleeping in screened or air-conditioned rooms are sensible precautions. Our pharmacists can advise on bite avoidance for your trip.' ],
				[ 'title' => 'Food &amp; Water Safety', 'desc' => "Travellers' diarrhoea can affect visitors to Cape Verde. Drinking bottled or treated water, being cautious with ice, and choosing freshly prepared food are good general precautions. Hepatitis A and typhoid can be linked to contaminated food and water, which is why vaccination may be recommended before your trip." ],
				[ 'title' => 'Sun &amp; Heat', 'desc' => 'Cape Verde has a warm, sunny climate year-round. Heat-related illness, dehydration and sunburn are common, avoidable risks. Use high-factor sun protection, drink plenty of water, and take care during the hottest part of the day, particularly if you are active outdoors.' ],
				[ 'title' => 'General Travel Health', 'desc' => 'As with any trip, it is sensible to carry a basic first-aid kit, ensure you have adequate travel insurance, and bring enough of any regular medication. Our pharmacists can review your routine vaccinations and offer practical advice to help you stay well throughout your stay.' ],
			],
			'tv_mal_eyebrow' => 'Malaria Risk',
			'tv_mal_h2'     => 'Malaria Risk in Cape Verde',
			'tv_mal_intro'  => 'Good news for travellers: Cape Verde is considered a very low-risk destination for malaria. The World Health Organization certified Cape Verde as malaria-free in 2024, so antimalarial tablets are not routinely needed for a typical trip.',
			'tv_malaria'    => [
				[ 'title' => 'A Malaria-Free Destination', 'desc' => 'Cape Verde was certified malaria-free by the World Health Organization in 2024. For most travellers, malaria is not a routine concern and antimalarial medication is generally not required for a standard trip.' ],
				[ 'title' => 'Personalised Advice', 'desc' => 'If your wider itinerary includes other destinations, or if you have particular health concerns, our pharmacists will review your full travel plans and give clear, personalised advice on whether any antimalarial precautions are needed.' ],
				[ 'title' => 'Sensible Bite Prevention', 'desc' => 'Even where malaria is not a concern, avoiding mosquito bites remains sensible to reduce the risk of other mosquito-borne illnesses. Use insect repellent, cover exposed skin in the evening, and sleep in screened or air-conditioned rooms where possible.' ],
			],
			'tv_how_eyebrow' => 'Three-Step Process',
			'tv_how_h2'     => 'How to Get Your Cape Verde Travel Vaccinations at Southdowns Pharmacy',
			'tv_how_intro'  => 'Three simple steps from booking to being fully protected.',
			'tv_how_steps'  => [
				[ 'title' => 'Book Your Consultation', 'desc' => 'Visit any of our four Hampshire locations during opening hours or book online. Walk-ins are welcome. We serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, and Chichester.' ],
				[ 'title' => 'Expert Travel Health Assessment', 'desc' => "Our GPhC-registered pharmacists will review your full itinerary, medical history, and planned activities to provide personalised Cape Verde travel health advice. We'll identify exactly which vaccines you need &mdash; and just as importantly, which ones you don't." ],
				[ 'title' => 'Same-Day Vaccination', 'desc' => 'Receive your vaccines immediately at the same appointment. We stock recommended Cape Verde travel vaccinations across all four branches and can complete your course before departure. No waiting lists, no delays.' ],
			],
			'tv_time_eyebrow' => 'Timing Guide',
			'tv_time_h2'    => 'When to Get Your Cape Verde Travel Vaccinations',
			'tv_time_intro' => "Ideally, book 6&ndash;8 weeks before departure &mdash; but don't worry if your trip is sooner. We accommodate last-minute travellers with same-day appointments and can provide immediate protection for most vaccines.",
			'tv_timing'     => [
				[ 'tag' => 'Ideal', 'time' => '6–8 Weeks Before', 'desc' => 'Best timing for multi-dose vaccines such as Hepatitis B. Allows your immune system to develop full protection before departure and leaves time to complete any course.' ],
				[ 'tag' => 'Good', 'time' => '2–4 Weeks Before', 'desc' => 'Still time for single-dose vaccines including Hepatitis A and Typhoid, plus accelerated courses where available. First doses of multi-dose courses can begin.' ],
				[ 'tag' => 'Last Minute', 'time' => 'Days Before Departure', 'desc' => "Don't skip it &mdash; some protection is always better than none. Hepatitis A and Typhoid can be given same-day. Come in even if you're leaving within days." ],
			],
			'tv_price_eyebrow' => 'Transparent Pricing',
			'tv_price_h2'   => 'Cape Verde Travel Vaccination Pricing',
			'tv_price_intro' => 'Transparent pricing with no hidden consultation fees. All prices include expert pharmacist assessment and vaccine administration.',
			'tv_pkg1_title' => 'Essential Cape Verde Package',
			'tv_pkg1_price' => '£TBC',
			'tv_pkg1_items' => [ [ 'text' => 'Hepatitis A vaccination' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Personalised travel advice' ] ],
			'tv_pkg2_title' => 'Comprehensive Cape Verde Package',
			'tv_pkg2_price' => '£TBC',
			'tv_pkg2_items' => [ [ 'text' => 'Hepatitis A &amp; B vaccinations' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Personalised travel advice' ] ],
			'tv_individual' => [
				[ 'name' => 'Hepatitis A', 'price' => '£TBC' ],
				[ 'name' => 'Hepatitis B (per dose)', 'price' => '£TBC' ],
				[ 'name' => 'Typhoid', 'price' => '£TBC' ],
				[ 'name' => 'Yellow Fever (Bosmere, Havant only)', 'price' => '£TBC' ],
				[ 'name' => 'Travel Health Consultation', 'price' => '£TBC' ],
			],
			'tv_price_info' => '<strong>Prices confirmed at consultation.</strong> All prices include expert pharmacist consultation and vaccine administration. No hidden fees.',
			'tv_loc_eyebrow' => 'Find Us',
			'tv_loc_h2'     => 'Book at Your Nearest Hampshire Travel Clinic',
			'tv_loc_intro'  => 'Cape Verde travel vaccinations available at all four Southdowns Pharmacy locations. Same-day appointments subject to availability. Free parking at all branches.',
			'tv_loc_yf_note' => 'Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.',
			'tv_loc_footer' => 'Conveniently located to serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, Petersfield, and Chichester.',
			'tv_why_eyebrow' => 'Our Promise',
			'tv_why_h2'     => 'Why Choose Southdowns Pharmacy for Your Cape Verde Travel Vaccinations?',
			'tv_why'        => [
				[ 'title' => 'Expert GPhC-Registered Pharmacists', 'desc' => 'Qualified specialists in travel health providing evidence-based, personalised vaccination advice for every itinerary.' ],
				[ 'title' => 'Recommended Cape Verde Vaccines in Stock', 'desc' => 'No ordering delays — we carry the recommended vaccines for Cape Verde travel across all four Hampshire branches.' ],
				[ 'title' => 'Same-Day Appointments', 'desc' => 'Walk in or book ahead — no waiting weeks for your travel vaccination appointment.' ],
				[ 'title' => 'NaTHNaC Registered Yellow Fever Centre', 'desc' => 'Our Bosmere Pharmacy, Havant branch is an officially designated Yellow Fever Vaccination Centre, authorised to issue valid ICVP certificates.' ],
				[ 'title' => 'Four Hampshire Locations', 'desc' => 'Serving Portsmouth, Southsea, Waterlooville, Havant, and wider Hampshire. Free parking at all sites.' ],
				[ 'title' => 'Family-Friendly Consultations', 'desc' => 'Child-safe dosing expertise and a welcoming environment for families travelling to Cape Verde with children of all ages.' ],
			],
			'tv_faq_eyebrow' => 'Common Questions',
			'tv_faq_h2'     => 'Frequently Asked Questions',
			'tv_faq_intro'  => 'Everything you need to know about Cape Verde travel vaccinations at Southdowns Pharmacy.',
			'tv_faqs'       => [
				[ 'question' => 'Which vaccines do I need for Cape Verde?', 'answer' => 'The vaccines you need depend on your itinerary, activities, and medical history. For most travellers, Hepatitis A is commonly recommended, with Typhoid and Hepatitis B advised in some circumstances. It is also a good idea to ensure your routine UK vaccinations are up to date. Our pharmacists will provide a personalised recommendation at your consultation.' ],
				[ 'question' => 'Do I need a Yellow Fever certificate for Cape Verde?', 'answer' => 'Yellow Fever is not present in Cape Verde. However, a valid ICVP certificate may be required if you are arriving from, or have recently travelled through, a country with risk of Yellow Fever transmission. Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only. Our pharmacists will check your full itinerary during consultation.' ],
				[ 'question' => 'Is malaria a risk in Cape Verde?', 'answer' => 'Cape Verde is considered a very low-risk destination for malaria and was certified malaria-free by the World Health Organization in 2024. Antimalarial tablets are not routinely needed for a standard trip. Our pharmacists will review your full travel plans and give clear advice if any precautions are relevant to you.' ],
				[ 'question' => 'How far in advance should I book?', 'answer' => 'Ideally 6–8 weeks before departure, to allow time for any multi-dose courses to be completed. However, we welcome last-minute travellers — many vaccines can be given on the same day, and some protection is always better than none.' ],
				[ 'question' => 'Can my whole family get vaccinated together?', 'answer' => 'Yes. We welcome families and can vaccinate adults and children at the same appointment. Our pharmacists have expertise in child-safe dosing and will advise on age-appropriate vaccines for younger travellers.' ],
				[ 'question' => 'Do you stock Cape Verde travel vaccines?', 'answer' => 'Yes. We stock the recommended Cape Verde travel vaccines across all four Hampshire branches, including Hepatitis A, Hepatitis B and Typhoid. Yellow Fever vaccination, where required, is available at our Bosmere Pharmacy, Havant branch only.' ],
				[ 'question' => 'Where can I get a Yellow Fever vaccination?', 'answer' => 'Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only, which is a NaTHNaC registered Yellow Fever Vaccination Centre. If your itinerary means a Yellow Fever certificate could be required, please book at our Bosmere branch.' ],
				[ 'question' => 'How long does the travel health consultation take?', 'answer' => 'Most consultations take 20–30 minutes including vaccination. If you are having multiple vaccines, allow a little longer. Same-day vaccination is available at all four branches.' ],
			],
			'tv_cta_badges' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'Recommended Vaccines in Stock' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => 'NaTHNaC Yellow Fever Centre' ] ],
			'tv_cta_h2'     => 'Travelling to Cape Verde?<br>Get Protected Before You Go.',
			'tv_cta_intro'  => 'Book your Cape Verde travel vaccination consultation at any of our four Hampshire locations. Expert advice, recommended vaccines in stock, same-day appointments available.',
			'tv_cta_btn1'   => 'Book Cape Verde Travel Consultation',
			'tv_cta_btn2'   => 'Find Your Nearest Branch',
			'tv_trust'      => [
				[ 'value' => 'Expert', 'label' => 'Travel Health Advice' ],
				[ 'value' => 'Same-Day', 'label' => 'Appointments' ],
				[ 'value' => 'GPhC', 'label' => 'Registered Pharmacists' ],
				[ 'value' => '4', 'label' => 'Hampshire Locations' ],
			],
			'tv_disclaimer' => 'Travel health recommendations for Cape Verde are based on current NaTHNaC, WHO, and MHRA guidance and are accurate as of May 2026. Requirements and recommendations may change &mdash; always consult the latest NaTHNaC or Foreign, Commonwealth &amp; Development Office guidance before travel. Vaccine suitability is assessed on an individual basis by our GPhC-registered pharmacists at the time of consultation.',
		],

		'india' => [
			'tv_hero_pill'  => 'India Travel Health &middot; Hampshire',
			'tv_hero_h1'    => 'India Travel Vaccinations in Hampshire',
			'tv_hero_intro' => 'Expert travel health advice and all essential vaccines for your India trip. Same-day appointments available across all four of our Hampshire locations &mdash; no waiting lists, no delays.',
			'tv_hero_btn1'  => 'Book India Travel Consultation',
			'tv_hero_btn2'  => 'Check What Vaccines You Need',
			'tv_hero_pills' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => 'Expert Pharmacist Advice' ], [ 'text' => '4 Hampshire Locations' ] ],
			'tv_hero_image' => 'https://images.unsplash.com/photo-1564507592333-c60657eea523?w=1200&q=80&auto=format&fit=crop',
			'tv_intro_eyebrow' => 'Travel Health Advice',
			'tv_intro_h2'   => 'Essential Vaccinations for India Travel',
			'tv_intro_p1'   => 'Planning a trip to India from Hampshire? Our travel clinics across Emsworth, Havant and Rowlands Castle provide comprehensive vaccination services and expert travel health advice for India travellers.',
			'tv_intro_p2'   => "Whether you're visiting Delhi, Mumbai, Goa, Rajasthan, or exploring rural India, we'll ensure you're fully protected with the right vaccines and antimalarial medication. Our GPhC-registered pharmacists assess your specific itinerary and medical history to create a personalised vaccination plan tailored to your trip.",
			'tv_vax_eyebrow' => 'Vaccination Guide',
			'tv_vax_h2'     => 'Recommended Vaccines for India',
			'tv_vax_intro'  => 'Our pharmacists will confirm exactly which vaccines you need based on your itinerary, activities and medical history.',
			'tv_vaccines'   => [
				[ 'category' => 'Routine Vaccines', 'name' => 'MMR (Measles, Mumps, Rubella)', 'who' => 'All travellers', 'doses' => '2 doses if not previously vaccinated', 'desc' => 'Essential routine vaccine protecting against three serious viral infections. Most UK adults received this as children &mdash; check your records before travelling.' ],
				[ 'category' => 'Routine Vaccines', 'name' => 'DTP Booster (Diphtheria, Tetanus, Polio)', 'who' => 'All travellers', 'doses' => '1 booster dose', 'desc' => 'A combined booster vaccine recommended every 10 years for travellers. Protects against three potentially fatal diseases.' ],
				[ 'category' => 'Routine Vaccines', 'name' => 'Hepatitis A', 'who' => 'All travellers', 'doses' => '1 dose (booster at 6&ndash;12 months)', 'desc' => 'Highly recommended for all India travellers. Spread through contaminated food and water, Hepatitis A is common throughout the Indian subcontinent and provides long-term immunity from a single dose.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Typhoid', 'who' => 'All travellers, especially street food lovers', 'doses' => '1 dose', 'desc' => 'Common in areas with poor sanitation. Spread through contaminated food and water &mdash; recommended for most India travellers, particularly if you plan to eat street food or travel outside major cities.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Hepatitis B', 'who' => 'Long stays, adventure travellers', 'doses' => '3 doses over 21 days (accelerated course available)', 'desc' => 'Recommended for longer stays or if you may be exposed to blood or body fluids. Particularly important for adventure travellers and those visiting rural areas.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Japanese Encephalitis', 'who' => 'Rural travellers, long stays', 'doses' => '2 doses, 28 days apart', 'desc' => 'May be recommended if visiting rural areas, especially rice-growing regions, or staying for extended periods. Spread by mosquitoes and can cause serious neurological illness.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Rabies', 'who' => 'Adventure travellers, those with likely animal contact', 'doses' => '3 doses over 21&ndash;28 days', 'desc' => 'Strongly recommended for adventure travellers, cyclists, and those visiting remote areas. Stray dogs and monkeys are common throughout India and rabies is present. Fatal once symptoms appear &mdash; pre-exposure vaccination is advised.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Cholera', 'who' => 'Travellers to areas with poor sanitation, aid and relief workers', 'doses' => '2 oral doses, 1&ndash;6 weeks apart', 'desc' => 'May be considered for travellers visiting areas with limited access to safe water and sanitation, or those undertaking aid and relief work. Spread through contaminated food and water. Our pharmacists will advise whether it is appropriate for your trip.' ],
				[ 'category' => 'Entry Requirements', 'name' => 'Yellow Fever (Certificate Note)', 'who' => 'Travellers arriving from countries with Yellow Fever risk', 'doses' => 'Not routinely recommended for India travel', 'desc' => 'India only requires proof of Yellow Fever vaccination if you are arriving from, or have recently transited through, a country with risk of Yellow Fever transmission. It is not a routine vaccine for travel to India itself. If your itinerary includes such a country, a valid ICVP certificate may be needed &mdash; our pharmacists will check your full route during consultation. Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.' ],
			],
			'tv_risk_eyebrow' => 'Risk Awareness',
			'tv_risk_h2'    => 'Health Risks When Travelling to India',
			'tv_risk_intro' => 'Understanding potential health risks helps you prepare properly. Our pharmacists will assess your specific itinerary and activities to provide tailored advice.',
			'tv_risks'      => [
				[ 'title' => 'Mosquito-Borne Diseases', 'desc' => 'Dengue fever occurs across many parts of India, including urban areas, and chikungunya is also present. Malaria is a risk in many regions. Use DEET-based repellents and cover up during peak biting times. Note that dengue-carrying mosquitoes bite during the day as well as at dusk, while malaria-carrying mosquitoes typically bite at night.' ],
				[ 'title' => 'Food &amp; Water Safety', 'desc' => "Travellers' diarrhoea is very common in India. Drink bottled or properly treated water only, avoid ice from unknown sources, and be cautious with food &mdash; choose freshly prepared, thoroughly cooked dishes where possible. Typhoid and Hepatitis A are real risks from contaminated food and water, making vaccination an important precaution before your trip." ],
				[ 'title' => 'Air Quality &amp; Altitude', 'desc' => 'Air pollution can be significant in larger Indian cities, particularly during winter months, and may affect travellers with asthma or other respiratory conditions. If your itinerary includes Himalayan regions such as Ladakh, be aware of altitude sickness and allow time to acclimatise. Our pharmacists can advise on sensible precautions.' ],
				[ 'title' => 'Rabies from Animal Bites', 'desc' => 'Stray dogs and monkeys are common throughout India, including in tourist areas and around temples. Rabies is fatal once symptoms appear &mdash; pre-exposure vaccination is worth considering, particularly for adventure travellers, cyclists, and families travelling with young children who may approach animals. Avoid contact with animals and seek prompt medical care after any bite or scratch.' ],
			],
			'tv_mal_eyebrow' => 'Antimalarial Protection',
			'tv_mal_h2'     => 'Malaria Prevention for India',
			'tv_mal_intro'  => 'India has malaria risk in many regions, and the level of risk varies by area and by season. Our pharmacists will assess your specific itinerary and recommend the right protection for your trip.',
			'tv_malaria'    => [
				[ 'title' => 'Risk Varies by Region & Season', 'desc' => 'Malaria risk in India varies considerably from place to place and changes through the year, generally being higher during and after the monsoon season. Many lower-lying and rural areas carry a greater risk, while some higher-altitude regions and certain destinations have little or none. Because this picture is complex, our pharmacists will check your exact itinerary and travel dates against current guidance.' ],
				[ 'title' => 'Antimalarial Options', 'desc' => 'Where antimalarial tablets are advised, options include Malarone (atovaquone/proguanil), Doxycycline, and Mefloquine. Our pharmacists will recommend the most suitable choice based on your health, activities, and duration of stay, and explain how and when to take it. Antimalarial medication is available across all four Hampshire branches.' ],
				[ 'title' => 'Bite Avoidance', 'desc' => 'Avoiding mosquito bites is an essential part of malaria prevention. Use DEET-based insect repellent on exposed skin, wear long sleeves and trousers, especially after dark, and sleep under an insecticide-treated mosquito net or in screened, air-conditioned rooms where possible. We stock DEET repellents at all four branches.' ],
			],
			'tv_how_eyebrow' => 'Three-Step Process',
			'tv_how_h2'     => 'How to Get Your India Travel Vaccinations at Southdowns Pharmacy',
			'tv_how_intro'  => 'Three simple steps from booking to being fully protected.',
			'tv_how_steps'  => [
				[ 'title' => 'Book Your Consultation', 'desc' => 'Visit any of our four Hampshire locations during opening hours or book online. Walk-ins are welcome. We serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, and Chichester.' ],
				[ 'title' => 'Expert Travel Health Assessment', 'desc' => "Our GPhC-registered pharmacists will review your full itinerary, medical history, and planned activities to provide personalised India travel health advice. We'll identify exactly which vaccines and medications you need &mdash; and just as importantly, which ones you don't." ],
				[ 'title' => 'Same-Day Vaccination', 'desc' => 'Receive your vaccines immediately at the same appointment. We stock all recommended India travel vaccinations across all four branches and can complete your course before departure. No waiting lists, no delays.' ],
			],
			'tv_time_eyebrow' => 'Timing Guide',
			'tv_time_h2'    => 'When to Get Your India Travel Vaccinations',
			'tv_time_intro' => "Ideally, book 6&ndash;8 weeks before departure &mdash; but don't worry if your trip is sooner. We accommodate last-minute travellers with same-day appointments and can provide immediate protection for most vaccines.",
			'tv_timing'     => [
				[ 'tag' => 'Ideal', 'time' => '6–8 Weeks Before', 'desc' => 'Best timing for multi-dose vaccines like Hepatitis B, Japanese Encephalitis, and Rabies. Allows your immune system to develop full protection before departure.' ],
				[ 'tag' => 'Good', 'time' => '2–4 Weeks Before', 'desc' => 'Still time for single-dose vaccines including Hepatitis A and Typhoid, plus accelerated courses. Antimalarial medication can be prescribed. First doses of multi-dose courses can begin.' ],
				[ 'tag' => 'Last Minute', 'time' => 'Days Before Departure', 'desc' => "Don't skip it &mdash; some protection is always better than none. Hepatitis A and Typhoid can be given same-day. Antimalarial tablets are available immediately. Come in even if you're leaving within days." ],
			],
			'tv_price_eyebrow' => 'Transparent Pricing',
			'tv_price_h2'   => 'India Travel Vaccination Pricing',
			'tv_price_intro' => 'Transparent pricing with no hidden consultation fees. All prices include expert pharmacist assessment and vaccine administration.',
			'tv_pkg1_title' => 'Essential India Package',
			'tv_pkg1_price' => '£TBC',
			'tv_pkg1_items' => [ [ 'text' => 'Hepatitis A vaccination' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Personalised travel advice' ] ],
			'tv_pkg2_title' => 'Comprehensive India Package',
			'tv_pkg2_price' => '£TBC',
			'tv_pkg2_items' => [ [ 'text' => 'Hepatitis A &amp; B vaccinations' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Japanese Encephalitis (2 doses)' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Antimalarial assessment' ] ],
			'tv_individual' => [
				[ 'name' => 'Hepatitis A', 'price' => '£TBC' ],
				[ 'name' => 'Hepatitis B (per dose)', 'price' => '£TBC' ],
				[ 'name' => 'Typhoid', 'price' => '£TBC' ],
				[ 'name' => 'Japanese Encephalitis (per dose)', 'price' => '£TBC' ],
				[ 'name' => 'Rabies (per dose)', 'price' => '£TBC' ],
				[ 'name' => 'Cholera (oral course)', 'price' => '£TBC' ],
				[ 'name' => 'DTP Booster', 'price' => '£TBC' ],
				[ 'name' => 'Antimalarial Tablets', 'price' => '£TBC' ],
			],
			'tv_price_info' => '<strong>Prices confirmed at consultation.</strong> All prices include expert pharmacist consultation and vaccine administration. No hidden fees.',
			'tv_loc_eyebrow' => 'Find Us',
			'tv_loc_h2'     => 'Book at Your Nearest Hampshire Travel Clinic',
			'tv_loc_intro'  => 'India travel vaccinations available at all four Southdowns Pharmacy locations. Same-day appointments subject to availability. Free parking at all branches.',
			'tv_loc_yf_note' => 'Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.',
			'tv_loc_footer' => 'Conveniently located to serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, Petersfield, and Chichester.',
			'tv_why_eyebrow' => 'Our Promise',
			'tv_why_h2'     => 'Why Choose Southdowns Pharmacy for Your India Travel Vaccinations?',
			'tv_why'        => [
				[ 'title' => 'Expert GPhC-Registered Pharmacists', 'desc' => 'Qualified specialists in travel health providing evidence-based, personalised vaccination advice for every itinerary.' ],
				[ 'title' => 'All India Vaccines in Stock', 'desc' => 'No ordering delays — we carry every recommended vaccine for India travel across all four Hampshire branches.' ],
				[ 'title' => 'Same-Day Appointments', 'desc' => 'Walk in or book ahead — no waiting weeks for your travel vaccination appointment.' ],
				[ 'title' => 'Antimalarial Advice & Tablets', 'desc' => 'Tailored malaria risk assessment and antimalarial tablets prescribed and dispensed at the same appointment.' ],
				[ 'title' => 'Four Hampshire Locations', 'desc' => 'Serving Portsmouth, Southsea, Waterlooville, Havant, and wider Hampshire. Free parking at all sites.' ],
				[ 'title' => 'Family-Friendly Consultations', 'desc' => 'Child-safe dosing expertise and a welcoming environment for families travelling to India with children of all ages.' ],
			],
			'tv_faq_eyebrow' => 'Common Questions',
			'tv_faq_h2'     => 'Frequently Asked Questions',
			'tv_faq_intro'  => 'Everything you need to know about India travel vaccinations at Southdowns Pharmacy.',
			'tv_faqs'       => [
				[ 'question' => 'Which vaccines do I need for India?', 'answer' => 'The vaccines you need depend on your itinerary, activities, and medical history. At minimum, most travellers should ensure their Hepatitis A, Typhoid, and routine vaccines (MMR, DTP) are up to date. Hepatitis B, Japanese Encephalitis, Rabies, and Cholera may be recommended depending on your plans. Our pharmacists will provide a personalised recommendation at your consultation.' ],
				[ 'question' => 'Do I need a Yellow Fever certificate for India?', 'answer' => 'Yellow Fever vaccination is not routinely recommended for travel to India. However, India does require proof of vaccination if you are arriving from, or have recently transited through, a country with risk of Yellow Fever transmission. Our pharmacists will check your full itinerary during consultation and advise whether a certificate is needed. Where required, Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.' ],
				[ 'question' => 'Is malaria a risk in India?', 'answer' => 'Yes. India has malaria risk in many regions, and the level of risk varies by area and by season, generally being higher during and after the monsoon. Our pharmacists will assess your specific itinerary and travel dates and prescribe antimalarial medication where appropriate, alongside advice on avoiding mosquito bites.' ],
				[ 'question' => 'How far in advance should I book?', 'answer' => 'Ideally 6–8 weeks before departure, to allow time for multi-dose courses to be completed. However, we welcome last-minute travellers — many vaccines can be given on the same day, and some protection is always better than none.' ],
				[ 'question' => 'Can my whole family get vaccinated together?', 'answer' => 'Yes. We welcome families and can vaccinate adults and children at the same appointment. Our pharmacists have expertise in child-safe dosing and will advise on age-appropriate vaccines for younger travellers.' ],
				[ 'question' => 'Do you stock all India travel vaccines?', 'answer' => 'Yes. We stock all recommended India travel vaccines across all four Hampshire branches, including Hepatitis A and B, Typhoid, Japanese Encephalitis, Rabies, Cholera, and DTP. No ordering delays or waiting lists.' ],
				[ 'question' => 'Can I get antimalarial tablets at the same appointment?', 'answer' => 'Yes. Our pharmacists can assess your malaria risk and prescribe antimalarial medication at the same appointment as your vaccinations. Options such as Malarone, Doxycycline, and Mefloquine are available in stock.' ],
				[ 'question' => 'How long does the travel health consultation take?', 'answer' => 'Most consultations take 20–30 minutes including vaccination. If you are having multiple vaccines or require an antimalarial prescription, allow a little longer. Same-day vaccination is available at all four branches.' ],
			],
			'tv_cta_badges' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'All Vaccines in Stock' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => 'Antimalarial Advice' ] ],
			'tv_cta_h2'     => 'Travelling to India?<br>Get Protected Before You Go.',
			'tv_cta_intro'  => 'Book your India travel vaccination consultation at any of our four Hampshire locations. Expert advice, all vaccines in stock, same-day appointments available.',
			'tv_cta_btn1'   => 'Book India Travel Consultation',
			'tv_cta_btn2'   => 'Find Your Nearest Branch',
			'tv_trust'      => [
				[ 'value' => 'All', 'label' => 'Vaccines in Stock' ],
				[ 'value' => 'Same-Day', 'label' => 'Appointments' ],
				[ 'value' => 'GPhC', 'label' => 'Registered Pharmacists' ],
				[ 'value' => '4', 'label' => 'Hampshire Locations' ],
			],
			'tv_disclaimer' => 'Travel health recommendations for India are based on current NaTHNaC, WHO, and MHRA guidance and are accurate as of May 2026. Requirements and recommendations may change &mdash; always consult the latest NaTHNaC or Foreign, Commonwealth &amp; Development Office guidance before travel. Vaccine suitability is assessed on an individual basis by our GPhC-registered pharmacists at the time of consultation.',
		],

		'kenya' => [
			'tv_hero_pill'  => 'Kenya Travel Health &middot; Hampshire',
			'tv_hero_h1'    => 'Kenya Travel Vaccinations in Hampshire',
			'tv_hero_intro' => 'Expert travel health advice and all essential vaccines for your Kenya trip. Same-day appointments available across all four of our Hampshire locations &mdash; no waiting lists, no delays.',
			'tv_hero_btn1'  => 'Book Kenya Travel Consultation',
			'tv_hero_btn2'  => 'Check What Vaccines You Need',
			'tv_hero_pills' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => 'Expert Pharmacist Advice' ], [ 'text' => '4 Hampshire Locations' ] ],
			'tv_hero_image' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop',
			'tv_intro_eyebrow' => 'Travel Health Advice',
			'tv_intro_h2'   => 'Essential Vaccinations for Kenya Travel',
			'tv_intro_p1'   => 'Planning a trip to Kenya from Hampshire? Our travel clinics across Emsworth, Havant and Rowlands Castle provide comprehensive vaccination services and expert travel health advice for Kenya travellers.',
			'tv_intro_p2'   => "Whether you're exploring Nairobi, taking a safari in the Maasai Mara, relaxing on the Mombasa coast, or trekking in the highlands, we'll help ensure you're properly protected with the right vaccines and antimalarial medication. Our GPhC-registered pharmacists assess your specific itinerary and medical history to create a personalised vaccination plan tailored to your trip.",
			'tv_vax_eyebrow' => 'Vaccination Guide',
			'tv_vax_h2'     => 'Recommended Vaccines for Kenya',
			'tv_vax_intro'  => 'Our pharmacists will confirm exactly which vaccines you need based on your itinerary, activities and medical history.',
			'tv_vaccines'   => [
				[ 'category' => 'Recommended Vaccines', 'name' => 'Hepatitis A', 'who' => 'All travellers', 'doses' => '1 dose (booster at 6&ndash;12 months)', 'desc' => 'Recommended for all Kenya travellers. Spread through contaminated food and water, Hepatitis A can be encountered throughout the region, and a single dose provides long-term immunity.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Typhoid', 'who' => 'All travellers, especially outside main resorts', 'doses' => '1 dose', 'desc' => 'Recommended where food and water hygiene may be variable. Spread through contaminated food and water &mdash; particularly worth considering if you plan to travel beyond major hotels and resorts.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Rabies', 'who' => 'Adventure travellers, those with likely animal contact', 'doses' => '3 doses over 21&ndash;28 days', 'desc' => 'Worth considering for adventure travellers, those visiting remote areas, and anyone with potential animal contact. Rabies is present in the region and is fatal once symptoms appear, so pre-exposure vaccination is a sensible precaution.' ],
				[ 'category' => 'Required Vaccines', 'name' => 'Yellow Fever (Required for Entry to Kenya)', 'who' => 'Required for entry to Kenya', 'doses' => '1 dose (lifetime immunity)', 'desc' => 'Yellow Fever vaccination is required for entry to Kenya, and a valid ICVP (International Certificate of Vaccination or Prophylaxis) must usually be presented on arrival. Our pharmacists will confirm the current requirements for your itinerary at consultation.<br><br><span style="display:block;border:1px solid rgba(251,191,36,0.4);background:rgba(251,191,36,0.12);border-radius:0.75rem;padding:0.75rem 1rem;"><strong>Please note:</strong> Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.</span>' ],
				[ 'category' => 'Antimalarial Protection', 'name' => 'Malaria Prophylaxis', 'who' => 'Most travellers to Kenya', 'doses' => 'Antimalarial tablets &mdash; course depends on the medication', 'desc' => 'Malaria is a significant risk across much of Kenya. Antimalarial tablets are recommended for most travellers, alongside good mosquito-bite avoidance. Our pharmacists will assess your itinerary and recommend the most suitable option &mdash; see the malaria section below for more detail.' ],
			],
			'tv_risk_eyebrow' => 'Risk Awareness',
			'tv_risk_h2'    => 'Health Risks When Travelling to Kenya',
			'tv_risk_intro' => 'Understanding potential health risks helps you prepare properly. Our pharmacists will assess your specific itinerary and activities to provide tailored advice.',
			'tv_risks'      => [
				[ 'title' => 'Malaria &amp; Mosquito-Borne Diseases', 'desc' => 'Malaria is a significant risk across much of Kenya and is the most important health consideration for many travellers. Antimalarial tablets and careful mosquito-bite avoidance are strongly recommended. Other mosquito-borne illnesses such as dengue may also be present, so use repellent and cover up, particularly around dawn and dusk.' ],
				[ 'title' => 'Food &amp; Water Safety', 'desc' => "Travellers' diarrhoea is common. Drink bottled or properly treated water, avoid ice from unknown sources, and be cautious with uncooked or unpeeled foods. Typhoid and Hepatitis A can be spread through contaminated food and water, which is why vaccination is recommended before your trip." ],
				[ 'title' => 'Rabies from Animal Bites', 'desc' => 'Rabies is present in Kenya and can be carried by dogs and other mammals. Avoid contact with animals, and seek prompt medical advice after any bite or scratch. Pre-exposure vaccination is worth considering, particularly for adventure travellers, those visiting remote areas, and families travelling with young children.' ],
				[ 'title' => 'Sun, Heat &amp; Altitude', 'desc' => "Kenya's climate ranges from hot coastal areas to cooler highlands. Stay well hydrated, use high-factor sun protection, and pace yourself in the heat. If your itinerary includes high-altitude trekking, allow time to acclimatise. Our pharmacists can advise on general travel health preparation for your trip." ],
			],
			'tv_mal_eyebrow' => 'Antimalarial Protection',
			'tv_mal_h2'     => 'Malaria Prevention for Kenya',
			'tv_mal_intro'  => 'Kenya has a significant malaria risk across much of the country, so antimalarial protection is an important part of preparing for your trip. Our pharmacists will assess your specific itinerary and recommend the right protection for you.',
			'tv_malaria'    => [
				[ 'title' => 'Risk Areas in Kenya', 'desc' => 'Malaria risk is present across much of Kenya, including coastal areas around Mombasa, lakeside regions, and many safari destinations. Risk is generally lower at higher altitudes, such as parts of Nairobi and the central highlands. Because risk varies by region and season, our pharmacists will assess your itinerary and advise accordingly.' ],
				[ 'title' => 'Antimalarial Options', 'desc' => 'We can supply antimalarial tablets such as Malarone (atovaquone/proguanil), Doxycycline, and Mefloquine. Our pharmacists will recommend the most suitable option based on your health, activities, and duration of stay. It is important to take antimalarials exactly as directed, including before and after your trip.' ],
				[ 'title' => 'Bite Prevention', 'desc' => 'Antimalarial tablets work best alongside good bite avoidance. Use DEET-based insect repellent on exposed skin, wear long sleeves and trousers after dark, and sleep under an insecticide-treated mosquito net where rooms are not screened or air-conditioned. We stock travel-strength DEET repellents at all four branches.' ],
			],
			'tv_how_eyebrow' => 'Three-Step Process',
			'tv_how_h2'     => 'How to Get Your Kenya Travel Vaccinations at Southdowns Pharmacy',
			'tv_how_intro'  => 'Three simple steps from booking to being fully protected.',
			'tv_how_steps'  => [
				[ 'title' => 'Book Your Consultation', 'desc' => 'Visit any of our four Hampshire locations during opening hours or book online. Walk-ins are welcome. We serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, and Chichester.' ],
				[ 'title' => 'Expert Travel Health Assessment', 'desc' => "Our GPhC-registered pharmacists will review your full itinerary, medical history, and planned activities to provide personalised Kenya travel health advice. We'll identify exactly which vaccines and medications you need &mdash; and just as importantly, which ones you don't." ],
				[ 'title' => 'Same-Day Vaccination', 'desc' => 'Receive your vaccines immediately at the same appointment. We stock recommended Kenya travel vaccinations across all four branches and can complete your course before departure. Yellow Fever vaccination is available at our Bosmere Pharmacy, Havant location only.' ],
			],
			'tv_time_eyebrow' => 'Timing Guide',
			'tv_time_h2'    => 'When to Get Your Kenya Travel Vaccinations',
			'tv_time_intro' => "Ideally, book 6&ndash;8 weeks before departure &mdash; but don't worry if your trip is sooner. We accommodate last-minute travellers with same-day appointments and can provide protection for most vaccines. Note that the Yellow Fever certificate becomes valid 10 days after vaccination, so allow time for this.",
			'tv_timing'     => [
				[ 'tag' => 'Ideal', 'time' => '6–8 Weeks Before', 'desc' => 'Best timing for multi-dose vaccines such as Rabies, and to ensure your Yellow Fever certificate is valid in good time. Allows your immune system to develop full protection before departure.' ],
				[ 'tag' => 'Good', 'time' => '2–4 Weeks Before', 'desc' => 'Still time for single-dose vaccines including Hepatitis A and Typhoid, and for Yellow Fever ahead of the 10-day certificate validity period. Antimalarial medication can be arranged. First doses of multi-dose courses can begin.' ],
				[ 'tag' => 'Last Minute', 'time' => 'Days Before Departure', 'desc' => "Don't skip it &mdash; some protection is always better than none. Hepatitis A and Typhoid can be given same-day, and antimalarial tablets can be arranged. Bear in mind the Yellow Fever certificate is valid only 10 days after vaccination, so come in as early as you can." ],
			],
			'tv_price_eyebrow' => 'Transparent Pricing',
			'tv_price_h2'   => 'Kenya Travel Vaccination Pricing',
			'tv_price_intro' => 'Transparent pricing with no hidden consultation fees. All prices include expert pharmacist assessment and vaccine administration.',
			'tv_pkg1_title' => 'Essential Kenya Package',
			'tv_pkg1_price' => '£TBC',
			'tv_pkg1_items' => [ [ 'text' => 'Hepatitis A vaccination' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Personalised travel advice' ] ],
			'tv_pkg2_title' => 'Comprehensive Kenya Package',
			'tv_pkg2_price' => '£TBC',
			'tv_pkg2_items' => [ [ 'text' => 'Hepatitis A vaccination' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Rabies course (where recommended)' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Antimalarial assessment' ] ],
			'tv_individual' => [
				[ 'name' => 'Hepatitis A', 'price' => '£TBC' ],
				[ 'name' => 'Typhoid', 'price' => '£TBC' ],
				[ 'name' => 'Rabies (per dose)', 'price' => '£TBC' ],
				[ 'name' => 'Yellow Fever (Bosmere, Havant only)', 'price' => '£TBC' ],
				[ 'name' => 'ICVP Certificate (Bosmere, Havant only)', 'price' => '£TBC' ],
				[ 'name' => 'Antimalarial Tablets', 'price' => '£TBC' ],
			],
			'tv_price_info' => '<strong>Prices confirmed at consultation.</strong> All prices include expert pharmacist consultation and vaccine administration. No hidden fees.',
			'tv_loc_eyebrow' => 'Find Us',
			'tv_loc_h2'     => 'Book at Your Nearest Hampshire Travel Clinic',
			'tv_loc_intro'  => 'Kenya travel vaccinations available at all four Southdowns Pharmacy locations. Same-day appointments subject to availability. Free parking at all branches.',
			'tv_loc_yf_note' => '<strong>Yellow Fever for Kenya:</strong> Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only. As Yellow Fever vaccination is required for entry to Kenya, please book at our Bosmere branch for this service.',
			'tv_loc_footer' => 'Conveniently located to serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, Petersfield, and Chichester.',
			'tv_why_eyebrow' => 'Our Promise',
			'tv_why_h2'     => 'Why Choose Southdowns Pharmacy for Your Kenya Travel Vaccinations?',
			'tv_why'        => [
				[ 'title' => 'Expert GPhC-Registered Pharmacists', 'desc' => 'Qualified specialists in travel health providing evidence-based, personalised vaccination advice for every itinerary.' ],
				[ 'title' => 'Kenya Travel Vaccines in Stock', 'desc' => 'No ordering delays — we carry recommended vaccines for Kenya travel across all four Hampshire branches.' ],
				[ 'title' => 'Same-Day Appointments', 'desc' => 'Walk in or book ahead — no waiting weeks for your travel vaccination appointment.' ],
				[ 'title' => 'Yellow Fever Centre at Bosmere, Havant', 'desc' => 'Yellow Fever vaccinations and ICVP certificates — required for entry to Kenya — are available at our Bosmere Pharmacy, Havant location.' ],
				[ 'title' => 'Four Hampshire Locations', 'desc' => 'Serving Portsmouth, Southsea, Waterlooville, Havant, and wider Hampshire. Free parking at all sites.' ],
				[ 'title' => 'Family-Friendly Consultations', 'desc' => 'Child-safe dosing expertise and a welcoming environment for families travelling to Kenya with children of all ages.' ],
			],
			'tv_faq_eyebrow' => 'Common Questions',
			'tv_faq_h2'     => 'Frequently Asked Questions',
			'tv_faq_intro'  => 'Everything you need to know about Kenya travel vaccinations at Southdowns Pharmacy.',
			'tv_faqs'       => [
				[ 'question' => 'Which vaccines do I need for Kenya?', 'answer' => 'The vaccines you need depend on your itinerary, activities, and medical history. For most travellers, Hepatitis A and Typhoid are recommended, and Rabies may be advised depending on your plans. Yellow Fever vaccination is required for entry to Kenya. Our pharmacists will provide a personalised recommendation at your consultation.' ],
				[ 'question' => 'Do I need a Yellow Fever certificate for Kenya?', 'answer' => 'Yellow Fever vaccination is required for entry to Kenya, and a valid ICVP certificate must usually be presented on arrival. The certificate becomes valid 10 days after vaccination. Please note that Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.' ],
				[ 'question' => 'Where can I get the Yellow Fever vaccine?', 'answer' => 'Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only. If you are travelling to Kenya, please book your Yellow Fever appointment at our Bosmere branch. Your other Kenya travel vaccinations can be arranged at any of our four Hampshire locations.' ],
				[ 'question' => 'Is malaria a risk in Kenya?', 'answer' => 'Yes. Kenya has a significant malaria risk across much of the country, including coastal and many safari areas. Risk is generally lower at higher altitudes. Antimalarial tablets are recommended for most travellers, and our pharmacists will assess your specific itinerary and advise on the most suitable option.' ],
				[ 'question' => 'How far in advance should I book?', 'answer' => 'Ideally 6–8 weeks before departure, to allow time for any multi-dose courses and to ensure your Yellow Fever certificate is valid in good time. However, we welcome last-minute travellers — many vaccines can be given on the same day, and some protection is always better than none.' ],
				[ 'question' => 'Can my whole family get vaccinated together?', 'answer' => 'Yes. We welcome families and can vaccinate adults and children at the same appointment. Our pharmacists have expertise in child-safe dosing and will advise on age-appropriate vaccines for younger travellers.' ],
				[ 'question' => 'Can I get antimalarial tablets at the same appointment?', 'answer' => 'Yes. Our pharmacists can assess your malaria risk and arrange suitable antimalarial medication at the same appointment as your vaccinations. We will advise on the most appropriate option for your trip, including how and when to take it.' ],
				[ 'question' => 'How long does the travel health consultation take?', 'answer' => 'Most consultations take 20–30 minutes including vaccination. If you are having multiple vaccines or require an antimalarial assessment, allow a little longer. Same-day vaccination is available at all four branches, with Yellow Fever available at our Bosmere, Havant branch.' ],
			],
			'tv_cta_badges' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'Kenya Vaccines in Stock' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => 'Yellow Fever at Bosmere, Havant' ] ],
			'tv_cta_h2'     => 'Travelling to Kenya?<br>Get Protected Before You Go.',
			'tv_cta_intro'  => 'Book your Kenya travel vaccination consultation at any of our four Hampshire locations. Expert advice, vaccines in stock, same-day appointments available.',
			'tv_cta_btn1'   => 'Book Kenya Travel Consultation',
			'tv_cta_btn2'   => 'Find Your Nearest Branch',
			'tv_trust'      => [
				[ 'value' => 'All', 'label' => 'Kenya Vaccines in Stock' ],
				[ 'value' => 'Same-Day', 'label' => 'Appointments' ],
				[ 'value' => 'GPhC', 'label' => 'Registered Pharmacists' ],
				[ 'value' => '4', 'label' => 'Hampshire Locations' ],
			],
			'tv_disclaimer' => 'Travel health recommendations for Kenya are based on current NaTHNaC, WHO, and MHRA guidance and are accurate as of May 2026. Requirements and recommendations may change &mdash; always consult the latest NaTHNaC or Foreign, Commonwealth &amp; Development Office guidance before travel. Vaccine suitability is assessed on an individual basis by our GPhC-registered pharmacists at the time of consultation.',
		],

		'thailand' => [
			'tv_hero_pill'  => 'Thailand Travel Health &middot; Hampshire',
			'tv_hero_h1'    => 'Thailand Travel Vaccinations in Hampshire',
			'tv_hero_intro' => 'Expert travel health advice and all essential vaccines for your Thailand trip. Same-day appointments available across all four of our Hampshire locations &mdash; no waiting lists, no delays.',
			'tv_hero_btn1'  => 'Book Thailand Travel Consultation',
			'tv_hero_btn2'  => 'Check What Vaccines You Need',
			'tv_hero_pills' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => 'Expert Pharmacist Advice' ], [ 'text' => '4 Hampshire Locations' ] ],
			'tv_hero_image' => 'https://images.unsplash.com/photo-1528181304800-259b08848526?w=1200&q=80&auto=format&fit=crop',
			'tv_intro_eyebrow' => 'Travel Health Advice',
			'tv_intro_h2'   => 'Essential Vaccinations for Thailand Travel',
			'tv_intro_p1'   => 'Planning a trip to Thailand from Hampshire? Our travel clinics across Emsworth, Havant and Rowlands Castle provide comprehensive vaccination services and expert travel health advice for Thailand travellers.',
			'tv_intro_p2'   => "Whether you're visiting Bangkok, Phuket, Chiang Mai, or exploring rural Thailand, we'll ensure you're fully protected with the right vaccines and antimalarial medication. Our GPhC-registered pharmacists assess your specific itinerary and medical history to create a personalised vaccination plan tailored to your trip.",
			'tv_vax_eyebrow' => 'Vaccination Guide',
			'tv_vax_h2'     => 'Recommended Vaccines for Thailand',
			'tv_vax_intro'  => 'Our pharmacists will confirm exactly which vaccines you need based on your itinerary, activities and medical history.',
			'tv_vaccines'   => [
				[ 'category' => 'Routine Vaccines', 'name' => 'MMR (Measles, Mumps, Rubella)', 'who' => 'All travellers', 'doses' => '2 doses if not previously vaccinated', 'desc' => 'Essential routine vaccine protecting against three serious viral infections. Most UK adults received this as children &mdash; check your records before travelling.' ],
				[ 'category' => 'Routine Vaccines', 'name' => 'DTP Booster (Diphtheria, Tetanus, Polio)', 'who' => 'All travellers', 'doses' => '1 booster dose', 'desc' => 'A combined booster vaccine recommended every 10 years for travellers. Protects against three potentially fatal diseases.' ],
				[ 'category' => 'Routine Vaccines', 'name' => 'Hepatitis A', 'who' => 'All travellers', 'doses' => '1 dose (booster at 6&ndash;12 months)', 'desc' => 'Highly recommended for all Thailand travellers. Spread through contaminated food and water, Hepatitis A is common throughout Southeast Asia and provides long-term immunity from a single dose.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Hepatitis B', 'who' => 'Long stays, adventure travellers', 'doses' => '3 doses over 21 days (accelerated course available)', 'desc' => 'Recommended for longer stays or if you may be exposed to blood or body fluids. Particularly important for adventure travellers and those visiting rural areas.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Typhoid', 'who' => 'All travellers, especially street food lovers', 'doses' => '1 dose', 'desc' => 'Common in areas with poor sanitation. Spread through contaminated food and water &mdash; essential if you plan to eat street food or travel outside major tourist areas.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Japanese Encephalitis', 'who' => 'Rural travellers, long stays', 'doses' => '2 doses, 28 days apart', 'desc' => 'Recommended if visiting rural areas, especially rice-growing regions, or staying for extended periods. Spread by mosquitoes and can cause serious neurological illness.' ],
				[ 'category' => 'Recommended Vaccines', 'name' => 'Rabies', 'who' => 'Adventure travellers, those with likely animal contact', 'doses' => '3 doses over 21&ndash;28 days', 'desc' => 'Strongly recommended for adventure travellers, cyclists, and those visiting remote areas. Stray dogs and monkeys are common throughout Thailand and rabies is present. Fatal once symptoms appear &mdash; pre-exposure vaccination is essential.' ],
				[ 'category' => 'Required Vaccines', 'name' => 'Yellow Fever (Certificate Required)', 'who' => 'Travellers arriving from countries with Yellow Fever risk', 'doses' => '1 dose (lifetime immunity)', 'desc' => 'Required if arriving from a country with risk of Yellow Fever transmission. Thailand requires a valid ICVP certificate if you are travelling from or transiting through a Yellow Fever endemic country. Our pharmacists will advise based on your specific itinerary. Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.' ],
			],
			'tv_risk_eyebrow' => 'Risk Awareness',
			'tv_risk_h2'    => 'Health Risks When Travelling to Thailand',
			'tv_risk_intro' => 'Understanding potential health risks helps you prepare properly. Our pharmacists will assess your specific itinerary and activities to provide tailored advice.',
			'tv_risks'      => [
				[ 'title' => 'Mosquito-Borne Diseases', 'desc' => 'Dengue fever is widespread throughout Thailand, including urban areas like Bangkok. While malaria risk is low in most popular tourist destinations, it remains a concern in rural and border regions. Use DEET-based repellents and wear long sleeves during dawn and dusk. Note that dengue-carrying mosquitoes bite during the day as well as at dusk.' ],
				[ 'title' => 'Food &amp; Water Safety', 'desc' => "Travellers' diarrhoea is extremely common in Thailand. Drink bottled water only, avoid ice from unknown sources, and be cautious with street food &mdash; choose busy stalls with fresh preparation where possible. Typhoid and Hepatitis A are real risks from contaminated food and water, making vaccination essential before your trip." ],
				[ 'title' => 'Japanese Encephalitis', 'desc' => 'Risk is higher in rural and agricultural areas, particularly rice-growing regions. The virus is spread by mosquitoes and can cause serious brain inflammation. Vaccination is recommended for travellers spending extended time in rural Thailand, particularly during the rainy season between May and October.' ],
				[ 'title' => 'Rabies from Animal Bites', 'desc' => 'Stray dogs and monkeys are common throughout Thailand, including on temple grounds and in tourist areas. Rabies is fatal once symptoms appear &mdash; pre-exposure vaccination is strongly recommended, particularly for adventure travellers, cyclists, and families travelling with young children who may approach animals.' ],
			],
			'tv_mal_eyebrow' => 'Antimalarial Protection',
			'tv_mal_h2'     => 'Malaria Prevention for Thailand',
			'tv_mal_intro'  => 'While most tourist areas in Thailand have low malaria risk, certain rural and border regions require antimalarial medication. Our pharmacists will assess your specific itinerary and recommend the right protection for your trip.',
			'tv_malaria'    => [
				[ 'title' => 'Risk Areas in Thailand', 'desc' => 'Border regions with Myanmar, Cambodia, and Laos carry the highest malaria risk. Rural forested areas in Kanchanaburi, Tak, and Trat provinces also require precautions. Popular beach destinations including Phuket, Koh Samui, Koh Phi Phi, and city destinations including Bangkok and Chiang Mai are generally considered malaria-free.' ],
				[ 'title' => 'Antimalarial Options', 'desc' => 'We prescribe Malarone (atovaquone/proguanil), Doxycycline, and Mefloquine. Our pharmacists will recommend the most suitable option based on your health, activities, and duration of stay. All options are available in stock across all four Hampshire branches.' ],
				[ 'title' => 'Bite Prevention', 'desc' => 'Use DEET 50% insect repellent on all exposed skin. Wear light-coloured long sleeves and trousers at dawn and dusk. Sleep under insecticide-treated mosquito nets in rural areas. We stock premium DEET repellents at all four branches.' ],
			],
			'tv_how_eyebrow' => 'Three-Step Process',
			'tv_how_h2'     => 'How to Get Your Thailand Travel Vaccinations at Southdowns Pharmacy',
			'tv_how_intro'  => 'Three simple steps from booking to being fully protected.',
			'tv_how_steps'  => [
				[ 'title' => 'Book Your Consultation', 'desc' => 'Visit any of our four Hampshire locations during opening hours or book online. Walk-ins are welcome. We serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, and Chichester.' ],
				[ 'title' => 'Expert Travel Health Assessment', 'desc' => "Our GPhC-registered pharmacists will review your full itinerary, medical history, and planned activities to provide personalised Thailand travel health advice. We'll identify exactly which vaccines and medications you need &mdash; and just as importantly, which ones you don't." ],
				[ 'title' => 'Same-Day Vaccination', 'desc' => 'Receive your vaccines immediately at the same appointment. We stock all recommended Thailand travel vaccinations across all four branches and can complete your course before departure. No waiting lists, no delays.' ],
			],
			'tv_time_eyebrow' => 'Timing Guide',
			'tv_time_h2'    => 'When to Get Your Thailand Travel Vaccinations',
			'tv_time_intro' => "Ideally, book 6&ndash;8 weeks before departure &mdash; but don't worry if your trip is sooner. We accommodate last-minute travellers with same-day appointments and can provide immediate protection for most vaccines.",
			'tv_timing'     => [
				[ 'tag' => 'Ideal', 'time' => '6–8 Weeks Before', 'desc' => 'Best timing for multi-dose vaccines like Hepatitis B, Japanese Encephalitis, and Rabies. Allows your immune system to develop full protection before departure.' ],
				[ 'tag' => 'Good', 'time' => '2–4 Weeks Before', 'desc' => 'Still time for single-dose vaccines including Hepatitis A and Typhoid, plus accelerated courses. Antimalarial medication can be prescribed. First doses of multi-dose courses can begin.' ],
				[ 'tag' => 'Last Minute', 'time' => 'Days Before Departure', 'desc' => "Don't skip it &mdash; some protection is always better than none. Hepatitis A and Typhoid can be given same-day. Antimalarial tablets are available immediately. Come in even if you're leaving within days." ],
			],
			'tv_price_eyebrow' => 'Transparent Pricing',
			'tv_price_h2'   => 'Thailand Travel Vaccination Pricing',
			'tv_price_intro' => 'Transparent pricing with no hidden consultation fees. All prices include expert pharmacist assessment and vaccine administration.',
			'tv_pkg1_title' => 'Essential Thailand Package',
			'tv_pkg1_price' => '£96',
			'tv_pkg1_items' => [ [ 'text' => 'Hepatitis A vaccination' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Personalised travel advice' ] ],
			'tv_pkg2_title' => 'Comprehensive Thailand Package',
			'tv_pkg2_price' => '£442',
			'tv_pkg2_items' => [ [ 'text' => 'Hepatitis A &amp; B vaccinations' ], [ 'text' => 'Typhoid vaccination' ], [ 'text' => 'Japanese Encephalitis (2 doses)' ], [ 'text' => 'Travel health consultation' ], [ 'text' => 'Antimalarial assessment' ] ],
			'tv_individual' => [
				[ 'name' => 'Hepatitis A', 'price' => '£56' ],
				[ 'name' => 'Hepatitis B (per dose)', 'price' => '£36' ],
				[ 'name' => 'Typhoid', 'price' => '£40' ],
				[ 'name' => 'Japanese Encephalitis (per dose)', 'price' => '£119' ],
				[ 'name' => 'Rabies (per dose)', 'price' => '£98.50' ],
				[ 'name' => 'DTP Booster', 'price' => '£35' ],
				[ 'name' => 'Antimalarial Tablets', 'price' => 'Quoted at consultation' ],
			],
			'tv_price_info' => '<strong>Prices confirmed at consultation.</strong> All prices include expert pharmacist consultation and vaccine administration. No hidden fees.',
			'tv_loc_eyebrow' => 'Find Us',
			'tv_loc_h2'     => 'Book at Your Nearest Hampshire Travel Clinic',
			'tv_loc_intro'  => 'Thailand travel vaccinations available at all four Southdowns Pharmacy locations. Same-day appointments subject to availability. Free parking at all branches.',
			'tv_loc_yf_note' => 'Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.',
			'tv_loc_footer' => 'Conveniently located to serve patients from across Hampshire including Portsmouth, Southsea, Waterlooville, Havant, Fareham, Gosport, Petersfield, and Chichester.',
			'tv_why_eyebrow' => 'Our Promise',
			'tv_why_h2'     => 'Why Choose Southdowns Pharmacy for Your Thailand Travel Vaccinations?',
			'tv_why'        => [
				[ 'title' => 'Expert GPhC-Registered Pharmacists', 'desc' => 'Qualified specialists in travel health providing evidence-based, personalised vaccination advice for every itinerary.' ],
				[ 'title' => 'All Thailand Vaccines in Stock', 'desc' => 'No ordering delays — we carry every recommended vaccine for Thailand travel across all four Hampshire branches.' ],
				[ 'title' => 'Same-Day Appointments', 'desc' => 'Walk in or book ahead — no waiting weeks for your travel vaccination appointment.' ],
				[ 'title' => 'NaTHNaC Registered Yellow Fever Centre', 'desc' => 'Our Bosmere Pharmacy, Havant branch is an officially designated Yellow Fever Vaccination Centre, authorised to issue valid ICVP certificates.' ],
				[ 'title' => 'Four Hampshire Locations', 'desc' => 'Serving Portsmouth, Southsea, Waterlooville, Havant, and wider Hampshire. Free parking at all sites.' ],
				[ 'title' => 'Family-Friendly Consultations', 'desc' => 'Child-safe dosing expertise and a welcoming environment for families travelling to Thailand with children of all ages.' ],
			],
			'tv_faq_eyebrow' => 'Common Questions',
			'tv_faq_h2'     => 'Frequently Asked Questions',
			'tv_faq_intro'  => 'Everything you need to know about Thailand travel vaccinations at Southdowns Pharmacy.',
			'tv_faqs'       => [
				[ 'question' => 'Which vaccines do I need for Thailand?', 'answer' => 'The vaccines you need depend on your itinerary, activities, and medical history. At minimum, most travellers should ensure their Hepatitis A, Typhoid, and routine vaccines (MMR, DTP) are up to date. Hepatitis B, Japanese Encephalitis, and Rabies may be recommended depending on your plans. Our pharmacists will provide a personalised recommendation at your consultation.' ],
				[ 'question' => 'Do I need a Yellow Fever certificate for Thailand?', 'answer' => 'Thailand does not require Yellow Fever vaccination for most travellers. However, if you are arriving from or transiting through a country with Yellow Fever risk, a valid ICVP certificate may be required for entry. Our pharmacists will check your full itinerary during consultation. Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.' ],
				[ 'question' => 'Is malaria a risk in Thailand?', 'answer' => 'Malaria risk in Thailand is low in most popular tourist destinations including Bangkok, Phuket, Chiang Mai, and the main islands. Risk is higher in rural and border regions with Myanmar, Cambodia, and Laos. Our pharmacists will assess your specific itinerary and prescribe antimalarials if appropriate.' ],
				[ 'question' => 'How far in advance should I book?', 'answer' => 'Ideally 6–8 weeks before departure, to allow time for multi-dose courses to be completed. However, we welcome last-minute travellers — many vaccines can be given on the same day, and some protection is always better than none.' ],
				[ 'question' => 'Can my whole family get vaccinated together?', 'answer' => 'Yes. We welcome families and can vaccinate adults and children at the same appointment. Our pharmacists have expertise in child-safe dosing and will advise on age-appropriate vaccines for younger travellers.' ],
				[ 'question' => 'Do you stock all Thailand travel vaccines?', 'answer' => 'Yes. We stock all recommended Thailand travel vaccines across all four Hampshire branches, including Hepatitis A and B, Typhoid, Japanese Encephalitis, Rabies, and DTP. No ordering delays or waiting lists.' ],
				[ 'question' => 'Can I get antimalarial tablets at the same appointment?', 'answer' => 'Yes. Our pharmacists can assess your malaria risk and prescribe antimalarial medication at the same appointment as your vaccinations. All options — Malarone, Doxycycline, and Mefloquine — are available in stock.' ],
				[ 'question' => 'How long does the travel health consultation take?', 'answer' => 'Most consultations take 20–30 minutes including vaccination. If you are having multiple vaccines or require an antimalarial prescription, allow a little longer. Same-day vaccination is available at all four branches.' ],
			],
			'tv_cta_badges' => [ [ 'text' => 'GPhC Registered' ], [ 'text' => 'All Vaccines in Stock' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => 'NaTHNaC Yellow Fever Centre &middot; Bosmere, Havant' ] ],
			'tv_cta_h2'     => 'Travelling to Thailand?<br>Get Protected Before You Go.',
			'tv_cta_intro'  => 'Book your Thailand travel vaccination consultation at any of our four Hampshire locations. Expert advice, all vaccines in stock, same-day appointments available.',
			'tv_cta_btn1'   => 'Book Thailand Travel Consultation',
			'tv_cta_btn2'   => 'Find Your Nearest Branch',
			'tv_trust'      => [
				[ 'value' => 'All', 'label' => 'Vaccines in Stock' ],
				[ 'value' => 'Same-Day', 'label' => 'Appointments' ],
				[ 'value' => 'GPhC', 'label' => 'Registered Pharmacists' ],
				[ 'value' => '4', 'label' => 'Hampshire Locations' ],
			],
			'tv_disclaimer' => 'Travel health recommendations for Thailand are based on current NaTHNaC, WHO, and MHRA guidance and are accurate as of April 2026. Requirements and recommendations may change &mdash; always consult the latest NaTHNaC or Foreign, Commonwealth &amp; Development Office guidance before travel. Vaccine suitability is assessed on an individual basis by our GPhC-registered pharmacists at the time of consultation.',
		],
	];
}
