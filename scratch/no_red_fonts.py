import re

css_path = 'e:/xampp/htdocs/attwood/assets/css/attwood-theme.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Replace any explicit red hex or var(--aw-primary) that applies to color
# E.g., color: #ff0000; color: #f00; color: var(--aw-primary);

css_content = re.sub(r'color:\s*#ff0000\b', 'color: #333333', css_content, flags=re.IGNORECASE)
css_content = re.sub(r'color:\s*#f00\b', 'color: #333', css_content, flags=re.IGNORECASE)
css_content = re.sub(r'color:\s*var\(--aw-primary\)', 'color: #333333', css_content, flags=re.IGNORECASE)
css_content = re.sub(r'color:\s*var\(--fa-primary\)', 'color: #333333', css_content, flags=re.IGNORECASE)

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Removed red fonts from attwood-theme.css")
