import re

css_path = 'e:/xampp/htdocs/attwood/css/aw-navbar.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# 1. Replace the hover trigger with a class-based trigger
css_content = css_content.replace(
    '.aw-nav-item.aw-has-megamenu:hover .aw-mega-menu {',
    '.aw-nav-item.aw-has-megamenu.active .aw-mega-menu {'
)

# Also let's fix the dropdown hover triggers (if any still exist)
css_content = css_content.replace(
    '.aw-nav-item:hover .aw-dropdown-menu {',
    '.aw-nav-item.active .aw-dropdown-menu {'
)

# 2. Add styles for visual cards
visual_css = """
/* ==========================================================================
   MEGA MENU VISUAL GRIDS
   ========================================================================== */
.aw-mega-visual .aw-mega-menu-inner {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 30px;
}

.aw-visual-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
}

.aw-grid-small {
  grid-template-columns: 1fr; /* For tours, maybe 1 per row or 2 per row depending on space */
}

.aw-visual-card {
  display: flex;
  flex-direction: column;
  gap: 8px;
  text-decoration: none !important;
  group: visual;
  transition: transform 0.2s;
}

.aw-visual-card:hover {
  transform: translateY(-3px);
}

.aw-card-img {
  width: 100%;
  height: 80px;
  background-size: cover;
  background-position: center;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  transition: box-shadow 0.2s;
}

.aw-visual-card:hover .aw-card-img {
  box-shadow: 0 8px 20px rgba(0, 174, 239, 0.3);
}

.aw-card-title {
  font-size: 13px;
  font-weight: 600;
  color: #444;
  line-height: 1.3;
  transition: color 0.2s;
}

.aw-visual-card:hover .aw-card-title {
  color: #00AEEF;
}

.aw-mega-footer {
  margin-top: 30px;
  padding-top: 20px;
  border-top: 1px solid rgba(0,0,0,0.05);
  display: flex;
  justify-content: flex-end;
}

.aw-btn-small {
  padding: 8px 16px;
  font-size: 12px;
  border-radius: 30px;
}
"""

if "MEGA MENU VISUAL GRIDS" not in css_content:
    css_content += "\n" + visual_css

# 3. Ensure fullpage close is clickable
if ".aw-fullpage-close {" in css_content:
    # Just in case, add z-index to it
    css_content = css_content.replace(
        '.aw-fullpage-close {',
        '.aw-fullpage-close {\n  z-index: 10000;\n  pointer-events: auto;'
    )

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Updated aw-navbar.css with visual grid styles and click logic")
