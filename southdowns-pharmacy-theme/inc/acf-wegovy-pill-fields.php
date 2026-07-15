<?php
/**
 * ACF Local Field Group — Wegovy Pill Page (page-templates/page-wegovy-pill.php)
 *
 * Covers the fields most likely to be edited (hero, main copy, prices,
 * availability, CTA). Every value in the template falls back to a hardcoded
 * default via sp_field()/sp_rows(), so the page renders fully even for fields
 * not listed here.
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key'      => 'group_wegovy_pill',
		'title'    => 'Wegovy Pill — Page Content',
		'position' => 'acf_after_title',
		'style'    => 'default',
		'label_placement' => 'top',
		'hide_on_screen'  => [ 'the_content' ],
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-wegovy-pill.php' ] ] ],
		'fields'   => [

			// ── Hero ────────────────────────────────────────────
			[ 'key' => 'field_wgp_hero_badge', 'label' => 'Hero Eyebrow', 'name' => 'wgp_hero_badge', 'type' => 'text', 'default_value' => 'Needle-Free Weight Loss &middot; MHRA Approved' ],
			[ 'key' => 'field_wgp_hero_headline', 'label' => 'Hero Headline', 'name' => 'wgp_hero_headline', 'type' => 'text', 'default_value' => 'The Wegovy Pill Has Arrived' ],
			[ 'key' => 'field_wgp_hero_body', 'label' => 'Hero Body', 'name' => 'wgp_hero_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'On 11 June 2026 the MHRA approved oral semaglutide &mdash; the first oral GLP-1 medicine licensed in the UK for weight loss, giving you a needle-free alternative to the weekly Wegovy injection.' ],
			[ 'key' => 'field_wgp_hero_image', 'label' => 'Hero Image', 'name' => 'wgp_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],

			// ── Description ─────────────────────────────────────
			[ 'key' => 'field_wgp_desc_heading', 'label' => 'Description Heading', 'name' => 'wgp_desc_heading', 'type' => 'text', 'default_value' => 'Oral Semaglutide, Explained' ],
			[ 'key' => 'field_wgp_desc_body', 'label' => 'Description Body', 'name' => 'wgp_desc_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0 ],
			[ 'key' => 'field_wgp_desc_image', 'label' => 'Description Image', 'name' => 'wgp_desc_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],

			// ── Prices ──────────────────────────────────────────
			[
				'key' => 'field_wgp_prices', 'label' => 'Prices', 'name' => 'wgp_prices', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Price',
				'sub_fields' => [
					[ 'key' => 'field_wgp_price_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ],
					[ 'key' => 'field_wgp_price_meta', 'label' => 'Sub-label', 'name' => 'meta', 'type' => 'text' ],
					[ 'key' => 'field_wgp_price_price', 'label' => 'Price', 'name' => 'price', 'type' => 'text', 'placeholder' => '£0.00' ],
				],
			],
			[ 'key' => 'field_wgp_price_note', 'label' => 'Price Note', 'name' => 'wgp_price_note', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Later dose steps (9mg and the 25mg maintenance dose) are discussed and priced at your consultation. 10-minute consultation per appointment.' ],

			// ── Availability (branch → days) ───────────────────
			[
				'key' => 'field_wgp_availability', 'label' => 'Availability (branch &amp; days)', 'name' => 'wgp_availability', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Branch',
				'instructions' => 'Display only. The bookable days/slots are configured on the Wegovy service in Amelia.',
				'sub_fields' => [
					[ 'key' => 'field_wgp_avail_branch', 'label' => 'Branch', 'name' => 'branch', 'type' => 'text' ],
					[ 'key' => 'field_wgp_avail_days', 'label' => 'Days', 'name' => 'days', 'type' => 'text' ],
				],
			],

			// ── Results ─────────────────────────────────────────
			[ 'key' => 'field_wgp_results_heading', 'label' => 'Results Heading', 'name' => 'wgp_results_heading', 'type' => 'text', 'default_value' => 'How Well Does It Work?' ],
			[ 'key' => 'field_wgp_results_body', 'label' => 'Results Body', 'name' => 'wgp_results_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0 ],

			// ── Final CTA ───────────────────────────────────────
			[ 'key' => 'field_wgp_cta_heading', 'label' => 'CTA Heading', 'name' => 'wgp_cta_heading', 'type' => 'text', 'default_value' => 'Ready to Start With<br/>the Wegovy Pill?' ],
			[ 'key' => 'field_wgp_cta_body', 'label' => 'CTA Body', 'name' => 'wgp_cta_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Book a consultation with our GPhC-registered pharmacists to see if the Wegovy pill is right for you &mdash; no GP referral needed, at your nearest Hampshire branch.' ],

			[ 'key' => 'field_wgp_disclaimer', 'label' => 'Medical Disclaimer', 'name' => 'wgp_disclaimer', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '' ],
		],
	] );

	// Seed the prices + availability repeaters in the editor with the client's values.
	add_filter( 'acf/load_value/name=wgp_prices', function ( $value, $post_id, $field ) {
		if ( ! empty( $value ) ) {
			return $value;
		}
		return [
			[ 'name' => 'Wegovy Pill 1.5mg', 'meta' => 'Starting dose · once daily',    'price' => '£128.50' ],
			[ 'name' => 'Wegovy Pill 4mg',   'meta' => 'Second dose step · once daily', 'price' => '£137.00' ],
		];
	}, 10, 3 );

	add_filter( 'acf/load_value/name=wgp_availability', function ( $value, $post_id, $field ) {
		if ( ! empty( $value ) ) {
			return $value;
		}
		return [
			[ 'branch' => 'Emsworth Pharmacy', 'days' => 'Mondays & Tuesdays' ],
			[ 'branch' => 'Davies Pharmacy',   'days' => 'Wednesdays, Thursdays & Fridays' ],
			[ 'branch' => 'Bosmere Pharmacy',  'days' => 'Mondays & Fridays' ],
		];
	}, 10, 3 );
} );
