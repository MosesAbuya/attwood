import os

nav_path = 'e:/xampp/htdocs/attwood/includes/nav.php'
with open(nav_path, 'r', encoding='utf-8') as f:
    nav_content = f.read()

# Get PHP logic block (everything before the Google Translate element)
split_marker = '<!-- Hidden Google Translate Element -->'
if split_marker in nav_content:
    php_logic = nav_content.split(split_marker)[0]
else:
    print("Error: Could not find split marker")
    exit(1)

new_html = """<!-- Hidden Google Translate Element -->
<div id="google_translate_element" style="display:none;"></div>

<link rel="stylesheet" href="css/aw-navbar.css?v=<?= time() ?>">
<script src="js/aw-navbar.js?v=<?= time() ?>"></script>

<!-- ====== MAIN HEADER ====== -->
<header class="aw-site-header" id="awNavbar">
  <div class="aw-nav-container">
    
    <!-- Logo -->
    <a href="/" class="aw-logo">
      <img src="oldattwood/img/logo.png" alt="Attwood Travel Agency Ltd">
    </a>

    <!-- Navigation Links -->
    <nav class="aw-main-nav" id="awMainNav">
      <ul class="aw-nav-list">
        
        <li class="aw-nav-item"><a href="about">About</a></li>

        <!-- Destinations Mega Menu (Image Based) -->
        <li class="aw-nav-item aw-has-megamenu">
          <a href="#" class="aw-mega-trigger">Destinations <i class="fa fa-angle-down"></i></a>
          <div class="aw-mega-menu aw-mega-visual">
            <div class="aw-mega-menu-inner">
              <?php foreach ($navRegions as $regionName => $countriesList): ?>
                <div class="aw-mega-column">
                  <h4 class="aw-mega-title"><a href="destinations"><?= htmlspecialchars($regionName) ?></a></h4>
                  <div class="aw-visual-grid">
                    <?php foreach ($countriesList as $c): ?>
                      <a href="destinations/<?= htmlspecialchars($c['country']) ?>" class="aw-visual-card">
                        <div class="aw-card-img" style="background-image: url('admin/<?= htmlspecialchars($c['featured_image'] ?: 'uploads/default-dest.jpg') ?>');"></div>
                        <span class="aw-card-title"><?= htmlspecialchars($c['country']) ?></span>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="aw-mega-footer">
              <a href="destinations" class="aw-btn-primary aw-btn-small">View All Destinations</a>
            </div>
          </div>
        </li>

        <!-- Tours Mega Menu (Image Based) -->
        <li class="aw-nav-item aw-has-megamenu">
          <a href="#" class="aw-mega-trigger">Tours <i class="fa fa-angle-down"></i></a>
          <div class="aw-mega-menu aw-mega-visual">
            <div class="aw-mega-menu-inner">
              <?php foreach ($navToursByCountry as $country => $tours): ?>
                <div class="aw-mega-column">
                  <h4 class="aw-mega-title"><a href="tours?country=<?= urlencode($country) ?>"><?= htmlspecialchars($country) ?></a></h4>
                  <div class="aw-visual-grid aw-grid-small">
                    <?php foreach ($tours as $t): ?>
                      <a href="tour/<?= htmlspecialchars($t['slug']) ?>" class="aw-visual-card">
                        <div class="aw-card-img" style="background-image: url('admin/<?= htmlspecialchars($t['featured_image'] ?: 'uploads/default-tour.jpg') ?>');"></div>
                        <span class="aw-card-title"><?= htmlspecialchars($t['title']) ?></span>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="aw-mega-footer">
              <a href="tours" class="aw-btn-primary aw-btn-small">View All Tours</a>
            </div>
          </div>
        </li>

        <!-- Activities Mega Menu (Image Based) -->
        <li class="aw-nav-item aw-has-megamenu">
          <a href="#" class="aw-mega-trigger">Activities <i class="fa fa-angle-down"></i></a>
          <div class="aw-mega-menu aw-mega-visual">
            <div class="aw-mega-menu-inner">
              <?php foreach ($navActByCategory as $category => $acts): ?>
                <div class="aw-mega-column">
                  <h4 class="aw-mega-title"><a href="activities"><?= htmlspecialchars($category) ?></a></h4>
                  <div class="aw-visual-grid">
                    <?php foreach ($acts as $a): ?>
                      <a href="activity/<?= htmlspecialchars($a['slug']) ?>" class="aw-visual-card">
                        <div class="aw-card-img" style="background-image: url('admin/<?= htmlspecialchars($a['featured_image'] ?: 'uploads/default-activity.jpg') ?>');"></div>
                        <span class="aw-card-title"><?= htmlspecialchars($a['name']) ?></span>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="aw-mega-footer">
              <a href="activities" class="aw-btn-primary aw-btn-small">View All Activities</a>
            </div>
          </div>
        </li>

        <li class="aw-nav-item"><a href="blog">Blog</a></li>
      </ul>
    </nav>

    <!-- Actions -->
    <div class="aw-nav-actions">
      <div class="aw-lang-select">
        <i class="fa fa-globe"></i>
        <select onchange="doGTranslate(this);" class="aw-lang-dropdown">
          <option value="en|en">EN</option>
          <option value="en|fr">FR</option>
          <option value="en|es">ES</option>
          <option value="en|de">DE</option>
          <option value="en|it">IT</option>
          <option value="en|zh-CN">ZH</option>
        </select>
      </div>

      <button class="aw-btn-icon" id="aw-search-toggle" aria-label="Search">
        <i class="fa fa-search"></i>
      </button>

      <!-- Hamburger for Full Page Menu -->
      <button class="aw-btn-icon" id="aw-fullpage-toggle" aria-label="Menu">
        <i class="fa fa-bars" style="font-size:22px;"></i>
      </button>

      <button data-open-planner="true" class="aw-btn-primary">Start Planning</button>
    </div>
  </div>

  <!-- Search Bar Dropdown (Hidden by default) -->
  <form action="tours" method="GET" id="aw-search-bar" class="aw-search-bar-hidden">
    <div class="aw-search-bar-inner">
      <input type="text" name="q" placeholder="Search tours, destinations..." autocomplete="off">
      <button type="submit">Search</button>
    </div>
  </form>
</header>

<!-- ====== FULL PAGE OVERLAY MENU ====== -->
<div id="aw-fullpage-menu" class="aw-fullpage-overlay">
  <div class="aw-fullpage-close" id="aw-fullpage-close">
    <i class="fa fa-times"></i>
  </div>
  
  <div class="aw-fullpage-content">
    <div class="container">
      <div class="row">
        <!-- The Attwood Difference -->
        <div class="col-md-4 mb-5">
          <h3 class="aw-fp-title">Who We Are</h3>
          <ul class="aw-fp-list">
            <li><a href="about">Our Story</a></li>
            <li><a href="why-us">The Attwood Difference</a></li>
            <li><a href="careers">Join Our Team</a></li>
            <li><a href="corporate">Corporate Travel</a></li>
            <li><a href="contact">Get in Touch</a></li>
          </ul>
        </div>

        <!-- Travel Information -->
        <div class="col-md-4 mb-5">
          <h3 class="aw-fp-title">Travel Smart</h3>
          <ul class="aw-fp-list">
            <li><a href="best-time-to-visit">When to Travel</a></li>
            <li><a href="travel-confidence">Book with Confidence</a></li>
            <li><a href="travel-insurance">Travel Protection</a></li>
          </ul>
        </div>

        <!-- Booking & Terms -->
        <div class="col-md-4 mb-5">
          <h3 class="aw-fp-title">The Fine Print</h3>
          <ul class="aw-fp-list">
            <li><a href="best-price-guarantee">Price Promise</a></li>
            <li><a href="booking-terms">Booking Conditions</a></li>
            <li><a href="privacy-policy">Data Privacy</a></li>
          </ul>
        </div>
      </div>
      
      <!-- Socials / Quick Contact in Menu -->
      <div class="row mt-5">
        <div class="col-12 text-center aw-fp-footer">
          <p class="mb-2" style="color: rgba(255,255,255,0.6); letter-spacing:0.1em; text-transform:uppercase; font-size:12px;">Connect with us</p>
          <div class="aw-fp-socials">
            <a href="https://www.instagram.com/filaoadventures/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://wa.me/254757139239" target="_blank"><i class="fa fa-whatsapp"></i></a>
            <a href="https://x.com/FilaoAdventures" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="mailto:info@filaoadventures.co.ke"><i class="fa fa-envelope"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
"""

with open(nav_path, 'w', encoding='utf-8') as f:
    f.write(php_logic + new_html)

print("nav.php rewritten with visual mega menus")
