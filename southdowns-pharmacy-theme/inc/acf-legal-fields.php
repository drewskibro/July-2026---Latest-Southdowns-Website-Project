<?php
/**
 * ACF Local Field Group — Legal pages (Privacy, Cookie, Terms) — shared.
 *
 * One field group serves all three legal templates; each PAGE stores its own
 * values. The hero (eyebrow / heading / intro / last-updated) is editable and
 * pre-filled per page. The legal body stays in the template by default (it
 * contains the reviewed, GDPR-sensitive copy and dynamic email/links) — the
 * optional WYSIWYG below lets the client/solicitor REPLACE the whole body if
 * needed.
 *
 * Templates use sp_field()/get_field() only (no helper from this file), so if
 * this file is ever missing the pages still render their built-in text.
 */

function legal_template_map(): array {
	return [
		'page-templates/page-privacy-policy.php'   => 'privacy',
		'page-templates/page-cookie-policy.php'    => 'cookie',
		'page-templates/page-terms-conditions.php' => 'terms',
	];
}

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$location = [];
	foreach ( array_keys( legal_template_map() ) as $tpl ) {
		$location[] = [ [ 'param' => 'page_template', 'operator' => '==', 'value' => $tpl ] ];
	}
	acf_add_local_field_group( [
		'key' => 'group_legal_pages', 'title' => 'Legal Page — Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top',
		'location' => $location,
		'fields' => [
			[ 'key' => 'field_legal_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'legal_eyebrow', 'type' => 'text' ],
			[ 'key' => 'field_legal_heading', 'label' => 'Hero Heading', 'name' => 'legal_heading', 'type' => 'text' ],
			[ 'key' => 'field_legal_intro', 'label' => 'Hero Intro', 'name' => 'legal_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'instructions' => 'The "Last updated" line is added automatically after this.' ],
			[ 'key' => 'field_legal_updated', 'label' => 'Last Updated', 'name' => 'legal_updated', 'type' => 'text', 'instructions' => 'e.g. June 2026' ],
			[ 'key' => 'field_legal_body', 'label' => 'Policy Body (override)', 'name' => 'legal_body', 'type' => 'wysiwyg', 'tabs' => 'all', 'media_upload' => 0, 'instructions' => 'Leave blank to keep the policy text built into the page. Add content here to REPLACE the entire policy body.' ],
		],
	] );
} );

/* Per-page pre-fill for the hero fields (not the body). */
function legal_defaults(): array {
	return [
		'privacy' => [
			'legal_eyebrow' => 'Legal &amp; Policies',
			'legal_heading' => 'Privacy Policy',
			'legal_intro'   => 'How we collect, use and protect your personal data.',
			'legal_updated' => 'June 2026',
		],
		'cookie' => [
			'legal_eyebrow' => 'Legal &amp; Policies',
			'legal_heading' => 'Cookie Policy',
			'legal_intro'   => 'How we use cookies and how to manage your preferences.',
			'legal_updated' => 'June 2026',
		],
		'terms' => [
			'legal_eyebrow' => 'Legal &amp; Policies',
			'legal_heading' => 'Terms &amp; Conditions',
			'legal_intro'   => 'The terms governing your use of our website and services.',
			'legal_updated' => 'June 2026',
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( [ 'legal_eyebrow', 'legal_heading', 'legal_intro', 'legal_updated' ] as $n ) {
		add_filter( 'acf/load_value/name=' . $n, function ( $value, $post_id, $field ) {
			if ( $value !== null && $value !== '' && $value !== false ) return $value;
			$slug = get_page_template_slug( $post_id );
			$key  = legal_template_map()[ $slug ] ?? 'privacy';
			$all  = legal_defaults();
			return $all[ $key ][ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
