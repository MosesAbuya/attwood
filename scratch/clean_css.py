import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# I will use regex to completely remove everything from "36. NAVBAR PLAYFUL OVERRIDES" up to the end of the file.
# Then I will cleanly append the correct styling.
pattern = re.compile(r'/\* ============================================================\s*36\. NAVBAR PLAYFUL OVERRIDES.*', re.DOTALL)
css_content = pattern.sub('', css_content)

new_styles = """
/* ============================================================
   36. NAVBAR PLAYFUL OVERRIDES (RESTORED MEGA MENU)
   ============================================================ */
.fa-nav-row {
  border-top: none !important;
  background: transparent !important;
  box-shadow: none !important;
}
.fa-nav-row-inner {
  background: transparent !important;
  border-radius: 0 !important;
  box-shadow: none !important;
  border: none !important;
  margin: 0 auto !important; /* reset from pill */
  padding: 0 !important;     /* reset from pill */
  max-width: 1280px !important;
}
.fa-site-header.scrolled .fa-nav-row, .fa-site-header.scrolled .fa-nav-row-inner {
  background: #ffffff !important;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}
.nav-top-link {
  color: #ffffff !important;
  font-weight: 700 !important;
  font-family: 'Inter', sans-serif !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  padding: 20px 15px !important;
}
.fa-site-header.scrolled .nav-top-link {
  color: #333333 !important;
}
.nav-top-link:hover, .fa-mainnav > ul > li:hover > .nav-top-link {
  color: var(--aw-accent-sky) !important;
}
.fa-logo-img-large {
  max-height: 55px !important;
  object-fit: contain;
}
.fa-sticky-logo img {
  max-height: 40px !important;
}

/* Fix Hero Typography Contrast */
.aw-hero-title-sleek {
  color: #ffffff !important;
  text-shadow: 0 2px 10px rgba(0,0,0,0.6) !important;
}
.aw-hero-subtitle-sleek {
  color: #ffffff !important;
  text-shadow: 0 2px 10px rgba(0,0,0,0.6) !important;
}
"""

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content.strip() + "\n" + new_styles)

print("Cleaned and updated attwood-brand.css")
