<?php
/**
 * ACF Local Field Group — Weight Loss Page
 *
 * Applies to: page-templates/page-weight-loss.php
 * Position:   acf_after_title (below page title, above classic editor)
 *
 * Tabs:
 *   1. Hero
 *   2. Science Section
 *   3. Treatments
 *   4. Testimonials
 *   5. FAQ
 */

add_action( 'acf/init', function () {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'                   => 'group_weight_loss_page',
        'title'                 => 'Weight Loss Page Content',
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => [ 'the_content' ],
        'active'                => true,

        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-weight-loss.php' ] ],
        ],

        'fields' => [

            // ============================================================
            // TAB 1 — HERO
            // ============================================================
            [
                'key'   => 'field_wl_tab_hero',
                'label' => 'Hero',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_wl_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'wl_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Displayed on the right half of the hero on desktop and as the background image on mobile. Recommended minimum 1200 × 800 px.',
            ],
            [
                'key'          => 'field_wl_hero_headline',
                'label'        => 'Hero Headline (H1)',
                'name'         => 'wl_hero_headline',
                'type'         => 'text',
                'instructions' => 'Main headline displayed in the hero section.',
                'placeholder'  => 'Lose 10–20% of your body weight in 12 months — with prescription support at your local Hampshire pharmacy',
            ],
            [
                'key'          => 'field_wl_hero_body',
                'label'        => 'Hero Body Text',
                'name'         => 'wl_hero_body',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Short paragraph shown beneath the headline in the hero section.',
                'placeholder'  => 'Mounjaro and Wegovy prescriptions from our Hampshire pharmacists. No GP referral. No long waits. Expert face-to-face care at Emsworth, Havant & Rowlands Castle.',
            ],
            [
                'key'          => 'field_wl_hero_badge_text',
                'label'        => 'Hero Badge Text',
                'name'         => 'wl_hero_badge_text',
                'type'         => 'text',
                'instructions' => 'Small pill badge above the headline.',
                'placeholder'  => 'Medical Weight Loss · Hampshire',
            ],

            // ============================================================
            // TAB 2 — SCIENCE SECTION
            // ============================================================
            [
                'key'   => 'field_wl_tab_science',
                'label' => 'Science Section',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'          => 'field_wl_science_eyebrow',
                'label'        => 'Eyebrow Label',
                'name'         => 'wl_science_eyebrow',
                'type'         => 'text',
                'instructions' => 'Small letter-spaced label above the headline (e.g. "Clinical Evidence").',
                'placeholder'  => 'Clinical Evidence',
            ],
            [
                'key'          => 'field_wl_science_headline',
                'label'        => 'Headline',
                'name'         => 'wl_science_headline',
                'type'         => 'text',
                'instructions' => 'Serif display headline introducing the chart.',
                'placeholder'  => 'Why diets alone fail — the science in one chart',
            ],
            [
                'key'          => 'field_wl_science_subhead',
                'label'        => 'Sub-headline',
                'name'         => 'wl_science_subhead',
                'type'         => 'textarea',
                'rows'         => 2,
                'placeholder'  => 'In randomised trials, GLP-1 receptor agonists produce sustained weight loss that lifestyle intervention alone rarely achieves.',
            ],
            [
                'key'          => 'field_wl_science_citation',
                'label'        => 'Chart Citation',
                'name'         => 'wl_science_citation',
                'type'         => 'text',
                'instructions' => 'Small footnote beneath the chart.',
                'placeholder'  => 'Data adapted from STEP-1 (Wilding et al., N Engl J Med 2021) and naturalistic dieting studies.',
            ],
            [
                'key'          => 'field_wl_science_quote',
                'label'        => 'Pullquote',
                'name'         => 'wl_science_quote',
                'type'         => 'textarea',
                'rows'         => 3,
                'placeholder'  => 'The patients I see on GLP-1 therapy describe something dieting never gave them — relief from the constant thinking about food. That is what makes the weight loss sustainable.',
            ],
            [
                'key'          => 'field_wl_science_quote_author',
                'label'        => 'Pullquote — Attribution Name',
                'name'         => 'wl_science_quote_author',
                'type'         => 'text',
                'placeholder'  => 'Alex Chen, MPharm',
            ],
            [
                'key'          => 'field_wl_science_quote_role',
                'label'        => 'Pullquote — Attribution Role',
                'name'         => 'wl_science_quote_role',
                'type'         => 'text',
                'placeholder'  => 'Lead Pharmacist, Southdowns Pharmacy',
            ],

            // ============================================================
            // TAB 3 — TREATMENTS (S4)
            // ============================================================
            [
                'key'   => 'field_wl_tab_pricing',
                'label' => 'Treatments',
                'name'  => '',
                'type'  => 'tab',
            ],

            // ---- Section header ----------------------------------
            [
                'key'         => 'field_wl_treatments_eyebrow',
                'label'       => 'Section Eyebrow',
                'name'        => 'wl_treatments_eyebrow',
                'type'        => 'text',
                'placeholder' => 'Prescription Treatments',
            ],
            [
                'key'         => 'field_wl_treatments_headline',
                'label'       => 'Section Headline',
                'name'        => 'wl_treatments_headline',
                'type'        => 'text',
                'placeholder' => 'Clinically proven weight loss medications',
            ],
            [
                'key'         => 'field_wl_treatments_subhead',
                'label'       => 'Section Sub-headline',
                'name'        => 'wl_treatments_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'Our GPhC-registered pharmacists prescribe the two most effective GLP-1 medications available in the UK, tailored to your health profile.',
            ],
            [
                'key'         => 'field_wl_treatments_cta_label',
                'label'       => 'Card CTA Button Label',
                'name'        => 'wl_treatments_cta_label',
                'type'        => 'text',
                'placeholder' => 'Book Free Consultation',
                'instructions' => 'Used on both treatment cards. Links to the global booking URL.',
            ],
            [
                'key'         => 'field_wl_treatments_eligibility',
                'label'       => 'Eligibility Note',
                'name'        => 'wl_treatments_eligibility',
                'type'        => 'textarea',
                'rows'        => 3,
                'instructions' => 'Blue note shown beneath the cards. Basic HTML allowed (e.g. <strong>).',
                'placeholder' => '<strong>Eligibility:</strong> You must have a BMI of 30 or above, or 27+ with a weight-related health condition such as type 2 diabetes or hypertension. Our pharmacists will assess your suitability at your free consultation.',
            ],

            // ---- Mounjaro card -----------------------------------
            [
                'key'           => 'field_wl_mounjaro_image',
                'label'         => 'Mounjaro — Image',
                'name'          => 'wl_mounjaro_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Top photo on the Mounjaro card. Recommended 800 × 450 px (16:9).',
            ],
            [
                'key'         => 'field_wl_mounjaro_image_alt',
                'label'       => 'Mounjaro — Image Alt Text',
                'name'        => 'wl_mounjaro_image_alt',
                'type'        => 'text',
                'placeholder' => 'Mounjaro weight loss injection',
            ],
            [
                'key'         => 'field_wl_mounjaro_badge',
                'label'       => 'Mounjaro — Top Badge',
                'name'        => 'wl_mounjaro_badge',
                'type'        => 'text',
                'placeholder' => 'Most Popular',
                'instructions' => 'Small uppercase pill on the image (blue background). Leave empty to hide the badge.',
            ],
            [
                'key'         => 'field_wl_mounjaro_name',
                'label'       => 'Mounjaro — Card Title',
                'name'        => 'wl_mounjaro_name',
                'type'        => 'text',
                'placeholder' => 'Mounjaro®',
            ],
            [
                'key'         => 'field_wl_mounjaro_subtitle',
                'label'       => 'Mounjaro — Subtitle',
                'name'        => 'wl_mounjaro_subtitle',
                'type'        => 'text',
                'placeholder' => 'Tirzepatide · GIP & GLP-1 receptor agonist',
            ],
            [
                'key'         => 'field_wl_mounjaro_body',
                'label'       => 'Mounjaro — Body',
                'name'        => 'wl_mounjaro_body',
                'type'        => 'textarea',
                'rows'        => 4,
                'instructions' => 'Main paragraph beneath the title. Basic HTML allowed (e.g. <strong> for the headline statistic).',
            ],
            [
                'key'          => 'field_wl_mounjaro_bullets',
                'label'        => 'Mounjaro — Bullet Points',
                'name'         => 'wl_mounjaro_bullets',
                'type'         => 'textarea',
                'rows'         => 4,
                'instructions' => 'One bullet per line. Empty lines are skipped. The price line below is appended automatically as the last bullet.',
                'new_lines'    => '',
            ],
            [
                'key'          => 'field_wl_mounjaro_price',
                'label'        => 'Mounjaro — Price Line',
                'name'         => 'wl_mounjaro_price',
                'type'         => 'text',
                'instructions' => 'Appended as the last bullet on the Mounjaro card. Leave empty to omit.',
                'placeholder'  => 'From £156.50/month including pharmacist support',
            ],

            // ---- Wegovy card -------------------------------------
            [
                'key'           => 'field_wl_wegovy_image',
                'label'         => 'Wegovy — Image',
                'name'          => 'wl_wegovy_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Top photo on the Wegovy card. Recommended 800 × 450 px (16:9).',
            ],
            [
                'key'         => 'field_wl_wegovy_image_alt',
                'label'       => 'Wegovy — Image Alt Text',
                'name'        => 'wl_wegovy_image_alt',
                'type'        => 'text',
                'placeholder' => 'Wegovy weight loss injection',
            ],
            [
                'key'         => 'field_wl_wegovy_badge',
                'label'       => 'Wegovy — Top Badge',
                'name'        => 'wl_wegovy_badge',
                'type'        => 'text',
                'placeholder' => 'Well Established',
                'instructions' => 'Small uppercase pill on the image (teal background). Leave empty to hide the badge.',
            ],
            [
                'key'         => 'field_wl_wegovy_name',
                'label'       => 'Wegovy — Card Title',
                'name'        => 'wl_wegovy_name',
                'type'        => 'text',
                'placeholder' => 'Wegovy®',
            ],
            [
                'key'         => 'field_wl_wegovy_subtitle',
                'label'       => 'Wegovy — Subtitle',
                'name'        => 'wl_wegovy_subtitle',
                'type'        => 'text',
                'placeholder' => 'Semaglutide · GLP-1 receptor agonist',
            ],
            [
                'key'         => 'field_wl_wegovy_body',
                'label'       => 'Wegovy — Body',
                'name'        => 'wl_wegovy_body',
                'type'        => 'textarea',
                'rows'        => 4,
                'instructions' => 'Main paragraph beneath the title. Basic HTML allowed.',
            ],
            [
                'key'          => 'field_wl_wegovy_bullets',
                'label'        => 'Wegovy — Bullet Points',
                'name'         => 'wl_wegovy_bullets',
                'type'         => 'textarea',
                'rows'         => 4,
                'instructions' => 'One bullet per line. Empty lines are skipped. The price line below is appended automatically as the last bullet.',
                'new_lines'    => '',
            ],
            [
                'key'          => 'field_wl_wegovy_price',
                'label'        => 'Wegovy — Price Line',
                'name'         => 'wl_wegovy_price',
                'type'         => 'text',
                'instructions' => 'Appended as the last bullet on the Wegovy card. Leave empty to omit.',
                'placeholder'  => 'From £140/month including pharmacist support',
            ],

            // ============================================================
            // TAB 4 — TESTIMONIALS (S7)
            // ============================================================
            [ 'key' => 'field_wl_tab_testimonials', 'label' => 'Testimonials', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_wl_testimonials_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'wl_testimonials_eyebrow',
                'type'        => 'text',
                'placeholder' => 'Patient Stories',
            ],
            [
                'key'         => 'field_wl_testimonials_headline',
                'label'       => 'Headline',
                'name'        => 'wl_testimonials_headline',
                'type'        => 'text',
                'placeholder' => 'Real patients, real results',
            ],
            [
                'key'         => 'field_wl_testimonials_subhead',
                'label'       => 'Sub-headline',
                'name'        => 'wl_testimonials_subhead',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'Hundreds of Hampshire patients have transformed their health through our medical weight loss programme.',
            ],
            [
                'key'          => 'field_wl_testimonials_reviews',
                'label'        => 'Reviews',
                'name'         => 'wl_testimonials_reviews',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 12,
                'layout'       => 'block',
                'button_label' => 'Add Review',
                'instructions' => 'Up to twelve review cards (six recommended). Cards always render with five yellow stars; per-card star ratings are not editable. Leave empty to use the six built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_review_quote',    'label' => 'Quote',             'name' => 'quote',    'type' => 'textarea', 'rows' => 4, 'instructions' => 'No surrounding quotation marks needed — the template adds them.' ],
                    [ 'key' => 'field_wl_review_initials', 'label' => 'Initials',          'name' => 'initials', 'type' => 'text', 'instructions' => '2–3 letters shown in the circular avatar (e.g. "SH").' ],
                    [ 'key' => 'field_wl_review_name',     'label' => 'Name',              'name' => 'name',     'type' => 'text', 'placeholder' => 'Sarah H.' ],
                    [ 'key' => 'field_wl_review_location', 'label' => 'Location / Branch', 'name' => 'location', 'type' => 'text', 'placeholder' => 'Waterlooville' ],
                ],
            ],
            [
                'key'          => 'field_wl_testimonials_trust',
                'label'        => 'Trust Row',
                'name'         => 'wl_testimonials_trust',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 4,
                'layout'       => 'table',
                'button_label' => 'Add Trust Item',
                'instructions' => 'Trust indicators below the cards. Icons cycle by position: 1 = star, 2 = people, 3 = shield. Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_trust_value',   'label' => 'Value',   'name' => 'value',   'type' => 'text', 'instructions' => 'Bold value (e.g. "4.9/5", "400+", "GPhC").' ],
                    [ 'key' => 'field_wl_trust_caption', 'label' => 'Caption', 'name' => 'caption', 'type' => 'text', 'instructions' => 'e.g. "average rating", "verified reviews".' ],
                ],
            ],

            // ============================================================
            // TAB 5 — FAQ (S10)
            // ============================================================
            [ 'key' => 'field_wl_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
            [
                'key'         => 'field_wl_faq_eyebrow',
                'label'       => 'Eyebrow Text',
                'name'        => 'wl_faq_eyebrow',
                'type'        => 'text',
                'placeholder' => 'FAQs',
            ],
            [
                'key'         => 'field_wl_faq_headline',
                'label'       => 'Sidebar Headline',
                'name'        => 'wl_faq_headline',
                'type'        => 'text',
                'placeholder' => 'Common questions about medical weight loss',
            ],
            [
                'key'         => 'field_wl_faq_intro',
                'label'       => 'Sidebar Intro',
                'name'        => 'wl_faq_intro',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'Everything you need to know before starting your journey. Can’t find your answer? Call us free.',
            ],
            [
                'key'          => 'field_wl_faq_stats',
                'label'        => 'Sidebar Stat Tiles',
                'name'         => 'wl_faq_stats',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 6,
                'layout'       => 'table',
                'button_label' => 'Add Stat',
                'instructions' => 'Up to six small stat tiles in the sidebar (three recommended). Leave empty to use defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_faq_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text', 'instructions' => 'e.g. "4.9", "400+", "10k+".' ],
                    [ 'key' => 'field_wl_faq_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text', 'instructions' => 'e.g. "Rating", "Reviews", "Patients".' ],
                ],
            ],
            [
                'key'         => 'field_wl_faq_cta_label',
                'label'       => 'CTA Button Label',
                'name'        => 'wl_faq_cta_label',
                'type'        => 'text',
                'placeholder' => 'Book Free Consultation',
                'instructions' => 'Button beneath the sidebar stat tiles. Links to the global booking URL.',
            ],
            [
                'key'          => 'field_wl_faq_items',
                'label'        => 'FAQ Items',
                'name'         => 'wl_faq_items',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 30,
                'layout'       => 'block',
                'button_label' => 'Add FAQ',
                'instructions' => 'Accordion items. Answers accept basic HTML (e.g. <strong>, <em>, links). Leave empty to use the eight built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
                    [ 'key' => 'field_wl_faq_answer',   'label' => 'Answer',   'name' => 'answer',   'type' => 'textarea', 'rows' => 5, 'instructions' => 'Basic HTML allowed.' ],
                ],
            ],

            // ============================================================
            // TAB 6 — BENEFITS / STEPS / WHY  (S5, S6, S9 card grids)
            // ============================================================
            [ 'key' => 'field_wl_tab_sections', 'label' => 'Benefits / Steps / Why', 'name' => '', 'type' => 'tab' ],
            [
                'key'          => 'field_wl_benefits',
                'label'        => 'Benefit Cards (“What you can expect”)',
                'name'         => 'wl_benefits',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 9,
                'layout'       => 'block',
                'button_label' => 'Add Benefit',
                'instructions' => 'The outcomes grid. Card icons cycle by position (kept in the design). Leave empty to use the six built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_benefit_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'instructions' => 'Card photo (recommended 600 × 400 px). Leave empty to keep the built-in photo for this position.' ],
                    [ 'key' => 'field_wl_benefit_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
                    [ 'key' => 'field_wl_benefit_desc',  'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
                ],
            ],
            [
                'key'          => 'field_wl_steps',
                'label'        => 'Programme Steps (“How our programme works”)',
                'name'         => 'wl_steps',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'block',
                'button_label' => 'Add Step',
                'instructions' => 'Numbered steps. Numbers + colours are added automatically by position. Leave empty to use the four built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
                    [ 'key' => 'field_wl_step_desc',  'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
                ],
            ],
            [
                'key'          => 'field_wl_why_cards',
                'label'        => 'Why Southdowns Cards',
                'name'         => 'wl_why_cards',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 9,
                'layout'       => 'block',
                'button_label' => 'Add Card',
                'instructions' => 'The “Why Hampshire chooses Southdowns” grid. Icons cycle by position (kept in the design). Leave empty to use the six built-in defaults.',
                'sub_fields'   => [
                    [ 'key' => 'field_wl_why_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
                    [ 'key' => 'field_wl_why_desc',  'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
                ],
            ],
        ],
    ] );
} );
