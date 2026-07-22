import re

nav_path = 'e:/xampp/htdocs/attwood/includes/nav.php'
with open(nav_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Insert the <link> before <header>
css_include = '<link rel="stylesheet" href="css/aw-navbar.css?v=<?= time() ?>">\n'
js_include = '\n<script src="js/aw-navbar.js?v=<?= time() ?>"></script>\n'

if 'css/aw-navbar.css' not in content:
    content = content.replace('<!-- ====== MAIN HEADER ====== -->', css_include + '<!-- ====== MAIN HEADER ====== -->')

if 'js/aw-navbar.js' not in content:
    content = content + js_include

with open(nav_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Added CSS and JS includes to nav.php")
