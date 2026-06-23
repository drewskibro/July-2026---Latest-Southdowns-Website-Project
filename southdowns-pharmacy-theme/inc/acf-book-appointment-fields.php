<?php
/**
 * ACF Local Field Group — Book Appointment Page (page-templates/page-book-appointment.php)
 * Light wiring: hero + locations heading only. The Amelia booking widget, the editor
 * content block (the_content), and the per-branch "how to get there" directions stay in code.
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key' => 'group_book_appointment', 'title' => 'Book Appointment — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top',
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-book-appointment.php' ] ] ],
		'fields' => [
			[ 'key' => 'field_ba_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'ba_hero_eyebrow', 'type' => 'text', 'default_value' => 'Book Online &middot; Same-Day Availability' ],
			[ 'key' => 'field_ba_hero_heading', 'label' => 'Hero Heading', 'name' => 'ba_hero_heading', 'type' => 'text', 'default_value' => 'Book Your Appointment' ],
			[ 'key' => 'field_ba_hero_intro', 'label' => 'Hero Intro', 'name' => 'ba_hero_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Choose your branch, service and time below. Most appointments are available the same or next day across our four Hampshire pharmacies.' ],
			[ 'key' => 'field_ba_loc_heading', 'label' => 'Locations Heading', 'name' => 'ba_loc_heading', 'type' => 'text', 'default_value' => 'Our Locations' ],
			[ 'key' => 'field_ba_loc_intro', 'label' => 'Locations Intro', 'name' => 'ba_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Find your nearest branch, with directions by car, bus and train.' ],
		],
	] );
} );
