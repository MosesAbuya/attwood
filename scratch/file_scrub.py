import os
import re

root_dir = 'e:/xampp/htdocs/attwood'
exclude_dirs = ['oldattwood', 'admin', 'scratch', 'vendor', '.git']

def preserve_case_replace(match):
    text = match.group(0)
    if text == 'Filao': return 'Attwood'
    if text == 'filao': return 'attwood'
    if text == 'FILAO': return 'ATTWOOD'
    return 'Attwood'

for root, dirs, files in os.walk(root_dir):
    dirs[:] = [d for d in dirs if d not in exclude_dirs]
    for file in files:
        if file.endswith('.php') or file.endswith('.css'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()
            
            orig_content = content
            
            # Text replacements
            content = content.replace('Filao Adventures', 'Attwood Travel Agency Ltd')
            content = content.replace('Filao adventures', 'Attwood Travel Agency Ltd')
            
            # Regex for Filao standalone
            content = re.sub(r'\bFilao\b', preserve_case_replace, content)
            content = re.sub(r'\bfilao\b', preserve_case_replace, content)
            content = re.sub(r'\bFILAO\b', preserve_case_replace, content)
            
            # Specific CSS class replacements
            css_replacements = {
                'fa-page-hero': 'aw-page-hero',
                'fa-section-heading': 'aw-section-heading',
                'fa-stats-bar': 'aw-stats-bar',
                'fa-stat-item': 'aw-stat-item',
                'filao-theme.css': 'attwood-theme.css' # we might just remove this link since we use attwood-brand.css
            }
            for old, new in css_replacements.items():
                content = content.replace(old, new)
            
            # Simple image regex: just switch the base path for now, we'll refine manually
            # But let's avoid breaking image links. Actually, let's replace all images/Filao/... with oldattwood/img/safa.jpg
            # as a placeholder, except we can randomize it later if needed.
            # A better way is to just replace 'images/Filao/' with 'oldattwood/img/' but the filenames won't match.
            # I will write a separate image fix step.
            
            if orig_content != content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f"Updated {filepath}")

print("File scrub complete.")
