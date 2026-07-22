import os

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'a', encoding='utf-8') as f:
    f.write("""
/* ============================================================
   36. NAVBAR PLAYFUL OVERRIDES
   ============================================================ */
.fa-nav-row {
  border-top: none !important;
  background: transparent !important;
  box-shadow: none !important;
}
.fa-nav-row-inner {
  background: rgba(255, 255, 255, 0.95) !important;
  border-radius: 50px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
  margin: 10px auto !important;
  padding: 0 30px !important;
  max-width: 1200px !important;
  border: 2px solid var(--aw-primary) !important;
  transition: all 0.3s ease;
}
.fa-site-header.scrolled .fa-nav-row {
  background: transparent !important;
  box-shadow: none !important;
  border-top-color: transparent !important;
}
.fa-site-header.scrolled .fa-nav-row-inner {
  margin: 15px auto !important;
  background: var(--aw-white) !important;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
}
.nav-top-link {
  font-family: var(--aw-font-body) !important;
  font-weight: 800 !important;
  color: var(--aw-text-dark) !important;
  text-transform: uppercase !important;
  letter-spacing: 0.05em !important;
  padding: 20px 15px !important;
}
.nav-top-link:hover, .fa-mainnav > ul > li:hover > .nav-top-link {
  color: var(--aw-primary) !important;
}
.fa-megamenu {
  border-radius: 20px !important;
  border: 3px dashed var(--aw-primary) !important;
  box-shadow: 0 20px 50px rgba(0,0,0,0.2) !important;
  margin-top: 25px !important;
}
.fa-mm-tabs .mm-heading {
  font-family: var(--aw-font-playful) !important;
  color: var(--aw-primary) !important;
  font-size: 28px !important;
  text-transform: none !important;
  border-bottom: 2px dashed var(--aw-accent-gold);
}
.fa-mm-tabs ul li.mm-active a {
  background: var(--aw-primary) !important;
  color: var(--aw-white) !important;
  border-radius: 10px !important;
  font-weight: 700 !important;
}
.mm-links-col h4 {
  font-family: var(--aw-font-display) !important;
  font-size: 24px !important;
  font-weight: 700 !important;
  color: var(--aw-accent-sky) !important;
}
.mm-links-col ul li a {
  font-family: var(--aw-font-body) !important;
  font-weight: 600 !important;
  color: var(--aw-text-muted) !important;
}
.mm-links-col ul li a:hover {
  color: var(--aw-primary) !important;
  transform: translateX(5px);
}
.fa-sticky-logo img {
  height: 40px !important; 
}
""")

print("Appended nav styles")
