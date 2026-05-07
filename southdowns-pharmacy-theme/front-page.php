<?php
/**
 * Template Name: Home Page
 *
 * Select this template on any page via Page → Template dropdown in the editor.
 * Then set that page as the front page: Settings → Reading → "A static page".
 */
get_header();
$booking_url = sp_booking_url();
$star_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
$stars = str_repeat( $star_svg, 5 );
?>

<!-- ============================================================
     HERO SLIDER
     ============================================================ -->
<section class="relative w-full min-h-[500px] md:min-h-[500px] lg:min-h-[600px] overflow-hidden" id="hero-slider">
  <div class="relative w-full min-h-[500px] md:min-h-[500px] lg:min-h-[600px]">

    <!-- Slide 1: Travel Vaccines -->
    <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 z-10" data-slide="0">
      <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image: url('https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773049303978-0.png');"></div>
      <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
      <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
        <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
          <div class="badge-rule w-8 h-px bg-white/30"></div>
          <span class="badge-text text-white/80 text-xs font-normal tracking-[0.15em] uppercase font-jost">4 Hampshire Locations &middot; Same-Day</span>
        </div>
        <h1 class="text-white text-3xl font-semibold tracking-tight leading-tight mb-4 font-jost" style="line-height:1.2;"><span class="serif-accent">Same-day</span> vaccine &amp; blood test appointments</h1>
        <p class="text-white text-base font-normal leading-relaxed mb-5 font-jost">Book your vaccine or blood test appointment today online or call our friendly team for advice and more information.</p>
        <div class="mb-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white text-sm font-medium bg-transparent border-2 border-white/40 px-5 py-2.5 rounded-full hover:bg-white/10 transition-colors font-jost">
            Book Appointment
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
        <p class="text-white/90 text-sm font-normal leading-relaxed font-jost">Same day appointments typically available—book early to avoid disappointment.</p>
      </div>
      <div class="hidden md:flex">
        <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
          <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
            <div class="badge-rule w-10 h-px bg-white/30"></div>
            <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost">4 Hampshire Locations &middot; Same-Day Appointments</span>
          </div>
          <h1 class="text-white text-4xl lg:text-[50px] font-semibold tracking-tight leading-tight mb-6 font-jost" style="line-height:1.1;"><span class="serif-accent">Same-day</span> vaccine &amp; blood test appointments</h1>
          <p class="text-white text-lg lg:text-xl font-normal leading-relaxed mb-6 font-jost">Book your vaccine or blood test appointment today online or call our friendly team for advice and more information.</p>
          <div class="mb-6">
            <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white text-base font-medium bg-transparent border-2 border-white/30 px-6 py-3 rounded-full hover:bg-white/10 transition-colors font-jost">
              Book Appointment
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
          <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/90 text-sm font-medium font-jost">
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> All Vaccines in Stock</span>
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Same-Day Available</span>
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Expert Pharmacists</span>
          </div>
        </div>
        <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center" style="background-image:url('https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773049303978-0.png');"></div>
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
    </div>

    <!-- Slide 2: Weight Loss -->
    <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0" data-slide="1">
      <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image:url('https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773078227843-0.png');"></div>
      <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
      <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
        <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
          <div class="badge-rule w-8 h-px bg-white/30"></div>
          <span class="badge-text text-white/80 text-xs font-normal tracking-[0.15em] uppercase font-jost">GPhC Registered &middot; Clinically Supervised</span>
        </div>
        <h1 class="text-white text-3xl font-semibold tracking-tight leading-tight mb-4 font-jost" style="line-height:1.2;">Medical <span class="serif-accent">weight loss</span> programme</h1>
        <p class="text-white text-base font-normal leading-relaxed mb-5 font-jost">Achieve your weight loss goals with our clinically supervised programme. GPhC registered pharmacists providing safe, effective treatments.</p>
        <div class="mb-4">
          <a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>" class="inline-flex items-center gap-2 text-white text-sm font-medium bg-transparent border-2 border-white/40 px-5 py-2.5 rounded-full hover:bg-white/10 transition-colors font-jost">
            Learn More
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
        <p class="text-white/90 text-sm font-normal leading-relaxed font-jost">Average 15-20kg weight loss with monthly check-ins included.</p>
      </div>
      <div class="hidden md:flex">
        <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
          <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
            <div class="badge-rule w-10 h-px bg-white/30"></div>
            <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost">GPhC Registered &middot; Clinically Supervised</span>
          </div>
          <h1 class="text-white text-4xl lg:text-[50px] font-semibold tracking-tight leading-tight mb-6 font-jost" style="line-height:1.1;">Medical <span class="serif-accent">weight loss</span> programme</h1>
          <p class="text-white text-lg lg:text-xl font-normal leading-relaxed mb-6 font-jost">Achieve your weight loss goals with our clinically supervised programme. GPhC registered pharmacists providing safe, effective treatments.</p>
          <div class="mb-6">
            <a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>" class="inline-flex items-center gap-2 text-white text-base font-medium bg-transparent border-2 border-white/30 px-6 py-3 rounded-full hover:bg-white/10 transition-colors font-jost">
              Learn More
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
          <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/90 text-sm font-medium font-jost">
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> GLP-1 Treatments</span>
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Monthly Check-ins</span>
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Free Consultation</span>
          </div>
        </div>
        <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover" style="background-image:url('https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773078227843-0.png');background-position:85% center;"></div>
      </div>
    </div>

    <!-- Slide 3: Blood Tests -->
    <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0" data-slide="2">
      <div class="md:hidden absolute inset-0 bg-cover bg-center" style="background-image:url('https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773078227870-1.png');"></div>
      <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
      <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
        <div class="premium-badge flex items-center justify-start gap-4 mb-4 self-start">
          <div class="badge-rule w-8 h-px bg-white/30"></div>
          <span class="badge-text text-white/80 text-xs font-normal tracking-[0.15em] uppercase font-jost">Results in 24&ndash;48 Hours</span>
        </div>
        <h1 class="text-white text-3xl font-semibold tracking-tight leading-tight mb-4 font-jost" style="line-height:1.2;"><span class="serif-accent">Comprehensive</span> blood testing</h1>
        <p class="text-white text-base font-normal leading-relaxed mb-5 font-jost">Same day blood test appointments available across 4 Hampshire locations. Vitamin B12 deficiency testing and full health screening.</p>
        <div class="mb-4">
          <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white text-sm font-medium bg-transparent border-2 border-white/40 px-5 py-2.5 rounded-full hover:bg-white/10 transition-colors font-jost">
            Book Blood Test
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
        <p class="text-white/90 text-sm font-normal leading-relaxed font-jost">Results typically available within 24-48 hours.</p>
      </div>
      <div class="hidden md:flex">
        <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
          <div class="premium-badge flex items-center justify-start gap-4 mb-6 self-start">
            <div class="badge-rule w-10 h-px bg-white/30"></div>
            <span class="badge-text text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost">Results in 24&ndash;48 Hours &middot; 4 Locations</span>
          </div>
          <h1 class="text-white text-4xl lg:text-[50px] font-semibold tracking-tight leading-tight mb-6 font-jost" style="line-height:1.1;"><span class="serif-accent">Comprehensive</span> blood testing</h1>
          <p class="text-white text-lg lg:text-xl font-normal leading-relaxed mb-6 font-jost">Same day blood test appointments available across 4 Hampshire locations. Vitamin B12 deficiency testing and full health screening.</p>
          <div class="mb-6">
            <a href="<?php echo esc_url( $booking_url ); ?>" class="inline-flex items-center gap-2 text-white text-base font-medium bg-transparent border-2 border-white/30 px-6 py-3 rounded-full hover:bg-white/10 transition-colors font-jost">
              Book Blood Test
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
          <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/90 text-sm font-medium font-jost">
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Same-Day Available</span>
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> 24&ndash;48hr Results</span>
            <span class="flex items-center gap-1.5"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> B12 &amp; Full Screening</span>
          </div>
        </div>
        <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover" style="background-image:url('https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773078227870-1.png');background-position:85% center;"></div>
      </div>
    </div>

  </div>

  <!-- Navigation Dots -->
  <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex gap-3">
    <button class="slider-dot w-3 h-3 rounded-full bg-white transition-all duration-300" data-slide="0" aria-label="Go to slide 1"></button>
    <button class="slider-dot w-3 h-3 rounded-full bg-white/50 transition-all duration-300" data-slide="1" aria-label="Go to slide 2"></button>
    <button class="slider-dot w-3 h-3 rounded-full bg-white/50 transition-all duration-300" data-slide="2" aria-label="Go to slide 3"></button>
  </div>

  <!-- Prev/Next Arrows -->
  <button class="slider-prev absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-white/40 transition-colors" aria-label="Previous slide">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
  </button>
  <button class="slider-next absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center hover:bg-white/40 transition-colors" aria-label="Next slide">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
  </button>
</section>

<script>
(function() {
  const slides = document.querySelectorAll('.hero-slide');
  const dots   = document.querySelectorAll('.slider-dot');
  const prev   = document.querySelector('.slider-prev');
  const next   = document.querySelector('.slider-next');
  let current = 0, timer;
  function go(i) {
    if (i < 0) i = slides.length - 1;
    if (i >= slides.length) i = 0;
    slides.forEach((s,n) => { s.classList.toggle('opacity-100', n===i); s.classList.toggle('z-10', n===i); s.classList.toggle('opacity-0', n!==i); s.classList.toggle('z-0', n!==i); });
    dots.forEach((d,n)   => { d.classList.toggle('bg-white', n===i); d.classList.toggle('bg-white/50', n!==i); });
    current = i;
  }
  function reset() { clearInterval(timer); timer = setInterval(() => go(current+1), 5000); }
  dots.forEach(d => d.addEventListener('click', () => { go(parseInt(d.dataset.slide)); reset(); }));
  prev.addEventListener('click', () => { go(current-1); reset(); });
  next.addEventListener('click', () => { go(current+1); reset(); });
  reset();
})();
</script>

<!-- ============================================================
     MOST POPULAR TREATMENTS
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-10 md:mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Trusted by thousands across Hampshire</span>
      </div>
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-800 mb-6 font-jost">Our Most Popular Treatments</h2>
      <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-jost">Comprehensive healthcare solutions tailored to your needs, delivered with care at our Hampshire locations.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
      <?php
      $treatments = [
        ['Weight Loss',       home_url('/weight-loss/'),    'https://c.animaapp.com/mkl3y6t51Gb5OV/img/uploaded-asset-1769944273995-0.jpeg', 'Weight loss treatment at Southdowns Pharmacy'],
        ['Travel Health',     home_url('/travel-health/'),  'https://c.animaapp.com/mkl3y6t51Gb5OV/img/uploaded-asset-1769944274005-1.jpeg', 'Travel health vaccinations at Southdowns Pharmacy'],
        ['Ear Wax Removal',   home_url('/ear-wax/'),        'https://c.animaapp.com/mkl3y6t51Gb5OV/img/uploaded-asset-1769944517596-0.jpeg', 'Ear wax removal service at Southdowns Pharmacy'],
        ['Hair Loss',         home_url('/hair-loss/'),      'https://c.animaapp.com/mkl3y6t51Gb5OV/img/uploaded-asset-1769944274011-2.jpeg', 'Hair loss treatment at Southdowns Pharmacy'],
        ['Smoking Cessation', home_url('/smoking-cessation/'), 'https://c.animaapp.com/mkl3y6t51Gb5OV/img/uploaded-asset-1769944583782-0.jpeg', 'Smoking cessation support at Southdowns Pharmacy'],
      ];
      foreach ( $treatments as $t ) : ?>
      <a href="<?php echo esc_url( $t[1] ); ?>" class="group block">
        <div class="relative overflow-hidden rounded-2xl shadow-lg aspect-[3/4]">
          <img alt="<?php echo esc_attr( $t[3] ); ?>" src="<?php echo esc_url( $t[2] ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
          <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/40 transition-colors duration-300 flex items-center justify-center">
            <span class="text-white text-sm font-medium px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 border border-white/30">View Details</span>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-4 md:p-5">
            <h3 class="text-white text-lg md:text-xl font-semibold font-jost mb-1"><?php echo esc_html( $t[0] ); ?></h3>
            <div class="w-8 h-0.5 bg-blue-400 group-hover:w-12 transition-all duration-300"></div>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     SEARCH VACCINES BY DESTINATION
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-10 md:mb-14">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <span class="badge-numeral text-4xl font-bold text-white font-jost leading-none">4</span>
        <div class="badge-divider w-px h-8 bg-white/15"></div>
        <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost">Locations Across Hampshire</span>
      </div>
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-semibold tracking-tight text-white mb-6 font-jost">Search Vaccines by<br class="hidden md:block" /> Destination</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">At <?php echo esc_html( sp_pharmacy_name() ); ?>, we provide expert travel health services across Hampshire. Find the vaccines you need for your next adventure.</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10 md:mb-14">
      <?php
      $stats = [
        ['4',    'Hampshire Locations'],
        ['20+',  'Vaccines Available'],
        ['Same', 'Day Appointments'],
        ['5★',   'Rated Service'],
      ];
      foreach ( $stats as $s ) : ?>
      <div class="text-center p-6 md:p-8 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-colors">
        <div class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2 font-jost"><?php echo esc_html( $s[0] ); ?></div>
        <div class="text-sm md:text-base text-blue-100 font-medium"><?php echo esc_html( $s[1] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Destination Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 md:gap-8">
      <?php
      $destinations = [
        ['Africa',                  'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Africa.webp',                      '5 recommended vaccines'],
        ['Australasia & Pacific',   'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Australasia-Pacific.webp',         '4 recommended vaccines'],
        ['Caribbean',               'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Carribbean.webp',                  '4 recommended vaccines'],
        ['Central America',         'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Central-America.webp',             '5 recommended vaccines'],
        ['Central Asia',            'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Central-Asia.webp',                '7 recommended vaccines'],
        ['East Asia',               'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/East-Asia.webp',                   '6 recommended vaccines'],
        ['Europe &amp; Russia',     'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Europe-Russia.webp',               '5 recommended vaccines'],
        ['Middle East',             'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Middle-East.webp',                 '5 recommended vaccines'],
        ['North America',           'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/North-America.webp',               '4 recommended vaccines'],
        ['South America &amp; Antarctica', 'https://c.animaapp.com/mmkd7a1dRSnHAj/assets/South-America-Antartica.webp', '6 recommended vaccines'],
      ];
      foreach ( $destinations as $d ) : ?>
      <a href="<?php echo esc_url( home_url( '/travel-health/' ) ); ?>" class="group block">
        <div class="relative overflow-hidden rounded-2xl mb-4 shadow-lg">
          <img alt="<?php echo esc_attr( $d[0] ); ?>" src="<?php echo esc_url( $d[1] ); ?>" class="aspect-[4/3] w-full object-cover transition-transform duration-300 group-hover:scale-110" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>
        <h3 class="text-white text-xl md:text-2xl font-semibold mb-1 font-jost group-hover:text-blue-200 transition-colors"><?php echo $d[0]; ?></h3>
        <p class="text-blue-100 text-base md:text-lg font-normal font-jost"><?php echo esc_html( $d[2] ); ?></p>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     TESTIMONIALS
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-10 md:mb-16">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Trusted by Thousands</span>
      </div>
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-6 font-jost">What Our Patients Say</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-jost">Real experiences from real patients across our Hampshire locations.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php
      $testimonials = [
        ['SJ', 'Sarah Johnson',   'Portsmouth Branch',     '"Excellent service from start to finish. The pharmacist was incredibly knowledgeable about travel vaccines and made me feel completely at ease. Same day appointment was a lifesaver!"'],
        ['MT', 'Michael Thompson','Southsea Branch',       '"The weight loss programme has been life-changing. Professional, supportive, and results-driven. I\'ve lost 18kg in 4 months with their expert guidance."'],
        ['EP', 'Emma Patel',      'Waterlooville Branch',  '"Quick, efficient blood testing service. Results came back within 24 hours and the staff explained everything clearly. Highly recommend for anyone needing health checks."'],
        ['DW', 'David Williams',  'Havant Branch',         '"Fantastic ear wax removal service. Painless procedure and immediate relief. The practitioner was gentle and professional throughout. Worth every penny."'],
        ['RC', 'Rachel Chen',     'Portsmouth Branch',     '"As a frequent traveller, I rely on Southdowns for all my travel health needs. Yellow fever certification was processed immediately. Couldn\'t ask for better service."'],
        ['JM', 'James Mitchell',  'Southsea Branch',       '"The smoking cessation programme helped me quit after 15 years. Supportive team, effective treatment, and ongoing check-ins made all the difference. Smoke-free for 6 months now!"'],
      ];
      foreach ( $testimonials as $t ) : ?>
      <div class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 md:p-8 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
        <div class="flex gap-1 mb-4"><?php echo $stars; ?></div>
        <p class="text-white text-base md:text-lg leading-relaxed mb-6 font-jost italic"><?php echo esc_html( $t[3] ); ?></p>
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-white font-semibold text-lg"><?php echo esc_html( $t[0] ); ?></div>
          <div>
            <div class="text-white font-semibold text-base font-jost"><?php echo esc_html( $t[1] ); ?></div>
            <div class="text-blue-200 text-sm font-jost"><?php echo esc_html( $t[2] ); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Trust Indicators -->
    <div class="mt-12 md:mt-16 flex flex-wrap justify-center items-center gap-8 md:gap-12">
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">4.9/5</div>
        <div class="text-blue-200 text-sm md:text-base font-jost">Average Rating</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">400+</div>
        <div class="text-blue-200 text-sm md:text-base font-jost">5-Star Reviews</div>
      </div>
      <div class="hidden md:block w-px h-12 bg-white/30"></div>
      <div class="text-center">
        <div class="text-white text-3xl md:text-4xl font-bold mb-1 font-jost">10,000+</div>
        <div class="text-blue-200 text-sm md:text-base font-jost">Happy Patients</div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     HEALTH HUB
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 md:mb-14 gap-6">
      <div class="flex-1">
        <div class="premium-badge flex items-center justify-start gap-4 mb-6">
          <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
          <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Expert Advice</span>
        </div>
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-800 font-jost">
          Latest from the <span class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Health Hub</span>
        </h2>
      </div>
      <a href="<?php echo esc_url( home_url( '/health-hub/' ) ); ?>" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-lg transition-colors group">
        View all articles
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php
      $articles = [
        ['https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop', 'Weight Loss', 'Mounjaro vs Wegovy: What the Clinical Trials Actually Show', '"My GP mentioned Wegovy. But my friend lost loads of weight on Mounjaro. Are they the same thing? Should I ask for the other one?...'],
        ['https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=600&h=400&fit=crop', 'Weight Loss', 'Mounjaro Side Effects: What to Expect at Your Monthly Review', "How Southdowns Pharmacy's face-to-face clinical support helps patients across Hampshire manage their weight loss journey with confidence..."],
        ['https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=400&fit=crop', 'Weight Loss', "Why Most Hampshire Patients Wish They'd Started Mounjaro Sooner", 'The weight loss treatment that makes people say "I should have started this sooner" — now available across Hampshire...'],
      ];
      foreach ( $articles as $a ) : ?>
      <a href="<?php echo esc_url( home_url( '/health-hub/' ) ); ?>" class="group block bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="relative overflow-hidden aspect-[3/2]">
          <img src="<?php echo esc_url( $a[0] ); ?>" alt="<?php echo esc_attr( $a[2] ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" />
          <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider"><?php echo esc_html( $a[1] ); ?></span>
        </div>
        <div class="p-6">
          <h3 class="text-xl md:text-2xl font-bold text-slate-800 mb-3 font-jost group-hover:text-blue-600 transition-colors"><?php echo esc_html( $a[2] ); ?></h3>
          <p class="text-slate-600 text-base leading-relaxed mb-4 line-clamp-3"><?php echo esc_html( $a[3] ); ?></p>
          <span class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm group-hover:gap-3 transition-all">Read Article <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     POPULAR VACCINES
     ============================================================ -->
<section class="relative py-16 md:py-24" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <div>
        <h2 class="text-4xl md:text-5xl font-semibold text-white mb-4 font-jost">Popular Vaccines</h2>
        <p class="text-blue-100 text-lg mb-8 font-jost">Find out everything about these popular vaccines we can provide at <?php echo esc_html( sp_pharmacy_name() ); ?>.</p>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <?php
          $vaccines = [
            ['name' => 'Yellow Fever',                       'url' => home_url( '/yellow-fever/' )],
            ['name' => 'Hepatitis A',                        'url' => home_url( '/travel-health/' )],
            ['name' => 'Typhoid',                            'url' => home_url( '/travel-health/' )],
            ['name' => 'Hepatitis B',                        'url' => home_url( '/travel-health/' )],
            ['name' => 'Rabies',                             'url' => home_url( '/travel-health/' )],
            ['name' => 'Cholera',                            'url' => home_url( '/travel-health/' )],
            ['name' => 'Japanese Encephalitis',              'url' => home_url( '/travel-health/' )],
            ['name' => 'Meningitis (ACWY)',                  'url' => home_url( '/travel-health/' )],
            ['name' => 'Tick Borne Encephalitis',            'url' => home_url( '/travel-health/' )],
            ['name' => 'Malaria Tablets',                    'url' => home_url( '/travel-health/' )],
            ['name' => 'MMR (Measles, Mumps & Rubella)',     'url' => home_url( '/travel-health/' )],
            ['name' => 'Dengue Fever (Qdenga)',              'url' => home_url( '/travel-health/' )],
          ];
          foreach ( $vaccines as $v ) : ?>
          <li><a href="<?php echo esc_url( $v['url'] ); ?>" class="group relative flex items-center justify-center min-h-[88px] px-6 pr-12 bg-blue-50 rounded-xl text-blue-900 font-bold text-xl text-center font-jost transition-all duration-300 ease-in-out hover:bg-white hover:-translate-y-0.5 hover:shadow-lg"><span><?php echo esc_html( $v['name'] ); ?></span><svg class="absolute right-5 w-5 h-5 text-blue-400 group-hover:text-blue-700 group-hover:translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a></li>
          <?php endforeach; ?>
        </ul>
        <div class="mb-6">
          <a href="<?php echo esc_url( home_url( '/travel-health/' ) ); ?>" class="inline-flex items-center gap-2 text-white font-semibold text-lg font-jost border-b-2 border-white/40 hover:border-white pb-1 transition-colors">
            View all vaccines
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
        <p class="text-white/80 text-sm font-jost"><strong class="text-white">Vaccine not listed?</strong> We can provide any travel vaccine. <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-white underline hover:text-blue-200">Contact us</a> for more information.</p>
      </div>
      <div class="hidden md:block">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
          <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Couple-at-airport.webp" alt="Travel health at Southdowns Pharmacy" class="w-full h-full object-cover" loading="lazy" />
          <div class="absolute top-6 right-6">
            <img src="https://c.animaapp.com/mmkd7a1dRSnHAj/assets/Roundals-Yellow-Fever-Centre.webp" alt="Yellow Fever Centre" class="w-32 h-32 object-contain drop-shadow-lg" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     PREMIUM PRODUCTS
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-12 md:mb-16">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-white/15"></div>
        <span class="badge-text text-white/70 text-sm font-light tracking-[0.15em] uppercase font-jost">Premium Collection</span>
      </div>
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-6 font-jost">Our Premium Products</h2>
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed font-jost">Discover our exclusive range of premium healthcare products, crafted with excellence.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12">
      <?php
      $products = [
        ['PREMIUM',     'Ear Wax Removal', 'Professional microsuction service for safe and effective ear cleaning',    home_url('/ear-wax/'),        'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773135818122-0.png', 'Ear Wax Removal'],
        ['BEST SELLER', 'B12 Injections',  'Energy boost vitamin therapy to support your wellness journey',            home_url('/b12-injections/'), 'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773135818147-1.png', 'B12 Injections'],
        ['EXCLUSIVE',   'Travel Health',   'Complete vaccination packages for your next adventure',                    home_url('/travel-health/'),  'https://c.animaapp.com/mmkd7a1dRSnHAj/img/uploaded-asset-1773135818166-2.png', 'Travel Health'],
      ];
      foreach ( $products as $p ) : ?>
      <a href="<?php echo esc_url( $p[3] ); ?>" class="group block relative">
        <div class="absolute top-4 right-4 z-20 bg-white/90 text-blue-600 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg"><?php echo esc_html( $p[0] ); ?></div>
        <div class="relative bg-white/10 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/20 transition-all duration-300 hover:bg-white/20 hover:scale-[1.02] shadow-xl">
          <div class="aspect-[4/3] overflow-hidden p-8 bg-white/5">
            <img src="<?php echo esc_url( $p[4] ); ?>" alt="<?php echo esc_attr( $p[5] ); ?>" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl" loading="lazy" />
          </div>
          <div class="p-6 bg-gradient-to-t from-blue-900/40 to-transparent">
            <h3 class="text-white text-xl font-bold mb-2 font-jost"><?php echo esc_html( $p[1] ); ?></h3>
            <p class="text-blue-100 text-base"><?php echo esc_html( $p[2] ); ?></p>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="max-w-4xl mx-auto">
      <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 flex items-start gap-5 hover:bg-white/20 transition-all duration-300">
        <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-white text-lg leading-relaxed"><strong class="font-bold">Product not listed?</strong> <span class="text-blue-100">Don't worry, we can provide a wide range of healthcare products and services.</span> <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-white font-bold hover:text-blue-200 transition-colors underline decoration-2 underline-offset-4">Contact us</a> <span class="text-blue-100">for more information.</span></p>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
