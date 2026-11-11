# System Patterns & Conventions

*This file is the single source of truth for recurring patterns, conventions, and technical standards in this project.*

## Purpose

Documents the established architecture patterns, coding conventions, and technical standards the project follows. This file exists so the agent (and future sessions) can produce consistent code without re-discovering or re-debating how things are done here.

## When to Update This File

Update this file when:
- A new architectural pattern is introduced or adopted (e.g., repository pattern, event-driven flow)
- A coding convention is established that deviates from language defaults
- A reusable approach is identified and should be applied consistently (error handling, logging, validation)
- A pattern is deprecated or replaced by a better approach
- A new integration point is added that follows (or defines) a standard interface
- File/folder structure conventions change

**Do not** document one-off implementations. Only patterns that should be **replicated** across the codebase belong here.

## Format

Organize patterns by category. Each pattern follows this structure:

```
### [Pattern Name]

**Category:** Architecture | Data Flow | Error Handling | Testing | API Design | File Structure | [Other]
**Status:** Active | Deprecated
**Description:** What the pattern is and when to apply it.
**Implementation:**
[Code example or step-by-step description]
**Rationale:** Why this pattern was chosen.
```

When a pattern is **deprecated** you can either delete it or update its status and note the replacement.

If this file gets corrupted, re-create it. 
CRITICAL: Keep this file under 300 lines. You are allowed to summarize, change the format, delete entries, etc., in order to keep it under the limit.

---

## Architecture

<!-- Patterns related to high-level system structure -->

## Data Flow

<!-- Patterns for how data moves through the system -->

## Error Handling

<!-- Standard approaches to errors, validation, and recovery -->

### Travel Planner settings and placement

**Category:** File Structure
**Status:** Active
**Description:** The Travel Planner plugin is configured by `southdowns-pharmacy-theme/gildhart-travel-planner.json` (until its settings screen is saved in wp-admin) and placed by shortcode. A template renders it before `get_header()` so its stylesheet lands in the head, and prints the result where it belongs.
**Implementation:**
`$planner = shortcode_exists( 'travel_planner' ) ? do_shortcode( '[travel_planner book="#book"]' ) : '';` before `get_header()`, then `echo $planner;` in place. A price in the JSON is always one dose's.
**Rationale:** The page is unchanged when the plugin is off or in preview, and prices stay in git.
