<?php
/**
 * Template Name: FAQ
 *
 * Frequently Asked Questions page. Create a Page (e.g. titled "FAQ", slug
 * "faq") and assign this template via Page → Template.
 *
 * Renders an accordion of common patient questions, a FAQPage JSON-LD schema
 * block, and the four branches in alphabetical order (via sp_branch_order())
 * with address, phone and opening hours.
 */
get_header();

// Common patient questions. Editable in WordPress (FAQ → FAQ Items); the
// defaults below render — and feed the schema — until the client edits them.
$faqs = sp_rows( 'faq_items', [
    [
        'q' => 'Do I need an appointment, or can I just walk in?',
        'a' => 'For everyday pharmacy needs — prescriptions, advice and over-the-counter medicines — you are welcome to walk in during opening hours. Clinical services such as travel health, weight loss consultations and vaccinations are best booked in advance so we can set time aside for you. You can book online or call your nearest branch.',
    ],
    [
        'q' => 'Do I need a GP referral?',
        'a' => 'No. Most of our private services — including travel vaccinations, weight loss consultations and health checks — do not need a GP referral. You can book directly with us.',
    ],
    [
        'q' => 'Are same-day appointments available?',
        'a' => 'Often, yes. Same-day and next-day appointments are usually available subject to demand. Booking online shows you live availability across all four branches.',
    ],
    [
        'q' => 'How do I book an appointment?',
        'a' => 'Book online through our appointment page, or call your nearest branch directly. You can choose your location, service and time in a couple of minutes.',
    ],
    [
        'q' => 'Which branch offers Yellow Fever vaccinations?',
        'a' => 'Yellow Fever vaccinations are carried out at our Bosmere Pharmacy in Havant, which is a NaTHNaC-registered Yellow Fever Vaccination Centre.',
    ],
    [
        'q' => 'Which branch offers ear wax removal?',
        'a' => 'Our TympaHealth ear wax removal service, using gentle microsuction, is available at our Emsworth branch.',
    ],
    [
        'q' => 'Do you offer NHS services?',
        'a' => 'Yes. Our pharmacies provide NHS services including Pharmacy First consultations, prescription dispensing and seasonal vaccinations, alongside our private clinics.',
    ],
    [
        'q' => 'Can I get my NHS repeat prescriptions from you?',
        'a' => 'Yes. You can nominate any of our branches as your regular pharmacy, and your GP surgery will then send your repeat prescriptions to us electronically through the NHS Electronic Prescription Service.',
    ],
    [
        'q' => 'How much do travel vaccinations cost?',
        'a' => 'Prices depend on which vaccines you need for your destination. We confirm the full cost with you during your travel health consultation, with no obligation to proceed.',
    ],
    [
        'q' => 'What are your opening hours?',
        'a' => 'Opening hours vary slightly by branch. You will find the address, phone number and opening hours for each of our four Hampshire pharmacies further down this page.',
    ],
], [ 'q' => 'question', 'a' => 'answer' ] );

// Branch display names — task specifies this exact wording.
$faq_branch_names = [
    2 => 'Bosmere (Havant)',
    3 => 'Davies (Havant)',
    1 => 'Emsworth',
    4 => 'Rowlands Castle',
];

// FAQPage JSON-LD schema, built from the questions above.
$faq_schema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [],
];
foreach ( $faqs as $faq_item ) {
    $faq_schema['mainEntity'][] = [
        '@type'          => 'Question',
        'name'           => $faq_item['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => wp_strip_all_tags( $faq_item['a'] ),
        ],
    ];
}
echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
?>

<style>
  .faq-a { max-height: 0; overflow: hidden; transition: max-height .3s ease; }
  .faq-item.open .faq-a { max-height: 600px; }
  .faq-chevron { transition: transform .3s ease; }
  .faq-item.open .faq-chevron { transform: rotate(180deg); }
</style>

<!-- ============================================================
     BREADCRUMB
     ============================================================ -->
<div class="bg-gray-50 border-b border-gray-200 px-4 md:px-8 lg:px-12 py-3">
  <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm font-jost">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-blue-600 hover:text-blue-800 transition-colors">Home</a>
    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span class="text-gray-800 font-medium">FAQs</span>
  </div>
</div>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="relative py-14 md:py-20 bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-6">
      <div class="badge-rule w-10 h-px bg-slate-800/20"></div>
      <span class="badge-text text-slate-500 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'faq_hero_eyebrow', 'Help &amp; Support' ); ?></span>
    </div>
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-slate-800 mb-5 font-jost"><?php echo sp_field( 'faq_hero_heading', 'Frequently Asked Questions' ); ?></h1>
    <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed font-jost"><?php echo sp_field( 'faq_hero_intro', 'Answers to the questions our Hampshire patients ask most &mdash; plus address, phone and opening hours for all four branches.' ); ?></p>
  </div>
</section>

<!-- ============================================================
     FAQ ACCORDION
     ============================================================ -->
<section class="py-12 md:py-20 bg-white">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="space-y-3">
      <?php foreach ( $faqs as $idx => $faq_item ) : ?>
      <div class="faq-item bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        <button type="button" class="faq-q w-full flex items-center justify-between gap-4 px-5 md:px-6 py-4 md:py-5 text-left hover:bg-slate-50 transition-colors" aria-expanded="false" aria-controls="faq-a-<?php echo esc_attr( $idx ); ?>">
          <span class="text-base md:text-lg font-semibold text-slate-800 font-jost"><?php echo esc_html( $faq_item['q'] ); ?></span>
          <svg class="faq-chevron w-5 h-5 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div id="faq-a-<?php echo esc_attr( $idx ); ?>" class="faq-a">
          <p class="px-5 md:px-6 pb-5 text-slate-600 leading-relaxed font-jost"><?php echo esc_html( $faq_item['a'] ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     OUR BRANCHES — alphabetical, with address / phone / hours
     ============================================================ -->
<section class="py-14 md:py-20 bg-[#fdf9f6] border-t border-[#e8e0d8]">
  <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">

    <div class="text-center mb-10 md:mb-12">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-800 mb-3 font-jost"><?php echo sp_field( 'faq_branches_heading', 'Our Four Hampshire Branches' ); ?></h2>
      <p class="text-lg text-slate-500 font-jost"><?php echo sp_field( 'faq_branches_intro', 'Address, phone and opening hours for every branch.' ); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
      <?php foreach ( sp_branch_order() as $i ) :
        $b         = sp_branch( $i );
        $b_name    = $faq_branch_names[ $i ] ?? $b['name'];
        $b_addr    = implode( ', ', array_filter( [ $b['address_line1'], $b['address_line2'], $b['postcode'] ] ) );
        $b_hours   = sp_branch_hours_html( $b );
      ?>
      <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="relative overflow-hidden aspect-[16/9]">
          <img src="<?php echo esc_url( $b['card_image'] ); ?>" alt="<?php echo esc_attr( $b_name ); ?> pharmacy" class="w-full h-full object-cover" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
          <h3 class="absolute bottom-4 left-5 right-5 text-white text-xl md:text-2xl font-bold font-jost"><?php echo esc_html( $b_name ); ?></h3>
        </div>
        <div class="p-6 md:p-7">
          <div class="space-y-3.5">

            <?php if ( $b_addr ) : ?>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <address class="text-slate-600 text-base not-italic font-jost leading-relaxed"><?php echo esc_html( $b_addr ); ?></address>
            </div>
            <?php endif; ?>

            <?php if ( ! empty( $b['phone'] ) ) : ?>
            <div class="flex items-center gap-3">
              <svg class="w-5 h-5 text-blue-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $b['phone'] ) ); ?>" class="text-slate-600 text-base font-jost hover:text-blue-600 transition-colors"><?php echo esc_html( $b['phone'] ); ?></a>
            </div>
            <?php endif; ?>

            <?php if ( $b_hours ) : ?>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
              <div class="text-slate-600 text-base font-jost leading-relaxed"><?php echo $b_hours; ?></div>
            </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============================================================
     CTA
     ============================================================ -->
<section class="py-12 md:py-16 bg-white border-t border-[#e8e0d8]">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-3 font-jost"><?php echo sp_field( 'faq_cta_heading', 'Still have a question?' ); ?></h2>
    <p class="text-slate-600 font-jost mb-6"><?php echo sp_field( 'faq_cta_body', 'Our team is happy to help &mdash; book an appointment online or call your nearest branch.' ); ?></p>
    <a href="<?php echo esc_url( sp_booking_url() ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-base font-semibold px-7 py-3.5 rounded-full transition-colors font-jost">
      <?php echo sp_field( 'faq_cta_btn', 'Book an Appointment' ); ?>
      <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>
  </div>
</section>

<script>
(function () {
  document.querySelectorAll('.faq-q').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item = btn.closest('.faq-item');
      var open = item.classList.toggle('open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });
})();
</script>

<?php get_footer();
