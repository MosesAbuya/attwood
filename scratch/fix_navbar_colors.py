import os
import re

css_path = 'e:/xampp/htdocs/attwood/css/aw-navbar.css'

with open(css_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

for i, line in enumerate(lines):
    # 1. Navbar Start Planning Button (and search button)
    if '.aw-nav-btn' in lines[i-1] or '.aw-search-bar-inner button' in lines[i-2] or '.aw-search-bar-inner button' in lines[i-1]:
        if 'background: #C49018' in line:
            lines[i] = line.replace('#C49018', '#ff0000') # Red
    # hover states for buttons
    elif '.aw-nav-btn:hover' in lines[i-1] or '.aw-search-bar-inner button:hover' in lines[i-1]:
        if 'background: #C49018' in line:
            lines[i] = line.replace('#C49018', '#e33a1b') # Dark Red
            
    # 2. Hamburger menu title
    elif '.aw-fp-title {' in lines[i-1] or '.aw-fp-title' in lines[i-2]:
        if 'color: #C49018;' in line:
            lines[i] = line.replace('#C49018', '#e9d020') # Yellow
            
    # Hamburger list hover
    elif '.aw-fp-list li a:hover {' in lines[i-1] or '.aw-fp-socials a:hover {' in lines[i-1]:
        if 'color: #C49018;' in line:
            lines[i] = line.replace('#C49018', '#e9d020') # Yellow
            
    # Hamburger hover backgrounds
    if 'rgba(196, 144, 24,' in line and '.aw-fp' in lines[i-1]:
        lines[i] = line.replace('rgba(196, 144, 24,', 'rgba(233, 208, 32,') # Yellow rgba

with open(css_path, 'w', encoding='utf-8') as f:
    f.writelines(lines)

print("Pass 1 done.")

with open(css_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace all remaining #C49018 (mostly mega menu hovers on white bg) with Attwood Blue #02adfa
content = content.replace('#C49018', '#02adfa')
# Replace all remaining rgba(196, 144, 24, (gold) with Attwood Blue rgba(2, 173, 250,
content = content.replace('rgba(196, 144, 24,', 'rgba(2, 173, 250,')

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Pass 2 done.")
