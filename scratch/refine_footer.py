import re

# 1. Update footer.php
footer_path = 'e:/xampp/htdocs/attwood/includes/footer.php'
with open(footer_path, 'r', encoding='utf-8') as f:
    footer_content = f.read()

# Change contact block to flex-column
footer_content = footer_content.replace('d-flex gap-4 mt-4 aw-contact-block', 'd-flex flex-column gap-3 mt-4 aw-contact-block')

# Add class to link columns for borders
footer_content = footer_content.replace('<div class="col-6 col-md-4 mb-4">', '<div class="col-6 col-md-4 mb-4 aw-footer-links-col">')
# The third column is col-12 col-md-4 mb-4
footer_content = footer_content.replace('<div class="col-12 col-md-4 mb-4">', '<div class="col-12 col-md-4 mb-4 aw-footer-links-col">')

with open(footer_path, 'w', encoding='utf-8') as f:
    f.write(footer_content)

# 2. Update CSS
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Make newsletter layer have glow, bigger border radius, and negative top margin
css_content = css_content.replace(
    'padding: 80px 20px 200px 20px; /* huge bottom padding to make room for banner */\n  position: relative;',
    'padding: 80px 20px 200px 20px;\n  position: relative;\n  border-radius: 60px 60px 0 0;\n  margin-top: -60px;\n  z-index: 100;\n  box-shadow: 0 -20px 50px rgba(0,0,0,0.4);'
)

# Overlay needs border-radius inherited
css_content = css_content.replace(
    '.aw-footer-newsletter-layer {\n  /* Background image set inline in HTML */',
    '.aw-footer-newsletter-layer {\n  /* Background image set inline in HTML */'
)
# Actually, the overlay is defined inline in HTML, but I can add css for it:
css_content += "\n.aw-footer-newsletter-layer .aw-footer-newsletter-overlay { border-radius: 60px 60px 0 0; }\n"

# Set column heading color to yellow
css_content = css_content.replace(
    'color: rgba(255,255,255,0.4);\n  font-size: 12px;\n  font-weight: 500;\n  margin-bottom: 25px;',
    'color: var(--aw-accent-gold);\n  font-size: 14px;\n  font-weight: 600;\n  margin-bottom: 25px;\n  text-transform: uppercase;\n  letter-spacing: 1px;'
)

# Add dividers to columns
divider_css = """
/* Footer link column dividers */
@media (min-width: 768px) {
  .aw-footer-links-col {
    border-right: 1px solid rgba(255,255,255,0.15);
    padding-left: 15px;
  }
  .aw-footer-links-col:last-child {
    border-right: none;
  }
}
@media (max-width: 767px) {
  .aw-footer-links-col {
    border-bottom: 1px solid rgba(255,255,255,0.15);
    padding-bottom: 15px;
    margin-bottom: 15px;
  }
  .aw-footer-links-col:last-child {
    border-bottom: none;
  }
}
"""
css_content += divider_css

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Footer refined successfully")
