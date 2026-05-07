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
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=1200&q=80&auto=format&fit=crop');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start">
      <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span></span>
      TympaHealth Certified
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;">Professional Ear Wax Removal</h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost">Safe, painless microsuction by trained clinicians. The gold standard in ear care &mdash; no water, no mess, immediate results.</p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost">Same-day appointments available &middot; From &pound;49 &middot; Free follow-up included</p>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start">
        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span></span>
        TympaHealth Certified
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;">Professional Ear Wax Removal by Microsuction</h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost">Powered by TympaHealth, our trained clinicians use gentle low-pressure microsuction &mdash; the gold standard in ear care. No water, no mess, completely painless with immediate results.</p>
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
      <p class="text-white text-base font-medium font-jost">From &pound;49 &middot; Free follow-up included &middot; Same-day appointments</p>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=1200&q=80&auto=format&fit=crop');"></div>

    <!-- Badge images — 3 badges straddling the centre divider -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398697-0.png" alt="Same Day Appointments" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398761-2.png" alt="GPhC Registered" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398725-1.png" alt="5-Star Rated" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
  </div>

</section>


<!-- ============================================================
     S2: KEY STATS — Light gradient, 4 white stat cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f0f9ff 100%);">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/30 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-100/20 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-200/60 shadow-sm">
        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span></span>
        <span class="uppercase tracking-wider text-xs font-semibold">At a Glance</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost">Professional Microsuction Treatment</h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost">The safest and most effective method of ear wax removal, available across our Hampshire locations.</p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
      <div class="ew-reveal ew-card-lift text-center p-6 md:p-8 bg-white rounded-2xl border border-blue-100/60 shadow-sm hover:shadow-md transition-shadow" data-delay="1">
        <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2 font-jost">20</div>
        <div class="text-sm md:text-base text-gray-500 font-medium font-jost">Minute Appointments</div>
      </div>
      <div class="ew-reveal ew-card-lift text-center p-6 md:p-8 bg-white rounded-2xl border border-blue-100/60 shadow-sm hover:shadow-md transition-shadow" data-delay="2">
        <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2 font-jost">95%+</div>
        <div class="text-sm md:text-base text-gray-500 font-medium font-jost">Success Rate</div>
      </div>
      <div class="ew-reveal ew-card-lift text-center p-6 md:p-8 bg-white rounded-2xl border border-blue-100/60 shadow-sm hover:shadow-md transition-shadow" data-delay="3">
        <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2 font-jost">Same</div>
        <div class="text-sm md:text-base text-gray-500 font-medium font-jost">Day Appointments</div>
      </div>
      <div class="ew-reveal ew-card-lift text-center p-6 md:p-8 bg-white rounded-2xl border border-blue-100/60 shadow-sm hover:shadow-md transition-shadow" data-delay="4">
        <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2 font-jost">Free</div>
        <div class="text-sm md:text-base text-gray-500 font-medium font-jost">Follow-Up Included</div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: COMMON SYMPTOMS — Blue gradient, 6 symptom cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="inline-flex items-center gap-2 bg-white/15 text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">Common Symptoms</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Is Ear Wax Affecting Your Daily Life?</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">Don&rsquo;t let blocked ears hold you back. Recognise these common symptoms?</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="1">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:rgba(6,182,212,0.25);border:1px solid rgba(34,211,238,0.5);">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#67e8f9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Difficulty Hearing</h3>
        <p class="text-blue-100 leading-relaxed font-jost">Muffled sounds or reduced hearing quality affecting conversations and daily activities.</p>
      </div>

      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="2">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:rgba(244,63,94,0.25);border:1px solid rgba(253,164,175,0.5);">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fda4af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Earache or Discomfort</h3>
        <p class="text-blue-100 leading-relaxed font-jost">Persistent pain, pressure, or uncomfortable fullness in one or both ears.</p>
      </div>

      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="3">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:rgba(245,158,11,0.25);border:1px solid rgba(252,211,77,0.5);">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fcd34d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Ringing or Buzzing</h3>
        <p class="text-blue-100 leading-relaxed font-jost">Tinnitus symptoms including ringing, buzzing, or humming sounds in your ears.</p>
      </div>

      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="4">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:rgba(139,92,246,0.25);border:1px solid rgba(196,181,253,0.5);">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#c4b5fd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Dizziness</h3>
        <p class="text-blue-100 leading-relaxed font-jost">Feeling off-balance or experiencing vertigo due to blocked ear canals.</p>
      </div>

      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="5">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:rgba(16,185,129,0.25);border:1px solid rgba(52,211,153,0.5);">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#6ee7b7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Hearing Aid Problems</h3>
        <p class="text-blue-100 leading-relaxed font-jost">Failed hearing aid fitting or devices not working properly due to wax build-up.</p>
      </div>

      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="6">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:rgba(249,115,22,0.25);border:1px solid rgba(253,186,116,0.5);">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fdba74" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Persistent Cough</h3>
        <p class="text-blue-100 leading-relaxed font-jost">Unexplained coughing caused by ear wax stimulating nerves in the ear canal.</p>
      </div>

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
<section class="relative overflow-hidden" id="about">
  <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[540px]">
    <!-- Left: copy -->
    <div class="relative flex flex-col justify-center px-10 lg:px-16 py-16 bg-white overflow-hidden">
      <div class="absolute top-0 right-0 w-72 h-72 bg-blue-50/60 rounded-full translate-x-1/2 -translate-y-1/2 blur-2xl pointer-events-none"></div>
      <div class="absolute bottom-0 left-0 w-56 h-56 bg-cyan-50/60 rounded-full -translate-x-1/3 translate-y-1/3 blur-2xl pointer-events-none"></div>
      <div class="relative z-10 ew-reveal">
        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-xs font-semibold px-4 py-2 rounded-full mb-6 border border-blue-200/60 uppercase tracking-wider self-start">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
          What You Need to Know
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost leading-tight">What Is Ear Microsuction?</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-5 font-jost">Ear Microsuction is the safest and most effective way to remove earwax. It works by inserting a low-pressure suction probe into the ear. One of our trained clinicians wearing a microscope will control the probe to clear the ear canal of wax.</p>
        <p class="text-gray-600 text-lg leading-relaxed mb-8 font-jost">Painless and clean &mdash; no water squirted into your ear canal like syringing. Immediate results every time.</p>
        <div class="grid grid-cols-2 gap-4">
          <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
            <div class="text-3xl font-bold text-blue-600 mb-1 font-jost">95%+</div>
            <div class="text-gray-500 text-sm font-jost">Success rate with immediate improvement in hearing</div>
          </div>
          <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
            <div class="text-3xl font-bold text-blue-600 mb-1 font-jost">No Water</div>
            <div class="text-gray-500 text-sm font-jost">Dry procedure &mdash; no mess, no water squirted into your ears</div>
          </div>
        </div>
      </div>
    </div>
    <!-- Right: image -->
    <div class="relative overflow-hidden min-h-[400px] lg:min-h-0">
      <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=900&q=80&auto=format&fit=crop" alt="Professional ear examination with advanced equipment" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy"/>
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
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="inline-flex items-center gap-2 bg-white/15 text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20">
        <span class="uppercase tracking-wider text-xs font-semibold">Treatment Comparison</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost">How Our Treatment Compares</h2>
      <p class="text-lg text-blue-100 max-w-3xl mx-auto font-jost">See why microsuction is the gold standard for ear wax removal.</p>
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
            <?php
            $rows = [
              ['Treatment Time',                  'Up to 30 minutes',  '30+ minutes',   'Days or weeks'],
              ['Water Spillage',                   'None &#10003;',     'Moderate',      'Drips and Leaks'],
              ['Risk Level',                       'Very Low &#10003;', 'Moderate',      'Varies'],
              ['Success Rate',                     '95%+ &#10003;',     '70&ndash;80%',  'Under 50%'],
              ['Immediate Results',                'Yes &#10003;',      'Sometimes',     'Rarely'],
              ['Safe for Perforated Eardrums',     'Yes &#10003;',      'No',            'No'],
            ];
            foreach ( $rows as $i => $row ) :
              $border = ( $i < count($rows) - 1 ) ? 'border-b border-white/10' : '';
            ?>
            <tr class="<?php echo $border; ?>">
              <td class="px-6 py-4 text-blue-100 font-medium"><?php echo $row[0]; ?></td>
              <td class="px-6 py-4 text-white font-semibold bg-white/5"><?php echo $row[1]; ?></td>
              <td class="px-6 py-4 text-blue-200"><?php echo $row[2]; ?></td>
              <td class="px-6 py-4 text-blue-200"><?php echo $row[3]; ?></td>
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
<section class="relative py-16 md:py-24 overflow-hidden" id="how-it-works" style="background: linear-gradient(180deg, #ffffff 0%, #f0f7ff 30%, #e8f4fd 60%, #f8fafc 100%);">
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/4 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-cyan-100/30 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span></span>
        <span class="uppercase tracking-wider text-xs font-semibold">Your Appointment</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost">What to Expect</h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost">Each appointment takes roughly 20&ndash;30 minutes. Simple, effective treatment in three easy steps.</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

      <!-- Photo -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl ew-reveal">
        <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=800&q=80&auto=format&fit=crop" alt="Healthcare professional performing ear examination" class="w-full aspect-[4/3] object-cover" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">20&ndash;30 Min Appointments</span>
        </div>
      </div>

      <!-- Steps -->
      <div>
        <div class="space-y-6">

          <div class="flex gap-5 group ew-reveal" data-delay="1">
            <div class="flex-shrink-0 flex flex-col items-center">
              <div class="w-12 h-12 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform text-base" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);">1</div>
              <div class="w-0.5 flex-1 mt-3 bg-gradient-to-b from-blue-300/60 to-transparent min-h-[32px]"></div>
            </div>
            <div class="pb-4">
              <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost">Initial Assessment</h4>
              <p class="text-gray-600 leading-relaxed font-jost">Detailed ear examination using high-definition imaging. We discuss your symptoms, review your ear health history, and explain the treatment plan. No-obligation assessment.</p>
              <span class="inline-block mt-3 text-blue-600 text-sm font-medium bg-blue-50 px-3 py-1 rounded-full border border-blue-100 font-jost">~10 minutes</span>
            </div>
          </div>

          <div class="flex gap-5 group ew-reveal" data-delay="2">
            <div class="flex-shrink-0 flex flex-col items-center">
              <div class="w-12 h-12 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform text-base" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);">2</div>
              <div class="w-0.5 flex-1 mt-3 bg-gradient-to-b from-blue-300/60 to-transparent min-h-[32px]"></div>
            </div>
            <div class="pb-4">
              <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost">Microsuction Treatment</h4>
              <p class="text-gray-600 leading-relaxed font-jost">Gentle wax removal using low-pressure suction with continuous monitoring and real-time imaging. Your clinician provides progress updates throughout. Completely painless with immediate relief.</p>
              <span class="inline-block mt-3 text-blue-600 text-sm font-medium bg-blue-50 px-3 py-1 rounded-full border border-blue-100 font-jost">15&ndash;20 minutes</span>
            </div>
          </div>

          <div class="flex gap-5 group ew-reveal" data-delay="3">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform text-base" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);">3</div>
            </div>
            <div>
              <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost">Aftercare &amp; Follow-Up</h4>
              <p class="text-gray-600 leading-relaxed font-jost">Prevention advice, home care tips, and hearing screening if needed. There is a <strong>free follow-up appointment</strong> included to determine if you need to return on a 3 or 6-month interval.</p>
              <span class="inline-block mt-3 text-green-600 text-sm font-medium bg-green-50 px-3 py-1 rounded-full border border-green-100 font-jost">Free follow-up</span>
            </div>
          </div>

        </div>
        <div class="mt-8 ew-reveal" data-delay="4">
          <div class="rounded-xl p-5 text-white text-sm font-medium flex items-center gap-3 shadow-lg shadow-blue-500/20" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <span class="font-jost">During examination, HD images &amp; videos are taken to identify any issues beyond wax buildup.</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S7: WHY THE NHS GAP MATTERS — Blue gradient, two-col text + image
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      <!-- Left: image -->
      <div class="ew-reveal relative rounded-2xl overflow-hidden shadow-2xl group order-2 lg:order-1">
        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&q=80&auto=format&fit=crop" alt="Friendly pharmacist consultation" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 to-transparent"></div>
      </div>

      <!-- Right: copy -->
      <div class="order-1 lg:order-2 ew-reveal" data-delay="1">
        <div class="inline-flex items-center gap-2 bg-white/15 text-white text-xs font-semibold px-4 py-2 rounded-full mb-6 border border-white/20 uppercase tracking-wider font-jost">
          Why Pharmacy Ear Care
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 font-jost">Skip the 12&ndash;16 Week NHS Wait</h2>
        <p class="text-blue-100 text-lg leading-relaxed mb-5 font-jost">In the UK, 3.9% of the population need earwax management yearly, many enduring 12&ndash;16 week waits. The lack of available NHS treatment leads many to suffer in silence, unaware that local pharmacy options exist.</p>
        <p class="text-blue-100 text-lg leading-relaxed mb-6 font-jost">At Southdowns Pharmacy Group, we&rsquo;ve partnered with <strong class="text-white">TympaHealth</strong> to provide easy and accessible ear wax removal at our Emsworth, Davies &amp; Bosmere branches. Various factors like age and loud noise exposure impact ear health. Don&rsquo;t let ear wax buildup lead to social withdrawal.</p>
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 mb-6">
          <h4 class="text-white font-bold mb-3 font-jost">Serving across Hampshire:</h4>
          <div class="flex flex-wrap gap-2">
            <span class="bg-white/20 text-white text-sm font-medium px-3 py-1.5 rounded-full border border-white/30 font-jost">Emsworth</span>
            <span class="bg-white/20 text-white text-sm font-medium px-3 py-1.5 rounded-full border border-white/30 font-jost">Havant</span>
            <span class="bg-white/20 text-white text-sm font-medium px-3 py-1.5 rounded-full border border-white/30 font-jost">Rowlands Castle</span>
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
     S8: PRICING — Light gradient, consultation card + glow treatment card
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" id="pricing" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 40%, #ecfeff 70%, #f8fafc 100%);">
  <div class="absolute top-1/2 left-0 w-[500px] h-[500px] bg-blue-200/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute top-0 right-0 w-80 h-80 bg-cyan-200/15 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-100">
        <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span></span>
        <span class="uppercase tracking-wider text-xs font-semibold">Transparent Pricing</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost">Ear Wax Removal Pricing</h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto font-jost">Clear, upfront pricing with no hidden fees.</p>
    </div>
    <div class="max-w-3xl mx-auto ew-reveal">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Consultation -->
        <div class="ew-card-lift bg-white rounded-2xl p-8 border border-gray-200 shadow-lg text-center">
          <div class="mb-4">
            <span class="text-5xl font-bold text-slate-800 font-jost">&pound;10</span>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost">Initial Consultation</h3>
          <p class="text-gray-500 text-base mb-6 font-jost">Comprehensive ear assessment before treatment to determine the best care for you.</p>
          <ul class="text-left space-y-3 mb-6">
            <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> HD ear canal imaging</li>
            <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Symptom discussion</li>
            <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Treatment plan explanation</li>
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
              <span class="text-5xl font-bold text-slate-800 font-jost">&pound;49</span>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost">Ear Wax Removal</h3>
            <p class="text-gray-500 text-base mb-6 font-jost">Professional ear wax removal for clear, healthy ears.</p>
            <ul class="text-left space-y-3 mb-6">
              <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Consultation included</li>
              <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Same-day appointments</li>
              <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Hearing screening included</li>
              <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Free 7-day follow-up</li>
              <li class="flex items-start gap-3 text-gray-600 text-sm font-jost"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> HD imaging before &amp; after</li>
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
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-white/15 text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">Why Us</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Why Choose Southdowns Pharmacy</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">TympaHealth certified clinicians using the latest diagnostic technology for safe, effective ear care.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php
      $why_cards = [
        ['TympaHealth Certified',        'Our clinicians completed the comprehensive TympaHealth Ear &amp; Hearing Healthcare training course.',                                     'rgba(16,185,129,0.25)',  'rgba(52,211,153,0.5)',  '#6ee7b7',  '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>'],
        ['Real-Time HD Imaging',         'Using advanced imaging equipment, we can see exactly what&rsquo;s in your ear canal before and during treatment.',                          'rgba(6,182,212,0.25)',   'rgba(34,211,238,0.5)',  '#67e8f9',  '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'],
        ['Same-Day Appointments',        'No NHS waiting. Same-day microsuction appointments available subject to availability.',                                                   'rgba(245,158,11,0.25)', 'rgba(252,211,77,0.5)',  '#fcd34d',  '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
        ['Painless Procedure',           'No water, no mess &mdash; just gentle suction for a comfortable experience with immediate hearing improvement.',                          'rgba(139,92,246,0.25)', 'rgba(196,181,253,0.5)', '#c4b5fd',  '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/>'],
        ['3 Convenient Locations',       'Available at Emsworth, Davies &amp; Bosmere. Serving Havant, Rowlands Castle and surrounds.',                                'rgba(244,63,94,0.25)',  'rgba(253,164,175,0.5)', '#fda4af',  '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>'],
        ['Free Follow-Up',               'Complimentary aftercare appointment included to check progress and determine if further treatment is needed.',                            'rgba(249,115,22,0.25)', 'rgba(253,186,116,0.5)', '#fdba74',  '<path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
      ];
      foreach ( $why_cards as $i => $card ) : $delay = ($i % 3) + 1; ?>
      <div class="ew-reveal group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105" data-delay="<?php echo $delay; ?>">
        <div class="w-12 h-12 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform" style="background:<?php echo $card[2]; ?>;border:1px solid <?php echo $card[3]; ?>;">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="<?php echo $card[4]; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $card[5]; ?></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost"><?php echo $card[0]; ?></h3>
        <p class="text-blue-100 leading-relaxed font-jost"><?php echo $card[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S10: TESTIMONIALS — Light gradient, 3 patient review cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(180deg, #ffffff 0%, #f0f7ff 40%, #e8f4fd 70%, #f8fafc 100%);">
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100/25 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-72 h-72 bg-cyan-100/20 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-200/60 shadow-sm">
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">Patient Reviews</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4 font-jost">What Our Patients Say</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <?php
      $reviews = [
        ['DW', 'David Williams',   'Emsworth Branch',  'bg-blue-100',  'text-blue-600',  'After weeks of muffled hearing, I got my ears treated here. The difference was immediate &mdash; I could hear clearly again! The clinician was so gentle and explained everything. Highly recommend!'],
        ['MT', 'Margaret Turner',  'Davies Branch',    'bg-cyan-100',  'text-cyan-600',  'Much better than the traditional syringing I had years ago. No mess, no fuss, just clear hearing again. The appointment only took 20 minutes and the staff were lovely.'],
        ['JR', 'John Roberts',     'Bosmere Branch',   'bg-blue-100',  'text-blue-600',  'Fantastic service. Painless procedure and immediate relief. I&rsquo;d been suffering for months with blocked ears and the GP wait was ridiculous. So glad I found Southdowns!'],
      ];
      foreach ( $reviews as $r ) : ?>
      <div class="ew-reveal ew-card-lift bg-gradient-to-br from-white to-blue-50/30 rounded-2xl p-8 border border-blue-100/50" data-delay="<?php echo array_search($r, $reviews) + 1; ?>">
        <div class="flex gap-1 mb-4">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg><?php endfor; ?>
        </div>
        <p class="text-gray-600 text-base leading-relaxed mb-6 italic font-jost">&ldquo;<?php echo $r[5]; ?>&rdquo;</p>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm <?php echo $r[3]; ?> <?php echo $r[4]; ?>"><?php echo esc_html($r[0]); ?></div>
          <div>
            <div class="text-slate-800 font-semibold text-sm font-jost"><?php echo esc_html($r[1]); ?></div>
            <div class="text-gray-400 text-xs font-jost"><?php echo esc_html($r[2]); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============================================================
     S11: FAQ — Blue gradient, sticky sidebar + 8 accordion items
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" id="faq" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

      <!-- Sticky sidebar -->
      <div class="lg:col-span-4 lg:sticky lg:top-28 lg:self-start ew-reveal">
        <div class="inline-flex items-center gap-2 bg-white/15 text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20">
          <span class="relative flex h-2.5 w-2.5"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span><span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span></span>
          <span class="uppercase tracking-wider text-xs font-semibold">FAQs</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 font-jost">Frequently Asked Questions</h2>
        <p class="text-lg text-blue-100 leading-relaxed mb-8 font-jost">Everything you need to know about ear wax removal at Southdowns Pharmacy.</p>
        <div class="hidden lg:grid grid-cols-3 gap-4 mb-8">
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="text-2xl font-bold text-white mb-1 font-jost">4.9</div>
            <div class="text-blue-200 text-xs font-medium font-jost">Rating</div>
          </div>
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="text-2xl font-bold text-white mb-1 font-jost">400+</div>
            <div class="text-blue-200 text-xs font-medium font-jost">Reviews</div>
          </div>
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
            <div class="text-2xl font-bold text-white mb-1 font-jost">10k+</div>
            <div class="text-blue-200 text-xs font-medium font-jost">Patients</div>
          </div>
        </div>
        <div class="hidden lg:block space-y-3">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="flex items-center justify-center gap-2 bg-white text-blue-700 hover:bg-blue-50 font-semibold px-6 py-3.5 rounded-full transition-all shadow-lg font-jost">Book Appointment</a>
          <p class="text-blue-200 text-sm text-center font-jost">From &pound;49 &middot; Free follow-up included</p>
        </div>
      </div>

      <!-- Accordion -->
      <div class="lg:col-span-8 space-y-4">
        <?php
        $faqs = [
          ['01', 'Is microsuction painful?',
           'No. Microsuction is a gentle, painless procedure. You may hear a mild suction sound during treatment, but the low-pressure probe causes no discomfort. It&rsquo;s far more comfortable than traditional ear syringing which uses water pressure.'],
          ['02', 'How long does the appointment take?',
           'Each appointment takes roughly <strong>20&ndash;30 minutes</strong>. This includes the initial ear examination, the microsuction procedure itself, and a hearing screening afterwards if appropriate.'],
          ['03', 'Do I need to use ear drops before my appointment?',
           'We recommend using olive oil or sodium bicarbonate ear drops for <strong>2&ndash;3 days before your appointment</strong>. This softens the wax and makes removal easier and quicker. However, we can often remove wax without prior preparation.'],
          ['04', 'Is the service available on the NHS?',
           'Many NHS GP surgeries no longer offer ear wax removal, and where they do, waiting times can be 12&ndash;16 weeks. Our private service means you can be seen <strong>the same day with no referral needed</strong>, so you get relief immediately.'],
          ['05', 'Is there an age restriction?',
           '<strong>Yes, this service is strictly for ages 18 and over only.</strong> If you make a booking for someone under 18, there is a strict no-refund policy as clinical time has been allocated. Please do not book for any persons under the age of 18.'],
          ['06', 'How often will I need treatment?',
           'This varies from person to person. Some people only need treatment once. Others who produce excess wax may benefit from appointments <strong>every 3 to 6 months</strong>. Your clinician will advise a personalised schedule during your free follow-up.'],
          ['07', 'What if you find something other than wax?',
           'During the examination, high-definition images and videos are taken. This can identify infections, perforations, or other conditions. If we find anything that requires further investigation, we&rsquo;ll advise you to visit your GP or refer you to a specialist ENT doctor.'],
          ['08', 'Which branches offer this service?',
           'TympaHealth ear wax removal is currently available at our <strong>Emsworth, Davies &amp; Bosmere</strong> branches. We serve patients from Emsworth, Havant, Rowlands Castle and the surrounding Hampshire area. Contact us for the nearest location.'],
        ];
        foreach ( $faqs as $faq ) : ?>
        <div class="ew-faq-item bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-sm">
          <button class="ew-faq-trigger w-full flex items-center gap-4 p-6 text-left hover:bg-gray-50/50 transition-colors" type="button">
            <span class="flex-shrink-0 w-10 h-10 text-white rounded-xl flex items-center justify-center font-bold text-sm shadow-md" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);"><?php echo esc_html($faq[0]); ?></span>
            <span class="flex-1 font-semibold text-slate-800 text-base leading-snug font-jost"><?php echo $faq[1]; ?></span>
            <span class="ew-faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
          </button>
          <div class="ew-faq-answer">
            <div class="px-6 pb-6 text-gray-600 leading-relaxed font-jost text-sm"><?php echo $faq[2]; ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S12: LOCATIONS — Light gradient, 3 TympaHealth branch cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" id="locations" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #ecfeff 100%);">
  <div class="absolute bottom-0 left-1/2 w-[600px] h-[400px] bg-blue-200/15 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm text-blue-700 text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-blue-200/60 shadow-sm">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span class="uppercase tracking-wider text-xs font-semibold">TympaHealth Locations</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost">Visit Our Ear Care Centres</h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost">Available at Emsworth, Davies &amp; Bosmere. Same-day appointments where available.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php
      $branches = [
        ['Emsworth',  'Emsworth, Hampshire',          'Mon&ndash;Fri: 9am&ndash;6pm &middot; Sat: 9am&ndash;5pm', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80&auto=format&fit=crop'],
        ['Davies',    'Davies, Hampshire',             'Mon&ndash;Fri: 9am&ndash;6pm &middot; Sat: 9am&ndash;1pm', 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=600&q=80&auto=format&fit=crop'],
        ['Bosmere',   'Bosmere, Hampshire',            'Mon&ndash;Fri: 9am&ndash;6pm &middot; Sat: 9am&ndash;4pm', 'https://images.unsplash.com/photo-1576602976047-174e57a47881?w=600&q=80&auto=format&fit=crop'],
      ];
      foreach ( $branches as $i => $branch ) : $delay = $i + 1; ?>
      <div class="ew-reveal ew-card-lift bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm group" data-delay="<?php echo $delay; ?>">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_attr($branch[3]); ?>" alt="<?php echo esc_attr($branch[0]); ?> ear wax removal pharmacy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md font-jost">Open Now</div>
          <div class="absolute bottom-3 left-3">
            <h3 class="text-white text-xl font-bold font-jost"><?php echo esc_html($branch[0]); ?></h3>
          </div>
        </div>
        <div class="p-5">
          <div class="flex items-start gap-2 mb-2">
            <svg class="flex-shrink-0 mt-0.5 text-blue-500 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-gray-600 text-sm font-jost"><?php echo $branch[1]; ?></span>
          </div>
          <div class="flex items-start gap-2 mb-4">
            <svg class="flex-shrink-0 mt-0.5 text-blue-500 w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <span class="text-gray-400 text-xs font-jost"><?php echo $branch[2]; ?></span>
          </div>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            Book Here
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
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
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="flex flex-wrap justify-center gap-3 mb-8">
      <span class="bg-white/15 text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/20 font-jost">TympaHealth Certified</span>
      <span class="bg-white/15 text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/20 font-jost">Free Follow-Up</span>
      <span class="bg-white/15 text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/20 font-jost">Same-Day Available</span>
      <span class="bg-white/15 text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/20 font-jost">Ages 18+ Only</span>
    </div>
    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Clearer Hearing Starts Today</h2>
    <p class="text-xl text-blue-100 leading-relaxed mb-10 max-w-2xl mx-auto font-jost">Don&rsquo;t suffer in silence. Book your ear wax removal appointment at one of our TympaHealth-equipped branches and experience immediate relief.</p>
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
      <span>&#10003; TympaHealth Certified</span>
      <span>&#10003; Free Follow-Up</span>
      <span>&#10003; Same-Day Available</span>
      <span>&#10003; From &pound;49</span>
    </div>
    <p class="text-blue-200/70 text-sm font-jost">Serving Emsworth, Havant, Rowlands Castle &amp; wider Hampshire</p>
    <!-- Trust indicators -->
    <div class="mt-10 flex flex-wrap justify-center items-center gap-8 md:gap-12">
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">4.9/5</div>
        <div class="text-blue-200 text-sm font-jost">Average Rating</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">400+</div>
        <div class="text-blue-200 text-sm font-jost">5-Star Reviews</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">10,000+</div>
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
