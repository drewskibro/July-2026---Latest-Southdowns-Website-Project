<?php
/**
 * Template Name: NHS Prescriptions
 *
 * NHS & private prescriptions service page.
 * URL slug: /nhs-prescriptions/
 */

get_header();

$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// Hero image placeholder
$hero_img = sp_field( 'rx_hero_image', 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=1200&q=80&auto=format&fit=crop' );

// Roundel font stack (exact pattern from page-emsworth.php)
$rx_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
$rx_txt  = "font-family:{$rx_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";
?>

<!-- Page-scoped styles -->
<style>
  /* FAQ accordion */
  .rx-faq-item { border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s; background: #fff; }
  .rx-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); }
  .rx-faq-item[open] { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); }
  .rx-faq-question { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; font-weight: 600; font-size: 1.05rem; color: #1e293b; list-style: none; font-family: 'Jost', sans-serif; }
  .rx-faq-question::-webkit-details-marker { display: none; }
  .rx-faq-chevron { transition: transform 0.3s; flex-shrink: 0; margin-left: 1rem; }
  .rx-faq-item[open] .rx-faq-chevron { transform: rotate(180deg); }
  .rx-faq-answer { padding: 0 1.5rem 1.25rem; color: #4b5563; line-height: 1.7; font-family: 'Jost', sans-serif; font-size: 0.95rem; }
</style>


<!-- ============================================================
     S1: HERO — 2-column split (blue left, image right) + 3 roundels
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-bleed image + gradient overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center"
       style="background-image: url('<?php echo esc_url( $hero_img ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      <?php echo sp_field( 'rx_hero_badge', 'NHS &amp; PRIVATE PRESCRIPTIONS &bull; HAMPSHIRE' ); ?>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo sp_field( 'rx_hero_heading', 'Prescriptions Made Easy &mdash; Collect From Your Local Hampshire Pharmacy' ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo sp_field( 'rx_hero_subtext', 'Nominate your nearest Southdowns branch and we&rsquo;ll handle your NHS repeat prescriptions. Reminders, family ordering, and expert pharmacist support included.' ); ?></p>
    <div class="flex flex-wrap gap-3">
      <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Nominate Your Pharmacy
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="https://www.nhs.uk/nhs-app/" class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full border border-white/20 font-jost">
        Order via NHS App
      </a>
    </div>
  </div>

  <!-- Desktop: two-column split -->
  <div class="hidden md:flex relative">

    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <?php echo sp_field( 'rx_hero_badge', 'NHS &amp; PRIVATE PRESCRIPTIONS &bull; HAMPSHIRE' ); ?>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'rx_hero_heading', 'Prescriptions Made Easy &mdash; Collect From Your Local Hampshire Pharmacy' ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo sp_field( 'rx_hero_subtext', 'Nominate your nearest Southdowns branch and we&rsquo;ll handle your NHS repeat prescriptions. Reminders, family ordering, and expert pharmacist support included.' ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Nominate Your Pharmacy
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="https://www.nhs.uk/nhs-app/" class="inline-flex items-center gap-2 text-white/80 text-base font-medium hover:text-white transition-colors font-jost">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
          Order via NHS App
        </a>
      </div>
      <!-- Trust strip -->
      <div class="flex flex-wrap gap-x-5 gap-y-2 text-white text-sm font-medium font-jost">
        <?php
        $rx_trust = sp_list( 'rx_hero_trust', [ 'GPhC Registered', 'All Four Locations', 'NHS &amp; Private', 'Same-Day Collection' ] );
        foreach ( $rx_trust as $item ) : ?>
        <div class="flex items-center gap-1.5">
          <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php echo $item; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Right: hero image -->
    <!-- TODO: replace Unsplash placeholder with a real prescriptions/pharmacy image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center"
         style="background-image: url('<?php echo esc_url( $hero_img ); ?>');"></div>

    <!-- Roundel 1 — FREE / NHS SERVICE (top, white/navy, 132px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:12%;transform:translateX(-50%);">
      <div style="
        width:132px;height:132px;border-radius:50%;
        background:#fff;
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        <span style="<?php echo $rx_txt; ?>font-size:15px;font-weight:800;color:#1e3a8a;line-height:1.1;letter-spacing:-0.01em;">FREE</span>
        <span style="<?php echo $rx_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">NHS SERVICE</span>
        <span style="<?php echo $rx_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">No Charges Apply</span>
      </div>
    </div>

    <!-- Roundel 2 — SAME DAY / COLLECTION (centre, green gradient, 148px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="
        width:148px;height:148px;border-radius:50%;
        background:linear-gradient(135deg,#16a34a 0%,#15803d 50%,#14532d 100%);
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px rgba(22,163,74,0.5),0 0 0 6px rgba(255,255,255,0.5),0 8px 32px rgba(22,163,74,0.35),0 2px 8px rgba(0,0,0,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        <span style="<?php echo $rx_txt; ?>font-size:13px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.01em;">SAME DAY</span>
        <span style="<?php echo $rx_txt; ?>font-size:13px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.01em;">COLLECTION</span>
        <span style="<?php echo $rx_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.8);line-height:1.3;margin-top:3px;">Order Before 12pm</span>
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
        <span style="<?php echo $rx_txt; ?>font-size:15px;font-weight:800;color:#1e3a8a;line-height:1.1;letter-spacing:-0.01em;">ALL 4</span>
        <span style="<?php echo $rx_txt; ?>font-size:11px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">BRANCHES</span>
        <span style="<?php echo $rx_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:2px;">Across Hampshire</span>
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

      <?php
      $rx_stats = sp_rows( 'rx_stats', [
        [ '10,000+', 'Patients Served' ],
        [ '4', 'Hampshire Locations' ],
        [ 'Free', 'NHS Repeat Prescriptions' ],
        [ '4.9/5', 'Patient Satisfaction' ],
      ], [ 0 => 'value', 1 => 'label' ] );
      $rx_stat_icons = [
        '<svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>',
        '<svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        '<svg class="w-6 h-6 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
        '<svg class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
      ];
      foreach ( $rx_stats as $rx_si => $st ) : ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="<?php echo $rx_si + 1; ?>">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost"><?php echo esc_html( $st[0] ); ?></div>
        <div class="text-sm text-blue-100 font-medium font-jost"><?php echo esc_html( $st[1] ); ?></div>
        <div class="mt-3 flex justify-center"><?php echo $rx_stat_icons[ $rx_si ] ?? ''; ?></div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ============================================================
     S3: HOW IT WORKS — Light, photo left, 3 numbered steps right
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="how-it-works">
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/4 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-green-100/30 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Simple Process</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo sp_field( 'rx_how_heading', 'Ready in Three Simple Steps' ); ?></h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_how_intro', 'Nominate your branch, let us prepare your medication, and collect when it suits you.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

      <!-- Photo placeholder -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl yf-reveal">
        <!-- TODO: replace with a real image of a pharmacist handling a prescription -->
        <img src="<?php echo esc_url( sp_field( 'rx_how_image', 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&q=80&auto=format&fit=crop' ) ); ?>"
             alt="Pharmacist preparing prescription medication"
             class="w-full aspect-[4/3] object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">NHS Electronic Prescriptions</span>
        </div>
      </div>

      <!-- Steps -->
      <div>
        <?php
        $rx_steps = sp_rows( 'rx_steps', [
            [
                'title' => 'Nominate Your Pharmacy',
                'body'  => 'Nominate your preferred Southdowns branch online or in person. Once nominated, your GP sends your electronic prescription directly to us &mdash; no paper needed.',
                'pill'  => 'Takes under 2 minutes',
            ],
            [
                'title' => 'We Prepare Your Medication',
                'body'  => 'Our GPhC-registered pharmacists dispense and check your prescription carefully, ensuring accuracy and your safety before it&rsquo;s ready to collect.',
                'pill'  => 'Same-day when ordered before 12pm',
            ],
            [
                'title' => 'Collect From Your Branch',
                'body'  => 'Visit your local branch at a time that suits you. We&rsquo;ll send you a reminder before you run out so you never miss a dose.',
                'pill'  => 'At your convenience',
            ],
        ], [ 'title' => 'title', 'body' => 'body', 'pill' => 'pill' ] );
        ?>
        <div class="space-y-6">
          <?php foreach ( $rx_steps as $i => $step ) :
            $num     = $i + 1;
            $is_last = ( $i === count( $rx_steps ) - 1 );
          ?>
          <div class="flex gap-5 group yf-reveal" data-delay="<?php echo $num; ?>">
            <div class="flex-shrink-0 <?php echo $is_last ? '' : 'flex flex-col items-center'; ?>">
              <div class="w-12 h-12 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform text-base" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);"><?php echo $num; ?></div>
              <?php if ( ! $is_last ) : ?><div class="w-0.5 flex-1 mt-3 bg-gradient-to-b from-blue-300/60 to-transparent min-h-[32px]"></div><?php endif; ?>
            </div>
            <div class="<?php echo $is_last ? '' : 'pb-4'; ?>">
              <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost"><?php echo esc_html( $step['title'] ); ?></h4>
              <p class="text-gray-600 leading-relaxed font-jost"><?php echo $step['body']; ?></p>
              <span class="inline-block mt-3 text-sm font-medium px-3 py-1 rounded-full border border-blue-100 text-blue-600 bg-blue-50 font-jost"><?php echo esc_html( $step['pill'] ); ?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="mt-8 yf-reveal" data-delay="4">
          <div class="rounded-xl p-5 text-white text-sm font-medium flex items-center gap-3 shadow-lg shadow-blue-500/20" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <span class="font-jost"><?php echo sp_field( 'rx_how_note', 'NHS EPS means no paper prescription &mdash; your GP sends everything to us electronically.' ); ?></span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S4: FEATURES GRID — Dark blue, 6 glassmorphism cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="absolute top-0 right-1/3 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-white/20"></div>
        <span class="badge-text text-white/70 text-sm font-normal tracking-[0.15em] uppercase font-jost">What&rsquo;s Included</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'rx_feat_heading', 'Everything Included &mdash; No Extra Charges' ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_feat_intro', 'Your NHS prescription service, handled from start to finish.' ); ?></p>
    </div>

    <?php
    $rx_features = sp_rows( 'rx_features', [
        [
            'title' => 'Same-Day Collection',
            'desc'  => 'Order before 12pm and collect the same day from any of our four Hampshire branches.',
            'icon'  => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
        ],
        [
            'title' => 'Repeat Reminders',
            'desc'  => 'We remind you to reorder a week before you run out &mdash; so you never miss a dose of essential medication.',
            'icon'  => '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>',
        ],
        [
            'title' => 'Family Ordering',
            'desc'  => 'Manage prescriptions for your whole family from one account. Simplified ordering for everyone you care for.',
            'icon'  => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        ],
        [
            'title' => 'Electronic Prescriptions',
            'desc'  => 'Fully integrated with NHS EPS. Your GP sends prescriptions directly to us electronically &mdash; no paper, no delays.',
            'icon'  => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/><path d="M9 7h6M9 11h6M9 15h4"/>',
        ],
        [
            'title' => 'Expert Pharmacist Support',
            'desc'  => 'We&rsquo;re your local pharmacy behind the technology. Our team is always on hand to answer questions about your medication.',
            'icon'  => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
        ],
        [
            'title' => 'NHS App Compatible',
            'desc'  => 'Order NHS repeat prescriptions via the NHS App. Nominate your chosen Southdowns branch and order directly through the app.',
            'icon'  => '<rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/><path d="M8 6h8M8 10h8M8 14h5"/>',
        ],
    ], [ 'title' => 'title', 'desc' => 'desc' ] );
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
      <?php foreach ( $rx_features as $idx => $feat ) : ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="<?php echo ( $idx % 3 ) + 1; ?>">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $feat['icon']; ?></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost"><?php echo esc_html( $feat['title'] ); ?></h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo $feat['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Mid-section CTAs -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center yf-reveal">
      <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Nominate Your Pharmacy
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="https://www.nhs.uk/nhs-app/" class="inline-flex items-center justify-center gap-2 bg-white/15 backdrop-blur-sm text-white font-semibold px-8 py-4 rounded-full border border-white/30 hover:bg-white/25 transition-colors text-base font-jost">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>
        Order via NHS App
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S5: NOMINATE YOUR PHARMACY — Light, two-column (text left, image right)
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="nominate">
  <div class="absolute bottom-0 right-0 w-[500px] h-[400px] bg-blue-100/20 rounded-full translate-x-1/4 translate-y-1/4 blur-3xl pointer-events-none"></div>

  <div class="relative z-10 section-container">
    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      <!-- Text content -->
      <div class="yf-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-5">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Nominate Us</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-5 font-jost"><?php echo sp_field( 'rx_nom_heading', 'Nominate Your Southdowns Branch Today' ); ?></h2>
        <div class="space-y-4 text-gray-600 leading-relaxed font-jost mb-7">
        <?php echo sp_field( 'rx_nom_body', '<p>Nominating your local Southdowns Pharmacy means your GP can send prescriptions directly to us &mdash; no paper, no extra trips. Once you&rsquo;re set up, ordering your repeat prescriptions takes minutes.</p><p>You can also sign up on our website to order private prescriptions, track orders, and manage your family&rsquo;s medication in one place.</p>' ); ?>
        </div>

        <!-- Benefits list -->
        <ul class="space-y-3 mb-8">
          <?php
          $rx_benefits = sp_list( 'rx_benefits', [
              'Nominate online or in branch in under 2 minutes',
              'GP sends prescriptions to us electronically',
              'Automatic reminders before you run out',
              'Order for yourself and your family',
              'Expert pharmacist advice whenever you need it',
              'NHS and private prescriptions both accepted',
          ] );
          foreach ( $rx_benefits as $b ) : ?>
          <li class="flex items-center gap-3 text-gray-700 font-jost">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html( $b ); ?>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost text-base">
          Nominate Your Pharmacy
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

      <!-- Image placeholder -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl yf-reveal" data-delay="2">
        <!-- TODO: replace with a real image of someone collecting a prescription at a pharmacy counter -->
        <img src="<?php echo esc_url( sp_field( 'rx_nom_image', 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=800&q=80&auto=format&fit=crop' ) ); ?>"
             alt="Patient collecting prescription at Southdowns Pharmacy"
             class="w-full aspect-[4/3] object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/25 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">GPhC-Registered Pharmacists</span>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S6: REPEAT DISPENSING — Dark navy
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none opacity-40"></div>
  <div class="absolute bottom-0 left-1/4 w-80 h-80 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.18) 0%,transparent 70%);"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-12 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-white/20"></div>
        <span class="badge-text text-white/70 text-sm font-normal tracking-[0.15em] uppercase font-jost">Repeat Dispensing</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'rx_rep_heading', 'What Is NHS Repeat Dispensing?' ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_rep_intro', 'A smarter way to manage long-term medications &mdash; we handle the schedule for you.' ); ?></p>
    </div>

    <div class="max-w-3xl mx-auto mb-10 yf-reveal" data-delay="1">
      <p class="text-blue-100 leading-relaxed text-lg mb-6 font-jost text-center"><?php echo sp_field( 'rx_rep_body', 'Repeat dispensing allows your GP to issue a batch of prescriptions for medications you take regularly. You don&rsquo;t need to request a new prescription each time &mdash; we manage the schedule and dispense at the right intervals automatically.' ); ?></p>

      <!-- EPS note box -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-6 py-5 flex items-start gap-4">
        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
          <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
        </div>
        <div>
          <p class="text-white font-semibold mb-1 font-jost"><?php echo sp_field( 'rx_eps_heading', 'Electronic Repeat Dispensing (EPS)' ); ?></p>
          <p class="text-blue-200 text-sm font-jost leading-relaxed"><?php echo sp_field( 'rx_eps_body', 'We are fully integrated with the NHS Electronic Prescription Service. Your GP sends prescriptions directly to our pharmacy electronically. No paper, no delays.' ); ?></p>
        </div>
      </div>
    </div>

    <!-- 4 benefit cards 2x2 -->
    <div class="grid sm:grid-cols-2 gap-6 max-w-3xl mx-auto">
      <?php
      $rx_repeat_cards = sp_rows( 'rx_repeat_cards', [
          [ 'title' => 'Convenience',             'desc' => 'No repeated GP appointments for the same medication.',                                 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>' ],
          [ 'title' => 'Time-Saving',              'desc' => 'We handle prescription requests automatically on your behalf.',                        'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>' ],
          [ 'title' => 'Better Medication Management', 'desc' => 'Regular intervals mean you never run out of essential medication.',               'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
          [ 'title' => 'Pharmacist Monitoring',   'desc' => 'Our team checks your medication at every dispensing for accuracy and your safety.',     'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>' ],
      ], [ 'title' => 'title', 'desc' => 'desc' ] );
      foreach ( $rx_repeat_cards as $idx => $card ) : ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6" data-delay="<?php echo $idx + 1; ?>">
        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><?php echo $card['icon']; ?></svg>
        </div>
        <h3 class="text-base font-bold text-white mb-2 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo esc_html( $card['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S7: WHAT WE ACCEPT — Blue gradient, two-column prescription cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>

  <div class="relative z-10 section-container">
    <div class="text-center mb-12 yf-reveal">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'rx_acc_heading', 'NHS &amp; Private Prescriptions Welcome' ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_acc_intro', 'Whatever your prescription type, all four branches have you covered.' ); ?></p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-10">

      <!-- NHS Prescriptions card -->
      <div class="yf-reveal bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(34,197,94,0.25);border:1px solid rgba(34,197,94,0.4);">
            <svg class="w-6 h-6 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <h3 class="text-xl font-bold text-white font-jost"><?php echo sp_field( 'rx_nhs_title', 'NHS Prescriptions' ); ?></h3>
        </div>
        <ul class="space-y-3">
          <?php
          $rx_nhs_list = sp_list( 'rx_nhs_list', [
              'Electronic prescriptions (EPS)',
              'Paper prescriptions from your GP',
              'Hospital discharge prescriptions',
              'Repeat prescriptions',
              'Repeat dispensing prescriptions',
              'Same-day prescription collection',
              'Prescription exemptions honoured',
          ] );
          foreach ( $rx_nhs_list as $item ) : ?>
          <li class="flex items-center gap-3 text-white font-jost text-sm">
            <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html( $item ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Private Prescriptions card -->
      <div class="yf-reveal bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8" data-delay="2">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background:rgba(139,92,246,0.25);border:1px solid rgba(139,92,246,0.4);">
            <svg class="w-6 h-6 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
          </div>
          <h3 class="text-xl font-bold text-white font-jost"><?php echo sp_field( 'rx_pvt_title', 'Private Prescriptions' ); ?></h3>
        </div>
        <ul class="space-y-3">
          <?php
          $rx_pvt_list = sp_list( 'rx_pvt_list', [
              'Private GP prescriptions',
              'Specialist prescriptions',
              'Weight loss medications (Mounjaro, Wegovy)',
              'Travel medication',
              'Hair loss treatments',
              'Emergency medication supplies',
              'Competitive private prescription pricing',
          ] );
          foreach ( $rx_pvt_list as $item ) : ?>
          <li class="flex items-center gap-3 text-white font-jost text-sm">
            <svg class="w-4 h-4 text-purple-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html( $item ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>

    <!-- Statement -->
    <p class="text-center text-blue-100 max-w-2xl mx-auto font-jost yf-reveal"><?php echo sp_field( 'rx_acc_statement', 'All four Southdowns branches accept NHS and private prescriptions. Nominate any branch and your GP can send prescriptions to us electronically.' ); ?></p>

  </div>
</section>


<!-- ============================================================
     S8: FOUR LOCATION CARDS — White bg (exact weight loss pattern)
     ============================================================ -->
<section id="locations" class="py-16 md:py-24 bg-white">
  <div class="section-container">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Our Pharmacies</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost"><?php echo sp_field( 'rx_loc_heading', 'Nominate Your Nearest Hampshire Branch' ); ?></h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_loc_intro', 'All four Southdowns branches accept NHS and private prescriptions.' ); ?></p>
    </div>

    <!-- Branch photo cards — exact weight loss component -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 yf-reveal">
      <?php foreach ( sp_branch_order() as $i ) :
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
          <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="mt-auto flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Nominate This Branch
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Info banner -->
    <div class="mt-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 shadow-xl shadow-blue-500/15 yf-reveal">
      <div class="flex-shrink-0">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
          <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
        </div>
      </div>
      <div class="flex-1 text-center md:text-left">
        <p class="text-white text-lg font-semibold mb-1 font-jost"><?php echo sp_field( 'rx_loc_banner_heading', 'Nominating takes under 2 minutes' ); ?></p>
        <p class="text-blue-100 text-base font-jost"><?php echo sp_field( 'rx_loc_banner_body', 'Nominate online or visit any of our four Hampshire branches in person. Your GP can then send all prescriptions directly to us electronically.' ); ?></p>
      </div>
      <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        Nominate Your Pharmacy
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S9: WHY CHOOSE US — Blue gradient, 6-card grid
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative section-container">

    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Why Choose Us</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'rx_why_heading', 'Why Patients Choose Southdowns' ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_why_intro', 'Your local pharmacist &mdash; not a faceless online service.' ); ?></p>
    </div>

    <?php
    $rx_why_cards = sp_rows( 'rx_why_cards', [
        [ 'title' => 'GPhC-Registered Pharmacists',       'desc' => 'Expert, qualified dispensing at all four branches.',                                                     'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
        [ 'title' => 'Same-Day Collection',               'desc' => 'Order before 12pm and collect the same day.',                                                            'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>' ],
        [ 'title' => 'Automatic Reminders',               'desc' => 'We remind you before you run out &mdash; so you never miss a dose.',                                    'icon' => '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>' ],
        [ 'title' => 'Electronic Prescriptions',          'desc' => 'Fully integrated with NHS EPS across all four branches.',                                                'icon' => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><path d="M9 7h6M9 11h6M9 15h4"/>' ],
        [ 'title' => 'Family Prescription Management',    'desc' => 'Handle prescriptions for your whole family from one account.',                                           'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>' ],
        [ 'title' => 'Expert Advice',                     'desc' => 'Your local pharmacy team on hand to answer any medication questions.',                                   'icon' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>' ],
    ], [ 'title' => 'title', 'desc' => 'desc' ] );
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $rx_why_cards as $idx => $card ) : ?>
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
     S10: FAQ — Light gradient, sticky sidebar + accordion
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
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost"><?php echo sp_field( 'rx_faq_heading', 'Prescription Service FAQs' ); ?></h2>
        <p class="text-gray-600 mb-8 font-jost"><?php echo sp_field( 'rx_faq_intro', 'Everything you need to know about our prescription services across Hampshire.' ); ?></p>

        <!-- Sidebar trust stats -->
        <div class="grid grid-cols-2 gap-3 mb-8">
          <?php
          $rx_faq_stats = sp_rows( 'rx_faq_stats', [
              [ 'value' => '4',      'label' => 'Branches' ],
              [ 'value' => 'Free',   'label' => 'NHS Service' ],
              [ 'value' => 'Same Day', 'label' => 'Collection' ],
              [ 'value' => '4.9/5', 'label' => 'Rating' ],
          ], [ 'value' => 'value', 'label' => 'label' ] );
          foreach ( $rx_faq_stats as $s ) : ?>
          <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-bold text-blue-600 font-jost"><?php echo esc_html( $s['value'] ); ?></div>
            <div class="text-xs text-gray-500 font-jost"><?php echo esc_html( $s['label'] ); ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20 w-full justify-center">
          Nominate Your Pharmacy
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

      <!-- FAQ accordion -->
      <div class="space-y-3 yf-reveal" data-delay="2">
        <?php
        $rx_faqs = sp_rows( 'rx_faqs', [
            [
                'q' => 'How do I nominate Southdowns as my pharmacy?',
                'a' => 'You can nominate any of our four branches online at southdownspharmacygroup.co.uk/nominate-us, in person at your chosen branch, or by asking your GP to nominate us on your behalf.',
            ],
            [
                'q' => 'Can I order repeat prescriptions through the NHS App?',
                'a' => 'Yes. Nominate your preferred Southdowns branch first, then order repeat prescriptions directly through the NHS App at any time.',
            ],
            [
                'q' => 'How quickly can I collect my prescription?',
                'a' => 'Same-day collection is available when ordered before 12pm. We&rsquo;ll send you a reminder when your prescription is ready to collect.',
            ],
            [
                'q' => 'Do you accept electronic prescriptions?',
                'a' => 'Yes, we are fully integrated with the NHS Electronic Prescription Service (EPS). Your GP can send prescriptions directly to any of our four branches electronically.',
            ],
            [
                'q' => 'Can I manage prescriptions for my family?',
                'a' => 'Yes. Sign up on our website and you can order and manage prescriptions for your whole family from one account.',
            ],
            [
                'q' => 'Do you accept private prescriptions?',
                'a' => 'Yes, all four branches accept private prescriptions including weight loss medications, specialist prescriptions, travel medication and more.',
            ],
        ], [ 'q' => 'question', 'a' => 'answer' ] );
        foreach ( $rx_faqs as $faq ) : ?>
        <details class="rx-faq-item">
          <summary class="rx-faq-question font-jost">
            <?php echo esc_html( $faq['q'] ); ?>
            <svg class="rx-faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </summary>
          <div class="rx-faq-answer"><?php echo esc_html( $faq['a'] ); ?></div>
        </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S11: CLOSING CTA BANNER — Blue gradient
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative section-container text-center">

    <!-- Trust badge pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-10 yf-reveal">
      <?php
      $rx_cta_pills = sp_list( 'rx_cta_pills', [ 'GPhC Registered', 'Free NHS Service', 'Same-Day Collection', 'Four Hampshire Branches' ] );
      $rx_pill_icons = [
        '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
        '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
      ];
      foreach ( $rx_cta_pills as $rx_pi => $pill ) : ?>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><?php echo $rx_pill_icons[ $rx_pi ] ?? ''; ?></svg>
        <?php echo esc_html( $pill ); ?>
      </span>
      <?php endforeach; ?>
    </div>

    <!-- Heading -->
    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'rx_cta_heading', 'Nominate Your Pharmacy Today' ); ?></h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'rx_cta_subtext', 'Free NHS prescriptions. Same-day collection. Expert pharmacist support across four Hampshire branches.' ); ?></p>
    </div>

    <!-- Checklist -->
    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-2 max-w-xl mx-auto mb-10 text-left yf-reveal" data-delay="1">
      <?php
      $rx_cta_points = sp_list( 'rx_cta_points', [
          'Free NHS repeat prescriptions',
          'Same-day collection before 12pm',
          'Automatic reminders so you never run out',
          'Electronic prescriptions via NHS EPS',
          'Manage your whole family&rsquo;s medications',
          'GPhC-registered pharmacists at every branch',
      ] );
      foreach ( $rx_cta_points as $point ) : ?>
      <div class="flex items-center gap-2.5 text-sm text-blue-100 font-jost">
        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <?php echo $point; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-wrap justify-center gap-4 yf-reveal" data-delay="2">
      <a href="https://southdownspharmacygroup.co.uk/nominate-us/" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Nominate Your Pharmacy
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center gap-2 text-white font-semibold border-2 border-white/40 px-8 py-4 rounded-full hover:bg-white/10 transition-colors text-base font-jost">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        023 9212 3456
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
