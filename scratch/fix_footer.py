import re

# 1. Update footer.php
footer_path = 'e:/xampp/htdocs/attwood/includes/footer.php'
with open(footer_path, 'r', encoding='utf-8') as f:
    footer_content = f.read()

# Fix logo
footer_content = footer_content.replace('assets/logo/attwood-logo.png', 'oldattwood/img/logo.png')
# Fix avatars
footer_content = footer_content.replace('oldattwood/img/team/moses.jpg', 'oldattwood/img/slider/slider-1.jpg')
footer_content = footer_content.replace('oldattwood/img/slider/slide2.jpg', 'oldattwood/img/slider/slider-2.jpg')
footer_content = footer_content.replace('oldattwood/img/slider/slide3.jpg', 'oldattwood/img/slider/slider-3.jpg')

with open(footer_path, 'w', encoding='utf-8') as f:
    f.write(footer_content)

# 2. Update CSS
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Update base layer margin to close gap
css_content = css_content.replace('margin-top: -100px; /* pulls it up under the banner */', 'margin-top: -200px; /* pulls it up under the banner to close the gap */')
css_content = css_content.replace('padding: 160px 20px 40px 20px; /* huge top padding to sit under banner */', 'padding: 260px 20px 40px 20px; /* huge top padding to sit under banner */')

# Update banner title font
css_content = re.sub(
    r'(\.aw-banner-title\s*\{[^}]*)(\})',
    r"\1  font-family: 'Inter', sans-serif !important;\n\2",
    css_content
)

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Footer fixed successfully")
