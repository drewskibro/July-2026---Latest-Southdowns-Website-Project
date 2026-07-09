<?php
/**
 * ACF Local Field Group — About Us Page
 *
 * Applies to: page-templates/page-about-us.php
 * All text fields are pre-filled with the current content (default_value).
 * Images are upload fields; until one is uploaded the template shows the
 * existing photo. Awards are managed globally (Pharmacy Settings → Awards).
 */

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'                   => 'group_about_page',
		'title'                 => 'About Us — Page Content',
		'position'              => 'acf_after_title',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'hide_on_screen'        => [ 'the_content' ],
		'location'              => [
			[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-about-us.php' ] ],
		],
		'fields' => [

			// ── Hero ──
			[ 'key' => 'field_ab_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_ab_hero_eyebrow', 'label' => 'Eyebrow', 'name' => 'ab_hero_eyebrow', 'type' => 'text', 'default_value' => 'Our Story' ],
			[ 'key' => 'field_ab_hero_heading', 'label' => 'Heading', 'name' => 'ab_hero_heading', 'type' => 'text', 'default_value' => 'Nationally Award-Winning Community Pharmacy' ],
			[ 'key' => 'field_ab_hero_intro', 'label' => 'Intro', 'name' => 'ab_hero_intro', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Proudly serving Hampshire communities across Emsworth, Havant and Rowlands Castle since 2009. Four branches, one commitment — exceptional care for every patient.' ],
			[ 'key' => 'field_ab_hero_btn1_label', 'label' => 'Primary Button Label', 'name' => 'ab_hero_btn1_label', 'type' => 'text', 'default_value' => 'Book an Appointment' ],
			[ 'key' => 'field_ab_hero_btn2_label', 'label' => 'Secondary Button Label', 'name' => 'ab_hero_btn2_label', 'type' => 'text', 'default_value' => 'All Services' ],
			[ 'key' => 'field_ab_hero_btn2_url', 'label' => 'Secondary Button Link', 'name' => 'ab_hero_btn2_url', 'type' => 'url', 'instructions' => 'Leave blank to link to /services/.' ],

			// ── Who We Are ──
			[ 'key' => 'field_ab_tab_who', 'label' => 'Who We Are', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_ab_who_eyebrow', 'label' => 'Eyebrow', 'name' => 'ab_who_eyebrow', 'type' => 'text', 'default_value' => 'Who We Are' ],
			[ 'key' => 'field_ab_who_heading', 'label' => 'Heading', 'name' => 'ab_who_heading', 'type' => 'text', 'default_value' => 'Your Local, Independent, Award-Winning Community Pharmacy' ],
			[
				'key' => 'field_ab_who_body', 'label' => 'Body Text', 'name' => 'ab_who_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
				'default_value' => '<p>Welcome to Southdowns Pharmacy Group – an independent, forward-thinking community pharmacy serving <strong>Emsworth, Havant and Rowlands Castle</strong>.</p><p>As a proudly independent pharmacy group, we have the freedom to invest in what matters most: our patients, our people and our local communities. Every decision we make is driven by a commitment to improving access to healthcare, delivering exceptional service and creating healthier communities.</p><p>We believe community pharmacy is about far more than dispensing medicines. Our experienced and approachable team provides expert clinical advice, preventative healthcare and a growing range of NHS and private services, helping people receive the care they need quickly, conveniently and close to home.</p><p>Our continued investment in innovative healthcare services, modern facilities and highly trained teams has established Southdowns Pharmacy Group as a multiple national award-winning pharmacy group, recognised for excellence in patient care, innovation and community impact. From NHS Pharmacy First consultations and vaccinations to weight management, travel health, ear wax removal and everyday healthcare advice, we are continually expanding our services to meet the changing needs of our communities.</p><p>At the heart of everything we do is a simple philosophy: patients come first. We take the time to listen, provide personalised care and build trusted relationships, ensuring every person who walks through our doors receives professional, compassionate and accessible healthcare.</p><p>Whether you are visiting us for expert advice, a prescription or one of our many clinical services, you can be confident that our team is committed to delivering the highest standards of care and making a positive difference to the health and wellbeing of the communities we proudly serve.</p><p><strong>Independent. Innovative. Community Focused. Committed to Better Healthcare.</strong></p>',
			],

			// ── Awards heading (cards = Pharmacy Settings → Awards) ──
			[ 'key' => 'field_ab_tab_awards', 'label' => 'Awards', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_ab_awards_eyebrow', 'label' => 'Eyebrow', 'name' => 'ab_awards_eyebrow', 'type' => 'text', 'default_value' => 'Recognised for Excellence' ],
			[ 'key' => 'field_ab_awards_heading', 'label' => 'Heading', 'name' => 'ab_awards_heading', 'type' => 'text', 'default_value' => 'Nationally Award-Winning Pharmacy Group', 'instructions' => 'The award cards themselves are edited globally under Pharmacy Settings → Awards.' ],

			// ── Meet The Teams ──
			[ 'key' => 'field_ab_tab_teams', 'label' => 'Meet The Teams', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_ab_teams_eyebrow', 'label' => 'Eyebrow', 'name' => 'ab_teams_eyebrow', 'type' => 'text', 'default_value' => 'Our People' ],
			[ 'key' => 'field_ab_teams_heading', 'label' => 'Heading', 'name' => 'ab_teams_heading', 'type' => 'text', 'default_value' => 'Meet The Teams' ],
			[ 'key' => 'field_ab_teams_intro', 'label' => 'Intro', 'name' => 'ab_teams_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Our experienced, hard-working teams are passionate about serving the communities across our Hampshire branches.' ],
			[ 'key' => 'field_ab_team_hero_image', 'label' => 'Team Hero Photo', 'name' => 'ab_team_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_ab_team_hero_alt', 'label' => 'Team Hero Alt Text', 'name' => 'ab_team_hero_alt', 'type' => 'text', 'default_value' => 'The Southdowns Pharmacy Group team outside Rowlands Castle Pharmacy on opening day' ],
			[ 'key' => 'field_ab_g1_image', 'label' => 'Gallery 1 — Photo', 'name' => 'ab_g1_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
			[ 'key' => 'field_ab_g1_caption', 'label' => 'Gallery 1 — Caption', 'name' => 'ab_g1_caption', 'type' => 'text', 'default_value' => 'Emsworth Pharmacy' ],
			[ 'key' => 'field_ab_g2_image', 'label' => 'Gallery 2 — Photo', 'name' => 'ab_g2_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
			[ 'key' => 'field_ab_g2_caption', 'label' => 'Gallery 2 — Caption', 'name' => 'ab_g2_caption', 'type' => 'text', 'default_value' => 'Bosmere Pharmacy, Havant' ],
			[ 'key' => 'field_ab_g3_image', 'label' => 'Gallery 3 — Photo', 'name' => 'ab_g3_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
			[ 'key' => 'field_ab_g3_caption', 'label' => 'Gallery 3 — Caption', 'name' => 'ab_g3_caption', 'type' => 'text', 'default_value' => 'Caring for our community' ],
			[
				'key' => 'field_ab_teams_body', 'label' => 'Teams Body Text', 'name' => 'ab_teams_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
				'default_value' => '<p>Southdowns Pharmacy Group is uniquely patient-focused. All of our staff continuously work hard to maintain and promote a high-quality customer and healthcare service that is accessible to all individuals.</p><p>We take pride in our local ownership and prioritise offering you and your family friendly, first-class pharmacy services. As a locally run pharmacy group, we have developed a true love for our patients and the people in our community.</p>',
			],
			[ 'key' => 'field_ab_teams_btn_label', 'label' => 'Button Label', 'name' => 'ab_teams_btn_label', 'type' => 'text', 'default_value' => 'Book an Appointment' ],

			// ── Locations ──
			[ 'key' => 'field_ab_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_ab_loc_eyebrow', 'label' => 'Eyebrow', 'name' => 'ab_loc_eyebrow', 'type' => 'text', 'default_value' => 'Our Pharmacies' ],
			[ 'key' => 'field_ab_loc_heading', 'label' => 'Heading', 'name' => 'ab_loc_heading', 'type' => 'text', 'default_value' => 'Find Your Nearest Branch' ],
			[ 'key' => 'field_ab_loc_intro', 'label' => 'Intro', 'name' => 'ab_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Four Hampshire locations — always close to you.' ],

			// ── Closing CTA ──
			[ 'key' => 'field_ab_tab_cta', 'label' => 'Closing CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_ab_cta_eyebrow', 'label' => 'Eyebrow', 'name' => 'ab_cta_eyebrow', 'type' => 'text', 'default_value' => 'Four Hampshire Branches' ],
			[ 'key' => 'field_ab_cta_heading', 'label' => 'Heading', 'name' => 'ab_cta_heading', 'type' => 'text', 'default_value' => 'Visit Us Today' ],
			[ 'key' => 'field_ab_cta_intro', 'label' => 'Intro', 'name' => 'ab_cta_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Reliable healthcare advice and support across four Hampshire branches. We’re always close to you and ready to help.' ],
			[ 'key' => 'field_ab_cta_btn_label', 'label' => 'Button Label', 'name' => 'ab_cta_btn_label', 'type' => 'text', 'default_value' => 'Book an Appointment' ],
		],
	] );

} );
