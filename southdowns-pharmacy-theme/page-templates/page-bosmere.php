<?php
/**
 * Template Name: Bosmere Location
 *
 * Dedicated location page for the Bosmere Medical Centre branch.
 * Bosmere Medical Centre, Solent Road, Havant, Hampshire, PO9 1DQ
 * Tel: 023 9248 1721
 * Mon–Sat 8am–9pm | Sun 10am–2pm
 */

get_header();

$booking_url   = sp_booking_url();

// ── Hero ────────────────────────────────────────────────────────
$hero_img      = get_field('branch_hero_image')          ?: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1200&h=800&fit=crop';
$hero_subtitle = get_field('branch_hero_subtitle')       ?: 'Your Pharmacy at Bosmere Medical Centre';
$hero_desc     = get_field('branch_hero_description')    ?: 'Expert healthcare services in Havant. Open 7 days a week with extended evening hours — no GP referral needed for most services.';

// ── Services offered at this branch ─────────────────────────────
$bosmere_services_featured = [ 'Weight Loss Injections', 'Travel Vaccinations', 'Ear Wax Removal' ];
$bosmere_services = [
    'B12 Injection','Covid Vaccination','Cholesterol Check','Flu Vaccination',
    'Free Contraceptive Service','Full Blood Count','Hypertension Check',
    'HPV Vaccinations','NHS Pharmacy First','RSV Vaccinations',
    'Shingles Vaccinations','Travel Vaccinations','Thyroid Health Check',
    'Weight Loss Injections','Weight Loss Consultation','Ear Wax Removal',
];
// Editable via Branch Location Details → Services. Leave empty to use the defaults above.
$svc_rows = function_exists('get_field') ? get_field('branch_services') : null;
if ( ! empty( $svc_rows ) ) {
    $bosmere_services          = array_column( $svc_rows, 'name' );
    $bosmere_services_featured = array_column( array_filter( $svc_rows, function ( $r ) { return ! empty( $r['featured'] ); } ), 'name' );
}

// ── Contact & Hours ─────────────────────────────────────────────
$addr1         = get_field('branch_address_line1')       ?: 'Bosmere Medical Centre, Solent Road';
$addr2         = get_field('branch_address_line2')       ?: 'Havant, Hampshire';
$postcode      = get_field('branch_postcode')            ?: 'PO9 1DQ';
$phone         = get_field('branch_phone')               ?: '023 9248 1721';
$phone_raw     = get_field('branch_phone_raw')           ?: '02392481721';
$hours_wd      = get_field('branch_hours_weekday')       ?: 'Mon–Sat 8am–9pm';
$hours_sat     = get_field('branch_hours_saturday')      ?: '';
$hours_sun     = get_field('branch_hours_sunday')        ?: 'Sun 10am–2pm';
$parking       = get_field('branch_parking')             ?: 'On-site patient parking';

// ── Map & Directions ────────────────────────────────────────────
$maps_src      = get_field('branch_maps_embed_src')      ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2518.970574133293!2d-0.9930838234190923!3d50.85022917167127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487445626c78f6ef%3A0x88068c388ee95ca1!2sBosmere%20Pharmacy-%20Travel%20Vaccinations%20%26%20Yellow%20Fever%20Centre%2C%20Weight%20Loss%20Injections.!5e0!3m2!1sen!2suk!4v1778830823352!5m2!1sen!2suk';
$maps_dir_url  = get_field('branch_maps_directions_url') ?: 'https://www.google.com/maps/dir/?api=1&destination=Bosmere+Medical+Centre,+Solent+Road,+Havant,+Hampshire+PO9+1DQ';
$by_car        = get_field('branch_by_car')              ?: 'Easily accessible from the A27 and A3(M) Havant interchange. Large free car park directly outside the pharmacy.';
$car_tags_raw  = get_field('branch_by_car_tags')         ?: 'Off A27 / A3(M),Large free car park';
$by_bus        = get_field('branch_by_bus')              ?: 'Stagecoach bus routes serve Havant town centre with stops close to Solent Road. The town\'s central bus interchange is nearby.';
$bus_routes_raw= get_field('branch_bus_routes')          ?: '30,31,700';
$by_train      = get_field('branch_by_train')            ?: 'Bedhampton is the closest station (~555m, 7 min walk). Havant Station is approx 860m away (~11 min walk). Both are served by South Western Railway and Southern.';
$train_stn_raw = get_field('branch_train_stations')      ?: 'Bedhampton Station|7 min walk,Havant Station|11 min walk';
$on_foot       = get_field('branch_on_foot')             ?: 'Located within Bosmere Medical Centre on Solent Road. The centre is well signposted and easy to find from the surrounding residential area.';
$landmark      = get_field('branch_landmark')            ?: 'Bosmere Medical Centre';

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
?>

<!-- Page-scoped styles -->
<style>
  .loc-reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
  .loc-reveal.loc-visible { opacity: 1; transform: translateY(0); }
  .loc-card-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
  .loc-card-lift:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }

  /* Branch card — subtle lift only, no overlay (matches weight loss page) */
  .branch-card-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
  .branch-card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.10); }
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
    <span class="text-gray-800 font-medium">Bosmere, Havant</span>
  </div>
</div>


<!-- ============================================================
     S1: HERO
     ============================================================ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Mobile: full-bleed image + gradient overlay -->
  <div class="md:hidden absolute inset-0 bg-cover bg-center"
       style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>
  <div class="md:hidden absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/70 to-transparent"></div>
  <div class="md:hidden absolute inset-0 flex flex-col justify-end px-6 py-8 z-10">
    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full mb-4 border border-white/20 self-start font-jost">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      GPhC Registered &bull; Bosmere Medical Centre
    </div>
    <h1 class="text-white text-3xl font-semibold leading-tight mb-4 font-jost" style="line-height:1.2;"><?php echo esc_html( $hero_subtitle ); ?></h1>
    <p class="text-white text-base leading-relaxed mb-5 font-jost"><?php echo esc_html( $hero_desc ); ?></p>
    <div class="flex flex-wrap gap-3 mb-4">
      <a href="<?php echo esc_url($booking_url); ?>" class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg font-jost">
        Book Appointment
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
    <p class="text-white/90 text-sm font-jost"><?php echo esc_html( $hours_wd ); ?><?php if ( $hours_sun ) : ?> &nbsp;|&nbsp; <?php echo esc_html( $hours_sun ); ?><?php endif; ?><?php if ( $parking ) : ?> &nbsp;|&nbsp; <?php echo esc_html( $parking ); ?><?php endif; ?></p>
  </div>

  <!-- Desktop: two-column split -->
  <div class="hidden md:flex relative">

    <!-- Left: solid blue panel -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] flex flex-col justify-center pl-12 pr-16 lg:pl-16 lg:pr-28 py-12" style="background-color:#1a73e9;">
      <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-5 py-2.5 rounded-full mb-6 border border-white/20 self-start font-jost">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        GPhC Registered &bull; Bosmere, Havant
      </div>
      <h1 class="text-white text-4xl lg:text-[48px] font-semibold mb-6 font-jost" style="line-height:1.1;"><?php echo esc_html( $hero_subtitle ); ?></h1>
      <p class="text-white text-lg lg:text-xl leading-relaxed mb-6 font-jost"><?php echo esc_html( $hero_desc ); ?></p>
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
          <?php echo esc_html( $hours_wd ); ?>
        </div>
        <?php if ( $hours_sun ) : ?>
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo esc_html( $hours_sun ); ?>
        </div>
        <?php endif; ?>
        <div class="flex items-center gap-2">
          <span class="inline-flex items-center gap-1.5 bg-white/20 text-white text-sm font-semibold px-3 py-1 rounded-full border border-white/30 font-jost">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Open 7 Days a Week
          </span>
        </div>
      </div>
    </div>

    <!-- Right: hero image -->
    <div class="w-1/2 min-h-[500px] lg:min-h-[600px] bg-cover bg-center"
         style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>

    <!-- Centre-straddling HTML/CSS roundel badges -->
    <?php
    $bos_font = "-apple-system,BlinkMacSystemFont,'Segoe UI','Inter','Helvetica Neue',Arial,sans-serif";
    $bos_txt  = "font-family:{$bos_font};-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:geometricPrecision;";
    ?>

    <!-- Roundel 1: Rated 5-Star Service (top) -->
    <div class="absolute z-30" style="left:50%;top:11%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#ffffff;box-shadow:0 0 0 2.5px #1e3a8a,0 0 0 6px rgba(255,255,255,0.85),0 10px 28px rgba(30,58,138,0.20);display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:12px;">
        <span style="display:block;color:#1e3a8a;font-size:9px;font-weight:600;letter-spacing:.03em;line-height:1.3;text-transform:uppercase;<?php echo $bos_txt; ?>">Rated</span>
        <span style="display:block;color:#1e3a8a;font-size:12px;font-weight:800;letter-spacing:.01em;line-height:1.15;text-transform:uppercase;<?php echo $bos_txt; ?>">5-Star</span>
        <span style="display:block;color:#1e3a8a;font-size:9px;font-weight:600;letter-spacing:.03em;line-height:1.3;text-transform:uppercase;<?php echo $bos_txt; ?>">Service</span>
        <span style="display:block;color:#f59e0b;font-size:12px;line-height:1.35;letter-spacing:1.5px;margin-top:2px;">★★★★★</span>
        <span style="display:block;color:#4b5563;font-size:7.5px;font-weight:500;letter-spacing:.02em;line-height:1.3;<?php echo $bos_txt; ?>">Over 400 Reviews</span>
      </div>
    </div>

    <!-- Roundel 2: Weight Loss Injections (centre, teal gradient) -->
    <div class="absolute z-30" style="left:50%;top:50%;transform:translate(-50%,-50%);">
      <div style="width:148px;height:148px;border-radius:50%;background:linear-gradient(145deg,#0f766e,#0d9488,#14b8a6);box-shadow:0 0 0 2.5px #ffffff,0 0 0 6px rgba(13,148,136,0.50),0 12px 32px rgba(13,148,136,0.32);display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:14px;">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#ffffff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:5px;flex-shrink:0;">
          <path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2v-4M9 21H5a2 2 0 0 1-2-2v-4m0 0h18"/>
        </svg>
        <span style="display:block;color:#ffffff;font-size:10px;font-weight:700;letter-spacing:.03em;line-height:1.35;text-transform:uppercase;<?php echo $bos_txt; ?>">Weight Loss</span>
        <span style="display:block;color:#ffffff;font-size:10px;font-weight:700;letter-spacing:.03em;line-height:1.35;text-transform:uppercase;<?php echo $bos_txt; ?>">Injections</span>
        <span style="display:block;color:rgba(255,255,255,0.85);font-size:8.5px;font-weight:600;letter-spacing:.03em;line-height:1.4;text-transform:uppercase;<?php echo $bos_txt; ?>">Medically Supervised</span>
      </div>
    </div>

    <!-- Roundel 3: Open 7 Days (bottom) -->
    <div class="absolute z-30" style="left:50%;bottom:11%;transform:translateX(-50%);">
      <div style="width:132px;height:132px;border-radius:50%;background:#ffffff;box-shadow:0 0 0 2.5px #1e3a8a,0 0 0 6px rgba(255,255,255,0.85),0 10px 28px rgba(30,58,138,0.20);display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:12px;">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#1e3a8a" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:4px;flex-shrink:0;">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        <span style="display:block;color:#1e3a8a;font-size:9px;font-weight:600;letter-spacing:.03em;line-height:1.3;text-transform:uppercase;<?php echo $bos_txt; ?>">Open</span>
        <span style="display:block;color:#1e3a8a;font-size:13px;font-weight:800;letter-spacing:.01em;line-height:1.2;text-transform:uppercase;<?php echo $bos_txt; ?>">7 Days</span>
        <span style="display:block;color:#4b5563;font-size:7.5px;font-weight:500;letter-spacing:.02em;line-height:1.35;<?php echo $bos_txt; ?>">Mon–Sat 8am–9pm</span>
      </div>
    </div>

  </div>

</section>


<!-- ============================================================
     S1B: SERVICES AVAILABLE AT BOSMERE
     ============================================================ -->
<section class="relative py-16 lg:py-20 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="absolute top-0 right-0 w-[500px] h-[400px] bg-blue-200/15 rounded-full translate-x-1/4 -translate-y-1/4 blur-3xl"></div>
  <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-10 loc-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-5">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">What We Offer</span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-800 mb-4 font-jost">Services Available at Bosmere</h2>
      <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed font-jost">Walk in or book ahead — <?php echo count( $bosmere_services ); ?> services available, no GP referral needed for most.</p>
    </div>

    <div class="grid grid-cols-2 gap-2.5 [&>span]:w-full [&>span]:justify-center md:flex md:flex-wrap md:justify-center md:gap-3 md:[&>span]:w-auto loc-reveal">
      <?php foreach ( $bosmere_services as $svc ) :
        $is_featured = in_array( $svc, $bosmere_services_featured, true );
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
     S2: MAP & DIRECTIONS
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
      <h2 class="text-white text-3xl lg:text-4xl font-semibold font-jost mb-4">Find Our Bosmere Branch</h2>
      <p class="text-blue-100 text-lg font-jost max-w-2xl mx-auto">Multiple ways to reach us — by car, bus, train, or on foot.</p>
    </div>

    <!-- Map + Address row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10 loc-reveal">

      <!-- Google Map -->
      <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-2xl bg-white/10" style="min-height:380px;">
        <?php if ( $maps_src ) : ?>
          <iframe src="<?php echo esc_url($maps_src); ?>" title="Map showing Bosmere Pharmacy at Bosmere Medical Centre, Solent Road, Havant" width="100%" height="380" style="border:0;display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <?php else : ?>
          <div class="flex items-center justify-center h-[380px] bg-white/10">
            <p class="text-white/60 font-jost text-sm">Map coming soon</p>
          </div>
        <?php endif; ?>
      </div>

      <!-- Address card -->
      <div class="flex flex-col justify-between bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 lg:p-8">
        <div>
          <h3 class="text-white font-semibold text-xl font-jost mb-4">Bosmere Pharmacy</h3>
          <div class="flex items-start gap-3 mb-5">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <address class="text-white not-italic font-jost leading-relaxed text-sm">
              <?php if ( $addr1 ) echo esc_html( $addr1 ) . '<br>'; ?>
              <?php if ( $addr2 ) echo esc_html( $addr2 ) . '<br>'; ?>
              <?php if ( $postcode ) echo esc_html( $postcode ); ?>
            </address>
          </div>
          <div class="flex items-start gap-3 mb-5">
            <svg class="w-5 h-5 text-blue-200 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-white font-jost text-sm leading-relaxed">
              <div><?php echo esc_html( $hours_wd ); ?></div>
              <?php if ( $hours_sun ) : ?><div><?php echo esc_html( $hours_sun ); ?></div><?php endif; ?>
              <div class="mt-1.5 inline-flex items-center gap-1 bg-green-400/20 text-green-300 text-xs font-medium px-2 py-0.5 rounded-full border border-green-400/30 font-jost">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Open 7 days a week
              </div>
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

    <!-- 4 Direction cards — each with a unique accent colour top border -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 loc-reveal">

      <!-- By Car — amber accent -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#f59e0b,#fbbf24);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(245,158,11,0.2);border:1px solid rgba(245,158,11,0.3);">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#fbbf24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2.5 0M13 16H3m10 0h2m4-6l-2-4H9l-2 4h12z"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-3">By Car</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-5"><?php echo esc_html( $by_car ); ?></p>
        <?php if ( $car_tag_list ) : ?>
        <div class="flex flex-wrap gap-2">
          <?php foreach ( $car_tag_list as $tag ) : ?>
            <span class="text-sm font-semibold px-4 py-1.5 rounded-full font-jost" style="background:rgba(245,158,11,0.2);border:1px solid rgba(245,158,11,0.35);color:#fcd34d;"><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- By Bus — sky-blue accent -->
      <!-- Bus routes verified against bustimes.org, May 2026 -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#38bdf8,#7dd3fc);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(56,189,248,0.2);border:1px solid rgba(56,189,248,0.3);">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#7dd3fc" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 19v2m8-2v2M3 10h18M8 5V3m8 2V3"/><circle cx="8" cy="15" r="1" fill="#7dd3fc"/><circle cx="16" cy="15" r="1" fill="#7dd3fc"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-3">By Bus</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-5"><?php echo esc_html( $by_bus ); ?></p>
        <?php if ( $bus_route_list ) : ?>
        <div class="flex flex-wrap gap-2">
          <?php foreach ( $bus_route_list as $route ) : ?>
            <span class="text-sm font-bold px-4 py-1.5 rounded-full font-jost" style="background:rgba(56,189,248,0.2);border:1px solid rgba(56,189,248,0.35);color:#7dd3fc;">Route <?php echo esc_html( $route ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- By Train — teal accent (Bedhampton closest, then Havant — corrected) -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#2dd4bf,#5eead4);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(45,212,191,0.2);border:1px solid rgba(45,212,191,0.3);">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#5eead4" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19l-2 3m14-3l-2 3M5 7h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 15a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2zM12 7V4"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-3">By Train</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-5"><?php echo esc_html( $by_train ); ?></p>
        <?php if ( $train_list ) : ?>
        <div class="flex flex-col gap-2">
          <?php foreach ( $train_list as $i => $stn ) : ?>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1.5 sm:gap-2 rounded-lg px-3 py-2.5" style="background:rgba(45,212,191,0.12);border:1px solid rgba(45,212,191,0.25);">
              <div class="flex items-center gap-2 flex-wrap min-w-0">
                <?php if ( $i === 0 ) : ?>
                  <span class="text-[11px] font-bold px-2 py-0.5 rounded whitespace-nowrap" style="background:rgba(45,212,191,0.3);color:#5eead4;letter-spacing:.05em;">CLOSEST</span>
                <?php endif; ?>
                <span class="text-white text-sm font-semibold font-jost"><?php echo esc_html( $stn['name'] ); ?></span>
              </div>
              <span class="text-teal-200 text-sm font-semibold font-jost whitespace-nowrap"><?php echo esc_html( $stn['time'] ); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- On Foot — green accent -->
      <div class="relative bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 loc-card-lift overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-[3px] rounded-t-2xl" style="background:linear-gradient(90deg,#4ade80,#86efac);"></div>
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background:rgba(74,222,128,0.2);border:1px solid rgba(74,222,128,0.3);">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#86efac" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14l-4 4m4-4l4 4m-4-4v6"/></svg>
        </div>
        <h4 class="text-white font-bold text-lg font-jost mb-3">On Foot</h4>
        <p class="text-white text-base font-jost leading-relaxed mb-5"><?php echo esc_html( $on_foot ); ?></p>
        <?php if ( $landmark ) : ?>
        <div class="flex items-center gap-2.5 rounded-lg px-3 py-2.5" style="background:rgba(74,222,128,0.12);border:1px solid rgba(74,222,128,0.25);">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="#86efac" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
          <span class="text-white text-sm font-semibold font-jost">Near <?php echo esc_html( $landmark ); ?></span>
        </div>
        <?php endif; ?>
      </div>

    </div><!-- /Direction cards -->

    <!-- Address & contact strip -->
    <div class="mt-12 loc-reveal">
      <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-10 bg-white/8 backdrop-blur-sm border border-white/15 rounded-2xl px-8 py-6">
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-blue-200 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <address class="not-italic text-white text-sm font-jost leading-relaxed">
            Bosmere Medical Centre, Solent Road<br>Havant, Hampshire, PO9 1DQ
          </address>
        </div>
        <div class="hidden md:block w-px h-10 bg-white/20"></div>
        <div class="flex items-center gap-3">
          <svg class="w-5 h-5 text-blue-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          <a href="tel:02392481721" class="text-white text-sm font-semibold font-jost hover:text-blue-200 transition-colors">02392 481721</a>
        </div>
        <div class="hidden md:block w-px h-10 bg-white/20"></div>
        <a href="<?php echo esc_url( $maps_dir_url ); ?>" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 bg-white text-blue-700 text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-blue-50 transition-colors shadow-lg font-jost">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          Get Directions
        </a>
      </div>
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
      <h2 class="text-gray-900 text-3xl lg:text-4xl font-semibold font-jost mb-4">What Our Bosmere Patients Say</h2>
      <p class="text-gray-500 text-lg font-jost max-w-2xl mx-auto">Real experiences from patients at our Bosmere Medical Centre branch.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
      <?php
      // Editable via Branch Location Details → Testimonials. Leave empty to show these defaults.
      $reviews_default = [
        [ 'quote' => 'Having a pharmacy right inside the medical centre is incredibly convenient. I can see my doctor and collect my prescription all in one visit. The staff are always welcoming and efficient.', 'author_name' => 'Patricia K.', 'author_initials' => 'PK', 'service' => 'Prescription Services', 'review_date' => 'March 2025', 'avatar_bg' => 'from-blue-500 to-blue-700' ],
        [ 'quote' => 'I needed a travel health consultation at short notice and they fit me in the same day. Thorough, professional, and the evening hours are a lifesaver when you can\'t get away from work during the day.', 'author_name' => 'Simon B.', 'author_initials' => 'SB', 'service' => 'Travel Health', 'review_date' => 'February 2025', 'avatar_bg' => 'from-indigo-500 to-indigo-700' ],
        [ 'quote' => 'Came in on a Sunday for a minor ailment — couldn\'t believe the pharmacy was open. The pharmacist was just as thorough as any weekday visit. Brilliant service and so handy being inside the medical centre.', 'author_name' => 'Angela H.', 'author_initials' => 'AH', 'service' => 'Minor Ailments', 'review_date' => 'January 2025', 'avatar_bg' => 'from-teal-500 to-teal-700' ],
      ];
      $reviews = function_exists('get_field') ? get_field('branch_testimonials') : null;
      if ( empty( $reviews ) ) { $reviews = $reviews_default; }
      $review_delays = [ '0', '0.1', '0.2' ];
      foreach ( $reviews as $ri => $rev ) :
        $bg = ! empty( $rev['avatar_bg'] ) ? $rev['avatar_bg'] : 'from-blue-500 to-blue-700';
      ?>
      <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-7 loc-reveal loc-card-lift" style="transition-delay:<?php echo esc_attr( $review_delays[ $ri ] ?? '0' ); ?>s;">
        <div class="flex gap-1 mb-4">
          <?php for($s=0;$s<5;$s++): ?><svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><?php endfor; ?>
        </div>
        <p class="text-gray-700 text-base font-jost leading-relaxed mb-6 italic">"<?php echo esc_html( $rev['quote'] ); ?>"</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br <?php echo esc_attr( $bg ); ?> flex items-center justify-center flex-shrink-0">
            <span class="text-white text-sm font-bold font-jost"><?php echo esc_html( $rev['author_initials'] ); ?></span>
          </div>
          <div>
            <div class="text-gray-900 font-semibold text-sm font-jost"><?php echo esc_html( $rev['author_name'] ); ?></div>
            <div class="text-gray-400 text-xs font-jost"><?php echo esc_html( $rev['service'] ); ?> &middot; <?php echo esc_html( $rev['review_date'] ); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
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
      <div class="text-gray-700 font-semibold text-sm font-jost">Open 7 Days a Week</div>
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
      <p class="text-blue-200 text-lg font-jost max-w-2xl mx-auto">Book an appointment at our Bosmere branch or speak to our AI health assistant instantly.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto loc-reveal">

      <!-- Book Appointment card -->
      <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-2xl">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6);">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-gray-900 text-2xl font-semibold font-jost mb-3"><?php echo get_field( 'branch_book_heading' ) ?: 'Book an Appointment'; ?></h3>
        <p class="text-gray-500 font-jost mb-6 leading-relaxed">Same-day appointments available at Bosmere Medical Centre, with extended evening and weekend hours to fit around your schedule.</p>
        <ul class="space-y-2 mb-8">
          <?php
          $cta_points_raw = function_exists( 'get_field' ) ? get_field( 'branch_book_points' ) : '';
          $cta_points = $cta_points_raw ? array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $cta_points_raw ) ) ) ) : ['No GP referral needed', 'Open 7 days — including evenings', 'All consultations strictly private', 'GPhC-registered pharmacists'];
          foreach ( $cta_points as $pt ): ?>
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
        <div class="absolute top-6 right-6">
          <div class="relative">
            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
            <div class="absolute inset-0 w-3 h-3 bg-green-400 rounded-full animate-ping opacity-75"></div>
          </div>
        </div>
        <div class="inline-flex items-center gap-1.5 bg-green-400/20 text-green-300 text-xs font-bold px-3 py-1.5 rounded-full border border-green-400/30 font-jost mb-6">
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
          <?php echo get_field( 'branch_ai_badge' ) ?: 'INSTANT HELP'; ?>
        </div>
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6 bg-white/15">
          <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="text-white text-2xl font-semibold font-jost mb-3"><?php echo get_field( 'branch_ai_heading' ) ?: 'Speak to Our AI Agent'; ?></h3>
        <p class="text-purple-200 font-jost mb-6 leading-relaxed">Get instant answers about services, pricing, and availability at Bosmere — available 24/7, no waiting.</p>
        <ul class="space-y-2 mb-8">
          <?php
          $ai_points_raw = function_exists( 'get_field' ) ? get_field( 'branch_ai_points' ) : '';
          $ai_points = $ai_points_raw ? array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $ai_points_raw ) ) ) ) : ['Available 24 hours a day, 7 days a week', 'Instant answers about all services', 'Check availability before booking', 'Completely free to use'];
          foreach ( $ai_points as $pt ): ?>
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
     S3B: INLINE BOOKING — BOSMERE PRE-FILTERED
     ============================================================ -->
<section class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]" id="book-bosmere">
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-2 md:mb-3 loc-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost">Book at Bosmere &middot; Same-Day Availability</span>
      </div>
      <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-800 mb-6 font-jost">Book Your Bosmere Appointment</h2>
      <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-jost">Choose your service and time — your appointment will be at Bosmere Medical Centre.</p>
    </div>
    <?php echo do_shortcode('[ameliastepbooking layout=2 location=2 show=category,service,employee,datetime,info]'); ?>
  </div>
</section>

<!-- ============================================================
     S5: OTHER BRANCHES
     ============================================================ -->
<?php
$other_branches = [
  [
    'name'     => 'Emsworth',
    'addr'     => '2-4 Central Buildings, Emsworth, PO10 7DU',
    'phone'    => '01243 968 869',
    'phone_raw'=> '01243968869',
    'hours_wd' => 'Mon–Fri 9am–7pm',
    'hours_sat'=> 'Sat 9am–5pm',
    'services' => 8,
    'img'      => get_field('branch_other_emsworth_image') ?: 'https://images.unsplash.com/photo-1582560475093-ba66accbc424?w=600&h=400&fit=crop',
    'url'      => home_url('/emsworth/'),
  ],
  [
    'name'     => 'Rowlands Castle',
    'addr'     => '14 The Green, Rowlands Castle, PO9 6BN',
    'phone'    => '023 9212 3456',
    'phone_raw'=> '02392123456',
    'hours_wd' => 'Mon–Fri 9am–6pm',
    'hours_sat'=> 'Sat 9am–1pm',
    'services' => 8,
    'img'      => get_field('branch_other_rowlands_image') ?: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
    'url'      => home_url('/rowlands-pharmacy/'),
  ],
  [
    'name'     => 'Davies Pharmacy',
    'addr'     => 'Hampshire',
    'phone'    => sp_phone(),
    'phone_raw'=> sp_phone_raw(),
    'hours_wd' => 'Mon–Fri 9am–6pm',
    'hours_sat'=> 'Sat 9am–1pm',
    'services' => 8,
    'img'      => get_field('branch_other_davies_image') ?: 'https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=600&h=400&fit=crop',
    'url'      => home_url('/davies-pharmacy/'),
  ],
];
?>
<section class="py-16 lg:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-12 loc-reveal">
      <div class="premium-badge flex items-center justify-center gap-4 mb-4">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Our Locations</span>
      </div>
      <h2 class="text-gray-900 text-3xl lg:text-4xl font-bold font-jost mb-4">Other Southdowns Branches</h2>
      <p class="text-gray-500 text-lg font-jost max-w-2xl mx-auto">We serve communities across Hampshire. Find your nearest branch below.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 loc-reveal">
      <?php foreach ( $other_branches as $b ) : ?>
      <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col">
        <!-- Photo with name overlay — image zoom on group-hover, no overlay on hover -->
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?php echo esc_url($b['img']); ?>" alt="<?php echo esc_attr($b['name']); ?> pharmacy"
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <div class="absolute bottom-3 left-3">
            <h3 class="text-white text-xl font-bold font-jost"><?php echo esc_html($b['name']); ?></h3>
          </div>
        </div>
        <!-- Card body -->
        <div class="p-5 flex flex-col flex-1">
          <div class="flex items-start gap-2 mb-2">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <address class="text-gray-600 text-sm not-italic font-jost"><?php echo esc_html($b['addr']); ?></address>
          </div>
          <div class="flex items-center gap-2 mb-2">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <a href="tel:<?php echo esc_attr($b['phone_raw']); ?>" class="text-gray-600 text-sm font-jost hover:text-blue-600 transition-colors"><?php echo esc_html($b['phone']); ?></a>
          </div>
          <div class="flex items-start gap-2 mb-4">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <div class="text-gray-400 text-xs font-jost leading-relaxed">
              <div><?php echo esc_html($b['hours_wd']); ?></div>
              <div><?php echo esc_html($b['hours_sat']); ?></div>
            </div>
          </div>
          <div class="mb-4">
            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1.5 rounded-full border border-blue-100 font-jost">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?php echo esc_html($b['services']); ?>+ services available
            </span>
          </div>
          <a href="<?php echo esc_url($b['url']); ?>"
             class="mt-auto flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-3 rounded-xl transition-colors font-jost">
            View <?php echo esc_html($b['name']); ?> Branch
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
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




