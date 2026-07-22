<?php
require_once 'includes/db.php';
$pdo = getPDO();
$activities = $pdo->query("SELECT id, name, slug, category, featured_image FROM activities ORDER BY name ASC")->fetchAll();

$acts = [];
foreach($activities as $act) {
  $tab = 'other';
  if (str_contains(strtolower($act['category']), 'wildlife')) {
      $tab = 'wildlife';
  } elseif (str_contains(strtolower($act['category']), 'adventure')) {
      $tab = 'adventure';
  } elseif (str_contains(strtolower($act['category']), 'cultural')) {
      $tab = 'cultural';
  } elseif (str_contains(strtolower($act['category']), 'water')) {
      $tab = 'water';
  }

  $img = $act['featured_image'];
  if (!empty($img) && !str_starts_with($img, 'http') && !str_starts_with($img, 'images/')) {
      $img = 'uploads/' . $img;
  }
  if (empty($img)) {
      $img = 'images/Attwood/East Africa/pexels-droneafrica-15373902.jpg'; // fallback
  }

  $acts[] = [
    'id' => $act['id'],
    'name' => $act['name'],
    'category' => $act['category'],
    'img' => $img,
    'link' => 'activities/'.$act['slug'],
    'tab' => $tab
  ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $base_href = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') ? '/attwood/' : '/'; ?>
  <base href="<?= $base_href ?>">
  <title>Safari Activities &mdash; Attwood Travel Agency Ltd</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css">
  <style>
    .dest-tabs { display:flex;gap:32px;justify-content:center;margin-bottom:48px;border-bottom:1px solid #E5DDD0; }
    .dest-tabs .nav-link { background:none;border:none;padding:12px 0;font-size:11.5px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#6B6358;border-bottom:2px solid transparent;border-radius:0;font-family:'Inter',sans-serif; }
    .dest-tabs .nav-link:hover { color:#C49018; }
    .dest-tabs .nav-link.active { color:#9E3A25;border-bottom-color:#9E3A25; }
    
    .dest-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px; }
  </style>
<link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<!-- Page Hero -->
<section class="tdv2-hero" style="background-image:url('oldattwood/img/slider/slide8.jpg');">
  <div class="tdv2-hero-overlay"></div>
  <div class="tdv2-hero-content">
    <div class="tdv2-hero-eyebrow">Discover</div>
    <h1>Explore Activities</h1>
  </div>
  <div class="tdv2-hero-breadcrumb">
      <a href="index"><i class="fa fa-home"></i></a>
      <span class="sep">/</span>
      <span>Activities</span>
  </div>
</section>

<!-- Content -->
<section class="section-pad bg-cream">
  <div class="container" style="max-width:1280px;">
    
    <ul class="nav dest-tabs" id="destTabs" role="tablist">
      <li class="nav-item">
        <button class="nav-link active" id="all-tab" data-toggle="tab" data-target="#tab-all" type="button" role="tab">All Activities</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="wildlife-tab" data-toggle="tab" data-target="#tab-wildlife" type="button" role="tab">Wildlife</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="adventure-tab" data-toggle="tab" data-target="#tab-adventure" type="button" role="tab">Adventure</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="cultural-tab" data-toggle="tab" data-target="#tab-cultural" type="button" role="tab">Cultural</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="water-tab" data-toggle="tab" data-target="#tab-water" type="button" role="tab">Water & Beach</button>
      </li>
    </ul>

    <div class="tab-content">
      <!-- ALL -->
      <div class="tab-pane fade show active" id="tab-all" role="tabpanel">
        <div class="tdv2-dest-grid">
          <?php foreach($acts as $a): ?>
          <a href="<?= $a['link'] ?>" class="tdv2-dest-card">
            <img src="<?= htmlspecialchars($a['img']) ?>" alt="<?= htmlspecialchars($a['name']) ?>" loading="lazy">
            <div class="tdv2-dc-overlay"></div>
            <div class="tdv2-dc-text">
              <div class="tdv2-dc-region"><?= htmlspecialchars($a['category']) ?></div>
              <div class="tdv2-dc-name"><?= htmlspecialchars($a['name']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      
      <!-- WILDLIFE -->
      <div class="tab-pane fade" id="tab-wildlife" role="tabpanel">
        <div class="tdv2-dest-grid">
          <?php foreach($acts as $a): if($a['tab'] !== 'wildlife') continue; ?>
          <a href="<?= $a['link'] ?>" class="tdv2-dest-card">
            <img src="<?= htmlspecialchars($a['img']) ?>" alt="<?= htmlspecialchars($a['name']) ?>" loading="lazy">
            <div class="tdv2-dc-overlay"></div>
            <div class="tdv2-dc-text">
              <div class="tdv2-dc-region"><?= htmlspecialchars($a['category']) ?></div>
              <div class="tdv2-dc-name"><?= htmlspecialchars($a['name']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ADVENTURE -->
      <div class="tab-pane fade" id="tab-adventure" role="tabpanel">
        <div class="tdv2-dest-grid">
          <?php foreach($acts as $a): if($a['tab'] !== 'adventure') continue; ?>
          <a href="<?= $a['link'] ?>" class="tdv2-dest-card">
            <img src="<?= htmlspecialchars($a['img']) ?>" alt="<?= htmlspecialchars($a['name']) ?>" loading="lazy">
            <div class="tdv2-dc-overlay"></div>
            <div class="tdv2-dc-text">
              <div class="tdv2-dc-region"><?= htmlspecialchars($a['category']) ?></div>
              <div class="tdv2-dc-name"><?= htmlspecialchars($a['name']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- CULTURAL -->
      <div class="tab-pane fade" id="tab-cultural" role="tabpanel">
        <div class="tdv2-dest-grid">
          <?php foreach($acts as $a): if($a['tab'] !== 'cultural') continue; ?>
          <a href="<?= $a['link'] ?>" class="tdv2-dest-card">
            <img src="<?= htmlspecialchars($a['img']) ?>" alt="<?= htmlspecialchars($a['name']) ?>" loading="lazy">
            <div class="tdv2-dc-overlay"></div>
            <div class="tdv2-dc-text">
              <div class="tdv2-dc-region"><?= htmlspecialchars($a['category']) ?></div>
              <div class="tdv2-dc-name"><?= htmlspecialchars($a['name']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- WATER -->
      <div class="tab-pane fade" id="tab-water" role="tabpanel">
        <div class="tdv2-dest-grid">
          <?php foreach($acts as $a): if($a['tab'] !== 'water') continue; ?>
          <a href="<?= $a['link'] ?>" class="tdv2-dest-card">
            <img src="<?= htmlspecialchars($a['img']) ?>" alt="<?= htmlspecialchars($a['name']) ?>" loading="lazy">
            <div class="tdv2-dc-overlay"></div>
            <div class="tdv2-dc-text">
              <div class="tdv2-dc-region"><?= htmlspecialchars($a['category']) ?></div>
              <div class="tdv2-dc-name"><?= htmlspecialchars($a['name']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

  </div>
</section>

<?php require_once 'includes/footer.php'; ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>
</body>
</html>
