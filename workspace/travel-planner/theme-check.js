/* Southdowns' side of the Travel Planner: what this theme does around it.

     node workspace/travel-planner/theme-check.js

   The plugin itself is Gildhart's product, built and tested in its own
   repository (Gildhart-pharmodigital/gildhart-travel-planner); this checks only
   the theme's part, which that repository cannot see: where the travel page
   puts the planner, the ways to it, and the chat button kept off its booking
   bar on a phone. Each was a fault on the live page on 11 November 2026.

   It reads the files, needs no server, and then breaks each rule in memory to
   prove the check would catch it. Exits 1 on any failure. The live page is
   checked by the product repository's tests/live/live-check.js. */
const fs = require('fs');
const path = require('path');

const ROOT = path.resolve(__dirname, '..', '..');
const TPL = path.join(ROOT, 'southdowns-pharmacy-theme', 'page-templates', 'page-travel-health.php');
const CSS = path.join(ROOT, 'southdowns-pharmacy-theme', 'assets', 'css', 'global.css');

function checks(tpl, css) {
  const out = [];
  const ok = (c, m) => out.push([!!c, m]);
  const phoneHero = (tpl.split('<!-- Mobile: full-width image with overlay -->')[1] || '').split('<!-- Desktop:')[0];
  ok(/data-th-check/.test(phoneHero) && /'#trip-planner'/.test(phoneHero) && /Check What Vaccines You Need/.test(phoneHero),
    'the phone\'s hero has "Check What Vaccines You Need", leading to the planner');
  const at = s => tpl.indexOf(s);
  const order = [at("echo $th_s2_html . $th_s3_html;"), at('echo $th_planner;'), at('S4: POPULAR DESTINATIONS'), at('echo $th_s3_html . $th_s2_html;'), at('S5: COMPREHENSIVE SERVICES')];
  ok(order.every(i => i > 0) && order.every((v, i) => !i || v > order[i - 1]) && at('S1: HERO') < at('ob_start()')
    && /if \( '' === \$th_planner \) \{\s*echo \$th_s2_html \. \$th_s3_html;[\s\S]*?\} else \{[\s\S]*?echo \$th_planner;/.test(tpl),
    'with the planner on the page it comes straight after the hero, the destinations under it, then why-us and the stats; without it the old order stands');
  const intro = (tpl.split('data-th-dest-intro')[1] || '').split('<?php else : ?>')[0];
  ok(intro && !/where/i.test(intro.replace(/<[^>]+>/g, ' ')) && /Popular destinations/.test(intro),
    'under the planner the destinations do not ask "where?" again: they are its popular destinations');
  ok(/data-gtp-pick="<\?php echo esc_attr\( \$d_slug \); \?>"/.test(tpl), 'each destination card opens its country in the planner');
  ok(/html\[data-gtp-pinned\]\s*#ai-chat-launcher\s*\{[^}]*--lift:\s*calc\(var\(--gtp-pinned-height,\s*0px\)\s*-\s*8px\)/.test(css),
    'on a phone the chat button lifts clear of the planner\'s pinned booking bar');
  return out;
}

/* Each rule broken on purpose, in memory: the check above must fail on it. */
const FAULTS = [
  ['the phone\'s hero has no way to the planner', 'tpl', 'px-5 py-2.5 rounded-full font-jost" data-th-check>', 'px-5 py-2.5 rounded-full font-jost">', /phone's hero/],
  ['the planner waits below why-us and the stats', 'tpl', "if ( '' === $th_planner ) {\n\techo $th_s2_html", "if ( true ) {\n\techo $th_s2_html", /straight after the hero/],
  ['the destinations ask "where?" again', 'tpl', '>Popular destinations</h2>', '>Where are you headed?</h2>', /"where\?" again/],
  ['the destination cards are only links', 'tpl', 'data-gtp-pick="<?php echo esc_attr( $d_slug ); ?>"', 'data-x="<?php echo esc_attr( $d_slug ); ?>"', /opens its country/],
  ['the chat button stays on the booking bar', 'css', '--lift: calc(var(--gtp-pinned-height, 0px) - 8px);', '--lift: 0px;', /chat button lifts/],
];

const files = { tpl: fs.readFileSync(TPL, 'utf8'), css: fs.readFileSync(CSS, 'utf8') };
let bad = 0;
for (const [pass, msg] of checks(files.tpl, files.css)) {
  if (!pass) bad++;
  console.log(`${pass ? 'pass' : 'FAIL'}  ${msg}`);
}
let caught = 0;
for (const [name, which, from, to, line] of FAULTS) {
  const f = Object.assign({}, files);
  if (f[which].split(from).length !== 2) { console.log(`NOT PLANTED  ${name}: the text to break was not found once`); bad++; continue; }
  f[which] = f[which].replace(from, to);
  const hit = checks(f.tpl, f.css).some(([pass, msg]) => !pass && line.test(msg));
  if (hit) caught++; else bad++;
  console.log(`${hit ? 'caught' : 'MISSED'}  ${name}`);
}
console.log(`theme: ${bad ? bad + ' problem' + (bad === 1 ? '' : 's') : 'all pass'}; ${caught} of ${FAULTS.length} planted faults caught`);
process.exit(bad ? 1 : 0);
