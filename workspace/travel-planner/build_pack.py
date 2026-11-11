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


# Other names for a place, for the search box only. TravelHealthPro files each
# country under one name ("DRC", "USA", "Korea, South") and some places under
# their country (Bali is their Indonesia page); a traveller types the name they
# know. Each is another name for the same page, never a different place, and
# the card that opens is headed with TravelHealthPro's own name.
AKA = {
    "democratic-republic-of-the-congo": ["Democratic Republic of the Congo", "DR Congo", "Congo (Kinshasa)"],
    "congo": ["Republic of the Congo", "Congo (Brazzaville)"],
    "indonesia": ["Bali"],
    "usa": ["United States of America", "United States", "America"],
    "united-kingdom": ["UK", "Great Britain"],
    "united-arab-emirates": ["UAE", "Dubai", "Abu Dhabi"],
    "north-macedonia": ["North Macedonia"],
    "south-korea": ["South Korea"],
    "north-korea": ["North Korea"],
    "turkey": ["Türkiye"],
    "czechia": ["Czech Republic"],
    "eswatini": ["Swaziland"],
    "cote-divoire": ["Ivory Coast"],
    "the-gambia": ["The Gambia"],
    "bahamas": ["The Bahamas"],
    "netherlands": ["Holland"],
    "tanzania": ["Zanzibar"],
    "cape-verde": ["Cabo Verde"],
    "macao-china": ["Macau"],
    "st-lucia": ["Saint Lucia"],
    "st-kitts-and-nevis": ["Saint Kitts and Nevis"],
    "st-vincent-and-the-grenadines": ["Saint Vincent and the Grenadines"],
    "canary-islands-spain": ["Tenerife", "Lanzarote", "Gran Canaria", "Fuerteventura"],
    "balearic-islands-spain": ["Majorca", "Mallorca", "Ibiza", "Menorca"],
}


def yellow_fever_note(country, yf):
    """The yellow fever card's line, from the facts read for this country:
    where the risk is, and whether a certificate is asked for. One sentence
    used to fit every country, and said a certificate "is required for entry
    in some cases" of a country that asks for none. A fact that was not read
    is not written about."""
    where = {"all": f"throughout {country}", "parts": f"in parts of {country}", "low": f"in parts of {country}"}.get(yf.get("scope"), f"in {country}")
    s = f"There's a risk of yellow fever {where}. The vaccine protects you"
    if yf.get("certificate_required") is True:
        return s + ", and a certificate can be asked for at the border."
    if yf.get("certificate_required") is False:
        return s + "; no certificate is asked for on entry."
    return s + "."


def certificate_words(country, yf, lines):
    """The pipeline's certificate sentences, with one gap closed: a country
    with yellow fever that asks for no certificate, where how far the risk
    reaches was not read, said only "No yellow fever certificate is needed."
    beside a card recommending the vaccine."""
    if yf.get("certificate_required") is False and yf.get("risk_in_country") and not yf.get("scope"):
        bare = "No yellow fever certificate is needed."
        full = f"No yellow fever certificate is needed to enter {country}, but there's a risk of yellow fever there, so the vaccine may be recommended."
        return [full if line == bare else line for line in lines]
    return lines


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
        if c["slug"] in AKA:
            row["aka"] = AKA[c["slug"]]
        sp = os.path.join(snaps, c["slug"] + ".json")
        if os.path.exists(sp):
            snap = json.load(open(sp, encoding="utf-8"))
            card = build.planner_from_snapshot(snap, vaccines, rules, today)
            yf = thp.facts(snap)["yellow_fever"]
            tiers = {}
            for tier in ("most", "some"):
                tiers[tier] = []
                for v in card["vaccines"].get(tier, []):
                    note = yellow_fever_note(card["name"], yf) if v["id"] == "yellow-fever" else v["note"]
                    tiers[tier].append({"id": v["id"], "note": note})
                    used.setdefault(v["id"], vaccines[v["id"]])
            card["certificates"] = certificate_words(card["name"], yf, card["certificates"])
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
    faults = [f"another name for {slug}, which is not in their list" for slug in AKA if slug not in {r["slug"] for r in rows}]
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
