<?php
/**
 * Template Name: Caribbean Travel Vaccinations
 *
 * Thin wrapper — all layout lives in template-parts/travel-destination.php;
 * copy comes from tv_data() ('caribbean' entry) with ACF overrides.
 *
 * PHARMACIST sign-off pending: verify all clinical content, and specifically
 * the malaria and yellow fever positions, against current NaTHNaC /
 * TravelHealthPro country pages before publish.
 *
 * Clinical note: unlike Africa, malaria is NOT a general Caribbean risk and
 * Yellow Fever is NOT generally required — dengue is the headline concern,
 * hence the teal dengue feature band rather than a Yellow Fever one.
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$tv_tpl = [
	// Placeholder Unsplash hero (Caribbean beach) — swap for a self-hosted,
	// on-brand image via the Hero Image field in WP admin when available.
	'hero_image'      => 'https://images.unsplash.com/photo-1580541832626-2a7131ee809f?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'        => 'Turquoise Caribbean sea and palm-fringed beach',
	'spotlight_image' => 'https://images.unsplash.com/photo-1548574505-5e239809ee19?w=1000&q=80&auto=format&fit=crop',
	'spotlight_alt'   => 'Caribbean coastline and palm trees',
	'embed_calendar'  => true, // on-page Amelia travel calendar (#book)

	// Dengue is the standout Caribbean-relevant offer, so it takes the feature
	// band slot (Africa uses the same band for Yellow Fever).
	'feature_band'    => [
		'theme'    => 'teal',
		'eyebrow'  => 'Dengue Vaccine Available &middot; Qdenga',
		'headline' => 'Dengue Is the Main Mosquito-Borne Risk.',
		'accent'   => 'We Stock the Vaccine.',
		'body'     => 'Dengue occurs across the Caribbean, with periodic outbreaks. We stock <strong class="text-slate-900">Qdenga</strong>, the dengue vaccine, and our pharmacists will advise whether it is appropriate for your trip alongside good bite-avoidance measures.',
		'points'   => [ 'Qdenga in stock — £96.00', 'Assessed against your itinerary', 'DEET repellents at all four branches' ],
		'cta'      => 'Book a Travel Consultation',
		'cta_url'  => '#book',
	],

	// No Caribbean country pages exist yet — add Jamaica / Dominican Republic /
	// Barbados / Cuba cards here once those clusters are built.
	'related'         => [],

	// Real client-confirmed per-vaccine prices are shown; package cards are
	// hidden because package prices have not been confirmed.
	'show_pricing'    => true,
	'show_packages'   => false,
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
