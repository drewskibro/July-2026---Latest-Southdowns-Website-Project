/**
 * Travel Planner by Gildhart: the planner ([travel_planner], includes/planner.php).
 *
 * A combobox over every country TravelHealthPro has a page for. Choosing one
 * lands the trip card beneath the stage, drawn from that country's file in
 * the pack (data/countries/<slug>.json) and from what the server said this
 * pharmacy gives and charges: the country's outline from Natural Earth; the
 * route from the pharmacy on the map; "When do you fly?" and the countdown;
 * two counts; the vaccines as cards you swipe on a phone, each with a dose's
 * price here and, with a date, the day to start by; the certificate, malaria
 * and the outbreak notices; and the way out, which is always a booking.
 *
 * The rules: supply is a price, "Not given here" or "Ask us"; a price is a
 * dose's, never a course's total, and nothing here sums one; nothing says
 * what a person needs. The box is hidden in the markup and shown here, so
 * nobody is offered a control that does nothing. Motion is still for anyone
 * who asks for less.
 */
(function () {
  'use strict';

  var root = document.querySelector('[data-gtp]');
  if (!root) { return; }
  var box    = root.querySelector('[data-gtp-box]');
  var input  = root.querySelector('[data-gtp-input]');
  var list   = root.querySelector('[data-gtp-list]');
  var result = root.querySelector('[data-gtp-result]');
  var dataEl = root.querySelector('[data-gtp-config]');
  if (!box || !input || !list || !result || !dataEl) { return; }

  var cfg = {};
  try { cfg = JSON.parse(dataEl.textContent || '{}'); } catch (e) { cfg = {}; }
  var countries = cfg.countries || [];
  if (!countries.length) { return; }
  var vaccines = cfg.vaccines || {};
  var bySlug = {};
  countries.forEach(function (c) { bySlug[c.slug] = c; });

  var uid    = root.id || 'trip-planner';
  var base   = cfg.base || '';
  var book   = cfg.book || '';
  var phone  = cfg.phone || '';
  var still  = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var world  = root.querySelector('[data-gtp-world]');
  var pin    = root.querySelector('[data-gtp-pin]');
  var home   = root.querySelector('[data-gtp-home]');
  var routes = root.querySelector('[data-gtp-route]');
  var cache  = {};
  var mapData = null;
  var active = -1;
  var shown = [];
  var chosen = null;
  var depart = null;

  box.hidden = false;
  root.setAttribute('data-gtp-ready', '');

  /* A header fixed to the top of the window covers whatever scrolls under it:
     its height is handed to the stylesheet, so a jump to the planner lands
     below it and the card's side column sticks below it. */
  function offset() {
    var top = 0;
    Array.prototype.forEach.call(document.querySelectorAll('header, [data-gtp-header]'), function (h) {
      var cs = window.getComputedStyle(h);
      if (cs.position !== 'sticky' && cs.position !== 'fixed') { return; }
      var r = h.getBoundingClientRect();
      if (r.width >= window.innerWidth * 0.6 && r.top <= 4 && r.height < window.innerHeight * 0.4) { top = Math.max(top, Math.round(r.bottom)); }
    });
    root.style.setProperty('--gtp-offset', top + 'px');
  }
  offset();
  window.addEventListener('resize', offset);

  /* ---- helpers ---------------------------------------------------------- */

  function el(tag, attrs, children) {
    var ns = tag === 'svg' || tag === 'path' || tag === 'circle' || tag === 'g' ? 'http://www.w3.org/2000/svg' : null;
    var node = ns ? document.createElementNS(ns, tag) : document.createElement(tag);
    if (attrs) {
      Object.keys(attrs).forEach(function (k) {
        if (k === 'text') { node.textContent = attrs[k]; }
        else if (attrs[k] !== null && attrs[k] !== undefined && attrs[k] !== false) { node.setAttribute(k, attrs[k] === true ? '' : attrs[k]); }
      });
    }
    (children || []).forEach(function (c) { if (c) { node.appendChild(typeof c === 'string' ? document.createTextNode(c) : c); } });
    return node;
  }

  function has(n) { return n !== null && n !== undefined && n !== ''; }

  /* "£56", "£98.50": the pence only where there are any. */
  function money(n) {
    n = Number(n);
    return '£' + (Math.round(n) === n ? String(n) : n.toFixed(2));
  }

  function fold(s) {
    s = String(s || '').toLowerCase();
    if (typeof s.normalize === 'function') { s = s.normalize('NFD').replace(/[̀-ͯ]/g, ''); }
    return s.replace(/[^a-z0-9\s-]/g, ' ').replace(/\s+/g, ' ').trim();
  }

  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  function longDate(iso) {
    var m = /^(\d{4})-(\d{2})-(\d{2})$/.exec(String(iso || ''));
    if (!m) { return ''; }
    return parseInt(m[3], 10) + ' ' + MONTHS[parseInt(m[2], 10) - 1] + ' ' + m[1];
  }
  function shortDate(d) { return d.getDate() + ' ' + MONTHS[d.getMonth()].slice(0, 3); }
  function today() { var d = new Date(); d.setHours(0, 0, 0, 0); return d; }
  function isoOf(d) { return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0'); }
  function daysUntil(d) { return Math.round((d - today()) / 86400000); }

  function getJSON(url) {
    return fetch(url, { credentials: 'same-origin' }).then(function (r) { if (!r.ok) { throw new Error(String(r.status)); } return r.json(); });
  }

  /* ---- what a vaccine costs here ------------------------------------------
     A dose's price: "£56 a dose" for a course of more than one, a single dose
     at its price. A vaccine that comes inside another (polio, in the tetanus,
     diphtheria and polio booster) says so. Never a course's total. */
  function priceText(v) {
    if (v.status === 'not') { return 'Not given here'; }
    if (v.status !== 'given') { return 'Ask us'; }
    if (!has(v.price)) {
      var inside = v.included_in && vaccines[v.included_in];
      if (inside && inside.status === 'given') { return 'With the ' + inside.name.charAt(0).toLowerCase() + inside.name.slice(1) + ' booster'; }
      return 'Ask us';
    }
    return v.doses > 1 ? money(v.price) + ' a dose' : money(v.price);
  }
  function childText(v) {
    if (v.status !== 'given' || !has(v.price) || !has(v.child_price)) { return ''; }
    return money(v.child_price) + (v.doses > 1 ? ' a dose' : '') + ' for children';
  }
  function courseText(v) {
    return v.doses > 1 ? v.doses + ' doses' : 'Single dose';
  }

  /* ---- matching ---------------------------------------------------------- */

  /* TravelHealthPro files a place under one name ("DRC", "USA") and some places
     under their country (Bali is their Indonesia page). The pack carries the
     other names a traveller types, and a match on one says which it was. */
  var akaHit = {};
  function matches(q) {
    q = fold(q);
    akaHit = {};
    if (!q) { return []; }
    var starts = [], words = [], other = [], within = [];
    function begins(text) { text = fold(text); return text.indexOf(q) === 0 || text.split(/[\s-]/).some(function (w) { return w.indexOf(q) === 0; }); }
    countries.forEach(function (c) {
      var name = fold(c.name);
      if (name.indexOf(q) === 0) { starts.push(c); return; }
      if (name.split(/[\s-]/).some(function (w) { return w.indexOf(q) === 0; })) { words.push(c); return; }
      var aka = (c.aka || []).filter(begins)[0];
      if (aka) { akaHit[c.slug] = aka; other.push(c); return; }
      if (name.indexOf(q) >= 0) { within.push(c); }
    });
    return starts.concat(words, other, within).slice(0, 8);
  }

  /* ---- the listbox -------------------------------------------------------- */

  function close() {
    list.hidden = true;
    list.innerHTML = '';
    input.setAttribute('aria-expanded', 'false');
    input.removeAttribute('aria-activedescendant');
    active = -1;
    shown = [];
  }

  function setActive(i) {
    var opts = list.querySelectorAll('[role="option"]');
    if (!opts.length) { return; }
    if (i < 0) { i = opts.length - 1; }
    if (i >= opts.length) { i = 0; }
    Array.prototype.forEach.call(opts, function (o, k) { o.setAttribute('aria-selected', k === i ? 'true' : 'false'); });
    active = i;
    input.setAttribute('aria-activedescendant', opts[i].id);
    if (typeof opts[i].scrollIntoView === 'function') { opts[i].scrollIntoView({ block: 'nearest' }); }
  }

  function open(q) {
    shown = matches(q);
    list.innerHTML = '';
    if (!fold(q)) { close(); return; }
    if (!shown.length) {
      list.appendChild(el('li', { 'class': 'gtp__none', role: 'presentation', text: 'No country by that name. Try another spelling, or book a consultation and tell us where you’re going.' }));
    }
    shown.forEach(function (c, i) {
      var li = el('li', { 'class': 'gtp__option', role: 'option', id: uid + '-opt-' + i, 'aria-selected': 'false', 'data-slug': c.slug }, [
        el('span', { 'class': 'gtp__option-name' }, [c.name, akaHit[c.slug] ? el('span', { 'class': 'gtp__option-aka', 'data-gtp-aka': '', text: akaHit[c.slug] }) : null]),
        c.url ? el('span', { 'class': 'gtp__option-tag', text: 'Guide' }) : null
      ]);
      li.addEventListener('mousedown', function (e) { e.preventDefault(); });
      li.addEventListener('click', function () { choose(c); });
      list.appendChild(li);
    });
    list.hidden = false;
    input.setAttribute('aria-expanded', 'true');
    active = -1;
    input.removeAttribute('aria-activedescendant');
  }

  input.addEventListener('input', function () { chosen = null; open(input.value); });
  input.addEventListener('focus', function () { if (input.value && !chosen) { open(input.value); } });
  input.addEventListener('blur', function () { window.setTimeout(close, 120); });
  input.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowDown') { e.preventDefault(); if (list.hidden) { open(input.value); } setActive(active + 1); }
    else if (e.key === 'ArrowUp') { e.preventDefault(); if (list.hidden) { open(input.value); } setActive(active - 1); }
    else if (e.key === 'Enter') {
      if (!list.hidden && shown.length) { e.preventDefault(); choose(shown[active >= 0 ? active : 0]); }
      else if (list.hidden && input.value) { var m = matches(input.value); if (m.length) { e.preventDefault(); choose(m[0]); } }
    }
    else if (e.key === 'Escape') { if (!list.hidden) { e.preventDefault(); close(); } }
    else if (e.key === 'Tab') { close(); }
  });

  /* The guides' quick links choose in place; without the script they are links. */
  Array.prototype.forEach.call(root.querySelectorAll('[data-gtp-pick]'), function (a) {
    a.addEventListener('click', function (e) {
      var c = bySlug[a.getAttribute('data-gtp-pick')];
      if (!c) { return; }
      e.preventDefault();
      choose(c, { scroll: true });
    });
  });

  /* ---- the map: the pin and the route from the pharmacy -------------------- */

  function placeOnMap(c) {
    if (!world || !pin || !routes) { return; }
    var draw = function () {
      var p = mapData && mapData.countries && mapData.countries[c.slug];
      routes.innerHTML = '';
      if (!p) { pin.setAttribute('hidden', ''); world.removeAttribute('data-gtp-lit'); return; }
      pin.setAttribute('cx', p.x); pin.setAttribute('cy', p.y); pin.removeAttribute('hidden');
      /* No pharmacy on the map (no address set): the country is marked, and no route is drawn from nowhere. */
      if (home) {
        var hx = parseFloat(home.getAttribute('data-x')), hy = parseFloat(home.getAttribute('data-y'));
        /* A bow to the north, as a long route looks on a flat map. */
        var len = Math.hypot(p.x - hx, p.y - hy);
        var mx = (hx + p.x) / 2, my = (hy + p.y) / 2 - Math.min(90, len * 0.22);
        var d = 'M' + hx + ',' + hy + ' Q' + mx + ',' + my + ' ' + p.x + ',' + p.y;
        routes.appendChild(el('path', { 'class': 'gtp__route', d: d, pathLength: '1' }));
        routes.appendChild(el('path', { 'class': 'gtp__comet', d: d, pathLength: '1' }));
      }
      world.removeAttribute('data-gtp-lit');
      void world.getBoundingClientRect();
      world.setAttribute('data-gtp-lit', still ? 'still' : 'moving');
    };
    if (mapData) { draw(); return; }
    getJSON(base + 'map.json').then(function (m) { mapData = m; if (chosen === c) { draw(); } }).catch(function () { pin.setAttribute('hidden', ''); });
  }

  /* ---- choosing a country ------------------------------------------------ */

  function remember(c) {
    try {
      var u = new URL(window.location.href);
      u.searchParams.set('going', c.slug);
      window.history.replaceState(null, '', u.toString());
    } catch (e) { /* an old browser keeps its address */ }
  }

  function choose(c, opts) {
    opts = opts || {};
    chosen = c;
    depart = null;
    input.value = c.name;
    close();
    remember(c);
    result.hidden = false;
    result.innerHTML = '';
    result.setAttribute('data-gtp-state', 'loading');
    result.appendChild(el('p', { 'class': 'gtp__loading', text: 'Finding ' + c.name + '…' }));
    placeOnMap(c);
    var done = function (card) {
      if (chosen !== c) { return; }
      result.innerHTML = '';
      result.appendChild(card);
      requestAnimationFrame(function () { requestAnimationFrame(function () { card.setAttribute('data-gtp-in', ''); }); });
      if (opts.scroll && typeof result.scrollIntoView === 'function') { result.scrollIntoView({ behavior: still ? 'auto' : 'smooth', block: 'start' }); }
    };
    if (!c.planner) { result.setAttribute('data-gtp-state', 'consult'); done(consultCard(c)); return; }
    if (cache[c.slug]) { result.setAttribute('data-gtp-state', 'trip'); done(tripCard(c, cache[c.slug])); return; }
    getJSON(base + 'countries/' + encodeURIComponent(c.slug) + '.json')
      .then(function (d) { cache[c.slug] = d; if (chosen === c) { result.setAttribute('data-gtp-state', 'trip'); done(tripCard(c, d)); } })
      .catch(function () { if (chosen === c) { result.setAttribute('data-gtp-state', 'consult'); done(consultCard(c)); } });
  }

  /* ---- the card's pieces --------------------------------------------------- */

  /* The country, drawn from Natural Earth. One with no outline is its name alone. */
  function media(c) {
    var fig = el('div', { 'class': 'gtp__media', 'data-gtp-media': 'drawn' });
    var svg = el('svg', { 'class': 'gtp__outline', viewBox: '0 0 200 200', 'aria-hidden': 'true', focusable: 'false' });
    fig.appendChild(svg);
    getJSON(base + 'outlines/' + encodeURIComponent(c.slug) + '.json').then(function (o) {
      if (!o || !o.d) { fig.setAttribute('data-gtp-media', 'type'); return; }
      svg.appendChild(el('path', { d: o.d, pathLength: '1' }));
      fig.setAttribute('data-gtp-outline', '');
    }).catch(function () { fig.setAttribute('data-gtp-media', 'type'); });
    return fig;
  }

  function glyph(kind) {
    var svg = el('svg', { 'class': 'gtp__glyph', viewBox: '0 0 24 24', 'aria-hidden': 'true', focusable: 'false' });
    var d = kind === 'certificate' ? 'M5 3h11l3 3v15H5z M8 9h8 M8 13h8 M8 17h5'
      : kind === 'malaria' ? 'M12 4v16 M12 9c-3 0-6 1-8 3 M12 9c3 0 6 1 8 3 M12 13c-2 0-4 2-5 5 M12 13c2 0 4 2 5 5 M9 5l3 2 3-2'
      : kind === 'centre' ? 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z M9 12l2 2 4-4'
      : 'M12 3a5 5 0 0 0-5 5v3l-2 4h14l-2-4V8a5 5 0 0 0-5-5z M10 19a2 2 0 0 0 4 0';
    svg.appendChild(el('path', { d: d, fill: 'none', stroke: 'currentColor', 'stroke-width': '1.8', 'stroke-linejoin': 'round', 'stroke-linecap': 'round' }));
    return svg;
  }

  function countUp(node, n) {
    if (still || n < 2) { node.textContent = String(n); return; }
    var start = null, dur = 650;
    function step(ts) {
      if (start === null) { start = ts; }
      var k = Math.min(1, (ts - start) / dur);
      var eased = 1 - Math.pow(1 - k, 3);
      node.textContent = String(Math.round(n * eased));
      if (k < 1) { requestAnimationFrame(step); } else { node.textContent = String(n); }
    }
    node.textContent = '0';
    requestAnimationFrame(step);
  }

  /* The way out: the booking leads, then this site's own page about the country, or the phone. */
  function actions(c) {
    var kids = [];
    var call = phone ? el('a', { 'class': 'gtp__button gtp__button--secondary', href: 'tel:' + phone.replace(/\s+/g, ''), 'data-gtp-call': '', text: 'Call ' + phone }) : null;
    if (book) { kids.push(el('a', { 'class': 'gtp__button gtp__button--primary', href: book, 'data-gtp-book': '', text: 'Book a travel consultation' })); }
    if (c.url) { kids.push(el('a', { 'class': 'gtp__button gtp__button--secondary', href: c.url, 'data-gtp-guide': '', text: 'Read our ' + c.name + ' guide' })); }
    else if (call) { kids.push(call); }
    if (!kids.length) { return null; }
    return el('div', { 'class': 'gtp__actions', 'data-gtp-actions': '' }, kids);
  }

  function consultCard(c) {
    var card = el('article', { 'class': 'gtp__card gtp__card--consult', 'data-gtp-card': 'consult' });
    card.appendChild(el('div', { 'class': 'gtp__side' }, [media(c)]));
    card.appendChild(el('div', { 'class': 'gtp__body' }, [
      el('p', { 'class': 'gtp__kicker', text: 'Your trip' }),
      el('h3', { 'class': 'gtp__name', text: c.name }),
      el('p', { 'class': 'gtp__lead-in', text: 'We haven’t read ' + c.name + '’s guidance into the planner yet. Book a travel consultation and the pharmacist goes through what your trip needs, from the same guidance.' }),
      actions(c),
      el('p', { 'class': 'gtp__note', text: 'Bring your dates, your route and any vaccination records you have.' })
    ]));
    return card;
  }

  function tripCard(c, d) {
    /* The pack's rows, each with what this pharmacy said of that vaccine. */
    var rows = function (tier) {
      return ((d.vaccines && d.vaccines[tier]) || []).filter(function (r) { return r && vaccines[r.id]; }).map(function (r) {
        var v = vaccines[r.id];
        return { id: r.id, tier: tier, pack_note: r.note || '', name: v.name, doses: Math.max(1, parseInt(v.doses, 10) || 1), lead: v.lead, included_in: v.included_in, status: v.status, price: v.price, child_price: v.child_price, note: v.note };
      });
    };
    var most = rows('most');
    var some = rows('some');
    var all  = most.concat(some);
    var byId = {};
    all.forEach(function (v) { byId[v.id] = v; });

    var card = el('article', { 'class': 'gtp__card gtp__card--trip', 'data-gtp-card': 'trip' });
    /* The picture and the facts are one column on a desktop, which stays in
       view beside the vaccines; on a phone the facts are the card's foot. */
    var side = el('div', { 'class': 'gtp__side', 'data-gtp-side': '' }, [media(c)]);
    card.appendChild(side);
    var body = el('div', { 'class': 'gtp__body' });
    card.appendChild(body);

    body.appendChild(el('p', { 'class': 'gtp__kicker', text: 'Your trip' }));
    body.appendChild(el('h3', { 'class': 'gtp__name', text: c.name }));
    body.appendChild(el('p', { 'class': 'gtp__checked', text: 'What the guidance recommends and what each vaccine costs here' + (d.checked ? ', checked against TravelHealthPro on ' + longDate(d.checked) : '') + '.' }));

    /* When do you fly? */
    var when = el('div', { 'class': 'gtp__when', 'data-gtp-when': '' });
    var dateId = uid + '-date';
    var dateIn = el('input', { 'class': 'gtp__date', type: 'date', id: dateId, min: isoOf(today()), 'data-gtp-date': '' });
    var countdown = el('p', { 'class': 'gtp__countdown', 'data-gtp-countdown': '', 'aria-live': 'polite', hidden: true });
    when.appendChild(el('label', { 'class': 'gtp__when-label', 'for': dateId, text: 'When do you fly?' }));
    when.appendChild(el('div', { 'class': 'gtp__when-row' }, [dateIn, el('span', { 'class': 'gtp__when-hint', text: 'Optional. It sets the day to start each course by.' })]));
    when.appendChild(countdown);
    body.appendChild(when);

    /* Two counts, never a summed price. */
    var figures = el('div', { 'class': 'gtp__figures', 'data-gtp-figures': '' });
    [[most.length, 'most travellers'], [some.length, 'some trips']].forEach(function (t) {
      var strong = el('strong', { 'data-gtp-figure': 'count', 'data-value': String(t[0]) });
      countUp(strong, t[0]);
      figures.appendChild(el('div', { 'class': 'gtp__figure' }, [strong, el('span', { 'class': 'gtp__figure-label', text: t[1] })]));
    });
    body.appendChild(figures);

    /* The vaccines, as cards. */
    var deck = el('ul', { 'class': 'gtp__deck', 'data-gtp-rows': '' });
    all.forEach(function (v) {
      var child = childText(v);
      deck.appendChild(el('li', { 'class': 'gtp__vax', 'data-gtp-row': v.id, 'data-fit': v.tier, 'data-status': v.status }, [
        el('p', { 'class': 'gtp__vax-badge', 'data-gtp-badge': '', text: v.tier === 'most' ? 'Most travellers' : 'Some travellers' }),
        el('h4', { 'class': 'gtp__vax-name', text: v.name }),
        el('p', { 'class': 'gtp__vax-note', text: v.pack_note }),
        el('p', { 'class': 'gtp__vax-course', text: courseText(v) }),
        el('p', { 'class': 'gtp__vax-price', 'data-gtp-price': '', text: priceText(v) }),
        child ? el('p', { 'class': 'gtp__vax-child', 'data-gtp-child': '', text: child }) : null,
        v.note ? el('p', { 'class': 'gtp__vax-where', 'data-gtp-where': '', text: v.note }) : null,
        el('p', { 'class': 'gtp__vax-start', 'data-gtp-start': '', hidden: true })
      ]));
    });
    body.appendChild(el('div', { 'class': 'gtp__deck-wrap' }, [deck, el('p', { 'class': 'gtp__swipe', 'aria-hidden': 'true', text: 'Swipe for more' })]));
    if (d.also_listed && d.also_listed.length) {
      body.appendChild(el('p', { 'class': 'gtp__also', text: 'TravelHealthPro also lists ' + d.also_listed.join(', ') + ' for some travellers; ask us at your consultation.' }));
    }

    function applyDate() {
      Array.prototype.forEach.call(deck.querySelectorAll('[data-gtp-row]'), function (li) {
        var v = byId[li.getAttribute('data-gtp-row')];
        var startEl = li.querySelector('[data-gtp-start]');
        if (!depart || !v || !v.lead || !v.lead.days || v.status === 'not') { startEl.hidden = true; startEl.textContent = ''; li.removeAttribute('data-gtp-late'); return; }
        var by = new Date(depart.getTime() - v.lead.days * 86400000);
        var left = daysUntil(depart);
        if (left < v.lead.days) { startEl.textContent = 'Needs ' + v.lead.text.replace(/^at least /i, '') + ' you travel, so ask us what’s still possible.'; li.setAttribute('data-gtp-late', ''); }
        else { startEl.textContent = 'Start by ' + shortDate(by) + '.'; li.removeAttribute('data-gtp-late'); }
        startEl.hidden = false;
      });
      if (!depart) { countdown.textContent = ''; countdown.hidden = true; return; }
      var n = daysUntil(depart);
      countdown.hidden = false;
      countdown.textContent = n <= 0 ? 'You fly today. Call us and we’ll see what can still be done.'
        : n === 1 ? 'You fly tomorrow. Call us and we’ll see what can still be done.'
        : n + ' days to go' + (n <= 14 ? ': book this week, some courses take longer than that.' : '.');
    }

    dateIn.addEventListener('change', function () {
      var m = /^(\d{4})-(\d{2})-(\d{2})$/.exec(dateIn.value || '');
      depart = m ? new Date(parseInt(m[1], 10), parseInt(m[2], 10) - 1, parseInt(m[3], 10)) : null;
      applyDate();
    });

    /* The facts the guidance settles at a glance. */
    var facts = el('ul', { 'class': 'gtp__facts', 'data-gtp-facts': '' });
    (d.certificates || []).forEach(function (line, i) {
      if (!line) { return; }
      facts.appendChild(el('li', { 'data-gtp-fact': i === 0 ? 'certificate' : 'certificate-more' }, [glyph('certificate'), el('span', { text: line })]));
    });
    /* What this pharmacy is, said only where the guidance lists the vaccine for this country. */
    if (cfg.yf && byId['yellow-fever']) {
      facts.appendChild(el('li', { 'data-gtp-fact': 'yf-centre' }, [glyph('centre'), el('span', { text: cfg.yf })]));
    }
    if (d.malaria && d.malaria.line) { facts.appendChild(el('li', { 'data-gtp-fact': 'malaria' }, [glyph('malaria'), el('span', { text: d.malaria.line })])); }
    /* The outbreak notices for this country: the disease and the day, never the notice's words. */
    var mine = (cfg.notices || []).filter(function (n) { return n.slug === c.slug; });
    if (mine.length) {
      var seen = {};
      var named = mine.filter(function (n) { var k = n.disease.toLowerCase(); if (seen[k]) { return false; } seen[k] = true; return true; })
        .map(function (n) { return n.disease + ' (' + n.day + ')'; });
      var span = el('span', { text: 'Outbreak notices from NaTHNaC: ' + named.join(', ') + '. We go through them at your consultation. ' });
      if (d.source) { span.appendChild(el('a', { href: d.source, target: '_blank', rel: 'noopener noreferrer', text: 'Read them on TravelHealthPro' })); }
      facts.appendChild(el('li', { 'data-gtp-fact': 'notices' }, [glyph('notices'), span]));
    }

    var act = actions(c);
    if (act) { body.appendChild(act); }
    body.appendChild(el('p', { 'class': 'gtp__note', 'data-gtp-note': '', text: 'A starting point, not a quote. Which vaccines apply to you is settled at your consultation, and each price is for one dose.' + (cfg.consultation ? ' ' + cfg.consultation : '') }));
    /* Whose guidance this is, and where to read it. */
    var src = el('p', { 'class': 'gtp__source', 'data-gtp-source': '' }, ['Guidance from NaTHNaC’s TravelHealthPro, written in our own words. ']);
    if (d.source) { src.appendChild(el('a', { href: d.source, target: '_blank', rel: 'noopener noreferrer', text: 'Read their page for ' + c.name })); src.appendChild(document.createTextNode('. ')); }
    if (cfg.licence) { src.appendChild(document.createTextNode(cfg.licence)); }
    body.appendChild(src);

    /* The facts are the card's aside: under the picture on a desktop, the card's foot on a phone. */
    if (facts.childNodes.length) {
      side.appendChild(el('div', { 'class': 'gtp__aside', 'data-gtp-aside': '' }, [
        el('p', { 'class': 'gtp__aside-kicker', text: 'Before you go' }),
        facts
      ]));
    }
    return card;
  }

  /* ?going=<slug> opens the planner on that country, so a link from anywhere
     on the site lands a reader on their answer. */
  var going = /[?&]going=([a-z0-9-]+)/.exec(window.location.search || '');
  if (going && bySlug[going[1]]) { choose(bySlug[going[1]], { scroll: true }); }
})();
