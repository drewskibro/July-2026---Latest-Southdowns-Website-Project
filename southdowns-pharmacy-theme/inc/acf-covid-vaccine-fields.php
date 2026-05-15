<?php
/**
 * ACF Local Field Groups — COVID-19 Vaccine Pages
 *
 * Two field groups, one per template:
 *
 *   1. NHS COVID-19 Vaccine — page-templates/page-covid-vaccine.php
 *      High-churn fields: hero copy, programme name, eligibility list,
 *      eligibility cards, private-promo body, final CTA copy.
 *
 *   2. Private COVID-19 Vaccine — page-templates/page-covid-vaccine-private.php
 *      High-churn fields: hero copy, price (single source of truth),
 *      inclusions list, final CTA copy.
 *
 * Position: acf_after_title (requires Classic Editor — see functions.php).
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ==========================================================
    // GROUP 1 · NHS COVID-19 Vaccine
    // ==========================================================
    acf_add_local_field_group( [
        'key'                   => 'group_covid_nhs_page',
        'title'                 => 'NHS COVID-19 Vaccine — Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-covid-vaccine.php' ] ],
        ],

        'fields' => [

            // ---- Tab 1 · Hero ------------------------------------
            [ 'key' => 'field_cv_nhs_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_cv_nhs_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'cv_nhs_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Displayed on the right half of the hero section (desktop) and as the background on mobile. Minimum 1200 × 800 px. Leave empty to use the default image.',
            ],
            [
                'key'         => 'field_cv_nhs_hero_badge',
                'label'       => 'Hero Badge Text',
                'name'        => 'cv_nhs_hero_badge',
                'type'        => 'text',
                'placeholder' => 'NHS Seasonal Vaccination · Hampshire',
            ],
            [
                'key'         => 'field_cv_nhs_hero_headline',
                'label'       => 'Hero Headline (H1)',
                'name'        => 'cv_nhs_hero_headline',
                'type'        => 'text',
                'placeholder' => 'Free NHS COVID-19 Vaccination at Southdowns Pharmacy',
            ],
            [
                'key'         => 'field_cv_nhs_hero_body',
                'label'       => 'Hero Body Text',
                'name'        => 'cv_nhs_hero_body',
                'type'        => 'textarea',
                'rows'        => 3,
                'placeholder' => 'Eligible patients can receive their seasonal COVID-19 vaccine free of charge at any of our four Hampshire locations. No long waits, no hassle — walk in or book online today.',
            ],

            // ---- Tab 2 · Programme -------------------------------
            [ 'key' => 'field_cv_nhs_tab_programme', 'label' => 'Programme', 'name' => '', 'type' => 'tab' ],
            [
                'key'           => 'field_cv_nhs_programme_image',
                'label'         => 'Programme Image',
                'name'          => 'cv_nhs_programme_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image shown in the "Protecting Those Most at Risk" two-column intro. Recommended 800 × 600 px (4:3). Leave empty to use the default image.',
            ],
            [
                'key'          => 'field_cv_nhs_programme_name',
                'label'        => 'Programme Name',
                'name'         => 'cv_nhs_programme_name',
                'type'         => 'text',
                'instructions' => 'Updated each season — appears on the programme card and final CTA badges.',
                'placeholder'  => 'Spring 2026 Programme',
            ],
            [
                'key'          => 'field_cv_nhs_programme_intro',
                'label'        => 'Programme Intro Paragraph',
                'name'         => 'cv_nhs_programme_intro',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Lead paragraph above the eligible-groups list inside the programme card.',
                'placeholder'  => 'For Spring 2026, the JCVI has updated its advice, focusing the programme on those at highest risk of serious disease. Free NHS COVID-19 vaccinations are now offered to the following groups only:',
            ],
            [
                'key'          => 'field_cv_nhs_programme_groups',
                'label'        => 'Eligible Groups (Bullet List)',
                'name'         => 'cv_nhs_programme_groups',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'table',
                'button_label' => 'Add Group',
                'instructions' => 'One short line per eligible cohort. Leave empty to fall back to current defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_cv_nhs_programme_group_text', 'label' => 'Group', 'name' => 'text', 'type' => 'text' ],
                ],
            ],

            // ---- Tab 3 · Eligibility -----------------------------
            [ 'key' => 'field_cv_nhs_tab_eligibility', 'label' => 'Eligibility', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_cv_nhs_elig_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'cv_nhs_elig_eyebrow',
                'type'        => 'text',
                'placeholder' => 'Spring 2026 Eligibility',
            ],
            [
                'key'         => 'field_cv_nhs_elig_headline',
                'label'       => 'Headline',
                'name'        => 'cv_nhs_elig_headline',
                'type'        => 'text',
                'placeholder' => 'Are You Eligible for a Free NHS COVID Vaccine?',
            ],
            [
                'key'         => 'field_cv_nhs_elig_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'cv_nhs_elig_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'The Spring 2026 programme is targeted at those at highest risk. Check whether you qualify below.',
            ],
            [
                'key'          => 'field_cv_nhs_elig_cards',
                'label'        => 'Eligibility Cards',
                'name'         => 'cv_nhs_elig_cards',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 6,
                'layout'       => 'block',
                'button_label' => 'Add Card',
                'instructions' => 'Each card has a short title and a body paragraph. Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_cv_nhs_elig_card_title', 'label' => 'Card Title', 'name' => 'title', 'type' => 'text' ],
                    [ 'key' => 'field_cv_nhs_elig_card_body',  'label' => 'Card Body',  'name' => 'body',  'type' => 'textarea', 'rows' => 4 ],
                ],
            ],

            // ---- Tab 4 · Locations -------------------------------
            [ 'key' => 'field_cv_nhs_tab_locations', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_cv_nhs_locations_eyebrow',
                'label'        => 'Eyebrow Text',
                'name'         => 'cv_nhs_locations_eyebrow',
                'type'         => 'text',
                'instructions' => 'Small badge above the locations grid headline.',
                'placeholder'  => '4 Locations Across Hampshire',
            ],
            [
                'key'         => 'field_cv_nhs_locations_headline',
                'label'       => 'Headline',
                'name'        => 'cv_nhs_locations_headline',
                'type'        => 'text',
                'placeholder' => 'Book at Your Nearest Hampshire Branch',
            ],
            [
                'key'         => 'field_cv_nhs_locations_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'cv_nhs_locations_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'Free NHS COVID-19 vaccinations available at all four Southdowns Pharmacy locations.',
            ],

            // ---- Tab 5 · Private Promo & Final CTA ---------------
            [ 'key' => 'field_cv_nhs_tab_cta', 'label' => 'Promo & Final CTA', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_cv_nhs_promo_body',
                'label'        => 'Private Vaccine Promo Body',
                'name'         => 'cv_nhs_promo_body',
                'type'         => 'textarea',
                'rows'         => 4,
                'instructions' => 'Body text in the "Not Eligible?" section. May reference the private price (currently £89.50). Basic HTML allowed.',
                'placeholder'  => 'If you don\'t currently meet the NHS eligibility criteria for Spring 2026, you can still protect yourself with our private COVID-19 vaccination service. We offer the latest Pfizer COVID-19 vaccine privately for <strong>£89.50 per dose</strong> — ideal for those who want to stay protected but fall outside the current NHS cohorts.',
            ],
            [
                'key'         => 'field_cv_nhs_final_cta_headline',
                'label'       => 'Final CTA Headline',
                'name'        => 'cv_nhs_final_cta_headline',
                'type'        => 'text',
                'placeholder' => 'Protect Yourself This Season — Book Your Free NHS COVID Vaccine Today',
            ],
            [
                'key'         => 'field_cv_nhs_final_cta_body',
                'label'       => 'Final CTA Body',
                'name'        => 'cv_nhs_final_cta_body',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'All four Southdowns Pharmacy locations offer NHS COVID-19 vaccination for eligible patients. Walk in during opening hours or book online now.',
            ],

        ],
    ] );


    // ==========================================================
    // GROUP 2 · Private COVID-19 Vaccine
    // ==========================================================
    acf_add_local_field_group( [
        'key'                   => 'group_covid_private_page',
        'title'                 => 'Private COVID-19 Vaccine — Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-covid-vaccine-private.php' ] ],
        ],

        'fields' => [

            // ---- Tab 1 · Hero ------------------------------------
            [ 'key' => 'field_cv_priv_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_cv_priv_hero_badge',
                'label'       => 'Hero Badge Text',
                'name'        => 'cv_priv_hero_badge',
                'type'        => 'text',
                'placeholder' => 'Private COVID-19 Vaccination · Hampshire',
            ],
            [
                'key'         => 'field_cv_priv_hero_headline',
                'label'       => 'Hero Headline (H1)',
                'name'        => 'cv_priv_hero_headline',
                'type'        => 'text',
                'placeholder' => 'Private COVID-19 Vaccine in Hampshire — Available Today',
            ],
            [
                'key'         => 'field_cv_priv_hero_body',
                'label'       => 'Hero Body Text',
                'name'        => 'cv_priv_hero_body',
                'type'        => 'textarea',
                'rows'        => 3,
                'placeholder' => 'Get your COVID-19 vaccine without NHS eligibility. The latest Pfizer vaccine — administered same-day by our GPhC-registered pharmacists across all four Hampshire locations.',
            ],
            [
                'key'           => 'field_cv_priv_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'cv_priv_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Shown on the right half of the hero (desktop) and as the full-bleed background on mobile. Recommended: 1200 × 800 px or larger.',
            ],
            [
                'key'           => 'field_cv_priv_s3_image',
                'label'         => 'Who Is This For — Image',
                'name'          => 'cv_priv_s3_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Image displayed on the right side of the "Who Is This For?" section. Recommended: 800 × 600 px. Ideally a pharmacist or patient consultation photo.',
            ],

            // ---- Tab 2 · Pricing (single source of truth) --------
            [ 'key' => 'field_cv_priv_tab_pricing', 'label' => 'Pricing', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_cv_priv_price',
                'label'        => 'Price',
                'name'         => 'cv_priv_price',
                'type'         => 'text',
                'instructions' => 'Single source of truth — appears on the pricing card, "Book Now" button, Why-Southdowns inclusion line, final CTA badges and trust row.',
                'placeholder'  => '£89.50',
            ],
            [
                'key'          => 'field_cv_priv_price_label',
                'label'        => 'Price Label',
                'name'         => 'cv_priv_price_label',
                'type'         => 'text',
                'instructions' => 'Small caption beneath the price.',
                'placeholder'  => 'per person · all-inclusive',
            ],
            [
                'key'          => 'field_cv_priv_inclusions',
                'label'        => 'Pricing Card Inclusions',
                'name'         => 'cv_priv_inclusions',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'table',
                'button_label' => 'Add Inclusion',
                'instructions' => 'Items shown beneath the price. Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_cv_priv_inclusion_text', 'label' => 'Inclusion', 'name' => 'text', 'type' => 'text' ],
                ],
            ],

            // ---- Tab 3 · Final CTA -------------------------------
            [ 'key' => 'field_cv_priv_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_cv_priv_final_cta_headline',
                'label'        => 'Final CTA Headline',
                'name'         => 'cv_priv_final_cta_headline',
                'type'         => 'text',
                'instructions' => 'Use <br> to force line breaks if needed.',
                'placeholder'  => 'Stay Protected.<br>Book Your Private<br>COVID-19 Vaccine Today.',
            ],
            [
                'key'         => 'field_cv_priv_final_cta_body',
                'label'       => 'Final CTA Body',
                'name'        => 'cv_priv_final_cta_body',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'No waiting lists. No eligibility criteria. Just the Pfizer vaccine, administered by our expert team — at a time that suits you.',
            ],

        ],
    ] );

} );
