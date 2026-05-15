<?php
/**
 * ACF Local Field Group — Branch Location Pages
 *
 * Applies to: page-location.php, page-emsworth.php, page-bosmere.php
 * Position:   acf_after_title (below page title, above classic editor)
 *
 * Tabs:
 *   1. Hero
 *   2. Contact & Hours
 *   3. Map & Directions
 *   4. Testimonials
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'                   => 'group_location_page',
        'title'                 => 'Branch Location Details',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        // ── Applies to all three location page templates ──────────
        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-location.php' ] ],
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-emsworth.php' ] ],
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-bosmere.php' ] ],
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-rowlands-pharmacy.php' ] ],
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-davies-pharmacy.php' ] ],
        ],

        'fields' => [

            // ============================================================
            // TAB 1 — HERO
            // ============================================================
            [
                'key'   => 'field_loc_tab_hero',
                'label' => 'Hero',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_loc_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'branch_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Displayed on the right half of the hero section (desktop). Minimum 1200 × 800 px.',
            ],
            [
                'key'          => 'field_loc_hero_subtitle',
                'label'        => 'Hero Headline (H1)',
                'name'         => 'branch_hero_subtitle',
                'type'         => 'text',
                'instructions' => 'e.g. "Your Local Pharmacy in Emsworth"',
            ],
            [
                'key'          => 'field_loc_hero_description',
                'label'        => 'Hero Description',
                'name'         => 'branch_hero_description',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Short paragraph shown beneath the H1 in the hero.',
            ],

            // ============================================================
            // TAB 2 — CONTACT & HOURS
            // ============================================================
            [
                'key'   => 'field_loc_tab_contact',
                'label' => 'Contact & Hours',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'   => 'field_loc_addr1',
                'label' => 'Address Line 1',
                'name'  => 'branch_address_line1',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_loc_addr2',
                'label' => 'Address Line 2',
                'name'  => 'branch_address_line2',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_loc_postcode',
                'label' => 'Postcode',
                'name'  => 'branch_postcode',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_loc_phone',
                'label'        => 'Phone — Display',
                'name'         => 'branch_phone',
                'type'         => 'text',
                'instructions' => 'Formatted for display, e.g. 023 9248 1721',
            ],
            [
                'key'          => 'field_loc_phone_raw',
                'label'        => 'Phone — Raw (tel: link)',
                'name'         => 'branch_phone_raw',
                'type'         => 'text',
                'instructions' => 'No spaces, e.g. 02392481721',
            ],
            [
                'key'          => 'field_loc_hours_wd',
                'label'        => 'Hours — Weekday',
                'name'         => 'branch_hours_weekday',
                'type'         => 'text',
                'instructions' => 'e.g. Mon–Fri 9am–7pm',
            ],
            [
                'key'          => 'field_loc_hours_sat',
                'label'        => 'Hours — Saturday',
                'name'         => 'branch_hours_saturday',
                'type'         => 'text',
                'instructions' => 'e.g. Sat 9am–5pm',
            ],
            [
                'key'          => 'field_loc_hours_sun',
                'label'        => 'Hours — Sunday',
                'name'         => 'branch_hours_sunday',
                'type'         => 'text',
                'instructions' => 'e.g. Sun 10am–2pm — leave blank if closed on Sundays',
            ],
            [
                'key'          => 'field_loc_parking',
                'label'        => 'Parking Info',
                'name'         => 'branch_parking',
                'type'         => 'text',
                'instructions' => 'Short note shown in the hero bar, e.g. "Free town centre parking"',
            ],

            // ============================================================
            // TAB 3 — MAP & DIRECTIONS
            // ============================================================
            [
                'key'   => 'field_loc_tab_map',
                'label' => 'Map & Directions',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_loc_maps_src',
                'label'        => 'Google Maps — Embed URL',
                'name'         => 'branch_maps_embed_src',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Paste only the src="…" value from the Google Maps embed iframe — not the full iframe tag.',
            ],
            [
                'key'          => 'field_loc_maps_dir',
                'label'        => 'Google Maps — Directions URL',
                'name'         => 'branch_maps_directions_url',
                'type'         => 'url',
                'instructions' => 'Link for the "Get Directions" button.',
            ],
            [
                'key'          => 'field_loc_by_car',
                'label'        => 'By Car — Description',
                'name'         => 'branch_by_car',
                'type'         => 'textarea',
                'rows'         => 3,
            ],
            [
                'key'          => 'field_loc_car_tags',
                'label'        => 'By Car — Tags',
                'name'         => 'branch_by_car_tags',
                'type'         => 'text',
                'instructions' => 'Comma-separated, e.g. Off A259 coast road, Near A27 junction, Free town centre parking',
            ],
            [
                'key'          => 'field_loc_by_bus',
                'label'        => 'By Bus — Description',
                'name'         => 'branch_by_bus',
                'type'         => 'textarea',
                'rows'         => 3,
            ],
            [
                'key'          => 'field_loc_bus_routes',
                'label'        => 'Bus Routes',
                'name'         => 'branch_bus_routes',
                'type'         => 'text',
                'instructions' => 'Comma-separated route numbers, e.g. 700, 700X, 23',
            ],
            [
                'key'          => 'field_loc_by_train',
                'label'        => 'By Train — Description',
                'name'         => 'branch_by_train',
                'type'         => 'textarea',
                'rows'         => 3,
            ],
            [
                'key'          => 'field_loc_train_stations',
                'label'        => 'Train Stations',
                'name'         => 'branch_train_stations',
                'type'         => 'text',
                'instructions' => 'Pipe-separated pairs, comma between stations. e.g. Emsworth Station|8 min walk,Havant Station|Connections available',
            ],
            [
                'key'          => 'field_loc_on_foot',
                'label'        => 'On Foot — Description',
                'name'         => 'branch_on_foot',
                'type'         => 'textarea',
                'rows'         => 3,
            ],
            [
                'key'          => 'field_loc_landmark',
                'label'        => 'Nearby Landmark',
                'name'         => 'branch_landmark',
                'type'         => 'text',
                'instructions' => 'Short name shown in the "Near X" badge, e.g. Emsworth Square',
            ],

            // ============================================================
            // TAB 4 — TESTIMONIALS
            // ============================================================
            [
                'key'   => 'field_loc_tab_reviews',
                'label' => 'Testimonials',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_loc_testimonials',
                'label'        => 'Patient Reviews',
                'name'         => 'branch_testimonials',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 3,
                'layout'       => 'block',
                'button_label' => 'Add Review',
                'instructions' => 'Up to 3 reviews. Leave empty to show built-in fallback reviews.',
                'sub_fields'   => [
                    [
                        'key'   => 'field_loc_t_quote',
                        'label' => 'Quote',
                        'name'  => 'quote',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                    [
                        'key'   => 'field_loc_t_name',
                        'label' => 'Author Name',
                        'name'  => 'author_name',
                        'type'  => 'text',
                    ],
                    [
                        'key'          => 'field_loc_t_initials',
                        'label'        => 'Author Initials',
                        'name'         => 'author_initials',
                        'type'         => 'text',
                        'maxlength'    => 3,
                        'instructions' => 'Up to 3 characters, e.g. RH',
                    ],
                    [
                        'key'   => 'field_loc_t_service',
                        'label' => 'Service',
                        'name'  => 'service',
                        'type'  => 'text',
                    ],
                    [
                        'key'          => 'field_loc_t_date',
                        'label'        => 'Review Date',
                        'name'         => 'review_date',
                        'type'         => 'text',
                        'instructions' => 'e.g. March 2025',
                    ],
                    [
                        'key'           => 'field_loc_t_bg',
                        'label'         => 'Avatar Gradient',
                        'name'          => 'avatar_bg',
                        'type'          => 'text',
                        'default_value' => 'from-blue-500 to-blue-700',
                        'instructions'  => 'Tailwind gradient classes, e.g. from-blue-500 to-blue-700 / from-indigo-500 to-indigo-700 / from-teal-500 to-teal-700',
                    ],
                ],
            ],

            // ============================================================
            // TAB 5 — OTHER BRANCHES (images shown in the S5 cards)
            // ============================================================
            [
                'key'   => 'field_loc_tab_other_branches',
                'label' => 'Other Branches',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_loc_other_emsworth_image',
                'label'         => 'Emsworth Card Image',
                'name'          => 'branch_other_emsworth_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image for the Emsworth card in the "Other Southdowns Branches" section. Recommended: 600×400px. Leave empty to use the default stock photo.',
            ],
            [
                'key'           => 'field_loc_other_bosmere_image',
                'label'         => 'Bosmere Card Image',
                'name'          => 'branch_other_bosmere_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image for the Bosmere card in the "Other Southdowns Branches" section. Recommended: 600×400px. Leave empty to use the default stock photo.',
            ],
            [
                'key'           => 'field_loc_other_rowlands_image',
                'label'         => 'Rowlands Castle Card Image',
                'name'          => 'branch_other_rowlands_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image for the Rowlands Castle card in the "Other Southdowns Branches" section. Recommended: 600×400px. Leave empty to use the default stock photo.',
            ],
            [
                'key'           => 'field_loc_other_davies_image',
                'label'         => 'Davies Pharmacy Card Image',
                'name'          => 'branch_other_davies_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image for the Davies Pharmacy card in the "Other Southdowns Branches" section. Recommended: 600×400px. Leave empty to use the default stock photo.',
            ],

        ], // end fields
    ] ); // end acf_add_local_field_group

} );
