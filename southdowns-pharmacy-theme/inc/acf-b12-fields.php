<?php
/**
 * ACF Local Field Group — B12 Injections Page
 * Applies to: page-templates/page-b12-injections.php
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key' => 'group_b12_page', 'title' => 'B12 Injections — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top', 'hide_on_screen' => [ 'the_content' ],
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-b12-injections.php' ] ] ],
		'fields' => [
			[ 'key' => 'field_b12_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_hero_image', 'label' => 'Hero Image', 'name' => 'b12_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_b12_hero_badge', 'label' => 'Badge', 'name' => 'b12_hero_badge', 'type' => 'text', 'default_value' => 'Boost Your Energy &middot; Same-Day Appointments' ],
			[ 'key' => 'field_b12_hero_headline', 'label' => 'Headline', 'name' => 'b12_hero_headline', 'type' => 'text', 'default_value' => 'Recharge with a Vitamin B12 Injection' ],
			[ 'key' => 'field_b12_hero_body', 'label' => 'Body', 'name' => 'b12_hero_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Feeling tired, run down or low on energy? Our trained pharmacists deliver safe, effective Vitamin B12 injections to help you feel like yourself again &mdash; available across Emsworth, Havant, Leigh Park and Rowlands Castle.' ],

			[ 'key' => 'field_b12_tab_stats', 'label' => 'Stats', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_stats', 'label' => 'Stats', 'name' => 'b12_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat', 'sub_fields' => [
				[ 'key' => 'field_b12_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
				[ 'key' => 'field_b12_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				[ 'key' => 'field_b12_stat_caption', 'label' => 'Caption', 'name' => 'caption', 'type' => 'text' ],
			] ],

			[ 'key' => 'field_b12_tab_intro', 'label' => 'Intro', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_intro_eyebrow', 'label' => 'Eyebrow', 'name' => 'b12_intro_eyebrow', 'type' => 'text', 'default_value' => 'What Is It?' ],
			[ 'key' => 'field_b12_intro_heading', 'label' => 'Heading', 'name' => 'b12_intro_heading', 'type' => 'text', 'default_value' => 'A Simple Boost for Body &amp; Mind' ],
			[ 'key' => 'field_b12_intro_body', 'label' => 'Body', 'name' => 'b12_intro_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0, 'default_value' => '<p>Vitamin B12 is essential for energy, a healthy nervous system and the production of red blood cells. When your levels run low, it can leave you feeling drained, foggy and run down &mdash; and food or tablets alone aren&rsquo;t always enough.</p><p>At Southdowns Pharmacy Group, our trained pharmacists use the latest equipment to deliver safe, effective <strong>B12 injections</strong> that go straight into the bloodstream &mdash; bypassing the digestive system for maximum absorption.</p><p>Whether you have a diagnosed deficiency or simply want to top up your energy, we&rsquo;ll help you find the right plan for you &mdash; with no GP referral and same-day appointments usually available.</p>' ],
			[ 'key' => 'field_b12_intro_image', 'label' => 'Intro Image', 'name' => 'b12_intro_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_b12_intro_btn', 'label' => 'Button Label', 'name' => 'b12_intro_btn', 'type' => 'text', 'default_value' => 'Book Your B12 Injection' ],

			[ 'key' => 'field_b12_tab_ben', 'label' => 'Benefits', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_ben_eyebrow', 'label' => 'Eyebrow', 'name' => 'b12_ben_eyebrow', 'type' => 'text', 'default_value' => 'The Benefits' ],
			[ 'key' => 'field_b12_ben_heading', 'label' => 'Heading', 'name' => 'b12_ben_heading', 'type' => 'text', 'default_value' => 'Why People Choose B12 Injections' ],
			[ 'key' => 'field_b12_ben_intro', 'label' => 'Intro', 'name' => 'b12_ben_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'From renewed energy to a healthier nervous system, a B12 injection can help you feel sharper, brighter and more like yourself again.' ],
			[ 'key' => 'field_b12_benefits', 'label' => 'Benefit Cards', 'name' => 'b12_benefits', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card', 'instructions' => 'Icons stay fixed by position.', 'sub_fields' => [
				[ 'key' => 'field_b12_ben_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_b12_ben_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
			] ],

			[ 'key' => 'field_b12_tab_sym', 'label' => 'Symptoms', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_sym_eyebrow', 'label' => 'Eyebrow', 'name' => 'b12_sym_eyebrow', 'type' => 'text', 'default_value' => 'Could You Be Deficient?' ],
			[ 'key' => 'field_b12_sym_heading', 'label' => 'Heading', 'name' => 'b12_sym_heading', 'type' => 'text', 'default_value' => 'Signs of a B12 Deficiency' ],
			[ 'key' => 'field_b12_sym_intro', 'label' => 'Intro', 'name' => 'b12_sym_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'A deficiency in vitamin B12 or folate can cause a range of problems. Tap each symptom below to learn more &mdash; some can occur even without anaemia.' ],
			[ 'key' => 'field_b12_symptoms', 'label' => 'Symptoms (accordion)', 'name' => 'b12_symptoms', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Symptom', 'sub_fields' => [
				[ 'key' => 'field_b12_sym_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_b12_sym_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],
			[ 'key' => 'field_b12_sym_note', 'label' => 'Note Box', 'name' => 'b12_sym_note', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Recognise some of these symptoms? You&rsquo;re not alone &mdash; B12 deficiency is common and easily treated. Our pharmacists can talk through your symptoms and help you decide if a B12 injection is right for you.' ],

			[ 'key' => 'field_b12_tab_hiw', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_hiw_offer', 'label' => 'Card Label', 'name' => 'b12_hiw_offer', 'type' => 'text', 'default_value' => 'How It Works' ],
			[ 'key' => 'field_b12_hiw_heading', 'label' => 'Card Heading', 'name' => 'b12_hiw_heading', 'type' => 'text', 'default_value' => 'Straight to Your Bloodstream' ],
			[ 'key' => 'field_b12_hiw_body', 'label' => 'Card Body', 'name' => 'b12_hiw_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'B12 injections deliver a high dose of vitamin B12 directly into the bloodstream, bypassing the digestive system. This ensures your body absorbs the maximum amount for the best possible benefit.' ],
			[ 'key' => 'field_b12_hiw_points', 'label' => 'Card Points', 'name' => 'b12_hiw_points', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Point', 'sub_fields' => [ [ 'key' => 'field_b12_hiw_point_text', 'label' => 'Point', 'name' => 'text', 'type' => 'text' ] ] ],
			[ 'key' => 'field_b12_hiw_btn', 'label' => 'Card Button', 'name' => 'b12_hiw_btn', 'type' => 'text', 'default_value' => 'Book Your B12 Injection' ],
			[ 'key' => 'field_b12_hiw_r_eyebrow', 'label' => 'Right Eyebrow', 'name' => 'b12_hiw_r_eyebrow', 'type' => 'text', 'default_value' => 'Is It Right for Me?' ],
			[ 'key' => 'field_b12_hiw_r_heading', 'label' => 'Right Heading', 'name' => 'b12_hiw_r_heading', 'type' => 'text', 'default_value' => 'Could a B12 Injection Help You?' ],
			[ 'key' => 'field_b12_hiw_r_body', 'label' => 'Right Body', 'name' => 'b12_hiw_r_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0, 'default_value' => '<p>B12 injections are usually recommended for people with a B12 deficiency, or a medical condition that affects how well B12 is absorbed from food. If you&rsquo;re feeling tired, run down, or have a diagnosed deficiency, an injection may be right for you.</p><p>Our knowledgeable pharmacists will work with you to determine the best treatment plan for your individual needs &mdash; available across <strong>Emsworth, Havant, Leigh Park and Rowlands Castle</strong>.</p>' ],

			[ 'key' => 'field_b12_tab_steps', 'label' => 'Steps', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_steps_eyebrow', 'label' => 'Eyebrow', 'name' => 'b12_steps_eyebrow', 'type' => 'text', 'default_value' => 'Simple &amp; Quick' ],
			[ 'key' => 'field_b12_steps_heading', 'label' => 'Heading', 'name' => 'b12_steps_heading', 'type' => 'text', 'default_value' => 'Getting Your B12 Injection' ],
			[ 'key' => 'field_b12_steps_intro', 'label' => 'Intro', 'name' => 'b12_steps_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'From booking to boosted in three simple steps &mdash; no GP, no long waits.' ],
			[ 'key' => 'field_b12_steps', 'label' => 'Steps', 'name' => 'b12_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'sub_fields' => [
				[ 'key' => 'field_b12_step_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
				[ 'key' => 'field_b12_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_b12_step_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],

			[ 'key' => 'field_b12_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_loc_heading', 'label' => 'Heading', 'name' => 'b12_loc_heading', 'type' => 'text', 'default_value' => 'Find Your Nearest Branch' ],
			[ 'key' => 'field_b12_loc_intro', 'label' => 'Intro', 'name' => 'b12_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four Southdowns Pharmacy locations offer B12 injections. Choose your nearest branch below to see opening hours, contact details and how to find us.' ],
			[ 'key' => 'field_b12_loc_note_h', 'label' => 'Note Heading', 'name' => 'b12_loc_note_h', 'type' => 'text', 'default_value' => 'Not sure which branch to visit?' ],
			[ 'key' => 'field_b12_loc_note_b', 'label' => 'Note Body', 'name' => 'b12_loc_note_b', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Every one of our four pharmacies offers B12 injections. Choose the location nearest to you above to view its details, or contact us and we&rsquo;ll happily point you to the right branch.' ],

			[ 'key' => 'field_b12_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_b12_cta_eyebrow', 'label' => 'Eyebrow', 'name' => 'b12_cta_eyebrow', 'type' => 'text', 'default_value' => 'Same-Day Appointments Available' ],
			[ 'key' => 'field_b12_cta_heading', 'label' => 'Heading (HTML)', 'name' => 'b12_cta_heading', 'type' => 'text', 'default_value' => 'Book Your B12<br/>Injection Today' ],
			[ 'key' => 'field_b12_cta_body', 'label' => 'Body', 'name' => 'b12_cta_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Start feeling your best. Book your B12 injection at any Southdowns Pharmacy &mdash; quick, safe and convenient care from Hampshire&rsquo;s trusted pharmacy group.' ],
			[ 'key' => 'field_b12_pills', 'label' => 'Badge Pills', 'name' => 'b12_pills', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Pill', 'sub_fields' => [ [ 'key' => 'field_b12_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			[ 'key' => 'field_b12_disclaimer', 'label' => 'Disclaimer', 'name' => 'b12_disclaimer', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => '<strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. If you are experiencing symptoms of a B12 or folate deficiency, please consult a qualified healthcare professional about your individual circumstances. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ],
		],
	] );
} );

function b12_repeater_defaults(): array {
	return [
		'b12_stats' => [
			[ 'value' => 'Same Day', 'label' => 'Appointments', 'caption' => 'No GP referral needed' ],
			[ 'value' => '10 Min', 'label' => 'Quick Appointment', 'caption' => 'In and out in minutes' ],
			[ 'value' => 'Expert', 'label' => 'Trained Pharmacists', 'caption' => 'Safe, professional care' ],
			[ 'value' => '4', 'label' => 'Hampshire Locations', 'caption' => 'Book at your nearest branch' ],
		],
		'b12_benefits' => [
			[ 'title' => 'Boosts Energy Levels', 'body' => 'Replenish depleted B12 stores and shake off that constant feeling of fatigue and sluggishness.' ],
			[ 'title' => 'Supports Your Nervous System', 'body' => 'Vitamin B12 plays a key role in keeping nerves healthy and your brain functioning at its best.' ],
			[ 'title' => 'Healthy Skin, Hair &amp; Nails', 'body' => 'B12 contributes to cell production, helping to promote glowing skin and stronger hair and nails.' ],
			[ 'title' => 'Reduces Stress &amp; Anxiety', 'body' => 'By supporting your nervous system, B12 can help ease feelings of stress, low mood and anxiety.' ],
			[ 'title' => 'Maximum Absorption', 'body' => 'Delivered straight into the bloodstream, injections bypass the gut for far better uptake than tablets.' ],
			[ 'title' => 'Supports Overall Wellbeing', 'body' => 'Feel sharper, brighter and more like yourself &mdash; a simple boost for body and mind.' ],
		],
		'b12_symptoms' => [
			[ 'title' => 'Extreme tiredness &amp; lack of energy', 'body' => 'Persistent fatigue and low energy are among the most common signs of a B12 or folate deficiency. If you feel exhausted no matter how much you rest, your B12 levels may be to blame.' ],
			[ 'title' => 'Pins and needles', 'body' => 'A tingling, &ldquo;pins and needles&rdquo; sensation in the hands and feet can occur when low B12 affects the health of your nerves.' ],
			[ 'title' => 'A sore, red tongue &amp; mouth ulcers', 'body' => 'A smooth, sore or unusually red tongue (glossitis) and recurrent mouth ulcers can both be linked to a deficiency in vitamin B12 or folate.' ],
			[ 'title' => 'Muscle weakness', 'body' => 'Low B12 can leave your muscles feeling weak and your body generally run down, making everyday tasks feel harder than they should.' ],
			[ 'title' => 'Problems with your vision', 'body' => 'In some cases a B12 deficiency can affect the optic nerve, leading to disturbances or changes in vision.' ],
			[ 'title' => 'Psychological changes', 'body' => 'A deficiency can affect mood and mental health, ranging from mild depression or anxiety through to confusion and, in severe long-term cases, dementia.' ],
			[ 'title' => 'Problems with memory &amp; thinking', 'body' => 'Difficulties with memory, understanding and judgement can all be associated with low levels of vitamin B12.' ],
		],
		'b12_hiw_points' => [
			[ 'text' => 'Maximum absorption &mdash; no gut barrier' ], [ 'text' => 'Administered by a trained pharmacist' ], [ 'text' => 'Same-day &amp; walk-in appointments' ], [ 'text' => 'Safe, quick and virtually painless' ],
		],
		'b12_steps' => [
			[ 'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop', 'title' => 'Book Your Appointment', 'body' => 'Book online or call your nearest branch. Same-day appointments are usually available &mdash; no GP referral needed.' ],
			[ 'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop', 'title' => 'Quick Health Check', 'body' => 'Our pharmacist talks through your symptoms and history to make sure a B12 injection is the right choice for you.' ],
			[ 'image' => 'https://images.unsplash.com/photo-1612277795421-9bc7706a4a34?w=600&h=400&fit=crop', 'title' => 'Your Injection, Done', 'body' => 'Your B12 injection is administered safely by a trained pharmacist &mdash; you&rsquo;re done in minutes and back to your day.' ],
		],
		'b12_pills' => [
			[ 'text' => 'GPhC Registered' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => 'Energy Boosting' ], [ 'text' => 'Expert Pharmacists' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( b12_repeater_defaults() ) as $f ) {
		add_filter( "acf/load_value/name={$f}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) return $value;
			$d = b12_repeater_defaults();
			return $d[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
