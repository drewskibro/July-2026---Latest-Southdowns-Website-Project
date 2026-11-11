<?php
/**
 * A page shaped like Southdowns' travel page, with its own stylesheet and
 * type, the planner where the template puts it (above the destinations) and
 * a stand-in for the booking section the cards lead to.
 *   ?bare=1     no theme stylesheet at all: the planner on a site it knows nothing of
 *   ?notices=1  the [travel_notices] list as well
 *   ?book=...   the shortcode's own booking link
 */
require __DIR__ . '/wp.php';
$bare    = ! empty( $_GET['bare'] );
$book    = isset( $_GET['book'] ) ? ' book="' . preg_replace( '/["\]]/', '', (string) $_GET['book'] ) . '"' : ' book="#book"';
$planner = do_shortcode( '[travel_planner' . $book . ']' );
$notices = ! empty( $_GET['notices'] ) ? do_shortcode( '[travel_notices count="6"]' ) : '';
?><!doctype html>
<html lang="en-GB"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Travel health (harness)</title>
<?php if ( ! $bare ) : ?>
<link rel="stylesheet" href="/theme/assets/css/tailwind.css">
<link rel="stylesheet" href="/theme/assets/css/global.css">
<style>body{font-family:'Jost',system-ui,sans-serif}</style>
<?php endif; ?>
<?php h_styles(); ?>
</head><body<?php echo $bare ? '' : ' class="font-jost"'; ?>>
<header style="padding:18px 24px;background:#fff;border-bottom:1px solid #e5e7eb"><strong>Southdowns Pharmacy Group</strong> (harness)</header>
<section style="background:#1a73e9;color:#fff;padding:56px 24px"><div style="max-width:1280px;margin:0 auto"><h1 style="font-size:44px;font-weight:600;margin:0 0 18px">Hampshire's Trusted Travel Health Clinic</h1>
<a data-hero-check href="<?php echo '' !== $planner ? '#trip-planner' : '#vaccines'; ?>" style="display:inline-block;border:2px solid #fff;border-radius:999px;padding:12px 24px;color:#fff;text-decoration:none;font-weight:600">Check What Vaccines You Need</a></div></section>
<section id="why-us" style="background:#fff;padding:64px 24px"><div style="max-width:1280px;margin:0 auto"><h2 style="font-size:40px;font-weight:700;margin:0">Why choose us</h2><p>Stand-in for the section above the planner.</p></div></section>
<?php echo $planner; // the plugin's own output ?>
<section id="destinations" style="background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#3b82f6 100%);color:#fff;padding:64px 24px"><div style="max-width:1280px;margin:0 auto"><h2 style="font-size:40px;font-weight:700;margin:0">Popular Travel Destinations</h2><p>Stand-in for the destinations section.</p></div></section>
<?php echo $notices; ?>
<section id="vaccines" style="background:#fff;padding:64px 24px"><div style="max-width:1280px;margin:0 auto"><h2 style="font-size:32px;margin:0">Vaccines</h2></div></section>
<section id="book" style="background:#fdf9f6;padding:64px 24px;min-height:700px"><div style="max-width:1280px;margin:0 auto"><h2 style="font-size:40px;font-weight:700;margin:0">Book Your Travel Appointment</h2><p>Stand-in for the booking calendar.</p></div></section>
<?php h_scripts(); ?>
</body></html>
