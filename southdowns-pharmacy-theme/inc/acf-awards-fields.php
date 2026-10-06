<?php
/**
 * ACF Local Field Group — Awards (global)
 *
 * Shown on: Pharmacy Settings → Awards (options page).
 * Used by:  front-page.php and page-about-us.php via the sp_awards() helper.
 *
 * The text (year / title / organisation) is pre-filled with the current awards
 * via the load_value seed below. Logos: upload via the Logo field, otherwise the
 * existing media-library logo is used (handled in sp_awards()).
 */

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'      => 'group_awards_global',
		'title'    => 'Awards',
		'style'    => 'default',
		'location' => [
			[ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'pharmacy-settings' ] ],
		],
		'fields'   => [
			[
				'key'          => 'field_sp_awards',
				'label'        => 'Awards',
				'name'         => 'sp_awards',
				'type'         => 'repeater',
				'instructions' => 'Award credentials shown on the Home and About Us pages. Leave the Logo empty to keep the current logo.',
				'min'          => 0,
				'layout'       => 'block',
				'button_label' => 'Add Award',
				'sub_fields'   => [
					[ 'key' => 'field_sp_award_year', 'label' => 'Year', 'name' => 'year', 'type' => 'text' ],
					[ 'key' => 'field_sp_award_title', 'label' => 'Award Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_sp_award_org', 'label' => 'Awarding Body', 'name' => 'organisation', 'type' => 'text' ],
					[
						'key'           => 'field_sp_award_finalist',
						'label'         => 'Shortlisted only (not won)',
						'name'          => 'finalist',
						'type'          => 'true_false',
						'instructions'  => 'Leave this off for an award that was won: the card shows a blue "Winner" badge. Tick it if the pharmacy was shortlisted rather than winning, and the card shows an amber "Finalist" badge instead. Untick it if they go on to win.',
						'ui'            => 1,
						'default_value' => 0,
					],
					[ 'key' => 'field_sp_award_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
				],
			],
		],
	] );

} );

/**
 * Pre-fill the Awards repeater in the editor with the current awards (text only;
 * logos fall back to the existing media-library files via sp_awards()).
 */
add_filter( 'acf/load_value/name=sp_awards', function ( $value, $post_id, $field ) {
	if ( ! empty( $value ) ) {
		return $value;
	}
	return [
		[ 'year' => '2026', 'title' => 'UK Pharmacy Group of the Year',           'organisation' => 'Pharmacy Business Awards',    'finalist' => 1, 'logo' => false ],
		[ 'year' => '2024', 'title' => 'Pharmacy Services Provider of the Year', 'organisation' => 'Independent Pharmacy Awards', 'finalist' => 0, 'logo' => false ],
		[ 'year' => '2023', 'title' => 'UK Community Pharmacist of the Year',     'organisation' => 'Pharmacy Business Awards',    'finalist' => 0, 'logo' => false ],
		[ 'year' => '2022', 'title' => 'UK Pharmacy Team of the Year',            'organisation' => 'Chemist and Druggist Awards', 'finalist' => 0, 'logo' => false ],
	];
}, 10, 3 );
