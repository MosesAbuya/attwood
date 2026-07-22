<?php
require_once 'includes/db.php';
$pdo = getPDO();

$slug = trim($_GET['slug'] ?? '');
if (!$slug) { header('Location: /attwood/blog'); exit; }

$blog = $pdo->prepare("SELECT * FROM blogs WHERE slug=? AND status='published'");
$blog->execute([$slug]);
$blog = $blog->fetch();
if (!$blog) { header('Location: /attwood/blog'); exit; }

// Related posts (same category, exclude current)
$related = $pdo->prepare("SELECT id, title, slug, excerpt, featured_image, author, created_at, category FROM blogs WHERE status='published' AND id != ? ORDER BY (category=?) DESC, created_at DESC LIMIT 3");
$related->execute([$blog['id'], $blog['category']]);
$related = $related->fetchAll();

$imgSrc = $blog['featured_image'] ? (str_starts_with($blog['featured_image'],'images/') ? $blog['featured_image'] : 'uploads/'.$blog['featured_image']) : 'images/Attwood/East Africa/pexels-droneafrica-13234382.jpg';
$readTime = max(1, round(str_word_count(strip_tags($blog['body'])) / 200));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $base_href = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') ? '/attwood/' : '/'; ?>
  <base href="<?= $base_href ?>">
  <title><?= htmlspecialchars($blog['seo_title'] ?: $blog['title']) ?> &mdash; Attwood Travel Agency Ltd Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= htmlspecialchars($blog['meta_description'] ?: mb_substr(strip_tags($blog['excerpt']),0,160)) ?>">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css">
  <style>
    /* Hero */
    .bd-hero { height:560px; background-size:cover; background-position:center; position:relative; display:flex; flex-direction:column; justify-content:flex-end; }
    .bd-hero .overlay { position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 60%); }
    .bd-hero-content { position:relative; z-index:2; padding:0 0 40px; max-width:900px; }
    .bd-category { font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#C49018;font-family:'Inter',sans-serif;margin-bottom:12px;display:block; }
    .bd-title { font-family:'Cormorant Garant',serif;font-size:clamp(32px,4.5vw,54px);color:#fff;margin-bottom:16px;line-height:1.15;font-weight:400; }
    .bd-meta { font-family:'Inter',sans-serif;font-size:13px;color:rgba(255,255,255,0.75);display:flex;gap:20px;align-items:center;flex-wrap:wrap; }
    .bd-meta i { color:#C49018;margin-right:5px; }
    .hero-breadcrumb { position:absolute;bottom:20px;right:30px;z-index:2;font-family:'Inter',sans-serif;font-size:13px;color:rgba(255,255,255,0.8); }
    .hero-breadcrumb a { color:rgba(255,255,255,0.8);text-decoration:none; }
    .hero-breadcrumb a:hover { color:#C49018; }

    /* Article body */
    .blog-body { font-family:var(--aw-font-ui); font-size:17px; line-height:1.9; color:var(--aw-text-dark); }
    .blog-body h2 { font-family:var(--aw-font-body); font-size:32px; color:var(--aw-text-dark); margin-top:44px; margin-bottom:18px; font-weight:800; }
    .blog-body h3 { font-family:var(--aw-font-body); font-size:26px; color:var(--aw-text-dark); margin-top:36px; margin-bottom:14px; font-weight:800; }
    .blog-body p { margin-bottom:22px; }
    .blog-body ul, .blog-body ol { margin-bottom:22px; padding-left:24px; }
    .blog-body ul li, .blog-body ol li { margin-bottom:10px; line-height:1.7; }
    .blog-body blockquote { font-family:var(--aw-font-body); font-size:24px; font-style:italic; color:var(--aw-primary); border-left:4px solid var(--aw-primary); padding:24px 32px; background:rgba(196,144,24,0.05); margin:40px 0; line-height:1.6; border-radius:4px; }
    .blog-body strong { color:var(--aw-text-dark); font-weight:700; }
    .blog-body img { width:100%; border-radius:12px; margin:30px 0; box-shadow:var(--aw-shadow-card); }

    /* Sidebar */
    .blog-sidebar-box { background:#fff; border:1px solid var(--aw-border); border-radius:12px; padding:32px; margin-bottom:32px; box-shadow:var(--aw-shadow-card); }
    .blog-sidebar-box h4 { font-family:var(--aw-font-body); font-size:22px; font-weight:800; color:var(--aw-text-dark); margin-bottom:24px; border-bottom:1px solid var(--aw-border); padding-bottom:12px; }

    /* Related card */
    .rel-card { background:#fff; border:1px solid var(--aw-border); border-radius:12px; overflow:hidden; transition:var(--aw-transition); box-shadow:var(--aw-shadow-card); }
    .rel-card:hover { transform:translateY(-4px); box-shadow:var(--aw-shadow-hover); }
    .rel-card img { width:100%; height:160px; object-fit:cover; transition:transform 0.6s ease; }
    .rel-card:hover img { transform:scale(1.08); }
    .rel-card-body { padding:24px; }
    .rel-card-title { font-family:var(--aw-font-body); font-size:18px; font-weight:800; color:var(--aw-text-dark); margin-bottom:12px; line-height:1.3; }
    .rel-card-title a { color:inherit; text-decoration:none; transition:var(--aw-transition); }
    .rel-card-title a:hover { color:var(--aw-primary); }
  </style>
<link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<!-- HERO -->
<section class="tdv2-hero" style="background-image:url('<?= htmlspecialchars($imgSrc) ?>');">
  <div class="tdv2-hero-overlay"></div>
  <div class="tdv2-hero-content text-center" style="max-width:900px; padding-left:24px; padding-right:24px;">
    <div class="tdv2-hero-eyebrow" style="margin-bottom:12px; color:var(--aw-primary); justify-content:center;"><?= htmlspecialchars($blog['category'] ?: 'Safari Stories') ?></div>
    <h1 style="font-family:var(--aw-font-body); font-size:clamp(32px,4.5vw,54px); font-weight:800; color:#fff; line-height:1.2; margin-bottom:16px;"><?= htmlspecialchars($blog['title']) ?></h1>
    <div style="font-family:var(--aw-font-ui); font-size:14px; color:rgba(255,255,255,0.8); display:flex; gap:24px; justify-content:center; align-items:center; flex-wrap:wrap; font-weight:500;">
      <span><i class="fa fa-user-o" style="color:var(--aw-primary); margin-right:6px;"></i><?= htmlspecialchars($blog['author']) ?></span>
      <span><i class="fa fa-calendar-o" style="color:var(--aw-primary); margin-right:6px;"></i><?= date('d F Y', strtotime($blog['created_at'])) ?></span>
      <span><i class="fa fa-clock-o" style="color:var(--aw-primary); margin-right:6px;"></i><?= $readTime ?> min read</span>
    </div>
  </div>
  <div class="tdv2-hero-breadcrumb">
    <a href="index.php">Home</a>
    <span class="sep">/</span>
    <a href="blog">Blog</a>
    <span class="sep">/</span>
    <span class="current"><?= htmlspecialchars(mb_substr($blog['title'],0,35)) ?>...</span>
  </div>
</section>

<!-- CONTENT -->
<section style="padding:80px 0;background:#F7F5F0;">
  <div class="container" style="max-width:1280px;">
    <div class="row g-5">

      <!-- Article -->
      <div class="col-lg-9">
        <div style="background:#fff;padding:32px;border-radius:6px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
          <?php if ($blog['excerpt']): ?>
          <p style="font-size:18px;color:#4A4340;line-height:1.8;font-family:'Cormorant Garant',serif;font-style:italic;border-left:4px solid #C49018;padding-left:20px;margin-bottom:36px;">
            <?= htmlspecialchars($blog['excerpt']) ?>
          </p>
          <?php endif; ?>
          <div class="blog-body">
            <?= $blog['body'] ?>
          </div>

          <!-- Tags -->
          <?php if ($blog['tags']): ?>
          <div style="margin-top:40px;padding-top:24px;border-top:1px solid #E5DDD0;">
            <span style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#6B6358;font-family:'Inter',sans-serif;margin-right:10px;">Tags:</span>
            <?php foreach (explode(',', $blog['tags']) as $tag): ?>
            <a href="blog?tag=<?= urlencode(trim($tag)) ?>"
               style="display:inline-block;margin:3px;padding:4px 12px;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;background:#FAF8F4;border:1px solid #E5DDD0;border-radius:30px;color:#4A4340;text-decoration:none;font-family:'Inter',sans-serif;">
              <?= htmlspecialchars(trim($tag)) ?>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <!-- Share -->
          <div style="margin-top:32px;padding-top:24px;border-top:1px solid #E5DDD0;display:flex;align-items:center;gap:12px;">
            <span style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#6B6358;font-family:'Inter',sans-serif;">Share:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" style="width:36px;height:36px;border-radius:50%;background:#1877f2;color:#fff;display:flex;align-items:center;justify-content:center;"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>&text=<?= urlencode($blog['title']) ?>" target="_blank" style="width:36px;height:36px;border-radius:50%;background:#000;color:#fff;display:flex;align-items:center;justify-content:center;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.254 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a href="https://wa.me/?text=<?= urlencode($blog['title'].' - http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>" target="_blank" style="width:36px;height:36px;border-radius:50%;background:#25d366;color:#fff;display:flex;align-items:center;justify-content:center;"><i class="fa fa-whatsapp"></i></a>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-3">
        <!-- CTA Box -->
        <div style="background:var(--aw-accent-olive); border-radius:12px; padding:32px; margin-bottom:32px; text-align:center; box-shadow:var(--aw-shadow-card);">
          <span style="font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--aw-primary); font-family:var(--aw-font-ui);">Ready to Go?</span>
          <h3 style="font-family:var(--aw-font-body); font-size:26px; color:#fff; margin:12px 0 16px; font-weight:800;">Plan Your Safari Today</h3>
          <p style="font-size:14px; color:rgba(255,255,255,0.85); font-family:var(--aw-font-ui); margin-bottom:24px; line-height:1.6;">Let our specialists craft the perfect itinerary for your African adventure.</p>
          <button data-open-planner="true" class="aw-btn-primary" style="width:100%; padding:14px;">Enquire Now</button>
        </div>

        <!-- Related Posts -->
        <?php if (!empty($related)): ?>
        <div class="blog-sidebar-box">
          <h4>More Stories</h4>
          <?php foreach ($related as $rel): ?>
          <?php $relImg = $rel['featured_image'] ? (str_starts_with($rel['featured_image'],'images/') ? $rel['featured_image'] : 'uploads/'.$rel['featured_image']) : 'images/Attwood/East Africa/pexels-droneafrica-13234382.jpg'; ?>
          <div class="rel-card mb-4">
            <div style="overflow:hidden;"><img src="<?= htmlspecialchars($relImg) ?>" alt="<?= htmlspecialchars($rel['title']) ?>" loading="lazy"></div>
            <div class="rel-card-body">
              <span style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--aw-primary);font-family:var(--aw-font-ui);"><?= htmlspecialchars($rel['category'] ?: 'Safari Stories') ?></span>
              <div class="rel-card-title mt-2">
                <a href="blog/<?= urlencode($rel['slug']) ?>"><?= htmlspecialchars($rel['title']) ?></a>
              </div>
              <div style="font-size:12px;color:var(--aw-text-muted);font-family:var(--aw-font-ui);display:flex;align-items:center;"><i class="fa fa-calendar-o mr-2" style="color:var(--aw-accent-gold);"></i><?= date('d M Y', strtotime($rel['created_at'])) ?></div>
            </div>
          </div>
          <?php endforeach; ?>
          <a href="blog" style="display:block;text-align:center;margin-top:16px;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--aw-accent-olive);text-decoration:none;font-family:var(--aw-font-ui);">View All Posts <i class="fa fa-arrow-right ml-1"></i></a>
        </div>
        <?php endif; ?>

        <!-- Categories -->
        <div class="blog-sidebar-box">
          <h4>Categories</h4>
          <?php
          $cats = $pdo->query("SELECT category, COUNT(*) as cnt FROM blogs WHERE status='published' GROUP BY category ORDER BY cnt DESC")->fetchAll();
          foreach ($cats as $c): ?>
          <a href="blog?category=<?= urlencode($c['category']) ?>"
             style="display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid var(--aw-border); text-decoration:none; font-family:var(--aw-font-ui); font-size:15px; color:var(--aw-text-dark); transition:var(--aw-transition);"
             onmouseover="this.style.color='var(--aw-primary)'" onmouseout="this.style.color='var(--aw-text-dark)'">
            <?= htmlspecialchars($c['category']) ?>
            <span style="font-size:12px; font-weight:700; background:rgba(196,144,24,0.1); padding:4px 10px; border-radius:20px; color:var(--aw-primary);"><?= $c['cnt'] ?></span>
          </a>
          <?php endforeach; ?>
        </div>

        <!-- Newsletter Sidebar Box -->
        <div class="blog-sidebar-box" style="text-align:center;">
          <h4>Join Our Newsletter</h4>
          <p style="font-size:14px; color:var(--aw-text-muted); font-family:var(--aw-font-ui); margin-bottom:16px;">Expert tips, safari inspiration, and exclusive offers.</p>
          <form id="sidebarNewsletterForm" class="newsletter-form">
            <input type="email" name="email" placeholder="Your Email Address" required style="width:100%; padding:14px; border:1px solid var(--aw-border); border-radius:6px; margin-bottom:12px; font-family:var(--aw-font-ui); font-size:14px; outline:none; transition:border 0.3s;" onfocus="this.style.borderColor='var(--aw-primary)'" onblur="this.style.borderColor='var(--aw-border)'">
            <button type="submit" class="aw-btn-primary" style="width:100%; padding:14px;">Subscribe</button>
          </form>
          <div id="sidebarNewsletterFeedback" style="display:none; font-size:13px; font-family:var(--aw-font-ui); margin-top:12px; border-radius:6px; padding:10px;"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sForm = document.getElementById('sidebarNewsletterForm');
    const sFeedback = document.getElementById('sidebarNewsletterFeedback');
    
    if (sForm) {
        sForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = sForm.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = 'Subscribing...';
            btn.disabled = true;
            sFeedback.style.display = 'none';
            
            const formData = new FormData(sForm);
            var basePath = window.location.hostname === 'localhost' ? '/attwood' : '';
            fetch(basePath + '/handlers/newsletter.php', {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(res => {
                btn.innerText = originalText;
                btn.disabled = false;
                sFeedback.style.display = 'block';
                if(res.success) {
                    sFeedback.style.backgroundColor = 'rgba(98,140,82,0.1)';
                    sFeedback.style.border = '1px solid #628C52';
                    sFeedback.style.color = '#4e7040';
                    sFeedback.innerHTML = '<i class="fa fa-check-circle mr-2"></i> ' + res.message;
                    sForm.reset();
                } else {
                    sFeedback.style.backgroundColor = 'rgba(180,30,30,0.1)';
                    sFeedback.style.border = '1px solid #b41e1e';
                    sFeedback.style.color = '#b41e1e';
                    sFeedback.innerHTML = '<i class="fa fa-exclamation-circle mr-2"></i> ' + res.message;
                }
            })
            .catch(err => {
                btn.innerText = originalText;
                btn.disabled = false;
                sFeedback.style.display = 'block';
                sFeedback.style.backgroundColor = 'rgba(180,30,30,0.1)';
                sFeedback.style.border = '1px solid #b41e1e';
                sFeedback.style.color = '#b41e1e';
                sFeedback.innerHTML = '<i class="fa fa-exclamation-circle mr-2"></i> Network error.';
            });
        });
    }
});
</script>
</body>
</html>
