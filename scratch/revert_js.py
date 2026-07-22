import os

filepath = 'e:/xampp/htdocs/attwood/assets/js/attwood-nav.js'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Revert my previous breaking changes
css_replacements = {
    'aw-nav': 'fa-nav',
    'aw-header': 'fa-header',
    'aw-dropdown': 'fa-dropdown',
    'aw-mobile': 'fa-mobile',
    'aw-desktop': 'fa-desktop',
    'aw-nav-scrolled': 'fa-nav-scrolled'
}
for new, old in css_replacements.items():
    content = content.replace(new, old)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Reverted JS")
