<?php
/**
 * ACF Local Field Group — Contraception Services Page
 * Applies to: page-templates/page-contraception.php
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key' => 'group_contraception_page', 'title' => 'Contraception Services — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top', 'hide_on_screen' => [ 'the_content' ],
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-contraception.php' ] ] ],
		'fields' => [
			[ 'key' => 'field_cs_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_hero_image', 'label' => 'Hero Image', 'name' => 'cs_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_cs_hero_badge', 'label' => 'Badge', 'name' => 'cs_hero_badge', 'type' => 'text', 'default_value' => 'Free NHS Service &middot; Confidential &middot; No Referral Needed' ],
			[ 'key' => 'field_cs_hero_headline', 'label' => 'Headline', 'name' => 'cs_hero_headline', 'type' => 'text', 'default_value' => 'Take Control of Your Contraception' ],
			[ 'key' => 'field_cs_hero_body', 'label' => 'Body', 'name' => 'cs_hero_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'A free, confidential NHS contraception service at Southdowns Pharmacy Group. Get expert advice, the ongoing contraceptive pill and emergency contraception &mdash; available across Emsworth, Havant, Leigh Park and Rowlands Castle.' ],

			[ 'key' => 'field_cs_tab_stats', 'label' => 'Stats', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_stats', 'label' => 'Stats', 'name' => 'cs_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat', 'sub_fields' => [
				[ 'key' => 'field_cs_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
				[ 'key' => 'field_cs_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				[ 'key' => 'field_cs_stat_caption', 'label' => 'Caption', 'name' => 'caption', 'type' => 'text' ],
			] ],

			[ 'key' => 'field_cs_tab_intro', 'label' => 'Intro', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_intro_eyebrow', 'label' => 'Eyebrow', 'name' => 'cs_intro_eyebrow', 'type' => 'text', 'default_value' => 'Why Choose Us' ],
			[ 'key' => 'field_cs_intro_heading', 'label' => 'Heading', 'name' => 'cs_intro_heading', 'type' => 'text', 'default_value' => 'Reliable Contraception, Right on Your High Street' ],
			[ 'key' => 'field_cs_intro_body', 'label' => 'Body', 'name' => 'cs_intro_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0, 'default_value' => '<p>Choosing our <strong>NHS Contraception Service</strong> means professional advice and genuine support whenever you need it. Our pharmacists are specially trained to provide confidential consultations and recommend the contraceptive method that&rsquo;s right for your body, your lifestyle and your future.</p><p>From starting or continuing the <strong>oral contraceptive pill</strong> to fast, discreet <strong>emergency contraception</strong>, we make accessible reproductive healthcare simple &mdash; no GP referral, no long waits, and no awkwardness.</p><p>We understand that everyone&rsquo;s needs are different. That&rsquo;s why every consultation starts with <em>you</em> &mdash; your health, your questions and your choice.</p>' ],
			[ 'key' => 'field_cs_intro_image', 'label' => 'Intro Image', 'name' => 'cs_intro_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_cs_intro_btn', 'label' => 'Button Label', 'name' => 'cs_intro_btn', 'type' => 'text', 'default_value' => 'Book a Consultation' ],

			[ 'key' => 'field_cs_tab_svc', 'label' => 'What We Offer', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_svc_eyebrow', 'label' => 'Eyebrow', 'name' => 'cs_svc_eyebrow', 'type' => 'text', 'default_value' => 'Our Contraception Service' ],
			[ 'key' => 'field_cs_svc_heading', 'label' => 'Heading', 'name' => 'cs_svc_heading', 'type' => 'text', 'default_value' => 'Everything You Need in One Place' ],
			[ 'key' => 'field_cs_svc_intro', 'label' => 'Intro', 'name' => 'cs_svc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'From your first consultation to ongoing support, our pharmacists are here to help you make confident, informed choices about your reproductive health.' ],
			[ 'key' => 'field_cs_services', 'label' => 'Service Cards', 'name' => 'cs_services', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card', 'instructions' => 'Icons stay fixed by position.', 'sub_fields' => [
				[ 'key' => 'field_cs_svc_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_cs_svc_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
			] ],

			[ 'key' => 'field_cs_tab_ec', 'label' => 'Emergency', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_ec_offer', 'label' => 'Card Label', 'name' => 'cs_ec_offer', 'type' => 'text', 'default_value' => 'Act Fast' ],
			[ 'key' => 'field_cs_ec_heading', 'label' => 'Card Heading', 'name' => 'cs_ec_heading', 'type' => 'text', 'default_value' => 'Emergency Contraception' ],
			[ 'key' => 'field_cs_ec_body', 'label' => 'Card Body', 'name' => 'cs_ec_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Need the morning-after pill? Don&rsquo;t wait. Emergency contraception is most effective the sooner it&rsquo;s taken &mdash; our pharmacists provide it quickly, confidentially and without judgment.' ],
			[ 'key' => 'field_cs_ec_points', 'label' => 'Card Points', 'name' => 'cs_ec_points', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Point', 'sub_fields' => [ [ 'key' => 'field_cs_ec_point_text', 'label' => 'Point', 'name' => 'text', 'type' => 'text' ] ] ],
			[ 'key' => 'field_cs_ec_btn', 'label' => 'Card Button', 'name' => 'cs_ec_btn', 'type' => 'text', 'default_value' => 'Get Emergency Contraception' ],
			[ 'key' => 'field_cs_ec_r_eyebrow', 'label' => 'Right Eyebrow', 'name' => 'cs_ec_r_eyebrow', 'type' => 'text', 'default_value' => 'Here When It Matters' ],
			[ 'key' => 'field_cs_ec_r_heading', 'label' => 'Right Heading', 'name' => 'cs_ec_r_heading', 'type' => 'text', 'default_value' => 'Discreet Help, Without the Wait' ],
			[ 'key' => 'field_cs_ec_r_body', 'label' => 'Right Body', 'name' => 'cs_ec_r_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0, 'default_value' => '<p>Whether something went wrong or you&rsquo;re simply being careful, our pharmacists are here to help &mdash; calmly, quickly and in complete confidence. There&rsquo;s no need to explain yourself or feel embarrassed.</p><p>Emergency contraception is available across all four of our <strong>Emsworth, Havant, Leigh Park and Rowlands Castle</strong> branches, with same-day consultations and no GP referral needed.</p>' ],

			[ 'key' => 'field_cs_tab_steps', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_steps_eyebrow', 'label' => 'Eyebrow', 'name' => 'cs_steps_eyebrow', 'type' => 'text', 'default_value' => 'Simple &amp; Quick' ],
			[ 'key' => 'field_cs_steps_heading', 'label' => 'Heading', 'name' => 'cs_steps_heading', 'type' => 'text', 'default_value' => 'How Our Service Works' ],
			[ 'key' => 'field_cs_steps_intro', 'label' => 'Intro', 'name' => 'cs_steps_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'From booking to peace of mind in three simple steps &mdash; no GP, no long waits.' ],
			[ 'key' => 'field_cs_steps', 'label' => 'Steps', 'name' => 'cs_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'sub_fields' => [
				[ 'key' => 'field_cs_step_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
				[ 'key' => 'field_cs_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_cs_step_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],

			[ 'key' => 'field_cs_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_faq_eyebrow', 'label' => 'Eyebrow', 'name' => 'cs_faq_eyebrow', 'type' => 'text', 'default_value' => 'Your Questions Answered' ],
			[ 'key' => 'field_cs_faq_heading', 'label' => 'Heading', 'name' => 'cs_faq_heading', 'type' => 'text', 'default_value' => 'Contraception FAQs' ],
			[ 'key' => 'field_cs_faq_intro', 'label' => 'Intro', 'name' => 'cs_faq_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Everything you might want to know about our NHS contraception service. Tap a question to read more.' ],
			[ 'key' => 'field_cs_faqs', 'label' => 'FAQ Items (accordion)', 'name' => 'cs_faqs', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ', 'sub_fields' => [
				[ 'key' => 'field_cs_faq_title', 'label' => 'Question', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_cs_faq_body', 'label' => 'Answer', 'name' => 'body', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '' ],
			] ],

			[ 'key' => 'field_cs_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_loc_heading', 'label' => 'Heading', 'name' => 'cs_loc_heading', 'type' => 'text', 'default_value' => 'Find Your Nearest Branch' ],
			[ 'key' => 'field_cs_loc_intro', 'label' => 'Intro', 'name' => 'cs_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four Southdowns Pharmacy locations offer our NHS contraception service. Choose your nearest branch below to see opening hours, contact details and how to find us.' ],
			[ 'key' => 'field_cs_loc_note_h', 'label' => 'Note Heading', 'name' => 'cs_loc_note_h', 'type' => 'text', 'default_value' => 'Not sure which branch to visit?' ],
			[ 'key' => 'field_cs_loc_note_b', 'label' => 'Note Body', 'name' => 'cs_loc_note_b', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Every one of our four pharmacies offers the full NHS contraception service. Choose the location nearest to you above to view its details, or contact us and we&rsquo;ll happily point you to the right branch.' ],

			[ 'key' => 'field_cs_tab_book', 'label' => 'Booking Form', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_book_eyebrow', 'label' => 'Eyebrow', 'name' => 'cs_book_eyebrow', 'type' => 'text', 'default_value' => 'Book Your Consultation' ],
			[ 'key' => 'field_cs_book_heading', 'label' => 'Heading', 'name' => 'cs_book_heading', 'type' => 'text', 'default_value' => 'Reserve Your 10-Minute Appointment' ],
			[ 'key' => 'field_cs_book_formnote', 'label' => 'Form Note', 'name' => 'cs_book_formnote', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'By submitting this form you consent to Southdowns Pharmacy Group contacting you about your appointment. Your information is kept strictly confidential.' ],

			[ 'key' => 'field_cs_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_cs_cta_eyebrow', 'label' => 'Eyebrow', 'name' => 'cs_cta_eyebrow', 'type' => 'text', 'default_value' => 'Confidential &amp; Free on the NHS' ],
			[ 'key' => 'field_cs_cta_heading', 'label' => 'Heading (HTML)', 'name' => 'cs_cta_heading', 'type' => 'text', 'default_value' => 'Take Control of Your<br/>Reproductive Health' ],
			[ 'key' => 'field_cs_cta_body', 'label' => 'Body', 'name' => 'cs_cta_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Confidential advice, the contraceptive pill and emergency contraception &mdash; available at any Southdowns Pharmacy. Take the next step with Hampshire&rsquo;s trusted pharmacy group.' ],
			[ 'key' => 'field_cs_pills', 'label' => 'Badge Pills', 'name' => 'cs_pills', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Pill', 'sub_fields' => [ [ 'key' => 'field_cs_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			[ 'key' => 'field_cs_disclaimer', 'label' => 'Disclaimer', 'name' => 'cs_disclaimer', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => '<strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. Eligibility for the NHS contraception service is set by the NHS and may change. Always consult a qualified healthcare professional about your individual circumstances. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ],
		],
	] );
} );

function cs_repeater_defaults(): array {
	return [
		'cs_stats' => [
			[ 'value' => 'Free', 'label' => 'NHS Service', 'caption' => 'No charge for eligible patients' ],
			[ 'value' => '10 Min', 'label' => 'Consultation', 'caption' => 'Quick, private appointment' ],
			[ 'value' => '100%', 'label' => 'Confidential', 'caption' => 'Private consulting room' ],
			[ 'value' => '4', 'label' => 'Hampshire Locations', 'caption' => 'Book at your nearest branch' ],
		],
		'cs_services' => [
			[ 'title' => 'Ongoing Contraceptive Pill', 'body' => 'Start or continue your oral contraceptive pill directly with our pharmacist &mdash; no GP appointment needed.' ],
			[ 'title' => 'Emergency Contraception', 'body' => 'Fast, confidential access to the morning-after pill when you need it most. The sooner you act, the more effective it is.' ],
			[ 'title' => 'Personalised Consultations', 'body' => 'A friendly chat about your health, lifestyle and preferences so we can recommend the method that suits you best.' ],
			[ 'title' => 'Ongoing Support', 'body' => 'Follow-up appointments to review your method, manage any side effects and keep you comfortable and confident.' ],
			[ 'title' => 'Confidential &amp; Discreet', 'body' => 'Every consultation takes place in a private room with no judgment &mdash; just professional, respectful care.' ],
			[ 'title' => 'Walk-In or Book Ahead', 'body' => 'Flexible appointment times to fit your day. Walk in, book online, or call your nearest branch.' ],
		],
		'cs_ec_points' => [
			[ 'text' => 'Available free on the NHS for eligible patients' ], [ 'text' => 'Most effective within 72 hours' ], [ 'text' => 'Confidential, same-day consultation' ], [ 'text' => 'No appointment or GP referral required' ],
		],
		'cs_steps' => [
			[ 'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop', 'title' => 'Book or Walk In', 'body' => 'Book a 10-minute consultation online or by phone, or simply walk in to your nearest branch. Same-day appointments are usually available.' ],
			[ 'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=400&fit=crop', 'title' => 'Private Consultation', 'body' => 'Our pharmacist discusses your health, lifestyle and preferences in a confidential room, then recommends the most suitable option for you.' ],
			[ 'image' => 'https://images.unsplash.com/photo-1559757175-08e3a05cd4e2?w=600&h=400&fit=crop', 'title' => 'Supply &amp; Ongoing Support', 'body' => 'You leave with your chosen contraception and a plan for follow-up &mdash; so any questions or side effects are always covered.' ],
		],
		'cs_faqs' => [
			[ 'title' => 'Is the NHS contraception service free?', 'body' => 'Yes. Our NHS contraception service is provided free of charge to eligible patients. There is no charge for the consultation or for the contraceptive pill supplied through the NHS service. Our pharmacist will confirm your eligibility during your appointment.' ],
			[ 'title' => 'Do I need an appointment or can I walk in?', 'body' => 'Both. Walk-ins are welcome at all four branches, and you can also book ahead online or by phone to guarantee a slot at a time that suits you. For emergency contraception we always recommend contacting us as early as possible.' ],
			[ 'title' => 'What is emergency contraception and how quickly should I take it?', 'body' => 'Emergency contraception (the &ldquo;morning-after pill&rdquo;) can be used after unprotected sex or if your usual contraception may have failed. It is most effective the sooner it is taken &mdash; ideally within 72 hours, though some options work up to 120 hours. Speak to our pharmacist as soon as possible.' ],
			[ 'title' => 'Can I start the contraceptive pill without seeing my GP?', 'body' => 'In most cases, yes. Our trained pharmacists can assess your suitability and supply the oral contraceptive pill directly through the NHS service, saving you a trip to the GP. We&rsquo;ll take a short medical history and blood pressure check to make sure your chosen method is safe for you.' ],
			[ 'title' => 'Is the consultation private and confidential?', 'body' => 'Absolutely. All consultations take place in a private consulting room and everything you discuss is kept strictly confidential. Our team is here to support you without judgment.' ],
			[ 'title' => 'Which contraceptive methods can the pharmacy help with?', 'body' => 'We provide the combined and progesterone-only oral contraceptive pills, emergency contraception, and expert advice on the full range of methods available &mdash; so you can make an informed choice. If a method we don&rsquo;t supply directly is right for you, we&rsquo;ll guide you on the best next step.' ],
		],
		'cs_pills' => [
			[ 'text' => 'GPhC Registered' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => '100% Confidential' ], [ 'text' => 'Free NHS Service' ], [ 'text' => 'Same-Day Appointments' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( cs_repeater_defaults() ) as $f ) {
		add_filter( "acf/load_value/name={$f}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) return $value;
			$d = cs_repeater_defaults();
			return $d[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
