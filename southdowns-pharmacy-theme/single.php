<?php
/**
 * Single post template — the blog article reading view.
 *
 * Renders an individual blog post: hero (category, title, author, date,
 * reading time), featured image, formatted article body, an author bio
 * card, and a "More from our pharmacists" related-posts grid.
 *
 * The blog listing lives in page-templates/page-health-hub.php (assign that
 * template to a Page titled "Blog" / "Health Hub"). Article cards there link
 * here. Styling mirrors the rest of the theme — Jost font, slate/blue
 * palette, #fdf9f6 sections, premium-badge + serif-accent accents.
 */
get_header();

while ( have_posts() ) : the_post();

	$sp_cats     = get_the_category();
	$sp_cat      = ! empty( $sp_cats ) ? $sp_cats[0]->name : 'Health';
	$sp_cat_id   = ! empty( $sp_cats ) ? (int) $sp_cats[0]->term_id : 0;
	$sp_thumb    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$sp_rt       = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
	$sp_author   = get_the_author();
	$sp_author_id = (int) get_the_author_meta( 'ID' );
	$sp_bio      = get_the_author_meta( 'description' );
	$sp_parts    = preg_split( '/\s+/', trim( $sp_author ) );
	$sp_initials = strtoupper( substr( $sp_parts[0], 0, 1 ) . ( isset( $sp_parts[1] ) ? substr( $sp_parts[1], 0, 1 ) : '' ) );
	$sp_blog_url = get_permalink( get_option( 'page_for_posts' ) );
	if ( ! $sp_blog_url ) {
		$sp_blog_url = home_url( '/blog/' );
	}
?>

<style>
	/* Article body typography (Tailwind CDN ships no typography plugin) */
	.sp-article { font-family: 'Jost', sans-serif; color: #334155; font-size: 1.125rem; line-height: 1.85; }
	.sp-article > * + * { margin-top: 1.5rem; }
	.sp-article h2 { font-size: 1.875rem; font-weight: 700; color: #1e293b; margin-top: 2.75rem; line-height: 1.25; }
	.sp-article h3 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-top: 2.25rem; line-height: 1.3; }
	.sp-article h4 { font-size: 1.25rem; font-weight: 600; color: #1e293b; margin-top: 2rem; }
	.sp-article p { margin-top: 1.5rem; }
	.sp-article a { color: #2563eb; text-decoration: underline; text-underline-offset: 2px; }
	.sp-article a:hover { color: #1d4ed8; }
	.sp-article ul, .sp-article ol { margin-top: 1.5rem; padding-left: 1.5rem; }
	.sp-article ul { list-style: disc; }
	.sp-article ol { list-style: decimal; }
	.sp-article li { margin-top: 0.5rem; padding-left: 0.25rem; }
	.sp-article li::marker { color: #2563eb; }
	.sp-article img { border-radius: 1rem; margin-top: 2rem; margin-bottom: 2rem; }
	.sp-article blockquote {
		border-left: 4px solid #2563eb;
		background: #f8fafc;
		padding: 1.25rem 1.5rem;
		border-radius: 0 0.75rem 0.75rem 0;
		font-style: italic;
		color: #475569;
		margin-top: 2rem;
	}
	.sp-article blockquote p { margin-top: 0; }
	.sp-article strong { color: #1e293b; font-weight: 600; }
	.sp-article h2:first-child, .sp-article h3:first-child, .sp-article p:first-child { margin-top: 0; }
	.sp-article figure { margin-top: 2rem; }
	.sp-article figcaption { font-size: 0.875rem; color: #94a3b8; text-align: center; margin-top: 0.5rem; }
</style>

<article>

	<!-- ============================================================
	     ARTICLE HERO
	     ============================================================ -->
	<header class="relative overflow-hidden bg-[#fdf9f6] border-t border-[#e8e0d8] pt-12 pb-12 md:pt-16 md:pb-16">
		<div class="max-w-3xl mx-auto px-4 md:px-8">

			<!-- Breadcrumb -->
			<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm text-slate-500 font-jost mb-8">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-blue-600 transition-colors">Home</a>
				<span class="text-slate-300">/</span>
				<a href="<?php echo esc_url( $sp_blog_url ); ?>" class="hover:text-blue-600 transition-colors">Blog</a>
				<span class="text-slate-300">/</span>
				<span class="text-slate-700 truncate"><?php echo esc_html( $sp_cat ); ?></span>
			</nav>

			<span class="inline-block bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider mb-5"><?php echo esc_html( $sp_cat ); ?></span>

			<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 mb-6 font-jost leading-tight">
				<?php the_title(); ?>
			</h1>

			<!-- Author + meta -->
			<div class="flex flex-wrap items-center gap-4">
				<div class="flex items-center gap-3">
					<div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-sm font-bold font-jost"><?php echo esc_html( $sp_initials ); ?></div>
					<div class="leading-tight">
						<div class="text-sm font-semibold text-slate-800 font-jost"><?php echo esc_html( $sp_author ); ?></div>
						<div class="text-xs text-slate-500 font-jost">Reviewed by our GPhC-registered team</div>
					</div>
				</div>
				<span class="hidden sm:block w-px h-8 bg-slate-200"></span>
				<div class="flex items-center gap-2 text-sm text-slate-500 font-jost">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<span class="text-slate-300">&middot;</span>
					<span><?php echo esc_html( $sp_rt ); ?> min read</span>
				</div>
			</div>
		</div>
	</header>

	<!-- ============================================================
	     FEATURED IMAGE
	     ============================================================ -->
	<?php if ( $sp_thumb ) : ?>
	<div class="bg-[#fdf9f6]">
		<div class="max-w-4xl mx-auto px-4 md:px-8 -mb-16 md:-mb-24">
			<div class="rounded-2xl overflow-hidden shadow-xl aspect-[16/9]">
				<img src="<?php echo esc_url( $sp_thumb ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover" />
			</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- ============================================================
	     ARTICLE BODY
	     ============================================================ -->
	<div class="bg-white <?php echo $sp_thumb ? 'pt-24 md:pt-32' : 'pt-14 md:pt-16'; ?> pb-14 md:pb-20">
		<div class="max-w-3xl mx-auto px-4 md:px-8">

			<div class="sp-article">
				<?php the_content(); ?>
			</div>

			<?php
			// Tags
			$sp_tags = get_the_tags();
			if ( $sp_tags ) : ?>
			<div class="flex flex-wrap gap-2 mt-12 pt-8 border-t border-slate-100">
				<?php foreach ( $sp_tags as $sp_tag ) : ?>
				<a href="<?php echo esc_url( get_tag_link( $sp_tag->term_id ) ); ?>" class="text-sm text-slate-600 bg-slate-100 hover:bg-blue-50 hover:text-blue-600 px-3 py-1.5 rounded-full font-jost transition-colors">#<?php echo esc_html( $sp_tag->name ); ?></a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<!-- Author bio card -->
			<div class="mt-12 bg-[#fdf9f6] border border-[#e8e0d8] rounded-2xl p-6 md:p-8 flex flex-col sm:flex-row items-start gap-5">
				<?php $sp_avatar = get_avatar_url( $sp_author_id, [ 'size' => 96 ] ); ?>
				<div class="w-16 h-16 flex-shrink-0 rounded-full overflow-hidden bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-lg font-bold font-jost">
					<?php if ( $sp_avatar ) : ?>
						<img src="<?php echo esc_url( $sp_avatar ); ?>" alt="<?php echo esc_attr( $sp_author ); ?>" class="w-full h-full object-cover" />
					<?php else : ?>
						<?php echo esc_html( $sp_initials ); ?>
					<?php endif; ?>
				</div>
				<div>
					<div class="text-xs font-semibold uppercase tracking-wider text-blue-600 font-jost mb-1">Written by</div>
					<h2 class="text-lg font-bold text-slate-800 font-jost mb-2"><?php echo esc_html( $sp_author ); ?></h2>
					<p class="text-slate-600 text-sm leading-relaxed font-jost">
						<?php echo esc_html( $sp_bio ? $sp_bio : 'Part of the GPhC-registered pharmacy team at ' . sp_pharmacy_name() . ', providing evidence-based health guidance across our Hampshire branches.' ); ?>
					</p>
				</div>
			</div>

			<!-- Back to blog -->
			<div class="mt-10">
				<a href="<?php echo esc_url( $sp_blog_url ); ?>" class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm font-jost hover:gap-3 transition-all">
					<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
					Back to all articles
				</a>
			</div>
		</div>
	</div>

</article>

<?php
// ============================================================
// RELATED ARTICLES — "see others"
// Same category first, topped up with recent posts. Excludes current.
// ============================================================
$sp_related = new WP_Query( [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 3,
	'post__not_in'        => [ get_the_ID() ],
	'ignore_sticky_posts' => true,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'category__in'        => $sp_cat_id ? [ $sp_cat_id ] : [],
] );

// Fall back to latest posts if the category has too few siblings.
if ( $sp_related->post_count < 3 ) {
	$sp_related = new WP_Query( [
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'post__not_in'        => [ get_the_ID() ],
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	] );
}

if ( $sp_related->have_posts() ) : ?>
<section class="py-14 md:py-20 bg-[#fdf9f6] border-t border-[#e8e0d8]">
	<div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
		<div class="premium-badge flex items-center justify-center gap-4 mb-4">
			<div class="badge-rule w-10 h-px bg-slate-800/20"></div>
			<span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost">Keep Reading</span>
			<div class="badge-rule w-10 h-px bg-slate-800/20"></div>
		</div>
		<h2 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-800 mb-10 md:mb-12 font-jost text-center">
			More from our <span class="serif-accent">pharmacists</span>
		</h2>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
			<?php while ( $sp_related->have_posts() ) : $sp_related->the_post();
				$r_cats     = get_the_category();
				$r_cat      = ! empty( $r_cats ) ? $r_cats[0]->name : 'Health';
				$r_thumb    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
				$r_rt       = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
				$r_author   = get_the_author();
				$r_parts    = preg_split( '/\s+/', trim( $r_author ) );
				$r_initials = strtoupper( substr( $r_parts[0], 0, 1 ) . ( isset( $r_parts[1] ) ? substr( $r_parts[1], 0, 1 ) : '' ) );
			?>
			<a href="<?php the_permalink(); ?>" class="group flex flex-col bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
				<div class="relative overflow-hidden aspect-[3/2]">
					<?php if ( $r_thumb ) : ?>
					<img src="<?php echo esc_url( $r_thumb ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" />
					<?php else : ?>
					<div class="w-full h-full" style="background:linear-gradient(135deg,#1e3a8a 0%,#3b82f6 100%);"></div>
					<?php endif; ?>
					<span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider"><?php echo esc_html( $r_cat ); ?></span>
				</div>
				<div class="p-6 flex flex-col flex-1">
					<div class="flex items-center gap-2 text-xs text-slate-400 font-jost mb-2">
						<span><?php echo esc_html( $r_rt ); ?> min read</span><span>&middot;</span><span><?php echo esc_html( get_the_date() ); ?></span>
					</div>
					<h3 class="text-xl font-bold text-slate-800 mb-2 font-jost leading-snug group-hover:text-blue-600 transition-colors"><?php the_title(); ?></h3>
					<p class="text-slate-600 text-sm leading-relaxed mb-4 font-jost line-clamp-3"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
					<div class="flex items-center gap-2.5 mt-auto pt-1">
						<div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-xs font-bold font-jost"><?php echo esc_html( $r_initials ); ?></div>
						<span class="text-sm font-semibold text-slate-700 font-jost"><?php echo esc_html( $r_author ); ?></span>
					</div>
				</div>
			</a>
			<?php endwhile; ?>
		</div>

		<div class="text-center mt-12">
			<a href="<?php echo esc_url( $sp_blog_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-800 text-white text-[15px] font-medium px-8 py-3.5 rounded-full transition-colors font-jost">
				View all articles
				<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
			</a>
		</div>
	</div>
</section>
<?php
endif;
wp_reset_postdata();

endwhile;

get_footer();
