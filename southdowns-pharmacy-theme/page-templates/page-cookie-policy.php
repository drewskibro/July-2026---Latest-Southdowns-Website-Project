<?php
/**
 * Template Name: Cookie Policy
 *
 * Standalone Cookie Policy page (slug "cookie-policy").
 * Reuses the Southdowns design system (Jost type, blue accents, premium-badge).
 * Gildhart links open in a new tab.
 */
get_header();
$email        = sp_email();
$last_updated = sp_field( 'legal_updated', 'June 2026' );
?>

<style>
  .legal-prose h3 { font-weight: 700; color: #1e293b; font-size: 1.25rem; margin-top: 2rem; margin-bottom: 0.75rem; }
  .legal-prose p { color: #4b5563; line-height: 1.75; margin-bottom: 1rem; }
  .legal-prose ul { list-style: none; margin: 0 0 1.25rem; padding: 0; }
  .legal-prose ul li { position: relative; padding-left: 1.75rem; color: #4b5563; line-height: 1.7; margin-bottom: 0.6rem; }
  .legal-prose ul li::before { content: ''; position: absolute; left: 0; top: 0.6rem; width: 8px; height: 8px; border-radius: 9999px; background: linear-gradient(135deg,#1d4ed8,#3b82f6); }
  .legal-prose a { color: #1d4ed8; text-decoration: underline; }
  .legal-prose a:hover { color: #1e3a8a; }
  .legal-prose strong { color: #1e293b; }
</style>

<!-- HERO -->
<section class="relative py-16 md:py-20 overflow-hidden" style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white rounded-full translate-x-1/4 translate-y-1/4"></div>
  </div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="premium-badge flex items-center justify-center gap-4 mb-6">
      <div class="badge-rule w-10 h-px bg-white/30"></div>
      <span class="badge-text text-white/80 text-sm font-light tracking-[0.15em] uppercase font-jost"><?php echo sp_field( 'legal_eyebrow', 'Legal &amp; Policies' ); ?></span>
    </div>
    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold mb-5 font-jost" style="line-height:1.1;"><?php echo sp_field( 'legal_heading', 'Cookie Policy' ); ?></h1>
    <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-2xl mx-auto font-jost"><?php echo sp_field( 'legal_intro', 'How we use cookies and how to manage your preferences.' ); ?> Last updated: <?php echo esc_html( $last_updated ); ?>.</p>
  </div>
</section>

<!-- BODY -->
<div class="bg-white py-12 md:py-16">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="legal-prose font-jost">
      <?php $legal_body = get_field( 'legal_body' ); if ( $legal_body ) : echo $legal_body; else : ?>
      <h3>What Are Cookies?</h3>
      <p>Cookies are small text files that are placed on your computer or mobile device when you visit a website. They are widely used to make websites work more efficiently and to provide information to the owners of the site. Cookies do not contain information that personally identifies you, but personal information we store about you may be linked to information obtained from cookies.</p>

      <h3>How We Use Cookies</h3>
      <p>We use cookies for the following purposes:</p>
      <ul>
        <li><strong>Essential cookies</strong> — Necessary for the website to function. They are usually only set in response to actions made by you, such as setting your privacy preferences or filling in forms.</li>
        <li><strong>Analytics cookies</strong> — These allow us to count visits and traffic sources so we can measure and improve the performance of our site. We use Google Analytics for this purpose. All information collected is aggregated and anonymous.</li>
        <li><strong>Functional cookies</strong> — These enable enhanced functionality and personalisation, set by us or by third party providers whose services we have added to our pages.</li>
        <li><strong>Booking system cookies</strong> — Our online booking system (Amelia) uses cookies to manage your session and ensure your booking is processed correctly.</li>
        <li><strong>Payment cookies</strong> — Our payment processor (Stripe) uses cookies to help prevent fraud and process payments securely.</li>
      </ul>

      <h3>Third-Party Cookies</h3>
      <p>In addition to our own cookies, we use the following third-party cookies:</p>
      <ul>
        <li><strong>Google Analytics</strong> — website analytics and performance measurement</li>
        <li><strong>Stripe</strong> — secure payment processing</li>
        <li><strong>Amelia</strong> — online appointment booking system</li>
      </ul>
      <p>Our website is designed, developed, and managed by Gildhart (PharmoDigital Ltd). For more information about our digital marketing partner, visit <a href="https://gildhart.com" target="_blank" rel="noopener noreferrer">gildhart.com</a>.</p>

      <h3>Managing Cookies</h3>
      <p>Most web browsers allow you to manage your cookie preferences. You can set your browser to refuse cookies, or to alert you when cookies are being sent. Please note that if you choose to refuse cookies, you may not be able to use all the features of our Site.</p>
      <p>You can also opt out of Google Analytics by installing the Google Analytics Opt-out Browser Add-on, available at <a href="https://tools.google.com/dlpage/gaoptout">https://tools.google.com/dlpage/gaoptout</a>.</p>

      <h3>Changes to This Cookie Policy</h3>
      <p>We may update this Cookie Policy from time to time. Please re-visit this Cookie Policy regularly to stay informed about our use of cookies and related technologies. The date at the top of this page indicates when it was last updated.</p>

      <h3>Contact Us</h3>
      <p>If you have questions about our use of cookies or other technologies, please email <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a> or contact your nearest branch.</p>
      <?php endif; ?>
    </div>

    <!-- Related policies -->
    <div class="mt-14 pt-8 border-t border-gray-100 flex flex-wrap gap-3">
      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-colors font-jost">Privacy Policy</a>
      <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-colors font-jost">Terms &amp; Conditions</a>
    </div>
  </div>
</div>

<?php get_footer(); ?>
