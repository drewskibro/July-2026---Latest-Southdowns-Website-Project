<?php
/**
 * Template Name: Kenya Travel Vaccinations
 *
 * Thin wrapper — all layout lives in template-parts/travel-destination.php;
 * copy comes from tv_data() ('kenya' entry) with ACF overrides.
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$tv_tpl = [
	'hero_image'     => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'       => 'Kenya savannah at sunset',
	'spotlight_alt'  => 'Kenya savannah landscape',
	'embed_calendar' => false,
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
