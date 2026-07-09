<?php
/**
 * Template Name: About Us
 *
 * Select this template on the About Us page (slug "about-us") via Page → Template.
 *
 * Structure mirrors the Southdowns design system used across the site:
 *   1. Centred hero (blue gradient)
 *   2. Who We Are — single-column, light section (intro copy only, no figurehead)
 *   3. Awards — the homepage awards component, reused verbatim
 *   4. Meet The Teams — dark section (whole-team hero + supporting photo gallery)
 *   5. Four location cards — reused from the weight loss page (markup identical,
 *      reveal class renamed to this page's own so it animates without weight-loss.js)
 *   6. Closing CTA banner
 *
 * NOTE: Leigh Park is NOT an active branch — no references to it anywhere on this page.
 * The four branches are Emsworth, Bosmere (Havant), Davies (Havant) and Rowlands Castle.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// Supplied imagery — referenced via the site's own uploads path so the URLs
// stay valid if the site moves off the Kinsta staging domain.
$ab_uploads       = wp_upload_dir()['baseurl'] . '/2026/06/';
$ab_staff_bosmere = $ab_uploads . '2.png';                                                   // Bosmere Pharmacy team
$ab_team_emsworth = $ab_uploads . 'A07E304A-201E-47B0-B368-D78EEB47AD69_1_105_c.jpeg';        // team outside Emsworth Pharmacy
$ab_team_img      = $ab_uploads . 'A2F7B9DC-AD6B-43A0-B5F7-09BA8B3C2D2F_1_105_c.jpeg';        // team on Rowlands Castle opening day
$ab_inside_img    = $ab_uploads . 'ACE75A44-0B10-4C2F-9FF5-501A17F21482_1_105_c-Copy.jpeg';  // team serving in branch
?>

<!-- Page-scoped styles -->
<style>
  .ab-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .ab-reveal.visible { opacity: 1; transform: translateY(0); }
  .ab-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .ab-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .ab-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .ab-reveal[data-delay="4"] { transition-delay: 0.4s; }
</style>

<!-- ============================================================
     S1: HERO — centred, blue gradient
     ============================================================ -->
<section class="relative py-20 md:py-28 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-6">
      <div class="badge-rule w-10 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ab_hero_eyebrow', 'Our Story' ); ?></span>
    </div>
    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'ab_hero_heading', 'Nationally Award-Winning Community Pharmacy' ); ?></h1>
    <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-3xl mx-auto font-jost"><?php echo sp_field( 'ab_hero_intro', 'Proudly serving Hampshire communities across Emsworth, Havant and Rowlands Castle since 2009. Four branches, one commitment &mdash; exceptional care for every patient.' ); ?></p>
    <div class="mt-10 flex flex-wrap justify-center gap-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-base px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        <?php echo sp_field( 'ab_hero_btn1_label', 'Book an Appointment' ); ?>
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="<?php echo esc_url( sp_field( 'ab_hero_btn2_url', home_url( '/services/' ) ) ); ?>" class="inline-flex items-center gap-2 border-2 border-white text-white font-semibold text-base px-7 py-3.5 rounded-full hover:bg-white hover:text-blue-700 transition-colors font-jost">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
        <?php echo sp_field( 'ab_hero_btn2_label', 'All Services' ); ?>
      </a>
    </div>
  </div>
</section>


<!-- ============================================================
     S2: ABOUT THE GROUP — two-column, light
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="ab-reveal">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ab_who_eyebrow', 'Who We Are' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'ab_who_heading', 'Your Local, Independent, Award-Winning Community Pharmacy' ); ?></h2>
    </div>

    <div class="ab-reveal space-y-4 text-lg text-gray-600 leading-relaxed font-jost" data-delay="1">
      <?php echo sp_field( 'ab_who_body', '<p>Welcome to Southdowns Pharmacy Group &ndash; an independent, forward-thinking community pharmacy serving <strong>Emsworth, Havant and Rowlands Castle</strong>.</p><p>As a proudly independent pharmacy group, we have the freedom to invest in what matters most: our patients, our people and our local communities. Every decision we make is driven by a commitment to improving access to healthcare, delivering exceptional service and creating healthier communities.</p><p>We believe community pharmacy is about far more than dispensing medicines. Our experienced and approachable team provides expert clinical advice, preventative healthcare and a growing range of NHS and private services, helping people receive the care they need quickly, conveniently and close to home.</p><p>Our continued investment in innovative healthcare services, modern facilities and highly trained teams has established Southdowns Pharmacy Group as a multiple national award-winning pharmacy group, recognised for excellence in patient care, innovation and community impact. From NHS Pharmacy First consultations and vaccinations to weight management, travel health, ear wax removal and everyday healthcare advice, we are continually expanding our services to meet the changing needs of our communities.</p><p>At the heart of everything we do is a simple philosophy: patients come first. We take the time to listen, provide personalised care and build trusted relationships, ensuring every person who walks through our doors receives professional, compassionate and accessible healthcare.</p><p>Whether you are visiting us for expert advice, a prescription or one of our many clinical services, you can be confident that our team is committed to delivering the highest standards of care and making a positive difference to the health and wellbeing of the communities we proudly serve.</p><p class="text-slate-800 font-semibold">Independent. Innovative. Community Focused. Committed to Better Healthcare.</p>' ); ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: AWARDS — reused verbatim from front-page.php
     ============================================================ -->
<section class="relative py-12 md:py-16 bg-white border-t border-[#e8e0d8]">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-8 md:mb-10">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ab_awards_eyebrow', 'Recognised for Excellence' ); ?></span>
      </div>
      <h2 class="flex items-center justify-center gap-3 md:gap-4 text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 font-jost">
        <svg class="w-6 h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 flex-shrink-0" viewBox="0 0 24 24" fill="#FFE907" aria-hidden="true"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
        <span><?php echo sp_field( 'ab_awards_heading', 'Nationally Award-Winning Pharmacy Group' ); ?></span>
        <svg class="w-6 h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 flex-shrink-0" viewBox="0 0 24 24" fill="#FFE907" aria-hidden="true"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
      </h2>
    </div>

    <div id="awards-track" class="flex sm:grid overflow-x-auto sm:overflow-visible snap-x snap-mandatory awards-no-scrollbar sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6 -mx-4 px-4 sm:mx-0 sm:px-0">
      <?php
      // Awards are edited globally under Pharmacy Settings → Awards (sp_awards()).
      $awards = sp_awards();
      $awards_total = count( $awards );
      foreach ( $awards as $i => $aw ) :
        // When the row count is odd, the final card is orphaned on the 2-col (tablet) layout — centre it.
        $orphan = ( $i === $awards_total - 1 && $awards_total % 2 === 1 )
          ? 'sm:col-span-2 sm:max-w-[calc(50%-0.75rem)] sm:mx-auto lg:col-span-1 lg:max-w-none'
          : '';
      ?>
      <div class="shrink-0 basis-[82%] snap-center sm:basis-auto sm:shrink flex flex-col items-center text-center bg-[#fdf9f6] border border-[#e8e0d8] rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 <?php echo $orphan; ?>">
        <div class="h-16 md:h-20 flex items-center justify-center mb-4">
          <img src="<?php echo esc_url( $aw['logo'] ); ?>" alt="<?php echo esc_attr( $aw['org'] . ' logo' ); ?>" class="max-h-full max-w-[150px] w-auto object-contain" loading="lazy" />
        </div>
        <div class="text-3xl font-bold text-blue-700 font-jost mb-1.5"><?php echo esc_html( $aw['year'] ); ?></div>
        <h3 class="text-base font-semibold text-slate-800 font-jost leading-snug mb-2"><?php echo esc_html( $aw['title'] ); ?></h3>
        <p class="text-sm text-slate-500 font-jost"><?php echo esc_html( $aw['org'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <style>
    .awards-no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .awards-no-scrollbar::-webkit-scrollbar { display: none; }
  </style>
  <script>
    (function () {
      var track = document.getElementById('awards-track');
      if (!track) return;
      var mobile = window.matchMedia('(max-width: 639px)');
      var idx = 0, timer = null, resumeTimer = null;

      function step() {
        var cards = track.children;
        if (!cards.length) return;
        idx = (idx + 1) % cards.length;
        track.scrollTo({ left: cards[idx].offsetLeft - cards[0].offsetLeft, behavior: 'smooth' });
      }
      function start() {
        stop();
        if (!mobile.matches) return;
        timer = setInterval(step, 3500);
      }
      function stop() { if (timer) { clearInterval(timer); timer = null; } }
      function pauseThenResume() {
        stop();
        clearTimeout(resumeTimer);
        resumeTimer = setTimeout(start, 5000);
      }

      start();
      (mobile.addEventListener ? mobile.addEventListener('change', start) : mobile.addListener(start));
      track.addEventListener('touchstart', stop, { passive: true });
      track.addEventListener('touchend', pauseThenResume, { passive: true });
    })();
  </script>
</section>


<!-- ============================================================
     S4: MEET THE TEAMS — dark section
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #1e3a8a 100%);">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 md:mb-16 ab-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/20"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ab_teams_eyebrow', 'Our People' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost"><?php echo sp_field( 'ab_teams_heading', 'Meet The Teams' ); ?></h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'ab_teams_intro', 'Our experienced, hard-working teams are passionate about serving the communities across our Hampshire branches.' ); ?></p>
    </div>

    <!-- Hero: whole team -->
    <div class="ab-reveal rounded-3xl overflow-hidden shadow-2xl mb-6 md:mb-8 relative">
      <img src="<?php echo esc_url( sp_field( 'ab_team_hero_image', $ab_team_img ) ); ?>" alt="<?php echo esc_attr( sp_field( 'ab_team_hero_alt', 'The Southdowns Pharmacy Group team outside Rowlands Castle Pharmacy on opening day' ) ); ?>" class="w-full h-full object-cover aspect-[16/9] md:aspect-[21/9]" loading="lazy"/>
      <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
    </div>

    <!-- Supporting photo gallery -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12 md:mb-16 ab-reveal" data-delay="2">
      <figure class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
        <img src="<?php echo esc_url( sp_field( 'ab_g1_image', $ab_team_emsworth ) ); ?>" alt="The team outside Emsworth Pharmacy" class="w-full h-full object-cover object-top" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
        <figcaption class="absolute bottom-3 left-4 right-4 text-white text-sm font-semibold font-jost"><?php echo sp_field( 'ab_g1_caption', 'Emsworth Pharmacy' ); ?></figcaption>
      </figure>
      <figure class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
        <img src="<?php echo esc_url( sp_field( 'ab_g2_image', $ab_staff_bosmere ) ); ?>" alt="The team at Bosmere Pharmacy, Havant" class="w-full h-full object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
        <figcaption class="absolute bottom-3 left-4 right-4 text-white text-sm font-semibold font-jost"><?php echo sp_field( 'ab_g2_caption', 'Bosmere Pharmacy, Havant' ); ?></figcaption>
      </figure>
      <figure class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
        <img src="<?php echo esc_url( sp_field( 'ab_g3_image', $ab_inside_img ) ); ?>" alt="Southdowns Pharmacy team serving customers in branch" class="w-full h-full object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
        <figcaption class="absolute bottom-3 left-4 right-4 text-white text-sm font-semibold font-jost"><?php echo sp_field( 'ab_g3_caption', 'Caring for our community' ); ?></figcaption>
      </figure>
    </div>

    <!-- Copy + CTA -->
    <div class="max-w-3xl mx-auto text-center ab-reveal" data-delay="3">
      <div class="space-y-4 text-lg text-blue-50 leading-relaxed font-jost">
        <?php echo sp_field( 'ab_teams_body', '<p>Southdowns Pharmacy Group is uniquely patient-focused. All of our staff continuously work hard to maintain and promote a high-quality customer and healthcare service that is accessible to all individuals.</p><p>We take pride in our local ownership and prioritise offering you and your family friendly, first-class pharmacy services. As a locally run pharmacy group, we have developed a true love for our patients and the people in our community.</p>' ); ?>
      </div>
      <div class="mt-8 flex flex-wrap justify-center gap-4">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          <?php echo sp_field( 'ab_teams_btn_label', 'Book an Appointment' ); ?>
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S5: FOUR LOCATION CARDS — reused from page-weight-loss.php
     ============================================================ -->
<section class="py-16 md:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 ab-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ab_loc_eyebrow', 'Our Pharmacies' ); ?></span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost"><?php echo sp_field( 'ab_loc_heading', 'Find Your Nearest Branch' ); ?></h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'ab_loc_intro', 'Four Hampshire locations &mdash; always close to you.' ); ?></p>
    </div>

    <!-- Branch photo cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 ab-reveal">
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
          <a href="<?php echo esc_url( $booking_url ); ?>" class="mt-auto flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Book an Appointment
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ============================================================
     S6: CLOSING CTA BANNER
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-8">
      <div class="badge-rule w-10 h-px bg-white/15"></div>
      <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ab_cta_eyebrow', 'Four Hampshire Branches' ); ?></span>
    </div>
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'ab_cta_heading', 'Visit Us Today' ); ?></h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'ab_cta_intro', 'Reliable healthcare advice and support across four Hampshire branches. We&rsquo;re always close to you and ready to help.' ); ?></p>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-lg px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        <?php echo sp_field( 'ab_cta_btn_label', 'Book an Appointment' ); ?>
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.ab-reveal');
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
