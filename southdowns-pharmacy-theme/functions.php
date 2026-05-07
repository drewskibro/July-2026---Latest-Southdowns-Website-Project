<?php
/**
 * Southdowns Pharmacy — functions.php
 * Core theme setup, ACF options page, helper functions, asset enqueuing.
 */

// ============================================================
// THEME SETUP
// ============================================================

add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo' );

    register_nav_menus( [
        'primary'        => __( 'Primary Navigation', 'southdowns-pharmacy' ),
        'footer-services' => __( 'Footer Services', 'southdowns-pharmacy' ),
        'footer-info'    => __( 'Footer Information', 'southdowns-pharmacy' ),
    ] );
} );


// ============================================================
// ACF OPTIONS PAGE (Pharmacy Settings)
// ============================================================

add_action( 'acf/init', function() {
    if ( function_exists( 'acf_add_options_page' ) ) {

        acf_add_options_page( [
            'page_title'  => 'Pharmacy Settings',
            'menu_title'  => 'Pharmacy Settings',
            'menu_slug'   => 'pharmacy-settings',
            'capability'  => 'manage_options',
            'icon_url'    => 'dashicons-heart',
            'position'    => 2,
            'redirect'    => false,
        ] );

        acf_add_options_sub_page( [
            'page_title'  => 'Branch Locations',
            'menu_title'  => 'Branch Locations',
            'parent_slug' => 'pharmacy-settings',
        ] );

        acf_add_options_sub_page( [
            'page_title'  => 'Contact & Social',
            'menu_title'  => 'Contact & Social',
            'parent_slug' => 'pharmacy-settings',
        ] );
    }
} );


// ============================================================
// HELPER FUNCTIONS
// ============================================================

/**
 * Get a global pharmacy options field (ACF options page).
 * Usage: sp_option( 'sp_pharmacy_name' )
 *
 * @param string $field_name  ACF field name.
 * @param mixed  $fallback    Default value if field is empty.
 * @return mixed
 */
function sp_option( string $field_name, $fallback = '' ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $fallback;
    }
    $value = get_field( $field_name, 'option' );
    if ( $value === null || $value === '' || $value === false ) {
        return $fallback;
    }
    return $value;
}

/**
 * Get a page-level ACF field, falling back to options then hardcoded default.
 * Usage: sp_field( 'yf_hero_headline', 'Yellow Fever Vaccination' )
 *
 * @param string $field_name  ACF field name.
 * @param mixed  $fallback    Default value if field is empty on both page and options.
 * @return mixed
 */
function sp_field( string $field_name, $fallback = '' ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $fallback;
    }
    $value = get_field( $field_name );
    if ( $value === null || $value === '' || $value === false ) {
        return $fallback;
    }
    return $value;
}

/**
 * Pharmacy name.
 */
function sp_pharmacy_name(): string {
    return sp_option( 'sp_pharmacy_name', 'Southdowns Pharmacy' );
}

/**
 * Primary phone number (raw, for tel: links).
 */
function sp_phone_raw(): string {
    return sp_option( 'sp_phone_raw', '02392123456' );
}

/**
 * Primary phone number (formatted, for display).
 */
function sp_phone(): string {
    return sp_option( 'sp_phone_display', '023 9212 3456' );
}

/**
 * Primary booking URL.
 */
function sp_booking_url(): string {
    return sp_option( 'sp_booking_url', '#' );
}

/**
 * Logo URL (falls back to Customizer logo, then theme asset).
 */
function sp_logo_url(): string {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    if ( $custom_logo_id ) {
        $logo = wp_get_attachment_image_url( $custom_logo_id, 'full' );
        if ( $logo ) return $logo;
    }
    return sp_option( 'sp_logo_url', 'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773141719755-0.png' );
}

/**
 * Primary contact email.
 */
function sp_email(): string {
    return sp_option( 'sp_email', 'info@southdownspharmacy.co.uk' );
}

/**
 * Get a specific branch's data by number (1–4).
 * Returns array: card_image, name, address_line1, address_line2, city, postcode, phone, hours_weekday, hours_saturday, hours_sunday, maps_url
 *
 * Override any value via Pharmacy Settings → Branch Locations
 * (ACF field name: sp_branch_<n>_<key>).
 *
 * @param int $branch  Branch number 1–4.
 * @return array
 */
function sp_branch( int $branch ): array {
    $defaults = [
        1 => [
            'card_image'      => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80&auto=format&fit=crop',
            'name'            => 'Emsworth',
            'address_line1'   => '2-4 Central Buildings',
            'address_line2'   => 'Emsworth',
            'city'            => 'Hampshire',
            'postcode'        => 'PO10 7DU',
            'phone'           => '023 9212 3456',
            'hours_weekday'   => 'Mon–Fri: 9:00am – 6:00pm',
            'hours_saturday'  => 'Saturday: 9:00am – 1:00pm',
            'hours_sunday'    => '',
            'maps_url'        => '#',
        ],
        2 => [
            'card_image'      => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=600&q=80&auto=format&fit=crop',
            'name'            => 'Havant',
            'address_line1'   => 'Bosmere Medical Centre, Solent Road',
            'address_line2'   => 'Havant',
            'city'            => 'Hampshire',
            'postcode'        => 'PO9 1DQ',
            'phone'           => '023 9212 3456',
            'hours_weekday'   => 'Mon–Fri: 9:00am – 6:00pm',
            'hours_saturday'  => 'Saturday: 9:00am – 1:00pm',
            'hours_sunday'    => '',
            'maps_url'        => '#',
        ],
        3 => [
            'card_image'      => 'https://images.unsplash.com/photo-1576602976047-174e57a47881?w=600&q=80&auto=format&fit=crop',
            'name'            => 'Davies Pharmacy',
            'address_line1'   => '',
            'address_line2'   => '',
            'city'            => 'Hampshire',
            'postcode'        => '',
            'phone'           => '023 9212 3456',
            'hours_weekday'   => 'Mon–Fri: 9:00am – 6:00pm',
            'hours_saturday'  => 'Saturday: 9:00am – 1:00pm',
            'hours_sunday'    => '',
            'maps_url'        => '#',
        ],
        4 => [
            'card_image'      => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600&q=80&auto=format&fit=crop',
            'name'            => 'Rowlands Castle',
            'address_line1'   => '12 The Green',
            'address_line2'   => 'Rowlands Castle',
            'city'            => 'Hampshire',
            'postcode'        => 'PO9 6BN',
            'phone'           => '023 9212 3456',
            'hours_weekday'   => 'Mon–Fri: 9:00am – 6:00pm',
            'hours_saturday'  => 'Saturday: 9:00am – 1:00pm',
            'hours_sunday'    => '',
            'maps_url'        => '#',
        ],
    ];

    $b = $defaults[ $branch ] ?? $defaults[1];

    // Override with ACF options if set
    $prefix = 'sp_branch_' . $branch . '_';
    foreach ( array_keys( $b ) as $key ) {
        $acf_value = sp_option( $prefix . $key );
        if ( $acf_value !== '' ) {
            $b[ $key ] = $acf_value;
        }
    }

    return $b;
}

/**
 * Render a branch's opening hours as escaped HTML, one line per day group
 * (weekday / saturday / sunday). Empty values are skipped.
 *
 * Output is `esc_html`-applied per line and joined with `<br>`, so the
 * caller can echo directly (HTML-safe by construction).
 *
 * @param array $b  Branch data array as returned by sp_branch().
 * @return string
 */
function sp_branch_hours_html( array $b ): string {
    $lines = array_filter( [
        $b['hours_weekday']  ?? '',
        $b['hours_saturday'] ?? '',
        $b['hours_sunday']   ?? '',
    ] );
    return implode( '<br>', array_map( 'esc_html', $lines ) );
}


// ============================================================
// ASSET ENQUEUING
// ============================================================

add_action( 'wp_enqueue_scripts', function() {
    $ver = wp_get_theme()->get( 'Version' );

    // Tailwind CSS CDN
    wp_enqueue_script(
        'tailwind-cdn',
        'https://cdn.tailwindcss.com',
        [],
        null,
        false
    );

    // Tailwind config (Jost font family)
    wp_add_inline_script( 'tailwind-cdn', '
        tailwind.config = {
            content: [],
            theme: {
                extend: {
                    fontFamily: {
                        jost: ["Jost", "sans-serif"]
                    }
                }
            }
        };
    ' );

    // Global theme stylesheet (Jost font + shared CSS classes)
    wp_enqueue_style(
        'southdowns-global',
        get_template_directory_uri() . '/assets/css/global.css',
        [],
        $ver
    );

    // Serif accent for headline emphasis (Playfair Display italic)
    wp_enqueue_style(
        'southdowns-serif',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400&display=swap',
        [],
        null
    );

    // Page-specific scripts
    $template = get_page_template_slug();

    if ( $template === 'page-templates/page-weight-loss.php' ) {
        wp_enqueue_script(
            'southdowns-weight-loss',
            get_template_directory_uri() . '/assets/js/weight-loss.js',
            [],
            $ver,
            true
        );
    }

    if ( $template === 'page-templates/page-travel-health.php' ) {
        wp_enqueue_script(
            'southdowns-travel-health',
            get_template_directory_uri() . '/assets/js/travel-health.js',
            [],
            $ver,
            true
        );
    }

    if ( $template === 'page-templates/page-yellow-fever.php' ) {
        wp_enqueue_script(
            'southdowns-yellow-fever',
            get_template_directory_uri() . '/assets/js/yellow-fever.js',
            [],
            $ver,
            true
        );
    }
} );


// ============================================================
// INCLUDE ACF FIELD GROUP REGISTRATIONS
// ============================================================

require_once get_template_directory() . '/inc/acf-pharmacy-settings-fields.php';
require_once get_template_directory() . '/inc/acf-location-fields.php';
require_once get_template_directory() . '/inc/acf-weight-loss-fields.php';
require_once get_template_directory() . '/inc/acf-covid-vaccine-fields.php';
require_once get_template_directory() . '/inc/acf-travel-health-fields.php';
require_once get_template_directory() . '/inc/acf-ear-wax-fields.php';


// ============================================================
// DISABLE GUTENBERG FOR CUSTOM PAGE TEMPLATES
// ============================================================

add_filter( 'use_block_editor_for_post', function( bool $use_block_editor, \WP_Post $post ): bool {
    $custom_templates = [
        'page-templates/page-home.php',
        'page-templates/page-weight-loss.php',
        'page-templates/page-travel-health.php',
        'page-templates/page-yellow-fever.php',
        // Location pages — acf_after_title requires classic editor
        'page-templates/page-location.php',
        'page-templates/page-emsworth.php',
        'page-templates/page-bosmere.php',
        // COVID-19 vaccine pages — acf_after_title requires classic editor
        'page-templates/page-covid-vaccine.php',
        'page-templates/page-covid-vaccine-private.php',
        // Ear wax removal — acf_after_title requires classic editor
        'page-templates/page-ear-wax.php',
    ];
    $template = get_page_template_slug( $post->ID );
    if ( in_array( $template, $custom_templates, true ) ) {
        return false;
    }
    return $use_block_editor;
}, 10, 2 );


// ============================================================
// JSON-LD SCHEMA (FAQPage — output per page template)
// ============================================================

add_action( 'wp_head', function() {
    // Individual page templates handle their own JSON-LD via wp_head hooks
    // or inline script blocks. This is a placeholder for global schema.
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Pharmacy',
        'name'     => sp_pharmacy_name(),
        'url'      => home_url(),
        'telephone' => sp_phone(),
        'email'    => sp_email(),
        'address'  => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '2-4 Central Buildings',
            'addressLocality' => 'Emsworth',
            'addressRegion'   => 'Hampshire',
            'postalCode'      => 'PO10 7DU',
            'addressCountry'  => 'GB',
        ],
        'openingHours' => [ 'Mo-Fr 09:00-18:00', 'Sa 09:00-13:00' ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
} );


// ============================================================
// DUPLICATE PAGE — Admin row action
// ============================================================

/**
 * Add a "Duplicate" link to the Pages list row actions.
 * Only shown to users who can edit pages.
 */
add_filter( 'page_row_actions', function( array $actions, \WP_Post $post ): array {
    if ( ! current_user_can( 'edit_pages' ) ) {
        return $actions;
    }
    $url = wp_nonce_url(
        admin_url( 'admin.php?action=sp_duplicate_page&post_id=' . $post->ID ),
        'sp_duplicate_page_' . $post->ID
    );
    $actions['sp_duplicate'] = '<a href="' . esc_url( $url ) . '">Duplicate</a>';
    return $actions;
}, 10, 2 );

/**
 * Handle the duplication request.
 *
 * Copies the post record and ALL post meta (ACF fields, page template,
 * featured image, etc.) to a new draft, then redirects to the edit screen.
 */
add_action( 'admin_action_sp_duplicate_page', function(): void {

    // 1. Validate post ID
    $post_id = isset( $_GET['post_id'] ) ? absint( $_GET['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_die( 'No page specified.' );
    }

    // 2. Permission check
    if ( ! current_user_can( 'edit_pages' ) ) {
        wp_die( 'You do not have permission to duplicate pages.' );
    }

    // 3. Nonce / CSRF check
    check_admin_referer( 'sp_duplicate_page_' . $post_id );

    // 4. Fetch the original post
    $original = get_post( $post_id );
    if ( ! $original || $original->post_type !== 'page' ) {
        wp_die( 'Page not found.' );
    }

    // 5. Insert the new post as a draft
    $new_id = wp_insert_post( [
        'post_title'     => $original->post_title . ' (Copy)',
        'post_status'    => 'draft',
        'post_type'      => 'page',
        'post_author'    => get_current_user_id(),
        'post_content'   => $original->post_content,
        'post_excerpt'   => $original->post_excerpt,
        'menu_order'     => $original->menu_order,
        'post_parent'    => $original->post_parent,
        'comment_status' => $original->comment_status,
    ], true ); // true = return WP_Error on failure

    if ( is_wp_error( $new_id ) ) {
        wp_die( 'Could not duplicate the page: ' . esc_html( $new_id->get_error_message() ) );
    }

    // 6. Copy all post meta — this includes:
    //    · _wp_page_template  (page template assignment)
    //    · _thumbnail_id      (featured image)
    //    · All ACF field values (stored as standard post meta rows)
    $all_meta = get_post_meta( $post_id );
    foreach ( $all_meta as $meta_key => $meta_values ) {
        foreach ( $meta_values as $meta_value ) {
            // get_post_meta() returns unserialized values;
            // add_post_meta() will re-serialize arrays/objects automatically.
            add_post_meta( $new_id, $meta_key, $meta_value );
        }
    }

    // 7. Open the edit screen for the new draft
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_id ) );
    exit;
} );
