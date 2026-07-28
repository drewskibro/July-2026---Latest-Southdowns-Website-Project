<?php
/**
 * Template Name: India Travel Vaccinations
 *
 * Thin wrapper — all layout lives in template-parts/travel-destination.php;
 * copy comes from tv_data() ('india' entry) with ACF overrides.
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$tv_tpl = [
	'hero_image'     => 'https://images.unsplash.com/photo-1564507592333-c60657eea523?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'       => 'Taj Mahal at sunrise in India',
	'spotlight_alt'  => 'Taj Mahal, India',
	'embed_calendar' => false,
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
