<?php
/**
 * Template Name: COVID-19 Vaccine
 *
 * Select this template on the COVID-19 Vaccine page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// ── ACF-backed copy (with hardcoded fallbacks) ─────────────────────────────
$cv_hero_image      = ( function_exists( 'get_field' ) ? get_field( 'cv_nhs_hero_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop';
$cv_programme_image = ( function_exists( 'get_field' ) ? get_field( 'cv_nhs_programme_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&q=80&auto=format&fit=crop';
$cv_hero_badge      = sp_field( 'cv_nhs_hero_badge',      'NHS Seasonal Vaccination · Hampshire' );
$cv_hero_headline   = sp_field( 'cv_nhs_hero_headline',   'Free NHS COVID-19 Vaccination at Southdowns Pharmacy' );
$cv_hero_body       = sp_field( 'cv_nhs_hero_body',       'Eligible patients can receive their seasonal COVID-19 vaccine free of charge at any of our four Hampshire locations. No long waits, no hassle &mdash; walk in or book online today.' );
$cv_programme_name  = sp_field( 'cv_nhs_programme_name',  'Spring 2026 Programme' );
$cv_programme_intro = sp_field( 'cv_nhs_programme_intro', 'For Spring 2026, the JCVI has updated its advice, focusing the programme on those at highest risk of serious disease. Free NHS COVID-19 vaccinations are now offered to the following groups only:' );
$cv_elig_eyebrow    = sp_field( 'cv_nhs_elig_eyebrow',    'Spring 2026 Eligibility' );
$cv_elig_headline   = sp_field( 'cv_nhs_elig_headline',   'Are You Eligible for a Free NHS COVID Vaccine?' );
$cv_elig_subhead    = sp_field( 'cv_nhs_elig_subhead',    'The Spring 2026 programme is targeted at those at highest risk. Check whether you qualify below.' );
$cv_promo_body      = sp_field( 'cv_nhs_promo_body',      'If you don\'t currently meet the NHS eligibility criteria for Spring 2026, you can still protect yourself with our private COVID-19 vaccination service. We offer the latest Pfizer COVID-19 vaccine privately for <strong>&pound;92.50 per dose</strong> &mdash; ideal for those who want to stay protected but fall outside the current NHS cohorts.' );
$cv_locations_eyebrow  = sp_field( 'cv_nhs_locations_eyebrow',  '4 Locations Across Hampshire' );
$cv_locations_headline = sp_field( 'cv_nhs_locations_headline', 'Book at Your Nearest Hampshire Branch' );
$cv_locations_subhead  = sp_field( 'cv_nhs_locations_subhead',  'Free NHS COVID-19 vaccinations available at all four Southdowns Pharmacy locations.' );
$cv_final_headline  = sp_field( 'cv_nhs_final_cta_headline', 'Protect Yourself This Season &mdash; Book Your Free NHS COVID Vaccine Today' );
$cv_final_body      = sp_field( 'cv_nhs_final_cta_body',     'All four Southdowns Pharmacy locations offer NHS COVID-19 vaccination for eligible patients. Walk in during opening hours or book online now.' );

// Repeater: eligible-groups bullet list
$cv_groups_raw = function_exists( 'get_field' ) ? get_field( 'cv_nhs_programme_groups' ) : null;
$cv_groups     = ! empty( $cv_groups_raw ) ? array_column( $cv_groups_raw, 'text' ) : [
    'Adults aged 75 years and over',
    'Residents in care homes for older adults',
    'Individuals who are immunosuppressed, aged 6 months and over',
];

// Repeater: eligibility cards
$cv_cards_raw = function_exists( 'get_field' ) ? get_field( 'cv_nhs_elig_cards' ) : null;
$cv_cards     = ! empty( $cv_cards_raw ) ? $cv_cards_raw : [
    [
        'title' => 'Adults Aged 75 and Over',
        'body'  => 'If you are 75 years of age or older, you are eligible for a free NHS COVID-19 vaccine this season. You should receive an invitation from the NHS, but you can also book directly without waiting for a letter.',
    ],
    [
        'title' => 'Care Home Residents',
        'body'  => 'Residents in care homes for older adults are eligible for a free NHS COVID-19 vaccine. Vaccination is typically arranged through your care home, but please speak to our team if you need assistance.',
    ],
    [
        'title' => 'Immunosuppressed Individuals (Aged 6 Months+)',
        'body'  => 'If you or your child are immunosuppressed due to a medical condition or treatment — such as chemotherapy, certain immunological conditions, or organ transplant — you are eligible regardless of age. Please bring details of your condition to your appointment.',
    ],
];

// Sections previously hardcoded — now editable (Booking / Safety / FAQ tab).
$cv_programme_headline = sp_field( 'cv_nhs_programme_headline', 'Protecting Those Most at Risk' );

$cv_book_headline = sp_field( 'cv_nhs_book_headline', 'Three Ways to Book Your NHS COVID Vaccine' );
$cv_book_subhead  = sp_field( 'cv_nhs_book_subhead', 'Booking is simple. Choose whichever method works best for you.' );
$cv_book_methods_raw = function_exists( 'get_field' ) ? get_field( 'cv_nhs_book_methods' ) : null;
$cv_book_methods = ! empty( $cv_book_methods_raw ) ? $cv_book_methods_raw : [
    [ 'title' => 'Book Online', 'body' => 'Use the NHS app or visit nhs.uk to book your COVID-19 vaccine appointment at your nearest Southdowns Pharmacy branch. Available 24 hours a day.' ],
    [ 'title' => 'Call 119', 'body' => 'Call 119 free of charge to book your NHS COVID-19 vaccine by phone. Lines are open seven days a week.' ],
    [ 'title' => 'Walk In or Call Us', 'body' => 'Visit any of our four Hampshire locations during opening hours and speak to our team directly, or call your nearest branch and we&apos;ll book you in.' ],
];
$cv_book_note = sp_field( 'cv_nhs_book_note', 'Eligible patients will receive a notification from the NHS inviting them to book their seasonal COVID-19 vaccine. <strong>You do not need to wait for this letter</strong> &mdash; you can book proactively at any time.' );

$cv_safety_headline = sp_field( 'cv_nhs_safety_headline', 'Safe, Approved, and Effective' );
$cv_safety_subhead  = sp_field( 'cv_nhs_safety_subhead', 'Every COVID-19 vaccine offered through Southdowns Pharmacy is approved by the Medicines and Healthcare products Regulatory Agency (MHRA).' );
$cv_safety_cards_raw = function_exists( 'get_field' ) ? get_field( 'cv_nhs_safety_cards' ) : null;
$cv_safety_cards = ! empty( $cv_safety_cards_raw ) ? $cv_safety_cards_raw : [
    [ 'title' => 'Are COVID-19 Vaccines Safe?', 'body' => 'Yes. All vaccines offered under the NHS programme are approved by the MHRA and subject to ongoing safety monitoring. They have been administered to hundreds of millions of people worldwide and have a well-established safety record.' ],
    [ 'title' => 'What Side Effects Should I Expect?', 'body' => 'Side effects are typically mild and short-lived. The most common include a sore or tender arm at the injection site, mild fatigue, headache, or flu-like symptoms in the day or two following vaccination. Serious reactions are extremely rare.<br><br>Our pharmacists observe all patients for a short period after vaccination.' ],
];
$cv_safety_note = sp_field( 'cv_nhs_safety_note', '<strong class="text-white">Which vaccine will I receive?</strong> Vaccine availability may vary by season and location. Our pharmacy team will confirm which vaccine you will receive when you book or arrive for your appointment.' );

$cv_promo_headline = sp_field( 'cv_nhs_promo_headline', 'Not Eligible for the NHS Vaccine?' );

$cv_faqs_raw = function_exists( 'get_field' ) ? get_field( 'cv_nhs_faqs' ) : null;
$cv_faqs = ! empty( $cv_faqs_raw ) ? $cv_faqs_raw : [
    [ 'question' => 'Do I need a letter or invitation before I can book?', 'answer' => 'No. While eligible patients will receive an NHS notification, you do not need to wait for it. You can book proactively at any of our branches, via the NHS app, or by calling 119.' ],
    [ 'question' => 'Is the vaccine really free?', 'answer' => 'Yes. If you meet the current NHS eligibility criteria, your COVID-19 vaccine is completely free of charge &mdash; there is nothing to pay.' ],
    [ 'question' => 'Which vaccine will I receive?', 'answer' => 'Vaccine availability varies by season. Our team will confirm which vaccine you will receive at the time of booking or at your appointment.' ],
    [ 'question' => 'How long does the appointment take?', 'answer' => 'The vaccination itself takes only a few minutes. We ask patients to remain for a short observation period afterwards &mdash; typically 10 to 15 minutes in total.' ],
    [ 'question' => 'Can I bring someone with me?', 'answer' => 'Yes. You are welcome to bring a family member or carer. Please let our team know in advance if you require any assistance.' ],
    [ 'question' => 'I was eligible last season but don&apos;t see myself in the current list &mdash; what should I do?', 'answer' => 'The eligibility criteria changed for Spring 2026. If you are no longer included in the NHS cohorts, you may wish to consider our private vaccination service at &pound;92.50. Speak to our pharmacist for personalised advice.' ],
    [ 'question' => 'Is the vaccine safe for immunosuppressed patients?', 'answer' => 'Yes. Immunosuppressed individuals are actually a priority group for the NHS programme, as they are at higher risk of serious illness. Please bring details of your condition or treatment to your appointment so our pharmacist can advise appropriately.' ],
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
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $cv_hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start">
      <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-blue-300"></span></span>
      <?php echo esc_html( $cv_hero_badge ); ?>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $cv_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $cv_hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Your NHS COVID Vaccine
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <div class="flex flex-wrap gap-4 text-white/90 text-xs font-jost">
      <span>&#10003; Free NHS Funded</span>
      <span>&#10003; No Long Waits</span>
      <span>&#10003; Same Day Available</span>
    </div>
  </div>

  <!-- Desktop: 2-column split -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start">
        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-300"></span></span>
        <?php echo esc_html( $cv_hero_badge ); ?>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $cv_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $cv_hero_body ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Your NHS COVID Vaccine
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#eligibility" class="inline-flex items-center gap-2 text-white/80 text-sm font-medium px-5 py-3 rounded-full hover:text-white transition-colors font-jost">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          Check If You&apos;re Eligible
        </a>
      </div>
      <div class="flex flex-wrap gap-5 text-white text-sm font-jost">
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          GPhC Registered
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Free NHS Funded
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          Same Day Available
        </span>
      </div>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $cv_hero_image ); ?>');"></div>
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
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">Free</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">of Charge</div>
      </div>

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="2">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">NHS</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">Funded</div>
      </div>

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="3">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">4</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">Hampshire Locations</div>
      </div>

      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="4">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">Same</div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost">Day Appointments Available</div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S3: WHAT IS THE PROGRAMME — Light gradient, two-col + Spring 2026
     ============================================================ -->
<section class="py-16 md:py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50/30 relative overflow-hidden">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/30 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-100/20 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Two-column intro -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center mb-16 yf-reveal">
      <div>
        <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-xs font-semibold px-4 py-2 rounded-full mb-6 border border-blue-100 uppercase tracking-wider">NHS COVID-19 Programme</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $cv_programme_headline ); ?></h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-5 font-jost">The NHS seasonal COVID-19 vaccination programme provides free vaccines to those most vulnerable to serious illness from COVID-19. The programme is reviewed regularly by the Joint Committee on Vaccination and Immunisation (JCVI), whose recommendations are accepted by ministers and form the basis of NHS eligibility each season.</p>
        <p class="text-gray-600 text-lg leading-relaxed font-jost">By getting vaccinated, you help protect yourself from serious illness, hospitalisation, and the complications that COVID-19 can cause &mdash; particularly if you are older or have an underlying health condition.</p>
      </div>
      <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
        <img src="<?php echo esc_url( $cv_programme_image ); ?>" alt="Pharmacist administering a vaccination" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">GPhC-Registered Pharmacists</span>
        </div>
      </div>
    </div>

    <!-- Spring 2026 programme box -->
    <div class="yf-reveal bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
      <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 md:px-8 py-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-white flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <span class="text-white font-semibold font-jost"><?php echo esc_html( $cv_programme_name ); ?></span>
      </div>
      <div class="p-6 md:p-8">
        <p class="text-gray-600 leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $cv_programme_intro ); ?></p>
        <ul class="space-y-3 mb-6">
          <?php foreach ( $cv_groups as $group_text ) : ?>
          <li class="flex items-center gap-3 text-gray-700 font-jost">
            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
              <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo esc_html( $group_text ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="bg-amber-50 rounded-xl p-4 border border-amber-200 flex items-start gap-3">
          <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <p class="text-amber-800 text-sm leading-relaxed font-jost"><strong>Please note:</strong> this represents a change from previous programmes, which included a broader range of cohorts. If you were eligible in a previous season, please check the current criteria before booking.</p>
        </div>
      </div>
    </div>

  </div>
</section>


<!-- ============================================================
     S4: ELIGIBILITY — Blue gradient, 3 eligibility cards
     ============================================================ -->
<section class="py-16 md:py-24 overflow-hidden relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="eligibility">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-14 yf-reveal">
      <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/30">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold"><?php echo esc_html( $cv_elig_eyebrow ); ?></span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost"><?php echo esc_html( $cv_elig_headline ); ?></h2>
      <p class="text-lg text-blue-100 max-w-3xl mx-auto font-jost"><?php echo wp_kses_post( $cv_elig_subhead ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-10 yf-reveal">

      <?php
      $card_icons = [
        '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>',
        '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
        '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
      ];
      foreach ( $cv_cards as $idx => $card ) :
        $icon = $card_icons[ $idx % count( $card_icons ) ];
      ?>
      <div class="yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300" data-delay="<?php echo (int) ( $idx + 1 ); ?>">
        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icon; ?></svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-3 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-blue-100 leading-relaxed text-sm font-jost"><?php echo wp_kses_post( $card['body'] ); ?></p>
      </div>
      <?php endforeach; ?>

    </div>

    <!-- Info box -->
    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 flex items-start gap-5 yf-reveal">
      <svg class="w-7 h-7 text-blue-200 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      <div>
        <p class="text-white font-semibold mb-1 font-jost">Not sure if you qualify?</p>
        <p class="text-blue-100 leading-relaxed text-sm font-jost">Speak to one of our pharmacists &mdash; we&apos;re happy to check your eligibility and advise on the right next step, including whether the private vaccine might be more appropriate for you.</p>
      </div>
    </div>

  </div>
</section>


<!-- ============================================================
     S5: HOW TO BOOK — Light gradient, 3 booking method steps
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f8fafc 100%);" id="how-to-book">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-14 yf-reveal">
      <div class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100 shadow-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">How to Book</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo esc_html( $cv_book_headline ); ?></h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost"><?php echo esc_html( $cv_book_subhead ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-10 yf-reveal">

      <?php foreach ( $cv_book_methods as $mi => $method ) : ?>
      <div class="yf-step bg-white rounded-2xl p-8 border border-blue-100/50 shadow-sm hover:shadow-xl hover:shadow-blue-100/30 hover:-translate-y-1 transition-all duration-300" data-delay="<?php echo (int) ( $mi + 1 ); ?>">
        <div class="yf-step-num w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-2xl flex items-center justify-center text-xl font-bold mb-5 shadow-lg shadow-blue-500/25"><?php echo (int) ( $mi + 1 ); ?></div>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $method['title'] ?? '' ); ?></h3>
        <p class="text-gray-600 leading-relaxed font-jost"><?php echo $method['body'] ?? ''; ?></p>
      </div>
      <?php endforeach; ?>

    </div>

    <!-- Info box -->
    <div class="max-w-3xl mx-auto bg-blue-50 rounded-2xl p-6 border border-blue-100 flex items-start gap-4 yf-reveal">
      <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      <p class="text-blue-700 text-sm leading-relaxed font-jost"><?php echo $cv_book_note; ?></p>
    </div>

  </div>
</section>


<!-- ============================================================
     S6: SAFETY & SIDE EFFECTS — Blue gradient, 2 white cards
     ============================================================ -->
<section class="py-16 md:py-24 overflow-hidden relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-14 yf-reveal">
      <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/30">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">Safety Information</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost"><?php echo esc_html( $cv_safety_headline ); ?></h2>
      <p class="text-lg text-blue-100 max-w-3xl mx-auto font-jost"><?php echo esc_html( $cv_safety_subhead ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-10 yf-reveal">

      <?php
      $cv_safety_icons = [
        '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
        '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/>',
      ];
      foreach ( $cv_safety_cards as $si => $card ) : ?>
      <div class="bg-white rounded-2xl p-8 border border-gray-200 yf-card-lift shadow-sm">
        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $cv_safety_icons[ $si % count( $cv_safety_icons ) ]; ?></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-4 font-jost"><?php echo esc_html( $card['title'] ?? '' ); ?></h3>
        <p class="text-gray-600 leading-relaxed font-jost"><?php echo $card['body'] ?? ''; ?></p>
      </div>
      <?php endforeach; ?>

    </div>

    <!-- Vaccine info box -->
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 flex items-start gap-4 yf-reveal">
      <svg class="w-6 h-6 text-blue-200 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo $cv_safety_note; ?></p>
    </div>

  </div>
</section>


<!-- ============================================================
     S7: NOT ELIGIBLE — Light, private vaccine promotion
     ============================================================ -->
<section class="py-16 md:py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50/30 relative overflow-hidden">
  <div class="absolute top-0 left-0 w-72 h-72 bg-blue-100/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center yf-reveal">

    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      <span class="uppercase tracking-wider text-xs font-semibold">Private Vaccination Available</span>
    </div>

    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $cv_promo_headline ); ?></h2>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8 leading-relaxed font-jost"><?php echo wp_kses_post( $cv_promo_body ); ?></p>

    <a href="<?php echo esc_url( home_url( '/covid-vaccine-private/' ) ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-full transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.02] text-base font-jost">
      Find Out About Our Private COVID Vaccine
      <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>

  </div>
</section>


<!-- ============================================================
     S8: LOCATIONS — White bg, 4 branch photo cards
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden bg-white" id="locations">
  <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 32px 32px;"></div>
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-100/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-10 md:mb-14">
      <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold"><?php echo esc_html( $cv_locations_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $cv_locations_headline ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo wp_kses_post( $cv_locations_subhead ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 yf-reveal">
      <?php foreach ( sp_branch_order() as $i ) :
        $b = sp_branch( $i ); ?>
      <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b['name'] ); ?> branch" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
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
            Book Here
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
        <p class="text-white text-lg font-semibold mb-1 font-jost">Walk-ins welcome at all four branches</p>
        <p class="text-blue-100 text-base font-jost">No letter required. If you meet the eligibility criteria, visit any branch during opening hours and our team will vaccinate you the same day.</p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        Book Online
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S9: FAQ — Light gradient, sticky sidebar + accordion
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" id="faq" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f8fafc 100%);">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-200/15 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

      <!-- Sticky sidebar -->
      <div class="lg:col-span-4 lg:sticky lg:top-28 lg:self-start yf-reveal">
        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
          <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span></span>
          <span class="uppercase tracking-wider text-xs font-semibold">FAQs</span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost">COVID-19 Vaccine FAQs</h2>
        <p class="text-lg text-gray-500 leading-relaxed mb-8 font-jost">Common questions about the NHS COVID-19 vaccination service at Southdowns Pharmacy.</p>
        <div class="hidden lg:grid grid-cols-3 gap-4 mb-8">
          <div class="text-center p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="text-2xl font-bold text-slate-800 mb-1 font-jost">4.9</div>
            <div class="text-gray-400 text-xs font-medium">Rating</div>
          </div>
          <div class="text-center p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="text-2xl font-bold text-slate-800 mb-1 font-jost">400+</div>
            <div class="text-gray-400 text-xs font-medium">Reviews</div>
          </div>
          <div class="text-center p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="text-2xl font-bold text-slate-800 mb-1 font-jost">10k+</div>
            <div class="text-gray-400 text-xs font-medium">Patients</div>
          </div>
        </div>
        <div class="hidden lg:block space-y-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-all shadow-lg shadow-blue-500/25 font-jost">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Book Your NHS COVID Vaccine
          </a>
          <p class="text-gray-400 text-sm text-center font-jost">Free for eligible patients &middot; Same-day available</p>
        </div>
      </div>

      <!-- FAQ accordion -->
      <div class="lg:col-span-8 yf-reveal" data-delay="2">
        <div class="space-y-4" id="faq-list">

          <?php
          foreach ( $cv_faqs as $fi => $faq ) : ?>
          <div class="yf-faq-item bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg">
            <button class="yf-faq-trigger w-full flex items-center justify-between text-left p-6 hover:bg-gray-50/50 transition-colors">
              <div class="flex items-center gap-4 flex-1">
                <span class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md shadow-blue-500/20"><?php echo esc_html( str_pad( (string) ( $fi + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <span class="text-slate-800 font-semibold text-base md:text-lg font-jost"><?php echo esc_html( $faq['question'] ?? '' ); ?></span>
              </div>
              <svg class="yf-faq-icon w-5 h-5 text-blue-400 flex-shrink-0 ml-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="yf-faq-answer"><div class="px-6 pb-6 pt-0 text-gray-600 leading-relaxed text-base font-jost"><?php echo $faq['answer'] ?? ''; ?></div></div>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S10: FINAL CTA — Blue gradient, badge pills, CTAs, trust stats
     ============================================================ -->
<section class="py-16 md:py-24 overflow-hidden relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="book">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

    <!-- Trust badge pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-8 yf-reveal">
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">NHS Funded</span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">Free of Charge</span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30"><?php echo esc_html( $cv_programme_name ); ?></span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">GPhC Registered</span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">Same-Day Available</span>
    </div>

    <div class="yf-reveal mb-8">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 font-jost"><?php echo wp_kses_post( $cv_final_headline ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-10 font-jost"><?php echo wp_kses_post( $cv_final_body ); ?></p>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10 yf-reveal" data-delay="1">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold px-8 py-4 rounded-full hover:bg-blue-50 transition-all shadow-lg text-lg hover:scale-[1.02] hover:shadow-xl font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Book Your NHS COVID Vaccine
      </a>
      <a href="#locations" class="inline-flex items-center justify-center gap-2 text-white font-medium border-2 border-white/30 px-8 py-4 rounded-full hover:bg-white/10 transition-all text-lg hover:border-white/50 font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        Find Your Nearest Branch
      </a>
    </div>

    <!-- Trust stats row -->
    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12 mt-10 yf-reveal" data-delay="2">
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">Free</div>
        <div class="text-blue-200 text-sm font-jost">of Charge</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">4</div>
        <div class="text-blue-200 text-sm font-jost">Hampshire Locations</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">Same Day</div>
        <div class="text-blue-200 text-sm font-jost">Available</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">GPhC</div>
        <div class="text-blue-200 text-sm font-jost">Registered</div>
      </div>
    </div>

  </div>
</section>


<!-- Medical disclaimer strip -->
<div class="bg-gray-100 border-t border-gray-200 py-6">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-gray-400 text-xs leading-relaxed text-center font-jost">This page provides general information about the NHS COVID-19 vaccination programme for Spring 2026. Eligibility criteria are set by the JCVI and NHS England and are subject to change. Information is accurate as of April 2026. Please consult the latest NHS guidance or speak to one of our GPhC-registered pharmacists for personalised advice.</p>
  </div>
</div>


<!-- FAQ Accordion JS -->
<script>
document.querySelectorAll('.yf-faq-trigger').forEach(function(btn) {
  btn.addEventListener('click', function() {
    var item = this.closest('.yf-faq-item');
    var isActive = item.classList.contains('active');
    document.querySelectorAll('.yf-faq-item').forEach(function(el) { el.classList.remove('active'); });
    if (!isActive) item.classList.add('active');
  });
});
</script>

<!-- Scroll Reveal JS -->
<script>
(function() {
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
