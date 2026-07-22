import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Make the pill wider, font smaller, and gap smaller so everything fits without overflowing.
fit_css = """
/* ============================================================
   40. PREVENT FLEX OVERFLOW (PILL FIT)
   ============================================================ */
/* Ensure the pill container doesn't overflow the screen */
.fa-nav-row-inner {
  width: 98% !important;
  max-width: 1600px !important;
  padding: 5px 15px !important;
  box-sizing: border-box !important;
}

/* Allow flex items to shrink if necessary */
.fa-sticky-logo,
.fa-mainnav,
.fa-nav-actions {
  flex-shrink: 1 !important;
}

/* Reduce logo slightly more */
.fa-sticky-logo img {
  max-height: 40px !important;
}

/* Compress the navigation links */
.fa-subnav-inner {
  gap: 2px !important;
  flex-wrap: nowrap !important;
}
.nav-top-link {
  padding: 8px 5px !important;
  font-size: 11px !important;
  letter-spacing: 0px !important;
}

/* Actions compression */
.fa-nav-actions {
  gap: 5px !important;
}
.aw-btn-start {
  padding: 8px 12px !important;
  font-size: 11px !important;
}
"""

if "40. PREVENT FLEX OVERFLOW" not in css_content:
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n" + fit_css)
    print("Added overflow prevention CSS")
else:
    print("Already added")
