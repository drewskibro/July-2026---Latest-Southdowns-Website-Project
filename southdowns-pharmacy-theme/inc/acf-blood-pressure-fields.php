<?php
/**
 * ACF Local Field Group — Blood Pressure Checks Page
 *
 * Applies to: page-templates/page-blood-pressure.php
 * Position:   acf_after_title (requires Classic Editor — see functions.php)
 *
 * Tabs:
 *   1.  Hero
 *   2.  Condition Section
 *   3.  FAQ
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'                   => 'group_blood_pressure_page',
        'title'                 => 'Blood Pressure Checks — Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-blood-pressure.php' ] ],
        ],

        'fields' => [

            // ── Tab 1 · Hero ──────────────────────────────────────
            [ 'key' => 'field_bp_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_bp_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'bp_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Right panel on desktop and background on mobile. Lifestyle photo (e.g. pharmacist taking blood pressure, warm pharmacy setting). Minimum 1200 × 800 px.',
            ],
            [
                'key'         => 'field_bp_hero_image_alt',
                'label'       => 'Hero Image Alt Text',
                'name'        => 'bp_hero_image_alt',
                'type'        => 'text',
                'placeholder' => 'Free blood pressure check at Southdowns Pharmacy',
            ],

            // ── Tab 2 · Condition Section ─────────────────────────
            [ 'key' => 'field_bp_tab_condition', 'label' => 'Condition Section', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_bp_condition_image',
                'label'         => 'Condition Section Image',
                'name'          => 'bp_condition_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Right column of the "Silent Threat" section. Lifestyle image — e.g. someone on a healthy walk outdoors or preparing healthy food. NOT clinical. Minimum 800 × 600 px.',
            ],
            [
                'key'         => 'field_bp_condition_image_alt',
                'label'       => 'Condition Image Alt Text',
                'name'        => 'bp_condition_image_alt',
                'type'        => 'text',
                'placeholder' => 'Healthy active lifestyle for heart health',
            ],

            // ── Tab 3 · FAQ ───────────────────────────────────────
            [ 'key' => 'field_bp_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_bp_faq_items',
                'label'        => 'FAQ Items',
                'name'         => 'bp_faq_items',
                'type'         => 'repeater',
                'instructions' => 'Add, edit or reorder FAQ questions. If left empty, the hardcoded defaults in the template are used.',
                'min'          => 0,
                'max'          => 20,
                'layout'       => 'block',
                'button_label' => 'Add FAQ Item',
                'sub_fields'   => [
                    [
                        'key'         => 'field_bp_faq_question',
                        'label'       => 'Question',
                        'name'        => 'question',
                        'type'        => 'text',
                        'placeholder' => 'Is the blood pressure check really free?',
                        'required'    => 1,
                    ],
                    [
                        'key'         => 'field_bp_faq_answer',
                        'label'       => 'Answer',
                        'name'        => 'answer',
                        'type'        => 'textarea',
                        'rows'        => 4,
                        'placeholder' => 'Yes, completely free...',
                        'required'    => 1,
                    ],
                ],
            ],

        ],
    ] );

} );
