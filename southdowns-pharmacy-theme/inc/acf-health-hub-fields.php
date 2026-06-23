<?php
/**
 * ACF Local Field Group — Health Hub Page (page-templates/page-health-hub.php)
 * Wires the hero, topic cards and section headings. The blog post loops
 * (featured + latest grid) pull live WordPress posts and stay dynamic.
 * Topic-card filter slugs stay in code (they drive the JS category filter).
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key' => 'group_health_hub', 'title' => 'Health Hub — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top',
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-health-hub.php' ] ] ],
		'fields' => [
			[ 'key' => 'field_hh_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'hh_hero_eyebrow', 'type' => 'text', 'default_value' => 'Health Hub' ],
			[ 'key' => 'field_hh_hero_heading', 'label' => 'Hero Heading (start)', 'name' => 'hh_hero_heading', 'type' => 'text', 'default_value' => 'Expert health advice from your' ],
			[ 'key' => 'field_hh_hero_heading_accent', 'label' => 'Hero Heading (accent)', 'name' => 'hh_hero_heading_accent', 'type' => 'text', 'instructions' => 'Shown in the serif accent style at the end of the heading.', 'default_value' => 'Hampshire pharmacists' ],
			[ 'key' => 'field_hh_hero_intro', 'label' => 'Hero Intro', 'name' => 'hh_hero_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Evidence-based guides on weight loss, travel health and everyday wellbeing &mdash; written and reviewed by our GPhC-registered team.' ],
			[ 'key' => 'field_hh_topics_heading', 'label' => 'Topics Heading', 'name' => 'hh_topics_heading', 'type' => 'text', 'default_value' => 'What brings you here today?' ],
			[ 'key' => 'field_hh_topics_intro', 'label' => 'Topics Intro', 'name' => 'hh_topics_intro', 'type' => 'text', 'default_value' => 'Jump straight to the health topic that matters most to you.' ],
			[
				'key' => 'field_hh_topics', 'label' => 'Topic Cards', 'name' => 'hh_topics', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Topic',
				'instructions' => 'Three topic cards. The category each links to is set in code.',
				'sub_fields' => [
					[ 'key' => 'field_hh_t_badge', 'label' => 'Badge', 'name' => 'badge', 'type' => 'text' ],
					[ 'key' => 'field_hh_t_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_hh_t_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
					[ 'key' => 'field_hh_t_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
				],
			],
			[ 'key' => 'field_hh_featured_eyebrow', 'label' => 'Featured Eyebrow', 'name' => 'hh_featured_eyebrow', 'type' => 'text', 'default_value' => 'Featured This Week' ],
			[ 'key' => 'field_hh_latest_heading', 'label' => 'Latest Heading', 'name' => 'hh_latest_heading', 'type' => 'text', 'default_value' => 'Latest from Our Pharmacists' ],
			[ 'key' => 'field_hh_latest_intro', 'label' => 'Latest Intro', 'name' => 'hh_latest_intro', 'type' => 'text', 'default_value' => 'Evidence-based health guidance, written and reviewed by our team.' ],
		],
	] );
} );

function hh_repeater_defaults(): array {
	return [
		'hh_topics' => [
			[ 'badge' => 'Weight Loss',   'title' => 'Weight Loss Journeys',  'desc' => 'GLP-1 medications, managing side effects, nutrition guides and real patient experiences.' ],
			[ 'badge' => 'Travel Health', 'title' => 'Travel Health Guides',  'desc' => 'Destination vaccines, malaria prevention, yellow fever advice and travel safety tips.' ],
			[ 'badge' => 'Wellness',      'title' => 'Wellness & Prevention', 'desc' => 'Vitamin guidance, prescription know-how, seasonal jabs and staying well year-round.' ],
		],
	];
}

add_action( 'acf/init', function () {
	add_filter( 'acf/load_value/name=hh_topics', function ( $value, $post_id, $field ) {
		if ( ! empty( $value ) ) return $value;
		$d = hh_repeater_defaults();
		return $d['hh_topics'];
	}, 10, 3 );
} );
