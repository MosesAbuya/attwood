import re
import os

nav_path = 'e:/xampp/htdocs/attwood/includes/nav.php'
with open(nav_path, 'r', encoding='utf-8') as f:
    nav_content = f.read()

# Split at Google Translate Element to keep the PHP logic
split_marker = '<!-- Hidden Google Translate Element -->'
if split_marker in nav_content:
    php_logic = nav_content.split(split_marker)[0]
else:
    print("Error: Could not find split marker")
    exit(1)

new_html = """<!-- Hidden Google Translate Element -->
<div id="google_translate_element" style="display:none;"></div>

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
        <li class="aw-nav-item aw-has-dropdown">
          <a href="destinations">Destinations <i class="fa fa-angle-down"></i></a>
          <ul class="aw-dropdown-menu">
            <?php foreach ($navRegions as $regionName => $countriesList): ?>
              <li class="aw-dropdown-item aw-has-subdropdown">
                <a href="#"><?= htmlspecialchars($regionName) ?> <i class="fa fa-angle-right"></i></a>
                <ul class="aw-subdropdown-menu">
                  <?php foreach ($countriesList as $c): ?>
                    <li><a href="destinations/<?= htmlspecialchars($c['country']) ?>"><?= htmlspecialchars($c['country']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="aw-nav-item aw-has-dropdown">
          <a href="tours">Tours <i class="fa fa-angle-down"></i></a>
          <ul class="aw-dropdown-menu">
            <?php foreach ($navToursByCountry as $country => $tours): ?>
              <li class="aw-dropdown-item aw-has-subdropdown">
                <a href="tours?country=<?= urlencode($country) ?>"><?= htmlspecialchars($country) ?> <i class="fa fa-angle-right"></i></a>
                <ul class="aw-subdropdown-menu">
                  <?php foreach ($tours as $t): ?>
                    <li><a href="tour/<?= htmlspecialchars($t['slug']) ?>"><?= htmlspecialchars($t['title']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="aw-nav-item aw-has-dropdown">
          <a href="#">Safari Experiences <i class="fa fa-angle-down"></i></a>
          <ul class="aw-dropdown-menu">
            <?php foreach ($navSafarisByTheme as $theme => $safaris): ?>
              <li class="aw-dropdown-item aw-has-subdropdown">
                <a href="#"><?= htmlspecialchars($theme) ?> <i class="fa fa-angle-right"></i></a>
                <ul class="aw-subdropdown-menu">
                  <?php foreach ($safaris as $s): ?>
                    <li><a href="tour/<?= htmlspecialchars($s['tour_slug']) ?>"><?= htmlspecialchars($s['title']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="aw-nav-item aw-has-dropdown">
          <a href="#">Activities <i class="fa fa-angle-down"></i></a>
          <ul class="aw-dropdown-menu">
            <?php foreach ($navActByCategory as $category => $acts): ?>
              <li class="aw-dropdown-item aw-has-subdropdown">
                <a href="#"><?= htmlspecialchars($category) ?> <i class="fa fa-angle-right"></i></a>
                <ul class="aw-subdropdown-menu">
                  <?php foreach ($acts as $a): ?>
                    <li><a href="activity/<?= htmlspecialchars($a['slug']) ?>"><?= htmlspecialchars($a['name']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="aw-nav-item aw-has-dropdown">
          <a href="#">We Recommend <i class="fa fa-angle-down"></i></a>
          <ul class="aw-dropdown-menu">
            <?php foreach ($navRecByActivity as $activity => $recs): ?>
              <li class="aw-dropdown-item aw-has-subdropdown">
                <a href="#"><?= htmlspecialchars($activity) ?> <i class="fa fa-angle-right"></i></a>
                <ul class="aw-subdropdown-menu">
                  <?php foreach ($recs as $r): ?>
                    <li><a href="tour/<?= htmlspecialchars($r['slug']) ?>"><?= htmlspecialchars($r['title']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endforeach; ?>
          </ul>
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

      <button class="aw-btn-icon aw-mobile-menu-toggle" id="aw-menu-toggle" aria-label="Menu">
        <i class="fa fa-bars"></i> <span>MENU</span>
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
"""

with open(nav_path, 'w', encoding='utf-8') as f:
    f.write(php_logic + new_html)

print("nav.php rewritten with clean HTML")
