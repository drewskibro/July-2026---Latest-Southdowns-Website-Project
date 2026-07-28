<?php
/**
 * Template Name: Cape Verde Travel Vaccinations
 *
 * Thin wrapper — all layout lives in template-parts/travel-destination.php;
 * copy comes from tv_data() ('cape-verde' entry) with ACF overrides.
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$tv_tpl = [
	'hero_image'     => 'https://images.unsplash.com/photo-1528181304800-259b08848526?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'       => 'Cape Verde coastline',
	'spotlight_alt'  => 'Cape Verde coastline',
	'embed_calendar' => false,
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
