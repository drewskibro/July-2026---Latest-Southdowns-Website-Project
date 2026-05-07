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
        <p class="text-gray-600 text-base leading-relaxed font-jost mb-6">
          <?php echo esc_html( sp_option( 'sp_footer_tagline', 'NATHNAC registered Yellow Fever Centre providing comprehensive healthcare services across 4 locations in Hampshire.' ) ); ?>
        </p>
        <div class="flex items-center gap-3">
          <a href="<?php echo esc_url( sp_option( 'sp_social_facebook', '#' ) ); ?>"
             aria-label="Facebook"
             class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          <a href="<?php echo esc_url( sp_option( 'sp_social_twitter', '#' ) ); ?>"
             aria-label="Twitter / X"
             class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-all duration-300 text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Our Locations -->
      <div class="lg:col-span-1">
        <h3 class="text-gray-900 text-lg font-semibold mb-6 font-jost">Our Locations</h3>
        <ul class="space-y-4">
          <?php for ( $i = 1; $i <= 4; $i++ ) :
            $branch = sp_branch( $i );
          ?>
          <li>
            <a href="<?php echo esc_url( $branch['maps_url'] ); ?>" class="group" target="_blank" rel="noopener noreferrer">
              <div class="text-gray-900 font-medium text-base mb-1 group-hover:text-blue-600 transition-colors font-jost">
                <?php echo esc_html( $branch['name'] ); ?>
              </div>
              <div class="text-gray-500 text-sm font-jost">
                <?php echo esc_html( $branch['address_line1'] . ', ' . $branch['address_line2'] . ', ' . $branch['city'] . ', ' . $branch['postcode'] ); ?>
              </div>
            </a>
          </li>
          <?php endfor; ?>
        </ul>
      </div>

      <!-- Services -->
      <div class="lg:col-span-1">
        <h3 class="text-gray-900 text-lg font-semibold mb-6 font-jost">Services</h3>
        <ul class="space-y-3">
          <li><a href="<?php echo esc_url( home_url( '/travel-health/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Travel Vaccinations</a></li>
          <li><a href="<?php echo esc_url( home_url( '/blood-testing/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Blood Testing</a></li>
          <li><a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Weight Loss Programs</a></li>
          <li><a href="<?php echo esc_url( home_url( '/b12-injections/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">B12 Injections</a></li>
          <li><a href="<?php echo esc_url( home_url( '/ear-wax-removal/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Ear Wax Removal</a></li>
          <li><a href="<?php echo esc_url( home_url( '/hair-loss/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Hair Loss Treatment</a></li>
          <li><a href="<?php echo esc_url( home_url( '/smoking-cessation/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Smoking Cessation</a></li>
        </ul>
      </div>

      <!-- Information & Contact -->
      <div class="lg:col-span-1">
        <h3 class="text-gray-900 text-lg font-semibold mb-6 font-jost">Information</h3>
        <ul class="space-y-3 mb-6">
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">About Us</a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">Contact Us</a></li>
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
          <div class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <a href="tel:<?php echo esc_attr( sp_phone_raw() ); ?>" class="text-gray-600 text-base hover:text-blue-600 transition-colors font-jost">
              <?php echo esc_html( sp_phone() ); ?>
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

        <a href="#" class="group relative bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-700 hover:from-purple-700 hover:via-purple-800 hover:to-indigo-800 rounded-2xl p-8 transition-all duration-300 hover:shadow-2xl overflow-hidden border-2 border-purple-400/30">
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
</body>
</html>
