<?php
/**
 * ACF Local Field Group — Services Hub Page
 *
 * Applies to: page-templates/page-services.php
 * Position:   acf_after_title (requires Classic Editor — see functions.php)
 *
 * The service grid itself is hardcoded in the template (it maps to real page
 * URLs and should stay stable). These fields let the editor swap the hero and
 * weight-loss imagery and optionally override the FAQ.
 *
 * Tabs:
 *   1.  Hero
 *   2.  Weight Loss Spotlight
 *   3.  FAQ
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'                   => 'group_services_page',
        'title'                 => 'Services Hub — Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-services.php' ] ],
        ],

        'fields' => [

            // ── Tab 1 · Hero ──────────────────────────────────────
            [ 'key' => 'field_svc_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_svc_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'svc_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Right panel on desktop and background on mobile. Warm pharmacy lifestyle photo (team, front-of-shop or consultation). Minimum 1200 × 800 px.',
            ],
            [
                'key'         => 'field_svc_hero_image_alt',
                'label'       => 'Hero Image Alt Text',
                'name'        => 'svc_hero_image_alt',
                'type'        => 'text',
                'placeholder' => 'Southdowns Pharmacy healthcare services across Hampshire',
            ],

            // ── Tab 2 · Weight Loss Spotlight ─────────────────────
            [ 'key' => 'field_svc_tab_wl', 'label' => 'Weight Loss Spotlight', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_svc_wl_image',
                'label'         => 'Weight Loss Image',
                'name'          => 'svc_wl_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image for the featured Weight Loss band. Aspirational lifestyle photo (active, healthy) — not clinical. Minimum 1000 × 750 px.',
            ],
            [
                'key'         => 'field_svc_wl_image_alt',
                'label'       => 'Weight Loss Image Alt Text',
                'name'        => 'svc_wl_image_alt',
                'type'        => 'text',
                'placeholder' => 'Clinically supervised weight loss programme at Southdowns Pharmacy',
            ],

            // ── Tab 3 · FAQ ───────────────────────────────────────
            [ 'key' => 'field_svc_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_svc_faq_items',
                'label'        => 'FAQ Items',
                'name'         => 'svc_faq_items',
                'type'         => 'repeater',
                'instructions' => 'Add, edit or reorder FAQ questions. If left empty, the hardcoded defaults in the template are used.',
                'min'          => 0,
                'max'          => 20,
                'layout'       => 'block',
                'button_label' => 'Add FAQ Item',
                'sub_fields'   => [
                    [
                        'key'         => 'field_svc_faq_question',
                        'label'       => 'Question',
                        'name'        => 'question',
                        'type'        => 'text',
                        'placeholder' => 'Do I need an appointment?',
                        'required'    => 1,
                    ],
                    [
                        'key'         => 'field_svc_faq_answer',
                        'label'       => 'Answer',
                        'name'        => 'answer',
                        'type'        => 'textarea',
                        'rows'        => 4,
                        'placeholder' => 'It depends on the service...',
                        'required'    => 1,
                    ],
                ],
            ],

        ],
    ] );

} );
