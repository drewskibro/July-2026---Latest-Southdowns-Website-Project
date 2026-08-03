<?php
/**
 * Template Name: Meningitis B Vaccine (NHS)
 *
 * Free NHS MenB vaccine programme (2026 one-off offer) for eligible young
 * people. Strict NHS eligibility — the page leads with the eligibility
 * warning and routes each cohort to the correct channel:
 *   17–18 cohort -> NHS online booking (nhs.uk/book-menb)
 *   Uni/FE freshers -> walk in at a participating pharmacy (no GP reg needed)
 * No Amelia calendar is embedded: no MenB service ID exists in Amelia and
 * the pharmacy route is walk-in under NHS guidance.
 *
 * Suggested slug: /meningitis-b-vaccine/
 *
 * @package Southdowns_Pharmacy
 */

get_header();

$phone     = sp_phone();
$phone_raw = sp_phone_raw();

// Imagery (ACF-overridable; swap via Meningitis B — Page Content in WP admin).
$mb_hero_img      = sp_field( 'mb_hero_image', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=80&auto=format&fit=crop' );
$mb_hero_alt      = sp_field( 'mb_hero_image_alt', 'University students — free NHS MenB vaccine for young people' );
$mb_spotlight_img = sp_field( 'mb_spotlight_image', 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1000&q=80&auto=format&fit=crop' );
$mb_spotlight_alt = sp_field( 'mb_spotlight_image_alt', 'Students starting university in autumn 2026' );

// Roundel font stack (same pattern as the other service pages).
$mb_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
$mb_txt  = "font-family:{$mb_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";

/* Official NHS / public-health links (England + devolved nations). */
$mb_links = [
	'book'     => 'https://www.nhs.uk/book-menb',
	'pharmacy' => 'https://www.nhs.uk/nhs-services/vaccination-and-booking-services/find-a-pharmacy-that-offers-walkin-menb-vaccinations-for-young-people/',
	'scotland' => 'https://www.nhsinform.scot/healthy-living/immunisation/meningococcal-b-menb-vaccine-for-young-people/who-can-get-the-meningococcal-b-menb-vaccine-for-young-people',
	'wales'    => 'https://phw.nhs.wales/knowledge-article/menb-vaccine-for-young-people/',
	'ni'       => 'https://www.health-ni.gov.uk/news/health-minister-announces-men-b-vaccination-programme',
	'outbreak' => 'https://ukhsa.blog.gov.uk/2026/03/18/meningitis-b-outbreak-what-you-need-to-know/',
	'study'    => 'https://www.gov.uk/government/publications/meningococcal-b-vaccine-information-for-healthcare-professionals/meningococcal-b-vaccination-programme-for-infants-information-for-healthcare-practitioners',
	'symptoms' => 'https://www.gov.uk/government/publications/meningitis-signs-and-symptoms-poster/meningitis-dont-ignore-the-signs-and-symptoms',
];

/* FAQ — ACF repeater override with hardcoded fallback (source: NHS programme copy). */
$mb_faqs = [];
if ( function_exists( 'have_rows' ) && have_rows( 'mb_faq_items' ) ) {
	while ( have_rows( 'mb_faq_items' ) ) {
		the_row();
		$mb_faqs[] = [ 'q' => get_sub_field( 'question' ), 'a' => get_sub_field( 'answer' ) ];
	}
}
if ( empty( $mb_faqs ) ) {
	$mb_faqs = [
		[ 'q' => 'Who is eligible for the free MenB vaccine?',
		  'a' => 'In England: young people aged 17 or 18 born between 1 September 2007 and 31 August 2008 who are registered with a GP surgery in England; all undergraduate freshers born on or after 21 July 2001 attending university for the first time in autumn 2026; and those born on or after 21 July 2001 starting further education for the first time in autumn 2026 who will live in further education accommodation. This includes international students and those from the devolved nations and Crown Dependencies attending these settings in England.' ],
		[ 'q' => 'How many doses do I need?',
		  'a' => 'Two doses are essential for protection. The second dose is given at least 28 days after the first, and it then takes a further 2 weeks to build a good level of immunity — around 6 weeks from start to finish. That is why it is important to get your first dose as early as possible, ideally well before the autumn term begins.' ],
		[ 'q' => 'Do I need to be registered with a GP?',
		  'a' => 'If you are in the 17–18 cohort and booking online through the NHS, you must be registered with a GP surgery in England. If you are an eligible student using the walk-in pharmacy service, you do not need to be registered with a GP surgery.' ],
		[ 'q' => 'What are the side effects of the MenB vaccine?',
		  'a' => 'Common side effects are usually mild and short-lived: a fever, some swelling, redness or tenderness at the injection site, nausea, headache or muscle aches. These usually pass within a day or two, and over-the-counter pain relief such as paracetamol can help. More serious side effects are rare.' ],
		[ 'q' => 'How well does the MenB vaccine work?',
		  'a' => 'The MenB vaccine covers most, but not all, strains of MenB that commonly cause disease in the UK. It has been used routinely in the UK infant vaccination programme since 2015, and a study in babies showed a 75% reduction in MenB disease in vaccinated groups. It has been thoroughly tested and meets strict safety standards. It does not protect against all causes of meningitis and septicaemia, so it remains important to know the signs and symptoms and seek early medical help if you are concerned about someone\'s health.' ],
		[ 'q' => 'How long does protection last?',
		  'a' => 'Protection from the MenB vaccine lasts for at least 5 years. If you are in an eligible group but have completed a course of MenB vaccination in the past 5 years, you will not need further vaccination now.' ],
		[ 'q' => 'What if I\'m not eligible — can I get the MenB vaccine privately?',
		  'a' => 'Yes. For those not eligible under the current NHS offer, the MenB vaccine can be obtained privately from many travel clinics, pharmacies and some private GP practices. Speak to our team for advice.' ],
		[ 'q' => 'I live in Scotland, Wales or Northern Ireland — does this apply to me?',
		  'a' => 'The MenB programme is available across all four UK nations, but access arrangements differ. Please check the official guidance from Public Health Scotland, Public Health Wales or the Public Health Agency (Northern Ireland) for how to access the vaccine in your area.' ],
	];
}
?>

<!-- Page-scoped styles -->
<style>
  .mb-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .mb-reveal.visible { opacity: 1; transform: translateY(0); }
  @media (prefers-reduced-motion: reduce) { .mb-reveal { opacity: 1; transform: none; transition: none; } }

  .mb-card { transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
  .mb-card:hover { transform: translateY(-6px); box-shadow: 0 20px 45px rgba(30,58,138,0.12); border-color: #bfdbfe; }

  .mb-faq-item { border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s; background: #fff; }
  .mb-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); }
  .mb-faq-item[open] { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); }
  .mb-faq-question { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; font-weight: 600; font-size: 1.05rem; color: #1e293b; list-style: none; font-family: 'Jost', sans-serif; }
  .mb-faq-question::-webkit-details-marker { display: none; }
  .mb-faq-chevron { transition: transform 0.3s; flex-shrink: 0; margin-left: 1rem; }
  .mb-faq-item[open] .mb-faq-chevron { transform: rotate(180deg); }
  .mb-faq-answer { padding: 0 1.5rem 1.25rem; color: #4b5563; line-height: 1.7; font-family: 'Jost', sans-serif; font-size: 0.95rem; }
</style>

<!-- ============================================================
     S1: HERO — 2-column split + roundels
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $mb_hero_img ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      FREE NHS SERVICE &bull; 2026 PROGRAMME
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;">Free NHS <span class="serif-accent">Meningitis B</span> Vaccine</h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost">A one-off MenB vaccine programme for eligible young people, including students starting university or residential further education in autumn 2026.</p>
    <a href="#eligibility" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost self-start">
      Check Your Eligibility
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </a>
  </div>

  <!-- Desktop -->
  <div class="hidden md:flex relative">
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        FREE NHS SERVICE &bull; 2026 ONE-OFF PROGRAMME
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-6 font-jost" style="line-height:1.1;">Free NHS <span class="serif-accent">Meningitis B</span> Vaccine for Young People</h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost">A time-limited MenB vaccine offer for eligible young people &mdash; including those starting university or moving into residential further education for the first time in autumn 2026. Two doses, free on the NHS.</p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="#eligibility" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Check Your Eligibility
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </a>
        <a href="#how" class="inline-flex items-center gap-2 text-white text-base font-semibold border-2 border-white/50 px-6 py-3 rounded-full hover:bg-white/10 hover:border-white transition-colors font-jost">
          How to Get It
        </a>
      </div>
      <div class="flex flex-wrap gap-x-5 gap-y-2 text-white text-sm font-medium font-jost">
        <?php foreach ( [ 'Free on the NHS', '2 Doses &bull; 4 Weeks Apart', 'Walk-In for Eligible Students', 'GPhC Registered' ] as $mb_chip ) : ?>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php echo $mb_chip; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $mb_hero_img ); ?>');" role="img" aria-label="<?php echo esc_attr( $mb_hero_alt ); ?>"></div>

    <!-- Roundel 1 — FREE -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:12%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18);padding:0 10px;text-align:center;">
        <span style="<?php echo $mb_txt; ?>font-size:22px;font-weight:800;color:#1e3a8a;line-height:1;">FREE</span>
        <span style="<?php echo $mb_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;margin-top:2px;">NHS SERVICE</span>
        <span style="<?php echo $mb_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Eligible Groups Only</span>
      </div>
    </div>
    <!-- Roundel 2 — 2 DOSES -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="width:148px;height:148px;border-radius:50%;background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px rgba(29,78,216,0.5),0 0 0 6px rgba(255,255,255,0.5),0 8px 32px rgba(29,78,216,0.35);padding:0 10px;text-align:center;">
        <span style="<?php echo $mb_txt; ?>font-size:22px;font-weight:800;color:#fff;line-height:1;">2 DOSES</span>
        <span style="<?php echo $mb_txt; ?>font-size:12px;font-weight:700;color:#fff;line-height:1.2;margin-top:3px;">4+ WEEKS APART</span>
        <span style="<?php echo $mb_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.8);line-height:1.3;margin-top:3px;">From 20 July 2026</span>
      </div>
    </div>
    <!-- Roundel 3 — PROTECTION -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:12%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18);padding:0 10px;text-align:center;">
        <span style="<?php echo $mb_txt; ?>font-size:22px;font-weight:800;color:#1e3a8a;line-height:1;">5+ YRS</span>
        <span style="<?php echo $mb_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;margin-top:2px;">PROTECTION</span>
        <span style="<?php echo $mb_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Full course</span>
      </div>
    </div>
  </div>
</section>

<!-- Eligibility warning strip -->
<div class="bg-amber-50 border-y border-amber-200 py-4">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-start gap-3">
      <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <p class="text-amber-800 text-sm leading-relaxed font-jost"><strong>Eligibility Notice:</strong> This free NHS service is strictly for the eligible groups listed below, under NHS guidance. Please do not attend or book if you are not eligible &mdash; you will not be vaccinated. If you have completed a MenB course in the past 5 years, you do not need further vaccination now.</p>
    </div>
  </div>
</div>

<!-- ============================================================
     S2: STATS BAND
     ============================================================ -->
<section class="py-10 md:py-12" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="section-container">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 mb-reveal">
      <?php
      $mb_stats = [
          [ 'value' => 'FREE',        'label' => 'On the NHS' ],
          [ 'value' => '2 Doses',     'label' => 'At Least 28 Days Apart' ],
          [ 'value' => '~6 Weeks',    'label' => 'To Full Protection' ],
          [ 'value' => '5+ Years',    'label' => 'Protection Lasts' ],
      ];
      foreach ( $mb_stats as $s ) : ?>
      <div class="text-center">
        <div class="text-2xl md:text-4xl font-bold text-white mb-1 font-jost"><?php echo $s['value']; ?></div>
        <div class="text-blue-100 text-xs md:text-sm font-jost"><?php echo $s['label']; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     S3: SPOTLIGHT — why this programme exists
     ============================================================ -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
  <div class="section-container">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
      <div class="mb-reveal">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
          2026 One-Off Programme
        </span>
        <h2 class="text-3xl md:text-4xl lg:text-[42px] font-bold text-slate-900 mb-5 font-jost leading-tight">Why the MenB Vaccine Is Being Offered Now</h2>
        <p class="text-slate-700 text-lg mb-5 font-jost leading-relaxed">A time-limited MenB vaccine offer is available now for eligible young people, including those starting university as undergraduates or moving into residential further education settings for the first time in autumn 2026.</p>
        <p class="text-slate-600 text-base font-jost leading-relaxed mb-8">The programme has been introduced in response to <a href="<?php echo esc_url( $mb_links['outbreak'] ); ?>" target="_blank" rel="noopener" class="text-blue-700 font-semibold hover:underline">recent meningitis outbreaks</a>, while a full review of the evidence by the Joint Committee on Vaccination and Immunisation (JCVI) is underway. It is available across all four nations of the UK &mdash; this page covers access in England.</p>
        <div class="flex flex-wrap gap-x-6 gap-y-3 mb-8">
          <?php foreach ( [ 'First doses from 20 July 2026', 'Second doses from August 2026', 'Walk-in at participating pharmacies' ] as $mb_point ) : ?>
          <div class="flex items-center gap-2 text-slate-700 font-jost text-sm md:text-base font-medium">
            <span class="flex-shrink-0 w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center">
              <svg class="w-3 h-3 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo esc_html( $mb_point ); ?>
          </div>
          <?php endforeach; ?>
        </div>
        <a href="#eligibility" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
          See If You're Eligible
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <div class="relative mb-reveal">
        <div class="rounded-3xl overflow-hidden aspect-[4/3] shadow-2xl shadow-blue-900/15">
          <img src="<?php echo esc_url( $mb_spotlight_img ); ?>" alt="<?php echo esc_attr( $mb_spotlight_alt ); ?>" class="w-full h-full object-cover" loading="lazy" />
        </div>
        <div class="absolute -bottom-5 -left-5 md:-bottom-6 md:-left-6 bg-white rounded-2xl shadow-xl border border-slate-100 px-5 py-4 flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
          </div>
          <div>
            <p class="text-slate-900 font-bold text-sm font-jost leading-tight">Starting Uni This Autumn?</p>
            <p class="text-slate-500 text-xs font-jost">Get your first dose well before term begins</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S4: ELIGIBILITY — the three groups (id="eligibility")
     ============================================================ -->
<section id="eligibility" class="py-16 md:py-24 bg-gradient-to-b from-slate-50 to-white">
  <div class="section-container">
    <div class="text-center mb-12 mb-reveal">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>
        Check Your Eligibility
      </span>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 font-jost">Who Can Get the Free MenB Vaccine?</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">In England, you are eligible if you are in one of these three groups. If you're unsure, our pharmacists can help you check.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
      <?php
      $mb_groups = [
          [ 'tag' => 'Group 1', 'title' => 'Aged 17 or 18', 'desc' => 'Born between <strong>1 September 2007 and 31 August 2008</strong> and registered with a GP surgery in England. Book online through the NHS &mdash; first-dose appointments from 20 July 2026.', 'icon' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>' ],
          [ 'tag' => 'Group 2', 'title' => 'University Freshers', 'desc' => 'All undergraduate freshers born on or after <strong>21 July 2001</strong> attending university for the first time in autumn 2026 &mdash; including international students and those from the devolved nations and Crown Dependencies.', 'icon' => '<path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5"/>' ],
          [ 'tag' => 'Group 3', 'title' => 'Residential FE Students', 'desc' => 'Born on or after <strong>21 July 2001</strong>, starting further education for the first time in autumn 2026, and living in further education accommodation.', 'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/>' ],
      ];
      foreach ( $mb_groups as $g ) : ?>
      <div class="mb-card bg-white border border-gray-200/80 rounded-2xl p-7 shadow-sm mb-reveal">
        <div class="flex items-center justify-between mb-4">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-50 text-blue-600">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $g['icon']; ?></svg>
          </div>
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200"><?php echo esc_html( $g['tag'] ); ?></span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 font-jost"><?php echo esc_html( $g['title'] ); ?></h3>
        <p class="text-gray-600 text-[15px] leading-relaxed font-jost"><?php echo wp_kses( $g['desc'], [ 'strong' => [] ] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Devolved nations note -->
    <div class="max-w-4xl mx-auto bg-blue-50 border border-blue-100 rounded-2xl px-6 py-5 flex items-start gap-4 mb-reveal">
      <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      <p class="text-blue-900 text-sm font-jost leading-relaxed">The programme runs across all four UK nations and Crown Dependencies. If you live in <a href="<?php echo esc_url( $mb_links['scotland'] ); ?>" target="_blank" rel="noopener" class="font-semibold underline hover:text-blue-700">Scotland</a>, <a href="<?php echo esc_url( $mb_links['wales'] ); ?>" target="_blank" rel="noopener" class="font-semibold underline hover:text-blue-700">Wales</a> or <a href="<?php echo esc_url( $mb_links['ni'] ); ?>" target="_blank" rel="noopener" class="font-semibold underline hover:text-blue-700">Northern Ireland</a>, please check your local public health guidance for how to access the vaccine in your area.</p>
    </div>
  </div>
</section>

<!-- ============================================================
     S5: HOW TO GET IT — two routes (id="how")
     ============================================================ -->
<section id="how" class="py-16 md:py-24 bg-white">
  <div class="section-container">
    <div class="text-center mb-12 mb-reveal">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        Two Simple Routes
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">How to Get Your MenB Vaccine</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">How you get vaccinated depends on which eligible group you're in. This applies to England.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
      <!-- Route 1: 17-18 cohort -->
      <div class="mb-card bg-white border border-gray-200/80 rounded-2xl p-8 shadow-sm mb-reveal flex flex-col">
        <span class="inline-flex items-center self-start px-3 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200 mb-5">Aged 17&ndash;18</span>
        <h3 class="text-2xl font-bold text-gray-900 mb-3 font-jost">Book Online with the NHS</h3>
        <p class="text-gray-600 text-[15px] leading-relaxed font-jost mb-6 flex-1">If you were born between 1 September 2007 and 31 August 2008, you can book online now. First-dose appointments begin from <strong>20 July 2026</strong>. You must be registered with a GP surgery in England.</p>
        <a href="<?php echo esc_url( $mb_links['book'] ); ?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
          Book on the NHS Website
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

      <!-- Route 2: students walk-in -->
      <div class="mb-card bg-white border-2 border-blue-200 rounded-2xl p-8 shadow-sm mb-reveal flex flex-col relative overflow-hidden">
        <span class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold font-jost uppercase tracking-wider px-4 py-1.5 rounded-bl-xl">At Our Pharmacies</span>
        <span class="inline-flex items-center self-start px-3 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mb-5 mt-4">Uni &amp; FE Freshers Under 25</span>
        <h3 class="text-2xl font-bold text-gray-900 mb-3 font-jost">Walk In &mdash; No GP Registration Needed</h3>
        <p class="text-gray-600 text-[15px] leading-relaxed font-jost mb-6 flex-1">If you were born on or after 21 July 2001 and are starting university or residential further education for the first time this autumn, you can get your MenB vaccine at a participating pharmacy from <strong>20 July 2026</strong>. This includes international students, students from Scotland, Wales, Northern Ireland, the Channel Islands and the Isle of Man, and those travelling abroad to study. <strong>You do not need to be registered with a GP surgery.</strong></p>
        <div class="flex flex-col sm:flex-row gap-3">
          <a href="#locations" class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
            Find Your Nearest Branch
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S6: DOSE TIMELINE
     ============================================================ -->
<section class="py-16 md:py-24" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="section-container">
    <div class="text-center mb-12 mb-reveal">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Around 6 Weeks Start to Finish
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Your Two-Dose Timeline</h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost">Two doses are essential for protection &mdash; start early, ideally well before the autumn term begins.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto mb-reveal">
      <?php
      $mb_steps = [
          [ 'n' => 'Dose 1', 'when' => 'From 20 July 2026', 'desc' => 'Get your first dose as early as possible. Book online (17&ndash;18 cohort) or walk in at a participating pharmacy (eligible students).' ],
          [ 'n' => 'Dose 2', 'when' => 'At Least 28 Days Later', 'desc' => 'Your second dose is offered from August and must be given at least 28 days after the first. Both doses are essential.' ],
          [ 'n' => 'Protected', 'when' => '2 Weeks After Dose 2', 'desc' => 'It takes a further 2 weeks after your second dose to build a good level of immunity. Protection lasts at least 5 years.' ],
      ];
      foreach ( $mb_steps as $i => $st ) : ?>
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7 hover:bg-white/15 transition-colors">
        <div class="flex items-center gap-3 mb-4">
          <span class="w-11 h-11 rounded-full bg-white text-blue-700 flex items-center justify-center font-bold text-sm font-jost flex-shrink-0"><?php echo esc_html( $i + 1 ); ?></span>
          <div>
            <p class="text-white text-lg font-bold font-jost leading-tight"><?php echo esc_html( $st['n'] ); ?></p>
            <p class="text-blue-200 text-xs font-semibold uppercase tracking-wide font-jost"><?php echo wp_kses_post( $st['when'] ); ?></p>
          </div>
        </div>
        <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo wp_kses_post( $st['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     S7: SAFETY & EFFECTIVENESS
     ============================================================ -->
<section class="py-16 md:py-24 bg-slate-50">
  <div class="section-container">
    <div class="text-center mb-12 mb-reveal">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        Tested &amp; Trusted
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Safety &amp; Effectiveness</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">The MenB vaccine has been used routinely in the UK infant programme since 2015 and meets strict safety standards.</p>
    </div>
    <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
      <?php
      $mb_safety = [
          [ 'accent' => 'emerald', 'title' => 'Proven in Real-World Use', 'desc' => 'Used in the UK infant vaccination programme since 2015, a study in babies showed a <a href="' . esc_url( $mb_links['study'] ) . '" target="_blank" rel="noopener" class="text-blue-700 font-semibold hover:underline">75% reduction in MenB disease</a> in vaccinated groups.', 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/>' ],
          [ 'accent' => 'blue', 'title' => 'Mild, Short-Lived Side Effects', 'desc' => 'Most side effects are mild and pass within a day or two: fever, swelling or tenderness at the injection site, nausea, headache or muscle aches. Paracetamol helps. Serious side effects are rare.', 'icon' => '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>' ],
          [ 'accent' => 'violet', 'title' => 'Long-Lasting Protection', 'desc' => 'Protection from the full two-dose course lasts for at least 5 years. If you completed a MenB course in the past 5 years, you do not need further vaccination now.', 'icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>' ],
          [ 'accent' => 'amber', 'title' => 'Know the Signs — Always', 'desc' => 'The vaccine covers most, but not all, MenB strains and does not protect against all causes of meningitis and septicaemia. <a href="' . esc_url( $mb_links['symptoms'] ) . '" target="_blank" rel="noopener" class="text-blue-700 font-semibold hover:underline">Stay aware of the signs and symptoms</a> and seek early medical help if concerned about someone\'s health.', 'icon' => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>' ],
      ];
      $mb_accents = [
          'emerald' => [ 'chip' => 'bg-emerald-50', 'icon' => 'text-emerald-600', 'top' => 'border-t-emerald-400' ],
          'blue'    => [ 'chip' => 'bg-blue-50',    'icon' => 'text-blue-600',    'top' => 'border-t-blue-400' ],
          'violet'  => [ 'chip' => 'bg-violet-50',  'icon' => 'text-violet-600',  'top' => 'border-t-violet-400' ],
          'amber'   => [ 'chip' => 'bg-amber-50',   'icon' => 'text-amber-600',   'top' => 'border-t-amber-400' ],
      ];
      foreach ( $mb_safety as $card ) : $a = $mb_accents[ $card['accent'] ]; ?>
      <div class="bg-white rounded-2xl p-7 md:p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 mb-reveal border-t-4 <?php echo esc_attr( $a['top'] ); ?>">
        <div class="flex items-start gap-4 mb-4">
          <div class="flex-shrink-0 w-14 h-14 <?php echo esc_attr( $a['chip'] ); ?> rounded-2xl flex items-center justify-center">
            <svg class="w-7 h-7 <?php echo esc_attr( $a['icon'] ); ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $card['icon']; ?></svg>
          </div>
          <h3 class="text-lg md:text-xl font-bold text-slate-900 font-jost pt-3"><?php echo esc_html( $card['title'] ); ?></h3>
        </div>
        <p class="text-slate-600 text-[15px] font-jost leading-relaxed"><?php echo wp_kses( $card['desc'], [ 'a' => [ 'href' => [], 'target' => [], 'rel' => [], 'class' => [] ] ] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Private option note -->
    <div class="max-w-4xl mx-auto mt-10 bg-white border border-slate-200 rounded-2xl px-6 py-5 flex items-start gap-4 mb-reveal">
      <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      <p class="text-slate-700 text-sm font-jost leading-relaxed"><strong>Not eligible for the NHS offer?</strong> The MenB vaccine can be obtained privately from many travel clinics, pharmacies and some private GP practices. Speak to our team on <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="text-blue-700 font-semibold hover:underline"><?php echo esc_html( $phone ); ?></a> for advice.</p>
    </div>
  </div>
</section>

<!-- ============================================================
     S8: LOCATIONS (id="locations") — reused branch module
     ============================================================ -->
<section id="locations" class="py-16 md:py-24 bg-white">
  <div class="section-container">
    <div class="text-center mb-12 mb-reveal">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        Find Us
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost">Our Hampshire Pharmacies</h2>
      <p class="text-slate-600 text-lg max-w-2xl mx-auto font-jost">Eligible students can walk in for their free MenB vaccine &mdash; no appointment or GP registration needed. We recommend calling ahead to confirm same-day availability at your branch.</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-reveal">
      <?php foreach ( sp_branch_order() as $i ) :
        $b = sp_branch( $i );
      ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-lg transition-shadow duration-300 flex flex-col">
        <div class="relative overflow-hidden h-44">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b['name'] ); ?> pharmacy" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-slate-800 text-xs font-semibold font-jost px-2.5 py-1 rounded-full"><?php echo esc_html( $b['name'] ); ?></span>
        </div>
        <div class="p-5 space-y-2.5 flex flex-col flex-1">
          <div class="flex items-start gap-2 text-slate-600 text-sm font-jost">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo esc_html( $b['address'] ); ?>
          </div>
          <div class="flex items-center gap-2 text-slate-600 text-sm font-jost">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 17l-.08-.08z"/></svg>
            <?php echo esc_html( $b['phone'] ); ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     S9: FAQ — sticky sidebar + accordion
     ============================================================ -->
<section id="faq" class="py-16 md:py-24" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
  <div class="section-container">
    <div class="grid lg:grid-cols-[340px_1fr] gap-12 lg:gap-16 items-start">
      <div class="lg:sticky lg:top-28 mb-reveal">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">FAQs</span>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">MenB Vaccine FAQs</h2>
        <p class="text-gray-600 mb-8 font-jost">Common questions about the free NHS Meningitis B vaccine programme.</p>
        <a href="#eligibility" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20 w-full justify-center">
          Check Your Eligibility
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" transform="rotate(180 12 12)"/></svg>
        </a>
      </div>
      <div class="space-y-3 mb-reveal">
        <?php foreach ( $mb_faqs as $faq ) : ?>
        <details class="mb-faq-item">
          <summary class="mb-faq-question font-jost">
            <?php echo esc_html( $faq['q'] ); ?>
            <svg class="mb-faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </summary>
          <div class="mb-faq-answer"><?php echo esc_html( $faq['a'] ); ?></div>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S10: CLOSING CTA
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="relative section-container text-center">
    <div class="mb-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost">Starting Uni This Autumn? Get Protected First.</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost">Two doses, around 6 weeks to full protection &mdash; so don't leave it until Freshers' Week. Eligible students can walk in at our Hampshire pharmacies from 20 July 2026.</p>
    </div>
    <div class="flex flex-wrap justify-center gap-4 mb-reveal">
      <a href="#locations" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Find Your Nearest Branch
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Medical / eligibility disclaimer -->
<div class="bg-gray-50 border-t border-gray-200 py-10">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-start gap-4 bg-white border border-gray-200 rounded-2xl p-5 md:p-6 shadow-sm">
      <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      </div>
      <div>
        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-1.5 font-jost">Important Information</h3>
        <p class="text-gray-600 text-sm leading-relaxed font-jost">This NHS MenB vaccination programme is delivered strictly under NHS eligibility guidance, which may change &mdash; always check the latest NHS information. Vaccination is provided only to those in the eligible groups; please do not book or attend if you are not eligible, as you will not be vaccinated. This information does not replace medical advice: the MenB vaccine does not protect against all causes of meningitis and septicaemia, so remain aware of the signs and symptoms and seek early medical help if concerned. Southdowns Pharmacy pharmacists are registered with the <span class="font-semibold text-gray-700">General Pharmaceutical Council (GPhC)</span>.</p>
      </div>
    </div>
  </div>
</div>

<?php
// ── FAQPage JSON-LD ──
$mb_faq_ldjson = [];
foreach ( $mb_faqs as $faq ) {
	$mb_faq_ldjson[] = [
		'@type'          => 'Question',
		'name'           => wp_strip_all_tags( $faq['q'] ),
		'acceptedAnswer' => [ '@type' => 'Answer', 'text' => wp_strip_all_tags( $faq['a'] ) ],
	];
}
$mb_ldjson = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $mb_faq_ldjson ];
?>
<script type="application/ld+json"><?php echo wp_json_encode( $mb_ldjson ); ?></script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.mb-reveal');
  if (!els.length) return;
  if (!('IntersectionObserver' in window)) { els.forEach(function(el) { el.classList.add('visible'); }); return; }
  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  els.forEach(function(el) { io.observe(el); });
})();
</script>

<?php get_footer();
