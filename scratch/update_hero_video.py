import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Make the title bolder
css_content = re.sub(
    r'\.aw-hero-title-sleek\s*\{[^}]*font-weight:\s*500;([^}]*)\}',
    r'.aw-hero-title-sleek {\1 font-weight: 700; }',
    css_content
)
# Ensure we got it (if previous sub didn't match perfectly, let's just do a manual replace)
css_content = css_content.replace(
    ".aw-hero-title-sleek {\n  font-family: 'Inter', sans-serif;\n  font-weight: 500;",
    ".aw-hero-title-sleek {\n  font-family: 'Inter', sans-serif;\n  font-weight: 700;"
)

# Add container and video, and animation to bg
new_styles = """
.aw-hero-bg-container {
  position: absolute;
  inset: 0;
  overflow: hidden;
  z-index: 1;
}

.aw-hero-bg, .aw-hero-video {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  animation: heroZoom 30s ease-in-out infinite alternate;
}

.aw-hero-bg {
  background-size: cover;
  background-position: center;
  z-index: 1;
}

.aw-hero-video {
  z-index: 2;
}

@keyframes heroZoom {
  0% { transform: scale(1); }
  100% { transform: scale(1.15); }
}

.aw-hero-overlay-sleek {
  z-index: 2 !important;
}
"""

if "heroZoom" not in css_content:
    # We need to replace the old .aw-hero-bg definition if it exists
    css_content = re.sub(r'\.aw-hero-bg\s*\{[^}]*\}', '', css_content)
    # Insert new styles right before .aw-hero-overlay-sleek
    css_content = css_content.replace('.aw-hero-overlay-sleek {', new_styles + '\n.aw-hero-overlay-sleek {')
    
with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Updated attwood-brand.css with video and zoom animation")
