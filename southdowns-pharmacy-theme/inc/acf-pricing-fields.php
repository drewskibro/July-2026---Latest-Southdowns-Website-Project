<?php
/**
 * ACF Local Field Group — Pricing Page (page-templates/page-pricing.php)
 *
 * Shown on: any Page using the "Pricing" template (position acf_after_title).
 * Used by:  page-pricing.php via the sp_pricing() helper below.
 *
 * The price list is a nested repeater: Categories → Services (name / duration /
 * price). The editor is pre-seeded with the full price list via load_value, and
 * sp_pricing() falls back to sp_pricing_defaults() so the page ALWAYS renders the
 * correct prices — even before the page has been saved.
 *
 * To mark a service as free, set its price to "£0.00" (the template shows a
 * green "Free" badge for any zero price).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The canonical price list (source of truth / editor seed / front-end fallback).
 *
 * @return array<int,array{name:string,description:string,services:array<int,array{name:string,duration:string,price:string}>}>
 */
function sp_pricing_defaults(): array {
	return [
		[
			'name'        => 'NHS Pharmacy First',
			'description' => 'Free NHS consultations for seven common conditions — no GP appointment needed.',
			'services'    => [
				[ 'name' => 'Earache',               'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Impetigo',              'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Infected Insect Bites', 'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Sinusitis',             'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Sore Throat',           'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Shingles',              'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'UTIs in Women',         'duration' => '5min', 'price' => '£0.00' ],
			],
		],
		[
			'name'        => 'Flu Vaccination',
			'description' => 'Free on the NHS for eligible patients, or book privately.',
			'services'    => [
				[ 'name' => 'NHS Flu Vaccination',     'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Private Flu Vaccination', 'duration' => '5min', 'price' => '£22.00' ],
			],
		],
		[
			'name'        => 'Covid Vaccination',
			'description' => '',
			'services'    => [
				[ 'name' => 'NHS Covid Vaccination',     'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Private Covid Vaccination', 'duration' => '5min', 'price' => '£89.50' ],
			],
		],
		[
			'name'        => 'Combined Flu & Covid Vaccination',
			'description' => 'Both jabs in a single appointment.',
			'services'    => [
				[ 'name' => 'NHS Flu & Covid Vaccinations',     'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Private Flu & Covid Vaccinations', 'duration' => '5min', 'price' => '£110.00' ],
			],
		],
		[
			'name'        => 'Shingles Vaccinations',
			'description' => '',
			'services'    => [
				[ 'name' => 'Private Shingles Vaccination', 'duration' => '5min', 'price' => '£210.00' ],
			],
		],
		[
			'name'        => 'RSV Vaccinations',
			'description' => '',
			'services'    => [
				[ 'name' => 'RSV Vaccination', 'duration' => '5min', 'price' => '£225.00' ],
			],
		],
		[
			'name'        => 'HPV Vaccinations',
			'description' => '',
			'services'    => [
				[ 'name' => 'HPV Vaccination', 'duration' => '5min', 'price' => '£175.00' ],
			],
		],
		[
			'name'        => 'B12 Injection',
			'description' => 'Vitamin B12 boosts — a single injection or a course of four.',
			'services'    => [
				[ 'name' => 'B12 Injection',                       'duration' => '10min', 'price' => '£25.00' ],
				[ 'name' => 'B12 Injection (Course of 4 - Weekly)', 'duration' => '10min', 'price' => '£95.00' ],
			],
		],
		[
			'name'        => 'Travel Vaccinations',
			'description' => 'Protect yourself before you travel. Book a travel consultation first; vaccine prices are per dose.',
			'services'    => [
				[ 'name' => 'Travel Consultation',                          'duration' => '10min', 'price' => '£20.00' ],
				[ 'name' => 'Cholera',                                      'duration' => '10min', 'price' => '£100.00' ],
				[ 'name' => 'Dengue',                                       'duration' => '10min', 'price' => '£96.00' ],
				[ 'name' => 'Diphtheria, Tetanus and Polio',                'duration' => '10min', 'price' => '£35.00' ],
				[ 'name' => 'Hepatitis A',                                  'duration' => '10min', 'price' => '£56.00' ],
				[ 'name' => 'Hepatitis B',                                  'duration' => '10min', 'price' => '£36.00' ],
				[ 'name' => 'Hepatitis B (Paediatric)',                     'duration' => '10min', 'price' => '£30.00' ],
				[ 'name' => 'Japanese Encephalitis',                        'duration' => '10min', 'price' => '£119.00' ],
				[ 'name' => 'Meningitis ACWY (Conjugated)',                 'duration' => '10min', 'price' => '£57.00' ],
				[ 'name' => 'Measles, Mumps and Rubella (MMR)',             'duration' => '10min', 'price' => '£35.00' ],
				[ 'name' => 'Rabies',                                       'duration' => '10min', 'price' => '£98.50' ],
				[ 'name' => 'Tick-borne Encephalitis (TBE)',                'duration' => '10min', 'price' => '£65.00' ],
				[ 'name' => 'Tick-borne Encephalitis (TBE) (Paediatric)',   'duration' => '10min', 'price' => '£56.00' ],
				[ 'name' => 'Typhoid (injection)',                          'duration' => '10min', 'price' => '£40.00' ],
				[ 'name' => 'Chikungunya Vaccine',                          'duration' => '10min', 'price' => '£180.00' ],
				[ 'name' => 'Yellow Fever Vaccine + Certificate',           'duration' => '10min', 'price' => '£95.00' ],
			],
		],
		[
			'name'        => 'Hypertension Check',
			'description' => 'Blood pressure checks — free on the NHS or book privately.',
			'services'    => [
				[ 'name' => 'NHS Blood Pressure Checks',     'duration' => '5min', 'price' => '£0.00' ],
				[ 'name' => 'Private Blood Pressure Checks', 'duration' => '5min', 'price' => '£10.00' ],
			],
		],
		[
			'name'        => 'Diabetes Screening Check',
			'description' => '',
			'services'    => [
				[ 'name' => 'Type 2 Diabetes Screening', 'duration' => '10min', 'price' => '£20.00' ],
			],
		],
		[
			'name'        => 'Free Contraceptive Service',
			'description' => '',
			'services'    => [
				[ 'name' => 'Emergency Contraception',        'duration' => '10min', 'price' => '£0.00' ],
				[ 'name' => 'Free NHS Contraceptive Service', 'duration' => '10min', 'price' => '£0.00' ],
			],
		],
		[
			'name'        => 'Weight Loss Consultation',
			'description' => '',
			'services'    => [
				[ 'name' => 'Weight Loss Consultation', 'duration' => '15min', 'price' => '£20.00' ],
			],
		],
		[
			'name'        => 'Weight Loss Injections',
			'description' => 'Mounjaro and Wegovy — priced per weekly dose. A consultation is required first.',
			'services'    => [
				[ 'name' => 'Mounjaro 2.5mg once per week',  'duration' => '10min', 'price' => '£156.50' ],
				[ 'name' => 'Mounjaro 5mg once per week',    'duration' => '10min', 'price' => '£196.50' ],
				[ 'name' => 'Mounjaro 7.5mg once per week',  'duration' => '10min', 'price' => '£286.50' ],
				[ 'name' => 'Mounjaro 10mg once per week',   'duration' => '10min', 'price' => '£296.50' ],
				[ 'name' => 'Mounjaro 12.5mg once per week', 'duration' => '10min', 'price' => '£375.00' ],
				[ 'name' => 'Mounjaro 15mg once per week',   'duration' => '10min', 'price' => '£375.00' ],
				[ 'name' => 'Wegovy 0.25mg once per week',   'duration' => '10min', 'price' => '£140.00' ],
				[ 'name' => 'Wegovy 0.5mg once per week',    'duration' => '10min', 'price' => '£140.00' ],
				[ 'name' => 'Wegovy 1mg once per week',      'duration' => '10min', 'price' => '£172.00' ],
				[ 'name' => 'Wegovy 1.7mg once per week',    'duration' => '10min', 'price' => '£224.00' ],
				[ 'name' => 'Wegovy 2.4mg once per week',    'duration' => '10min', 'price' => '£269.00' ],
			],
		],
		[
			'name'        => 'Ear Wax Removal',
			'description' => 'Gentle microsuction at our Emsworth and Bosmere branches. A consultation confirms suitability.',
			'services'    => [
				[ 'name' => 'Ear Wax Removal Consultation (Emsworth)', 'duration' => '5min',  'price' => '£25.00' ],
				[ 'name' => 'Ear Wax Removal (One Ear) - Emsworth',    'duration' => '20min', 'price' => '£50.00' ],
				[ 'name' => 'Ear Wax Removal (Both Ears) - Emsworth',  'duration' => '25min', 'price' => '£60.00' ],
				[ 'name' => 'Ear Wax Removal Consultation (Bosmere)',  'duration' => '5min',  'price' => '£25.00' ],
				[ 'name' => 'Ear Wax Removal (One Ear) - Bosmere',     'duration' => '20min', 'price' => '£50.00' ],
				[ 'name' => 'Ear Wax Removal (Both Ears) - Bosmere',   'duration' => '25min', 'price' => '£60.00' ],
			],
		],
		[
			'name'        => 'Full Blood Count',
			'description' => '',
			'services'    => [
				[ 'name' => 'Full Blood Count', 'duration' => '10min', 'price' => '£69.00' ],
			],
		],
		[
			'name'        => 'Cholesterol Check',
			'description' => '',
			'services'    => [
				[ 'name' => 'Cholesterol Testing', 'duration' => '10min', 'price' => '£74.00' ],
			],
		],
		[
			'name'        => 'Thyroid Health Check',
			'description' => '',
			'services'    => [
				[ 'name' => 'Thyroid Health Check', 'duration' => '10min', 'price' => '£79.00' ],
			],
		],
	];
}

/**
 * Returns the pricing categories for the front end: the saved ACF rows if the
 * page has them, otherwise the built-in defaults. Guards against a half-saved
 * repeater (categories present but no services) by falling back to defaults.
 *
 * @return array<int,array{name:string,description:string,services:array}>
 */
function sp_pricing(): array {
	$defaults = sp_pricing_defaults();

	if ( ! function_exists( 'have_rows' ) || ! have_rows( 'pricing_categories' ) ) {
		return $defaults;
	}

	$cats           = [];
	$total_services = 0;

	while ( have_rows( 'pricing_categories' ) ) {
		the_row();
		$cat_name = (string) get_sub_field( 'name' );
		$cat_desc = (string) get_sub_field( 'description' );

		$services = [];
		if ( have_rows( 'services' ) ) {
			while ( have_rows( 'services' ) ) {
				the_row();
				$services[] = [
					'name'     => (string) get_sub_field( 'name' ),
					'duration' => (string) get_sub_field( 'duration' ),
					'price'    => (string) get_sub_field( 'price' ),
				];
			}
		}

		$total_services += count( $services );
		$cats[]          = [
			'name'        => $cat_name,
			'description' => $cat_desc,
			'services'    => $services,
		];
	}

	return ( $cats && $total_services > 0 ) ? $cats : $defaults;
}

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'            => 'group_pricing_page',
		'title'          => 'Pricing — Page Content',
		'position'       => 'acf_after_title',
		'style'          => 'default',
		'label_placement' => 'top',
		'hide_on_screen' => [ 'the_content' ],
		'location'       => [
			[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-pricing.php' ] ],
		],
		'fields'         => [

			// ── Hero ────────────────────────────────────────────────
			[ 'key' => 'field_pr_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'pr_hero_eyebrow', 'type' => 'text', 'default_value' => 'Transparent Pricing' ],
			[ 'key' => 'field_pr_hero_heading', 'label' => 'Hero Heading', 'name' => 'pr_hero_heading', 'type' => 'text', 'default_value' => 'Our Service Prices' ],
			[ 'key' => 'field_pr_hero_intro', 'label' => 'Hero Intro', 'name' => 'pr_hero_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Clear, up-front pricing for every NHS and private service across our four Hampshire pharmacies &mdash; no hidden costs.' ],
			[
				'key' => 'field_pr_hero_pills', 'label' => 'Hero Trust Pills', 'name' => 'pr_hero_pills', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Pill',
				'instructions' => 'Small badges shown in the hero. Leave empty to use the defaults.',
				'sub_fields' => [
					[ 'key' => 'field_pr_hero_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ],
				],
			],

			// ── Intro note above the price cards ───────────────────
			[ 'key' => 'field_pr_intro_note', 'label' => 'Price List Note', 'name' => 'pr_intro_note', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Prices include your consultation unless stated otherwise. NHS services are free for eligible patients. Travel vaccine prices are per dose.' ],

			// ── Categories → Services (nested repeater) ────────────
			[
				'key'          => 'field_pricing_categories',
				'label'        => 'Price List — Categories',
				'name'         => 'pricing_categories',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add Category',
				'instructions' => 'Each category becomes a price card. Set a service price to "£0.00" to show a green "Free" badge.',
				'sub_fields'   => [
					[ 'key' => 'field_pr_cat_name', 'label' => 'Category Name', 'name' => 'name', 'type' => 'text' ],
					[ 'key' => 'field_pr_cat_desc', 'label' => 'Category Description', 'name' => 'description', 'type' => 'text', 'instructions' => 'Optional short line under the category title.' ],
					[
						'key'          => 'field_pr_cat_services',
						'label'        => 'Services',
						'name'         => 'services',
						'type'         => 'repeater',
						'layout'       => 'table',
						'button_label' => 'Add Service',
						'sub_fields'   => [
							[ 'key' => 'field_pr_svc_name', 'label' => 'Service', 'name' => 'name', 'type' => 'text' ],
							[ 'key' => 'field_pr_svc_duration', 'label' => 'Duration', 'name' => 'duration', 'type' => 'text', 'placeholder' => '10min' ],
							[ 'key' => 'field_pr_svc_price', 'label' => 'Price', 'name' => 'price', 'type' => 'text', 'placeholder' => '£0.00' ],
						],
					],
				],
			],

			// ── Booking section ────────────────────────────────────
			[ 'key' => 'field_pr_book_eyebrow', 'label' => 'Booking Eyebrow', 'name' => 'pr_book_eyebrow', 'type' => 'text', 'default_value' => 'Book Online &middot; Same-Day Availability' ],
			[ 'key' => 'field_pr_book_heading', 'label' => 'Booking Heading', 'name' => 'pr_book_heading', 'type' => 'text', 'default_value' => 'Book Your Appointment' ],
			[ 'key' => 'field_pr_book_intro', 'label' => 'Booking Intro', 'name' => 'pr_book_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Choose your location, service and time across our Hampshire branches. Most services need no GP referral.' ],
		],
	] );

	// Pre-seed the price-list repeater in the editor with the full price list.
	add_filter( 'acf/load_value/name=pricing_categories', function ( $value, $post_id, $field ) {
		if ( ! empty( $value ) ) {
			return $value;
		}
		return sp_pricing_defaults();
	}, 10, 3 );

} );
