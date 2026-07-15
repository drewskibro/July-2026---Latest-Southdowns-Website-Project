<?php
/**
 * Template Name: Services Hub
 *
 * Central "Our Services" landing page — the SEO hub that links out to every
 * service. Fixes the broken /services/ menu link (previously redirected to home).
 *
 * URL slug: /services/
 *
 * Assembled from EXISTING Southdowns components:
 *   - Standard 2-column service hero + roundels (page-blood-pressure.php pattern)
 *   - sp_branch() four-card locations block (reused verbatim)
 *   - premium-badge / yf-reveal / section gradients (global.css)
 * New pieces: category service grid + Weight Loss spotlight band.
 */

get_header();

$booking_url = sp_booking_url();

// Hero image (ACF-overridable). Warm pharmacy lifestyle photo, not clinical.
$svc_hero_img = sp_field( 'svc_hero_image', 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=1200&q=80&auto=format&fit=crop' );
$svc_hero_alt = sp_field( 'svc_hero_image_alt', 'Southdowns Pharmacy healthcare services across Hampshire' );

// Weight-loss spotlight image (ACF-overridable).
$svc_wl_img = sp_field( 'svc_wl_image', 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=1000&q=80&auto=format&fit=crop' );
$svc_wl_alt = sp_field( 'svc_wl_image_alt', 'Clinically supervised weight loss programme at Southdowns Pharmacy' );

// Roundel font stack (exact pattern from page-blood-pressure.php / page-emsworth.php)
$svc_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
$svc_txt  = "font-family:{$svc_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";

/* -----------------------------------------------------------------
   SERVICE CATALOGUE — grouped by category. Each service links to its
   existing page. Prices are the real anchor prices carried in the
   theme; everything else deep-links to /pricing/ (no invented figures).
   ----------------------------------------------------------------- */
$svc_groups = [
    [
        'eyebrow' => 'Travel Clinic',
        'heading' => 'Travel Health & Vaccinations',
        'blurb'   => "Hampshire's dedicated travel clinic — destination-specific vaccine plans and expert advice, no GP referral needed.",
        'tile'    => 'bg-blue-50 text-blue-600',
        'services' => [
            [ 'name' => 'Travel Health', 'url' => '/travel-health/', 'desc' => 'Expert vaccine advice and same-day appointments for any destination.', 'nhs' => false, 'price' => '',
              'icon' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>' ],
            [ 'name' => 'Thailand Travel Vaccines', 'url' => '/destinations/thailand/', 'desc' => 'All essential vaccines and expert advice for your trip to Thailand.', 'nhs' => false, 'price' => '',
              'icon' => '<path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>' ],
            [ 'name' => 'Yellow Fever', 'url' => '/yellow-fever/', 'desc' => 'NATHNAC-certified centre — vaccine plus your lifelong ICVP certificate.', 'nhs' => false, 'price' => '',
              'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
        ],
    ],
    [
        'eyebrow' => 'Vaccinations',
        'heading' => 'COVID-19 Vaccinations',
        'blurb'   => 'NHS and private COVID-19 vaccination at all four branches — walk in or book ahead.',
        'tile'    => 'bg-teal-50 text-teal-600',
        'services' => [
            [ 'name' => 'NHS COVID-19 Vaccine', 'url' => '/covid-19-vaccine/', 'desc' => 'Free seasonal COVID-19 vaccination for eligible NHS patients.', 'nhs' => true, 'price' => '',
              'icon' => '<path d="m18 2 4 4"/><path d="m17 7 3-3"/><path d="M19 9 8.7 19.3c-1 1-2.5 1-3.4 0l-.6-.6c-1-1-1-2.5 0-3.4L15 5"/><path d="m9 11 4 4"/><path d="m5 19-3 3"/><path d="m14 4 6 6"/>' ],
            [ 'name' => 'Private COVID-19 Vaccine', 'url' => '/covid-vaccine-private/', 'desc' => 'Private Pfizer vaccination with no eligibility criteria or waiting list.', 'nhs' => false, 'price' => 'from £89.50',
              'icon' => '<path d="m18 2 4 4"/><path d="m17 7 3-3"/><path d="M19 9 8.7 19.3c-1 1-2.5 1-3.4 0l-.6-.6c-1-1-1-2.5 0-3.4L15 5"/><path d="m9 11 4 4"/><path d="m5 19-3 3"/><path d="m14 4 6 6"/>' ],
        ],
    ],
    [
        'eyebrow' => 'Clinical & Wellbeing',
        'heading' => 'Clinical & Wellbeing Services',
        'blurb'   => 'Everyday health services delivered by GPhC-registered pharmacists close to home.',
        'tile'    => 'bg-emerald-50 text-emerald-600',
        'services' => [
            [ 'name' => 'Weight Loss', 'url' => '/weight-loss/', 'desc' => 'Clinically supervised Mounjaro & Wegovy programmes — no GP referral.', 'nhs' => false, 'price' => 'Free consultation',
              'icon' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>' ],
            [ 'name' => 'Wegovy Pill', 'url' => '/wegovy-pill/', 'desc' => 'The MHRA-approved oral semaglutide — a needle-free alternative to the weekly jab.', 'nhs' => false, 'price' => 'from £128.50',
              'icon' => '<path d="M10.5 20.5 3.5 13.5a4.95 4.95 0 0 1 7-7l7 7a4.95 4.95 0 0 1-7 7Z"/><path d="m8.5 8.5 7 7"/>' ],
            [ 'name' => 'Blood Pressure Checks', 'url' => '/blood-pressure-checks/', 'desc' => 'Free NHS blood pressure checks — no appointment, results in minutes.', 'nhs' => true, 'price' => '',
              'icon' => '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8z"/>' ],
            [ 'name' => 'Ear Wax Removal', 'url' => '/ear-wax-removal/', 'desc' => 'Gentle TympaHealth microsuction with same-day appointments.', 'nhs' => false, 'price' => '£50 one ear · £60 both',
              'icon' => '<path d="M6 8.5a6.5 6.5 0 1 1 13 0c0 6-6 6-6 10a3.5 3.5 0 1 1-7 0"/><path d="M8.5 8.5a3.5 3.5 0 1 1 7 0c0 3-3 3-3 5"/>' ],
        ],
    ],
    [
        'eyebrow' => 'NHS Services',
        'heading' => 'NHS Services',
        'blurb'   => 'Free NHS care on your doorstep — treatment and prescriptions without the wait.',
        'tile'    => 'bg-indigo-50 text-indigo-600',
        'services' => [
            [ 'name' => 'Pharmacy First', 'url' => '/pharmacy-first/', 'desc' => 'Free NHS assessment and treatment for seven common conditions.', 'nhs' => true, 'price' => '',
              'icon' => '<path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6 6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 12 0v-4"/><circle cx="20" cy="10" r="2"/>' ],
            [ 'name' => 'NHS Prescriptions', 'url' => '/nhs-prescriptions/', 'desc' => 'Nominate your branch for repeat prescriptions, reminders & family ordering.', 'nhs' => true, 'price' => '',
              'icon' => '<rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M9 14l2 2 4-4"/>' ],
        ],
    ],
];

/* -----------------------------------------------------------------
   FAQ — ACF repeater override, falling back to hardcoded defaults.
   ----------------------------------------------------------------- */
$svc_faqs = [];
if ( function_exists( 'have_rows' ) && have_rows( 'svc_faq_items' ) ) {
    while ( have_rows( 'svc_faq_items' ) ) {
        the_row();
        $svc_faqs[] = [ 'q' => get_sub_field( 'question' ), 'a' => get_sub_field( 'answer' ) ];
    }
}
if ( empty( $svc_faqs ) ) {
    $svc_faqs = [
        [ 'q' => 'Do I need an appointment to use your services?',
          'a' => 'It depends on the service. Free NHS services like blood pressure checks and Pharmacy First are walk-in during opening hours. Travel health, weight loss and ear wax removal are usually booked in advance so we can give you dedicated pharmacist time — though same-day appointments are often available.' ],
        [ 'q' => 'Which of your services are free on the NHS?',
          'a' => 'Blood pressure checks, Pharmacy First (treatment for seven common conditions), NHS repeat prescriptions and — for eligible patients — the seasonal COVID-19 vaccination are all free on the NHS. Travel vaccinations, weight loss programmes, ear wax removal and private COVID-19 vaccination are private services.' ],
        [ 'q' => 'Do I need a GP referral?',
          'a' => 'No. Every service we offer is accessible directly — you do not need a GP referral for travel health, weight loss, ear wax removal, Pharmacy First or any of our vaccinations. Just book in or walk in.' ],
        [ 'q' => 'Do all four branches offer every service?',
          'a' => 'Core services such as prescriptions, blood pressure checks and Pharmacy First are available at all four Hampshire branches. Some specialist services may run from selected branches — call ahead or check the individual service page and we will point you to the nearest location.' ],
        [ 'q' => 'Can I get weight-loss treatment and travel vaccines without seeing my GP?',
          'a' => 'Yes. Our GPhC-registered pharmacists carry out a clinical assessment in-branch for weight loss (Mounjaro & Wegovy) and provide destination-specific travel vaccinations — all without needing to see your GP first.' ],
        [ 'q' => 'How much do your private services cost?',
          'a' => 'Pricing varies by service — for example ear wax removal is £50 for one ear or £60 for both, and private COVID-19 vaccination starts from £89.50. You can see the full, transparent price list on our pricing page or ask any of our team.' ],
        [ 'q' => 'How do I book an appointment?',
          'a' => 'Book online using the button on any service page, call us, or pop into your nearest branch. Our team will find you the earliest available slot — often the same day.' ],
    ];
}
?>

<!-- Page-scoped styles -->
<style>
  /* Scroll reveal (same pattern as the service pages) */
  .yf-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .yf-reveal.visible { opacity: 1; transform: translateY(0); }
  .yf-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .yf-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .yf-reveal[data-delay="3"] { transition-delay: 0.3s; }

  @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
  .yf-shimmer { background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }

  @media (prefers-reduced-motion: reduce) {
    .yf-reveal { opacity: 1; transform: none; transition: none; }
    .yf-shimmer { animation: none; }
  }

  /* FAQ accordion (same pattern as the service pages) */
  .svc-faq-item { border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s; background: #fff; }
  .svc-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); }
  .svc-faq-item[open] { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); }
  .svc-faq-question { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; font-weight: 600; font-size: 1.05rem; color: #1e293b; list-style: none; font-family: 'Jost', sans-serif; }
  .svc-faq-question::-webkit-details-marker { display: none; }
  .svc-faq-chevron { transition: transform 0.3s; flex-shrink: 0; margin-left: 1rem; }
  .svc-faq-item[open] .svc-faq-chevron { transform: rotate(180deg); }
  .svc-faq-answer { padding: 0 1.5rem 1.25rem; color: #4b5563; line-height: 1.7; font-family: 'Jost', sans-serif; font-size: 0.95rem; }

  /* Service card */
  .svc-card { transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
  .svc-card:hover { transform: translateY(-6px); box-shadow: 0 20px 45px rgba(30,58,138,0.12); border-color: #bfdbfe; }
  .svc-card:hover .svc-card-arrow { transform: translateX(4px); }
  .svc-card-arrow { transition: transform 0.25s ease; }
</style>

<!-- ============================================================
     S1: HERO — 2-column split (blue left, image right) + 3 roundels
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-bleed image + gradient overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $svc_hero_img ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
      NHS &amp; PRIVATE CARE &bull; HAMPSHIRE
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;">Pharmacy Services Across <span class="serif-accent">Hampshire</span></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost">From travel vaccines and weight-loss programmes to free NHS health checks &mdash; expert care from GPhC-registered pharmacists at all four Southdowns branches.</p>
    <div class="flex flex-wrap gap-3">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book an Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>

  <!-- Desktop: two-column split -->
  <div class="hidden md:flex relative">

    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        NHS &amp; PRIVATE CARE &bull; HAMPSHIRE
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-6 font-jost" style="line-height:1.1;">Pharmacy Services Across <span class="serif-accent">Hampshire</span></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost">Everything from travel vaccinations and clinically supervised weight loss to free NHS health checks &mdash; delivered by GPhC-registered pharmacists at all four Southdowns branches.</p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book an Appointment
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
      <!-- Trust strip -->
      <div class="flex flex-wrap gap-x-5 gap-y-2 text-white text-sm font-medium font-jost">
        <?php
        $svc_trust = [ 'NHS &amp; Private Care', 'GPhC Registered', 'No GP Referral', 'Same-Day Appointments' ];
        foreach ( $svc_trust as $item ) : ?>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php echo $item; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Right: hero image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $svc_hero_img ); ?>');" role="img" aria-label="<?php echo esc_attr( $svc_hero_alt ); ?>"></div>

    <!-- Roundel 1 — 10+ SERVICES (top, white/navy, 132px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:12%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);padding:0 10px;text-align:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        <span style="<?php echo $svc_txt; ?>font-size:15px;font-weight:800;color:#1e3a8a;line-height:1.1;letter-spacing:-0.01em;">10+</span>
        <span style="<?php echo $svc_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">SERVICES</span>
        <span style="<?php echo $svc_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">One Trusted Team</span>
      </div>
    </div>

    <!-- Roundel 2 — NHS & PRIVATE (centre, blue gradient, 148px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="width:148px;height:148px;border-radius:50%;background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px rgba(29,78,216,0.5),0 0 0 6px rgba(255,255,255,0.5),0 8px 32px rgba(29,78,216,0.35),0 2px 8px rgba(0,0,0,0.15);padding:0 10px;text-align:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.95)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        <span style="<?php echo $svc_txt; ?>font-size:13px;font-weight:800;color:#fff;line-height:1.2;letter-spacing:-0.01em;">NHS &amp;</span>
        <span style="<?php echo $svc_txt; ?>font-size:13px;font-weight:800;color:#fff;line-height:1.2;letter-spacing:-0.01em;">PRIVATE</span>
        <span style="<?php echo $svc_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.8);line-height:1.3;margin-top:3px;">Care Under One Roof</span>
      </div>
    </div>

    <!-- Roundel 3 — 4 BRANCHES (bottom, white/navy, 132px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:12%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);padding:0 10px;text-align:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span style="<?php echo $svc_txt; ?>font-size:15px;font-weight:800;color:#1e3a8a;line-height:1.1;letter-spacing:-0.01em;">4</span>
        <span style="<?php echo $svc_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">BRANCHES</span>
        <span style="<?php echo $svc_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Across Hampshire</span>
      </div>
    </div>

  </div>
</section>


<!-- ============================================================
     S2: AT-A-GLANCE STATS — Blue gradient band
     ============================================================ -->
<section class="py-10 md:py-12" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="section-container">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 yf-reveal">
      <?php
      $svc_stats = [
          [ 'value' => '10+',    'label' => 'Health Services' ],
          [ 'value' => '4',      'label' => 'Hampshire Branches' ],
          [ 'value' => 'NHS &amp; Private', 'label' => 'Care Options' ],
          [ 'value' => 'GPhC',   'label' => 'Registered Pharmacists' ],
      ];
      foreach ( $svc_stats as $s ) : ?>
      <div class="text-center">
        <div class="text-2xl md:text-4xl font-bold text-white mb-1 font-jost"><?php echo $s['value']; ?></div>
        <div class="text-blue-100 text-xs md:text-sm font-jost"><?php echo $s['label']; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: WEIGHT LOSS SPOTLIGHT — Featured band (the big earner)
     ============================================================ -->
<section class="py-16 md:py-24 bg-[#fdf9f6] border-t border-[#e8e0d8] overflow-hidden">
  <div class="section-container">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">

      <!-- Copy -->
      <div class="yf-reveal order-2 lg:order-1">
        <span class="inline-flex items-center gap-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-wide px-3 py-1.5 rounded-full mb-5 font-jost shadow-sm">
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.367 2.446a1 1 0 00-.364 1.118l1.287 3.956c.3.921-.755 1.688-1.54 1.118l-3.366-2.446a1 1 0 00-1.176 0l-3.366 2.446c-.784.57-1.838-.197-1.539-1.118l1.287-3.956a1 1 0 00-.364-1.118L2.05 9.372c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.951-.69l1.286-3.955z"/></svg>
          Most Popular
        </span>
        <div class="premium-badge flex items-center justify-start gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Medical Weight Loss</span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-5 font-jost">Reach a Healthier Weight, <span class="serif-accent text-blue-700">Supported Every Step</span></h2>
        <p class="text-lg text-slate-600 mb-6 leading-relaxed font-jost">Clinically supervised Mounjaro and Wegovy programmes from local, GPhC-registered pharmacists &mdash; with no GP referral and a free initial consultation. Supplied the same day from our Hampshire pharmacies.</p>

        <div class="grid sm:grid-cols-2 gap-x-6 gap-y-3 mb-8">
          <?php
          $svc_wl_points = [
              'GLP-1 treatments (Mounjaro &amp; Wegovy)',
              'Free initial consultation',
              'No GP referral needed',
              'Ongoing pharmacist support',
          ];
          foreach ( $svc_wl_points as $point ) : ?>
          <div class="flex items-center gap-2.5 text-slate-700 font-jost">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="text-sm md:text-base"><?php echo $point; ?></span>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="flex flex-wrap gap-4">
          <a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
            Explore Weight Loss
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-blue-700 font-semibold border-2 border-blue-200 px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors font-jost">
            Book Free Consultation
          </a>
        </div>
      </div>

      <!-- Image -->
      <div class="yf-reveal order-1 lg:order-2">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-blue-900/10 aspect-[4/3]">
          <img src="<?php echo esc_url( $svc_wl_img ); ?>" alt="<?php echo esc_attr( $svc_wl_alt ); ?>" class="w-full h-full object-cover" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S4: SERVICE CATEGORY GRID — the hub (links to every service page)
     ============================================================ -->
<section id="all-services" class="py-16 md:py-24 bg-white">
  <div class="section-container">

    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Everything We Offer</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 font-jost">Explore Our Services</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Choose a service to learn more, see pricing and book. Every service is delivered by our GPhC-registered team across Hampshire.</p>
    </div>

    <?php foreach ( $svc_groups as $group ) : ?>
    <div class="mb-14 last:mb-0 yf-reveal">

      <!-- Category header -->
      <div class="flex items-center gap-4 mb-6">
        <div class="flex-shrink-0">
          <span class="text-xs font-bold uppercase tracking-[0.12em] text-blue-600 font-jost"><?php echo $group['eyebrow']; ?></span>
          <h3 class="text-2xl md:text-3xl font-bold text-gray-900 font-jost"><?php echo $group['heading']; ?></h3>
        </div>
        <div class="flex-1 h-px bg-gray-200"></div>
      </div>
      <p class="text-gray-600 mb-8 max-w-3xl font-jost"><?php echo $group['blurb']; ?></p>

      <!-- Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ( $group['services'] as $svc ) : ?>
        <a href="<?php echo esc_url( home_url( $svc['url'] ) ); ?>" class="svc-card group block bg-white border border-gray-200/80 rounded-2xl p-6 shadow-sm">
          <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center <?php echo esc_attr( $group['tile'] ); ?>">
              <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $svc['icon']; ?></svg>
            </div>
            <?php if ( ! empty( $svc['nhs'] ) ) : ?>
              <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full font-jost">Free &middot; NHS</span>
            <?php elseif ( ! empty( $svc['price'] ) ) : ?>
              <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full font-jost"><?php echo esc_html( $svc['price'] ); ?></span>
            <?php endif; ?>
          </div>
          <h4 class="text-lg font-bold text-gray-900 mb-2 font-jost group-hover:text-blue-700 transition-colors"><?php echo esc_html( $svc['name'] ); ?></h4>
          <p class="text-gray-600 text-sm leading-relaxed mb-4 font-jost"><?php echo esc_html( $svc['desc'] ); ?></p>
          <span class="inline-flex items-center gap-1.5 text-blue-600 text-sm font-semibold font-jost">
            Learn more
            <svg class="svc-card-arrow w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </span>
        </a>
        <?php endforeach; ?>
      </div>

    </div>
    <?php endforeach; ?>

  </div>
</section>


<!-- ============================================================
     S5: PRICING SNAPSHOT — Deep-links to the full price list
     ============================================================ -->
<section class="py-16 md:py-24" style="background: linear-gradient(180deg,#f8fafc 0%,#eff6ff 50%,#dbeafe 100%);">
  <div class="section-container">
    <div class="max-w-5xl mx-auto">

      <div class="text-center mb-10 yf-reveal">
        <div class="premium-badge flex items-center justify-center gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Transparent Pricing</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Clear, Upfront Pricing</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">No hidden fees. Many services are free on the NHS, and our private prices are always shown upfront.</p>
      </div>

      <!-- Snapshot rows -->
      <div class="grid sm:grid-cols-2 gap-4 mb-8 yf-reveal">
        <?php
        $svc_price_snapshot = [
            [ 'name' => 'Blood Pressure Checks', 'price' => 'Free', 'note' => 'NHS service' ],
            [ 'name' => 'Pharmacy First',        'price' => 'Free', 'note' => 'NHS service' ],
            [ 'name' => 'Ear Wax Removal',       'price' => '£50', 'note' => 'one ear · £60 both' ],
            [ 'name' => 'Private COVID-19 Vaccine', 'price' => 'from £89.50', 'note' => 'no eligibility criteria' ],
            [ 'name' => 'Weight Loss',           'price' => 'Free', 'note' => 'initial consultation' ],
            [ 'name' => 'Travel Vaccinations',   'price' => 'Varies', 'note' => 'by destination — see full list' ],
        ];
        foreach ( $svc_price_snapshot as $row ) : ?>
        <div class="flex items-center justify-between gap-4 bg-white rounded-2xl px-5 py-4 border border-gray-100 shadow-sm">
          <span class="text-gray-800 font-medium font-jost"><?php echo esc_html( $row['name'] ); ?></span>
          <span class="text-right flex-shrink-0">
            <span class="block text-blue-700 font-bold font-jost"><?php echo esc_html( $row['price'] ); ?></span>
            <span class="block text-gray-400 text-xs font-jost"><?php echo esc_html( $row['note'] ); ?></span>
          </span>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="text-center yf-reveal">
        <a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
          View Full Price List
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S6: WHY CHOOSE SOUTHDOWNS — Blue gradient, glass cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none opacity-40"></div>
  <div class="relative section-container">

    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost">Why Southdowns</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost">Trusted Care, Close to Home</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost">A local, independent pharmacy group putting expert healthcare within reach of every Hampshire community.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 yf-reveal">
      <?php
      $svc_why = [
          [ 'title' => 'GPhC-Registered Pharmacists', 'desc' => 'Every service is delivered by qualified, regulated professionals you can trust.',
            'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
          [ 'title' => 'Four Hampshire Branches', 'desc' => 'Emsworth, Havant, Davies and Rowlands Castle — there is always one near you.',
            'icon' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>' ],
          [ 'title' => 'NHS &amp; Private, One Place', 'desc' => 'Free NHS services and premium private care under a single, familiar roof.',
            'icon' => '<path d="M12 2v20M2 12h20"/>' ],
          [ 'title' => 'No GP Referral Needed', 'desc' => 'Access travel health, weight loss and more directly — skip the waiting list.',
            'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/>' ],
          [ 'title' => 'Same-Day Appointments', 'desc' => 'Often available today — book online, call, or simply walk in.',
            'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>' ],
          [ 'title' => 'Trusted by Thousands', 'desc' => 'Rated 4.9/5 by hundreds of local patients across our branches.',
            'icon' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>' ],
      ];
      foreach ( $svc_why as $why ) : ?>
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:bg-white/15 transition-colors">
        <div class="w-12 h-12 bg-white/15 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $why['icon']; ?></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-2 font-jost"><?php echo $why['title']; ?></h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo $why['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ============================================================
     S7: FOUR LOCATION CARDS — White bg (reused sp_branch() component)
     ============================================================ -->
<section id="locations" class="py-16 md:py-24 bg-white">
  <div class="section-container">

    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Our Pharmacies</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Visit Us Across Hampshire</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Find your nearest Southdowns branch for opening hours, contact details and directions.</p>
    </div>

    <!-- Branch photo cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 yf-reveal">
      <?php for ( $i = 1; $i <= 4; $i++ ) :
        $b = sp_branch( $i ); ?>
      <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b['name'] ); ?> pharmacy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <h3 class="text-white text-xl font-bold font-jost"><?php echo esc_html( $b['name'] ); ?></h3>
          </div>
        </div>
        <div class="p-5 flex flex-col flex-1">
          <div class="flex items-start gap-2 mb-2">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-gray-600 text-sm font-jost"><?php echo esc_html( $b['address_line1'] . ', ' . $b['address_line2'] ); ?></span>
          </div>
          <div class="flex items-start gap-2 mb-4">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <span class="text-gray-400 text-xs font-jost leading-relaxed"><?php echo sp_branch_hours_html( $b ); ?></span>
          </div>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="mt-auto flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Book an Appointment
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endfor; ?>
    </div>

  </div>
</section>


<!-- ============================================================
     S8: FAQ — Light gradient, sticky sidebar + accordion
     ============================================================ -->
<section id="faq" class="py-16 md:py-24" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
  <div class="section-container">
    <div class="grid lg:grid-cols-[340px_1fr] gap-12 lg:gap-16 items-start">

      <!-- Sticky sidebar -->
      <div class="lg:sticky lg:top-28 yf-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">FAQs</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Your Questions, Answered</h2>
        <p class="text-gray-600 mb-8 font-jost">Common questions about our NHS and private services across Hampshire.</p>

        <div class="grid grid-cols-2 gap-3 mb-8">
          <?php
          $svc_faq_stats = [
              [ 'value' => '10+',    'label' => 'Services' ],
              [ 'value' => '4',      'label' => 'Branches' ],
              [ 'value' => 'Same Day', 'label' => 'Appointments' ],
              [ 'value' => 'No Referral', 'label' => 'Needed' ],
          ];
          foreach ( $svc_faq_stats as $s ) : ?>
          <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-xl font-bold text-blue-600 font-jost"><?php echo esc_html( $s['value'] ); ?></div>
            <div class="text-xs text-gray-500 font-jost"><?php echo esc_html( $s['label'] ); ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20 w-full justify-center">
          Book an Appointment
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

      <!-- FAQ accordion -->
      <div class="space-y-3 yf-reveal" data-delay="2">
        <?php foreach ( $svc_faqs as $faq ) : ?>
        <details class="svc-faq-item">
          <summary class="svc-faq-question font-jost">
            <?php echo esc_html( $faq['q'] ); ?>
            <svg class="svc-faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </summary>
          <div class="svc-faq-answer"><?php echo esc_html( $faq['a'] ); ?></div>
        </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S9: CLOSING CTA BANNER — Dark blue gradient
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="absolute top-0 right-0 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.12) 0%,transparent 70%);"></div>
  <div class="relative section-container text-center">

    <div class="flex flex-wrap justify-center gap-3 mb-10 yf-reveal">
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        GPhC Registered
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        NHS &amp; Private
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Four Hampshire Branches
      </span>
    </div>

    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost">Find the Right Care for You</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost">Whatever you need &mdash; a travel vaccine, a weight-loss plan, a free NHS check or a repeat prescription &mdash; your local Southdowns team is ready to help.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-4 yf-reveal" data-delay="2">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Book an Appointment
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>

  </div>
</section>


<?php
// ── FAQPage JSON-LD (built from the same FAQ array shown above) ──
$svc_faq_ldjson = [];
foreach ( $svc_faqs as $faq ) {
    $svc_faq_ldjson[] = [
        '@type'          => 'Question',
        'name'           => wp_strip_all_tags( $faq['q'] ),
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => wp_strip_all_tags( $faq['a'] ) ],
    ];
}
$svc_ldjson = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $svc_faq_ldjson ];
?>
<script type="application/ld+json"><?php echo wp_json_encode( $svc_ldjson ); ?></script>

<!-- Scroll reveal JS -->
<script>
(function() {
  'use strict';
  var els = document.querySelectorAll('.yf-reveal');
  if (!els.length) return;
  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  els.forEach(function(el) { io.observe(el); });
})();
</script>

<?php get_footer();
