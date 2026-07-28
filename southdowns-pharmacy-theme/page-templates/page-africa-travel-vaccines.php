<?php
/**
 * Template Name: Africa Travel Vaccinations
 *
 * Thin wrapper — all layout lives in template-parts/travel-destination.php;
 * copy comes from tv_data() ('africa' entry) with ACF overrides.
 *
 * DRAFT: clinical content pending pharmacist sign-off (Nemesh Patel, GPhC 2061623).
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$tv_tpl = [
	'hero_image'     => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'       => 'African savannah at sunset',
	'spotlight_alt'  => 'Safari wildlife on the African savannah',
	'embed_calendar' => true, // on-page Amelia travel calendar (#book)
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
