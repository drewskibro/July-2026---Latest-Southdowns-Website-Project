<!-- ============================================================
     SHARED FOOTER
     ACF: SP_* global options — logo, branches, email, phone,
          social links, booking URL, accreditation badges
     ============================================================ -->
<footer class="relative bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-0">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

      <!-- Logo & About -->
      <div class="lg:col-span-1">
        <div class="mb-6">
          <img src="<?php echo esc_url( sp_logo_url() ); ?>"
               alt="<?php echo esc_attr( sp_pharmacy_name() ); ?>"
               class="h-16 w-auto" />
        </div>
        <p class="text-slate-800 text-base font-semibold font-jost mb-2"><?php echo sp_option( 'sp_footer_tagline', 'Independent. Innovative. Community Focused.' ); ?></p>
        <p class="text-gray-600 text-base leading-relaxed font-jost mb-6"><?php echo sp_option( 'sp_footer_blurb', 'Providing award-winning NHS and private healthcare services across four locations in Hampshire, with a NaTHNaC-registered Yellow Fever Vaccination Centre at Bosmere Pharmacy, Havant.' ); ?></p>
      </div>

      <!-- Our Locations -->
      <div class="lg:col-span-1">
        <h3 class="text-gray-900 text-lg font-semibold mb-6 font-jost">Our Locations</h3>
        <ul class="space-y-4">
          <?php foreach ( sp_branch_order() as $i ) :
            $branch = sp_branch( $i );
            // Footer shows the full pharmacy name for Rowlands Castle.
            $footer_branch_name = ( $branch['name'] === 'Rowlands Castle' ) ? 'Rowlands Castle Pharmacy' : $branch['name'];
          ?>
          <li>
            <a href="<?php echo esc_url( $branch['maps_url'] ); ?>" class="group" target="_blank" rel="noopener noreferrer">
              <div class="text-gray-900 font-medium text-base mb-1 group-hover:text-blue-600 transition-colors font-jost">
                <?php echo esc_html( $footer_branch_name ); ?>
              </div>
              <div class="text-gray-500 text-sm font-jost">
                <?php echo esc_html( $branch['address_line1'] . ', ' . $branch['address_line2'] . ', ' . $branch['city'] . ', ' . $branch['postcode'] ); ?>
              </div>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Services -->
      <div class="lg:col-span-1">
        <h3 class="text-gray-900 text-lg font-semibold mb-6 font-jost">Services</h3>
        <ul class="space-y-3">
          <li><a href="<?php echo esc_url( home_url( '/travel-vaccinations/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Travel Vaccinations</a></li>
          <li><a href="<?php echo esc_url( home_url( '/blood-testing/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Blood Testing</a></li>
          <li><a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Weight Loss Programs</a></li>
          <li><a href="<?php echo esc_url( home_url( '/b12-injections/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">B12 Injections</a></li>
          <li><a href="<?php echo esc_url( home_url( '/ear-wax-removal/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Ear Wax Removal</a></li>
        </ul>
      </div>

      <!-- Information & Contact -->
      <div class="lg:col-span-1">
        <h3 class="text-gray-900 text-lg font-semibold mb-6 font-jost">Information</h3>
        <ul class="space-y-3 mb-6">
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">About Us</a></li>
          <li><a href="<?php echo esc_url( home_url( '/book-appointment/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Contact Us</a></li>
          <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Privacy Policy</a></li>
          <li><a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Cookie Policy</a></li>
        </ul>
        <div class="space-y-3">
          <div class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <a href="mailto:<?php echo esc_attr( sp_email() ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">
              <?php echo esc_html( sp_email() ); ?>
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- Footer CTA strip -->
    <div class="border-t border-[#e8e0d8] pt-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="group relative bg-blue-600 hover:bg-blue-700 rounded-2xl p-8 transition-all duration-300 hover:shadow-xl overflow-hidden">
          <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
          <div class="relative z-10">
            <div class="flex items-center gap-4 mb-3">
              <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-white font-jost">Book Appointment</h3>
            </div>
            <p class="text-blue-100 text-base font-jost mb-4">Schedule your visit at any of our 4 Hampshire locations. Same day appointments available.</p>
            <div class="inline-flex items-center gap-2 text-white text-sm font-semibold font-jost group-hover:gap-3 transition-all">
              <span>Book Now</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </div>
          </div>
        </a>

        <a href="#" data-vf-open aria-label="Speak to our AI agent" class="group relative bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-700 hover:from-purple-700 hover:via-purple-800 hover:to-indigo-800 rounded-2xl p-8 transition-all duration-300 hover:shadow-2xl overflow-hidden border-2 border-purple-400/30">
          <div class="absolute top-4 right-4 bg-yellow-400 text-purple-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-pulse">INSTANT HELP</div>
          <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
          <div class="relative z-10">
            <div class="flex items-center gap-4 mb-3">
              <div class="relative w-12 h-12 bg-white/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                <div class="absolute inset-0 bg-white/30 rounded-full animate-ping"></div>
                <svg xmlns="http://www.w3.org/2000/svg" class="relative w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-white font-jost">Speak to our AI Agent</h3>
            </div>
            <p class="text-purple-100 text-base font-jost mb-4">Get instant answers 24/7. Skip the phone queue.</p>
            <div class="inline-flex items-center gap-2 bg-white text-purple-700 px-5 py-3 rounded-full text-sm font-bold font-jost group-hover:gap-3 group-hover:shadow-lg transition-all">
              <span>Chat Now</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <!-- Bottom bar -->
  <div class="border-t border-[#e8e0d8] bg-[#fdf9f6]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-gray-900 text-base font-jost text-center md:text-left">
          Copyright &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( sp_pharmacy_name() ); ?> Group. All rights reserved.
        </p>
        <div class="flex items-center gap-6">
          <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="text-gray-900 text-base hover:text-blue-600 transition-colors font-jost">Privacy Policy</a>
          <span class="text-gray-300">|</span>
          <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>" class="text-gray-900 text-base hover:text-blue-600 transition-colors font-jost">Cookie Policy</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
<script>
(function() {
  var badges = document.querySelectorAll('.premium-badge');
  if (!badges.length) return;
  if (!('IntersectionObserver' in window)) {
    badges.forEach(function(el) { el.classList.add('premium-badge-visible'); });
    return;
  }
  var obs = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('premium-badge-visible');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });
  badges.forEach(function(el) { obs.observe(el); });
})();
</script>

<!-- Open the Voiceflow chat from any "Speak to our AI agent" trigger (delegated, future-proof). -->
<script>
(function() {
  function openChat() {
    if (window.voiceflow && window.voiceflow.chat && typeof window.voiceflow.chat.open === 'function') {
      window.voiceflow.chat.open();
      return true;
    }
    return false;
  }
  document.addEventListener('click', function(e) {
    // Explicit triggers (nav + footer buttons): never navigate, just open the chat.
    var btn = e.target.closest('[data-vf-open]');
    if (btn) { e.preventDefault(); openChat(); return; }
    // Dual-CTA "Chat with AI Agent" links: open chat if loaded, else fall back to the /ai-agent/ page.
    var link = e.target.closest('a[href*="/ai-agent"]');
    if (link && openChat()) { e.preventDefault(); }
  });
})();
</script>
</body>
</html>
