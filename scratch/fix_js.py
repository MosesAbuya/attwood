import os
import re

js_files = [
    'e:/xampp/htdocs/attwood/assets/js/attwood-nav.js',
    'e:/xampp/htdocs/attwood/js/start-planning.js',
    'e:/xampp/htdocs/attwood/js/main.js'
]

def preserve_case_replace(match):
    text = match.group(0)
    if text == 'Filao': return 'Attwood'
    if text == 'filao': return 'attwood'
    if text == 'FILAO': return 'ATTWOOD'
    return 'Attwood'

for filepath in js_files:
    if os.path.exists(filepath):
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
        
        orig_content = content
        
        content = content.replace('Filao Adventures', 'Attwood Travel Agency Ltd')
        content = re.sub(r'\bFilao\b', preserve_case_replace, content)
        content = re.sub(r'\bfilao\b', preserve_case_replace, content)
        
        css_replacements = {
            'fa-nav': 'aw-nav',
            'fa-header': 'aw-header',
            'fa-dropdown': 'aw-dropdown',
            'fa-mobile': 'aw-mobile',
            'fa-desktop': 'aw-desktop',
            'fa-nav-scrolled': 'aw-nav-scrolled'
        }
        for old, new in css_replacements.items():
            content = content.replace(old, new)
            
        if orig_content != content:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Fixed JS in {filepath}")

print("JS fix complete.")
