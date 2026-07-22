import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# We need to remove sections 39, 40, 41, 42 and anything else related to navbar.
# Actually, wait, let's remove everything from "38. FIX HERO OVERLAPS" (or "37. SLEEK HERO SECTION") down to the end if it's just navbar stuff.
# But wait, 37 is the hero section which we need to keep.
# Let's remove specifically from "39. AGGRESSIVE PILL OVERRIDES" to the end.

split_marker = '/* ============================================================\n   39. AGGRESSIVE PILL OVERRIDES (FIXING CONFLICTS)\n   ============================================================ */'
if split_marker in css_content:
    clean_css = css_content.split(split_marker)[0]
    with open(css_path, 'w', encoding='utf-8') as f:
        f.write(clean_css)
    print("Cleaned up aggressive overrides in attwood-brand.css")
else:
    print("Split marker not found, might have been cleaned already or has a different format.")
    
# Let's also look for earlier navbar overrides. E.g., "Sleek Frosted Pill Navbar"
# Let's use regex to remove any block that looks like a navbar override.
# Actually, instead of regex, since we don't care about the old navbar styles, we can just leave them if they don't apply, 
# because we renamed the classes to .aw-site-header!
# BUT to be clean, let's remove the "39, 40, 41, 42" blocks.
