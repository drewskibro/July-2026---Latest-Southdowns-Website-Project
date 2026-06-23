<?php
/**
 * Template Name: Pharmacy First
 *
 * Select this template on the Pharmacy First page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();
$pf_hero_img = sp_field( 'pf_hero_image', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1200&q=80&auto=format&fit=crop' );
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
     S1: HERO — Matches homepage 2-column layout exactly
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-width image with overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url( $pf_hero_img ); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start">
      <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span></span>
      <?php echo sp_field( 'pf_hero_badge', 'NHS Pharmacy First &middot; Hampshire' ); ?>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo sp_field( 'pf_hero_heading', 'Free NHS Treatment &mdash; No GP Appointment Needed' ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo sp_field( 'pf_hero_subtext', 'Under the NHS Pharmacy First scheme, our pharmacists at Southdowns Pharmacy can assess and treat seven common conditions &mdash; completely free of charge. No referral, no waiting weeks for a GP. Walk in or book online and get treated the same day.' ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        <?php echo sp_field( 'pf_hero_btn', 'Book a Pharmacy First Appointment' ); ?>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <div class="flex flex-wrap gap-4 text-white/90 text-xs font-jost">
      <span>&#10003; Free NHS Treatment</span>
      <span>&#10003; No GP Referral</span>
      <span>&#10003; Same Day</span>
    </div>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start">
        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-400"></span></span>
        <?php echo sp_field( 'pf_hero_badge', 'NHS Pharmacy First &middot; Hampshire' ); ?>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;"><?php echo sp_field( 'pf_hero_heading', 'Free NHS Treatment &mdash; No GP Appointment Needed' ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo sp_field( 'pf_hero_subtext', 'Under the NHS Pharmacy First scheme, our pharmacists at Southdowns Pharmacy can assess and treat seven common conditions &mdash; completely free of charge. No referral, no waiting weeks for a GP. Walk in or book online and get treated the same day.' ); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          <?php echo sp_field( 'pf_hero_btn', 'Book a Pharmacy First Appointment' ); ?>
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#conditions" class="inline-flex items-center gap-2 text-white/80 text-sm font-medium px-5 py-3 rounded-full hover:text-white transition-colors font-jost">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          Learn About the 7 Conditions
        </a>
      </div>
      <div class="flex flex-wrap gap-5 text-white text-sm font-jost">
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          GPhC Registered
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          NHS Funded &mdash; Free
        </span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          Same Day Treatment
        </span>
      </div>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('<?php echo esc_url( $pf_hero_img ); ?>');"></div>
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

      <?php
      $pf_stats = sp_rows( 'pf_stats', [
        [ '7', 'Conditions Treated' ],
        [ 'FREE', 'NHS Funded' ],
        [ 'No', 'GP Appointment' ],
        [ 'Same', 'Day Treatment' ],
      ], [ 0 => 'value', 1 => 'label' ] );
      foreach ( $pf_stats as $pf_si => $st ) : ?>
      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="<?php echo $pf_si + 1; ?>">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $st[0] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium font-jost"><?php echo esc_html( $st[1] ); ?></div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ============================================================
     S3: CONDITIONS — Light gradient, 7 condition cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50/30 relative overflow-hidden" id="conditions">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/30 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-100/20 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-14 yf-reveal">
      <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">NHS Pharmacy First</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo sp_field( 'pf_cond_heading', 'Seven Common Conditions. Treated Free. Today.' ); ?></h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost"><?php echo sp_field( 'pf_cond_intro', 'Our GPhC-registered pharmacists can assess, diagnose and treat the following conditions under the NHS Pharmacy First scheme &mdash; with medication supplied free of charge where clinically appropriate.' ); ?></p>
    </div>

    <?php
    $conditions = sp_rows( 'pf_conditions', [
      [ '01', 'Sinusitis',                    'Ages 12+',           'A blocked or runny nose with facial pain or pressure lasting more than ten days, or symptoms that worsen after initial improvement. Our pharmacist will assess and treat where appropriate.' ],
      [ '02', 'Sore Throat',                  'Ages 5+',            'A painful throat that makes swallowing uncomfortable. Our pharmacist will assess the severity using a clinical scoring system and provide appropriate NHS-funded treatment.' ],
      [ '03', 'Earache (Acute Otitis Media)', 'Ages 1&ndash;17',    'Pain in one or both ears, which may be sharp, dull or accompanied by temporary hearing loss. Particularly common in children &mdash; walk in without a GP appointment.' ],
      [ '04', 'Infected Insect Bite',         'Ages 1+',            'A bite or sting that has become red, swollen, warm to the touch, or showing signs of infection such as discharge. Our pharmacist will assess and prescribe antibiotics where needed.' ],
      [ '05', 'Impetigo',                     'Ages 1+',            'A highly contagious skin infection causing red sores, usually around the nose and mouth, that burst and form honey-coloured crusts. Early treatment prevents it spreading.' ],
      [ '06', 'Shingles',                     'Ages 18+',           'A painful, blistering rash caused by reactivation of the chickenpox virus. Starting antiviral treatment early is important &mdash; if you suspect shingles, come in without delay.' ],
      [ '07', 'Uncomplicated UTI',            'Women aged 16&ndash;64 only', 'Burning or stinging when passing urine, needing to go more frequently, or cloudy and strong-smelling urine. No GP visit needed &mdash; our pharmacist can prescribe treatment directly.' ],
    ], [ 0 => 'num', 1 => 'name', 2 => 'age', 3 => 'desc' ] );
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php foreach ( $conditions as $i => $c ) :
        $delay = ( $i % 3 ) + 1; ?>
      <div class="yf-reveal yf-card-lift bg-white rounded-2xl p-7 border border-blue-100/50 shadow-sm hover:shadow-xl hover:shadow-blue-100/30 hover:-translate-y-1 transition-all duration-300 <?php echo ( $i === 6 ) ? 'md:col-start-2 lg:col-start-2' : ''; ?>" data-delay="<?php echo esc_attr( $delay ); ?>">
        <div class="flex items-center gap-3 mb-4">
          <span class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md shadow-blue-500/20"><?php echo esc_html( $c[0] ); ?></span>
          <span class="inline-block bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full border border-blue-100 font-jost"><?php echo $c[2]; ?></span>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost"><?php echo esc_html( $c[1] ); ?></h3>
        <p class="text-gray-600 leading-relaxed text-sm font-jost"><?php echo $c[3]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Free treatment note -->
    <div class="mt-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 shadow-xl shadow-blue-500/15 yf-reveal">
      <div class="flex-shrink-0">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
          <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        </div>
      </div>
      <div class="flex-1 text-center md:text-left">
        <p class="text-white text-lg font-semibold mb-1 font-jost"><?php echo sp_field( 'pf_freenote_heading', 'Completely free &mdash; including prescription medicines' ); ?></p>
        <p class="text-blue-100 text-base font-jost"><?php echo sp_field( 'pf_freenote_body', 'Under NHS Pharmacy First you pay nothing &mdash; not even a prescription charge &mdash; for any treatment provided under the scheme, including antibiotics and antivirals.' ); ?></p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        <?php echo sp_field( 'pf_freenote_btn', 'Book Today' ); ?>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S4: HOW IT WORKS — Blue gradient, 3 steps
     ============================================================ -->
<section class="py-16 md:py-24 overflow-hidden relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="how-it-works">
  <div class="absolute inset-0 yf-shimmer pointer-events-none"></div>
  <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-14 yf-reveal">
      <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/30">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">How It Works</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'pf_how_heading', 'Three Steps to Free NHS Treatment' ); ?></h2>
      <p class="text-lg text-blue-100 max-w-3xl mx-auto font-jost"><?php echo sp_field( 'pf_how_intro', 'No referral, no red tape. Expert care when you need it, at any of our 4 Hampshire locations.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 yf-reveal">

      <?php
      $pf_steps = sp_rows( 'pf_steps', [
        [ 'Walk In or Book Online', 'Visit any of our four Hampshire locations during opening hours, or book a convenient slot online. No GP referral needed.' ],
        [ 'Private Pharmacist Consultation', 'One of our trained pharmacists will see you in a private consultation room, asking about your symptoms, medical history and current medications, following NHS clinical guidelines throughout.' ],
        [ 'Walk Out Treated', 'If your condition meets the NHS Pharmacy First criteria, you&apos;ll receive appropriate treatment on the spot &mdash; including prescription-only medicines such as antibiotics or antivirals where clinically indicated. Completely free of charge.' ],
      ], [ 0 => 'title', 1 => 'desc' ] );
      foreach ( $pf_steps as $pf_sti => $step ) : ?>
      <div class="yf-step bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300" data-delay="<?php echo $pf_sti + 1; ?>">
        <div class="yf-step-num w-14 h-14 bg-white/20 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mb-6 shadow-lg"><?php echo $pf_sti + 1; ?></div>
        <h3 class="text-xl font-bold text-white mb-3 font-jost"><?php echo esc_html( $step[0] ); ?></h3>
        <p class="text-blue-100 leading-relaxed font-jost"><?php echo $step[1]; ?></p>
      </div>
      <?php endforeach; ?>

    </div>

    <div class="mt-10 text-center yf-reveal" data-delay="2">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold px-8 py-4 rounded-full hover:bg-blue-50 transition-all shadow-lg text-lg hover:scale-[1.02] hover:shadow-xl font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <?php echo sp_field( 'pf_how_btn', 'Book a Pharmacy First Appointment' ); ?>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S5: ELIGIBILITY — Light gradient, two-col text + checklist
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f8fafc 100%);">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-14 yf-reveal">
      <div class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100 shadow-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">Eligibility</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost"><?php echo sp_field( 'pf_elig_heading', 'Is Pharmacy First Right for You?' ); ?></h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start yf-reveal">

      <!-- Explanatory text -->
      <div>
        <div class="space-y-6 text-gray-600 text-lg leading-relaxed font-jost mb-6">
        <?php echo sp_field( 'pf_elig_body', '<p>NHS Pharmacy First is available to anyone registered with a GP in England. Most conditions can be treated across a wide age range &mdash; from young children to adults. The UTI pathway is available to women aged 16 to 64 only.</p><p>You do not need to be registered with a GP in Hampshire &mdash; any England-registered GP qualifies. If your symptoms suggest something more serious, our pharmacist will refer you to the appropriate NHS service without delay.</p>' ); ?>
        </div>
        <div class="bg-blue-50 rounded-xl p-5 border border-blue-100 flex items-start gap-3">
          <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          <p class="text-blue-700 text-sm leading-relaxed font-jost"><?php echo sp_field( 'pf_elig_infobox', 'If you are unsure whether your condition qualifies, simply walk in or give us a call. Our pharmacists will advise you at no charge.' ); ?></p>
        </div>
      </div>

      <!-- Eligibility checklist -->
      <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm yf-card-lift">
        <h3 class="text-xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'pf_elig_list_heading', 'You Are Eligible If&hellip;' ); ?></h3>
        <ul class="space-y-4">
          <?php
          $checklist = sp_list( 'pf_checklist', [
            'Registered with any GP in England',
            'Ages 1+ for most conditions',
            'Women aged 16&ndash;64 for uncomplicated UTI',
            'No appointment needed &mdash; walk in welcome',
            'Completely free of charge',
            'Same-day treatment available',
          ] );
          foreach ( $checklist as $item ) : ?>
          <li class="flex items-center gap-3 text-gray-700 font-jost">
            <span class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
              <svg class="w-3.5 h-3.5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo $item; ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="mt-8">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3.5 rounded-full transition-colors shadow-lg shadow-blue-500/20 font-jost">
            <?php echo sp_field( 'pf_elig_btn', 'Book Your Free Appointment' ); ?>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S6: LOCATIONS — White bg, 4 branch photo cards
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden bg-white" id="locations">
  <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 32px 32px;"></div>
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-100/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-10 md:mb-14">
      <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">4 Locations Across Hampshire</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'pf_loc_heading', 'Visit Us at Any of Our 4 Hampshire Locations' ); ?></h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'pf_loc_intro', 'Free parking and same-day Pharmacy First treatment at all locations.' ); ?></p>
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
        <p class="text-white text-lg font-semibold mb-1 font-jost"><?php echo sp_field( 'pf_loc_banner_heading', 'No appointment needed &mdash; walk in any time' ); ?></p>
        <p class="text-blue-100 text-base font-jost"><?php echo sp_field( 'pf_loc_banner_body', 'All four branches offer NHS Pharmacy First during regular opening hours. Or book a slot online for a guaranteed time.' ); ?></p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        <?php echo sp_field( 'pf_loc_banner_btn', 'Book Online' ); ?>
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S7: FAQ — Light gradient, two-column sticky sidebar + accordion
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
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost"><?php echo sp_field( 'pf_faq_heading', 'Pharmacy First FAQs' ); ?></h2>
        <p class="text-lg text-gray-500 leading-relaxed mb-8 font-jost"><?php echo sp_field( 'pf_faq_intro', 'Common questions about the NHS Pharmacy First service at Southdowns Pharmacy.' ); ?></p>
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
            Book Pharmacy First
          </a>
          <p class="text-gray-400 text-sm text-center font-jost">Free NHS service &middot; No GP referral needed</p>
        </div>
      </div>

      <!-- FAQ accordion -->
      <div class="lg:col-span-8 yf-reveal" data-delay="2">
        <div class="space-y-4" id="faq-list">

          <?php
          $faqs = sp_rows( 'pf_faqs', [
            [ '01', 'Is it really free?', 'Yes. NHS Pharmacy First is fully funded by the NHS. You pay nothing &mdash; not even a prescription charge &mdash; for any treatment provided under the scheme, including prescription-only medicines like antibiotics or antivirals.' ],
            [ '02', 'Do I need to see my GP first?', 'No. That&apos;s the whole point of the service. Our pharmacists are trained to assess and treat these conditions independently. Simply walk in or book online.' ],
            [ '03', 'What conditions can you treat?', 'Sinusitis (12+), Sore Throat (5+), Earache (1&ndash;17), Infected Insect Bite (1+), Impetigo (1+), Shingles (18+), and Uncomplicated UTI (women 16&ndash;64).' ],
            [ '04', 'Do I need to be registered with a specific GP?', 'No. You just need to be registered with any GP in England. You don&apos;t need to be registered locally in Hampshire or with a specific practice.' ],
            [ '05', 'What if my condition can&apos;t be treated here?', 'If your symptoms don&apos;t meet the Pharmacy First criteria, or suggest something more serious, our pharmacist will advise you on the most appropriate next step &mdash; whether that&apos;s your GP, urgent care, or 111.' ],
            [ '06', 'Can children use Pharmacy First?', 'Yes. Children can be treated for earache (ages 1&ndash;17), infected insect bites (ages 1+), impetigo (ages 1+), and sore throat (ages 5+). A parent or guardian should accompany children to the appointment.' ],
            [ '07', 'How long does an appointment take?', 'Most consultations take 10&ndash;15 minutes. You may be asked to wait briefly if the pharmacist is with another patient, but same-day treatment is available at all four branches.' ],
          ], [ 0 => 'num', 1 => 'question', 2 => 'answer' ] );
          foreach ( $faqs as $faq ) : ?>
          <div class="yf-faq-item bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg">
            <button class="yf-faq-trigger w-full flex items-center justify-between text-left p-6 hover:bg-gray-50/50 transition-colors">
              <div class="flex items-center gap-4 flex-1">
                <span class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md shadow-blue-500/20"><?php echo esc_html( $faq[0] ); ?></span>
                <span class="text-slate-800 font-semibold text-base md:text-lg font-jost"><?php echo $faq[1]; ?></span>
              </div>
              <svg class="yf-faq-icon w-5 h-5 text-blue-400 flex-shrink-0 ml-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div class="yf-faq-answer"><div class="px-6 pb-6 pt-0 text-gray-600 leading-relaxed text-base font-jost"><?php echo $faq[2]; ?></div></div>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S8: FINAL CTA — Blue gradient, badge pills, CTAs, trust stats
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
      <?php foreach ( sp_list( 'pf_cta_pills', [ 'NHS Funded', '7 Conditions', 'No GP Needed', 'Same-Day Service', 'GPhC Registered' ] ) as $pill ) : ?>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30"><?php echo esc_html( $pill ); ?></span>
      <?php endforeach; ?>
    </div>

    <div class="yf-reveal mb-8">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 font-jost"><?php echo sp_field( 'pf_cta_heading', 'Don&apos;t Wait Weeks for a GP. Get Treated Today.' ); ?></h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-10 font-jost"><?php echo sp_field( 'pf_cta_subtext', 'All four Southdowns Pharmacy locations offer NHS Pharmacy First &mdash; walk in during opening hours or book your slot online. Free treatment, expert pharmacists, no appointment needed.' ); ?></p>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8 yf-reveal" data-delay="1">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold px-8 py-4 rounded-full hover:bg-blue-50 transition-all shadow-lg text-lg hover:scale-[1.02] hover:shadow-xl font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <?php echo sp_field( 'pf_cta_btn', 'Book a Pharmacy First Appointment' ); ?>
      </a>
    </div>

    <!-- Trust stats row -->
    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12 mt-10 yf-reveal" data-delay="2">
      <?php
      $pf_cta_stats = sp_rows( 'pf_cta_stats', [
        [ '7', 'Conditions Covered' ],
        [ 'FREE', 'NHS Funded' ],
        [ 'Same Day', 'Treatment Available' ],
        [ '4', 'Hampshire Locations' ],
      ], [ 0 => 'value', 1 => 'label' ] );
      foreach ( $pf_cta_stats as $pf_csi => $cs ) : ?>
      <?php if ( $pf_csi > 0 ) : ?><div class="hidden md:block w-px h-12 bg-white/30"></div><?php endif; ?>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost"><?php echo esc_html( $cs[0] ); ?></div>
        <div class="text-blue-200 text-sm font-jost"><?php echo esc_html( $cs[1] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- Medical disclaimer strip -->
<div class="bg-gray-100 border-t border-gray-200 py-6">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-gray-400 text-xs leading-relaxed text-center font-jost"><?php echo sp_field( 'pf_disclaimer', 'This service is provided under the NHS Pharmacy First scheme. Treatment is subject to clinical assessment by our GPhC-registered pharmacists. Not all presentations will meet the criteria for NHS-funded treatment. If you are unsure whether your condition qualifies, please walk in or call your nearest branch. Information is accurate as of April 2026.' ); ?></p>
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
