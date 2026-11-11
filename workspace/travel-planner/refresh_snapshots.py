#!/usr/bin/env python3
"""Read TravelHealthPro's country pages afresh, for a new data pack.

    python3 refresh_snapshots.py --pipeline <content system with thp.py> --out <a directory outside the repository>
    python3 build_pack.py --pipeline <the same> --snapshots <that directory>

One request for their list of countries, then one for each country's page,
spaced out, named plainly for what it is. The snapshots hold TravelHealthPro's
own text, so they are kept out of this repository (it is public): only the
pack built from them, which is facts in our own words, is committed.

If their server refuses or their pages stop reading as country pages, this
stops and says so. It does not try another way in: the pack keeps its date,
every card goes on saying that date, and a person decides what to do next.
"""
import argparse, json, os, pathlib, sys, time


def main():
    ap = argparse.ArgumentParser(description=__doc__.split("\n\n")[0])
    ap.add_argument("--pipeline", required=True)
    ap.add_argument("--out", required=True)
    ap.add_argument("--delay", type=float, default=1.2, help="seconds between requests")
    a = ap.parse_args()
    sys.path.insert(0, os.path.abspath(a.pipeline))
    import thp  # noqa: E402

    out = pathlib.Path(a.out).resolve()
    thp.SOURCES = out
    thp.CACHE = out / "cache"
    thp.UA = "pharmacy-travel-planner/1.0 (one read of each country page, for a dated summary in our own words)"
    out.mkdir(parents=True, exist_ok=True)

    countries = thp.countries()
    print(f"{len(countries)} countries listed", flush=True)
    done, failed, streak = 0, [], 0
    for c in countries:
        time.sleep(a.delay)
        try:
            snap = thp.parse(c["slug"], thp.fetch_html(c["slug"], refresh=True))
            f = thp.facts(snap)
            if not (f["tiers"].get("most") or f["tiers"].get("some") or f["tiers"].get("selected")):
                raise ValueError("no vaccine tiers read: not their country page as we know it")
            (out / f"{c['slug']}.json").write_text(json.dumps(snap, indent=2, ensure_ascii=False) + "\n", encoding="utf-8")
            done += 1; streak = 0
        except Exception as e:  # their server said no, or the page is not what it was
            failed.append((c["slug"], str(e)[:120])); streak += 1
            if streak >= 5:
                print(f"STOPPED: five in a row could not be read ({failed[-1][1]}). Nothing further was asked.", flush=True)
                break
        if done and done % 40 == 0:
            print(f"  {done} read", flush=True)
    print(f"read {done} of {len(countries)}; {len(failed)} not read" + (": " + ", ".join(s for s, _ in failed[:12]) if failed else ""), flush=True)
    return 0 if done and streak < 5 else 1


if __name__ == "__main__":
    sys.exit(main())
