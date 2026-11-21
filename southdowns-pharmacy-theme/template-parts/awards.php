<?php
/**
 * The awards: the newest one featured, the rest beside it.
 *
 * Used by front-page.php and page-templates/page-about-us.php, under their own
 * eyebrow and heading. Awards come from sp_awards() (Pharmacy Settings → Awards),
 * newest first; the first is the featured one.
 *
 *   Desktop: the featured award as a large card on the left, the others as a
 *            column of compact cards on the right. Everything is in view.
 *   Tablet:  the featured award across the top, the others two to a row.
 *   Phone:   the featured award, then the others as a row you swipe (native
 *            scrolling and snap; nothing moves by itself).
 *
 * When the featured award links to a published post on this site that has a
 * featured image (its news story), the featured card becomes that story: the
 * post's image across its top, one sentence from the post, and "Read the full
 * story". Without one, the card shows the award's logo.
 *
 * Each card leads with the award's title; the result and the year are a small
 * label above it, the awarding body a line below. The theme's Tailwind is
 * pre-built, so this section styles itself in the <style> block below.
 */
$awards   = sp_awards();
$featured = array_shift( $awards );
if ( ! $featured ) {
	return;
}

/** The result-and-year label: "Winner · 2026" or "Runner Up · 2026". */
$sp_aw_label = function ( $aw ) {
	$badge = $aw['badge'] ?? '';
	$text  = 'finalist' === $badge ? 'Runner Up' : ( 'winner' === $badge ? 'Winner' : '' );
	ob_start();
	?>
	<p class="sp-aw-label">
		<?php if ( '' !== $text ) : ?><span class="sp-aw-badge sp-aw-badge--<?php echo 'finalist' === $badge ? 'runner' : 'winner'; ?>"><?php echo esc_html( $text ); ?></span><?php endif; ?>
		<span class="sp-aw-year"><?php echo esc_html( $aw['year'] ); ?></span>
	</p>
	<?php
	return (string) ob_get_clean();
};
$sp_aw_alt = function ( $aw ) {
	return '' !== (string) ( $aw['alt'] ?? '' ) ? $aw['alt'] : $aw['org'] . ' logo';
};

$f_link = (string) ( $featured['link'] ?? '' );
$f_tag  = '' !== $f_link ? 'a' : 'div';

/* The featured award's news story, when its link is a published post with an image. */
$f_story = null;
if ( '' !== $f_link && function_exists( 'url_to_postid' ) ) {
	$f_post_id = (int) url_to_postid( $f_link );
	if ( $f_post_id && 'publish' === get_post_status( $f_post_id ) && has_post_thumbnail( $f_post_id ) ) {
		$f_excerpt = trim( wp_strip_all_tags( get_the_excerpt( $f_post_id ) ) );
		// One sentence, at most about thirty words.
		if ( preg_match( '/^(.+?[.!?])(\s|$)/u', $f_excerpt, $f_m ) ) {
			$f_excerpt = $f_m[1];
		}
		$f_story = [
			'image'   => get_the_post_thumbnail_url( $f_post_id, 'large' ),
			'alt'     => get_the_title( $f_post_id ),
			'excerpt' => wp_trim_words( $f_excerpt, 30 ),
		];
	}
}
?>
<div class="sp-aw">
	<<?php echo $f_tag; ?> class="sp-aw-feature font-jost<?php echo $f_story ? ' sp-aw-feature--story' : ''; ?>"<?php if ( 'a' === $f_tag ) : ?> href="<?php echo esc_url( $f_link ); ?>" aria-label="<?php echo esc_attr( ( $f_story ? 'Read the full story: ' : 'Read about our ' ) . $featured['title'] . ' ' . $featured['year'] ); ?>"<?php endif; ?>>
		<?php if ( $f_story ) : ?>
		<img class="sp-aw-story__img" src="<?php echo esc_url( $f_story['image'] ); ?>" alt="<?php echo esc_attr( $f_story['alt'] ); ?>" loading="lazy" />
		<?php else : ?>
		<div class="sp-aw-feature__logo">
			<img src="<?php echo esc_url( $featured['logo'] ); ?>" alt="<?php echo esc_attr( $sp_aw_alt( $featured ) ); ?>" loading="lazy" />
		</div>
		<?php endif; ?>
		<div class="sp-aw-feature__body">
			<p class="sp-aw-kicker">Latest award</p>
			<?php echo $sp_aw_label( $featured ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in the closure ?>
			<h3 class="sp-aw-feature__title"><?php echo esc_html( $featured['title'] ); ?></h3>
			<p class="sp-aw-org"><?php echo esc_html( $featured['org'] ); ?></p>
			<?php if ( $f_story && '' !== $f_story['excerpt'] ) : ?>
			<p class="sp-aw-story__excerpt"><?php echo esc_html( $f_story['excerpt'] ); ?></p>
			<?php endif; ?>
			<?php if ( 'a' === $f_tag ) : ?>
			<span class="sp-aw-more" aria-hidden="true"><?php echo $f_story ? 'Read the full story' : 'Read about the award'; ?> <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
			<?php endif; ?>
		</div>
	</<?php echo $f_tag; ?>>

	<?php if ( $awards ) : ?>
	<ul class="sp-aw-list" role="list" aria-label="More awards">
		<?php foreach ( $awards as $aw ) :
			$link = (string) ( $aw['link'] ?? '' );
			$tag  = '' !== $link ? 'a' : 'div';
		?>
		<li class="sp-aw-item">
			<<?php echo $tag; ?> class="sp-aw-card font-jost"<?php if ( 'a' === $tag ) : ?> href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( 'Read about our ' . $aw['title'] . ' ' . $aw['year'] ); ?>"<?php endif; ?>>
				<div class="sp-aw-card__logo"><img src="<?php echo esc_url( $aw['logo'] ); ?>" alt="<?php echo esc_attr( $sp_aw_alt( $aw ) ); ?>" loading="lazy" /></div>
				<div class="sp-aw-card__body">
					<?php echo $sp_aw_label( $aw ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in the closure ?>
					<h3 class="sp-aw-card__title"><?php echo esc_html( $aw['title'] ); ?></h3>
					<p class="sp-aw-org"><?php echo esc_html( $aw['org'] ); ?></p>
				</div>
			</<?php echo $tag; ?>>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>

<style>
	.sp-aw { --aw-ink: #1e293b; --aw-soft: #64748b; --aw-line: #e8e0d8; --aw-blue: #1d4ed8; display: grid; gap: 16px; text-align: left; }
	.sp-aw-feature, .sp-aw-card { display: flex; color: var(--aw-ink); text-decoration: none; background: #fff; border: 1px solid var(--aw-line); border-radius: 20px; box-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 8px 24px -12px rgba(15, 23, 42, .12); transition: transform .3s cubic-bezier(.2, .7, .2, 1), box-shadow .3s ease, border-color .3s ease; }
	a.sp-aw-feature:hover, a.sp-aw-card:hover { transform: translateY(-3px); border-color: #c7d2fe; box-shadow: 0 2px 4px rgba(15, 23, 42, .05), 0 18px 40px -16px rgba(29, 78, 216, .28); }
	a.sp-aw-feature:focus-visible, a.sp-aw-card:focus-visible { outline: 3px solid #2563eb; outline-offset: 3px; }

	/* The featured award */
	.sp-aw-feature { flex-direction: column; align-items: center; gap: 20px; padding: 28px 24px; text-align: center; background: linear-gradient(165deg, #ffffff 0%, #ffffff 45%, #eff6ff 100%); border-color: #dbeafe; }
	.sp-aw-feature__logo { display: flex; align-items: center; justify-content: center; height: 110px; width: 100%; }
	.sp-aw-feature__logo img { max-height: 100%; max-width: 220px; width: auto; object-fit: contain; }
	.sp-aw-feature__body { display: flex; flex-direction: column; align-items: center; }
	.sp-aw-kicker { margin: 0 0 10px; color: var(--aw-soft); font-size: 12px; font-weight: 600; letter-spacing: .16em; text-transform: uppercase; }
	.sp-aw-feature__title { margin: 12px 0 0; font-size: 26px; font-weight: 700; line-height: 1.15; letter-spacing: -.01em; color: var(--aw-ink); }
	.sp-aw-feature .sp-aw-org { margin-top: 8px; font-size: 16px; }
	.sp-aw-more { display: inline-flex; align-items: center; gap: 6px; margin-top: 18px; color: var(--aw-blue); font-size: 15px; font-weight: 600; }
	.sp-aw-more svg { transition: transform .3s ease; }
	a.sp-aw-feature:hover .sp-aw-more svg { transform: translateX(3px); }

	/* The featured award as its news story: the post's image across the top, the words below. */
	.sp-aw-feature--story { padding: 0; gap: 0; overflow: hidden; align-items: stretch; text-align: left; background: #fff; }
	.sp-aw-story__img { display: block; width: 100%; height: auto; aspect-ratio: 1200 / 630; object-fit: cover; }
	.sp-aw-feature--story .sp-aw-feature__body { flex: 1; align-items: flex-start; justify-content: center; padding: 24px 24px 26px; }
	.sp-aw-feature--story .sp-aw-kicker { margin-bottom: 8px; }
	.sp-aw-feature--story .sp-aw-feature__title { margin-top: 10px; font-size: 24px; }
	.sp-aw-story__excerpt { margin: 10px 0 0; color: #475569; font-size: 15px; line-height: 1.55; }
	.sp-aw-feature--story .sp-aw-more { margin-top: 14px; }

	/* The result and the year: a small label, never the loudest thing on the card */
	.sp-aw-label { display: flex; align-items: center; gap: 8px; margin: 0; }
	.sp-aw-badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; line-height: 1.4; }
	.sp-aw-badge--winner { color: #fff; background: #2563eb; }
	.sp-aw-badge--runner { color: #92400e; background: #fef3c7; box-shadow: inset 0 0 0 1px #fde68a; }
	.sp-aw-year { color: var(--aw-blue); font-size: 13px; font-weight: 700; letter-spacing: .06em; font-variant-numeric: tabular-nums; }
	.sp-aw-org { margin: 4px 0 0; color: var(--aw-soft); font-size: 14px; line-height: 1.4; }

	/* The others: on a phone, a row you swipe */
	.sp-aw-list { display: flex; gap: 12px; margin: 0 -16px; padding: 4px 16px 12px; list-style: none; overflow-x: auto; scroll-snap-type: x mandatory; scroll-padding-inline: 16px; -ms-overflow-style: none; scrollbar-width: none; }
	.sp-aw-list::-webkit-scrollbar { display: none; }
	.sp-aw-item { flex: 0 0 78%; margin: 0; scroll-snap-align: start; display: flex; }
	.sp-aw-card { flex: 1; flex-direction: column; gap: 14px; padding: 20px; }
	.sp-aw-card__logo { display: flex; align-items: center; height: 56px; }
	.sp-aw-card__logo img { max-height: 100%; max-width: 120px; width: auto; object-fit: contain; }
	.sp-aw-card__body { display: flex; flex-direction: column; }
	.sp-aw-card__title { margin: 10px 0 0; font-size: 17px; font-weight: 600; line-height: 1.3; color: var(--aw-ink); }

	@media (min-width: 640px) {
		.sp-aw { gap: 20px; }
		/* The featured award across the top: its logo to the left of its words. */
		.sp-aw-feature { flex-direction: row; gap: 32px; padding: 32px; text-align: left; }
		.sp-aw-feature__logo { flex: 0 0 200px; height: 120px; }
		.sp-aw-feature__body { align-items: flex-start; }
		.sp-aw-feature__title { font-size: 28px; }
		/* The others two to a row, each its logo beside its words. Nothing hidden. */
		.sp-aw-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin: 0; padding: 0; overflow: visible; }
		.sp-aw-card { flex-direction: row; align-items: center; gap: 18px; padding: 18px 20px; }
		.sp-aw-card__logo { flex: 0 0 96px; justify-content: center; height: 64px; }
		.sp-aw-card__logo img { max-width: 96px; }
		.sp-aw-card__title { margin-top: 6px; font-size: 16px; }
	}
	@media (min-width: 640px) {
		/* The story keeps its image on top at every width. */
		.sp-aw-feature--story { flex-direction: column; gap: 0; padding: 0; }
		.sp-aw-feature--story .sp-aw-feature__body { padding: 28px 32px 30px; }
		.sp-aw-feature--story .sp-aw-feature__title { font-size: 26px; }
	}
	@media (min-width: 640px) and (max-width: 1023px) {
		/* An odd one out at the end takes the whole row rather than sitting in half of it. */
		.sp-aw-item:last-child:nth-child(odd) { grid-column: 1 / -1; }
	}
	@media (min-width: 1024px) {
		/* The featured award on the left, the others in a column on the right, the same height. */
		.sp-aw { grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); gap: 24px; align-items: stretch; }
		.sp-aw-feature { flex-direction: column; justify-content: center; gap: 28px; padding: 40px 36px; text-align: center; }
		.sp-aw-feature__logo { flex: none; height: 150px; }
		.sp-aw-feature__logo img { max-width: 280px; }
		.sp-aw-feature__body { align-items: center; }
		.sp-aw-feature__title { font-size: 32px; }
		.sp-aw-feature--story { justify-content: flex-start; gap: 0; padding: 0; text-align: left; }
		.sp-aw-feature--story .sp-aw-feature__body { align-items: flex-start; padding: 26px 32px 30px; }
		.sp-aw-feature--story .sp-aw-feature__title { font-size: 28px; }
		.sp-aw-list { grid-template-columns: minmax(0, 1fr); grid-auto-rows: 1fr; gap: 12px; }
		.sp-aw-card { padding: 14px 22px; }
		.sp-aw-card__logo { flex-basis: 110px; height: 60px; }
		.sp-aw-card__logo img { max-width: 110px; }
		.sp-aw-card__body { display: grid; grid-template-columns: minmax(0, 1fr) auto; grid-template-areas: "title label" "org label"; column-gap: 20px; align-items: center; flex: 1; }
		.sp-aw-card__body .sp-aw-label { grid-area: label; justify-self: end; }
		.sp-aw-card__title { grid-area: title; margin: 0; font-size: 17px; }
		.sp-aw-card__body .sp-aw-org { grid-area: org; }
	}
	@media (prefers-reduced-motion: reduce) {
		.sp-aw-feature, .sp-aw-card, .sp-aw-more svg { transition: none; }
		a.sp-aw-feature:hover, a.sp-aw-card:hover { transform: none; }
	}
</style>
