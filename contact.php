<?php
require_once 'includes/db.php';
$pdo = getPDO();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Attwood Travel Agency Ltd &mdash; Plan Your Safari</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Get in touch with Attwood Travel Agency Ltd. Our safari specialists are ready to craft your perfect African journey.">
  <link rel="icon" href="assets/favicon_io/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/attwood-theme.css">
  <style>
    .contact-form-box { background:#fff; padding:40px; border-radius:12px; box-shadow:var(--aw-shadow-card); }
    .contact-form-box .form-control { border:1px solid var(--aw-border); border-radius:6px; font-family:var(--aw-font-ui); font-size:14px; padding:14px 16px; color:var(--aw-text-dark); background:rgba(250, 248, 244, 0.5); margin-bottom:20px; transition:border 0.3s; }
    .contact-form-box .form-control:focus { border-color:var(--aw-primary); box-shadow:0 0 0 3px rgba(196,144,24,.1); outline:none; background:#fff; }
    .contact-form-box label { font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--aw-text-muted); font-family:var(--aw-font-ui); margin-bottom:8px; display:block; }
    .contact-info-box { padding:32px 0; }
    .contact-item { display:flex; gap:20px; margin-bottom:24px; transition:var(--aw-transition); }
    .contact-item:hover { transform:translateY(-2px); }
    .contact-item .icon { width:54px; height:54px; background:rgba(196,144,24,0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:var(--aw-primary); }
    .contact-item .icon i { font-size:22px; }
    .contact-item .text h4 { font-family:var(--aw-font-body); font-size:20px; font-weight:800; color:var(--aw-text-dark); margin-bottom:6px; }
    .contact-item .text p { font-size:15px; color:var(--aw-text-muted); margin:0; line-height:1.6; font-family:var(--aw-font-ui); }
    .contact-item .text a { color:var(--aw-text-muted); text-decoration:none; transition:var(--aw-transition); }
    .contact-item .text a:hover { color:var(--aw-primary); }
    #contactFeedback { display:none; }
  </style>
<link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">
<?php @include_once __DIR__.'/includes/head_tags.php'; ?>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<section class="tdv2-hero" style="background-image:url('oldattwood/img/slider/slider-1.jpg');">
  <div class="tdv2-hero-overlay"></div>
  <div class="tdv2-hero-content text-center">
    <div class="tdv2-hero-eyebrow" style="margin-bottom:12px; justify-content:center;">Get In Touch</div>
    <h1 style="font-family:var(--aw-font-body); font-size:clamp(32px,5vw,60px); font-weight:800; color:#fff; line-height:1.1; margin-bottom:16px;">Plan Your Safari</h1>
  </div>
  <div class="tdv2-hero-breadcrumb">
    <a href="index.php">Home</a>
    <span class="sep">/</span>
    <span class="current">Contact Us</span>
  </div>
</section>

<section class="section-pad bg-cream">
  <div class="container" style="max-width:1280px;">
    
    <div class="aw-section-heading centered" style="margin:0 auto 60px;">
      <span class="eyebrow" style="color:var(--aw-primary);">Plan Your Safari</span>
      <h2 style="font-family:var(--aw-font-body); font-size:36px; font-weight:800; color:var(--aw-text-dark); margin-top:10px;">Let's Craft Your Journey</h2>
      <p style="font-family:var(--aw-font-ui); color:var(--aw-text-muted); font-size:16px; max-width:600px; margin:16px auto 0;">Whether you're ready to book or just starting to dream, our safari specialists are here to help you design the perfect itinerary.</p>
    </div>
    <div class="contact-info-grid" style="text-align:left; background:#fff; padding:48px; border-radius:12px; border:1px solid var(--aw-border); box-shadow:var(--aw-shadow-card);">
      <h3 style="font-family:var(--aw-font-body); font-size:28px; font-weight:800; color:var(--aw-text-dark); margin-bottom:32px; text-align:center;">Contact Information</h3>
      
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="contact-item" style="height:100%; padding:32px; border:1px solid var(--aw-border); border-radius:12px; background:#fff; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
            <div class="icon"><i class="fa fa-map-marker"></i></div>
            <div class="text">
              <h4>Our Office</h4>
              <p>Ambank House, Nairobi, Kenya<br>East Africa</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 mb-4">
          <div class="contact-item" style="height:100%; padding:32px; border:1px solid var(--aw-border); border-radius:12px; background:#fff; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
            <div class="icon"><i class="fa fa-phone"></i></div>
            <div class="text">
              <h4>Call Us</h4>
              <p><a href="tel:+254757139239">+254 757 139239</a></p>
              <p style="font-size:13px; margin-top:8px; color:var(--aw-primary);">Mon - Fri: 8am to 6pm (EAT)</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 mb-4">
          <div class="contact-item" style="height:100%; padding:32px; border:1px solid var(--aw-border); border-radius:12px; background:#fff; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
            <div class="icon"><i class="fa fa-envelope"></i></div>
            <div class="text">
              <h4>Email Us</h4>
              <p><a href="mailto:info@filaoadventures.co.ke">info@filaoadventures.co.ke</a></p>
            </div>
          </div>
        </div>

        <div class="col-md-6 mb-4">
          <div class="contact-item" style="height:100%; padding:32px; border:1px solid var(--aw-border); border-radius:12px; background:#fff; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
            <div class="icon" style="color:#25D366; background:rgba(37,211,102,0.1);"><i class="fa fa-whatsapp"></i></div>
            <div class="text">
              <h4>WhatsApp</h4>
              <p><a href="https://wa.me/254757139239" target="_blank">Chat with a Specialist</a></p>
            </div>
          </div>
        </div>
      <div style="margin-top:20px; border-top:1px solid var(--aw-border); padding-top:32px; text-align:center;">
        <h4 style="font-family:var(--aw-font-ui); font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--aw-primary); margin-bottom:16px;">Connect With Us</h4>
        <div style="display:flex; gap:16px; justify-content:center;">
          <a href="https://www.facebook.com/profile.php?id=100084891550126#" style="width:44px; height:44px; background:#fff; border:1px solid var(--aw-border); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--aw-text-dark); transition:var(--aw-transition); box-shadow:var(--aw-shadow-card);" onmouseover="this.style.color='var(--aw-primary)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.color='var(--aw-text-dark)'; this.style.transform='none'"><i class="fa fa-facebook"></i></a>
          <a href="https://www.instagram.com/filaoadventures/" style="width:44px; height:44px; background:#fff; border:1px solid var(--aw-border); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--aw-text-dark); transition:var(--aw-transition); box-shadow:var(--aw-shadow-card);" onmouseover="this.style.color='var(--aw-primary)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.color='var(--aw-text-dark)'; this.style.transform='none'"><i class="fa fa-instagram"></i></a>
          <a href="https://ke.linkedin.com/jobs/view/travel-consultant-at-attwood-adventures-4398464574" style="width:44px; height:44px; background:#fff; border:1px solid var(--aw-border); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--aw-text-dark); transition:var(--aw-transition); box-shadow:var(--aw-shadow-card);" onmouseover="this.style.color='var(--aw-primary)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.color='var(--aw-text-dark)'; this.style.transform='none'"><i class="fa fa-linkedin"></i></a>
        </div>
      </div>
    </div>
    
    <!-- Contact Form Section -->
    <div class="row justify-content-center mt-5" style="text-align:left;">
      <div class="col-lg-8">
        <div class="contact-form-box">
          <h3 style="font-family:var(--aw-font-body); font-size:28px; font-weight:800; color:var(--aw-text-dark); margin-bottom:24px;">Send a Message</h3>
          <form id="contactForm" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">First Name *</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="Your first name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">Last Name *</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Your last name" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email Address *</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone / WhatsApp</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="message">Message *</label>
              <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tell us about your plans or ask a question..." required></textarea>
            </div>
            <div id="contactFeedback" class="alert alert-info" style="font-family:var(--aw-font-ui); font-size:14px; padding:12px; border-radius:6px; margin-bottom:20px; display:none;"></div>
            <div class="text-center">
              <button type="submit" class="aw-btn-primary" style="width:100%; padding:14px; font-size:14px;"><i class="fa fa-paper-plane mr-2"></i> Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section style="height:450px;width:100%;background:#e5e5e5;position:relative;">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8213590140717!2d36.818516773111256!3d-1.2808824356163548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d4ebab9d2f%3A0xdbeb6499f1afcd15!2sTwiga%20Towers!5e0!3m2!1sen!2ske!4v1783868324520!5m2!1sen!2ske" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
</section>

<?php require_once 'includes/footer.php'; ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="assets/js/attwood-nav.js"></script>
<script src="js/start-planning.js?v=1781967414"></script>
<script>
</script>
</body>
</html>
