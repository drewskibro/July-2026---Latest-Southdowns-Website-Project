<?php
/**
 * Template Name: Wegovy Pill
 *
 * Specialist weight-loss service page for oral semaglutide (the "Wegovy pill").
 * Design mirrors page-b12-injections.php — split hero, blue stat bar, white
 * content sections, scroll-reveal animations, accordion for safety info, plus a
 * branch/day availability grid and pricing cards.
 *
 * Setup: create a Page titled "Wegovy Pill" (slug "wegovy-pill") and assign this
 * template via Page → Template. Content is editable under the "Wegovy Pill — Page
 * Content" fields (inc/acf-wegovy-pill-fields.php); every value below falls back
 * to a hardcoded default so the page renders fully out of the box.
 *
 * NOTE: The actual bookable availability (Emsworth Mon–Tue, Davies Wed–Fri,
 * Bosmere Mon & Fri), the 10-min slot length and the two prices are configured
 * in the Amelia backend on the "Wegovy Pill" service — this page displays them.
 */
get_header();
$booking_url = sp_booking_url();

// ── Hero ───────────────────────────────────────────────────────────────────
$wgp_hero_image    = ( function_exists( 'get_field' ) ? get_field( 'wgp_hero_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1000&q=75&auto=format&fit=crop';
$wgp_hero_badge    = sp_field( 'wgp_hero_badge',    'Needle-Free Weight Loss &middot; MHRA Approved' );
$wgp_hero_headline = sp_field( 'wgp_hero_headline', 'The Wegovy Pill Has Arrived' );
$wgp_hero_body     = sp_field( 'wgp_hero_body',     'On 11 June 2026 the MHRA approved oral semaglutide &mdash; the first oral GLP-1 medicine licensed in the UK for weight loss, giving you a needle-free alternative to the weekly Wegovy injection.' );

// ── Stats bar ──────────────────────────────────────────────────────────────
$wgp_stats = sp_rows( 'wgp_stats', [
    [ 'value' => 'Needle-Free', 'label' => 'Daily Oral Tablet',   'caption' => 'No weekly injection' ],
    [ 'value' => 'Up to 17%',   'label' => 'Average Weight Loss', 'caption' => 'At 64 weeks on maintenance dose' ],
    [ 'value' => '10 Min',      'label' => 'Consultation',        'caption' => 'No GP referral needed' ],
    [ 'value' => 'MHRA',        'label' => 'Approved Jun 2026',   'caption' => 'UK-licensed oral semaglutide' ],
], [ 'value' => 'value', 'label' => 'label', 'caption' => 'caption' ] );

// ── Eligibility cards ──────────────────────────────────────────────────────
$wgp_eligibility = sp_rows( 'wgp_eligibility', [
    [ 'title' => 'New to weight-loss medication', 'body' => 'You may be eligible to start if you have a BMI of 30 or above, or 27 or above with a weight-related health condition such as type 2 diabetes, high blood pressure, high cholesterol, obstructive sleep apnoea, or cardiovascular disease.' ],
    [ 'title' => 'Already on weight-loss medication', 'body' => 'You are also eligible to take the Wegovy pill and can request to switch. Where clinically suitable, the Wegovy pill can be prescribed off-label.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── "Empty-stomach rule" steps ─────────────────────────────────────────────
$wgp_howto_steps = sp_rows( 'wgp_howto_steps', [
    [ 'title' => 'On an empty stomach', 'body' => 'Take it first thing, after fasting for at least 8 hours &mdash; usually overnight.' ],
    [ 'title' => 'Whole, with a sip of water', 'body' => 'Swallow whole with no more than 120ml of plain water. Do not split, crush or chew it.' ],
    [ 'title' => 'Then wait 30 minutes', 'body' => 'Wait at least 30 minutes before eating, drinking anything else, or taking other medicines.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── Dose escalation schedule ───────────────────────────────────────────────
$wgp_doses = sp_rows( 'wgp_doses', [
    [ 'dose' => '1.5 mg', 'stage' => 'Starting dose', 'note' => 'Once daily &middot; min. 1 month' ],
    [ 'dose' => '4 mg',   'stage' => 'Step up',        'note' => 'Once daily &middot; min. 1 month' ],
    [ 'dose' => '9 mg',   'stage' => 'Step up',        'note' => 'Once daily &middot; min. 1 month' ],
    [ 'dose' => '25 mg',  'stage' => 'Maintenance',    'note' => 'Full target dose' ],
], [ 'dose' => 'dose', 'stage' => 'stage', 'note' => 'note' ] );

// ── Prices ─────────────────────────────────────────────────────────────────
$wgp_prices = sp_rows( 'wgp_prices', [
    [ 'name' => 'Wegovy Pill 1.5mg', 'meta' => 'Starting dose &middot; once daily', 'price' => '£128.50' ],
    [ 'name' => 'Wegovy Pill 4mg',   'meta' => 'Second dose step &middot; once daily', 'price' => '£137.00' ],
], [ 'name' => 'name', 'meta' => 'meta', 'price' => 'price' ] );

// ── Availability (branch → days) ───────────────────────────────────────────
$wgp_availability = sp_rows( 'wgp_availability', [
    [ 'branch' => 'Emsworth Pharmacy', 'days' => 'Mondays &amp; Tuesdays' ],
    [ 'branch' => 'Davies Pharmacy',   'days' => 'Wednesdays, Thursdays &amp; Fridays' ],
    [ 'branch' => 'Bosmere Pharmacy',  'days' => 'Mondays &amp; Fridays' ],
], [ 'branch' => 'branch', 'days' => 'days' ] );

// ── Common side effects ────────────────────────────────────────────────────
$wgp_side_effects = sp_list( 'wgp_side_effects', [
    'Nausea', 'Vomiting', 'Diarrhoea or constipation', 'Abdominal discomfort or bloating', 'Burping or acid reflux',
] );

// ── Safety accordion (MHRA guidance) ───────────────────────────────────────
$wgp_safety = sp_rows( 'wgp_safety', [
    [ 'title' => 'Pancreatitis', 'body' => 'Semaglutide has been associated with a small increased risk of pancreatitis. Seek urgent medical attention for severe, persistent abdominal pain that may spread to the back.' ],
    [ 'title' => 'Gallbladder problems', 'body' => 'Gallstones and gallbladder inflammation have been reported, particularly with rapid weight loss. Report new upper-abdominal pain or jaundice promptly.' ],
    [ 'title' => 'Dehydration &amp; kidney injury', 'body' => 'Severe vomiting or diarrhoea can cause dehydration. Maintain fluid intake and seek advice if you notice reduced urine output or dizziness, as acute kidney injury has been reported.' ],
    [ 'title' => 'Diabetic retinopathy', 'body' => 'Rapid improvement in blood glucose, particularly in people with type 2 diabetes on insulin, may temporarily worsen diabetic retinopathy. Those affected should be monitored.' ],
    [ 'title' => 'Hypoglycaemia', 'body' => 'Used alongside insulin or a sulfonylurea in type 2 diabetes, there is an increased risk of low blood sugar; the dose of those medicines may need adjusting.' ],
    [ 'title' => 'Heart rate', 'body' => 'A small increase in resting heart rate has been observed and should be monitored.' ],
    [ 'title' => 'Thyroid C-cell tumours', 'body' => 'Based on animal studies there is a theoretical risk; this has not been confirmed in humans, but report any neck lump, difficulty swallowing, or persistent hoarseness.' ],
], [ 'title' => 'title', 'body' => 'body' ] );
?>

<!-- Page-scoped styles -->
<style>
  .wgp-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .wgp-reveal.visible { opacity: 1; transform: translateY(0); }
  .wgp-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .wgp-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .wgp-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .wgp-reveal[data-delay="4"] { transition-delay: 0.4s; }

  .wgp-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1); }
  .wgp-faq-item.active .wgp-faq-answer { max-height: 600px; }
  .wgp-faq-item.active .wgp-faq-icon { transform: rotate(45deg); }
  .wgp-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }
  .wgp-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .wgp-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .wgp-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }

  .wgp-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .wgp-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
</style>

<!-- ============================================================
     S1: HERO — split blue panel + image
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $wgp_hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/80 to-blue-900/30 hero-legible"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10 hero-legible">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/90 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $wgp_hero_badge ); ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $wgp_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $wgp_hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost">Prescription-only &middot; No GP referral needed</p>
  </div>

  <!-- Desktop -->
  <div class="hidden md:flex">
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $wgp_hero_badge ); ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $wgp_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $wgp_hero_body ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Appointment
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#how-to-take" class="inline-flex items-center gap-2 border-2 border-white text-white text-base font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-blue-700 transition-colors font-jost">
          How It Works
        </a>
      </div>
      <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/90 text-sm font-jost">
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> GPhC Registered</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg> No GP Referral</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg> MHRA Approved</span>
      </div>
    </div>

    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $wgp_hero_image ); ?>');"></div>
  </div>

</section>


<!-- ============================================================
     S2: STATS BAR
     ============================================================ -->
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
      <?php foreach ( $wgp_stats as $i => $stat ) : ?>
      <div class="wgp-reveal wgp-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $stat['value'] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost"><?php echo esc_html( $stat['label'] ); ?></div>
        <div class="text-xs text-blue-200/60 mt-1 font-jost"><?php echo esc_html( $stat['caption'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: DESCRIPTION — What is the Wegovy pill
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="wgp-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_desc_eyebrow', 'What Is It?' ); ?></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_desc_heading', 'Oral Semaglutide, Explained' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'wgp_desc_body', '<p>Wegovy pills are a prescription-only weight-loss treatment that contain <strong>semaglutide</strong> &mdash; the same active ingredient used in Wegovy injections. In clinical studies they produced an average of up to <strong>17% weight loss</strong> after 64 weeks on the maintenance dose.</p><p>As a glucagon-like peptide 1 (GLP-1) tablet, Wegovy works like the natural GLP-1 hormone released after eating. This helps reduce hunger, lower food cravings, and keep you feeling satisfied for longer after meals.</p><p>Wegovy tablets are started on a low dose and increased gradually until you reach the maintenance dose of 25mg. They must be taken once a day on an empty stomach after 8 hours of fasting, and swallowed whole with no more than 120ml of water.</p>' ); ?>
        </div>
        <div class="mt-8 flex flex-wrap gap-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <?php echo sp_field( 'wgp_desc_btn', 'Book Your Consultation' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
      <div class="wgp-reveal" data-delay="2">
        <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
          <img src="<?php echo esc_url( sp_field( 'wgp_desc_image', 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=900&h=675&q=75&auto=format&fit=crop' ) ); ?>" alt="Pharmacist discussing oral semaglutide weight-loss treatment" class="w-full h-full object-cover" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent"></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S4: ELIGIBILITY — Who can take it
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden border-t border-gray-100" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_elig_eyebrow', 'Am I Eligible?' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_elig_heading', 'Who Can Take the Wegovy Pill' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'wgp_elig_intro', 'Suitability is confirmed by our GPhC-registered pharmacists during your consultation. In general:' ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
      <?php foreach ( $wgp_eligibility as $i => $e ) : ?>
      <div class="wgp-reveal wgp-card-lift bg-white rounded-2xl p-8 border border-blue-100 shadow-sm" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-5 text-white" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo wp_kses_post( $e['title'] ); ?></h3>
        <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $e['body'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S5: HOW TO TAKE — empty-stomach rule + dose escalation
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="how-to-take">
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50/50 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_howto_eyebrow', 'How to Take It' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_howto_heading', 'The Daily Routine &amp; What to Expect' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'wgp_howto_intro', 'For the tablet to absorb properly, the empty-stomach rule matters. This daily routine is the main trade-off compared with the once-weekly injection &mdash; so it is worth thinking about which fits your life better.' ); ?></p>
    </div>

    <!-- Empty-stomach steps -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-16">
      <?php foreach ( $wgp_howto_steps as $i => $step ) : ?>
      <div class="wgp-reveal wgp-card-lift rounded-2xl p-7 border border-blue-100 bg-gradient-to-br from-blue-50 to-white" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="w-11 h-11 rounded-full flex items-center justify-center mb-4 text-white text-lg font-bold font-jost" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);"><?php echo esc_html( $i + 1 ); ?></div>
        <h3 class="text-lg font-bold text-slate-800 mb-2 font-jost"><?php echo wp_kses_post( $step['title'] ); ?></h3>
        <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $step['body'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Dose escalation -->
    <div class="max-w-4xl mx-auto text-center mb-8">
      <h3 class="text-2xl md:text-3xl font-bold text-slate-800 mb-3 font-jost"><?php echo sp_field( 'wgp_dose_heading', 'Gradual Dose Escalation' ); ?></h3>
      <p class="text-gray-500 font-jost"><?php echo sp_field( 'wgp_dose_intro', 'The dose is stepped up slowly to reduce gastrointestinal side effects, with a minimum of one month at each level.' ); ?></p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
      <?php foreach ( $wgp_doses as $i => $d ) : $is_final = ( $i === count( $wgp_doses ) - 1 ); ?>
      <div class="wgp-reveal rounded-2xl p-6 text-center border <?php echo $is_final ? 'text-white border-transparent' : 'bg-white border-gray-200/80'; ?>" data-delay="<?php echo ( $i % 4 ) + 1; ?>" <?php echo $is_final ? 'style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);"' : ''; ?>>
        <div class="text-3xl font-bold font-jost mb-1 <?php echo $is_final ? 'text-white' : 'text-blue-700'; ?>"><?php echo esc_html( $d['dose'] ); ?></div>
        <div class="text-sm font-semibold font-jost mb-1 <?php echo $is_final ? 'text-white' : 'text-slate-800'; ?>"><?php echo esc_html( $d['stage'] ); ?></div>
        <div class="text-xs font-jost <?php echo $is_final ? 'text-blue-100' : 'text-gray-400'; ?>"><?php echo wp_kses_post( $d['note'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: RESULTS + PRICES
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden border-t border-gray-100" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);" id="pricing">
  <div class="absolute top-0 left-0 w-80 h-80 bg-blue-100/40 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

      <!-- Results -->
      <div class="wgp-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_results_eyebrow', 'Results You Can Expect' ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-5 font-jost"><?php echo sp_field( 'wgp_results_heading', 'How Well Does It Work?' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'wgp_results_body', '<p>In the phase 3 OASIS 4 trial, adults taking the 25mg pill for around 64 weeks lost on average about <strong>16.6% of their body weight</strong> when taken as intended, compared with roughly 2% on placebo. Around one in three of those who took it consistently lost 20% or more.</p><p>These results are broadly comparable to high-dose injectable semaglutide. Individual results vary and depend on your starting weight, the dose you reach, and the lifestyle changes alongside it. The Wegovy pill works best as part of a comprehensive programme of dietary change, increased activity and regular follow-up.</p>' ); ?>
        </div>
        <div class="mt-6 rounded-2xl p-5 flex items-start gap-3 bg-white border border-amber-200">
          <svg class="flex-shrink-0 w-6 h-6 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
          <p class="text-sm text-amber-900 leading-relaxed font-jost"><?php echo sp_field( 'wgp_results_warning', 'Be cautious of any product sold online as a &ldquo;Wegovy pill&rdquo; without a prescription. Only use a licensed product prescribed by a GMC-registered prescriber and dispensed by a GPhC-registered pharmacy.' ); ?></p>
        </div>
      </div>

      <!-- Prices -->
      <div class="wgp-reveal" data-delay="2">
        <div class="bg-white rounded-3xl border border-gray-200/80 shadow-lg p-8">
          <div class="flex items-center gap-2 mb-1">
            <span class="text-slate-400 text-xs uppercase tracking-[0.15em] font-jost"><?php echo sp_field( 'wgp_price_eyebrow', 'Transparent Pricing' ); ?></span>
          </div>
          <h3 class="text-2xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_price_heading', 'Wegovy Pill Prices' ); ?></h3>
          <ul class="divide-y divide-gray-100">
            <?php foreach ( $wgp_prices as $p ) : ?>
            <li class="flex items-center justify-between gap-4 py-4">
              <div class="min-w-0">
                <span class="block text-slate-800 font-semibold font-jost"><?php echo wp_kses_post( $p['name'] ); ?></span>
                <span class="text-sm text-gray-400 font-jost"><?php echo wp_kses_post( $p['meta'] ); ?></span>
              </div>
              <span class="flex-shrink-0 text-blue-700 font-bold text-2xl font-jost"><?php echo esc_html( $p['price'] ); ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <p class="text-xs text-gray-400 mt-4 font-jost"><?php echo sp_field( 'wgp_price_note', 'Later dose steps (9mg and the 25mg maintenance dose) are discussed and priced at your consultation. 10-minute consultation per appointment.' ); ?></p>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="mt-6 w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors shadow-lg font-jost">
            Book Appointment
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S7: AVAILABILITY — which branch, which days
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="availability">
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-50/40 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_avail_eyebrow', 'Where &amp; When' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_avail_heading', 'Available Across Our Hampshire Branches' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'wgp_avail_intro', 'Wegovy pill consultations run on set days at each branch. Choose the day and location that suits you when you book.' ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php foreach ( $wgp_availability as $i => $a ) : ?>
      <div class="wgp-reveal wgp-card-lift rounded-2xl p-7 border border-gray-200/80 bg-gradient-to-br from-blue-50 to-white text-center" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-4" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2 font-jost"><?php echo wp_kses_post( $a['branch'] ); ?></h3>
        <p class="text-blue-700 font-semibold font-jost"><?php echo wp_kses_post( $a['days'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="mt-10 text-center">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-bold px-8 py-4 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
        Book Your Appointment
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- ============================================================
     S8: SIDE EFFECTS & MHRA SAFETY
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);" id="safety">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_safety_eyebrow', 'Side Effects &amp; Safety' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_safety_heading', 'What You Should Know' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'wgp_safety_intro', 'The most common side effects are gastrointestinal &mdash; such as nausea &mdash; and are usually worst while the dose is being increased. They tend to ease as your body adjusts.' ); ?></p>
    </div>

    <!-- Common side effects pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-12">
      <?php foreach ( $wgp_side_effects as $se ) : ?>
      <span class="inline-flex items-center gap-2 bg-white border border-gray-200 text-slate-700 text-sm font-medium px-4 py-2 rounded-full font-jost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
        <?php echo wp_kses_post( $se ); ?>
      </span>
      <?php endforeach; ?>
    </div>

    <!-- MHRA safety accordion -->
    <h3 class="text-center text-2xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'wgp_safety_sub', 'Important Safety Information (UK SmPC / MHRA)' ); ?></h3>
    <div class="space-y-4">
      <?php foreach ( $wgp_safety as $i => $c ) : ?>
      <div class="wgp-faq-item wgp-reveal bg-white border border-gray-200 rounded-2xl overflow-hidden" data-delay="<?php echo ( $i % 4 ) + 1; ?>">
        <button class="wgp-faq-trigger w-full flex items-center gap-4 p-6 text-left bg-white hover:bg-blue-50/50 transition-colors" type="button">
          <span class="flex-shrink-0 w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-sm font-jost"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
          <span class="flex-1 text-lg font-bold text-slate-800 font-jost"><?php echo wp_kses_post( $c['title'] ); ?></span>
          <span class="wgp-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          </span>
        </button>
        <div class="wgp-faq-answer">
          <p class="px-6 pb-6 pl-[4.5rem] text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $c['body'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- When to seek help -->
    <div class="mt-10 rounded-2xl p-6 md:p-7 bg-white border border-blue-100 shadow-sm">
      <h4 class="text-lg font-bold text-slate-800 mb-3 font-jost"><?php echo sp_field( 'wgp_help_heading', 'When to Seek Help' ); ?></h4>
      <div class="space-y-3 text-gray-600 leading-relaxed font-jost">
        <?php echo sp_field( 'wgp_help_body', '<p><strong>Call 999</strong> for signs of a severe allergic reaction (anaphylaxis), such as difficulty breathing or severe swelling of the face or throat.</p><p><strong>Contact your GP or call 111</strong> for persistent vomiting, signs of dehydration, a neck lump, or other concerning but non-emergency symptoms.</p><p>Report any suspected side effects through the <strong>MHRA Yellow Card scheme</strong> at <a href="https://yellowcard.mhra.gov.uk" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-800 underline">yellowcard.mhra.gov.uk</a>.</p><p>Family planning: the pill must not be used during pregnancy. Women of childbearing potential should use effective contraception during treatment and stop at least two months before trying to conceive.</p>' ); ?>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S9: FINAL CTA
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-8">
      <div class="badge-rule w-10 h-px bg-white/15"></div>
      <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'wgp_cta_eyebrow', 'A Needle-Free Path to Weight Loss' ); ?></span>
    </div>
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'wgp_cta_heading', 'Ready to Start With<br/>the Wegovy Pill?' ); ?></h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'wgp_cta_body', 'Book a consultation with our GPhC-registered pharmacists to see if the Wegovy pill is right for you &mdash; no GP referral needed, at your nearest Hampshire branch.' ); ?></p>

    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php
      $wgp_pills = sp_list( 'wgp_cta_pills', [ 'GPhC Registered', 'No GP Referral', 'Needle-Free', 'MHRA Approved', '10-Min Consultation' ] );
      foreach ( $wgp_pills as $pill ) : ?>
      <div class="flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        <?php echo wp_kses_post( $pill ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-lg px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        Book Appointment
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Medical disclaimer -->
<div class="bg-slate-50 border-t border-slate-200 py-6">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-xs text-gray-400 leading-relaxed font-jost"><?php echo sp_field( 'wgp_disclaimer', '<strong>Medical disclaimer:</strong> This information is for general guidance only and does not replace professional medical advice. The Wegovy pill (oral semaglutide) is a prescription-only medicine; eligibility and suitability are assessed by our GPhC-registered pharmacists during your consultation. Information is based on current MHRA and UK SmPC guidance. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ); ?></p>
  </div>
</div>

<!-- Accordion JS -->
<script>
(function() {
  document.querySelectorAll('.wgp-faq-trigger').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.wgp-faq-item');
      var isOpen = item.classList.contains('active');
      document.querySelectorAll('.wgp-faq-item.active').forEach(function(el) { el.classList.remove('active'); });
      if (!isOpen) item.classList.add('active');
    });
  });
})();
</script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.wgp-reveal');
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
