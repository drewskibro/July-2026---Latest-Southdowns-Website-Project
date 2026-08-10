<?php
/**
 * Template Name: Australasia & Pacific Travel Vaccinations
 *
 * Thin wrapper — all layout lives in template-parts/travel-destination.php;
 * copy comes from tv_data() ('australasia' entry) with ACF overrides.
 *
 * PHARMACIST sign-off pending. Research verified 2026-08-06 against
 * NaTHNaC/TravelHealthPro, the Australian Immunisation Handbook, NSW Health
 * and Health New Zealand. Re-check the Japanese Encephalitis and malaria
 * positions at publish time — both shift with outbreaks and season — and
 * confirm the Solomon Islands malaria position (hedged in the copy).
 *
 * Region-specific framing (do NOT align these with other region pages):
 *   · Yellow Fever is an ENTRY-CERTIFICATE matter only, not a health risk.
 *     Australia requires a certificate; New Zealand does not.
 *   · No malaria in Australia or New Zealand.
 *   · Japanese Encephalitis has a narrow threshold — short trips don't warrant it.
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$tv_tpl = [
	// Placeholder Unsplash imagery — swap for self-hosted, on-brand photography
	// via the Hero Image / Intro Spotlight Image fields in WP admin.
	'hero_image'      => 'https://images.unsplash.com/photo-1507699622108-4be3abd695ad?w=1200&q=80&auto=format&fit=crop',
	'hero_alt'        => 'New Zealand mountain and coastal landscape',
	'spotlight_image' => 'https://images.unsplash.com/photo-1589330273594-fade1ee91647?w=1000&q=80&auto=format&fit=crop',
	'spotlight_alt'   => 'Pacific island lagoon and palm trees',
	'embed_calendar'  => true, // on-page Amelia travel calendar (#book)

	// Yellow Fever takes the feature band, but framed as an ENTRY REQUIREMENT
	// rather than a regional health risk (there is no YF in this region).
	// Wording is deliberate: a certificate "avoids delays at the border" —
	// travellers without one are referred to a biosecurity officer, NOT refused
	// entry. Do not strengthen this claim.
	'feature_band'    => [
		'theme'    => 'yellow',
		'eyebrow'  => 'Entry Requirement &middot; NaTHNaC-Registered Centre',
		'headline' => 'Yellow Fever Certificates for Travel to Australia.',
		'accent'   => 'Check Your Route.',
		'body'     => 'There is no yellow fever in Australia, New Zealand or the Pacific &mdash; this is purely an entry requirement. Australia requires a certificate if, in the six days before arriving, you have stayed overnight in a country with yellow fever risk or transited one for more than 12 hours, which commonly catches routings via Africa or South America. Your certificate becomes valid <strong class="text-slate-900">10 days after vaccination</strong>, so plan ahead. New Zealand does not currently require proof.',
		'points'   => [ 'Required by Australia — not New Zealand', 'Avoids delays at the border', 'ICVP certificates at Bosmere, Havant' ],
		'cta'      => 'Book Yellow Fever at Bosmere',
		'cta_url'  => home_url( '/yellow-fever/#book' ),
	],

	// No country pages exist for this region yet — add Australia / New Zealand /
	// Fiji cards here once those clusters are built. (Bali/Indonesia belongs to
	// South-East Asia, not this region — do not add it here.)
	'related'         => [],

	// Real client-confirmed per-vaccine prices are shown; package cards are
	// hidden because package prices have not been confirmed.
	'show_pricing'    => true,
	'show_packages'   => false,
];

include locate_template( 'template-parts/travel-destination.php' );

get_footer();
