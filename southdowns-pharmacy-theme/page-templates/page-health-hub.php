<?php
/**
 * Template Name: Health Hub
 *
 * Health Hub / Blog listing page. Create a Page (e.g. titled "Health Hub")
 * and assign this template via Page → Template — same as every other page.
 *
 * Renders a custom posts query: hero with category filter tabs, topic cards,
 * a featured article, and the latest-articles grid. Individual articles
 * render through single.php.
 *
 * FILTERING IS SERVER-SIDE. The three tabs/topic cards are "buckets" that map
 * onto your real WordPress categories, resolved live in code below:
 *   • Weight Loss   → categories named/slugged "weight-loss"
 *   • Travel Health → "travel-health" or "travel-vaccines"
 *   • Wellness      → every other category (except Uncategorised)
 * So you don't need categories with special slugs — it adapts to whatever
 * categories your posts already use. Adjust $hh_bucket_defs to move a category.
 */
get_header();

$hh_page_url = get_permalink( get_queried_object_id() );
$hh_paged    = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

// ── Which topic bucket is selected? (?topic=weight-loss|travel-health|wellness)
$hh_tabs = [
    'all'           => 'All Articles',
    'weight-loss'   => 'Weight Loss',
    'travel-health' => 'Travel Health',
    'wellness'      => 'Wellness',
];
$hh_topic = isset( $_GET['topic'] ) ? sanitize_key( wp_unslash( $_GET['topic'] ) ) : 'all';
if ( ! isset( $hh_tabs[ $hh_topic ] ) ) {
    $hh_topic = 'all';
}

// ── Resolve each bucket to the real category slugs present on the site.
// A category matches a bucket if its slug OR name (case-insensitive) is listed.
// "Wellness" is the catch-all for anything not claimed above (minus Uncategorised).
$hh_bucket_defs = [
    'weight-loss'   => [ 'weight-loss', 'Weight Loss' ],
    'travel-health' => [ 'travel-health', 'travel-vaccines', 'Travel Health', 'Travel Vaccines' ],
];
$hh_all_cats = function_exists( 'get_categories' ) ? get_categories( [ 'hide_empty' => true ] ) : [];
$hh_buckets  = [ 'weight-loss' => [], 'travel-health' => [], 'wellness' => [] ];
$hh_claimed  = [];

foreach ( $hh_all_cats as $hh_c ) {
    $hh_placed = false;
    foreach ( [ 'weight-loss', 'travel-health' ] as $hh_b ) {
        foreach ( $hh_bucket_defs[ $hh_b ] as $hh_needle ) {
            if ( 0 === strcasecmp( $hh_c->slug, $hh_needle ) || 0 === strcasecmp( $hh_c->name, $hh_needle ) ) {
                $hh_buckets[ $hh_b ][] = $hh_c->slug;
                $hh_claimed[]          = $hh_c->slug;
                $hh_placed             = true;
                break 2;
            }
        }
    }
    if ( ! $hh_placed && 0 !== strcasecmp( $hh_c->slug, 'uncategorized' ) ) {
        $hh_buckets['wellness'][] = $hh_c->slug;
    }
}

// ── Build the query, filtered to the selected bucket's categories.
$hh_args = [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 9,
    'paged'               => $hh_paged,
    'ignore_sticky_posts' => true,
];
if ( 'all' !== $hh_topic && ! empty( $hh_buckets[ $hh_topic ] ) ) {
    $hh_args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $hh_buckets[ $hh_topic ],
            'operator' => 'IN',
        ],
    ];
} elseif ( 'all' !== $hh_topic ) {
    // A bucket with no matching categories → force an empty result set.
    $hh_args['post__in'] = [ 0 ];
}
$hh_query = new WP_Query( $hh_args );

// Link helper: a tab/card jumps to a filtered view (and scrolls to the grid).
if ( ! function_exists( 'hh_topic_url' ) ) {
    function hh_topic_url( string $base, string $slug ): string {
        if ( 'all' === $slug ) {
            return $base;
        }
        return add_query_arg( 'topic', $slug, $base ) . '#hh-articles';
    }
}
?>

<style>
  .hh-tab { transition: background-color .2s, color .2s, border-color .2s; }
  .hh-tab:hover:not(.is-active) { border-color: #bfdbfe; color: #1d4ed8; }
  .hh-tab.is-active { background: #2563eb; border-color: #2563eb; color: #fff; }
</style>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="relative overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8] py-16 md:py-24">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-6">
      <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
      <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'hh_hero_eyebrow', 'Health Hub' ); ?></span>
    </div>
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-800 mb-6 font-jost leading-tight">
      <?php echo sp_field( 'hh_hero_heading', 'Expert health advice from your' ); ?> <span class="serif-accent"><?php echo sp_field( 'hh_hero_heading_accent', 'Hampshire pharmacists' ); ?></span>
    </h1>
    <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-jost mb-8">
      <?php echo sp_field( 'hh_hero_intro', 'Evidence-based guides on weight loss, travel health and everyday wellbeing &mdash; written and reviewed by our GPhC-registered team.' ); ?>
    </p>
    <div class="flex flex-wrap justify-center gap-2 md:gap-3">
      <?php foreach ( $hh_tabs as $hh_slug => $hh_label ) :
        $hh_active = ( $hh_topic === $hh_slug ) ? ' is-active' : '';
      ?>
      <a href="<?php echo esc_url( hh_topic_url( $hh_page_url, $hh_slug ) ); ?>" class="hh-tab<?php echo $hh_active; ?> px-5 py-2.5 rounded-full border border-slate-200 bg-white text-slate-600 text-sm font-medium font-jost"><?php echo esc_html( $hh_label ); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     TOPIC CARDS
     ============================================================ -->
<section class="py-14 md:py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-10 md:mb-12">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 mb-3 font-jost"><?php echo sp_field( 'hh_topics_heading', 'What brings you here today?' ); ?></h2>
      <p class="text-lg text-slate-500 font-jost"><?php echo sp_field( 'hh_topics_intro', 'Jump straight to the health topic that matters most to you.' ); ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <?php
      // Card text/image editable in WordPress (Health Hub → Topic Cards); the
      // bucket each links to (filter) stays in code to drive the server filter.
      $hh_topics = sp_rows( 'hh_topics', [
          [ 'filter' => 'weight-loss',   'badge' => 'Weight Loss',   'title' => 'Weight Loss Journeys',  'desc' => 'GLP-1 medications, managing side effects, nutrition guides and real patient experiences.', 'img' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=900&h=560&fit=crop' ],
          [ 'filter' => 'travel-health', 'badge' => 'Travel Health', 'title' => 'Travel Health Guides',  'desc' => 'Destination vaccines, malaria prevention, yellow fever advice and travel safety tips.',   'img' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=900&h=560&fit=crop' ],
          [ 'filter' => 'wellness',      'badge' => 'Wellness',      'title' => 'Wellness & Prevention', 'desc' => 'Vitamin guidance, prescription know-how, seasonal jabs and staying well year-round.',     'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=900&h=560&fit=crop' ],
      ], [ 'badge' => 'badge', 'title' => 'title', 'desc' => 'desc', 'img' => 'image' ] );
      $hh_topic_filters = [ 'weight-loss', 'travel-health', 'wellness' ];
      foreach ( $hh_topics as $hh_i => $hh_t ) :
        $hh_t_filter = $hh_topic_filters[ $hh_i ] ?? 'all';
      ?>
      <a href="<?php echo esc_url( hh_topic_url( $hh_page_url, $hh_t_filter ) ); ?>" class="hh-topic group block rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="relative aspect-[16/10] overflow-hidden">
          <img src="<?php echo esc_url( $hh_t['img'] ); ?>" alt="<?php echo esc_attr( $hh_t['title'] ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/75 via-slate-900/15 to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-5">
            <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-2"><?php echo esc_html( $hh_t['badge'] ); ?></span>
            <h3 class="text-white text-xl md:text-2xl font-bold font-jost"><?php echo esc_html( $hh_t['title'] ); ?></h3>
          </div>
        </div>
        <div class="p-6">
          <p class="text-slate-600 text-base leading-relaxed mb-4 font-jost"><?php echo esc_html( $hh_t['desc'] ); ?></p>
          <span class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm font-jost group-hover:gap-3 transition-all">
            Explore <?php echo esc_html( $hh_t['badge'] ); ?>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
// ============================================================
// FEATURED ARTICLE — first post, unfiltered page 1 only
// ============================================================
if ( 1 === $hh_paged && 'all' === $hh_topic && $hh_query->have_posts() ) :
    $hh_query->the_post();
    $hh_cats     = get_the_category();
    $hh_cat      = ! empty( $hh_cats ) ? $hh_cats[0]->name : 'Health';
    $hh_thumb    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    $hh_rt       = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
    $hh_author   = get_the_author();
    $hh_parts    = preg_split( '/\s+/', trim( $hh_author ) );
    $hh_initials = strtoupper( substr( $hh_parts[0], 0, 1 ) . ( isset( $hh_parts[1] ) ? substr( $hh_parts[1], 0, 1 ) : '' ) );
?>
<section class="py-14 md:py-20 bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="premium-badge flex items-center gap-4 mb-8">
      <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
      <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'hh_featured_eyebrow', 'Featured This Week' ); ?></span>
    </div>
    <a href="<?php the_permalink(); ?>" class="group grid grid-cols-1 lg:grid-cols-2 bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300">
      <div class="relative overflow-hidden min-h-[260px] lg:min-h-[400px]">
        <?php if ( $hh_thumb ) : ?>
        <img src="<?php echo esc_url( $hh_thumb ); ?>" alt="<?php the_title_attribute(); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
        <?php else : ?>
        <div class="absolute inset-0" style="background:linear-gradient(135deg,#1e3a8a 0%,#3b82f6 100%);"></div>
        <?php endif; ?>
        <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider"><?php echo esc_html( $hh_cat ); ?></span>
      </div>
      <div class="p-7 md:p-10 flex flex-col justify-center">
        <div class="flex items-center gap-2 text-xs text-slate-400 font-jost mb-3">
          <span><?php echo esc_html( $hh_rt ); ?> min read</span><span>&middot;</span><span><?php echo esc_html( get_the_date() ); ?></span>
        </div>
        <h3 class="text-2xl md:text-3xl font-bold text-slate-800 mb-4 font-jost leading-tight group-hover:text-blue-600 transition-colors"><?php the_title(); ?></h3>
        <p class="text-slate-600 text-base md:text-lg leading-relaxed mb-6 font-jost line-clamp-3"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32 ) ); ?></p>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-sm font-bold font-jost"><?php echo esc_html( $hh_initials ); ?></div>
          <span class="text-sm font-semibold text-slate-700 font-jost"><?php echo esc_html( $hh_author ); ?></span>
        </div>
        <span class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm font-jost mt-6 group-hover:gap-3 transition-all">
          Read Full Article
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </span>
      </div>
    </a>
  </div>
</section>
<?php endif; ?>

<!-- ============================================================
     LATEST ARTICLES GRID
     ============================================================ -->
<section id="hh-articles" class="py-14 md:py-20 bg-white scroll-mt-24">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
    <div class="text-center mb-10 md:mb-12">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 mb-3 font-jost"><?php echo sp_field( 'hh_latest_heading', 'Latest from Our Pharmacists' ); ?></h2>
      <p class="text-lg text-slate-500 font-jost">
        <?php
        if ( 'all' !== $hh_topic ) {
            echo 'Showing: <span class="font-semibold text-slate-700">' . esc_html( $hh_tabs[ $hh_topic ] ) . '</span> &middot; <a href="' . esc_url( $hh_page_url ) . '" class="text-blue-600 hover:text-blue-800 font-medium">View all</a>';
        } else {
            echo sp_field( 'hh_latest_intro', 'Evidence-based health guidance, written and reviewed by our team.' );
        }
        ?>
      </p>
    </div>

    <?php if ( $hh_query->have_posts() ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php while ( $hh_query->have_posts() ) : $hh_query->the_post();
        $hh_cats     = get_the_category();
        $hh_cat      = ! empty( $hh_cats ) ? $hh_cats[0]->name : 'Health';
        $hh_thumb    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        $hh_rt       = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
        $hh_author   = get_the_author();
        $hh_parts    = preg_split( '/\s+/', trim( $hh_author ) );
        $hh_initials = strtoupper( substr( $hh_parts[0], 0, 1 ) . ( isset( $hh_parts[1] ) ? substr( $hh_parts[1], 0, 1 ) : '' ) );
      ?>
      <a href="<?php the_permalink(); ?>" class="hh-article-card group flex flex-col bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="relative overflow-hidden aspect-[3/2]">
          <?php if ( $hh_thumb ) : ?>
          <img src="<?php echo esc_url( $hh_thumb ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" />
          <?php else : ?>
          <div class="w-full h-full" style="background:linear-gradient(135deg,#1e3a8a 0%,#3b82f6 100%);"></div>
          <?php endif; ?>
          <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider"><?php echo esc_html( $hh_cat ); ?></span>
        </div>
        <div class="p-6 flex flex-col flex-1">
          <div class="flex items-center gap-2 text-xs text-slate-400 font-jost mb-2">
            <span><?php echo esc_html( $hh_rt ); ?> min read</span><span>&middot;</span><span><?php echo esc_html( get_the_date() ); ?></span>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-2 font-jost leading-snug group-hover:text-blue-600 transition-colors"><?php the_title(); ?></h3>
          <p class="text-slate-600 text-sm leading-relaxed mb-4 font-jost line-clamp-3"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
          <div class="flex items-center gap-2.5 mt-auto pt-1">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-xs font-bold font-jost"><?php echo esc_html( $hh_initials ); ?></div>
            <span class="text-sm font-semibold text-slate-700 font-jost"><?php echo esc_html( $hh_author ); ?></span>
          </div>
        </div>
      </a>
      <?php endwhile; ?>
    </div>

    <?php if ( $hh_query->max_num_pages > 1 ) : ?>
    <div class="blog-pagination mt-12 md:mt-16">
      <div class="nav-links">
        <?php echo paginate_links( [
            'base'      => trailingslashit( $hh_page_url ) . '%_%',
            'format'    => 'page/%#%/',
            'current'   => $hh_paged,
            'total'     => $hh_query->max_num_pages,
            'mid_size'  => 1,
            'prev_text' => '&larr; Newer',
            'next_text' => 'Older &rarr;',
            'add_args'  => ( 'all' !== $hh_topic ) ? [ 'topic' => $hh_topic ] : false,
        ] ); ?>
      </div>
    </div>
    <?php endif; ?>

    <?php else : ?>
    <div class="text-center py-12">
      <p class="text-lg text-slate-500 font-jost">
        <?php if ( 'all' !== $hh_topic ) : ?>
        No articles in this category yet &mdash; <a href="<?php echo esc_url( $hh_page_url ); ?>" class="text-blue-600 hover:text-blue-800 font-medium">view all articles</a>.
        <?php else : ?>
        No articles published yet &mdash; check back soon.
        <?php endif; ?>
      </p>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php
wp_reset_postdata();
get_footer();
