import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

hero_styles = """
/* ============================================================
   37. SLEEK HERO SECTION (RESTORED)
   ============================================================ */
/* Hero Section */
.aw-hero-sleek {
  position: relative;
  height: 100vh;
  min-height: 700px;
  width: 100%;
  overflow: hidden;
}
.aw-hero-bg {
  position: absolute; inset: 0;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  transform: scale(1.05);
}
.aw-hero-overlay-sleek {
  position: absolute; inset: 0;
  background: linear-gradient(to bottom, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.1) 50%, rgba(0,0,0,0.6) 100%);
}
.aw-hero-title-sleek {
  font-family: 'Inter', sans-serif;
  font-weight: 500;
  font-size: clamp(40px, 5vw, 65px);
  color: #fff !important;
  line-height: 1.1;
  letter-spacing: -0.02em;
  text-shadow: 0 2px 10px rgba(0,0,0,0.6) !important;
}
.aw-hero-subtitle-sleek {
  font-family: 'Inter', sans-serif;
  font-size: clamp(14px, 1.5vw, 16px);
  color: rgba(255,255,255,0.95) !important;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
  text-shadow: 0 2px 10px rgba(0,0,0,0.6) !important;
}

/* Glassmorphic Search Bar */
.aw-hero-search-glass {
  background: rgba(25, 25, 25, 0.35);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 50px;
  padding: 8px 15px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}
.aw-hero-search-glass form {
  margin: 0;
}
.aw-hero-search-glass .search-field {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 20px;
  border-right: 1px solid rgba(255,255,255,0.15);
}
.aw-hero-search-glass .search-field.border-0 {
  border-right: none;
}
.aw-hero-search-glass .search-field input {
  background: transparent;
  border: none;
  outline: none;
  color: #fff !important;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  font-weight: 500;
  width: 100%;
}
.aw-hero-search-glass .search-field input::placeholder {
  color: rgba(255,255,255,0.8);
}
.aw-hero-search-glass .search-field i {
  color: rgba(255,255,255,0.8);
  font-size: 12px;
}
.aw-btn-explore {
  background: #fff;
  color: #000;
  border: none;
  padding: 12px 30px;
  border-radius: 30px;
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 14px;
  transition: all 0.3s;
}
.aw-btn-explore:hover {
  background: var(--aw-accent-sky);
  color: #fff;
}

/* Socials & Scroll */
.aw-hero-socials a {
  display: flex; align-items: center; justify-content: center;
  width: 40px; height: 40px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(5px);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.2);
  transition: all 0.3s;
  text-decoration: none;
}
.aw-hero-socials a:hover {
  background: #fff;
  color: #000;
  transform: translateY(-3px);
}
"""

if "37. SLEEK HERO SECTION" not in css_content:
    css_content += "\n" + hero_styles

# Now for the Navbar styles
# I need to explicitly make fa-logo-row visible, center the logo, and style the links below it.
nav_styles = """
/* ============================================================
   38. CENTERED NAVBAR (MEGA MENU RETAINED)
   ============================================================ */
/* Header background transparent over hero */
.fa-site-header {
  position: absolute;
  top: 0; left: 0; width: 100%;
  z-index: 1000;
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
  transition: all 0.3s ease;
}

/* Row 1: Logo and Contacts */
.fa-logo-row {
  padding: 15px 0 !important;
  border-bottom: 1px solid rgba(255,255,255,0.1) !important;
  background: transparent !important;
}
.fa-site-header.scrolled .fa-logo-row {
  display: none !important; /* Hide top row on scroll */
}

/* Make sure logo is centered */
.fa-logo-centered-link {
  display: block;
  text-align: center;
}
.fa-logo-img-large {
  max-height: 80px !important;
  object-fit: contain;
  transition: all 0.3s ease;
}

/* Row 2: Navigation Links */
.fa-nav-row {
  background: transparent !important;
  border: none !important;
  box-shadow: none !important;
}
.fa-nav-row-inner {
  display: flex;
  justify-content: center !important;
  align-items: center;
  background: transparent !important;
  margin: 0 auto !important;
  padding: 0 !important;
  box-shadow: none !important;
  border: none !important;
}

/* Scrolled State for Row 2 */
.fa-site-header.scrolled {
  position: fixed;
  background: #ffffff !important;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}
.fa-site-header.scrolled .fa-nav-row-inner {
  justify-content: space-between !important; /* On scroll, logo appears on left, links right */
  padding: 0 30px !important;
}

/* Links Styling */
.fa-mainnav {
  display: flex;
  justify-content: center;
  width: 100%;
}
.fa-site-header.scrolled .fa-mainnav {
  justify-content: flex-end;
}
.fa-subnav-inner {
  display: flex;
  justify-content: center;
  gap: 20px;
  list-style: none;
  margin: 0; padding: 0;
}
.nav-top-link {
  color: #ffffff !important;
  font-weight: 600 !important;
  font-family: 'Inter', sans-serif !important;
  font-size: 14px !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  padding: 25px 10px !important;
  display: block;
  transition: color 0.3s ease;
}
.fa-site-header.scrolled .nav-top-link {
  color: #333333 !important;
  padding: 20px 10px !important;
}
.nav-top-link:hover, .fa-mainnav > ul > li:hover > .nav-top-link {
  color: var(--aw-accent-sky) !important;
}

/* Hide the sticky logo initially, show on scroll */
.fa-sticky-logo {
  display: none !important;
  align-items: center;
}
.fa-sticky-logo img {
  max-height: 50px !important;
}
.fa-site-header.scrolled .fa-sticky-logo {
  display: flex !important;
}

/* Overriding the default filao-theme.css layout bugs */
.fa-site-header .container {
  max-width: 1400px !important;
}
/* Ensure the action buttons (Start Planning, Search) match the theme */
.fa-nav-actions {
  display: none !important; /* Hide old nav actions if they clash, or restyle them */
}
"""

if "38. CENTERED NAVBAR" not in css_content:
    css_content += "\n" + nav_styles

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content)

print("Restored hero CSS and centered the navbar")
