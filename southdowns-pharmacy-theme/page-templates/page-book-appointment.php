<?php
/**
 * Template Name: Book Appointment
 *
 * Booking page — embeds the Amelia step booking form, followed by the branch
 * locations: an accordion on mobile (today's hours, phone, address, and a
 * "how to get there" dropdown) and image cards on desktop.
 *
 * Setup: create a Page titled "Book Appointment" with the slug
 * "book-appointment", then assign this template via Page → Template.
 *
 * Every "Book Appointment", "Contact Us" and "Pricing" CTA across the theme
 * hardlinks here via sp_booking_url() (see functions.php).
 */
get_header();

// Today, in the site's timezone.
$sp_today_name = current_time( 'l' );        // e.g. "Wednesday"
$sp_dow        = (int) current_time( 'N' );  // 1 (Mon) .. 7 (Sun)

// Branch number → branch page URL.
$sp_branch_links = [
    1 => home_url( '/emsworth/' ),
    2 => home_url( '/bosmere/' ),
    3 => home_url( '/davies/' ),
    4 => home_url( '/rowlands-pharmacy/' ),
];

// "How to get there" copy per branch — moved over from the branch page templates.
$sp_transport = [
    1 => [
        'car'   => 'Convenient access from the A259 coast road and the A27 Emsworth junction. Free public car parks in North Street and Queen Street are just minutes away.',
        'bus'   => 'The Stagecoach Coastliner runs frequently through Emsworth town centre along the A259, connecting Portsmouth and Chichester. Stops are within easy walking distance of the pharmacy.',
        'train' => 'Emsworth Station (Southern West Coastway line) is just a 5-minute walk from the pharmacy. Havant Station provides additional connections and is approximately 3.5 miles away.',
    ],
    2 => [
        'car'   => 'Easily accessible from the A27 and A3(M) Havant interchange. Large free car park directly outside the pharmacy.',
        'bus'   => 'Stagecoach bus routes serve Havant town centre with stops close to Solent Road. The town\'s central bus interchange is nearby.',
        'train' => 'Bedhampton is the closest station (~555m, 7 min walk). Havant Station is approx 860m away (~11 min walk). Both are served by South Western Railway and Southern.',
    ],
    3 => [
        'car'   => 'Accessible from the A27 via the B2149 Park Road South into Havant town centre. West Street is in the heart of the town. Paid car parks are available at Prince George Street, East Street, and Bulbeck Road — all within 5 minutes\' walk.',
        'bus'   => 'Havant bus station is adjacent to the Meridian Shopping Centre, a short walk from the pharmacy. Stagecoach South operates frequent services to Portsmouth, Hayling Island, Waterlooville, Emsworth, and Chichester.',
        'train' => 'Havant railway station is served by South Western Railway and Southern, with direct services to London Waterloo, Portsmouth, Brighton, and Southampton. Davies Pharmacy on West Street is a 5-minute walk from the station exit.',
    ],
    4 => [
        'car'   => 'Rowlands Castle is easily reached from junction 2 of the A3(M). Take the B2149 south into the village — the pharmacy is on The Green at the heart of the village.',
        'bus'   => 'Route 27 (Stagecoach South) is the main bus serving Rowlands Castle, running between Emsworth and Havant and stopping directly at The Green. Bus service to the village is limited, so the train station is often the more reliable option.',
        'train' => 'Rowlands Castle station is on Bowes Hill, served by South Western Railway. The pharmacy on The Green is a 2–3 minute walk from the station exit.',
    ],
];
?>

<style>
  .loc-acc-panel { max-height: 0; overflow: hidden; transition: max-height .35s ease; }
  .loc-acc.open .loc-acc-panel { max-height: 1200px; }
  .loc-acc-chevron { transition: transform .3s ease; }
  .loc-acc.open .loc-acc-chevron { transform: rotate(180deg); }
</style>

<!-- ============================================================
     BREADCRUMB
     ============================================================ -->
<div class="bg-gray-50 border-b border-gray-200 px-4 md:px-8 lg:px-12 py-3">
  <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm font-jost">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-blue-600 hover:text-blue-800 transition-colors">Home</a>
    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span class="text-gray-800 font-medium">Book Appointment</span>
  </div>
</div>

<!-- ============================================================
     BOOK APPOINTMENT — Amelia step booking (all locations & services)
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <div class="text-center mb-8 md:mb-10">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'ba_hero_eyebrow', 'Book Online &middot; Same-Day Availability' ); ?></span>
      </div>
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-800 mb-6 font-jost"><?php echo sp_field( 'ba_hero_heading', 'Book Your Appointment' ); ?></h1>
      <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'ba_hero_intro', 'Choose your location, service, and time across our Hampshire branches. It only takes a minute &mdash; no GP referral needed for most services.' ); ?></p>
    </div>

    <?php
    // Optional editor intro copy — renders only if the page has body content.
    while ( have_posts() ) : the_post();
      if ( trim( get_the_content() ) !== '' ) :
        ?>
        <div class="prose prose-slate max-w-3xl mx-auto mb-10 text-slate-600 font-jost">
          <?php the_content(); ?>
        </div>
        <?php
      endif;
    endwhile;
    ?>

    <?php echo do_shortcode( '[ameliastepbooking layout=2 show=location,category,service,employee,datetime,info]' ); ?>

  </div>
</section>

<!-- ============================================================
     OUR LOCATIONS — accordion on mobile, image cards on desktop
     ============================================================ -->
<section class="py-14 md:py-20 bg-white border-t border-[#e8e0d8]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-8 md:mb-12">
      <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-800 mb-3 font-jost"><?php echo sp_field( 'ba_loc_heading', 'Our Locations' ); ?></h2>
      <p class="text-slate-500 font-jost"><?php echo sp_field( 'ba_loc_intro', 'Opening hours, contact details and directions for our four Hampshire branches.' ); ?></p>
    </div>

    <!-- Mobile: accordion -->
    <div class="md:hidden space-y-4">
      <?php foreach ( sp_branch_order() as $i ) :
        $b  = sp_branch( $i );
        $tr = $sp_transport[ $i ] ?? [ 'car' => '', 'bus' => '', 'train' => '' ];

        // Today's opening hours.
        if ( $sp_dow <= 5 ) {
            $h = $b['hours_weekday'];
        } elseif ( $sp_dow === 6 ) {
            $h = $b['hours_saturday'];
        } else {
            $h = $b['hours_sunday'];
        }
        if ( $h ) {
            $hp            = explode( ': ', $h, 2 );
            $today_display = esc_html( $sp_today_name ) . ' &middot; ' . esc_html( trim( end( $hp ) ) );
        } else {
            $today_display = esc_html( $sp_today_name ) . ' &middot; Closed';
        }

        $short_addr = trim( $b['address_line1'] . ( $b['postcode'] ? ', ' . $b['postcode'] : '' ), ', ' );
        $panel_id   = 'loc-panel-' . $i;
      ?>
      <div class="loc-acc border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">

        <button type="button" class="loc-acc-btn w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-slate-50 transition-colors" aria-expanded="false" aria-controls="<?php echo esc_attr( $panel_id ); ?>">
          <span class="min-w-0">
            <span class="block text-lg font-bold text-slate-800 font-jost"><?php echo esc_html( $b['name'] ); ?></span>
            <span class="flex items-center gap-1.5 text-sm font-medium text-blue-700 font-jost mt-0.5">
              <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
              <?php echo $today_display; ?>
            </span>
          </span>
          <svg class="loc-acc-chevron w-5 h-5 text-blue-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </button>

        <div class="px-5 pb-4 space-y-1.5">
          <?php if ( ! empty( $b['phone'] ) ) : ?>
          <div class="flex items-center gap-2 text-sm text-gray-600 font-jost">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $b['phone'] ) ); ?>" class="hover:text-blue-600 transition-colors"><?php echo esc_html( $b['phone'] ); ?></a>
          </div>
          <?php endif; ?>
          <?php if ( $short_addr ) : ?>
          <div class="flex items-start gap-2 text-sm text-gray-600 font-jost">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span><?php echo esc_html( $short_addr ); ?></span>
          </div>
          <?php endif; ?>
        </div>

        <div id="<?php echo esc_attr( $panel_id ); ?>" class="loc-acc-panel">
          <div class="px-5 pb-5 pt-4 border-t border-gray-100">
            <h3 class="text-xs font-bold uppercase tracking-[0.08em] text-blue-900 mb-3 font-jost">How to Get There</h3>
            <div class="space-y-3">

              <?php if ( ! empty( $tr['car'] ) ) : ?>
              <div class="flex items-start gap-3">
                <span class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 17a2 2 0 1 0 0 .01M19 17a2 2 0 1 0 0 .01M5 17l1.5-6.5A2 2 0 0 1 8.4 9h7.2a2 2 0 0 1 1.9 1.5L19 17M3 13h18"/></svg>
                </span>
                <div>
                  <span class="block text-sm font-semibold text-slate-800 font-jost mb-0.5">By Car</span>
                  <span class="block text-sm text-gray-600 font-jost leading-relaxed"><?php echo esc_html( $tr['car'] ); ?></span>
                </div>
              </div>
              <?php endif; ?>

              <?php if ( ! empty( $tr['bus'] ) ) : ?>
              <div class="flex items-start gap-3">
                <span class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="14" rx="3"/><path d="M4 11h16M8 17v3m8-3v3"/></svg>
                </span>
                <div>
                  <span class="block text-sm font-semibold text-slate-800 font-jost mb-0.5">By Bus</span>
                  <span class="block text-sm text-gray-600 font-jost leading-relaxed"><?php echo esc_html( $tr['bus'] ); ?></span>
                </div>
              </div>
              <?php endif; ?>

              <?php if ( ! empty( $tr['train'] ) ) : ?>
              <div class="flex items-start gap-3">
                <span class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="13" rx="3"/><path d="M5 11h14M9 20l-1.5 2m9-2l1.5 2"/></svg>
                </span>
                <div>
                  <span class="block text-sm font-semibold text-slate-800 font-jost mb-0.5">By Train</span>
                  <span class="block text-sm text-gray-600 font-jost leading-relaxed"><?php echo esc_html( $tr['train'] ); ?></span>
                </div>
              </div>
              <?php endif; ?>

            </div>
          </div>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

    <!-- Desktop: image cards -->
    <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ( sp_branch_order() as $i ) :
        $b    = sp_branch( $i );
        $url  = $sp_branch_links[ $i ] ?? home_url( '/' );
        $addr = implode( ', ', array_filter( [ $b['address_line1'], $b['address_line2'], $b['postcode'] ] ) );
      ?>
      <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b['name'] ); ?> pharmacy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <h3 class="text-white text-xl font-bold font-jost"><?php echo esc_html( $b['name'] ); ?></h3>
          </div>
        </div>
        <div class="p-5 flex flex-col flex-1">
          <?php if ( $addr ) : ?>
          <div class="flex items-start gap-2 mb-2">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span class="text-gray-600 text-sm font-jost"><?php echo esc_html( $addr ); ?></span>
          </div>
          <?php endif; ?>
          <div class="flex items-start gap-2 mb-4">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <span class="text-gray-400 text-xs font-jost leading-relaxed"><?php echo sp_branch_hours_html( $b ); ?></span>
          </div>
          <a href="<?php echo esc_url( $url ); ?>" class="mt-auto flex items-center justify-center gap-2 w-full text-blue-600 text-sm font-semibold bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-colors font-jost">
            View <?php echo esc_html( $b['name'] ); ?>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<script>
(function () {
  document.querySelectorAll('.loc-acc-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = btn.closest('.loc-acc');
      var open = item.classList.toggle('open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });
})();
</script>

<?php get_footer();
