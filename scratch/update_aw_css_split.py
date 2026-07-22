import re

css_path = 'e:/xampp/htdocs/attwood/css/aw-navbar.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

split_css = """
/* ==========================================================================
   FULL-WIDTH SPLIT-PANE MEGA MENU
   ========================================================================== */
.aw-nav-container {
  position: relative;
}

.aw-nav-item.aw-has-megamenu {
  position: static; /* so absolute children anchor to aw-nav-container */
}

.aw-mega-menu.aw-mega-split {
  position: absolute;
  top: calc(100% + 20px);
  left: 0;
  width: 100%;
  max-width: none;
  transform: translateY(15px);
  padding: 0;
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  height: 500px; /* Fixed height for image alignment */
}

.aw-nav-item.aw-has-megamenu.active .aw-mega-menu.aw-mega-split {
  transform: translateY(0);
}

/* Sidebar */
.aw-mega-sidebar {
  width: 250px;
  background: #f8f5eb;
  padding: 30px 0 0 0;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
}

.aw-sidebar-header {
  font-size: 16px;
  font-weight: 700;
  color: #a43a2c; /* Theme red as per image */
  margin-bottom: 20px;
  padding: 0 30px;
}

.aw-sidebar-list {
  list-style: none;
  padding: 0;
  margin: 0;
  flex-grow: 1;
  overflow-y: auto;
}

.aw-sidebar-list li {
  padding: 12px 30px;
  font-size: 13px;
  font-weight: 600;
  color: #555;
  cursor: pointer;
  border-left: 3px solid transparent;
  transition: all 0.2s;
  text-transform: uppercase;
}

.aw-sidebar-list li:hover {
  background: rgba(255,255,255,0.5);
}

.aw-sidebar-list li.active {
  background: #ffffff;
  color: #b18c4b; /* Gold */
  border-left-color: #b18c4b;
}

.aw-sidebar-footer {
  padding: 20px 30px;
  border-top: 1px solid rgba(0,0,0,0.05);
}

.aw-sidebar-footer a {
  font-size: 12px;
  font-weight: 700;
  color: #777;
  text-decoration: none;
  letter-spacing: 0.05em;
  transition: color 0.2s;
}

.aw-sidebar-footer a:hover {
  color: #b18c4b;
}

/* Middle Content Pane */
.aw-mega-content {
  width: 350px;
  background: #ffffff;
  padding: 30px;
  flex-shrink: 0;
  position: relative;
}

.aw-mega-pane {
  display: none;
  height: 100%;
  overflow-y: auto;
}

.aw-mega-pane.active {
  display: block;
  animation: fadeInPane 0.3s ease forwards;
}

@keyframes fadeInPane {
  from { opacity: 0; transform: translateX(-10px); }
  to { opacity: 1; transform: translateX(0); }
}

.aw-pane-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.aw-pane-links li a {
  color: #333;
  font-size: 14px;
  text-decoration: none;
  display: block;
  transition: color 0.2s;
  line-height: 1.4;
}

.aw-pane-links li a:hover {
  color: #00AEEF;
}

/* Right Image Pane */
.aw-mega-image-container {
  flex-grow: 1;
  position: relative;
  background: #111;
  overflow: hidden;
}

.aw-mega-img-display {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: opacity 0.3s ease;
}

.aw-mega-img-display.fading {
  opacity: 0.7;
}

.aw-mega-caption {
  position: absolute;
  bottom: 30px;
  left: 30px;
  color: #fff;
  font-size: 28px;
  font-style: italic;
  font-family: 'Playfair Display', serif; /* or another elegant font */
  text-shadow: 0 2px 10px rgba(0,0,0,0.5);
  pointer-events: none;
}

.aw-mega-close {
  position: absolute;
  top: 20px;
  right: 20px;
  background: #d8a032; /* Gold */
  color: #fff;
  border: none;
  padding: 8px 16px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.05em;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.2s;
  z-index: 10;
}

.aw-mega-close:hover {
  background: #b88624;
}
"""

if "FULL-WIDTH SPLIT-PANE MEGA MENU" not in css_content:
    css_content += "\n" + split_css
    
    # Let's remove the .aw-mega-visual block so it doesn't conflict
    css_content = re.sub(r'/\* ==+[\s\n]+MEGA MENU VISUAL GRIDS[\s\S]+?(?=/\*|$)', '', css_content)

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Updated aw-navbar.css with full-width split-pane styles")
