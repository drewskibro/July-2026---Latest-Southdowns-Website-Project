<?php
/**
 * Template Name: Blood Testing
 *
 * Private blood testing hub. Availability varies by branch, so the page is
 * built around ACCURACY:
 *   - Per-test Amelia calendars filtered by category/service, so a patient can
 *     only book a test at a branch that actually offers it.
 *   - An availability matrix instead of any "all four branches" claim.
 *   - Davies (the phlebotomy centre, location 3) featured as the flagship.
 *
 * URL slug: /blood-testing/  (fixes the existing footer "Blood Testing" link)
 *
 * Amelia mapping (confirmed from the client's Amelia install):
 *   Type 2 Diabetes Screening · category 11 · Davies(3) only  (all tests Davies-only per client)
 *   Full Blood Count          · category 18 · Davies(3) only
 *   Cholesterol Testing       · category 19 / service 59 · Davies(3) only
 *   Thyroid Function & Auto.   · service 60 · Davies(3) only
 *   Locations: Emsworth=1, Bosmere=2, Davies=3, Rowlands=4 (no blood tests).
 */

get_header();

// CTAs scroll to the on-page per-test booking calendars (#book).
$booking_url = '#book';
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// Imagery (ACF-overridable).
$bt_hero_img    = sp_field( 'bt_hero_image', 'https://images.unsplash.com/photo-1579154204601-01588f351e67?w=1200&q=80&auto=format&fit=crop' );
$bt_hero_alt    = sp_field( 'bt_hero_image_alt', 'Private blood testing at Southdowns Pharmacy, Hampshire' );
$bt_davies_img  = sp_field( 'bt_davies_image', 'https://images.unsplash.com/photo-1581595219315-a187dd40c322?w=1000&q=80&auto=format&fit=crop' );
$bt_davies_alt  = sp_field( 'bt_davies_image_alt', 'Davies Pharmacy phlebotomy centre, Havant' );

// Roundel font stack (same pattern as the other service pages).
$bt_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
$bt_txt  = "font-family:{$bt_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";

/* -----------------------------------------------------------------
   TEST CATALOGUE — each maps to an Amelia filter + real availability.
   'book' = the tab key used by the booking section further down.
   ----------------------------------------------------------------- */
$bt_tests = [
    [
        'key'      => 'fbc',
        'name'     => 'Full Blood Count (FBC)',
        'price'    => '£79',
        'avail'    => 'Davies only',
        'desc'     => 'A comprehensive check of key blood biomarkers — ideal if you feel tired or run down, are concerned about immunity, or simply want reassurance.',
        'icon'     => '<path d="M12 2v6"/><path d="M12 22a7 7 0 0 0 7-7c0-3-3-6.5-7-11-4 4.5-7 8-7 11a7 7 0 0 0 7 7z"/>',
    ],
    [
        'key'      => 'diabetes',
        'name'     => 'Type 2 Diabetes Screening',
        'price'    => '£55',
        'avail'    => 'Davies only',
        'desc'     => 'A simple screening check to assess your blood sugar and diabetes risk, with clear guidance from our pharmacist on any next steps.',
        'icon'     => '<path d="M19 5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2"/><path d="M12 3v18"/><path d="M8 21h8"/><circle cx="12" cy="12" r="4"/>',
    ],
    [
        'key'      => 'cholesterol',
        'name'     => 'Cholesterol Testing',
        'price'    => '£74',
        'avail'    => 'Davies only',
        'desc'     => 'Measure your cholesterol and understand your cardiovascular risk, with professional advice on lifestyle and next steps.',
        'icon'     => '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8z"/>',
    ],
    [
        'key'      => 'thyroid',
        'name'     => 'Thyroid Function & Autoimmune',
        'price'    => '£79',
        'avail'    => 'Davies only',
        'desc'     => 'An advanced thyroid profile to identify potential thyroid dysfunction and autoimmune thyroid conditions early — energy, metabolism, mood and more.',
        'icon'     => '<path d="M12 2a3 3 0 0 0-3 3c0 1 .5 2 1 3-1 1-3 2.5-3 5a5 5 0 0 0 5 5 5 5 0 0 0 5-5c0-2.5-2-4-3-5 .5-1 1-2 1-3a3 3 0 0 0-3-3z"/>',
    ],
];

/* Booking tabs — each renders an Amelia calendar filtered so patients can only
   book at a branch that offers that test. Thyroid has no category ID (yet), so
   it is pinned by service + location. */
$bt_book_tabs = [
    [ 'key' => 'fbc',         'label' => 'Full Blood Count',   'price' => '£79', 'avail' => 'Davies only',   'davies_only' => true,  'note' => 'This test is available at <strong>Davies Pharmacy, Havant</strong> only.',                          'shortcode' => '[ameliastepbooking layout=2 category=18 location=3 show=category,service,employee,datetime,info]' ],
    [ 'key' => 'diabetes',    'label' => 'Diabetes Screening', 'price' => '£55', 'avail' => 'Davies only',   'davies_only' => true,  'note' => 'This test is available at <strong>Davies Pharmacy, Havant</strong> only.',                          'shortcode' => '[ameliastepbooking layout=2 category=11 location=3 show=category,service,employee,datetime,info]' ],
    [ 'key' => 'cholesterol', 'label' => 'Cholesterol',        'price' => '£74', 'avail' => 'Davies only',   'davies_only' => true,  'note' => 'This test is available at <strong>Davies Pharmacy, Havant</strong> only.',                          'shortcode' => '[ameliastepbooking layout=2 category=19 location=3 show=category,service,employee,datetime,info]' ],
    [ 'key' => 'thyroid',     'label' => 'Thyroid',            'price' => '£79', 'avail' => 'Davies only',   'davies_only' => true,  'note' => 'This test is available at <strong>Davies Pharmacy, Havant</strong> only.',                          'shortcode' => '[ameliastepbooking layout=2 service=60 location=3 show=category,service,employee,datetime,info]' ],
];

/* FAQ — ACF repeater override with hardcoded fallback. */
$bt_faqs = [];
if ( function_exists( 'have_rows' ) && have_rows( 'bt_faq_items' ) ) {
    while ( have_rows( 'bt_faq_items' ) ) {
        the_row();
        $bt_faqs[] = [ 'q' => get_sub_field( 'question' ), 'a' => get_sub_field( 'answer' ) ];
    }
}
if ( empty( $bt_faqs ) ) {
    $bt_faqs = [
        [ 'q' => 'Where are your blood tests carried out?',
          'a' => 'All of our blood tests — Full Blood Count, Type 2 Diabetes Screening, Cholesterol and Thyroid — are carried out at Davies Pharmacy, our dedicated phlebotomy centre at 12 West Street, Havant, PO9 1PF.' ],
        [ 'q' => 'Do I need a GP referral?',
          'a' => 'No. All of our blood tests are private services you can book directly — no GP referral and no waiting list.' ],
        [ 'q' => 'How quickly will I get my results?',
          'a' => 'Turnaround varies by test, but results are typically available within 24–48 hours. Your pharmacist will talk you through what they mean and any recommended next steps.' ],
        [ 'q' => 'Do I need to fast before my test?',
          'a' => 'Some tests (for example cholesterol) may require you to fast beforehand. Any preparation needed will be confirmed when you book — if you are unsure, please ask our team.' ],
        [ 'q' => 'Is the appointment private and confidential?',
          'a' => 'Yes. All appointments are carried out discreetly by trained staff, and your results are handled in strict confidence.' ],
        [ 'q' => 'How much do blood tests cost?',
          'a' => 'Full Blood Count is £79, Type 2 Diabetes Screening £55, Cholesterol Testing £74, and the Thyroid Function & Autoimmune profile £79. You can see our full price list on the pricing page.' ],
    ];
}
?>

<!-- Page-scoped styles -->
<style>
  .yf-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .yf-reveal.visible { opacity: 1; transform: translateY(0); }
  .yf-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .yf-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .yf-reveal[data-delay="3"] { transition-delay: 0.3s; }
  @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
  .yf-shimmer { background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }
  @media (prefers-reduced-motion: reduce) { .yf-reveal { opacity: 1; transform: none; transition: none; } .yf-shimmer { animation: none; } }

  /* Test card */
  .bt-card { transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
  .bt-card:hover { transform: translateY(-6px); box-shadow: 0 20px 45px rgba(30,58,138,0.12); border-color: #bfdbfe; }

  /* Booking test selector */
  .bt-tab { transition: background 0.2s, color 0.2s, border-color 0.2s, box-shadow 0.2s, transform 0.2s; }
  .bt-tab[aria-selected="true"] { background: #1d4ed8; color: #fff; border-color: #1d4ed8; box-shadow: 0 8px 20px rgba(29,78,216,0.28); transform: translateY(-2px); }
  .bt-tab[aria-selected="true"] .bt-tab-price { color: #dbeafe; }
  .bt-tab[aria-selected="true"] .bt-tab-avail { color: rgba(255,255,255,0.9) !important; }
  .bt-panel { display: none; }
  .bt-panel.active { display: block; }

  /* FAQ accordion */
  .bt-faq-item { border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s; background: #fff; }
  .bt-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); }
  .bt-faq-item[open] { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); }
  .bt-faq-question { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; font-weight: 600; font-size: 1.05rem; color: #1e293b; list-style: none; font-family: 'Jost', sans-serif; }
  .bt-faq-question::-webkit-details-marker { display: none; }
  .bt-faq-chevron { transition: transform 0.3s; flex-shrink: 0; margin-left: 1rem; }
  .bt-faq-item[open] .bt-faq-chevron { transform: rotate(180deg); }
  .bt-faq-answer { padding: 0 1.5rem 1.25rem; color: #4b5563; line-height: 1.7; font-family: 'Jost', sans-serif; font-size: 0.95rem; }
</style>

<!-- ============================================================
     S1: HERO — 2-column split + 3 roundels
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $bt_hero_img ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      PRIVATE BLOOD TESTING &bull; HAMPSHIRE
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;">Private Blood Testing in <span class="serif-accent">Hampshire</span></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost">Fast, professional blood health checks with rapid results and expert pharmacy support &mdash; no GP referral, no waiting list.</p>
    <div class="flex flex-wrap gap-3">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book a Blood Test
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>

  <!-- Desktop -->
  <div class="hidden md:flex relative">
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        PRIVATE BLOOD TESTING &bull; HAMPSHIRE
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-6 font-jost" style="line-height:1.1;">Private Blood Testing in <span class="serif-accent">Hampshire</span></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost">Understand your health in minutes. Fast, professional blood health checks with rapid results and expert pharmacy support &mdash; carried out at our Davies Pharmacy phlebotomy centre in Havant, with no GP referral and no waiting list.</p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book a Blood Test
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#tests" class="inline-flex items-center gap-2 text-white text-base font-semibold border-2 border-white/50 px-6 py-3 rounded-full hover:bg-white/10 hover:border-white transition-colors font-jost">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
          View Tests &amp; Prices
        </a>
      </div>
      <div class="flex flex-wrap gap-x-5 gap-y-2 text-white text-sm font-medium font-jost">
        <?php foreach ( [ 'No GP Referral', 'Rapid Results', 'GPhC Registered', 'Private &amp; Confidential' ] as $item ) : ?>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php echo $item; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $bt_hero_img ); ?>');" role="img" aria-label="<?php echo esc_attr( $bt_hero_alt ); ?>"></div>

    <!-- Roundel 1 — 4 TESTS -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:12%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18);padding:0 10px;text-align:center;">
        <span style="<?php echo $bt_txt; ?>font-size:22px;font-weight:800;color:#1e3a8a;line-height:1;">4</span>
        <span style="<?php echo $bt_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;margin-top:2px;">BLOOD TESTS</span>
        <span style="<?php echo $bt_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Private &amp; Fast</span>
      </div>
    </div>
    <!-- Roundel 2 — RESULTS -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="width:148px;height:148px;border-radius:50%;background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px rgba(29,78,216,0.5),0 0 0 6px rgba(255,255,255,0.5),0 8px 32px rgba(29,78,216,0.35);padding:0 10px;text-align:center;">
        <span style="<?php echo $bt_txt; ?>font-size:20px;font-weight:800;color:#fff;line-height:1;">24&ndash;48h</span>
        <span style="<?php echo $bt_txt; ?>font-size:12px;font-weight:700;color:#fff;line-height:1.2;margin-top:3px;">RESULTS</span>
        <span style="<?php echo $bt_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.8);line-height:1.3;margin-top:3px;">No GP Referral</span>
      </div>
    </div>
    <!-- Roundel 3 — DAVIES -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:12%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18);padding:0 10px;text-align:center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span style="<?php echo $bt_txt; ?>font-size:13px;font-weight:800;color:#1e3a8a;line-height:1.1;">DAVIES</span>
        <span style="<?php echo $bt_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Phlebotomy Centre</span>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S2: STATS BAND
     ============================================================ -->
<section class="py-10 md:py-12" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="section-container">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 yf-reveal">
      <?php
      $bt_stats = [
          [ 'value' => '24&ndash;48h', 'label' => 'Typical Results' ],
          [ 'value' => 'No Referral', 'label' => 'GP Not Needed' ],
          [ 'value' => 'Private',     'label' => '&amp; Confidential' ],
          [ 'value' => 'GPhC',        'label' => 'Registered Pharmacists' ],
      ];
      foreach ( $bt_stats as $s ) : ?>
      <div class="text-center">
        <div class="text-2xl md:text-4xl font-bold text-white mb-1 font-jost"><?php echo $s['value']; ?></div>
        <div class="text-blue-100 text-xs md:text-sm font-jost"><?php echo $s['label']; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     S3: THE TESTS — 4 cards
     ============================================================ -->
<section id="tests" class="py-16 md:py-24 bg-white">
  <div class="section-container">
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Our Blood Tests</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 font-jost">Choose Your Test</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Fast, professional testing from GPhC-registered pharmacists at Davies Pharmacy, our dedicated phlebotomy centre in Havant.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php foreach ( $bt_tests as $t ) :
        $davies_only = ( $t['avail'] === 'Davies only' ); ?>
      <div class="bt-card group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-sm flex flex-col">
        <div class="flex items-start justify-between mb-4">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-50 text-blue-600">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $t['icon']; ?></svg>
          </div>
          <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-lg font-bold px-3 py-1 rounded-full font-jost"><?php echo esc_html( $t['price'] ); ?></span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2 font-jost"><?php echo esc_html( $t['name'] ); ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed mb-4 font-jost flex-1"><?php echo esc_html( $t['desc'] ); ?></p>
        <div class="flex items-center justify-between gap-3 mt-auto pt-4 border-t border-gray-100">
          <span class="inline-flex items-center gap-1.5 text-xs font-semibold font-jost <?php echo $davies_only ? 'text-blue-700' : 'text-emerald-700'; ?>">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo esc_html( $t['avail'] ); ?>
          </span>
          <a href="#book" data-book-tab="<?php echo esc_attr( $t['key'] ); ?>" class="bt-book-link inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-full transition-colors font-jost">
            Book
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     S4: DAVIES SPOTLIGHT — the flagship phlebotomy centre
     ============================================================ -->
<section class="py-16 md:py-24 bg-[#fdf9f6] border-t border-[#e8e0d8] overflow-hidden">
  <div class="section-container">
    <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
      <div class="yf-reveal order-2 lg:order-1">
        <span class="inline-flex items-center gap-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-wide px-3 py-1.5 rounded-full mb-5 font-jost shadow-sm">
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.367 2.446a1 1 0 00-.364 1.118l1.287 3.956c.3.921-.755 1.688-1.54 1.118l-3.366-2.446a1 1 0 00-1.176 0l-3.366 2.446c-.784.57-1.838-.197-1.539-1.118l1.287-3.956a1 1 0 00-.364-1.118L2.05 9.372c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.951-.69l1.286-3.955z"/></svg>
          Our Phlebotomy Centre
        </span>
        <div class="premium-badge flex items-center justify-start gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Davies Pharmacy, Havant</span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-5 font-jost">All Our Blood Tests, <span class="serif-accent text-blue-700">Under One Roof</span></h2>
        <p class="text-lg text-slate-600 mb-6 leading-relaxed font-jost">Davies Pharmacy in Havant is our dedicated phlebotomy centre &mdash; the only branch offering our full range, including our exclusive Full Blood Count, Cholesterol and advanced Thyroid Function &amp; Autoimmune screening. Whether you feel tired or run down, want reassurance about your immunity, or need early insight into thyroid health, our team provides fast, professional testing without the long GP wait.</p>
        <div class="grid sm:grid-cols-2 gap-x-6 gap-y-3 mb-8">
          <?php foreach ( [ 'Full Blood Count (FBC)', 'Cholesterol Testing', 'Thyroid Function &amp; Autoimmune', 'Type 2 Diabetes Screening' ] as $point ) : ?>
          <div class="flex items-center gap-2.5 text-slate-700 font-jost">
            <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="text-sm md:text-base"><?php echo $point; ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <a href="#book" data-book-tab="fbc" class="bt-book-link inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
          Book at Davies
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
      <div class="yf-reveal order-1 lg:order-2">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-blue-900/10 aspect-[4/3]">
          <img src="<?php echo esc_url( $bt_davies_img ); ?>" alt="<?php echo esc_attr( $bt_davies_alt ); ?>" class="w-full h-full object-cover" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S5: DAVIES LOCATION — all tests, one place
     ============================================================ -->
<section class="py-16 md:py-24 bg-white">
  <div class="section-container">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-10 yf-reveal">
        <div class="premium-badge flex items-center justify-center gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Where to Book</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">One Location for All Your Tests</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Every blood test is carried out at Davies Pharmacy, our dedicated phlebotomy centre in Havant.</p>
      </div>
      <div class="yf-reveal grid md:grid-cols-2 gap-8 lg:gap-10 items-center bg-white rounded-3xl border border-blue-100 shadow-sm p-6 md:p-8 lg:p-10">
        <div>
          <span class="inline-flex items-center gap-2 bg-blue-600 text-white text-xs font-bold uppercase tracking-wide px-3 py-1.5 rounded-full mb-4 font-jost">Phlebotomy Centre</span>
          <h3 class="text-2xl font-bold text-gray-900 mb-2 font-jost">Davies Pharmacy, Havant</h3>
          <div class="flex items-start gap-2 text-gray-600 mb-6 font-jost">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>12 West Street, Havant, Hampshire, PO9 1PF</span>
          </div>
          <ul class="space-y-2.5 mb-8">
            <?php foreach ( $bt_tests as $t ) : ?>
            <li class="flex items-center gap-2.5 text-slate-700 font-jost text-sm md:text-base">
              <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              <?php echo esc_html( $t['name'] ); ?> &mdash; <span class="font-semibold text-blue-700"><?php echo esc_html( $t['price'] ); ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <div class="flex flex-wrap gap-3">
            <a href="#book" data-book-tab="fbc" class="bt-book-link inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
              Book at Davies
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            <a href="https://www.google.com/maps/search/?api=1&amp;query=Davies+Pharmacy+12+West+Street+Havant+PO9+1PF" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-blue-700 font-semibold border-2 border-blue-200 px-6 py-3 rounded-full hover:bg-blue-50 transition-colors font-jost">
              Get directions
            </a>
          </div>
        </div>
        <div class="rounded-2xl overflow-hidden aspect-[4/3] shadow-md">
          <img src="<?php echo esc_url( $bt_davies_img ); ?>" alt="<?php echo esc_attr( $bt_davies_alt ); ?>" class="w-full h-full object-cover" loading="lazy" />
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S6: HOW IT WORKS
     ============================================================ -->
<section class="py-16 md:py-24" style="background: linear-gradient(180deg,#f8fafc 0%,#eff6ff 50%,#dbeafe 100%);">
  <div class="section-container">
    <div class="text-center mb-12 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Simple &amp; Fast</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">How It Works</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 yf-reveal">
      <?php
      $bt_steps = [
          [ 'n' => '1', 'title' => 'Book Online', 'desc' => 'Choose your test and a convenient time at Davies Pharmacy, Havant. No GP referral needed.' ],
          [ 'n' => '2', 'title' => 'Quick Appointment', 'desc' => 'Visit Davies Pharmacy in Havant. Your sample is taken by trained staff in a discreet, professional setting.' ],
          [ 'n' => '3', 'title' => 'Lab Analysis', 'desc' => 'Your sample is analysed and results are typically ready within 24&ndash;48 hours.' ],
          [ 'n' => '4', 'title' => 'Results &amp; Advice', 'desc' => 'Your pharmacist explains your results and any recommended next steps.' ],
      ];
      foreach ( $bt_steps as $st ) : ?>
      <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <div class="w-11 h-11 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg font-jost mb-4"><?php echo $st['n']; ?></div>
        <h3 class="text-lg font-bold text-gray-900 mb-2 font-jost"><?php echo $st['title']; ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed font-jost"><?php echo $st['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     S7: BOOKING — per-test Amelia calendars (tabbed)
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="book">
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-8 md:mb-10">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Book Online</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 mb-6 font-jost">Book Your Blood Test</h2>
      <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-jost">Select a test below, then choose your time. All blood tests are carried out at our Davies Pharmacy, Havant.</p>
    </div>

    <!-- Test selector (Step 1) -->
    <div class="max-w-3xl mx-auto mb-10">
      <div class="flex items-center justify-center gap-3 mb-4">
        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-blue-600 text-white text-sm font-bold font-jost">1</span>
        <span class="text-sm font-bold uppercase tracking-[0.12em] text-blue-700 font-jost">Choose your test</span>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3" role="tablist">
        <?php foreach ( $bt_book_tabs as $bi => $tab ) : ?>
        <button type="button" class="bt-tab flex flex-col items-center justify-center gap-0.5 text-center font-semibold text-slate-700 bg-white border-2 border-[#e8e0d8] px-4 py-3.5 rounded-2xl hover:border-blue-300 hover:bg-blue-50 font-jost shadow-sm" role="tab" data-tab="<?php echo esc_attr( $tab['key'] ); ?>" aria-selected="<?php echo 0 === $bi ? 'true' : 'false'; ?>">
          <span class="text-sm md:text-base leading-tight"><?php echo esc_html( $tab['label'] ); ?></span>
          <span class="bt-tab-price text-xs font-bold text-blue-600"><?php echo esc_html( $tab['price'] ); ?></span>
          <span class="bt-tab-avail inline-flex items-center gap-1 text-[11px] mt-1 <?php echo $tab['davies_only'] ? 'text-blue-600 font-semibold' : 'text-slate-400 font-medium'; ?>">
            <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo esc_html( $tab['avail'] ); ?>
          </span>
        </button>
        <?php endforeach; ?>
      </div>
      <p class="flex items-center justify-center gap-2 text-sm text-slate-500 mt-5 font-jost">
        <svg class="w-4 h-4 text-blue-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        Then pick your time below
      </p>
    </div>

    <!-- Panels -->
    <?php foreach ( $bt_book_tabs as $bi => $tab ) : ?>
    <div class="bt-panel <?php echo 0 === $bi ? 'active' : ''; ?>" data-panel="<?php echo esc_attr( $tab['key'] ); ?>">
      <div class="flex items-start sm:items-center justify-center gap-2.5 max-w-2xl mx-auto mb-6 px-4 py-3 rounded-xl <?php echo $tab['davies_only'] ? 'bg-blue-50 border border-blue-100 text-blue-800' : 'bg-emerald-50 border border-emerald-100 text-emerald-800'; ?>">
        <svg class="w-4 h-4 flex-shrink-0 mt-0.5 sm:mt-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <p class="text-sm font-jost"><?php echo wp_kses( $tab['note'], [ 'strong' => [] ] ); ?></p>
      </div>
      <?php echo do_shortcode( $tab['shortcode'] ); ?>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============================================================
     S8: WHY CHOOSE — glass cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none opacity-40"></div>
  <div class="relative section-container">
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost">Why Southdowns</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost">Testing You Can Trust</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost">Professional blood testing on your doorstep, without the long GP wait.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 yf-reveal">
      <?php
      $bt_why = [
          [ 'title' => 'No GP Referral', 'desc' => 'Book any test directly &mdash; no referral, no waiting list.', 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/>' ],
          [ 'title' => 'Rapid Results', 'desc' => 'Results typically within 24&ndash;48 hours, explained by your pharmacist.', 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>' ],
          [ 'title' => 'GPhC-Registered Team', 'desc' => 'Every test is handled by qualified, regulated professionals.', 'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
          [ 'title' => 'Private &amp; Confidential', 'desc' => 'Discreet appointments and results handled in strict confidence.', 'icon' => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>' ],
          [ 'title' => 'Dedicated Phlebotomy Centre', 'desc' => 'Davies Pharmacy offers our full range under one roof.', 'icon' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>' ],
          [ 'title' => 'One Trusted Location', 'desc' => 'All blood testing at our Davies Pharmacy phlebotomy centre in Havant.', 'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/>' ],
      ];
      foreach ( $bt_why as $why ) : ?>
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
     S9: PRICING SNAPSHOT
     ============================================================ -->
<section class="py-16 md:py-24 bg-white">
  <div class="section-container">
    <div class="max-w-3xl mx-auto">
      <div class="text-center mb-10 yf-reveal">
        <div class="premium-badge flex items-center justify-center gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Transparent Pricing</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Blood Test Prices</h2>
      </div>
      <div class="space-y-3 yf-reveal mb-8">
        <?php foreach ( $bt_tests as $t ) : ?>
        <div class="flex items-center justify-between gap-4 bg-white rounded-2xl px-5 py-4 border border-gray-100 shadow-sm">
          <div>
            <span class="block text-gray-800 font-semibold font-jost"><?php echo esc_html( $t['name'] ); ?></span>
            <span class="block text-gray-400 text-xs font-jost"><?php echo esc_html( $t['avail'] ); ?></span>
          </div>
          <span class="text-blue-700 font-bold text-lg font-jost flex-shrink-0"><?php echo esc_html( $t['price'] ); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center yf-reveal">
        <a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>" class="inline-flex items-center gap-2 text-blue-700 font-semibold border-2 border-blue-200 px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors font-jost">
          View Full Price List
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S10: FAQ — sticky sidebar + accordion
     ============================================================ -->
<section id="faq" class="py-16 md:py-24" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
  <div class="section-container">
    <div class="grid lg:grid-cols-[340px_1fr] gap-12 lg:gap-16 items-start">
      <div class="lg:sticky lg:top-28 yf-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">FAQs</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Blood Testing FAQs</h2>
        <p class="text-gray-600 mb-8 font-jost">Common questions about our private blood testing across Hampshire.</p>
        <a href="#book" data-book-tab="fbc" class="bt-book-link inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20 w-full justify-center">
          Book a Blood Test
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
      <div class="space-y-3 yf-reveal" data-delay="2">
        <?php foreach ( $bt_faqs as $faq ) : ?>
        <details class="bt-faq-item">
          <summary class="bt-faq-question font-jost">
            <?php echo esc_html( $faq['q'] ); ?>
            <svg class="bt-faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </summary>
          <div class="bt-faq-answer"><?php echo esc_html( $faq['a'] ); ?></div>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     S11: CLOSING CTA
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="relative section-container text-center">
    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost">Take Control of Your Health</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost">Fast, private blood testing with expert pharmacist support &mdash; no GP referral, rapid results. Book your test today.</p>
    </div>
    <div class="flex flex-wrap justify-center gap-4 yf-reveal" data-delay="2">
      <a href="#book" data-book-tab="fbc" class="bt-book-link inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Book a Blood Test
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Medical disclaimer strip -->
<div class="bg-slate-100 border-t border-slate-200 py-6">
  <div class="section-container">
    <p class="text-xs text-slate-500 text-center leading-relaxed font-jost max-w-4xl mx-auto">Our blood tests are private screening services and are not a substitute for advice from your GP or a diagnosis. If you have urgent or serious health concerns, please contact your GP or NHS 111. Test availability, sample type and any preparation (such as fasting) are confirmed at the point of booking.</p>
  </div>
</div>

<?php
// ── FAQPage JSON-LD ──
$bt_faq_ldjson = [];
foreach ( $bt_faqs as $faq ) {
    $bt_faq_ldjson[] = [
        '@type'          => 'Question',
        'name'           => wp_strip_all_tags( $faq['q'] ),
        'acceptedAnswer' => [ '@type' => 'Answer', 'text' => wp_strip_all_tags( $faq['a'] ) ],
    ];
}
$bt_ldjson = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $bt_faq_ldjson ];
?>
<script type="application/ld+json"><?php echo wp_json_encode( $bt_ldjson ); ?></script>

<!-- Booking tab switch + scroll-reveal JS -->
<script>
(function() {
  'use strict';
  // Booking tabs
  var tabs   = document.querySelectorAll('.bt-tab');
  var panels = document.querySelectorAll('.bt-panel');
  function activate(key) {
    tabs.forEach(function(t) { t.setAttribute('aria-selected', t.getAttribute('data-tab') === key ? 'true' : 'false'); });
    panels.forEach(function(p) { p.classList.toggle('active', p.getAttribute('data-panel') === key); });
    // Amelia calendars are built on load; those inside a hidden tab measure zero
    // width and render collapsed. Firing resize once shown forces a re-layout.
    window.dispatchEvent(new Event('resize'));
    requestAnimationFrame(function() { window.dispatchEvent(new Event('resize')); });
    setTimeout(function() { window.dispatchEvent(new Event('resize')); }, 150);
  }
  tabs.forEach(function(t) {
    t.addEventListener('click', function() { activate(t.getAttribute('data-tab')); });
  });
  // Card / CTA "Book" links activate the matching tab, then scroll to #book
  document.querySelectorAll('.bt-book-link').forEach(function(link) {
    link.addEventListener('click', function(e) {
      var key = link.getAttribute('data-book-tab');
      if (key) { activate(key); }
      var target = document.getElementById('book');
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
  });

  // Scroll reveal
  var els = document.querySelectorAll('.yf-reveal');
  if (els.length && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries) {
      entries.forEach(function(en) {
        if (en.isIntersecting) { en.target.classList.add('visible'); io.unobserve(en.target); }
      });
    }, { threshold: 0.12 });
    els.forEach(function(el) { io.observe(el); });
  } else {
    els.forEach(function(el) { el.classList.add('visible'); });
  }
})();
</script>

<?php get_footer();
