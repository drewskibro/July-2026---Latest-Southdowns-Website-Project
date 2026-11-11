# The Travel Planner on this site

The planner is Gildhart's product, built, tested and released from its own
private repository: **Gildhart-pharmodigital/gildhart-travel-planner**. Its
source, tests, guidance pipeline and the Claude skill that runs it live there.

What this repository carries:

- `gildhart-travel-planner/` at the root: **a released copy** of the plugin
  (1.2.0), which the deploy puts in `wp-content/plugins/`. **Do not edit it
  here.** A fix is made in the product repository, released, and copied in
  with its `tools/sync-client.py`, which refuses to overwrite a copy that was
  changed here.
- `southdowns-pharmacy-theme/gildhart-travel-planner.json`: Southdowns'
  settings as onboarded. Since the planner was switched on (11 November 2026)
  the live settings are in wp-admin, Travel Planner > Settings, and this file
  is not read. Change prices there.
- The theme's part: `page-templates/page-travel-health.php` places the planner
  straight after the hero, the phone's hero leads to it, the destinations
  under it open their country in it, and `assets/css/global.css` lifts the
  chat button clear of its booking bar on a phone.

## Checks

```
node workspace/travel-planner/theme-check.js
```

The theme's part, from the files, with each rule broken on purpose to prove
it is caught. The plugin's own checks run in the product repository, and so
does its live check, which reads this site's travel page as a visitor sees it.
