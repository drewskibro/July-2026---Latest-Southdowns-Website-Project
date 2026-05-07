<?php
/**
 * Template Name: Weight Loss
 *
 * Select this template on the Weight Loss page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

$hero_image     = ( function_exists( 'get_field' ) ? get_field( 'wl_hero_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&q=80&auto=format&fit=crop';
$hero_headline  = sp_field( 'wl_hero_headline',  'Lose 10&ndash;20% of your body weight in 12 months &mdash; with prescription support at your local Hampshire pharmacy' );
$hero_body      = sp_field( 'wl_hero_body',      'Mounjaro and Wegovy prescriptions from our Hampshire pharmacists. No GP referral. No long waits. Expert face-to-face care at Southsea, Waterlooville, Havant &amp; Portsmouth.' );
$hero_badge     = sp_field( 'wl_hero_badge_text', 'Medical Weight Loss &middot; Hampshire' );

$science_eyebrow      = sp_field( 'wl_science_eyebrow',      'Clinical Evidence' );
$science_headline     = sp_field( 'wl_science_headline',     'Why diets alone fail &mdash; the science in one chart' );
$science_subhead      = sp_field( 'wl_science_subhead',      'In randomised trials, GLP-1 receptor agonists produce sustained weight loss that lifestyle intervention alone rarely achieves. The contrast is not subtle.' );
$science_citation     = sp_field( 'wl_science_citation',     'Data adapted from the STEP-1 trial (Wilding et al., <em>N Engl J Med</em> 2021) and naturalistic dieting studies published in <em>Obesity Reviews</em>.' );
$science_quote        = sp_field( 'wl_science_quote',        'Patients on GLP-1 therapy describe something dieting never gave them &mdash; relief from the constant thinking about food. That is what makes the weight loss sustainable.' );
$science_quote_author = sp_field( 'wl_science_quote_author', 'Alex Chen, MPharm' );
$science_quote_role   = sp_field( 'wl_science_quote_role',   'Lead Pharmacist, Southdowns Pharmacy' );

$mounjaro_price = sp_field( 'wl_mounjaro_price', 'From &pound;149/month including pharmacist support' );
$wegovy_price   = sp_field( 'wl_wegovy_price',   'From &pound;149/month including pharmacist support' );

// Treatments (S4)
$treatments_eyebrow     = sp_field( 'wl_treatments_eyebrow',     'Prescription Treatments' );
$treatments_headline    = sp_field( 'wl_treatments_headline',    'Clinically proven weight loss medications' );
$treatments_subhead     = sp_field( 'wl_treatments_subhead',     'Our GPhC-registered pharmacists prescribe the two most effective GLP-1 medications available in the UK, tailored to your health profile.' );
$treatments_cta_label   = sp_field( 'wl_treatments_cta_label',   'Book Free Consultation' );
$treatments_eligibility = sp_field( 'wl_treatments_eligibility', '<strong>Eligibility:</strong> You must have a BMI of 30 or above, or 27+ with a weight-related health condition such as type 2 diabetes or hypertension. Our pharmacists will assess your suitability at your free consultation.' );

$mounjaro_image     = ( function_exists( 'get_field' ) ? get_field( 'wl_mounjaro_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=800&q=80&auto=format&fit=crop';
$mounjaro_image_alt = sp_field( 'wl_mounjaro_image_alt', 'Mounjaro weight loss injection' );
$mounjaro_badge     = sp_field( 'wl_mounjaro_badge',     'Most Popular' );
$mounjaro_name      = sp_field( 'wl_mounjaro_name',      'Mounjaro&reg;' );
$mounjaro_subtitle  = sp_field( 'wl_mounjaro_subtitle',  'Tirzepatide &middot; GIP &amp; GLP-1 receptor agonist' );
$mounjaro_body      = sp_field( 'wl_mounjaro_body',      'The newest and most effective medication available. Mounjaro targets two hormones simultaneously, producing up to <strong>22.5% weight loss</strong> in clinical trials &mdash; more than any other approved treatment.' );
$mounjaro_bullets_raw = sp_field( 'wl_mounjaro_bullets', "Weekly self-injection, 2.5mg starting dose\nDual-action: reduces appetite &amp; improves insulin sensitivity\nMHRA-approved for BMI &ge;30, or &ge;27 with comorbidities" );
$mounjaro_bullets   = array_values( array_filter( array_map( 'trim', preg_split( "/\r\n|\r|\n/", (string) $mounjaro_bullets_raw ) ) ) );
if ( $mounjaro_price ) { $mounjaro_bullets[] = $mounjaro_price; }

$wegovy_image     = ( function_exists( 'get_field' ) ? get_field( 'wl_wegovy_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&q=80&auto=format&fit=crop';
$wegovy_image_alt = sp_field( 'wl_wegovy_image_alt', 'Wegovy weight loss injection' );
$wegovy_badge     = sp_field( 'wl_wegovy_badge',     'Well Established' );
$wegovy_name      = sp_field( 'wl_wegovy_name',      'Wegovy&reg;' );
$wegovy_subtitle  = sp_field( 'wl_wegovy_subtitle',  'Semaglutide &middot; GLP-1 receptor agonist' );
$wegovy_body      = sp_field( 'wl_wegovy_body',      'The gold-standard GLP-1 medication with an extensive clinical track record. SUSTAIN and STEP trial data show up to <strong>15% body weight reduction</strong> &mdash; a major advance over lifestyle intervention alone.' );
$wegovy_bullets_raw = sp_field( 'wl_wegovy_bullets', "Weekly self-injection, 0.25mg starting dose\nMimics natural GLP-1 hormone to suppress appetite\nMHRA-approved for BMI &ge;30, or &ge;27 with comorbidities" );
$wegovy_bullets   = array_values( array_filter( array_map( 'trim', preg_split( "/\r\n|\r|\n/", (string) $wegovy_bullets_raw ) ) ) );
if ( $wegovy_price ) { $wegovy_bullets[] = $wegovy_price; }

// Testimonials (S7)
$testimonials_eyebrow  = sp_field( 'wl_testimonials_eyebrow',  'Patient Stories' );
$testimonials_headline = sp_field( 'wl_testimonials_headline', 'Real patients, real results' );
$testimonials_subhead  = sp_field( 'wl_testimonials_subhead',  'Hundreds of Hampshire patients have transformed their health through our medical weight loss programme.' );

$testimonials_reviews_raw = function_exists( 'get_field' ) ? get_field( 'wl_testimonials_reviews' ) : null;
$testimonials_reviews     = ! empty( $testimonials_reviews_raw ) ? $testimonials_reviews_raw : [
    [ 'quote' => 'I&rsquo;ve tried every diet going over the years. With Mounjaro I lost 18kg in 6 months. The Southdowns team have been brilliant &mdash; so knowledgeable and supportive throughout.', 'initials' => 'SH', 'name' => 'Sarah H.',  'location' => 'Waterlooville' ],
    [ 'quote' => 'My GP had a 3-month wait. I walked into Southdowns pharmacy, had a consultation the same day and started Wegovy that afternoon. 14kg down in 5 months &mdash; absolutely life-changing.',  'initials' => 'MT', 'name' => 'Mark T.',   'location' => 'Portsmouth'    ],
    [ 'quote' => 'I was sceptical at first but the pharmacist explained everything so clearly. My blood sugar is now normal for the first time in years and I&rsquo;ve lost nearly 3 stone. Highly recommend.', 'initials' => 'LR', 'name' => 'Linda R.',  'location' => 'Havant'        ],
    [ 'quote' => 'The monthly check-ins are what make this different from online services. Having a real pharmacist monitor my progress and adjust my dose has made all the difference. Down 22kg and counting.', 'initials' => 'DJ', 'name' => 'David J.',  'location' => 'Southsea'      ],
    [ 'quote' => 'I&rsquo;d heard horror stories about side effects but mine were minimal. The pharmacist gave me clear advice on managing them. 11kg lost in 3 months and my joints feel amazing.',          'initials' => 'JB', 'name' => 'Julie B.',  'location' => 'Waterlooville' ],
    [ 'quote' => 'Fantastic service from start to finish. No judgement, just professional support. I feel like a completely different person. The team at Portsmouth are wonderful.',                          'initials' => 'RC', 'name' => 'Rachel C.', 'location' => 'Portsmouth'    ],
];

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
$faq_headline  = sp_field( 'wl_faq_headline',  'Common questions about medical weight loss' );
$faq_intro     = sp_field( 'wl_faq_intro',     'Everything you need to know before starting your journey. Can&rsquo;t find your answer? Call us free.' );
$faq_cta_label = sp_field( 'wl_faq_cta_label', 'Book Free Consultation' );

$faq_stats_raw = function_exists( 'get_field' ) ? get_field( 'wl_faq_stats' ) : null;
$faq_stats     = ! empty( $faq_stats_raw ) ? $faq_stats_raw : [
    [ 'value' => '4.9',  'label' => 'Rating'   ],
    [ 'value' => '400+', 'label' => 'Reviews'  ],
    [ 'value' => '10k+', 'label' => 'Patients' ],
];

$faq_items_raw = function_exists( 'get_field' ) ? get_field( 'wl_faq_items' ) : null;
$faq_items     = ! empty( $faq_items_raw ) ? $faq_items_raw : [
    [ 'question' => 'Am I eligible for weight loss injections?',
      'answer'   => 'You are generally eligible if you have a BMI of 30 or above, or a BMI of 27 or above alongside a weight-related health condition such as type 2 diabetes, high blood pressure, high cholesterol or sleep apnoea. Our pharmacists will carry out a full assessment at your free consultation to confirm eligibility.' ],
    [ 'question' => 'What is the difference between Mounjaro and Wegovy?',
      'answer'   => 'Both are weekly self-injections that reduce appetite, but they work differently. Mounjaro (tirzepatide) targets two hormones &mdash; GIP and GLP-1 &mdash; and tends to produce greater weight loss (up to 22.5% in trials). Wegovy (semaglutide) targets GLP-1 only and has a longer clinical track record. Our pharmacists will recommend the right option based on your health history and goals.' ],
    [ 'question' => 'Do I need a GP referral?',
      'answer'   => 'No. Our GPhC-registered pharmacists are independent prescribers who can assess your suitability and issue a prescription directly &mdash; without a GP referral or NHS waiting list. You can book, consult and start treatment all on the same day.' ],
    [ 'question' => 'How much weight can I expect to lose?',
      'answer'   => 'Clinical trials show that patients typically lose 10&ndash;20% of their body weight over 12 months. Results vary by individual and depend on consistent use, diet, activity and adherence to the programme. Most patients notice a meaningful reduction in appetite and begin losing weight within the first 4&ndash;8 weeks.' ],
    [ 'question' => 'What are the common side effects?',
      'answer'   => 'The most common side effects are nausea, constipation, diarrhoea and reduced appetite, particularly in the first few weeks as your body adjusts to the medication. These are usually mild and temporary. Our pharmacists provide detailed advice on managing side effects and can adjust your dose if needed.' ],
    [ 'question' => 'How much does the programme cost?',
      'answer'   => 'Your initial consultation is completely free. Monthly treatment costs start from &pound;149 and include your medication, the prescribing consultation and ongoing pharmacist support. Pricing varies by medication and dose. We will provide a full cost breakdown at your free consultation before you commit to anything.' ],
    [ 'question' => 'Can I use weight loss injections if I have type 2 diabetes?',
      'answer'   => 'Yes, and GLP-1 medications can be particularly beneficial for people with type 2 diabetes, as they also improve blood sugar control. However, your pharmacist will review your current medications and medical history carefully to ensure safety and appropriate dosing, particularly if you are taking insulin or sulphonylureas.' ],
    [ 'question' => 'What happens when I reach my goal weight?',
      'answer'   => 'When you reach your goal weight, our pharmacists will work with you on a structured exit plan to help maintain your results. This may involve a gradual dose reduction, lifestyle coaching and dietary advice. Our goal is to give you the tools to maintain a healthy weight long after completing the programme.' ],
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

  /* S3 — Clinical Evidence section — layered blue/navy palette with depth */
  @import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400&display=swap');

  .sci-section { background: linear-gradient(160deg, #0f172a 0%, #1e3a8a 55%, #1d4ed8 100%); position: relative; overflow: hidden; }
  .sci-section-inner { position: relative; z-index: 10; }
  .sci-headline { font-family: 'Fraunces', Georgia, 'Times New Roman', serif; font-weight: 500; font-variation-settings: 'opsz' 96; letter-spacing: -0.015em; color: #ffffff; line-height: 1.08; }
  .sci-subhead { font-family: 'Jost', sans-serif; color: rgba(219,234,254,0.85); font-weight: 300; }
  .sci-footnote { font-family: 'Jost', sans-serif; font-size: 0.82rem; color: rgba(255,255,255,0.78); font-weight: 400; letter-spacing: 0.01em; }
  .sci-footnote em { font-family: 'Fraunces', Georgia, serif; font-style: italic; }

  /* Chart */
  .sci-chart-wrap { position: relative; }
  .sci-chart { width: 100%; height: auto; display: block; font-family: 'Jost', sans-serif; }
  .sci-axis-line { stroke: rgba(255,255,255,0.15); stroke-width: 1; }
  .sci-grid-line { stroke: rgba(255,255,255,0.08); stroke-width: 1; stroke-dasharray: 4 4; }
  .sci-axis-label { fill: rgba(255,255,255,0.78); font-size: 12px; font-weight: 400; }
  .sci-axis-note { fill: rgba(255,255,255,0.7); font-size: 11.5px; font-weight: 400; letter-spacing: 0.02em; }

  .sci-curve { fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-dasharray: 1; stroke-dashoffset: 1; transition: stroke-dashoffset 2.4s cubic-bezier(0.22, 1, 0.36, 1); }
  .sci-curve--diet { stroke: rgba(255,255,255,0.35); stroke-width: 2; transition-delay: 0.2s; }
  .sci-curve--glp1 { stroke: #60a5fa; stroke-width: 3; transition-delay: 0.6s; }
  .yf-reveal.visible .sci-curve { stroke-dashoffset: 0; }

  .sci-endpoint { opacity: 0; transition: opacity 0.5s ease; transition-delay: 2.5s; }
  .sci-endpoint--glp1 { transition-delay: 2.9s; }
  .yf-reveal.visible .sci-endpoint { opacity: 1; }
  .sci-endpoint-dot-diet { fill: rgba(255,255,255,0.45); }
  .sci-endpoint-dot-glp1 { fill: #60a5fa; }
  .sci-endpoint-label { font-size: 12.5px; font-weight: 600; fill: #ffffff; }
  .sci-endpoint-sublabel { font-size: 11px; font-weight: 400; fill: rgba(255,255,255,0.65); }

  /* Pullquote */
  .sci-quote { font-family: 'Fraunces', Georgia, serif; font-style: italic; font-weight: 400; font-variation-settings: 'opsz' 48; color: #ffffff; letter-spacing: -0.005em; line-height: 1.35; }
  .sci-quote-mark { font-family: 'Fraunces', Georgia, serif; color: #93c5fd; line-height: 0.5; }
  .sci-quote-author { font-family: 'Jost', sans-serif; font-size: 0.8rem; letter-spacing: 0.16em; text-transform: uppercase; color: #ffffff; font-weight: 600; }
  .sci-quote-role { font-family: 'Jost', sans-serif; font-size: 0.85rem; color: rgba(219,234,254,0.75); font-weight: 300; }
  .sci-divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(147,197,253,0.3) 50%, transparent); }

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
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-width image with overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo $hero_badge; ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo $hero_headline; ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo $hero_body; ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full">
        Book Free Consultation
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="#treatments" class="inline-flex items-center gap-2 text-white text-sm font-medium border-2 border-white/40 px-5 py-2.5 rounded-full hover:bg-white/10 transition-colors font-jost">Check Eligibility</a>
    </div>
    <div class="flex flex-wrap gap-4 text-white/90 text-xs font-jost">
      <span>&#10003; GPhC Registered</span>
      <span>&#10003; No GP Referral</span>
      <span>&#10003; Face-to-Face Support</span>
    </div>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo $hero_badge; ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[46px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo $hero_headline; ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo $hero_body; ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Free Consultation
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#treatments" class="inline-flex items-center gap-2 text-white text-base font-medium border-2 border-white/30 px-6 py-3 rounded-full hover:bg-white/10 transition-colors font-jost">Check Eligibility</a>
      </div>
      <div class="flex flex-wrap gap-5 text-white text-sm font-jost">
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
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"></div>

    <!-- Badge images straddling the centre divider -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398697-0.png" alt="Same Day Appointments" class="w-[130px] h-[130px] object-contain drop-shadow-lg" />
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <img src="https://southdownspharmacygroup.kinsta.cloud/wp-content/uploads/2026/04/Untitled-design-5.png" alt="Medical Weight Loss" class="w-[130px] h-[130px] object-cover drop-shadow-lg rounded-full" />
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398725-1.png" alt="5-Star Service" class="w-[130px] h-[130px] object-contain drop-shadow-lg" />
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

      <!-- Card 1: Patients Treated -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="1">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">10,000+</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Patients Treated</div>
        <div class="mt-3 flex justify-center">
          <svg class="w-6 h-6 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
          </svg>
        </div>
      </div>

      <!-- Card 2: Body Weight Lost -->
      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-5 md:p-6 text-center" data-delay="2">
        <div class="text-3xl md:text-4xl font-bold text-white mb-1 font-jost">10–20%</div>
        <div class="text-sm text-blue-100 font-medium font-jost">Body Weight Lost</div>
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
     S3: THE SCIENCE — Brand-white bg, animated clinical chart, pharmacist pullquote
     ============================================================ -->
<section class="sci-section py-20 md:py-28 lg:py-32">
  <!-- Ambient radial glows -->
  <div class="absolute top-0 left-1/4 w-[480px] h-[480px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(59,130,246,0.22) 0%, transparent 70%);"></div>
  <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(96,165,250,0.18) 0%, transparent 70%);"></div>
  <div class="absolute top-1/2 left-0 w-72 h-72 rounded-full pointer-events-none -translate-y-1/2" style="background: radial-gradient(circle, rgba(30,58,138,0.35) 0%, transparent 70%);"></div>
  <!-- Dot pattern -->
  <div class="absolute inset-0 pointer-events-none dot-pattern"></div>

  <div class="sci-section-inner max-w-5xl mx-auto px-6 sm:px-8 lg:px-8">

    <!-- Header — brand pill eyebrow -->
    <div class="yf-reveal text-center mb-14 md:mb-20">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $science_eyebrow ); ?></span>
      </div>
      <h2 class="sci-headline text-4xl sm:text-5xl md:text-[56px] lg:text-[62px] mb-6 max-w-3xl mx-auto"><?php echo $science_headline; ?></h2>
      <p class="sci-subhead text-base md:text-lg max-w-xl mx-auto leading-relaxed"><?php echo $science_subhead; ?></p>
    </div>

    <!-- Animated chart -->
    <figure class="yf-reveal sci-chart-wrap mb-6">
      <svg class="sci-chart" viewBox="0 0 860 400" preserveAspectRatio="xMidYMid meet" role="img" aria-labelledby="sci-chart-title sci-chart-desc">
        <title id="sci-chart-title">Body weight change over 12 months: diet alone vs GLP-1 medication</title>
        <desc id="sci-chart-desc">Line chart: traditional dieting stays near 100% starting weight with yo-yo oscillation; GLP-1 medication descends smoothly to ~83% by 12 months.</desc>

        <!-- Y-axis label (horizontal, no rotation) -->
        <text x="10" y="34" class="sci-axis-note">Body weight (% of start)</text>

        <!-- Horizontal grid lines -->
        <line class="sci-grid-line" x1="90" y1="50"  x2="800" y2="50"/>
        <line class="sci-grid-line" x1="90" y1="155" x2="800" y2="155"/>
        <line class="sci-grid-line" x1="90" y1="260" x2="800" y2="260"/>

        <!-- Y-axis labels -->
        <text x="82" y="54"  class="sci-axis-label" text-anchor="end">100%</text>
        <text x="82" y="159" class="sci-axis-label" text-anchor="end">90%</text>
        <text x="82" y="264" class="sci-axis-label" text-anchor="end">80%</text>

        <!-- X-axis baseline + month labels -->
        <line class="sci-axis-line" x1="90" y1="320" x2="800" y2="320"/>
        <text x="90"  y="340" class="sci-axis-label" text-anchor="middle">0</text>
        <text x="267" y="340" class="sci-axis-label" text-anchor="middle">3</text>
        <text x="445" y="340" class="sci-axis-label" text-anchor="middle">6</text>
        <text x="623" y="340" class="sci-axis-label" text-anchor="middle">9</text>
        <text x="800" y="340" class="sci-axis-label" text-anchor="middle">12</text>
        <text x="445" y="365" class="sci-axis-note"  text-anchor="middle">Months on programme</text>

        <!-- DIET curve: explicit cubic bezier — controlled to never cross y=50 (100% line) -->
        <path class="sci-curve sci-curve--diet"
              pathLength="1"
              d="M 90 50
                 C 130 50, 165 100, 205 104
                 C 242 108, 285 62, 320 66
                 C 358 70, 398 118, 435 122
                 C 472 126, 515 72, 552 76
                 C 592 80, 632 110, 668 108
                 C 706 106, 762 82, 800 84"/>

        <!-- GLP-1 curve: smooth S-curve descent with plateau -->
        <path class="sci-curve sci-curve--glp1"
              pathLength="1"
              d="M 90 50 C 210 56, 250 168, 445 218 C 640 264, 760 280, 800 284"/>

        <!-- Diet endpoint -->
        <g class="sci-endpoint">
          <circle class="sci-endpoint-dot-diet" cx="800" cy="84" r="4"/>
          <text x="660" y="67"  class="sci-endpoint-label"    text-anchor="end">Diet alone</text>
          <text x="660" y="83" class="sci-endpoint-sublabel" text-anchor="end">≈ −2% after 12 months</text>
        </g>

        <!-- GLP-1 endpoint -->
        <g class="sci-endpoint sci-endpoint--glp1">
          <circle class="sci-endpoint-dot-glp1" cx="800" cy="284" r="5"/>
          <text x="658" y="310"  class="sci-endpoint-label"    text-anchor="end">GLP-1 medication</text>
          <text x="658" y="326" class="sci-endpoint-sublabel" text-anchor="end">≈ −17% after 12 months</text>
        </g>
      </svg>

      <figcaption class="sci-footnote text-center mt-4 max-w-2xl mx-auto"><?php echo $science_citation; ?></figcaption>
    </figure>

    <!-- Brand-toned divider -->
    <div class="sci-divider my-14 md:my-20 max-w-xs mx-auto"></div>

    <!-- Pharmacist pullquote -->
    <figure class="yf-reveal text-center max-w-3xl mx-auto">
      <div class="sci-quote-mark text-6xl md:text-7xl mb-2" aria-hidden="true">&ldquo;</div>
      <blockquote class="sci-quote text-2xl md:text-3xl lg:text-[34px] mb-10 px-2">
        <?php echo $science_quote; ?>
      </blockquote>
      <figcaption>
        <div class="sci-quote-author mb-1"><?php echo esc_html( $science_quote_author ); ?></div>
        <div class="sci-quote-role"><?php echo esc_html( $science_quote_role ); ?></div>
      </figcaption>
    </figure>

  </div>
</section>


<!-- ============================================================
     S4: TREATMENTS — White bg, Mounjaro + Wegovy side-by-side cards
     ============================================================ -->
<section id="treatments" class="py-16 md:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Heading -->
    <div class="text-center mb-12 md:mb-16 yf-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $treatments_eyebrow ); ?></span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost"><?php echo esc_html( $treatments_headline ); ?></h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost"><?php echo $treatments_subhead; ?></p>
    </div>

    <!-- Treatment cards -->
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">

      <?php
      $treatment_cards = [
          [
              'image'       => $mounjaro_image,
              'image_alt'   => $mounjaro_image_alt,
              'badge'       => $mounjaro_badge,
              'badge_class' => 'bg-blue-600',
              'name'        => $mounjaro_name,
              'subtitle'    => $mounjaro_subtitle,
              'body'        => $mounjaro_body,
              'bullets'     => $mounjaro_bullets,
              'delay'       => 1,
          ],
          [
              'image'       => $wegovy_image,
              'image_alt'   => $wegovy_image_alt,
              'badge'       => $wegovy_badge,
              'badge_class' => 'bg-teal-600',
              'name'        => $wegovy_name,
              'subtitle'    => $wegovy_subtitle,
              'body'        => $wegovy_body,
              'bullets'     => $wegovy_bullets,
              'delay'       => 2,
          ],
      ];
      foreach ( $treatment_cards as $card ) : ?>
      <div class="yf-reveal yf-card-lift bg-white rounded-3xl overflow-hidden border border-gray-200 shadow-md" data-delay="<?php echo (int) $card['delay']; ?>">
        <div class="relative h-56 overflow-hidden">
          <?php if ( $card['image'] ) : ?>
          <img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['image_alt'] ); ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
          <?php endif; ?>
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 to-transparent"></div>
          <?php if ( $card['badge'] ) : ?>
          <div class="absolute bottom-4 left-5">
            <span class="<?php echo esc_attr( $card['badge_class'] ); ?> text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wide"><?php echo esc_html( $card['badge'] ); ?></span>
          </div>
          <?php endif; ?>
        </div>
        <div class="p-7">
          <?php if ( $card['name'] ) : ?>
          <h3 class="text-2xl font-bold text-gray-900 mb-1 font-jost"><?php echo $card['name']; ?></h3>
          <?php endif; ?>
          <?php if ( $card['subtitle'] ) : ?>
          <p class="text-sm text-blue-600 font-medium mb-4 font-jost"><?php echo $card['subtitle']; ?></p>
          <?php endif; ?>
          <?php if ( $card['body'] ) : ?>
          <p class="text-gray-600 mb-5 font-jost leading-relaxed"><?php echo $card['body']; ?></p>
          <?php endif; ?>
          <?php if ( ! empty( $card['bullets'] ) ) : ?>
          <ul class="space-y-2.5 mb-6">
            <?php foreach ( $card['bullets'] as $bullet ) : ?>
            <li class="flex items-start gap-2.5 text-sm text-gray-700 font-jost">
              <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              <span><?php echo $bullet; ?></span>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if ( $treatments_cta_label ) : ?>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition-colors font-jost">
            <?php echo esc_html( $treatments_cta_label ); ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>

    <?php if ( $treatments_eligibility ) : ?>
    <!-- Eligibility note -->
    <div class="mt-10 text-center yf-reveal">
      <div class="inline-flex items-start gap-3 bg-blue-50 border border-blue-100 rounded-2xl px-6 py-4 max-w-2xl text-left">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm text-blue-800 font-jost"><?php echo $treatments_eligibility; ?></p>
      </div>
    </div>
    <?php endif; ?>

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
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Real Results</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-jost">What you can expect from your programme</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">Beyond the number on the scales, patients report wide-ranging improvements to their health and quality of life.</p>
    </div>

    <!-- 6 benefit cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="1">
        <div class="h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=600&q=80&auto=format&fit=crop" alt="Healthy weight" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost">Significant weight loss</h3>
          <p class="text-sm text-gray-600 font-jost">10&ndash;20% of body weight lost over 12 months, with most patients seeing results within the first 4 weeks.</p>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="2">
        <div class="h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=600&q=80&auto=format&fit=crop" alt="Blood sugar control" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost">Improved blood sugar control</h3>
          <p class="text-sm text-gray-600 font-jost">GLP-1 medications improve insulin sensitivity, helping to prevent or manage type 2 diabetes alongside weight loss.</p>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="3">
        <div class="h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80&auto=format&fit=crop" alt="Better energy" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost">More energy, less fatigue</h3>
          <p class="text-sm text-gray-600 font-jost">Patients consistently report better energy levels, improved sleep quality and greater motivation for exercise.</p>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="1">
        <div class="h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=600&q=80&auto=format&fit=crop" alt="Heart health" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost">Reduced cardiovascular risk</h3>
          <p class="text-sm text-gray-600 font-jost">Lower blood pressure, improved cholesterol levels and reduced strain on your heart as you reach a healthier weight.</p>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="2">
        <div class="h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&q=80&auto=format&fit=crop" alt="Mental wellbeing" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost">Better mental wellbeing</h3>
          <p class="text-sm text-gray-600 font-jost">Improved self-confidence, reduced anxiety around food and a greater sense of control over your health and body.</p>
        </div>
      </div>

      <div class="yf-reveal yf-card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm" data-delay="3">
        <div class="h-44 overflow-hidden">
          <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=600&q=80&auto=format&fit=crop" alt="Joint health" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
        </div>
        <div class="p-6">
          <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-1 font-jost">Reduced joint pain</h3>
          <p class="text-sm text-gray-600 font-jost">Less weight means less pressure on knees, hips and ankles &mdash; many patients report significantly reduced joint pain within months.</p>
        </div>
      </div>

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
      <p class="text-lg text-gray-600 max-w-2xl mx-auto font-jost">From your first free consultation to reaching your goal weight, we're with you at every step.</p>
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

        <div class="yf-reveal yf-step flex gap-5 p-5 bg-blue-50 rounded-2xl hover:bg-blue-100 transition-colors" data-delay="1">
          <div class="yf-step-num w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0 font-jost" style="background-color:#1a73e9;">1</div>
          <div>
            <h3 class="font-bold text-gray-900 mb-1 font-jost">Free consultation</h3>
            <p class="text-sm text-gray-600 font-jost">Book a same-day appointment at your nearest Southdowns branch. Our pharmacist reviews your medical history, BMI and health goals to recommend the right treatment.</p>
          </div>
        </div>

        <div class="yf-reveal yf-step flex gap-5 p-5 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors" data-delay="2">
          <div class="yf-step-num w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0 font-jost" style="background: linear-gradient(135deg, #1a73e9, #1d4ed8);">2</div>
          <div>
            <h3 class="font-bold text-gray-900 mb-1 font-jost">Same-day prescription &amp; injection training</h3>
            <p class="text-sm text-gray-600 font-jost">If eligible, your prescription is issued the same day. We show you exactly how to self-administer your weekly injection safely and confidently.</p>
          </div>
        </div>

        <div class="yf-reveal yf-step flex gap-5 p-5 bg-blue-50 rounded-2xl hover:bg-blue-100 transition-colors" data-delay="3">
          <div class="yf-step-num w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0 font-jost" style="background-color:#1a73e9;">3</div>
          <div>
            <h3 class="font-bold text-gray-900 mb-1 font-jost">Monthly check-ins &amp; dose adjustments</h3>
            <p class="text-sm text-gray-600 font-jost">Return monthly for weight monitoring, blood pressure checks and dose titration. We adjust your medication as needed to maximise results and minimise side effects.</p>
          </div>
        </div>

        <div class="yf-reveal yf-step flex gap-5 p-5 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors" data-delay="4">
          <div class="yf-step-num w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0 font-jost" style="background: linear-gradient(135deg, #1a73e9, #1d4ed8);">4</div>
          <div>
            <h3 class="font-bold text-gray-900 mb-1 font-jost">Reach your goal &amp; maintain results</h3>
            <p class="text-sm text-gray-600 font-jost">At your goal weight, we guide you through a structured exit plan to help you maintain your results long-term, with lifestyle advice and ongoing support.</p>
          </div>
        </div>

        <div class="yf-reveal pt-2" data-delay="5">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-7 py-3.5 rounded-full transition-colors font-jost shadow-lg shadow-blue-500/20">
            Book Your Free Consultation
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S7: TESTIMONIALS — Blue gradient, 6 glassmorphism review cards
     ============================================================ -->
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
            Book Weight Loss Consultation
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endfor; ?>
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
        <p class="text-blue-100 text-base font-jost">Walk in or book online. Our pharmacists can prescribe Mounjaro or Wegovy directly &mdash; same day, no waiting lists.</p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        Book Free Consultation
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

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="1">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost">GPhC-Registered</h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost">All prescribers are General Pharmaceutical Council registered. Your safety and clinical standards are never compromised.</p>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="2">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost">Same-Day Prescriptions</h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost">No waiting lists, no GP referrals. Book a free consultation online and start your weight loss programme the same day.</p>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="3">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost">Face-to-Face Care</h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost">Unlike online services, our pharmacists see you in person every month &mdash; monitoring progress, adjusting doses and answering your questions.</p>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="1">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost">4 Hampshire Locations</h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost">Southsea, Waterlooville, Havant and Portsmouth &mdash; with free parking. Always a convenient branch near you.</p>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="2">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost">MHRA-Approved Medications</h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost">We only prescribe UK-licensed, MHRA-approved medications. No compounded or unregulated products &mdash; ever.</p>
      </div>

      <div class="yf-reveal yf-card-lift bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7" data-delay="3">
        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-2 font-jost">10,000+ Patients Served</h3>
        <p class="text-blue-100 text-sm leading-relaxed font-jost">Over a decade serving Hampshire communities. Our 4.9-star rating reflects the care and trust we build with every patient.</p>
      </div>

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
        MHRA-Approved Meds
      </span>
    </div>

    <!-- Heading -->
    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-jost">Start your weight loss journey today</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto font-jost">Book your free consultation at your nearest Hampshire branch. Same-day prescriptions. No waiting lists. Real results.</p>
    </div>

    <!-- Checklist -->
    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-2 max-w-xl mx-auto mb-10 text-left yf-reveal" data-delay="1">
      <?php
      $points = [
        'Free consultation &mdash; no obligation',
        'Same-day prescription if eligible',
        'Monthly face-to-face check-ins',
        'MHRA-approved medications only',
        'GPhC-registered prescribers',
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
        Book Free Consultation
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
<div class="bg-gray-50 border-t border-gray-200 py-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-xs text-gray-500 text-center leading-relaxed font-jost max-w-4xl mx-auto">
      <strong>Medical disclaimer:</strong> The information on this page is for general information only and does not constitute medical advice. Mounjaro&reg; (tirzepatide) and Wegovy&reg; (semaglutide) are prescription-only medicines. Eligibility is subject to a clinical assessment by a GPhC-registered pharmacist prescriber. Results may vary. Individual weight loss outcomes depend on a number of factors including adherence to the treatment plan, lifestyle and pre-existing medical conditions. Always consult a healthcare professional before starting any new medication.
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
