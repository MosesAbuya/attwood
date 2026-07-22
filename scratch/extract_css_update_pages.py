import re

index_path = 'e:/xampp/htdocs/attwood/index.php'
with open(index_path, 'r', encoding='utf-8') as f:
    index_content = f.read()

# Extract <style> block from index.php
match = re.search(r'<style>(.*?)</style>', index_content, re.DOTALL)
if match:
    css_content = match.group(1)
    # Remove from index.php
    index_content = index_content[:match.start()] + index_content[match.end():]
    with open(index_path, 'w', encoding='utf-8') as f:
        f.write(index_content)
        
    # Append to attwood-brand.css
    css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n/* Extracted from index.php */\n" + css_content)
    print("Extracted CSS and appended to attwood-brand.css")
else:
    print("Could not find <style> block in index.php")

# Now update tours.php HTML
tours_path = 'e:/xampp/htdocs/attwood/tours.php'
with open(tours_path, 'r', encoding='utf-8') as f:
    tours_content = f.read()

# The old card has <div class="fa-tour-card w-100">
# The new aw-tour-card HTML:
# <div class="aw-tour-card w-100">
#   <div class="aw-tour-img-wrap">
#     <img src="..." ...>
#     <div class="aw-tour-badge-featured">Featured</div>
#   </div>
#   <div class="aw-tour-body">...
# Replace fa-tour-card to aw-tour-card
tours_content = tours_content.replace('fa-tour-card', 'aw-tour-card')
tours_content = tours_content.replace('tc-image-wrap', 'aw-tour-img-wrap')
tours_content = tours_content.replace('tc-image', 'aw-tour-img')
tours_content = tours_content.replace('tc-body', 'aw-tour-body')
tours_content = tours_content.replace('tc-country', 'aw-tour-country')
tours_content = tours_content.replace('tc-title', 'aw-tour-title')
tours_content = tours_content.replace('tc-excerpt', 'aw-tour-excerpt')
tours_content = tours_content.replace('tc-footer', 'aw-tour-footer')
tours_content = tours_content.replace('tc-price', 'aw-tour-price')
tours_content = tours_content.replace('tc-cta', 'aw-btn-sky')
tours_content = tours_content.replace('price-val', 'aw-price-val')

with open(tours_path, 'w', encoding='utf-8') as f:
    f.write(tours_content)

print("Updated tours.php")

# Destinations
dest_path = 'e:/xampp/htdocs/attwood/destinations.php'
with open(dest_path, 'r', encoding='utf-8') as f:
    dest_content = f.read()

# Replace classes
dest_content = dest_content.replace('fa-dest-card', 'aw-dest-card')
dest_content = dest_content.replace('dc-image-wrap', 'aw-dest-img-box')
dest_content = dest_content.replace('dc-image', '')
dest_content = dest_content.replace('dc-title', 'aw-dest-country')

with open(dest_path, 'w', encoding='utf-8') as f:
    f.write(dest_content)

print("Updated destinations.php")
