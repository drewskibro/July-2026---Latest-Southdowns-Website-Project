<?php
/**
 * ACF Local Field Group — Meningitis B Vaccine (NHS) Page
 *
 * Applies to: page-templates/page-menb-vaccine.php
 *
 * Eligibility rules, dates and NHS links are hardcoded in the template (they
 * must track official NHS guidance, not client edits). These fields cover the
 * imagery and the FAQ.
 */

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'                   => 'group_menb_page',
		'title'                 => 'Meningitis B — Page Content',
		'position'              => 'acf_after_title',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => [ 'the_content' ],
		'active'                => true,

		'location' => [
			[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-menb-vaccine.php' ] ],
		],

		'fields' => [

			// ── Tab 1 · Imagery ───────────────────────────────────
			[ 'key' => 'field_mb_tab_images', 'label' => 'Imagery', 'name' => '', 'type' => 'tab' ],
			[
				'key'           => 'field_mb_hero_image',
				'label'         => 'Hero Image',
				'name'          => 'mb_hero_image',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'medium',
				'instructions'  => 'Right panel on desktop, background on mobile. Young people / students lifestyle photo works best. Minimum 1200 × 800 px.',
			],
			[
				'key'         => 'field_mb_hero_image_alt',
				'label'       => 'Hero Image Alt Text',
				'name'        => 'mb_hero_image_alt',
				'type'        => 'text',
				'placeholder' => 'University students — free NHS MenB vaccine for young people',
			],
			[
				'key'           => 'field_mb_spotlight_image',
				'label'         => 'Spotlight Image',
				'name'          => 'mb_spotlight_image',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'medium',
				'instructions'  => 'Image beside the "Why the MenB Vaccine Is Being Offered Now" copy. Minimum 1000 × 750 px.',
			],
			[
				'key'         => 'field_mb_spotlight_image_alt',
				'label'       => 'Spotlight Image Alt Text',
				'name'        => 'mb_spotlight_image_alt',
				'type'        => 'text',
				'placeholder' => 'Students starting university in autumn 2026',
			],

			// ── Tab 2 · FAQ ───────────────────────────────────────
			[ 'key' => 'field_mb_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			[
				'key'          => 'field_mb_faq_items',
				'label'        => 'FAQ Items',
				'name'         => 'mb_faq_items',
				'type'         => 'repeater',
				'instructions' => 'Add, edit or reorder FAQ questions. If left empty, the hardcoded NHS-programme defaults in the template are used.',
				'min'          => 0,
				'max'          => 20,
				'layout'       => 'block',
				'button_label' => 'Add FAQ Item',
				'sub_fields'   => [
					[
						'key'         => 'field_mb_faq_question',
						'label'       => 'Question',
						'name'        => 'question',
						'type'        => 'text',
						'placeholder' => 'Who is eligible for the free MenB vaccine?',
						'required'    => 1,
					],
					[
						'key'      => 'field_mb_faq_answer',
						'label'    => 'Answer',
						'name'     => 'answer',
						'type'     => 'textarea',
						'rows'     => 4,
						'required' => 1,
					],
				],
			],

		],
	] );

} );
