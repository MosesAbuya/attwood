import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Make sure we don't hide .fa-nav-actions, let's keep them!
css_content = css_content.replace('.fa-nav-actions {\n  display: none !important; /* Hide old nav actions if they clash, or restyle them */\n}', '')

# Ensure logo scales down slightly on scroll
css_content += """
.fa-site-header.scrolled .aw-center-logo-img {
    max-height: 55px !important;
}
.fa-site-header.scrolled .nav-logo-center {
    padding: 0 20px !important;
}
"""

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Fixed CSS for nav actions")
