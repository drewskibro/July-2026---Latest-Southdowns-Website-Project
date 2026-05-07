<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'font-jost bg-white text-gray-900 overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>

<?php
$branch_emsworth        = sp_branch( 1 );
$branch_havant          = sp_branch( 2 );
$branch_davies          = sp_branch( 3 );
$branch_rowlands_castle = sp_branch( 4 );

$branches = [
    [ 'data' => $branch_emsworth,        'url' => home_url( '/emsworth/' ) ],
    [ 'data' => $branch_havant,          'url' => home_url( '/bosmere/' ) ],
    [ 'data' => $branch_davies,          'url' => home_url( '/davies/' ) ],
    [ 'data' => $branch_rowlands_castle, 'url' => home_url( '/rowlands-castle/' ) ],
];

$destinations = [
    [ 'name' => 'Thailand',    'flag' => 'th', 'desc' => 'Hep A, Typhoid, Rabies & more', 'url' => home_url( '/destinations/thailand/' ) ],
    [ 'name' => 'India',       'flag' => 'in', 'desc' => 'Hep A, Typhoid, Japanese Enc.',  'url' => home_url( '/destinations/india/' ) ],
    [ 'name' => 'Cape Verde',  'flag' => 'cv', 'desc' => 'Yellow Fever, Hep A, Typhoid',   'url' => home_url( '/destinations/cape-verde/' ) ],
    [ 'name' => 'Kenya',       'flag' => 'ke', 'desc' => 'Yellow Fever, Hep A, Malaria',   'url' => home_url( '/destinations/kenya/' ) ],
];
?>

<!-- ============================================================
     PRIMARY NAVIGATION (Desktop + Mobile)
     ============================================================ -->
<header class="sticky top-0 z-[100] bg-white">

  <!-- Desktop header -->
  <div class="relative bg-white hidden md:flex justify-center z-[9] border-b border-[#e8e0d8] px-5">
    <div class="relative flex max-w-[1393.6px] w-full">

      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center py-3 pr-8">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( sp_pharmacy_name() ); ?>">
          <img src="<?php echo esc_url( sp_logo_url() ); ?>" alt="<?php echo esc_attr( sp_pharmacy_name() ); ?>" class="h-12 lg:h-14 w-auto" />
        </a>
      </div>

      <!-- Right column: Top Menu over Main Menu -->
      <div class="flex-1 flex flex-col justify-end pb-2">

        <!-- Top Menu -->
        <nav aria-label="Top Menu" class="text-[15px] font-light text-zinc-700">
          <ul class="flex items-center justify-end gap-6 py-2">
            <li><a href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>" class="hover:text-blue-600 transition-colors">FAQs</a></li>
            <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="hover:text-blue-600 transition-colors">Blog</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="hover:text-blue-600 transition-colors">Contact Us</a></li>
            <li>
              <button type="button" aria-label="Speak to our AI agent" class="inline-flex items-center gap-2 bg-purple-600 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-purple-700 transition-colors">
                <span class="relative flex items-center justify-center w-4 h-4 flex-shrink-0">
                  <span class="absolute inset-0 rounded-full bg-white/40 animate-ping"></span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="relative w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </span>
                <span>Speak to our AI agent</span>
              </button>
            </li>
          </ul>
        </nav>

        <!-- Main Menu -->
        <nav aria-label="Main Menu" class="text-zinc-800 -mt-1">
          <ul class="flex items-center justify-end">

            <!-- SERVICES dropdown -->
            <li class="dd-parent py-3">
              <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="px-2 py-2 inline-flex items-center hover:text-blue-700 transition-colors">
                <span>Services</span>
                <svg class="dd-chevron" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              </a>
              <div class="mega-dd">
                <div class="mega-dd-content">
                  <div class="mega-dd-section">
                    <div class="mega-dd-title">Travel Health</div>
                    <a href="<?php echo esc_url( home_url( '/travel-health/' ) ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon"><svg viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.125A59.769 59.769 0 0121.485 12 59.768 59.768 0 013.27 20.875L5.999 12zm0 0h7.5"/></svg></div>
                      <div class="mega-dd-link-content"><span class="mega-dd-link-name">Travel Vaccinations</span><span class="mega-dd-link-desc">Destination-specific vaccine plans</span></div>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/yellow-fever/' ) ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon"><svg viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.063 2.522-.187 3.756-.249 2.502-2.13 4.477-4.62 4.79a48.108 48.108 0 01-8.386 0c-2.49-.313-4.371-2.288-4.62-4.79A48.196 48.196 0 013 12c0-1.267.063-2.522.187-3.756.249-2.502 2.13-4.477 4.62-4.79a48.108 48.108 0 018.386 0c2.49.313 4.371 2.288 4.62 4.79.124 1.234.187 2.49.187 3.756z"/></svg></div>
                      <div class="mega-dd-link-content"><span class="mega-dd-link-name">Yellow Fever</span><span class="mega-dd-link-desc">NATHNAC certified centre</span></div>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/blood-tests/' ) ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon"><svg viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25c-3.5 4.5-6 7.875-6 11.25a6 6 0 0012 0c0-3.375-2.5-6.75-6-11.25z"/></svg></div>
                      <div class="mega-dd-link-content"><span class="mega-dd-link-name">Blood Tests</span><span class="mega-dd-link-desc">Results within 24–48 hours</span></div>
                    </a>
                  </div>
                  <div class="mega-dd-section">
                    <div class="mega-dd-title">Specialist Care</div>
                    <a href="<?php echo esc_url( home_url( '/ear-wax-removal/' ) ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon"><svg viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396.234-.847 1.058-1.354 1.938-1.354H6.75z"/></svg></div>
                      <div class="mega-dd-link-content"><span class="mega-dd-link-name">Ear Wax Removal</span><span class="mega-dd-link-desc">Professional microsuction</span></div>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/health-wellbeing/' ) ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon"><svg viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg></div>
                      <div class="mega-dd-link-content"><span class="mega-dd-link-name">Health &amp; Wellbeing</span><span class="mega-dd-link-desc">Blood pressure, diabetes &amp; more</span></div>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon"><svg viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                      <div class="mega-dd-link-content"><span class="mega-dd-link-name">Weight Loss</span><span class="mega-dd-link-desc">Clinically supervised programmes</span></div>
                    </a>
                  </div>
                  <div class="mega-dd-featured">
                    <div class="mega-dd-featured-badge">Most Popular</div>
                    <h5>Medical Weight Loss</h5>
                    <p>GLP-1 treatments supplied same day from our Hampshire pharmacies.</p>
                    <div class="mega-dd-featured-trust">
                      <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> GPhC-registered pharmacists</span>
                      <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> Free initial consultation</span>
                      <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> No GP referral needed</span>
                    </div>
                    <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="mega-dd-featured-btn">Book Free Consultation
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
                    </a>
                  </div>
                </div>
              </div>
            </li>

            <!-- LOCATIONS dropdown -->
            <li class="dd-parent py-3">
              <a href="<?php echo esc_url( home_url( '/locations/' ) ); ?>" class="px-2 py-2 inline-flex items-center hover:text-blue-700 transition-colors">
                <span>Locations</span>
                <svg class="dd-chevron" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              </a>
              <div class="mega-dd mega-dd-locations">
                <div class="mega-dd-content">
                  <div class="mega-dd-section">
                    <div class="mega-dd-title">Our Branches</div>
                    <?php foreach ( $branches as $b ) :
                        $name     = $b['data']['name'] ?? '';
                        $line1    = $b['data']['address_line1'] ?? '';
                        $postcode = $b['data']['postcode'] ?? '';
                        $desc     = trim( $line1 . ( $postcode ? ', ' . $postcode : '' ) );
                    ?>
                    <a href="<?php echo esc_url( $b['url'] ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon">
                        <svg viewBox="0 0 24 24" stroke-width="1.8">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                      </div>
                      <div class="mega-dd-link-content">
                        <span class="mega-dd-link-name"><?php echo esc_html( $name ); ?></span>
                        <span class="mega-dd-link-desc"><?php echo esc_html( $desc ); ?></span>
                      </div>
                    </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </li>

            <!-- DESTINATIONS dropdown -->
            <li class="dd-parent py-3">
              <a href="<?php echo esc_url( home_url( '/destinations/' ) ); ?>" class="px-2 py-2 inline-flex items-center hover:text-blue-700 transition-colors">
                <span>Destinations</span>
                <svg class="dd-chevron" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              </a>
              <div class="mega-dd mega-dd-locations">
                <div class="mega-dd-content">
                  <div class="mega-dd-section">
                    <div class="mega-dd-title">Top Destinations</div>
                    <?php foreach ( $destinations as $d ) : ?>
                    <a href="<?php echo esc_url( $d['url'] ); ?>" class="mega-dd-link">
                      <div class="mega-dd-link-icon" style="padding:0;overflow:hidden;">
                        <img src="https://flagcdn.com/w40/<?php echo esc_attr( $d['flag'] ); ?>.png" alt="<?php echo esc_attr( $d['name'] ); ?> flag" style="width:100%;height:100%;object-fit:cover;border-radius:9px;" />
                      </div>
                      <div class="mega-dd-link-content">
                        <span class="mega-dd-link-name"><?php echo esc_html( $d['name'] ); ?></span>
                        <span class="mega-dd-link-desc"><?php echo esc_html( $d['desc'] ); ?></span>
                      </div>
                    </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </li>

            <!-- PRICING (flat) -->
            <li class="py-3"><a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>" class="px-2 py-2 inline-block hover:text-blue-700 transition-colors">Pricing</a></li>

            <!-- BOOK APPOINTMENT CTA -->
            <li class="py-3 ml-2">
              <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-800 text-white text-sm font-medium px-7 py-3 rounded-full transition-colors">
                Book Appointment
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Mobile header -->
  <div class="relative bg-white flex justify-center z-[99999] border-b border-[#e8e0d8] p-[5px] md:hidden">
    <div class="relative flex items-center w-full">

      <!-- Hamburger (left) -->
      <div class="w-3/12 flex items-center justify-start">
        <button type="button" id="mob-menu-btn" aria-label="Open menu" aria-expanded="false" aria-controls="mob-drawer" class="text-white text-2xl bg-blue-600 hover:bg-blue-700 transition-colors px-5 py-[15px] rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>

      <!-- Logo (centre) -->
      <div class="w-6/12 flex items-center justify-center">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( sp_pharmacy_name() ); ?>">
          <img alt="<?php echo esc_attr( sp_pharmacy_name() ); ?>" src="<?php echo esc_url( sp_logo_url() ); ?>" class="w-[70px] h-auto" />
        </a>
      </div>

      <!-- Book button (right) -->
      <div class="w-3/12 flex items-center justify-end">
        <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-2 rounded-full transition-colors">Book</a>
      </div>
    </div>
  </div>

  <!-- Mobile drawer -->
  <div id="mob-drawer" class="mob-drawer md:hidden bg-gray-50 border-b border-stone-300">
    <ul class="font-jost">

      <!-- Services accordion -->
      <li class="border-b border-stone-200">
        <div class="mob-dd-toggle flex justify-between items-center py-4 px-[22.5px] text-zinc-800 font-medium">
          <span>Services</span>
          <svg class="mob-dd-arrow" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </div>
        <div class="mob-dd-sub">
          <a href="<?php echo esc_url( home_url( '/travel-health/' ) ); ?>">Travel Vaccinations</a>
          <a href="<?php echo esc_url( home_url( '/yellow-fever/' ) ); ?>">Yellow Fever</a>
          <a href="<?php echo esc_url( home_url( '/blood-tests/' ) ); ?>">Blood Tests</a>
          <a href="<?php echo esc_url( home_url( '/ear-wax-removal/' ) ); ?>">Ear Wax Removal</a>
          <a href="<?php echo esc_url( home_url( '/health-wellbeing/' ) ); ?>">Health &amp; Wellbeing</a>
          <a href="<?php echo esc_url( home_url( '/weight-loss/' ) ); ?>">Weight Loss</a>
        </div>
      </li>

      <!-- Locations accordion -->
      <li class="border-b border-stone-200">
        <div class="mob-dd-toggle flex justify-between items-center py-4 px-[22.5px] text-zinc-800 font-medium">
          <span>Locations</span>
          <svg class="mob-dd-arrow" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </div>
        <div class="mob-dd-sub">
          <?php foreach ( $branches as $b ) : ?>
          <a href="<?php echo esc_url( $b['url'] ); ?>"><?php echo esc_html( $b['data']['name'] ?? '' ); ?></a>
          <?php endforeach; ?>
        </div>
      </li>

      <!-- Destinations accordion -->
      <li class="border-b border-stone-200">
        <div class="mob-dd-toggle flex justify-between items-center py-4 px-[22.5px] text-zinc-800 font-medium">
          <span>Destinations</span>
          <svg class="mob-dd-arrow" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </div>
        <div class="mob-dd-sub">
          <?php foreach ( $destinations as $d ) : ?>
          <a href="<?php echo esc_url( $d['url'] ); ?>" style="display:flex;align-items:center;gap:8px;">
            <img src="https://flagcdn.com/w20/<?php echo esc_attr( $d['flag'] ); ?>.png" alt="<?php echo esc_attr( $d['name'] ); ?>" style="width:20px;height:14px;border-radius:2px;" />
            <?php echo esc_html( $d['name'] ); ?>
          </a>
          <?php endforeach; ?>
        </div>
      </li>

      <!-- Flat links -->
      <li class="border-b border-stone-200"><a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>" class="block py-4 px-[22.5px] text-zinc-800 font-medium hover:text-blue-700">Pricing</a></li>
      <li class="border-b border-stone-200"><a href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>" class="block py-4 px-[22.5px] text-zinc-800 font-medium hover:text-blue-700">FAQs</a></li>
      <li class="border-b border-stone-200"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="block py-4 px-[22.5px] text-zinc-800 font-medium hover:text-blue-700">Blog</a></li>
      <li class="border-b border-stone-200"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="block py-4 px-[22.5px] text-zinc-800 font-medium hover:text-blue-700">Contact Us</a></li>

      <!-- CTAs -->
      <li class="px-[22.5px] py-4 flex flex-col gap-3">
        <button type="button" class="inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-4 py-3 rounded-full transition-colors">
          <span class="relative flex items-center justify-center w-4 h-4 flex-shrink-0">
            <span class="absolute inset-0 rounded-full bg-white/40 animate-ping"></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="relative w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          </span>
          Speak to our AI agent
        </button>
        <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-800 text-white text-sm font-semibold px-4 py-3 rounded-full transition-colors">Book Appointment</a>
      </li>
    </ul>
  </div>
</header>

<script>
(function() {
  // Mobile drawer
  var btn    = document.getElementById('mob-menu-btn');
  var drawer = document.getElementById('mob-drawer');
  if ( btn && drawer ) {
    btn.addEventListener('click', function() {
      var isOpen = drawer.classList.toggle('open');
      btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  // Mobile accordion toggles
  document.querySelectorAll('.mob-dd-toggle').forEach(function(t) {
    t.addEventListener('click', function() {
      this.classList.toggle('active');
      var sub = this.nextElementSibling;
      if ( sub ) sub.classList.toggle('open');
    });
  });
})();
</script>
