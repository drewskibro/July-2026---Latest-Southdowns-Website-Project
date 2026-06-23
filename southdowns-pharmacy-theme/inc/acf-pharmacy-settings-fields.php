<?php
/**
 * ACF Local Field Group — Pharmacy Settings → Branch Locations
 *
 * Registers per-branch fields on the global "Branch Locations" sub-page
 * (registered in functions.php via acf_add_options_sub_page).
 *
 * Field naming convention is `sp_branch_<n>_<key>` so that the existing
 * sp_branch() helper in functions.php picks them up automatically:
 *
 *   foreach ( array_keys( $b ) as $key ) {
 *       $acf_value = sp_option( 'sp_branch_' . $branch . '_' . $key );
 *       if ( $acf_value !== '' ) { $b[ $key ] = $acf_value; }
 *   }
 *
 * Fields per branch:
 *   - card_image      (image URL — used in the locations grid across all pages)
 *   - name
 *   - address_line1, address_line2, city, postcode
 *   - phone
 *   - hours_weekday, hours_saturday
 *   - maps_url
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    $branches = [
        1 => 'Emsworth',
        2 => 'Havant',
        3 => 'Davies Pharmacy',
        4 => 'Rowlands Castle',
    ];

    $fields = [];

    foreach ( $branches as $n => $label ) {

        // Tab: branch label
        $fields[] = [
            'key'   => "field_sp_branch_{$n}_tab",
            'label' => $label,
            'name'  => '',
            'type'  => 'tab',
        ];

        $fields[] = [
            'key'           => "field_sp_branch_{$n}_card_image",
            'label'         => 'Card Image',
            'name'          => "sp_branch_{$n}_card_image",
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
            'instructions'  => 'Used in the "Book at Your Nearest Hampshire Branch" locations grid on every page that lists all four branches. Recommended 600 × 450 px (4:3).',
        ];

        $fields[] = [
            'key'         => "field_sp_branch_{$n}_name",
            'label'       => 'Branch Name',
            'name'        => "sp_branch_{$n}_name",
            'type'        => 'text',
            'placeholder' => $label,
        ];

        $fields[] = [
            'key'   => "field_sp_branch_{$n}_address_line1",
            'label' => 'Address Line 1',
            'name'  => "sp_branch_{$n}_address_line1",
            'type'  => 'text',
        ];

        $fields[] = [
            'key'   => "field_sp_branch_{$n}_address_line2",
            'label' => 'Address Line 2',
            'name'  => "sp_branch_{$n}_address_line2",
            'type'  => 'text',
        ];

        $fields[] = [
            'key'   => "field_sp_branch_{$n}_city",
            'label' => 'City / Region',
            'name'  => "sp_branch_{$n}_city",
            'type'  => 'text',
        ];

        $fields[] = [
            'key'   => "field_sp_branch_{$n}_postcode",
            'label' => 'Postcode',
            'name'  => "sp_branch_{$n}_postcode",
            'type'  => 'text',
        ];

        $fields[] = [
            'key'   => "field_sp_branch_{$n}_phone",
            'label' => 'Phone',
            'name'  => "sp_branch_{$n}_phone",
            'type'  => 'text',
        ];

        $fields[] = [
            'key'          => "field_sp_branch_{$n}_hours_weekday",
            'label'        => 'Weekday Hours',
            'name'         => "sp_branch_{$n}_hours_weekday",
            'type'         => 'text',
            'instructions' => 'e.g. "Mon–Fri: 9:00am – 6:00pm"',
        ];

        $fields[] = [
            'key'          => "field_sp_branch_{$n}_hours_saturday",
            'label'        => 'Saturday Hours',
            'name'         => "sp_branch_{$n}_hours_saturday",
            'type'         => 'text',
            'instructions' => 'e.g. "Saturday: 9:00am – 1:00pm". Leave empty if closed on Saturday.',
        ];

        $fields[] = [
            'key'          => "field_sp_branch_{$n}_hours_sunday",
            'label'        => 'Sunday Hours',
            'name'         => "sp_branch_{$n}_hours_sunday",
            'type'         => 'text',
            'instructions' => 'e.g. "Sunday: 10:00am – 4:00pm". Leave empty if closed on Sunday.',
        ];

        $fields[] = [
            'key'          => "field_sp_branch_{$n}_maps_url",
            'label'        => 'Google Maps URL',
            'name'         => "sp_branch_{$n}_maps_url",
            'type'         => 'url',
            'instructions' => 'Direct link to this branch on Google Maps.',
        ];
    }

    acf_add_local_field_group( [
        'key'                   => 'group_pharmacy_branch_locations',
        'title'                 => 'Branch Locations',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,

        'location' => [
            [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-branch-locations' ] ],
        ],

        'fields' => $fields,
    ] );

} );

/**
 * Footer brand text — global, edited under Pharmacy Settings.
 * Wired in footer.php via sp_option().
 */
add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }
    acf_add_local_field_group( [
        'key'             => 'group_pharmacy_footer',
        'title'           => 'Footer',
        'style'           => 'default',
        'label_placement' => 'top',
        'location'        => [
            [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'pharmacy-settings' ] ],
        ],
        'fields' => [
            [ 'key' => 'field_sp_footer_tagline', 'label' => 'Footer Tagline', 'name' => 'sp_footer_tagline', 'type' => 'text', 'default_value' => 'Independent. Innovative. Community Focused.' ],
            [ 'key' => 'field_sp_footer_blurb', 'label' => 'Footer Blurb', 'name' => 'sp_footer_blurb', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Providing award-winning NHS and private healthcare services across four locations in Hampshire, with a NaTHNaC-registered Yellow Fever Vaccination Centre at Bosmere Pharmacy, Havant.' ],
        ],
    ] );
} );
