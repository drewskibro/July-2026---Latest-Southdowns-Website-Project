<?php
/**
 * Template Name: Flu Vaccinations
 *
 * Select this template on the Flu Vaccinations page via Page → Template in the editor.
 *
 * Design mirrors page-travel-health.php — split hero, blue stat bar, white content
 * sections, scroll-reveal animations, accordion for the at-risk conditions list, and
 * the shared "Hampshire Locations" branch grid (sp_branch data).
 *
 * Placeholder Unsplash images are used throughout — swap for branded assets later.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// ── Hero ───────────────────────────────────────────────────────────────────
$fv_hero_image    = ( function_exists( 'get_field' ) ? get_field( 'fv_hero_image' ) : '' ) ?: 'https://southdownspharmacygroup.kinsta.cloud/wp-content/uploads/2026/06/fluvacc.png';
$fv_hero_badge    = sp_field( 'fv_hero_badge',    'NHS &amp; Private &middot; Same-Day Appointments' );
$fv_hero_headline = sp_field( 'fv_hero_headline', 'Protect Yourself This Flu Season' );
$fv_hero_body     = sp_field( 'fv_hero_body',     'Private flu jabs and NHS flu vaccinations at Southdowns Pharmacy Group. Quick, convenient protection against this year&rsquo;s seasonal flu strain &mdash; available across Emsworth, Havant, Leigh Park and Rowlands Castle.' );

// ── Stats bar ──────────────────────────────────────────────────────────────
$fv_stats = sp_rows( 'fv_stats', [
    [ 'value' => '£20',       'label' => 'Private Flu Jab',      'caption' => 'Seasonal introductory offer' ],
    [ 'value' => 'Same Day',  'label' => 'Appointments',         'caption' => 'No GP referral needed' ],
    [ 'value' => 'Free',      'label' => 'NHS Vaccinations',     'caption' => 'For eligible patients' ],
    [ 'value' => '4',         'label' => 'Hampshire Locations',  'caption' => 'Book at your nearest branch' ],
], [ 'value' => 'value', 'label' => 'label', 'caption' => 'caption' ] );

// ── Who is eligible (short list) ───────────────────────────────────────────
$fv_eligible = sp_rows( 'fv_eligible', [
    [ 'icon' => '<path d="M12 2a5 5 0 0 0-5 5v2a5 5 0 0 0 10 0V7a5 5 0 0 0-5-5z"/><path d="M5 21v-1a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v1"/>', 'title' => 'Aged 65 or over',            'body' => 'Everyone aged 65 and above qualifies for a free seasonal flu vaccination.' ],
    [ 'icon' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',                                                 'title' => 'Long-term health conditions', 'body' => 'Certain chronic conditions increase your risk — see the full list below.' ],
    [ 'icon' => '<circle cx="12" cy="8" r="5"/><path d="M12 13v8M9 18h6"/>',                            'title' => 'Pregnant at any stage',       'body' => 'Recommended during the first, second or third trimester of pregnancy.' ],
    [ 'icon' => '<path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>',           'title' => 'Living in a care home',       'body' => 'Residents of long-stay residential or care homes are eligible.' ],
    [ 'icon' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/>', 'title' => 'Carers',                      'body' => 'Main carers, or those receiving a carer&rsquo;s allowance, can be vaccinated free.' ],
    [ 'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>', 'title' => 'Household contacts', 'body' => 'Living with someone who has a weakened immune system? You may qualify too.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── Detailed at-risk conditions (accordion) ────────────────────────────────
$fv_conditions = sp_rows( 'fv_conditions', [
    [ 'title' => 'Chronic respiratory disease', 'body' => 'Asthma requiring continuous or repeated use of inhaled or systemic steroids, or with previous exacerbations needing hospital admission. COPD including chronic bronchitis and emphysema; bronchiectasis, cystic fibrosis, interstitial lung fibrosis, pneumoconiosis and bronchopulmonary dysplasia (BPD). Children previously admitted to hospital for lower respiratory tract disease are also included.' ],
    [ 'title' => 'Chronic heart &amp; vascular disease', 'body' => 'Congenital heart disease, hypertension with cardiac complications, chronic heart failure, and anyone needing regular medication or follow-up for ischaemic heart disease. This also covers atrial fibrillation, peripheral vascular disease and a history of venous thromboembolism.' ],
    [ 'title' => 'Chronic kidney disease', 'body' => 'Chronic kidney disease at stage 3, 4 or 5, chronic kidney failure, nephrotic syndrome and kidney transplantation.' ],
    [ 'title' => 'Chronic neurological disease', 'body' => 'Stroke or transient ischaemic attack (TIA), and conditions where respiratory function may be compromised. Following individual assessment, immunisation is also offered to those with cerebral palsy, severe or profound multiple learning disabilities, Down&rsquo;s syndrome, multiple sclerosis, dementia, Parkinson&rsquo;s disease, motor neurone disease and related conditions.' ],
    [ 'title' => 'Diabetes &amp; adrenal insufficiency', 'body' => 'Type 1 diabetes, type 2 diabetes requiring insulin or oral hypoglycaemic drugs, and diet-controlled diabetes. Also Addison&rsquo;s disease and secondary or tertiary adrenal insufficiency requiring steroid replacement.' ],
    [ 'title' => 'Immunosuppression', 'body' => 'Weakened immune systems due to cancer treatment, organ or stem cell transplants, HIV, inherited immune disorders, or autoimmune diseases such as lupus, rheumatoid arthritis and psoriasis. These patients may respond less well to vaccination, making protection especially important.' ],
    [ 'title' => 'Morbid obesity (class III)', 'body' => 'Adults with a Body Mass Index of 40 kg/m² or above.' ],
    [ 'title' => 'Pregnancy', 'body' => 'Pregnant women at any stage of pregnancy — first, second or third trimester. The inactivated flu vaccine is safe and recommended in pregnancy.' ],
    [ 'title' => 'Household contacts of the immunosuppressed', 'body' => 'Those who share living accommodation on most days with someone who is immunosuppressed, where close contact is unavoidable.' ],
    [ 'title' => 'Carers', 'body' => 'Anyone eligible for a carer&rsquo;s allowance, or who is the sole or primary carer of an elderly or disabled person whose welfare may be at risk if the carer falls ill.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── How it works ───────────────────────────────────────────────────────────
$fv_steps = sp_rows( 'fv_steps', [
    [ 'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop', 'title' => 'Book or Walk In',          'body' => 'Book online or call your nearest branch. Same-day appointments are usually available, and we welcome walk-ins where possible.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop', 'title' => 'Quick Eligibility Check',  'body' => 'Our pharmacist confirms whether you qualify for a free NHS jab or a private flu vaccination — it takes just a couple of minutes.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1612277795421-9bc7706a4a34?w=600&h=400&fit=crop', 'title' => 'Vaccinated in Minutes',    'body' => 'Your flu jab is administered by a trained pharmacist. You&rsquo;re protected and back to your day in no time — no fuss, no long waits.' ],
], [ 'image' => 'image', 'title' => 'title', 'body' => 'body' ] );
?>

<!-- Page-scoped styles -->
<style>
  .fv-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .fv-reveal.visible { opacity: 1; transform: translateY(0); }
  .fv-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .fv-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .fv-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .fv-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .fv-reveal[data-delay="5"] { transition-delay: 0.5s; }

  .fv-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s ease; }
  .fv-faq-item.active .fv-faq-answer { max-height: 600px; }
  .fv-faq-item.active .fv-faq-icon { transform: rotate(45deg); }
  .fv-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }
  .fv-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .fv-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .fv-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }

  .fv-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .fv-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
</style>

<!-- ============================================================
     S1: HERO — split blue panel + image
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $fv_hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $fv_hero_badge ); ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $fv_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $fv_hero_body ); ?></p>
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
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $fv_hero_badge ); ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $fv_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $fv_hero_body ); ?></p>
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
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> NHS &amp; Private Jabs</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Same-Day Available</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Expert Pharmacists</span>
      </div>
    </div>

    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $fv_hero_image ); ?>');"></div>
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
      <?php foreach ( $fv_stats as $i => $stat ) : ?>
      <div class="fv-reveal fv-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $stat['value'] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost"><?php echo esc_html( $stat['label'] ); ?></div>
        <div class="text-xs text-blue-200/60 mt-1 font-jost"><?php echo esc_html( $stat['caption'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: INTRO — Why the flu vaccine matters
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="fv-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'fv_intro_eyebrow', 'Why It Matters' ); ?></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'fv_intro_heading', 'The Importance of the Flu Vaccine' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'fv_intro_body', '<p>For most people the flu is a miserable week in bed &mdash; but for some it can be serious, even life-threatening, particularly those with underlying health conditions. A seasonal flu vaccine is one of the simplest, most effective ways to reduce your risk of illness and its complications.</p><p>Whether you choose a free <strong>NHS flu vaccination</strong> or a convenient <strong>private flu jab</strong>, getting protected against this year&rsquo;s strain gives you peace of mind &mdash; less time off work, and a layer of protection for the vulnerable people around you.</p><p>The best time to be vaccinated is in <strong>autumn or early winter</strong>, before flu starts circulating widely. Left it late? Don&rsquo;t worry &mdash; private flu vaccination remains available throughout the season.</p>' ); ?>
        </div>
        <div class="mt-8 flex flex-wrap gap-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <?php echo sp_field( 'fv_intro_btn', 'Book Your Flu Jab' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
      <div class="fv-reveal" data-delay="2">
        <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
          <img src="<?php echo esc_url( sp_field( 'fv_intro_image', 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?w=900&h=675&fit=crop' ) ); ?>" alt="Pharmacist preparing a flu vaccination" class="w-full h-full object-cover" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent"></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S4: NHS ELIGIBILITY — short list cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="nhs-eligibility">
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50/50 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'fv_elig_eyebrow', 'Free NHS Flu Vaccinations' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'fv_elig_heading', 'Are You Eligible for a Free Jab?' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'fv_elig_intro', 'You can get your seasonal flu vaccine free on the NHS if you fall into one of the groups below. Not eligible? You can still book a private flu jab with us in minutes.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $fv_eligible as $i => $e ) : $delay = ( $i % 3 ) + 1; ?>
      <div class="fv-reveal fv-card-lift rounded-2xl p-7 border border-blue-100 bg-gradient-to-br from-blue-50 to-white" data-delay="<?php echo (int) $delay; ?>">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-5 text-white" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $e['icon']; ?></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2 font-jost"><?php echo wp_kses_post( $e['title'] ); ?></h3>
        <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $e['body'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="text-center text-sm text-gray-400 mt-8 max-w-3xl mx-auto font-jost"><?php echo sp_field( 'fv_elig_note', 'Please note: NHS flu vaccine eligibility may change in line with NHS guidance. The information here is accurate at the time of writing and is subject to update.' ); ?></p>
  </div>
</section>


<!-- ============================================================
     S5: AT-RISK CONDITIONS — accordion
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'fv_cond_eyebrow', 'Long-Term Health Conditions' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'fv_cond_heading', 'Which Conditions Make You Eligible?' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'fv_cond_intro', 'If you live with any of the following long-term conditions, you&rsquo;re likely entitled to a free NHS flu vaccination. Tap each one to learn more.' ); ?></p>
    </div>

    <div class="space-y-4">
      <?php foreach ( $fv_conditions as $i => $c ) : ?>
      <div class="fv-faq-item fv-reveal bg-white border border-gray-200 rounded-2xl overflow-hidden" data-delay="<?php echo ( $i % 4 ) + 1; ?>">
        <button class="fv-faq-trigger w-full flex items-center gap-4 p-6 text-left bg-white hover:bg-blue-50/50 transition-colors" type="button">
          <span class="flex-shrink-0 w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-sm font-jost"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
          <span class="flex-1 text-lg font-bold text-slate-800 font-jost"><?php echo wp_kses_post( $c['title'] ); ?></span>
          <span class="fv-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          </span>
        </button>
        <div class="fv-faq-answer">
          <p class="px-6 pb-6 pl-[4.5rem] text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $c['body'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-10 rounded-2xl p-6 md:p-7 flex flex-col sm:flex-row items-start gap-4 bg-white border border-blue-100 shadow-sm">
      <svg class="flex-shrink-0 w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <p class="text-gray-600 leading-relaxed font-jost flex-1"><?php echo sp_field( 'fv_cond_note', 'Eligibility criteria for the NHS flu vaccine may change based on NHS guidance. If you&rsquo;re unsure whether you qualify, our pharmacists will happily check for you &mdash; just ask in branch or when you book.' ); ?></p>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: PRIVATE FLU JAB — pricing highlight
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="private-flu">
  <div class="absolute top-0 left-0 w-80 h-80 bg-blue-50/60 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">

      <!-- Pricing card -->
      <div class="fv-reveal rounded-3xl p-8 md:p-10 text-white relative overflow-hidden flex flex-col justify-center" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full translate-x-1/3 -translate-y-1/3"></div>
        <div class="relative z-10">
          <span class="inline-block bg-amber-400 text-blue-900 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide mb-5 font-jost"><?php echo sp_field( 'fv_priv_offer', 'Seasonal Introductory Offer' ); ?></span>
          <div class="flex items-end gap-2 mb-3">
            <span class="text-6xl md:text-7xl font-bold font-jost"><?php echo sp_field( 'fv_priv_price', '£20' ); ?></span>
            <span class="text-blue-100 text-lg mb-3 font-jost"><?php echo sp_field( 'fv_priv_price_suffix', 'per private flu jab' ); ?></span>
          </div>
          <p class="text-blue-100 text-lg leading-relaxed mb-7 font-jost"><?php echo sp_field( 'fv_priv_body', 'Don&rsquo;t qualify for a free NHS vaccination? Our convenient private flu jab service gives adults fast, reliable protection against seasonal flu &mdash; no appointment marathon, no GP referral.' ); ?></p>
          <ul class="space-y-3 mb-8">
            <?php foreach ( sp_list( 'fv_priv_points', [ 'Available to adults of all eligibilities', 'Administered by a trained pharmacist', 'Same-day &amp; walk-in appointments', 'Protection against this year&rsquo;s flu strain' ] ) as $point ) : ?>
            <li class="flex items-center gap-3 text-white font-jost">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span><?php echo wp_kses_post( $point ); ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
            <?php echo sp_field( 'fv_priv_btn', 'Book Your Private Flu Jab' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>

      <!-- Where can I get it -->
      <div class="fv-reveal flex flex-col justify-center" data-delay="2">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'fv_priv_r_eyebrow', 'Private Flu Vaccination' ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-5 font-jost"><?php echo sp_field( 'fv_priv_r_heading', 'Where Can I Get a Private Flu Jab?' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'fv_priv_r_body', '<p>Wondering <em>&ldquo;where can I get a private flu jab near me?&rdquo;</em> &mdash; you&rsquo;re in the right place. Southdowns Pharmacy Group offers private flu vaccinations across <strong>Emsworth, Havant, Leigh Park and Rowlands Castle</strong>.</p><p>Appointments are available at all of our pharmacy locations, and many slots can be booked same-day. Our flu vaccine private service is ideal for anyone who wants quick, dependable protection without the wait.</p>' ); ?>
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
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100">
  <div class="absolute top-0 right-0 w-80 h-80 bg-blue-50/60 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'fv_steps_eyebrow', 'Simple &amp; Quick' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'fv_steps_heading', 'Getting Your Flu Jab Is Easy' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'fv_steps_intro', 'From booking to protected in three simple steps &mdash; no GP, no long waits.' ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $fv_steps as $i => $step ) : ?>
      <div class="fv-reveal fv-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="relative overflow-hidden aspect-[3/2]">
          <img src="<?php echo esc_url( $step['image'] ); ?>" alt="<?php echo esc_attr( $step['title'] ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
          <div class="absolute top-3 left-3 w-9 h-9 bg-white text-blue-700 text-sm font-bold rounded-full flex items-center justify-center font-jost"><?php echo esc_html( $i + 1 ); ?></div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $step['title'] ); ?></h3>
          <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $step['body'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S8: LOCATIONS — 4 branch cards (shared with travel health)
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);" id="locations">
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/40 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-100/30 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <span class="badge-numeral text-4xl font-bold text-slate-800 font-jost leading-none">4</span>
        <div class="badge-divider w-px h-8 bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Hampshire Locations</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'fv_loc_heading', 'Visit Your Nearest Flu Clinic' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'fv_loc_intro', 'All four Southdowns Pharmacy locations offer NHS and private flu vaccinations. Same-day appointments usually available &mdash; call ahead to confirm.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ( sp_branch_order() as $pos => $i ) :
        $b     = sp_branch( $i );
        $name  = $b['name'];
        $addr1 = $b['address_line1'];
        $addr2 = $b['address_line2'];
        $hours = sp_branch_hours_html( $b );
        $img   = $b['card_image'];
        $delay = $pos + 1;
      ?>
      <div class="fv-reveal fv-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group flex flex-col" data-delay="<?php echo (int) $delay; ?>">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_attr( $img ); ?>" alt="<?php echo esc_attr( $name ); ?> flu vaccination clinic" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full font-jost">Flu Clinic</span>
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
          <a href="<?php echo esc_url( $booking_url ); ?>" class="mt-auto block text-center text-blue-700 font-semibold text-sm py-2.5 rounded-full border border-blue-200 hover:border-blue-400 hover:bg-blue-50 transition-colors font-jost">
            Book at This Branch
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-10 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center gap-5 bg-white border border-blue-100 shadow-sm">
      <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </div>
      <div class="flex-1">
        <div class="font-bold text-slate-800 font-jost mb-1"><?php echo sp_field( 'fv_loc_note_h', 'Not sure which branch to visit?' ); ?></div>
        <p class="text-gray-600 text-sm font-jost"><?php echo sp_field( 'fv_loc_note_b', 'Each of our four pharmacies books its own flu vaccination appointments. Find your nearest location above and contact that branch directly &mdash; every site offers both NHS and private flu jabs.' ); ?></p>
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
      <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'fv_cta_eyebrow', 'Same-Day Appointments Available' ); ?></span>
    </div>
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'fv_cta_heading', 'Book Your Flu<br/>Vaccination Today' ); ?></h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'fv_cta_body', 'Beat the seasonal rush. Book your private flu jab or NHS flu vaccination at any Southdowns Pharmacy &mdash; quick, convenient protection from Hampshire&rsquo;s trusted pharmacy group.' ); ?></p>

    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php
      $fv_pills = sp_rows( 'fv_pills', [
        ['<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>', 'GPhC Registered'],
        ['<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>', '4 Hampshire Locations'],
        ['<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>', 'Same-Day Appointments'],
        ['<polyline points="20 6 9 17 4 12"/>', 'NHS &amp; Private Jabs'],
        ['<path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/><path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/><path d="M18 12a2 2 0 0 0 0 4h4v-4z"/>', '£20 Private Flu Jab'],
      ], [ 1 => 'text' ] );
      foreach ( $fv_pills as $pill ) : ?>
      <div class="flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $pill[0]; ?></svg>
        <?php echo wp_kses_post( $pill[1] ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-lg px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        Book Your Flu Jab
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Medical disclaimer -->
<div class="bg-slate-50 border-t border-slate-200 py-6">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-xs text-gray-400 leading-relaxed font-jost"><?php echo sp_field( 'fv_disclaimer', '<strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. NHS flu vaccine eligibility is set by the NHS and may change. Always consult a qualified healthcare professional about your individual circumstances. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ); ?></p>
  </div>
</div>

<!-- Accordion JS -->
<script>
(function() {
  document.querySelectorAll('.fv-faq-trigger').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.fv-faq-item');
      var isOpen = item.classList.contains('active');
      document.querySelectorAll('.fv-faq-item.active').forEach(function(el) { el.classList.remove('active'); });
      if (!isOpen) item.classList.add('active');
    });
  });
})();
</script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.fv-reveal');
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
