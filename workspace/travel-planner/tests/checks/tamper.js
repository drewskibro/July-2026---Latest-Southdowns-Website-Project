/* The checks must catch what they exist to catch. Each fault below is a rule
   this plugin keeps, broken on purpose in the plugin's own files; planner.js
   is run against it and must fail on the line named; the file is then put
   back as it was. node checks/tamper.js */
const fs = require('fs');
const path = require('path');
const { spawnSync } = require('child_process');
const ROOT = path.resolve(__dirname, '..', '..', '..', '..', 'gildhart-travel-planner');
const FAULTS = [
  ['a card shows the course\'s total', 'assets/planner.js', "return v.doses > 1 ? money(v.price) + ' a dose' : money(v.price);", "return money(v.price * v.doses);", /each card says a dose's price/],
  ['the public sees the planner in preview', 'includes/settings.php', "if ( gtp_setting( 'enabled' ) ) { return true; }", "return true;", /in preview a visitor sees no planner/],
  ['the reader keeps a notice\'s words', 'includes/notices.php', "'url'     => $url,\n\t\t);\n\t}\n\treturn array( 'ok'", "'url'     => $url,\n\t\t\t'words'   => wp_strip_all_tags( $card ),\n\t\t);\n\t}\n\treturn array( 'ok'", /nothing else|none of a notice's words/],
  ['the first reading emails everything', 'includes/notices.php', "if ( $first ) { return 'first read'; }", "", /the first reading takes the last six months and emails nobody/],
  ['a pharmacy that is no yellow fever centre prices it', 'includes/data.php', "! gtp_setting( 'yf_centre' ) && 'given' === $out['yellow-fever']['status']", "false", /not a registered centre/],
  ['a brand name in the pack', 'data/countries/kenya.json', '"note": "Spread by daytime-biting mosquitoes, and bite', '"note": "Qdenga. Spread by daytime-biting mosquitoes, and bite', /brand name/],
  ['a guide that is a draft is linked', 'includes/planner.php', "if ( ! $id || 'publish' !== get_post_status( $id ) ) { return ''; }", "", /a guide that is a draft is neither offered nor linked/],
  ['an unreadable page is emailed every day', 'includes/notices.php', "if ( $told ) { return 'unreadable'; }", "", /the next failure is not emailed again/],
  ['a notice for several countries is kept under their button\'s label', 'includes/notices.php', "if ( '' === trim( $am[1] ) ) {", "if ( false ) {", /no notice is kept under their button's label/],
  ['a card says two things about the yellow fever certificate', 'data/countries/uganda.json', "The vaccine protects you; no certificate is asked for on entry.", "The vaccine protects you, and the certificate is required for entry in some cases.", /agrees with that country's certificate fact/],
  ['the box does not answer to a place\'s other name', 'assets/planner.js', "var aka = (c.aka || []).filter(begins)[0];", "var aka = null;", /"Bali" finds Indonesia/],
];
let caught = 0;
for (const [name, file, from, to, line] of FAULTS) {
  const f = path.join(ROOT, file);
  const was = fs.readFileSync(f, 'utf8');
  if (was.split(from).length !== 2) { console.log(`  NOT PLANTED ${name}: the line to break was not found once in ${file}`); continue; }
  fs.writeFileSync(f, was.replace(from, to));
  let out = '';
  try { out = spawnSync('node', [path.join(__dirname, 'planner.js')], { encoding: 'utf8', timeout: 400000 }).stdout || ''; }
  finally { fs.writeFileSync(f, was); }
  const fails = out.split('\n').filter(l => /^\s+FAIL/.test(l));
  const hit = fails.some(l => line.test(l));
  if (hit) caught++;
  console.log(`  ${hit ? 'caught' : 'MISSED'}  ${name} (${fails.length} failing)`);
}
console.log(`tamper: ${caught} of ${FAULTS.length} faults caught`);
process.exit(caught === FAULTS.length ? 0 : 1);
