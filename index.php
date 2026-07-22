<?php
require_once 'includes/db.php';
$pdo = getPDO();

// Fetch published tours
$tours = $pdo->query("SELECT id, title, slug, duration_days, price_from_usd, excerpt, description, featured_image, status FROM tours WHERE status='published' ORDER BY id ASC LIMIT 6")->fetchAll();
$hot_tours = $pdo->query("SELECT id, title, slug, duration_days, price_from_usd, excerpt, description, featured_image, status FROM tours WHERE status='published' ORDER BY price_from_usd ASC LIMIT 3")->fetchAll();

// Fetch Countries with images + tour count
$countries = $pdo->query("
    SELECT d.country, MIN(d.featured_image) as featured_image, COUNT(DISTINCT ist.tour_id) as tour_count
    FROM destinations d
    LEFT JOIN itinerary_steps ist ON ist.destination_id = d.id
    WHERE d.featured_image IS NOT NULL AND d.featured_image != ''
    GROUP BY d.country
    ORDER BY tour_count DESC
    LIMIT 8
")->fetchAll();

// Fetch recent blogs
$recent_blogs = $pdo->query("SELECT * FROM blogs WHERE status='published' ORDER BY created_at DESC LIMIT 3")->fetchAll();

// Helper: build route string from itinerary
function getTourRoute($pdo, $tourId)
{
  $stmt = $pdo->prepare("SELECT d.name FROM itinerary_steps ist JOIN destinations d ON d.id=ist.destination_id WHERE ist.tour_id=? ORDER BY ist.step_number ASC");
  $stmt->execute([$tourId]);
  $names = $stmt->fetchAll(PDO::FETCH_COLUMN);
  $names = array_map('htmlspecialchars', $names);
  return implode(' &rarr; ', $names);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Attwood Travel Agency Ltd | Safaris, Beach Holidays & Tours | Kenya</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Attwood Travel Agency Ltd — Kenya's premier safari and travel company. Book tailored safaris to Maasai Mara, beach holidays, honeymoon packages, family tours and more.">
  <link rel="icon" type="image/x-icon" href="assets/favicon_io/favicon.ico">
  <link rel="apple-touch-icon" href="assets/favicon_io/apple-touch-icon.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css?v=<?= time() ?>">
  <link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
  <link rel="stylesheet" href="css/start-planning.css?v=<?= time() ?>">
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>

  
</head>

<body>

  <!-- BACK TO TOP -->
  <div id="back-to-top">
    <a class="top" href="#top"><i class="fa fa-long-arrow-up"></i></a>
  </div>

  <!-- SOCIAL SIDEBAR -->
  <div class="social-sidebar">
    <a href="https://www.facebook.com/share/16HsWzXEFA/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
    <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
    <a href="https://www.tiktok.com/@attwood.travel.ag" target="_blank" title="TikTok"><i class="fa fa-music"></i></a>
    <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
    <a href="https://youtube.com/@attwoodtravelagency" target="_blank" title="YouTube"><i class="fa fa-youtube"></i></a>
    <a href="https://www.linkedin.com/in/attwood-travel-agency-6a7978357" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
  </div>

  <?php require_once 'includes/nav.php'; ?>

  <!-- ====================================================
       1. HERO SLIDER (NEW SLEEK OVERHAUL)
       ==================================================== -->
<section class="aw-hero-sleek">
  <!-- Background Image and Video -->
  <div class="aw-hero-bg-container">
    <div class="aw-hero-bg" style="background-image: url('oldattwood/img/slider/slide1.jpg');"></div>
    <video class="aw-hero-video" autoplay loop muted playsinline poster="oldattwood/img/slider/slide1.jpg">
      <source src="assets/videos/hero.webm" type="video/webm">
    </video>
  </div>
  <div class="aw-hero-overlay-sleek"></div>

  <!-- Content -->
  <div class="container h-100 position-relative" style="z-index: 10;">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-12 col-md-10 col-lg-8 mt-5">
        <h1 class="aw-hero-title-sleek">Your Perfect Safari Escape</h1>
        <p class="aw-hero-subtitle-sleek mt-3">Experience the art of travel through our curated destinations.<br>Your unforgettable adventure begins here.</p>
        
        <!-- Search Bar Container (Glassmorphism) -->
        <div class="aw-hero-search-glass mt-5">
          <form class="d-flex align-items-center flex-wrap flex-md-nowrap w-100" action="tours" method="GET" style="gap: 10px;">
            <div class="search-field">
              <input type="text" name="dest" placeholder="Search Destination" style="color:#fff;">
              <i class="fa fa-map-marker"></i>
            </div>
            <div class="search-field">
              <input type="month" name="month" style="color:#fff;" placeholder="Travel Dates">
            </div>
            <div class="search-field border-0">
              <select name="guests" style="color:#fff; background: transparent; border: none; width: 100%; outline: none; appearance: none; -webkit-appearance: none; padding-right: 20px;">
                <option value="" disabled selected>Guests</option>
                <option value="1 Adult" style="color:#000;">1 Adult</option>
                <option value="2 Adults" style="color:#000;">2 Adults</option>
                <option value="2 Adults + 1 Child" style="color:#000;">2 Adults + 1 Child</option>
                <option value="2 Adults + 2 Children" style="color:#000;">2 Adults + 2 Children</option>
                <option value="Family / Group" style="color:#000;">Family / Group</option>
              </select>
              <i class="fa fa-angle-down"></i>
            </div>
            <div class="search-btn-col ms-auto">
              <button type="submit" class="aw-btn-explore">Explore</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Scroll Indicator -->
  <div class="aw-hero-bottom-bar d-flex justify-content-end align-items-end position-absolute w-100 px-4 px-lg-5 pb-4" style="bottom:0; z-index:10;">
    <div class="aw-hero-scroll text-white d-none d-md-block" style="font-family:'Inter', sans-serif; font-size:14px; font-weight:600; cursor:pointer;" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
      Step Inside <i class="fa fa-arrow-down ml-2"></i>
    </div>
  </div>
</section>

<!-- ====================================================
       2. ABOUT SECTION
       ==================================================== -->
  <section class="aw-about-section" style="margin-top:40px;">
    <div class="container" style="max-width:1280px;">
      <div class="row align-items-center">
        <!-- Image -->
        <div class="col-md-5 mb-4 mb-md-0">
          <div class="aw-about-img-wrap">
            <img src="oldattwood/img/tours-safaris.jpg" alt="Attwood Safari Tours">
          </div>
        </div>
        <!-- Text -->
        <div class="col-md-7">
          <div class="aw-about-text">
            <h2 class="aw-section-title">Attwood Travel Agency Ltd</h2>
            <span class="aw-section-line"></span>
            <h3>As the leaders in responsible travel, we offer big adventures with a small environmental footprint.</h3>
            <p class="mt-3">While safety is core to how we operate, we're also focused on the fun factor and suitably challenging you to reach that great sensation of personal achievement while enjoying the camaraderie of like-minded travellers.</p>
            <p>We offer all-season holiday tours and safaris upon request. Our tour vehicles are perfectly maintained four-by-four (4×4) wheel drives equipped with modern binoculars, fridge compartments, a charging system, Wi-Fi, and radio calls — guaranteeing an exceptional safari.</p>
            <a class="aw-btn-bor mt-4" href="about">Read More About Us</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ====================================================
       4B. HOT DEALS SECTION (Affordable Bundles)
       ==================================================== -->
  <section class="aw-hot-section">
    <div class="container" style="max-width:1280px;">
      <div class="text-center mb-5">
        <h2 class="aw-section-title dark">Affordable Vacation Bundles</h2>
        <span class="aw-section-line blue"></span>
      </div>
      <div class="row">
        <?php foreach ($hot_tours as $tour):
          $img = !empty($tour['featured_image']) ? 'uploads/' . $tour['featured_image'] : 'oldattwood/img/safa.jpg';
          $route  = getTourRoute($pdo, $tour['id']);
          $nights  = max(1, (int)($tour['duration_days'] ?? 1)) - 1;
          $price   = !empty($tour['price_from_usd']) ? '$' . number_format($tour['price_from_usd']) : 'Contact Us';
          $country = getTourCountries($pdo, $tour['id']);
          if(empty($country)) $country = "Various Locations";
        ?>
        <div class="col-lg-4 col-md-6 mb-4 d-flex">
          <div class="aw-hot-card w-100">
            <div class="aw-hot-img-wrap">
              <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($tour['title'] ?? '') ?>" loading="lazy">
              <div class="aw-hot-tag-black"><?= ($nights+1) ?> DAYS / <?= $nights ?> NIGHTS</div>
              <div class="aw-hot-tag-white"><i class="fa fa-map-marker"></i> <?= htmlspecialchars($country) ?></div>
            </div>
            <div class="aw-hot-body">
              <div class="aw-hot-title"><?= htmlspecialchars($tour['title'] ?? '') ?></div>
              <?php if ($route): ?>
              <div class="aw-hot-route"><?= mb_strimwidth(strip_tags($route), 0, 40, '...') ?></div>
              <?php endif; ?>
              <div class="aw-hot-divider"></div>
              <div class="aw-hot-footer">
                <div>
                  <div class="aw-hot-price-lbl">Starting From:</div>
                  <div class="aw-hot-price-val"><?= $price ?> <del style="font-size:12px;color:#999;font-weight:600;margin-left:4px;"><?php if(!empty($tour['price_from_usd'])) echo '$'.number_format($tour['price_from_usd']*1.15); ?></del></div>
                  <div class="aw-hot-price-tax">TAXES INCL/PERS</div>
                </div>
                <a href="tours/<?= $tour['slug'] ?? '' ?>" class="aw-hot-btn">Book A Trip &rarr;</a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-4">
        <a href="tours" class="aw-btn-bor" style="border-radius:20px;border-color:#ff6a1a;color:#ff6a1a!important;">View All Package</a>
      </div>
    </div>
  </section>


  <!-- ====================================================
       3. PACKAGES / FEATURES SECTION
       ==================================================== -->
  <section class="aw-packages-section">
    <div class="container" style="max-width:1280px;">
      <div class="text-center mb-5">
        <h2 class="aw-section-title">About Our Packages</h2>
        <span class="aw-section-line"></span>
        <p class="aw-section-sub" style="max-width:600px;margin:0 auto;">We craft experiences that go beyond the ordinary — tailored to your passions, your pace, and your dreams.</p>
      </div>
      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4 d-flex">
          <div class="aw-pkg-card w-100">
            <div class="aw-pkg-card-icon"><i class="fa fa-binoculars"></i></div>
            <h3>Best Tour Packages</h3>
            <span class="aw-pkg-card-line"></span>
            <p>We offer all-season holiday tours and safaris upon request. Our tour vehicles are perfectly in new condition and all are four by four (4×4) wheel drives for guaranteed exceptional Safari. Also equipped with modern binoculars, fridge compartments, charging system, Wi-fi, and Radio calls.</p>
            <a href="tours" class="aw-btn-bor">Read More</a>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4 mb-4 d-flex">
          <div class="aw-pkg-card w-100">
            <div class="aw-pkg-card-icon"><i class="fa fa-map-o"></i></div>
            <h3>Tailor Made Packages</h3>
            <span class="aw-pkg-card-line"></span>
            <p>We offer a range of customizable tour packages to suit your interests, preferences, and budget. Whether you're looking for a romantic getaway, a family vacation, or a thrilling adventure, Attwood can design the perfect itinerary for you.</p>
            <a href="tours" class="aw-btn-bor">Read More</a>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4 mb-4 d-flex">
          <div class="aw-pkg-card w-100">
            <div class="aw-pkg-card-icon"><i class="fa fa-leaf"></i></div>
            <h3>Responsible Tourism</h3>
            <span class="aw-pkg-card-line"></span>
            <p>We are dedicated to promoting sustainable tourism practices and preserving the environment and local communities. We work closely with local communities to ensure that our tours positively impact the destinations they visit.</p>
            <a href="tours" class="aw-btn-bor">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ====================================================
       4. FEATURED TOURS (from DB)
       ==================================================== -->
  <section class="aw-tours-section">
    <div class="container" style="max-width:1280px;">
      <div class="text-center mb-5">
        <h2 class="aw-section-title">Our Featured Safari Packages</h2>
        <span class="aw-section-line"></span>
        <p class="aw-section-sub">Handpicked adventures from the wild savannahs of Kenya to the turquoise coasts — each journey crafted with passion.</p>
      </div>
      <div class="row">
        <?php foreach ($tours as $tour):
          $img = !empty($tour['featured_image'])
            ? 'uploads/' . $tour['featured_image']
            : 'oldattwood/img/safa.jpg';
          $route  = getTourRoute($pdo, $tour['id']);
          $excerpt = !empty($tour['excerpt']) ? $tour['excerpt'] : ($tour['description'] ?? '');
          $nights  = max(1, (int)($tour['duration_days'] ?? 1)) - 1;
          $price   = !empty($tour['price_from_usd']) ? '$' . number_format($tour['price_from_usd']) : 'Contact Us';
        ?>
        <div class="col-lg-4 col-md-6 mb-4 d-flex">
          <div class="aw-tour-card w-100">
            <div class="aw-tour-img-wrap">
              <div class="aw-tour-featured">Featured</div>
              <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($tour['title'] ?? '') ?>" loading="lazy">
            </div>
            <div class="aw-tour-body">
              <div class="aw-tour-title"><a href="tours/<?= $tour['slug'] ?? '' ?>"><?= htmlspecialchars($tour['title'] ?? '') ?></a></div>
              
              <div class="aw-tour-details-row">
                <div class="aw-tour-meta">
                  <div class="aw-tour-meta-item">
                    <i class="fa fa-map-marker"></i>
                    <span><?= getTourCountries($pdo, $tour['id']) ?><?= $route ? ', ' . mb_strimwidth(strip_tags($route),0,20,'...') : '' ?></span>
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
      <div class="text-center mt-3">
        <a href="tours" class="aw-view-all">View All Tours &rarr;</a>
      </div>
    </div>
  </section>


  <!-- ====================================================
       5. TESTIMONIALS (parallax)
       ==================================================== -->
  <section class="aw-testi-section">
    <div class="aw-testi-overlay"></div>
    <div class="aw-testi-inner container" style="max-width:1000px;">
      <div class="text-center mb-5">
        <h2 class="aw-section-title white">Why You Should Choose Us</h2>
        <span class="aw-section-line white"></span>
      </div>
      <div id="aw-testi-carousel" class="owl-carousel aw-owl-testi">
        <div class="aw-testi-card">
          <p class="aw-testi-desc">Attwood Travel Agency offers personalized safari experiences tailored to your preferences. With expert local guides and seamless logistics, your journey will be safe, smooth, and unforgettable.</p>
          <span class="aw-testi-line d-block"></span>
          <div class="aw-testi-name">Attwood Travel Agency</div>
          <div class="aw-testi-role">Our Promise to You</div>
        </div>
        <div class="aw-testi-card">
          <p class="aw-testi-desc">We provide affordable, all-inclusive travel packages with no hidden costs. Our 24/7 customer support ensures you're never alone while exploring your dream destinations.</p>
          <span class="aw-testi-line d-block"></span>
          <div class="aw-testi-name">Transparent Pricing</div>
          <div class="aw-testi-role">No Surprises, Ever</div>
        </div>
        <div class="aw-testi-card">
          <p class="aw-testi-desc">From Maasai Mara to the Maldives, from Zanzibar to Dubai — we bring the world's most iconic destinations to your doorstep with expert planning and unrivalled care.</p>
          <span class="aw-testi-line d-block"></span>
          <div class="aw-testi-name">Global Reach</div>
          <div class="aw-testi-role">Local Expertise</div>
        </div>
      </div>
    </div>
  </section>


  <!-- ====================================================
       6. DESTINATIONS (from DB)
       ==================================================== -->
  <section class="aw-dest-section">
    <div class="container" style="max-width:1280px;">
      <div class="text-center mb-5">
        <h2 class="aw-section-title white">Iconic Destinations</h2>
        <span class="aw-section-line white"></span>
        <p class="aw-section-sub white" style="max-width:560px;margin:0 auto;">From Kenya's wild savannahs to Indian Ocean paradise — explore where we take you.</p>
      </div>
    </div>

    <div class="aw-dest-carousel-outer" style="position:relative;max-width:1280px;margin:0 auto;padding:0 60px;">
      <button class="aw-hero-arrow prev aw-dest-prev" aria-label="Previous" style="left:0;"><i class="fa fa-arrow-left"></i></button>
      <button class="aw-hero-arrow next aw-dest-next" aria-label="Next" style="right:0;"><i class="fa fa-arrow-right"></i></button>

      <div style="overflow:hidden;">
        <div class="aw-dest-track" style="display:flex;gap:20px;transition:transform .45s cubic-bezier(.25,.46,.45,.94);will-change:transform;">
          <?php foreach ($countries as $dest):
            if (!$dest['featured_image']) continue;
            $img = $dest['featured_image'];
            if (!str_starts_with($img, 'http') && !str_starts_with($img, 'images/')) {
              $img = 'uploads/' . $img;
            }
            $cName = $dest['country'];
            $region = 'Africa';
            $cL = strtolower(trim($cName));
            if (in_array($cL, ['maldives','sri lanka','indonesia','bali'])) $region = 'Asia';
            elseif (in_array($cL, ['uae','united arab emirates','dubai','oman','qatar'])) $region = 'Middle East';
            elseif (in_array($cL, ['france','italy','greece','spain','uk'])) $region = 'Europe';
            elseif (in_array($cL, ['seychelles','mauritius','madagascar'])) $region = 'Indian Ocean';
          ?>
          <div class="aw-dest-slide" style="flex:0 0 calc(25% - 15px);min-width:calc(25% - 15px);">
            <a href="country.php?name=<?= urlencode($cName) ?>" class="aw-dest-card">
              <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($cName) ?>">
              <div class="aw-dest-info">
                <div class="aw-dest-country"><?= htmlspecialchars($cName) ?></div>
                <?php if ($dest['tour_count'] > 0): ?>
                <div class="aw-dest-badge-hover"><?= $dest['tour_count'] ?> Tour<?= $dest['tour_count'] > 1 ? 's' : '' ?></div>
                <?php endif; ?>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
          <div class="aw-dest-slide" style="flex:0 0 calc(25% - 15px);min-width:calc(25% - 15px);">
            <a href="destinations" class="aw-dest-card aw-dest-card-viewall">
              <div class="aw-tour-discount">Get 10% Off</div>
              <h3>Of Our All<br>Destination</h3>
              <div class="aw-btn-sky">View All Destination</div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="aw-dest-dots-wrap" id="awDestDots"></div>

    <div class="text-center mt-4">
      <a href="destinations" class="aw-view-all white">View All Destinations &rarr;</a>
    </div>
  </section>


  <!-- ====================================================
       7. STATS / COUNTER (parallax)
       ==================================================== -->
  <section class="aw-counter-section">
    <div class="aw-counter-overlay"></div>
    <div class="aw-counter-inner container" style="max-width:1280px;">
      <div class="row text-center">
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <div class="aw-counter-num">500+</div>
          <div class="aw-counter-divider"></div>
          <div class="aw-counter-label">Tours Delivered</div>
        </div>
        <div class="col-md-3 col-6 mb-4 mb-md-0">
          <div class="aw-counter-num">15+</div>
          <div class="aw-counter-divider"></div>
          <div class="aw-counter-label">Destinations</div>
        </div>
        <div class="col-md-3 col-6">
          <div class="aw-counter-num">98%</div>
          <div class="aw-counter-divider"></div>
          <div class="aw-counter-label">Client Satisfaction</div>
        </div>
        <div class="col-md-3 col-6">
          <div class="aw-counter-num">10+</div>
          <div class="aw-counter-divider"></div>
          <div class="aw-counter-label">Years of Excellence</div>
        </div>
      </div>
    </div>
  </section>


  <!-- ====================================================
       8. WHY CHOOSE ATTWOOD
       ==================================================== -->
  <section class="aw-why-section">
    <div class="container" style="max-width:1280px;">
      <div class="row align-items-center">
        <!-- Image -->
        <div class="col-lg-5 mb-5 mb-lg-0">
          <div class="aw-why-img-wrap">
            <img src="oldattwood/img/about-1.jpg" alt="Why Choose Attwood Travel">
          </div>
        </div>
        <!-- Features -->
        <div class="col-lg-6 offset-lg-1">
          <h2 class="aw-section-title">Why Choose Attwood?</h2>
          <span class="aw-section-line"></span>
          <p class="aw-section-sub mb-4">We are not just a travel agency — we are your personal journey curator. Every adventure begins with understanding you: your pace, your passions, your dream.</p>

          <div class="aw-why-feature">
            <div class="aw-icon-bor"><i class="fa fa-map-marker"></i></div>
            <div class="aw-why-feature-text">
              <h4>Truly Tailor-Made</h4>
              <p>Every detail — the lodges, the guides, the pace — shaped entirely around your wishes. No two Attwood journeys are the same.</p>
            </div>
          </div>

          <div class="aw-why-feature">
            <div class="aw-icon-bor"><i class="fa fa-star"></i></div>
            <div class="aw-why-feature-text">
              <h4>Deep Kenya Expertise</h4>
              <p>Born from the African bush, our team's knowledge comes from years on the ground across Kenya's national parks and reserves.</p>
            </div>
          </div>

          <div class="aw-why-feature">
            <div class="aw-icon-bor"><i class="fa fa-leaf"></i></div>
            <div class="aw-why-feature-text">
              <h4>Sustainable &amp; Responsible</h4>
              <p>We partner with eco-certified lodges and contribute to community conservation on every safari we conduct.</p>
            </div>
          </div>

          <div class="aw-why-feature">
            <div class="aw-icon-bor"><i class="fa fa-phone"></i></div>
            <div class="aw-why-feature-text">
              <h4>24/7 Customer Support</h4>
              <p>Our team is always available before, during, and after your journey to ensure everything runs perfectly.</p>
            </div>
          </div>

          <a href="about" class="aw-btn-red mt-2 mr-3">Our Story</a>
          <a href="contact" class="aw-btn-bor mt-2">Get In Touch</a>
        </div>
      </div>
    </div>
  </section>


  <!-- ====================================================
       9. BLOG TEASERS (from DB)
       ==================================================== -->
  <?php if (!empty($recent_blogs)): ?>
  <section class="aw-blog-section">
    <div class="container" style="max-width:1280px;">
      <div class="text-center mb-5">
        <h2 class="aw-section-title">Safari Stories &amp; Travel Guides</h2>
        <span class="aw-section-line"></span>
        <p class="aw-section-sub">Tips, inspiration and behind-the-scenes moments from our guides and travellers.</p>
      </div>
      <div class="row">
        <?php foreach ($recent_blogs as $blog):
          $imgSrc = $blog['featured_image']
            ? (str_starts_with($blog['featured_image'], 'images/') ? $blog['featured_image'] : 'uploads/' . $blog['featured_image'])
            : 'oldattwood/img/blog-1.jpg';
          $blogDate = date('d', strtotime($blog['created_at']));
          $blogMon  = date('M', strtotime($blog['created_at']));
        ?>
        <div class="col-lg-4 col-md-6 mb-4 d-flex">
          <div class="aw-blog-card w-100">
            <div class="aw-blog-img-wrap">
              <a href="blog-detail?slug=<?= htmlspecialchars($blog['slug']) ?>">
                <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" loading="lazy">
              </a>
              <div class="aw-blog-date">
                <span class="day"><?= $blogDate ?></span>
                <span class="mon"><?= $blogMon ?></span>
              </div>
            </div>
            <div class="aw-blog-body">
              <div class="aw-blog-cat"><?= htmlspecialchars($blog['category'] ?? 'Travel') ?></div>
              <div class="aw-blog-title"><a href="blog-detail?slug=<?= htmlspecialchars($blog['slug']) ?>"><?= htmlspecialchars($blog['title']) ?></a></div>
              <div class="aw-blog-excerpt"><?= htmlspecialchars(mb_strimwidth(strip_tags($blog['excerpt'] ?: ($blog['body'] ?? '')), 0, 120, '...')) ?></div>
              <a href="blog-detail?slug=<?= htmlspecialchars($blog['slug']) ?>" class="aw-blog-read">Read More <i class="fa fa-arrow-right ml-1"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center mt-3">
        <a href="blog" class="aw-view-all">View All Articles &rarr;</a>
      </div>
    </div>
  </section>
  <?php endif; ?>


  <!-- ====================================================
       10. CTA / QUOTATION BAND
       ==================================================== -->
  <section class="aw-cta-band text-center">
    <div class="container" style="max-width:900px;">
      <h2>Request a Quotation Now!</h2>
      <p>Ready to turn your dream holiday into reality? Speak with an Attwood specialist today — let us craft your perfect journey.</p>
      <a href="contact" class="aw-btn-red mr-3" style="font-size:16px;padding:14px 36px;">Request Now <i class="fa fa-arrow-right ml-2"></i></a>
      <a href="tours" class="aw-btn-olive" style="font-size:16px;padding:14px 36px;">Browse Tours</a>
    </div>
  </section>


  <?php require_once 'includes/footer.php'; ?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff0000"/>
  </svg></div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="assets/js/attwood-nav.js"></script>
  <script src="js/main.js"></script>

  <script>
  $(document).ready(function () {

    // ── Hero Slider ──────────────────────────────────────
    var slides = document.querySelectorAll('.aw-hero-slide');
    var dotsWrap = document.getElementById('heroDots');
    var currentSlide = 0;
    var heroInterval;

    // Build dots
    slides.forEach(function(_, i) {
      var dot = document.createElement('button');
      dot.className = 'aw-hero-dot' + (i === 0 ? ' active' : '');
      dot.setAttribute('aria-label', 'Slide ' + (i + 1));
      dot.addEventListener('click', function() { goToSlide(i); resetHeroInterval(); });
      dotsWrap.appendChild(dot);
    });

    function goToSlide(n) {
      slides[currentSlide].classList.remove('active');
      document.querySelectorAll('.aw-hero-dot')[currentSlide].classList.remove('active');
      currentSlide = (n + slides.length) % slides.length;
      slides[currentSlide].classList.add('active');
      document.querySelectorAll('.aw-hero-dot')[currentSlide].classList.add('active');
    }

    function nextSlide() { goToSlide(currentSlide + 1); }
    function prevSlide() { goToSlide(currentSlide - 1); }

    function resetHeroInterval() {
      clearInterval(heroInterval);
      heroInterval = setInterval(nextSlide, 5500);
    }

    document.getElementById('heroNext').addEventListener('click', function() { nextSlide(); resetHeroInterval(); });
    document.getElementById('heroPrev').addEventListener('click', function() { prevSlide(); resetHeroInterval(); });

    resetHeroInterval();

    // ── Testimonials Owl Carousel ─────────────────────────
    $('#aw-testi-carousel').owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      dots: true,
      nav: false,
      slideSpeed: 800,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn'
    });

    // ── Destinations Carousel ─────────────────────────────
    var destTrack    = document.querySelector('.aw-dest-track');
    var destSlides   = document.querySelectorAll('.aw-dest-slide');
    var destDotWrap  = document.getElementById('awDestDots');
    var destCurrent  = 0;

    if (destTrack && destSlides.length) {
      function getDestSPV() {
        var w = window.innerWidth;
        if (w <= 768) return 1;
        if (w <= 1024) return 3;
        return 4;
      }

      function buildDestDots() {
        destDotWrap.innerHTML = '';
        var spv = getDestSPV();
        var totalPages = Math.ceil(destSlides.length / spv);
        for (var i = 0; i < totalPages; i++) {
          var dot = document.createElement('button');
          dot.className = 'aw-dest-dot' + (i === 0 ? ' active' : '');
          dot.dataset.page = i;
          dot.addEventListener('click', function() {
            destGoTo(parseInt(this.dataset.page) * getDestSPV());
          });
          destDotWrap.appendChild(dot);
        }
      }

      function updateDestDots() {
        var spv = getDestSPV();
        var activePage = Math.round(destCurrent / spv);
        document.querySelectorAll('.aw-dest-dot').forEach(function(d, i) {
          d.classList.toggle('active', i === activePage);
        });
      }

      function destGoTo(index) {
        var spv = getDestSPV();
        // Responsive slide widths
        destSlides.forEach(function(sl) {
          var pct = (100 / spv) - 1.5;
          sl.style.flex = '0 0 calc(' + pct + '% - ' + (20 * (spv - 1) / spv) + 'px)';
          sl.style.minWidth = sl.style.flex;
        });
        var max = Math.max(0, destSlides.length - spv);
        destCurrent = Math.max(0, Math.min(index, max));
        var slideWidth = destSlides[0].offsetWidth + 20;
        destTrack.style.transform = 'translateX(-' + (destCurrent * slideWidth) + 'px)';
        updateDestDots();
      }

      document.querySelector('.aw-dest-prev').addEventListener('click', function() { destGoTo(destCurrent - getDestSPV()); });
      document.querySelector('.aw-dest-next').addEventListener('click', function() { destGoTo(destCurrent + getDestSPV()); });

      buildDestDots();
      destGoTo(0);
      window.addEventListener('resize', function() { buildDestDots(); destGoTo(0); });
      setInterval(function() {
        var spv = getDestSPV();
        var max = Math.max(0, destSlides.length - spv);
        destGoTo(destCurrent + spv > max ? 0 : destCurrent + spv);
      }, 5000);
    }

    // ── Hero AJAX Search ──────────────────────────────────
    var heroSearchInput   = document.getElementById('aw-dest-input');
    var heroSearchResults = document.getElementById('aw-search-results');
    if (heroSearchInput && heroSearchResults) {
      var heroSearchTimeout;
      heroSearchInput.addEventListener('input', function () {
        var q = this.value.trim();
        clearTimeout(heroSearchTimeout);
        if (q.length < 2) { heroSearchResults.classList.add('d-none'); return; }
        heroSearchTimeout = setTimeout(function () {
          fetch('ajax-search.php?q=' + encodeURIComponent(q))
            .then(function(res) { return res.json(); })
            .then(function(data) {
              if (data.length === 0) {
                heroSearchResults.innerHTML = '<div style="padding:16px;color:#666;font-size:14px;text-align:center;">No results found</div>';
              } else {
                var html = '<ul style="list-style:none;margin:0;padding:0;">';
                data.forEach(function(item) {
                  html += '<li style="border-bottom:1px solid #f0ebe3;">' +
                    '<a href="' + item.url + '" style="display:flex;align-items:center;padding:12px 16px;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background=\'#faf8f4\'" onmouseout="this.style.background=\'transparent\'">' +
                    '<img src="' + item.image + '" alt="" style="width:50px;height:50px;object-fit:cover;border-radius:4px;margin-right:16px;">' +
                    '<div><div style="font-family:\'Raleway\',sans-serif;font-size:16px;font-weight:700;color:#232a20;">' + item.title + '</div>' +
                    '<div style="font-family:\'Raleway\',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#ff0000;">' + item.type + '</div></div>' +
                    '</a></li>';
                });
                html += '</ul>';
                heroSearchResults.innerHTML = html;
              }
              heroSearchResults.classList.remove('d-none');
            })
            .catch(function(err) { console.error('Search error', err); });
        }, 300);
      });
      document.addEventListener('click', function(e) {
        if (!e.target.closest('#aw-dest-input') && !e.target.closest('#aw-search-results')) {
          heroSearchResults.classList.add('d-none');
        }
      });
    }

  });
  </script>
  <script src="js/start-planning.js?v=<?= time() ?>"></script>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){ var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0]; s1.async=true; s1.src='https://embed.tawk.to/6820fd5f0468761914094844/1ir0drfc8'; s1.charset='UTF-8'; s1.setAttribute('crossorigin','*'); s0.parentNode.insertBefore(s1,s0); })();
  </script>
  <!--End of Tawk.to Script-->

</body>

</html>