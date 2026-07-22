import re

# 1. SCRUB nav.php
nav_path = 'e:/xampp/htdocs/attwood/includes/nav.php'
with open(nav_path, 'r', encoding='utf-8') as f:
    nav_content = f.read()

def preserve_case_replace(match):
    text = match.group(0)
    if text == 'Filao': return 'Attwood'
    if text == 'filao': return 'attwood'
    if text == 'FILAO': return 'ATTWOOD'
    return 'Attwood'

nav_content = nav_content.replace('Filao Adventures', 'Attwood Travel Agency Ltd')
nav_content = re.sub(r'\bFilao\b', preserve_case_replace, nav_content)
nav_content = re.sub(r'\bfilao\b', preserve_case_replace, nav_content)

# Update logo sources
nav_content = re.sub(r'src="assets/logo/.*?\.png"', 'src="oldattwood/img/logo.png"', nav_content)

# Hide fa-logo-row completely, we will use fa-sticky-logo permanently for our single row design!
nav_content = nav_content.replace('<div class="fa-logo-row" id="faLogoRow">', '<div class="fa-logo-row d-none" id="faLogoRow">')

# Expose fa-sticky-logo permanently, remove its native hiding class logic if any, just strip ID or let CSS handle it
# Wait, just writing it back
with open(nav_path, 'w', encoding='utf-8') as f:
    f.write(nav_content)
print("Scrubbed nav.php")

# 2. OVERHAUL CSS
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Completely remove previous 38. CENTERED NAVBAR block
css_content = re.sub(r'/\* ============================================================\s*38\. CENTERED NAVBAR.*', '', css_content, flags=re.DOTALL)

# Now, write the Floating Pill Navbar CSS
floating_nav_css = """
/* ============================================================
   38. FLOATING PILL NAVBAR (SCROLLBACK STICKY)
   ============================================================ */
/* Hide the top row (contacts) so we only deal with the nav row */
.fa-logo-row {
  display: none !important;
}

/* Wrapper */
.fa-site-header {
  position: absolute;
  top: 25px;
  left: 0;
  width: 100%;
  z-index: 1050;
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
  transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1), top 0.4s ease;
}

/* Scrollback Sticky Classes */
/* 'nav-hidden' when scrolling down */
.fa-site-header.nav-hidden {
  transform: translateY(-150%);
}
/* 'nav-sticky' when scrolling up */
.fa-site-header.nav-sticky {
  position: fixed;
  top: 15px;
  transform: translateY(0);
}

/* The actual pill */
.fa-nav-row {
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
}
.fa-nav-row-inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 0 auto !important;
  max-width: 90% !important;
  background: #ffffff !important;
  border-radius: 50px !important;
  padding: 5px 30px !important;
  box-shadow: 0 10px 40px rgba(0,0,0,0.1) !important;
  border: 1px solid rgba(0,0,0,0.05) !important;
}

/* When sticky, maybe slightly smaller padding */
.fa-site-header.nav-sticky .fa-nav-row-inner {
  box-shadow: 0 15px 50px rgba(0,0,0,0.15) !important;
}

/* Force the logo to always be visible inside the pill */
.fa-sticky-logo {
  display: flex !important;
  align-items: center;
}
.fa-sticky-logo img {
  max-height: 55px !important;
  transition: max-height 0.3s ease;
}

/* Main Navigation Items */
.fa-mainnav {
  display: flex;
  align-items: center;
}
.fa-subnav-inner {
  display: flex;
  gap: 15px;
  margin: 0;
  padding: 0;
}
.nav-top-link {
  color: #333333 !important;
  font-family: 'Inter', sans-serif !important;
  font-weight: 700 !important;
  font-size: 13px !important;
  letter-spacing: 0.5px !important;
  padding: 15px 12px !important;
  text-transform: uppercase !important;
  border-radius: 30px;
  transition: all 0.3s ease;
}
.nav-top-link:hover, .fa-mainnav > ul > li:hover > .nav-top-link {
  color: var(--aw-accent-sky) !important;
  background: rgba(0,0,0,0.03);
}

/* Actions inside the nav (Search, Menu) */
.fa-nav-actions {
  display: flex !important;
  align-items: center;
  gap: 15px;
}
.fa-search-btn, .fa-menu-open {
  color: #333 !important;
}
.aw-btn-start {
  background: var(--aw-accent-sky) !important;
  color: #fff !important;
  border-radius: 30px !important;
  padding: 10px 24px !important;
  font-weight: 700 !important;
}
.aw-btn-start:hover {
  background: #333 !important;
}

/* Mega Menu Adjustments */
.fa-megamenu {
  border-radius: 20px !important;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
  top: 100% !important;
  margin-top: 15px !important;
}
"""
with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content.strip() + "\n" + floating_nav_css)
print("Updated CSS")

# 3. OVERHAUL JS for Scrollback Sticky
js_path = 'e:/xampp/htdocs/attwood/assets/js/attwood-nav.js'
with open(js_path, 'r', encoding='utf-8') as f:
    js_content = f.read()

# Replace the scroll listener logic.
# I'll just append a script at the bottom that overrides the scroll listener safely.

js_scrollback = """
// ── Scrollback Sticky Logic ──────────────────────
document.addEventListener('DOMContentLoaded', function () {
    var header = document.getElementById('faNavbar');
    if (!header) return;

    var lastScroll = window.pageYOffset || document.documentElement.scrollTop;
    var threshold = 200; // start hiding after 200px

    window.addEventListener('scroll', function () {
        var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > threshold) {
            // We are scrolled down past the hero
            if (currentScroll > lastScroll) {
                // Scrolling DOWN
                header.classList.remove('nav-sticky');
                header.classList.add('nav-hidden');
            } else {
                // Scrolling UP
                header.classList.remove('nav-hidden');
                header.classList.add('nav-sticky');
            }
        } else {
            // Top of the page
            header.classList.remove('nav-sticky', 'nav-hidden');
        }

        lastScroll = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
    }, { passive: true });
});
"""

# We must ensure we don't append it multiple times if run twice.
if "// ── Scrollback Sticky Logic ──────────────────────" not in js_content:
    with open(js_path, 'a', encoding='utf-8') as f:
        f.write("\n" + js_scrollback)
    print("Added scrollback JS")
else:
    print("Scrollback JS already present")
