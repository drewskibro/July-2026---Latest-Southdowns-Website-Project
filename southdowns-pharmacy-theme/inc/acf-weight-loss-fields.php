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
                'placeholder'  => 'Clinically supervised weight loss at your local Hampshire pharmacy',
            ],
            [
                'key'          => 'field_wl_hero_body',
                'label'        => 'Hero Body Text',
                'name'         => 'wl_hero_body',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Short paragraph shown beneath the headline in the hero section. Promote the consultation, not a medicine: no medicine names, medicine classes, "injections" or weight-loss figures.',
                'placeholder'  => 'A supervised weight management programme led by our GPhC-registered pharmacists, with a face-to-face assessment and monthly in-person reviews at four local Hampshire branches.',
            ],
            [
                'key'          => 'field_wl_hero_badge_text',
                'label'        => 'Hero Badge Text',
                'name'         => 'wl_hero_badge_text',
                'type'         => 'text',
                'instructions' => 'Small pill badge above the headline.',
                'placeholder'  => 'Weight Management · Hampshire',
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
