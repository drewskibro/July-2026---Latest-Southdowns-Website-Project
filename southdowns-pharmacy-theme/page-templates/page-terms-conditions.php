<?php
/**
 * Template Name: Terms & Conditions
 *
 * Standalone Terms & Conditions page (slug "terms-conditions").
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
    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold mb-5 font-jost" style="line-height:1.1;"><?php echo sp_field( 'legal_heading', 'Terms &amp; Conditions' ); ?></h1>
    <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-2xl mx-auto font-jost"><?php echo sp_field( 'legal_intro', 'The terms governing your use of our website and services.' ); ?> Last updated: <?php echo esc_html( $last_updated ); ?>.</p>
  </div>
</section>

<!-- BODY -->
<div class="bg-white py-12 md:py-16">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="legal-prose font-jost">
      <?php $legal_body = get_field( 'legal_body' ); if ( $legal_body ) : echo $legal_body; else : ?>
      <h3>Agreement to Terms</h3>
      <p>These Terms and Conditions constitute a legally binding agreement made between you, whether personally or on behalf of an entity ("you") and Southdowns Pharmacy Group ("we," "us" or "our"), concerning your access to and use of the <a href="https://southdownspharmacygroup.co.uk">https://southdownspharmacygroup.co.uk</a> website as well as any other media form, media channel, mobile website or mobile application related, linked, or otherwise connected thereto (collectively, the "Site").</p>
      <p>You agree that by accessing the Site, you have read, understood, and agree to be bound by all of these Terms and Conditions. If you do not agree with all of these Terms and Conditions, then you are expressly prohibited from using the Site and you must discontinue use immediately.</p>
      <p>We reserve the right, in our sole discretion, to make changes or modifications to these Terms and Conditions at any time and for any reason. We will alert you about any changes by updating the "Last updated" date of these Terms and Conditions, and you waive any right to receive specific notice of each such change.</p>
      <p>It is your responsibility to periodically review these Terms and Conditions to stay informed of updates. The Site is intended for users who are at least 18 years old. Persons under the age of 18 are not permitted to use the Site.</p>

      <h3>Intellectual Property Rights</h3>
      <p>Unless otherwise indicated, the Site is our proprietary property. All source code, databases, functionality, software, website designs and graphics on the Site are owned or controlled by or licensed to PharmoDigital Ltd, trading as Gildhart, the digital marketing agency responsible for the design, development, and ongoing management of this website. Some content, such as video, text, photographs, and logos contained therein (the "Marks") are a mixture of content by us and by PharmoDigital Ltd — all of which are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the United Kingdom, foreign jurisdictions, and international conventions.</p>
      <p>The Content and the Marks are provided on the Site "AS IS" for your information and personal use only. Except as expressly provided in these Terms and Conditions, no part of the Site and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without express prior written permission by us or PharmoDigital Ltd (<a href="https://gildhart.com" target="_blank" rel="noopener noreferrer">gildhart.com</a>).</p>

      <h3>User Representations</h3>
      <p>By using the Site, you represent and warrant that:</p>
      <ul>
        <li>all registration information you submit will be true, accurate, current, and complete</li>
        <li>you will maintain the accuracy of such information and promptly update such registration information as necessary</li>
        <li>you have the legal capacity and you agree to comply with these Terms and Conditions</li>
        <li>you are not under the age of 18</li>
        <li>you will not access the Site through automated or non-human means, whether through a bot, script, or otherwise</li>
        <li>you will not use the Site for any illegal or unauthorised purpose</li>
        <li>your use of the Site will not violate any applicable law or regulation</li>
      </ul>

      <h3>Prohibited Activities</h3>
      <p>You may not access or use the Site for any purpose other than that for which we make the Site available. The Site may not be used in connection with any commercial endeavours except those that are specifically endorsed or approved by us.</p>

      <h3>Third-Party Websites and Content</h3>
      <p>The Site may contain links to other websites ("Third-Party Websites") as well as articles, photographs, text, graphics, pictures, designs, music, sound, video, information, applications, software, and other content or items belonging to or originating from third parties ("Third-Party Content").</p>
      <p>Such Third-Party Websites and Third-Party Content are not investigated, monitored, or checked for accuracy, appropriateness, or completeness by us, and we are not responsible for any Third-Party Websites accessed through the Site or any Third-Party Content posted on, available through, or installed from the Site.</p>
      <p>You agree and acknowledge that we do not endorse the products or services offered on Third-Party Websites and you shall hold us harmless from any harm caused by your purchase of such products or services.</p>

      <h3>Site Management</h3>
      <p>We reserve the right, but not the obligation, to:</p>
      <ul>
        <li>monitor the Site for violations of these Terms and Conditions</li>
        <li>take appropriate legal action against anyone who, in our sole discretion, violates the law or these Terms and Conditions</li>
        <li>in our sole discretion and without limitation, refuse, restrict access to, limit the availability of, or disable any of your Contributions or any portion thereof</li>
        <li>remove from the Site or otherwise disable all files and content that are excessive in size or are in any way burdensome to our systems</li>
        <li>otherwise manage the Site in a manner designed to protect our rights and property and to facilitate the proper functioning of the Site</li>
      </ul>

      <h3>Modifications and Interruptions</h3>
      <p>We reserve the right to change, modify, or remove the contents of the Site at any time or for any reason at our sole discretion without notice. We also reserve the right to modify or discontinue all or part of the Site without notice at any time. We will not be liable to you or any third party for any modification, price change, suspension, or discontinuance of the Site.</p>

      <h3>Miscellaneous</h3>
      <p>These Terms and Conditions and any policies or operating rules posted by us on the Site constitute the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision of these Terms and Conditions shall not operate as a waiver of such right or provision. There is no joint venture, partnership, employment or agency relationship created between you and us as a result of these Terms and Conditions or use of the Site.</p>

      <h3>Contact Us</h3>
      <p>In order to resolve a complaint regarding the Site or to receive further information regarding use of the Site, please contact your nearest branch or email <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>.</p>
      <?php endif; ?>
    </div>

    <!-- Related policies -->
    <div class="mt-14 pt-8 border-t border-gray-100 flex flex-wrap gap-3">
      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-colors font-jost">Privacy Policy</a>
      <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-colors font-jost">Cookie Policy</a>
    </div>
  </div>
</div>

<?php get_footer(); ?>
