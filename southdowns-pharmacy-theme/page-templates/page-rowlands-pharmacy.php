<?php
/**
 * Template Name: Rowlands Castle Pharmacy Location
 *
 * Dedicated location page for the Rowlands Castle branch.
 * 12 The Green, Rowlands Castle, Hampshire, PO9 6BN
 * Tel: 023 9241 3952
 * Mon–Fri 9am–6pm | Sat 9am–1pm | Sun Closed
 */

get_header();

$booking_url   = sp_booking_url();

// ── Hero ────────────────────────────────────────────────────────
$hero_img      = get_field('branch_hero_image')          ?: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1200&h=800&fit=crop';
$hero_subtitle = get_field('branch_hero_subtitle')       ?: 'Your Local Pharmacy in Rowlands Castle';
$hero_desc     = get_field('branch_hero_description')    ?: 'Trusted village pharmacy on The Green — weight loss injections, travel vaccinations and NHS Pharmacy First services. No GP referral needed for most consultations.';

// ── Contact & Hours ─────────────────────────────────────────────
$addr1         = get_field('branch_address_line1')       ?: '12 The Green';
$addr2         = get_field('branch_address_line2')       ?: 'Rowlands Castle, Hampshire';
$postcode      = get_field('branch_postcode')            ?: 'PO9 6BN';
$phone         = get_field('branch_phone')               ?: '023 9241 3952';
$phone_raw     = get_field('branch_phone_raw')           ?: '02392413952';
$hours_wd      = get_field('branch_hours_weekday')       ?: 'Mon–Fri 9am–6pm';
$hours_sat     = get_field('branch_hours_saturday')      ?: 'Sat 9am–1pm';
$hours_sun     = get_field('branch_hours_sunday')        ?: '';
$parking       = get_field('branch_parking')             ?: 'Parking on The Green';

// ── Map & Directions ────────────────────────────────────────────
$maps_src      = get_field('branch_maps_embed_src')      ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2516.7533281722576!2d-0.961667523760126!3d50.89127565552625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487445a4fe353377%3A0x2189f14c6daaf0fa!2sRowlands%20Castle%20Pharmacy%2C%20Flu%20%26%20Covid%20Vaccinations%20-%20Travel%20Clinic!5e0!3m2!1sen!2suk!4v1778833643777!5m2!1sen!2suk';
$maps_dir_url  = get_field('branch_maps_directions_url') ?: 'https://www.google.com/maps/dir/?api=1&destination=12+The+Green,+Rowlands+Castle,+Hampshire+PO9+6BN';
$by_car        = get_field('branch_by_car')              ?: 'Rowlands Castle is easily reached from junction 2 of the A3(M). Take the B2149 south into the village — the pharmacy is on The Green at the heart of the village.';
$car_tags_raw  = get_field('branch_by_car_tags')         ?: 'Off A3(M) Junction 2,B2149 into Village,Parking on The Green';
$by_bus        = get_field('branch_by_bus')              ?: 'Bus routes 27, 37 and 8 serve Rowlands Castle. Route 27 runs from both Emsworth and Havant, stopping directly at The Green.';
$bus_routes_raw= get_field('branch_bus_routes')          ?: '27,37,8';
$by_train      = get_field('branch_by_train')            ?: 'Rowlands Castle station is on Bowes Hill, served by South Western Railway. The pharmacy on The Green is a 2–3 minute walk from the station exit.';
$train_stn_raw = get_field('branch_train_stations')      ?: 'Rowlands Castle Station|2–3 min walk';
$on_foot       = get_field('branch_on_foot')             ?: 'The pharmacy sits directly on the village green — the focal point of Rowlands Castle. Clearly visible from the station approach road.';
$landmark      = get_field('branch_landmark')            ?: 'The Village Green';

// Parse comma / pipe-separated direction fields
$car_tag_list   = array_filter( array_map( 'trim', explode( ',', $car_tags_raw ) ) );
$bus_route_list = array_filter( array_map( 'trim', explode( ',', $bus_routes_raw ) ) );
$train_list     = [];
foreach ( array_filter( array_map( 'trim', explode( ',', $train_stn_raw ) ) ) as $pair ) {
    $parts = explode( '|', $pair );
    if ( count( $parts ) === 2 ) {
        $train_list[] = [ 'name' => trim( $parts[0] ), 'time' => trim( $parts[1] ) ];
    }
}

// ── Services ────────────────────────────────────────────────────
$rc_services_featured = [ 'Weight Loss Injections', 'Travel Vaccinations', 'NHS Pharmacy First' ];
$rc_services = [
    'Covid Vaccination',
    'Flu Vaccination',
    'Free Contraceptive Service',
    'Hypertension Check',
    'NHS Pharmacy First',
    'Travel Vaccinations',
    'Weight Loss Injections',
    'Weight Loss Consultation',
];

// ── Full opening hours table ────────────────────────────────────
$opening_hours = [
    [ 'day' => 'Monday',    'time' => '09:00 – 18:00', 'closed' => false ],
    [ 'day' => 'Tuesday',   'time' => '09:00 – 18:00', 'closed' => false ],
    [ 'day' => 'Wednesday', 'time' => '09:00 – 18:00', 'closed' => false ],
    [ 'day' => 'Thursday',  'time' => '09:00 – 18:00', 'closed' => false ],
    [ 'day' => 'Friday',    'time' => '09:00 – 18:00', 'closed' => false ],
    [ 'day' => 'Saturday',  'time' => '09:00 – 13:00', 'closed' => false ],
    [ 'day' => 'Sunday',    'time' => 'Closed',        'closed' => true  ],
];

// ── Other branches ──────────────────────────────────────────────
$other_branches = [
    [
        'name'      => 'Emsworth Pharmacy',
        'addr'      => '2-4 Central Buildings, Emsworth, PO10 7DU',
        'phone'     => '01243 968 869',
        'phone_raw' => '01243968869',
        'hours_wd'  => 'Mon–Fri 9am–7pm',
        'hours_sat' => 'Sat 9am–5pm',
        'services'  => 13,
        'img'       => get_field('branch_other_emsworth_image') ?: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=400&fit=crop',
        'url'       => home_url('/emsworth/'),
    ],
    [
        'name'      => 'Bosmere Pharmacy',
        'addr'      => 'Broadmarsh Lane, Havant, PO9 1AW',
        'phone'     => '023 9248 1721',
        'phone_raw' => '02392481721',
        'hours_wd'  => 'Mon–Fri 9am–6:30pm',
        'hours_sat' => 'Sat 9am–5pm',
        'services'  => 16,
        'img'       => get_field('branch_other_bosmere_image') ?: 'https://images.unsplash.com/photo-1582560475093-ba66accbc424?w=600&h=400&fit=crop',
        'url'       => home_url('/bosmere/'),
    ],
    [
        'name'      => 'Davies Pharmacy',
        'addr'      => 'Emsworth Road, Havant, PO9 2SN',
        'phone'     => '023 9248 3744',
        'phone_raw' => '02392483744',
        'hours_wd'  => 'Mon–Fri 9am–6pm',
        'hours_sat' => 'Sat 9am–1pm',
        'services'  => 10,
        'img'       => get_field('branch_other_davies_image') ?: 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=600&h=400&fit=crop',
        'url'       => home_url('/davies-pharmacy/'),
    ],
];

// ── Roundel font stack ───────────────────────────────────────────
$rc_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
$rc_txt  = "font-family:{$rc_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";
?>

<!-- Page-scoped styles -->
<style>
  .loc-reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
  .loc-reveal.loc-visible { opacity: 1; transform: translateY(0); }
  .loc-card-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
  .loc-card-lift:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
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
    <span class="text-gray-800 font-medium">Rowlands Castle</span>
  </div>
</div>


<!-- ============================================================
     S1: HERO
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[640px] overflow-hidden">

  <!-- Mobile: full-bleed image + gradient overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center"
       style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      GPhC Registered &bull; Rowlands Castle
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $hero_subtitle ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo esc_html( $hero_desc ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url($booking_url); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost"><?php echo esc_html( $hours_wd ); ?> &nbsp;|&nbsp; <?php echo esc_html( $hours_sat ); ?><?php if ( $parking ) : ?> &nbsp;|&nbsp; <?php echo esc_html( $parking ); ?><?php endif; ?></p>
  </div>

  <!-- Desktop: two-column split -->
  <div class="hidden md:flex relative">

    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[640px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        GPhC Registered &bull; Rowlands Castle Branch
      </div>
      <h1 class="text-white text-4xl lg:text-[50px] font-semibold mb-5 font-jost" style="line-height:1.1;"><?php echo esc_html( $hero_subtitle ); ?></h1>
      <p class="text-white text-base lg:text-lg leading-relaxed mb-6 font-jost"><?php echo esc_html( $hero_desc ); ?></p>

      <!-- Services pill grid (in-hero, before CTAs) -->
      <div class="flex flex-wrap gap-2 mb-7">
        <?php foreach ( $rc_services as $svc ) :
          $is_featured = in_array( $svc, $rc_services_featured, true );
          if ( $is_featured ) : ?>
            <span class="inline-flex items-center gap-1.5 bg-white text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full font-jost shadow-sm">
              <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
              <?php echo esc_html( $svc ); ?>
            </span>
          <?php else : ?>
            <span class="inline-flex items-center bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-3 py-1.5 rounded-full border border-white/30 font-jost">
              <?php echo esc_html( $svc ); ?>
            </span>
          <?php endif;
        endforeach; ?>
      </div>

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
      <div class="flex flex-wrap gap-x-6 gap-y-2 text-white text-sm font-medium font-jost">
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo esc_html( $hours_wd ); ?>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo esc_html( $hours_sat ); ?>
        </div>
      </div>
    </div>

    <!-- Right: hero image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[640px] bg-cover bg-center"
         style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>

    <!-- Centre-straddling HTML/CSS roundels -->

    <!-- Roundel 1: Weight Loss Injections (top, white/navy) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:11%;transform:translateX(-50%);">
      <div style="
        width:138px;height:138px;border-radius:50%;
        background:#fff;
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>
        <span style="<?php echo $rc_txt; ?>font-size:13px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">Weight Loss</span>
        <span style="<?php echo $rc_txt; ?>font-size:13px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">Injections</span>
        <span style="<?php echo $rc_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:3px;">Medically</span>
        <span style="<?php echo $rc_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;">Supervised</span>
      </div>
    </div>

    <!-- Roundel 2: Pharmacy First (centre, indigo gradient, 152px) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="
        width:152px;height:152px;border-radius:50%;
        background:linear-gradient(135deg,#4f46e5 0%,#4338ca 50%,#312e81 100%);
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px rgba(79,70,229,0.5),0 0 0 6px rgba(255,255,255,0.5),0 8px 32px rgba(79,70,229,0.35),0 2px 8px rgba(0,0,0,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9c2.39 0 4.68.94 6.36 2.64"/></svg>
        <span style="<?php echo $rc_txt; ?>font-size:14px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.01em;">Pharmacy</span>
        <span style="<?php echo $rc_txt; ?>font-size:14px;font-weight:700;color:#fff;line-height:1.2;letter-spacing:-0.01em;">First</span>
        <span style="<?php echo $rc_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.8);line-height:1.3;margin-top:3px;">No GP Referral</span>
        <span style="<?php echo $rc_txt; ?>font-size:10px;font-weight:600;color:rgba(255,255,255,0.8);line-height:1.3;">Needed</span>
      </div>
    </div>

    <!-- Roundel 3: Travel Vaccinations (bottom, white/navy) -->
    <div class="absolute z-30 flex flex-col items-center" style="left:50%;bottom:11%;transform:translateX(-50%);">
      <div style="
        width:138px;height:138px;border-radius:50%;
        background:#fff;
        display:flex;flex-direction:column;align-items:center;justify-content:center;
        box-shadow:0 0 0 3px #1e3a8a,0 0 0 6px rgba(255,255,255,0.7),0 8px 24px rgba(0,0,0,0.18),0 2px 8px rgba(30,58,138,0.15);
        padding:0 10px;text-align:center;
      ">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1e3a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        <span style="<?php echo $rc_txt; ?>font-size:13px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">Travel</span>
        <span style="<?php echo $rc_txt; ?>font-size:13px;font-weight:700;color:#1e3a8a;line-height:1.2;letter-spacing:-0.01em;">Vaccinations</span>
        <span style="<?php echo $rc_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;margin-top:3px;">Travel Clinic</span>
        <span style="<?php echo $rc_txt; ?>font-size:10px;font-weight:600;color:#64748b;line-height:1.3;">Hampshire</span>
      </div>
    </div>

  </div>

</section>


<!-- ============================================================
     S1B: SERVICES AVAILABLE AT ROWLANDS CASTLE
     ============================================================ -->
<section class="relative py-16 lg:py-20 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="absolute top-0 right-0 w-[500px] h-[400px] bg-blue-200/15 rounded-full translate-x-1/4 -translate-y-1/4 blur-3xl"></div>
  <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-10 loc-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">What We Offer</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost">Services Available at Rowlands Castle</h2>
      <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost">Walk in or book ahead — <?php echo count( $rc_services ); ?> services available, no GP referral needed for most.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-2.5 md:gap-3 loc-reveal">
      <?php foreach ( $rc_services as $svc ) :
        $is_featured = in_array( $svc, $rc_services_featured, true );
      ?>
        <?php if ( $is_featured ) : ?>
          <span class="inline-flex items-center gap-1.5 bg-blue-600 text-white text-sm md:text-[15px] font-semibold px-4 md:px-5 py-2 md:py-2.5 rounded-full shadow-md hover:bg-blue-700 transition-colors font-jost">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.39 7.36H22l-6.18 4.49L18.21 22 12 17.27 5.79 22l2.39-8.15L2 9.36h7.61z"/></svg>
            <?php echo esc_html( $svc ); ?>
          </span>
        <?php else : ?>
          <span class="inline-flex items-center gap-1.5 bg-white text-slate-700 text-sm md:text-[15px] font-medium px-4 md:px-5 py-2 md:py-2.5 rounded-full border border-slate-200 hover:border-blue-400 hover:text-blue-700 hover:shadow-sm transition-all font-jost">
            <svg class="w-3.5 h-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <?php echo esc_html( $svc ); ?>
          </span>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ============================================================
     S2: MAP, ADDRESS & GETTING HERE
     ============================================================ -->
<section id="loc-directions" class="relative py-16 lg:py-24 overflow-hidden" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">

  <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(circle at 20% 30%,#ffffff 1px,transparent 1px),radial-gradient(circle at 80% 70%,#ffffff 1px,transparent 1px);background-size:50px 50px;"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <!-- Heading -->
    <div class="text-center mb-12 loc-reveal">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2 rounded-full mb-5 border border-white/20 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Getting Here
      </div>
      <h2 class="text-white text-3xl lg:text-4xl font-semibold font-jost mb-4">Find Our Rowlands Castle Branch</h2>
      <p class="text-white text-lg font-jost max-w-2xl mx-auto">Multiple ways to reach us — by car, bus, train, or on foot.</p>
    </div>

    <!-- Map + Opening Hours card -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10 loc-reveal">

      <!-- Google Map -->
      <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-2xl bg-white/10" style="min-height:420px;">
        <iframe src="<?php echo esc_url($maps_src); ?>" title="Map showing Rowlands Castle Pharmacy at 12 The Green, Rowlands Castle, PO9 6BN" width="100%" height="420" style="border:0;display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- Opening Hours table card -->
      <div class="flex flex-col justify-between bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-7">
        <div>
          <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <h3 class="text-white font-semibold text-lg font-jost">Opening Hours</h3>
          </div>
          <dl class="divide-y divide-white/15">
            <?php foreach ( $opening_hours as $row ) : ?>
              <div class="flex items-center justify-between py-2.5">
                <dt class="text-white text-sm font-medium font-jost"><?php echo esc_html( $row['day'] ); ?></dt>
                <?php if ( $row['closed'] ) : ?>
                  <dd class="inline-flex items-center gap-1.5 text-blue-200/70 text-xs font-medium font-jost">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-200/60"></span>
                    <?php echo esc_html( $row['time'] ); ?>
                  </dd>
                <?php else : ?>
                  <dd class="text-white text-sm font-jost tabular-nums"><?php echo esc_html( $row['time'] ); ?></dd>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </dl>
        </div>
        <a href="<?php echo esc_url($booking_url); ?>" class="mt-5 flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold text-sm px-5 py-3 rounded-xl hover:bg-blue-50 transition-colors shadow-lg font-jost w-full">
          Book Appointment
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>

    </div><!-- /Map + Opening Hours row -->

    <!-- 4 Direction cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 loc-reveal">

      <!-- By Car -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 overflow-hidden loc-card-lift">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#f59e0b,#fbbf24);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(245,158,11,0.2);">
          <svg class="w-6 h-6" style="color:#fbbf24;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2.5 0M13 16H3m10 0h2m4-6l-2-4H9l-2 4h12z"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-2">By Car</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-4"><?php echo esc_html( $by_car ); ?></p>
        <?php if ( $car_tag_list ) : ?>
        <div class="flex flex-wrap gap-2">
          <?php foreach ( $car_tag_list as $tag ) : ?>
            <span class="bg-white/15 text-white text-sm font-medium px-3 py-1 rounded-full font-jost border border-white/20"><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- By Bus -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 overflow-hidden loc-card-lift">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#0ea5e9,#38bdf8);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(14,165,233,0.2);">
          <svg class="w-6 h-6" style="color:#38bdf8;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 19v2m8-2v2M3 10h18M8 5V3m8 2V3"/><circle cx="8" cy="15" r="1" fill="currentColor"/><circle cx="16" cy="15" r="1" fill="currentColor"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-2">By Bus</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-4"><?php echo esc_html( $by_bus ); ?></p>
        <?php if ( $bus_route_list ) : ?>
        <div class="flex flex-wrap gap-2">
          <?php foreach ( $bus_route_list as $route ) : ?>
            <span class="bg-white text-blue-700 text-sm font-bold px-3 py-1 rounded-full font-jost">Route <?php echo esc_html( $route ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- By Train -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 overflow-hidden loc-card-lift">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#14b8a6,#2dd4bf);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(20,184,166,0.2);">
          <svg class="w-6 h-6" style="color:#2dd4bf;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19l-2 3m14-3l-2 3M5 7h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 15a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2zM12 7V4"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-2">By Train</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-4"><?php echo esc_html( $by_train ); ?></p>
        <?php if ( $train_list ) : ?>
        <div class="flex flex-col gap-2">
          <?php foreach ( $train_list as $idx => $stn ) : ?>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white/15 rounded-lg px-3 py-2 border border-white/20 gap-1">
              <div class="flex items-center gap-2">
                <?php if ( $idx === 0 ) : ?>
                  <span class="bg-teal-400 text-teal-900 text-xs font-bold px-2 py-0.5 rounded-full font-jost flex-shrink-0">CLOSEST</span>
                <?php endif; ?>
                <span class="text-white text-sm font-medium font-jost"><?php echo esc_html( $stn['name'] ); ?></span>
              </div>
              <span class="text-white text-sm font-jost flex-shrink-0"><?php echo esc_html( $stn['time'] ); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- On Foot -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 overflow-hidden loc-card-lift">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#22c55e,#4ade80);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(34,197,94,0.2);">
          <svg class="w-6 h-6" style="color:#4ade80;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14l-4 4m4-4l4 4m-4-4v6"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-2">On Foot</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-4"><?php echo esc_html( $on_foot ); ?></p>
        <?php if ( $landmark ) : ?>
        <div class="flex items-center gap-2 bg-white/15 rounded-lg px-3 py-2 border border-white/20">
          <svg class="w-4 h-4 text-green-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
          <span class="text-white text-sm font-medium font-jost">Near <?php echo esc_html( $landmark ); ?></span>
        </div>
        <?php endif; ?>
      </div>

    </div><!-- /Direction cards -->

    <!-- Address + contact strip -->
    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-6 py-4 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 loc-reveal">
      <div class="flex items-center gap-2.5">
        <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <span class="text-white text-sm font-jost"><?php echo esc_html("$addr1, $addr2, $postcode"); ?></span>
      </div>
      <div class="hidden sm:block w-px h-5 bg-white/30"></div>
      <div class="flex items-center gap-2.5">
        <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="text-white text-sm font-jost hover:text-blue-200 transition-colors"><?php echo esc_html($phone); ?></a>
      </div>
      <div class="hidden sm:block w-px h-5 bg-white/30"></div>
      <a href="<?php echo esc_url($maps_dir_url); ?>" target="_blank" rel="noopener noreferrer"
         class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2 rounded-xl hover:bg-blue-50 transition-colors shadow font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        Get Directions
      </a>
    </div>

  </div>
</section>


<!-- ============================================================
     S3: TESTIMONIALS
     ============================================================ -->
<section class="py-16 lg:py-24" style="background:linear-gradient(180deg,#f8fafc 0%,#eff6ff 60%,#f8fafc 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <div class="text-center mb-12 loc-reveal">
      <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-sm font-medium px-5 py-2 rounded-full mb-5 border border-blue-200 font-jost">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
        Patient Reviews
      </div>
      <h2 class="text-gray-900 text-3xl lg:text-4xl font-semibold font-jost mb-4">What Our Rowlands Castle Patients Say</h2>
      <p class="text-gray-500 text-lg font-jost max-w-2xl mx-auto">Real experiences from villagers and visitors at our Rowlands Castle branch.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

      <!-- Review 1 -->
      <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-7 loc-reveal loc-card-lift" style="transition-delay:0s;">
        <div class="flex gap-1 mb-4">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><?php endfor; ?>
        </div>
        <p class="text-gray-700 text-base font-jost leading-relaxed mb-6 italic">"Such a welcoming village pharmacy. I started my weight loss injection programme here and the team have been brilliant — supportive, knowledgeable, and never rushed. Highly recommend."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center flex-shrink-0">
            <span class="text-white text-sm font-bold font-jost">SP</span>
          </div>
          <div>
            <div class="text-gray-900 font-semibold text-sm font-jost">Sarah P.</div>
            <div class="text-gray-400 text-xs font-jost">Weight Loss Injections &middot; January 2025</div>
          </div>
        </div>
      </div>

      <!-- Review 2 -->
      <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-7 loc-reveal loc-card-lift" style="transition-delay:0.1s;">
        <div class="flex gap-1 mb-4">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><?php endfor; ?>
        </div>
        <p class="text-gray-700 text-base font-jost leading-relaxed mb-6 italic">"Travelling to South America and needed yellow fever, hep A and typhoid. Got everything sorted in one visit at the travel clinic. Easier and quicker than going through my GP — properly excellent service."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center flex-shrink-0">
            <span class="text-white text-sm font-bold font-jost">JM</span>
          </div>
          <div>
            <div class="text-gray-900 font-semibold text-sm font-jost">James M.</div>
            <div class="text-gray-400 text-xs font-jost">Travel Vaccinations &middot; February 2025</div>
          </div>
        </div>
      </div>

      <!-- Review 3 -->
      <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-7 loc-reveal loc-card-lift" style="transition-delay:0.2s;">
        <div class="flex gap-1 mb-4">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><?php endfor; ?>
        </div>
        <p class="text-gray-700 text-base font-jost leading-relaxed mb-6 italic">"Used the NHS Pharmacy First service for a sinus infection — was seen, assessed and given antibiotics on the same day. No GP appointment needed. The pharmacist was thorough and reassuring throughout."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-teal-500 to-teal-700 flex items-center justify-center flex-shrink-0">
            <span class="text-white text-sm font-bold font-jost">EB</span>
          </div>
          <div>
            <div class="text-gray-900 font-semibold text-sm font-jost">Emma B.</div>
            <div class="text-gray-400 text-xs font-jost">NHS Pharmacy First &middot; March 2025</div>
          </div>
        </div>
      </div>

    </div><!-- /Review cards -->

    <!-- Trust strip -->
    <div class="flex flex-wrap items-center justify-center gap-8 loc-reveal">
      <div class="flex items-center gap-3">
        <div class="flex gap-0.5">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><?php endfor; ?>
        </div>
        <span class="text-gray-700 font-semibold text-sm font-jost">4.9/5 Average Rating</span>
      </div>
      <div class="w-px h-6 bg-gray-300 hidden md:block"></div>
      <div class="text-gray-700 font-semibold text-sm font-jost">Travel Clinic Hampshire</div>
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
      <h2 class="text-white text-3xl lg:text-4xl font-semibold font-jost mb-4">Ready to Get Started?</h2>
      <p class="text-blue-200 text-lg font-jost max-w-2xl mx-auto">Book an appointment at our Rowlands Castle branch or speak to our AI health assistant instantly.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto loc-reveal">

      <!-- Book Appointment card -->
      <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-2xl">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-gray-900 text-2xl font-semibold font-jost mb-3">Book an Appointment</h3>
        <p class="text-gray-500 font-jost mb-6 leading-relaxed">Same-day and next-day appointments available at our Rowlands Castle branch. No GP referral needed for most services.</p>
        <ul class="space-y-2 mb-8">
          <?php foreach (['No GP referral needed', 'Same-day appointments available', 'All consultations strictly private', 'GPhC-registered pharmacists'] as $pt): ?>
          <li class="flex items-center gap-3 text-gray-700 text-sm font-jost">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html($pt); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo esc_url($booking_url); ?>"
           class="flex items-center justify-center gap-2 w-full text-white font-semibold text-base px-6 py-4 rounded-2xl shadow-lg font-jost transition-all hover:shadow-xl hover:-translate-y-0.5"
           style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          Book Now — It's Free
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <p class="text-center text-gray-400 text-xs font-jost mt-3">No card required &bull; Cancel anytime</p>
      </div>

      <!-- AI Agent card -->
      <div class="rounded-3xl p-8 lg:p-10 shadow-2xl relative overflow-hidden" style="background:linear-gradient(135deg,#2e1065 0%,#4c1d95 40%,#6d28d9 100%);">
        <div class="absolute top-6 right-6">
          <div class="relative">
            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
            <div class="absolute inset-0 w-3 h-3 bg-green-400 rounded-full animate-ping opacity-75"></div>
          </div>
        </div>
        <div class="inline-flex items-center gap-1.5 bg-green-400/20 text-green-300 text-xs font-bold px-3 py-1.5 rounded-full border border-green-400/30 font-jost mb-6">
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
          INSTANT HELP
        </div>
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 bg-white/15">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-white text-2xl font-semibold font-jost mb-3">Speak to Our AI Agent</h3>
        <p class="text-purple-200 font-jost mb-6 leading-relaxed">Get instant answers about services, pricing, and availability at Rowlands Castle — available 24/7, no waiting.</p>
        <ul class="space-y-2 mb-8">
          <?php foreach (['Available 24 hours a day, 7 days a week', 'Instant answers about all services', 'Check availability before booking', 'Completely free to use'] as $pt): ?>
          <li class="flex items-center gap-3 text-purple-100 text-sm font-jost">
            <svg class="w-5 h-5 text-purple-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <?php echo esc_html($pt); ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo esc_url(home_url('/ai-agent/')); ?>"
           class="flex items-center justify-center gap-2 w-full bg-white/15 border border-white/30 text-white font-semibold text-base px-6 py-4 rounded-2xl font-jost hover:bg-white/25 transition-all backdrop-blur-sm">
          Chat with AI Agent
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
<section class="py-16 lg:py-24" style="background:linear-gradient(180deg,#f8fafc 0%,#eff6ff 50%,#dbeafe 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <div class="text-center mb-12 loc-reveal">
      <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-sm font-medium px-5 py-2 rounded-full mb-5 border border-blue-200 font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Our Locations
      </div>
      <h2 class="text-gray-900 text-3xl lg:text-4xl font-semibold font-jost mb-4">Other Southdowns Branches</h2>
      <p class="text-gray-500 text-lg font-jost max-w-2xl mx-auto">We serve communities across Hampshire. Find your nearest branch below.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php foreach ( $other_branches as $i => $b ) : ?>
      <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col loc-reveal" style="transition-delay:<?php echo $i * 0.1; ?>s;">

        <div class="relative h-48 overflow-hidden">
          <img src="<?php echo esc_url($b['img']); ?>"
               alt="<?php echo esc_attr($b['name']); ?> pharmacy"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
          <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 to-transparent flex items-end p-5">
            <h3 class="text-white text-xl font-semibold font-jost"><?php echo esc_html($b['name']); ?></h3>
          </div>
        </div>

        <div class="p-6 flex flex-col flex-1">
          <div class="flex items-start gap-2.5 mb-3">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <address class="text-gray-600 text-sm not-italic font-jost leading-snug"><?php echo esc_html($b['addr']); ?></address>
          </div>
          <div class="flex items-center gap-2.5 mb-3">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <a href="tel:<?php echo esc_attr($b['phone_raw']); ?>" class="text-gray-600 text-sm font-jost hover:text-blue-600 transition-colors"><?php echo esc_html($b['phone']); ?></a>
          </div>
          <div class="flex items-start gap-2.5 mb-5">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-gray-600 text-sm font-jost leading-snug">
              <div><?php echo esc_html($b['hours_wd']); ?></div>
              <div><?php echo esc_html($b['hours_sat']); ?></div>
            </div>
          </div>
          <div class="flex items-center gap-2 mb-6">
            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1.5 rounded-full border border-blue-100 font-jost">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?php echo esc_html($b['services']); ?>+ services available
            </span>
          </div>
          <div class="mt-auto">
            <a href="<?php echo esc_url($b['url']); ?>"
               class="flex items-center justify-center gap-2 w-full text-white font-semibold text-sm px-5 py-3 rounded-xl font-jost transition-all hover:shadow-lg hover:-translate-y-0.5"
               style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
              View <?php echo esc_html($b['name']); ?>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>


<!-- ============================================================
     TRUST STATS
     ============================================================ -->
<section class="py-14 lg:py-20" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-8">

      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">4</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Hampshire Branches</div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal" style="transition-delay:0.1s;">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">8+</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Healthcare Services</div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal" style="transition-delay:0.2s;">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">10,000+</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Patients Served</div>
      </div>

      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8 text-center loc-reveal" style="transition-delay:0.3s;">
        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
        </div>
        <div class="text-4xl lg:text-5xl font-bold text-white font-jost mb-2">5★</div>
        <div class="text-blue-100 text-sm font-medium font-jost">Patient Rated</div>
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
