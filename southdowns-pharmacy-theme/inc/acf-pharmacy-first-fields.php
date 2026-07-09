<?php
/**
 * ACF Local Field Group — Pharmacy First Page
 *
 * Applies to: page-templates/page-pharmacy-first.php
 * Text fields pre-filled via default_value; repeaters seeded via load_value.
 * Hero image is an upload field (placeholder shows until uploaded).
 */

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'             => 'group_pharmacy_first_page',
		'title'           => 'Pharmacy First — Page Content',
		'position'        => 'acf_after_title',
		'style'           => 'default',
		'label_placement' => 'top',
		'hide_on_screen'  => [ 'the_content' ],
		'location'        => [
			[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-pharmacy-first.php' ] ],
		],
		'fields' => [

			// ── Hero ──
			[ 'key' => 'field_pf_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_hero_badge', 'label' => 'Badge', 'name' => 'pf_hero_badge', 'type' => 'text', 'default_value' => 'NHS Pharmacy First &middot; Hampshire' ],
			[ 'key' => 'field_pf_hero_heading', 'label' => 'Heading', 'name' => 'pf_hero_heading', 'type' => 'text', 'default_value' => 'Free NHS Treatment &mdash; No GP Appointment Needed' ],
			[ 'key' => 'field_pf_hero_subtext', 'label' => 'Sub-text', 'name' => 'pf_hero_subtext', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Under the NHS Pharmacy First scheme, our pharmacists at Southdowns Pharmacy can assess and treat seven common conditions &mdash; completely free of charge. No referral, no waiting weeks for a GP. Walk in or book online and get treated the same day.' ],
			[ 'key' => 'field_pf_hero_btn', 'label' => 'Button Label', 'name' => 'pf_hero_btn', 'type' => 'text', 'default_value' => 'Book a Pharmacy First Appointment' ],
			[ 'key' => 'field_pf_hero_image', 'label' => 'Hero Image', 'name' => 'pf_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],

			// ── Stat Cards ──
			[ 'key' => 'field_pf_tab_stats', 'label' => 'Stat Cards', 'name' => '', 'type' => 'tab' ],
			[
				'key' => 'field_pf_stats', 'label' => 'Stat Cards', 'name' => 'pf_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat',
				'sub_fields' => [
					[ 'key' => 'field_pf_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_pf_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],

			// ── Conditions ──
			[ 'key' => 'field_pf_tab_cond', 'label' => 'Conditions', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_cond_heading', 'label' => 'Heading', 'name' => 'pf_cond_heading', 'type' => 'text', 'default_value' => 'Seven Common Conditions. Treated Free. Today.' ],
			[ 'key' => 'field_pf_cond_intro', 'label' => 'Intro', 'name' => 'pf_cond_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Our GPhC-registered pharmacists can assess, diagnose and treat the following conditions under the NHS Pharmacy First scheme &mdash; with medication supplied free of charge where clinically appropriate.' ],
			[
				'key' => 'field_pf_conditions', 'label' => 'Conditions', 'name' => 'pf_conditions', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Condition',
				'sub_fields' => [
					[ 'key' => 'field_pf_cond_num', 'label' => 'Number', 'name' => 'num', 'type' => 'text' ],
					[ 'key' => 'field_pf_cond_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text' ],
					[ 'key' => 'field_pf_cond_age', 'label' => 'Age Range', 'name' => 'age', 'type' => 'text' ],
					[ 'key' => 'field_pf_cond_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],
			[ 'key' => 'field_pf_freenote_heading', 'label' => 'Free-note Heading', 'name' => 'pf_freenote_heading', 'type' => 'text', 'default_value' => 'Completely free &mdash; including prescription medicines' ],
			[ 'key' => 'field_pf_freenote_body', 'label' => 'Free-note Body', 'name' => 'pf_freenote_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Under NHS Pharmacy First you pay nothing &mdash; not even a prescription charge &mdash; for any treatment provided under the scheme, including antibiotics and antivirals.' ],
			[ 'key' => 'field_pf_freenote_btn', 'label' => 'Free-note Button', 'name' => 'pf_freenote_btn', 'type' => 'text', 'default_value' => 'Book Today' ],

			// ── How It Works ──
			[ 'key' => 'field_pf_tab_how', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_how_heading', 'label' => 'Heading', 'name' => 'pf_how_heading', 'type' => 'text', 'default_value' => 'Three Steps to Free NHS Treatment' ],
			[ 'key' => 'field_pf_how_intro', 'label' => 'Intro', 'name' => 'pf_how_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'No referral, no red tape. Expert care when you need it, at any of our 4 Hampshire locations.' ],
			[
				'key' => 'field_pf_steps', 'label' => 'Steps', 'name' => 'pf_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step',
				'sub_fields' => [
					[ 'key' => 'field_pf_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_pf_step_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],
			[ 'key' => 'field_pf_how_btn', 'label' => 'Button Label', 'name' => 'pf_how_btn', 'type' => 'text', 'default_value' => 'Book a Pharmacy First Appointment' ],

			// ── Eligibility ──
			[ 'key' => 'field_pf_tab_elig', 'label' => 'Eligibility', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_elig_heading', 'label' => 'Heading', 'name' => 'pf_elig_heading', 'type' => 'text', 'default_value' => 'Is Pharmacy First Right for You?' ],
			[
				'key' => 'field_pf_elig_body', 'label' => 'Body Text', 'name' => 'pf_elig_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
				'default_value' => '<p>NHS Pharmacy First is available to anyone registered with a GP in England. Most conditions can be treated across a wide age range — from young children to adults. The UTI pathway is available to women aged 16 to 64 only.</p><p>You do not need to be registered with a GP in Hampshire — any England-registered GP qualifies. If your symptoms suggest something more serious, our pharmacist will refer you to the appropriate NHS service without delay.</p>',
			],
			[ 'key' => 'field_pf_elig_infobox', 'label' => 'Info Box', 'name' => 'pf_elig_infobox', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'If you are unsure whether your condition qualifies, simply walk in or give us a call. Our pharmacists will advise you at no charge.' ],
			[ 'key' => 'field_pf_elig_list_heading', 'label' => 'Checklist Heading', 'name' => 'pf_elig_list_heading', 'type' => 'text', 'default_value' => 'You Are Eligible If&hellip;' ],
			[
				'key' => 'field_pf_checklist', 'label' => 'Eligibility Checklist', 'name' => 'pf_checklist', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item',
				'sub_fields' => [ [ 'key' => 'field_pf_check_text', 'label' => 'Item', 'name' => 'text', 'type' => 'text' ] ],
			],
			[ 'key' => 'field_pf_elig_btn', 'label' => 'Button Label', 'name' => 'pf_elig_btn', 'type' => 'text', 'default_value' => 'Book Your Free Appointment' ],

			// ── Locations ──
			[ 'key' => 'field_pf_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_loc_heading', 'label' => 'Heading', 'name' => 'pf_loc_heading', 'type' => 'text', 'default_value' => 'Visit Us at Any of Our 4 Hampshire Locations' ],
			[ 'key' => 'field_pf_loc_intro', 'label' => 'Intro', 'name' => 'pf_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Free parking and same-day Pharmacy First treatment at all locations.' ],
			[ 'key' => 'field_pf_loc_banner_heading', 'label' => 'Banner Heading', 'name' => 'pf_loc_banner_heading', 'type' => 'text', 'default_value' => 'No appointment needed &mdash; walk in any time' ],
			[ 'key' => 'field_pf_loc_banner_body', 'label' => 'Banner Body', 'name' => 'pf_loc_banner_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four branches offer NHS Pharmacy First during regular opening hours. Or book a slot online for a guaranteed time.' ],
			[ 'key' => 'field_pf_loc_banner_btn', 'label' => 'Banner Button', 'name' => 'pf_loc_banner_btn', 'type' => 'text', 'default_value' => 'Book Online' ],

			// ── FAQ ──
			[ 'key' => 'field_pf_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_faq_heading', 'label' => 'FAQ Heading', 'name' => 'pf_faq_heading', 'type' => 'text', 'default_value' => 'Pharmacy First FAQs' ],
			[ 'key' => 'field_pf_faq_intro', 'label' => 'FAQ Intro', 'name' => 'pf_faq_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Common questions about the NHS Pharmacy First service at Southdowns Pharmacy.' ],
			[
				'key' => 'field_pf_faqs', 'label' => 'FAQ Items', 'name' => 'pf_faqs', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ',
				'sub_fields' => [
					[ 'key' => 'field_pf_faq_num', 'label' => 'Number', 'name' => 'num', 'type' => 'text' ],
					[ 'key' => 'field_pf_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
					[ 'key' => 'field_pf_faq_a', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],

			// ── Final CTA ──
			[ 'key' => 'field_pf_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_pf_cta_heading', 'label' => 'Heading', 'name' => 'pf_cta_heading', 'type' => 'text', 'default_value' => 'Don&apos;t Wait Weeks for a GP. Get Treated Today.' ],
			[ 'key' => 'field_pf_cta_subtext', 'label' => 'Sub-text', 'name' => 'pf_cta_subtext', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four Southdowns Pharmacy locations offer NHS Pharmacy First &mdash; walk in during opening hours or book your slot online. Free treatment, expert pharmacists, no appointment needed.' ],
			[ 'key' => 'field_pf_cta_btn', 'label' => 'Button Label', 'name' => 'pf_cta_btn', 'type' => 'text', 'default_value' => 'Book a Pharmacy First Appointment' ],
			[
				'key' => 'field_pf_cta_pills', 'label' => 'Badge Pills', 'name' => 'pf_cta_pills', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Pill',
				'sub_fields' => [ [ 'key' => 'field_pf_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ],
			],
			[
				'key' => 'field_pf_cta_stats', 'label' => 'Trust Stats', 'name' => 'pf_cta_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat',
				'sub_fields' => [
					[ 'key' => 'field_pf_cta_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_pf_cta_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],
			[ 'key' => 'field_pf_disclaimer', 'label' => 'Disclaimer', 'name' => 'pf_disclaimer', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '', 'default_value' => 'This service is provided under the NHS Pharmacy First scheme. Treatment is subject to clinical assessment by our GPhC-registered pharmacists. Not all presentations will meet the criteria for NHS-funded treatment. If you are unsure whether your condition qualifies, please walk in or call your nearest branch. Information is accurate as of April 2026.' ],
		],
	] );

} );

/**
 * Seed the Pharmacy First repeaters with the current content.
 */
function pf_repeater_defaults(): array {
	return [
		'pf_stats' => [
			[ 'value' => '7', 'label' => 'Conditions Treated' ],
			[ 'value' => 'FREE', 'label' => 'NHS Funded' ],
			[ 'value' => 'No', 'label' => 'GP Appointment' ],
			[ 'value' => 'Same', 'label' => 'Day Treatment' ],
		],
		'pf_conditions' => [
			[ 'num' => '01', 'name' => 'Sinusitis',                    'age' => 'Ages 12+',                'desc' => 'A blocked or runny nose with facial pain or pressure lasting more than ten days, or symptoms that worsen after initial improvement. Our pharmacist will assess and treat where appropriate.' ],
			[ 'num' => '02', 'name' => 'Sore Throat',                  'age' => 'Ages 5+',                 'desc' => 'A painful throat that makes swallowing uncomfortable. Our pharmacist will assess the severity using a clinical scoring system and provide appropriate NHS-funded treatment.' ],
			[ 'num' => '03', 'name' => 'Earache (Acute Otitis Media)', 'age' => 'Ages 1&ndash;17',         'desc' => 'Pain in one or both ears, which may be sharp, dull or accompanied by temporary hearing loss. Particularly common in children &mdash; walk in without a GP appointment.' ],
			[ 'num' => '04', 'name' => 'Infected Insect Bite',         'age' => 'Ages 1+',                 'desc' => 'A bite or sting that has become red, swollen, warm to the touch, or showing signs of infection such as discharge. Our pharmacist will assess and prescribe antibiotics where needed.' ],
			[ 'num' => '05', 'name' => 'Impetigo',                     'age' => 'Ages 1+',                 'desc' => 'A highly contagious skin infection causing red sores, usually around the nose and mouth, that burst and form honey-coloured crusts. Early treatment prevents it spreading.' ],
			[ 'num' => '06', 'name' => 'Shingles',                     'age' => 'Ages 18+',                'desc' => 'A painful, blistering rash caused by reactivation of the chickenpox virus. Starting antiviral treatment early is important &mdash; if you suspect shingles, come in without delay.' ],
			[ 'num' => '07', 'name' => 'Uncomplicated UTI',            'age' => 'Women aged 16&ndash;64 only', 'desc' => 'Burning or stinging when passing urine, needing to go more frequently, or cloudy and strong-smelling urine. No GP visit needed &mdash; our pharmacist can prescribe treatment directly.' ],
		],
		'pf_steps' => [
			[ 'title' => 'Walk In or Book Online',          'desc' => 'Visit any of our four Hampshire locations during opening hours, or book a convenient slot online. No GP referral needed.' ],
			[ 'title' => 'Private Pharmacist Consultation', 'desc' => 'One of our trained pharmacists will see you in a private consultation room, asking about your symptoms, medical history and current medications, following NHS clinical guidelines throughout.' ],
			[ 'title' => 'Walk Out Treated',                'desc' => 'If your condition meets the NHS Pharmacy First criteria, you&apos;ll receive appropriate treatment on the spot &mdash; including prescription-only medicines such as antibiotics or antivirals where clinically indicated. Completely free of charge.' ],
		],
		'pf_checklist' => [
			[ 'text' => 'Registered with any GP in England' ],
			[ 'text' => 'Ages 1+ for most conditions' ],
			[ 'text' => 'Women aged 16&ndash;64 for uncomplicated UTI' ],
			[ 'text' => 'No appointment needed &mdash; walk in welcome' ],
			[ 'text' => 'Completely free of charge' ],
			[ 'text' => 'Same-day treatment available' ],
		],
		'pf_faqs' => [
			[ 'num' => '01', 'question' => 'Is it really free?', 'answer' => 'Yes. NHS Pharmacy First is fully funded by the NHS. You pay nothing &mdash; not even a prescription charge &mdash; for any treatment provided under the scheme, including prescription-only medicines like antibiotics or antivirals.' ],
			[ 'num' => '02', 'question' => 'Do I need to see my GP first?', 'answer' => 'No. That&apos;s the whole point of the service. Our pharmacists are trained to assess and treat these conditions independently. Simply walk in or book online.' ],
			[ 'num' => '03', 'question' => 'What conditions can you treat?', 'answer' => 'Sinusitis (12+), Sore Throat (5+), Earache (1&ndash;17), Infected Insect Bite (1+), Impetigo (1+), Shingles (18+), and Uncomplicated UTI (women 16&ndash;64).' ],
			[ 'num' => '04', 'question' => 'Do I need to be registered with a specific GP?', 'answer' => 'No. You just need to be registered with any GP in England. You don&apos;t need to be registered locally in Hampshire or with a specific practice.' ],
			[ 'num' => '05', 'question' => 'What if my condition can&apos;t be treated here?', 'answer' => 'If your symptoms don&apos;t meet the Pharmacy First criteria, or suggest something more serious, our pharmacist will advise you on the most appropriate next step &mdash; whether that&apos;s your GP, urgent care, or 111.' ],
			[ 'num' => '06', 'question' => 'Can children use Pharmacy First?', 'answer' => 'Yes. Children can be treated for earache (ages 1&ndash;17), infected insect bites (ages 1+), impetigo (ages 1+), and sore throat (ages 5+). A parent or guardian should accompany children to the appointment.' ],
			[ 'num' => '07', 'question' => 'How long does an appointment take?', 'answer' => 'Most consultations take 10&ndash;15 minutes. You may be asked to wait briefly if the pharmacist is with another patient, but same-day treatment is available at all four branches.' ],
		],
		'pf_cta_pills' => [
			[ 'text' => 'NHS Funded' ],
			[ 'text' => '7 Conditions' ],
			[ 'text' => 'No GP Needed' ],
			[ 'text' => 'Same-Day Service' ],
			[ 'text' => 'GPhC Registered' ],
		],
		'pf_cta_stats' => [
			[ 'value' => '7', 'label' => 'Conditions Covered' ],
			[ 'value' => 'FREE', 'label' => 'NHS Funded' ],
			[ 'value' => 'Same Day', 'label' => 'Treatment Available' ],
			[ 'value' => '4', 'label' => 'Hampshire Locations' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( pf_repeater_defaults() ) as $field_name ) {
		add_filter( "acf/load_value/name={$field_name}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) {
				return $value;
			}
			$defaults = pf_repeater_defaults();
			return $defaults[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
