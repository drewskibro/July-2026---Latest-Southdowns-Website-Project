<?php
/**
 * Template Name: Private COVID-19 Vaccine
 *
 * Select this template on the Private COVID-19 Vaccine page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// ── ACF-backed copy (with hardcoded fallbacks) ─────────────────────────────
$cvp_hero_badge     = sp_field( 'cv_priv_hero_badge',    'Private COVID-19 Vaccination · Hampshire' );
$cvp_hero_headline  = sp_field( 'cv_priv_hero_headline', 'Private COVID-19 Vaccine in Hampshire &mdash; Available Today' );
$cvp_hero_body      = sp_field( 'cv_priv_hero_body',     'Not eligible for the NHS COVID-19 vaccine this season? Southdowns Pharmacy offers private COVID-19 vaccination using the latest Pfizer vaccine &mdash; no eligibility criteria, no waiting list, no GP referral needed. Walk in or book online at any of our four Hampshire locations.' );
$cvp_price          = sp_field( 'cv_priv_price',         '£89.50' );
$cvp_price_label    = sp_field( 'cv_priv_price_label',   'per person · all-inclusive' );
$cvp_final_headline = sp_field( 'cv_priv_final_cta_headline', 'Stay Protected.<br>Book Your Private<br>COVID-19 Vaccine Today.' );
$cvp_final_body     = sp_field( 'cv_priv_final_cta_body',     'No waiting lists. No eligibility criteria. Just the Pfizer vaccine, administered by our expert team — at a time that suits you.' );

// Repeater: pricing card inclusions
$cvp_inclusions_raw = function_exists( 'get_field' ) ? get_field( 'cv_priv_inclusions' ) : null;
$cvp_inclusions     = ! empty( $cvp_inclusions_raw ) ? array_column( $cvp_inclusions_raw, 'text' ) : [
    'Pfizer-BioNTech mRNA vaccine dose',
    'Pre-vaccination health consultation',
    'Post-vaccination observation period',
    'Personalised digital vaccination record',
];
?>

<!-- Page-scoped styles -->
<style>
  /* FAQ Accordion */
  .yf-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s ease; }
  .yf-faq-item.active .yf-faq-answer { max-height: 500px; }
  .yf-faq-item.active .yf-faq-icon { transform: rotate(45deg); }
  .yf-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }

  /* Scroll reveal */
  .yf-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .yf-reveal.visible { opacity: 1; transform: translateY(0); }
  .yf-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .yf-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .yf-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .yf-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .yf-reveal[data-delay="5"] { transition-delay: 0.5s; }

  /* Shimmer */
  @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
  .yf-shimmer { background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }

  /* Card hover lift */
  .yf-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .yf-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }

  /* Step number hover */
  .yf-step:hover .yf-step-num { transform: scale(1.15); box-shadow: 0 0 0 8px rgba(59,130,246,0.15); }
  .yf-step-num { transition: transform 0.3s ease, box-shadow 0.3s ease; }

  /* Animated gradient border for pricing card */
  @keyframes borderRotate { 0% { --angle: 0deg; } 100% { --angle: 360deg; } }
  @property --angle { syntax: '<angle>'; initial-value: 0deg; inherits: false; }
  .yf-glow-card { position: relative; background: white; border-radius: 1.25rem; overflow: hidden; }
  .yf-glow-card::before { content: ''; position: absolute; inset: -2px; border-radius: 1.35rem; background: conic-gradient(from var(--angle), #3b82f6, #93c5fd, #3b82f6); animation: borderRotate 4s linear infinite; z-index: -1; }

  /* FAQ item transitions */
  .yf-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .yf-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .yf-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }
</style>


<!-- ============================================================
     S1: HERO — 2-column split, matches homepage layout exactly
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-width image with overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&q=80&auto=format&fit=crop');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start">
      <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-blue-300"></span></span>
      <?php echo esc_html( $cvp_hero_badge ); ?>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo wp_kses_post( $cvp_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $cvp_hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Your COVID Vaccine
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <div class="flex flex-wrap gap-4 text-white/90 text-xs font-jost">
      <span>&#10003; <?php echo esc_html( $cvp_price ); ?> Per Dose</span>
      <span>&#10003; Latest Pfizer</span>
      <span>&#10003; Same Day Available</span>
    </div>
  </div>

  <!-- Desktop: 2-column split -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start">
        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-300"></span></span>
        <?php echo esc_html( $cvp_hero_badge ); ?>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo wp_kses_post( $cvp_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $cvp_hero_body ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Your COVID Vaccine
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#pricing" class="inline-flex items-center gap-2 text-white/80 text-sm font-medium px-5 py-3 rounded-full hover:text-white transition-colors font-jost">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          Check Pricing &amp; Availability
        </a>
      </div>
      <div class="flex flex-wrap gap-5 text-white text-sm font-jost">
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          GPhC Registered
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Latest Pfizer Vaccine
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          Same Day Available
        </span>
      </div>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&q=80&auto=format&fit=crop');"></div>
  </div>

</section>


<!-- ============================================================
     S2: STAT CARDS — Blue gradient, 4 glassmorphism stat cards
     ============================================================ -->
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="1">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $cvp_price ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">Per Dose</div>
      </div>

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="2">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">Pfizer</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">Latest Vaccine</div>
      </div>

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="3">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">No</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">NHS Eligibility Needed</div>
      </div>

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="4">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">Same</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">Day Appointments Available</div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S3: WHO IS IT FOR — Light gradient, intro + eligibility list
     ============================================================ -->
<section class="py-16 md:py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50/30 relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/30 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-100/20 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center yf-reveal">

      <div>
        <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-xs font-semibold px-4 py-2 rounded-full mb-6 border border-blue-100 uppercase tracking-wider">Who Is This For?</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost">Stay Protected &mdash; Even if You&apos;re Not NHS Eligible</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-5 font-jost">The NHS COVID-19 vaccination programme for Spring 2026 has narrowed its eligibility criteria, meaning many people who were vaccinated in previous seasons are no longer included. If you fall outside the current NHS cohorts but want to stay protected, our private vaccination service means you don&apos;t have to go without.</p>
        <p class="text-gray-600 text-base leading-relaxed mb-6 font-jost">The private COVID-19 vaccine at Southdowns Pharmacy is suitable for anyone who:</p>
        <ul class="space-y-3 mb-6">
          <?php
          $reasons = [
            'Is not currently eligible for a free NHS COVID-19 vaccine',
            'Wants protection ahead of travel to higher-risk destinations',
            'Has underlying health conditions and wants additional peace of mind outside the NHS programme',
            'Is a carer or lives with someone who is vulnerable and wants to reduce the risk of passing on the virus',
            'Simply wants to stay up to date with their COVID-19 protection',
          ];
          foreach ( $reasons as $r ) : ?>
          <li class="flex items-start gap-3 text-gray-700 font-jost">
            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
              <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo esc_html( $r ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <p class="text-blue-700 font-semibold text-base font-jost">No referral needed. No eligibility criteria. Just walk in or book online.</p>
      </div>

      <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
        <img src="https://images.unsplash.com/photo-1580060839134-75a5edca2e99?w=800&q=80&auto=format&fit=crop" alt="Pharmacist preparing vaccination" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">Open to All &mdash; No Eligibility Criteria</span>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S4 · PRICING  (dark, id="pricing")
════════════════════════════════════════════════════════ -->
<section id="pricing" class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.18) 0%,transparent 70%);"></div>
  <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(147,197,253,0.12) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10 text-center">
    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
      Transparent Pricing
    </span>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Simple, All-Inclusive Price</h2>
    <p class="text-blue-200 text-lg max-w-xl mx-auto mb-14 font-jost">One price covers everything — no hidden charges, no consultation fees.</p>

    <!-- Glowing price card -->
    <div class="flex justify-center mb-14">
      <div class="yf-glow-card rounded-3xl p-1 max-w-sm w-full">
        <div class="bg-slate-900 rounded-[1.25rem] px-8 py-10 flex flex-col items-center gap-6">
          <div class="text-center">
            <p class="text-blue-300 text-sm font-semibold uppercase tracking-widest font-jost mb-1">Private COVID-19 Vaccine</p>
            <p class="text-white font-bold font-jost" style="font-size:4rem;line-height:1;"><?php echo esc_html( $cvp_price ); ?></p>
            <p class="text-slate-400 text-sm font-jost mt-1"><?php echo esc_html( $cvp_price_label ); ?></p>
          </div>
          <ul class="w-full space-y-3">
            <?php foreach ( $cvp_inclusions as $inc ) : ?>
            <li class="flex items-center gap-3 text-slate-200 font-jost text-sm">
              <span class="flex-shrink-0 w-5 h-5 bg-blue-600/30 rounded-full flex items-center justify-center">
                <svg class="w-3 h-3 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              </span>
              <?php echo esc_html( $inc ); ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="w-full text-center bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3.5 rounded-xl font-jost transition-colors duration-200 shadow-lg shadow-blue-600/30">
            Book Now — <?php echo esc_html( $cvp_price ); ?>
          </a>
        </div>
      </div>
    </div>

    <p class="text-blue-300/70 text-sm font-jost max-w-lg mx-auto">Price correct as of Spring 2026. Subject to vaccine availability. Contact us for group or corporate pricing enquiries.</p>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S5 · THE VACCINE  (dark blue — proof-led redesign)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-1/4 left-0 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);"></div>
  <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.12) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"/></svg>
        About the Vaccine
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">The Pfizer-BioNTech COVID-19 Vaccine</h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost">An updated mRNA vaccine formulated against current circulating strains, with a proven track record of safety and effectiveness.</p>
    </div>

    <!-- Proof stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto mb-12">
      <?php
      $vaccine_stats = [
        [ 'value' => 'Billions', 'label' => 'of doses administered worldwide' ],
        [ 'value' => 'MHRA',     'label' => 'approved & continuously monitored' ],
        [ 'value' => 'Same',     'label' => 'Pfizer vaccine used by the NHS' ],
      ];
      foreach ( $vaccine_stats as $s ) : ?>
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-6 py-5 text-center">
        <p class="text-3xl md:text-4xl font-extrabold text-white font-jost leading-none mb-2"><?php echo esc_html( $s['value'] ); ?></p>
        <p class="text-blue-200 text-sm font-jost"><?php echo esc_html( $s['label'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Detail cards -->
    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <!-- Card 1 -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5" style="background:rgba(96,165,250,0.2);border:1px solid rgba(96,165,250,0.4);">
          <svg class="w-6 h-6 text-blue-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-3 font-jost">Why Pfizer?</h3>
        <ul class="space-y-2.5 text-white font-jost text-sm leading-relaxed">
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-blue-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Widely studied mRNA platform with extensive real-world safety data</li>
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-blue-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Updated to target dominant Omicron sub-variants</li>
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-blue-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>MHRA-approved and recommended by leading health authorities</li>
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-blue-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Same vaccine used in the NHS Spring 2026 programme</li>
        </ul>
      </div>

      <!-- Card 2 -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5" style="background:rgba(52,211,153,0.2);border:1px solid rgba(52,211,153,0.4);">
          <svg class="w-6 h-6 text-emerald-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-3 font-jost">Is It Safe?</h3>
        <p class="text-white font-jost text-sm mb-4 leading-relaxed">COVID-19 vaccines are among the most closely monitored medicines in history. The Pfizer vaccine has been given to billions of people worldwide.</p>
        <ul class="space-y-2.5 text-white font-jost text-sm leading-relaxed">
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-emerald-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Does not contain live virus and cannot give you COVID-19</li>
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-emerald-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>mRNA does not alter your DNA</li>
          <li class="flex items-start gap-2"><svg class="w-4 h-4 text-emerald-300 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Our pharmacists review your health history before administering</li>
        </ul>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S6 · SIDE EFFECTS  (dark)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-0 right-1/3 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        What to Expect
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Side Effects & After Care</h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost">Most side effects are mild and resolve within a couple of days — they are a sign your immune system is responding.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <!-- Common side effects -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
        <h3 class="text-xl font-bold text-white mb-5 font-jost">Common Side Effects</h3>
        <ul class="space-y-3">
          <?php
          $common_se = [
            'Soreness, redness or swelling at the injection site',
            'Feeling tired or fatigued',
            'Headache',
            'Muscle aches and chills',
            'Fever (temperature above 37.8°C)',
            'Feeling or being sick (nausea)',
          ];
          foreach ( $common_se as $se ) : ?>
          <li class="flex items-start gap-3 text-white font-jost text-sm leading-relaxed">
            <span class="flex-shrink-0 w-5 h-5 bg-blue-500/30 rounded-full flex items-center justify-center mt-0.5">
              <svg class="w-3 h-3 text-blue-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo esc_html( $se ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <p class="text-blue-200 text-xs mt-5 font-jost">These typically resolve within 1–2 days. Rest and paracetamol can help.</p>
      </div>

      <!-- When to seek advice -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
        <h3 class="text-xl font-bold text-white mb-5 font-jost">When to Seek Advice</h3>
        <p class="text-white font-jost text-sm mb-5">Serious reactions are very rare. Contact 111 or seek urgent care if you experience:</p>
        <ul class="space-y-3">
          <?php
          $urgent_se = [
            'Difficulty breathing or shortness of breath',
            'Swelling of the face, lips, tongue or throat',
            'Chest pain or a rapid or irregular heartbeat',
            'Feeling faint or collapse',
            'Symptoms that do not improve after 2–3 days',
          ];
          foreach ( $urgent_se as $se ) : ?>
          <li class="flex items-start gap-3 text-white font-jost text-sm leading-relaxed">
            <span class="flex-shrink-0 w-5 h-5 bg-amber-500/30 rounded-full flex items-center justify-center mt-0.5">
              <svg class="w-3 h-3 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo esc_html( $se ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="mt-5 bg-amber-400/15 border border-amber-400/30 rounded-xl px-4 py-3">
          <p class="text-amber-100 text-xs font-jost">In an emergency always call <strong class="text-white">999</strong>. For urgent but non-emergency concerns call <strong class="text-white">111</strong>.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S7 · WHY SOUTHDOWNS  (blue gradient, premium glassmorphism)
════════════════════════════════════════════════════════ -->
<?php
$cvp_why_cards = [
    [
        'title' => 'GPhC-Registered Pharmacists',
        'desc'  => 'Every dose is administered by a fully qualified, GPhC-registered pharmacist prescriber — never a technician or trainee.',
        'icon'  => [ 'rgba(16,185,129,0.25)', 'rgba(52,211,153,0.5)', '#6ee7b7', '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>' ],
    ],
    [
        'title' => 'Same-Day Appointments',
        'desc'  => 'Walk in or book online for a same-day slot — most patients are seen, vaccinated and out the door within 20 minutes.',
        'icon'  => [ 'rgba(6,182,212,0.25)', 'rgba(34,211,238,0.5)', '#67e8f9', '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>' ],
    ],
    [
        'title' => 'Four Convenient Locations',
        'desc'  => 'Branches in Emsworth, Havant, Davies Pharmacy and Rowlands Castle — there is always a Southdowns near you.',
        'icon'  => [ 'rgba(244,63,94,0.25)', 'rgba(253,164,175,0.5)', '#fda4af', '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>' ],
    ],
    [
        'title' => 'Genuine Pfizer Vaccine',
        'desc'  => 'Authentic, MHRA-approved Pfizer stock only — stored and handled to manufacturer cold-chain standards.',
        'icon'  => [ 'rgba(245,158,11,0.25)', 'rgba(252,211,77,0.5)', '#fcd34d', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
    ],
    [
        'title' => 'All-Inclusive Pricing',
        'desc'  => 'One transparent fee covers everything — consultation, vaccine, observation and your digital record. No hidden extras, no surprises.',
        'icon'  => [ 'rgba(139,92,246,0.25)', 'rgba(196,181,253,0.5)', '#c4b5fd', '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>' ],
    ],
    [
        'title' => 'Peace of Mind, Same Day',
        'desc'  => 'No referral, no waiting list, no paperwork chase — walk in and leave protected the same morning.',
        'icon'  => [ 'rgba(249,115,22,0.25)', 'rgba(253,186,116,0.5)', '#fdba74', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>' ],
    ],
];
?>
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost">Our Promise to You</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Why Choose Southdowns Pharmacy?</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">Authentic Pfizer stock, GPhC-registered prescribers, and four Hampshire locations — private COVID protection without the wait.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $cvp_why_cards as $i => $card ) :
        $icon  = $card['icon'];
      ?>
      <div class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:<?php echo $icon[0]; ?>;border:1px solid <?php echo $icon[1]; ?>;">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="<?php echo $icon[2]; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icon[3]; ?></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-blue-100 leading-relaxed font-jost"><?php echo esc_html( $card['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S8 · HOW TO BOOK  (dark, id="how-to-book")
════════════════════════════════════════════════════════ -->
<section id="how-to-book" class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute bottom-0 left-1/4 w-80 h-80 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.18) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Getting Started
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">How to Book Your Vaccine</h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost">Three easy ways to secure your appointment — choose whatever works best for you.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto mb-10">
      <?php
      $book_steps = [
        [
          'num'      => '01',
          'title'    => 'Book Online',
          'tagline'  => 'Done in under 60 seconds',
          'desc'     => 'Choose your branch, pick a slot, confirm — our booking system is open 24/7 and you will receive instant confirmation.',
          'icon'     => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>',
        ],
        [
          'num'      => '02',
          'title'    => 'Call Your Branch',
          'tagline'  => 'Speak to a pharmacist',
          'desc'     => 'Prefer a conversation? Our team will answer your questions and find you a slot that fits around your day.',
          'icon'     => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 17l-.08-.08z"/>',
        ],
        [
          'num'      => '03',
          'title'    => 'Walk In',
          'tagline'  => 'Often seen the same day',
          'desc'     => 'No appointment? Pop into any of our four Hampshire branches — subject to availability, we will do our best to fit you in.',
          'icon'     => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
        ],
      ];
      foreach ( $book_steps as $step ) : ?>
      <div class="group relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 overflow-hidden hover:bg-white/15 hover:-translate-y-1 transition-all duration-300 reveal-item">
        <span aria-hidden="true" class="absolute -top-4 -right-2 text-[7rem] leading-none font-extrabold text-white/5 font-jost select-none pointer-events-none group-hover:text-white/10 transition-colors"><?php echo esc_html( $step['num'] ); ?></span>
        <div class="relative z-10">
          <div class="w-12 h-12 rounded-xl bg-blue-500/20 border border-blue-400/30 flex items-center justify-center mb-5">
            <svg class="w-6 h-6 text-blue-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $step['icon']; ?></svg>
          </div>
          <h3 class="text-xl font-bold text-white mb-1.5 font-jost"><?php echo esc_html( $step['title'] ); ?></h3>
          <p class="text-blue-300 text-xs font-semibold uppercase tracking-wider font-jost mb-3"><?php echo esc_html( $step['tagline'] ); ?></p>
          <p class="text-white/90 text-sm leading-relaxed font-jost"><?php echo esc_html( $step['desc'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Info box -->
    <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-7 py-5 flex items-start gap-4">
      <svg class="w-6 h-6 text-blue-300 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <p class="text-blue-100 text-sm font-jost"><strong class="text-white">Your appointment takes around 15–20 minutes.</strong> This includes a brief health consultation, the injection, and a short observation period. Please bring any relevant medical history or a list of current medications.</p>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S9 · NHS ELIGIBLE?  (light)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 bg-slate-50">
  <div class="section-container">
    <div class="max-w-3xl mx-auto text-center">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Free NHS Vaccine
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-5 font-jost">Could You Get the Vaccine Free on the NHS?</h2>
      <p class="text-slate-600 text-lg mb-6 font-jost">For Spring 2026, the NHS COVID-19 programme is available free of charge to people aged 75 and over, care home residents, and those who are severely immunosuppressed. If you think you may be eligible, it is worth checking before booking a private appointment.</p>
      <div class="bg-blue-50 border border-blue-100 rounded-2xl px-8 py-6 mb-8 text-left">
        <p class="text-blue-900 font-semibold font-jost mb-3">You may be eligible for a free NHS COVID-19 vaccine if you are:</p>
        <ul class="space-y-2 text-slate-700 font-jost text-sm">
          <li class="flex items-center gap-2"><svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Aged 75 or over</li>
          <li class="flex items-center gap-2"><svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>A resident in a care home for older adults</li>
          <li class="flex items-center gap-2"><svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Aged 6 months or over with a severely weakened immune system</li>
        </ul>
      </div>
      <a href="/covid-19-vaccine/" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3.5 rounded-xl font-jost transition-colors duration-200 shadow-md">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Learn About the NHS COVID-19 Vaccine
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S10 · LOCATIONS  (white, id="locations")
════════════════════════════════════════════════════════ -->
<section id="locations" class="py-20 md:py-28 bg-white">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        Find Us
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost">Our Pharmacy Locations</h2>
      <p class="text-slate-600 text-lg max-w-2xl mx-auto font-jost">Private COVID-19 vaccinations are available at all four Southdowns Pharmacy branches across Hampshire.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php for ( $i = 1; $i <= 4; $i++ ) :
        $b = sp_branch( $i );
        $addr = trim( $b['address_line1'] . ( $b['address_line2'] ? ', ' . $b['address_line2'] : '' ) );
        if ( '' === $addr ) { $addr = $b['city']; }
      ?>
      <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b['name'] ); ?> pharmacy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <h3 class="text-white text-xl font-bold font-jost"><?php echo esc_html( $b['name'] ); ?></h3>
          </div>
        </div>
        <div class="p-5 flex flex-col flex-1">
          <div class="flex items-start gap-2 mb-2">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-gray-600 text-sm font-jost"><?php echo esc_html( $addr ); ?></span>
          </div>
          <div class="flex items-start gap-2 mb-4">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <span class="text-gray-400 text-xs font-jost leading-relaxed"><?php echo sp_branch_hours_html( $b ); ?></span>
          </div>
          <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="mt-auto flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Book COVID Vaccine
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S11 · FAQ  (light gradient, id="faq")
════════════════════════════════════════════════════════ -->
<section id="faq" class="py-20 md:py-28" style="background: linear-gradient(180deg, #f8fafc 0%, #eff6ff 100%);">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        Common Questions
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost">Frequently Asked Questions</h2>
      <p class="text-slate-600 text-lg max-w-xl mx-auto font-jost">Everything you need to know about the private COVID-19 vaccine service at Southdowns Pharmacy.</p>
    </div>

    <div class="max-w-3xl mx-auto space-y-3">
      <?php
      $faqs = [
        [
          'q' => 'Why would I pay for a COVID-19 vaccine when the NHS offers one for free?',
          'a' => 'The NHS Spring 2026 programme is limited to specific high-risk groups. If you fall outside those groups but still want protection — perhaps before a holiday, because of personal health circumstances, or simply for peace of mind — our private service gives you access to the same Pfizer vaccine without a referral or eligibility check.',
        ],
        [
          'q' => 'Is the private vaccine the same as the NHS vaccine?',
          'a' => 'Yes. We use the same Pfizer-BioNTech mRNA vaccine that is used in the NHS programme. The only difference is that you pay for the service privately, which makes it available regardless of your age or health status.',
        ],
        [
          'q' => 'How long does immunity last after the vaccine?',
          'a' => 'Protection from COVID-19 vaccines wanes over time, typically over a period of months. The vaccine is most effective in the period immediately after administration. If you received a previous COVID-19 vaccine, your immune system should still mount a strong boosted response.',
        ],
        [
          'q' => 'Can I have the vaccine if I have had COVID-19 recently?',
          'a' => 'Current UKHSA guidance suggests waiting at least 4 weeks after a confirmed COVID-19 infection before receiving a vaccine dose, as natural immunity provides some short-term protection. Our pharmacist will advise you on this during your pre-vaccination consultation.',
        ],
        [
          'q' => 'Is there anything I need to do to prepare for my appointment?',
          'a' => 'No special preparation is needed. It helps to wear loose clothing that gives easy access to your upper arm. Please bring a list of any current medications or known allergies. Eating and drinking normally beforehand is absolutely fine.',
        ],
        [
          'q' => 'Who should NOT receive the COVID-19 vaccine?',
          'a' => 'You should not receive the vaccine if you have had a confirmed severe allergic reaction (anaphylaxis) to a previous dose of the same vaccine or to any of its ingredients. Our pharmacist will conduct a health check before your vaccination to ensure it is suitable for you.',
        ],
        [
          'q' => 'Can I have this vaccine alongside other vaccinations, such as flu or travel vaccines?',
          'a' => 'Yes — COVID-19 vaccines can generally be given at the same time as other vaccines, including flu and travel vaccines such as yellow fever. Our pharmacist can advise on the best schedule during your consultation.',
        ],
        [
          'q' => 'Do you offer the vaccine for children?',
          'a' => 'Our private COVID-19 vaccination service is available to adults aged 18 and over. If you have concerns about COVID-19 vaccination for a child, please speak to your GP or contact the NHS for guidance.',
        ],
      ];
      foreach ( $faqs as $idx => $faq ) : $n = $idx + 1; ?>
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden reveal-item">
        <button class="yf-faq-trigger w-full flex items-center justify-between gap-4 px-6 py-5 text-left" aria-expanded="false">
          <span class="flex items-center gap-3">
            <span class="flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xs font-jost"><?php echo $n; ?></span>
            <span class="font-semibold text-slate-900 font-jost"><?php echo esc_html( $faq['q'] ); ?></span>
          </span>
          <span class="yf-faq-icon flex-shrink-0 w-7 h-7 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 transition-transform duration-300">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
          </span>
        </button>
        <div class="yf-faq-answer hidden px-6 pb-5">
          <div class="pl-10 text-slate-600 font-jost text-sm leading-relaxed"><?php echo esc_html( $faq['a'] ); ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S12 · FINAL CTA  (dark, id="book")
════════════════════════════════════════════════════════ -->
<section id="book" class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.2) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10 text-center">
    <div class="flex flex-wrap justify-center gap-2 mb-8">
      <?php
      $badges = [
        'Pfizer-BioNTech Vaccine',
        'MHRA Approved',
        'GPhC-Registered Pharmacists',
        'Same-Day Availability',
        'All-Inclusive Pricing',
      ];
      foreach ( $badges as $badge ) : ?>
      <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold font-jost bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-3.5 h-3.5 text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        <?php echo esc_html( $badge ); ?>
      </span>
      <?php endforeach; ?>
    </div>

    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-5 font-jost leading-tight"><?php echo wp_kses_post( $cvp_final_headline ); ?></h2>
    <p class="text-blue-200 text-lg max-w-xl mx-auto mb-10 font-jost"><?php echo wp_kses_post( $cvp_final_body ); ?></p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
      <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-xl font-jost hover:bg-blue-50 transition-colors duration-200 shadow-xl shadow-blue-900/30 text-lg">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Book Your Appointment
      </a>
      <a href="tel:<?php echo esc_attr( sp_phone_raw() ); ?>" class="inline-flex items-center justify-center gap-2 bg-white/15 backdrop-blur-sm text-white font-bold px-8 py-4 rounded-xl font-jost border border-white/30 hover:bg-white/25 transition-colors duration-200 text-lg">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 17l-.08-.08z"/></svg>
        <?php echo esc_html( sp_phone() ); ?>
      </a>
    </div>

    <!-- Trust row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto border-t border-white/10 pt-10">
      <?php
      $trust_stats = [
        [ 'value' => '4',         'label' => 'Hampshire Locations' ],
        [ 'value' => 'Same Day',  'label' => 'Appointments Available' ],
        [ 'value' => 'GPhC',      'label' => 'Registered Pharmacists' ],
        [ 'value' => 'Pfizer',    'label' => 'mRNA Vaccine' ],
      ];
      foreach ( $trust_stats as $stat ) : ?>
      <div class="text-center">
        <p class="text-3xl font-extrabold text-white font-jost"><?php echo esc_html( $stat['value'] ); ?></p>
        <p class="text-blue-300 text-sm mt-1 font-jost"><?php echo esc_html( $stat['label'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     MEDICAL DISCLAIMER
════════════════════════════════════════════════════════ -->
<div class="bg-slate-100 border-t border-slate-200 py-6">
  <div class="section-container">
    <p class="text-slate-500 text-xs font-jost text-center leading-relaxed max-w-4xl mx-auto">
      <strong>Medical Disclaimer:</strong> The information on this page is for general guidance only and does not constitute medical advice. Vaccine suitability is assessed on an individual basis by our pharmacist at the time of your appointment. COVID-19 vaccines carry a small risk of side effects; serious adverse reactions are rare but possible. If you have concerns about your suitability for vaccination, please speak to your GP or a qualified healthcare professional. Southdowns Pharmacy follows all current MHRA, UKHSA, and JCVI guidance.
    </p>
  </div>
</div>


<!-- ═══════════════════════════════════════════════════════
     JAVASCRIPT — FAQ Accordion + Scroll Reveal
════════════════════════════════════════════════════════ -->
<script>
(function () {
  'use strict';

  /* FAQ accordion */
  document.querySelectorAll('.yf-faq-trigger').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var answer = btn.nextElementSibling;
      var icon   = btn.querySelector('.yf-faq-icon');
      var open   = btn.getAttribute('aria-expanded') === 'true';

      /* close all */
      document.querySelectorAll('.yf-faq-trigger').forEach(function (b) {
        b.setAttribute('aria-expanded', 'false');
        b.nextElementSibling.classList.add('hidden');
        b.querySelector('.yf-faq-icon').style.transform = 'rotate(0deg)';
      });

      if (!open) {
        btn.setAttribute('aria-expanded', 'true');
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
      }
    });
  });

  /* Scroll reveal: .reveal-item (JS-driven inline opacity) */
  var items = document.querySelectorAll('.reveal-item');
  if (items.length) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.style.opacity  = '1';
          entry.target.style.transform = 'translateY(0)';
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    items.forEach(function (el) {
      el.style.opacity   = '0';
      el.style.transform = 'translateY(24px)';
      el.style.transition = 'opacity 0.55s ease, transform 0.55s ease';
      io.observe(el);
    });
  }

  /* Scroll reveal: .yf-reveal (CSS-driven via .visible class) */
  var yfItems = document.querySelectorAll('.yf-reveal');
  if (yfItems.length) {
    if (!('IntersectionObserver' in window)) {
      yfItems.forEach(function (el) { el.classList.add('visible'); });
    } else {
      var yfIo = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            yfIo.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12 });
      yfItems.forEach(function (el) { yfIo.observe(el); });
    }
  }
}());
</script>

<?php get_footer(); ?>
