<?php
require_once 'includes/db.php';
$slug = $_GET['slug'] ?? '';
$id = intval($_GET['id'] ?? 0);

if (!$slug && !$id) { header('Location: destinations.php'); exit; }
$pdo = getPDO();

if ($slug) {
    $dest = $pdo->prepare('SELECT * FROM destinations WHERE slug=?');
    $dest->execute([$slug]);
} else {
    $dest = $pdo->prepare('SELECT * FROM destinations WHERE id=?');
    $dest->execute([$id]);
}

$dest = $dest->fetch();
if (!$dest) { header('Location: destinations.php'); exit; }
$id = $dest['id']; // normalize

// Related tours
$tours = $pdo->prepare('SELECT DISTINCT t.id, t.title, t.slug, t.duration_days, t.price_from_usd, t.excerpt, t.featured_image FROM tours t JOIN itinerary_steps ist ON ist.tour_id=t.id WHERE ist.destination_id=? AND t.status="published" LIMIT 3');
$tours->execute([$id]);
$tours = $tours->fetchAll();

$img = $dest['featured_image'];
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
  <title><?= htmlspecialchars($dest['name']) ?> &mdash; Attwood Travel Agency Ltd</title>
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
    <div class="tdv2-hero-eyebrow" style="margin-bottom:12px;"><?= htmlspecialchars($dest['country']) ?></div>
    <h1><?= htmlspecialchars($dest['name']) ?></h1>
    <div class="tdv2-hero-actions" style="margin-top:24px;">
      <a href="#" class="tdv2-btn-cta" data-open-planner="true">Start Planning Now</a>
    </div>
  </div>
  <div class="tdv2-hero-breadcrumb">
      <a href="index"><i class="fa fa-home"></i></a>
      <span class="sep">/</span>
      <a href="destinations">Destinations</a>
      <span class="sep">/</span>
      <a href="country?name=<?= urlencode($dest['country']) ?>"><?= htmlspecialchars($dest['country']) ?></a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($dest['name']) ?></span>
  </div>
</section>

<section class="section-pad bg-cream">
  <div class="container" style="max-width:1280px;">
    <div class="row">
      <div class="col-lg-8 pr-lg-5">
        <div style="background:#fff;padding:40px;border-radius:12px;box-shadow:var(--aw-shadow-card);margin-bottom:48px;">
          <h2 style="font-family:var(--aw-font-body);font-size:32px;font-weight:800;color:var(--aw-text-dark);margin-bottom:24px;">About <?= htmlspecialchars($dest['name']) ?></h2>
          <div style="font-size:16px;color:var(--aw-text-body);line-height:1.8;">
            <?php if($dest['description']): ?>
              <?= $dest['description'] ?>
            <?php else: ?>
              <p><?= htmlspecialchars($dest['name']) ?> is one of <?= htmlspecialchars($dest['country']) ?>'s premier travel destinations. Whether you are looking for spectacular wildlife encounters, stunning landscapes, or pure relaxation, this region offers an unforgettable experience. At Attwood Travel Agency Ltd, we craft tailor-made journeys that allow you to explore <?= htmlspecialchars($dest['name']) ?> at your own pace, staying at the finest hand-picked lodges and camps.</p>
              <p>Speak to one of our safari experts to start designing your perfect itinerary.</p>
            <?php endif; ?>
          </div>
        </div>

        <div class="aw-section-heading">
          <h2>Tours Visiting <?= htmlspecialchars($dest['name']) ?></h2>
        </div>
        
        <?php if(count($tours) > 0): ?>
          <div class="row">
            <?php foreach($tours as $tour): 
              $img = $tour['featured_image'] ? 'uploads/'.$tour['featured_image'] : 'images/Attwood/East Africa/pexels-balazsimon-15993990.jpg';
              $nights = $tour['duration_days'] - 1;
            ?>
            <div class="col-md-6 mb-4 d-flex">
              <div class="aw-tour-card w-100">
                <div class="aw-tour-img-wrap">
                  <div class="aw-tour-featured">Featured</div>
                  <a href="tours/<?= $tour['slug'] ?? '' ?>">
                    <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($tour['title'] ?? '') ?>" loading="lazy">
                  </a>
                </div>
                <div class="aw-tour-body">
                  <div class="aw-tour-title"><a href="tours/<?= $tour['slug'] ?? '' ?>"><?= htmlspecialchars($tour['title'] ?? '') ?></a></div>
                  
                  <div class="aw-tour-details-row">
                    <div class="aw-tour-meta">
                      <div class="aw-tour-meta-item">
                        <i class="fa fa-map-marker"></i>
                        <span><?= getTourCountries($pdo, $tour['id']) ?></span>
                      </div>
                      <div class="aw-tour-meta-item">
                        <i class="fa fa-clock-o"></i>
                        <span><?= ($nights+1) ?> Days - <?= $nights ?> Nights</span>
                      </div>
                    </div>
                    
                    <div class="aw-tour-price-box">
                      <?php if (!empty($tour['price_from_usd'])): ?>
                        <span class="aw-tour-discount">Best Offer</span>
                        <div class="aw-tour-old-price">$<?= number_format($tour['price_from_usd'] * 1.15) ?></div>
                        <div class="aw-tour-new-price">$<?= number_format($tour['price_from_usd']) ?></div>
                      <?php else: ?>
                        <div class="aw-tour-new-price" style="font-size:14px;color:#ff6a1a;">Enquire Now</div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <a href="tours/<?= $tour['slug'] ?? '' ?>" class="aw-tour-cta-btn">View Details</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div style="background:#fff;padding:32px;border-left:3px solid #C49018;">
            <p style="font-size:15px;color:#4A4340;margin-bottom:16px;">We currently do not have any published set-departure tours that visit this destination. However, as tailor-made specialists, we can easily incorporate <?= htmlspecialchars($dest['name']) ?> into a custom itinerary for you.</p>
            <a href="#" class="tc-cta" data-open-planner="true" data-dest-name="<?= htmlspecialchars($dest['name']) ?>">Plan a Custom Safari</a>
          </div>
        <?php endif; ?>

      </div>
      
      <div class="col-lg-4">
        <div style="border-radius:12px;padding:32px;background:#fff;box-shadow:var(--aw-shadow-card);position:sticky;top:150px;border:1px solid var(--aw-border);">
          <h3 style="font-family:var(--aw-font-body);font-size:22px;font-weight:800;color:var(--aw-text-dark);margin-bottom:24px;border-bottom:1px solid var(--aw-border);padding-bottom:12px;">Quick Facts</h3>
          
          <div class="mb-4">
            <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-text-muted);font-family:var(--aw-font-ui);display:block;margin-bottom:6px;">Country</span>
            <span style="font-size:16px;color:var(--aw-text-dark);font-weight:600;"><i class="fa fa-map-marker" style="color:var(--aw-primary);width:16px;"></i> <?= htmlspecialchars($dest['country']) ?></span>
          </div>
          
          <div class="mb-4">
            <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-text-muted);font-family:var(--aw-font-ui);display:block;margin-bottom:6px;">Region Type</span>
            <span style="font-size:16px;color:var(--aw-text-dark);font-weight:600;"><i class="fa fa-tag" style="color:var(--aw-primary);width:16px;"></i> <?= htmlspecialchars($dest['region_type'] ?: 'National Park') ?></span>
          </div>
          
          <div class="mb-5">
            <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-text-muted);font-family:var(--aw-font-ui);display:block;margin-bottom:6px;">Best Time To Visit</span>
            <span style="font-size:16px;color:var(--aw-text-dark);font-weight:600;"><i class="fa fa-calendar" style="color:var(--aw-primary);width:16px;"></i> June to October</span>
          </div>

          <button data-open-planner="true" data-dest-name="<?= htmlspecialchars($dest['name']) ?>" class="tdv2-btn-cta" style="width:100%;">Plan a Trip Here</button>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>`n<script src="js/start-planning.js?v=1781967414"></script>
</body>
</html>
