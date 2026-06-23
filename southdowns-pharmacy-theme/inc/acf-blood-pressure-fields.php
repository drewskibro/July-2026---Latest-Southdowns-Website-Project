<?php
/**
 * ACF Local Field Group — Blood Pressure Checks Page
 *
 * Applies to: page-templates/page-blood-pressure.php
 * Position:   acf_after_title (requires Classic Editor — see functions.php)
 *
 * Every field is pre-filled with the CURRENT page content:
 *   · simple fields use 'default_value'
 *   · repeaters are seeded via the acf/load_value filter at the bottom of this file
 * so the client opens the editor and sees the real text/stats ready to tweak.
 * The template (page-blood-pressure.php) also keeps the same values as a final
 * fallback, so the page renders correctly no matter what.
 *
 * Images are upload fields — the client uploads their own photo; until then the
 * template shows the existing placeholder.
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

			// ── TAB 1 · HERO ──────────────────────────────────────
			[ 'key' => 'field_bp_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_hero_badge', 'label' => 'Hero Badge Text', 'name' => 'bp_hero_badge', 'type' => 'text', 'default_value' => 'FREE NHS BLOOD PRESSURE CHECKS • HAMPSHIRE' ],
			[ 'key' => 'field_bp_hero_heading', 'label' => 'Hero Heading', 'name' => 'bp_hero_heading', 'type' => 'text', 'default_value' => 'Know Your Numbers. Protect Your Heart.' ],
			[ 'key' => 'field_bp_hero_subheading', 'label' => 'Hero Sub-heading', 'name' => 'bp_hero_subheading', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Free NHS blood pressure checks at all four Southdowns branches across Hampshire. No appointment needed — walk in and get your results in minutes.' ],
			[ 'key' => 'field_bp_hero_image', 'label' => 'Hero Image', 'name' => 'bp_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'instructions' => 'Right panel on desktop and background on mobile. Lifestyle photo (e.g. pharmacist taking blood pressure, warm pharmacy setting). Min 1200 × 800 px. Until you upload one, a stock placeholder is shown.' ],
			[ 'key' => 'field_bp_hero_image_alt', 'label' => 'Hero Image Alt Text', 'name' => 'bp_hero_image_alt', 'type' => 'text', 'default_value' => 'Free blood pressure check at Southdowns Pharmacy' ],
			[
				'key' => 'field_bp_hero_trust', 'label' => 'Hero Trust Items', 'name' => 'bp_hero_trust', 'type' => 'repeater',
				'instructions' => 'Small ticked items under the hero buttons.', 'min' => 0, 'layout' => 'table', 'button_label' => 'Add Trust Item',
				'sub_fields' => [ [ 'key' => 'field_bp_hero_trust_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ],
			],

			// ── TAB 2 · KEY STATS ─────────────────────────────────
			[ 'key' => 'field_bp_tab_stats', 'label' => 'Key Stats', 'name' => '', 'type' => 'tab' ],
			[
				'key' => 'field_bp_stats', 'label' => 'Stat Cards', 'name' => 'bp_stats', 'type' => 'repeater',
				'instructions' => 'The four stat cards in the blue bar.', 'min' => 0, 'layout' => 'table', 'button_label' => 'Add Stat',
				'sub_fields' => [
					[ 'key' => 'field_bp_stats_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_bp_stats_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],

			// ── TAB 3 · SILENT THREAT ─────────────────────────────
			[ 'key' => 'field_bp_tab_threat', 'label' => 'Silent Threat', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_threat_badge', 'label' => 'Section Eyebrow', 'name' => 'bp_threat_badge', 'type' => 'text', 'default_value' => 'The Silent Threat' ],
			[ 'key' => 'field_bp_threat_heading', 'label' => 'Heading', 'name' => 'bp_threat_heading', 'type' => 'text', 'default_value' => 'High Blood Pressure: Understanding the Risk' ],
			[
				'key' => 'field_bp_threat_body', 'label' => 'Body Text', 'name' => 'bp_threat_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
				'instructions' => 'The two intro paragraphs. Links are allowed.',
				'default_value' => '<p>High blood pressure (hypertension) is one of the leading causes of <a href="https://www.nhs.uk/conditions/cardiovascular-disease/" target="_blank" rel="noopener noreferrer">cardiovascular disease</a> in the UK, yet most people who have it experience no symptoms at all. It’s often called “the silent killer” for this reason — by the time it’s noticed, damage may already have been done.</p><p>Over 14 million people in the UK have high blood pressure, and an estimated 7 million of them don’t know it. A simple 5-minute check at your local Southdowns Pharmacy could be one of the most important health steps you take this year.</p>',
			],
			[
				'key' => 'field_bp_threat_stats', 'label' => 'Stat Callouts', 'name' => 'bp_threat_stats', 'type' => 'repeater',
				'instructions' => 'The three small white stat boxes.', 'min' => 0, 'layout' => 'table', 'button_label' => 'Add Callout',
				'sub_fields' => [
					[ 'key' => 'field_bp_threat_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_bp_threat_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],
			[ 'key' => 'field_bp_threat_note', 'label' => 'Info Note', 'name' => 'bp_threat_note', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'instructions' => 'Blue note box. Basic HTML (e.g. <strong>) allowed.', 'default_value' => '<strong>Regular monitoring is key.</strong> Even if you feel completely well, getting your blood pressure checked regularly is one of the simplest and most effective ways to protect your long-term health.' ],
			[ 'key' => 'field_bp_condition_image', 'label' => 'Condition Section Image', 'name' => 'bp_condition_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium', 'instructions' => 'Lifestyle image — e.g. healthy walk or healthy food. NOT clinical. Min 800 × 600 px. Until you upload one, a stock placeholder is shown.' ],
			[ 'key' => 'field_bp_condition_image_alt', 'label' => 'Condition Image Alt Text', 'name' => 'bp_condition_image_alt', 'type' => 'text', 'default_value' => 'Healthy active lifestyle for heart health' ],

			// ── TAB 4 · RISK FACTORS ──────────────────────────────
			[ 'key' => 'field_bp_tab_risk', 'label' => 'Risk Factors', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_risk_heading', 'label' => 'Heading', 'name' => 'bp_risk_heading', 'type' => 'text', 'default_value' => 'Could You Be at Higher Risk?' ],
			[ 'key' => 'field_bp_risk_intro', 'label' => 'Intro', 'name' => 'bp_risk_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Several everyday factors can quietly raise your blood pressure over time. Understanding your risk is the first step towards taking action.' ],
			[
				'key' => 'field_bp_risk_cards', 'label' => 'Risk Factor Cards', 'name' => 'bp_risk_cards', 'type' => 'repeater',
				'instructions' => 'Card title + description. The icon and colour for each card stay fixed in the design (by position).', 'min' => 0, 'layout' => 'block', 'button_label' => 'Add Card',
				'sub_fields' => [
					[ 'key' => 'field_bp_risk_card_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_bp_risk_card_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],
			[ 'key' => 'field_bp_risk_cta', 'label' => 'Mid CTA Button Label', 'name' => 'bp_risk_cta', 'type' => 'text', 'default_value' => 'Get Your Free Check Today' ],

			// ── TAB 5 · LIFESTYLE ─────────────────────────────────
			[ 'key' => 'field_bp_tab_reduce', 'label' => 'Lifestyle', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_reduce_heading', 'label' => 'Heading', 'name' => 'bp_reduce_heading', 'type' => 'text', 'default_value' => 'Simple Steps to Healthier Blood Pressure' ],
			[ 'key' => 'field_bp_reduce_intro', 'label' => 'Intro', 'name' => 'bp_reduce_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Small, consistent lifestyle changes can make a significant difference. Our pharmacists can guide you on the right steps for your situation.' ],
			[
				'key' => 'field_bp_reduce_cards', 'label' => 'Lifestyle Cards', 'name' => 'bp_reduce_cards', 'type' => 'repeater',
				'instructions' => 'Card title + description. Icons/colours stay fixed by position.', 'min' => 0, 'layout' => 'block', 'button_label' => 'Add Card',
				'sub_fields' => [
					[ 'key' => 'field_bp_reduce_card_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_bp_reduce_card_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],
			[ 'key' => 'field_bp_reduce_callout_heading', 'label' => 'Pharmacist Callout Heading', 'name' => 'bp_reduce_callout_heading', 'type' => 'text', 'default_value' => 'Talk to your Southdowns pharmacist' ],
			[ 'key' => 'field_bp_reduce_callout_body', 'label' => 'Pharmacist Callout Body', 'name' => 'bp_reduce_callout_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Our team can give personalised advice on blood pressure management and refer you to your GP if needed. Walk in to any branch, no appointment required.' ],
			[ 'key' => 'field_bp_reduce_callout_label', 'label' => 'Pharmacist Callout Button', 'name' => 'bp_reduce_callout_label', 'type' => 'text', 'default_value' => 'Get Advice' ],

			// ── TAB 6 · ELIGIBILITY ───────────────────────────────
			[ 'key' => 'field_bp_tab_elig', 'label' => 'Eligibility', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_elig_heading', 'label' => 'Heading', 'name' => 'bp_elig_heading', 'type' => 'text', 'default_value' => 'Who Should Get a Blood Pressure Check?' ],
			[ 'key' => 'field_bp_elig_intro', 'label' => 'Intro', 'name' => 'bp_elig_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Our free NHS blood pressure service is open to almost everyone — and it only takes 5 minutes.' ],
			[
				'key' => 'field_bp_elig_recommended', 'label' => 'Recommended For (list)', 'name' => 'bp_elig_recommended', 'type' => 'repeater',
				'instructions' => 'Ticked list under "Recommended For".', 'min' => 0, 'layout' => 'table', 'button_label' => 'Add Item',
				'sub_fields' => [ [ 'key' => 'field_bp_elig_rec_text', 'label' => 'Item', 'name' => 'text', 'type' => 'text' ] ],
			],
			[
				'key' => 'field_bp_elig_frequency', 'label' => 'How Often to Check', 'name' => 'bp_elig_frequency', 'type' => 'repeater',
				'instructions' => 'Frequency label + description rows.', 'min' => 0, 'layout' => 'block', 'button_label' => 'Add Row',
				'sub_fields' => [
					[ 'key' => 'field_bp_elig_freq_label', 'label' => 'Frequency', 'name' => 'freq', 'type' => 'text' ],
					[ 'key' => 'field_bp_elig_freq_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
				],
			],
			[ 'key' => 'field_bp_elig_walkin_heading', 'label' => 'Walk-in Callout Heading', 'name' => 'bp_elig_walkin_heading', 'type' => 'text', 'default_value' => 'Walk In — No Appointment Needed' ],
			[ 'key' => 'field_bp_elig_walkin_body', 'label' => 'Walk-in Callout Body', 'name' => 'bp_elig_walkin_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Simply walk in to any of our four Hampshire branches during opening hours. The check takes around 5 minutes and results are immediate. No referral, no waiting room.' ],
			[ 'key' => 'field_bp_elig_walkin_label', 'label' => 'Walk-in Callout Button', 'name' => 'bp_elig_walkin_label', 'type' => 'text', 'default_value' => 'Book Ahead' ],

			// ── TAB 7 · WHY CHOOSE US ─────────────────────────────
			[ 'key' => 'field_bp_tab_why', 'label' => 'Why Choose Us', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_why_heading', 'label' => 'Heading', 'name' => 'bp_why_heading', 'type' => 'text', 'default_value' => 'Why Patients Choose Southdowns' ],
			[ 'key' => 'field_bp_why_intro', 'label' => 'Intro', 'name' => 'bp_why_intro', 'type' => 'text', 'default_value' => 'Your local pharmacist — accessible, expert, and on your side.' ],
			[
				'key' => 'field_bp_why_cards', 'label' => 'Why Choose Cards', 'name' => 'bp_why_cards', 'type' => 'repeater',
				'instructions' => 'Card title + description. Icons stay fixed by position.', 'min' => 0, 'layout' => 'block', 'button_label' => 'Add Card',
				'sub_fields' => [
					[ 'key' => 'field_bp_why_card_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_bp_why_card_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],

			// ── TAB 8 · LOCATIONS ─────────────────────────────────
			[ 'key' => 'field_bp_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_loc_heading', 'label' => 'Heading', 'name' => 'bp_loc_heading', 'type' => 'text', 'default_value' => 'Find Your Nearest Hampshire Branch' ],
			[ 'key' => 'field_bp_loc_intro', 'label' => 'Intro', 'name' => 'bp_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'instructions' => 'Branch cards themselves are managed under Pharmacy Settings → Branch Locations.', 'default_value' => 'All four Southdowns branches offer free blood pressure checks. Walk in during opening hours — no appointment needed.' ],
			[ 'key' => 'field_bp_loc_banner_heading', 'label' => 'Walk-in Banner Heading', 'name' => 'bp_loc_banner_heading', 'type' => 'text', 'default_value' => 'Walk in — no appointment needed' ],
			[ 'key' => 'field_bp_loc_banner_body', 'label' => 'Walk-in Banner Body', 'name' => 'bp_loc_banner_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four branches offer free blood pressure checks during opening hours. Results take just 5 minutes and our pharmacist will talk you through what they mean.' ],
			[ 'key' => 'field_bp_loc_banner_label', 'label' => 'Walk-in Banner Button', 'name' => 'bp_loc_banner_label', 'type' => 'text', 'default_value' => 'Book a Check' ],

			// ── TAB 9 · FAQ ───────────────────────────────────────
			[ 'key' => 'field_bp_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_faq_heading', 'label' => 'FAQ Heading', 'name' => 'bp_faq_heading', 'type' => 'text', 'default_value' => 'Blood Pressure Check FAQs' ],
			[ 'key' => 'field_bp_faq_intro', 'label' => 'FAQ Intro', 'name' => 'bp_faq_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Common questions about our free NHS blood pressure service across Hampshire.' ],
			[
				'key' => 'field_bp_faq_items', 'label' => 'FAQ Items', 'name' => 'bp_faq_items', 'type' => 'repeater',
				'instructions' => 'Add, edit or reorder FAQ questions.', 'min' => 0, 'max' => 20, 'layout' => 'block', 'button_label' => 'Add FAQ Item',
				'sub_fields' => [
					[ 'key' => 'field_bp_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text', 'required' => 1 ],
					[ 'key' => 'field_bp_faq_answer', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 4, 'required' => 1 ],
				],
			],

			// ── TAB 10 · CLOSING CTA / DISCLAIMER ─────────────────
			[ 'key' => 'field_bp_tab_cta', 'label' => 'Closing CTA / Disclaimer', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_bp_cta_heading', 'label' => 'CTA Heading', 'name' => 'bp_cta_heading', 'type' => 'text', 'default_value' => 'Take 5 Minutes to Know Your Numbers' ],
			[ 'key' => 'field_bp_cta_subheading', 'label' => 'CTA Sub-heading', 'name' => 'bp_cta_subheading', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'A free blood pressure check at your local Southdowns Pharmacy could be one of the most important things you do for your health this year.' ],
			[ 'key' => 'field_bp_cta_label', 'label' => 'CTA Button Label', 'name' => 'bp_cta_label', 'type' => 'text', 'default_value' => 'Book a Free Check' ],
			[
				'key' => 'field_bp_cta_points', 'label' => 'CTA Checklist', 'name' => 'bp_cta_points', 'type' => 'repeater',
				'instructions' => 'The ticked checklist in the closing banner.', 'min' => 0, 'layout' => 'table', 'button_label' => 'Add Point',
				'sub_fields' => [ [ 'key' => 'field_bp_cta_point_text', 'label' => 'Point', 'name' => 'text', 'type' => 'text' ] ],
			],
			[ 'key' => 'field_bp_disclaimer', 'label' => 'Medical Disclaimer', 'name' => 'bp_disclaimer', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '', 'instructions' => 'Footer disclaimer strip. Basic HTML allowed.', 'default_value' => '<strong class="text-slate-600">Medical Disclaimer:</strong> Blood pressure checks provided by Southdowns Pharmacy are a screening service only and do not replace a consultation with your GP or other qualified healthcare provider. A single reading should not be used to diagnose hypertension. If you are concerned about your blood pressure or experience symptoms such as severe headache, chest pain, or blurred vision, contact your GP immediately or call 999 in an emergency.' ],

		],
	] );

} );


/**
 * Pre-fill the REPEATER fields in the editor with the current page content.
 *
 * ACF's 'default_value' covers simple fields but not repeaters, so we seed the
 * repeaters here: when a repeater has no saved rows yet, return the defaults
 * (which ACF then shows in the editor and the front-end uses). Once the client
 * saves the page, their own rows take over.
 */
function bp_repeater_defaults(): array {
	return [
		'bp_hero_trust' => [
			[ 'text' => 'No Appointment Needed' ],
			[ 'text' => 'GPhC Registered' ],
			[ 'text' => 'Free NHS Service' ],
			[ 'text' => 'Same-Day Results' ],
		],
		'bp_stats' => [
			[ 'value' => '1 in 3', 'label' => 'UK Adults Affected' ],
			[ 'value' => '7M+',    'label' => 'Undiagnosed in UK' ],
			[ 'value' => 'Free',   'label' => 'NHS Check — No Charge' ],
			[ 'value' => '5 Min',  'label' => 'Quick, Painless Check' ],
		],
		'bp_threat_stats' => [
			[ 'value' => '14M+', 'label' => 'UK adults with high BP' ],
			[ 'value' => '50%',  'label' => 'Don’t know they have it' ],
			[ 'value' => '#1',   'label' => 'Risk factor for stroke' ],
		],
		'bp_risk_cards' => [
			[ 'title' => 'Age 40 or Over',      'desc' => 'Blood pressure tends to rise naturally as we age. The NHS recommends everyone over 40 gets checked every five years, and more often if readings are borderline.' ],
			[ 'title' => 'Family History',      'desc' => 'If a close relative has high blood pressure or heart disease, your own risk is significantly higher. Genetics play a real role in cardiovascular health.' ],
			[ 'title' => 'High-Salt Diet',      'desc' => 'Eating too much salt is one of the most common causes of raised blood pressure. The average UK adult eats roughly double the recommended daily amount.' ],
			[ 'title' => 'Being Overweight',    'desc' => 'Carrying excess weight puts additional strain on your heart and blood vessels. Even modest reductions in weight can lead to meaningful improvements in blood pressure.' ],
			[ 'title' => 'Physical Inactivity', 'desc' => 'A sedentary lifestyle weakens the heart over time. Regular moderate exercise strengthens the cardiovascular system and helps keep blood pressure in a healthy range.' ],
			[ 'title' => 'Alcohol & Smoking',   'desc' => 'Both alcohol and tobacco directly raise blood pressure and damage artery walls. Reducing or stopping either can produce rapid improvements in cardiovascular health.' ],
		],
		'bp_reduce_cards' => [
			[ 'title' => 'Reduce Salt Intake',        'desc' => 'Aim for no more than 6g of salt per day. Check food labels and cook from scratch where possible. Even small reductions can lower blood pressure within weeks.' ],
			[ 'title' => 'Regular Physical Activity', 'desc' => 'Aim for 150 minutes of moderate activity per week — brisk walking, cycling, or swimming. Consistent exercise is one of the most effective natural blood pressure treatments.' ],
			[ 'title' => 'Healthy Weight',            'desc' => 'Losing even 5–10% of body weight if you’re overweight can produce measurable improvements in blood pressure. Our pharmacy team can provide weight management guidance.' ],
			[ 'title' => 'Limit Alcohol',             'desc' => 'Keep alcohol within NHS guidelines (no more than 14 units per week). Excessive drinking raises blood pressure and can interfere with blood pressure medications.' ],
			[ 'title' => 'Stop Smoking',              'desc' => 'Smoking temporarily raises blood pressure with each cigarette and damages artery walls long-term. Southdowns offers free NHS Stop Smoking support — ask your pharmacist.' ],
			[ 'title' => 'Manage Stress',             'desc' => 'Chronic stress keeps blood pressure elevated. Practical steps like better sleep, mindfulness, and regular breaks can all contribute to healthier readings over time.' ],
		],
		'bp_why_cards' => [
			[ 'title' => 'Free NHS Service',           'desc' => 'Blood pressure checks are completely free at all four branches. No charge, no private fee, no insurance required.' ],
			[ 'title' => 'No Appointment Needed',      'desc' => 'Walk in to any of our Hampshire branches at your convenience. No booking, no waiting weeks for an appointment.' ],
			[ 'title' => 'Instant Results',            'desc' => 'Readings are immediate. Our pharmacist will discuss your results with you on the spot and advise on next steps where appropriate.' ],
			[ 'title' => 'Expert Pharmacist Advice',   'desc' => 'Our GPhC-registered pharmacists provide personalised guidance, lifestyle advice, and GP referrals when needed — not just a number on a screen.' ],
			[ 'title' => '4 Local Hampshire Branches', 'desc' => 'Emsworth, Havant, Davies Pharmacy, and Rowlands Castle. Conveniently located so your nearest branch is never far away.' ],
			[ 'title' => 'Linked to Your Care',        'desc' => 'We can share your results with your GP if required and help you manage any follow-up care. Your health, joined up.' ],
		],
		'bp_elig_recommended' => [
			[ 'text' => 'Adults aged 40 and over' ],
			[ 'text' => 'Anyone with a family history of heart disease or stroke' ],
			[ 'text' => 'People who are overweight or obese' ],
			[ 'text' => 'Those with a high-salt or unhealthy diet' ],
			[ 'text' => 'Anyone who smokes or drinks regularly' ],
			[ 'text' => 'People who are physically inactive' ],
			[ 'text' => "Anyone who hasn't had a check in over a year" ],
		],
		'bp_elig_frequency' => [
			[ 'freq' => 'Every 5 years',   'desc' => 'For adults aged 40+ with no known risk factors or previous high readings.' ],
			[ 'freq' => 'Every year',      'desc' => 'If your reading is consistently in the higher normal range (130–139/85–89 mmHg).' ],
			[ 'freq' => 'Every 3–6 months', 'desc' => 'If you’re being monitored for hypertension or are on blood pressure medication.' ],
			[ 'freq' => 'Immediately',     'desc' => 'If you experience severe headaches, blurred vision, chest pain, or dizziness.' ],
		],
		'bp_cta_points' => [
			[ 'text' => 'Completely free — NHS service' ],
			[ 'text' => 'No appointment needed, walk in' ],
			[ 'text' => 'Results in just 5 minutes' ],
			[ 'text' => 'Instant pharmacist advice' ],
			[ 'text' => 'Available at all 4 Hampshire branches' ],
			[ 'text' => 'GPhC-registered pharmacists' ],
		],
		'bp_faq_items' => [
			[ 'question' => 'Is the blood pressure check really free?', 'answer' => 'Yes, completely free. Our blood pressure checks are an NHS service available at all four Southdowns branches. There is no charge, no private fee, and no insurance needed.' ],
			[ 'question' => 'Do I need an appointment?', 'answer' => "No appointment is needed. Simply walk in to any of our Hampshire branches during opening hours and ask for a blood pressure check. We recommend calling ahead at busy times, but it's not required." ],
			[ 'question' => 'How long does the check take?', 'answer' => "The check itself takes around 2 minutes. Including a brief conversation with your pharmacist about the results and any recommended next steps, you're typically in and out in 5–10 minutes." ],
			[ 'question' => 'What do the numbers mean?', 'answer' => 'Your blood pressure reading has two numbers: systolic (top) and diastolic (bottom), measured in mmHg. Ideal is around 120/80 mmHg. High blood pressure is generally considered 140/90 mmHg or above. Our pharmacist will explain what your specific reading means for you.' ],
			[ 'question' => 'What happens if my blood pressure is high?', 'answer' => "Our pharmacist will advise on lifestyle changes and, if appropriate, refer you to your GP for further assessment or medication. A single high reading doesn't necessarily mean you have hypertension — multiple readings over time are usually needed for a diagnosis." ],
			[ 'question' => 'How often should I get my blood pressure checked?', 'answer' => "The NHS recommends all adults over 40 get checked at least every 5 years. If your reading is in the high-normal range, annually is advisable. If you're on blood pressure medication or have a history of hypertension, more frequent checks (every 3–6 months) are recommended." ],
			[ 'question' => "Can I get a check if I'm pregnant?", 'answer' => 'Yes, and it’s particularly important during pregnancy as high blood pressure can be a sign of pre-eclampsia. However, your midwife or GP should be your primary point of contact during pregnancy — please ensure they are informed of any readings from our check.' ],
			[ 'question' => 'Which branches offer blood pressure checks?', 'answer' => 'All four Southdowns Pharmacy branches — Emsworth, Havant (Bosmere Medical Centre), Davies Pharmacy, and Rowlands Castle — offer free blood pressure checks during their regular opening hours.' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( bp_repeater_defaults() ) as $field_name ) {
		add_filter( "acf/load_value/name={$field_name}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) {
				return $value;
			}
			$defaults = bp_repeater_defaults();
			return $defaults[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
