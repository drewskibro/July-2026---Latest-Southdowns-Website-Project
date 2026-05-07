<?php
/**
 * Template Name: Yellow Fever
 *
 * Select this template on the Yellow Fever page via Page → Template in the editor.
 */
get_header();
$booking_url = sp_booking_url();
$phone_raw   = sp_phone_raw();
$phone       = sp_phone();
?>

<!-- FAQPage JSON-LD Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How long does yellow fever vaccination protection last?","acceptedAnswer":{"@type":"Answer","text":"A single dose provides lifelong immunity for most people. The International Certificate of Vaccination is now valid for life."}},
    {"@type":"Question","name":"When should I get the vaccine before travel?","acceptedAnswer":{"@type":"Answer","text":"Book at least 10 days before departure. Your ICVP certificate becomes valid 10 days after vaccination."}},
    {"@type":"Question","name":"Which countries require yellow fever certification?","acceptedAnswer":{"@type":"Answer","text":"Over 40 countries require proof of vaccination, including most of sub-Saharan Africa, parts of South America, and some Asian nations when arriving from endemic areas."}},
    {"@type":"Question","name":"Do I need the vaccine if I'm only transiting through an affected country?","acceptedAnswer":{"@type":"Answer","text":"Yes, often. Many countries require certification if you've transited through a yellow fever endemic country, even without leaving the airport."}},
    {"@type":"Question","name":"Can I get yellow fever vaccine on the NHS?","acceptedAnswer":{"@type":"Answer","text":"No. Yellow fever vaccination has never been available on the NHS. Our all-inclusive price of £85 covers the vaccine, consultation, official certificate, and everything you need."}},
    {"@type":"Question","name":"I lost my certificate. Can I get a replacement?","acceptedAnswer":{"@type":"Answer","text":"If you were vaccinated at Southdowns Pharmacy, we can issue a replacement certificate from our vaccination records. Bring valid photo ID."}},
    {"@type":"Question","name":"Is the vaccine safe during pregnancy?","acceptedAnswer":{"@type":"Answer","text":"Yellow fever vaccine is generally avoided during pregnancy as it is a live vaccine. Discuss your situation with our pharmacist if travel is unavoidable."}},
    {"@type":"Question","name":"What if I have an egg allergy?","acceptedAnswer":{"@type":"Answer","text":"The vaccine is grown in eggs. Severe anaphylactic egg allergy is a contraindication. Disclose your complete allergy history during consultation."}}
  ]
}
</script>

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

  /* Animated gradient border for pricing card */
  @keyframes borderRotate { 0% { --angle: 0deg; } 100% { --angle: 360deg; } }
  @property --angle { syntax: '<angle>'; initial-value: 0deg; inherits: false; }
  .yf-glow-card { position: relative; background: white; border-radius: 1.25rem; overflow: hidden; }
  .yf-glow-card::before { content: ''; position: absolute; inset: -2px; border-radius: 1.35rem; background: conic-gradient(from var(--angle), #3b82f6, #f59e0b, #3b82f6); animation: borderRotate 4s linear infinite; z-index: -1; }

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
  <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
      <div class="badge-rule w-8 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-xs font-light tracking-[0.15em] uppercase font-jost">NaTHNaC Registered Centre</span>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;">Yellow Fever Vaccine Hampshire</h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost">Registered Yellow Fever Vaccination Centre. Lifetime protection with official ICVP certificate included. Available at all 4 Hampshire locations.</p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Vaccination
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost">&pound;85 all-inclusive &middot; Same day appointments available</p>
  </div>

  <!-- Desktop: 2-column split matching homepage hero -->
  <div class="hidden md:flex">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
        <div class="badge-rule w-10 h-px bg-white/30"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost">NaTHNaC Registered &middot; Yellow Fever Centre</span>
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold leading-tight mb-6 font-jost" style="line-height:1.1;">Yellow Fever Vaccine Hampshire</h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost">Registered Yellow Fever Vaccination Centre serving Hampshire. Lifetime protection with official International Certificate included. Available at all 4 locations.</p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Vaccination
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#locations" class="inline-flex items-center gap-2 text-white/80 text-sm font-medium px-5 py-3 rounded-full hover:text-white transition-colors font-jost">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          Find Your Nearest Branch
        </a>
      </div>
      <p class="text-white text-base lg:text-lg font-medium font-jost">&pound;85 all-inclusive &middot; Same day appointments typically available.</p>
    </div>

    <!-- Right: image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200&q=80&auto=format&fit=crop');"></div>

    <!-- Badge images straddling the centre divider -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398697-0.png" alt="Same Day Appointments" class="w-[130px] h-[130px] object-contain drop-shadow-lg" />
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398761-2.png" alt="Yellow Fever Centre" class="w-[130px] h-[130px] object-contain drop-shadow-lg" />
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:15%;transform:translateX(-50%);">
      <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773073398725-1.png" alt="5-Star Service" class="w-[130px] h-[130px] object-contain drop-shadow-lg" />
    </div>
  </div>

</section>


<!-- ============================================================
     S2: KEY FACTS — Blue gradient, 4 glassmorphism stat cards
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10 md:mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">At a Glance</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Key Facts About the Yellow Fever Vaccine</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">Everything you need to know before booking your vaccination at Southdowns Pharmacy.</p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="1">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">&infin;</div>
        <div class="text-sm md:text-base text-blue-100 font-medium">Lifetime Protection</div>
      </div>
      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="2">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">ICVP</div>
        <div class="text-sm md:text-base text-blue-100 font-medium">Certificate Included</div>
      </div>
      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="3">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">Same</div>
        <div class="text-sm md:text-base text-blue-100 font-medium">Day Appointments</div>
      </div>
      <div class="yf-reveal yf-card-lift text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors" data-delay="4">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost">4</div>
        <div class="text-sm md:text-base text-blue-100 font-medium">Hampshire Locations</div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S3: WHAT IS YELLOW FEVER — Light gradient, two-col layout
     ============================================================ -->
<section class="py-16 md:py-24 bg-gradient-to-br from-slate-50 via-white to-amber-50/30 relative overflow-hidden" id="about">
  <div class="absolute top-0 right-0 w-96 h-96 bg-amber-100/30 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center yf-reveal">
      <div>
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">What You Need to Know</span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost">What Is Yellow Fever?</h2>
        <p class="text-gray-600 text-lg leading-relaxed mb-6 font-jost">Yellow Fever is a serious viral disease transmitted by infected mosquitoes across sub-Saharan Africa, South America and parts of Central America. In severe cases, the disease carries a fatality rate of up to 50%. There is no specific antiviral treatment &mdash; vaccination is the only effective prevention.</p>
        <p class="text-gray-600 text-lg leading-relaxed mb-8 font-jost">Many countries legally require proof of yellow fever vaccination for entry, even if you are simply transiting through an airport in an affected region. Without an official ICVP, you may be denied boarding, quarantined on arrival, or refused entry entirely.</p>
        <div class="grid grid-cols-2 gap-4">
          <div class="bg-white rounded-xl p-5 border border-blue-100 shadow-sm hover:shadow-md transition-shadow yf-card-lift">
            <div class="text-3xl font-bold text-blue-600 mb-1 font-jost">99%</div>
            <div class="text-gray-500 text-sm font-jost">Protection from a single vaccine dose within 30 days</div>
          </div>
          <div class="bg-white rounded-xl p-5 border border-amber-100 shadow-sm hover:shadow-md transition-shadow yf-card-lift">
            <div class="text-3xl font-bold text-amber-500 mb-1 font-jost">Valid for Life</div>
            <div class="text-gray-500 text-sm font-jost">One vaccination. Your ICVP certificate never expires.</div>
          </div>
        </div>
      </div>
      <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
        <img src="https://images.unsplash.com/photo-1580060839134-75a5edca2e99?w=800&q=80&auto=format&fit=crop" alt="Healthcare professional administering a travel vaccination" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy"/>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent"></div>
      </div>
    </div>
  </div>
</section>


<!-- ============================================================
     S4: WHY YOU NEED IT — White bg, 3 numbered step cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
  <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Why It Matters</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost">Why You Need the Yellow Fever Vaccine</h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost">Three essential reasons vaccination is critical for travel to affected regions.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

      <div class="yf-reveal yf-step bg-gradient-to-br from-white to-blue-50/30 rounded-2xl p-8 border border-blue-100/50 hover:shadow-xl hover:shadow-blue-100/30 hover:-translate-y-1 transition-all duration-300" data-delay="1">
        <div class="yf-step-num w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-2xl flex items-center justify-center text-xl font-bold mb-5 shadow-lg shadow-blue-500/25">1</div>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost">Legal Entry Requirement</h3>
        <p class="text-gray-600 leading-relaxed font-jost">Many countries in Africa, South America, and Asia require a valid yellow fever certificate for entry. Your certificate becomes valid <strong>10 days after vaccination</strong>. Without it, you risk being denied boarding or quarantined.</p>
      </div>

      <div class="yf-reveal yf-step bg-gradient-to-br from-white to-amber-50/30 rounded-2xl p-8 border border-amber-100/50 hover:shadow-xl hover:shadow-amber-100/30 hover:-translate-y-1 transition-all duration-300" data-delay="2">
        <div class="yf-step-num w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mb-5 shadow-lg shadow-amber-400/25">2</div>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost">Serious Disease Prevention</h3>
        <p class="text-gray-600 leading-relaxed font-jost">Yellow fever is transmitted by mosquitoes in tropical regions. Most experience mild symptoms, but in some cases it can cause serious complications affecting the liver and kidneys. There is no specific treatment once infected.</p>
      </div>

      <div class="yf-reveal yf-step bg-gradient-to-br from-white to-blue-50/30 rounded-2xl p-8 border border-blue-100/50 hover:shadow-xl hover:shadow-blue-100/30 hover:-translate-y-1 transition-all duration-300" data-delay="3">
        <div class="yf-step-num w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-2xl flex items-center justify-center text-xl font-bold mb-5 shadow-lg shadow-blue-500/25">3</div>
        <h3 class="text-xl font-bold text-slate-800 mb-3 font-jost">Lifetime Protection</h3>
        <p class="text-gray-600 leading-relaxed font-jost">Unlike many travel vaccines, yellow fever vaccination provides <strong>lifelong immunity from a single dose.</strong> Your official certificate is valid for life, even certificates issued before 2016 with old expiry dates.</p>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S5: RISK AREAS — Blue gradient, Africa + Americas + transit warning
     ============================================================ -->
<section class="py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="risk-areas">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Risk Areas</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 font-jost">Yellow Fever Risk Areas</h2>
      <p class="text-lg text-blue-100 max-w-3xl mx-auto font-jost">Yellow fever is endemic across large areas of sub-Saharan Africa and South America. If your itinerary passes through these regions, you almost certainly need vaccination.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 yf-reveal">

      <!-- Africa -->
      <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
        <h3 class="text-2xl font-bold text-white mb-4 font-jost">&#127757; Africa</h3>
        <p class="text-blue-100 mb-4 text-sm font-jost">Sub-Saharan Africa (47 countries at risk). West Africa carries the highest risk.</p>
        <ul class="space-y-3">
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Ghana, Nigeria, Senegal, C&ocirc;te d&apos;Ivoire (West Africa &mdash; highest risk)
          </li>
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Kenya, Ethiopia, Tanzania, Uganda (East Africa)
          </li>
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Democratic Republic of Congo, Cameroon, Sudan (Central Africa)
          </li>
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Angola, Zambia, Zimbabwe (Southern Africa risk zones)
          </li>
        </ul>
      </div>

      <!-- South America -->
      <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
        <h3 class="text-2xl font-bold text-white mb-4 font-jost">&#127758; South America</h3>
        <p class="text-blue-100 mb-4 text-sm font-jost">Central and South America (13 countries). Amazon rainforest regions carry the highest risk.</p>
        <ul class="space-y-3">
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Brazil (Amazon basin, north and central states)
          </li>
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Peru, Colombia, Ecuador (Andean and Amazon regions)
          </li>
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Bolivia, Venezuela, Guyana, Suriname
          </li>
          <li class="flex items-start gap-2 text-white text-sm font-jost">
            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Panama, Trinidad and Tobago, Argentina (border risk zones)
          </li>
        </ul>
      </div>

    </div>

    <!-- Transit warning -->
    <div class="mt-8 bg-yellow-500/20 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-yellow-400/30 flex items-start gap-5 yf-reveal">
      <svg class="w-8 h-8 text-yellow-400 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <div>
        <strong class="block text-white text-lg mb-2 font-jost">Transit Warning &mdash; Don&apos;t Overlook This</strong>
        <p class="text-blue-100 leading-relaxed font-jost">Even if your destination doesn&apos;t have yellow fever, you may need a certificate if <strong class="text-white">transiting through affected countries.</strong> For example, travelling UK &rarr; Kenya &rarr; Seychelles requires a certificate for Seychelles entry. We check your complete itinerary during consultation.</p>
      </div>
    </div>

  </div>
</section>


<!-- ============================================================
     S6: HOW IT WORKS — White bg, pharmacist photo + 3 numbered steps
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="how-it-works">
  <div class="absolute bottom-0 right-0 w-72 h-72 bg-amber-100/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Your Appointment</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost">What to Expect</h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost">A streamlined, professional vaccination experience. From consultation to certified ICVP in under 30 minutes.</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start yf-reveal">

      <!-- Photo -->
      <div class="relative rounded-2xl overflow-hidden shadow-xl">
        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&q=80&auto=format&fit=crop" alt="GPhC pharmacist preparing travel vaccination" class="w-full aspect-[4/3] object-cover" loading="lazy"/>
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
          <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
          <span class="text-slate-800 font-semibold text-sm font-jost">GPhC-Registered Pharmacists</span>
        </div>
      </div>

      <!-- Steps -->
      <div class="space-y-8">
        <div class="flex gap-5 group">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">1</div>
          <div>
            <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost">Travel Consultation</h4>
            <p class="text-gray-600 leading-relaxed font-jost">Our yellow fever travel expert reviews your itinerary, destination countries, transit points, and medical history. We confirm whether you need vaccination and check for any contraindications.</p>
          </div>
        </div>
        <div class="flex gap-5 group">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">2</div>
          <div>
            <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost">Vaccination</h4>
            <p class="text-gray-600 leading-relaxed font-jost">Single injection administered into your upper arm. We use only WHO-prequalified vaccine from approved manufacturers, stored under strict cold chain conditions.</p>
          </div>
        </div>
        <div class="flex gap-5 group">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">3</div>
          <div>
            <h4 class="text-xl font-bold text-slate-800 mb-2 font-jost">Official Certificate Issued</h4>
            <p class="text-gray-600 leading-relaxed font-jost">You receive your International Certificate of Vaccination or Prophylaxis (ICVP) immediately. We complete all required fields &mdash; vaccine batch number, date, official stamp, and pharmacist signature. Valid 10 days after vaccination and lasts for life.</p>
          </div>
        </div>
        <div class="bg-gradient-to-r from-blue-50 to-amber-50 rounded-xl p-5 border border-blue-100 text-blue-700 text-sm font-medium flex items-center gap-3">
          <svg class="w-5 h-5 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          <span class="font-jost">Allow approx 30 minutes total &middot; Book at least 10 days before travel</span>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S7: SIDE EFFECTS & SAFETY — Light gradient, 2 white cards
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" id="safety" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #fffbeb 100%);">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="absolute top-0 left-0 w-72 h-72 bg-blue-200/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-72 h-72 bg-amber-200/20 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Safety Information</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost">Side Effects &amp; Safety</h2>
      <p class="text-lg text-gray-500 max-w-3xl mx-auto font-jost">Excellent safety record with over 600 million doses administered worldwide. Serious reactions are extremely rare.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 yf-reveal">

      <!-- Common side effects -->
      <div class="bg-white rounded-2xl p-8 border border-gray-200 yf-card-lift shadow-sm">
        <h3 class="text-xl font-bold text-slate-800 mb-5 font-jost">Common Side Effects (1 in 3 People)</h3>
        <ul class="space-y-3 mb-6">
          <li class="flex items-center gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Injection site pain, redness, or swelling
          </li>
          <li class="flex items-center gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Headache and muscle aches
          </li>
          <li class="flex items-center gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            Low-grade fever and fatigue
          </li>
        </ul>
        <p class="text-gray-400 text-sm font-jost">These mild effects typically appear 5&ndash;10 days post-vaccination and resolve within 2 weeks.</p>
      </div>

      <!-- Contraindications -->
      <div class="bg-white rounded-2xl p-8 border border-gray-200 yf-card-lift shadow-sm">
        <h3 class="text-xl font-bold text-slate-800 mb-5 font-jost">Who Should NOT Receive the Vaccine</h3>
        <ul class="space-y-3">
          <li class="flex items-start gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Infants under 9 months old
          </li>
          <li class="flex items-start gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Severe egg allergy or previous severe reaction
          </li>
          <li class="flex items-start gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Thymus disorders or history of thymus removal
          </li>
          <li class="flex items-start gap-3 text-gray-600 font-jost">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Severely immunocompromised patients
          </li>
        </ul>
        <div class="mt-6 bg-amber-50 rounded-xl p-4 border border-amber-200 text-amber-800 text-sm font-jost">
          <strong>Special precautions:</strong> Pregnancy, breastfeeding, ages 60+, and mild immunosuppression require case-by-case assessment by our pharmacist.
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S8: PRICING — White bg, animated glow card, £85 all-inclusive
     ============================================================ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden" id="pricing">
  <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 32px 32px;"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Transparent Pricing</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost">Yellow Fever Vaccine Pricing</h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto font-jost">All-inclusive price. No hidden fees. No consultation charges.</p>
    </div>

    <div class="max-w-lg mx-auto yf-reveal">
      <div class="yf-glow-card relative bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-center py-3.5 relative overflow-hidden">
          <div class="yf-shimmer absolute inset-0"></div>
          <span class="relative text-white font-semibold text-sm uppercase tracking-wider">All-Inclusive &middot; Everything Included</span>
        </div>
        <div class="p-8 text-center">
          <div class="mb-6">
            <span class="text-5xl md:text-6xl font-bold text-slate-800 font-jost">&pound;85</span>
            <span class="text-gray-500 text-lg ml-2 font-jost">per person</span>
          </div>
          <p class="text-gray-400 text-sm mb-8 font-jost">Single lifetime dose</p>
          <ul class="text-left space-y-3 mb-8">
            <li class="flex items-start gap-3 text-gray-600 font-jost">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              Yellow fever vaccine (single lifetime dose)
            </li>
            <li class="flex items-start gap-3 text-gray-600 font-jost">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              GPhC pharmacist travel health consultation
            </li>
            <li class="flex items-start gap-3 text-gray-600 font-jost">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              Full travel health risk assessment
            </li>
            <li class="flex items-start gap-3 text-gray-600 font-jost">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              15-minute post-vaccination observation
            </li>
            <li class="flex items-start gap-3 text-gray-600 font-jost">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              Official ICVP Certificate included
            </li>
            <li class="flex items-start gap-3 text-gray-600 font-jost">
              <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              No additional fees whatsoever
            </li>
          </ul>
          <a href="<?php echo esc_url( $booking_url ); ?>" class="block w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold py-4 rounded-full text-center transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.02] font-jost">
            Book Your Vaccination
          </a>
          <p class="text-gray-400 text-xs mt-4 font-jost">Certificate valid for life &middot; Valid 10 days post-vaccination</p>
        </div>
      </div>
    </div>

    <div class="max-w-3xl mx-auto mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100 flex items-start gap-4 yf-reveal">
      <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
      <p class="text-gray-600 text-sm leading-relaxed font-jost">Unlike many vaccination centres, we include the official ICVP certificate in our price &mdash; some providers charge &pound;20&ndash;40 extra. The price you see is the price you pay. We accept cash, card, and contactless. <strong>Book at least 10 days before departure.</strong></p>
    </div>

  </div>
</section>


<!-- ============================================================
     S9: WHY CHOOSE US — Blue gradient, 6-card grid
     ============================================================ -->
<section class="py-16 md:py-24 overflow-hidden relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10 md:mb-16">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Why Us</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 font-jost">Why Choose Southdowns Pharmacy</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">Officially designated NaTHNaC Yellow Fever Vaccination Centre &mdash; the only type of centre authorised to issue valid ICVP certificates.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 yf-reveal">

      <div class="group yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">NaTHNaC Registered Centre</h3>
        <p class="text-blue-100 text-base leading-relaxed font-jost">Officially designated by the National Travel Health Network and Centre as an authorised Yellow Fever Vaccination Centre.</p>
      </div>

      <div class="group yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">GPhC Registered Pharmacists</h3>
        <p class="text-blue-100 text-base leading-relaxed font-jost">All vaccinations administered by General Pharmaceutical Council registered pharmacists with specialist travel health training.</p>
      </div>

      <div class="group yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">WHO-Prequalified Vaccine</h3>
        <p class="text-blue-100 text-base leading-relaxed font-jost">Only WHO-prequalified yellow fever vaccine from licensed UK manufacturers, stored under strict cold-chain protocols.</p>
      </div>

      <div class="group yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">4 Hampshire Locations</h3>
        <p class="text-blue-100 text-base leading-relaxed font-jost">Serving Portsmouth, Southsea, Waterlooville, Havant, and wider Hampshire. Easy parking at all sites.</p>
      </div>

      <div class="group yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Same-Day Appointments</h3>
        <p class="text-blue-100 text-base leading-relaxed font-jost">Last-minute travel? We offer same-day vaccination appointments subject to availability. Walk-ins welcome.</p>
      </div>

      <div class="group yf-card-lift bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
          <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        </div>
        <h3 class="text-white text-lg font-bold mb-3 font-jost">Complete Travel Health</h3>
        <p class="text-blue-100 text-base leading-relaxed font-jost">We provide comprehensive pre-travel consultations covering typhoid, hepatitis, rabies, meningitis, and malaria alongside yellow fever.</p>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S10: FAQ — Light gradient, two-column sticky sidebar + accordion
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden" id="faq" style="background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f8fafc 100%);">
  <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 28px 28px;"></div>
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-amber-200/15 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

      <!-- Sticky sidebar -->
      <div class="lg:col-span-4 lg:sticky lg:top-28 lg:self-start yf-reveal">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">FAQs</span>
        </div>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-6 font-jost">Yellow Fever Vaccine FAQs</h2>
        <p class="text-lg text-gray-500 leading-relaxed mb-8 font-jost">Everything you need to know about yellow fever vaccination at Southdowns Pharmacy.</p>
        <!-- Trust stats -->
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
            Book Vaccination
          </a>
          <p class="text-gray-400 text-sm text-center font-jost">&pound;85 all-inclusive &middot; Certificate included</p>
        </div>
      </div>

      <!-- FAQ accordion -->
      <div class="lg:col-span-8 yf-reveal" data-delay="2">
        <div class="space-y-4" id="faq-list">

          <?php
          $faqs = [
            ['01', 'How long does yellow fever vaccination protection last?', 'A single dose provides lifelong immunity for most people. The International Certificate of Vaccination is now valid for life (previously 10 years under old WHO rules). You won\'t need booster doses unless you were pregnant, immunocompromised, or a stem cell transplant recipient when first vaccinated.'],
            ['02', 'When should I get the vaccine before travel?', 'Book at least 10 days before departure. Your ICVP certificate becomes valid 10 days after vaccination. Some countries strictly enforce this rule. We recommend 2&ndash;3 weeks before travel where possible. Same-day appointments available for last-minute plans.'],
            ['03', 'Which countries require yellow fever certification?', 'Over 40 countries require proof of vaccination. This includes most of sub-Saharan Africa, parts of South America, and some Asian/Pacific nations when arriving from endemic areas. Requirements change frequently &mdash; we check current NaTHNaC guidance during your consultation.'],
            ['04', 'Do I need the vaccine if I\'m only transiting through an affected country?', 'Yes, often. Many countries require certification if you\'ve transited through a yellow fever endemic country, even without leaving the airport. We\'ll assess your specific itinerary, including all transit stops, during consultation.'],
            ['05', 'Can I get yellow fever vaccine on the NHS?', 'No. Yellow fever vaccination has never been available on the NHS. It must be obtained privately from a registered centre like Southdowns Pharmacy. Our all-inclusive price of &pound;85 covers the vaccine, consultation, official certificate, and everything you need in a single appointment.'],
            ['06', 'I lost my certificate. Can I get a replacement?', 'If you were vaccinated at Southdowns Pharmacy, we can issue a replacement certificate from our vaccination records. Bring valid photo ID. If vaccinated elsewhere, contact that centre directly &mdash; a legitimate replacement cannot be issued without proof of original vaccination.'],
            ['07', 'Is the vaccine safe during pregnancy?', 'Yellow fever vaccine is generally avoided during pregnancy as it is a live vaccine. However, if travel to a high-risk area is unavoidable, vaccination may be recommended after careful risk-benefit assessment. Discuss your situation with our pharmacist.'],
            ['08', 'What if I have an egg allergy?', 'The vaccine is grown in eggs. Severe anaphylactic egg allergy is a contraindication. Milder egg allergies may still allow vaccination with an extended observation period. Disclose your complete allergy history during consultation so we can advise appropriately.'],
          ];
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
     S11: LOCATIONS — White bg, 4 branch photo cards with hover zoom
     ============================================================ -->
<section class="py-16 md:py-24 relative overflow-hidden bg-white" id="locations">
  <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(#1e3a8a 1px, transparent 1px); background-size: 32px 32px;"></div>
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/30 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-80 h-80 bg-amber-100/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-10 md:mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <span class="badge-numeral text-4xl font-bold text-slate-800 font-jost leading-none">4</span>
        <div class="badge-divider w-px h-8 bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Locations Across Hampshire</span>
      </div>
      <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-jost">Visit Our Vaccination Centres</h2>
      <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-jost">Free parking &amp; same-day yellow fever appointments at all locations.</p>
    </div>

    <!-- Branch photo cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 yf-reveal">
      <?php for ( $i = 1; $i <= 4; $i++ ) :
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
        <p class="text-white text-lg font-semibold mb-1 font-jost">Need help choosing a location?</p>
        <p class="text-blue-100 text-base font-jost">All four branches are NaTHNaC registered Yellow Fever Vaccination Centres with free parking.</p>
      </div>
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-sm font-jost flex-shrink-0">
        Book Nearest Branch
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S12: FINAL CTA — Blue gradient, trust badges, CTAs, disclaimer + JS
     ============================================================ -->
<section class="py-16 md:py-24 overflow-hidden relative" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);" id="book">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

    <!-- Trust badge pills -->
    <div class="flex flex-wrap justify-center gap-3 mb-8 yf-reveal">
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">NaTHNaC Registered</span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">Certificate Included</span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">Same-Day Service</span>
      <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full border border-white/30">GPhC Pharmacists</span>
    </div>

    <div class="yf-reveal mb-6">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 font-jost">Protect Yourself Before You Travel</h2>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-10 font-jost">Don&apos;t risk being denied boarding or quarantined on arrival. Book your yellow fever vaccination at our registered centre today.</p>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8 yf-reveal" data-delay="1">
      <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold px-8 py-4 rounded-full hover:bg-blue-50 transition-all shadow-lg text-lg hover:scale-[1.02] hover:shadow-xl font-jost">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Book Yellow Fever Vaccination
      </a>
      <a href="tel:<?php echo esc_attr( $phone_raw ); ?>" class="inline-flex items-center justify-center gap-2 text-white font-medium border-2 border-white/30 px-8 py-4 rounded-full hover:bg-white/10 transition-all text-lg hover:border-white/50 font-jost">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <?php echo esc_html( $phone ); ?>
      </a>
    </div>

    <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-white text-sm mb-6 yf-reveal" data-delay="2">
      <span>&#10003; NaTHNaC Registered Centre</span>
      <span>&#10003; Official ICVP Included</span>
      <span>&#10003; Same-Day Available</span>
      <span>&#10003; &pound;85 All-Inclusive</span>
    </div>

    <!-- Trust indicators -->
    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12 mt-10 yf-reveal" data-delay="3">
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

<!-- Medical disclaimer strip -->
<div class="bg-gray-100 border-t border-gray-200 py-6">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="text-gray-400 text-xs leading-relaxed text-center font-jost">This information is for educational purposes and does not constitute medical advice. Yellow fever vaccination is a prescription-only medicine in the UK. Eligibility and suitability are assessed by our GPhC-registered pharmacists during your consultation. Only NaTHNaC-registered vaccination centres are authorised to issue International Certificates of Vaccination or Prophylaxis (ICVP). Information is accurate as of April 2026 and based on current NaTHNaC, WHO, and MHRA guidance.</p>
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
