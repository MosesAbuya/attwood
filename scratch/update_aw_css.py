import re

css_path = 'e:/xampp/htdocs/attwood/css/aw-navbar.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Add mega menu and fullpage styles
new_css = """
/* ==========================================================================
   MEGA MENU STYLES
   ========================================================================== */
.aw-mega-menu {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%) translateY(15px);
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.15);
  padding: 30px;
  width: 900px;
  max-width: 90vw;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
  z-index: 100;
  border: 1px solid rgba(0,0,0,0.05);
  pointer-events: none;
}

.aw-nav-item.aw-has-megamenu:hover .aw-mega-menu {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(0);
  pointer-events: auto;
}

.aw-mega-menu-inner {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 30px;
}

.aw-mega-column {
  display: flex;
  flex-direction: column;
}

.aw-mega-title {
  font-size: 16px;
  font-weight: 700;
  text-transform: uppercase;
  color: #111;
  border-bottom: 2px solid rgba(0, 174, 239, 0.2);
  padding-bottom: 10px;
  margin-bottom: 15px;
}

.aw-mega-title a {
  color: inherit;
  text-decoration: none;
  transition: color 0.2s;
}
.aw-mega-title a:hover {
  color: #00AEEF;
}

.aw-mega-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.aw-mega-list li a {
  color: #555;
  text-decoration: none;
  font-size: 14px;
  transition: all 0.2s ease;
  display: block;
}

.aw-mega-list li a:hover {
  color: #00AEEF;
  transform: translateX(5px);
}

/* ==========================================================================
   FULL PAGE OVERLAY MENU
   ========================================================================== */
.aw-fullpage-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(15, 15, 15, 0.95);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  z-index: 9999;
  opacity: 0;
  visibility: hidden;
  transition: all 0.4s cubic-bezier(0.77, 0, 0.175, 1);
  display: flex;
  align-items: center;
  justify-content: center;
}

.aw-fullpage-overlay.active {
  opacity: 1;
  visibility: visible;
}

.aw-fullpage-close {
  position: absolute;
  top: 40px;
  right: 50px;
  font-size: 36px;
  color: #fff;
  cursor: pointer;
  transition: transform 0.3s ease, color 0.3s ease;
}

.aw-fullpage-close:hover {
  transform: rotate(90deg);
  color: #00AEEF;
}

.aw-fullpage-content {
  width: 100%;
  max-width: 1200px;
  padding: 0 40px;
  transform: translateY(30px);
  transition: transform 0.4s ease 0.1s;
}

.aw-fullpage-overlay.active .aw-fullpage-content {
  transform: translateY(0);
}

.aw-fp-title {
  color: #00AEEF;
  font-size: 18px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  margin-bottom: 25px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding-bottom: 15px;
}

.aw-fp-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.aw-fp-list li a {
  color: #fff;
  text-decoration: none;
  font-size: 20px;
  font-weight: 500;
  transition: all 0.2s ease;
  display: inline-block;
}

.aw-fp-list li a:hover {
  color: #00AEEF;
  transform: translateX(10px);
}

.aw-fp-socials {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 15px;
}

.aw-fp-socials a {
  color: #fff;
  font-size: 24px;
  transition: color 0.2s, transform 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: rgba(255,255,255,0.05);
}

.aw-fp-socials a:hover {
  color: #00AEEF;
  background: rgba(0, 174, 239, 0.1);
  transform: translateY(-3px);
}

/* Ensure body doesn't scroll when overlay is open */
body.aw-fp-noscroll {
  overflow: hidden;
}
"""

if "MEGA MENU STYLES" not in css_content:
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n" + new_css)
    print("Added Mega Menu and Fullpage Overlay styles")
else:
    print("Mega Menu styles already exist")
