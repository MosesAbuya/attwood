import re

index_path = 'e:/xampp/htdocs/attwood/index.php'
with open(index_path, 'r', encoding='utf-8') as f:
    index_content = f.read()

# The hero section starts at 1. HERO SLIDER and ends before 2. ABOUT SECTION
hero_pattern = re.compile(r'<!-- ===.*?1\. HERO SLIDER.*?=== -->.*?<!-- ===.*?2\. ABOUT SECTION.*?=== -->', re.DOTALL)

new_hero_html = """<!-- ====================================================
       1. HERO SLIDER (NEW SLEEK OVERHAUL)
       ==================================================== -->
<section class="aw-hero-sleek">
  <!-- Background Image -->
  <div class="aw-hero-bg" style="background-image: url('oldattwood/img/slider/slide1.jpg');"></div>
  <div class="aw-hero-overlay-sleek"></div>

  <!-- Content -->
  <div class="container h-100 position-relative z-index-2">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-12 col-md-10 col-lg-8 mt-5">
        <h1 class="aw-hero-title-sleek">Your Next Escape,<br>Perfectly Planned.</h1>
        <p class="aw-hero-subtitle-sleek mt-3">Experience the art of travel through curated destinations and handpicked experiences.<br>Your adventure begins here, refined, effortless, and made just for you.</p>
        
        <!-- Search Bar Container (Glassmorphism) -->
        <div class="aw-hero-search-glass mt-5">
          <form class="d-flex align-items-center flex-wrap flex-md-nowrap w-100" action="tours" method="GET">
            <div class="search-field">
              <input type="text" name="dest" placeholder="Search Destination">
              <i class="fa fa-angle-down"></i>
            </div>
            <div class="search-field">
              <input type="text" name="month" placeholder="Travel Dates">
            </div>
            <div class="search-field">
              <input type="text" name="type" placeholder="Travel Type">
              <i class="fa fa-angle-down"></i>
            </div>
            <div class="search-field border-0">
              <input type="number" name="guests" placeholder="Guests">
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

  <!-- Bottom Socials & Scroll Indicator -->
  <div class="aw-hero-bottom-bar d-flex justify-content-between align-items-end position-absolute w-100 px-4 px-lg-5 pb-4" style="bottom:0; z-index:2;">
    <div class="aw-hero-socials d-flex gap-3">
      <a href="#"><i class="fa fa-instagram"></i></a>
      <a href="#"><i class="fa fa-youtube-play"></i></a>
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-tiktok"></i></a>
    </div>
    <div class="aw-hero-scroll text-white d-none d-md-block" style="font-family:'Inter', sans-serif; font-size:14px; font-weight:600; cursor:pointer;" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
      Step Inside <i class="fa fa-arrow-down ml-2"></i>
    </div>
  </div>
</section>

<!-- ====================================================
       2. ABOUT SECTION
       ==================================================== -->"""

if hero_pattern.search(index_content):
    index_content = hero_pattern.sub(new_hero_html, index_content)
    with open(index_path, 'w', encoding='utf-8') as f:
        f.write(index_content)
    print("Replaced Hero in index.php")
else:
    print("Hero pattern not found!")
