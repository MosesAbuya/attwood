import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Replace solid white background with frosted glass
css_content = css_content.replace('background: #ffffff !important;\n  border-radius: 50px !important;', 'background: rgba(255, 255, 255, 0.2) !important;\n  backdrop-filter: blur(15px);\n  -webkit-backdrop-filter: blur(15px);\n  border-radius: 50px !important;')

# When sticky, make it solid or slightly frosted white
css_content += """
/* White background when sticky */
.fa-site-header.nav-sticky .fa-nav-row-inner {
  background: rgba(255, 255, 255, 0.95) !important;
  box-shadow: 0 15px 50px rgba(0,0,0,0.15) !important;
  border: 1px solid rgba(255,255,255,0.4) !important;
}

/* Ensure links are white when transparent, dark when sticky */
.fa-nav-row-inner .nav-top-link, 
.fa-nav-row-inner .fa-search-btn, 
.fa-nav-row-inner .fa-menu-open {
  color: #ffffff !important;
}
.fa-site-header.nav-sticky .fa-nav-row-inner .nav-top-link,
.fa-site-header.nav-sticky .fa-nav-row-inner .fa-search-btn,
.fa-site-header.nav-sticky .fa-nav-row-inner .fa-menu-open {
  color: #333333 !important;
}

/* Hover effects */
.fa-nav-row-inner .nav-top-link:hover {
  background: rgba(255,255,255,0.15);
}
.fa-site-header.nav-sticky .fa-nav-row-inner .nav-top-link:hover {
  background: rgba(0,0,0,0.04);
}
"""

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Updated pill to frosted glass")
