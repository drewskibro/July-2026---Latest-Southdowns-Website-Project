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
  /* Hide the scrollbar on the mobile category strip */
  .pr-tabs { scrollbar-width: none; }
  .pr-tabs::-webkit-scrollbar { display: none; }
  .pr-tab { transition: background-color .2s ease, color .2s ease, border-color .2s ease; }
  /* Active category button */
  .pr-tab[aria-selected="true"] {
    background-color: #1d4ed8 !important;
    border-color: #1d4ed8 !important;
    color: #ffffff !important;
  }
  .pr-tab[aria-selected="true"] .pr-tab-count { color: rgba(255,255,255,.75) !important; }
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
     PRICE LIST — pick a category, its services appear below
     ============================================================ -->
<section class="py-12 md:py-20 bg-white">
  <div class="max-w-4xl mx-auto px-4 md:px-8">

    <?php $pr_note = sp_field( 'pr_intro_note', '' ); if ( $pr_note ) : ?>
    <p class="text-center text-slate-500 text-sm md:text-base font-jost max-w-3xl mx-auto mb-8 leading-relaxed"><?php echo $pr_note; ?></p>
    <?php endif; ?>

    <p class="text-center text-slate-400 text-xs uppercase tracking-[0.15em] font-jost mb-4">Choose a category</p>

    <!-- Category tabs (horizontal strip on mobile, wrapped on desktop) -->
    <div class="pr-tabs flex md:flex-wrap md:justify-center gap-2 overflow-x-auto md:overflow-visible pb-2 mb-8 -mx-4 px-4 md:mx-0 md:px-0" role="tablist" aria-label="Service categories">
      <?php foreach ( $pr_cats as $pr_i => $pr_c ) :
        if ( empty( $pr_c['name'] ) ) { continue; }
        $pr_slug = sanitize_title( $pr_c['name'] );
      ?>
      <button type="button" id="prtab-<?php echo esc_attr( $pr_slug ); ?>" class="pr-tab flex-shrink-0 whitespace-nowrap inline-flex items-center gap-2 text-sm font-medium text-slate-600 bg-[#fdf9f6] border border-[#e8e0d8] px-4 py-2 rounded-full hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 font-jost" role="tab" aria-controls="prpanel-<?php echo esc_attr( $pr_slug ); ?>" aria-selected="<?php echo 0 === $pr_i ? 'true' : 'false'; ?>" data-cat="<?php echo esc_attr( $pr_slug ); ?>">
        <?php echo esc_html( $pr_c['name'] ); ?>
        <span class="pr-tab-count text-xs text-slate-400 font-normal"><?php echo count( $pr_c['services'] ); ?></span>
      </button>
      <?php endforeach; ?>
    </div>

    <!-- Category panels — only the selected one is visible -->
    <?php foreach ( $pr_cats as $pr_i => $pr_c ) :
      if ( empty( $pr_c['name'] ) ) { continue; }
      $pr_slug = sanitize_title( $pr_c['name'] );
    ?>
    <div id="prpanel-<?php echo esc_attr( $pr_slug ); ?>" class="pr-panel <?php echo 0 === $pr_i ? '' : 'hidden'; ?>" role="tabpanel" aria-labelledby="prtab-<?php echo esc_attr( $pr_slug ); ?>" data-panel="<?php echo esc_attr( $pr_slug ); ?>">
      <div class="bg-[#fdf9f6] border border-[#e8e0d8] rounded-2xl p-6 md:p-8">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 font-jost mb-1"><?php echo esc_html( $pr_c['name'] ); ?></h2>
        <?php if ( ! empty( $pr_c['description'] ) ) : ?>
        <p class="text-sm md:text-base text-slate-500 font-jost leading-relaxed mb-5"><?php echo esc_html( $pr_c['description'] ); ?></p>
        <?php else : ?>
        <div class="mb-5"></div>
        <?php endif; ?>

        <ul class="divide-y divide-[#e8e0d8]">
          <?php foreach ( $pr_c['services'] as $pr_s ) :
            $pr_price = trim( (string) $pr_s['price'] );
            $pr_num   = (float) preg_replace( '/[^0-9.]/', '', $pr_price );
            $pr_free  = $pr_price !== '' && $pr_num == 0.0;
          ?>
          <li class="flex items-center justify-between gap-4 py-3.5">
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
    </div>
    <?php endforeach; ?>

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

<!-- Pricing category switcher: show only the selected category's services -->
<script>
(function () {
  var tabs   = document.querySelectorAll('.pr-tab');
  var panels = document.querySelectorAll('.pr-panel');
  if ( ! tabs.length ) { return; }
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var cat = tab.getAttribute('data-cat');
      tabs.forEach(function (t) {
        t.setAttribute('aria-selected', t.getAttribute('data-cat') === cat ? 'true' : 'false');
      });
      panels.forEach(function (p) {
        p.classList.toggle('hidden', p.getAttribute('data-panel') !== cat);
      });
    });
  });
})();
</script>

<?php get_footer();
