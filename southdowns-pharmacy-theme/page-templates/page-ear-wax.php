<?php
/**
 * Template Name: Ear Wax Removal
 *
 * Select this template on the Ear Wax page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();

// ── S1 Hero ACF fields ────────────────────────────────────────
$hero_image       = get_field( 'ew_hero_image' )      ?: 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=1200&q=80&auto=format&fit=crop';
$hero_image_alt   = get_field( 'ew_hero_image_alt' )  ?: 'Professional ear wax removal by microsuction';
$hero_badge       = get_field( 'ew_hero_badge' )      ?: 'TympaHealth Certified';
$hero_headline    = get_field( 'ew_hero_headline' )   ?: 'Professional <span class="serif-accent">ear wax removal</span> by microsuction';
$hero_body        = get_field( 'ew_hero_body' )       ?: 'Powered by TympaHealth, our trained clinicians use gentle low-pressure microsuction &mdash; the gold standard in ear care. No water, no mess, completely painless with immediate results.';
$hero_sub_text    = get_field( 'ew_hero_sub_text' )   ?: '&pound;50 one ear &middot; &pound;55 both ears &middot; Same-day appointments';
$hero_roundel_1   = get_field( 'ew_hero_roundel_1' )  ?: 'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398697-0.png';
$hero_roundel_1_alt = get_field( 'ew_hero_roundel_1_alt' ) ?: 'Same Day Appointments';
$hero_roundel_2   = get_field( 'ew_hero_roundel_2' )  ?: 'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398697-0.png';
$hero_roundel_2_alt = get_field( 'ew_hero_roundel_2_alt' ) ?: 'TympaHealth Certified';
$hero_roundel_3   = get_field( 'ew_hero_roundel_3' )  ?: 'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398725-1.png';
$hero_roundel_3_alt = get_field( 'ew_hero_roundel_3_alt' ) ?: '5-Star Rated';
?>

<!-- Page-scoped styles -->
<style>
  /* Scroll reveal */
  .ew-reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .ew-reveal.visible { opacity: 1; transform: translateY(0); }
  .ew-reveal[data-delay="1"] { transition-delay: 0.1s; }
  .ew-reveal[data-delay="2"] { transition-delay: 0.2s; }
  .ew-reveal[data-delay="3"] { transition-delay: 0.3s; }
  .ew-reveal[data-delay="4"] { transition-delay: 0.4s; }
  .ew-reveal[data-delay="5"] { transition-delay: 0.5s; }
  .ew-reveal[data-delay="6"] { transition-delay: 0.6s; }

  /* FAQ Accordion */
  .ew-faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), padding 0.3s ease; }
  .ew-faq-item.active .ew-faq-answer { max-height: 500px; }
  .ew-faq-item.active .ew-faq-icon { transform: rotate(45deg); }
  .ew-faq-icon { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); }
  .ew-faq-item { transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; }
  .ew-faq-item:hover { border-color: #93c5fd; box-shadow: 0 8px 30px rgba(59,130,246,0.1); transform: translateY(-2px); }
  .ew-faq-item.active { border-color: #3b82f6; box-shadow: 0 8px 30px rgba(59,130,246,0.15); transform: translateY(-2px); }

  /* Card hover lift */
  .ew-card-lift { transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease; }
  .ew-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }

  /* Animated glow border for pricing */
  @property --angle { syntax: '<angle>'; initial-value: 0deg; inherits: false; }
  @keyframes ewBorderRotate { to { --angle: 360deg; } }
  .ew-glow-card { position: relative; background: white; border-radius: 1.25rem; overflow: hidden; }
  .ew-glow-card::before { content: ''; position: absolute; inset: -2px; border-radius: 1.35rem; background: conic-gradient(from var(--angle), #3b82f6, #06b6d4, #3b82f6); animation: ewBorderRotate 4s linear infinite; z-index: -1; }

  /* Shimmer */
  @keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
  .ew-shimmer { background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%); background-size: 200% 100%; animation: shimmer 3s ease-in-out infinite; }
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
      <span class="badge-text text-white/80 text-xs font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $hero_badge ); ?></span>
    </div>
    <h1 class="text-white text-3xl font-semibold tracking-tight leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo wp_kses_post( $hero_headline ); ?></h1>
    <p class="text-white text-base font-normal leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $hero_body ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost"><?php echo wp_kses_post( $hero_sub_text ); ?></p>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $hero_badge ); ?></span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold tracking-tight leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo wp_kses_post( $hero_headline ); ?></h1>
      <p class="text-white text-lg lg:text-xl font-normal leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $hero_body ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Appointment
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#locations" class="inline-flex items-center gap-2 text-white/80 text-sm font-medium px-5 py-3 rounded-full hover:text-white transition-colors font-jost">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Find Your Nearest Branch
        </a>
      </div>
      <p class="text-white text-base font-medium font-jost"><?php echo wp_kses_post( $hero_sub_text ); ?></p>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"></div>

    <!-- Floating roundel badges — premium inline HTML circles -->
    <?php
    // Shared base styles — system font stack for pixel-perfect rendering at small sizes.
    $badge_font_stack = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
    $badge_text_base = "font-family:{$badge_font_stack};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;font-feature-settings:'kern' 1,'ss01' 1;";
    ?>

    <!-- Roundel 1: Same Day Appointments (top) -->
    <div class="absolute z-30" style="left:50%;top:11%;transform:translateX(-50%);">
      <div style="
        width:132px;height:132px;border-radius:50%;
        background:#ffffff;
        box-shadow:0 0 0 2.5px #1e3a8a,0 0 0 6px rgba(255,255,255,0.85),0 10px 28px rgba(30,58,138,0.20);
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        text-align:center;padding:14px;
      ">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#1e3a8a" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:5px;flex-shrink:0;">
          <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>
        </svg>
        <span style="display:block;color:#1e3a8a;font-size:10px;font-weight:700;letter-spacing:.03em;line-height:1.35;text-transform:uppercase;<?php echo $badge_text_base; ?>">Same Day</span>
        <span style="display:block;color:#1e3a8a;font-size:10px;font-weight:700;letter-spacing:.03em;line-height:1.35;text-transform:uppercase;<?php echo $badge_text_base; ?>">Appointments</span>
      </div>
    </div>

    <!-- Roundel 2: TympaHealth Certified (centre) — teal gradient, slightly larger -->
    <div class="absolute z-30" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="
        width:148px;height:148px;border-radius:50%;
        background:linear-gradient(145deg,#0f766e,#0d9488,#14b8a6);
        box-shadow:0 0 0 2.5px #ffffff,0 0 0 6px rgba(13,148,136,0.50),0 12px 32px rgba(13,148,136,0.32);
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        text-align:center;padding:16px;
      ">
        <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#ffffff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:5px;flex-shrink:0;">
          <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
        <span style="display:block;color:#ffffff;font-size:10px;font-weight:700;letter-spacing:.03em;line-height:1.4;text-transform:uppercase;<?php echo $badge_text_base; ?>">TympaHealth</span>
        <span style="display:block;color:#ffffff;font-size:10px;font-weight:700;letter-spacing:.03em;line-height:1.4;text-transform:uppercase;<?php echo $badge_text_base; ?>">Certified</span>
        <span style="display:block;color:rgba(255,255,255,0.85);font-size:8.5px;font-weight:600;letter-spacing:.04em;line-height:1.4;text-transform:uppercase;<?php echo $badge_text_base; ?>">Centre</span>
      </div>
    </div>

    <!-- Roundel 3: 5-Star Rated Service (bottom) -->
    <div class="absolute z-30" style="left:50%;bottom:11%;transform:translateX(-50%);">
      <div style="
        width:132px;height:132px;border-radius:50%;
        background:#ffffff;
        box-shadow:0 0 0 2.5px #1e3a8a,0 0 0 6px rgba(255,255,255,0.85),0 10px 28px rgba(30,58,138,0.20);
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        text-align:center;padding:14px;
      ">
        <span style="display:block;color:#1e3a8a;font-size:9px;font-weight:600;letter-spacing:.03em;line-height:1.3;text-transform:uppercase;<?php echo $badge_text_base; ?>">Rated</span>
        <span style="display:block;color:#1e3a8a;font-size:13px;font-weight:800;letter-spacing:.01em;line-height:1.2;text-transform:uppercase;<?php echo $badge_text_base; ?>">5-Star</span>
        <span style="display:block;color:#1e3a8a;font-size:9px;font-weight:600;letter-spacing:.03em;line-height:1.3;text-transform:uppercase;<?php echo $badge_text_base; ?>">Service</span>
        <span style="display:block;color:#f59e0b;font-size:12px;line-height:1.4;letter-spacing:1.5px;margin-top:1px;">★★★★★</span>
        <span style="display:block;color:#4b5563;font-size:8px;font-weight:600;letter-spacing:.02em;line-height:1.3;<?php echo $badge_text_base; ?>">Over 400 Reviews</span>
      </div>
    </div>
  </div>

</section>


<!-- ============================================================
     S2: KEY STATS — Light gradient, 4 white stat cards
     ============================================================ -->
<?php
$stats_headline = get_field( 'ew_stats_headline' ) ?: 'Professional Microsuction Treatment';
$stats_subhead  = get_field( 'ew_stats_subhead' )  ?: 'The safest and most effective method of ear wax removal, available across our Hampshire locations.';
$stats_acf      = get_field( 'ew_stats' );
$stats_defaults = [
    [ 'value' => '20',    'label' => 'Minute Appointments' ],
    [ 'value' => '95%+',  'label' => 'Success Rate' ],
    [ 'value' => 'Same',  'label' => 'Day Appointments' ],
    [ 'value' => 'From',  'label' => '&pound;50 Per Ear' ],
];
$stats = ( ! empty( $stats_acf ) ) ? $stats_acf : $stats_defaults;
?>
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/30 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-100/20 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">At a Glance</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo esc_html( $stats_headline ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo esc_html( $stats_subhead ); ?></p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
      <?php foreach ( $stats as $i => $stat ) : $delay = $i + 1; ?>
      <div class="ew-reveal ew-card-lift text-center p-6 md:p-8 bg-white rounded-2xl border border-blue-100/60 shadow-sm hover:shadow-md transition-shadow" data-delay="<?php echo $delay; ?>">
        <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2 font-jost"><?php echo esc_html( $stat['value'] ); ?></div>
        <div class="text-sm md:text-base text-gray-500 font-medium font-jost"><?php echo esc_html( $stat['label'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: COMMON SYMPTOMS — Blue gradient, 6 symptom cards
     ============================================================ -->
<?php
$symptoms_eyebrow = get_field( 'ew_symptoms_eyebrow' ) ?: 'Common Symptoms';
$symptoms_headline = get_field( 'ew_symptoms_headline' ) ?: 'Is Ear Wax Affecting Your Daily Life?';
$symptoms_subhead  = get_field( 'ew_symptoms_subhead' )  ?: 'Don&rsquo;t let blocked ears hold you back. Recognise these common symptoms?';
$symptoms_acf      = get_field( 'ew_symptoms' );
$symptoms_defaults = [
    [ 'title' => 'Difficulty Hearing',    'body' => 'Muffled sounds or reduced hearing quality affecting conversations and daily activities.' ],
    [ 'title' => 'Earache or Discomfort', 'body' => 'Persistent pain, pressure, or uncomfortable fullness in one or both ears.' ],
    [ 'title' => 'Ringing or Buzzing',    'body' => 'Tinnitus symptoms including ringing, buzzing, or humming sounds in your ears.' ],
    [ 'title' => 'Dizziness',             'body' => 'Feeling off-balance or experiencing vertigo due to blocked ear canals.' ],
    [ 'title' => 'Hearing Aid Problems',  'body' => 'Failed hearing aid fitting or devices not working properly due to wax build-up.' ],
    [ 'title' => 'Persistent Cough',      'body' => 'Unexplained coughing caused by ear wax stimulating nerves in the ear canal.' ],
];
$symptoms = ( ! empty( $symptoms_acf ) ) ? $symptoms_acf : $symptoms_defaults;

// Icon sets by position (bg colour, border colour, stroke colour, SVG path).
$symptom_icons = [
    // Difficulty Hearing — muted speaker (Heroicons speaker-x-mark).
    [ 'rgba(6,182,212,0.25)',   'rgba(34,211,238,0.5)',  '#67e8f9', '<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75 19.5 12m0 0 2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6 4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z"/>' ],
    // Earache or Discomfort — bolt / sharp pain (Heroicons bolt).
    [ 'rgba(244,63,94,0.25)',   'rgba(253,164,175,0.5)', '#fda4af', '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5 14.25 2.25 12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>' ],
    // Ringing or Buzzing (Tinnitus) — radiating signal waves (Heroicons signal).
    [ 'rgba(245,158,11,0.25)',  'rgba(252,211,77,0.5)',  '#fcd34d', '<path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Z"/>' ],
    // Dizziness / Vertigo — circular spinning arrows (Heroicons arrow-path).
    [ 'rgba(139,92,246,0.25)',  'rgba(196,181,253,0.5)', '#c4b5fd', '<path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>' ],
    // Hearing Aid Problems — wrench / repair tool (Heroicons wrench).
    [ 'rgba(16,185,129,0.25)',  'rgba(52,211,153,0.5)',  '#6ee7b7', '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z"/>' ],
    // Persistent Cough — airflow / wind lines (Feather wind).
    [ 'rgba(249,115,22,0.25)',  'rgba(253,186,116,0.5)', '#fdba74', '<path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>' ],
];
?>
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $symptoms_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost"><?php echo esc_html( $symptoms_headline ); ?></h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo wp_kses_post( $symptoms_subhead ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $symptoms as $i => $symptom ) :
        $icon = $symptom_icons[ $i % count( $symptom_icons ) ];
        $delay = $i + 1;
      ?>
      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="<?php echo $delay; ?>">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:<?php echo $icon[0]; ?>;border:1px solid <?php echo $icon[1]; ?>;">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="<?php echo $icon[2]; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icon[3]; ?></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost"><?php echo esc_html( $symptom['title'] ); ?></h3>
        <p class="text-blue-100 leading-relaxed font-jost"><?php echo esc_html( $symptom['body'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-10">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
        Book Your Appointment
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- ============================================================
     S4: WHAT IS MICROSUCTION — Two-column: white left + image right
     ============================================================ -->
<?php
$about_image      = get_field( 'ew_about_image' )      ?: 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=900&q=80&auto=format&fit=crop';
$about_image_alt  = get_field( 'ew_about_image_alt' )  ?: 'Professional ear examination with advanced equipment';
$about_eyebrow    = get_field( 'ew_about_eyebrow' )    ?: 'What You Need to Know';
$about_headline   = get_field( 'ew_about_headline' )   ?: 'What Is Ear Microsuction?';
$about_body_1     = get_field( 'ew_about_body_1' )     ?: 'Ear Microsuction is the safest and most effective way to remove earwax. It works by inserting a low-pressure suction probe into the ear. One of our trained clinicians wearing a microscope will control the probe to clear the ear canal of wax.';
$about_body_2     = get_field( 'ew_about_body_2' )     ?: 'Painless and clean &mdash; no water squirted into your ear canal like syringing. Immediate results every time.';
$about_stat1_val  = get_field( 'ew_about_stat_1_value' ) ?: '95%+';
$about_stat1_lbl  = get_field( 'ew_about_stat_1_label' ) ?: 'Success rate with immediate improvement in hearing';
$about_stat2_val  = get_field( 'ew_about_stat_2_value' ) ?: 'No Water';
$about_stat2_lbl  = get_field( 'ew_about_stat_2_label' ) ?: 'Dry procedure &mdash; no mess, no water squirted into your ears';
?>
<section class="relative overflow-hidden" id="about">
  <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[540px]">
    <!-- Left: copy -->
    <div class="relative flex flex-col justify-center px-10 lg:px-16 py-16 bg-white overflow-hidden">
      <div class="absolute top-0 right-0 w-72 h-72 bg-blue-50/60 rounded-full translate-x-1/2 -translate-y-1/2 blur-2xl pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 w-56 h-56 bg-cyan-50/60 rounded-full -translate-x-1/3 translate-y-1/3 blur-2xl pointer-events-none"></div>
      <div class="relative z-10 ew-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $about_eyebrow ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost leading-tight"><?php echo esc_html( $about_headline ); ?></h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $about_body_1 ); ?></p>
        <p class="text-gray-600 text-lg leading-relaxed mb-8 font-jost"><?php echo wp_kses_post( $about_body_2 ); ?></p>
        <div class="grid grid-cols-2 gap-4">
          <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
            <div class="text-3xl font-bold text-blue-600 mb-1 font-jost"><?php echo esc_html( $about_stat1_val ); ?></div>
            <div class="text-gray-500 text-sm font-jost"><?php echo wp_kses_post( $about_stat1_lbl ); ?></div>
          </div>
          <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
            <div class="text-3xl font-bold text-blue-600 mb-1 font-jost"><?php echo esc_html( $about_stat2_val ); ?></div>
            <div class="text-gray-500 text-sm font-jost"><?php echo wp_kses_post( $about_stat2_lbl ); ?></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Right: image -->
    <div class="relative overflow-hidden min-h-[400px] lg:min-h-0">
      <img src="<?php echo esc_url( $about_image ); ?>" alt="<?php echo esc_attr( $about_image_alt ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy"/>
      <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
      <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        <span class="text-slate-800 font-semibold text-sm font-jost">TympaHealth Certified Clinicians</span>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S5: TREATMENT COMPARISON — Blue gradient, comparison table
     ============================================================ -->
<?php
$cmp_eyebrow  = get_field( 'ew_comparison_eyebrow' )  ?: 'Treatment Comparison';
$cmp_headline = get_field( 'ew_comparison_headline' ) ?: 'How Our Treatment Compares';
$cmp_subhead  = get_field( 'ew_comparison_subhead' )  ?: 'See why microsuction is the gold standard for ear wax removal.';
$cmp_rows_acf = get_field( 'ew_comparison_rows' );
$cmp_defaults = [
    [ 'feature' => 'Treatment Time',              'microsuction' => 'Up to 30 minutes',  'syringing' => '30+ minutes',  'home_remedies' => 'Days or weeks' ],
    [ 'feature' => 'Water Spillage',              'microsuction' => 'None &#10003;',     'syringing' => 'Moderate',     'home_remedies' => 'Drips and Leaks' ],
    [ 'feature' => 'Risk Level',                  'microsuction' => 'Very Low &#10003;', 'syringing' => 'Moderate',     'home_remedies' => 'Varies' ],
    [ 'feature' => 'Success Rate',                'microsuction' => '95%+ &#10003;',     'syringing' => '70&ndash;80%', 'home_remedies' => 'Under 50%' ],
    [ 'feature' => 'Immediate Results',           'microsuction' => 'Yes &#10003;',      'syringing' => 'Sometimes',    'home_remedies' => 'Rarely' ],
    [ 'feature' => 'Safe for Perforated Eardrums','microsuction' => 'Yes &#10003;',      'syringing' => 'No',           'home_remedies' => 'No' ],
];
$cmp_rows = ( ! empty( $cmp_rows_acf ) ) ? $cmp_rows_acf : $cmp_defaults;
?>
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $cmp_eyebrow ); ?></span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost"><?php echo esc_html( $cmp_headline ); ?></h2>
      <p class="text-lg text-blue-100 max-w-3xl mx-auto font-jost"><?php echo esc_html( $cmp_subhead ); ?></p>
    </div>
    <div class="ew-reveal bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left">
          <thead>
            <tr class="border-b border-white/20">
              <th class="px-6 py-4 text-white font-semibold text-sm font-jost">Feature</th>
              <th class="px-6 py-4 text-white font-bold text-sm bg-white/10 font-jost">Our Microsuction</th>
              <th class="px-6 py-4 text-blue-200 font-semibold text-sm font-jost">Traditional Syringing</th>
              <th class="px-6 py-4 text-blue-200 font-semibold text-sm font-jost">At-Home Remedies</th>
            </tr>
          </thead>
          <tbody class="text-sm font-jost">
            <?php foreach ( $cmp_rows as $i => $row ) :
              $border = ( $i < count( $cmp_rows ) - 1 ) ? 'border-b border-white/10' : '';
            ?>
            <tr class="<?php echo $border; ?>">
              <td class="px-6 py-4 text-blue-100 font-medium"><?php echo wp_kses_post( $row['feature'] ); ?></td>
              <td class="px-6 py-4 text-white font-semibold bg-white/5"><?php echo wp_kses_post( $row['microsuction'] ); ?></td>
              <td class="px-6 py-4 text-blue-200"><?php echo wp_kses_post( $row['syringing'] ); ?></td>
              <td class="px-6 py-4 text-blue-200"><?php echo wp_kses_post( $row['home_remedies'] ); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S6: HOW IT WORKS — Light gradient, photo + 3 numbered steps
     ============================================================ -->
<?php
$how_image      = get_field( 'ew_how_image' )      ?: 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=800&q=80&auto=format&fit=crop';
$how_image_alt  = get_field( 'ew_how_image_alt' )  ?: 'Healthcare professional performing ear examination';
$how_eyebrow    = get_field( 'ew_how_eyebrow' )    ?: 'Your Appointment';
$how_headline   = get_field( 'ew_how_headline' )   ?: 'What to Expect';
$how_subhead    = get_field( 'ew_how_subhead' )    ?: 'Each appointment takes roughly 20&ndash;30 minutes. Simple, effective treatment in three easy steps.';
$how_banner     = get_field( 'ew_how_info_banner' ) ?: 'During examination, HD images &amp; videos are taken to identify any issues beyond wax buildup.';
$how_steps_acf  = get_field( 'ew_how_steps' );
$how_defaults   = [
    [ 'title' => 'Initial Assessment',        'body' => 'Detailed ear examination using high-definition imaging. We discuss your symptoms, review your ear health history, and explain the treatment plan. No-obligation assessment.',                                                                   'duration_label' => '~10 minutes',       'duration_style' => 'blue' ],
    [ 'title' => 'Microsuction Treatment',    'body' => 'Gentle wax removal using low-pressure suction with continuous monitoring and real-time imaging. Your clinician provides progress updates throughout. Completely painless with immediate relief.',                                        'duration_label' => '15&ndash;20 minutes','duration_style' => 'blue' ],
    [ 'title' => 'Aftercare &amp; Advice',    'body' => 'Prevention advice, home care tips, and hearing screening if needed. Professional ear wax removal for clear, healthy ears.',                                                              'duration_label' => '',               'duration_style' => 'blue' ],
];
$how_steps = ( ! empty( $how_steps_acf ) ) ? $how_steps_acf : $how_defaults;
?>
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="how-it-works">
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/4 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-cyan-100/30 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $how_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo esc_html( $how_headline ); ?></h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost"><?php echo wp_kses_post( $how_subhead ); ?></p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

      <!-- Photo -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl ew-reveal">
        <img src="<?php echo esc_url( $how_image ); ?>" alt="<?php echo esc_attr( $how_image_alt ); ?>" class="w-full aspect-[4/3] object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">20&ndash;30 Min Appointments</span>
        </div>
      </div>

      <!-- Steps -->
      <div>
        <div class="space-y-6">
          <?php foreach ( $how_steps as $i => $step ) :
            $step_num   = $i + 1;
            $delay      = $step_num;
            $is_last    = ( $i === count( $how_steps ) - 1 );
            $pill_style = ( isset( $step['duration_style'] ) && $step['duration_style'] === 'green' )
                ? 'text-green-600 bg-green-50 border-green-100'
                : 'text-blue-600 bg-blue-50 border-blue-100';
          ?>
          <div class="flex gap-5 group ew-reveal" data-delay="<?php echo $delay; ?>">
            <div class="flex-shrink-0 <?php echo $is_last ? '' : 'flex flex-col items-center'; ?>">
              <div class="w-12 h-12 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform text-base" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);"><?php echo $step_num; ?></div>
              <?php if ( ! $is_last ) : ?><div class="w-0.5 flex-1 mt-3 bg-gradient-to-b from-blue-300/60 to-transparent min-h-[32px]"></div><?php endif; ?>
            </div>
            <div class="<?php echo $is_last ? '' : 'pb-4'; ?>">
              <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost"><?php echo wp_kses_post( $step['title'] ); ?></h4>
              <p class="text-gray-600 leading-relaxed font-jost"><?php echo wp_kses_post( $step['body'] ); ?></p>
              <?php if ( ! empty( $step['duration_label'] ) ) : ?>
              <span class="inline-block mt-3 text-sm font-medium px-3 py-1 rounded-full border font-jost <?php echo $pill_style; ?>"><?php echo wp_kses_post( $step['duration_label'] ); ?></span>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="mt-8 ew-reveal" data-delay="4">
          <div class="rounded-xl p-5 text-white text-sm font-medium flex items-center gap-3 shadow-lg shadow-blue-500/20" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <span class="font-jost"><?php echo wp_kses_post( $how_banner ); ?></span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S7: WHY THE NHS GAP MATTERS — Blue gradient, two-col text + image
     ============================================================ -->
<?php
$nhs_image           = get_field( 'ew_nhs_image' )            ?: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&q=80&auto=format&fit=crop';
$nhs_image_alt       = get_field( 'ew_nhs_image_alt' )        ?: 'Friendly pharmacist consultation';
$nhs_eyebrow         = get_field( 'ew_nhs_eyebrow' )          ?: 'Why Pharmacy Ear Care';
$nhs_headline        = get_field( 'ew_nhs_headline' )         ?: 'Skip the 12&ndash;16 Week NHS Wait';
$nhs_body_1          = get_field( 'ew_nhs_body_1' )           ?: 'In the UK, 3.9% of the population need earwax management yearly, many enduring 12&ndash;16 week waits. The lack of available NHS treatment leads many to suffer in silence, unaware that local pharmacy options exist.';
$nhs_body_2          = get_field( 'ew_nhs_body_2' )           ?: 'At Southdowns Pharmacy Group, we&rsquo;ve partnered with <strong class="text-white">TympaHealth</strong> to provide easy and accessible ear wax removal at our branch. Various factors like age and loud noise exposure impact ear health. Don&rsquo;t let ear wax buildup lead to social withdrawal.';
$nhs_locs_headline   = get_field( 'ew_nhs_locations_headline' ) ?: 'Available at:';
$nhs_locations_raw   = get_field( 'ew_nhs_locations' );
$nhs_locations       = $nhs_locations_raw
    ? array_filter( array_map( 'trim', explode( "\n", $nhs_locations_raw ) ) )
    : [ 'Southdowns Pharmacy, [INSERT BRANCH LOCATION]' ];
?>
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      <!-- Left: image -->
      <div class="ew-reveal relative rounded-2xl overflow-hidden shadow-2xl group order-2 lg:order-1">
        <img src="<?php echo esc_url( $nhs_image ); ?>" alt="<?php echo esc_attr( $nhs_image_alt ); ?>" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 to-transparent"></div>
      </div>

      <!-- Right: copy -->
      <div class="order-1 lg:order-2 ew-reveal" data-delay="1">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-white/30"></div>
          <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $nhs_eyebrow ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 font-jost"><?php echo wp_kses_post( $nhs_headline ); ?></h2>
        <p class="text-blue-100 text-lg leading-relaxed mb-5 font-jost"><?php echo wp_kses_post( $nhs_body_1 ); ?></p>
        <p class="text-blue-100 text-lg leading-relaxed mb-6 font-jost"><?php echo wp_kses_post( $nhs_body_2 ); ?></p>
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 mb-6">
          <h4 class="text-white font-bold mb-3 font-jost"><?php echo esc_html( $nhs_locs_headline ); ?></h4>
          <div class="flex flex-wrap gap-2">
            <?php foreach ( $nhs_locations as $loc ) : ?>
            <span class="bg-white/20 text-white text-sm font-medium px-3 py-1.5 rounded-full border border-white/30 font-jost"><?php echo esc_html( $loc ); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-7 py-3.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Same-Day Appointment
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S8: PRICING — Light gradient, one-ear card + two-ear glow card
     ============================================================ -->
<?php
$pricing_eyebrow         = get_field( 'ew_pricing_eyebrow' )           ?: 'Transparent Pricing';
$pricing_headline        = get_field( 'ew_pricing_headline' )          ?: 'Ear Wax Removal Pricing';
$pricing_subhead         = get_field( 'ew_pricing_subhead' )           ?: 'Clear, upfront pricing with no hidden fees. Consultation included.';
$pricing_c_price         = get_field( 'ew_pricing_consult_price' )     ?: '&pound;50';
$pricing_c_title         = get_field( 'ew_pricing_consult_title' )     ?: 'One Ear';
$pricing_c_body          = get_field( 'ew_pricing_consult_body' )      ?: 'Professional ear wax removal for clear, healthy ears.';
$pricing_c_bullets_raw   = get_field( 'ew_pricing_consult_bullets' );
$pricing_c_bullets       = $pricing_c_bullets_raw
    ? array_filter( array_map( 'trim', explode( "\n", $pricing_c_bullets_raw ) ) )
    : [ 'Consultation included', 'Same-day appointments', 'HD ear canal imaging', 'Hearing screening included' ];
$pricing_t_price         = get_field( 'ew_pricing_treatment_price' )   ?: '&pound;55';
$pricing_t_title         = get_field( 'ew_pricing_treatment_title' )   ?: 'Both Ears';
$pricing_t_body          = get_field( 'ew_pricing_treatment_body' )    ?: 'Professional ear wax removal for clear, healthy ears.';
$pricing_t_bullets_raw   = get_field( 'ew_pricing_treatment_bullets' );
$pricing_t_bullets       = $pricing_t_bullets_raw
    ? array_filter( array_map( 'trim', explode( "\n", $pricing_t_bullets_raw ) ) )
    : [ 'Consultation included', 'Same-day appointments', 'HD imaging before &amp; after', 'Hearing screening included' ];
?>
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="pricing">
  <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-blue-200/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute top-0 right-0 w-80 h-80 bg-cyan-200/15 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $pricing_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo esc_html( $pricing_headline ); ?></h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto font-jost"><?php echo esc_html( $pricing_subhead ); ?></p>
    </div>
    <div class="max-w-3xl mx-auto ew-reveal">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Consultation -->
        <div class="ew-card-lift bg-white rounded-2xl p-8 border border-gray-200 shadow-lg text-center">
          <div class="mb-4">
            <span class="text-5xl font-bold text-slate-800 font-jost"><?php echo wp_kses_post( $pricing_c_price ); ?></span>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $pricing_c_title ); ?></h3>
          <p class="text-gray-500 text-base mb-6 font-jost"><?php echo esc_html( $pricing_c_body ); ?></p>
          <ul class="text-left space-y-3 mb-6">
            <?php foreach ( $pricing_c_bullets as $bullet ) : ?>
            <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> <?php echo wp_kses_post( $bullet ); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="block w-full text-blue-600 font-semibold py-3 rounded-full text-center border-2 border-blue-600 hover:bg-blue-50 transition-colors font-jost">Book Assessment</a>
        </div>

        <!-- Full Treatment — animated glow border -->
        <div class="ew-glow-card relative shadow-2xl">
          <div class="overflow-hidden rounded-t-xl">
            <div class="relative overflow-hidden text-center py-3.5" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
              <div class="ew-shimmer absolute inset-0"></div>
              <span class="relative text-white font-semibold text-sm uppercase tracking-wider font-jost">Most Popular</span>
            </div>
          </div>
          <div class="p-8 text-center">
            <div class="mb-4">
              <span class="text-5xl font-bold text-slate-800 font-jost"><?php echo wp_kses_post( $pricing_t_price ); ?></span>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $pricing_t_title ); ?></h3>
            <p class="text-gray-500 text-base mb-6 font-jost"><?php echo esc_html( $pricing_t_body ); ?></p>
            <ul class="text-left space-y-3 mb-6">
              <?php foreach ( $pricing_t_bullets as $bullet ) : ?>
              <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> <?php echo wp_kses_post( $bullet ); ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?php echo esc_url( $booking_url ); ?>" class="block w-full text-white font-semibold py-3.5 rounded-full text-center transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.02] font-jost" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">Book Treatment</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S9: WHY CHOOSE US — Blue gradient, 6 glassmorphism cards
     ============================================================ -->
<?php
$why_eyebrow   = get_field( 'ew_why_eyebrow' )  ?: 'Why Us';
$why_headline  = get_field( 'ew_why_headline' ) ?: 'Why Choose Southdowns Pharmacy';
$why_subhead   = get_field( 'ew_why_subhead' )  ?: 'TympaHealth certified clinicians using the latest diagnostic technology for safe, effective ear care.';
$why_cards_acf = get_field( 'ew_why_cards' );
$why_defaults  = [
    [ 'title' => 'TympaHealth Certified',   'body' => 'Our clinicians completed the comprehensive TympaHealth Ear &amp; Hearing Healthcare training course.' ],
    [ 'title' => 'Real-Time HD Imaging',    'body' => 'Using advanced imaging equipment, we can see exactly what&rsquo;s in your ear canal before and during treatment.' ],
    [ 'title' => 'Same-Day Appointments',   'body' => 'No NHS waiting. Same-day microsuction appointments available subject to availability.' ],
    [ 'title' => 'Painless Procedure',      'body' => 'No water, no mess &mdash; just gentle suction for a comfortable experience with immediate hearing improvement.' ],
    [ 'title' => 'Convenient Location',     'body' => 'Available at Southdowns Pharmacy, [INSERT BRANCH LOCATION]. Easy access with same-day appointments available.' ],
    [ 'title' => 'Professional Service',   'body' => 'Professional ear wax removal for clear, healthy ears. Carried out by trained, TympaHealth certified clinicians.' ],
];
$why_cards = ( ! empty( $why_cards_acf ) ) ? $why_cards_acf : $why_defaults;

// Icon sets cycle by position.
$why_icons = [
    [ 'rgba(16,185,129,0.25)',  'rgba(52,211,153,0.5)',  '#6ee7b7', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>' ],
    [ 'rgba(6,182,212,0.25)',   'rgba(34,211,238,0.5)',  '#67e8f9', '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>' ],
    [ 'rgba(245,158,11,0.25)',  'rgba(252,211,77,0.5)',  '#fcd34d', '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>' ],
    [ 'rgba(139,92,246,0.25)',  'rgba(196,181,253,0.5)', '#c4b5fd', '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/>' ],
    [ 'rgba(244,63,94,0.25)',   'rgba(253,164,175,0.5)', '#fda4af', '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>' ],
    [ 'rgba(249,115,22,0.25)',  'rgba(253,186,116,0.5)', '#fdba74', '<path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>' ],
];
?>
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $why_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost"><?php echo esc_html( $why_headline ); ?></h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo esc_html( $why_subhead ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $why_cards as $i => $card ) :
        $icon  = $why_icons[ $i % count( $why_icons ) ];
        $delay = ( $i % 3 ) + 1;
      ?>
      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="<?php echo $delay; ?>">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:<?php echo $icon[0]; ?>;border:1px solid <?php echo $icon[1]; ?>;">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="<?php echo $icon[2]; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icon[3]; ?></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost"><?php echo wp_kses_post( $card['title'] ); ?></h3>
        <p class="text-blue-100 leading-relaxed font-jost"><?php echo wp_kses_post( $card['body'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S10: TESTIMONIALS — Light gradient, 3 patient review cards
     ============================================================ -->
<?php
$test_eyebrow  = get_field( 'ew_testimonials_eyebrow' )  ?: 'Patient Reviews';
$test_headline = get_field( 'ew_testimonials_headline' ) ?: 'What Our Patients Say';
$test_acf      = get_field( 'ew_testimonials' );
$test_defaults = [
    [ 'initials' => 'DW', 'name' => 'David Williams',  'branch' => 'Southdowns Pharmacy', 'quote' => 'After weeks of muffled hearing, I got my ears treated here. The difference was immediate &mdash; I could hear clearly again! The clinician was so gentle and explained everything. Highly recommend!' ],
    [ 'initials' => 'MT', 'name' => 'Margaret Turner', 'branch' => 'Southdowns Pharmacy', 'quote' => 'Much better than the traditional syringing I had years ago. No mess, no fuss, just clear hearing again. The appointment only took 20 minutes and the staff were lovely.' ],
    [ 'initials' => 'JR', 'name' => 'John Roberts',    'branch' => 'Southdowns Pharmacy', 'quote' => 'Fantastic service. Painless procedure and immediate relief. I&rsquo;d been suffering for months with blocked ears and the GP wait was ridiculous. So glad I found Southdowns!' ],
];
$testimonials = ( ! empty( $test_acf ) ) ? $test_acf : $test_defaults;
// Avatar colour pairs cycle by position.
$avatar_colours = [
    [ 'bg-blue-100', 'text-blue-600' ],
    [ 'bg-cyan-100', 'text-cyan-600' ],
    [ 'bg-blue-100', 'text-blue-600' ],
];
?>
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/25 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-72 h-72 bg-cyan-100/20 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $test_eyebrow ); ?></span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo esc_html( $test_headline ); ?></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $testimonials as $i => $t ) :
        $colours = $avatar_colours[ $i % count( $avatar_colours ) ];
        $delay   = $i + 1;
      ?>
      <div class="ew-reveal ew-card-lift bg-gradient-to-br from-white to-blue-50/30 rounded-2xl p-8 border border-blue-100/50" data-delay="<?php echo $delay; ?>">
        <div class="flex gap-1 mb-4">
          <?php for ( $s = 0; $s < 5; $s++ ) : ?><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg><?php endfor; ?>
        </div>
        <p class="text-gray-600 text-base leading-relaxed mb-6 italic font-jost">&ldquo;<?php echo wp_kses_post( $t['quote'] ); ?>&rdquo;</p>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm <?php echo $colours[0]; ?> <?php echo $colours[1]; ?>"><?php echo esc_html( $t['initials'] ); ?></div>
          <div>
            <div class="text-slate-800 font-semibold text-sm font-jost"><?php echo esc_html( $t['name'] ); ?></div>
            <div class="text-gray-400 text-xs font-jost"><?php echo esc_html( $t['branch'] ); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S11: FAQ — Blue gradient, sticky sidebar + accordion items
     ============================================================ -->
<?php
$faq_eyebrow  = get_field( 'ew_faq_eyebrow' )  ?: 'FAQs';
$faq_headline = get_field( 'ew_faq_headline' ) ?: 'Frequently Asked Questions';
$faq_intro    = get_field( 'ew_faq_intro' )    ?: 'Everything you need to know about ear wax removal at Southdowns Pharmacy.';
$faq_rating   = get_field( 'ew_faq_rating' )   ?: '4.9';
$faq_reviews  = get_field( 'ew_faq_reviews' )  ?: '400+';
$faq_patients = get_field( 'ew_faq_patients' ) ?: '10k+';
$faqs_acf     = get_field( 'ew_faqs' );
$faqs_defaults = [
    [ 'question' => 'Is microsuction painful?',                     'answer' => 'No. Microsuction is a gentle, painless procedure. You may hear a mild suction sound during treatment, but the low-pressure probe causes no discomfort. It&rsquo;s far more comfortable than traditional ear syringing which uses water pressure.' ],
    [ 'question' => 'How long does the appointment take?',          'answer' => 'Each appointment takes roughly <strong>20&ndash;30 minutes</strong>. This includes the initial ear examination, the microsuction procedure itself, and a hearing screening afterwards if appropriate.' ],
    [ 'question' => 'Do I need to use ear drops before my appointment?', 'answer' => 'We recommend using olive oil or sodium bicarbonate ear drops for <strong>2&ndash;3 days before your appointment</strong>. This softens the wax and makes removal easier and quicker. However, we can often remove wax without prior preparation.' ],
    [ 'question' => 'Is the service available on the NHS?',         'answer' => 'Many NHS GP surgeries no longer offer ear wax removal, and where they do, waiting times can be 12&ndash;16 weeks. Our private service means you can be seen <strong>the same day with no referral needed</strong>, so you get relief immediately.' ],
    [ 'question' => 'Is there an age restriction?',                 'answer' => '<strong>Yes, this service is strictly for ages 18 and over only.</strong> If you make a booking for someone under 18, there is a strict no-refund policy as clinical time has been allocated. Please do not book for any persons under the age of 18.' ],
    [ 'question' => 'How often will I need treatment?',             'answer' => 'This varies from person to person. Some people only need treatment once. Others who produce excess wax may benefit from appointments <strong>every 3 to 6 months</strong>. Your clinician will advise a personalised schedule at the end of your appointment.' ],
    [ 'question' => 'What if you find something other than wax?',   'answer' => 'During the examination, high-definition images and videos are taken. This can identify infections, perforations, or other conditions. If we find anything that requires further investigation, we&rsquo;ll advise you to visit your GP or refer you to a specialist ENT doctor.' ],
    [ 'question' => 'Where is the service available?',              'answer' => 'TympaHealth ear wax removal is available at <strong>Southdowns Pharmacy, [INSERT BRANCH LOCATION]</strong>. Contact us to book or to find out more about the service.' ],
];
$faqs = ( ! empty( $faqs_acf ) ) ? $faqs_acf : $faqs_defaults;
?>
<section class="relative py-16 md:py-24 overflow-hidden" id="faq" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

      <!-- Sticky sidebar -->
      <div class="lg:col-span-4 lg:sticky lg:top-28 lg:self-start ew-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-white/30"></div>
          <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo esc_html( $faq_eyebrow ); ?></span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 font-jost"><?php echo esc_html( $faq_headline ); ?></h2>
        <p class="text-lg text-blue-100 leading-relaxed mb-8 font-jost"><?php echo esc_html( $faq_intro ); ?></p>
        <div class="hidden lg:grid grid-cols-3 gap-4 mb-8">
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="text-2xl font-bold text-white mb-1 font-jost"><?php echo esc_html( $faq_rating ); ?></div>
            <div class="text-blue-200 text-xs font-medium font-jost">Rating</div>
          </div>
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="text-2xl font-bold text-white mb-1 font-jost"><?php echo esc_html( $faq_reviews ); ?></div>
            <div class="text-blue-200 text-xs font-medium font-jost">Reviews</div>
          </div>
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="text-2xl font-bold text-white mb-1 font-jost"><?php echo esc_html( $faq_patients ); ?></div>
            <div class="text-blue-200 text-xs font-medium font-jost">Patients</div>
          </div>
        </div>
        <div class="hidden lg:block space-y-3">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="flex items-center justify-center gap-2 bg-white text-blue-700 hover:bg-blue-50 font-semibold px-6 py-3.5 rounded-full transition-all shadow-lg font-jost">Book Appointment</a>
          <p class="text-blue-200 text-sm text-center font-jost">&pound;50 one ear &middot; &pound;55 both ears</p>
        </div>
      </div>

      <!-- Accordion -->
      <div class="lg:col-span-8 space-y-4">
        <?php foreach ( $faqs as $i => $faq ) :
          $num = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
        ?>
        <div class="ew-faq-item bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-sm">
          <button class="ew-faq-trigger w-full flex items-center gap-4 p-6 text-left hover:bg-gray-50/50 transition-colors" type="button">
            <span class="flex-shrink-0 w-10 h-10 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);"><?php echo $num; ?></span>
            <span class="flex-1 font-semibold text-slate-800 text-base leading-snug font-jost"><?php echo wp_kses_post( $faq['question'] ); ?></span>
            <span class="ew-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
          </button>
          <div class="ew-faq-answer">
            <div class="px-6 pb-6 text-gray-600 leading-relaxed font-jost text-sm"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S12: LOCATIONS — All 4 branches via sp_branch() ACF helper
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="locations">
  <div class="absolute bottom-0 left-1/2 w-[600px] h-[400px] bg-blue-200/15 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Our Locations</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost">Visit Our Ear Care Centres</h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost">Ear wax removal available across all 4 Hampshire locations. Same-day appointments where available.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php for ( $i = 1; $i <= 4; $i++ ) :
        $branch = sp_branch( $i );
        $delay  = $i;
      ?>
      <div class="ew-reveal ew-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo $delay; ?>">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_url( $branch['card_image'] ); ?>" alt="<?php echo esc_attr( $branch['name'] ); ?> ear wax removal pharmacy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md font-jost">Open Now</div>
          <div class="absolute bottom-3 left-3">
            <h3 class="text-white text-xl font-bold font-jost"><?php echo esc_html( $branch['name'] ); ?></h3>
          </div>
        </div>
        <div class="p-5">
          <div class="flex items-start gap-2 mb-2">
            <svg class="flex-shrink-0 mt-0.5 text-blue-500 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-gray-600 text-sm font-jost"><?php echo esc_html( $branch['address_line1'] . ', ' . $branch['city'] . ', ' . $branch['postcode'] ); ?></span>
          </div>
          <div class="flex items-start gap-2 mb-4">
            <svg class="flex-shrink-0 mt-0.5 text-blue-500 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <span class="text-gray-400 text-xs font-jost"><?php echo esc_html( $branch['hours_weekday'] ); ?></span>
          </div>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Book Here
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endfor; ?>
    </div>

    <!-- Info banner -->
    <div class="mt-10 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 shadow-xl text-white" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
      <div class="flex-shrink-0 w-14 h-14 bg-white/20 rounded-full flex items-center justify-center">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      </div>
      <div class="flex-1 text-center md:text-left">
        <p class="text-lg font-semibold mb-1 font-jost">Questions about ear wax removal?</p>
        <p class="text-blue-100 font-jost">Feel free to get in touch with our friendly team if you have any questions about the service.</p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="flex-shrink-0 inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost">
        Book Nearest Branch
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- ============================================================
     S13: FINAL CTA — Blue gradient, trust pills + Book CTA
     ============================================================ -->
<?php
$cta_pills_raw   = get_field( 'ew_cta_trust_pills' );
$cta_pills       = $cta_pills_raw
    ? array_filter( array_map( 'trim', explode( "\n", $cta_pills_raw ) ) )
    : [ 'TympaHealth Certified', '&pound;50 One Ear', '&pound;55 Both Ears', 'Same-Day Available', 'Ages 18+ Only' ];
$cta_headline    = get_field( 'ew_cta_headline' )      ?: 'Clearer Hearing Starts Today';
$cta_body        = get_field( 'ew_cta_body' )          ?: 'Don&rsquo;t suffer in silence. Book your ear wax removal appointment at one of our TympaHealth-equipped branches and experience immediate relief.';
$cta_stat_rating  = get_field( 'ew_cta_stat_rating' )  ?: '4.9/5';
$cta_stat_reviews = get_field( 'ew_cta_stat_reviews' ) ?: '400+';
$cta_stat_patients= get_field( 'ew_cta_stat_patients') ?: '10,000+';
?>
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="flex flex-wrap justify-center gap-3 mb-8">
      <?php foreach ( $cta_pills as $pill ) : ?>
      <span class="bg-white/15 text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/20 font-jost"><?php echo esc_html( $pill ); ?></span>
      <?php endforeach; ?>
    </div>
    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost"><?php echo esc_html( $cta_headline ); ?></h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost"><?php echo wp_kses_post( $cta_body ); ?></p>
    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-xl text-lg font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Book Ear Wax Removal
      </a>
      <a href="#locations" class="inline-flex items-center justify-center gap-2 text-white font-medium border-2 border-white/30 px-8 py-4 rounded-full hover:bg-white/10 transition-colors text-lg font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        Find Your Nearest Branch
      </a>
    </div>
    <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-white text-sm mb-4 font-jost">
      <?php foreach ( $cta_pills as $pill ) : ?>
      <span>&#10003; <?php echo esc_html( $pill ); ?></span>
      <?php endforeach; ?>
    </div>
    <p class="text-blue-200/70 text-sm font-jost">Available at Southdowns Pharmacy, [INSERT BRANCH LOCATION]</p>
    <!-- Trust indicators -->
    <div class="mt-10 flex flex-wrap justify-center items-center gap-8 md:gap-12">
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost"><?php echo esc_html( $cta_stat_rating ); ?></div>
        <div class="text-blue-200 text-sm font-jost">Average Rating</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost"><?php echo esc_html( $cta_stat_reviews ); ?></div>
        <div class="text-blue-200 text-sm font-jost">5-Star Reviews</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost"><?php echo esc_html( $cta_stat_patients ); ?></div>
        <div class="text-blue-200 text-sm font-jost">Happy Patients</div>
      </div>
    </div>
  </div>
</section>

<!-- Age restriction notice -->
<div class="bg-amber-50 border-t border-amber-200 py-6">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-start gap-3">
      <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <p class="text-amber-800 text-sm leading-relaxed font-jost"><strong>Age Restriction:</strong> This service is strictly for age 18+ only. If you make a booking for under 18, there is a strict no-refund policy, as the clinical time has been allocated for the original appointment made. Please do not book for any persons under the age of 18.</p>
    </div>
  </div>
</div>

<!-- Medical disclaimer -->
<div class="bg-gray-50 border-t border-gray-200 py-6">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-gray-400 text-xs leading-relaxed text-center font-jost">This information is for educational purposes and does not constitute medical advice. Ear wax removal by microsuction is a clinical procedure performed by trained healthcare professionals. Suitability is assessed during your initial consultation. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).</p>
  </div>
</div>

<!-- FAQ accordion JS -->
<script>
(function() {
  document.querySelectorAll('.ew-faq-trigger').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.ew-faq-item');
      var isOpen = item.classList.contains('active');
      document.querySelectorAll('.ew-faq-item.active').forEach(function(el) { el.classList.remove('active'); });
      if (!isOpen) item.classList.add('active');
    });
  });
})();
</script>

<!-- Scroll reveal JS -->
<script>
(function() {
  var els = document.querySelectorAll('.ew-reveal');
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
