<?php
require_once 'includes/db.php';
$pdo = getPDO();

// Category filter
$catFilter = trim($_GET['category'] ?? '');

// Pagination
$perPage = 9;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

$whereClause = "WHERE b.status='published'" . ($catFilter ? " AND b.category=" . $pdo->quote($catFilter) : '');
$total = $pdo->query("SELECT COUNT(*) FROM blogs b $whereClause")->fetchColumn();
$totalPages = ceil($total / $perPage);

$blogs = $pdo->query("SELECT * FROM blogs b $whereClause ORDER BY b.created_at DESC LIMIT $perPage OFFSET $offset")->fetchAll();

// Categories for filter
$categories = $pdo->query("SELECT DISTINCT category FROM blogs WHERE status='published' AND category IS NOT NULL AND category != '' ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Safari Travel Blog &mdash; Attwood Travel Agency Ltd</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Expert safari insights, travel tips, wildlife guides and destination inspiration from Attwood Travel Agency Ltd.">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css">
  <style>
    .blog-card { background:#fff; border-radius:12px; overflow:hidden; border:1px solid var(--aw-border); transition:var(--aw-transition); height:100%; display:flex; flex-direction:column; position:relative; }
    .blog-card:hover { transform:translateY(-8px); box-shadow:var(--aw-shadow-hover); }
    .blog-card-img { height:260px; overflow:hidden; position:relative; }
    .blog-card-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.6s ease; }
    .blog-card:hover .blog-card-img img { transform:scale(1.08); }
    .blog-card-badge { position:absolute; top:16px; left:16px; background:var(--aw-primary); color:#fff; font-family:var(--aw-font-ui); font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; padding:6px 14px; border-radius:999px; box-shadow:0 4px 10px rgba(0,0,0,0.2); z-index:2; }
    .blog-card-body { padding:32px 24px; flex:1; display:flex; flex-direction:column; }
    .blog-card-meta { display:flex; align-items:center; gap:16px; font-family:var(--aw-font-ui); font-size:12px; color:var(--aw-text-muted); margin-bottom:12px; }
    .blog-card-meta i { color:var(--aw-accent-gold); margin-right:4px; }
    .blog-card-title { font-family:var(--aw-font-body); font-size:24px; font-weight:800; color:var(--aw-text-dark); margin-bottom:16px; line-height:1.2; }
    .blog-card-title a { color:inherit; text-decoration:none; transition:var(--aw-transition); }
    .blog-card-title a:hover { color:var(--aw-primary); }
    .blog-excerpt { font-size:15px; color:var(--aw-text-body); line-height:1.7; font-family:var(--aw-font-ui); flex:1; margin-bottom:24px; }
    .blog-read-more { font-family:var(--aw-font-ui); font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--aw-accent-olive); text-decoration:none; transition:var(--aw-transition); display:inline-flex; align-items:center; }
    .blog-read-more i { margin-left:6px; transition:transform 0.3s ease; }
    .blog-read-more:hover { color:var(--aw-primary); }
    .blog-read-more:hover i { transform:translateX(4px); }
    
    .blog-filter-btn { font-size:13px; font-weight:700; letter-spacing:1px; text-transform:uppercase; padding:10px 24px; border-radius:999px; border:1px solid var(--aw-border); background:#fff; color:var(--aw-text-body); font-family:var(--aw-font-ui); transition:var(--aw-transition); text-decoration:none; box-shadow:var(--aw-shadow-card); }
    .blog-filter-btn:hover, .blog-filter-btn.active { background:var(--aw-primary); color:#fff; border-color:var(--aw-primary); box-shadow:var(--aw-shadow-hover); }
  </style>
<link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<section class="tdv2-hero" style="background-image:url('oldattwood/img/slider/slide4.jpg');">
  <div class="tdv2-hero-overlay"></div>
  <div class="tdv2-hero-content">
    <div class="tdv2-hero-eyebrow" style="margin-bottom:12px;">Safari Stories</div>
    <h1>Insights From The Wild</h1>
    <p style="font-family:var(--aw-font-ui); font-size:18px; color:rgba(255,255,255,0.85); max-width:500px; margin:0 auto;">Expert guides, wildlife insights, travel tips, and destination stories from our safari specialists.</p>
  </div>
  <div class="tdv2-hero-breadcrumb">
    <a href="index.php">Home</a>
    <span class="sep">/</span>
    <span class="current">Travel Blog</span>
  </div>
</section>

<!-- Filter Bar -->
<div id="blog-container">
  <div style="background:#FAF8F4; border-bottom:1px solid #E5DDD0; padding:20px 0;">
    <div class="container" style="max-width:1280px;">
      <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center blog-filters">
        <a href="blog" class="blog-filter-btn <?= !$catFilter ? 'active' : '' ?>">All Posts</a>
        <?php foreach ($categories as $cat): ?>
        <a href="blog?category=<?= urlencode($cat) ?>" class="blog-filter-btn <?= $catFilter===$cat ? 'active' : '' ?>"><?= htmlspecialchars($cat) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Blog Grid -->
  <section style="padding:80px 0; background:#F7F5F0; position:relative;">
    <div id="blog-loading" style="display:none; position:absolute; inset:0; background:rgba(247,245,240,0.7); z-index:10; align-items:center; justify-content:center;">
      <i class="fa fa-spinner fa-spin fa-3x" style="color:#C49018;"></i>
    </div>
    <div class="container" style="max-width:1280px;">
      <?php if (empty($blogs)): ?>
      <div class="text-center py-5">
        <h3 style="font-family:'Cormorant Garant',serif;color:#1C1712;">No posts found.</h3>
        <a href="blog" class="btn-attwood-cta d-inline-block mt-3">View All Posts</a>
      </div>
      <?php else: ?>
      <div class="row g-4">
        <?php foreach ($blogs as $b): ?>
        <?php
          $imgSrc = $b['featured_image'] ? (str_starts_with($b['featured_image'],'images/') ? $b['featured_image'] : 'uploads/'.$b['featured_image']) : 'images/Attwood/East Africa/pexels-droneafrica-13234382.jpg';
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="blog-card">
            <div class="blog-card-img">
              <div class="blog-card-badge"><?= htmlspecialchars($b['category'] ?: 'Safari Stories') ?></div>
              <a href="blog/<?= urlencode($b['slug']) ?>">
                <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($b['title']) ?>" loading="lazy">
              </a>
            </div>
            <div class="blog-card-body">
              <div class="blog-card-meta">
                <span><i class="fa fa-calendar-o"></i><?= date('d M Y', strtotime($b['created_at'])) ?></span>
                <span><i class="fa fa-user-o"></i><?= htmlspecialchars($b['author']) ?></span>
              </div>
              <h2 class="blog-card-title">
                <a href="blog/<?= urlencode($b['slug']) ?>"><?= htmlspecialchars($b['title']) ?></a>
              </h2>
              <p class="blog-excerpt"><?= htmlspecialchars(mb_substr($b['excerpt'] ?: strip_tags($b['body']), 0, 140)) ?>...</p>
              
              <a href="blog/<?= urlencode($b['slug']) ?>" class="blog-read-more">Read Article <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Pagination -->
      <?php if ($totalPages > 1): ?>
      <div class="d-flex justify-content-center mt-5 gap-2 blog-pagination">
        <?php for ($p=1; $p<=$totalPages; $p++): ?>
        <a href="?page=<?= $p ?><?= $catFilter ? '&category='.urlencode($catFilter) : '' ?>"
           style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:14px;font-weight:700;font-family:'Inter',sans-serif;text-decoration:none;<?= $p===$page ? 'background:#1C1712;color:#fff;' : 'background:#fff;color:#4A4340;border:1px solid #E5DDD0;' ?>">
          <?= $p ?>
        </a>
        <?php endfor; ?>
      </div>
      <?php endif; ?>
      <?php endif; ?>
    </div>
  </section>
</div>

<?php require_once 'includes/footer.php'; ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('blog-container');
    
    container.addEventListener('click', function(e) {
        const link = e.target.closest('.blog-filter-btn, .blog-pagination a');
        if (!link) return;
        
        e.preventDefault();
        const url = link.href;
        const loading = document.getElementById('blog-loading');
        if(loading) loading.style.display = 'flex';
        
        // Update URL
        window.history.pushState({path: url}, '', url);
        
        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('blog-container').innerHTML;
                container.innerHTML = newContent;
            })
            .catch(err => {
                window.location.href = url; // fallback
            });
    });
    
    window.addEventListener('popstate', function() {
        window.location.reload();
    });
});
</script>
</body>
</html>
