<?php
/**
 * ACF Local Field Group — FAQ Page (page-templates/page-faq.php)
 * The FAQ repeater feeds both the visible accordion AND the FAQPage JSON-LD schema.
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key' => 'group_faq_page', 'title' => 'FAQ — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top', 'hide_on_screen' => [ 'the_content' ],
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-faq.php' ] ] ],
		'fields' => [
			[ 'key' => 'field_faq_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'faq_hero_eyebrow', 'type' => 'text', 'default_value' => 'Help &amp; Support' ],
			[ 'key' => 'field_faq_hero_heading', 'label' => 'Hero Heading', 'name' => 'faq_hero_heading', 'type' => 'text', 'default_value' => 'Frequently Asked Questions' ],
			[ 'key' => 'field_faq_hero_intro', 'label' => 'Hero Intro', 'name' => 'faq_hero_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Answers to the questions our Hampshire patients ask most &mdash; plus address, phone and opening hours for all four branches.' ],
			[
				'key' => 'field_faq_items', 'label' => 'FAQ Items', 'name' => 'faq_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ',
				'instructions' => 'These feed both the on-page accordion and the SEO FAQ schema.',
				'sub_fields' => [
					[ 'key' => 'field_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text' ],
					[ 'key' => 'field_faq_a', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '' ],
				],
			],
			[ 'key' => 'field_faq_branches_heading', 'label' => 'Branches Heading', 'name' => 'faq_branches_heading', 'type' => 'text', 'default_value' => 'Our Four Hampshire Branches' ],
			[ 'key' => 'field_faq_branches_intro', 'label' => 'Branches Intro', 'name' => 'faq_branches_intro', 'type' => 'text', 'default_value' => 'Address, phone and opening hours for every branch.' ],
			[ 'key' => 'field_faq_cta_heading', 'label' => 'CTA Heading', 'name' => 'faq_cta_heading', 'type' => 'text', 'default_value' => 'Still have a question?' ],
			[ 'key' => 'field_faq_cta_body', 'label' => 'CTA Body', 'name' => 'faq_cta_body', 'type' => 'text', 'default_value' => 'Our team is happy to help &mdash; book an appointment online or call your nearest branch.' ],
			[ 'key' => 'field_faq_cta_btn', 'label' => 'CTA Button', 'name' => 'faq_cta_btn', 'type' => 'text', 'default_value' => 'Book an Appointment' ],
		],
	] );
} );

function faq_repeater_defaults(): array {
	return [
		'faq_items' => [
			[ 'question' => 'Do I need an appointment, or can I just walk in?', 'answer' => 'For everyday pharmacy needs — prescriptions, advice and over-the-counter medicines — you are welcome to walk in during opening hours. Clinical services such as travel health, weight loss consultations and vaccinations are best booked in advance so we can set time aside for you. You can book online or call your nearest branch.' ],
			[ 'question' => 'Do I need a GP referral?', 'answer' => 'No. Most of our private services — including travel vaccinations, weight loss consultations and health checks — do not need a GP referral. You can book directly with us.' ],
			[ 'question' => 'Are same-day appointments available?', 'answer' => 'Often, yes. Same-day and next-day appointments are usually available subject to demand. Booking online shows you live availability across all four branches.' ],
			[ 'question' => 'How do I book an appointment?', 'answer' => 'Book online through our appointment page, or call your nearest branch directly. You can choose your location, service and time in a couple of minutes.' ],
			[ 'question' => 'Which branch offers Yellow Fever vaccinations?', 'answer' => 'Yellow Fever vaccinations are carried out at our Bosmere Pharmacy in Havant, which is a NaTHNaC-registered Yellow Fever Vaccination Centre.' ],
			[ 'question' => 'Which branch offers ear wax removal?', 'answer' => 'Our TympaHealth ear wax removal service, using gentle microsuction, is available at our Emsworth branch.' ],
			[ 'question' => 'Do you offer NHS services?', 'answer' => 'Yes. Our pharmacies provide NHS services including Pharmacy First consultations, prescription dispensing and seasonal vaccinations, alongside our private clinics.' ],
			[ 'question' => 'Can I get my NHS repeat prescriptions from you?', 'answer' => 'Yes. You can nominate any of our branches as your regular pharmacy, and your GP surgery will then send your repeat prescriptions to us electronically through the NHS Electronic Prescription Service.' ],
			[ 'question' => 'How much do travel vaccinations cost?', 'answer' => 'Prices depend on which vaccines you need for your destination. We confirm the full cost with you during your travel health consultation, with no obligation to proceed.' ],
			[ 'question' => 'What are your opening hours?', 'answer' => 'Opening hours vary slightly by branch. You will find the address, phone number and opening hours for each of our four Hampshire pharmacies further down this page.' ],
		],
	];
}

add_action( 'acf/init', function () {
	add_filter( 'acf/load_value/name=faq_items', function ( $value, $post_id, $field ) {
		if ( ! empty( $value ) ) return $value;
		$d = faq_repeater_defaults();
		return $d['faq_items'];
	}, 10, 3 );
} );
