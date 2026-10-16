<?php
/**
 * Template Name: Weight Loss
 *
 * Select this template on the Weight Loss page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
// No phone number is shown on this page by design — enquiries route through the
// consultation booking so that clinical questions are answered in person.

$hero_image     = ( function_exists( 'get_field' ) ? get_field( 'wl_hero_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&q=80&auto=format&fit=crop';
$hero_headline  = sp_field( 'wl_hero_headline',  'Clinically supervised weight loss at your local Hampshire pharmacy' );
$hero_body      = sp_field( 'wl_hero_body',      'A supervised weight management programme led by our GPhC-registered pharmacists, with a face-to-face assessment and monthly in-person reviews at four local Hampshire branches. Start with a face-to-face consultation &mdash; no GP referral needed.' );
$hero_badge     = sp_field( 'wl_hero_badge_text', 'Weight Management &middot; Hampshire' );

// The former S3 (clinical evidence chart) and S4 (named medicine cards)
// sections were removed: a weight management page may promote the
// consultation-led service but not a prescription-only medicine, directly
// or by implication (CAP AdviceOnline, "Weight control: Prescription-only
// medicines"). Do not reintroduce medicine names, classes or trial figures.

// Testimonials (S7)
$testimonials_eyebrow  = sp_field( 'wl_testimonials_eyebrow',  'Patient Stories' );
$testimonials_headline = sp_field( 'wl_testimonials_headline', 'Real patients, real results' );
$testimonials_subhead  = sp_field( 'wl_testimonials_subhead',  'What Hampshire patients say about the care they receive on our weight management programme. Individual results vary.' );

// No placeholder reviews. The section renders only when real, consented patient
// reviews are entered in the editor (wl_testimonials_reviews). The previous
// defaults were sample copy naming prescription-only medicines with weight-loss
// figures, which cannot appear on a public page.
$testimonials_reviews_raw = function_exists( 'get_field' ) ? get_field( 'wl_testimonials_reviews' ) : null;
$testimonials_reviews     = ! empty( $testimonials_reviews_raw ) ? $testimonials_reviews_raw : [];

$testimonials_trust_raw = function_exists( 'get_field' ) ? get_field( 'wl_testimonials_trust' ) : null;
$testimonials_trust     = ! empty( $testimonials_trust_raw ) ? $testimonials_trust_raw : [
    [ 'value' => '4.9/5', 'caption' => 'average rating'    ],
    [ 'value' => '400+',  'caption' => 'verified reviews'  ],
    [ 'value' => 'GPhC',  'caption' => 'registered'        ],
];

// Trust-row icons cycle by position (star → people → shield).
$testimonials_trust_icons = [
    '<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
    '<svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>',
    '<svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
    '<svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
];

// FAQ (S10)
$faq_eyebrow   = sp_field( 'wl_faq_eyebrow',   'FAQs' );
$faq_headline  = sp_field( 'wl_faq_headline',  'Common questions about weight management' );
$faq_intro     = sp_field( 'wl_faq_intro',     'Everything you need to know before starting. Can&rsquo;t find your answer? Ask us at your consultation.' );
$faq_cta_label = sp_field( 'wl_faq_cta_label', 'Book a Consultation' );

$faq_stats_raw = function_exists( 'get_field' ) ? get_field( 'wl_faq_stats' ) : null;
$faq_stats     = ! empty( $faq_stats_raw ) ? $faq_stats_raw : [
    [ 'value' => '4.9',  'label' => 'Rating'   ],
    [ 'value' => '400+', 'label' => 'Reviews'  ],
    [ 'value' => '10k+', 'label' => 'Patients' ],
];

$faq_items_raw = function_exists( 'get_field' ) ? get_field( 'wl_faq_items' ) : null;
$faq_items     = ! empty( $faq_items_raw ) ? $faq_items_raw : [
    [ 'question' => 'Am I eligible?',
      'answer'   => 'The programme is for adults with a BMI of 30 or above, or a BMI of 27 or above alongside a weight-related health condition such as type 2 diabetes, high blood pressure, high cholesterol or sleep apnoea. Meeting these criteria does not automatically mean the programme is right for you &mdash; your pharmacist will carry out a full assessment of your medical history and current medicines, and will tell you honestly if it is not suitable.' ],
    [ 'question' => 'Is the programme suitable for everyone?',
      'answer'   => 'No. It is not suitable if you are pregnant, breastfeeding or trying to conceive, and some medical conditions and medicines mean it may not be appropriate. Your pharmacist will review your full medical history and every medicine you take, including anything bought over the counter, before agreeing a plan with you.' ],
    [ 'question' => 'Do I still need to change my diet and activity?',
      'answer'   => 'Yes. Healthy eating and regular activity are the foundation of every plan. Your pharmacist will give you practical dietary and lifestyle advice, and review your progress with you at each monthly visit.' ],
    [ 'question' => 'Do I need a GP referral?',
      'answer'   => 'No. You can book a consultation directly with our pharmacists &mdash; no GP referral and no NHS waiting list. With your consent we will keep your GP informed.' ],
    [ 'question' => 'How much weight will I lose?',
      'answer'   => 'Everyone is different, so we do not make promises about how much you will lose or how quickly. Your pharmacist will agree realistic, safe goals with you and track your progress at your monthly reviews.' ],
    [ 'question' => 'What happens at my monthly reviews?',
      'answer'   => 'Each month you see a pharmacist in person at your chosen branch. We check your weight and blood pressure, talk through how you are getting on, and adjust your plan where needed.' ],
    [ 'question' => 'How much does the programme cost?',
      'answer'   => 'The initial consultation is &pound;20, with no obligation to go ahead. Costs depend on the plan agreed with your pharmacist, and we give you a full breakdown at your consultation before you decide whether to go ahead.' ],
    [ 'question' => 'Can I join if I have type 2 diabetes?',
      'answer'   => 'Possibly, but it needs careful assessment. Your pharmacist will review your diabetes care and current medicines thoroughly, particularly if you take insulin or other diabetes medication, and we will coordinate with your GP or diabetes team where appropriate.' ],
    [ 'question' => 'What happens when I reach my goal weight?',
      'answer'   => 'We will work with you on a structured plan to help you maintain your progress, with ongoing lifestyle and dietary advice. Keeping weight off can be harder than losing it, so we talk openly about what to expect and how to plan for it.' ],
];

// S5 Benefits — client-editable (Weight Loss → Benefits / Steps / Why). Card icons stay in code, by position.
$benefits_raw = function_exists( 'get_field' ) ? get_field( 'wl_benefits' ) : null;
$benefits     = ! empty( $benefits_raw ) ? $benefits_raw : [
    [ 'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=600&q=80&auto=format&fit=crop', 'title' => 'Gradual weight loss',           'desc' => 'A supervised plan aims for steady, sustainable progress at a pace that is safe for you. Results vary from person to person.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=600&q=80&auto=format&fit=crop', 'title' => 'Blood sugar control',           'desc' => 'Losing excess weight can improve blood sugar control. If you already take diabetes medication, your pharmacist will review it with you.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80&auto=format&fit=crop', 'title' => 'Energy and sleep',              'desc' => 'Many patients tell us they notice better energy levels, improved sleep and more motivation to be active as their weight reduces.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=600&q=80&auto=format&fit=crop', 'title' => 'Wider health markers',          'desc' => 'Reaching a healthier weight can help with blood pressure and cholesterol. We monitor these at your monthly reviews and refer you to your GP where appropriate.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&q=80&auto=format&fit=crop', 'title' => 'Confidence and wellbeing',      'desc' => 'Many patients describe feeling more confident and positive as they make progress &mdash; often the change they value most.' ],
    [ 'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=600&q=80&auto=format&fit=crop', 'title' => 'Less pressure on joints',       'desc' => 'Carrying less weight means less load on knees, hips and ankles. Some patients report this makes everyday movement more comfortable.' ],
];
$benefit_icons = [
    '<path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
];

// S6 Steps — client-editable. Numbers + alternating colours stay in code, by position.
$steps_raw = function_exists( 'get_field' ) ? get_field( 'wl_steps' ) : null;
$steps     = ! empty( $steps_raw ) ? $steps_raw : [
    [ 'title' => 'Consultation &amp; assessment', 'desc' => 'Book an appointment at your nearest Southdowns branch. Our pharmacist reviews your medical history, medication, measured BMI and health goals to decide whether treatment is appropriate.' ],
    [ 'title' => 'Your personalised plan', 'desc' => 'If the programme is right for you, your pharmacist will set up a personalised plan and explain exactly what happens next. If it is not suitable, we will explain why and talk through the alternatives.' ],
    [ 'title' => 'Monthly face-to-face reviews', 'desc' => 'Return each month for weight and blood pressure checks and a review of how your plan is going, with changes made where needed.' ],
    [ 'title' => 'Maintaining your progress', 'desc' => 'We work with you on a structured plan to help maintain your progress, with lifestyle and dietary advice alongside ongoing pharmacist support.' ],
];
$step_styles = [
    [ 'card' => 'bg-blue-50 hover:bg-blue-100', 'num' => 'background-color:#1a73e9;' ],
    [ 'card' => 'bg-gray-50 hover:bg-gray-100', 'num' => 'background: linear-gradient(135deg, #1a73e9, #1d4ed8);' ],
];

// S9 Why Southdowns — client-editable. Card icons stay in code, by position.
$why_cards_raw = function_exists( 'get_field' ) ? get_field( 'wl_why_cards' ) : null;
$why_cards     = ! empty( $why_cards_raw ) ? $why_cards_raw : [
    [ 'title' => 'GPhC-Registered',           'desc' => 'All our pharmacists are registered with the General Pharmaceutical Council. Your safety and clinical standards are never compromised.' ],
    [ 'title' => 'Same-Day Assessments',      'desc' => 'No waiting lists and no GP referral. Book a consultation online and be assessed the same day &mdash; treatment follows only where it is clinically appropriate.' ],
    [ 'title' => 'Face-to-Face Care',         'desc' => "Unlike online services, our pharmacists see you in person every month &mdash; monitoring your progress, reviewing your plan and answering your questions." ],
    [ 'title' => '4 Hampshire Locations',     'desc' => 'Bosmere and Davies in Havant, plus Emsworth and Rowlands Castle &mdash; with free parking. Always a convenient branch near you.' ],
    [ 'title' => 'Honest Clinical Advice',    'desc' => 'If the programme is not right for you, we will tell you and talk through the alternatives. No pressure and no hard sell.' ],
    [ 'title' => 'Rooted in Hampshire',       'desc' => 'A local independent pharmacy group serving Hampshire communities, with care built on long-term relationships rather than one-off transactions.' ],
];
$why_icons = [
    '<path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
];
?>

<!-- Page-scoped styles -->
<style>
  .yf-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .yf-reveal.visible { opacity: 1; transform: translateY(0); }
  .yf-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .yf-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .yf-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .yf-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .yf-reveal[data-delay="5"] { transition-delay: 0.5s; }

  @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
  .yf-shimmer { background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }

  .yf-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .yf-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }

  .yf-step:hover .yf-step-num { transform: scale(1.15); box-shadow: 0 0 0 8px rgba(59,130,246,0.15); }
  .yf-step-num { transition: transform 0.3s ease, box-shadow 0.3s ease; }

  /* FAQ — native <details> accordion */
  .wl-faq-item { border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s; }
  .wl-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .wl-faq-item[open] { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); }
  .wl-faq-question { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; font-weight: 600; font-size: 1.05rem; color: #1e293b; list-style: none; }
  .wl-faq-question::-webkit-details-marker { display: none; }
  .wl-faq-chevron { transition: transform 0.3s; flex-shrink: 0; margin-left: 1rem; }
  .wl-faq-item[open] .wl-faq-chevron { transform: rotate(180deg); }
  .wl-faq-answer { padding: 0 1.5rem 1.25rem; color: #4b5563; line-height: 1.7; }
</style>

<!-- ============================================================
     S1: HERO — Matches homepage 2-column layout exactly
     ============================================================ -->
<section class="hero-type relative w-full min-h-[560px] lg:min-h-[660px] overflow-hidden">

  <!-- Mobile: full-width image with overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900 via-blue-900/85 to-blue-900/30"></div>
  <!-- Relative (not absolute) so the hero grows with its content and never clips the top; min-height keeps it tall. -->
  <div class="md:hidden relative z-10 flex flex-col justify-end min-h-[85vh] px-6 pt-28 pb-12 hero-legible">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo $hero_badge; ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo $hero_headline; ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo $hero_body; ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full">
        Book a Consultation
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="#faqs" class="inline-flex items-center gap-2 text-white text-sm font-medium border-2 border-white/40 px-5 py-2.5 rounded-full hover:bg-white/10 transition-colors font-jost">Check Eligibility</a>
    </div>
    <div class="hero-note flex flex-wrap gap-4 text-white text-xs font-medium font-jost">
      <span>&#10003; GPhC Registered</span>
      <span>&#10003; No GP Referral</span>
      <span>&#10003; Face-to-Face Support</span>
    </div>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[560px] lg:min-h-[660px] flex flex-col justify-center pl-12 lg:pl-16 pr-24 lg:pr-36 py-12" style="background-color:#196bdc;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo $hero_badge; ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[46px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo $hero_headline; ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo $hero_body; ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book a Consultation
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#faqs" class="inline-flex items-center gap-2 text-white text-base font-medium border-2 border-white/30 px-6 py-3 rounded-full hover:bg-white/10 transition-colors font-jost">Check Eligibility</a>
      </div>
      <div class="hero-features flex flex-wrap gap-5 text-white text-sm font-semibold font-jost">
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          GPhC Registered
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          No GP Referral
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          Face-to-Face Support
        </span>
      </div>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[560px] lg:min-h-[660px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"></div>

    <!-- Badge images straddling the centre divider -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:8%;transform:translateX(-50%);">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/roundel-same-day.webp' ); ?>" alt="Same Day Appointments" class="object-contain drop-shadow-lg" style="width:150px;height:150px;transform:scale(1.26);" />
    </div>
    <?php
    /*
     * Centre roundel — built in-theme rather than an uploaded image.
     * Replaces a previous "Average 15-20kg weight loss" badge, which made an
     * unsubstantiated outcome claim that copy edits could not reach (it was
     * baked into an image) and was hotlinked from the staging domain.
     */
    ?>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div class="rounded-full flex flex-col items-center justify-center text-center px-5 drop-shadow-lg"
           style="width:150px;height:150px;background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 55%,#3b82f6 100%);box-shadow:0 0 0 3px rgba(29,78,216,0.45),0 0 0 6px rgba(255,255,255,0.55),0 8px 24px rgba(15,23,42,0.28);"
           role="img" aria-label="GPhC registered pharmacist prescribers">
        <svg class="w-5 h-5 text-blue-100" style="margin-bottom:4px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>
        </svg>
        <span class="text-white font-extrabold leading-none font-jost" style="font-size:25px;letter-spacing:0.01em;">GPhC</span>
        <span class="text-white font-bold leading-tight font-jost" style="margin-top:2px;font-size:11px;letter-spacing:0.07em;">REGISTERED</span>
        <span class="text-blue-100 font-semibold font-jost block mx-auto" style="margin-top:4px;font-size:9.5px;line-height:1.15;max-width:88px;">Pharmacist Prescribers</span>
      </div>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:8%;transform:translateX(-50%);">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/roundel-5-star.webp' ); ?>" alt="5-Star Service" class="object-contain drop-shadow-lg" style="width:150px;height:150px;transform:scale(1.13);" />
    </div>
  </div>

</section>


<!-- ============================================================
     S2: SOCIAL PROOF BAR — Blue gradient, 5 glassmorphism stat cards
     ============================================================ -->
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">

      <!-- Card 1: No GP referral needed -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="1">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">No GP</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Referral Needed</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
          </svg>
        </div>
      </div>

      <!-- Card 2: Monthly face-to-face reviews -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="2">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">Monthly</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Face-to-Face Reviews</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
          </svg>
        </div>
      </div>

      <!-- Card 3: Satisfaction -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="3">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">4.9/5</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Patient Satisfaction</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
          </svg>
        </div>
      </div>

      <!-- Card 4: Locations -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="4">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">4</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Hampshire Locations</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
      </div>

      <!-- Card 5: Same Day -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center col-span-2 md:col-span-1" data-delay="5">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">Same Day</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Appointments</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S5: OUTCOMES & BENEFITS — Light gradient, 6 result photo cards
     ============================================================ -->
<section class="py-16 md:py-24" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">What to Expect</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">What you can expect from your programme</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Beyond the number on the scales, patients report wide-ranging improvements to their health and quality of life.</p>
    </div>

    <!-- 6 benefit cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $benefits as $bi => $bcard ) :
          $b_img  = ! empty( $bcard['image'] ) ? $bcard['image'] : 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=600&q=80&auto=format&fit=crop';
          $b_icon = $benefit_icons[ $bi % count( $benefit_icons ) ];
      ?>
      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="<?php echo (int) ( ( $bi % 3 ) + 1 ); ?>">
        <div class="h-44 overflow-hidden">
          <img src="<?php echo esc_url( $b_img ); ?>" alt="<?php echo esc_attr( $bcard['title'] ?? '' ); ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><?php echo $b_icon; ?></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost"><?php echo esc_html( $bcard['title'] ?? '' ); ?></h3>
          <p class="text-sm text-gray-600 font-jost"><?php echo $bcard['desc'] ?? ''; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: HOW IT WORKS — White bg, photo left + 4 numbered step cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Your Journey</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">How our programme works</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">From your first consultation to reaching your goal weight, we're with you at every step.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-center">

      <!-- Photo -->
      <div class="yf-reveal order-2 lg:order-1">
        <div class="relative rounded-3xl overflow-hidden shadow-xl">
          <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=900&q=80&auto=format&fit=crop" alt="Pharmacist consultation" class="w-full h-[420px] object-cover"/>
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
          <div class="absolute bottom-6 left-6 right-6">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl px-5 py-4 shadow-lg">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  </svg>
                </div>
                <div>
                  <div class="font-bold text-gray-900 text-sm font-jost">GPhC-Registered Pharmacists</div>
                  <div class="text-xs text-gray-600 font-jost">Expert face-to-face care across Hampshire</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Steps -->
      <div class="order-1 lg:order-2 space-y-5">

        <?php foreach ( $steps as $si => $step ) : $ss = $step_styles[ $si % count( $step_styles ) ]; ?>
        <div class="yf-reveal yf-step flex gap-5 p-5 <?php echo $ss['card']; ?> rounded-2xl transition-colors" data-delay="<?php echo (int) ( $si + 1 ); ?>">
          <div class="yf-step-num w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0 font-jost" style="<?php echo $ss['num']; ?>"><?php echo (int) ( $si + 1 ); ?></div>
          <div>
            <h3 class="font-bold text-gray-900 mb-1 font-jost"><?php echo esc_html( $step['title'] ?? '' ); ?></h3>
            <p class="text-sm text-gray-600 font-jost"><?php echo $step['desc'] ?? ''; ?></p>
          </div>
        </div>
        <?php endforeach; ?>

        <div class="yf-reveal pt-2" data-delay="5">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20">
            Book Your Consultation
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S7: TESTIMONIALS — Blue gradient, 6 glassmorphism review cards
     Hidden until real reviews are entered (see $testimonials_reviews).
     ============================================================ -->
<?php if ( ! empty( $testimonials_reviews ) ) : ?>
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $testimonials_eyebrow ); ?></span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo esc_html( $testimonials_headline ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost"><?php echo $testimonials_subhead; ?></p>
    </div>

    <!-- Review cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
      <?php foreach ( $testimonials_reviews as $i => $review ) :
          $r_quote    = ! empty( $review['quote'] )    ? $review['quote']    : '';
          $r_initials = ! empty( $review['initials'] ) ? $review['initials'] : '';
          $r_name     = ! empty( $review['name'] )     ? $review['name']     : '';
          $r_location = ! empty( $review['location'] ) ? $review['location'] : '';
          $r_delay    = ( $i % 3 ) + 1;
      ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6" data-delay="<?php echo (int) $r_delay; ?>">
        <div class="flex gap-1 mb-3">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg><?php endfor; ?>
        </div>
        <?php if ( $r_quote ) : ?>
        <p class="text-white/90 text-sm leading-relaxed mb-4 font-jost">&ldquo;<?php echo $r_quote; ?>&rdquo;</p>
        <?php endif; ?>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-sm"><?php echo esc_html( $r_initials ); ?></div>
          <div>
            <div class="text-white font-semibold text-sm font-jost"><?php echo esc_html( $r_name ); ?></div>
            <div class="text-blue-200 text-xs font-jost"><?php echo esc_html( $r_location ); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Trust row -->
    <?php if ( ! empty( $testimonials_trust ) ) : ?>
    <div class="flex flex-wrap justify-center gap-8 yf-reveal">
      <?php foreach ( $testimonials_trust as $i => $t ) :
          $t_value   = ! empty( $t['value'] )   ? $t['value']   : '';
          $t_caption = ! empty( $t['caption'] ) ? $t['caption'] : '';
          if ( ! $t_value && ! $t_caption ) { continue; }
          $t_icon    = $testimonials_trust_icons[ $i % count( $testimonials_trust_icons ) ];
      ?>
      <div class="flex items-center gap-2 text-white font-jost">
        <?php echo $t_icon; ?>
        <span class="font-bold"><?php echo esc_html( $t_value ); ?></span><span class="text-blue-200 text-sm"><?php echo esc_html( $t_caption ); ?></span>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>


<!-- ============================================================
     S8: LOCATIONS — White bg, 4 branch photo cards with hover zoom
     ============================================================ -->
<section class="py-16 md:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Our Pharmacies</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">Visit us at your nearest Hampshire location</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Walk in or book online &mdash; same-day weight loss consultations available at all four Southdowns branches.</p>
    </div>

    <!-- Branch photo cards -->
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
          <a href="<?php echo esc_url( $booking_url ); ?>" class="mt-auto flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Book Weight Loss Consultation
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
        <p class="text-white text-lg font-semibold mb-1 font-jost">No GP referral needed</p>
        <p class="text-blue-100 text-base font-jost">Walk in or book online. Our pharmacists will assess you in person and talk you through your options &mdash; no GP referral and no waiting lists.</p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        Book a Consultation
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S9: WHY SOUTHDOWNS — Blue gradient, 6-card grid
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Why Choose Us</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost">Why Hampshire chooses Southdowns</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto font-jost">We combine clinical expertise with genuine face-to-face care &mdash; the things online weight loss services simply can't replicate.</p>
    </div>

    <!-- 6-card grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ( $why_cards as $wi => $wcard ) : $w_icon = $why_icons[ $wi % count( $why_icons ) ]; ?>
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="<?php echo (int) ( ( $wi % 3 ) + 1 ); ?>">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $w_icon; ?></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost"><?php echo esc_html( $wcard['title'] ?? '' ); ?></h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost"><?php echo $wcard['desc'] ?? ''; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S10: FAQ — Light gradient, two-column sticky sidebar + accordion
     ============================================================ -->
<section id="faqs" class="py-16 md:py-24" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="grid lg:grid-cols-[340px_1fr] gap-12 lg:gap-16 items-start">

      <!-- Sticky sidebar -->
      <div class="lg:sticky lg:top-28 yf-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-4">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $faq_eyebrow ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost"><?php echo esc_html( $faq_headline ); ?></h2>
        <p class="text-gray-600 mb-8 font-jost"><?php echo $faq_intro; ?></p>

        <?php if ( ! empty( $faq_stats ) ) : ?>
        <!-- Trust stats -->
        <div class="grid grid-cols-<?php echo (int) min( 6, max( 1, count( $faq_stats ) ) ); ?> gap-3 mb-8">
          <?php foreach ( $faq_stats as $stat ) :
              $s_value = ! empty( $stat['value'] ) ? $stat['value'] : '';
              $s_label = ! empty( $stat['label'] ) ? $stat['label'] : '';
              if ( ! $s_value && ! $s_label ) { continue; }
          ?>
          <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-bold text-blue-600 font-jost"><?php echo esc_html( $s_value ); ?></div>
            <div class="text-xs text-gray-500 font-jost"><?php echo esc_html( $s_label ); ?></div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( $faq_cta_label ) : ?>
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20 w-full justify-center">
          <?php echo esc_html( $faq_cta_label ); ?>
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <?php endif; ?>
      </div>

      <!-- FAQ accordion -->
      <div class="space-y-3 yf-reveal" data-delay="2">
        <?php foreach ( $faq_items as $faq ) :
            $q = ! empty( $faq['question'] ) ? $faq['question'] : '';
            $a = ! empty( $faq['answer'] )   ? $faq['answer']   : '';
            if ( ! $q && ! $a ) { continue; }
        ?>
        <details class="wl-faq-item">
          <summary class="wl-faq-question">
            <span><?php echo esc_html( $q ); ?></span>
            <svg class="wl-faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </summary>
          <div class="wl-faq-answer"><?php echo $a; ?></div>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S11: FINAL CTA — Blue gradient, trust badges, checklist, disclaimer
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

    <!-- Trust badge pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-10 yf-reveal">
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        GPhC Registered
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        No GP Referral
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        4.9/5 Rating
      </span>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/20">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        Monthly Reviews
      </span>
    </div>

    <!-- Heading -->
    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost">Start your weight loss journey today</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost">Book your consultation at your nearest Hampshire branch. Same-day assessments, no waiting lists, and honest advice about whether treatment is right for you.</p>
    </div>

    <!-- Checklist -->
    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-2 max-w-xl mx-auto mb-10 text-left yf-reveal" data-delay="1">
      <?php
      $points = [
        'Initial consultation &mdash; no obligation',
        'Same-day assessments available',
        'Monthly face-to-face check-ins',
        'Honest advice, no pressure',
        'GPhC-registered pharmacists',
        'No GP referral needed',
      ];
      foreach ( $points as $point ) : ?>
      <div class="flex items-center gap-2.5 text-sm text-blue-100 font-jost">
        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <?php echo $point; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-wrap justify-center gap-4 yf-reveal" data-delay="2">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-base font-jost">
        Book a Consultation
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
        <span><strong class="text-white">4</strong> Hampshire branches</span>
      </div>
      <div class="flex items-center gap-2 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <span><strong class="text-white">GPhC</strong> registered pharmacy</span>
      </div>
    </div>

  </div>
</section>

<!-- ============================================================
     IMPORTANT SAFETY INFORMATION — required before the disclaimer strip
     ============================================================ -->
<section class="bg-white border-t border-gray-200 py-12 md:py-16">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 md:p-8">
      <div class="flex items-start gap-4 mb-5">
        <div class="w-11 h-11 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div>
          <h2 class="text-xl md:text-2xl font-bold text-amber-900 font-jost leading-tight">Important information</h2>
          <p class="text-amber-800 text-sm font-jost mt-1">Please read before booking a consultation.</p>
        </div>
      </div>

      <div class="space-y-4 text-slate-700 text-sm md:text-[15px] leading-relaxed font-jost">
        <p>Our weight management programme is <strong>not suitable for everyone</strong>, including if you are pregnant, breastfeeding or trying to conceive. Whether it is right for you is decided only after a <strong>face-to-face clinical assessment</strong> by a GPhC-registered pharmacist, taking into account your full medical history and every medicine you take.</p>

        <p>Any plan is used <strong>alongside a reduced-calorie diet and increased physical activity</strong>, not instead of them. Your pharmacist will explain the benefits, risks and possible side effects of anything recommended for you, and you should always read the information leaflet supplied with any medicine.</p>

        <p>Suspected side effects to any medicine can be reported through the MHRA Yellow Card scheme at <a href="https://yellowcard.mhra.gov.uk" target="_blank" rel="noopener" class="text-blue-700 font-semibold hover:underline">yellowcard.mhra.gov.uk</a>.</p>
      </div>
    </div>
  </div>
</section>

<!-- Medical disclaimer strip -->
<div class="bg-gray-50 border-t border-gray-200 py-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-xs text-gray-500 text-center leading-relaxed font-jost max-w-4xl mx-auto">
      <strong>Medical disclaimer:</strong> The information on this page is for general information only and does not constitute medical advice. Suitability for our weight management programme is subject to a clinical assessment by a GPhC-registered pharmacist. Individual results vary and depend on many factors, including following your plan, lifestyle and existing medical conditions. Always consult a healthcare professional before starting any new treatment.
    </p>
  </div>
</div>

<!-- Scroll reveal JS -->
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
