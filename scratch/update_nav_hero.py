import re

# 1. Update nav.php HTML
nav_path = 'e:/xampp/htdocs/attwood/includes/nav.php'
with open(nav_path, 'r', encoding='utf-8') as f:
    nav_content = f.read()

# We want to keep everything up to the <!-- ====== MAIN HEADER ====== -->
header_split = nav_content.split('<!-- ====== MAIN HEADER ====== -->')
nav_php_logic = header_split[0]

# Now we define the new sleek single row navbar
new_nav_html = """<!-- ====== MAIN HEADER ====== -->
<header class="aw-sleek-header" id="awNavbar">
  <div class="container-fluid px-4 px-lg-5">
    <div class="aw-sleek-nav-inner d-flex justify-content-between align-items-center">
      
      <!-- Left: Logo -->
      <a href="/" class="aw-sleek-logo">
        <img src="oldattwood/img/logo.png" alt="Attwood Travel Agency Ltd" style="max-height: 50px;">
      </a>

      <!-- Center: Nav Links -->
      <nav class="aw-sleek-mainnav d-none d-lg-block">
        <ul class="d-flex list-unstyled mb-0 gap-4">
          <li><a href="index">Home</a></li>
          <li><a href="about">About</a></li>
          <li class="has-dropdown">
            <a href="destinations">Destination <i class="fa fa-angle-down ml-1"></i></a>
            <!-- Keep a simple dropdown instead of the massive mega menu for the sleek look -->
            <ul class="sleek-dropdown list-unstyled">
              <li><a href="tours">All Tours</a></li>
              <li><a href="safaris">Safaris</a></li>
              <li><a href="destinations">All Destinations</a></li>
            </ul>
          </li>
          <li class="has-dropdown">
            <a href="#">Pages <i class="fa fa-angle-down ml-1"></i></a>
            <ul class="sleek-dropdown list-unstyled">
              <li><a href="blog">Blog</a></li>
              <li><a href="activities">Activities</a></li>
              <li><a href="sustainable-tourism">Sustainable Tourism</a></li>
            </ul>
          </li>
          <li><a href="contact">Contact Us</a></li>
        </ul>
      </nav>

      <!-- Right: Button -->
      <div class="aw-sleek-right d-none d-lg-flex">
        <a href="contact" class="aw-btn-schedule">Schedule Now</a>
      </div>
      
      <!-- Mobile Toggle -->
      <div class="d-lg-none">
        <button id="aw-mobile-toggle" class="btn btn-link text-white"><i class="fa fa-bars fa-2x"></i></button>
      </div>
      
    </div>
  </div>
</header>
"""

with open(nav_path, 'w', encoding='utf-8') as f:
    f.write(nav_php_logic + new_nav_html)

print("Updated nav.php")

# 2. Update index.php hero section
index_path = 'e:/xampp/htdocs/attwood/index.php'
with open(index_path, 'r', encoding='utf-8') as f:
    index_content = f.read()

# Replace the old hero with the new one.
# Find the start and end of the hero section.
hero_pattern = re.compile(r'<!-- ====== HERO ====== -->.*?<!-- ====== INTRO CARDS ====== -->', re.DOTALL)

new_hero_html = """<!-- ====== HERO ====== -->
<section class="aw-hero-sleek">
  <!-- Background Image -->
  <div class="aw-hero-bg" style="background-image: url('oldattwood/img/slider/slide1.jpg');"></div>
  <div class="aw-hero-overlay-sleek"></div>

  <!-- Content -->
  <div class="container h-100 position-relative z-index-2">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-12 col-md-10 col-lg-8 mt-5">
        <h1 class="aw-hero-title-sleek">Your Next Escape,<br>Perfectly Planned.</h1>
        <p class="aw-hero-subtitle-sleek mt-3">Experience the art of travel through curated destinations and handpicked experiences. Your adventure begins here, refined, effortless, and made just for you.</p>
        
        <!-- Search Bar Container (Glassmorphism) -->
        <div class="aw-hero-search-glass mt-5">
          <form class="d-flex align-items-center flex-wrap flex-md-nowrap w-100" action="tours" method="GET">
            <div class="search-field">
              <input type="text" placeholder="Search Destination">
              <i class="fa fa-angle-down"></i>
            </div>
            <div class="search-field">
              <input type="text" placeholder="Travel Dates">
            </div>
            <div class="search-field">
              <input type="text" placeholder="Travel Type">
              <i class="fa fa-angle-down"></i>
            </div>
            <div class="search-field">
              <input type="text" placeholder="Guests">
              <i class="fa fa-angle-down"></i>
            </div>
            <div class="search-btn-col">
              <button type="submit" class="aw-btn-explore">Explore</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Socials & Scroll Indicator -->
  <div class="aw-hero-bottom-bar px-5 d-flex justify-content-between align-items-end pb-4 position-absolute w-100" style="bottom:0; z-index:2;">
    <div class="aw-hero-socials d-flex gap-3">
      <a href="#"><i class="fa fa-instagram"></i></a>
      <a href="#"><i class="fa fa-youtube-play"></i></a>
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
    </div>
    <div class="aw-hero-scroll text-white" style="font-family:'Inter', sans-serif; font-size:14px; font-weight:600;">
      Step Inside <i class="fa fa-arrow-down ml-2"></i>
    </div>
  </div>
</section>

<!-- ====== INTRO CARDS ====== -->"""

index_content = hero_pattern.sub(new_hero_html, index_content)

with open(index_path, 'w', encoding='utf-8') as f:
    f.write(index_content)

print("Updated index.php")

# 3. Add CSS for the new Navbar and Hero
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'a', encoding='utf-8') as f:
    f.write("""
/* ============================================================
   37. SLEEK NAVBAR & HERO OVERHAUL
   ============================================================ */
/* Header Base */
.aw-sleek-header {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding: 25px 0;
  z-index: 999;
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  background: transparent;
}

/* Sticky on scroll up */
.aw-sleek-header.sticky-scroll-up {
  position: fixed;
  top: 0;
  background: rgba(25, 25, 25, 0.95);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  padding: 15px 0;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  transform: translateY(-100%);
}
.aw-sleek-header.sticky-scroll-up.is-visible {
  transform: translateY(0);
}

/* Nav Links */
.aw-sleek-mainnav ul li a {
  color: #fff;
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.3s;
}
.aw-sleek-mainnav ul li a:hover {
  color: var(--aw-primary);
}
.aw-sleek-mainnav ul li.has-dropdown {
  position: relative;
}
.sleek-dropdown {
  position: absolute;
  top: 150%;
  left: 0;
  background: #fff;
  min-width: 220px;
  padding: 15px 0;
  border-radius: 12px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.15);
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s;
  transform: translateY(10px);
}
.aw-sleek-mainnav ul li.has-dropdown:hover .sleek-dropdown {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
  top: 100%;
}
.sleek-dropdown li a {
  color: #333 !important;
  display: block;
  padding: 8px 25px;
  font-size: 14px;
}
.sleek-dropdown li a:hover {
  background: #f8f9fa;
  color: var(--aw-primary) !important;
}

/* Schedule Button */
.aw-btn-schedule {
  background: transparent;
  color: #fff;
  border: 1px solid rgba(255,255,255,0.4);
  padding: 10px 24px;
  border-radius: 30px;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s;
}
.aw-btn-schedule:hover {
  background: #fff;
  color: #000;
}

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
  transform: scale(1.05); /* Slight zoom for effect */
}
.aw-hero-overlay-sleek {
  position: absolute; inset: 0;
  background: linear-gradient(to bottom, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.1) 50%, rgba(0,0,0,0.6) 100%);
}
.aw-hero-title-sleek {
  font-family: 'Inter', sans-serif;
  font-weight: 500;
  font-size: clamp(40px, 5vw, 65px);
  color: #fff;
  line-height: 1.1;
  letter-spacing: -0.02em;
}
.aw-hero-subtitle-sleek {
  font-family: 'Inter', sans-serif;
  font-size: clamp(14px, 1.5vw, 16px);
  color: rgba(255,255,255,0.85);
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
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
.aw-hero-search-glass .search-field {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 20px;
  border-right: 1px solid rgba(255,255,255,0.15);
}
.aw-hero-search-glass .search-field:last-of-type {
  border-right: none;
}
.aw-hero-search-glass .search-field input {
  background: transparent;
  border: none;
  outline: none;
  color: #fff;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  font-weight: 500;
  width: 100%;
}
.aw-hero-search-glass .search-field input::placeholder {
  color: rgba(255,255,255,0.7);
}
.aw-hero-search-glass .search-field i {
  color: rgba(255,255,255,0.7);
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
  background: var(--aw-primary);
  color: #fff;
}

/* Socials */
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
""")

print("Updated CSS")

# 4. Add JS for the sticky on scroll up behavior
js_path = 'e:/xampp/htdocs/attwood/assets/js/attwood-nav.js'
with open(js_path, 'a', encoding='utf-8') as f:
    f.write("""
// Sticky Header on Scroll Up
let lastScrollTop = 0;
const header = document.getElementById('awNavbar');

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // If scrolled past hero section (approx 200px)
    if (scrollTop > 200) {
        header.classList.add('sticky-scroll-up');
        
        if (scrollTop < lastScrollTop) {
            // Scrolling up
            header.classList.add('is-visible');
        } else {
            // Scrolling down
            header.classList.remove('is-visible');
        }
    } else {
        // At the top
        header.classList.remove('sticky-scroll-up', 'is-visible');
    }
    
    lastScrollTop = scrollTop;
});
""")

print("Updated JS")
