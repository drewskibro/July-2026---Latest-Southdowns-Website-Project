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
      /* A phone shows a screen at a time, with the way out pinned to its foot: the whole section in one
         picture draws that bar once, wherever the first screen ended, so take the screens as well. */
      if (w < 700 && slug === 'thailand') {
        await p.evaluate(() => document.querySelector('[data-gtp-result]').scrollIntoView({ block: 'start' }));
        await p.waitForTimeout(300);
        await p.screenshot({ path: `${OUT}/planner-${slug}-${name}-screen-1.png` });
        await p.evaluate(() => document.querySelector('[data-gtp-deck], .gtp__deck').scrollIntoView({ block: 'center' }));
        await p.waitForTimeout(300);
        await p.screenshot({ path: `${OUT}/planner-${slug}-${name}-screen-2.png` });
        await p.evaluate(() => window.scrollTo(0, 0));
      }
    }
    if (w >= 700) {
      /* The two screens in wp-admin, in the harness's plain page: the markup is the plugin's, the styling is not WordPress's. */
      await p.goto(`${BASE}/ctl.php?be=admin`);
      for (const page of ['gtp-settings', 'gtp-notices']) {
        await p.goto(`${BASE}/admin.php?page=${page}`, { waitUntil: 'networkidle' });
        await p.screenshot({ path: `${OUT}/admin-${page}.png`, fullPage: true });
      }
    }
    await ctx.close();
  }
  await b.close();
})().catch(e => { console.error(e); process.exit(1); });
