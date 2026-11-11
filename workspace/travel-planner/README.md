# The Travel Planner plugin: how it is built, tested and refreshed

The plugin is `gildhart-travel-planner/` at the repository's root. The deploy
copies it to the site's plugins folder beside the theme
(`.github/workflows/deploy.yml`); it does nothing until it is switched on in
wp-admin, and shows nothing to the public until its own setting says so.

Southdowns' settings (prices a dose, the booking link, the map point, the
colours) are `southdowns-pharmacy-theme/gildhart-travel-planner.json`. The
plugin reads that file until someone saves its settings screen in wp-admin.
The planner is placed by `page-templates/page-travel-health.php`, above the
destinations.

## Checks

```
cd workspace/travel-planner/tests
./serve.sh                 # the harness: the plugin without WordPress, port 8911
node checks/planner.js     # 137 checks; exits 1 on any failure
node checks/tamper.js      # breaks 11 rules on purpose; each must be caught
node checks/shots.js out/  # screenshots, for a person to look at (a phone's screens and the two wp-admin screens too)
```

The harness (`tests/harness/`) stands in for WordPress, and
`tests/fixtures/outbreaks.html` for TravelHealthPro's outbreak search: a saved
copy with every notice's words taken out. Nothing in the checks asks
TravelHealthPro for anything. Run both checks before any change is pushed.

## Refreshing what the guidance says (the data pack)

`gildhart-travel-planner/data/` is built, never edited. It needs the content
system that holds `thp.py` (the Miles Pharmacy repository's `content-system/`).

```
python3 refresh_snapshots.py --pipeline <content-system> --out <a directory outside this repository>
python3 build_pack.py --pipeline <content-system> --snapshots <that directory>
git diff --stat gildhart-travel-planner/data/countries   # what changed in the guidance
```

The snapshots hold TravelHealthPro's own text, and this repository is public,
so they stay outside it: only the pack, which is facts in our own words, is
committed. Read the diff before committing: a country whose recommended
vaccines changed is a clinical change, and a person should see it. Then bump
the plugin's version and deploy. A page that drops its connection is asked for
once more; a page their server refuses is not.

Between the reading of 8 October 2026 and that of 11 November, four things
changed in 262 countries: Zimbabwe's page could be read (it had no card);
polio joined "some travellers" for Kenya, Libya and Uganda; and Uganda stopped
asking for a yellow fever certificate. That last one is why the yellow fever
line on a card is now written from each country's own certificate fact
(`yellow_fever_note()` in `build_pack.py`), and the checks hold every card to
it.

`AKA` in `build_pack.py` is the other names the box answers to. TravelHealthPro
files a place under one name ("DRC", "USA", "Korea, South") and some places
under their country (Bali is their Indonesia page); a traveller types the name
they know. Add a name there, never in `data/countries.json`.

`data/map.json` and `data/outlines/` are drawn from Natural Earth by the same
content system (`planner_map.py`) and change only when a country does.

## Another pharmacy

Install the plugin on its site, then either fill in Travel Planner > Settings
or paste the settings exported from this site and change the prices, the
booking link, the map point and the colours. No rebuild: the pack holds no
price and no pharmacy. If its theme lives in git, give it its own
`gildhart-travel-planner.json`.
