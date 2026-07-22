import os
import re
import random

root_dir = 'e:/xampp/htdocs/attwood'
exclude_dirs = ['oldattwood', 'admin', 'scratch', 'vendor', '.git']

hero_images = [
    'oldattwood/img/slider/slide1.jpg',
    'oldattwood/img/slider/slide4.jpg',
    'oldattwood/img/slider/slide5.jpg',
    'oldattwood/img/slider/slide6.jpg',
    'oldattwood/img/slider/slide7.jpg',
    'oldattwood/img/slider/slide8.jpg',
    'oldattwood/img/slider/slider-1.jpg',
]

content_images = [
    'oldattwood/img/safa.jpg',
    'oldattwood/img/safaris.jpg',
    'oldattwood/img/about-head-img.jpg',
    'oldattwood/img/beach.jpg',
    'oldattwood/img/team.jpg',
    'oldattwood/img/group.jpg',
    'oldattwood/img/front.jpg',
]

def replace_hero(match):
    return random.choice(hero_images)

def replace_content(match):
    return random.choice(content_images)

for root, dirs, files in os.walk(root_dir):
    dirs[:] = [d for d in dirs if d not in exclude_dirs]
    for file in files:
        if file.endswith('.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()
            
            orig_content = content
            
            # Find backgrounds: url('images/Attwood/...')
            content = re.sub(r"url\(['\"]?images/Attwood/[^'\")]*['\"]?\)", lambda m: f"url('{replace_hero(m)}')", content)
            
            # Find img src: src="images/Attwood/..."
            content = re.sub(r'src=["\']images/Attwood/[^"\']*["\']', lambda m: f'src="{replace_content(m)}"', content)
            
            if orig_content != content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f"Fixed images in {file}")

print("Image fix complete.")
