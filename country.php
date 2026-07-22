<?php
require_once 'includes/db.php';
$pdo = getPDO();

$countryName = isset($_GET['name']) ? trim($_GET['name']) : '';
if (empty($countryName)) {
    header('Location: destinations.php');
    exit;
}

// Fetch country and region data
$stmtCountry = $pdo->prepare("SELECT c.featured_image as c_img, r.name as r_name FROM countries c LEFT JOIN regions r ON c.region_id = r.id WHERE c.name = ?");
$stmtCountry->execute([$countryName]);
$countryData = $stmtCountry->fetch();

$heroImg = 'images/Attwood/East Africa/pexels-droneafrica-15373902.jpg';
$regionName = 'Africa';
if ($countryData) {
    if (!empty($countryData['c_img'])) {
        $img = $countryData['c_img'];
        if (str_starts_with($img, 'images/')) {
            $heroImg = $img;
        } elseif (str_starts_with($img, 'destinations/') || str_starts_with($img, 'countries/') || str_starts_with($img, 'regions/')) {
            $heroImg = 'uploads/' . $img;
        } else {
            $heroImg = 'uploads/destinations/' . $img;
        }
    }
    if (!empty($countryData['r_name'])) {
        $regionName = $countryData['r_name'];
    }
}

$stmt = $pdo->prepare("SELECT id, name, slug, country, region_type, featured_image, latitude, longitude FROM destinations WHERE country = ? ORDER BY name ASC");
$stmt->execute([$countryName]);
$destinations = $stmt->fetchAll();

$dests = [];
foreach($destinations as $dest) {
  // Handle image path
  $img = $dest['featured_image'];
  if (!empty($img) && !str_starts_with($img, 'http') && !str_starts_with($img, 'images/') && !str_starts_with($img, 'uploads/')) {
      $img = str_starts_with($img, 'destinations/') ? 'uploads/' . $img : 'uploads/destinations/' . $img;
  }
  if (empty($img)) {
      $img = 'images/Attwood/East Africa/pexels-droneafrica-15373902.jpg'; // fallback
  }

  $dests[] = [
    'id' => $dest['id'],
    'name' => $dest['name'],
    'country' => $dest['country'],
    'img' => $img,
    'link' => 'destinations/'.$dest['slug'],
    'region' => $dest['region_type'] ?: 'Destination',
    'lat' => (float)$dest['latitude'],
    'lng' => (float)$dest['longitude']
  ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= htmlspecialchars($countryName) ?> Destinations | Attwood Travel Agency Ltd</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css?v=<?= time() ?>">
  <link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
  <style>
    .dest-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px; }
  </style>
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<!-- Page Hero -->
<section class="tdv2-hero" style="background-image:url('<?= htmlspecialchars($heroImg) ?>');">
  <div class="tdv2-hero-overlay"></div>
  <div class="tdv2-hero-content">
    <div class="tdv2-hero-eyebrow">Explore</div>
    <h1>Destinations in <?= htmlspecialchars($countryName) ?></h1>
  </div>
  <div class="tdv2-hero-breadcrumb">
      <a href="index"><i class="fa fa-home"></i></a>
      <span class="sep">/</span>
      <a href="destinations?region=<?= urlencode($regionName) ?>"><?= htmlspecialchars($regionName) ?></a>
      <span class="sep">/</span>
      <span><?= htmlspecialchars($countryName) ?></span>
  </div>
</section>

<!-- Content -->
<section class="section-pad bg-cream">
  <div class="container" style="max-width:1280px;">
    
    <div class="row">
      <div class="col-lg-8 pr-lg-5">
      
        <!-- About Country -->
        <div style="background:#fff;padding:40px;border-radius:12px;box-shadow:var(--aw-shadow-card);margin-bottom:48px;">
          <h2 style="font-family:var(--aw-font-body);font-size:32px;font-weight:800;color:var(--aw-text-dark);margin-bottom:24px;">About <?= htmlspecialchars($countryName) ?></h2>
          <div style="font-size:16px;color:var(--aw-text-body);line-height:1.8;">
            <p><?= htmlspecialchars($countryName) ?> is a spectacular travel destination that offers unforgettable experiences. Whether you are looking for breathtaking wildlife encounters, stunning landscapes, or pure relaxation, this region has it all. At Attwood Travel Agency Ltd, we craft tailor-made journeys that allow you to explore <?= htmlspecialchars($countryName) ?> at your own pace, staying at the finest hand-picked lodges and camps.</p>
            <p>Below you will find the specific regions and parks we visit within <?= htmlspecialchars($countryName) ?>. Speak to one of our safari experts to start designing your perfect itinerary.</p>
          </div>
        </div>

        <!-- Destinations Map -->
        <div style="margin-bottom:64px;border-radius:12px;overflow:hidden;box-shadow:var(--aw-shadow-card);border:1px solid var(--aw-border);">
          <div style="background:var(--aw-accent-olive);color:#fff;padding:16px 24px;display:flex;align-items:center;justify-content:space-between;">
            <h3 style="font-family:var(--aw-font-body);font-size:20px;font-weight:700;margin:0;"><i class="fa fa-map-marker mr-2" style="color:var(--aw-accent-gold);"></i> Map of <?= htmlspecialchars($countryName) ?> Destinations</h3>
            <span style="font-size:13px;font-family:var(--aw-font-ui);font-weight:600;color:rgba(255,255,255,0.7);">Interactive Map</span>
          </div>
          <div id="destMap" style="height:450px;width:100%;background:#e5e5e5;display:flex;align-items:center;justify-content:center;">
            <span style="color:#6B6358;font-size:14px;font-family:'Inter',sans-serif;"><i class="fa fa-spinner fa-spin mr-2"></i> Loading map...</span>
          </div>
        </div>
        
        <div class="aw-section-heading">
          <h2>Places to Visit in <?= htmlspecialchars($countryName) ?></h2>
        </div>
        
        <div class="tdv2-dest-grid">
          <?php if(count($dests) > 0): ?>
            <?php foreach($dests as $d): ?>
            <a href="<?= $d['link'] ?>" class="tdv2-dest-card">
              <img src="<?= htmlspecialchars($d['img']) ?>" alt="<?= htmlspecialchars($d['name']) ?>" loading="lazy">
              <div class="tdv2-dc-overlay"></div>
              <div class="tdv2-dc-text">
                <div class="tdv2-dc-region"><?= htmlspecialchars($d['region']) ?></div>
                <div class="tdv2-dc-name"><?= htmlspecialchars($d['name']) ?></div>
              </div>
            </a>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12 text-center" style="grid-column: 1 / -1;">
                <p>No destinations found for this country.</p>
            </div>
          <?php endif; ?>
        </div>

      </div>
      
      <!-- Right Sidebar -->
      <div class="col-lg-4">
        <div style="border-radius:12px;padding:32px;background:#fff;box-shadow:var(--aw-shadow-card);position:sticky;top:150px;border:1px solid var(--aw-border);">
          <h3 style="font-family:var(--aw-font-body);font-size:22px;font-weight:800;color:var(--aw-text-dark);margin-bottom:24px;border-bottom:1px solid var(--aw-border);padding-bottom:12px;">Country Quick Facts</h3>
          
          <div class="mb-4">
            <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-text-muted);font-family:var(--aw-font-ui);display:block;margin-bottom:6px;">Country</span>
            <span style="font-size:16px;color:var(--aw-text-dark);font-weight:600;"><i class="fa fa-map-marker" style="color:var(--aw-primary);width:16px;"></i> <?= htmlspecialchars($countryName) ?></span>
          </div>
          
          <div class="mb-5">
            <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-text-muted);font-family:var(--aw-font-ui);display:block;margin-bottom:6px;">Destinations</span>
            <span style="font-size:16px;color:var(--aw-text-dark);font-weight:600;"><i class="fa fa-map" style="color:var(--aw-primary);width:16px;"></i> <?= count($dests) ?> Regions/Parks</span>
          </div>

          <button data-open-planner="true" data-dest-name="<?= htmlspecialchars($countryName) ?>" class="tdv2-btn-cta" style="width:100%;">Plan a Trip Here</button>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="js/start-planning.js?v=1781967414"></script>
<script>
$(document).ready(function() {
  var dests = <?= json_encode($dests) ?>;
  var mapContainer = document.getElementById('destMap');
  
  if(dests.length > 0) {
    mapContainer.innerHTML = ''; // clear loading text
    var map = L.map('destMap');
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
      subdomains: 'abcd',
      maxZoom: 20
    }).addTo(map);
    
    var markers = [];
    dests.forEach(function(d) {
      if(d.lat && d.lng) {
        var iconHtml = '<div style="background:#C49018;color:#fff;width:24px;height:24px;border-radius:50%;border:2px solid #fff;box-shadow:0 3px 6px rgba(0,0,0,0.3);"></div>';
        var icon = L.divIcon({ className: '', html: iconHtml, iconSize: [24, 24], iconAnchor: [12, 12] });
        var marker = L.marker([d.lat, d.lng], {icon: icon}).addTo(map)
          .bindPopup('<div style="text-align:center;"><img src="' + d.img + '" style="width:100%;height:100px;object-fit:cover;border-radius:4px;margin-bottom:8px;"><br><strong style="font-family:\'Cormorant Garant\',serif;font-size:18px;color:#1C1712;">' + d.name + '</strong><br><a href="' + d.link + '" style="display:inline-block;margin-top:8px;font-size:11px;font-family:\'Inter\',sans-serif;color:#C49018;text-transform:uppercase;letter-spacing:0.1em;font-weight:700;">Explore &rarr;</a></div>');
        markers.push(marker);
      }
    });
    
    if(markers.length > 0) {
      var group = new L.featureGroup(markers);
      var center = group.getBounds().getCenter();
      map.setView(center, 5); // Use fixed regional zoom
    } else {
      map.setView([-1.286389, 36.817223], 5); // default to Nairobi
    }
  } else {
    mapContainer.innerHTML = '<span style="color:#6B6358;font-size:14px;font-family:\'Inter\',sans-serif;">No map data available.</span>';
  }
});
</script>
</body>
</html>
