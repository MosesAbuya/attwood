path = 'e:/xampp/htdocs/attwood/tour-detail.php'
with open(path, 'r', encoding='utf-8') as f:
    content = f.read()

# ─── 1. Fix hero: shorter, centered content, white bold h1 ───────────────────
content = content.replace(
    """    /* ---- HERO ---- */
    .tdv2-hero {
      position: relative;
      height: 100vh;
      min-height: 620px;
      background-size: cover;
      background-position: center;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      overflow: hidden;
    }
    .tdv2-hero-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.2) 100%);
    }
    .tdv2-hero-content {
      position: relative; z-index: 2;
      padding: 0 40px 60px 40px;
      max-width: 900px;
      animation: fadeUp 0.8s ease both;
    }
    .tdv2-hero-eyebrow {
      font-family: 'Caveat', cursive;
      font-size: 22px;
      color: var(--aw-accent-gold);
      letter-spacing: 1px;
      margin-bottom: 8px;
    }
    .tdv2-hero h1 {
      font-family: 'Pacifico', cursive;
      font-size: clamp(36px, 5.5vw, 72px);
      color: #fff;
      line-height: 1.15;
      margin-bottom: 16px;
      text-shadow: 0 4px 20px rgba(0,0,0,0.5);
    }
    .tdv2-hero-route {
      font-family: 'Quicksand', sans-serif;
      font-size: 15px;
      color: rgba(255,255,255,0.75);
      margin-bottom: 28px;
      display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
    }
    .tdv2-hero-route i { color: var(--aw-accent-gold); }
    .tdv2-stat-chips {
      display: flex; flex-wrap: wrap; gap: 10px;
      margin-bottom: 32px;
    }""",
    """    /* ---- HERO ---- */
    .tdv2-hero {
      position: relative;
      height: 520px;
      min-height: 420px;
      background-size: cover;
      background-position: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      overflow: hidden;
    }
    .tdv2-hero-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.3) 100%);
    }
    .tdv2-hero-content {
      position: relative; z-index: 2;
      padding: 0 24px;
      max-width: 860px;
      width: 100%;
      text-align: center;
      animation: fadeUp 0.8s ease both;
    }
    .tdv2-hero-eyebrow {
      font-family: 'Caveat', cursive;
      font-size: 22px;
      color: var(--aw-accent-gold);
      letter-spacing: 1px;
      margin-bottom: 8px;
    }
    .tdv2-hero h1 {
      font-family: 'Raleway', sans-serif;
      font-size: clamp(32px, 5vw, 58px);
      font-weight: 900;
      color: #ffffff !important;
      line-height: 1.15;
      margin-bottom: 16px;
      text-shadow: 0 3px 18px rgba(0,0,0,0.7);
    }
    .tdv2-hero-route {
      font-family: 'Quicksand', sans-serif;
      font-size: 14px;
      color: rgba(255,255,255,0.75);
      margin-bottom: 22px;
      display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;
    }
    .tdv2-hero-route i { color: var(--aw-accent-gold); }
    .tdv2-stat-chips {
      display: flex; flex-wrap: wrap; gap: 10px;
      margin-bottom: 28px;
      justify-content: center;
    }"""
)

# ─── 2. Fix hero actions to center ──────────────────────────────────────────
content = content.replace(
    '    .tdv2-hero-actions {\n      display: flex; align-items: center; gap: 14px; flex-wrap: wrap;\n    }',
    '    .tdv2-hero-actions {\n      display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap;\n    }'
)

# ─── 3. Fix breadcrumb: centered, not absolute full-width ───────────────────
content = content.replace(
    """    .tdv2-hero-breadcrumb {
      position: absolute; top: 20px; left: 40px; z-index: 3;
      font-family: 'Quicksand', sans-serif; font-size: 12px; color: rgba(255,255,255,0.7);
      display: flex; gap: 8px; align-items: center;
    }
    .tdv2-hero-breadcrumb a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .tdv2-hero-breadcrumb a:hover { color: var(--aw-accent-gold); }
    .tdv2-hero-breadcrumb .sep { color: rgba(255,255,255,0.4); }""",
    """    .tdv2-hero-breadcrumb {
      position: absolute; bottom: 20px; z-index: 3;
      left: 50%; transform: translateX(-50%);
      font-family: 'Quicksand', sans-serif; font-size: 12px; color: rgba(255,255,255,0.7);
      display: flex; gap: 8px; align-items: center;
      background: rgba(0,0,0,0.35);
      backdrop-filter: blur(8px);
      padding: 7px 20px;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,0.15);
      white-space: nowrap;
    }
    .tdv2-hero-breadcrumb a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .tdv2-hero-breadcrumb a:hover { color: var(--aw-accent-gold); }
    .tdv2-hero-breadcrumb .sep { color: rgba(255,255,255,0.4); }"""
)

# ─── 4. Replace sticky-nav CSS with tabs CSS ────────────────────────────────
content = content.replace(
    """    /* ---- STICKY NAV ---- */
    .tdv2-sticky-nav {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: #fff;
      border-bottom: 3px solid var(--aw-accent-gold);
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .tdv2-sticky-nav .nav-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      gap: 0;
      overflow-x: auto;
      scrollbar-width: none;
    }
    .tdv2-sticky-nav .nav-inner::-webkit-scrollbar { display: none; }
    .tdv2-nav-link {
      font-family: 'Raleway', sans-serif;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #666 !important;
      padding: 14px 20px;
      text-decoration: none !important;
      border-bottom: 3px solid transparent;
      margin-bottom: -3px;
      white-space: nowrap;
      transition: all 0.25s ease;
    }
    .tdv2-nav-link:hover { color: var(--aw-primary) !important; border-bottom-color: var(--aw-primary); }
    .tdv2-nav-link.active { color: var(--aw-accent-sky) !important; border-bottom-color: var(--aw-accent-sky); }""",
    """    /* ---- CENTERED TABS ---- */
    .tdv2-tabs-wrap {
      background: #fff;
      border-bottom: 3px solid var(--aw-accent-gold);
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .tdv2-tabs {
      display: flex;
      justify-content: center;
      overflow-x: auto;
      scrollbar-width: none;
      gap: 0;
      padding: 0 16px;
    }
    .tdv2-tabs::-webkit-scrollbar { display: none; }
    .tdv2-tab-btn {
      background: none;
      border: none;
      border-bottom: 3px solid transparent;
      margin-bottom: -3px;
      padding: 15px 22px;
      font-family: 'Raleway', sans-serif;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.09em;
      text-transform: uppercase;
      color: #777;
      cursor: pointer;
      white-space: nowrap;
      transition: all 0.25s ease;
    }
    .tdv2-tab-btn:hover { color: var(--aw-primary); border-bottom-color: var(--aw-primary); }
    .tdv2-tab-btn.active { color: var(--aw-accent-sky); border-bottom-color: var(--aw-accent-sky); }
    .tdv2-tab-pane { display: none; }
    .tdv2-tab-pane.active { display: block; animation: fadeUp 0.3s ease both; }"""
)

# ─── 5. Replace the sticky-nav HTML with centered tabs HTML ─────────────────
old_nav_html = """<!-- ============================================================
     STICKY SECTION NAV
     ============================================================ -->
<nav class="tdv2-sticky-nav">
  <div class="nav-inner">
    <a href="#overview-section" class="tdv2-nav-link active">Overview</a>
    <a href="#itinerary-section" class="tdv2-nav-link">Itinerary</a>
    <a href="#inclusions-section" class="tdv2-nav-link">Inclusions</a>
    <a href="#pricing-section" class="tdv2-nav-link">Pricing</a>
    <a href="#accommodations-section" class="tdv2-nav-link">Accommodations</a>
    <a href="#map-section" class="tdv2-nav-link">Map</a>
    <a href="#gallery-section" class="tdv2-nav-link">Gallery</a>
  </div>
</nav>"""

new_nav_html = """<!-- ============================================================
     CENTERED TABS NAVIGATION
     ============================================================ -->
<div class="tdv2-tabs-wrap">
  <div class="tdv2-tabs" id="tdv2TabsNav">
    <button class="tdv2-tab-btn active" data-tab="overview">Overview</button>
    <button class="tdv2-tab-btn" data-tab="itinerary">Itinerary (<?= count($steps) ?> Days)</button>
    <button class="tdv2-tab-btn" data-tab="inclusions">Inclusions</button>
    <button class="tdv2-tab-btn" data-tab="pricing">Pricing</button>
    <button class="tdv2-tab-btn" data-tab="accommodations">Accommodations</button>
    <button class="tdv2-tab-btn" data-tab="map">Map</button>
    <button class="tdv2-tab-btn" data-tab="gallery">Gallery</button>
  </div>
</div>"""

content = content.replace(old_nav_html, new_nav_html)

# ─── 6. Wrap left-col sections in tab panes & open/close ────────────────────
old_left_open = '    <!-- ====================== LEFT COLUMN ====================== -->\n    <div class="tdv2-left-col">\n\n      <!-- OVERVIEW -->\n      <section class="tdv2-section" id="overview-section">'
new_left_open = '    <!-- ====================== LEFT COLUMN ====================== -->\n    <div class="tdv2-left-col">\n\n      <!-- OVERVIEW -->\n      <div class="tdv2-tab-pane active" id="tdv2-tab-overview">\n      <section class="tdv2-section">'
content = content.replace(old_left_open, new_left_open)

# Close overview pane + open itinerary pane
content = content.replace(
    '      <!-- ITINERARY TIMELINE -->\n      <section class="tdv2-section" id="itinerary-section">',
    '      </section></div>\n\n      <!-- ITINERARY TIMELINE -->\n      <div class="tdv2-tab-pane" id="tdv2-tab-itinerary">\n      <section class="tdv2-section">'
)

# Close itinerary pane + open inclusions pane
content = content.replace(
    '      <!-- INCLUSIONS / EXCLUSIONS -->\n      <section class="tdv2-section" id="inclusions-section">',
    '      </section></div>\n\n      <!-- INCLUSIONS / EXCLUSIONS -->\n      <div class="tdv2-tab-pane" id="tdv2-tab-inclusions">\n      <section class="tdv2-section">'
)

# Close inclusions pane + open pricing pane
content = content.replace(
    '      <!-- PRICING -->\n      <section class="tdv2-section" id="pricing-section">',
    '      </section></div>\n\n      <!-- PRICING -->\n      <div class="tdv2-tab-pane" id="tdv2-tab-pricing">\n      <section class="tdv2-section">'
)

# Close pricing pane + open accommodations pane
content = content.replace(
    '      <!-- ACCOMMODATIONS -->\n      <section class="tdv2-section" id="accommodations-section">',
    '      </section></div>\n\n      <!-- ACCOMMODATIONS -->\n      <div class="tdv2-tab-pane" id="tdv2-tab-accommodations">\n      <section class="tdv2-section">'
)

# Close accommodations pane + open map pane
content = content.replace(
    '      <!-- MAP -->\n      <section class="tdv2-section" id="map-section">',
    '      </section></div>\n\n      <!-- MAP -->\n      <div class="tdv2-tab-pane" id="tdv2-tab-map">\n      <section class="tdv2-section">'
)

# Close map pane + open gallery pane
content = content.replace(
    '      <!-- GALLERY -->\n      <section class="tdv2-section" id="gallery-section">',
    '      </section></div>\n\n      <!-- GALLERY -->\n      <div class="tdv2-tab-pane" id="tdv2-tab-gallery">\n      <section class="tdv2-section">'
)

# Close gallery section + close gallery pane + close left col
content = content.replace(
    '    </div><!-- /left col -->',
    '      </section></div>\n    </div><!-- /left col -->'
)

# ─── 7. Replace the old inline scroll JS with tabs JS ───────────────────────
old_scroll_js = """<script>
// Sticky nav active section highlighting
(function() {
  var links = document.querySelectorAll('.tdv2-nav-link');
  var sections = [];
  links.forEach(function(l) {
    var id = l.getAttribute('href').replace('#','');
    var sec = document.getElementById(id);
    if(sec) sections.push({link:l, section:sec});
  });
  function onScroll() {
    var scrollY = window.scrollY + 100;
    var active = null;
    sections.forEach(function(s) {
      if(s.section.offsetTop <= scrollY) active = s;
    });
    links.forEach(function(l) { l.classList.remove('active'); });
    if(active) active.link.classList.add('active');
  }
  window.addEventListener('scroll', onScroll, {passive:true});
  // Smooth scroll
  links.forEach(function(l) {
    l.addEventListener('click', function(e) {
      var id = l.getAttribute('href').replace('#','');
      var sec = document.getElementById(id);
      if(sec) { e.preventDefault(); sec.scrollIntoView({behavior:'smooth', block:'start'}); }
    });
  });
  // Init map when scrolled into view
  var mapSec = document.getElementById('map-section');
  var mapInitialized = false;
  if(mapSec) {
    var obs = new IntersectionObserver(function(entries) {
      if(entries[0].isIntersecting && !mapInitialized) {
        mapInitialized = true;
        initMap();
      }
    }, {threshold:0.1});
    obs.observe(mapSec);
  }
})();
</script>"""

new_tabs_js = """<script>
// ── Tab Switching
(function() {
  var btns = document.querySelectorAll('.tdv2-tab-btn');
  var mapInitialized = false;

  function activate(tab) {
    btns.forEach(function(b) { b.classList.remove('active'); });
    document.querySelectorAll('.tdv2-tab-pane').forEach(function(p) { p.classList.remove('active'); });

    var btn = document.querySelector('.tdv2-tab-btn[data-tab="' + tab + '"]');
    var pane = document.getElementById('tdv2-tab-' + tab);
    if(btn) btn.classList.add('active');
    if(pane) pane.classList.add('active');

    // Init Leaflet map the first time map tab is shown
    if(tab === 'map' && !mapInitialized) {
      mapInitialized = true;
      setTimeout(initMap, 50); // small delay to ensure element is visible
    }

    // Scroll to top of tabs
    var wrap = document.querySelector('.tdv2-tabs-wrap');
    if(wrap) { window.scrollTo({ top: wrap.offsetTop - 10, behavior: 'smooth' }); }
  }

  btns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      activate(btn.getAttribute('data-tab'));
    });
  });
})();
</script>"""

content = content.replace(old_scroll_js, new_tabs_js)

with open(path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Done. Lines:", content.count('\n'))
