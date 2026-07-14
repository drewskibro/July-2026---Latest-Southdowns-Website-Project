<?php
/**
 * ACF Local Field Group — Blood Testing Page
 *
 * Applies to: page-templates/page-blood-testing.php
 * Position:   acf_after_title (requires Classic Editor — see functions.php)
 *
 * The test catalogue, prices, availability matrix and Amelia booking IDs are
 * hardcoded in the template (they must stay in sync with Amelia). These fields
 * cover the imagery and the FAQ.
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'                   => 'group_blood_testing_page',
        'title'                 => 'Blood Testing — Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-blood-testing.php' ] ],
        ],

        'fields' => [

            // ── Tab 1 · Hero ──────────────────────────────────────
            [ 'key' => 'field_bt_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_bt_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'bt_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Right panel on desktop and background on mobile. Clinical-but-warm phlebotomy / blood testing photo. Minimum 1200 × 800 px.',
            ],
            [
                'key'         => 'field_bt_hero_image_alt',
                'label'       => 'Hero Image Alt Text',
                'name'        => 'bt_hero_image_alt',
                'type'        => 'text',
                'placeholder' => 'Private blood testing at Southdowns Pharmacy, Hampshire',
            ],

            // ── Tab 2 · Davies Spotlight ──────────────────────────
            [ 'key' => 'field_bt_tab_davies', 'label' => 'Davies Spotlight', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_bt_davies_image',
                'label'         => 'Davies Spotlight Image',
                'name'          => 'bt_davies_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image for the Davies "phlebotomy centre" spotlight band. Minimum 1000 × 750 px.',
            ],
            [
                'key'         => 'field_bt_davies_image_alt',
                'label'       => 'Davies Image Alt Text',
                'name'        => 'bt_davies_image_alt',
                'type'        => 'text',
                'placeholder' => 'Davies Pharmacy phlebotomy centre, Havant',
            ],

            // ── Tab 3 · FAQ ───────────────────────────────────────
            [ 'key' => 'field_bt_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_bt_faq_items',
                'label'        => 'FAQ Items',
                'name'         => 'bt_faq_items',
                'type'         => 'repeater',
                'instructions' => 'Add, edit or reorder FAQ questions. If left empty, the hardcoded defaults in the template are used.',
                'min'          => 0,
                'max'          => 20,
                'layout'       => 'block',
                'button_label' => 'Add FAQ Item',
                'sub_fields'   => [
                    [
                        'key'         => 'field_bt_faq_question',
                        'label'       => 'Question',
                        'name'        => 'question',
                        'type'        => 'text',
                        'placeholder' => 'Which branches offer blood tests?',
                        'required'    => 1,
                    ],
                    [
                        'key'         => 'field_bt_faq_answer',
                        'label'       => 'Answer',
                        'name'        => 'answer',
                        'type'        => 'textarea',
                        'rows'        => 4,
                        'required'    => 1,
                    ],
                ],
            ],

        ],
    ] );

} );
