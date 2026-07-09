<?php
/**
 * Template Name: Privacy Policy
 *
 * Standalone Privacy Policy page (slug "privacy-policy").
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
    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold mb-5 font-jost" style="line-height:1.1;"><?php echo sp_field( 'legal_heading', 'Privacy Policy' ); ?></h1>
    <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-2xl mx-auto font-jost"><?php echo sp_field( 'legal_intro', 'How we collect, use and protect your personal data.' ); ?> Last updated: <?php echo esc_html( $last_updated ); ?>.</p>
  </div>
</section>

<!-- BODY -->
<div class="bg-white py-12 md:py-16">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="legal-prose font-jost">
      <?php $legal_body = get_field( 'legal_body' ); if ( $legal_body ) : echo $legal_body; else : ?>
      <h3>Introduction</h3>
      <p>Southdowns Pharmacy Group ("we", "our" or "us") is committed to protecting your privacy and handling your personal information responsibly, securely and transparently.</p>
      <p>This Privacy Policy explains how we collect, use, store and protect your personal information when you visit our website, make an enquiry, book a service or otherwise interact with us online.</p>
      <p>By using this website and providing your personal information, you consent to the collection, use and processing of your information as described in this Privacy Policy, including being contacted about your enquiry, booking and, where you have given your consent, other healthcare services, clinics, promotions and health initiatives that may be relevant to you. You may withdraw your consent to marketing communications at any time.</p>

      <h3>Who We Are</h3>
      <p>Southdowns Pharmacy Group is an independent community pharmacy group providing NHS and private healthcare services across Hampshire.</p>
      <p>As the Data Controller, we are responsible for ensuring that your personal information is processed in accordance with the UK General Data Protection Regulation (UK GDPR) and the Data Protection Act 2018.</p>

      <h3>Information We Collect</h3>
      <p><strong>Personal Information</strong> — We may collect personal information that you voluntarily provide, including:</p>
      <ul>
        <li>Name</li>
        <li>Email address</li>
        <li>Telephone number</li>
        <li>Appointment or booking details</li>
        <li>Information submitted through contact forms</li>
        <li>Information relating to services you request</li>
      </ul>
      <p><strong>Technical Information</strong> — When you visit our website, we may automatically collect certain information, including:</p>
      <ul>
        <li>IP address</li>
        <li>Browser type and version</li>
        <li>Device information</li>
        <li>Operating system</li>
        <li>Pages visited</li>
        <li>Date and time of access</li>
        <li>Website usage data</li>
      </ul>
      <p>This information helps us improve the performance, security and usability of our website.</p>

      <h3>How We Use Your Information</h3>
      <p>We may use your personal information to:</p>
      <ul>
        <li>Respond to enquiries and requests</li>
        <li>Manage appointments and bookings</li>
        <li>Deliver NHS and private healthcare services</li>
        <li>Process transactions where applicable</li>
        <li>Communicate important information relating to your booking or enquiry</li>
        <li>Inform you about additional healthcare services, clinics, vaccinations, promotions and health campaigns where you have consented to receive such communications</li>
        <li>Improve our website and services</li>
        <li>Monitor website performance and security</li>
        <li>Prevent fraud and protect against unlawful activity</li>
        <li>Comply with legal and regulatory obligations</li>
      </ul>

      <h3>Legal Basis for Processing</h3>
      <p>We process your personal information on one or more of the following lawful bases:</p>
      <ul>
        <li>Your consent</li>
        <li>Performance of a contract</li>
        <li>Compliance with legal obligations</li>
        <li>Our legitimate interests in providing and improving our services</li>
      </ul>
      <p>Where healthcare or special category personal data is processed, we do so only where permitted under applicable data protection legislation.</p>

      <h3>Sharing Your Information</h3>
      <p>We do not sell, rent or trade your personal information.</p>
      <p>We may share your information with carefully selected third-party organisations that assist us in providing healthcare services, operating our website, processing transactions and maintaining our systems. All such providers are required to process personal information securely, confidentially and in accordance with applicable data protection laws.</p>
      <!-- Named processor list retained for UK GDPR transparency (Art. 13/14). Not part of the client's drafted copy — kept deliberately. -->
      <p>The third parties we currently work with include:</p>
      <ul>
        <li><strong>Stripe</strong> — payment processing (<a href="https://stripe.com/gb/privacy" target="_blank" rel="noopener noreferrer">stripe.com</a>)</li>
        <li><strong>Amelia</strong> — online booking system</li>
        <li><strong>Gildhart (PharmoDigital Ltd)</strong> — digital marketing, website design and management (<a href="https://gildhart.com" target="_blank" rel="noopener noreferrer">gildhart.com</a>)</li>
        <li><strong>Google Analytics</strong> — website analytics</li>
        <li><strong>Kinsta</strong> — website hosting</li>
      </ul>
      <p>We may also disclose personal information where required by law or where necessary to protect the rights, property, safety or security of Southdowns Pharmacy Group, our patients, staff or the wider public.</p>

      <h3>Cookies</h3>
      <p>Our website uses cookies and similar technologies to enhance your browsing experience, understand how visitors use our website and improve our services.</p>
      <p>You can manage or disable cookies through your browser settings. Further information is available in our <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>">Cookie Policy</a>.</p>

      <h3>Data Security</h3>
      <p>We implement appropriate technical, organisational and physical safeguards designed to protect your personal information against accidental loss, unauthorised access, misuse, alteration or disclosure.</p>
      <p>While we take reasonable steps to protect your information, no method of internet transmission or electronic storage is completely secure.</p>

      <h3>Data Retention</h3>
      <p>We retain personal information only for as long as necessary to fulfil the purposes for which it was collected or to comply with legal, regulatory and professional obligations.</p>

      <h3>Your Rights</h3>
      <p>Under UK GDPR, you have the right to:</p>
      <ul>
        <li>Request access to the personal information we hold about you.</li>
        <li>Request correction of inaccurate or incomplete personal information.</li>
        <li>Request deletion of your personal information where applicable.</li>
        <li>Restrict or object to certain types of processing.</li>
        <li>Withdraw your consent at any time where processing is based on consent, including your consent to receive information about future healthcare services, promotions and health campaigns.</li>
      </ul>

      <h3>Third-Party Websites</h3>
      <p>Our website may contain links to external websites. We are not responsible for the privacy practices or content of those websites and encourage you to review their own privacy policies before providing personal information.</p>

      <h3>Changes to this Privacy Policy</h3>
      <p>We may update this Privacy Policy from time to time to reflect changes in legislation, technology or our services. Any updates will be published on this page together with the revised "Last Updated" date.</p>

      <h3>Contact Us</h3>
      <p>If you have any questions about this Privacy Policy or wish to exercise your data protection rights, you may contact your nearest Southdowns Pharmacy Group branch, or email us at <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>.</p>
      <p>We are committed to handling your personal information responsibly and addressing any privacy-related queries promptly.</p>
      <?php endif; ?>
    </div>

    <!-- Related policies -->
    <div class="mt-14 pt-8 border-t border-gray-100 flex flex-wrap gap-3">
      <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-colors font-jost">Terms &amp; Conditions</a>
      <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-colors font-jost">Cookie Policy</a>
    </div>
  </div>
</div>

<?php get_footer(); ?>
