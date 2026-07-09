<?php
/**
 * ACF Local Field Group — NHS Prescriptions Page
 *
 * Applies to: page-templates/page-nhs-prescriptions.php
 * Text fields pre-filled via default_value; repeaters seeded via load_value.
 * Images are upload fields. The "Nominate" / "NHS App" button labels and the
 * decorative roundels stay in the design.
 */

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'             => 'group_nhs_prescriptions_page',
		'title'           => 'NHS Prescriptions — Page Content',
		'position'        => 'acf_after_title',
		'style'           => 'default',
		'label_placement' => 'top',
		'hide_on_screen'  => [ 'the_content' ],
		'location'        => [
			[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-nhs-prescriptions.php' ] ],
		],
		'fields' => [

			// ── Hero ──
			[ 'key' => 'field_rx_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_hero_badge', 'label' => 'Badge', 'name' => 'rx_hero_badge', 'type' => 'text', 'default_value' => 'NHS &amp; PRIVATE PRESCRIPTIONS &bull; HAMPSHIRE' ],
			[ 'key' => 'field_rx_hero_heading', 'label' => 'Heading', 'name' => 'rx_hero_heading', 'type' => 'text', 'default_value' => 'Prescriptions Made Easy &mdash; Collect From Your Local Hampshire Pharmacy' ],
			[ 'key' => 'field_rx_hero_subtext', 'label' => 'Sub-text', 'name' => 'rx_hero_subtext', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Nominate your nearest Southdowns branch and we&rsquo;ll handle your NHS repeat prescriptions. Reminders, family ordering, and expert pharmacist support included.' ],
			[ 'key' => 'field_rx_hero_image', 'label' => 'Hero Image', 'name' => 'rx_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[
				'key' => 'field_rx_hero_trust', 'label' => 'Hero Trust Items', 'name' => 'rx_hero_trust', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item',
				'sub_fields' => [ [ 'key' => 'field_rx_hero_trust_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ],
			],

			// ── Stat Bar ──
			[ 'key' => 'field_rx_tab_stats', 'label' => 'Stat Bar', 'name' => '', 'type' => 'tab' ],
			[
				'key' => 'field_rx_stats', 'label' => 'Stat Cards', 'name' => 'rx_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat',
				'sub_fields' => [
					[ 'key' => 'field_rx_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_rx_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],

			// ── How It Works ──
			[ 'key' => 'field_rx_tab_how', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_how_heading', 'label' => 'Heading', 'name' => 'rx_how_heading', 'type' => 'text', 'default_value' => 'Ready in Three Simple Steps' ],
			[ 'key' => 'field_rx_how_intro', 'label' => 'Intro', 'name' => 'rx_how_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Nominate your branch, let us prepare your medication, and collect when it suits you.' ],
			[ 'key' => 'field_rx_how_image', 'label' => 'Section Image', 'name' => 'rx_how_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[
				'key' => 'field_rx_steps', 'label' => 'Steps', 'name' => 'rx_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step',
				'sub_fields' => [
					[ 'key' => 'field_rx_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_rx_step_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
					[ 'key' => 'field_rx_step_pill', 'label' => 'Pill', 'name' => 'pill', 'type' => 'text' ],
				],
			],
			[ 'key' => 'field_rx_how_note', 'label' => 'EPS Note', 'name' => 'rx_how_note', 'type' => 'text', 'default_value' => 'NHS EPS means no paper prescription &mdash; your GP sends everything to us electronically.' ],

			// ── Features ──
			[ 'key' => 'field_rx_tab_feat', 'label' => 'Features', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_feat_heading', 'label' => 'Heading', 'name' => 'rx_feat_heading', 'type' => 'text', 'default_value' => 'Everything Included &mdash; No Extra Charges' ],
			[ 'key' => 'field_rx_feat_intro', 'label' => 'Intro', 'name' => 'rx_feat_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Your NHS prescription service, handled from start to finish.' ],
			[
				'key' => 'field_rx_features', 'label' => 'Feature Cards', 'name' => 'rx_features', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Feature',
				'instructions' => 'Card icons stay fixed by position.',
				'sub_fields' => [
					[ 'key' => 'field_rx_feat_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_rx_feat_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],

			// ── Nominate ──
			[ 'key' => 'field_rx_tab_nom', 'label' => 'Nominate', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_nom_heading', 'label' => 'Heading', 'name' => 'rx_nom_heading', 'type' => 'text', 'default_value' => 'Nominate Your Southdowns Branch Today' ],
			[
				'key' => 'field_rx_nom_body', 'label' => 'Body Text', 'name' => 'rx_nom_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
				'default_value' => '<p>Nominating your local Southdowns Pharmacy means your GP can send prescriptions directly to us — no paper, no extra trips. Once you’re set up, ordering your repeat prescriptions takes minutes.</p><p>You can also sign up on our website to order private prescriptions, track orders, and manage your family’s medication in one place.</p>',
			],
			[
				'key' => 'field_rx_benefits', 'label' => 'Benefits List', 'name' => 'rx_benefits', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Benefit',
				'sub_fields' => [ [ 'key' => 'field_rx_benefit_text', 'label' => 'Item', 'name' => 'text', 'type' => 'text' ] ],
			],
			[ 'key' => 'field_rx_nom_image', 'label' => 'Section Image', 'name' => 'rx_nom_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],

			// ── Repeat Dispensing ──
			[ 'key' => 'field_rx_tab_rep', 'label' => 'Repeat Dispensing', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_rep_heading', 'label' => 'Heading', 'name' => 'rx_rep_heading', 'type' => 'text', 'default_value' => 'What Is NHS Repeat Dispensing?' ],
			[ 'key' => 'field_rx_rep_intro', 'label' => 'Intro', 'name' => 'rx_rep_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'A smarter way to manage long-term medications &mdash; we handle the schedule for you.' ],
			[ 'key' => 'field_rx_rep_body', 'label' => 'Body', 'name' => 'rx_rep_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Repeat dispensing allows your GP to issue a batch of prescriptions for medications you take regularly. You don&rsquo;t need to request a new prescription each time &mdash; we manage the schedule and dispense at the right intervals automatically.' ],
			[ 'key' => 'field_rx_eps_heading', 'label' => 'EPS Box Heading', 'name' => 'rx_eps_heading', 'type' => 'text', 'default_value' => 'Electronic Repeat Dispensing (EPS)' ],
			[ 'key' => 'field_rx_eps_body', 'label' => 'EPS Box Body', 'name' => 'rx_eps_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'We are fully integrated with the NHS Electronic Prescription Service. Your GP sends prescriptions directly to our pharmacy electronically. No paper, no delays.' ],
			[
				'key' => 'field_rx_repeat_cards', 'label' => 'Benefit Cards', 'name' => 'rx_repeat_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card',
				'sub_fields' => [
					[ 'key' => 'field_rx_repcard_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_rx_repcard_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
				],
			],

			// ── What We Accept ──
			[ 'key' => 'field_rx_tab_acc', 'label' => 'What We Accept', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_acc_heading', 'label' => 'Heading', 'name' => 'rx_acc_heading', 'type' => 'text', 'default_value' => 'NHS &amp; Private Prescriptions Welcome' ],
			[ 'key' => 'field_rx_acc_intro', 'label' => 'Intro', 'name' => 'rx_acc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Whatever your prescription type, all four branches have you covered.' ],
			[ 'key' => 'field_rx_nhs_title', 'label' => 'NHS Card Title', 'name' => 'rx_nhs_title', 'type' => 'text', 'default_value' => 'NHS Prescriptions' ],
			[
				'key' => 'field_rx_nhs_list', 'label' => 'NHS List', 'name' => 'rx_nhs_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item',
				'sub_fields' => [ [ 'key' => 'field_rx_nhs_item', 'label' => 'Item', 'name' => 'text', 'type' => 'text' ] ],
			],
			[ 'key' => 'field_rx_pvt_title', 'label' => 'Private Card Title', 'name' => 'rx_pvt_title', 'type' => 'text', 'default_value' => 'Private Prescriptions' ],
			[
				'key' => 'field_rx_pvt_list', 'label' => 'Private List', 'name' => 'rx_pvt_list', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Item',
				'sub_fields' => [ [ 'key' => 'field_rx_pvt_item', 'label' => 'Item', 'name' => 'text', 'type' => 'text' ] ],
			],
			[ 'key' => 'field_rx_acc_statement', 'label' => 'Statement', 'name' => 'rx_acc_statement', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four Southdowns branches accept NHS and private prescriptions. Nominate any branch and your GP can send prescriptions to us electronically.' ],

			// ── Locations ──
			[ 'key' => 'field_rx_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_loc_heading', 'label' => 'Heading', 'name' => 'rx_loc_heading', 'type' => 'text', 'default_value' => 'Nominate Your Nearest Hampshire Branch' ],
			[ 'key' => 'field_rx_loc_intro', 'label' => 'Intro', 'name' => 'rx_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four Southdowns branches accept NHS and private prescriptions.' ],
			[ 'key' => 'field_rx_loc_banner_heading', 'label' => 'Banner Heading', 'name' => 'rx_loc_banner_heading', 'type' => 'text', 'default_value' => 'Nominating takes under 2 minutes' ],
			[ 'key' => 'field_rx_loc_banner_body', 'label' => 'Banner Body', 'name' => 'rx_loc_banner_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Nominate online or visit any of our four Hampshire branches in person. Your GP can then send all prescriptions directly to us electronically.' ],

			// ── Why Choose Us ──
			[ 'key' => 'field_rx_tab_why', 'label' => 'Why Choose Us', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_why_heading', 'label' => 'Heading', 'name' => 'rx_why_heading', 'type' => 'text', 'default_value' => 'Why Patients Choose Southdowns' ],
			[ 'key' => 'field_rx_why_intro', 'label' => 'Intro', 'name' => 'rx_why_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Your local pharmacist &mdash; not a faceless online service.' ],
			[
				'key' => 'field_rx_why_cards', 'label' => 'Cards', 'name' => 'rx_why_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card',
				'sub_fields' => [
					[ 'key' => 'field_rx_whycard_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
					[ 'key' => 'field_rx_whycard_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
				],
			],

			// ── FAQ ──
			[ 'key' => 'field_rx_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_faq_heading', 'label' => 'Heading', 'name' => 'rx_faq_heading', 'type' => 'text', 'default_value' => 'Prescription Service FAQs' ],
			[ 'key' => 'field_rx_faq_intro', 'label' => 'Intro', 'name' => 'rx_faq_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Everything you need to know about our prescription services across Hampshire.' ],
			[
				'key' => 'field_rx_faq_stats', 'label' => 'Sidebar Stats', 'name' => 'rx_faq_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat',
				'sub_fields' => [
					[ 'key' => 'field_rx_faqstat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
					[ 'key' => 'field_rx_faqstat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				],
			],
			[
				'key' => 'field_rx_faqs', 'label' => 'FAQ Items', 'name' => 'rx_faqs', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ',
				'sub_fields' => [
					[ 'key' => 'field_rx_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
					[ 'key' => 'field_rx_faq_a', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
				],
			],

			// ── Closing CTA ──
			[ 'key' => 'field_rx_tab_cta', 'label' => 'Closing CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_rx_cta_heading', 'label' => 'Heading', 'name' => 'rx_cta_heading', 'type' => 'text', 'default_value' => 'Nominate Your Pharmacy Today' ],
			[ 'key' => 'field_rx_cta_subtext', 'label' => 'Sub-text', 'name' => 'rx_cta_subtext', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Free NHS prescriptions. Same-day collection. Expert pharmacist support across four Hampshire branches.' ],
			[
				'key' => 'field_rx_cta_points', 'label' => 'Checklist', 'name' => 'rx_cta_points', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Point',
				'sub_fields' => [ [ 'key' => 'field_rx_cta_point_text', 'label' => 'Point', 'name' => 'text', 'type' => 'text' ] ],
			],
			[
				'key' => 'field_rx_cta_pills', 'label' => 'Badge Pills', 'name' => 'rx_cta_pills', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Pill',
				'sub_fields' => [ [ 'key' => 'field_rx_cta_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ],
			],
		],
	] );

} );

/**
 * Seed the NHS Prescriptions repeaters with the current content.
 */
function rx_repeater_defaults(): array {
	return [
		'rx_hero_trust' => [
			[ 'text' => 'GPhC Registered' ], [ 'text' => 'All Four Locations' ], [ 'text' => 'NHS &amp; Private' ], [ 'text' => 'Same-Day Collection' ],
		],
		'rx_stats' => [
			[ 'value' => '10,000+', 'label' => 'Patients Served' ],
			[ 'value' => '4', 'label' => 'Hampshire Locations' ],
			[ 'value' => 'Free', 'label' => 'NHS Repeat Prescriptions' ],
			[ 'value' => '4.9/5', 'label' => 'Patient Satisfaction' ],
		],
		'rx_steps' => [
			[ 'title' => 'Nominate Your Pharmacy', 'body' => 'Nominate your preferred Southdowns branch online or in person. Once nominated, your GP sends your electronic prescription directly to us &mdash; no paper needed.', 'pill' => 'Takes under 2 minutes' ],
			[ 'title' => 'We Prepare Your Medication', 'body' => 'Our GPhC-registered pharmacists dispense and check your prescription carefully, ensuring accuracy and your safety before it&rsquo;s ready to collect.', 'pill' => 'Same-day when ordered before 12pm' ],
			[ 'title' => 'Collect From Your Branch', 'body' => 'Visit your local branch at a time that suits you. We&rsquo;ll send you a reminder before you run out so you never miss a dose.', 'pill' => 'At your convenience' ],
		],
		'rx_features' => [
			[ 'title' => 'Same-Day Collection', 'desc' => 'Order before 12pm and collect the same day from any of our four Hampshire branches.' ],
			[ 'title' => 'Repeat Reminders', 'desc' => 'We remind you to reorder a week before you run out &mdash; so you never miss a dose of essential medication.' ],
			[ 'title' => 'Family Ordering', 'desc' => 'Manage prescriptions for your whole family from one account. Simplified ordering for everyone you care for.' ],
			[ 'title' => 'Electronic Prescriptions', 'desc' => 'Fully integrated with NHS EPS. Your GP sends prescriptions directly to us electronically &mdash; no paper, no delays.' ],
			[ 'title' => 'Expert Pharmacist Support', 'desc' => 'We&rsquo;re your local pharmacy behind the technology. Our team is always on hand to answer questions about your medication.' ],
			[ 'title' => 'NHS App Compatible', 'desc' => 'Order NHS repeat prescriptions via the NHS App. Nominate your chosen Southdowns branch and order directly through the app.' ],
		],
		'rx_benefits' => [
			[ 'text' => 'Nominate online or in branch in under 2 minutes' ],
			[ 'text' => 'GP sends prescriptions to us electronically' ],
			[ 'text' => 'Automatic reminders before you run out' ],
			[ 'text' => 'Order for yourself and your family' ],
			[ 'text' => 'Expert pharmacist advice whenever you need it' ],
			[ 'text' => 'NHS and private prescriptions both accepted' ],
		],
		'rx_repeat_cards' => [
			[ 'title' => 'Convenience', 'desc' => 'No repeated GP appointments for the same medication.' ],
			[ 'title' => 'Time-Saving', 'desc' => 'We handle prescription requests automatically on your behalf.' ],
			[ 'title' => 'Better Medication Management', 'desc' => 'Regular intervals mean you never run out of essential medication.' ],
			[ 'title' => 'Pharmacist Monitoring', 'desc' => 'Our team checks your medication at every dispensing for accuracy and your safety.' ],
		],
		'rx_nhs_list' => [
			[ 'text' => 'Electronic prescriptions (EPS)' ], [ 'text' => 'Paper prescriptions from your GP' ], [ 'text' => 'Hospital discharge prescriptions' ], [ 'text' => 'Repeat prescriptions' ], [ 'text' => 'Repeat dispensing prescriptions' ], [ 'text' => 'Same-day prescription collection' ], [ 'text' => 'Prescription exemptions honoured' ],
		],
		'rx_pvt_list' => [
			[ 'text' => 'Private GP prescriptions' ], [ 'text' => 'Specialist prescriptions' ], [ 'text' => 'Weight loss medications (Mounjaro, Wegovy)' ], [ 'text' => 'Travel medication' ], [ 'text' => 'Hair loss treatments' ], [ 'text' => 'Emergency medication supplies' ], [ 'text' => 'Competitive private prescription pricing' ],
		],
		'rx_why_cards' => [
			[ 'title' => 'GPhC-Registered Pharmacists', 'desc' => 'Expert, qualified dispensing at all four branches.' ],
			[ 'title' => 'Same-Day Collection', 'desc' => 'Order before 12pm and collect the same day.' ],
			[ 'title' => 'Automatic Reminders', 'desc' => 'We remind you before you run out &mdash; so you never miss a dose.' ],
			[ 'title' => 'Electronic Prescriptions', 'desc' => 'Fully integrated with NHS EPS across all four branches.' ],
			[ 'title' => 'Family Prescription Management', 'desc' => 'Handle prescriptions for your whole family from one account.' ],
			[ 'title' => 'Expert Advice', 'desc' => 'Your local pharmacy team on hand to answer any medication questions.' ],
		],
		'rx_faq_stats' => [
			[ 'value' => '4', 'label' => 'Branches' ], [ 'value' => 'Free', 'label' => 'NHS Service' ], [ 'value' => 'Same Day', 'label' => 'Collection' ], [ 'value' => '4.9/5', 'label' => 'Rating' ],
		],
		'rx_faqs' => [
			[ 'question' => 'How do I nominate Southdowns as my pharmacy?', 'answer' => 'You can nominate any of our four branches online at southdownspharmacygroup.co.uk/nominate-us, in person at your chosen branch, or by asking your GP to nominate us on your behalf.' ],
			[ 'question' => 'Can I order repeat prescriptions through the NHS App?', 'answer' => 'Yes. Nominate your preferred Southdowns branch first, then order repeat prescriptions directly through the NHS App at any time.' ],
			[ 'question' => 'How quickly can I collect my prescription?', 'answer' => 'Same-day collection is available when ordered before 12pm. We&rsquo;ll send you a reminder when your prescription is ready to collect.' ],
			[ 'question' => 'Do you accept electronic prescriptions?', 'answer' => 'Yes, we are fully integrated with the NHS Electronic Prescription Service (EPS). Your GP can send prescriptions directly to any of our four branches electronically.' ],
			[ 'question' => 'Can I manage prescriptions for my family?', 'answer' => 'Yes. Sign up on our website and you can order and manage prescriptions for your whole family from one account.' ],
			[ 'question' => 'Do you accept private prescriptions?', 'answer' => 'Yes, all four branches accept private prescriptions including weight loss medications, specialist prescriptions, travel medication and more.' ],
		],
		'rx_cta_points' => [
			[ 'text' => 'Free NHS repeat prescriptions' ], [ 'text' => 'Same-day collection before 12pm' ], [ 'text' => 'Automatic reminders so you never run out' ], [ 'text' => 'Electronic prescriptions via NHS EPS' ], [ 'text' => 'Manage your whole family&rsquo;s medications' ], [ 'text' => 'GPhC-registered pharmacists at every branch' ],
		],
		'rx_cta_pills' => [
			[ 'text' => 'GPhC Registered' ], [ 'text' => 'Free NHS Service' ], [ 'text' => 'Same-Day Collection' ], [ 'text' => 'Four Hampshire Branches' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( rx_repeater_defaults() ) as $field_name ) {
		add_filter( "acf/load_value/name={$field_name}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) {
				return $value;
			}
			$defaults = rx_repeater_defaults();
			return $defaults[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
