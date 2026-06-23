<?php
/**
 * ACF Local Field Group — Travel Health Page
 *
 * Applies to: page-templates/page-travel-health.php
 * Position:   acf_after_title (requires Classic Editor — see functions.php)
 *
 * Wired incrementally, section by section. Tabs to be added as more
 * sections of the template are migrated to ACF.
 *
 * Tabs registered so far:
 *   1. Hero
 *   2. Stats Bar
 *   3. Why Choose Us
 *   4. Services
 *   5. Vaccines
 *   6. How It Works
 *   7. Trust / About
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'                   => 'group_travel_health_page',
        'title'                 => 'Travel Health — Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-travel-health.php' ] ],
        ],

        'fields' => [

            // ---- Tab 1 · Hero ------------------------------------
            [ 'key' => 'field_th_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_th_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'th_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Displayed on the right half of the hero (desktop) and as the background on mobile. Minimum 1200 × 800 px.',
            ],
            [
                'key'         => 'field_th_hero_badge',
                'label'       => 'Hero Badge Text',
                'name'        => 'th_hero_badge',
                'type'        => 'text',
                'placeholder' => 'No GP Referral · Same-Day Appointments',
            ],
            [
                'key'         => 'field_th_hero_headline',
                'label'       => 'Hero Headline (H1)',
                'name'        => 'th_hero_headline',
                'type'        => 'text',
                'placeholder' => 'Hampshire’s Trusted Travel Health Clinic',
            ],
            [
                'key'         => 'field_th_hero_body',
                'label'       => 'Hero Body Text',
                'name'        => 'th_hero_body',
                'type'        => 'textarea',
                'rows'        => 3,
                'placeholder' => 'Southdowns Pharmacy’s dedicated travel health service, serving Hampshire from 4 locations. Expert vaccination advice, same-day appointments, and everything you need to travel safely — all under one roof.',
            ],

            // ---- Tab 2 · Stats Bar -------------------------------
            [ 'key' => 'field_th_tab_stats', 'label' => 'Stats Bar', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_th_stats',
                'label'        => 'Stat Cards',
                'name'         => 'th_stats',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 4,
                'layout'       => 'block',
                'button_label' => 'Add Stat',
                'instructions' => 'Up to four stat cards. Leave empty to use defaults. Display order matches the order set here.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_stat_value',   'label' => 'Big Value',          'name' => 'value',   'type' => 'text', 'instructions' => 'e.g. "1,000+", "Same Day", "4.9★"' ],
                    [ 'key' => 'field_th_stat_label',   'label' => 'Label',              'name' => 'label',   'type' => 'text', 'instructions' => 'e.g. "Travellers Protected"' ],
                    [ 'key' => 'field_th_stat_caption', 'label' => 'Supporting Caption', 'name' => 'caption', 'type' => 'text', 'instructions' => 'Smaller line beneath the label.' ],
                ],
            ],

            // ---- Tab 3 · Why Choose Us ---------------------------
            [ 'key' => 'field_th_tab_why', 'label' => 'Why Choose Us', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_th_why_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'th_why_eyebrow',
                'type'        => 'text',
                'placeholder' => 'More Than Just Jabs',
            ],
            [
                'key'         => 'field_th_why_headline',
                'label'       => 'Headline',
                'name'        => 'th_why_headline',
                'type'        => 'text',
                'placeholder' => 'Why Choose Our Hampshire Travel Clinics?',
            ],
            [
                'key'         => 'field_th_why_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'th_why_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'Comprehensive travel health protection that gives you confidence from booking to landing.',
            ],
            [
                'key'          => 'field_th_why_cards',
                'label'        => 'Cards',
                'name'         => 'th_why_cards',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 3,
                'layout'       => 'block',
                'button_label' => 'Add Card',
                'instructions' => 'Up to three feature cards. Numbered badges (01/02/03) are generated automatically from card position. Leave empty to use defaults.',
                'sub_fields'   => [
                    [
                        'key'           => 'field_th_why_card_image',
                        'label'         => 'Image',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Recommended 600 × 400 px (3:2).',
                    ],
                    [ 'key' => 'field_th_why_card_title',      'label' => 'Title',      'name' => 'title',      'type' => 'text' ],
                    [ 'key' => 'field_th_why_card_body',       'label' => 'Body',       'name' => 'body',       'type' => 'textarea', 'rows' => 4 ],
                    [ 'key' => 'field_th_why_card_link_label', 'label' => 'Link Label', 'name' => 'link_label', 'type' => 'text', 'instructions' => 'e.g. "Book Consultation". Leave empty to hide the link.' ],
                    [ 'key' => 'field_th_why_card_link_url',   'label' => 'Link URL',   'name' => 'link_url',   'type' => 'url',  'instructions' => 'Full URL or in-page anchor (e.g. "#vaccines"). Leave empty to default to the global booking URL.' ],
                ],
            ],

            // ---- Tab 4 · Services --------------------------------
            [ 'key' => 'field_th_tab_services', 'label' => 'Services', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_th_services_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'th_services_eyebrow',
                'type'        => 'text',
                'placeholder' => 'Everything Under One Roof',
            ],
            [
                'key'         => 'field_th_services_headline',
                'label'       => 'Headline',
                'name'        => 'th_services_headline',
                'type'        => 'text',
                'placeholder' => 'Our Travel Health Services',
            ],
            [
                'key'         => 'field_th_services_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'th_services_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'One appointment covers everything. No GP, no hospital, no hassle — we handle your complete travel health needs in one visit.',
            ],
            [
                'key'          => 'field_th_services_cards',
                'label'        => 'Service Cards',
                'name'         => 'th_services_cards',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 6,
                'layout'       => 'block',
                'button_label' => 'Add Service',
                'instructions' => 'Up to six service cards. Card icons are template-driven and cycle through six built-in styles by position. Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_services_card_title',     'label' => 'Title',         'name' => 'title',        'type' => 'text' ],
                    [ 'key' => 'field_th_services_card_body',      'label' => 'Body',          'name' => 'body',         'type' => 'textarea', 'rows' => 4 ],
                    [
                        'key'          => 'field_th_services_card_bullets',
                        'label'        => 'Bullet Points',
                        'name'         => 'bullets',
                        'type'         => 'textarea',
                        'rows'         => 4,
                        'instructions' => 'One bullet per line. Empty lines are skipped.',
                        'new_lines'    => '',
                    ],
                    [
                        'key'           => 'field_th_services_card_is_highlight',
                        'label'         => 'Highlight Style',
                        'name'          => 'is_highlight',
                        'type'          => 'true_false',
                        'ui'            => 1,
                        'instructions'  => 'Switches the card to the amber "official centre" treatment (used by Yellow Fever).',
                        'default_value' => 0,
                    ],
                    [
                        'key'          => 'field_th_services_card_top_badge',
                        'label'        => 'Top Badge',
                        'name'         => 'top_badge',
                        'type'         => 'text',
                        'instructions' => 'Optional small uppercase badge above the title (e.g. "Official Vaccination Centre"). Leave empty to hide.',
                    ],
                    [ 'key' => 'field_th_services_card_link_label', 'label' => 'Link Label',   'name' => 'link_label',   'type' => 'text', 'instructions' => 'Optional CTA link beneath the card. Leave empty to hide.' ],
                    [ 'key' => 'field_th_services_card_link_url',   'label' => 'Link URL',     'name' => 'link_url',     'type' => 'url',  'instructions' => 'Full URL or in-page anchor.' ],
                ],
            ],
            [
                'key'         => 'field_th_services_cta_label',
                'label'       => 'Bottom CTA Label',
                'name'        => 'th_services_cta_label',
                'type'        => 'text',
                'placeholder' => 'Book Your Travel Health Appointment',
                'instructions' => 'Text on the large CTA button below the cards. Links to the global booking URL.',
            ],

            // ---- Tab 5 · Vaccines --------------------------------
            [ 'key' => 'field_th_tab_vaccines', 'label' => 'Vaccines', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_th_vaccines_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'th_vaccines_eyebrow',
                'type'        => 'text',
                'placeholder' => 'Always In Stock',
            ],
            [
                'key'         => 'field_th_vaccines_headline',
                'label'       => 'Headline',
                'name'        => 'th_vaccines_headline',
                'type'        => 'text',
                'placeholder' => 'Travel Vaccines We Provide',
            ],
            [
                'key'         => 'field_th_vaccines_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'th_vaccines_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'No prescription, no waiting lists, no GP appointments. All vaccines are available same-day across our 4 Hampshire locations.',
            ],
            [
                'key'          => 'field_th_vaccines_list',
                'label'        => 'Vaccine Tiles',
                'name'         => 'th_vaccines_list',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 0,
                'layout'       => 'table',
                'button_label' => 'Add Vaccine',
                'instructions' => 'Tiles render in a 3-column grid in the order set here. Leave empty to use defaults (12 vaccines).',
                'sub_fields'   => [
                    [ 'key' => 'field_th_vaccine_name',        'label' => 'Vaccine Name',  'name' => 'name',        'type' => 'text', 'instructions' => 'e.g. "Hepatitis A"' ],
                    [ 'key' => 'field_th_vaccine_description', 'label' => 'Short Description', 'name' => 'description', 'type' => 'text', 'instructions' => 'One-line caption beneath the name.' ],
                    [
                        'key'           => 'field_th_vaccine_is_yf',
                        'label'         => 'Yellow Fever Style',
                        'name'          => 'is_yf',
                        'type'          => 'true_false',
                        'ui'            => 1,
                        'instructions'  => 'Switches the tile to the amber/ICVP highlight treatment used by Yellow Fever.',
                        'default_value' => 0,
                    ],
                ],
            ],
            [
                'key'         => 'field_th_vaccines_banner_body',
                'label'       => 'Bottom Banner Copy',
                'name'        => 'th_vaccines_banner_body',
                'type'        => 'textarea',
                'rows'        => 2,
                'instructions' => 'Info banner below the tiles. Basic HTML allowed (e.g. <strong> for emphasis on lead times).',
                'placeholder' => 'Some vaccinations require a course of doses over several weeks. We recommend booking your appointment at least <strong>6–8 weeks before travel</strong>, though we can still help with last-minute trips.',
            ],
            [
                'key'         => 'field_th_vaccines_banner_cta_label',
                'label'       => 'Banner CTA Label',
                'name'        => 'th_vaccines_banner_cta_label',
                'type'        => 'text',
                'placeholder' => 'Book Now',
            ],

            // ---- Tab 6 · How It Works ----------------------------
            [ 'key' => 'field_th_tab_how', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_th_how_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'th_how_eyebrow',
                'type'        => 'text',
                'placeholder' => 'Simple & Straightforward',
            ],
            [
                'key'         => 'field_th_how_headline',
                'label'       => 'Headline',
                'name'        => 'th_how_headline',
                'type'        => 'text',
                'placeholder' => 'How Your Appointment Works',
            ],
            [
                'key'         => 'field_th_how_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'th_how_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'From booking to protected — it really is this simple. No GP referral, no long waits, no unnecessary visits.',
            ],
            [
                'key'          => 'field_th_how_steps',
                'label'        => 'Step Cards',
                'name'         => 'th_how_steps',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 3,
                'layout'       => 'block',
                'button_label' => 'Add Step',
                'instructions' => 'Up to three step cards. The STEP 1/2/3 badge is generated automatically from card position. Step 1 also shows the global Book Online / Call Us buttons; steps 2 and 3 show their bullet points. Leave empty to use defaults.',
                'sub_fields'   => [
                    [
                        'key'           => 'field_th_how_step_image',
                        'label'         => 'Image',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Recommended 600 × 400 px (3:2).',
                    ],
                    [ 'key' => 'field_th_how_step_image_alt', 'label' => 'Image Alt Text', 'name' => 'image_alt', 'type' => 'text', 'instructions' => 'Describes the image for accessibility & SEO.' ],
                    [ 'key' => 'field_th_how_step_title',     'label' => 'Title',          'name' => 'title',     'type' => 'text' ],
                    [ 'key' => 'field_th_how_step_body',      'label' => 'Body',           'name' => 'body',      'type' => 'textarea', 'rows' => 4 ],
                    [
                        'key'          => 'field_th_how_step_bullets',
                        'label'        => 'Bullet Points',
                        'name'         => 'bullets',
                        'type'         => 'textarea',
                        'rows'         => 3,
                        'instructions' => 'One bullet per line. Empty lines are skipped. Only shown on steps 2 and 3 (step 1 displays the Book Online / Call Us buttons instead).',
                        'new_lines'    => '',
                    ],
                ],
            ],

            // ---- Tab 7 · Trust / About ---------------------------
            [ 'key' => 'field_th_tab_trust', 'label' => 'Trust / About', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_th_trust_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'th_trust_eyebrow',
                'type'        => 'text',
                'placeholder' => 'GPhC Registered · NHS Partner',
            ],
            [
                'key'         => 'field_th_trust_headline',
                'label'       => 'Headline',
                'name'        => 'th_trust_headline',
                'type'        => 'text',
                'placeholder' => 'Hampshire’s Dedicated Travel Health Experts',
            ],
            [
                'key'         => 'field_th_trust_intro',
                'label'       => 'Intro Paragraph',
                'name'        => 'th_trust_intro',
                'type'        => 'textarea',
                'rows'        => 3,
                'placeholder' => 'Southdowns Pharmacy Group has been protecting Hampshire travellers for years. Our dedicated travel health team combines clinical expertise with genuine care to make your trip preparation as straightforward as possible.',
            ],
            [
                'key'          => 'field_th_trust_points',
                'label'        => 'Trust Points',
                'name'         => 'th_trust_points',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 6,
                'layout'       => 'block',
                'button_label' => 'Add Trust Point',
                'instructions' => 'Bullet list with blue tick icons. Leave empty to use the four built-in points.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_trust_point_title', 'label' => 'Heading', 'name' => 'title', 'type' => 'text' ],
                    [ 'key' => 'field_th_trust_point_body',  'label' => 'Body',    'name' => 'body',  'type' => 'textarea', 'rows' => 3, 'instructions' => 'Basic HTML allowed (e.g. <strong>).' ],
                ],
            ],
            [
                'key'         => 'field_th_trust_cta_label',
                'label'       => 'CTA Button Label',
                'name'        => 'th_trust_cta_label',
                'type'        => 'text',
                'placeholder' => 'Book Your Appointment',
                'instructions' => 'Button beneath the trust points. Links to the global booking URL.',
            ],
            [
                'key'           => 'field_th_trust_image',
                'label'         => 'Main Photo',
                'name'          => 'th_trust_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Tall portrait photo on the right. Recommended 700 × 900 px (4:5).',
            ],
            [
                'key'         => 'field_th_trust_image_alt',
                'label'       => 'Main Photo Alt Text',
                'name'        => 'th_trust_image_alt',
                'type'        => 'text',
                'placeholder' => 'Southdowns Pharmacy travel health pharmacist',
            ],
            [
                'key'         => 'field_th_trust_badge_title',
                'label'       => 'Floating Badge — Title',
                'name'        => 'th_trust_badge_title',
                'type'        => 'text',
                'placeholder' => 'GPhC Registered',
                'instructions' => 'Bold text in the bottom-left floating badge.',
            ],
            [
                'key'         => 'field_th_trust_badge_body',
                'label'       => 'Floating Badge — Body',
                'name'        => 'th_trust_badge_body',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'Fully qualified travel health pharmacists at all 4 locations',
            ],
            [
                'key'         => 'field_th_trust_badge_rating',
                'label'       => 'Floating Badge — Rating Text',
                'name'        => 'th_trust_badge_rating',
                'type'        => 'text',
                'placeholder' => '4.9/5 Rating',
                'instructions' => 'Caption next to the 5-star row in the bottom-left badge.',
            ],
            [
                'key'         => 'field_th_trust_stat_value',
                'label'       => 'Stat Badge — Big Number',
                'name'        => 'th_trust_stat_value',
                'type'        => 'text',
                'placeholder' => '1,000+',
                'instructions' => 'Large stat in the top-right floating badge.',
            ],
            [
                'key'         => 'field_th_trust_stat_caption',
                'label'       => 'Stat Badge — Caption',
                'name'        => 'th_trust_stat_caption',
                'type'        => 'text',
                'placeholder' => 'Travellers protected each year',
            ],

            // ============================================================
            // TAB — DESTINATIONS / FAQ / CTA  (previously hardcoded grids)
            // ============================================================
            [ 'key' => 'field_th_tab_extras', 'label' => 'Destinations / FAQ / CTA', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_th_destinations',
                'label'        => 'Destination Cards (“Where Are You Headed?”)',
                'name'         => 'th_destinations',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 16,
                'layout'       => 'block',
                'button_label' => 'Add Destination',
                'instructions' => 'Photo cards in the destinations grid. Leave empty to use the eight built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_dest_image',    'label' => 'Image',    'name' => 'image',    'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'instructions' => 'Recommended 600 × 450 px. Leave empty to keep the built-in photo for this position.' ],
                    [ 'key' => 'field_th_dest_region',   'label' => 'Region',   'name' => 'region',   'type' => 'text', 'instructions' => 'Small label above the name, e.g. "Southeast Asia".' ],
                    [ 'key' => 'field_th_dest_name',     'label' => 'Name',     'name' => 'name',     'type' => 'text', 'instructions' => 'e.g. "Thailand".' ],
                    [ 'key' => 'field_th_dest_vaccines', 'label' => 'Vaccines', 'name' => 'vaccines', 'type' => 'text', 'instructions' => 'Short caption, e.g. "Hep A/B · Typhoid · Rabies".' ],
                ],
            ],
            [
                'key'          => 'field_th_faqs',
                'label'        => 'FAQ Items',
                'name'         => 'th_faqs',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 30,
                'layout'       => 'block',
                'button_label' => 'Add FAQ',
                'instructions' => 'Accordion items (numbers added automatically). Answers accept basic HTML. Leave empty to use the eight built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
                    [ 'key' => 'field_th_faq_answer',   'label' => 'Answer',   'name' => 'answer',   'type' => 'textarea', 'rows' => 5, 'instructions' => 'Basic HTML allowed.' ],
                ],
            ],
            [
                'key'          => 'field_th_pills',
                'label'        => 'Final CTA — Trust Pills',
                'name'         => 'th_pills',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'table',
                'button_label' => 'Add Pill',
                'instructions' => 'Small badges in the final call-to-action. Icons cycle by position. Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ],
                ],
            ],
            [
                'key'          => 'field_th_checklist',
                'label'        => 'Final CTA — Checklist',
                'name'         => 'th_checklist',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 12,
                'layout'       => 'table',
                'button_label' => 'Add Item',
                'instructions' => 'Ticked list in the final call-to-action. Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_th_checklist_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ],
                ],
            ],

        ],
    ] );

} );
