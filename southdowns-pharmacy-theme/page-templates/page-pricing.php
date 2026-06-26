<?php
/**
 * Template Name: Pricing
 *
 * Categorised service price list + the full Amelia booking flow.
 *
 * Setup: create a Page titled "Pricing" (slug "pricing"), then assign this
 * template via Page → Template. All content is editable under the "Pricing —
 * Page Content" fields (see inc/acf-pricing-fields.php). The price list itself
 * is the "Price List — Categories" repeater; sp_pricing() falls back to the
 * built-in defaults so the page always renders the correct prices.
 */
get_header();

$pr_cats  = sp_pricing();
$pr_pills = sp_list( 'pr_hero_pills', [ 'NHS &amp; Private Services', '4 Hampshire Branches', 'No GP Referral Needed' ] );
?>

<style>
  html { scroll-behavior: smooth; }
  .pr-cat { scroll-margin-top: 7rem; }
</style>

<!-- ============================================================
     BREADCRUMB
     ============================================================ -->
<div class="bg-gray-50 border-b border-gray-200 px-4 md:px-8 lg:px-12 py-3">
  <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm font-jost">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-blue-600 hover:text-blue-800 transition-colors">Home</a>
    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span class="text-gray-800 font-medium">Pricing</span>
  </div>
</div>

<!-- ============================================================
     HERO — blue gradient
     ============================================================ -->
<section class="relative overflow-hidden" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);">
  <div class="dot-pattern absolute inset-0"></div>
  <div class="relative z-10 max-w-5xl mx-auto px-4 md:px-8 py-16 md:py-24 text-center">
    <div class="flex items-center justify-center gap-4 mb-6">
      <div class="w-10 h-px bg-white/30"></div>
      <span class="text-white/80 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'pr_hero_eyebrow', 'Transparent Pricing' ); ?></span>
      <div class="w-10 h-px bg-white/30"></div>
    </div>
    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6 font-jost"><?php echo sp_field( 'pr_hero_heading', 'Our Service Prices' ); ?></h1>
    <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed mb-8 font-jost"><?php echo sp_field( 'pr_hero_intro', 'Clear, up-front pricing for every NHS and private service across our four Hampshire pharmacies &mdash; no hidden costs.' ); ?></p>
    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php foreach ( $pr_pills as $pr_pill ) : ?>
      <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-2 rounded-full border border-white/25 font-jost">
        <svg class="w-4 h-4 text-white/90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
        <?php echo $pr_pill; ?>
      </span>
      <?php endforeach; ?>
    </div>
    <a href="#book" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold px-8 py-4 rounded-full hover:bg-blue-50 transition-colors shadow-lg text-lg font-jost">
      Book an Appointment
      <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>
  </div>
</section>

<!-- ============================================================
     PRICE LIST — quick-nav + masonry of category cards
     ============================================================ -->
<section class="py-16 md:py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <?php $pr_note = sp_field( 'pr_intro_note', '' ); if ( $pr_note ) : ?>
    <p class="text-center text-slate-500 text-sm md:text-base font-jost max-w-3xl mx-auto mb-10 leading-relaxed"><?php echo $pr_note; ?></p>
    <?php endif; ?>

    <!-- Category quick-nav -->
    <div class="flex flex-wrap justify-center gap-2 mb-12">
      <?php foreach ( $pr_cats as $pr_c ) : if ( empty( $pr_c['name'] ) ) { continue; } $pr_slug = sanitize_title( $pr_c['name'] ); ?>
      <a href="#<?php echo esc_attr( $pr_slug ); ?>" class="inline-flex items-center text-sm font-medium text-slate-600 bg-[#fdf9f6] border border-[#e8e0d8] px-4 py-2 rounded-full hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-colors font-jost"><?php echo esc_html( $pr_c['name'] ); ?></a>
      <?php endforeach; ?>
    </div>

    <!-- Masonry of price cards -->
    <div class="columns-1 md:columns-2 lg:columns-3 gap-6">
      <?php foreach ( $pr_cats as $pr_c ) :
        if ( empty( $pr_c['name'] ) ) { continue; }
        $pr_slug = sanitize_title( $pr_c['name'] );
      ?>
      <div id="<?php echo esc_attr( $pr_slug ); ?>" class="pr-cat break-inside-avoid mb-6 bg-[#fdf9f6] border border-[#e8e0d8] rounded-2xl p-6">
        <h2 class="text-xl md:text-2xl font-bold text-slate-800 font-jost mb-1"><?php echo esc_html( $pr_c['name'] ); ?></h2>
        <?php if ( ! empty( $pr_c['description'] ) ) : ?>
        <p class="text-sm text-slate-500 font-jost leading-relaxed mb-4"><?php echo esc_html( $pr_c['description'] ); ?></p>
        <?php else : ?>
        <div class="mb-4"></div>
        <?php endif; ?>

        <ul class="divide-y divide-[#e8e0d8]">
          <?php foreach ( $pr_c['services'] as $pr_s ) :
            $pr_price = trim( (string) $pr_s['price'] );
            $pr_num   = (float) preg_replace( '/[^0-9.]/', '', $pr_price );
            $pr_free  = ( $pr_price !== '' && $pr_num == 0.0 );
          ?>
          <li class="flex items-baseline justify-between gap-4 py-3">
            <div class="min-w-0">
              <span class="block text-slate-800 font-medium font-jost leading-snug"><?php echo esc_html( $pr_s['name'] ); ?></span>
              <?php if ( ! empty( $pr_s['duration'] ) ) : ?>
              <span class="inline-flex items-center gap-1 text-xs text-slate-400 font-jost mt-1">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <?php echo esc_html( $pr_s['duration'] ); ?>
              </span>
              <?php endif; ?>
            </div>
            <div class="flex-shrink-0 text-right">
              <?php if ( $pr_free ) : ?>
              <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 text-xs font-bold uppercase tracking-wide font-jost">Free</span>
              <?php else : ?>
              <span class="text-blue-700 font-bold text-lg font-jost"><?php echo esc_html( $pr_price ); ?></span>
              <?php endif; ?>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============================================================
     BOOKING — Amelia step booking (all locations & services)
     ============================================================ -->
<section id="book" class="relative py-16 md:py-24 overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-8 md:mb-10">
      <div class="premium-badge flex items-center justify-center gap-4 mb-6">
        <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
        <span class="badge-text text-slate-500 text-sm font-normal tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'pr_book_eyebrow', 'Book Online &middot; Same-Day Availability' ); ?></span>
      </div>
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 mb-6 font-jost"><?php echo sp_field( 'pr_book_heading', 'Book Your Appointment' ); ?></h2>
      <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'pr_book_intro', 'Choose your location, service and time across our Hampshire branches. Most services need no GP referral.' ); ?></p>
    </div>
    <?php echo do_shortcode( '[ameliastepbooking layout=2 show=location,category,service,employee,datetime,info]' ); ?>
  </div>
</section>

<?php get_footer();
