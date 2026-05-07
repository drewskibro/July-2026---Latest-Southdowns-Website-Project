<?php
/**
 * Template Name: Travel Health
 *
 * Select this template on the Travel Health page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// ── ACF-backed copy (with hardcoded fallbacks) ─────────────────────────────
$th_hero_image    = ( function_exists( 'get_field' ) ? get_field( 'th_hero_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200&q=80&auto=format&fit=crop';
$th_hero_badge    = sp_field( 'th_hero_badge',    'No GP Referral &middot; Same-Day Appointments' );
$th_hero_headline = sp_field( 'th_hero_headline', 'Hampshire&rsquo;s Trusted Travel Health Clinic' );
$th_hero_body     = sp_field( 'th_hero_body',     'Southdowns Pharmacy&rsquo;s dedicated travel health service, serving Hampshire from 4 locations. Expert vaccination advice, same-day appointments, and everything you need to travel safely &mdash; all under one roof.' );

// Stats Bar (S2)
$th_stats_raw = function_exists( 'get_field' ) ? get_field( 'th_stats' ) : null;
$th_stats     = ! empty( $th_stats_raw ) ? $th_stats_raw : [
    [ 'value' => 'Same Day', 'label' => 'Travel Vaccinations',  'caption' => 'No referral needed, no long waits' ],
    [ 'value' => '1,000+',   'label' => 'Travellers Protected', 'caption' => 'Safe journeys across 50+ countries' ],
    [ 'value' => '20+',      'label' => 'Vaccines In Stock',    'caption' => 'Complete travel protection' ],
    [ 'value' => '4.9★',     'label' => 'Patient Rating',       'caption' => 'GPhC registered pharmacists' ],
];

// Why Choose Us (S3)
$th_why_eyebrow  = sp_field( 'th_why_eyebrow',  'More Than Just Jabs' );
$th_why_headline = sp_field( 'th_why_headline', 'Why Choose Our Hampshire Travel Clinics?' );
$th_why_subhead  = sp_field( 'th_why_subhead',  'Comprehensive travel health protection that gives you confidence from booking to landing.' );

$th_why_cards_raw = function_exists( 'get_field' ) ? get_field( 'th_why_cards' ) : null;
$th_why_cards     = ! empty( $th_why_cards_raw ) ? $th_why_cards_raw : [
    [
        'image'      => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
        'title'      => 'Expert Travel Consultations',
        'body'       => 'Personalised risk assessment based on your exact itinerary, not generic destination advice. We consider your route, accommodation type, activities, and medical history.',
        'link_label' => 'Book Consultation',
        'link_url'   => '',
    ],
    [
        'image'      => 'https://images.unsplash.com/photo-1584982751601-97dcc096659c?w=600&h=400&fit=crop',
        'title'      => 'Same-Day Appointments',
        'body'       => 'Last-minute trip planned? No problem. Get essential vaccinations administered the same day and walk out protected, not stressed about timing.',
        'link_label' => 'Book Consultation',
        'link_url'   => '',
    ],
    [
        'image'      => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=600&h=400&fit=crop',
        'title'      => 'Every Vaccine In Stock',
        'body'       => 'No prescription delays or follow-up visits. We stock every travel vaccine including Yellow Fever, DTP, Typhoid, Rabies, Japanese Encephalitis, and malaria prevention.',
        'link_label' => 'View All Vaccines',
        'link_url'   => '#vaccines',
    ],
];

// Services (S5)
$th_services_eyebrow   = sp_field( 'th_services_eyebrow',   'Everything Under One Roof' );
$th_services_headline  = sp_field( 'th_services_headline',  'Our Travel Health Services' );
$th_services_subhead   = sp_field( 'th_services_subhead',   'One appointment covers everything. No GP, no hospital, no hassle &mdash; we handle your complete travel health needs in one visit.' );
$th_services_cta_label = sp_field( 'th_services_cta_label', 'Book Your Travel Health Appointment' );

$th_services_cards_raw = function_exists( 'get_field' ) ? get_field( 'th_services_cards' ) : null;
$th_services_cards     = ! empty( $th_services_cards_raw ) ? $th_services_cards_raw : [
    [
        'title'        => 'Travel Vaccination Consultation',
        'body'         => 'Comprehensive one-to-one assessment with a qualified travel health pharmacist. We review your destination, activities, medical history, and previous vaccinations to create your personalised plan.',
        'bullets'      => "Same-day vaccination if required\nWritten vaccination record provided\nNo GP referral needed",
        'is_highlight' => false,
        'top_badge'    => '',
        'link_label'   => '',
        'link_url'     => '',
    ],
    [
        'title'        => 'Malaria Prevention',
        'body'         => 'Prescription anti-malarial medication tailored to your destination, travel dates, and medical history. We explain how and when to take your medication for maximum protection.',
        'bullets'      => "Doxycycline, Malarone & Lariam\nBite avoidance advice included\nSame-day prescription & supply",
        'is_highlight' => false,
        'top_badge'    => '',
        'link_label'   => '',
        'link_url'     => '',
    ],
    [
        'title'        => 'Fit to Fly Certificates',
        'body'         => 'Official documentation confirming you are medically fit to travel, accepted by all major UK airlines. Issued same-day following a brief assessment by our pharmacist.',
        'bullets'      => "Accepted by all UK airlines\nSame-day certificate issued\nQuick 15-minute appointment",
        'is_highlight' => false,
        'top_badge'    => '',
        'link_label'   => '',
        'link_url'     => '',
    ],
    [
        'title'        => 'Destination Health Advice',
        'body'         => 'Detailed written guidance for your specific destinations covering food and water safety, insect protection, sun safety, altitude sickness, traveller’s diarrhoea, and emergency medication.',
        'bullets'      => "Food & water safety guidance\nInsect & sun protection advice\nEmergency medication guidance",
        'is_highlight' => false,
        'top_badge'    => '',
        'link_label'   => '',
        'link_url'     => '',
    ],
    [
        'title'        => 'Travel Medication & Kits',
        'body'         => 'We supply a full range of travel medications including altitude sickness tablets, traveller’s diarrhoea treatment, antihistamines, and first aid essentials for your trip.',
        'bullets'      => "Altitude sickness prevention\nTraveller’s diarrhoea treatment\nFull travel first-aid kits",
        'is_highlight' => false,
        'top_badge'    => '',
        'link_label'   => '',
        'link_url'     => '',
    ],
    [
        'title'        => 'Yellow Fever Vaccination',
        'body'         => 'We are an NHS-registered Yellow Fever Vaccination Centre. A single dose provides lifelong immunity and the ICVP certificate is valid for life. Accepted at all borders.',
        'bullets'      => "ICVP certificate issued same day\nValid for life — no boosters needed\nNHS-registered centre",
        'is_highlight' => true,
        'top_badge'    => 'Official Vaccination Centre',
        'link_label'   => 'Learn more about Yellow Fever',
        'link_url'     => home_url( '/yellow-fever/' ),
    ],
];

// Vaccines (S6)
$th_vaccines_eyebrow         = sp_field( 'th_vaccines_eyebrow',         'Always In Stock' );
$th_vaccines_headline        = sp_field( 'th_vaccines_headline',        'Travel Vaccines We Provide' );
$th_vaccines_subhead         = sp_field( 'th_vaccines_subhead',         'No prescription, no waiting lists, no GP appointments. All vaccines are available same-day across our 4 Hampshire locations.' );
$th_vaccines_banner_body     = sp_field( 'th_vaccines_banner_body',     'Some vaccinations require a course of doses over several weeks. We recommend booking your appointment at least <strong>6&ndash;8 weeks before travel</strong>, though we can still help with last-minute trips.' );
$th_vaccines_banner_cta      = sp_field( 'th_vaccines_banner_cta_label', 'Book Now' );

$th_vaccines_raw = function_exists( 'get_field' ) ? get_field( 'th_vaccines_list' ) : null;
$th_vaccines     = ! empty( $th_vaccines_raw ) ? $th_vaccines_raw : [
    [ 'name' => 'Yellow Fever',                 'description' => 'ICVP certificate included &middot; Valid for life',           'is_yf' => true  ],
    [ 'name' => 'Hepatitis A',                  'description' => 'Single dose gives 1 year protection, booster lasts 25 years', 'is_yf' => false ],
    [ 'name' => 'Hepatitis B',                  'description' => 'Course of 3 doses over 6 months &middot; Long-term protection', 'is_yf' => false ],
    [ 'name' => 'Typhoid',                      'description' => 'Injection or oral capsules &middot; 3-year protection',        'is_yf' => false ],
    [ 'name' => 'Rabies (Pre-Exposure)',        'description' => '3-dose course &middot; Essential for adventure travellers',    'is_yf' => false ],
    [ 'name' => 'Meningitis ACWY',              'description' => 'Single dose &middot; Required for Hajj / Umrah pilgrims',     'is_yf' => false ],
    [ 'name' => 'Japanese Encephalitis',        'description' => '2-dose course &middot; For rural Asia travel',                'is_yf' => false ],
    [ 'name' => 'Diphtheria, Tetanus & Polio',  'description' => 'Combined booster &middot; 10-year protection',                'is_yf' => false ],
    [ 'name' => 'Cholera',                      'description' => 'Oral vaccine &middot; Includes diarrhoea protection',         'is_yf' => false ],
    [ 'name' => 'Chickenpox (Varicella)',       'description' => 'For travellers without prior immunity',                       'is_yf' => false ],
    [ 'name' => 'MMR (Measles, Mumps, Rubella)', 'description' => 'Catch-up for unvaccinated adults',                           'is_yf' => false ],
    [ 'name' => 'Travel Flu & Pneumo',          'description' => 'For high-risk travellers and over-65s',                       'is_yf' => false ],
];

// How It Works (S7)
$th_how_eyebrow  = sp_field( 'th_how_eyebrow',  'Simple &amp; Straightforward' );
$th_how_headline = sp_field( 'th_how_headline', 'How Your Appointment Works' );
$th_how_subhead  = sp_field( 'th_how_subhead',  'From booking to protected &mdash; it really is this simple. No GP referral, no long waits, no unnecessary visits.' );

$th_how_steps_raw = function_exists( 'get_field' ) ? get_field( 'th_how_steps' ) : null;
$th_how_steps     = ! empty( $th_how_steps_raw ) ? $th_how_steps_raw : [
    [
        'image'     => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop',
        'image_alt' => 'Book your travel health appointment online',
        'title'     => 'Book Online or Call Us',
        'body'      => 'Book a travel health consultation at your nearest Southdowns Pharmacy location. Same-day appointments are usually available &mdash; just call ahead to confirm. No GP referral needed.',
        'bullets'   => '',
    ],
    [
        'image'     => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=400&fit=crop',
        'image_alt' => 'Travel health consultation with pharmacist',
        'title'     => 'Your Consultation',
        'body'      => 'A qualified travel health pharmacist reviews your destinations, activities, medical history, and travel dates. We build your personalised vaccine and health plan &mdash; typically takes 20&ndash;30 minutes.',
        'bullets'   => "Personalised risk assessment\nWritten health advice provided",
    ],
    [
        'image'     => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=600&h=400&fit=crop',
        'image_alt' => 'Travel vaccinations administered same day',
        'title'     => 'Vaccinated &amp; Ready to Go',
        'body'      => 'Approved vaccines are administered the same day, no follow-up visit needed. You leave with your vaccination record, written health advice, and the confidence to travel safely.',
        'bullets'   => "Certificates issued same day\nComplete vaccination record kept",
    ],
];

// Trust / About (S8)
$th_trust_eyebrow      = sp_field( 'th_trust_eyebrow',      'GPhC Registered &middot; NHS Partner' );
$th_trust_headline     = sp_field( 'th_trust_headline',     'Hampshire&rsquo;s Dedicated Travel Health Experts' );
$th_trust_intro        = sp_field( 'th_trust_intro',        'Southdowns Pharmacy Group has been protecting Hampshire travellers for years. Our dedicated travel health team combines clinical expertise with genuine care to make your trip preparation as straightforward as possible.' );
$th_trust_cta_label    = sp_field( 'th_trust_cta_label',    'Book Your Appointment' );
$th_trust_image        = ( function_exists( 'get_field' ) ? get_field( 'th_trust_image' ) : '' ) ?: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=700&h=900&fit=crop';
$th_trust_image_alt    = sp_field( 'th_trust_image_alt',    'Southdowns Pharmacy travel health pharmacist' );
$th_trust_badge_title  = sp_field( 'th_trust_badge_title',  'GPhC Registered' );
$th_trust_badge_body   = sp_field( 'th_trust_badge_body',   'Fully qualified travel health pharmacists at all 4 locations' );
$th_trust_badge_rating = sp_field( 'th_trust_badge_rating', '4.9/5 Rating' );
$th_trust_stat_value   = sp_field( 'th_trust_stat_value',   '1,000+' );
$th_trust_stat_caption = sp_field( 'th_trust_stat_caption', 'Travellers protected each year' );

$th_trust_points_raw = function_exists( 'get_field' ) ? get_field( 'th_trust_points' ) : null;
$th_trust_points     = ! empty( $th_trust_points_raw ) ? $th_trust_points_raw : [
    [ 'title' => 'GPhC Registered Pharmacists',         'body' => 'All our travel health pharmacists are registered with the General Pharmaceutical Council and hold specialist travel health qualifications.' ],
    [ 'title' => 'NHS-Designated Yellow Fever Centre',  'body' => 'One of very few approved Yellow Fever vaccination centres in Hampshire, we meet NHS standards for international travel certification.' ],
    [ 'title' => '4 Convenient Hampshire Locations',    'body' => 'Cosham, Emsworth, Havant, and Purbrook &mdash; with free parking, wheelchair access, and extended opening hours at most sites.' ],
    [ 'title' => 'Trusted by Local GPs',                'body' => 'Hampshire GPs refer their patients to us for travel health advice, knowing they&rsquo;ll receive expert care and up-to-date guidance.' ],
];

// Service-card icons cycle by position. Six built-in icons; defaults map 1:1 to the cards above.
$th_service_icons = [
    '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3M8 21H5a2 2 0 0 1-2-2v-3m18 0v3a2 2 0 0 1-2 2h-3"/><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>',
    '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.58a2 2 0 0 1 2-2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
    '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
    '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><path d="M3 9h18M9 21V9"/></svg>',
    '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
];
?>

<!-- Page-scoped styles -->
<style>
  /* Scroll reveal */
  .tv-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .tv-reveal.visible { opacity: 1; transform: translateY(0); }
  .tv-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .tv-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .tv-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .tv-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .tv-reveal[data-delay="5"] { transition-delay: 0.5s; }

  /* FAQ Accordion */
  .tv-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s ease; }
  .tv-faq-item.active .tv-faq-answer { max-height: 500px; }
  .tv-faq-item.active .tv-faq-icon { transform: rotate(45deg); }
  .tv-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }
  .tv-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .tv-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .tv-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }

  /* Card hover lift */
  .tv-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .tv-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }

  /* Shimmer */
  @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
  .tv-shimmer { background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }
</style>

<!-- ============================================================
     S1: HERO — Matches homepage 2-column layout exactly
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-width image with overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $th_hero_image ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $th_hero_badge ); ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $th_hero_headline ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $th_hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Travel Consultation
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost">Same-day appointments typically available &middot; No referral needed</p>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $th_hero_badge ); ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $th_hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $th_hero_body ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Travel Consultation
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#vaccines" class="inline-flex items-center gap-2 border-2 border-white text-white text-base font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-blue-700 transition-colors font-jost">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14l2 2 4-4"/></svg>
          Check What Vaccines You Need
        </a>
      </div>
      <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/90 text-sm font-jost">
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> All Travel Vaccines</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Same-Day Available</span>
        <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Expert Pharmacists</span>
      </div>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $th_hero_image ); ?>');"></div>

    <!-- Badge images straddling the centre divider -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398697-0.png" alt="Same Day Appointments" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398761-2.png" alt="Yellow Fever Centre" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398725-1.png" alt="5-Star Service" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
  </div>

</section>


<!-- ============================================================
     S2: STATS BAR — Blue gradient, 4 glassmorphism stat cards
     ============================================================ -->
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
      <?php foreach ( $th_stats as $i => $stat ) : ?>
      <div class="tv-reveal tv-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $stat['value'] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost"><?php echo esc_html( $stat['label'] ); ?></div>
        <?php if ( ! empty( $stat['caption'] ) ) : ?>
          <div class="text-xs text-blue-200/60 mt-1 font-jost"><?php echo esc_html( $stat['caption'] ); ?></div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: WHY CHOOSE US — White bg, 3 photo cards with numbered badges
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="why-us">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $th_why_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $th_why_headline ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo wp_kses_post( $th_why_subhead ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

      <?php foreach ( $th_why_cards as $i => $card ) :
        $card_link = ! empty( $card['link_url'] ) ? $card['link_url'] : $booking_url;
      ?>
      <div class="tv-reveal tv-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo (int) $i + 1; ?>">
        <div class="relative overflow-hidden aspect-[3/2]">
          <img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
          <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
          <p class="text-gray-600 leading-relaxed mb-4 font-jost"><?php echo wp_kses_post( $card['body'] ); ?></p>
          <?php if ( ! empty( $card['link_label'] ) ) : ?>
          <a href="<?php echo esc_url( $card_link ); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm hover:gap-3 transition-all font-jost">
            <?php echo esc_html( $card['link_label'] ); ?> <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ============================================================
     S4: POPULAR DESTINATIONS — Blue gradient, 8 destination photo cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="destinations">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Popular Travel Destinations</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Where Are You Headed?</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">From tropical Asia to safari Africa, we have the vaccinations and expert advice to keep you safe wherever your adventure takes you.</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Thailand -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="1">
        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=450&fit=crop" alt="Thailand travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">Southeast Asia</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Thailand</h3>
          <p class="text-blue-100/80 text-xs font-jost">Hep A/B &middot; Typhoid &middot; Rabies</p>
        </div>
      </div>

      <!-- India -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="2">
        <img src="https://images.unsplash.com/photo-1564507592333-c60657eea523?w=600&h=450&fit=crop" alt="India travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">South Asia</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">India</h3>
          <p class="text-blue-100/80 text-xs font-jost">Hep A/B &middot; Typhoid &middot; DTP</p>
        </div>
      </div>

      <!-- Kenya -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="3">
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=600&h=450&fit=crop" alt="Kenya travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">East Africa</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Kenya</h3>
          <p class="text-blue-100/80 text-xs font-jost">Yellow Fever &middot; Typhoid &middot; Malaria</p>
        </div>
      </div>

      <!-- Vietnam -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="4">
        <img src="https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=600&h=450&fit=crop" alt="Vietnam travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">Southeast Asia</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Vietnam</h3>
          <p class="text-blue-100/80 text-xs font-jost">Hep A &middot; Typhoid &middot; Rabies</p>
        </div>
      </div>

      <!-- Tanzania -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="1">
        <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&h=450&fit=crop" alt="Tanzania safari travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">East Africa</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Tanzania</h3>
          <p class="text-blue-100/80 text-xs font-jost">Yellow Fever &middot; Malaria &middot; Typhoid</p>
        </div>
      </div>

      <!-- Morocco -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="2">
        <img src="https://images.unsplash.com/photo-1539020140153-e479b8c22e70?w=600&h=450&fit=crop" alt="Morocco travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">North Africa</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Morocco</h3>
          <p class="text-blue-100/80 text-xs font-jost">Hep A &middot; Typhoid &middot; Rabies</p>
        </div>
      </div>

      <!-- Indonesia / Bali -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="3">
        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&h=450&fit=crop" alt="Indonesia Bali travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">Southeast Asia</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Indonesia / Bali</h3>
          <p class="text-blue-100/80 text-xs font-jost">Hep A/B &middot; Typhoid &middot; Rabies</p>
        </div>
      </div>

      <!-- Dubai / UAE -->
      <div class="tv-reveal tv-card-lift relative group overflow-hidden rounded-2xl aspect-[4/3]" data-delay="4">
        <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&h=450&fit=crop" alt="Dubai UAE travel vaccinations" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end p-4">
          <div class="text-xs text-blue-200 font-semibold uppercase tracking-wider mb-1 font-jost">Middle East</div>
          <h3 class="text-white font-bold text-lg leading-tight mb-1 font-jost">Dubai / UAE</h3>
          <p class="text-blue-100/80 text-xs font-jost">Hep A &middot; DTP &middot; Advice</p>
        </div>
      </div>

    </div>
    <!-- CTA strip -->
    <div class="text-center mt-10">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
        Get Your Personalised Vaccine Plan
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <p class="text-blue-200 text-sm mt-3 font-jost">Not seeing your destination? We cover 150+ countries &mdash; book a consultation for a personalised assessment.</p>
    </div>
  </div>
</section>


<!-- ============================================================
     S5: COMPREHENSIVE SERVICES — White bg, 6 service cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="services">
  <div class="absolute top-0 left-0 w-80 h-80 bg-blue-50/60 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-50/40 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $th_services_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $th_services_headline ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo wp_kses_post( $th_services_subhead ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <?php foreach ( $th_services_cards as $i => $card ) :
        $is_hl  = ! empty( $card['is_highlight'] );
        $delay  = ( $i % 3 ) + 1;
        $bullet_lines = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) ( $card['bullets'] ?? '' ) ) ) );
        $card_border  = $is_hl ? 'border-amber-200 bg-gradient-to-br from-amber-50 to-white' : 'border-blue-100 bg-gradient-to-br from-blue-50 to-white';
        $icon_bg      = $is_hl ? 'bg-gradient-to-br from-amber-400 to-amber-600' : '';
        $icon_style   = $is_hl ? '' : 'background:linear-gradient(135deg,#1d4ed8,#3b82f6);';
        $bullet_color = $is_hl ? '#d97706' : '#3b82f6';
        $link_color   = $is_hl ? 'text-amber-600' : 'text-blue-600';
        $icon_svg     = $th_service_icons[ $i ] ?? $th_service_icons[0];
      ?>
      <div class="tv-reveal tv-card-lift rounded-2xl p-8 border <?php echo esc_attr( $card_border ); ?>" data-delay="<?php echo (int) $delay; ?>">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-5 text-white <?php echo esc_attr( $icon_bg ); ?>"<?php echo $icon_style ? ' style="' . esc_attr( $icon_style ) . '"' : ''; ?>>
          <?php echo $icon_svg; ?>
        </div>
        <?php if ( ! empty( $card['top_badge'] ) ) : ?>
        <div class="inline-flex items-center gap-1.5 bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wide"><?php echo esc_html( $card['top_badge'] ); ?></div>
        <?php endif; ?>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-gray-600 leading-relaxed mb-4 font-jost"><?php echo wp_kses_post( $card['body'] ); ?></p>
        <?php if ( ! empty( $bullet_lines ) ) : ?>
        <ul class="space-y-2">
          <?php foreach ( $bullet_lines as $line ) : ?>
          <li class="flex items-center gap-2 text-sm text-gray-600 font-jost"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr( $bullet_color ); ?>" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><?php echo esc_html( $line ); ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php if ( ! empty( $card['link_label'] ) && ! empty( $card['link_url'] ) ) : ?>
        <a href="<?php echo esc_url( $card['link_url'] ); ?>" class="inline-flex items-center gap-2 <?php echo esc_attr( $link_color ); ?> font-semibold text-sm mt-4 hover:gap-3 transition-all font-jost">
          <?php echo esc_html( $card['link_label'] ); ?> <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>

    </div>
    <div class="text-center mt-10">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
        <?php echo esc_html( $th_services_cta_label ); ?>
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: AVAILABLE VACCINES — Blue gradient, 12 vaccine name tiles
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="vaccines">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $th_vaccines_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost"><?php echo esc_html( $th_vaccines_headline ); ?></h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo wp_kses_post( $th_vaccines_subhead ); ?></p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php foreach ( $th_vaccines as $i => $v ) :
        $delay = ( $i % 3 ) + 1;
        $is_yf = ! empty( $v['is_yf'] );
      ?>
      <div class="tv-reveal tv-card-lift flex items-start gap-4 p-5 rounded-2xl border backdrop-blur-sm <?php echo $is_yf ? 'bg-amber-500/20 border-amber-400/40' : 'bg-white/10 border-white/20 hover:bg-white/15'; ?> transition-colors" data-delay="<?php echo (int) $delay; ?>">
        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center <?php echo $is_yf ? 'bg-amber-400/30' : 'bg-white/20'; ?>">
          <?php if ( $is_yf ) : ?>
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <?php else : ?>
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
          <?php endif; ?>
        </div>
        <div>
          <div class="font-bold <?php echo $is_yf ? 'text-amber-200' : 'text-white'; ?> font-jost mb-1"><?php echo wp_kses_post( $v['name'] ); ?></div>
          <div class="text-xs <?php echo $is_yf ? 'text-amber-100/80' : 'text-blue-100/80'; ?> font-jost"><?php echo wp_kses_post( $v['description'] ); ?></div>
        </div>
        <?php if ( $is_yf ) : ?>
        <div class="ml-auto flex-shrink-0">
          <span class="bg-amber-400/30 text-amber-200 text-xs font-bold px-2.5 py-1 rounded-full font-jost">ICVP</span>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-10 p-5 rounded-2xl bg-white/10 border border-white/20 flex flex-col sm:flex-row items-start sm:items-center gap-4">
      <svg class="flex-shrink-0 w-8 h-8 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <p class="text-blue-100 text-sm leading-relaxed font-jost flex-1"><?php echo wp_kses_post( $th_vaccines_banner_body ); ?></p>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="flex-shrink-0 inline-flex items-center gap-2 bg-white text-blue-700 font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-blue-50 transition-colors shadow font-jost">
        <?php echo esc_html( $th_vaccines_banner_cta ); ?> <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- ============================================================
     S7: HOW IT WORKS — White bg, 3 photo step cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 left-0 w-80 h-80 bg-blue-50/60 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $th_how_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $th_how_headline ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo $th_how_subhead; ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

      <?php foreach ( $th_how_steps as $i => $step ) :
          $step_num   = $i + 1;
          $step_image = ! empty( $step['image'] ) ? $step['image'] : '';
          $step_alt   = ! empty( $step['image_alt'] ) ? $step['image_alt'] : '';
          $step_title = ! empty( $step['title'] ) ? $step['title'] : '';
          $step_body  = ! empty( $step['body'] ) ? $step['body'] : '';
          $bullets_raw = isset( $step['bullets'] ) ? (string) $step['bullets'] : '';
          $bullets    = array_values( array_filter( array_map( 'trim', preg_split( "/\r\n|\r|\n/", $bullets_raw ) ) ) );
      ?>
      <div class="tv-reveal tv-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo (int) $step_num; ?>">
        <div class="relative overflow-hidden aspect-[3/2]">
          <?php if ( $step_image ) : ?>
          <img src="<?php echo esc_url( $step_image ); ?>" alt="<?php echo esc_attr( $step_alt ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <?php endif; ?>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <div class="absolute top-4 left-4">
            <div class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider font-jost">STEP <?php echo (int) $step_num; ?></div>
          </div>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo $step_title; ?></h3>
          <p class="text-gray-600 leading-relaxed mb-4 font-jost"><?php echo $step_body; ?></p>
          <?php if ( $step_num === 1 ) : ?>
          <div class="flex flex-wrap gap-3">
            <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-full hover:bg-blue-700 transition-colors font-jost">
              Book Online
            </a>
            <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center gap-2 text-blue-600 text-sm font-semibold px-4 py-2 rounded-full border border-blue-200 hover:border-blue-400 transition-colors font-jost">
              Call Us
            </a>
          </div>
          <?php elseif ( ! empty( $bullets ) ) : ?>
          <ul class="space-y-1.5">
            <?php foreach ( $bullets as $bullet ) : ?>
            <li class="flex items-center gap-2 text-sm text-gray-600 font-jost"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><?php echo esc_html( $bullet ); ?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ============================================================
     S8: TRUST / ABOUT — Light gradient, two-col with bullet points + photo
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f0fe 50%, #f5f8ff 100%);">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/40 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      <!-- Left: copy -->
      <div class="tv-reveal" data-delay="1">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo $th_trust_eyebrow; ?></span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo $th_trust_headline; ?></h2>
        <p class="text-lg text-gray-600 leading-relaxed mb-6 font-jost"><?php echo $th_trust_intro; ?></p>
        <ul class="space-y-4 mb-8">
          <?php foreach ( $th_trust_points as $point ) :
              $pt_title = ! empty( $point['title'] ) ? $point['title'] : '';
              $pt_body  = ! empty( $point['body'] )  ? $point['body']  : '';
              if ( ! $pt_title && ! $pt_body ) { continue; }
          ?>
          <li class="flex items-start gap-4">
            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center mt-0.5" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div>
              <div class="font-bold text-slate-800 font-jost mb-1"><?php echo esc_html( $pt_title ); ?></div>
              <div class="text-gray-600 text-sm leading-relaxed font-jost"><?php echo $pt_body; ?></div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php if ( $th_trust_cta_label ) : ?>
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <?php echo esc_html( $th_trust_cta_label ); ?>
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <?php endif; ?>
      </div>

      <!-- Right: photo + floating badge -->
      <div class="tv-reveal relative" data-delay="2">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/5]">
          <img src="<?php echo esc_url( $th_trust_image ); ?>" alt="<?php echo esc_attr( $th_trust_image_alt ); ?>" class="w-full h-full object-cover" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 to-transparent"></div>
        </div>
        <?php if ( $th_trust_badge_title || $th_trust_badge_body || $th_trust_badge_rating ) : ?>
        <!-- Floating trust badge -->
        <div class="absolute -bottom-4 -left-4 md:-left-8 bg-white rounded-2xl shadow-xl p-5 max-w-[220px]">
          <?php if ( $th_trust_badge_title ) : ?>
          <div class="flex items-center gap-2 mb-2">
            <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <span class="font-bold text-slate-800 text-sm font-jost"><?php echo esc_html( $th_trust_badge_title ); ?></span>
          </div>
          <?php endif; ?>
          <?php if ( $th_trust_badge_body ) : ?>
          <p class="text-gray-500 text-xs leading-relaxed font-jost"><?php echo $th_trust_badge_body; ?></p>
          <?php endif; ?>
          <?php if ( $th_trust_badge_rating ) : ?>
          <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-1">
            <?php for($s=0;$s<5;$s++): ?><svg width="14" height="14" viewBox="0 0 24 24" fill="#fbbf24" stroke="#fbbf24" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><?php endfor; ?>
            <span class="text-xs text-gray-500 ml-1 font-jost"><?php echo esc_html( $th_trust_badge_rating ); ?></span>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ( $th_trust_stat_value || $th_trust_stat_caption ) : ?>
        <!-- Second floating badge top right -->
        <div class="absolute -top-4 -right-4 md:-right-8 bg-white rounded-2xl shadow-xl p-4 max-w-[180px]">
          <?php if ( $th_trust_stat_value ) : ?><div class="text-2xl font-bold text-blue-700 font-jost"><?php echo esc_html( $th_trust_stat_value ); ?></div><?php endif; ?>
          <?php if ( $th_trust_stat_caption ) : ?><div class="text-xs text-gray-500 font-jost"><?php echo esc_html( $th_trust_stat_caption ); ?></div><?php endif; ?>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S9: FAQ — White bg, sticky sidebar + 8 accordion items
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="faq">
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-50/60 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Frequently Asked Questions</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost">Travel Health FAQs</h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost">Everything you need to know about travel vaccinations and health advice at Southdowns Pharmacy.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-14 items-start">
      <!-- Sticky sidebar -->
      <div class="lg:sticky lg:top-24 tv-reveal" data-delay="1">
        <div class="rounded-2xl p-8 border border-blue-100" style="background:linear-gradient(135deg,#f0f4ff,#e8f0fe);">
          <h3 class="text-xl font-bold text-slate-800 mb-4 font-jost">Ready to travel safely?</h3>
          <p class="text-gray-600 text-sm leading-relaxed mb-6 font-jost">Our travel health pharmacists are available 6 days a week. Same-day appointments usually available.</p>
          <div class="space-y-3 mb-6">
            <div class="flex items-center gap-3 p-3 bg-white rounded-xl border border-blue-100">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
              <div><div class="font-semibold text-slate-800 text-sm font-jost">Same-Day Available</div><div class="text-xs text-gray-500 font-jost">Mon–Sat</div></div>
            </div>
            <div class="flex items-center gap-3 p-3 bg-white rounded-xl border border-blue-100">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
              <div><div class="font-semibold text-slate-800 text-sm font-jost">No GP Referral</div><div class="text-xs text-gray-500 font-jost">Walk in or book ahead</div></div>
            </div>
            <div class="flex items-center gap-3 p-3 bg-white rounded-xl border border-blue-100">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.58a2 2 0 0 1 2-2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
              <div><div class="font-semibold text-slate-800 text-sm font-jost"><?php echo esc_html( $phone ); ?></div><div class="text-xs text-gray-500 font-jost">Free to call</div></div>
            </div>
          </div>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="block text-center text-white font-semibold py-3.5 rounded-full shadow-lg font-jost transition-opacity hover:opacity-90 mb-3" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            Book Travel Consultation
          </a>
          <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="block text-center text-blue-700 font-semibold py-3.5 rounded-full border border-blue-200 hover:border-blue-400 transition-colors font-jost">
            Call <?php echo esc_html( $phone ); ?>
          </a>
        </div>
      </div>

      <!-- FAQ accordion -->
      <div class="lg:col-span-2 space-y-4">
        <?php
        $faqs = [
          ['01', 'How far in advance should I book travel vaccinations?',
           'We recommend booking at least <strong>6–8 weeks before travel</strong>. Some vaccines require a course of injections over several weeks (e.g. Rabies requires 3 doses over 21–28 days, Hepatitis B requires 3 doses over 6 months). That said, we can still help with last-minute trips and will do our best to protect you even with limited time.'],
          ['02', 'Do I need a GP referral for travel vaccinations?',
           '<strong>No GP referral is needed.</strong> Simply book directly with us online or by phone. Our qualified pharmacists can assess your needs, recommend the right vaccines, and administer them all in the same appointment. No waiting lists, no bouncing between services.'],
          ['03', 'Which vaccinations are free on the NHS for travel?',
           'A small number of travel vaccines are available free on the NHS if your GP provides them: Hepatitis A, Typhoid, Cholera, and Polio (if boosters are needed). <strong>Most travel vaccines are private</strong> (not NHS-funded), including Yellow Fever, Rabies, Japanese Encephalitis, Hepatitis B, and Meningitis ACWY (for travel). We can advise you on what&rsquo;s available and at what cost during your consultation.'],
          ['04', 'What happens at a travel health consultation?',
           'Your appointment typically takes <strong>20–30 minutes</strong>. A qualified travel health pharmacist will: review your destination(s) and planned activities; check your vaccination history; discuss any relevant medical conditions; recommend appropriate vaccines and malaria prevention; and provide written destination-specific health advice. Approved vaccines are usually administered the same day.'],
          ['05', 'Can you vaccinate children for travel?',
           'Yes, we vaccinate children for travel. <strong>Most vaccines can be given from 12 months of age</strong>, and some from 6 weeks. We will tailor recommendations to your child&rsquo;s age and destination. Please bring any previous vaccination records to the appointment.'],
          ['06', 'Do you stock malaria tablets?',
           'Yes. We supply all commonly prescribed anti-malarial medications including <strong>Doxycycline</strong>, <strong>Malarone (Atovaquone/Proguanil)</strong>, and <strong>Lariam (Mefloquine)</strong>. The right choice depends on your destination, medical history, and personal preferences &mdash; we&rsquo;ll discuss all options at your consultation.'],
          ['07', 'What is the Yellow Fever certificate (ICVP) and do you issue them?',
           'The <strong>International Certificate of Vaccination or Prophylaxis (ICVP)</strong>, also known as the "Yellow Card," is an official WHO document proving you have been vaccinated against Yellow Fever. Some countries require it for entry. We are an NHS-approved Yellow Fever Vaccination Centre and issue ICVP certificates on the same day as vaccination. The certificate is now valid for life (no booster or renewal needed).'],
          ['08', 'Can I get all my vaccines in one appointment?',
           '<strong>Yes, in most cases.</strong> We can administer multiple vaccines on the same day &mdash; most travel vaccines can be given simultaneously. We stock everything you&rsquo;re likely to need and will coordinate your jabs efficiently to minimise the number of appointments required. Courses requiring multiple doses (such as Rabies or Hepatitis B) will need follow-up visits.'],
        ];
        foreach ( $faqs as $faq ) : ?>
        <div class="tv-faq-item tv-reveal border border-gray-200 rounded-2xl overflow-hidden" data-delay="2">
          <button class="tv-faq-trigger w-full flex items-center gap-4 p-6 text-left bg-white hover:bg-blue-50/50 transition-colors" type="button">
            <span class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center text-white text-sm font-bold font-jost" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);"><?php echo esc_html( $faq[0] ); ?></span>
            <span class="flex-1 font-semibold text-slate-800 text-base leading-snug font-jost"><?php echo $faq[1]; ?></span>
            <span class="tv-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
          </button>
          <div class="tv-faq-answer">
            <div class="px-6 pb-6 text-gray-600 leading-relaxed font-jost text-sm"><?php echo $faq[2]; ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S10: LOCATIONS — Light gradient, 4 branch cards
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
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost">Visit Your Nearest Travel Clinic</h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost">All four Southdowns Pharmacy locations offer the full range of travel health services. Same-day appointments usually available &mdash; call ahead to confirm.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php for ( $i = 1; $i <= 4; $i++ ) :
        $b       = sp_branch( $i );
        $name    = $b['name'];
        $addr1   = $b['address_line1'];
        $addr2   = $b['address_line2'];
        $hours   = sp_branch_hours_html( $b );
        $img     = $b['card_image'];
        $delay   = $i;
      ?>
      <div class="tv-reveal tv-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group flex flex-col" data-delay="<?php echo $delay; ?>">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_attr( $img ); ?>" alt="<?php echo esc_attr( $name ); ?> travel health clinic" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full font-jost">Travel Clinic</span>
          </div>
        </div>
        <div class="p-5 flex flex-col flex-1">
          <h3 class="text-lg font-bold text-slate-800 mb-2 font-jost"><?php echo esc_html( $name ); ?></h3>
          <div class="space-y-1.5 text-sm text-gray-600 mb-4 font-jost">
            <div class="flex items-start gap-2">
              <svg class="flex-shrink-0 mt-0.5 text-blue-500" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span><?php echo esc_html( $addr1 ); ?><?php if ($addr2) echo ', ' . esc_html( $addr2 ); ?></span>
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
      <?php endfor; ?>
    </div>

    <!-- Info banner -->
    <div class="mt-10 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-start md:items-center gap-5 bg-white border border-blue-100 shadow-sm">
      <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </div>
      <div class="flex-1">
        <div class="font-bold text-slate-800 font-jost mb-1">Not sure which branch to visit?</div>
        <p class="text-gray-600 text-sm font-jost">Each of our four pharmacies books its own travel health appointments. Find your nearest location above and contact that branch directly &mdash; every site offers the complete range of travel health services.</p>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S11: FINAL CTA — Blue gradient, trust badges, Book + phone CTAs
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-8">
      <div class="badge-rule w-10 h-px bg-white/15"></div>
      <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Same-Day Appointments Available</span>
    </div>
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 font-jost" style="line-height:1.1;">Travel with Confidence.<br/>Start Here.</h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost">Don&rsquo;t leave your health to chance. Book a travel health consultation with Hampshire&rsquo;s most trusted pharmacy group &mdash; expert advice, all vaccines in stock, same-day appointments across 4 locations.</p>

    <!-- Trust badge pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php
      $trust_pills = [
        ['<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>', 'GPhC Registered'],
        ['<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>', '4 Hampshire Locations'],
        ['<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>', 'Same-Day Appointments'],
        ['<polyline points="20 6 9 17 4 12"/>', 'No GP Referral Needed'],
        ['<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>', '20+ Vaccines In Stock'],
      ];
      foreach ( $trust_pills as $pill ) : ?>
      <div class="flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full border border-white/20 font-jost">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $pill[0]; ?></svg>
        <?php echo esc_html( $pill[1] ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-wrap justify-center gap-4 mb-10">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold text-lg px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl font-jost">
        Book Travel Consultation
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
      <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center gap-2 text-white/90 font-semibold text-lg px-8 py-4 rounded-full border-2 border-white/30 hover:border-white/60 transition-colors font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.58a2 2 0 0 1 2-2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        Call <?php echo esc_html( $phone ); ?>
      </a>
    </div>

    <!-- Checklist -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-xl mx-auto mb-10">
      <?php
      $checklist = [
        'All travel vaccines in stock',
        'No GP referral required',
        'Written health advice included',
        'ICVP certificates issued same-day',
        'Malaria prevention prescriptions',
        'Fit to fly certificates',
      ];
      foreach ( $checklist as $item ) : ?>
      <div class="flex items-center gap-2 text-white/90 text-sm font-jost">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        <?php echo esc_html( $item ); ?>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Trust indicators -->
    <div class="flex flex-wrap justify-center gap-6 text-blue-200/80 text-xs font-jost">
      <span>&#9733; 4.9/5 Patient Rating</span>
      <span>&middot;</span>
      <span>1,000+ Travellers Protected</span>
      <span>&middot;</span>
      <span>GPhC Registered</span>
      <span>&middot;</span>
      <span>NHS Yellow Fever Centre</span>
    </div>
  </div>
</section>

<!-- Medical disclaimer -->
<div class="bg-slate-50 border-t border-slate-200 py-6">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-xs text-gray-400 leading-relaxed font-jost"><strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. Travel health recommendations vary depending on your individual medical history, destination, and activities. Always consult a qualified healthcare professional before travelling. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).</p>
  </div>
</div>

<!-- FAQ accordion JS -->
<script>
(function() {
  document.querySelectorAll('.tv-faq-trigger').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.tv-faq-item');
      var isOpen = item.classList.contains('active');
      document.querySelectorAll('.tv-faq-item.active').forEach(function(el) { el.classList.remove('active'); });
      if (!isOpen) item.classList.add('active');
    });
  });
})();
</script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.tv-reveal');
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
