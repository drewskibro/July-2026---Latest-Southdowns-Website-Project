/* The Travel Planner plugin (gildhart-travel-planner/), run without WordPress
   on the harness (tests/harness), with Southdowns' own settings file and a
   saved copy of TravelHealthPro's outbreak search whose every notice's words
   were taken out (tests/fixtures). TravelHealthPro is never asked.

   What it holds, each a rule from the first site this ran on or from the
   brief for this one (11 November 2026):

   - the pharmacy's point on the map is worked out from its address, exactly
     as the map was drawn;
   - a card prices a dose, from the settings: "£56 a dose" beside "2 doses",
     a single dose at its price, a child's price beside it, "Ask us" for what
     nobody has priced, a vaccine that comes inside another saying so; no
     course's total and no trip's sum anywhere;
   - a price changed in the settings is the price on the card at once;
   - yellow fever is priced only by a registered centre, and says where;
   - every card ends at the booking; a guide is linked only while published;
   - nothing in the pack is a price, a pharmacy's words or a brand name;
   - in preview only an editor sees the planner, and the page's own button
     goes where it went before;
   - the reader keeps a notice's date, disease, country and regions and none
     of its words; reads the last six months once and the last month after;
     emails a new notice for a disease the pharmacy vaccinates against, never
     on the first reading; says once when their page cannot be read, keeps
     the last good reading with its date, and stops showing it after 30 days;
   - a person can add a notice, take one off, read now and pause the reader;
   - it holds on a phone, on a site with no stylesheet of its own, and from
     the keyboard;
   - on a phone the pinned booking bar tells the page its height, and the
     theme lifts the chat button clear of both its buttons; the map's pin and
     route are not drawn behind the box;
   - a card anywhere on the page can open its country in the planner;
   - the travel page leads a phone to the planner from its hero, puts the
     planner straight after the hero, and does not ask "where?" twice;
   - the page cache is cleared when the settings change, when the notices on
     show change (and not when they do not), and once for a new version,
     through Kinsta's own call when the site is on Kinsta. */
const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const PORT = process.env.GTP_PORT || 8911;
const BASE = `http://127.0.0.1:${PORT}`;
const ROOT = path.resolve(__dirname, '..', '..', '..', '..');
const PACK = path.join(ROOT, 'gildhart-travel-planner', 'data');
const SITE = JSON.parse(fs.readFileSync(path.join(ROOT, 'southdowns-pharmacy-theme', 'gildhart-travel-planner.json'), 'utf8'));
const NOW = '2026-11-11 12:00';

let pass = 0, fail = 0;
const ok = (c, m) => { if (c) { pass++; } else { fail++; console.log('  FAIL', m); } };
const readJson = f => JSON.parse(fs.readFileSync(f, 'utf8'));
const q = o => Object.entries(o).map(([k, v]) => `${encodeURIComponent(k)}=${encodeURIComponent(typeof v === 'string' ? v : JSON.stringify(v))}`).join('&');

/* The pharmacy's booking list, a dose, on 11 November 2026: the words a card must say. */
const SAYS = {
  'hepatitis-a': '£56 a dose', 'tetanus-dtp': '£35', 'typhoid': '£40', 'hepatitis-b': '£36 a dose', 'rabies': '£98.50 a dose',
  'japanese-encephalitis': '£119 a dose', 'tick-borne-encephalitis': '£65 a dose', 'cholera': '£100 a dose', 'dengue': '£96 a dose',
  'chikungunya': '£180', 'measles-mmr': '£35 a dose', 'menacwy': '£57', 'yellow-fever': '£95', 'tuberculosis-bcg': 'Ask us',
  'polio': 'With the tetanus, diphtheria and polio booster',
};
const CHILD = { 'hepatitis-b': '£30 a dose for children', 'tick-borne-encephalitis': '£56 a dose for children' };
const BRANDS = ['qdenga', 'ixiaro', 'dukoral', 'vaxchora', 'vivotif', 'typhim', 'havrix', 'avaxim', 'vaqta', 'engerix', 'twinrix', 'rabipur', 'verorab', 'stamaril', 'revaxis', 'nimenrix', 'menveo', 'menquadfi', 'ticovac', 'ixchiq', 'vimkunya', 'priorix', 'malarone', 'chloroquine', 'atovaquone', 'proguanil', 'doxycycline', 'mefloquine'];

(async () => {
  const b = await chromium.launch({ args: ['--no-proxy-server'] });
  const world = async (name, as = 'visitor', opts = {}) => {
    const ctx = await b.newContext({ viewport: { width: opts.w || 1440, height: opts.h || 900 }, reducedMotion: 'reduce' });
    const ctl = async (o = {}) => (await ctx.request.get(`${BASE}/ctl.php?${q(o)}`)).json();
    await ctl({ world: name, be: as, fresh: 1, 'set[__now]': NOW });
    const enable = async (more = {}) => { const s = (await ctl()).settings; await ctl({ option: 'gtp_settings', value: Object.assign({}, s, { enabled: true }, more) }); };
    const page = async (url = '/page.php') => { const p = await ctx.newPage(); p.errs = []; p.on('pageerror', e => p.errs.push(String(e))); await p.goto(BASE + url, { waitUntil: 'networkidle' }); return p; };
    return { ctx, ctl, enable, page, be: who => ctl({ be: who }) };
  };
  const pick = async (p, text) => { const i = p.locator('[data-gtp-input]'); await i.fill(''); await i.type(text); await i.press('Enter'); await p.waitForSelector('[data-gtp-card][data-gtp-in]'); };
  const rowsOf = p => p.locator('[data-gtp-row]').evaluateAll(r => r.map(x => ({
    id: x.getAttribute('data-gtp-row'), course: x.querySelector('.gtp__vax-course').textContent, price: x.querySelector('[data-gtp-price]').textContent,
    child: (x.querySelector('[data-gtp-child]') || { textContent: '' }).textContent, where: (x.querySelector('[data-gtp-where]') || { textContent: '' }).textContent,
    badge: x.querySelector('[data-gtp-badge]').textContent, note: x.querySelector('.gtp__vax-note').textContent })));

  // ---- the pack: no price, no pharmacy, no brand --------------------------------
  {
    const files = fs.readdirSync(path.join(PACK, 'countries')).filter(f => f.endsWith('.json'));
    const index = readJson(path.join(PACK, 'countries.json')).countries;
    const cat = readJson(path.join(PACK, 'vaccines.json'));
    const meta = readJson(path.join(PACK, 'pack.json'));
    ok(index.length >= 250 && files.length === index.filter(c => c.planner).length, `the pack: ${index.length} countries, ${files.length} with a card`);
    const bad = [];
    for (const f of [...files.map(x => path.join('countries', x)), 'vaccines.json', 'countries.json', 'pack.json']) {
      const t = fs.readFileSync(path.join(PACK, f), 'utf8'); const low = t.toLowerCase();
      if (t.includes('£')) bad.push(`${f}: a price`);
      if (/we're a registered|we can issue|\bmiles\b|southdowns/.test(low)) bad.push(`${f}: a pharmacy's words`);
      for (const br of BRANDS) if (new RegExp(`\\b${br}\\b`).test(low)) bad.push(`${f}: ${br}`);
    }
    ok(!bad.length, `nothing in the pack is a price, a pharmacy's own words or a brand name (${bad.slice(0, 4).join('; ') || 'none'})`);
    const used = new Set(files.flatMap(f => { const d = readJson(path.join(PACK, 'countries', f)); return [...d.vaccines.most, ...d.vaccines.some].map(v => v.id); }));
    ok([...used].every(id => cat[id] && cat[id].name && cat[id].doses >= 1), `every vaccine a card names is in the catalogue with its doses (${used.size})`);
    ok(/^\d{4}-\d{2}-\d{2}$/.test(meta.read.oldest) && /Open Government Licence v3\.0/.test(meta.licence), `the pack says when it was read (${meta.read.oldest}) and carries the licence line`);
    ok(Object.keys(SITE.vaccines).every(id => cat[id]) && Object.keys(cat).every(id => SITE.vaccines[id]), 'the site\'s file says something of every vaccine the cards name, and nothing of any other');
    /* A card never says two things about the yellow fever certificate: the vaccine's line follows the
       country's own certificate fact. Uganda asked for none from October 2026, and one sentence for every
       country went on saying a certificate "is required for entry in some cases". */
    const clash = []; let yfCards = 0;
    for (const f of files) {
      const d = readJson(path.join(PACK, 'countries', f));
      const yf = [...d.vaccines.most, ...d.vaccines.some].find(v => v.id === 'yellow-fever');
      if (!yf) continue;
      yfCards++;
      const none = d.certificates.some(l => /^No yellow fever certificate/.test(l)), asked = d.certificates.some(l => /^A yellow fever certificate (is|can be) asked for/.test(l));
      if (/required for entry in some cases/.test(yf.note)) clash.push(`${d.slug}: the old sentence`);
      if (none && !/no certificate is asked for on entry/.test(yf.note)) clash.push(`${d.slug}: none asked for, and the vaccine's line does not say so`);
      if (asked && !/a certificate can be asked for at the border/.test(yf.note)) clash.push(`${d.slug}: one asked for, and the vaccine's line does not say so`);
      if (none && asked) clash.push(`${d.slug}: both`);
    }
    ok(yfCards >= 40 && !clash.length, `the yellow fever line on a card agrees with that country's certificate fact (${yfCards} cards; ${clash.slice(0, 3).join('; ') || 'none disagree'})`);
    const aka = index.filter(c => c.aka);
    ok(aka.length >= 20 && aka.every(c => Array.isArray(c.aka) && c.aka.length && c.aka.every(a => typeof a === 'string' && a && !index.some(o => o.name === a))) , `other names for a place are for the box only, and none is another place's own name (${aka.length})`);
  }

  // ---- the settings, the map point, who sees it -------------------------------
  {
    const w = await world('settings');
    const d = await w.ctl();
    ok(d.project.ewell.x === 451.1 && d.project.ewell.y === 105.9, `a latitude and longitude land where the map's own drawing put them (${JSON.stringify(d.project.ewell)})`);
    ok(d.project.home && d.project.home.x > 440 && d.project.home.x < 455 && d.project.home.y > 100 && d.project.home.y < 112, `the pharmacy's point is on the south coast of England (${JSON.stringify(d.project.home)})`);
    ok(d.settings.pharmacy === SITE.pharmacy && d.settings.enabled === false && d.settings.yf_centre === true, 'unsaved, the settings are the site\'s own file: its name, preview, a yellow fever centre');
    ok(d.vaccines['rabies'].price === 98.5 && d.vaccines['hepatitis-b'].child_price === 30 && d.vaccines['tuberculosis-bcg'].status === 'ask', 'the prices are the file\'s, a dose each');
    ok(d.ours.includes('dengue') && d.ours.includes('yellow fever') && !d.ours.includes('tuberculosis'), `"ours" is what the pharmacy gives (${d.ours.length} disease words)`);

    let p = await w.page();
    ok(await p.locator('[data-gtp]').count() === 0 && await p.locator('[data-hero-check]').getAttribute('href') === '#vaccines', 'in preview a visitor sees no planner, and the page\'s button goes where it went before');
    await p.close();
    await w.be('editor');
    p = await w.page();
    ok(await p.locator('[data-gtp]').count() === 1 && await p.locator('[data-gtp-preview]').isVisible() && await p.locator('[data-hero-check]').getAttribute('href') === '#trip-planner', 'an editor sees it, with a line saying nobody else can, and the button leads to it');
    await p.close();
    await w.be('visitor');
    await w.enable();
    p = await w.page();
    ok(await p.locator('[data-gtp]').count() === 1 && await p.locator('[data-gtp-preview]').count() === 0, 'switched on, everyone sees it and the preview line is gone');
    ok(await p.locator('link#gtp-planner-css').count() === 1 && await p.locator('script#gtp-planner-js').count() === 1, 'its own stylesheet and script, once each');

    /* A pharmacy that is not a yellow fever centre never prices it, whatever its table says. */
    await w.enable({ yf_centre: false });
    const no = await w.ctl();
    ok(no.vaccines['yellow-fever'].status === 'ask' && no.vaccines['yellow-fever'].price === null, 'not a registered centre: yellow fever is "Ask us", with no price');
    await p.close(); await w.ctx.close();
  }

  // ---- the planner in a browser: the box, the map, the card --------------------
  {
    const w = await world('browser');
    await w.ctl({ do: 'read' });
    await w.enable();
    const p = await w.page();
    await p.waitForSelector('[data-gtp][data-gtp-ready]');
    ok(await p.locator('[data-gtp-box]').isVisible(), 'the box is shown by the script');
    ok(await p.locator('[data-gtp-home]').count() === 1, 'the pharmacy is on the map');
    const quick = await p.locator('[data-gtp-pick]').evaluateAll(a => a.map(x => [x.textContent, new URL(x.href).pathname]));
    ok(JSON.stringify(quick) === JSON.stringify([['Cape Verde', '/cape-verde-travel-vaccinations/'], ['India', '/india-travel-vaccinations/'], ['Kenya', '/kenya-travel-vaccinations/'], ['Thailand', '/thailand-travel-vaccinations/']]), `the site's own four guides are offered, each a real link (${quick.map(x => x[0]).join(', ')})`);

    /* The keyboard: type, arrow, Enter; Escape closes. */
    const input = p.locator('[data-gtp-input]');
    await input.type('ken');
    ok(await p.locator('[data-gtp-list] [role="option"]').count() >= 1 && await input.getAttribute('aria-expanded') === 'true', 'typing opens the list');
    await input.press('Escape');
    ok(await p.locator('[data-gtp-list]').isHidden(), 'Escape closes it');
    await input.press('ArrowDown'); await input.press('Enter');
    await p.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    ok((await p.locator('.gtp__name').textContent()) === 'Kenya' && /[?&]going=kenya/.test(p.url()), 'arrow and Enter choose Kenya, and the address remembers it');
    await p.waitForSelector('[data-gtp-world][data-gtp-lit]');
    ok(await p.locator('[data-gtp-route] path').count() === 2 && !(await p.locator('[data-gtp-pin]').getAttribute('hidden') !== null), 'the route is drawn from the pharmacy to the country');
    await p.waitForSelector('[data-gtp-media][data-gtp-outline] path');
    ok(true, 'the country is drawn from its outline');

    /* The names a traveller types: TravelHealthPro files Bali under Indonesia, and calls two countries "DRC" and "USA". */
    const offered = async text => { await input.fill(''); await input.type(text); return p.locator('[data-gtp-list] [role="option"]').evaluateAll(o => o.map(x => ({ slug: x.getAttribute('data-slug'), aka: (x.querySelector('[data-gtp-aka]') || { textContent: '' }).textContent }))); };
    const bali = await offered('bali'), congo = await offered('congo'), states = await offered('united states'), dem = await offered('democratic rep');
    ok(bali.length === 1 && bali[0].slug === 'indonesia' && bali[0].aka === 'Bali', `"Bali" finds Indonesia, and says why (${JSON.stringify(bali[0] || null)})`);
    ok(congo.some(o => o.slug === 'congo' && !o.aka) && congo.some(o => o.slug === 'democratic-republic-of-the-congo' && /Congo/.test(o.aka)) && dem.some(o => o.slug === 'democratic-republic-of-the-congo'), '"Congo" offers both countries of that name, though one is filed as "DRC"');
    ok(states.some(o => o.slug === 'usa' && o.aka === 'United States of America'), '"United States" finds the country they file as "USA"');
    await input.fill(''); await input.press('Escape');

    /* Every card, on four countries that between them name every vaccine. */
    const seen = {};
    for (const [slug, text] of [['kenya', 'keny'], ['thailand', 'thai'], ['pakistan', 'pakis'], ['austria', 'austri']]) {
      await pick(p, text);
      const d = readJson(path.join(PACK, 'countries', `${slug}.json`));
      const want = [...d.vaccines.most, ...d.vaccines.some];
      const rows = await rowsOf(p);
      ok(rows.length === want.length && want.every((v, i) => rows[i].id === v.id && rows[i].note === v.note), `${slug}: every vaccine the guidance lists is a card, in its order, with our line (${rows.length})`);
      const wrong = rows.filter(r => r.price !== SAYS[r.id] || (CHILD[r.id] || '') !== r.child);
      ok(!wrong.length, `${slug}: each card says a dose's price as the pharmacy's list has it (${rows.map(r => r.price).join(' / ')}${wrong.length ? '; wrong: ' + wrong.map(r => r.id).join(', ') : ''})`);
      ok(rows.every(r => /^(Single dose|\d+ doses)$/.test(r.course)), `${slug}: the course line counts doses and prices nothing`);
      ok(rows.filter(r => r.badge === 'Most travellers').length === d.vaccines.most.length && rows.filter(r => r.badge === 'Some travellers').length === d.vaccines.some.length, `${slug}: badged most or some travellers`);
      /* No course's total: a dose's price times its doses is nowhere on the card. */
      const cat = (await w.ctl()).vaccines;
      const card = await p.locator('[data-gtp-card]').innerText();
      const shown = new Set(Object.values(cat).flatMap(v => [v.price, v.child_price]).filter(n => n !== null).map(n => '£' + (Number.isInteger(n) ? n : n.toFixed(2))));
      const totals = rows.map(r => cat[r.id]).filter(v => v.status === 'given' && v.price !== null && v.doses > 1).map(v => '£' + (Number.isInteger(v.price * v.doses) ? v.price * v.doses : (v.price * v.doses).toFixed(2))).filter(t => !shown.has(t));
      const found = totals.filter(t => new RegExp(`${t.replace('.', '\\.')}(?![\\d.])`).test(card));
      ok(totals.length > 0 && !found.length, `${slug}: no course's total anywhere on the card (${totals.join(', ')}; found ${found.join(', ') || 'none'})`);
      const figs = await p.locator('[data-gtp-figure]').evaluateAll(e => e.map(x => [x.getAttribute('data-gtp-figure'), x.getAttribute('data-value')]));
      ok(JSON.stringify(figs) === JSON.stringify([['count', String(d.vaccines.most.length)], ['count', String(d.vaccines.some.length)]]) && !/£/.test(await p.locator('[data-gtp-figures]').innerText()), `${slug}: two counts and no summed price`);
      rows.forEach(r => { seen[r.id] = r; });
    }
    ok(Object.keys(SAYS).every(id => seen[id]), `between them the four countries showed every vaccine (${Object.keys(seen).length} of ${Object.keys(SAYS).length})`);
    ok(seen['yellow-fever'].where === SITE.vaccines['yellow-fever'].note, `yellow fever says where it is given (${seen['yellow-fever'].where})`);

    /* Kenya: the facts, the notices, the way out. */
    await pick(p, 'keny');
    const kenya = readJson(path.join(PACK, 'countries', 'kenya.json'));
    const facts = await p.locator('[data-gtp-facts] li').evaluateAll(l => l.map(x => [x.getAttribute('data-gtp-fact'), x.innerText]));
    ok(facts[0][0] === 'certificate' && facts[0][1] === kenya.certificates[0] && facts.some(f => f[0] === 'malaria' && f[1] === kenya.malaria.line), 'the certificate and malaria facts are the pack\'s sentences');
    ok(facts.some(f => f[0] === 'yf-centre' && f[1] === SITE.yf_line), `the registered centre is named where the guidance lists the vaccine (${SITE.yf_line})`);
    const notices = (await w.ctl()).current.filter(n => n.slug === 'kenya');
    const nf = facts.find(f => f[0] === 'notices');
    ok(notices.length > 0 && nf && [...new Set(notices.map(n => n.disease))].every(dz => nf[1].includes(dz)) && !/words are NaTHNaC/.test(nf[1]), `Kenya's outbreak notices are named by disease and day, none of their words (${nf ? nf[1].slice(0, 90) : 'no notices fact'}…)`);
    ok(await p.locator('[data-gtp-fact="notices"] a').getAttribute('href') === 'https://travelhealthpro.org.uk/countries/kenya', 'and lead to TravelHealthPro\'s own page for the country');
    const acts = await p.locator('[data-gtp-actions] a').evaluateAll(a => a.map(x => [x.textContent, x.getAttribute('href')]));
    ok(acts[0][0] === 'Book a travel consultation' && acts[0][1] === '#book' && acts[1][0] === 'Read our Kenya guide' && /\/kenya-travel-vaccinations\/$/.test(acts[1][1]), `the booking leads, then the site's own guide (${acts.map(a => a[0]).join(' | ')})`);
    const note = await p.locator('[data-gtp-note]').textContent();
    ok(/each price is for one dose\./.test(note) && note.endsWith(SITE.consultation_line) && !/redeem|deduct|comes off/i.test(note), `the note says a price is a dose's, and the consultation's line as given, claiming nothing more (${note.slice(-60)})`);
    const src = await p.locator('[data-gtp-source]').innerText();
    ok(/NaTHNaC/.test(src) && /Open Government Licence v3\.0/.test(src) && await p.locator('[data-gtp-source] a').getAttribute('href') === kenya.source, 'the source is named, linked and licensed');
    ok(/checked against TravelHealthPro on \d+ [A-Z][a-z]+ \d{4}\./.test(await p.locator('.gtp__checked').textContent()), 'the card says the day its guidance was checked');
    const text = (await p.locator('[data-gtp-card]').innerText()).replace(/Flying straight from the UK, you won.t need one\./g, '');
    ok(!/you (don.t|do not|won.t) need|not needed for you|no need for/i.test(text), 'the card tells nobody they do not need a vaccine');
    const html = await p.content();
    ok(!BRANDS.some(br => new RegExp(`\\b${br}\\b`, 'i').test(html)), 'no brand name anywhere in the page, its data included');

    /* The date: a countdown, a start-by day, and a course that no longer fits. */
    const day = n => { const d = new Date(); d.setDate(d.getDate() + n); return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`; };
    await p.locator('[data-gtp-date]').fill(day(34)); await p.locator('[data-gtp-date]').dispatchEvent('change');
    ok((await p.locator('[data-gtp-countdown]').textContent()) === '34 days to go.', 'a date gives the countdown');
    ok(/^Start by \d+ [A-Z][a-z]{2}\.$/.test(await p.locator('[data-gtp-row="yellow-fever"] [data-gtp-start]').textContent()) && /^Start by /.test(await p.locator('[data-gtp-row="typhoid"] [data-gtp-start]').textContent()), 'and a day to start by on each course with a lead time');
    ok(await p.locator('[data-gtp-row="hepatitis-a"] [data-gtp-start]').isHidden(), 'a vaccine with no minimum notice shows none');
    await p.locator('[data-gtp-date]').fill(day(5)); await p.locator('[data-gtp-date]').dispatchEvent('change');
    const late = await p.locator('[data-gtp-row="typhoid"] [data-gtp-start]').textContent();
    ok(/^Needs 2 weeks before you travel, so ask us what.s still possible\.$/.test(late) && await p.locator('[data-gtp-row="typhoid"][data-gtp-late]').count() === 1, `a course that no longer fits says so and ends at us (${late})`);

    /* A country whose card cannot be had (not read into the pack, or its file not answering) ends at the booking too. */
    await p.route('**/data/countries/zimbabwe.json', r => r.fulfill({ status: 404, body: '' }));
    await pick(p, 'zimbab');
    ok(await p.locator('[data-gtp-card="consult"]').count() === 1 && await p.locator('[data-gtp-book]').getAttribute('href') === '#book' && await p.locator('[data-gtp-row]').count() === 0, 'a country whose card cannot be had is answered with the consultation');
    await p.unroute('**/data/countries/zimbabwe.json');
    /* A country with no guide and no phone set: the booking alone. */
    await pick(p, 'austri');
    ok(await p.locator('[data-gtp-actions] a').count() === 1 && await p.locator('[data-gtp-guide]').count() === 0 && await p.locator('[data-gtp-call]').count() === 0, 'no guide and no phone: the booking alone, never a dead link');
    ok(!p.errs.length, `no script errors (${p.errs.join(' | ') || 'none'})`);
    await p.close();

    /* A guide whose page is not published is not linked. */
    await w.ctl({ 'set[__published]': ['/india-travel-vaccinations/'] });
    const p2 = await w.page('/page.php?going=thailand');
    await p2.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    ok(await p2.locator('[data-gtp-pick]').count() === 1 && await p2.locator('[data-gtp-guide]').count() === 0 && await p2.locator('[data-gtp-book]').count() === 1, 'a guide that is a draft is neither offered nor linked; ?going= opens the card');
    await p2.close();

    /* A price changed on the settings screen is the card's price at once. */
    const s = (await w.ctl()).settings;
    s.vaccines['hepatitis-a'].price = 61.5; s.phone = '023 9248 1721';
    await w.ctl({ option: 'gtp_settings', value: s });
    const p3 = await w.page('/page.php?going=austria');
    await p3.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    await pick(p3, 'thai');
    ok((await p3.locator('[data-gtp-row="hepatitis-a"] [data-gtp-price]').textContent()) === '£61.50 a dose', 'a price changed in the settings is the price on the card, with no rebuild');
    ok(await p3.locator('[data-gtp-call]').getAttribute('href') === 'tel:02392481721', 'with a phone set and no guide to offer, the second button calls');
    await p3.close(); await w.ctx.close();
  }

  // ---- the reader: what it keeps, when it emails, when it cannot read ----------
  {
    const w = await world('reader');
    let d = await w.ctl({ do: 'cron' });
    ok(Array.isArray(d.cron) && d.cron[1] === 'daily', 'the reading is scheduled once a day');
    d = await w.ctl({ do: 'read' });
    ok(d.read === 'first read' && d.mail.length === 0 && /period=6&coun=All&dis=All$/.test(d.asked[0]), `the first reading takes the last six months and emails nobody (${d.read})`);
    const items = Object.values(d.state.items);
    const KEYS = JSON.stringify(['country', 'date', 'disease', 'regions', 'slug', 'url']);
    ok(items.length > 100 && items.every(n => JSON.stringify(Object.keys(n).filter(k => k !== 'group').sort()) === KEYS), `each notice kept is its date, disease, country, regions and address, and nothing else (${items.length})`);
    /* A notice NaTHNaC files under several countries opens from a button, "View Countries +": it is kept
       once for each country it names, never as a country called by the button's label. */
    const several = items.filter(n => n.group);
    const ebola = several.filter(n => n.date === '2026-11-06' && n.disease === 'Ebola disease').map(n => n.slug).sort();
    ok(!items.some(n => /view countries/i.test(n.country)) && items.every(n => n.slug !== '' || !n.group), 'no notice is kept under their button\'s label as a country');
    ok(several.length >= 10 && new Set(several.map(n => n.group)).size >= 4 && several.every(n => n.url === `https://travelhealthpro.org.uk/countries/${n.slug}` && n.regions.length === 0 && n.group.split('|')[2].split('+').includes(n.slug))
      && JSON.stringify(ebola) === JSON.stringify(['democratic-republic-of-the-congo', 'united-kingdom']), `a notice for several countries is kept once for each it names (${several.length} from ${new Set(several.map(n => n.group)).size} notices)`);
    ok(!/words are NaTHNaC|As of|a total of/.test(JSON.stringify(d.state)), 'none of a notice\'s words or figures is kept');
    ok(items.every(n => /^\d{4}-\d{2}-\d{2}$/.test(n.date) && n.disease && n.country && (n.url === '' || n.url === `https://travelhealthpro.org.uk/countries/${n.slug}`)) && !items.some(n => /Nowhere|Old thing/.test(n.country + n.disease)), 'every address is TravelHealthPro\'s own country page, and an earlier update under a notice is not read as one');
    ok(items.every(n => n.date >= '2026-07-14') && d.current.every(n => n.date >= '2026-08-13') && d.current.length < items.length, `kept for 120 days, current for 90 (${items.length} kept, ${d.current.length} current)`);

    d = await w.ctl({ do: 'read' });
    ok(d.read === 'read' && d.mail.length === 0 && /period=1&/.test(d.asked[1]), 'the next day\'s reading takes the last month, and nothing new is nothing said');
    d = await w.ctl({ 'set[__feed]': 'next', do: 'read' });
    ok(d.read === 'read, 2 new, alerted' && d.mail.length === 1, `two new notices: one email (${d.read})`);
    const m = d.mail[0] || { subject: '', body: '' };
    ok(/A new outbreak notice: Dengue in Thailand \(Chiang Mai\)/.test(m.subject) && /11 November 2026/.test(m.body) && !/Marburg/.test(m.body) && /travelhealthpro\.org\.uk\/countries\/thailand/.test(m.body), 'the email names the one the pharmacy vaccinates against, by day and country, and not the other');
    ok(m.to === 'owner@example.test' && /none of NaTHNaC.s figures or words/.test(m.body), 'to the site\'s owner, saying to read the notice before writing about it');
    ok(d.current[0].date === '2026-11-11' && d.current[1].date === '2026-11-11' && JSON.stringify(d.current.slice(0, 2).map(n => n.disease).sort()) === JSON.stringify(['Dengue', 'Marburg virus disease']), 'both are on the site, newest first');

    /* Their page stops reading as their search. */
    d = await w.ctl({ 'set[__feed]': 'changed', do: 'read' });
    ok(d.read === 'unreadable, alerted' && d.mail.length === 2 && /could not be read/.test(d.mail[1].subject) && /Nothing on the site is broken/.test(d.mail[1].body), 'their page changed: one email saying so');
    const before = d.current.length;
    d = await w.ctl({ do: 'read' });
    ok(d.read === 'unreadable' && d.mail.length === 2 && d.current.length === before && before > 50, 'the next failure is not emailed again, and the last good reading stands');
    const askedSoFar = d.asked.length;
    d = await w.ctl({ 'set[__feed]': 'down', do: 'read' });
    ok(d.read === 'unreadable' && d.asked.length === askedSoFar + 1, 'their server not answering is the same: one request, no second way in');
    /* 31 days without a good reading: the automatic notices are no longer shown; a person's are. */
    await w.be('admin');
    const pa = await w.page('/admin.php?page=gtp-notices');
    ok(/has not been readable since/.test(await pa.locator('[data-gtp-reader]').innerText()), 'the notices screen says since when');
    await pa.locator('[data-gtp-add] input[name="date"]').fill('2026-11-10');
    await pa.locator('[data-gtp-add] input[name="disease"]').fill('Dengue');
    await pa.locator('[data-gtp-add] select[name="slug"]').selectOption('sri-lanka');
    await pa.locator('[data-gtp-add] button[type="submit"]').click();
    await pa.waitForLoadState('networkidle');
    const byHand = await pa.locator('[data-gtp-kept] tbody tr', { hasText: 'added by hand' }).allInnerTexts();
    ok(/Notice added/.test(await pa.locator('[data-gtp-message]').innerText()) && byHand.length === 1 && /10 November 2026\s+Dengue\s+Sri Lanka/.test(byHand[0]) && /shown/.test(byHand[0]), `a person adds a notice by hand on the screen (${(byHand[0] || '').replace(/\s+/g, ' ').slice(0, 70)})`);
    d = await w.ctl({ 'set[__now]': '2026-12-13 12:00' });
    ok(d.current.length === 1 && d.current[0].manual === true && d.current[0].country === 'Sri Lanka', `after 30 days unread the reader's notices are not shown, and the one added by hand is (${d.current.length})`);
    d = await w.ctl({ 'set[__now]': NOW, 'set[__feed]': 'next', do: 'read' });
    ok(/^read/.test(d.read) && d.state.failing === '' && d.current.length > 50, 'a good reading clears the fault and the notices are back');

    /* Take one off, put it back; remove the one added by hand. */
    const key = d.current.find(n => !n.manual).key;
    await pa.goto(`${BASE}/admin.php?page=gtp-notices`);
    await pa.locator(`[data-gtp-row="${key}"] button`).click();
    await pa.waitForLoadState('networkidle');
    d = await w.ctl();
    ok(!d.current.some(n => n.key === key) && /taken off/.test(await pa.locator(`[data-gtp-row="${key}"]`).innerText()), 'a notice taken off is off the site and says so on the screen');
    await pa.locator(`[data-gtp-row="${key}"] button`).click();
    await pa.waitForLoadState('networkidle');
    d = await w.ctl();
    ok(d.current.some(n => n.key === key), 'and can be put back');
    const hand = d.current.find(n => n.manual).key;
    await pa.locator(`[data-gtp-row="${hand}"] button`).click();
    await pa.waitForLoadState('networkidle');
    d = await w.ctl();
    ok(!d.current.some(n => n.manual) && Object.keys(d.state.manual).length === 0, 'one added by hand is removed for good');

    /* What is not a notice is not added: a day still to come, a country not on the list, no disease. */
    for (const [date, disease, slug, why] of [['2027-06-01', 'Dengue', 'kenya', 'a day still to come'], ['2026-11-01', 'Dengue', 'atlantis', 'no such country'], ['2026-11-01', '', 'kenya', 'no disease']]) {
      const r = await w.ctx.request.post(`${BASE}/admin-post.php`, { form: { action: 'gtp_notices_add', _wpnonce: 'nonce-gtp_notices_add', date, disease, slug }, maxRedirects: 0 });
      ok(/gtp=not-added/.test(r.headers().location || ''), `not added: ${why}`);
    }
    /* Read now, from the screen; and paused, the daily reading asks nobody. */
    await pa.goto(`${BASE}/admin.php?page=gtp-notices`);
    const asked = (await w.ctl()).asked.length;
    await pa.locator('form:has(input[value="gtp_notices_read"]) button').click();
    await pa.waitForLoadState('networkidle');
    ok(/The reader says: read/.test(await pa.locator('[data-gtp-message]').innerText()) && (await w.ctl()).asked.length === asked + 1, 'Read now reads, and says what it did');
    const s = (await w.ctl()).settings;
    await w.ctl({ option: 'gtp_settings', value: Object.assign({}, s, { reader_paused: true }) });
    d = await w.ctl({ do: 'read' });
    ok(d.read === 'paused' && d.asked.length === asked + 1, 'paused, the daily reading asks nobody');
    /* Email about every notice, or none. */
    await w.ctl({ option: 'gtp_settings', value: Object.assign({}, s, { alerts: 'none' }) });
    await w.ctl({ option: 'gtp_notices', value: Object.assign({}, (await w.ctl()).state, { seen: [] }) });
    d = await w.ctl({ do: 'read' });
    ok(/new$/.test(d.read) && d.mail.length === 2, `set to email nothing, new notices are read and nobody is emailed (${d.read})`);
    await pa.close();

    /* Only someone who manages the site may do any of it. */
    await w.be('editor');
    const r = await w.ctx.request.post(`${BASE}/admin-post.php`, { form: { action: 'gtp_notices_read', _wpnonce: 'nonce-gtp_notices_read' }, maxRedirects: 0 });
    const r2 = await w.ctx.request.post(`${BASE}/admin-post.php`, { form: { action: 'gtp_save_settings', _wpnonce: 'nonce-gtp_save_settings', 'gtp[enabled]': '1' }, maxRedirects: 0 });
    ok(r.status() === 403 && r2.status() === 403, 'an editor cannot read now or save the settings');
    await w.be('admin');
    const r3 = await w.ctx.request.post(`${BASE}/admin-post.php`, { form: { action: 'gtp_notices_read', _wpnonce: 'wrong' }, maxRedirects: 0 });
    ok(r3.status() === 403, 'nor can a request without the screen\'s own nonce');
    await w.ctx.close();
  }

  // ---- the settings screen ------------------------------------------------------
  {
    const w = await world('admin', 'admin');
    const p = await w.page('/admin.php?page=gtp-settings');
    ok(await p.locator('[data-gtp-prices] tbody tr').count() === Object.keys(SAYS).length, `the price table has every vaccine the cards name (${Object.keys(SAYS).length})`);
    ok(/come from the site's own file/.test(await p.locator('[data-gtp-source-of-settings]').innerText()) && /read from TravelHealthPro on/.test(await p.locator('[data-gtp-pack]').innerText()), 'it says the settings are the site\'s file, and the day the guidance was read');
    await p.locator('input[name="gtp[vaccines][typhoid][price]"]').fill('£42.50');
    await p.locator('select[name="gtp[vaccines][cholera][status]"]').selectOption('not');
    await p.locator('input[name="gtp[enabled]"]').check();
    await p.locator('input[name="gtp[booking_url]"]').fill('javascript:alert(1)');
    await p.locator('button:has-text("Save settings")').click();
    await p.waitForLoadState('networkidle');
    let d = await w.ctl();
    ok(/Settings saved/.test(await p.locator('[data-gtp-message]').innerText()) && d.settings.enabled === true && d.vaccines.typhoid.price === 42.5 && d.vaccines.cholera.status === 'not' && d.vaccines.cholera.price === null, 'saving keeps the prices typed, as numbers, and a vaccine not given has no price');
    ok(d.settings.booking_url === '' && d.settings.guides.thailand === '/thailand-travel-vaccinations/' && d.settings.color_dark === '#1e3a8a', 'a booking link that is not a link is refused; everything untouched is kept');
    ok(/were saved here/.test(await p.locator('[data-gtp-source-of-settings]').innerText()), 'and the screen says the saved settings are now in force');
    await w.be('visitor');
    const front = await w.page('/page.php?going=kenya');
    await front.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    ok((await front.locator('[data-gtp-row="typhoid"] [data-gtp-price]').textContent()) === '£42.50' && (await front.locator('[data-gtp-row="cholera"] [data-gtp-price]').textContent()) === 'Not given here', 'the card follows: the new price, and "Not given here"');
    await front.close();
    await w.be('admin');
    /* Export, import on a site with no file of its own, and back to the file. */
    const exported = await p.locator('[data-gtp-export]').inputValue();
    await w.ctl({ 'set[__no_site_file]': true, option: 'gtp_settings', value: null });
    d = await w.ctl();
    ok(d.settings.pharmacy === 'Harness Pharmacy' && d.vaccines['hepatitis-a'].status === 'ask' && d.project.home === null, 'a site with no file and nothing saved promises nothing: every vaccine "Ask us", no point on the map');
    await p.goto(`${BASE}/admin.php?page=gtp-settings`);
    await p.locator('textarea[name="gtp_import"]').fill(exported);
    await p.locator('button:has-text("Import settings")').click();
    await p.waitForLoadState('networkidle');
    d = await w.ctl();
    ok(d.settings.pharmacy === SITE.pharmacy && d.vaccines.typhoid.price === 42.5 && d.vaccines.rabies.price === 98.5, 'settings copied from one site set up another in one paste');
    await w.ctl({ 'set[__no_site_file]': false });
    await p.goto(`${BASE}/admin.php?page=gtp-settings`);
    await p.locator('button:has-text("Use the site\'s file again")').click();
    await p.waitForLoadState('networkidle');
    d = await w.ctl();
    ok(d.vaccines.typhoid.price === 40 && d.settings.enabled === false, 'and "Use the site\'s file again" forgets what was saved');
    ok(!p.errs.length, 'no script errors on the screens');
    await p.close(); await w.ctx.close();
  }

  // ---- [travel_notices] ---------------------------------------------------------
  {
    const w = await world('list');
    await w.ctl({ do: 'read' });
    await w.enable();
    const p = await w.page('/page.php?notices=1');
    const rows = await p.locator('[data-gtp-notices] [data-gtp-notice]').evaluateAll(l => l.map(x => ({ date: x.querySelector('time').getAttribute('datetime'), text: x.querySelector('.gtp__notice-words').innerText, href: (x.querySelector('a') || { href: '' }).href })));
    ok(rows.length === 6 && rows.every((r, i) => i === 0 || rows[i - 1].date >= r.date) && rows.every(r => / in /.test(r.text) && (r.href === '' || /^https:\/\/travelhealthpro\.org\.uk\/countries\//.test(r.href))), `the list: six notices, newest first, each to TravelHealthPro's page (${rows[0] && rows[0].text})`);
    const src = await p.locator('.gtp__notices-source').innerText();
    ok(/NaTHNaC/.test(src) && /read on 11 November 2026/.test(src) && /Open Government Licence/.test(src), 'it says whose notices they are, when they were read and under what licence');
    /* A notice for several countries is one row naming each, linked to each one's page, and says no "in":
       which country the case was found in and which it came from is in NaTHNaC's words alone. */
    await p.goto(`${BASE}/page.php?notices=20`, { waitUntil: 'networkidle' });
    const many = await p.locator('[data-gtp-notices] [data-gtp-notice]').evaluateAll(l => l.map(x => ({ date: x.querySelector('time').getAttribute('datetime'), text: x.querySelector('.gtp__notice-words').innerText.replace(/\s+/g, ' ').trim(), hrefs: [...x.querySelectorAll('a')].map(a => a.href) })));
    const eb = many.filter(r => r.date === '2026-11-06' && /^Ebola disease/.test(r.text));
    ok(eb.length === 1 && eb[0].text === 'Ebola disease: DRC, United Kingdom' && JSON.stringify(eb[0].hrefs) === JSON.stringify(['https://travelhealthpro.org.uk/countries/democratic-republic-of-the-congo', 'https://travelhealthpro.org.uk/countries/united-kingdom'])
      && !many.some(r => /view countries/i.test(r.text)), `a notice for several countries is one row naming each (${eb[0] && eb[0].text})`);
    /* And it is on each of those countries' cards. */
    await p.goto(`${BASE}/page.php?going=nigeria`, { waitUntil: 'networkidle' });
    await p.waitForSelector('[data-gtp-card][data-gtp-in]');
    const ng = await p.locator('[data-gtp-fact="notices"]').innerText();
    ok(/Ebola disease \(21 October 2026\)/.test(ng) && await p.locator('[data-gtp-fact="notices"] a').getAttribute('href') === 'https://travelhealthpro.org.uk/countries/nigeria', `and it is on each of those countries' cards (Nigeria: ${ng.replace(/\s+/g, ' ').slice(0, 80)})`);
    await p.close(); await w.ctx.close();
  }

  // ---- a phone, and a site with no stylesheet of its own ------------------------
  for (const [name, w0, h0, url] of [['a phone', 390, 844, '/page.php?going=kenya'], ['a bare site', 1280, 800, '/page.php?bare=1&going=kenya'], ['a bare site on a phone', 390, 844, '/page.php?bare=1&going=kenya']]) {
    const w = await world('look', 'visitor', { w: w0, h: h0 });
    await w.ctl({ do: 'read' });
    await w.enable();
    const p = await w.page(url);
    await p.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    const m = await p.evaluate(() => {
      const q = s => document.querySelector(s); const bx = e => e.getBoundingClientRect();
      const small = [...document.querySelectorAll('.gtp *')].filter(e => e.getClientRects().length && [...e.childNodes].some(c => c.nodeType === 3 && c.textContent.trim())).filter(e => parseFloat(getComputedStyle(e).fontSize) < 13).map(e => e.className);
      const acts = [...document.querySelectorAll('[data-gtp-actions] a')].map(bx);
      const cards = [...document.querySelectorAll('[data-gtp-row]')].map(bx);
      return { over: document.documentElement.scrollWidth - innerWidth, small, heading: parseFloat(getComputedStyle(q('.gtp__heading')).fontSize), input: bx(q('[data-gtp-input]')).height,
        oneRow: acts.length < 2 || Math.abs(acts[0].top - acts[1].top) < 2, name: bx(q('.gtp__name')).height, gap: bx(q('.gtp__checked')).top - bx(q('.gtp__name')).bottom,
        deckScrolls: q('[data-gtp-rows]').scrollWidth > q('[data-gtp-rows]').clientWidth, cardW: cards[0].width, asideBelowBody: bx(q('[data-gtp-aside]')).top >= bx(q('.gtp__body')).bottom - 1,
        stageBg: getComputedStyle(q('.gtp__stage')).backgroundImage };
    });
    ok(m.over <= 0, `${name}: nothing scrolls sideways (${m.over}px over)`);
    ok(!m.small.length && m.heading >= 30 && m.input >= 56, `${name}: its own type and sizes hold whatever the site sets (heading ${m.heading}px, box ${Math.round(m.input)}px, nothing under 13px)`);
    ok(m.gap >= 8 && m.oneRow, `${name}: the card keeps its own gaps, and the way out is one row (${Math.round(m.gap)}px under the name)`);
    ok(/30, 58, 138/.test(m.stageBg), `${name}: the stage is the pharmacy's own colour`);
    if (w0 === 390) ok(m.deckScrolls && m.cardW >= 250 && m.asideBelowBody, `${name}: the vaccines are a deck you swipe, and the facts are the card's foot`);
    ok(!p.errs.length, `${name}: no script errors`);
    await p.close(); await w.ctx.close();
  }

  // ---- a desktop: the side column stays in view ----------------------------------
  {
    const w = await world('desk');
    await w.enable();
    const p = await w.page('/page.php?going=kenya');
    await p.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    const top = await p.evaluate(() => document.querySelector('[data-gtp-card]').getBoundingClientRect().top + scrollY);
    await p.evaluate(y => scrollTo(0, y + 600), top);
    await p.waitForTimeout(200);
    const m = await p.evaluate(() => { const s = document.querySelector('[data-gtp-side]').getBoundingClientRect(), b = document.querySelector('.gtp__body').getBoundingClientRect(); return { sideTop: s.top, sideH: s.height, bodyLeft: b.left, sideRight: s.right, bodyH: b.height }; });
    ok(Math.abs(m.sideTop) < 2 && m.sideRight <= m.bodyLeft + 1 && m.bodyH > m.sideH, `on a desktop the outline and the facts stay in view beside the vaccines (side at ${Math.round(m.sideTop)}px after 600px of scroll)`);
    await p.close(); await w.ctx.close();
  }


  // ---- a phone: the pinned bar, and a chat button at the foot of the window ------
  {
    const covered = async (p) => p.evaluate(() => {
      const bar = document.querySelector('[data-gtp-actions]'), out = [];
      for (const a of bar.querySelectorAll('a')) {
        const r = a.getBoundingClientRect();
        /* Points inside the pill, its rounded ends included: a corner of its box is not the button. */
        const cy = (r.top + r.bottom) / 2, cx = (r.left + r.right) / 2, e = r.height / 2;
        for (const [x, y] of [[r.left + e, cy], [r.right - e, cy], [r.right - 4, cy], [cx, r.top + 3], [cx, r.bottom - 3], [r.right - e, r.top + 3], [r.right - e, r.bottom - 3]]) {
          const hit = document.elementFromPoint(x, y);
          if (!hit || !a.contains(hit)) out.push(`${a.textContent.trim().slice(0, 12)} at ${Math.round(x)},${Math.round(y)}: ${hit ? (hit.id || hit.className || hit.tagName) : 'nothing'}`);
        }
      }
      return out;
    });
    const state = p => p.evaluate(() => {
      const bar = document.querySelector('[data-gtp-actions]').getBoundingClientRect(), l = document.getElementById('ai-chat-launcher');
      return { pinned: document.documentElement.hasAttribute('data-gtp-pinned'), h: document.documentElement.style.getPropertyValue('--gtp-pinned-height'),
        clear: Math.ceil(innerHeight - bar.top), barTop: bar.top, launcherBottom: l ? l.getBoundingClientRect().bottom : null, vh: innerHeight };
    });
    for (const kind of ['circle', 'pill']) {
      const w = await world('pin-' + kind, 'visitor', { w: 390, h: 844 });
      await w.ctl({ do: 'read' });
      await w.enable();
      const p = await w.page(`/page.php?going=kenya&launcher=${kind}`);
      await p.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
      /* The card's top at the window's: the bar's own place is a screen further down, so it is pinned. */
      await p.evaluate(() => document.querySelector('[data-gtp-card]').scrollIntoView({ block: 'start' }));
      await p.waitForTimeout(250);
      const s = await state(p), c = await covered(p);
      if (kind === 'circle') ok(s.pinned && parseInt(s.h, 10) === s.clear && s.clear >= 80, `on a phone the pinned bar tells the page so, and how far it reaches up the window (${s.h || 'nothing'}; the bar's top is ${s.clear}px up)`);
      ok(!c.length && s.launcherBottom <= s.barTop - 4, `a chat button ${kind === 'pill' ? 'with its label open' : 'at the foot of a phone'} covers neither button of the pinned bar (${c.slice(0, 2).join('; ') || 'nothing covered'}; button ends ${Math.round(s.barTop - s.launcherBottom)}px above the bar)`);
      if (kind === 'circle') {
        await p.evaluate(() => scrollTo(0, 0));
        await p.waitForTimeout(250);
        const top = await state(p);
        ok(!top.pinned && !top.h && Math.round(top.vh - top.launcherBottom) === 16, `with the bar back in its place the page is told nothing, and the chat button is back at the foot (${Math.round(top.vh - top.launcherBottom)}px up)`);
        await p.evaluate(() => document.querySelector('[data-gtp-card]').scrollIntoView({ block: 'start' }));
        await p.waitForTimeout(250);
        const m = await p.evaluate(() => [...document.querySelectorAll('[data-gtp-pin], [data-gtp-route]')].map(e => ({ d: getComputedStyle(e).display, w: e.getBoundingClientRect().width })));
        ok(m.length === 2 && m.every(x => x.d === 'none' && x.w === 0), `on a phone the map behind the box draws no pin and no route (${JSON.stringify(m)})`);
      }
      ok(!p.errs.length, `the pinned bar on a phone (${kind}): no script errors`);
      await p.close(); await w.ctx.close();
    }
    const w = await world('pin-desk');
    await w.ctl({ do: 'read' });
    await w.enable();
    const p = await w.page('/page.php?going=kenya&launcher=pill&dest=1');
    await p.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
    await p.evaluate(() => document.querySelector('[data-gtp-actions]').scrollIntoView({ block: 'end' }));
    await p.waitForTimeout(250);
    const s = await state(p);
    const pinVis = await p.evaluate(() => [...document.querySelectorAll('[data-gtp-pin], [data-gtp-route] path')].every(e => getComputedStyle(e).display !== 'none' && e.getBoundingClientRect().width > 0));
    ok(!s.pinned && !s.h && pinVis, `on a desktop the bar is in its place and says nothing, and the map still draws the pin and the route`);

    /* A card outside the planner (the theme's destinations) opens its country in place. */
    await p.evaluate(() => { window.__stay = 1; });
    await p.click('[data-h-dest]');
    await p.waitForFunction(() => { const n = document.querySelector('.gtp__name'); return n && n.textContent === 'Thailand'; });
    ok(await p.evaluate(() => window.__stay === 1) && /[?&]going=thailand/.test(p.url()), 'a card elsewhere on the page marked data-gtp-pick opens its country in the planner, in place');
    await p.close(); await w.ctx.close();
  }

  // ---- the travel page's template: the way to the planner ------------------------
  {
    const tpl = fs.readFileSync(path.join(ROOT, 'southdowns-pharmacy-theme', 'page-templates', 'page-travel-health.php'), 'utf8');
    const phoneHero = (tpl.split('<!-- Mobile: full-width image with overlay -->')[1] || '').split('<!-- Desktop:')[0];
    ok(/data-th-check/.test(phoneHero) && /'#trip-planner'/.test(phoneHero) && /Check What Vaccines You Need/.test(phoneHero), 'the phone\'s hero has "Check What Vaccines You Need", leading to the planner');
    const at = s => tpl.indexOf(s);
    const order = [at("echo $th_s2_html . $th_s3_html;"), at('echo $th_planner;'), at('S4: POPULAR DESTINATIONS'), at('echo $th_s3_html . $th_s2_html;'), at('S5: COMPREHENSIVE SERVICES')];
    ok(order.every(i => i > 0) && order.every((v, i) => !i || v > order[i - 1]) && at('S1: HERO') < at('ob_start()') && /if \( '' === \$th_planner \) \{\s*echo \$th_s2_html \. \$th_s3_html;[\s\S]*?\} else \{[\s\S]*?echo \$th_planner;/.test(tpl),
      'with the planner on the page it comes straight after the hero, the destinations under it, then why-us and the stats; without it the old order stands');
    const intro = (tpl.split('data-th-dest-intro')[1] || '').split('<?php else : ?>')[0];
    ok(intro && !/where/i.test(intro.replace(/<[^>]+>/g, ' ')) && /Popular destinations/.test(intro), 'under the planner the destinations do not ask "where?" again: they are its popular destinations');
    ok(/data-gtp-pick="<\?php echo esc_attr\( \$d_slug \); \?>"/.test(tpl), 'and each destination card opens its country in the planner');
  }

  // ---- the page cache: cleared when what is shown changes, and only then ----------
  {
    const w = await world('cache', 'admin');
    await w.ctl({ 'set[__kinsta]': [] });
    let d = await w.ctl();
    const n = () => d.purged.length;
    const s0 = d.settings;
    await w.ctl({ option: 'gtp_settings', value: Object.assign({}, s0, { enabled: true }) });
    d = await w.ctl();
    ok(n() === 1 && d.purged[0] === 'settings' && JSON.stringify(d.kinsta) === '[true]', `saving the settings clears the page cache, through Kinsta's own call, forced (${JSON.stringify(d.purged)}; Kinsta ${JSON.stringify(d.kinsta)})`);
    await w.ctl({ option: 'gtp_settings', value: Object.assign({}, s0, { enabled: true }) });
    d = await w.ctl();
    ok(n() === 1, `saving them again unchanged clears nothing (${n()} clearings)`);
    const s1 = Object.assign({}, d.settings); s1.vaccines = Object.assign({}, s1.vaccines, { 'hepatitis-a': Object.assign({}, s1.vaccines['hepatitis-a'], { price: 58 }) });
    await w.ctl({ option: 'gtp_settings', value: s1 });
    d = await w.ctl();
    ok(n() === 2 && d.purged[1] === 'settings', `a changed price clears it (${n()} clearings)`);

    await w.ctl({ do: 'read' });
    d = await w.ctl();
    const afterFirst = n();
    ok(afterFirst === 3 && d.purged[2] === 'notices' && d.current.length > 0, `a reading that puts notices on the page clears it (${d.current.length} on show)`);
    await w.ctl({ do: 'read', 'set[__now]': '2026-11-11 18:00' });
    d = await w.ctl();
    ok(n() === afterFirst, `a second reading that day, the same notices on show, clears nothing (${n()} clearings)`);
    await w.ctl({ do: 'read', 'set[__feed]': 'next' });
    d = await w.ctl();
    ok(n() === afterFirst + 1 && d.purged[n() - 1] === 'notices', `a reading with a new notice in it clears it (${n()} clearings)`);
    const key = d.current[0].key, before = n();
    const r = await w.ctx.request.post(`${BASE}/admin-post.php`, { form: { action: 'gtp_notices_toggle', _wpnonce: 'nonce-gtp_notices_toggle', key, hide: '1' }, maxRedirects: 0 });
    d = await w.ctl();
    ok(r.status() === 302 && n() === before + 1 && !d.current.some(x => x.key === key), `taking a notice off by hand clears it (${n() - before} clearing)`);
    await w.ctl({ option: 'gtp_settings', value: Object.assign({}, d.settings, { reader_paused: true }) });
    d = await w.ctl();
    const paused = n();
    await w.ctl({ do: 'daily', 'set[__now]': '2027-01-20 12:00' });
    d = await w.ctl();
    ok(d.current.length === 0 && n() === paused + 1 && d.purged[n() - 1] === 'notices', `with the reader paused, the daily run still sees the last reading go stale, and clears it (${d.current.length} on show, ${n() - paused} clearing)`);
    await w.ctl({ do: 'daily' });
    d = await w.ctl();
    ok(n() === paused + 1, 'and the next day, nothing having changed, clears nothing');
    await w.ctl({ do: 'init' });
    d = await w.ctl();
    const v = n();
    await w.ctl({ do: 'init' });
    d = await w.ctl();
    ok(d.purged[v - 1] === 'version' && n() === v, `a new version of the plugin clears it once, on its first run (${JSON.stringify(d.purged.slice(-2))})`);
    await w.ctx.close();

    const o = await world('cache-elsewhere', 'admin');
    let e = await o.ctl();
    await o.ctl({ option: 'gtp_settings', value: Object.assign({}, e.settings, { enabled: true }) });
    e = await o.ctl();
    const pg = await o.page();
    ok(e.purged.length === 1 && e.kinsta === null && !pg.errs.length && await pg.locator('[data-gtp-box]').isVisible(), `on a host that is not Kinsta the same action fires, and the planner works (${JSON.stringify(e.purged)})`);
    await pg.close(); await o.ctx.close();
  }

  await b.close();
  console.log(`planner: ${pass} pass, ${fail} fail`);
  process.exit(fail ? 1 : 0);
})().catch(e => { console.error(e); process.exit(1); });
