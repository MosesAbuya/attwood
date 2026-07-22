<?php
require_once 'includes/db.php';
$slug = $_GET['slug'] ?? '';
$id = intval($_GET['id'] ?? 0);

if (!$slug && !$id) { header('Location: /attwood/activities'); exit; }
$pdo = getPDO();

if ($slug) {
    $act = $pdo->prepare('SELECT * FROM activities WHERE slug=?');
    $act->execute([$slug]);
} else {
    $act = $pdo->prepare('SELECT * FROM activities WHERE id=?');
    $act->execute([$id]);
}

$act = $act->fetch();
if (!$act) { header('Location: /attwood/activities'); exit; }
$id = $act['id'];

// Related tours using pivot table activity_tour
$tours = $pdo->prepare('
    SELECT DISTINCT t.id, t.title, t.slug, t.duration_days, t.price_from_usd, t.excerpt, t.description, t.featured_image 
    FROM tours t 
    LEFT JOIN activity_tour at ON at.tour_id = t.id 
    LEFT JOIN tour_taxonomy_pivot ttp ON t.id = ttp.tour_id
    LEFT JOIN taxonomies tx ON ttp.taxonomy_id = tx.id
    WHERE (at.activity_id = ? OR (tx.type = "activity" AND (? LIKE CONCAT("%", tx.name, "%") OR tx.name = ?))) 
    AND t.status="published" 
    LIMIT 6
');
$tours->execute([$id, $act['name'], $act['name']]);
$tours = $tours->fetchAll();

$img = $act['featured_image'];
if (!empty($img) && !str_starts_with($img, 'http') && !str_starts_with($img, 'images/')) {
    $img = 'uploads/' . $img;
}
$heroImg = $img ?: 'images/Attwood/East Africa/pexels-droneafrica-15373902.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $base_href = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') ? '/attwood/' : '/'; ?>
  <base href="<?= $base_href ?>">
  <title><?= htmlspecialchars($act['name']) ?> &mdash; Attwood Travel Agency Ltd</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css?v=<?= time() ?>">
  <link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<section class="tdv2-hero" style="background-image:url('<?= htmlspecialchars($heroImg) ?>');">
  <div class="tdv2-hero-overlay"></div>
  <div class="tdv2-hero-content">
    <div class="tdv2-hero-eyebrow" style="margin-bottom:12px;"><?= htmlspecialchars($act['category']) ?></div>
    <h1><?= htmlspecialchars($act['name']) ?></h1>
    <div class="tdv2-hero-actions" style="margin-top:24px;">
      <button data-open-planner="true" class="tdv2-btn-cta">Enquire Now</button>
    </div>
  </div>
  <div class="tdv2-hero-breadcrumb">
      <a href="index"><i class="fa fa-home"></i></a>
      <span class="sep">/</span>
      <a href="activities">Activities</a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($act['name']) ?></span>
  </div>
</section>

<!-- Content -->
<section style="padding:80px 0; background:#F7F5F0;">
  <div class="container" style="max-width:1280px;">
    <div class="row g-5">
      <!-- Main Activity Info -->
      <div class="col-lg-8">
        <div style="background:#fff;border-radius:12px;box-shadow:var(--aw-shadow-card);padding:48px;margin-bottom:40px;border:1px solid var(--aw-border);">
          <h2 style="font-family:var(--aw-font-body);font-size:36px;font-weight:800;color:var(--aw-text-dark);margin-bottom:24px;">Experience <?= htmlspecialchars($act['name']) ?></h2>
          
          <div style="font-family:var(--aw-font-body);font-size:17px;line-height:1.8;color:var(--aw-text-body);">
            <p><?= nl2br(htmlspecialchars($act['description'] ?? 'Prepare for an unforgettable experience in the heart of nature.')) ?></p>
            <p>At Attwood Travel Agency Ltd, we ensure that your activities are carefully tailored to your pace and preferences. Whether you seek thrilling adventures or peaceful relaxation, our expert guides provide unparalleled insight and hospitality.</p>
          </div>
        </div>
      </div>
      
      <!-- Sidebar / CTA -->
      <div class="col-lg-4">
        <div style="background:var(--aw-accent-olive);border-radius:12px;box-shadow:var(--aw-shadow-card);padding:40px 32px;text-align:center;position:sticky;top:150px;">
          <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-accent-gold);font-family:var(--aw-font-ui);display:block;margin-bottom:12px;">Tailor-Made Travel</span>
          <h3 style="font-family:var(--aw-font-body);font-size:28px;font-weight:800;color:#fff;margin:0 0 16px;">Add this to your journey</h3>
          <p style="font-size:15px;color:rgba(255,255,255,0.8);font-family:var(--aw-font-body);margin-bottom:32px;">Speak to our safari experts to incorporate <?= htmlspecialchars($act['name']) ?> into your bespoke African itinerary.</p>
          <button data-open-planner="true" class="tdv2-btn-cta" style="width:100%;">Enquire Now</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Related Tours (Using Pivot Table) -->
<?php if (count($tours) > 0): ?>
<section style="padding:80px 0; background:#fff; border-top:1px solid var(--aw-border);">
  <div class="container" style="max-width:1280px;">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:40px;">
      <div>
        <span style="font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-accent-gold);font-family:var(--aw-font-ui);">Tours &amp; Safaris</span>
        <h2 style="font-family:var(--aw-font-body);font-size:42px;font-weight:800;color:var(--aw-text-dark);margin-top:8px;">Tours Featuring <?= htmlspecialchars($act['name']) ?></h2>
      </div>
      <a href="tours" class="tdv2-btn-outline" style="color:var(--aw-text-dark) !important; border-color:var(--aw-border);">View All Tours &rarr;</a>
    </div>

    <div class="row">
      <?php foreach($tours as $t): 
        $tImg = $t['featured_image'];
        if (!empty($tImg) && !str_starts_with($tImg, 'http') && !str_starts_with($tImg, 'images/')) {
            $tImg = 'uploads/' . $tImg;
        }
        $tImg = $tImg ?: 'images/Attwood/East Africa/pexels-droneafrica-13234382.jpg';
        $nights = max(1, $t['duration_days'] - 1);
      ?>
      <div class="col-md-6 col-lg-4 mb-4 d-flex">
        <div class="aw-tour-card w-100">
          <div class="aw-tour-img-wrap">
            <div class="aw-tour-featured">Featured</div>
            <a href="tours/<?= $t['slug'] ?? '' ?>">
              <img src="<?= htmlspecialchars($tImg) ?>" alt="<?= htmlspecialchars($t['title'] ?? '') ?>" loading="lazy">
            </a>
          </div>
          <div class="aw-tour-body">
            <div class="aw-tour-title"><a href="tours/<?= $t['slug'] ?? '' ?>"><?= htmlspecialchars($t['title'] ?? '') ?></a></div>
            
            <div class="aw-tour-details-row">
              <div class="aw-tour-meta">
                <div class="aw-tour-meta-item">
                  <i class="fa fa-map-marker"></i>
                  <span><?= getTourCountries($pdo, $t['id']) ?></span>
                </div>
                <div class="aw-tour-meta-item">
                  <i class="fa fa-clock-o"></i>
                  <span><?= ($nights+1) ?> Days - <?= $nights ?> Nights</span>
                </div>
              </div>
              
              <div class="aw-tour-price-box">
                <?php if (!empty($t['price_from_usd'])): ?>
                  <span class="aw-tour-discount">Best Offer</span>
                  <div class="aw-tour-old-price">$<?= number_format($t['price_from_usd'] * 1.15) ?></div>
                  <div class="aw-tour-new-price">$<?= number_format($t['price_from_usd']) ?></div>
                <?php else: ?>
                  <div class="aw-tour-new-price" style="font-size:14px;color:#ff6a1a;">Enquire Now</div>
                <?php endif; ?>
              </div>
            </div>

            <a href="tours/<?= $t['slug'] ?? '' ?>" class="aw-tour-cta-btn">View Details</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>`n<script src="js/start-planning.js?v=1781967414"></script>
</body>
</html>
