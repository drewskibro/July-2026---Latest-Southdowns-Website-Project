<?php
/**
 * The featured post card: image on the left, title, excerpt, author and
 * "Read Full Article" on the right (stacked on a phone).
 *
 * Call inside the loop, after the_post(): used by "Featured This Week" on the
 * blog page (page-templates/page-health-hub.php) and on the homepage
 * (front-page.php). Both feature the most recent sticky post, or the newest
 * post when none is sticky.
 */
$hh_cats     = get_the_category();
$hh_cat      = ! empty( $hh_cats ) ? $hh_cats[0]->name : 'Health';
$hh_thumb    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
$hh_rt       = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
$hh_author   = get_the_author();
$hh_parts    = preg_split( '/\s+/', trim( $hh_author ) );
$hh_initials = strtoupper( substr( $hh_parts[0], 0, 1 ) . ( isset( $hh_parts[1] ) ? substr( $hh_parts[1], 0, 1 ) : '' ) );
?>
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
