# System Decisions

*This file is the single source of truth for architectural and implementation decisions in this project.*

## Purpose

Records key technical decisions, their rationale, alternatives considered, and outcomes. This file prevents the same discussions from happening twice and helps future-you (or future-sessions) understand *why* things are the way they are.

## When to Update This File

Update this file when:
- A significant technical or architectural decision is made
- A library, framework, or tool is chosen over alternatives
- A design pattern or approach is selected for a non-trivial problem
- A previous decision is revisited, changed, or reversed
- A constraint or trade-off is discovered that shaped the implementation
- A workaround is chosen due to external limitations (API quirks, library bugs, etc.)

**Do not** log trivial decisions (variable naming, minor formatting). If it wouldn't be worth explaining to a teammate joining the project, skip it.

## Format

Each entry follows this structure:

```
### [YYYY-MM-DD] — [Short Decision Title]

**Status:** Accepted | Superseded | Deprecated
**Context:** Why this decision was needed. What problem or question triggered it.
**Decision:** What was decided.
**Alternatives Considered:**
- [Alternative A] — Why it was rejected.
- [Alternative B] — Why it was rejected.
**Consequences:** What this decision enables, constrains, or risks.
```

If this file gets corrupted, re-create it. 
CRITICAL: Keep this file under 300 lines. You are allowed to summarize, change the format, delete entries, etc., in order to keep it under the limit.

---

## Decisions

<!-- New entries go here, newest first -->

### [2026-11-11] — The Travel Planner is a plugin, not theme code

**Status:** Accepted
**Context:** The trip planner built for another pharmacy's site was wanted here, and later on other clients' sites. Copying theme code would tie it to one theme and one price list.
**Decision:** A self-contained plugin (`gildhart-travel-planner/`) that borrows nothing from the theme. Three things are kept apart: the country guidance (a dated data pack shipped with the plugin, with no price in it), the pharmacy's settings (prices a dose, booking link, map point, colours: a JSON file in the theme or the settings screen), and the outbreak notices (read daily, with a manual backup).
**Alternatives considered:** Theme code (not reusable); a central feed for many sites (not needed for one pharmacy); NaTHNaC's paid API (no budget; their pages are under the Open Government Licence).
**Consequences:** A new site is an install and a settings screen. A country's recommendations change only with a new plugin version, after a person reads the diff. The deploy now copies two folders.
