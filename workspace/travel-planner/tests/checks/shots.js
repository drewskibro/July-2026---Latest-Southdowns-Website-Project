/* Screenshots of the planner in the harness, for a person to look at: node checks/shots.js <out dir> */
const { chromium } = require('playwright');
const fs = require('fs');
const BASE = `http://127.0.0.1:${process.env.GTP_PORT || 8911}`;
const OUT = process.argv[2] || 'shots';
fs.mkdirSync(OUT, { recursive: true });
(async () => {
  const b = await chromium.launch({ args: ['--no-proxy-server'] });
  for (const [w, h, name] of [[1440, 900, '1440'], [390, 844, '390']]) {
    const ctx = await b.newContext({ viewport: { width: w, height: h }, deviceScaleFactor: 2, reducedMotion: 'reduce' });
    const p = await ctx.newPage();
    await p.goto(`${BASE}/ctl.php?world=shots&be=editor&fresh=1&set%5B__now%5D=2026-11-11%2012:00&do=read`);
    await p.goto(`${BASE}/ctl.php?option=gtp_settings&value=${encodeURIComponent(JSON.stringify(Object.assign({}, (await (await p.goto(`${BASE}/ctl.php`)).json()).settings, { enabled: true })))}`);
    await p.goto(`${BASE}/page.php`, { waitUntil: 'networkidle' });
    await p.waitForSelector('[data-gtp][data-gtp-ready]');
    await (await p.$('.gtp__stage')).screenshot({ path: `${OUT}/planner-rest-${name}.png` });
    for (const [slug, q] of [['thailand', 'thai'], ['kenya', 'keny']]) {
      await p.locator('[data-gtp-input]').fill('');
      await p.locator('[data-gtp-input]').type(q);
      await p.locator('[data-gtp-input]').press('Enter');
      await p.waitForSelector('[data-gtp-card="trip"][data-gtp-in]');
      await p.waitForTimeout(700);
      await (await p.$('[data-gtp]')).screenshot({ path: `${OUT}/planner-${slug}-${name}.png` });
    }
    await ctx.close();
  }
  await b.close();
})().catch(e => { console.error(e); process.exit(1); });
