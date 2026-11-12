=== Travel Planner by Gildhart ===
Requires at least: 6.0
Requires PHP: 7.4
Stable tag: 1.3.0
License: GPLv2 or later

"Where are you going?" for a pharmacy's travel clinic.

== What it does ==

A visitor types any country. The planner shows the vaccines the guidance
lists for it, what each costs a dose at this pharmacy, how far ahead to
book, the certificate and malaria facts, and the outbreak notices for that
country. Every answer ends at a booking.

* [travel_planner] puts the planner on a page.
* [travel_notices] lists the latest outbreak notices (count="6", diseases="ours" or "all").

== Setting it up on a site ==

1. Plugins > Add New Plugin > Upload Plugin, with the zip from Gildhart's
   updates repository (github.com/Gildhart-pharmodigital/travel-planner-updates),
   then Activate. It updates itself from then on.
2. Open Travel Planner > Settings. Fill in the booking link, the pharmacy's
   point on the map, each vaccine's price a dose, and the colours.
   Or paste settings copied from another site into "Import settings".
3. Put [travel_planner] on the travel page.
4. Until "Show the planner to everyone" is ticked, only people signed in to
   edit the site can see it. Tick it once the prices and wording are approved.

A site built in git can carry its settings as a file in its theme,
gildhart-travel-planner.json beside style.css. The plugin reads that file
until someone saves the settings screen.

== What updates, and how ==

* Outbreak notices are read once a day from NaTHNaC's TravelHealthPro: the
  date, the disease and the country, never their words or figures. If their
  page cannot be read, one email says so, the last reading stays with its
  date, and after 30 days it is no longer shown. Travel Planner > Notices
  lets a person read now, add a notice by hand, or take one off.
* The live line: under the box, the planner says when the notices were last
  read ("Live: outbreak notices from NaTHNaC, checked today at 6:40am", by the
  visitor's own clock) and lists the latest three, each opening its country;
  on a desktop the map marks every country with a notice in the last 30 days.
  The dot pulses, gently, only while the last reading is under 50 hours old
  (a daily reading through a day-long page cache); older, it says "last
  checked" and nothing moves; after 30 days it is not drawn at all. Nothing
  moves for a visitor who has asked for reduced motion.
* The page cache: the prices and the notices are in the page's HTML, so a
  host that caches pages is told to clear them when the settings change,
  when the notices on show change, and once for a new version. On Kinsta
  this is Kinsta's own call; any other host or caching plugin can answer the
  gtp_purge_pages action.
* What the guidance says about each country ships with the plugin and is
  dated on every card. It changes only with a new version of the plugin, so
  a recommendation never moves on a site without a person having looked.
* The plugin itself: WordPress finds each new version (with each month's
  guidance) in Gildhart's updates repository, shows it in Plugins like any
  other, and installs it by itself. Travel Planner > Settings > Updates turns
  that off. Only Gildhart's own zip, for exactly the version named, is ever
  offered. Settings, prices and notices are kept: they are in the site's
  database (or its theme), never in the plugin's folder.

== For a theme ==

* On a phone the trip card's booking bar is pinned to the foot of the window.
  While it is, <html> carries data-gtp-pinned and --gtp-pinned-height (from
  the window's bottom edge to the bar's top), so a theme can lift its own
  floating things (a chat button) clear of it.
* Anything on the page marked data-gtp-pick="<country slug>" (a destination
  card, say) opens that country in the planner in place. Make it a link to
  ?going=<slug> and it still works without the script.

== The rules it keeps ==

* A price is one dose's. A card never shows a course's total or a trip's sum.
* A vaccine is named by its type, never a brand.
* Nobody is told they do not need a vaccine. Every card ends at a booking.
* Yellow fever is priced only for a registered yellow fever centre.
* Country guidance: contains public sector information licensed under the
  Open Government Licence v3.0 (NaTHNaC TravelHealthPro), written in our own
  words. The map is drawn from Natural Earth (public domain).
