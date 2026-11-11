#!/usr/bin/env python3
"""The Travel Planner's data pack: gildhart-travel-planner/data/.

    python3 build_pack.py --pipeline <path to the content system that holds thp.py>
                          [--snapshots <dir>] [--today YYYY-MM-DD] [--out <dir>]

What a country's card says comes from here; what a pharmacy charges never
does. The pack is every country TravelHealthPro (NaTHNaC) has a page for,
read into facts by thp.py (the reader built for the first site this ran on)
and written in our own sentences: the vaccines the guidance lists for most
and for some travellers, the certificate and malaria facts, and one line a
vaccine. No price, no supply, no pharmacy's name: the plugin's settings hold
those, so one pack serves any pharmacy.

A recommendation never changes on a site by itself. This script is run by a
person, its output is committed, and `git diff` on data/countries/ is what
changed in the guidance since the last pack. The outbreak notices are the
live half, read daily by the plugin (includes/notices.php).

It writes:
  pack.json            when the pack was built and read, its source and licence
  countries.json       every country: name, slug, whether it has a card
  countries/<slug>.json  the card's facts
  vaccines.json        each vaccine the cards name: doses, timing, lead time
The map and the outlines (data/map.json, data/outlines/) are drawn from
Natural Earth by the same content system and copied in beside them; they
change only when a country does.
"""
import argparse, datetime, json, os, re, sys


def main():
    ap = argparse.ArgumentParser(description=__doc__.split("\n\n")[0])
    ap.add_argument("--pipeline", required=True, help="the content system directory holding thp.py and build.py")
    ap.add_argument("--snapshots", help="a directory of TravelHealthPro snapshots (default: the pipeline's own sources/thp)")
    ap.add_argument("--today", help="the day the pack is built (default: today)")
    ap.add_argument("--out", default=os.path.join(os.path.dirname(os.path.abspath(__file__)), "..", "..", "gildhart-travel-planner", "data"))
    a = ap.parse_args()

    sys.path.insert(0, os.path.abspath(a.pipeline))
    import build, thp  # noqa: E402  (the pipeline's own modules)

    today = datetime.date.fromisoformat(a.today) if a.today else datetime.date.today()
    snaps = os.path.abspath(a.snapshots or os.path.join(a.pipeline, "sources", "thp"))
    out = os.path.abspath(a.out)
    os.makedirs(os.path.join(out, "countries"), exist_ok=True)

    vaccines = build.load_vaccines()
    rules = build.load(build.ROOT / "rules" / "global.json")
    # No pharmacy in the pack: no "we're a registered yellow fever centre",
    # no "we can issue the certificate". The plugin says what its pharmacy does.
    rules["clinic"] = dict(rules["clinic"], yellow_fever_centre=False, polio_icvp=False)
    brands = [b.lower() for b in rules.get("pom_brands", [])]

    # The yellow fever line names the pharmacy on the first site; here it stops at the fact.
    notes = dict(thp.NOTES)
    notes["yellow-fever"] = re.sub(r";\s*we're a registered yellow fever centre\.?$", ".", notes["yellow-fever"])
    thp.NOTES = notes

    index = json.load(open(os.path.join(snaps, "countries.json"), encoding="utf-8"))
    used, rows, written, fetched = {}, [], 0, []
    for c in index["countries"]:
        row = {"name": c["name"], "slug": c["slug"]}
        sp = os.path.join(snaps, c["slug"] + ".json")
        if os.path.exists(sp):
            snap = json.load(open(sp, encoding="utf-8"))
            card = build.planner_from_snapshot(snap, vaccines, rules, today)
            tiers = {}
            for tier in ("most", "some"):
                tiers[tier] = []
                for v in card["vaccines"].get(tier, []):
                    tiers[tier].append({"id": v["id"], "note": v["note"]})
                    used.setdefault(v["id"], vaccines[v["id"]])
            page = {
                "slug": card["slug"], "name": card["name"], "checked": card["checked"],
                "source": snap.get("url") or ("https://travelhealthpro.org.uk/countries/" + card["slug"]),
                "vaccines": tiers, "also_listed": card["also_listed"],
                "certificates": card["certificates"], "malaria": card["malaria"],
            }
            json.dump(page, open(os.path.join(out, "countries", c["slug"] + ".json"), "w", encoding="utf-8"), indent=1, ensure_ascii=False)
            row["planner"] = True
            written += 1
            fetched.append(card["checked"])
        rows.append(row)

    catalogue = {}
    for vid, v in sorted(used.items()):
        catalogue[vid] = {
            "name": v["name"], "doses": v["price"]["doses_in_course"],
            "timing": v.get("timing_note"), "lead": build.lead_days(v.get("timing_note")),
            "included_in": v.get("included_in") or None,
        }
    json.dump(catalogue, open(os.path.join(out, "vaccines.json"), "w", encoding="utf-8"), indent=1, ensure_ascii=False)
    json.dump({"countries": rows}, open(os.path.join(out, "countries.json"), "w", encoding="utf-8"), indent=1, ensure_ascii=False)
    json.dump({
        "built": today.isoformat(),
        "read": {"oldest": min(fetched), "newest": max(fetched)},
        "countries": len(rows), "cards": written, "vaccines": len(catalogue),
        "source": "NaTHNaC TravelHealthPro country pages (travelhealthpro.org.uk/countries), read into facts and written in our own words",
        "licence": "Contains public sector information licensed under the Open Government Licence v3.0.",
    }, open(os.path.join(out, "pack.json"), "w", encoding="utf-8"), indent=1, ensure_ascii=False)

    # What must never be in a pack: a price, a pharmacy, a prescription-only brand.
    faults = []
    for root, _, files in os.walk(out):
        if os.path.basename(root) == "outlines":
            continue
        for f in files:
            if not f.endswith(".json") or f == "map.json":
                continue
            text = open(os.path.join(root, f), encoding="utf-8").read()
            low = text.lower()
            if "£" in text:
                faults.append(f"{f}: a price")
            if re.search(r"\bmiles\b|we're a registered|we can issue", low):
                faults.append(f"{f}: a pharmacy's own words")
            for b in brands:
                if re.search(r"\b" + re.escape(b) + r"\b", low):
                    faults.append(f"{f}: the brand {b}")
    print(f"pack: {len(rows)} countries, {written} cards, {len(catalogue)} vaccines, read {min(fetched)} to {max(fetched)}, built {today.isoformat()}")
    if faults:
        print("FAULTS:\n  " + "\n  ".join(faults[:20]))
        return 1
    return 0


if __name__ == "__main__":
    sys.exit(main())
