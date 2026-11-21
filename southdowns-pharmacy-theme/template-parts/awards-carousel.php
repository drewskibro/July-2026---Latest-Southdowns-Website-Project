<?php
/**
 * The awards row: a horizontal carousel at every width.
 *
 * Used by front-page.php and page-templates/page-about-us.php, under their own
 * eyebrow and heading. Awards come from sp_awards() (Pharmacy Settings → Awards).
 *
 *   Phone:   about 82% a card, native swipe and snap, and the existing autoplay.
 *   Tablet:  about 45% a card.
 *   Desktop: about five cards with the next one cut off at the edge, round
 *            arrows either side (each hides at its end) and click-and-drag.
 *
 * The theme's Tailwind is pre-built, so the widths, arrows and cursors that
 * have no compiled class are in the <style> block below.
 */
$awards = sp_awards();
?>
<div class="sp-awards relative" data-sp-awards>
  <button type="button" class="sp-awards__arrow sp-awards__arrow--prev bg-blue-600 text-white rounded-full shadow-lg" aria-label="Previous awards" data-sp-awards-prev hidden>
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
  </button>

  <div id="awards-track" class="sp-awards__track flex overflow-x-auto snap-x snap-mandatory awards-no-scrollbar gap-5 md:gap-6 -mx-4 px-4 sm:mx-0 sm:px-0" tabindex="0" role="region" aria-label="Our awards" data-sp-awards-track>
    <?php foreach ( $awards as $aw ) :
      $aw_link = (string) ( $aw['link'] ?? '' );
      $aw_tag  = '' !== $aw_link ? 'a' : 'div';
      $aw_alt  = '' !== (string) ( $aw['alt'] ?? '' ) ? $aw['alt'] : $aw['org'] . ' logo';
      $badge   = $aw['badge'] ?? '';
    ?>
    <<?php echo $aw_tag; ?> class="sp-award shrink-0 snap-center flex flex-col items-center text-center bg-[#fdf9f6] border border-[#e8e0d8] rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1"<?php if ( 'a' === $aw_tag ) : ?> href="<?php echo esc_url( $aw_link ); ?>" draggable="false" aria-label="<?php echo esc_attr( 'Read about our ' . $aw['title'] . ' ' . $aw['year'] ); ?>"<?php endif; ?>>
      <div class="h-16 md:h-20 flex items-center justify-center mb-4">
        <img src="<?php echo esc_url( $aw['logo'] ); ?>" alt="<?php echo esc_attr( $aw_alt ); ?>" class="max-h-full max-w-[150px] w-auto object-contain" loading="lazy" draggable="false" />
      </div>
      <div class="text-3xl font-bold text-blue-700 font-jost mb-1.5"><?php echo esc_html( $aw['year'] ); ?></div>
      <?php /* Fixed-height slot so cards stay aligned whether or not a badge is set. */ ?>
      <div class="h-7 flex items-center justify-center mb-2">
        <?php if ( $badge === 'finalist' ) : ?>
        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full border border-amber-200 bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wide font-jost">Runner Up</span>
        <?php elseif ( $badge === 'winner' ) : ?>
        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-blue-600 text-white text-xs font-bold uppercase tracking-wide font-jost">Winner</span>
        <?php endif; ?>
      </div>
      <h3 class="text-base font-semibold text-slate-800 font-jost leading-snug mb-2"><?php echo esc_html( $aw['title'] ); ?></h3>
      <p class="mt-auto text-sm text-slate-500 font-jost"><?php echo esc_html( $aw['org'] ); ?></p>
    </<?php echo $aw_tag; ?>>
    <?php endforeach; ?>
  </div>

  <button type="button" class="sp-awards__arrow sp-awards__arrow--next bg-blue-600 text-white rounded-full shadow-lg" aria-label="Next awards" data-sp-awards-next hidden>
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
  </button>
</div>

<style>
  .awards-no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  .awards-no-scrollbar::-webkit-scrollbar { display: none; }
  /* Room for a card's hover lift and shadow, which a scrolling row would otherwise clip. */
  .sp-awards__track { padding-top: 6px; padding-bottom: 18px; margin-top: -6px; margin-bottom: -18px; }
  .sp-awards__track:focus-visible { outline: 3px solid #2563eb; outline-offset: 4px; border-radius: 1rem; }
  .sp-award { flex: 0 0 82%; text-decoration: none; }
  @media (min-width: 640px) {
    .sp-award { flex-basis: calc((100% - 1.25rem) / 2.2); scroll-snap-align: start; }
  }
  @media (min-width: 768px) {
    .sp-award { flex-basis: calc((100% - 1.5rem) / 2.2); }
  }
  @media (min-width: 1024px) {
    /* About five a row, the sixth cut off at the edge to say there is more. */
    .sp-award { flex-basis: max(200px, calc((100% - 6rem) / 5.3)); }
  }
  .sp-awards__arrow { display: none; }
  @media (min-width: 1024px) {
    .sp-awards__arrow { position: absolute; top: 50%; z-index: 10; display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; transform: translateY(-50%); transition: background-color .2s ease; }
    .sp-awards__arrow:hover { background-color: #1d4ed8; }
    .sp-awards__arrow:focus-visible { outline: 3px solid #93c5fd; outline-offset: 3px; }
    .sp-awards__arrow--prev { left: -46px; }
    .sp-awards__arrow--next { right: -46px; }
    .sp-awards__arrow[hidden] { display: none; }
  }
  @media (hover: hover) and (pointer: fine) {
    .sp-awards__track { cursor: grab; }
    .sp-awards__track.is-dragging { cursor: grabbing; scroll-snap-type: none; user-select: none; }
    .sp-awards__track.is-dragging .sp-award { pointer-events: none; }
  }
</style>
<script>
  (function () {
    var wrap = document.querySelector('[data-sp-awards]');
    var track = wrap && wrap.querySelector('[data-sp-awards-track]');
    if (!track) return;
    var prev = wrap.querySelector('[data-sp-awards-prev]');
    var next = wrap.querySelector('[data-sp-awards-next]');

    /* One card and its gap. */
    function stepSize() {
      var card = track.children[0];
      if (!card) return track.clientWidth;
      var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
      return card.getBoundingClientRect().width + gap;
    }

    /* Arrows: each hides when there is nothing more that way. */
    var queued = false;
    function update() {
      queued = false;
      var max = track.scrollWidth - track.clientWidth;
      prev.hidden = track.scrollLeft <= 2;
      next.hidden = track.scrollLeft >= max - 2;
    }
    function queue() { if (!queued) { queued = true; requestAnimationFrame(update); } }
    prev.addEventListener('click', function () { track.scrollBy({ left: -stepSize(), behavior: 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left: stepSize(), behavior: 'smooth' }); });
    track.addEventListener('scroll', queue, { passive: true });
    window.addEventListener('resize', queue);
    window.addEventListener('load', queue);
    update();

    /* Click-and-drag with a mouse. Touch is left to the browser's own swipe and snap.
       A move of more than 5px is a drag, and the click that ends it does not open a card. */
    var down = false, dragged = false, startX = 0, startLeft = 0, pointerId = null;
    track.addEventListener('pointerdown', function (e) {
      if (e.pointerType !== 'mouse' || e.button !== 0) return;
      down = true; dragged = false; startX = e.clientX; startLeft = track.scrollLeft; pointerId = e.pointerId;
    });
    track.addEventListener('pointermove', function (e) {
      if (!down || e.pointerId !== pointerId) return;
      var dx = e.clientX - startX;
      if (!dragged && Math.abs(dx) > 5) {
        dragged = true;
        track.classList.add('is-dragging');
        try { track.setPointerCapture(pointerId); } catch (err) {}
      }
      if (dragged) { track.scrollLeft = startLeft - dx; }
    });
    function end(e) {
      if (!down || (e && e.pointerId !== pointerId)) return;
      down = false;
      if (!dragged) return;
      /* Settle on the nearest card, as the snap would. */
      var step = stepSize(), left = track.scrollLeft;
      track.classList.remove('is-dragging');
      track.scrollLeft = left;
      track.scrollTo({ left: Math.round(left / step) * step, behavior: 'smooth' });
    }
    track.addEventListener('pointerup', end);
    track.addEventListener('pointercancel', end);
    track.addEventListener('click', function (e) {
      if (dragged) { e.preventDefault(); e.stopPropagation(); dragged = false; }
    }, true);
    track.addEventListener('dragstart', function (e) { e.preventDefault(); });

    /* Phones: the row moves on by itself every few seconds, and pauses while it is touched (as before). */
    var mobile = window.matchMedia('(max-width: 639px)');
    var idx = 0, timer = null, resumeTimer = null;
    function auto() {
      var cards = track.children;
      if (!cards.length) return;
      idx = (idx + 1) % cards.length;
      track.scrollTo({ left: cards[idx].offsetLeft - cards[0].offsetLeft, behavior: 'smooth' });
    }
    function start() {
      stop();
      if (!mobile.matches) return;
      timer = setInterval(auto, 3500);
    }
    function stop() { if (timer) { clearInterval(timer); timer = null; } }
    function pauseThenResume() {
      stop();
      clearTimeout(resumeTimer);
      resumeTimer = setTimeout(start, 5000);
    }
    start();
    (mobile.addEventListener ? mobile.addEventListener('change', start) : mobile.addListener(start));
    track.addEventListener('touchstart', stop, { passive: true });
    track.addEventListener('touchend', pauseThenResume, { passive: true });
  })();
</script>
