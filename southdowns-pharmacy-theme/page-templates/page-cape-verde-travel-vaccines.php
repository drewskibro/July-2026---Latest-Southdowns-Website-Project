<?php
/**
 * Template Name: Cape Verde Travel Vaccinations
 *
 * Hampshire Cape Verde travel health & vaccinations landing page.
 *
 * @package Southdowns_Pharmacy
 */

get_header();

// Country content (editable in WordPress — Travel Vaccines field group). Each
// page stores its own values; $tv supplies this country's defaults as fallback.
$tv = tv_data();
?>

<!-- INTERIM CONTENT: Cape Verde destination copy is placeholder pending the client's clinical brief — all medical content to be reviewed before publication. -->

<style>
  /* ───── Animated glow border (used on featured pricing card) ───── */
  @property --angle {
    syntax: '<angle>';
    initial-value: 0deg;
    inherits: false;
  }
  .yf-glow-card {
    position: relative;
    background: conic-gradient(from var(--angle), #3b82f6, #93c5fd, #3b82f6);
    animation: yf-rotate 6s linear infinite;
  }
  @keyframes yf-rotate {
    to { --angle: 360deg; }
  }

  /* ───── FAQ accordion icon rotation ───── */
  .yf-faq-trigger[aria-expanded="true"] .yf-faq-icon {
    transform: rotate(180deg);
  }

  /* ───── Reveal-on-scroll base ───── */
  .reveal-item {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.55s ease, transform 0.55s ease;
  }
</style>


<!-- ═══════════════════════════════════════════════════════
     S1 · HERO — split layout, blue gradient + image
════════════════════════════════════════════════════════ -->
<section class="relative w-full min-h-[500px] lg:min-h-[600px] overflow-hidden">

  <!-- Desktop split: 2 columns -->
  <div class="hidden lg:grid grid-cols-2 min-h-[600px]">

    <!-- Left: copy -->
    <div class="relative flex items-center px-12 xl:px-20 py-20" style="background:#1a73e9;">
      <div class="absolute inset-0 dot-pattern opacity-50 pointer-events-none"></div>
      <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.35) 0%,transparent 70%);"></div>

      <div class="relative z-10 max-w-xl">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-200"></span>
          </span>
          <?php echo sp_field( 'tv_hero_pill', $tv['tv_hero_pill'] ); ?>
        </span>
        <h1 class="text-4xl xl:text-5xl font-extrabold text-white mb-6 font-jost leading-tight"><?php echo sp_field( 'tv_hero_h1', $tv['tv_hero_h1'] ); ?></h1>
        <p class="text-blue-100 text-lg mb-8 font-jost leading-relaxed"><?php echo sp_field( 'tv_hero_intro', $tv['tv_hero_intro'] ); ?></p>

        <div class="flex flex-col sm:flex-row gap-3 mb-8">
          <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-6 py-3.5 rounded-xl font-jost hover:bg-blue-50 transition-colors duration-200 shadow-lg">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <?php echo sp_field( 'tv_hero_btn1', $tv['tv_hero_btn1'] ); ?>
          </a>
          <a href="#vaccines" class="inline-flex items-center justify-center gap-2 bg-white/15 backdrop-blur-sm text-white font-bold px-6 py-3.5 rounded-xl font-jost border border-white/30 hover:bg-white/25 transition-colors duration-200">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
            <?php echo sp_field( 'tv_hero_btn2', $tv['tv_hero_btn2'] ); ?>
          </a>
        </div>

        <!-- Trust pills -->
        <div class="flex flex-wrap gap-2">
          <?php
          $hero_pills = sp_list( 'tv_hero_pills', array_column( $tv['tv_hero_pills'], 'text' ) );
          foreach ( $hero_pills as $p ) : ?>
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold font-jost bg-white/10 backdrop-blur-sm text-blue-100 border border-white/15">
            <svg class="w-3 h-3 text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            <?php echo esc_html( $p ); ?>
          </span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Right: image -->
    <div class="relative">
      <img src="<?php echo esc_url( sp_field( 'tv_hero_image', 'https://images.unsplash.com/photo-1528181304800-259b08848526?w=1200&q=80&auto=format&fit=crop' ) ); ?>" alt="Cape Verde coastline" class="absolute inset-0 w-full h-full object-cover" loading="eager"/>
      <div class="absolute inset-0 bg-gradient-to-l from-transparent to-blue-900/20"></div>
    </div>
  </div>

  <!-- Mobile / tablet: stacked image with overlay -->
  <div class="lg:hidden relative min-h-[500px]" style="background:#1a73e9;">
    <img src="<?php echo esc_url( sp_field( 'tv_hero_image', 'https://images.unsplash.com/photo-1528181304800-259b08848526?w=1200&q=80&auto=format&fit=crop' ) ); ?>" alt="Cape Verde coastline" class="absolute inset-0 w-full h-full object-cover opacity-30" loading="eager"/>
    <div class="absolute inset-0 dot-pattern opacity-40 pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-900/40 via-blue-800/60 to-blue-900/80"></div>

    <div class="relative z-10 px-6 py-16 sm:px-10 max-w-2xl">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <span class="relative flex h-2 w-2">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-200"></span>
        </span>
        <?php echo sp_field( 'tv_hero_pill', $tv['tv_hero_pill'] ); ?>
      </span>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-5 font-jost leading-tight"><?php echo sp_field( 'tv_hero_h1', $tv['tv_hero_h1'] ); ?></h1>
      <p class="text-blue-100 text-base sm:text-lg mb-7 font-jost"><?php echo sp_field( 'tv_hero_intro', $tv['tv_hero_intro'] ); ?></p>

      <div class="flex flex-col gap-3 mb-6">
        <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-5 py-3 rounded-xl font-jost hover:bg-blue-50 transition-colors duration-200 shadow-lg">
          <?php echo sp_field( 'tv_hero_btn1', $tv['tv_hero_btn1'] ); ?>
        </a>
        <a href="#vaccines" class="inline-flex items-center justify-center gap-2 bg-white/15 backdrop-blur-sm text-white font-bold px-5 py-3 rounded-xl font-jost border border-white/30 hover:bg-white/25 transition-colors duration-200">
          <?php echo sp_field( 'tv_hero_btn2', $tv['tv_hero_btn2'] ); ?>
        </a>
      </div>

      <div class="flex flex-wrap gap-2">
        <?php foreach ( $hero_pills as $p ) : ?>
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold font-jost bg-white/10 backdrop-blur-sm text-blue-100 border border-white/15">
          <svg class="w-3 h-3 text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
          <?php echo esc_html( $p ); ?>
        </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S2 · INTRO  (light)
════════════════════════════════════════════════════════ -->
<section class="py-16 md:py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50/30">
  <div class="section-container">
    <div class="max-w-3xl mx-auto text-center">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        <?php echo sp_field( 'tv_intro_eyebrow', $tv['tv_intro_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-5 font-jost"><?php echo sp_field( 'tv_intro_h2', $tv['tv_intro_h2'] ); ?></h2>
      <p class="text-slate-700 text-lg mb-5 font-jost leading-relaxed"><?php echo sp_field( 'tv_intro_p1', $tv['tv_intro_p1'] ); ?></p>
      <p class="text-slate-600 text-base font-jost leading-relaxed"><?php echo sp_field( 'tv_intro_p2', $tv['tv_intro_p2'] ); ?></p>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S3 · VACCINES  (dark, id="vaccines")
════════════════════════════════════════════════════════ -->
<section id="vaccines" class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-1/4 right-0 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.18) 0%,transparent 70%);"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.15) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <?php echo sp_field( 'tv_vax_eyebrow', $tv['tv_vax_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'tv_vax_h2', $tv['tv_vax_h2'] ); ?></h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_vax_intro', $tv['tv_vax_intro'] ); ?></p>
    </div>

    <?php
    /* Flat, client-editable vaccine list (Travel Vaccines → Vaccines), grouped
       by category at render. Category subheads + colours stay in code. */
    $tv_vaccines = sp_rows( 'tv_vaccines', $tv['tv_vaccines'], [
      'category' => 'category', 'name' => 'name', 'who' => 'who', 'doses' => 'doses', 'desc' => 'desc',
    ] );
    $vaccine_groups = [];
    foreach ( $tv_vaccines as $v ) {
      $cat = $v['category'] ?? 'Routine Vaccines';
      $vaccine_groups[ $cat ][] = $v;
    }
    $cat_meta = [
      'Routine Vaccines'     => [ 'subhead' => 'Ensure these are up to date before travel',   'colour' => 'blue' ],
      'Recommended Vaccines' => [ 'subhead' => 'Strongly advised depending on your itinerary', 'colour' => 'amber' ],
      'Required Vaccines'    => [ 'subhead' => 'May be mandatory depending on your route',      'colour' => 'rose' ],
      'Entry Requirements'   => [ 'subhead' => 'May apply depending on your route',            'colour' => 'rose' ],
      'Antimalarial Protection' => [ 'subhead' => 'Important — malaria protection for this destination', 'colour' => 'amber' ],
    ];

    /* Colour helper for category tags */
    $tag_styles = [
      'blue'  => 'bg-blue-500/20 text-blue-200 border-blue-400/30',
      'amber' => 'bg-amber-500/20 text-amber-200 border-amber-400/30',
      'rose'  => 'bg-rose-500/20 text-rose-200 border-rose-400/30',
    ];
    $bullet_styles = [
      'blue'  => 'bg-blue-500/30 text-blue-300',
      'amber' => 'bg-amber-500/30 text-amber-300',
      'rose'  => 'bg-rose-500/30 text-rose-300',
    ];
    ?>

    <div class="space-y-12 max-w-5xl mx-auto">
      <?php $vnum = 0; foreach ( $vaccine_groups as $cat => $glist ) : $meta = $cat_meta[ $cat ] ?? [ 'subhead' => '', 'colour' => 'blue' ]; ?>
      <div>
        <!-- Group header -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-2 mb-6 border-b border-white/10 pb-4">
          <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider border <?php echo esc_attr( $tag_styles[ $meta['colour'] ] ); ?>">
              <?php echo esc_html( $cat ); ?>
            </span>
          </div>
          <p class="text-blue-300/80 text-sm font-jost"><?php echo esc_html( $meta['subhead'] ); ?></p>
        </div>

        <!-- Vaccine cards -->
        <div class="grid md:grid-cols-2 gap-4">
          <?php foreach ( $glist as $v ) : $vnum++; ?>
          <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 hover:bg-white/15 transition-colors duration-300 reveal-item">
            <div class="flex items-start gap-4 mb-3">
              <span class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold font-jost <?php echo esc_attr( $bullet_styles[ $meta['colour'] ] ); ?>">
                <?php echo esc_html( str_pad( (string) $vnum, 2, '0', STR_PAD_LEFT ) ); ?>
              </span>
              <h3 class="text-lg font-bold text-white font-jost leading-snug pt-1.5"><?php echo wp_kses_post( $v['name'] ); ?></h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3 pl-14">
              <div>
                <p class="text-blue-300/60 text-xs font-semibold uppercase tracking-wider font-jost mb-0.5">Who needs it</p>
                <p class="text-blue-100 text-sm font-jost"><?php echo esc_html( $v['who'] ); ?></p>
              </div>
              <div>
                <p class="text-blue-300/60 text-xs font-semibold uppercase tracking-wider font-jost mb-0.5">Doses</p>
                <p class="text-blue-100 text-sm font-jost"><?php echo wp_kses_post( $v['doses'] ); ?></p>
              </div>
            </div>
            <p class="text-blue-100/80 text-sm font-jost leading-relaxed pl-14"><?php echo wp_kses_post( $v['desc'] ); ?></p>

            <?php if ( false !== strpos( $v['name'], 'Yellow Fever' ) ) : ?>
            <!-- Yellow Fever — Bosmere, Havant callout -->
            <div class="mt-4 ml-14 rounded-xl border border-amber-400/40 bg-amber-500/15 px-4 py-3" style="background:rgba(245,158,11,0.12);">
              <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-300 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <div>
                  <p class="text-amber-100 text-sm font-jost font-semibold leading-relaxed">Yellow Fever vaccinations and ICVP certificates are available at our Bosmere Pharmacy, Havant location only.</p>
                  <a href="<?php echo esc_url( home_url( '/yellow-fever/' ) . '#book' ); ?>" class="mt-2 inline-flex items-center gap-1.5 text-amber-200 font-semibold text-sm font-jost hover:text-amber-100 transition-colors duration-200">
                    Book Yellow Fever at Bosmere Pharmacy, Havant
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </a>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S4 · HEALTH RISKS  (light)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 bg-slate-50">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-amber-50 text-amber-700 border border-amber-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <?php echo sp_field( 'tv_risk_eyebrow', $tv['tv_risk_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost"><?php echo sp_field( 'tv_risk_h2', $tv['tv_risk_h2'] ); ?></h2>
      <p class="text-slate-600 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_risk_intro', $tv['tv_risk_intro'] ); ?></p>
    </div>

    <?php
    /* Risk-card text is client-editable (Travel Vaccines → Health Risks); icons stay in code, by index. */
    $risk_cards = sp_rows( 'tv_risks', $tv['tv_risks'], [ 'title' => 'title', 'desc' => 'desc' ] );
    $risk_icons = [
      '<path d="M12 2a10 10 0 0 0-10 10c0 4.42 2.87 8.17 6.84 9.5.5.08.66-.23.66-.5v-1.69c-2.77.6-3.36-1.34-3.36-1.34-.46-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.87 1.52 2.34 1.07 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.1.39-2 1.03-2.71-.1-.25-.45-1.29.1-2.64 0 0 .84-.27 2.75 1.02.79-.22 1.65-.33 2.5-.33.85 0 1.71.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.35.2 2.39.1 2.64.64.71 1.03 1.61 1.03 2.71 0 3.84-2.34 4.68-4.57 4.93.36.31.69.92.69 1.85V21c0 .27.16.59.67.5C19.14 20.16 22 16.42 22 12A10 10 0 0 0 12 2z"/>',
      '<path d="M3 3h18v3H3zM5 6v15h14V6"/><path d="M9 10h6M9 14h6"/>',
      '<circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>',
      '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
    ];
    ?>

    <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
      <?php foreach ( $risk_cards as $idx => $r ) : ?>
      <div class="bg-white rounded-2xl p-7 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300 reveal-item">
        <div class="flex items-start gap-4 mb-4">
          <div class="flex-shrink-0 w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $risk_icons[ $idx % count( $risk_icons ) ]; ?></svg>
          </div>
          <h3 class="text-lg font-bold text-slate-900 font-jost pt-2.5"><?php echo wp_kses_post( $r['title'] ); ?></h3>
        </div>
        <p class="text-slate-600 text-sm font-jost leading-relaxed"><?php echo wp_kses_post( $r['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>



<!-- ═══════════════════════════════════════════════════════
     S5 · MALARIA  (dark)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-0 left-1/3 w-[500px] h-[500px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <?php echo sp_field( 'tv_mal_eyebrow', $tv['tv_mal_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'tv_mal_h2', $tv['tv_mal_h2'] ); ?></h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_mal_intro', $tv['tv_mal_intro'] ); ?></p>
    </div>

    <?php
    /* Malaria-card text is client-editable (Travel Vaccines → Malaria); icons stay in code, by index. */
    $malaria_cards = sp_rows( 'tv_malaria', $tv['tv_malaria'], [ 'title' => 'title', 'desc' => 'desc' ] );
    $malaria_icons = [
      '<path d="M9 12l2 2 4-4"/><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
      '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
      '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
    ];
    ?>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
      <?php foreach ( $malaria_cards as $idx => $card ) : ?>
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7 hover:bg-white/15 transition-colors duration-300 reveal-item">
        <div class="w-12 h-12 bg-blue-600/30 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $malaria_icons[ $idx % count( $malaria_icons ) ]; ?></svg>
        </div>
        <h3 class="text-lg font-bold text-white mb-3 font-jost"><?php echo esc_html( $card['title'] ); ?></h3>
        <p class="text-blue-100/85 text-sm font-jost leading-relaxed"><?php echo esc_html( $card['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S6 · HOW IT WORKS  (light)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 bg-slate-50">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        <?php echo sp_field( 'tv_how_eyebrow', $tv['tv_how_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost"><?php echo sp_field( 'tv_how_h2', $tv['tv_how_h2'] ); ?></h2>
      <p class="text-slate-600 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_how_intro', $tv['tv_how_intro'] ); ?></p>
    </div>

    <?php
    /* Step text is client-editable (Travel Vaccines → How It Works); step icons stay in code, by index. */
    $how_steps  = sp_rows( 'tv_how_steps', $tv['tv_how_steps'], [ 'title' => 'title', 'desc' => 'desc' ] );
    $how_icons  = [
      '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
      '<path d="M9 11H1l8-8 8 8h-8v8a4 4 0 0 1-4-4z" transform="rotate(45 9 11)"/><path d="M14 2v6h6"/><path d="M16 13H8M16 17H8M10 9H8"/>',
      '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
    ];
    ?>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
      <?php foreach ( $how_steps as $idx => $step ) : ?>
      <div class="bg-white rounded-2xl p-7 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300 reveal-item relative">
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $how_icons[ $idx % count( $how_icons ) ]; ?></svg>
        </div>
        <span class="text-blue-400/70 text-xs font-bold tracking-widest font-jost uppercase">Step <?php echo esc_html( str_pad( (string) ( $idx + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
        <h3 class="text-lg font-bold text-slate-900 mt-1 mb-3 font-jost"><?php echo esc_html( $step['title'] ); ?></h3>
        <p class="text-slate-600 text-sm font-jost leading-relaxed"><?php echo wp_kses_post( $step['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S7 · TIMING  (dark)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.18) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <?php echo sp_field( 'tv_time_eyebrow', $tv['tv_time_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'tv_time_h2', $tv['tv_time_h2'] ); ?></h2>
      <p class="text-blue-200 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_time_intro', $tv['tv_time_intro'] ); ?></p>
    </div>

    <?php
    /* Timing-card text is client-editable (Travel Vaccines → Timing); colours stay in code, by index. */
    $timing_cards   = sp_rows( 'tv_timing', $tv['tv_timing'], [ 'tag' => 'tag', 'time' => 'time', 'desc' => 'desc' ] );
    $timing_colours = [ 'green', 'blue', 'amber' ];
    $timing_styles  = [
      'green' => [ 'bg' => 'bg-green-500/20',  'text' => 'text-green-200',  'border' => 'border-green-400/30',  'dot' => 'bg-green-400' ],
      'blue'  => [ 'bg' => 'bg-blue-500/20',   'text' => 'text-blue-200',   'border' => 'border-blue-400/30',   'dot' => 'bg-blue-400' ],
      'amber' => [ 'bg' => 'bg-amber-500/20',  'text' => 'text-amber-200',  'border' => 'border-amber-400/30',  'dot' => 'bg-amber-400' ],
    ];
    ?>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
      <?php foreach ( $timing_cards as $idx => $card ) : $s = $timing_styles[ $timing_colours[ $idx % count( $timing_colours ) ] ]; ?>
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7 hover:bg-white/15 transition-colors duration-300 reveal-item">
        <div class="flex items-center gap-2 mb-4">
          <span class="w-2 h-2 rounded-full <?php echo esc_attr( $s['dot'] ); ?>"></span>
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider border <?php echo esc_attr( $s['bg'] . ' ' . $s['text'] . ' ' . $s['border'] ); ?>">
            <?php echo esc_html( $card['tag'] ); ?>
          </span>
        </div>
        <h3 class="text-xl font-bold text-white mb-3 font-jost"><?php echo wp_kses_post( $card['time'] ); ?></h3>
        <p class="text-blue-100/85 text-sm font-jost leading-relaxed"><?php echo wp_kses_post( $card['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S8 · PRICING  (light, id="pricing")
════════════════════════════════════════════════════════ -->
<section id="pricing" class="py-20 md:py-28 bg-white">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        <?php echo sp_field( 'tv_price_eyebrow', $tv['tv_price_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost"><?php echo sp_field( 'tv_price_h2', $tv['tv_price_h2'] ); ?></h2>
      <p class="text-slate-600 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_price_intro', $tv['tv_price_intro'] ); ?></p>
    </div>

    <!-- Package cards -->
    <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-12">

      <!-- Package 1: Essential -->
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-md transition-shadow duration-300 reveal-item">
        <div class="flex items-center gap-2 mb-4">
          <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">Essential</span>
        </div>
        <h3 class="text-2xl font-bold text-slate-900 mb-2 font-jost"><?php echo sp_field( 'tv_pkg1_title', $tv['tv_pkg1_title'] ); ?></h3>
        <p class="text-slate-500 text-sm font-jost mb-5">From <span class="text-3xl font-extrabold text-slate-900 align-baseline"><?php echo sp_field( 'tv_pkg1_price', $tv['tv_pkg1_price'] ); ?></span></p>
        <ul class="space-y-3">
          <?php
          $pkg1 = sp_list( 'tv_pkg1_items', array_column( $tv['tv_pkg1_items'], 'text' ) );
          foreach ( $pkg1 as $item ) : ?>
          <li class="flex items-start gap-3 text-slate-700 font-jost text-sm">
            <span class="flex-shrink-0 w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
              <svg class="w-3 h-3 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </span>
            <?php echo esc_html( $item ); ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Package 2: Comprehensive (Most Popular, glow card) -->
      <div class="yf-glow-card rounded-2xl p-1 reveal-item">
        <div class="bg-white rounded-[0.95rem] p-8 h-full">
          <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-jost uppercase tracking-wider bg-blue-600 text-white">Most Popular</span>
          </div>
          <h3 class="text-2xl font-bold text-slate-900 mb-2 font-jost"><?php echo sp_field( 'tv_pkg2_title', $tv['tv_pkg2_title'] ); ?></h3>
          <p class="text-slate-500 text-sm font-jost mb-5">From <span class="text-3xl font-extrabold text-slate-900 align-baseline"><?php echo sp_field( 'tv_pkg2_price', $tv['tv_pkg2_price'] ); ?></span></p>
          <ul class="space-y-3">
            <?php
            $pkg2 = sp_list( 'tv_pkg2_items', array_column( $tv['tv_pkg2_items'], 'text' ) );
            foreach ( $pkg2 as $item ) : ?>
            <li class="flex items-start gap-3 text-slate-700 font-jost text-sm">
              <span class="flex-shrink-0 w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center mt-0.5">
                <svg class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              </span>
              <?php echo wp_kses_post( $item ); ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Individual vaccine pricing -->
    <div class="max-w-4xl mx-auto bg-slate-50 rounded-2xl p-8 border border-slate-100 mb-8">
      <h3 class="text-lg font-bold text-slate-900 mb-5 font-jost">Individual Vaccine Pricing</h3>
      <?php
      $individual_prices = sp_rows( 'tv_individual', $tv['tv_individual'], [ 'name' => 'name', 'price' => 'price' ] );
      ?>
      <div class="grid sm:grid-cols-2 gap-x-8 gap-y-3">
        <?php foreach ( $individual_prices as $line ) : ?>
        <div class="flex items-center justify-between py-2 border-b border-slate-200/70">
          <span class="text-slate-700 font-jost text-sm"><?php echo esc_html( $line['name'] ); ?></span>
          <span class="text-blue-700 font-bold font-jost text-sm"><?php echo esc_html( $line['price'] ); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Info box -->
    <div class="max-w-4xl mx-auto bg-blue-50 border border-blue-100 rounded-2xl px-6 py-5 flex items-start gap-4">
      <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <p class="text-blue-900 text-sm font-jost"><?php echo sp_field( 'tv_price_info', $tv['tv_price_info'] ); ?></p>
    </div>
  </div>
</section>



<!-- ═══════════════════════════════════════════════════════
     S9 · LOCATIONS  (white, id="locations")
════════════════════════════════════════════════════════ -->
<section id="locations" class="py-20 md:py-28 bg-slate-50">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <?php echo sp_field( 'tv_loc_eyebrow', $tv['tv_loc_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost"><?php echo sp_field( 'tv_loc_h2', $tv['tv_loc_h2'] ); ?></h2>
      <p class="text-slate-600 text-lg max-w-2xl mx-auto font-jost"><?php echo sp_field( 'tv_loc_intro', $tv['tv_loc_intro'] ); ?></p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <?php foreach ( sp_branch_order() as $i ) :
        $b = sp_branch( $i );
      ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-lg transition-shadow duration-300 reveal-item flex flex-col">
        <div class="relative overflow-hidden h-44">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b['name'] ); ?> pharmacy" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy"/>
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
          <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-slate-800 text-xs font-semibold font-jost px-2.5 py-1 rounded-full"><?php echo esc_html( $b['name'] ); ?></span>
        </div>
        <div class="p-5 space-y-2.5 flex flex-col flex-1">
          <div class="flex items-start gap-2 text-slate-600 text-sm font-jost">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo esc_html( $b['address'] ); ?>
          </div>
          <div class="flex items-center gap-2 text-slate-600 text-sm font-jost">
            <svg class="w-4 h-4 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 17l-.08-.08z"/></svg>
            <?php echo esc_html( $b['phone'] ); ?>
          </div>
          <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="mt-auto pt-1 inline-flex items-center gap-1.5 text-blue-600 font-semibold text-sm font-jost hover:text-blue-700 transition-colors duration-200">
            Book here
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Yellow Fever — Bosmere, Havant callout -->
    <div class="max-w-4xl mx-auto bg-amber-50 border border-amber-200 rounded-2xl px-6 py-5 flex items-start gap-4 mb-8">
      <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <div>
        <p class="text-amber-900 text-sm font-jost font-semibold leading-relaxed"><?php echo sp_field( 'tv_loc_yf_note', $tv['tv_loc_yf_note'] ); ?></p>
        <a href="<?php echo esc_url( home_url( '/yellow-fever/' ) . '#book' ); ?>" class="mt-2 inline-flex items-center gap-1.5 text-amber-700 font-semibold text-sm font-jost hover:text-amber-800 transition-colors duration-200">
          Book Yellow Fever at Bosmere Pharmacy, Havant
          <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    <p class="text-slate-600 text-center max-w-3xl mx-auto font-jost"><?php echo sp_field( 'tv_loc_footer', $tv['tv_loc_footer'] ); ?></p>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S10 · WHY SOUTHDOWNS  (dark)
════════════════════════════════════════════════════════ -->
<section class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);"></div>
  <div class="absolute bottom-0 left-1/4 w-80 h-80 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.12) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
        <?php echo sp_field( 'tv_why_eyebrow', $tv['tv_why_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 font-jost"><?php echo sp_field( 'tv_why_h2', $tv['tv_why_h2'] ); ?></h2>
    </div>

    <?php
    /* Feature text is client-editable (Travel Vaccines → Why Us); icons stay in code, by index. */
    $why_features = sp_rows( 'tv_why', $tv['tv_why'], [ 'title' => 'title', 'desc' => 'desc' ] );
    $why_icons = [
      '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
      '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
      '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
      '<path d="M9 12l2 2 4-4"/><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
      '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
      '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M23 11h-6"/>',
    ];
    ?>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
      <?php foreach ( $why_features as $idx => $feat ) : ?>
      <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-7 hover:bg-white/15 transition-colors duration-300 reveal-item">
        <div class="w-11 h-11 bg-blue-600/30 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-5 h-5 text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $why_icons[ $idx % count( $why_icons ) ]; ?></svg>
        </div>
        <h3 class="text-base font-bold text-white mb-2 font-jost"><?php echo esc_html( $feat['title'] ); ?></h3>
        <p class="text-blue-100/85 text-sm font-jost leading-relaxed"><?php echo esc_html( $feat['desc'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S11 · FAQ  (light gradient, id="faq")
════════════════════════════════════════════════════════ -->
<section id="faq" class="py-20 md:py-28" style="background: linear-gradient(180deg, #f8fafc 0%, #eff6ff 100%);">
  <div class="section-container">
    <div class="text-center mb-14">
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold font-jost mb-6 bg-blue-50 text-blue-700 border border-blue-100">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <?php echo sp_field( 'tv_faq_eyebrow', $tv['tv_faq_eyebrow'] ); ?>
      </span>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 font-jost"><?php echo sp_field( 'tv_faq_h2', $tv['tv_faq_h2'] ); ?></h2>
      <p class="text-slate-600 text-lg max-w-xl mx-auto font-jost"><?php echo sp_field( 'tv_faq_intro', $tv['tv_faq_intro'] ); ?></p>
    </div>

    <div class="max-w-3xl mx-auto space-y-3">
      <?php
      $faqs = sp_rows( 'tv_faqs', $tv['tv_faqs'], [ 'question' => 'question', 'answer' => 'answer' ] );
      foreach ( $faqs as $idx => $faq ) : $n = $idx + 1; ?>
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden reveal-item">
        <button class="yf-faq-trigger w-full flex items-center justify-between gap-4 px-6 py-5 text-left" aria-expanded="false">
          <span class="flex items-center gap-3">
            <span class="flex-shrink-0 w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xs font-jost"><?php echo $n; ?></span>
            <span class="font-semibold text-slate-900 font-jost"><?php echo esc_html( $faq['question'] ); ?></span>
          </span>
          <span class="yf-faq-icon flex-shrink-0 w-7 h-7 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 transition-transform duration-300">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
          </span>
        </button>
        <div class="yf-faq-answer hidden px-6 pb-5">
          <div class="pl-10 text-slate-600 font-jost text-sm leading-relaxed"><?php echo esc_html( $faq['answer'] ); ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     S12 · FINAL CTA  (dark, id="book")
════════════════════════════════════════════════════════ -->
<section id="book" class="py-20 md:py-28 relative overflow-hidden" style="background: linear-gradient(160deg,#0f172a 0%,#1e3a8a 55%,#1d4ed8 100%);">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(59,130,246,0.2) 0%,transparent 70%);"></div>

  <div class="section-container relative z-10 text-center">
    <div class="flex flex-wrap justify-center gap-2 mb-8">
      <?php
      $cta_badges = sp_list( 'tv_cta_badges', array_column( $tv['tv_cta_badges'], 'text' ) );
      foreach ( $cta_badges as $badge ) : ?>
      <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-semibold font-jost bg-white/15 backdrop-blur-sm text-white border border-white/20">
        <svg class="w-3.5 h-3.5 text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
        <?php echo esc_html( $badge ); ?>
      </span>
      <?php endforeach; ?>
    </div>

    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-5 font-jost leading-tight"><?php echo sp_field( 'tv_cta_h2', $tv['tv_cta_h2'] ); ?></h2>
    <p class="text-blue-200 text-lg max-w-2xl mx-auto mb-10 font-jost"><?php echo sp_field( 'tv_cta_intro', $tv['tv_cta_intro'] ); ?></p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
      <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-8 py-4 rounded-xl font-jost hover:bg-blue-50 transition-colors duration-200 shadow-xl shadow-blue-900/30 text-lg">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <?php echo sp_field( 'tv_cta_btn1', $tv['tv_cta_btn1'] ); ?>
      </a>
      <a href="#locations" class="inline-flex items-center justify-center gap-2 bg-white/15 backdrop-blur-sm text-white font-bold px-8 py-4 rounded-xl font-jost border border-white/30 hover:bg-white/25 transition-colors duration-200 text-lg">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <?php echo sp_field( 'tv_cta_btn2', $tv['tv_cta_btn2'] ); ?>
      </a>
    </div>

    <!-- Trust row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto border-t border-white/10 pt-10">
      <?php
      $trust_stats = sp_rows( 'tv_trust', $tv['tv_trust'], [ 'value' => 'value', 'label' => 'label' ] );
      foreach ( $trust_stats as $stat ) : ?>
      <div class="text-center">
        <p class="text-2xl md:text-3xl font-extrabold text-white font-jost"><?php echo esc_html( $stat['value'] ); ?></p>
        <p class="text-blue-300 text-sm mt-1 font-jost"><?php echo esc_html( $stat['label'] ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════
     MEDICAL DISCLAIMER
════════════════════════════════════════════════════════ -->
<div class="bg-slate-100 border-t border-slate-200 py-6">
  <div class="section-container">
    <p class="text-slate-500 text-xs font-jost text-center leading-relaxed max-w-4xl mx-auto">
      <strong>Medical Disclaimer:</strong> <?php echo sp_field( 'tv_disclaimer', $tv['tv_disclaimer'] ); ?>
    </p>
  </div>
</div>


<!-- ═══════════════════════════════════════════════════════
     JAVASCRIPT — FAQ Accordion + Scroll Reveal
════════════════════════════════════════════════════════ -->
<script>
(function () {
  'use strict';

  /* FAQ accordion */
  document.querySelectorAll('.yf-faq-trigger').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var answer = btn.nextElementSibling;
      var icon   = btn.querySelector('.yf-faq-icon');
      var open   = btn.getAttribute('aria-expanded') === 'true';

      /* close all */
      document.querySelectorAll('.yf-faq-trigger').forEach(function (b) {
        b.setAttribute('aria-expanded', 'false');
        b.nextElementSibling.classList.add('hidden');
        b.querySelector('.yf-faq-icon').style.transform = 'rotate(0deg)';
      });

      if (!open) {
        btn.setAttribute('aria-expanded', 'true');
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
      }
    });
  });

  /* Scroll reveal */
  var items = document.querySelectorAll('.reveal-item');
  if (!items.length) return;

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.style.opacity   = '1';
        entry.target.style.transform = 'translateY(0)';
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  items.forEach(function (el) { io.observe(el); });
}());
</script>

<?php get_footer(); ?>
