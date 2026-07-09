<?php
/**
 * ACF Local Field Group — Yellow Fever Page (page-templates/page-yellow-fever.php)
 *
 * Wires every text block, price, list and image across the 12 sections.
 * Stays in code: SVG icons, decorative roundel badge graphics, section
 * colours/numbers (by index), the Amelia booking widget, branch data
 * (pulled via sp_branch), and the SEO FAQ JSON-LD block at the top.
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$t = function ( $key, $label, $name, $default = '', $type = 'text', $extra = [] ) {
		return array_merge( [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => $type, 'default_value' => $default ], $extra );
	};
	$ta = [ 'rows' => 3, 'new_lines' => '' ];

	acf_add_local_field_group( [
		'key' => 'group_yellow_fever', 'title' => 'Yellow Fever — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top',
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-yellow-fever.php' ] ] ],
		'fields' => [
			// ---- S1 Hero ----
			[ 'key' => 'field_yf_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_hero_eyebrow', 'Hero Eyebrow', 'yf_hero_eyebrow', 'NaTHNaC Registered &middot; Yellow Fever Centre' ),
			$t( 'field_yf_hero_heading', 'Hero Heading', 'yf_hero_heading', 'Yellow Fever Vaccine Hampshire' ),
			$t( 'field_yf_hero_body', 'Hero Body', 'yf_hero_body', 'Registered Yellow Fever Vaccination Centre serving Hampshire. Lifetime protection with official International Certificate included. Available at our Bosmere Pharmacy in Havant.', 'textarea', $ta ),
			$t( 'field_yf_hero_btn', 'Hero Button', 'yf_hero_btn', 'Book Vaccination' ),
			$t( 'field_yf_hero_price', 'Hero Price Line', 'yf_hero_price', '&pound;95 all-inclusive &middot; Same day appointments typically available.' ),
			$t( 'field_yf_hero_image', 'Hero Image', 'yf_hero_image', '', 'image', [ 'return_format' => 'url', 'preview_size' => 'medium' ] ),

			// ---- S2 Key Facts ----
			[ 'key' => 'field_yf_tab_facts', 'label' => 'Key Facts', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_facts_eyebrow', 'Eyebrow', 'yf_facts_eyebrow', 'At a Glance' ),
			$t( 'field_yf_facts_heading', 'Heading', 'yf_facts_heading', 'Key Facts About the Yellow Fever Vaccine' ),
			$t( 'field_yf_facts_intro', 'Intro', 'yf_facts_intro', 'Everything you need to know before booking your vaccination at Southdowns Pharmacy.', 'textarea', $ta ),
			[ 'key' => 'field_yf_facts', 'label' => 'Stat Cards', 'name' => 'yf_facts', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat', 'sub_fields' => [
				[ 'key' => 'field_yf_fact_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
				[ 'key' => 'field_yf_fact_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
			] ],

			// ---- S3 What Is Yellow Fever ----
			[ 'key' => 'field_yf_tab_about', 'label' => 'What Is YF', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_about_eyebrow', 'Eyebrow', 'yf_about_eyebrow', 'What You Need to Know' ),
			$t( 'field_yf_about_heading', 'Heading', 'yf_about_heading', 'What Is Yellow Fever?' ),
			$t( 'field_yf_about_p1', 'Paragraph 1', 'yf_about_p1', 'Yellow Fever is a serious viral disease transmitted by infected mosquitoes across sub-Saharan Africa, South America and parts of Central America. In severe cases, the disease carries a fatality rate of up to 50%. There is no specific antiviral treatment &mdash; vaccination is the only effective prevention.', 'textarea', $ta ),
			$t( 'field_yf_about_p2', 'Paragraph 2', 'yf_about_p2', 'Many countries legally require proof of yellow fever vaccination for entry, even if you are simply transiting through an airport in an affected region. Without an official ICVP, you may be denied boarding, quarantined on arrival, or refused entry entirely.', 'textarea', $ta ),
			$t( 'field_yf_about_stat1_value', 'Stat 1 Value', 'yf_about_stat1_value', '99%' ),
			$t( 'field_yf_about_stat1_label', 'Stat 1 Label', 'yf_about_stat1_label', 'Protection from a single vaccine dose within 30 days' ),
			$t( 'field_yf_about_stat2_value', 'Stat 2 Value', 'yf_about_stat2_value', 'Valid for Life' ),
			$t( 'field_yf_about_stat2_label', 'Stat 2 Label', 'yf_about_stat2_label', 'One vaccination. Your ICVP certificate never expires.' ),
			$t( 'field_yf_about_image', 'Image', 'yf_about_image', '', 'image', [ 'return_format' => 'url', 'preview_size' => 'medium' ] ),

			// ---- S4 Why You Need It ----
			[ 'key' => 'field_yf_tab_why', 'label' => 'Why You Need It', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_why_eyebrow', 'Eyebrow', 'yf_why_eyebrow', 'Why It Matters' ),
			$t( 'field_yf_why_heading', 'Heading', 'yf_why_heading', 'Why You Need the Yellow Fever Vaccine' ),
			$t( 'field_yf_why_intro', 'Intro', 'yf_why_intro', 'Three essential reasons vaccination is critical for travel to affected regions.', 'textarea', $ta ),
			[ 'key' => 'field_yf_why_cards', 'label' => 'Reason Cards', 'name' => 'yf_why_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Reason', 'sub_fields' => [
				[ 'key' => 'field_yf_why_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_yf_why_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],

			// ---- S5 Risk Areas ----
			[ 'key' => 'field_yf_tab_risk', 'label' => 'Risk Areas', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_risk_eyebrow', 'Eyebrow', 'yf_risk_eyebrow', 'Risk Areas' ),
			$t( 'field_yf_risk_heading', 'Heading', 'yf_risk_heading', 'Yellow Fever Risk Areas' ),
			$t( 'field_yf_risk_intro', 'Intro', 'yf_risk_intro', 'Yellow fever is endemic across large areas of sub-Saharan Africa and South America. If your itinerary passes through these regions, you almost certainly need vaccination.', 'textarea', $ta ),
			$t( 'field_yf_risk_africa_heading', 'Africa Heading', 'yf_risk_africa_heading', '&#127757; Africa' ),
			$t( 'field_yf_risk_africa_intro', 'Africa Intro', 'yf_risk_africa_intro', 'Sub-Saharan Africa (47 countries at risk). West Africa carries the highest risk.' ),
			[ 'key' => 'field_yf_risk_africa_items', 'label' => 'Africa List', 'name' => 'yf_risk_africa_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item', 'sub_fields' => [ [ 'key' => 'field_yf_risk_af_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_risk_sa_heading', 'South America Heading', 'yf_risk_sa_heading', '&#127758; South America' ),
			$t( 'field_yf_risk_sa_intro', 'South America Intro', 'yf_risk_sa_intro', 'Central and South America (13 countries). Amazon rainforest regions carry the highest risk.' ),
			[ 'key' => 'field_yf_risk_sa_items', 'label' => 'South America List', 'name' => 'yf_risk_sa_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item', 'sub_fields' => [ [ 'key' => 'field_yf_risk_sa_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_risk_warn_heading', 'Transit Warning Heading', 'yf_risk_warn_heading', 'Transit Warning &mdash; Don&apos;t Overlook This' ),
			$t( 'field_yf_risk_warn_body', 'Transit Warning Body', 'yf_risk_warn_body', 'Even if your destination doesn&apos;t have yellow fever, you may need a certificate if transiting through affected countries. For example, travelling UK &rarr; Kenya &rarr; Seychelles requires a certificate for Seychelles entry. We check your complete itinerary during consultation.', 'textarea', $ta ),

			// ---- S6 How It Works ----
			[ 'key' => 'field_yf_tab_how', 'label' => 'What to Expect', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_how_eyebrow', 'Eyebrow', 'yf_how_eyebrow', 'Your Appointment' ),
			$t( 'field_yf_how_heading', 'Heading', 'yf_how_heading', 'What to Expect' ),
			$t( 'field_yf_how_intro', 'Intro', 'yf_how_intro', 'A streamlined, professional vaccination experience. From consultation to certified ICVP in under 30 minutes.', 'textarea', $ta ),
			$t( 'field_yf_how_image', 'Image', 'yf_how_image', '', 'image', [ 'return_format' => 'url', 'preview_size' => 'medium' ] ),
			$t( 'field_yf_how_image_badge', 'Image Badge', 'yf_how_image_badge', 'GPhC-Registered Pharmacists' ),
			[ 'key' => 'field_yf_how_steps', 'label' => 'Steps', 'name' => 'yf_how_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'sub_fields' => [
				[ 'key' => 'field_yf_how_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_yf_how_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],
			$t( 'field_yf_how_note', 'Note', 'yf_how_note', 'Allow approx 30 minutes total &middot; Book at least 10 days before travel' ),

			// ---- S7 Side Effects ----
			[ 'key' => 'field_yf_tab_safety', 'label' => 'Side Effects', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_safety_eyebrow', 'Eyebrow', 'yf_safety_eyebrow', 'Safety Information' ),
			$t( 'field_yf_safety_heading', 'Heading', 'yf_safety_heading', 'Side Effects &amp; Safety' ),
			$t( 'field_yf_safety_intro', 'Intro', 'yf_safety_intro', 'Excellent safety record with over 600 million doses administered worldwide. Serious reactions are extremely rare.', 'textarea', $ta ),
			$t( 'field_yf_safety_common_heading', 'Common Side Effects Heading', 'yf_safety_common_heading', 'Common Side Effects (1 in 3 People)' ),
			[ 'key' => 'field_yf_safety_common_items', 'label' => 'Common Side Effects List', 'name' => 'yf_safety_common_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item', 'sub_fields' => [ [ 'key' => 'field_yf_sc_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_safety_common_note', 'Common Side Effects Note', 'yf_safety_common_note', 'These mild effects typically appear 5&ndash;10 days post-vaccination and resolve within 2 weeks.' ),
			$t( 'field_yf_safety_contra_heading', 'Contraindications Heading', 'yf_safety_contra_heading', 'Who Should NOT Receive the Vaccine' ),
			[ 'key' => 'field_yf_safety_contra_items', 'label' => 'Contraindications List', 'name' => 'yf_safety_contra_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item', 'sub_fields' => [ [ 'key' => 'field_yf_ct_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_safety_contra_note', 'Contraindications Note', 'yf_safety_contra_note', '<strong>Special precautions:</strong> Pregnancy, breastfeeding, ages 60+, and mild immunosuppression require case-by-case assessment by our pharmacist.', 'textarea', $ta ),

			// ---- S8 Pricing ----
			[ 'key' => 'field_yf_tab_pricing', 'label' => 'Pricing', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_pricing_eyebrow', 'Eyebrow', 'yf_pricing_eyebrow', 'Transparent Pricing' ),
			$t( 'field_yf_pricing_heading', 'Heading', 'yf_pricing_heading', 'Yellow Fever Vaccine Pricing' ),
			$t( 'field_yf_pricing_intro', 'Intro', 'yf_pricing_intro', 'All-inclusive price. No hidden fees. No consultation charges.', 'textarea', $ta ),
			$t( 'field_yf_pricing_badge', 'Card Badge', 'yf_pricing_badge', 'All-Inclusive &middot; Everything Included' ),
			$t( 'field_yf_price', 'Price', 'yf_price', '&pound;95' ),
			$t( 'field_yf_price_unit', 'Price Unit', 'yf_price_unit', 'per person' ),
			$t( 'field_yf_price_sub', 'Price Subtitle', 'yf_price_sub', 'Single lifetime dose' ),
			[ 'key' => 'field_yf_pricing_includes', 'label' => "What's Included", 'name' => 'yf_pricing_includes', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item', 'sub_fields' => [ [ 'key' => 'field_yf_inc_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_pricing_btn', 'Button', 'yf_pricing_btn', 'Book Your Vaccination' ),
			$t( 'field_yf_pricing_fineprint', 'Fine Print', 'yf_pricing_fineprint', 'Certificate valid for life &middot; Valid 10 days post-vaccination' ),
			$t( 'field_yf_pricing_note', 'Note Box', 'yf_pricing_note', 'Unlike many vaccination centres, we include the official ICVP certificate in our price &mdash; some providers charge &pound;20&ndash;40 extra. The price you see is the price you pay. We accept cash, card, and contactless. <strong>Book at least 10 days before departure.</strong>', 'textarea', $ta ),

			// ---- S9 Why Choose Us ----
			[ 'key' => 'field_yf_tab_choose', 'label' => 'Why Choose Us', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_choose_eyebrow', 'Eyebrow', 'yf_choose_eyebrow', 'Why Us' ),
			$t( 'field_yf_choose_heading', 'Heading', 'yf_choose_heading', 'Why Choose Southdowns Pharmacy' ),
			$t( 'field_yf_choose_intro', 'Intro', 'yf_choose_intro', 'Officially designated NaTHNaC Yellow Fever Vaccination Centre &mdash; the only type of centre authorised to issue valid ICVP certificates.', 'textarea', $ta ),
			[ 'key' => 'field_yf_choose_cards', 'label' => 'Cards', 'name' => 'yf_choose_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card', 'sub_fields' => [
				[ 'key' => 'field_yf_choose_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_yf_choose_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],

			// ---- S10 FAQ ----
			[ 'key' => 'field_yf_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_faq_eyebrow', 'Eyebrow', 'yf_faq_eyebrow', 'FAQs' ),
			$t( 'field_yf_faq_heading', 'Heading', 'yf_faq_heading', 'Yellow Fever Vaccine FAQs' ),
			$t( 'field_yf_faq_intro', 'Intro', 'yf_faq_intro', 'Everything you need to know about yellow fever vaccination at Southdowns Pharmacy.', 'textarea', $ta ),
			[ 'key' => 'field_yf_faq_items', 'label' => 'FAQ Items', 'name' => 'yf_faq_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ', 'sub_fields' => [
				[ 'key' => 'field_yf_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
				[ 'key' => 'field_yf_faq_a', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '' ],
			] ],
			$t( 'field_yf_faq_cta_btn', 'Sidebar Button', 'yf_faq_cta_btn', 'Book Vaccination' ),
			$t( 'field_yf_faq_cta_note', 'Sidebar Note', 'yf_faq_cta_note', '&pound;95 all-inclusive &middot; Certificate included' ),

			// ---- S11 Locations ----
			[ 'key' => 'field_yf_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			$t( 'field_yf_loc_eyebrow', 'Eyebrow', 'yf_loc_eyebrow', 'Where to Find Us' ),
			$t( 'field_yf_loc_heading', 'Heading', 'yf_loc_heading', 'Visit Our Yellow Fever Clinic' ),
			$t( 'field_yf_loc_intro', 'Intro', 'yf_loc_intro', 'Yellow Fever vaccinations are carried out at our Bosmere Pharmacy in Havant, with same-day appointments typically available.', 'textarea', $ta ),
			$t( 'field_yf_loc_card_btn', 'Branch Card Button', 'yf_loc_card_btn', 'Book Your Yellow Fever Vaccination' ),
			$t( 'field_yf_loc_banner_heading', 'Banner Heading', 'yf_loc_banner_heading', 'NaTHNaC registered Yellow Fever Centre' ),
			$t( 'field_yf_loc_banner_body', 'Banner Body', 'yf_loc_banner_body', 'Yellow Fever vaccinations are administered at our Bosmere Pharmacy in Havant, with same-day appointments typically available.', 'textarea', $ta ),
			$t( 'field_yf_loc_banner_btn', 'Banner Button', 'yf_loc_banner_btn', 'Book Your Vaccination' ),

			// ---- S12 Final CTA + Booking ----
			[ 'key' => 'field_yf_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_yf_cta_badges', 'label' => 'Trust Badges', 'name' => 'yf_cta_badges', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Badge', 'sub_fields' => [ [ 'key' => 'field_yf_badge_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_cta_heading', 'Heading', 'yf_cta_heading', 'Protect Yourself Before You Travel' ),
			$t( 'field_yf_cta_body', 'Body', 'yf_cta_body', 'Don&apos;t risk being denied boarding or quarantined on arrival. Book your yellow fever vaccination at our registered centre today.', 'textarea', $ta ),
			$t( 'field_yf_cta_btn', 'Button', 'yf_cta_btn', 'Book Yellow Fever Vaccination' ),
			[ 'key' => 'field_yf_cta_ticks', 'label' => 'Tick List', 'name' => 'yf_cta_ticks', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Tick', 'sub_fields' => [ [ 'key' => 'field_yf_tick_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			$t( 'field_yf_disclaimer', 'Medical Disclaimer', 'yf_disclaimer', 'This information is for educational purposes and does not constitute medical advice. Yellow fever vaccination is a prescription-only medicine in the UK. Eligibility and suitability are assessed by our GPhC-registered pharmacists during your consultation. Only NaTHNaC-registered vaccination centres are authorised to issue International Certificates of Vaccination or Prophylaxis (ICVP). Information is accurate as of April 2026 and based on current NaTHNaC, WHO, and MHRA guidance.', 'textarea', $ta ),
			$t( 'field_yf_book_eyebrow', 'Booking Eyebrow', 'yf_book_eyebrow', 'Book Online &middot; Bosmere Pharmacy, Havant' ),
			$t( 'field_yf_book_heading', 'Booking Heading', 'yf_book_heading', 'Book Your Yellow Fever Vaccination' ),
			$t( 'field_yf_book_intro', 'Booking Intro', 'yf_book_intro', 'Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only. Choose your time below.', 'textarea', $ta ),
		],
	] );
} );

function yf_repeater_defaults(): array {
	return [
		'yf_facts' => [
			[ 'value' => '&infin;', 'label' => 'Lifetime Protection' ],
			[ 'value' => 'ICVP', 'label' => 'Certificate Included' ],
			[ 'value' => 'Same', 'label' => 'Day Appointments' ],
			[ 'value' => '&pound;95', 'label' => 'All-Inclusive Price' ],
		],
		'yf_why_cards' => [
			[ 'title' => 'Legal Entry Requirement', 'body' => 'Many countries in Africa, South America, and Asia require a valid yellow fever certificate for entry. Your certificate becomes valid <strong>10 days after vaccination</strong>. Without it, you risk being denied boarding or quarantined.' ],
			[ 'title' => 'Serious Disease Prevention', 'body' => 'Yellow fever is transmitted by mosquitoes in tropical regions. Most experience mild symptoms, but in some cases it can cause serious complications affecting the liver and kidneys. There is no specific treatment once infected.' ],
			[ 'title' => 'Lifetime Protection', 'body' => 'Unlike many travel vaccines, yellow fever vaccination provides <strong>lifelong immunity from a single dose.</strong> Your official certificate is valid for life, even certificates issued before 2016 with old expiry dates.' ],
		],
		'yf_risk_africa_items' => [
			[ 'text' => 'Ghana, Nigeria, Senegal, C&ocirc;te d&apos;Ivoire (West Africa &mdash; highest risk)' ],
			[ 'text' => 'Kenya, Ethiopia, Tanzania, Uganda (East Africa)' ],
			[ 'text' => 'Democratic Republic of Congo, Cameroon, Sudan (Central Africa)' ],
			[ 'text' => 'Angola, Zambia, Zimbabwe (Southern Africa risk zones)' ],
		],
		'yf_risk_sa_items' => [
			[ 'text' => 'Brazil (Amazon basin, north and central states)' ],
			[ 'text' => 'Peru, Colombia, Ecuador (Andean and Amazon regions)' ],
			[ 'text' => 'Bolivia, Venezuela, Guyana, Suriname' ],
			[ 'text' => 'Panama, Trinidad and Tobago, Argentina (border risk zones)' ],
		],
		'yf_how_steps' => [
			[ 'title' => 'Travel Consultation', 'body' => 'Our yellow fever travel expert reviews your itinerary, destination countries, transit points, and medical history. We confirm whether you need vaccination and check for any contraindications.' ],
			[ 'title' => 'Vaccination', 'body' => 'Single injection administered into your upper arm. We use only WHO-prequalified vaccine from approved manufacturers, stored under strict cold chain conditions.' ],
			[ 'title' => 'Official Certificate Issued', 'body' => 'You receive your International Certificate of Vaccination or Prophylaxis (ICVP) immediately. We complete all required fields &mdash; vaccine batch number, date, official stamp, and pharmacist signature. Valid 10 days after vaccination and lasts for life.' ],
		],
		'yf_safety_common_items' => [
			[ 'text' => 'Injection site pain, redness, or swelling' ],
			[ 'text' => 'Headache and muscle aches' ],
			[ 'text' => 'Low-grade fever and fatigue' ],
		],
		'yf_safety_contra_items' => [
			[ 'text' => 'Infants under 9 months old' ],
			[ 'text' => 'Severe egg allergy or previous severe reaction' ],
			[ 'text' => 'Thymus disorders or history of thymus removal' ],
			[ 'text' => 'Severely immunocompromised patients' ],
		],
		'yf_pricing_includes' => [
			[ 'text' => 'Yellow fever vaccine (single lifetime dose)' ],
			[ 'text' => 'GPhC pharmacist travel health consultation' ],
			[ 'text' => 'Full travel health risk assessment' ],
			[ 'text' => '15-minute post-vaccination observation' ],
			[ 'text' => 'Official ICVP Certificate included' ],
			[ 'text' => 'No additional fees whatsoever' ],
		],
		'yf_choose_cards' => [
			[ 'title' => 'NaTHNaC Registered Centre', 'body' => 'Officially designated by the National Travel Health Network and Centre as an authorised Yellow Fever Vaccination Centre.' ],
			[ 'title' => 'GPhC Registered Pharmacists', 'body' => 'All vaccinations administered by General Pharmaceutical Council registered pharmacists with specialist travel health training.' ],
			[ 'title' => 'WHO-Prequalified Vaccine', 'body' => 'Only WHO-prequalified yellow fever vaccine from licensed UK manufacturers, stored under strict cold-chain protocols.' ],
			[ 'title' => 'Based at Bosmere Pharmacy, Havant', 'body' => 'Our Yellow Fever clinic is based at Bosmere Pharmacy in Havant, within easy reach of Portsmouth, Waterlooville and wider Hampshire.' ],
			[ 'title' => 'Same-Day Appointments', 'body' => 'Last-minute travel? We offer same-day vaccination appointments subject to availability. Walk-ins welcome.' ],
			[ 'title' => 'Complete Travel Health', 'body' => 'We provide comprehensive pre-travel consultations covering typhoid, hepatitis, rabies, meningitis, and malaria alongside yellow fever.' ],
		],
		'yf_faq_items' => [
			[ 'question' => 'How long does yellow fever vaccination protection last?', 'answer' => 'A single dose provides lifelong immunity for most people. The International Certificate of Vaccination is now valid for life (previously 10 years under old WHO rules). You won\'t need booster doses unless you were pregnant, immunocompromised, or a stem cell transplant recipient when first vaccinated.' ],
			[ 'question' => 'When should I get the vaccine before travel?', 'answer' => 'Book at least 10 days before departure. Your ICVP certificate becomes valid 10 days after vaccination. Some countries strictly enforce this rule. We recommend 2&ndash;3 weeks before travel where possible. Same-day appointments available for last-minute plans.' ],
			[ 'question' => 'Which countries require yellow fever certification?', 'answer' => 'Over 40 countries require proof of vaccination. This includes most of sub-Saharan Africa, parts of South America, and some Asian/Pacific nations when arriving from endemic areas. Requirements change frequently &mdash; we check current NaTHNaC guidance during your consultation.' ],
			[ 'question' => 'Do I need the vaccine if I\'m only transiting through an affected country?', 'answer' => 'Yes, often. Many countries require certification if you\'ve transited through a yellow fever endemic country, even without leaving the airport. We\'ll assess your specific itinerary, including all transit stops, during consultation.' ],
			[ 'question' => 'Can I get yellow fever vaccine on the NHS?', 'answer' => 'No. Yellow fever vaccination has never been available on the NHS. It must be obtained privately from a registered centre like Southdowns Pharmacy. Our all-inclusive price of &pound;95 covers the vaccine, consultation, official certificate, and everything you need in a single appointment.' ],
			[ 'question' => 'I lost my certificate. Can I get a replacement?', 'answer' => 'If you were vaccinated at Southdowns Pharmacy, we can issue a replacement certificate from our vaccination records. Bring valid photo ID. If vaccinated elsewhere, contact that centre directly &mdash; a legitimate replacement cannot be issued without proof of original vaccination.' ],
			[ 'question' => 'Is the vaccine safe during pregnancy?', 'answer' => 'Yellow fever vaccine is generally avoided during pregnancy as it is a live vaccine. However, if travel to a high-risk area is unavoidable, vaccination may be recommended after careful risk-benefit assessment. Discuss your situation with our pharmacist.' ],
			[ 'question' => 'What if I have an egg allergy?', 'answer' => 'The vaccine is grown in eggs. Severe anaphylactic egg allergy is a contraindication. Milder egg allergies may still allow vaccination with an extended observation period. Disclose your complete allergy history during consultation so we can advise appropriately.' ],
		],
		'yf_cta_badges' => [
			[ 'text' => 'NaTHNaC Registered' ],
			[ 'text' => 'Certificate Included' ],
			[ 'text' => 'Same-Day Service' ],
			[ 'text' => 'GPhC Pharmacists' ],
		],
		'yf_cta_ticks' => [
			[ 'text' => 'NaTHNaC Registered Centre' ],
			[ 'text' => 'Official ICVP Included' ],
			[ 'text' => 'Same-Day Available' ],
			[ 'text' => '&pound;95 All-Inclusive' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( yf_repeater_defaults() ) as $yf_field ) {
		add_filter( 'acf/load_value/name=' . $yf_field, function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) return $value;
			$d = yf_repeater_defaults();
			return $d[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
