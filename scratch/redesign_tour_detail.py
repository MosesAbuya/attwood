import re

# Read current tour-detail.php
path = 'e:/xampp/htdocs/attwood/tour-detail.php'
with open(path, 'r', encoding='utf-8') as f:
    content = f.read()

# We keep everything from line 1 up to and including line 122 (the PHP logic block)
# and everything from the scripts block onward (line 530+)
# We replace lines 123-528 (DOCTYPE through footer include + closing div)

php_logic_end = content.index('?>\n<!DOCTYPE html>')
scripts_start = content.index('<script src="js/jquery.min.js">')

php_block = content[:php_logic_end + 2]  # up to and including ?>
scripts_block = content[scripts_start:]   # from jquery onward

new_html = r'''
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $base_href = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') ? '/attwood/' : '/'; ?>
  <base href="<?= $base_href ?>">
  <title><?= htmlspecialchars($tour['seo_title'] ?: $tour['title']) ?> &mdash; Attwood Travel Agency Ltd</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= htmlspecialchars(strip_tags($tour['meta_description'] ?: $tour['excerpt'] ?: 'An expertly crafted safari by Attwood Travel Agency Ltd.')) ?>">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;500;600;700&family=Raleway:wght@300;400;500;600;700;800&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css">
  <link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
  <?php @include_once __DIR__.'/includes/head_tags.php'; ?>
  <style>
    /* =========================================================
       TOUR DETAIL v2 — Attwood Brand Theme
       ========================================================= */
    @keyframes slideInRight { from { transform:translateX(100%); opacity:0; } to { transform:translateX(0); opacity:1; } }
    @keyframes fadeUp { from { transform:translateY(30px); opacity:0; } to { transform:translateY(0); opacity:1; } }
    @keyframes pulse { 0%,100%{transform:scale(1);} 50%{transform:scale(1.05);} }

    /* ---- HERO ---- */
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
    }
    .tdv2-chip {
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.25);
      border-radius: 999px;
      padding: 8px 18px;
      font-family: 'Quicksand', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: #fff;
      display: flex; align-items: center; gap: 8px;
    }
    .tdv2-chip i { color: var(--aw-accent-gold); font-size: 14px; }
    .tdv2-chip.chip-price {
      background: var(--aw-primary);
      border-color: var(--aw-primary);
      color: #fff;
      font-size: 14px;
      font-weight: 700;
    }
    .tdv2-hero-actions {
      display: flex; align-items: center; gap: 14px; flex-wrap: wrap;
    }
    .tdv2-btn-cta {
      background: var(--aw-primary);
      color: #fff !important;
      padding: 14px 32px;
      border-radius: 999px;
      font-family: 'Raleway', sans-serif;
      font-weight: 700;
      font-size: 15px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      box-shadow: 0 8px 30px rgba(255,0,0,0.4);
      transition: all 0.3s ease;
      display: inline-block;
    }
    .tdv2-btn-cta:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(255,0,0,0.5); background: var(--aw-primary-dark); }
    .tdv2-btn-outline {
      background: transparent;
      color: #fff !important;
      padding: 13px 28px;
      border-radius: 999px;
      font-family: 'Raleway', sans-serif;
      font-weight: 600;
      font-size: 14px;
      text-decoration: none;
      border: 2px solid rgba(255,255,255,0.5);
      transition: all 0.3s ease;
      display: inline-block;
    }
    .tdv2-btn-outline:hover { border-color: var(--aw-accent-gold); color: var(--aw-accent-gold) !important; }
    .tdv2-hero-breadcrumb {
      position: absolute; top: 20px; left: 40px; z-index: 3;
      font-family: 'Quicksand', sans-serif; font-size: 12px; color: rgba(255,255,255,0.7);
      display: flex; gap: 8px; align-items: center;
    }
    .tdv2-hero-breadcrumb a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .tdv2-hero-breadcrumb a:hover { color: var(--aw-accent-gold); }
    .tdv2-hero-breadcrumb .sep { color: rgba(255,255,255,0.4); }

    /* ---- STICKY NAV ---- */
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
    .tdv2-nav-link.active { color: var(--aw-accent-sky) !important; border-bottom-color: var(--aw-accent-sky); }

    /* ---- LAYOUT ---- */
    .tdv2-main { max-width: 1280px; margin: 0 auto; padding: 48px 24px; }
    .tdv2-grid { display: grid; grid-template-columns: 1fr 380px; gap: 40px; align-items: start; }
    @media (max-width: 991px) { .tdv2-grid { grid-template-columns: 1fr; } }

    /* ---- SECTION BLOCKS ---- */
    .tdv2-section {
      margin-bottom: 56px;
      scroll-margin-top: 70px;
    }
    .tdv2-section-header {
      display: flex; align-items: center; gap: 14px;
      margin-bottom: 28px;
      padding-bottom: 16px;
      border-bottom: 2px solid #f0f0f0;
    }
    .tdv2-section-icon {
      width: 44px; height: 44px;
      background: var(--aw-accent-gold);
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px; color: #000;
      flex-shrink: 0;
    }
    .tdv2-section-title {
      font-family: 'Pacifico', cursive;
      font-size: clamp(22px, 3vw, 30px);
      color: var(--aw-text-dark);
      margin: 0;
      line-height: 1.2;
    }
    .tdv2-prose {
      font-family: 'Raleway', sans-serif;
      font-size: 15.5px;
      line-height: 1.8;
      color: #4a4a4a;
    }
    .tdv2-prose p { margin-bottom: 16px; }
    .tdv2-prose ul { padding-left: 20px; }
    .tdv2-prose ul li { margin-bottom: 8px; }

    /* ---- HIGHLIGHT BADGES on overview ---- */
    .tdv2-highlights-grid {
      display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px;
      margin-top: 28px;
    }
    .tdv2-highlight-item {
      background: linear-gradient(135deg, #f8f9fa, #fff);
      border: 1px solid #eee;
      border-left: 4px solid var(--aw-accent-sky);
      border-radius: 10px;
      padding: 14px 16px;
      font-family: 'Quicksand', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: #333;
      display: flex; align-items: center; gap: 10px;
    }
    .tdv2-highlight-item i { color: var(--aw-accent-sky); font-size: 16px; flex-shrink: 0; }

    /* ---- ITINERARY TIMELINE ---- */
    .tdv2-timeline { position: relative; }
    .tdv2-timeline::before {
      content: '';
      position: absolute;
      left: 22px; top: 0; bottom: 0;
      width: 3px;
      background: linear-gradient(to bottom, var(--aw-accent-gold), var(--aw-accent-sky));
      border-radius: 2px;
    }
    .tdv2-timeline-item {
      display: flex; gap: 20px;
      margin-bottom: 24px;
      position: relative;
    }
    .tdv2-timeline-badge {
      flex-shrink: 0;
      width: 46px; height: 46px;
      background: var(--aw-accent-gold);
      color: #000;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Raleway', sans-serif;
      font-size: 13px;
      font-weight: 800;
      border: 3px solid #fff;
      box-shadow: 0 4px 15px rgba(233,208,32,0.5);
      z-index: 1;
      position: relative;
    }
    .tdv2-timeline-card {
      flex: 1;
      background: #fff;
      border: 1px solid #eee;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      transition: box-shadow 0.3s;
    }
    .tdv2-timeline-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.1); }
    .tdv2-timeline-card-header {
      padding: 16px 20px;
      background: linear-gradient(135deg, var(--aw-accent-olive) 0%, #2d3b28 100%);
      display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
      cursor: pointer;
    }
    .tdv2-timeline-dest {
      font-family: 'Raleway', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #fff;
      flex: 1;
    }
    .tdv2-timeline-meta-chips {
      display: flex; gap: 8px; flex-wrap: wrap;
    }
    .tdv2-meta-chip {
      background: rgba(255,255,255,0.15);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 999px;
      padding: 4px 12px;
      font-family: 'Quicksand', sans-serif;
      font-size: 11px;
      font-weight: 600;
      color: rgba(255,255,255,0.9);
      display: flex; align-items: center; gap: 5px;
    }
    .tdv2-meta-chip.chip-gold { background: rgba(233,208,32,0.25); border-color: rgba(233,208,32,0.5); color: var(--aw-accent-gold); }
    .tdv2-timeline-body {
      padding: 20px;
      display: flex; gap: 20px;
    }
    .tdv2-timeline-body-text {
      flex: 1;
      font-family: 'Raleway', sans-serif;
      font-size: 14.5px;
      line-height: 1.75;
      color: #555;
    }
    .tdv2-timeline-body-text p { margin-bottom: 10px; }
    .tdv2-step-img {
      width: 160px; height: 120px;
      object-fit: cover;
      border-radius: 10px;
      flex-shrink: 0;
    }
    @media (max-width: 600px) {
      .tdv2-timeline-body { flex-direction: column; }
      .tdv2-step-img { width: 100%; height: 160px; }
    }

    /* ---- INCLUSIONS / EXCLUSIONS ---- */
    .tdv2-inc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    @media (max-width: 640px) { .tdv2-inc-grid { grid-template-columns: 1fr; } }
    .tdv2-inc-card {
      border-radius: 16px;
      padding: 28px;
      position: relative;
      overflow: hidden;
    }
    .tdv2-inc-card.included {
      background: linear-gradient(135deg, #e8f5e1, #f0f8ea);
      border: 2px solid rgba(118,146,66,0.3);
    }
    .tdv2-inc-card.excluded {
      background: linear-gradient(135deg, #fde8e8, #fdf0f0);
      border: 2px solid rgba(255,0,0,0.2);
    }
    .tdv2-inc-card-title {
      font-family: 'Raleway', sans-serif;
      font-size: 16px; font-weight: 800;
      margin-bottom: 18px;
      display: flex; align-items: center; gap: 10px;
    }
    .tdv2-inc-card.included .tdv2-inc-card-title { color: var(--aw-accent-forest); }
    .tdv2-inc-card.excluded .tdv2-inc-card-title { color: var(--aw-primary); }
    .tdv2-inc-card ul { list-style: none; padding: 0; margin: 0; }
    .tdv2-inc-card ul li {
      font-family: 'Quicksand', sans-serif;
      font-size: 13.5px;
      padding: 7px 0;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      display: flex; align-items: flex-start; gap: 10px;
      color: #333;
    }
    .tdv2-inc-card ul li:last-child { border-bottom: none; }
    .tdv2-inc-card.included ul li::before { content: '✓'; color: var(--aw-accent-forest); font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .tdv2-inc-card.excluded ul li::before { content: '✕'; color: var(--aw-primary); font-weight: 700; flex-shrink: 0; margin-top: 1px; }

    /* ---- PRICING TABLE ---- */
    .tdv2-pricing-table {
      width: 100%;
      border-collapse: collapse;
      font-family: 'Quicksand', sans-serif;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    }
    .tdv2-pricing-table thead tr {
      background: var(--aw-accent-olive);
      color: var(--aw-accent-gold);
    }
    .tdv2-pricing-table thead th {
      padding: 16px 20px;
      text-align: left;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }
    .tdv2-pricing-table tbody tr { border-bottom: 1px solid #f0f0f0; }
    .tdv2-pricing-table tbody tr:nth-child(even) { background: #fafafa; }
    .tdv2-pricing-table tbody tr:hover { background: #fff8e1; }
    .tdv2-pricing-table td {
      padding: 14px 20px;
      font-size: 14px;
      color: #444;
    }
    .tdv2-pricing-table td:first-child { font-weight: 700; color: var(--aw-text-dark); }
    .tdv2-pricing-table td:not(:first-child) { color: var(--aw-accent-forest); font-weight: 700; font-size: 15px; }

    /* ---- ACCOMMODATIONS ---- */
    .tdv2-acc-card {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
      margin-bottom: 24px;
      display: flex;
    }
    .tdv2-acc-card img {
      width: 240px;
      object-fit: cover;
      flex-shrink: 0;
    }
    .tdv2-acc-body {
      padding: 24px;
      flex: 1;
    }
    .tdv2-acc-day-badge {
      background: var(--aw-accent-gold);
      color: #000;
      font-family: 'Caveat', cursive;
      font-size: 14px;
      font-weight: 700;
      padding: 3px 12px;
      border-radius: 999px;
      display: inline-block;
      margin-bottom: 10px;
    }
    .tdv2-acc-name {
      font-family: 'Raleway', sans-serif;
      font-size: 19px;
      font-weight: 800;
      color: var(--aw-text-dark);
      margin-bottom: 6px;
    }
    .tdv2-acc-loc {
      font-family: 'Quicksand', sans-serif;
      font-size: 13px;
      color: #888;
      margin-bottom: 14px;
    }
    .tdv2-acc-loc i { color: var(--aw-primary); }
    .tdv2-acc-desc {
      font-family: 'Raleway', sans-serif;
      font-size: 14px;
      line-height: 1.7;
      color: #555;
    }
    @media (max-width: 640px) {
      .tdv2-acc-card { flex-direction: column; }
      .tdv2-acc-card img { width: 100%; height: 200px; }
    }

    /* ---- MAP ---- */
    .tdv2-map-wrap {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    /* ---- GALLERY ---- */
    .tdv2-gallery-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
    }
    @media (max-width: 640px) { .tdv2-gallery-grid { grid-template-columns: repeat(2, 1fr); } }
    .tdv2-gallery-item {
      aspect-ratio: 4/3;
      border-radius: 12px;
      overflow: hidden;
      display: block;
    }
    .tdv2-gallery-item img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    .tdv2-gallery-item:hover img { transform: scale(1.08); }

    /* ---- SIDEBAR ---- */
    .tdv2-sidebar { position: sticky; top: 70px; }
    .tdv2-sidebar-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 40px rgba(0,0,0,0.12);
      overflow: hidden;
    }
    .tdv2-sidebar-top {
      background: linear-gradient(135deg, var(--aw-accent-olive), #2d3b28);
      padding: 28px 28px 24px;
      text-align: center;
    }
    .tdv2-price-label {
      font-family: 'Caveat', cursive;
      font-size: 18px;
      color: var(--aw-accent-gold);
      letter-spacing: 2px;
      text-transform: uppercase;
    }
    .tdv2-price-main {
      font-family: 'Raleway', sans-serif;
      font-size: 48px;
      font-weight: 800;
      color: #fff;
      line-height: 1;
      margin: 6px 0;
    }
    .tdv2-price-per {
      font-family: 'Quicksand', sans-serif;
      font-size: 12px;
      color: rgba(255,255,255,0.6);
    }
    .tdv2-sidebar-stats {
      display: flex;
      border-top: 1px solid rgba(255,255,255,0.1);
      margin-top: 20px;
    }
    .tdv2-sidebar-stat {
      flex: 1;
      text-align: center;
      padding: 14px 8px;
      border-right: 1px solid rgba(255,255,255,0.1);
    }
    .tdv2-sidebar-stat:last-child { border-right: none; }
    .tdv2-sidebar-stat i { font-size: 16px; color: var(--aw-accent-gold); display: block; margin-bottom: 4px; }
    .tdv2-sidebar-stat span { font-family: 'Quicksand', sans-serif; font-size: 11px; color: rgba(255,255,255,0.6); display: block; }
    .tdv2-sidebar-stat strong { font-family: 'Raleway', sans-serif; font-size: 13px; color: #fff; display: block; }

    .tdv2-sidebar-form { padding: 24px 28px; }
    .tdv2-form-label {
      font-family: 'Quicksand', sans-serif;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #888;
      margin-bottom: 6px;
      display: block;
    }
    .tdv2-input {
      width: 100%;
      padding: 11px 14px;
      border: 2px solid #eee;
      border-radius: 10px;
      font-family: 'Quicksand', sans-serif;
      font-size: 14px;
      color: #333;
      outline: none;
      transition: border-color 0.25s;
      background: #fafafa;
      box-sizing: border-box;
    }
    .tdv2-input:focus { border-color: var(--aw-accent-sky); background: #fff; }
    .tdv2-input-group { margin-bottom: 16px; }
    .tdv2-row-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; }
    .tdv2-btn-submit {
      width: 100%;
      background: var(--aw-primary);
      color: #fff;
      padding: 14px;
      border: none;
      border-radius: 12px;
      font-family: 'Raleway', sans-serif;
      font-weight: 800;
      font-size: 15px;
      letter-spacing: 0.05em;
      cursor: pointer;
      box-shadow: 0 6px 25px rgba(255,0,0,0.35);
      transition: all 0.3s;
    }
    .tdv2-btn-submit:hover { background: var(--aw-primary-dark); transform: translateY(-2px); box-shadow: 0 10px 35px rgba(255,0,0,0.45); }
    .tdv2-trust-badges {
      padding: 16px 28px 24px;
      border-top: 1px solid #f5f5f5;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .tdv2-trust-item {
      display: flex; align-items: center; gap: 12px;
      font-family: 'Quicksand', sans-serif; font-size: 12.5px;
      color: #555; font-weight: 600;
    }
    .tdv2-trust-item i {
      width: 30px; height: 30px;
      background: var(--aw-bg-subtle);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      color: var(--aw-accent-forest);
      font-size: 13px;
      flex-shrink: 0;
    }

    /* ---- MAP TOOLTIP ---- */
    .leaflet-popup-content-wrapper { border-radius: 10px; font-family: 'Quicksand', sans-serif; }
    .leaflet-popup-content { margin: 12px 16px; font-size: 13px; line-height: 1.5; color: #1C1712; }
  </style>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="tdv2-hero" style="background-image: url('<?= htmlspecialchars($heroImg) ?>');">
  <div class="tdv2-hero-overlay"></div>

  <div class="tdv2-hero-breadcrumb">
    <a href="index"><i class="fa fa-home"></i></a>
    <span class="sep">/</span>
    <a href="tours">Tours</a>
    <span class="sep">/</span>
    <span style="color:rgba(255,255,255,0.9);"><?= htmlspecialchars($tour['title']) ?></span>
  </div>

  <div class="tdv2-hero-content">
    <div class="tdv2-hero-eyebrow">✦ Attwood Signature Safari</div>
    <h1><?= htmlspecialchars($tour['title']) ?></h1>

    <?php if ($routeStr): ?>
    <div class="tdv2-hero-route">
      <i class="fa fa-map-marker"></i>
      <?= htmlspecialchars($routeStr) ?>
    </div>
    <?php endif; ?>

    <div class="tdv2-stat-chips">
      <div class="tdv2-chip"><i class="fa fa-calendar"></i> <?= $daysCount ?> Days / <?= $nights ?> Nights</div>
      <?php if(!empty($tourCountries)): ?>
      <div class="tdv2-chip"><i class="fa fa-globe"></i> <?= implode(' &amp; ', $tourCountries) ?></div>
      <?php endif; ?>
      <?php if(!empty($steps)): ?>
      <div class="tdv2-chip"><i class="fa fa-road"></i> <?= count($steps) ?> Destinations</div>
      <?php endif; ?>
      <?php if(!empty($tour['price_from_usd']) && (float)$tour['price_from_usd'] > 0): ?>
      <div class="tdv2-chip chip-price"><i class="fa fa-tag" style="color:#fff;"></i> From <?= $price ?> / person</div>
      <?php endif; ?>
    </div>

    <div class="tdv2-hero-actions">
      <a href="#" class="tdv2-btn-cta" data-open-planner="true"
         data-tour-id="<?= $tour['id'] ?>"
         data-tour-title="<?= htmlspecialchars($tour['title']) ?>">
        <i class="fa fa-paper-plane" style="margin-right:8px;"></i> Start Planning Now
      </a>
      <a href="#itinerary-section" class="tdv2-btn-outline">View Itinerary</a>
    </div>
  </div>
</section>

<!-- ============================================================
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
</nav>

<!-- ============================================================
     MAIN CONTENT
     ============================================================ -->
<div class="tdv2-main">
  <div class="tdv2-grid">

    <!-- ====================== LEFT COLUMN ====================== -->
    <div class="tdv2-left-col">

      <!-- OVERVIEW -->
      <section class="tdv2-section" id="overview-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon"><i class="fa fa-binoculars"></i></div>
          <h2 class="tdv2-section-title">Overview</h2>
        </div>
        <div class="tdv2-prose">
          <?= !empty($tour['description']) ? $tour['description'] : '<p>' . nl2br(htmlspecialchars($tour['excerpt'] ?? '')) . '</p>' ?>
        </div>

        <?php if(!empty($tour['highlights'])): ?>
        <div class="mt-4">
          <h3 style="font-family:'Raleway',sans-serif; font-size:17px; font-weight:800; color:var(--aw-text-dark); margin-bottom:14px;">
            <i class="fa fa-star" style="color:var(--aw-accent-gold); margin-right:8px;"></i>Journey Highlights
          </h3>
          <div class="tdv2-prose"><?= $tour['highlights'] ?></div>
        </div>
        <?php else: ?>
        <div class="tdv2-highlights-grid mt-4">
          <div class="tdv2-highlight-item"><i class="fa fa-car"></i> Custom 4x4 Land Cruiser game drives</div>
          <div class="tdv2-highlight-item"><i class="fa fa-user"></i> Expert local English-speaking guides</div>
          <div class="tdv2-highlight-item"><i class="fa fa-home"></i> Premium lodge &amp; tented camp stays</div>
          <div class="tdv2-highlight-item"><i class="fa fa-camera"></i> Spectacular photography opportunities</div>
          <div class="tdv2-highlight-item"><i class="fa fa-shield"></i> Fully financially protected travel</div>
          <div class="tdv2-highlight-item"><i class="fa fa-phone"></i> 24/7 on-safari support</div>
        </div>
        <?php endif; ?>
      </section>

      <!-- ITINERARY TIMELINE -->
      <section class="tdv2-section" id="itinerary-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon" style="background:var(--aw-accent-sky);"><i class="fa fa-map" style="color:#fff;"></i></div>
          <h2 class="tdv2-section-title">Itinerary</h2>
        </div>

        <div class="tdv2-timeline">
          <?php foreach($steps as $idx => $step): ?>
          <div class="tdv2-timeline-item">
            <div class="tdv2-timeline-badge">D<?= $step['step_number'] ?></div>
            <div class="tdv2-timeline-card">
              <div class="tdv2-timeline-card-header">
                <div class="tdv2-timeline-dest"><?= htmlspecialchars($step['dest_name']) ?></div>
                <div class="tdv2-timeline-meta-chips">
                  <?php if($step['nights_count'] > 1): ?>
                  <span class="tdv2-meta-chip chip-gold"><i class="fa fa-moon-o"></i> <?= $step['nights_count'] ?> Nights</span>
                  <?php endif; ?>
                  <?php if($step['acc_name']): ?>
                  <span class="tdv2-meta-chip"><i class="fa fa-bed"></i> <?= htmlspecialchars($step['acc_name']) ?></span>
                  <?php endif; ?>
                  <?php if($step['transit_mode']): ?>
                  <span class="tdv2-meta-chip"><i class="fa fa-car"></i> <?= htmlspecialchars($step['transit_mode']) ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="tdv2-timeline-body">
                <div class="tdv2-timeline-body-text">
                  <?= $step['step_description'] ?>
                </div>
                <?php if($step['step_image']): ?>
                <img src="uploads/<?= htmlspecialchars($step['step_image']) ?>" alt="Day <?= $step['step_number'] ?>" class="tdv2-step-img">
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- INCLUSIONS / EXCLUSIONS -->
      <section class="tdv2-section" id="inclusions-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon" style="background:var(--aw-accent-forest);"><i class="fa fa-check" style="color:#fff;"></i></div>
          <h2 class="tdv2-section-title">Inclusions</h2>
        </div>
        <div class="tdv2-inc-grid">
          <div class="tdv2-inc-card included">
            <div class="tdv2-inc-card-title">
              <i class="fa fa-check-circle"></i> What's Included
            </div>
            <div class="inc-list">
              <?= !empty($tour['inclusions']) ? $tour['inclusions'] : '<ul><li>All park entrance fees and taxes</li><li>Full board accommodation as per itinerary</li><li>Exclusive use of 4x4 Safari Land Cruiser</li><li>Professional English-speaking driver/guide</li><li>Airport transfers</li><li>Drinking water during game drives</li><li>Flying Doctors emergency evacuation cover</li></ul>' ?>
            </div>
          </div>
          <div class="tdv2-inc-card excluded">
            <div class="tdv2-inc-card-title">
              <i class="fa fa-times-circle"></i> What's Excluded
            </div>
            <div class="inc-list">
              <?= !empty($tour['exclusions']) ? $tour['exclusions'] : '<ul><li>International flights and visa fees</li><li>Travel insurance (highly recommended)</li><li>Tips and gratuities for guides/staff</li><li>Items of a personal nature</li><li>Optional activities (e.g., balloon safari)</li></ul>' ?>
            </div>
          </div>
        </div>
      </section>

      <!-- PRICING -->
      <section class="tdv2-section" id="pricing-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon" style="background:var(--aw-primary);"><i class="fa fa-usd" style="color:#fff;"></i></div>
          <h2 class="tdv2-section-title">Pricing</h2>
        </div>
        <div style="border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">
          <table class="tdv2-pricing-table">
            <thead>
              <tr>
                <th>Group Size</th>
                <th>Adult (USD)</th>
                <th>Child (USD)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tiers = [1=>'1 Person',2=>'2 People',3=>'3 People',4=>'4 People',5=>'5 People',6=>'6 People'];
              $hasPricing = false;
              foreach($tiers as $num => $label) {
                $adultP = $tour["price_{$num}_pax"] ?? null;
                $childP = $tour["price_child_{$num}_pax"] ?? null;
                if(((float)$adultP > 0) || ((float)$childP > 0)) {
                  $hasPricing = true;
                  $aDisp = ((float)$adultP > 0) ? '$'.number_format((float)$adultP) : '—';
                  $cDisp = ((float)$childP > 0) ? '$'.number_format((float)$childP) : '—';
                  echo "<tr><td>{$label}</td><td>{$aDisp}</td><td>{$cDisp}</td></tr>";
                }
              }
              if(!$hasPricing) echo "<tr><td colspan='3' style='text-align:center; color:#888; font-style:italic;'>Contact us for pricing details.</td></tr>";
              ?>
            </tbody>
          </table>
        </div>
        <p style="font-family:'Quicksand',sans-serif; font-size:12px; color:#999; margin-top:12px;">
          * Prices subject to seasonality and availability. Children under 12 years.
        </p>
      </section>

      <!-- ACCOMMODATIONS -->
      <section class="tdv2-section" id="accommodations-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon" style="background:#6c757d;"><i class="fa fa-bed" style="color:#fff;"></i></div>
          <h2 class="tdv2-section-title">Accommodations</h2>
        </div>
        <?php
          $hasAcc = false;
          foreach($steps as $s) { if($s['acc_id']) { $hasAcc = true; break; } }
          $dayStart = 1;
        ?>
        <?php if($hasAcc): ?>
          <?php foreach($steps as $idx => $step):
            $nights_count = max(1, $step['nights_count']);
            $dayEnd = $dayStart + $nights_count - 1;
            $dayLabel = ($dayStart == $dayEnd) ? "Day $dayStart" : "Day $dayStart – $dayEnd";
            $dayStart += $nights_count;
            if(!$step['acc_id']) continue;
            $img = $step['acc_image'] ? 'uploads/'.htmlspecialchars($step['acc_image']) : 'images/Attwood/East Africa/Sopa Lodges/dining-by-the-waterhole-in-samburu-sopa-lodge.jpg';
          ?>
          <div class="tdv2-acc-card">
            <img src="<?= $img ?>" alt="<?= htmlspecialchars($step['acc_name'] ?? 'Accommodation') ?>">
            <div class="tdv2-acc-body">
              <span class="tdv2-acc-day-badge"><?= $dayLabel ?></span>
              <div class="tdv2-acc-name"><?= htmlspecialchars($step['acc_name'] ?? 'Accommodation TBD') ?></div>
              <div class="tdv2-acc-loc">
                <i class="fa fa-map-marker"></i>
                <?= htmlspecialchars($step['dest_name'] ?? 'Various') ?> &mdash; <?= $nights_count ?> night(s)
              </div>
              <div class="tdv2-acc-desc"><?= html_entity_decode($step['acc_desc'] ?? 'Details will be provided upon booking.') ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="font-family:'Raleway',sans-serif; color:#888;">Standard premium lodges and camps are selected based on availability and season.</p>
        <?php endif; ?>
      </section>

      <!-- MAP -->
      <section class="tdv2-section" id="map-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon" style="background:var(--aw-accent-sky);"><i class="fa fa-map-marker" style="color:#fff;"></i></div>
          <h2 class="tdv2-section-title">Route Map</h2>
        </div>
        <div class="tdv2-map-wrap">
          <div id="tourMap" style="height:480px; background:#e5e5e5; display:flex; align-items:center; justify-content:center;">
            <span style="color:#888; font-family:'Quicksand',sans-serif;">Loading map&hellip;</span>
          </div>
        </div>
        <p style="font-family:'Quicksand',sans-serif; font-size:11.5px; color:#aaa; margin-top:10px; text-align:center;">
          * Route is illustrative. Actual transit paths may vary.
        </p>
      </section>

      <!-- GALLERY -->
      <section class="tdv2-section" id="gallery-section">
        <div class="tdv2-section-header">
          <div class="tdv2-section-icon" style="background:var(--aw-primary);"><i class="fa fa-image" style="color:#fff;"></i></div>
          <h2 class="tdv2-section-title">Gallery</h2>
        </div>
        <div class="tdv2-gallery-grid popup-gallery">
          <?php if(count($gallery) > 0):
            foreach($gallery as $img): ?>
            <a href="uploads/<?= htmlspecialchars($img['image_path'] ?? '') ?>" class="tdv2-gallery-item" title="<?= htmlspecialchars($img['caption'] ?? '') ?>">
              <img src="uploads/<?= htmlspecialchars($img['image_path'] ?? '') ?>" alt="Gallery" loading="lazy">
            </a>
          <?php endforeach;
          else:
            $fallbackImages = [
              'images/Attwood/East Africa/pexels-droneafrica-13234382.jpg',
              'images/Attwood/East Africa/Maasai Mara/free-photo-of-majestic-african-elephant-in-kenyan-savanna (6).jpeg',
              'images/Attwood/East Africa/Amboseli/Sarova-Shaba-Safari-breakfast-in-the-wild.jpg',
              'images/Attwood/East Africa/pexels-kelly-17291020.jpg',
              'images/Attwood/East Africa/pexels-balazsimon-15993990.jpg',
              'images/Attwood/East Africa/Maasai Mara/free-photo-of-leopard-resting-in-tree-masai-mara-kenya (4).jpeg'
            ];
            foreach($fallbackImages as $fimg): ?>
            <a href="<?= $fimg ?>" class="tdv2-gallery-item">
              <img src="<?= $fimg ?>" alt="Safari Gallery" loading="lazy">
            </a>
          <?php endforeach; endif; ?>
        </div>
      </section>

    </div><!-- /left col -->

    <!-- ====================== SIDEBAR ====================== -->
    <aside class="tdv2-sidebar">
      <div class="tdv2-sidebar-card">
        <!-- Price Header -->
        <div class="tdv2-sidebar-top">
          <div class="tdv2-price-label">From</div>
          <div class="tdv2-price-main"><?= $price ?></div>
          <div class="tdv2-price-per">per person sharing</div>

          <div class="tdv2-sidebar-stats">
            <div class="tdv2-sidebar-stat">
              <i class="fa fa-calendar"></i>
              <strong><?= $daysCount ?></strong>
              <span>Days</span>
            </div>
            <div class="tdv2-sidebar-stat">
              <i class="fa fa-moon-o"></i>
              <strong><?= $nights ?></strong>
              <span>Nights</span>
            </div>
            <div class="tdv2-sidebar-stat">
              <i class="fa fa-users"></i>
              <strong>1–6</strong>
              <span>Pax</span>
            </div>
          </div>
        </div>

        <!-- Enquiry Form -->
        <div class="tdv2-sidebar-form">
          <div id="tourEnquiryFeedback" class="alert" style="display:none;font-size:13px;padding:12px; margin-bottom:16px;"></div>
          <form id="tourEnquiryForm" action="#" method="POST">
            <input type="hidden" name="type" value="tour_enquiry">
            <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
            <input type="hidden" name="tour_title" value="<?= htmlspecialchars($tour['title']) ?>">

            <div class="tdv2-input-group">
              <label class="tdv2-form-label">Full Name</label>
              <input type="text" name="first_name" class="tdv2-input" placeholder="Jane Doe" required>
            </div>
            <div class="tdv2-input-group">
              <label class="tdv2-form-label">Email Address</label>
              <input type="email" name="email" class="tdv2-input" placeholder="jane@example.com" required>
            </div>
            <div class="tdv2-input-group">
              <label class="tdv2-form-label">Phone / WhatsApp</label>
              <input type="tel" id="tourPhone" class="tdv2-input" placeholder="" style="width:100%;">
            </div>
            <div class="tdv2-input-group">
              <label class="tdv2-form-label">Travel Date</label>
              <input type="date" name="travel_date" class="tdv2-input" required>
            </div>
            <div class="tdv2-row-inputs">
              <div>
                <label class="tdv2-form-label">Adults</label>
                <input type="number" name="adults" class="tdv2-input" min="1" value="2" required>
              </div>
              <div>
                <label class="tdv2-form-label">Children</label>
                <input type="number" name="children" class="tdv2-input" min="0" value="0">
              </div>
            </div>
            <p style="font-family:'Quicksand',sans-serif; font-size:10.5px; color:var(--aw-primary); margin-bottom:12px; margin-top:-8px;">* Children are under 12 years.</p>
            <div class="tdv2-input-group">
              <label class="tdv2-form-label">Message</label>
              <textarea name="message" class="tdv2-input" rows="3" placeholder="Tell us about your dream safari..."></textarea>
            </div>
            <button type="submit" id="tourEnquiryBtn" class="tdv2-btn-submit">
              <i class="fa fa-paper-plane" style="margin-right:8px;"></i> Send Enquiry
            </button>
            <p style="font-family:'Quicksand',sans-serif; font-size:10.5px; color:#aaa; text-align:center; margin-top:10px;">
              No payment required now. We reply within 24hrs.
            </p>
          </form>
        </div>

        <!-- Trust Badges -->
        <div class="tdv2-trust-badges">
          <div class="tdv2-trust-item">
            <i class="fa fa-shield"></i>
            100% Financial Protection
          </div>
          <div class="tdv2-trust-item">
            <i class="fa fa-refresh"></i>
            Flexible Booking Terms
          </div>
          <div class="tdv2-trust-item">
            <i class="fa fa-comments"></i>
            24/7 On-Safari Support
          </div>
        </div>
      </div>
    </aside>

  </div><!-- /grid -->
</div><!-- /main -->

<?php require_once 'includes/footer.php'; ?>

<script>
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
</script>

'''

new_content = php_block + new_html + scripts_block

with open(path, 'w', encoding='utf-8') as f:
    f.write(new_content)

print(f"Done. Wrote {len(new_content)} bytes to {path}")
