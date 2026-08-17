#!/usr/bin/env python3
"""
Fixes a truncated EMBLEM_DATA_URI in index.php by copying the complete,
working base64 string over from your reference globe HTML file.

Usage:
    python3 fix_globe_texture.py reference_globe.html index.php

This does a byte-for-byte extraction and substitution -- no manual
retyping of the base64 blob, so there's no risk of truncating it again.
It also validates that the extracted string actually decodes as a
valid PNG before writing anything, and makes a .bak backup of index.php.
"""

import re
import sys
import base64
import shutil


def extract_data_uri(html_text):
    """Pull the full `data:image/png;base64,....` string out of a
    `var EMBLEM_DATA_URI = "...";` assignment. Base64 text never
    contains a literal double-quote, so matching up to the first
    unescaped `"` after the opening one is safe."""
    match = re.search(
        r'EMBLEM_DATA_URI\s*=\s*"(data:image/png;base64,[A-Za-z0-9+/=]+)"',
        html_text,
    )
    if not match:
        return None
    return match.group(1)


def validate_png_data_uri(data_uri):
    b64_part = data_uri.split(",", 1)[1]
    raw = base64.b64decode(b64_part, validate=True)
    if raw[:8] != b"\x89PNG\r\n\x1a\n":
        raise ValueError("Decoded data does not start with a PNG signature")
    return len(raw)


def main():
    if len(sys.argv) != 3:
        print("Usage: python3 fix_globe_texture.py <reference_html> <index_php>")
        sys.exit(1)

    ref_path, target_path = sys.argv[1], sys.argv[2]

    with open(ref_path, "r", encoding="utf-8") as f:
        ref_text = f.read()

    good_uri = extract_data_uri(ref_text)
    if not good_uri:
        print(f"Could not find a complete EMBLEM_DATA_URI in {ref_path}.")
        print("Make sure this is the *working* reference file.")
        sys.exit(1)

    try:
        byte_len = validate_png_data_uri(good_uri)
    except Exception as e:
        print(f"The EMBLEM_DATA_URI found in {ref_path} is not a valid PNG: {e}")
        sys.exit(1)

    print(f"Found a valid PNG data-URI in {ref_path} ({byte_len} bytes decoded, "
          f"{len(good_uri)} base64 chars).")

    with open(target_path, "r", encoding="utf-8") as f:
        target_text = f.read()

    # Replace every EMBLEM_DATA_URI assignment in the target file (index.php
    # may reference it once, or twice if it appears in more than one script
    # block) with the known-good string.
    pattern = re.compile(
        r'EMBLEM_DATA_URI\s*=\s*"data:image/png;base64,[A-Za-z0-9+/=]*"'
    )
    new_assignment = f'EMBLEM_DATA_URI = "{good_uri}"'

    new_text, count = pattern.subn(new_assignment, target_text)

    if count == 0:
        print(f"No EMBLEM_DATA_URI assignment found in {target_path} -- nothing to fix.")
        sys.exit(1)

    backup_path = target_path + ".bak"
    shutil.copyfile(target_path, backup_path)

    with open(target_path, "w", encoding="utf-8") as f:
        f.write(new_text)

    print(f"Replaced {count} occurrence(s) of EMBLEM_DATA_URI in {target_path}.")
    print(f"Backup of the original saved to {backup_path}.")
    print("Done -- the globe's logo texture should now render correctly.")


if __name__ == "__main__":
    main()