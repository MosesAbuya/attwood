import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

match_css = """
/* ============================================================
   42. MATCH SEARCH CONTAINER & FIX NAV ALIGNMENT
   ============================================================ */

/* 1. Glossy Dark Background matching Hero Search Container */
/* 5. Make navbar thicker with more padding */
.fa-nav-row-inner,
.fa-site-header.nav-sticky .fa-nav-row-inner,
.fa-site-header.scrolled .fa-nav-row-inner {
  background: rgba(25, 25, 25, 0.35) !important;
  backdrop-filter: blur(12px) !important;
  -webkit-backdrop-filter: blur(12px) !important;
  border: 1px solid rgba(255, 255, 255, 0.1) !important;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
  padding: 16px 35px !important; /* Thicker padding */
  align-items: center !important; /* Vertical center */
}

/* 2. Vertically align navitems exactly */
.fa-mainnav,
.fa-subnav-inner {
  display: flex !important;
  align-items: center !important;
  margin: 0 !important;
  padding: 0 !important;
  height: 100% !important;
}

.fa-subnav-inner > li {
  display: flex !important;
  align-items: center !important;
  margin: 0 !important;
  padding: 0 !important;
}

/* 3 & 4. Change font color to white */
.nav-top-link,
.fa-nav-actions,
.fa-nav-actions button,
.fa-nav-actions span,
.fa-nav-actions i,
.fa-nav-toggle,
.fa-lang-selector-wrap,
.fa-lang-selector-wrap select,
.fa-lang-selector-wrap i {
  color: #ffffff !important;
  text-shadow: 0 1px 2px rgba(0,0,0,0.3) !important; /* Help visibility */
  display: flex !important;
  align-items: center !important;
}

/* Reset margin/padding on links to keep them perfectly centered */
.nav-top-link {
  margin: 0 !important;
  line-height: 1 !important;
}

/* Fix dropdown text colors so they don't stay white on white backgrounds */
.fa-megamenu .nav-top-link,
.fa-megamenu * {
  text-shadow: none !important;
}

/* 5. Button color to match theme (Cyan from Logo) */
.btn-attwood-cta,
.aw-btn-start {
  background: #00AEEF !important; /* Attwood Cyan */
  color: #ffffff !important;
  border: none !important;
  font-weight: 700 !important;
  padding: 10px 20px !important;
  border-radius: 50px !important;
  box-shadow: 0 4px 15px rgba(0, 174, 239, 0.4) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.05em !important;
  text-shadow: none !important;
  align-items: center !important;
  justify-content: center !important;
  line-height: 1 !important;
}

.btn-attwood-cta:hover,
.aw-btn-start:hover {
  background: #0096ce !important;
}

/* Also ensure logo is aligned properly */
.fa-sticky-logo {
  display: flex !important;
  align-items: center !important;
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}
"""

if "42. MATCH SEARCH CONTAINER" not in css_content:
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n" + match_css)
    print("Added search container match tweaks")
else:
    print("Already added")
