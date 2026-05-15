<?php
/**
 * Template Name: Blood Pressure Checks
 *
 * Free NHS blood pressure check service page.
 * URL slug: /blood-pressure-checks/
 */

get_header();

$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// ACF image fields — lifestyle (not clinical) photography
$bp_hero_img      = sp_field( 'bp_hero_image', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&q=80&auto=format&fit=crop' );
/* TODO: swap $bp_hero_img for a warm lifestyle photo of a pharmacist taking someone's blood pressure in a pharmacy setting */

$bp_condition_img = sp_field( 'bp_condition_image', 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=800&q=80&auto=format&fit=crop' );
/* TODO: swap $bp_condition_img for a lifestyle image (person walking outdoors, healthy food spread, or relaxing) — not clinical */

// Roundel font stack (exact pattern from page-emsworth.php)
$bp_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
$bp_txt  = "font-family:{$bp_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";
?>

<!-- Page-scoped styles -->
<style>
  /* FAQ accordion */
  .bp-faq-item { border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s; background: #fff; }
  .bp-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); }
  .bp-faq-item[open] { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); }
  .bp-faq-question { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; font-weight: 600; font-size: 1.05rem; color: #1e293b; list-style: none; font-family: 'Jost', sans-serif; }
  .bp-faq-question::-webkit-details-marker { display: none; }
  .bp-faq-chevron { transition: transform 0.3s; flex-shrink: 0; margin-left: 1rem; }
  .bp-faq-item[open] .bp-faq-chevron { transform: rotate(180deg); }
  .bp-faq-answer { padding: 0 1.5rem 1.25rem; color: #4b5563; line-height: 1.7; font-family: 'Jost', sans-serif; font-size: 0.95rem; }
</style>


<!-- ============================================================
     S1: HERO — 2-column split (blue left, image right) + 3 roundels
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-bleed image + gradient overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center"
       style="background-image: url('<?php echo esc_url( $bp_hero_img ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
      FREE NHS BLOOD PRESSURE CHECKS &bull; HAMPSHIRE
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;">Know Your Numbers. Protect Your Heart.</h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost">Free NHS blood pressure checks at all four Southdowns branches across Hampshire &mdash; no appointment needed, results in minutes.</p>
    <div class="flex flex-wrap gap-3">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book a Free Check
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full border border-white/20 font-jost">
        Call Us: <?php echo esc_html( $phone ); ?>
      </a>
    </div>
  </div>

  <!-- Desktop: two-column split -->
  <div class="hidden md:flex relative">

    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        FREE NHS BLOOD PRESSURE CHECKS &bull; HAMPSHIRE
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-6 font-jost" style="line-height:1.1;">Know Your Numbers. Protect Your Heart.</h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost">Free NHS blood pressure checks at all four Southdowns branches across Hampshire. No appointment needed &mdash; walk in and get your results in minutes.</p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book a Free Check
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center gap-2 text-white/80 text-base font-medium hover:text-white transition-colors font-jost">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          <?php echo esc_html( $phone ); ?>
        </a>
      </div>
      <!-- Trust strip -->
      <div class="flex flex-wrap gap-x-5 gap-y-2 text-white text-sm font-medium font-jost">
        <?php
        $bp_trust = [ 'No Appointment Needed', 'GPhC Registered', 'Free NHS Service', 'Same-Day Results' ];
        foreach ( $bp_trust as $item ) : ?>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php echo $item; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Right: hero image -->
    <!-- TODO: replace Unsplash placeholder with a lifestyle pharmacy/BP check image (warm tones, not clinical) -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center"
         style="background-image: url('<?php echo esc_url( $bp_hero_img ); ?>');"></div>

    <!-- Roundel 1 — FREE CHECK / NHS SERVICE (top, white/navy, 132px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:12%;transform:translateX(-50%);">
      <div style="
        width:132px;height:132px;border-radius:50%;
        background:#fff;
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        <span style="<?php echo $bp_txt; ?>font-size:15px;font-weight:800;color:#1e3a8a;line-height:1.1;letter-spacing:-0.01em;">FREE</span>
        <span style="<?php echo $bp_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">CHECK</span>
        <span style="<?php echo $bp_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">NHS Service</span>
      </div>
    </div>

    <!-- Roundel 2 — NO APPOINTMENT / WALK IN (centre, red gradient, 148px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="
        width:148px;height:148px;border-radius:50%;
        background:linear-gradient(135deg,#dc2626 0%,#b91c1c 50%,#7f1d1d 100%);
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px rgba(220,38,38,0.5),0 0 0 6px rgba(255,255,255,0.5),0 8px 32px rgba(220,38,38,0.35),0 2px 8px rgba(0,0,0,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
        <span style="<?php echo $bp_txt; ?>font-size:12px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.01em;">NO</span>
        <span style="<?php echo $bp_txt; ?>font-size:12px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.01em;">APPOINTMENT</span>
        <span style="<?php echo $bp_txt; ?>font-size:11px;font-weight:700;color:rgba(255,255,255,0.9);line-height:1.2;letter-spacing:-0.01em;">WALK IN</span>
        <span style="<?php echo $bp_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.75);line-height:1.3;margin-top:3px;">All 4 Branches</span>
      </div>
    </div>

    <!-- Roundel 3 — ALL 4 / BRANCHES (bottom, white/navy, 132px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:12%;transform:translateX(-50%);">
      <div style="
        width:132px;height:132px;border-radius:50%;
        background:#fff;
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span style="<?php echo $bp_txt; ?>font-size:15px;font-weight:800;color:#1e3a8a;line-height:1.1;letter-spacing:-0.01em;">ALL 4</span>
        <span style="<?php echo $bp_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">BRANCHES</span>
        <span style="<?php echo $bp_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Across Hampshire</span>
      </div>
    </div>

  </div>
</section>


<!-- ============================================================
     S2: STATS BAR — Blue gradient, 4 glassmorphism stat cards
     ============================================================ -->
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative section-container">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="1">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">1 in 3</div>
        <div class="text-sm text-blue-100 font-medium font-jost">UK Adults Affected</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="2">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">7M+</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Undiagnosed in UK</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="3">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">Free</div>
        <div class="text-sm text-blue-100 font-medium font-jost">NHS Check — No Charge</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="4">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">5 Min</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Quick, Painless Check</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/></svg>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S3: THE SILENT THREAT — Light, two-col (text left, image right)
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="about">
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/4 blur-3xl pointer-events-none"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-rose-100/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl pointer-events-none"></div>

  <div class="relative z-10 section-container">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      <!-- Text content -->
      <div class="yf-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-5">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">The Silent Threat</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-5 font-jost">High Blood Pressure: Understanding the Risk</h2>
        <p class="text-gray-600 leading-relaxed mb-4 font-jost">High blood pressure (hypertension) is one of the leading causes of <a href="https://www.nhs.uk/conditions/cardiovascular-disease/" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline underline-offset-2 hover:text-blue-700 font-medium">cardiovascular disease</a> in the UK, yet most people who have it experience no symptoms at all. It&rsquo;s often called &ldquo;the silent killer&rdquo; for this reason &mdash; by the time it&rsquo;s noticed, damage may already have been done.</p>
        <p class="text-gray-600 leading-relaxed mb-8 font-jost">Over 14 million people in the UK have high blood pressure, and an estimated 7 million of them don&rsquo;t know it. A simple 5-minute check at your local Southdowns Pharmacy could be one of the most important health steps you take this year.</p>

        <!-- 3 stat callouts -->
        <div class="grid grid-cols-3 gap-4 mb-8">
          <div class="bg-white rounded-2xl p-4 text-center shadow-sm border border-gray-100">
            <div class="text-2xl font-bold text-blue-600 mb-1 font-jost">14M+</div>
            <div class="text-xs text-gray-500 leading-snug font-jost">UK adults with high BP</div>
          </div>
          <div class="bg-white rounded-2xl p-4 text-center shadow-sm border border-gray-100">
            <div class="text-2xl font-bold text-rose-600 mb-1 font-jost">50%</div>
            <div class="text-xs text-gray-500 leading-snug font-jost">Don&rsquo;t know they have it</div>
          </div>
          <div class="bg-white rounded-2xl p-4 text-center shadow-sm border border-gray-100">
            <div class="text-2xl font-bold text-amber-600 mb-1 font-jost">#1</div>
            <div class="text-xs text-gray-500 leading-snug font-jost">Risk factor for stroke</div>
          </div>
        </div>

        <!-- Info note box -->
        <div class="rounded-xl p-5 flex items-start gap-3 border border-blue-100" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);">
          <div class="w-9 h-9 bg-blue-500/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/></svg>
          </div>
          <p class="text-blue-800 text-sm leading-relaxed font-jost"><strong>Regular monitoring is key.</strong> Even if you feel completely well, getting your blood pressure checked regularly is one of the simplest and most effective ways to protect your long-term health.</p>
        </div>
      </div>

      <!-- Image placeholder -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl yf-reveal" data-delay="2">
        <!-- TODO: replace with a lifestyle image of someone on a healthy walk or preparing nutritious food — warm and positive, not clinical -->
        <img src="<?php echo esc_url( $bp_condition_img ); ?>"
             alt="Healthy active lifestyle for heart health"
             class="w-full aspect-[4/3] object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">Protect Your Heart Health</span>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S4: RISK FACTORS — Dark navy, icon card grid (6 cards)
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="absolute top-0 right-1/3 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-white/20"></div>
        <span class="badge-text text-white/70 text-sm font-normal tracking-[0.15em] uppercase font-jost">Risk Factors</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Could You Be at Higher Risk?</h2>
      <p class="text-lg text-white leading-relaxed max-w-2xl mx-auto font-jost">Several everyday factors can quietly raise your blood pressure over time. Understanding your risk is the first step towards taking action.</p>
    </div>

    <?php
    $bp_risk_cards = [
        [
            'title'  => 'Age 40 or Over',
            'desc'   => 'Blood pressure tends to rise naturally as we age. The NHS recommends everyone over 40 gets checked every five years, and more often if readings are borderline.',
            'icon'   => '<circle cx="12" cy="8" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 20v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>',
            'colour' => 'rgba(59,130,246,0.3)',
        ],
        [
            'title'  => 'Family History',
            'desc'   => 'If a close relative has high blood pressure or heart disease, your own risk is significantly higher. Genetics play a real role in cardiovascular health.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
            'colour' => 'rgba(168,85,247,0.3)',
        ],
        [
            'title'  => 'High-Salt Diet',
            'desc'   => 'Eating too much salt is one of the most common causes of raised blood pressure. The average UK adult eats roughly double the recommended daily amount.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>',
            'colour' => 'rgba(245,158,11,0.3)',
        ],
        [
            'title'  => 'Being Overweight',
            'desc'   => 'Carrying excess weight puts additional strain on your heart and blood vessels. Even modest reductions in weight can lead to meaningful improvements in blood pressure.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>',
            'colour' => 'rgba(236,72,153,0.3)',
        ],
        [
            'title'  => 'Physical Inactivity',
            'desc'   => 'A sedentary lifestyle weakens the heart over time. Regular moderate exercise strengthens the cardiovascular system and helps keep blood pressure in a healthy range.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
            'colour' => 'rgba(16,185,129,0.3)',
        ],
        [
            'title'  => 'Alcohol & Smoking',
            'desc'   => 'Both alcohol and tobacco directly raise blood pressure and damage artery walls. Reducing or stopping either can produce rapid improvements in cardiovascular health.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>',
            'colour' => 'rgba(239,68,68,0.3)',
        ],
    ];
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
      <?php foreach ( $bp_risk_cards as $idx => $card ) : ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="<?php echo ( $idx % 3 ) + 1; ?>">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5" style="background:<?php echo $card['colour']; ?>;border:1px solid rgba(255,255,255,0.15);">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $card['icon']; ?></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-white text-sm leading-relaxed font-jost"><?php echo esc_html( $card['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Mid-section CTA -->
    <div class="flex justify-center yf-reveal">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Get Your Free Check Today
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S5: HOW TO REDUCE — Light, 6-card icon grid
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="reduce">
  <div class="absolute bottom-0 right-0 w-[500px] h-[400px] bg-blue-100/20 rounded-full translate-x-1/4 translate-y-1/4 blur-3xl pointer-events-none"></div>
  <div class="absolute top-0 left-0 w-64 h-64 bg-rose-100/15 rounded-full -translate-x-1/3 -translate-y-1/3 blur-3xl pointer-events-none"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Lifestyle Changes</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4 font-jost">Simple Steps to Healthier Blood Pressure</h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto font-jost">Small, consistent lifestyle changes can make a significant difference. Our pharmacists can guide you on the right steps for your situation.</p>
    </div>

    <?php
    $bp_reduce_cards = [
        [
            'title'  => 'Reduce Salt Intake',
            'desc'   => 'Aim for no more than 6g of salt per day. Check food labels and cook from scratch where possible. Even small reductions can lower blood pressure within weeks.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            'bg'     => 'bg-blue-50',
            'ring'   => 'ring-blue-200',
            'ico_col'=> 'text-blue-600',
        ],
        [
            'title'  => 'Regular Physical Activity',
            'desc'   => 'Aim for 150 minutes of moderate activity per week &mdash; brisk walking, cycling, or swimming. Consistent exercise is one of the most effective natural blood pressure treatments.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
            'bg'     => 'bg-green-50',
            'ring'   => 'ring-green-200',
            'ico_col'=> 'text-green-600',
        ],
        [
            'title'  => 'Healthy Weight',
            'desc'   => 'Losing even 5&ndash;10% of body weight if you&rsquo;re overweight can produce measurable improvements in blood pressure. Our pharmacy team can provide weight management guidance.',
            'icon'   => '<circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8M12 8v8"/>',
            'bg'     => 'bg-amber-50',
            'ring'   => 'ring-amber-200',
            'ico_col'=> 'text-amber-600',
        ],
        [
            'title'  => 'Limit Alcohol',
            'desc'   => 'Keep alcohol within NHS guidelines (no more than 14 units per week). Excessive drinking raises blood pressure and can interfere with blood pressure medications.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>',
            'bg'     => 'bg-purple-50',
            'ring'   => 'ring-purple-200',
            'ico_col'=> 'text-purple-600',
        ],
        [
            'title'  => 'Stop Smoking',
            'desc'   => 'Smoking temporarily raises blood pressure with each cigarette and damages artery walls long-term. Southdowns offers free NHS Stop Smoking support &mdash; ask your pharmacist.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
            'bg'     => 'bg-rose-50',
            'ring'   => 'ring-rose-200',
            'ico_col'=> 'text-rose-600',
        ],
        [
            'title'  => 'Manage Stress',
            'desc'   => 'Chronic stress keeps blood pressure elevated. Practical steps like better sleep, mindfulness, and regular breaks can all contribute to healthier readings over time.',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            'bg'     => 'bg-teal-50',
            'ring'   => 'ring-teal-200',
            'ico_col'=> 'text-teal-600',
        ],
    ];
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
      <?php foreach ( $bp_reduce_cards as $idx => $card ) : ?>
      <div class="yf-reveal yf-card-lift bg-white rounded-2xl p-7 shadow-sm border border-gray-100/80 group" data-delay="<?php echo ( $idx % 3 ) + 1; ?>">
        <div class="w-12 h-12 <?php echo $card['bg']; ?> ring-1 <?php echo $card['ring']; ?> rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 <?php echo $card['ico_col']; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $card['icon']; ?></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-2 font-jost"><?php echo $card['title']; ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed font-jost"><?php echo $card['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Pharmacist callout -->
    <div class="max-w-3xl mx-auto yf-reveal">
      <div class="rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center flex-shrink-0">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
        </div>
        <div class="flex-1 text-center md:text-left">
          <p class="text-white text-lg font-semibold mb-1 font-jost">Talk to your Southdowns pharmacist</p>
          <p class="text-blue-100 font-jost text-sm leading-relaxed">Our team can give personalised advice on blood pressure management and refer you to your GP if needed. Walk in to any branch, no appointment required.</p>
        </div>
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
          Get Advice
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: ELIGIBILITY — Dark navy, callout panel
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);" id="eligibility">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="absolute bottom-0 left-1/4 w-80 h-80 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.18) 0%,transparent 70%);"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-12 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-white/20"></div>
        <span class="badge-text text-white/70 text-sm font-normal tracking-[0.15em] uppercase font-jost">Check Eligibility</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Who Should Get a Blood Pressure Check?</h2>
      <p class="text-lg text-white max-w-2xl mx-auto font-jost">Our free NHS blood pressure service is open to almost everyone &mdash; and it only takes 5 minutes.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-10">

      <!-- Recommended for -->
      <div class="yf-reveal bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(34,197,94,0.25);border:1px solid rgba(34,197,94,0.4);">
            <svg class="w-6 h-6 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <h3 class="text-xl font-bold text-white font-jost">Recommended For</h3>
        </div>
        <ul class="space-y-3">
          <?php
          $bp_eligible = [
              'Adults aged 40 and over',
              'Anyone with a family history of heart disease or stroke',
              'People who are overweight or obese',
              'Those with a high-salt or unhealthy diet',
              'Anyone who smokes or drinks regularly',
              'People who are physically inactive',
              'Anyone who hasn\'t had a check in over a year',
          ];
          foreach ( $bp_eligible as $item ) : ?>
          <li class="flex items-center gap-3 text-white font-jost text-sm">
            <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html( $item ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- How often to check -->
      <div class="yf-reveal bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8" data-delay="2">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(59,130,246,0.25);border:1px solid rgba(59,130,246,0.4);">
            <svg class="w-6 h-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/></svg>
          </div>
          <h3 class="text-xl font-bold text-white font-jost">How Often to Check</h3>
        </div>
        <ul class="space-y-4">
          <?php
          $bp_frequency = [
              [ 'freq' => 'Every 5 years',   'desc' => 'For adults aged 40+ with no known risk factors or previous high readings.' ],
              [ 'freq' => 'Every year',       'desc' => 'If your reading is consistently in the higher normal range (130–139/85–89 mmHg).' ],
              [ 'freq' => 'Every 3–6 months', 'desc' => 'If you&rsquo;re being monitored for hypertension or are on blood pressure medication.' ],
              [ 'freq' => 'Immediately',      'desc' => 'If you experience severe headaches, blurred vision, chest pain, or dizziness.' ],
          ];
          foreach ( $bp_frequency as $f ) : ?>
          <li class="flex items-start gap-3 font-jost">
            <span class="inline-block mt-0.5 text-xs font-bold text-white bg-white/20 px-2.5 py-1 rounded-full flex-shrink-0"><?php echo esc_html( $f['freq'] ); ?></span>
            <span class="text-white text-sm leading-relaxed"><?php echo $f['desc']; ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>

    <!-- Walk-in callout -->
    <div class="max-w-3xl mx-auto yf-reveal" data-delay="1">
      <div class="bg-white/10 backdrop-blur-sm border border-white/25 rounded-2xl px-6 py-6 flex flex-col sm:flex-row items-center gap-5 text-center sm:text-left">
        <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
        </div>
        <div class="flex-1">
          <p class="text-white text-lg font-bold mb-1 font-jost">Walk In — No Appointment Needed</p>
          <p class="text-white text-sm leading-relaxed font-jost">Simply walk in to any of our four Hampshire branches during opening hours. The check takes around 5 minutes and results are immediate. No referral, no waiting room.</p>
        </div>
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
          Book Ahead
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>

  </div>
</section>


<!-- ============================================================
     S7: WHY CHOOSE SOUTHDOWNS — Blue gradient, 6-card glassmorphism
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative section-container">

    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Why Choose Us</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Why Patients Choose Southdowns</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost">Your local pharmacist &mdash; accessible, expert, and on your side.</p>
    </div>

    <?php
    $bp_why_cards = [
        [
            'title' => 'Free NHS Service',
            'desc'  => 'Blood pressure checks are completely free at all four branches. No charge, no private fee, no insurance required.',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        ],
        [
            'title' => 'No Appointment Needed',
            'desc'  => 'Walk in to any of our Hampshire branches at your convenience. No booking, no waiting weeks for an appointment.',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>',
        ],
        [
            'title' => 'Instant Results',
            'desc'  => 'Readings are immediate. Our pharmacist will discuss your results with you on the spot and advise on next steps where appropriate.',
            'icon'  => '<circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>',
        ],
        [
            'title' => 'Expert Pharmacist Advice',
            'desc'  => 'Our GPhC-registered pharmacists provide personalised guidance, lifestyle advice, and GP referrals when needed — not just a number on a screen.',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>',
        ],
        [
            'title' => '4 Local Hampshire Branches',
            'desc'  => 'Emsworth, Havant, Davies Pharmacy, and Rowlands Castle. Conveniently located so your nearest branch is never far away.',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
        ],
        [
            'title' => 'Linked to Your Care',
            'desc'  => 'We can share your results with your GP if required and help you manage any follow-up care. Your health, joined up.',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        ],
    ];
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $bp_why_cards as $idx => $card ) : ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="<?php echo ( $idx % 3 ) + 1; ?>">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $card['icon']; ?></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo $card['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ============================================================
     S8: FOUR LOCATION CARDS — White bg (exact weight loss pattern)
     ============================================================ -->
<section id="locations" class="py-16 md:py-24 bg-white">
  <div class="section-container">

    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Our Pharmacies</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Find Your Nearest Hampshire Branch</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">All four Southdowns branches offer free blood pressure checks. Walk in during opening hours &mdash; no appointment needed.</p>
    </div>

    <!-- Branch photo cards — exact weight loss component -->
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
            Book a Check Here
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endfor; ?>
    </div>

    <!-- Walk-in info banner -->
    <div class="mt-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 shadow-xl shadow-blue-500/15 yf-reveal">
      <div class="flex-shrink-0">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
          <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </div>
      </div>
      <div class="flex-1 text-center md:text-left">
        <p class="text-white text-lg font-semibold mb-1 font-jost">Walk in — no appointment needed</p>
        <p class="text-blue-100 text-base font-jost">All four branches offer free blood pressure checks during opening hours. Results take just 5 minutes and our pharmacist will talk you through what they mean.</p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        Book a Check
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S9: FAQ — Light gradient, sticky sidebar + accordion
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
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Blood Pressure Check FAQs</h2>
        <p class="text-gray-600 mb-8 font-jost">Common questions about our free NHS blood pressure service across Hampshire.</p>

        <!-- Sidebar trust stats -->
        <div class="grid grid-cols-2 gap-3 mb-8">
          <?php
          $bp_faq_stats = [
              [ 'value' => 'Free',   'label' => 'NHS Service' ],
              [ 'value' => '5 Min',  'label' => 'Quick Check' ],
              [ 'value' => 'Walk In', 'label' => 'No Appointment' ],
              [ 'value' => '4',      'label' => 'Branches' ],
          ];
          foreach ( $bp_faq_stats as $s ) : ?>
          <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-bold text-blue-600 font-jost"><?php echo esc_html( $s['value'] ); ?></div>
            <div class="text-xs text-gray-500 font-jost"><?php echo esc_html( $s['label'] ); ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20 w-full justify-center">
          Book a Free Check
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

      <!-- FAQ accordion -->
      <div class="space-y-3 yf-reveal" data-delay="2">
        <?php
        $bp_faqs = [
            [
                'q' => 'Is the blood pressure check really free?',
                'a' => 'Yes, completely free. Our blood pressure checks are an NHS service available at all four Southdowns branches. There is no charge, no private fee, and no insurance needed.',
            ],
            [
                'q' => 'Do I need an appointment?',
                'a' => 'No appointment is needed. Simply walk in to any of our Hampshire branches during opening hours and ask for a blood pressure check. We recommend calling ahead at busy times, but it\'s not required.',
            ],
            [
                'q' => 'How long does the check take?',
                'a' => 'The check itself takes around 2 minutes. Including a brief conversation with your pharmacist about the results and any recommended next steps, you\'re typically in and out in 5–10 minutes.',
            ],
            [
                'q' => 'What do the numbers mean?',
                'a' => 'Your blood pressure reading has two numbers: systolic (top) and diastolic (bottom), measured in mmHg. Ideal is around 120/80 mmHg. High blood pressure is generally considered 140/90 mmHg or above. Our pharmacist will explain what your specific reading means for you.',
            ],
            [
                'q' => 'What happens if my blood pressure is high?',
                'a' => 'Our pharmacist will advise on lifestyle changes and, if appropriate, refer you to your GP for further assessment or medication. A single high reading doesn\'t necessarily mean you have hypertension — multiple readings over time are usually needed for a diagnosis.',
            ],
            [
                'q' => 'How often should I get my blood pressure checked?',
                'a' => 'The NHS recommends all adults over 40 get checked at least every 5 years. If your reading is in the high-normal range, annually is advisable. If you\'re on blood pressure medication or have a history of hypertension, more frequent checks (every 3–6 months) are recommended.',
            ],
            [
                'q' => 'Can I get a check if I\'m pregnant?',
                'a' => 'Yes, and it\'s particularly important during pregnancy as high blood pressure can be a sign of pre-eclampsia. However, your midwife or GP should be your primary point of contact during pregnancy — please ensure they are informed of any readings from our check.',
            ],
            [
                'q' => 'Which branches offer blood pressure checks?',
                'a' => 'All four Southdowns Pharmacy branches — Emsworth, Havant (Bosmere Medical Centre), Davies Pharmacy, and Rowlands Castle — offer free blood pressure checks during their regular opening hours.',
            ],
        ];
        foreach ( $bp_faqs as $faq ) : ?>
        <details class="bp-faq-item">
          <summary class="bp-faq-question font-jost">
            <?php echo esc_html( $faq['q'] ); ?>
            <svg class="bp-faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </summary>
          <div class="bp-faq-answer"><?php echo esc_html( $faq['a'] ); ?></div>
        </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S10: CLOSING CTA BANNER — Dark blue gradient
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="absolute top-0 right-0 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.12) 0%,transparent 70%);"></div>
  <div class="relative section-container text-center">

    <!-- Trust badge pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-10 yf-reveal">
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        GPhC Registered
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        Free NHS Service
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        5-Minute Check
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Four Hampshire Branches
      </span>
    </div>

    <!-- Heading -->
    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost">Take 5 Minutes to Know Your Numbers</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost">A free blood pressure check at your local Southdowns Pharmacy could be one of the most important things you do for your health this year.</p>
    </div>

    <!-- Checklist -->
    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-2 max-w-xl mx-auto mb-10 text-left yf-reveal" data-delay="1">
      <?php
      $bp_cta_points = [
          'Completely free &mdash; NHS service',
          'No appointment needed, walk in',
          'Results in just 5 minutes',
          'Instant pharmacist advice',
          'Available at all 4 Hampshire branches',
          'GPhC-registered pharmacists',
      ];
      foreach ( $bp_cta_points as $point ) : ?>
      <div class="flex items-center gap-2.5 text-sm text-blue-100 font-jost">
        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <?php echo $point; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-wrap justify-center gap-4 yf-reveal" data-delay="2">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Book a Free Check
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center gap-2 text-white font-semibold border-2 border-white/40 px-8 py-4 rounded-full hover:bg-white/10 transition-colors text-base font-jost">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <?php echo esc_html( $phone ); ?>
      </a>
    </div>

    <!-- Trust indicators -->
    <div class="flex flex-wrap justify-center gap-8 mt-10 text-blue-200 text-sm yf-reveal" data-delay="3">
      <div class="flex items-center gap-2 font-jost">
        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <span><strong class="text-white">4.9/5</strong> from 400+ reviews</span>
      </div>
      <div class="flex items-center gap-2 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
        <span><strong class="text-white">10,000+</strong> patients served</span>
      </div>
      <div class="flex items-center gap-2 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <span><strong class="text-white">GPhC</strong> registered pharmacy</span>
      </div>
    </div>

  </div>
</section>


<!-- Medical disclaimer strip -->
<div class="bg-slate-100 border-t border-slate-200 py-6">
  <div class="section-container">
    <p class="text-xs text-slate-500 text-center font-jost leading-relaxed max-w-3xl mx-auto">
      <strong class="text-slate-600">Medical Disclaimer:</strong> Blood pressure checks provided by Southdowns Pharmacy are a screening service only and do not replace a consultation with your GP or other qualified healthcare provider. A single reading should not be used to diagnose hypertension. If you are concerned about your blood pressure or experience symptoms such as severe headache, chest pain, or blurred vision, contact your GP immediately or call 999 in an emergency.
    </p>
  </div>
</div>


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

<?php get_footer(); ?>
