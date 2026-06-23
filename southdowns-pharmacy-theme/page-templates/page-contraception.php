<?php
/**
 * Template Name: Contraception Services
 *
 * Select this template on the Contraception Services page via Page → Template in the editor.
 *
 * Design mirrors page-flu-vaccinations.php — split hero, blue stat bar, white content
 * sections, scroll-reveal animations, accordion for the FAQ list, and the shared
 * "Hampshire Locations" branch grid (sp_branch data). The location cards link through
 * to each branch's own page (Emsworth, Bosmere/Havant, Davies, Rowlands Castle).
 *
 * Placeholder Unsplash images are used throughout — swap for branded assets later.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// Branch number → branch page URL (matches page-book-appointment.php mapping).
$cs_branch_links = [
    1 => home_url( '/emsworth/' ),
    2 => home_url( '/bosmere/' ),
    3 => home_url( '/davies/' ),
    4 => home_url( '/rowlands-pharmacy/' ),
];

// ── Hero ───────────────────────────────────────────────────────────────────
$cs_hero_image    = ( function_exists( 'get_field' ) ? get_field( 'cs_hero_image' ) : '' ) ?: 'https://southdownspharmacygroup.kinsta.cloud/wp-content/uploads/2026/06/conc.png';
$cs_hero_badge    = sp_field( 'cs_hero_badge',    'Free NHS Service &middot; Confidential &middot; No Referral Needed' );
$cs_hero_headline = sp_field( 'cs_hero_headline', 'Take Control of Your Contraception' );
$cs_hero_body     = sp_field( 'cs_hero_body',     'A free, confidential NHS contraception service at Southdowns Pharmacy Group. Get expert advice, the ongoing contraceptive pill and emergency contraception &mdash; available across Emsworth, Havant, Leigh Park and Rowlands Castle.' );

// ── Stats bar ──────────────────────────────────────────────────────────────
$cs_stats = sp_rows( 'cs_stats', [
    [ 'value' => 'Free',       'label' => 'NHS Service',          'caption' => 'No charge for eligible patients' ],
    [ 'value' => '10 Min',     'label' => 'Consultation',         'caption' => 'Quick, private appointment' ],
    [ 'value' => '100%',       'label' => 'Confidential',         'caption' => 'Private consulting room' ],
    [ 'value' => '4',          'label' => 'Hampshire Locations',  'caption' => 'Book at your nearest branch' ],
], [ 'value' => 'value', 'label' => 'label', 'caption' => 'caption' ] );

// ── What we offer (short list cards) ───────────────────────────────────────
$cs_services = sp_rows( 'cs_services', [
    [ 'icon' => '<path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/>',                                                                          'title' => 'Ongoing Contraceptive Pill', 'body' => 'Start or continue your oral contraceptive pill directly with our pharmacist &mdash; no GP appointment needed.' ],
    [ 'icon' => '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>',                                                                                          'title' => 'Emergency Contraception',    'body' => 'Fast, confidential access to the morning-after pill when you need it most. The sooner you act, the more effective it is.' ],
    [ 'icon' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',                                                            'title' => 'Personalised Consultations', 'body' => 'A friendly chat about your health, lifestyle and preferences so we can recommend the method that suits you best.' ],
    [ 'icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',                                            'title' => 'Ongoing Support',            'body' => 'Follow-up appointments to review your method, manage any side effects and keep you comfortable and confident.' ],
    [ 'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',                                                                              'title' => 'Confidential &amp; Discreet','body' => 'Every consultation takes place in a private room with no judgment &mdash; just professional, respectful care.' ],
    [ 'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>', 'title' => 'Walk-In or Book Ahead', 'body' => 'Flexible appointment times to fit your day. Walk in, book online, or call your nearest branch.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── FAQ (accordion) ────────────────────────────────────────────────────────
$cs_faqs = sp_rows( 'cs_faqs', [
    [ 'title' => 'Is the NHS contraception service free?', 'body' => 'Yes. Our NHS contraception service is provided free of charge to eligible patients. There is no charge for the consultation or for the contraceptive pill supplied through the NHS service. Our pharmacist will confirm your eligibility during your appointment.' ],
    [ 'title' => 'Do I need an appointment or can I walk in?', 'body' => 'Both. Walk-ins are welcome at all four branches, and you can also book ahead online or by phone to guarantee a slot at a time that suits you. For emergency contraception we always recommend contacting us as early as possible.' ],
    [ 'title' => 'What is emergency contraception and how quickly should I take it?', 'body' => 'Emergency contraception (the &ldquo;morning-after pill&rdquo;) can be used after unprotected sex or if your usual contraception may have failed. It is most effective the sooner it is taken &mdash; ideally within 72 hours, though some options work up to 120 hours. Speak to our pharmacist as soon as possible.' ],
    [ 'title' => 'Can I start the contraceptive pill without seeing my GP?', 'body' => 'In most cases, yes. Our trained pharmacists can assess your suitability and supply the oral contraceptive pill directly through the NHS service, saving you a trip to the GP. We&rsquo;ll take a short medical history and blood pressure check to make sure your chosen method is safe for you.' ],
    [ 'title' => 'Is the consultation private and confidential?', 'body' => 'Absolutely. All consultations take place in a private consulting room and everything you discuss is kept strictly confidential. Our team is here to support you without judgment.' ],
    [ 'title' => 'Which contraceptive methods can the pharmacy help with?', 'body' => 'We provide the combined and progesterone-only oral contraceptive pills, emergency contraception, and expert advice on the full range of methods available &mdash; so you can make an informed choice. If a method we don&rsquo;t supply directly is right for you, we&rsquo;ll guide you on the best next step.' ],
], [ 'title' => 'title', 'body' => 'body' ] );

// ── How it works ───────────────────────────────────────────────────────────
$cs_steps = sp_rows( 'cs_steps', [
    [ 'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop', 'title' => 'Book or Walk In',           'body' => 'Book a 10-minute consultation online or by phone, or simply walk in to your nearest branch. Same-day appointments are usually available.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=400&fit=crop', 'title' => 'Private Consultation',      'body' => 'Our pharmacist discusses your health, lifestyle and preferences in a confidential room, then recommends the most suitable option for you.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1559757175-08e3a05cd4e2?w=600&h=400&fit=crop', 'title' => 'Supply &amp; Ongoing Support', 'body' => 'You leave with your chosen contraception and a plan for follow-up &mdash; so any questions or side effects are always covered.' ],
], [ 'image' => 'image', 'title' => 'title', 'body' => 'body' ] );
?>

<!-- Page-scoped styles -->
<style>
  .cs-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .cs-reveal.visible { opacity: 1; transform: translateY(0); }
  .cs-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .cs-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .cs-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .cs-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .cs-reveal[data-delay="5"] { transition-delay: 0.5s; }

  .cs-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s ease; }
  .cs-faq-item.active .cs-faq-answer { max-height: 600px; }
  .cs-faq-item.active .cs-faq-icon { transform: rotate(45deg); }
  .cs-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }
  .cs-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .cs-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .cs-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }

  .cs-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .cs-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
</style>

<!-- ============================================================
     S1: HERO — split blue panel + image
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $cs_hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $cs_hero_badge ); ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $cs_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $cs_hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Now
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost">Free NHS service &middot; Confidential &middot; No referral needed</p>
  </div>

  <!-- Desktop -->
  <div class="hidden md:flex">
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo wp_kses_post( $cs_hero_badge ); ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $cs_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $cs_hero_body ); ?></p>
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
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Free NHS Service</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> 100% Confidential</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Expert Pharmacists</span>
      </div>
    </div>

    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $cs_hero_image ); ?>');"></div>
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
      <?php foreach ( $cs_stats as $i => $stat ) : ?>
      <div class="cs-reveal cs-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $stat['value'] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost"><?php echo esc_html( $stat['label'] ); ?></div>
        <div class="text-xs text-blue-200/60 mt-1 font-jost"><?php echo esc_html( $stat['caption'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: INTRO — Why choose our NHS contraception service
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="cs-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_intro_eyebrow', 'Why Choose Us' ); ?></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'cs_intro_heading', 'Reliable Contraception, Right on Your High Street' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'cs_intro_body', '<p>Choosing our <strong>NHS Contraception Service</strong> means professional advice and genuine support whenever you need it. Our pharmacists are specially trained to provide confidential consultations and recommend the contraceptive method that&rsquo;s right for your body, your lifestyle and your future.</p><p>From starting or continuing the <strong>oral contraceptive pill</strong> to fast, discreet <strong>emergency contraception</strong>, we make accessible reproductive healthcare simple &mdash; no GP referral, no long waits, and no awkwardness.</p><p>We understand that everyone&rsquo;s needs are different. That&rsquo;s why every consultation starts with <em>you</em> &mdash; your health, your questions and your choice.</p>' ); ?>
        </div>
        <div class="mt-8 flex flex-wrap gap-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <?php echo sp_field( 'cs_intro_btn', 'Book a Consultation' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
      <div class="cs-reveal" data-delay="2">
        <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-[4/3]">
          <img src="<?php echo esc_url( sp_field( 'cs_intro_image', 'https://images.unsplash.com/photo-1579165466741-7f35e4755660?w=900&h=675&fit=crop' ) ); ?>" alt="Pharmacist offering a confidential contraception consultation" class="w-full h-full object-cover" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent"></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S4: WHAT WE OFFER — service cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="what-we-offer">
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50/50 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_svc_eyebrow', 'Our Contraception Service' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'cs_svc_heading', 'Everything You Need in One Place' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'cs_svc_intro', 'From your first consultation to ongoing support, our pharmacists are here to help you make confident, informed choices about your reproductive health.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $cs_services as $i => $e ) : $delay = ( $i % 3 ) + 1; ?>
      <div class="cs-reveal cs-card-lift rounded-2xl p-7 border border-blue-100 bg-gradient-to-br from-blue-50 to-white" data-delay="<?php echo (int) $delay; ?>">
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
     S5: EMERGENCY CONTRACEPTION — highlight panel
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="emergency-contraception">
  <div class="absolute top-0 left-0 w-80 h-80 bg-blue-50/60 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">

      <!-- Highlight card -->
      <div class="cs-reveal rounded-3xl p-8 md:p-10 text-white relative overflow-hidden flex flex-col justify-center" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full translate-x-1/3 -translate-y-1/3"></div>
        <div class="relative z-10">
          <span class="inline-block bg-amber-400 text-blue-900 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide mb-5 font-jost"><?php echo sp_field( 'cs_ec_offer', 'Act Fast' ); ?></span>
          <h3 class="text-3xl md:text-4xl font-bold mb-4 font-jost"><?php echo sp_field( 'cs_ec_heading', 'Emergency Contraception' ); ?></h3>
          <p class="text-blue-100 text-lg leading-relaxed mb-7 font-jost"><?php echo sp_field( 'cs_ec_body', 'Need the morning-after pill? Don&rsquo;t wait. Emergency contraception is most effective the sooner it&rsquo;s taken &mdash; our pharmacists provide it quickly, confidentially and without judgment.' ); ?></p>
          <ul class="space-y-3 mb-8">
            <?php foreach ( sp_list( 'cs_ec_points', [ 'Available free on the NHS for eligible patients', 'Most effective within 72 hours', 'Confidential, same-day consultation', 'No appointment or GP referral required' ] ) as $point ) : ?>
            <li class="flex items-center gap-3 text-white font-jost">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span><?php echo wp_kses_post( $point ); ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
            <?php echo sp_field( 'cs_ec_btn', 'Get Emergency Contraception' ); ?>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>

      <!-- Supporting copy -->
      <div class="cs-reveal flex flex-col justify-center" data-delay="2">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_ec_r_eyebrow', 'Here When It Matters' ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-5 font-jost"><?php echo sp_field( 'cs_ec_r_heading', 'Discreet Help, Without the Wait' ); ?></h2>
        <div class="space-y-4 text-lg text-gray-600 leading-relaxed font-jost">
          <?php echo sp_field( 'cs_ec_r_body', '<p>Whether something went wrong or you&rsquo;re simply being careful, our pharmacists are here to help &mdash; calmly, quickly and in complete confidence. There&rsquo;s no need to explain yourself or feel embarrassed.</p><p>Emergency contraception is available across all four of our <strong>Emsworth, Havant, Leigh Park and Rowlands Castle</strong> branches, with same-day consultations and no GP referral needed.</p>' ); ?>
        </div>
        <div class="mt-8 grid grid-cols-2 gap-4">
          <div class="rounded-2xl border border-gray-200/80 p-5 bg-gradient-to-br from-blue-50 to-white">
            <div class="text-2xl font-bold text-slate-800 font-jost mb-1">4 Branches</div>
            <div class="text-sm text-gray-500 font-jost">Across Hampshire</div>
          </div>
          <div class="rounded-2xl border border-gray-200/80 p-5 bg-gradient-to-br from-blue-50 to-white">
            <div class="text-2xl font-bold text-slate-800 font-jost mb-1">Same Day</div>
            <div class="text-sm text-gray-500 font-jost">Consultations available</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S6: HOW IT WORKS — 3 photo steps
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden border-t border-gray-100" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);">
  <div class="absolute top-0 right-0 w-80 h-80 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_steps_eyebrow', 'Simple &amp; Quick' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'cs_steps_heading', 'How Our Service Works' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'cs_steps_intro', 'From booking to peace of mind in three simple steps &mdash; no GP, no long waits.' ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $cs_steps as $i => $step ) : ?>
      <div class="cs-reveal cs-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo (int) $i + 1; ?>">
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
     S7: FAQ — accordion
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="faqs">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_faq_eyebrow', 'Your Questions Answered' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'cs_faq_heading', 'Contraception FAQs' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'cs_faq_intro', 'Everything you might want to know about our NHS contraception service. Tap a question to read more.' ); ?></p>
    </div>

    <div class="space-y-4">
      <?php foreach ( $cs_faqs as $i => $c ) : ?>
      <div class="cs-faq-item cs-reveal bg-white border border-gray-200 rounded-2xl overflow-hidden" data-delay="<?php echo ( $i % 4 ) + 1; ?>">
        <button class="cs-faq-trigger w-full flex items-center gap-4 p-6 text-left bg-white hover:bg-blue-50/50 transition-colors" type="button">
          <span class="flex-shrink-0 w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-sm font-jost"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
          <span class="flex-1 text-lg font-bold text-slate-800 font-jost"><?php echo wp_kses_post( $c['title'] ); ?></span>
          <span class="cs-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          </span>
        </button>
        <div class="cs-faq-answer">
          <p class="px-6 pb-6 pl-[4.5rem] text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $c['body'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S8: LOCATIONS — 4 branch cards (link through to branch pages)
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
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'cs_loc_heading', 'Find Your Nearest Branch' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'cs_loc_intro', 'All four Southdowns Pharmacy locations offer our NHS contraception service. Choose your nearest branch below to see opening hours, contact details and how to find us.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ( sp_branch_order() as $pos => $i ) :
        $b        = sp_branch( $i );
        $name     = $b['name'];
        $addr1    = $b['address_line1'];
        $addr2    = $b['address_line2'];
        $hours    = sp_branch_hours_html( $b );
        $img      = $b['card_image'];
        $page_url = $cs_branch_links[ $i ] ?? $booking_url;
        $delay    = $pos + 1;
      ?>
      <a href="<?php echo esc_url( $page_url ); ?>" class="cs-reveal cs-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group flex flex-col" data-delay="<?php echo (int) $delay; ?>">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_attr( $img ); ?>" alt="<?php echo esc_attr( $name ); ?> contraception service" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full font-jost">Contraception</span>
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
        <div class="font-bold text-slate-800 font-jost mb-1"><?php echo sp_field( 'cs_loc_note_h', 'Not sure which branch to visit?' ); ?></div>
        <p class="text-gray-600 text-sm font-jost"><?php echo sp_field( 'cs_loc_note_b', 'Every one of our four pharmacies offers the full NHS contraception service. Choose the location nearest to you above to view its details, or contact us and we&rsquo;ll happily point you to the right branch.' ); ?></p>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S9: BOOKING FORM
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden border-t border-gray-100" id="book">
  <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50/50 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_book_eyebrow', 'Book Your Consultation' ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'cs_book_heading', 'Reserve Your 10-Minute Appointment' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost">Fill out the form below to book a 10-minute consultation for emergency or NHS contraceptive pill.</p>
    </div>

    <div class="cs-reveal rounded-3xl border border-blue-100 shadow-sm bg-gradient-to-br from-blue-50 to-white p-6 md:p-10">
      <?php echo do_shortcode( '[contact-form-7 id="contraception-booking" title="Contraception Booking"]' ); ?>
      <p class="text-center text-sm text-gray-400 mt-6 font-jost"><?php echo sp_field( 'cs_book_formnote', 'By submitting this form you consent to Southdowns Pharmacy Group contacting you about your appointment. Your information is kept strictly confidential.' ); ?></p>
    </div>
  </div>
</section>


<!-- ============================================================
     S10: FINAL CTA
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-8">
      <div class="badge-rule w-10 h-px bg-white/15"></div>
      <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'cs_cta_eyebrow', 'Confidential &amp; Free on the NHS' ); ?></span>
    </div>
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'cs_cta_heading', 'Take Control of Your<br/>Reproductive Health' ); ?></h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost"><?php echo sp_field( 'cs_cta_body', 'Confidential advice, the contraceptive pill and emergency contraception &mdash; available at any Southdowns Pharmacy. Take the next step with Hampshire&rsquo;s trusted pharmacy group.' ); ?></p>

    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php
      $cs_pills = sp_rows( 'cs_pills', [
        ['<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>', 'GPhC Registered'],
        ['<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>', '4 Hampshire Locations'],
        ['<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>', '100% Confidential'],
        ['<polyline points="20 6 9 17 4 12"/>', 'Free NHS Service'],
        ['<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>', 'Same-Day Appointments'],
      ], [ 1 => 'text' ] );
      foreach ( $cs_pills as $pill ) : ?>
      <div class="flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $pill[0]; ?></svg>
        <?php echo wp_kses_post( $pill[1] ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-lg px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        Book a Consultation
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- Medical disclaimer -->
<div class="bg-slate-50 border-t border-slate-200 py-6">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-xs text-gray-400 leading-relaxed font-jost"><?php echo sp_field( 'cs_disclaimer', '<strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. Eligibility for the NHS contraception service is set by the NHS and may change. Always consult a qualified healthcare professional about your individual circumstances. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ); ?></p>
  </div>
</div>

<!-- Accordion JS -->
<script>
(function() {
  document.querySelectorAll('.cs-faq-trigger').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.cs-faq-item');
      var isOpen = item.classList.contains('active');
      document.querySelectorAll('.cs-faq-item.active').forEach(function(el) { el.classList.remove('active'); });
      if (!isOpen) item.classList.add('active');
    });
  });
})();
</script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.cs-reveal');
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
