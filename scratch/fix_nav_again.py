import re

# 1. Scrub nav.php
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

# Update the logo
nav_content = re.sub(r'src="assets/logo/.*?\.png"', 'src="oldattwood/img/logo.png"', nav_content)

with open(nav_path, 'w', encoding='utf-8') as f:
    f.write(nav_content)

print("Scrubbed nav.php")

# 2. Fix attwood-brand.css
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Remove the red text colors from nav links and aw-sleek-header stuff
# We can just change all instances of color: var(--aw-primary) to color: #fff or dark depending on context.
# But let's specifically target the red text rules.

# The user said "do not use red as a font color for text anywhere in the website. Maybe only in some headings."
# Let's replace 'color: var(--aw-primary) !important;' with 'color: var(--aw-text-dark) !important;' where it applies to navs.
css_content = css_content.replace('color: var(--aw-primary) !important;', 'color: var(--aw-text-dark); /* removed red */')

# But for nav-top-link specifically, make it white when over hero
css_content += """
/* Navbar specific restyling */
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
}
.fa-site-header.scrolled .fa-nav-row, .fa-site-header.scrolled .fa-nav-row-inner {
  background: #fff !important;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}
.nav-top-link {
  color: #fff !important;
  font-weight: 700 !important;
  font-family: 'Inter', sans-serif !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
}
.fa-site-header.scrolled .nav-top-link {
  color: #333 !important;
}
.fa-logo-img-large {
  max-height: 60px !important;
  object-fit: contain;
}
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
    f.write(css_content)

print("Updated CSS")

# 3. Make sure the Hero text uses sleek classes properly in index.php
index_path = 'e:/xampp/htdocs/attwood/index.php'
with open(index_path, 'r', encoding='utf-8') as f:
    index_content = f.read()

# Make sure the search inputs use white text
index_content = index_content.replace('placeholder="Search Destination"', 'placeholder="Search Destination" style="color:#fff;"')
index_content = index_content.replace('placeholder="Travel Dates"', 'placeholder="Travel Dates" style="color:#fff;"')
index_content = index_content.replace('placeholder="Travel Type"', 'placeholder="Travel Type" style="color:#fff;"')
index_content = index_content.replace('placeholder="Guests"', 'placeholder="Guests" style="color:#fff;"')

with open(index_path, 'w', encoding='utf-8') as f:
    f.write(index_content)
    
print("Updated index.php")
