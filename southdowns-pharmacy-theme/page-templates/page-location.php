<?php
/**
 * Template Name: Location
 *
 * One template powers all four branch location pages.
 * Assign this template to each branch page via Page → Template, then
 * populate the ACF fields for that branch.
 *
 * Required ACF fields (all text unless noted):
 *  branch_location_name      – short area name, e.g. "Southsea"
 *  branch_hero_subtitle      – h1 tagline
 *  branch_hero_description   – hero body copy (textarea)
 *  branch_hero_image         – image field (returns URL)
 *  branch_hours_weekday      – e.g. "Mon–Fri 9am–6pm"
 *  branch_hours_saturday     – e.g. "Sat 9am–1pm"
 *  branch_address_line1      – e.g. "123 High Street"
 *  branch_address_line2      – e.g. "Southsea, Hampshire"
 *  branch_postcode           – e.g. "PO5 1AA"
 *  branch_phone              – formatted, e.g. "023 9212 3456"
 *  branch_phone_raw          – e.g. "02392123456" (for tel: link)
 *  branch_parking            – e.g. "Free street parking nearby"
 *  branch_maps_embed_src     – Google Maps iframe src URL
 *  branch_maps_directions_url – Google Maps directions URL
 *  branch_by_car             – textarea
 *  branch_by_car_tags        – comma-sep, e.g. "Free street parking, 20 min from M27"
 *  branch_by_bus             – textarea
 *  branch_bus_routes         – comma-sep route numbers, e.g. "1, 3, 17, 23"
 *  branch_by_train           – textarea
 *  branch_train_stations     – pipe-sep pairs, e.g. "Portsmouth & Southsea|10 min,Fratton|15 min"
 *  branch_on_foot            – textarea
 *  branch_landmark           – e.g. "Kings Theatre"
 *  branch_is_flagship        – true/false field
 *  branch_area_image         – image field (URL, for other-branches card)
 *  branch_services_count     – number (default 8)
 *  branch_testimonials       – repeater:
 *                               quote (textarea)
 *                               author_name (text)
 *                               author_initials (text)
 *                               service (text)
 *                               review_date (text)
 *                               avatar_bg (text, Tailwind gradient classes)
 */

get_header();

$booking_url   = sp_booking_url();

// Pull ACF fields for this branch
$loc_name      = get_field('branch_location_name')     ?: get_the_title();
$hero_subtitle = get_field('branch_hero_subtitle')     ?: 'Your Community Pharmacy in ' . esc_html($loc_name);
$hero_desc     = get_field('branch_hero_description')  ?: 'Expert healthcare services across all of our Hampshire locations. Same-day appointments available — no GP referral needed.';
$hero_img      = get_field('branch_hero_image')        ?: 'https://images.unsplash.com/photo-1582560475093-ba66accbc424?w=1200&h=800&fit=crop';
$hours_wd      = get_field('branch_hours_weekday')     ?: 'Mon–Fri 9am–6pm';
$hours_sat     = get_field('branch_hours_saturday')    ?: 'Sat 9am–1pm';
$hours_sun     = get_field('branch_hours_sunday')      ?: '';
$addr1         = get_field('branch_address_line1')     ?: '';
$addr2         = get_field('branch_address_line2')     ?: '';
$postcode      = get_field('branch_postcode')          ?: '';
$phone         = get_field('branch_phone')             ?: sp_phone();
$phone_raw     = get_field('branch_phone_raw')         ?: sp_phone_raw();
$parking       = get_field('branch_parking')           ?: 'Parking available nearby';
$maps_src      = get_field('branch_maps_embed_src')    ?: '';
$maps_dir_url  = get_field('branch_maps_directions_url') ?: '#';
$is_flagship   = get_field('branch_is_flagship')       ?: false;
?>

<!-- Page-scoped styles -->
<style>
  .loc-reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
  .loc-reveal.loc-visible { opacity: 1; transform: translateY(0); }
  .loc-card-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
  .loc-card-lift:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }

  /* Branch card premium hover glow */
  .branch-card { position: relative; transition: transform 0.5s cubic-bezier(0.23,1,0.32,1), box-shadow 0.5s cubic-bezier(0.23,1,0.32,1); isolation: isolate; }
  .branch-card::before { content: ''; position: absolute; inset: -2px; border-radius: 18px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 40%, #1e3a8a 70%, #6366f1 100%); opacity: 0; z-index: -1; transition: opacity 0.4s ease; }
  .branch-card:hover::before { opacity: 1; }
  .branch-card:hover { transform: translateY(-8px); box-shadow: 0 25px 50px rgba(30,58,138,0.2), 0 0 40px rgba(59,130,246,0.1); }
  .branch-card .branch-cta-arrow { transition: transform 0.35s cubic-bezier(0.23,1,0.32,1); }
  .branch-card:hover .branch-cta-arrow { transform: translateX(5px); }
  .branch-card .branch-cta-btn { transition: box-shadow 0.4s ease; }
  .branch-card:hover .branch-cta-btn { box-shadow: 0 8px 24px rgba(30,58,138,0.35); }
  .branch-stagger-1 { transition-delay: 0s; }
  .branch-stagger-2 { transition-delay: 0.15s; }
  .branch-stagger-3 { transition-delay: 0.3s; }
</style>


<!-- ============================================================
     BREADCRUMB
     ============================================================ -->
<div class="bg-gray-50 border-b border-gray-200 px-4 md:px-8 lg:px-12 py-3">
  <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm font-jost">
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="text-blue-600 hover:text-blue-800 transition-colors">Home</a>
    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span class="text-gray-500">Locations</span>
    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span class="text-gray-800 font-medium"><?php echo esc_html($loc_name); ?></span>
  </div>
</div>


<!-- ============================================================
     S1: HERO — Two-column layout matching homepage/service pages
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-bleed image + gradient overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center"
       style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      GPhC Registered &bull; <?php echo esc_html($loc_name); ?>
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html($hero_subtitle); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo esc_html($hero_desc); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url($booking_url); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost"><?php echo esc_html($hours_wd); ?> &nbsp;|&nbsp; <?php echo esc_html($hours_sat); ?><?php if ($parking): ?> &nbsp;|&nbsp; <?php echo esc_html($parking); ?><?php endif; ?></p>
  </div>

  <!-- Desktop: two-column split -->
  <div class="hidden md:flex relative">
    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center px-12 lg:px-16 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        GPhC Registered &bull; <?php echo esc_html($loc_name); ?> Branch
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html($hero_subtitle); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo esc_html($hero_desc); ?></p>
      <div class="flex flex-wrap gap-3 mb-6">
        <a href="<?php echo esc_url($booking_url); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-base font-semibold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          Book Appointment
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <a href="#loc-directions" class="inline-flex items-center gap-2 text-white/80 text-base font-medium hover:text-white transition-colors font-jost">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          Get Directions
        </a>
      </div>
      <div class="flex flex-wrap gap-x-6 gap-y-2 text-white text-base font-medium font-jost">
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo esc_html($hours_wd); ?>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo esc_html($hours_sat); ?>
        </div>
      </div>
    </div>

    <!-- Right: hero image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center"
         style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>

    <!-- Centre-straddling trust badges -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:15%;transform:translateX(-50%);">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/roundel-same-day.webp' ); ?>" alt="Same Day Appointments" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/roundel-yellow-fever.webp' ); ?>" alt="GPhC Registered" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:15%;transform:translateX(-50%);">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/roundel-5-star.webp' ); ?>" alt="5-Star Rated" class="w-[130px] h-[130px] object-contain drop-shadow-lg"/>
    </div>
  </div>

</section>


<!-- ============================================================
     S2: MAP & DIRECTIONS
     ============================================================ -->
<?php
$by_car     = get_field('branch_by_car')       ?: 'We are conveniently accessible by car from across the area.';
$car_tags   = get_field('branch_by_car_tags')  ?: '';
$by_bus     = get_field('branch_by_bus')       ?: 'Several bus routes serve this branch.';
$bus_routes = get_field('branch_bus_routes')   ?: '';
$by_train   = get_field('branch_by_train')     ?: 'The branch is within easy reach of local train stations.';
$train_stn  = get_field('branch_train_stations') ?: '';
$on_foot    = get_field('branch_on_foot')      ?: 'Easy to reach on foot from the town centre.';
$landmark   = get_field('branch_landmark')     ?: '';

// Parse comma-separated car tags
$car_tag_list = $car_tags ? array_map('trim', explode(',', $car_tags)) : [];

// Parse comma-separated bus routes
$bus_route_list = $bus_routes ? array_map('trim', explode(',', $bus_routes)) : [];

// Parse pipe-separated train stations: "Name|Time,Name2|Time2"
$train_list = [];
if ( $train_stn ) {
  foreach ( array_map('trim', explode(',', $train_stn)) as $pair ) {
    $parts = explode('|', $pair);
    if ( count($parts) === 2 ) {
      $train_list[] = ['name' => trim($parts[0]), 'time' => trim($parts[1])];
    }
  }
}
?>
<section id="loc-directions" class="relative py-16 lg:py-24 overflow-hidden" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">

  <!-- Background pattern -->
  <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(circle at 20% 30%,#ffffff 1px,transparent 1px),radial-gradient(circle at 80% 70%,#ffffff 1px,transparent 1px);background-size:50px 50px;"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <!-- Heading -->
    <div class="text-center mb-12 loc-reveal">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2 rounded-full mb-5 border border-white/20 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Getting Here
      </div>
      <h2 class="text-white text-3xl lg:text-4xl font-semibold font-jost mb-4">Find Our <?php echo esc_html($loc_name); ?> Branch</h2>
      <p class="text-blue-100 text-lg font-jost max-w-2xl mx-auto">Multiple ways to reach us — by car, bus, train, or on foot.</p>
    </div>

    <!-- Map + Address row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10 loc-reveal">

      <!-- Google Map (2/3 width on desktop) -->
      <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-2xl bg-white/10" style="min-height:380px;">
        <?php if ( $maps_src ) : ?>
          <iframe
            src="<?php echo esc_url($maps_src); ?>"
            width="100%" height="380" style="border:0;display:block;"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        <?php else : ?>
          <div class="flex items-center justify-center h-[380px] bg-white/10">
            <p class="text-white/60 font-jost text-sm">Map not available</p>
          </div>
        <?php endif; ?>
      </div>

      <!-- Address card (1/3 width) -->
      <div class="flex flex-col justify-between bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8">
        <div>
          <h3 class="text-white font-semibold text-xl font-jost mb-4"><?php echo esc_html($loc_name); ?> Pharmacy</h3>
          <?php if ( $addr1 || $addr2 || $postcode ) : ?>
          <div class="flex items-start gap-3 mb-5">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <address class="text-white not-italic font-jost leading-relaxed">
              <?php if ($addr1) echo esc_html($addr1) . '<br>'; ?>
              <?php if ($addr2) echo esc_html($addr2) . '<br>'; ?>
              <?php if ($postcode) echo esc_html($postcode); ?>
            </address>
          </div>
          <?php endif; ?>
          <div class="flex items-center gap-3 mb-5">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="font-jost text-white text-sm leading-relaxed">
              <div><?php echo esc_html($hours_wd); ?></div>
              <div><?php echo esc_html($hours_sat); ?></div>
            </div>
          </div>
          <div class="flex items-center gap-3 mb-6">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="text-white font-jost text-sm hover:text-blue-200 transition-colors"><?php echo esc_html($phone); ?></a>
          </div>
        </div>
        <a href="<?php echo esc_url($maps_dir_url); ?>" target="_blank" rel="noopener noreferrer"
           class="flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold text-sm px-5 py-3 rounded-xl hover:bg-blue-50 transition-colors shadow-lg font-jost w-full">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          Get Directions
        </a>
      </div>

    </div><!-- /Map + Address row -->

    <!-- 4 Direction cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 loc-reveal">

      <!-- By Car -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(255,255,255,0.15);">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2.5 0M13 16H3m10 0h2m4-6l-2-4H9l-2 4h12z"/></svg>
        </div>
        <h4 class="text-white font-semibold text-base font-jost mb-2">By Car</h4>
        <p class="text-blue-100 text-sm font-jost leading-relaxed mb-4"><?php echo esc_html($by_car); ?></p>
        <?php if ( $car_tag_list ) : ?>
        <div class="flex flex-wrap gap-2">
          <?php foreach ( $car_tag_list as $tag ) : ?>
            <span class="bg-white/15 text-white text-xs font-medium px-3 py-1 rounded-full font-jost border border-white/20"><?php echo esc_html($tag); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- By Bus -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(255,255,255,0.15);">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 19v2m8-2v2M3 10h18M8 5V3m8 2V3"/><circle cx="8" cy="15" r="1" fill="currentColor"/><circle cx="16" cy="15" r="1" fill="currentColor"/></svg>
        </div>
        <h4 class="text-white font-semibold text-base font-jost mb-2">By Bus</h4>
        <p class="text-blue-100 text-sm font-jost leading-relaxed mb-4"><?php echo esc_html($by_bus); ?></p>
        <?php if ( $bus_route_list ) : ?>
        <div class="flex flex-wrap gap-2">
          <?php foreach ( $bus_route_list as $route ) : ?>
            <span class="bg-white text-blue-700 text-xs font-bold px-3 py-1 rounded-full font-jost">Route <?php echo esc_html($route); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- By Train -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(255,255,255,0.15);">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19l-2 3m14-3l-2 3M5 7h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 15a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2zM12 7V4"/></svg>
        </div>
        <h4 class="text-white font-semibold text-base font-jost mb-2">By Train</h4>
        <p class="text-blue-100 text-sm font-jost leading-relaxed mb-4"><?php echo esc_html($by_train); ?></p>
        <?php if ( $train_list ) : ?>
        <div class="flex flex-col gap-2">
          <?php foreach ( $train_list as $stn ) : ?>
            <div class="flex items-center justify-between bg-white/15 rounded-lg px-3 py-2 border border-white/20">
              <span class="text-white text-xs font-medium font-jost"><?php echo esc_html($stn['name']); ?></span>
              <span class="text-blue-200 text-xs font-jost"><?php echo esc_html($stn['time']); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- On Foot -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(255,255,255,0.15);">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14l-4 4m4-4l4 4m-4-4v6"/></svg>
        </div>
        <h4 class="text-white font-semibold text-base font-jost mb-2">On Foot</h4>
        <p class="text-blue-100 text-sm font-jost leading-relaxed mb-4"><?php echo esc_html($on_foot); ?></p>
        <?php if ( $landmark ) : ?>
        <div class="flex items-center gap-2 bg-white/15 rounded-lg px-3 py-2 border border-white/20">
          <svg class="w-4 h-4 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
          <span class="text-white text-xs font-medium font-jost">Near <?php echo esc_html($landmark); ?></span>
        </div>
        <?php endif; ?>
      </div>

    </div><!-- /Direction cards -->

  </div>
</section>


<!-- ============================================================
     S3: TESTIMONIALS
     ============================================================ -->
<?php
$testimonials = get_field('branch_testimonials') ?: [];

// Fallback reviews if no ACF data
if ( empty($testimonials) ) {
  $testimonials = [
    [
      'quote'          => 'The team here are absolutely brilliant. I came in for a minor ailment consultation and was seen straight away. Friendly, professional, and genuinely caring staff.',
      'author_name'    => 'Sarah M.',
      'author_initials'=> 'SM',
      'service'        => 'Minor Ailments',
      'review_date'    => 'March 2025',
      'avatar_bg'      => 'from-blue-500 to-blue-700',
    ],
    [
      'quote'          => 'Got my travel vaccinations done here before a trip to Southeast Asia. No GP referral needed, same-day appointment available. Couldn\'t be easier or more convenient.',
      'author_name'    => 'James T.',
      'author_initials'=> 'JT',
      'service'        => 'Travel Health',
      'review_date'    => 'February 2025',
      'avatar_bg'      => 'from-indigo-500 to-indigo-700',
    ],
    [
      'quote'          => 'My ear wax removal was done quickly and painlessly using microsuction. I can hear perfectly again. The pharmacist explained everything clearly before starting.',
      'author_name'    => 'Linda P.',
      'author_initials'=> 'LP',
      'service'        => 'Ear Wax Removal',
      'review_date'    => 'January 2025',
      'avatar_bg'      => 'from-violet-500 to-violet-700',
    ],
  ];
}
?>
<section class="py-16 lg:py-24" style="background:linear-gradient(180deg,#f8fafc 0%,#eff6ff 60%,#f8fafc 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <!-- Heading -->
    <div class="text-center mb-12 loc-reveal">
      <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-sm font-medium px-5 py-2 rounded-full mb-5 border border-blue-200 font-jost">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
        Patient Reviews
      </div>
      <h2 class="text-gray-900 text-3xl lg:text-4xl font-semibold font-jost mb-4">What Our Patients Say</h2>
      <p class="text-gray-500 text-lg font-jost max-w-2xl mx-auto">Real experiences from patients at our <?php echo esc_html($loc_name); ?> branch.</p>
    </div>

    <!-- Review cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
      <?php foreach ( $testimonials as $i => $t ) :
        $delay = $i + 1;
      ?>
      <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-7 loc-reveal loc-card-lift" style="transition-delay:<?php echo ($i * 0.1); ?>s;">
        <!-- Stars -->
        <div class="flex gap-1 mb-4">
          <?php for ( $s = 0; $s < 5; $s++ ) : ?>
            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
          <?php endfor; ?>
        </div>

        <!-- Quote -->
        <p class="text-gray-700 text-base font-jost leading-relaxed mb-6 italic">"<?php echo esc_html($t['quote']); ?>"</p>

        <!-- Author -->
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br <?php echo esc_attr($t['avatar_bg']); ?> flex items-center justify-center flex-shrink-0">
            <span class="text-white text-sm font-bold font-jost"><?php echo esc_html($t['author_initials']); ?></span>
          </div>
          <div>
            <div class="text-gray-900 font-semibold text-sm font-jost"><?php echo esc_html($t['author_name']); ?></div>
            <div class="text-gray-400 text-xs font-jost"><?php echo esc_html($t['service']); ?> &middot; <?php echo esc_html($t['review_date']); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div><!-- /Review cards -->

    <!-- Trust strip -->
    <div class="flex flex-wrap items-center justify-center gap-8 loc-reveal">
      <div class="flex items-center gap-3">
        <div class="flex gap-0.5">
          <?php for ($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><?php endfor; ?>
        </div>
        <span class="text-gray-700 font-semibold text-sm font-jost">4.9/5 Average Rating</span>
      </div>
      <div class="w-px h-6 bg-gray-300 hidden md:block"></div>
      <div class="text-gray-700 font-semibold text-sm font-jost">400+ Google Reviews</div>
      <div class="w-px h-6 bg-gray-300 hidden md:block"></div>
      <div class="text-gray-700 font-semibold text-sm font-jost">GPhC Registered Pharmacy</div>
      <div class="w-px h-6 bg-gray-300 hidden md:block"></div>
      <a href="<?php echo esc_url($booking_url); ?>" class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-blue-700 transition-colors shadow-md font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S4: BOOK / AI AGENT DUAL CTA
     ============================================================ -->
<section class="py-16 lg:py-24" style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 50%,#1d4ed8 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <div class="text-center mb-12 loc-reveal">
      <h2 class="text-white text-3xl lg:text-4xl font-semibold font-jost mb-4"><?php echo get_field( 'branch_cta_heading' ) ?: 'Ready to Get Started?'; ?></h2>
      <p class="text-blue-200 text-lg font-jost max-w-2xl mx-auto">Book an appointment at our <?php echo esc_html($loc_name); ?> branch or speak to our AI health assistant instantly.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto loc-reveal">

      <!-- Book Appointment card -->
      <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-2xl">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-gray-900 text-2xl font-semibold font-jost mb-3"><?php echo get_field( 'branch_book_heading' ) ?: 'Book an Appointment'; ?></h3>
        <p class="text-gray-500 font-jost mb-6 leading-relaxed">Same-day and next-day appointments available at our <?php echo esc_html($loc_name); ?> branch. No GP referral needed for most services.</p>
        <ul class="space-y-2 mb-8">
          <?php
          $cta_points_raw = function_exists( 'get_field' ) ? get_field( 'branch_book_points' ) : '';
          $cta_points = $cta_points_raw ? array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $cta_points_raw ) ) ) ) : ['No GP referral needed', 'Same-day appointments available', 'All consultations strictly private', 'GPhC-registered pharmacists'];
          ?>
          <?php foreach ( $cta_points as $pt ) : ?>
          <li class="flex items-center gap-3 text-gray-700 text-sm font-jost">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html($pt); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo esc_url($booking_url); ?>"
           class="flex items-center justify-center gap-2 w-full text-white font-semibold text-base px-6 py-4 rounded-2xl shadow-lg font-jost transition-all hover:shadow-xl hover:-translate-y-0.5"
           style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <?php echo get_field( 'branch_book_btn' ) ?: "Book Now — It's Free"; ?>
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <p class="text-center text-gray-400 text-xs font-jost mt-3">No card required &bull; Cancel anytime</p>
      </div>

      <!-- AI Agent card -->
      <div class="rounded-3xl p-8 lg:p-10 shadow-2xl relative overflow-hidden" style="background:linear-gradient(135deg,#2e1065 0%,#4c1d95 40%,#6d28d9 100%);">
        <!-- Pulsing glow -->
        <div class="absolute top-6 right-6">
          <div class="relative">
            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
            <div class="absolute inset-0 w-3 h-3 bg-green-400 rounded-full animate-ping opacity-75"></div>
          </div>
        </div>
        <!-- INSTANT HELP badge -->
        <div class="inline-flex items-center gap-1.5 bg-green-400/20 text-green-300 text-xs font-bold px-3 py-1.5 rounded-full border border-green-400/30 font-jost mb-6">
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
          <?php echo get_field( 'branch_ai_badge' ) ?: 'INSTANT HELP'; ?>
        </div>
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 bg-white/15">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-white text-2xl font-semibold font-jost mb-3"><?php echo get_field( 'branch_ai_heading' ) ?: 'Speak to Our AI Agent'; ?></h3>
        <p class="text-purple-200 font-jost mb-6 leading-relaxed">Get instant answers about services, pricing, and availability at <?php echo esc_html($loc_name); ?> — available 24/7, no waiting.</p>
        <ul class="space-y-2 mb-8">
          <?php
          $ai_points_raw = function_exists( 'get_field' ) ? get_field( 'branch_ai_points' ) : '';
          $ai_points = $ai_points_raw ? array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $ai_points_raw ) ) ) ) : ['Available 24 hours a day, 7 days a week', 'Instant answers about all services', 'Check availability before booking', 'Completely free to use'];
          ?>
          <?php foreach ( $ai_points as $pt ) : ?>
          <li class="flex items-center gap-3 text-purple-100 text-sm font-jost">
            <svg class="w-5 h-5 text-purple-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html($pt); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo esc_url(home_url('/ai-agent/')); ?>"
           class="flex items-center justify-center gap-2 w-full bg-white/15 border border-white/30 text-white font-semibold text-base px-6 py-4 rounded-2xl font-jost hover:bg-white/25 transition-all backdrop-blur-sm">
          <?php echo get_field( 'branch_ai_btn' ) ?: 'Chat with AI Agent'; ?>
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </a>
        <p class="text-center text-purple-300 text-xs font-jost mt-3">No sign-up required &bull; Instant responses</p>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S5: OTHER BRANCHES
     ============================================================ -->
<?php
// Query all pages using this template, excluding the current page
$sibling_pages = get_pages([
  'meta_key'   => '_wp_page_template',
  'meta_value' => 'page-templates/page-location.php',
  'exclude'    => [ get_the_ID() ],
  'sort_column'=> 'menu_order,post_title',
]);

// Fallback services count
$services_count = get_field('branch_services_count') ?: 8;
?>
<section class="py-16 lg:py-24" style="background:linear-gradient(180deg,#f8fafc 0%,#eff6ff 50%,#dbeafe 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <!-- Heading -->
    <div class="text-center mb-12 loc-reveal">
      <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-sm font-medium px-5 py-2 rounded-full mb-5 border border-blue-200 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Our Locations
      </div>
      <h2 class="text-gray-900 text-3xl lg:text-4xl font-semibold font-jost mb-4">Other Southdowns Branches</h2>
      <p class="text-gray-500 text-lg font-jost max-w-2xl mx-auto">We serve communities across Hampshire. Find your nearest branch below.</p>
    </div>

    <?php if ( ! empty($sibling_pages) ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-<?php echo count($sibling_pages) >= 3 ? '3' : count($sibling_pages); ?> gap-8">
      <?php foreach ( $sibling_pages as $i => $sib_page ) :
        $stagger = $i + 1;
        // Pull ACF fields for sibling
        $sib_name     = get_field('branch_location_name', $sib_page->ID) ?: $sib_page->post_title;
        $sib_addr1    = get_field('branch_address_line1', $sib_page->ID) ?: '';
        $sib_addr2    = get_field('branch_address_line2', $sib_page->ID) ?: '';
        $sib_postcode = get_field('branch_postcode', $sib_page->ID) ?: '';
        $sib_phone    = get_field('branch_phone', $sib_page->ID) ?: sp_phone();
        $sib_phone_raw= get_field('branch_phone_raw', $sib_page->ID) ?: sp_phone_raw();
        $sib_hours_wd = get_field('branch_hours_weekday', $sib_page->ID) ?: 'Mon–Fri 9am–6pm';
        $sib_hours_sat= get_field('branch_hours_saturday', $sib_page->ID) ?: 'Sat 9am–1pm';
        $sib_svc_count= get_field('branch_services_count', $sib_page->ID) ?: 8;
        $sib_area_img = get_field('branch_area_image', $sib_page->ID) ?: 'https://images.unsplash.com/photo-1582560475093-ba66accbc424?w=600&h=400&fit=crop';
        $sib_url      = get_permalink($sib_page->ID);
        $stagger_cls  = 'branch-stagger-' . min($stagger, 3);
      ?>
      <div class="branch-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 <?php echo esc_attr($stagger_cls); ?> loc-reveal">

        <!-- Branch image -->
        <div class="relative h-48 overflow-hidden">
          <img src="<?php echo esc_url($sib_area_img); ?>"
               alt="<?php echo esc_attr($sib_name); ?> pharmacy"
               class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy">
          <!-- Branch name overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 to-transparent flex items-end p-5">
            <h3 class="text-white text-xl font-semibold font-jost"><?php echo esc_html($sib_name); ?></h3>
          </div>
        </div>

        <!-- Card body -->
        <div class="p-6">
          <!-- Address -->
          <?php if ( $sib_addr1 || $sib_addr2 ) : ?>
          <div class="flex items-start gap-2.5 mb-3">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <address class="text-gray-600 text-sm not-italic font-jost leading-snug">
              <?php if ($sib_addr1) echo esc_html($sib_addr1) . ', '; ?>
              <?php if ($sib_addr2) echo esc_html($sib_addr2); ?>
              <?php if ($sib_postcode) echo ', ' . esc_html($sib_postcode); ?>
            </address>
          </div>
          <?php endif; ?>

          <!-- Phone -->
          <div class="flex items-center gap-2.5 mb-3">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <a href="tel:<?php echo esc_attr($sib_phone_raw); ?>" class="text-gray-600 text-sm font-jost hover:text-blue-600 transition-colors"><?php echo esc_html($sib_phone); ?></a>
          </div>

          <!-- Hours -->
          <div class="flex items-start gap-2.5 mb-5">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-gray-600 text-sm font-jost leading-snug">
              <div><?php echo esc_html($sib_hours_wd); ?></div>
              <div><?php echo esc_html($sib_hours_sat); ?></div>
            </div>
          </div>

          <!-- Services count pill -->
          <div class="flex items-center gap-2 mb-6">
            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1.5 rounded-full border border-blue-100 font-jost">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?php echo esc_html($sib_svc_count); ?>+ services available
            </span>
          </div>

          <!-- CTA -->
          <a href="<?php echo esc_url($sib_url); ?>"
             class="branch-cta-btn flex items-center justify-center gap-2 w-full text-white font-semibold text-sm px-5 py-3 rounded-xl font-jost"
             style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
            View <?php echo esc_html($sib_name); ?> Branch
            <svg class="w-4 h-4 branch-cta-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div><!-- /branch cards -->

    <?php else : ?>
    <!-- Fallback if no sibling pages found -->
    <div class="text-center py-12">
      <p class="text-gray-500 font-jost">Explore all our <a href="<?php echo esc_url(home_url('/locations/')); ?>" class="text-blue-600 hover:underline">Hampshire locations</a>.</p>
    </div>
    <?php endif; ?>

  </div>
</section>


<!-- ============================================================
     TRUST STATS
     ============================================================ -->
<section class="py-14 lg:py-20" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-8">

      <!-- Branches -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">4</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Hampshire Branches</div>
      </div>

      <!-- Services -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal" style="transition-delay:0.1s;">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">8+</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Healthcare Services</div>
      </div>

      <!-- Patients Served -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal" style="transition-delay:0.2s;">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">10,000+</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Patients Served</div>
      </div>

      <!-- 4th stat: 7 Days if Sunday hours set, else 5★ -->
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal" style="transition-delay:0.3s;">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <?php if ( $hours_sun ) : ?>
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          <?php else : ?>
          <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
          <?php endif; ?>
        </div>
        <?php if ( $hours_sun ) : ?>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">7 Days</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Open Every Week</div>
        <?php else : ?>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">5★</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Patient Rated</div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>


<!-- ============================================================
     S6: JAVASCRIPT — Scroll reveal
     ============================================================ -->
<script>
(function () {
  'use strict';

  // Scroll reveal
  var revealEls = document.querySelectorAll('.loc-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('loc-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(function (el) { observer.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('loc-visible'); });
  }
})();
</script>

<?php get_footer(); ?>
