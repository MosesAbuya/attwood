import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Aggressive overrides to kill filao-theme.css conflicts
aggressive_css = """
/* ============================================================
   39. AGGRESSIVE PILL OVERRIDES (FIXING CONFLICTS)
   ============================================================ */

/* Kill all backgrounds on the wrapper rows */
.fa-site-header,
.fa-site-header.scrolled,
.fa-site-header:hover,
.fa-site-header.scrolled:hover {
  background: transparent !important;
  box-shadow: none !important;
  border: none !important;
}

.fa-logo-row,
.fa-site-header.scrolled .fa-logo-row {
  display: none !important;
  background: transparent !important;
}

.fa-nav-row,
.fa-site-header.scrolled .fa-nav-row,
.fa-site-header.scrolled .fa-nav-row:hover {
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
}

/* Ensure the pill doesn't wrap or cause overflow issues */
.fa-nav-row-inner {
  display: flex !important;
  flex-wrap: nowrap !important;
  justify-content: space-between !important;
  align-items: center !important;
  max-width: 95% !important; /* give it more room */
  overflow: visible !important;
}

/* Scale down the logo inside the pill so it fits */
.fa-sticky-logo {
  display: flex !important;
  position: static !important;
  transform: none !important;
  margin-right: 20px !important;
}
.fa-sticky-logo img {
  max-height: 45px !important; /* scale it down */
  width: auto !important;
}

/* Scale down the nav links slightly so they fit */
.nav-top-link {
  padding: 10px 8px !important;
  font-size: 12px !important;
  white-space: nowrap !important;
}

/* Fix actions (Search, Menu, Start Planning) */
.fa-nav-actions {
  display: flex !important;
  flex-wrap: nowrap !important;
  align-items: center !important;
  gap: 10px !important;
}
.aw-btn-start {
  white-space: nowrap !important;
  padding: 8px 16px !important;
  font-size: 12px !important;
}
"""

if "39. AGGRESSIVE PILL OVERRIDES" not in css_content:
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n" + aggressive_css)
    print("Added aggressive overrides")
else:
    print("Overrides already present")
