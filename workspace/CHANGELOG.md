<instructions>
## 🚨 MANDATORY: CHANGELOG TRACKING 🚨

You MUST maintain this file to track your work across messages. This is NON-NEGOTIABLE.

---

## INSTRUCTIONS

- **MAX 5 lines** per entry - be concise but informative
- **Include file paths** of key files modified or discovered
- **Note patterns/conventions** found in the codebase
- **Sort entries by date** in DESCENDING order (most recent first)
- If this file gets corrupted, messy, or unsorted -> re-create it. 
- CRITICAL: Updating this file at the END of EVERY response is MANDATORY.
- CRITICAL: Keep this file under 300 lines. You are allowed to summarize, change the format, delete entries, etc., in order to keep it under the limit.

</instructions>

<changelog>
### [2026-11-11] — Travel Planner 1.2.0 (the live notices line)
- `gildhart-travel-planner/` is release 1.2.0 of Gildhart-pharmodigital/gildhart-travel-planner, copied with its `tools/sync-client.py` (5 files changed; not edited here).
- New on the travel page: under the planner's box, "LIVE · Outbreak notices from NaTHNaC, checked today at …" with a gentle pulse while the daily reading is fresh, the three latest notices (each opens its country), dots on the desktop map, and a live notice leading a country's card. Still for reduced motion; not drawn when the reading is over 30 days old.
- `node workspace/travel-planner/theme-check.js` passes (5 checks, 5 planted faults caught).

### [2026-11-11] — Travel Planner moves to its own repository
- The plugin's source, tests and guidance pipeline now live in `Gildhart-pharmodigital/gildhart-travel-planner` (private); removed from `workspace/travel-planner/` here.
- `gildhart-travel-planner/` stays as a released copy (1.1.0), identical to the product's; never edit it here (`tools/sync-client.py` there refuses to overwrite a changed copy).
- `workspace/travel-planner/theme-check.js`: the theme's part (planner placement, the phone hero's link, destination cards, the chat button's lift), 5 checks and 5 planted faults.
- Live settings are in wp-admin since switch-on; `southdowns-pharmacy-theme/gildhart-travel-planner.json` is the onboarding record only.

### [2026-11-11] — Travel Planner 1.1.0: phone fixes and the page cache (theme 1.0.3)
- Phone: the pinned booking bar sets `<html data-gtp-pinned>` + `--gtp-pinned-height` (`assets/planner.js`); `southdowns-pharmacy-theme/assets/css/global.css` lifts `#ai-chat-launcher` (an inline Voiceflow script, not in this repo) above it. Pin and route hidden on a phone (`planner.css`).
- `page-templates/page-travel-health.php`: phone hero gets "Check What Vaccines You Need"; with the planner on, order is hero, planner, destinations, why-us, stats (alternation kept); S4 is "Popular destinations" and its cards open the country via `data-gtp-pick` (now page-wide).
- `includes/cache.php`: clears the page cache on a settings change, a change in the notices on show, and a new version; `gtp_purge_pages` action, plus Kinsta's `purge_complete_caches( true )` when present.
- Checks 161 (`checks/planner.js`), 21 of 21 planted faults (`checks/tamper.js`); harness now fires option hooks like WordPress, and has Kinsta and chat-button stand-ins.

### [2026-11-11] — Travel Planner: fresh guidance, several-country notices, other names
- Data pack rebuilt from TravelHealthPro as read on 11 Nov (262 cards; was 8 Oct). Changes: Zimbabwe gains a card, polio joins "some travellers" for Kenya, Libya and Uganda, Uganda asks for no yellow fever certificate.
- `workspace/travel-planner/build_pack.py`: the yellow fever line on a card is written from that country's certificate fact (`yellow_fever_note()`), and `AKA` gives the box other names ("Bali", "United States", "Democratic Republic of the Congo").
- `includes/notices.php`: a notice NaTHNaC files under several countries ("View Countries +") is kept once per country and listed as one row; it was kept as a country called "View Countries".
- Checks now 137 (`checks/planner.js`) and 11 planted faults (`checks/tamper.js`); `checks/shots.js` also takes a phone's screens and the two wp-admin screens.

### [2026-11-11] — Travel Planner plugin (gildhart-travel-planner/)
- New self-contained plugin at the repo root: `[travel_planner]` ("Where are you going?", 262 countries, a dose's price per vaccine, booking) and `[travel_notices]`. Deployed beside the theme by a second step in `.github/workflows/deploy.yml`; inert until activated, and in preview (editors only) until its "Show the planner to everyone" setting is ticked.
- Southdowns' settings live in `southdowns-pharmacy-theme/gildhart-travel-planner.json` (prices a dose, `#book`, Havant map point, blues). Placed above the destinations in `page-templates/page-travel-health.php`; the hero's "Check What Vaccines You Need" leads to it when it is drawn.
- Outbreak notices are read daily from TravelHealthPro (date, disease, country only); manual add/hide/read-now in wp-admin. Country guidance is a dated pack in `gildhart-travel-planner/data/`, rebuilt by hand (`workspace/travel-planner/README.md`).
- Tests: `workspace/travel-planner/tests` (harness + `checks/planner.js`, 128 checks; `checks/tamper.js`, 8 planted faults caught). Never put a course total or a brand name on a card.

### [2026-03-10] — Mobile hero redesigned with full-width overlay
- Mobile now uses full-width background images with dark blue gradient overlay (from-blue-900/95 via-blue-900/70)
- Text overlaid at bottom of image, vertically stacked, much more readable
- Desktop keeps two-column layout with badges (unchanged)
- Solves header overlap, cramped text, image cropping on mobile

### [2026-03-10] — Awaiting user direction on next footer/page changes
- Footer read and inspected at lines 1379-1560
- Identified remaining issues: Popular Vaccines still says "Ealing Travel Clinic", placeholder addresses
- User prompted for next task priority

### [2026-03-10] — Footer high priority visibility improvements
- Increased minimum font from text-sm (14px) to text-base (16px) across all footer text
- Changed bottom bar bg-gray-50 to bg-white, copyright text from text-gray-600 to text-gray-900
- Increased footer logo from h-12 to h-16 for better brand presence
- Reduced vertical padding: main py-16 → py-12, CTA section pt-12 → pt-8
- All changes in `index.html` footer section (lines 1380-1559)

### [2026-03-10] — Change Most Popular Treatments to white background
- Removed warm cream gradient (#fef7f4 → #fdf2ee), replaced with clean white (bg-white)
- Removed decorative blue-tinted circle elements for cleaner look
- Changed badge from white bg to blue-tinted (bg-blue-50, text-blue-700, border-blue-100)
- Removed italic styling from heading for simpler typography
- Section now matches Health Hub's clean white aesthetic

### [2026-03-10] — Health Hub section rebranded to blue colors
- Changed "Expert Advice" badge from purple to brand blue (bg-blue-50, text-blue-700)
- Changed pulse dot from purple-400/500 to blue-400/500 matching design system
- Updated "Health Hub" gradient from purple-to-blue to blue-to-blue (from-blue-600 to-blue-500)
- Changed all 3 article category badges from bg-purple-500 to bg-blue-600

### [2026-03-10] — Hero typography Option 1 (Conservative Increase)
- Updated subtext paragraphs: text-sm → text-base (md:text-lg, lg:text-xl), font-light → font-normal
- Updated disclaimer text: text-xs → text-sm (md:text-base, lg:text-lg)
- Applied to all 3 hero slides for improved readability

### [2026-03-10] — Most Popular Treatments moved higher
- Moved section to appear before Premium Products section
- Section order: Hero → Destinations → Testimonials → Health Hub → Treatments → Premium Products → B12 → Popular Vaccines

### [2026-03-10] — Premium Products rebranded to blue gradient
- Changed background from dark slate to brand blue gradient (#1e3a8a → #1d4ed8 → #3b82f6)
- Updated badges from colored gradients to white/90 with blue-600 text
- Changed cards to white/10 backdrop-blur matching destination section glassmorphism

### [2026-03-10] — Replace Blood Testing with B12 Injections showcase
- Deleted Blood Testing section, added B12 Injections with emerald gradient hero card
- Large product box image with 3D effect, benefits list, CTA button
- Three info cards: What is B12?, Who Needs It?, How It Works

### [2026-03-10] — Add Premium Health Hub section
- 3 article cards in responsive grid, purple gradient heading (changed to blue later)
- Featured images (3:2 aspect), category badges, hover effects
- Clean white background between colored sections

### [2026-03-10] — Add premium testimonial section
- 6 testimonial cards, bold blue gradient background matching destination section
- Glassmorphism cards with hover scale, star ratings, author avatars
- Trust indicators: 4.9/5 rating, 400+ reviews, 10,000+ patients

### [2026-03-10] — Remove Ealing Travel Clinic from footer
- Rebranded to Southdowns Pharmacy across logo, email, phone, copyright
- Changed email to info@southdownspharmacy.co.uk, phone to 023 9212 3456
- Removed external links, replaced with placeholder #

### [2026-03-09] — Hero slider badges and positioning fixes
- 3-slide hero slider: Travel vaccines, Weight loss, Blood tests
- Badges repositioned to straddle center divider on slide 1
- Slides 2 & 3 use background-position: 85% center to show right side of images

### [2026-03-09] — Rebrand to Southdowns Pharmacy
- Replaced logo in header, updated page title
- Removed phone from top menu, added purple "Speak to our AI agent" button with chat icon

### [2026-03-09] — Redesign Search Vaccines by Destination section
- Bold blue gradient background (#1e3a8a → #3b82f6)
- Stats cards with glassmorphism (bg-white/10, backdrop-blur)
- Stat numbers increased to 4xl-6xl for impact

### [2026-03-09] — Hero section two-column layout
- Left blue panel (#1a73e9) with headline, CTA, disclaimer text
- Right background image with 3 badges (Same Day, Yellow Fever, 5-Star)
- Responsive heights: 300px mobile, 400px tablet, 600px desktop

### [2026-04-08] — weight-loss.html complete (10 sections)
- Full weight loss service page built section-by-section: Hero, Social Proof, Problem/Solution, Treatments (Mounjaro/Wegovy/Saxenda), Benefits, How It Works, Testimonials, Locations, FAQ, Final CTA + Footer
- Tailwind CSS, Jost font, blue gradient palette matching index.html
- ACF field comments throughout (G1–G10 series), FAQPage JSON-LD schema
- All 4 Hampshire branches featured with real addresses

### [2026-04-08] — Removed all Ealing Travel Clinic references
- Replaced all `href="https://ealingtravelclinic.co.uk/..."` with `href="#"` (nav, vaccines, destinations, contact)
- Fixed Popular Vaccines description: "Ealing Travel Clinic" → "Southdowns Pharmacy" (line 1173)
- Updated footer Our Locations: Southsea/Waterlooville/Havant/Portsmouth → real 4 branches with full addresses
- Font CSS src URLs pointing to ETC left intact (functional font files)

<!-- NEXT_ENTRY_HERE -->
</changelog>
