<?php
// includes/nav.php   Attwood Travel Agency Ltd Global Navigation
require_once __DIR__ . '/db.php';
$navPdo = getPDO();

// Tours grouped by destination country from DB
$regionsStmt = $navPdo->query("
    SELECT r.name as region_name, r.slug as region_slug, r.featured_image as region_img,
           c.name as country_name, c.slug as country_slug, c.featured_image as country_img
    FROM regions r
    JOIN countries c ON r.id = c.region_id
    ORDER BY r.name, c.name
")->fetchAll(PDO::FETCH_ASSOC);

$navRegions = [];
$navCountries = []; // Just the names for the tour dropdown
$navCountriesImages = []; // Country images

foreach ($regionsStmt as $row) {
    $cName = trim($row['country_name']);
    $navCountries[] = $cName;
    $navCountriesImages[$cName] = $row['country_img'];
    $region = trim($row['region_name']);
    
    if (!isset($navRegions[$region])) {
        $navRegions[$region] = [];
    }
    
    // Maintain the old structure for compatibility
    $navRegions[$region][] = [
        'country' => $cName,
        'featured_image' => $row['country_img'],
        'region_img' => $row['region_img']
    ];
}
$navCountries = array_unique($navCountries);

$navToursByCountry = [];
foreach ($navCountries as $navCountry) {
  $rows = $navPdo->prepare("
        SELECT DISTINCT t.id, t.title, t.slug, t.featured_image
        FROM tours t
        JOIN itinerary_steps ist ON t.id = ist.tour_id
        JOIN destinations d ON d.id = ist.destination_id
        WHERE d.country = ? AND t.status='published'
        ORDER BY t.title ASC LIMIT 6
    ");
  $rows->execute([$navCountry]);
  $toursList = $rows->fetchAll();
  if (count($toursList) > 0) {
      $navToursByCountry[$navCountry] = $toursList;
  }
}

// Fallback: if no country-based grouping, just load all tours
if (empty($navToursByCountry)) {
  $allTours = $navPdo->query("SELECT id, title, slug FROM tours WHERE status='published' ORDER BY id ASC LIMIT 12")->fetchAll();
  $navToursByCountry['All Tours'] = $allTours;
}

// Fetch Destiantions with their associated tours for the mobile menu
$navDestData = $navPdo->query("
    SELECT DISTINCT d.id, d.name, d.slug 
    FROM destinations d
    JOIN itinerary_steps ist ON d.id = ist.destination_id
    JOIN tours t ON t.id = ist.tour_id
    WHERE t.status='published'
    ORDER BY d.name ASC LIMIT 10
")->fetchAll();

$navDestinations = [];
foreach($navDestData as $navDestLoop) {
    $tstmt = $navPdo->prepare("
        SELECT DISTINCT t.id, t.title, t.slug 
        FROM tours t
        JOIN itinerary_steps ist ON t.id = ist.tour_id
        WHERE ist.destination_id = ? AND t.status='published'
        ORDER BY t.title ASC LIMIT 5
    ");
    $tstmt->execute([$navDestLoop['id']]);
    $navDestLoop['tours'] = $tstmt->fetchAll();
    $navDestinations[] = $navDestLoop;
}


// Recommended tours grouped by activity from DB
$navRecommended = $navPdo->query("
    SELECT id, title, slug, featured_image, price_from_usd, duration_days, recommended_activity
    FROM tours
    WHERE is_recommended=1 AND status='published'
    ORDER BY recommended_activity ASC, title ASC
")->fetchAll();

// Group recommended by activity
$navRecByActivity = [];
foreach ($navRecommended as $rt) {
  $recAct = $rt['recommended_activity'] ?: 'Featured';
  $navRecByActivity[$recAct][] = $rt;
}

// Activities dynamically grouped by category
$navActivities = $navPdo->query("SELECT id, name, slug, category, featured_image FROM activities ORDER BY category ASC, name ASC")->fetchAll();
$navActByCategory = [];
foreach ($navActivities as $navActItem) {
  $navActByCategory[$navActItem['category']][] = $navActItem;
}

// Safaris dynamically grouped by Theme
$navSafarisThemes = $navPdo->query("
    SELECT tx.name as theme_name, tx.slug as theme_slug, t.id, t.title, t.slug as tour_slug, t.featured_image
    FROM taxonomies tx
    JOIN tour_taxonomy_pivot ttp ON tx.id = ttp.taxonomy_id
    JOIN tours t ON ttp.tour_id = t.id
    JOIN tour_category_pivot tcp ON t.id = tcp.tour_id
    JOIN tour_categories tc ON tcp.category_id = tc.id
    WHERE t.status='published' AND tc.slug = 'safari-tours' AND tx.name IN ('Family Friendly', 'Honeymoon', 'Solo Traveler')
    ORDER BY tx.name ASC, t.duration_days ASC
")->fetchAll();

$navSafarisByTheme = [];
foreach ($navSafarisThemes as $st) {
  $navSafarisByTheme[$st['theme_name']][] = $st;
}

// Joining Tours
$navJoiningTours = $navPdo->query("
    SELECT id, title, slug as tour_slug, featured_image
    FROM tours
    WHERE is_joining_tour=1 AND status='published'
    ORDER BY title ASC
")->fetchAll();

if (!empty($navJoiningTours)) {
    $navSafarisByTheme['Joining Tours'] = $navJoiningTours;
}

// Multi-Country Tours
$navMultiCountryTours = $navPdo->query("
    SELECT t.id, t.title, t.slug as tour_slug, t.featured_image
    FROM tours t
    JOIN itinerary_steps ist ON t.id = ist.tour_id
    JOIN destinations d ON d.id = ist.destination_id
    WHERE t.status='published'
    GROUP BY t.id
    HAVING COUNT(DISTINCT d.country) > 1
    ORDER BY t.title ASC
")->fetchAll();

if (!empty($navMultiCountryTours)) {
    $navSafarisByTheme['Multi-Country'] = $navMultiCountryTours;
}
?>
<!-- Hidden Google Translate Element -->
<div id="google_translate_element" style="display:none;"></div>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

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

        <!-- Destinations Mega Menu (Split Pane) -->
        <li class="aw-nav-item aw-has-megamenu">
          <a href="#" class="aw-mega-trigger">Destinations <i class="fa fa-angle-down"></i></a>
          <div class="aw-mega-menu aw-mega-split">
            <!-- Sidebar -->
            <div class="aw-mega-sidebar">
              <div class="aw-sidebar-header">Destinations by Region</div>
              <ul class="aw-sidebar-list">
                <?php $isFirst = true; foreach ($navRegions as $regionName => $countriesList): 
                    $safeId = md5($regionName);
                    // Use the first country's region image as the default for this region
                    $regionImg = !empty($countriesList) ? ($countriesList[0]['region_img'] ?: $countriesList[0]['featured_image']) : 'default.jpg';
                ?>
                  <li class="<?= $isFirst ? 'active' : '' ?>" data-target="mega-dest-<?= $safeId ?>" data-default-img="uploads/<?= htmlspecialchars($regionImg) ?>">
                    <?= htmlspecialchars($regionName) ?>
                  </li>
                <?php $isFirst = false; endforeach; ?>
              </ul>
              <div class="aw-sidebar-footer"><a href="destinations">VIEW ALL DESTINATIONS</a></div>
            </div>
            
            <!-- Middle Content -->
            <div class="aw-mega-content">
              <?php $isFirst = true; foreach ($navRegions as $regionName => $countriesList): 
                  $safeId = md5($regionName);
              ?>
                <div class="aw-mega-pane <?= $isFirst ? 'active' : '' ?>" id="mega-dest-<?= $safeId ?>">
                  <ul class="aw-pane-links">
                    <?php foreach ($countriesList as $c): ?>
                      <li>
                        <a href="country.php?name=<?= urlencode($c['country']) ?>" data-hover-img="uploads/<?= htmlspecialchars($c['featured_image'] ?: 'default.jpg') ?>">
                          <?= htmlspecialchars($c['country']) ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php $isFirst = false; endforeach; ?>
              
              <!-- View All Button -->
              <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--aw-border);">
                <a href="destinations" style="font-family:var(--aw-font-ui); font-size:13px; font-weight:700; color:var(--aw-primary); text-transform:uppercase; letter-spacing:1px; text-decoration:none;">View All Destinations <i class="fa fa-arrow-right" style="margin-left:4px;"></i></a>
              </div>
            </div>

            <!-- Right Image Pane -->
            <div class="aw-mega-image-container">
              <?php 
                $firstRegion = array_key_first($navRegions); 
                $firstImg = 'uploads/default.jpg';
                if ($firstRegion && !empty($navRegions[$firstRegion])) {
                    $firstImg = 'uploads/'.($navRegions[$firstRegion][0]['region_img'] ?: $navRegions[$firstRegion][0]['featured_image']);
                }
              ?>
              <img src="<?= htmlspecialchars($firstImg) ?>" alt="Featured Destination" class="aw-mega-img-display">
              <div class="aw-mega-caption">Discover Your Next Destination</div>
              <button class="aw-mega-close"><i class="fa fa-times"></i> CLOSE</button>
            </div>
          </div>
        </li>

        <!-- Tours Mega Menu (Split Pane) -->
        <li class="aw-nav-item aw-has-megamenu">
          <a href="#" class="aw-mega-trigger">Tours <i class="fa fa-angle-down"></i></a>
          <div class="aw-mega-menu aw-mega-split">
            <!-- Sidebar -->
            <div class="aw-mega-sidebar">
              <div class="aw-sidebar-header">Tours by Country</div>
              <ul class="aw-sidebar-list">
                <?php $isFirst = true; foreach ($navToursByCountry as $country => $navToursGroup): 
                    $safeId = md5($country);
                    $countryImg = $navCountriesImages[$country] ?? 'default.jpg';
                ?>
                  <li class="<?= $isFirst ? 'active' : '' ?>" data-target="mega-tours-<?= $safeId ?>" data-default-img="uploads/<?= htmlspecialchars($countryImg) ?>">
                    <?= htmlspecialchars(strtoupper($country)) ?>
                  </li>
                <?php $isFirst = false; endforeach; ?>
              </ul>
              <div class="aw-sidebar-footer"><a href="tours">VIEW ALL TOURS</a></div>
            </div>
            
            <!-- Middle Content -->
            <div class="aw-mega-content">
              <?php $isFirst = true; foreach ($navToursByCountry as $country => $navToursGroup): 
                $safeId = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($country));
              ?>
                <div class="aw-mega-pane <?= $isFirst ? 'active' : '' ?>" id="mega-tours-<?= $safeId ?>">
                  <ul class="aw-pane-links">
                    <?php foreach ($navToursGroup as $t): ?>
                      <li>
                        <a href="tours/<?= htmlspecialchars($t['slug']) ?>" data-hover-img="uploads/<?= htmlspecialchars($t['featured_image'] ?: 'default.jpg') ?>">
                          <?= htmlspecialchars($t['title']) ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php $isFirst = false; endforeach; ?>
              
              <!-- View All Button -->
              <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--aw-border);">
                <a href="tours" style="font-family:var(--aw-font-ui); font-size:13px; font-weight:700; color:var(--aw-primary); text-transform:uppercase; letter-spacing:1px; text-decoration:none;">View All Tours <i class="fa fa-arrow-right" style="margin-left:4px;"></i></a>
              </div>
            </div>

            <!-- Right Image Pane -->
            <div class="aw-mega-image-container">
              <?php 
                $firstCountry = array_key_first($navToursByCountry); 
                $firstImg = 'uploads/'.($navCountriesImages[$firstCountry] ?? 'default.jpg');
              ?>
              <img src="<?= htmlspecialchars($firstImg) ?>" alt="Featured Tour" class="aw-mega-img-display">
              <div class="aw-mega-caption">Explore Our Safari Tours</div>
              <button class="aw-mega-close"><i class="fa fa-times"></i> CLOSE</button>
            </div>
          </div>
        </li>

        <!-- Activities Mega Menu (Split Pane) -->
        <li class="aw-nav-item aw-has-megamenu">
          <a href="#" class="aw-mega-trigger">Activities <i class="fa fa-angle-down"></i></a>
          <div class="aw-mega-menu aw-mega-split">
            <!-- Sidebar -->
            <div class="aw-mega-sidebar">
              <div class="aw-sidebar-header">Activities by Type</div>
              <ul class="aw-sidebar-list">
                <?php $isFirst = true; foreach ($navActByCategory as $category => $acts): 
                    $safeId = md5($category);
                    $catImg = !empty($acts) ? $acts[0]['featured_image'] : 'default.jpg';
                ?>
                  <li class="<?= $isFirst ? 'active' : '' ?>" data-target="mega-acts-<?= $safeId ?>" data-default-img="uploads/<?= htmlspecialchars($catImg) ?>">
                    <?= htmlspecialchars(strtoupper($category)) ?>
                  </li>
                <?php $isFirst = false; endforeach; ?>
              </ul>
              <div class="aw-sidebar-footer"><a href="activities">VIEW ALL ACTIVITIES</a></div>
            </div>
            
            <!-- Middle Content -->
            <div class="aw-mega-content">
              <?php $isFirst = true; foreach ($navActByCategory as $category => $acts): 
                  $safeId = md5($category);
              ?>
                <div class="aw-mega-pane <?= $isFirst ? 'active' : '' ?>" id="mega-acts-<?= $safeId ?>">
                  <ul class="aw-pane-links">
                    <?php foreach ($acts as $a): ?>
                      <li>
                        <a href="activities/<?= htmlspecialchars($a['slug']) ?>" data-hover-img="uploads/<?= htmlspecialchars($a['featured_image'] ?: 'default.jpg') ?>">
                          <?= htmlspecialchars($a['name']) ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php $isFirst = false; endforeach; ?>
              
              <!-- View All Button -->
              <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--aw-border);">
                <a href="activities" style="font-family:var(--aw-font-ui); font-size:13px; font-weight:700; color:var(--aw-primary); text-transform:uppercase; letter-spacing:1px; text-decoration:none;">View All Activities <i class="fa fa-arrow-right" style="margin-left:4px;"></i></a>
              </div>
            </div>

            <!-- Right Image Pane -->
            <div class="aw-mega-image-container">
              <?php 
                $firstCat = array_key_first($navActByCategory); 
                $firstImg = 'uploads/default.jpg';
                if ($firstCat && !empty($navActByCategory[$firstCat])) {
                    $firstImg = 'uploads/'.($navActByCategory[$firstCat][0]['featured_image'] ?: 'default.jpg');
                }
              ?>
              <img src="<?= htmlspecialchars($firstImg) ?>" alt="Featured Activity" class="aw-mega-img-display">
              <div class="aw-mega-caption">Experience The Extraordinary</div>
              <button class="aw-mega-close"><i class="fa fa-times"></i> CLOSE</button>
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

<!-- ====== MOBILE OFF-CANVAS MENU ====== -->
<div id="aw-mobile-menu" class="aw-mobile-overlay">
  <div class="aw-mobile-menu-inner">
    <div class="aw-mobile-header">
      <img src="oldattwood/img/logo.png" alt="Attwood" style="max-height: 40px;">
      <button id="aw-mobile-close" class="aw-btn-icon"><i class="fa fa-times" style="font-size:22px; color:#fff;"></i></button>
    </div>
    <ul class="aw-mobile-nav-list">
      <li><a href="about">About</a></li>
      <li><a href="destinations">Destinations <i class="fa fa-angle-right"></i></a></li>
      <li><a href="tours">Tours <i class="fa fa-angle-right"></i></a></li>
      <li><a href="activities">Activities <i class="fa fa-angle-right"></i></a></li>
      <li><a href="blog">Blog</a></li>
      <li style="margin-top:20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top:20px;">
        <a href="#" id="aw-mobile-open-who-we-are">Who We Are <i class="fa fa-angle-right"></i></a>
      </li>
    </ul>
  </div>
</div>

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
