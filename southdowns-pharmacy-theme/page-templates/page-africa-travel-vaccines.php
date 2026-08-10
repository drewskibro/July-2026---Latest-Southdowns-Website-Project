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
	'hero_image'      => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'        => 'African savannah at sunset',
	// Distinct from the hero so the page doesn't repeat one photo (asset already used on the home-page region grid).
	'spotlight_image' => 'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Africa.webp',
	'spotlight_alt'   => 'Safari wildlife on the African savannah',
	'embed_calendar'  => true, // on-page Amelia travel calendar (#book)
	// Full-width Yellow Fever / Bosmere band after the vaccines section.
	'feature_band'    => [
		'theme'    => 'yellow',
		'eyebrow'  => 'NaTHNaC-Registered Yellow Fever Centre',
		'headline' => 'Need a Yellow Fever Certificate?',
		'accent'   => 'Bosmere Pharmacy, Havant.',
		'body'     => 'Many African countries require proof of Yellow Fever vaccination for entry. Our Bosmere branch is an officially designated Yellow Fever Vaccination Centre issuing valid ICVP certificates &mdash; and your certificate only becomes valid <strong class="text-slate-900">10 days after vaccination</strong>, so book early.',
		'points'   => [ 'ICVP certificates issued on-site', 'Lifetime validity — one dose', 'Bosmere Pharmacy, Havant only' ],
		'cta'      => 'Book Yellow Fever at Bosmere',
		'cta_url'  => home_url( '/yellow-fever/#book' ),
	],
	// Pricing hidden until confirmed Africa prices are available (all £TBC otherwise).
	'show_pricing'    => false,
	// "Popular African destinations" image cards (region page -> country pages).
	'related'         => [
		[ 'name' => 'Kenya', 'desc' => 'Safari trips, Yellow Fever & malaria advice', 'url' => '/kenya-travel-vaccinations/', 'img' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&q=80&auto=format&fit=crop' ],
		[ 'name' => 'Cape Verde', 'desc' => 'Beach holidays — Hep A, Typhoid & more', 'url' => '/cape-verde-travel-vaccinations/', 'img' => 'https://images.unsplash.com/photo-1528181304800-259b08848526?w=800&q=80&auto=format&fit=crop' ],
	],
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
