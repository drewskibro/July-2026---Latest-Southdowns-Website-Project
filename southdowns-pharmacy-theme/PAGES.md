# Southdowns Pharmacy — Pages & ACF Wiring Tracker

Master list of every page in the theme, how far **Claude** has connected it to ACF
(so the client can edit text / images / prices), and where **Oliver** has QC'd it on
the live site. We work **page-by-page** down this list.

_Last updated: 2026-06-22_

## Traffic lights

**Claude Progress** — what I've done:
- 🔴 Not started (content still hardcoded / not editable)
- 🟠 In progress (being wired now)
- 🟢 Done — wired & ready for your QC

**Oliver QC** — your manual check on the live site:
- 🔴 Not checked yet
- 🟠 Changes needed (leave a note in the last column)
- 🟢 Approved

---

## 📋 Tracker

| # | Page | Claude Progress | Oliver QC | Template | Notes |
|---|------|:---------------:|:---------:|----------|-------|
| 1 | **Blood Pressure Checks** | 🟢 | 🟢 | `page-blood-pressure.php` | ✅ Fully wired — ready for QC. ~45 editable fields across 10 tabs (hero, stats, sections, all card grids, lists, CTAs, FAQ, disclaimer). Slug `/blood-pressure-checks/` |
| 2 | **Home Page** | 🟢 | 🟢 | `front-page.php` | ✅ Wired & pre-filled — hero slides (heading/sub-text/image), all 8 section headings/intros, and repeaters for treatments, destinations+stats, testimonials+trust, articles, vaccines, products. Hero badges/feature-ticks/button labels left in design. |
| 3 | **About Us** | 🟢 | 🟢 | `page-about-us.php` | ✅ Wired & pre-filled — hero, Who We Are (rich text), team photos+captions+copy, locations, closing CTA. |
| 4 | **Pharmacy First** | 🟢 | 🟢 | `page-pharmacy-first.php` | ✅ Wired & pre-filled — hero, stats, 7 conditions, 3 steps, eligibility + checklist, locations, FAQ, final CTA, disclaimer. |
| 5 | **NHS Prescriptions** | 🟢 | 🟢 | `page-nhs-prescriptions.php` | ✅ Wired & pre-filled — hero, stats, how-it-works steps, features, nominate, repeat dispensing, NHS/private lists, locations, why-choose, FAQ, closing CTA. |
| 6 | **Flu Vaccinations** | 🟢 | 🟢 | `page-flu-vaccinations.php` | ✅ Wired & pre-filled — hero, stats, intro, NHS eligibility cards, conditions accordion, £20 private panel, steps, locations, final CTA, disclaimer. |
| 7 | **B12 Injections** | 🟢 | 🟢 | `page-b12-injections.php` | ✅ Wired & pre-filled — hero, stats, intro, benefit cards, symptoms accordion, how-it-works panel, steps, locations, final CTA, disclaimer. |
| 8 | **Contraception Services** | 🟢 | 🟢 | `page-contraception.php` | ✅ Wired & pre-filled — hero, stats, intro, service cards, emergency panel, steps, FAQs, locations, booking form intro, final CTA, disclaimer. |
| 9 | **Book Appointment** | 🟢 | 🟢 | `page-book-appointment.php` | ✅ Wired & pre-filled — hero + Our Locations heading/intro. _Left in code:_ Amelia booking widget, optional editor body, per-branch "how to get there" directions (12 fields, rarely changed), branch cards (global). |
| 10 | **FAQ** | 🟢 | 🟢 | `page-faq.php` | ✅ Wired & pre-filled — hero, FAQ repeater (one list feeds both the accordion **and** the SEO FAQ schema), branches heading/intro, CTA. Branch cards pull from global Branch Locations. |
| 11 | **Health Hub** | 🟢 | 🟢 | `page-health-hub.php` | ✅ Wired & pre-filled — hero (eyebrow/heading+accent/intro), 3 topic cards (badge/title/desc/image), section headings, featured eyebrow. _Left dynamic:_ blog post loops (real WP posts) + category filter tabs. |
| 12 | **Yellow Fever** | 🟢 | 🟢 | `page-yellow-fever.php` | ✅ Fully wired — ~87 fields across 12 tabs (hero, key facts, what-is, why-need, risk areas, what-to-expect, side effects, pricing + includes, why-choose, FAQ, locations, final CTA + booking). _Left in code:_ SVG icons, decorative roundel badges, Amelia widget, and the SEO FAQ JSON-LD block at the top (mirror big FAQ edits there if needed). |
| 13 | **Cape Verde Travel Vaccines** | 🟢 | 🟢 | `page-cape-verde-travel-vaccines.php` | ✅ Wired & pre-filled — all 4 destination pages share one field group (Travel Vaccines), each page editable separately. Hero, intro, vaccines (flat repeater grouped by category), risks, malaria, steps, timing, pricing (packages + individual), locations, why, FAQ, CTA, disclaimer. ⚠️ Interim placeholder copy & £TBC prices — for clinical review. |
| 14 | **India Travel Vaccines** | 🟢 | 🟢 | `page-india-travel-vaccines.php` | ✅ Wired (shared Travel Vaccines field group). India content pre-filled (9 vaccines incl. malaria). ⚠️ Placeholder copy & £TBC prices. |
| 15 | **Kenya Travel Vaccines** | 🟢 | 🟢 | `page-kenya-travel-vaccines.php` | ✅ Wired (shared field group). Kenya content pre-filled (YF required for entry; malaria). ⚠️ Placeholder copy & £TBC prices. |
| 16 | **Thailand Travel Vaccines** | 🟢 | 🟢 | `page-thailand-travel-vaccines.php` | ✅ Wired (shared field group). Thailand content pre-filled — note this page already had **real prices** (£96/£442 etc.), preserved as defaults. |
| 17 | **Privacy Policy** | 🟢 | 🟢 | `page-privacy-policy.php` | ✅ Wired (shared Legal field group). Hero (eyebrow/heading/intro/last-updated) editable & pre-filled. Body legal copy stays in code (GDPR-reviewed, dynamic email) with an **optional WYSIWYG override** to replace it. |
| 18 | **Cookie Policy** | 🟢 | 🟢 | `page-cookie-policy.php` | ✅ Wired (shared Legal field group). Same pattern — hero editable, body override available. |
| 19 | **Terms & Conditions** | 🟢 | 🟢 | `page-terms-conditions.php` | ✅ Wired (shared Legal field group). Same pattern — hero editable, body override available. |
| 20 | Ear Wax Removal | 🟢 | 🟢 | `page-ear-wax.php` | **Audited + polished 23 Jun ✅ 100%** — already exhaustively wired (hero, stats, symptoms, about, comparison, how, why, testimonials, FAQ). Final gap closed: the "Available at Emsworth" location header + the booking section header (eyebrow/headline/subhead) now editable (new "Location & Booking" tab). |
| 21 | Weight Loss | 🟢 | 🟢 | `page-weight-loss.php` | **Wired 23 Jun ✅** — gaps closed: benefit cards, programme steps & "Why Southdowns" cards are now repeaters (new "Benefits / Steps / Why" tab). Testimonials & FAQ were already wired. Card icons/colours stay in design; "leave empty for built-in defaults". |
| 22 | Travel Health | 🟢 | 🟢 | `page-travel-health.php` | **Wired 23 Jun ✅** — gaps closed: destination cards, FAQ, final-CTA trust pills & checklist are now repeaters (new "Destinations / FAQ / CTA" tab). Icons stay in design; "leave empty for built-in defaults". |
| 23 | Location (generic) | 🟢 | 🟢 | `page-location.php` | **Audited + polished 23 Jun ✅ 100%** — per-branch content fully wired via `branch_*` (NAP, hours, hero, testimonials, services, directions). Final gap closed: dual-CTA section (Book + AI-agent) headings, button labels, badge & both benefit lists now editable. |
| 24 | COVID-19 Vaccine (NHS) | 🟠 | 🔴 | `page-covid-vaccine.php` | **Audited 23 Jun — PARTIAL.** Wired: hero, programme, locations, eligibility, final CTA. ⚠️ Hardcoded: 3 booking-method cards, "is it safe / side effects" Q&A, FAQ Q&As. |
| 25 | Private COVID-19 Vaccine | 🟠 | 🔴 | `page-covid-vaccine-private.php` | **Audited 23 Jun — MOSTLY HARDCODED.** Only hero + price + final CTA wired (7 fields). ⚠️ Hardcoded inline arrays: vaccine stats, common/urgent side effects, why-choose cards, booking steps, FAQ, badges, trust stats. |
| 26 | Emsworth Location | 🟢 | 🔴 | `page-emsworth.php` | **Audited 23 Jun** — core branch data editable (`branch_*`: address, hours, phone, hero, directions, parking, map). ⚠️ Services list + testimonials are hardcoded inline (optional to wire; see note below table). |
| 27 | Bosmere Location | 🟢 | 🔴 | `page-bosmere.php` | **Audited 23 Jun** — same as Emsworth: core data editable; services list + testimonials hardcoded. |
| 28 | Davies Pharmacy Location | 🟢 | 🔴 | `page-davies-pharmacy.php` | **Audited 23 Jun** — same as Emsworth: core data editable; services list + testimonials hardcoded. |
| 29 | Rowlands Castle Location | 🟢 | 🔴 | `page-rowlands-pharmacy.php` | **Audited 23 Jun** — same as Emsworth: core data editable; services list + testimonials hardcoded. |

**Shared templates (not pages, but contain editable bits):**

| Page | Claude Progress | Oliver QC | Template | Notes |
|------|:---------------:|:---------:|----------|-------|
| Header | 🟢 | 🟢 | `header.php` | Logo + booking global ✅; nav, mega-menus & layout are structure (kept in code by design). No standalone content to wire. |
| Footer | 🟢 | 🟢 | `footer.php` | ✅ Tagline + about blurb now editable under **Pharmacy Settings → Footer**. Contact/email/branches global ✅; service links = nav (code); copyright auto-year. |

> **Score:** Claude 🟢 27 · 🟠 2 · 🔴 0 (+2 shared 🟢) — _Weight Loss & Travel Health gaps now closed (23 Jun). Remaining 🟠: NHS COVID (24) + Private COVID (25) — hero/sections wired, but card grids / side-effects / FAQs still hardcoded. Branch pages: core data editable, services list + testimonials hardcoded._
>
> **Branch pages note:** the 4 named branch templates hardcode their services list + testimonials inline, whereas the generic `page-location.php` pulls testimonials from `branch_testimonials`. Worth confirming which template each branch Page actually uses, and optionally switching the named pages to the same `branch_testimonials` field.
>
> 🆕 **Awards are now global** — edit once under **Pharmacy Settings → Awards**; they appear on both Home and About Us (`inc/acf-awards-fields.php` + `sp_awards()`).

---

## Already editable everywhere (global)

From **Pharmacy Settings** (ACF options page) — works on every page:
- Pharmacy name, phone (display + tel), email, logo, booking URL
- The 4 branches: name, address, phone, hours, photo, map — **Pharmacy Settings → Branch Locations**

---

## ACF field groups (all in code — deploy-safe ✅)

All defined in PHP under `inc/`, loaded by `functions.php`. Being code, they **can't be
wiped by a deploy and need no export.**

| File | Targets |
|------|---------|
| `inc/acf-pharmacy-settings-fields.php` | Global options (Pharmacy Settings / Branch Locations / Contact & Social) |
| `inc/acf-location-fields.php` | Location, Emsworth, Bosmere, Davies, Rowlands |
| `inc/acf-covid-vaccine-fields.php` | COVID-19 Vaccine + Private |
| `inc/acf-travel-health-fields.php` | Travel Health |
| `inc/acf-weight-loss-fields.php` | Weight Loss |
| `inc/acf-ear-wax-fields.php` | Ear Wax Removal |
| `inc/acf-blood-pressure-fields.php` | Blood Pressure Checks |
| `inc/acf-awards-fields.php` | Global Awards (Pharmacy Settings → Awards) |
| `inc/acf-home-fields.php` | Home Page (`front-page.php`) |
| `inc/acf-about-fields.php` | About Us |
| `inc/acf-pharmacy-first-fields.php` | Pharmacy First |
| `inc/acf-nhs-prescriptions-fields.php` | NHS Prescriptions |
| `inc/acf-flu-fields.php` | Flu Vaccinations |
| `inc/acf-b12-fields.php` | B12 Injections |
| `inc/acf-contraception-fields.php` | Contraception Services |
| `inc/acf-book-appointment-fields.php` | Book Appointment |
| `inc/acf-faq-fields.php` | FAQ |
| `inc/acf-health-hub-fields.php` | Health Hub |
| `inc/acf-yellow-fever-fields.php` | Yellow Fever |
| `inc/acf-travel-vaccines-fields.php` | Travel Vaccines (Cape Verde, India, Kenya, Thailand — shared) |
| `inc/acf-legal-fields.php` | Legal pages (Privacy, Cookie, Terms — shared) |

> ⚠️ The **only** export rule that still applies: if anyone builds a field group via
> **Custom Fields → Add New** in WP admin (saved to the database), it must be exported
> (**Generate PHP**) and committed, or it's wiped on the next deploy. Defining fields in
> the `inc/` files = nothing to export. Field *values* the client types are always safe.

---

## Working agreement

- **Content** (text, images, prices, ACF values) → edit in **WordPress**.
- **Theme code** (templates, `functions.php`, ACF field *definitions*) → edit in **GitHub**, deploy to server.
