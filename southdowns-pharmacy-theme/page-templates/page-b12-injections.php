<?php
/**
 * Template Name: B12 Injections
 *
 * Select this template on the B12 Injections page via Page → Template in the editor.
 *
 * Design mirrors page-contraception.php / page-flu-vaccinations.php — split hero,
 * blue stat bar, white content sections, scroll-reveal animations, accordion for the
 * symptoms list, and the shared "Hampshire Locations" branch grid (sp_branch data).
 * The location cards link through to each branch's own page.
 *
 * Placeholder Unsplash images are used throughout — swap for branded assets later.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// Branch number → branch page URL (matches page-book-appointment.php mapping).
$b12_branch_links = [
    1 => home_url( '/emsworth/' ),
    2 => home_url( '/bosmere/' ),
    3 => home_url( '/davies/' ),
    4 => home_url( '/rowlands-pharmacy/' ),
];

// ── Hero ───────────────────────────────────────────────────────────────────
$b12_hero_image    = ( function_exists( 'get_field' ) ? get_field( 'b12_hero_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1612277795421-9bc7706a4a34?w=900&h=900&fit=crop';
$b12_hero_badge    = sp_field( 'b12_hero_badge',    'Boost Your Energy &middot; Same-Day Appointments' );
$b12_hero_headline = sp_field( 'b12_hero_headline', 'Recharge with a Vitamin B12 Injection' );
$b12_hero_body     = sp_field( 'b12_hero_body',     'Feeling tired, run down or low on energy? Our trained pharmacists deliver safe, effective Vitamin B12 injections to help you feel like yourself again &mdash; available across Emsworth, Havant, Leigh Park and Rowlands Castle.' );

// ── Stats bar ──────────────────────────────────────────────────────────────
$b12_stats = sp_rows( 'b12_stats', [
    [ 'value' => 'Same Day',  'label' => 'Appointments',         'caption' => 'No GP referral needed' ],
    [ 'value' => '10 Min',    'label' => 'Quick Appointment',    'caption' => 'In and out in minutes' ],
    [ 'value' => 'Expert',    'label' => 'Trained Pharmacists',  'caption' => 'Safe, professional care' ],
    [ 'value' => '4',         'label' => 'Hampshire Locations',  'caption' => 'Book at your nearest branch' ],
], [ 'value' => 'value', 'label' => 'label', 'caption' => 'caption' ] );

// ── Benefits (short list cards) ────────────────────────────────────────────
$b12_benefits = sp_rows( 'b12_benefits', [
    [ 'icon' => '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>',                                                                          'title' => 'Boosts Energy Levels',        'body' => 'Replenish depleted B12 stores and shake off that constant feeling of fatigue and sluggishness.' ],
    [ 'icon' => '<path d="M12 2a3 3 0 0 0-3 3v1a3 3 0 0 0 0 6 3 3 0 0 0 0 6v1a3 3 0 0 0 6 0v-1a3 3 0 0 0 0-6 3 3 0 0 0 0-6V5a3 3 0 0 0-3-3z"/>', 'title' => 'Supports Your Nervous System', 'body' => 'Vitamin B12 plays a key role in keeping nerves healthy and your brain functioning at its best.' ],
    [ 'icon' => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>', 'title' => 'Healthy Skin, Hair &amp; Nails', 'body' => 'B12 contributes to cell production, helping to promote glowing skin and stronger hair and nails.' ],
    [ 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',                                'title' => 'Reduces Stress &amp; Anxiety',  'body' => 'By supporting your nervous system, B12 can help ease feelings of stress, low mood and anxiety.' ],
    [ 'icon' => '<path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>', 'title' => 'Maximum Absorption',        'body' => 'Delivered straight into the bloodstream, injections bypass the gut for far better uptake than tablets.' ],
    [ 'icon' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/>', 'title' => 'Supports Overall Wellbeing', 'body' => 'Feel sharper, brighter and more like yourself &mdash; a simple boost for body and mind.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── Symptoms of deficiency (accordion) ─────────────────────────────────────
$b12_symptoms = sp_rows( 'b12_symptoms', [
    [ 'title' => 'Extreme tiredness &amp; lack of energy', 'body' => 'Persistent fatigue and low energy are among the most common signs of a B12 or folate deficiency. If you feel exhausted no matter how much you rest, your B12 levels may be to blame.' ],
    [ 'title' => 'Pins and needles', 'body' => 'A tingling, &ldquo;pins and needles&rdquo; sensation in the hands and feet can occur when low B12 affects the health of your nerves.' ],
    [ 'title' => 'A sore, red tongue &amp; mouth ulcers', 'body' => 'A smooth, sore or unusually red tongue (glossitis) and recurrent mouth ulcers can both be linked to a deficiency in vitamin B12 or folate.' ],
    [ 'title' => 'Muscle weakness', 'body' => 'Low B12 can leave your muscles feeling weak and your body generally run down, making everyday tasks feel harder than they should.' ],
    [ 'title' => 'Problems with your vision', 'body' => 'In some cases a B12 deficiency can affect the optic nerve, leading to disturbances or changes in vision.' ],
    [ 'title' => 'Psychological changes', 'body' => 'A deficiency can affect mood and mental health, ranging from mild depression or anxiety through to confusion and, in severe long-term cases, dementia.' ],
    [ 'title' => 'Problems with memory &amp; thinking', 'body' => 'Difficulties with memory, understanding and judgement can all be associated with low levels of vitamin B12.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── How it works ───────────────────────────────────────────────────────────
$b12_steps = sp_rows( 'b12_steps', [
    [ 'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop', 'title' => 'Book Your Appointment',     'body' => 'Book online or call your nearest branch. Same-day appointments are usually available &mdash; no GP referral needed.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop', 'title' => 'Quick Health Check',        'body' => 'Our pharmacist talks through your symptoms and history to make sure a B12 injection is the right choice for you.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1612277795421-9bc7706a4a34?w=600&h=400&fit=crop', 'title' => 'Your Injection, Done',      'body' => 'Your B12 injection is administered safely by a trained pharmacist &mdash; you&rsquo;re done in minutes and back to your day.' ],
], [ 'image' => 'image', 'title' => 'title', 'body' => 'body' ] );
?>

<!-- Page-scoped styles -->
<style>
  .b12-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .b12-reveal.visible { opacity: 1; transform: translateY(0); }
  .b12-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .b12-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .b12-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .b12-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .b12-reveal[data-delay="5"] { transition-delay: 0.5s; }

  .b12-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s ease; }
  .b12-faq-item.active .b12-faq-answer { max-height: 600px; }
  .b12-faq-item.active .b12-faq-icon { transform: rotate(45deg); }
  .b12-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }
  .b12-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .b12-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .b12-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }

  .b12-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .b12-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
</style>

<!-- ============================================================
     S1: HERO — split blue panel + image
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $b12_hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $b12_hero_badge ); ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $b12_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $b12_hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Now
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost">Same-day appointments typically available &middot; No referral needed</p>
  </div>

  <!-- Desktop -->
  <div class="hidden md:flex">
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $b12_hero_badge ); ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $b12_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $b12_hero_body ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Now
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="inline-flex items-center gap-2 border-2 border-white text-white text-base font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-blue-700 transition-colors font-jost">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          All Services
        </a>
      </div>
      <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/90 text-sm font-jost">
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg> Energy Boost</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Same-Day Available</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Expert Pharmacists</span>
      </div>
    </div>

    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $b12_hero_image ); ?>');"></div>
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
      <?php foreach ( $b12_stats as $i => $stat ) : ?>
      <div class="b12-reveal b12-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $stat['value'] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost"><?php echo esc_html( $stat['label'] ); ?></div>
        <div class="text-xs text-blue-200/60 mt-1 font-jost"><?php echo esc_html( $stat['caption'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: INTRO — What are B12 injections
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="b12-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'b12_intro_eyebrow', 'What Is It?' ); ?></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'b12_intro_heading', 'A Simple Boost for Body &amp; Mind' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'b12_intro_body', '<p>Vitamin B12 is essential for energy, a healthy nervous system and the production of red blood cells. When your levels run low, it can leave you feeling drained, foggy and run down &mdash; and food or tablets alone aren&rsquo;t always enough.</p><p>At Southdowns Pharmacy Group, our trained pharmacists use the latest equipment to deliver safe, effective <strong>B12 injections</strong> that go straight into the bloodstream &mdash; bypassing the digestive system for maximum absorption.</p><p>Whether you have a diagnosed deficiency or simply want to top up your energy, we&rsquo;ll help you find the right plan for you &mdash; with no GP referral and same-day appointments usually available.</p>' ); ?>
        </div>
        <div class="mt-8 flex flex-wrap gap-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <?php echo sp_field( 'b12_intro_btn', 'Book Your B12 Injection' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
      <div class="b12-reveal" data-delay="2">
        <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
          <img src="<?php echo esc_url( sp_field( 'b12_intro_image', 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=900&h=675&fit=crop' ) ); ?>" alt="Pharmacist preparing a Vitamin B12 injection" class="w-full h-full object-cover" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent"></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S4: BENEFITS — cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="benefits">
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50/50 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'b12_ben_eyebrow', 'The Benefits' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'b12_ben_heading', 'Why People Choose B12 Injections' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'b12_ben_intro', 'From renewed energy to a healthier nervous system, a B12 injection can help you feel sharper, brighter and more like yourself again.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $b12_benefits as $i => $e ) : $delay = ( $i % 3 ) + 1; ?>
      <div class="b12-reveal b12-card-lift rounded-2xl p-7 border border-blue-100 bg-gradient-to-br from-blue-50 to-white" data-delay="<?php echo (int) $delay; ?>">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-5 text-white" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $e['icon']; ?></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2 font-jost"><?php echo wp_kses_post( $e['title'] ); ?></h3>
        <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $e['body'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S5: SYMPTOMS — accordion
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);" id="symptoms">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'b12_sym_eyebrow', 'Could You Be Deficient?' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'b12_sym_heading', 'Signs of a B12 Deficiency' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'b12_sym_intro', 'A deficiency in vitamin B12 or folate can cause a range of problems. Tap each symptom below to learn more &mdash; some can occur even without anaemia.' ); ?></p>
    </div>

    <div class="space-y-4">
      <?php foreach ( $b12_symptoms as $i => $c ) : ?>
      <div class="b12-faq-item b12-reveal bg-white border border-gray-200 rounded-2xl overflow-hidden" data-delay="<?php echo ( $i % 4 ) + 1; ?>">
        <button class="b12-faq-trigger w-full flex items-center gap-4 p-6 text-left bg-white hover:bg-blue-50/50 transition-colors" type="button">
          <span class="flex-shrink-0 w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-sm font-jost"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
          <span class="flex-1 text-lg font-bold text-slate-800 font-jost"><?php echo wp_kses_post( $c['title'] ); ?></span>
          <span class="b12-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          </span>
        </button>
        <div class="b12-faq-answer">
          <p class="px-6 pb-6 pl-[4.5rem] text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $c['body'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-10 rounded-2xl p-6 md:p-7 flex flex-col sm:flex-row items-start gap-4 bg-white border border-blue-100 shadow-sm">
      <svg class="flex-shrink-0 w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <p class="text-gray-600 leading-relaxed font-jost flex-1"><?php echo sp_field( 'b12_sym_note', 'Recognise some of these symptoms? You&rsquo;re not alone &mdash; B12 deficiency is common and easily treated. Our pharmacists can talk through your symptoms and help you decide if a B12 injection is right for you.' ); ?></p>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: HOW IT WORKS / IS IT RIGHT FOR ME — highlight panel
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="how-it-works">
  <div class="absolute top-0 left-0 w-80 h-80 bg-blue-50/60 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">

      <!-- Highlight card -->
      <div class="b12-reveal rounded-3xl p-8 md:p-10 text-white relative overflow-hidden flex flex-col justify-center" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full translate-x-1/3 -translate-y-1/3"></div>
        <div class="relative z-10">
          <span class="inline-block bg-amber-400 text-blue-900 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide mb-5 font-jost"><?php echo sp_field( 'b12_hiw_offer', 'How It Works' ); ?></span>
          <h3 class="text-3xl md:text-4xl font-bold mb-4 font-jost"><?php echo sp_field( 'b12_hiw_heading', 'Straight to Your Bloodstream' ); ?></h3>
          <p class="text-blue-100 text-lg leading-relaxed mb-7 font-jost"><?php echo sp_field( 'b12_hiw_body', 'B12 injections deliver a high dose of vitamin B12 directly into the bloodstream, bypassing the digestive system. This ensures your body absorbs the maximum amount for the best possible benefit.' ); ?></p>
          <ul class="space-y-3 mb-8">
            <?php foreach ( sp_list( 'b12_hiw_points', [ 'Maximum absorption &mdash; no gut barrier', 'Administered by a trained pharmacist', 'Same-day &amp; walk-in appointments', 'Safe, quick and virtually painless' ] ) as $point ) : ?>
            <li class="flex items-center gap-3 text-white font-jost">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span><?php echo wp_kses_post( $point ); ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
            <?php echo sp_field( 'b12_hiw_btn', 'Book Your B12 Injection' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>

      <!-- Is it right for me -->
      <div class="b12-reveal flex flex-col justify-center" data-delay="2">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'b12_hiw_r_eyebrow', 'Is It Right for Me?' ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-5 font-jost"><?php echo sp_field( 'b12_hiw_r_heading', 'Could a B12 Injection Help You?' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'b12_hiw_r_body', '<p>B12 injections are usually recommended for people with a B12 deficiency, or a medical condition that affects how well B12 is absorbed from food. If you&rsquo;re feeling tired, run down, or have a diagnosed deficiency, an injection may be right for you.</p><p>Our knowledgeable pharmacists will work with you to determine the best treatment plan for your individual needs &mdash; available across <strong>Emsworth, Havant, Leigh Park and Rowlands Castle</strong>.</p>' ); ?>
        </div>
        <div class="mt-8 grid grid-cols-2 gap-4">
          <div class="rounded-2xl border border-gray-200/80 p-5 bg-gradient-to-br from-blue-50 to-white">
            <div class="text-2xl font-bold text-slate-800 font-jost mb-1">4 Branches</div>
            <div class="text-sm text-gray-500 font-jost">Across Hampshire</div>
          </div>
          <div class="rounded-2xl border border-gray-200/80 p-5 bg-gradient-to-br from-blue-50 to-white">
            <div class="text-2xl font-bold text-slate-800 font-jost mb-1">Same Day</div>
            <div class="text-sm text-gray-500 font-jost">Appointments available</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S7: HOW IT WORKS — 3 photo steps
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden border-t border-gray-100" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);">
  <div class="absolute top-0 right-0 w-80 h-80 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'b12_steps_eyebrow', 'Simple &amp; Quick' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'b12_steps_heading', 'Getting Your B12 Injection' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'b12_steps_intro', 'From booking to boosted in three simple steps &mdash; no GP, no long waits.' ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $b12_steps as $i => $step ) : ?>
      <div class="b12-reveal b12-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="relative overflow-hidden aspect-[3/2]">
          <img src="<?php echo esc_url( $step['image'] ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $step['title'] ) ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
          <div class="absolute top-3 left-3 w-9 h-9 bg-white text-blue-700 text-sm font-bold rounded-full flex items-center justify-center font-jost"><?php echo esc_html( $i + 1 ); ?></div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo wp_kses_post( $step['title'] ); ?></h3>
          <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $step['body'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S8: LOCATIONS — 4 branch cards (link through to branch pages)
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="locations">
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-50/50 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-50/40 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <span class="badge-numeral text-4xl font-bold text-slate-800 font-jost leading-none">4</span>
        <div class="badge-divider w-px h-8 bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Hampshire Locations</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'b12_loc_heading', 'Find Your Nearest Branch' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'b12_loc_intro', 'All four Southdowns Pharmacy locations offer B12 injections. Choose your nearest branch below to see opening hours, contact details and how to find us.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ( sp_branch_order() as $pos => $i ) :
        $b        = sp_branch( $i );
        $name     = $b['name'];
        $addr1    = $b['address_line1'];
        $addr2    = $b['address_line2'];
        $hours    = sp_branch_hours_html( $b );
        $img      = $b['card_image'];
        $page_url = $b12_branch_links[ $i ] ?? $booking_url;
        $delay    = $pos + 1;
      ?>
      <a href="<?php echo esc_url( $page_url ); ?>" class="b12-reveal b12-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group flex flex-col" data-delay="<?php echo (int) $delay; ?>">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_attr( $img ); ?>" alt="<?php echo esc_attr( $name ); ?> B12 injection clinic" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full font-jost">B12 Injections</span>
          </div>
        </div>
        <div class="p-5 flex flex-col flex-1">
          <h3 class="text-lg font-bold text-slate-800 mb-2 font-jost"><?php echo esc_html( $name ); ?></h3>
          <div class="space-y-1.5 text-sm text-gray-600 mb-4 font-jost">
            <div class="flex items-start gap-2">
              <svg class="flex-shrink-0 mt-0.5 text-blue-500" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span><?php echo esc_html( $addr1 ); ?><?php if ( $addr2 ) echo ', ' . esc_html( $addr2 ); ?></span>
            </div>
            <?php if ( $hours ) : ?>
            <div class="flex items-start gap-2">
              <svg class="flex-shrink-0 mt-0.5 text-blue-500" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
              <span class="leading-relaxed"><?php echo $hours; ?></span>
            </div>
            <?php endif; ?>
          </div>
          <span class="mt-auto inline-flex items-center justify-center gap-1.5 text-blue-700 font-semibold text-sm py-2.5 rounded-full border border-blue-200 group-hover:border-blue-400 group-hover:bg-blue-50 transition-colors font-jost">
            Book at This Branch
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="mt-10 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center gap-5 bg-white border border-blue-100 shadow-sm">
      <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </div>
      <div class="flex-1">
        <div class="font-bold text-slate-800 font-jost mb-1"><?php echo sp_field( 'b12_loc_note_h', 'Not sure which branch to visit?' ); ?></div>
        <p class="text-gray-600 text-sm font-jost"><?php echo sp_field( 'b12_loc_note_b', 'Every one of our four pharmacies offers B12 injections. Choose the location nearest to you above to view its details, or contact us and we&rsquo;ll happily point you to the right branch.' ); ?></p>
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
      <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'b12_cta_eyebrow', 'Same-Day Appointments Available' ); ?></span>
    </div>
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'b12_cta_heading', 'Book Your B12<br/>Injection Today' ); ?></h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'b12_cta_body', 'Start feeling your best. Book your B12 injection at any Southdowns Pharmacy &mdash; quick, safe and convenient care from Hampshire&rsquo;s trusted pharmacy group.' ); ?></p>

    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php
      $b12_pills = sp_rows( 'b12_pills', [
        ['<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>', 'GPhC Registered'],
        ['<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>', '4 Hampshire Locations'],
        ['<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>', 'Same-Day Appointments'],
        ['<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>', 'Energy Boosting'],
        ['<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>', 'Expert Pharmacists'],
      ], [ 1 => 'text' ] );
      foreach ( $b12_pills as $pill ) : ?>
      <div class="flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $pill[0]; ?></svg>
        <?php echo wp_kses_post( $pill[1] ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-lg px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        Book Your B12 Injection
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Medical disclaimer -->
<div class="bg-slate-50 border-t border-slate-200 py-6">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-xs text-gray-400 leading-relaxed font-jost"><?php echo sp_field( 'b12_disclaimer', '<strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. If you are experiencing symptoms of a B12 or folate deficiency, please consult a qualified healthcare professional about your individual circumstances. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ); ?></p>
  </div>
</div>

<!-- Accordion JS -->
<script>
(function() {
  document.querySelectorAll('.b12-faq-trigger').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.b12-faq-item');
      var isOpen = item.classList.contains('active');
      document.querySelectorAll('.b12-faq-item.active').forEach(function(el) { el.classList.remove('active'); });
      if (!isOpen) item.classList.add('active');
    });
  });
})();
</script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.b12-reveal');
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
