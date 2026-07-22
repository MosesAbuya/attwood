import os

footer_path = 'e:/xampp/htdocs/attwood/includes/footer.php'

new_footer = """<?php
// includes/footer.php   Attwood Travel Agency Ltd Global Footer
?>
<footer class="aw-footer-modern">
  <!-- Layer 1: White Newsletter Top -->
  <div class="aw-footer-newsletter-layer">
    <div class="container text-center">
      <h2 class="aw-footer-title">Subscribe to our newsletter</h2>
      <p class="aw-footer-subtitle">Sign up today and get exclusive safari itineraries and offers.</p>
      
      <form class="aw-newsletter-form-inline" id="footerNewsletterForm">
        <div class="aw-input-wrapper">
          <i class="fa fa-envelope-o text-muted"></i>
          <input type="email" name="email" placeholder="Enter your email address" required>
        </div>
        <button type="submit" class="aw-btn-dark">Get started</button>
      </form>
      <div id="footerNewsletterFeedback" style="display:none; font-size:13px; margin-top:15px; border-radius:4px; padding:10px; max-width:400px; margin-left:auto; margin-right:auto;"></div>
      
      <div class="aw-footer-experts mt-4 d-flex align-items-center justify-content-center gap-2">
        <span style="font-size:12px; font-weight:500; color:#777;">Our experts are ready to help!</span>
        <div class="aw-expert-avatars d-flex">
           <img src="oldattwood/img/team/moses.jpg" alt="Expert" style="width:28px; height:28px; border-radius:50%; border: 2px solid #fff; object-fit:cover; margin-right:-8px; position:relative; z-index:3;">
           <img src="oldattwood/img/slider/slide2.jpg" alt="Expert" style="width:28px; height:28px; border-radius:50%; border: 2px solid #fff; object-fit:cover; margin-right:-8px; position:relative; z-index:2;">
           <img src="oldattwood/img/slider/slide3.jpg" alt="Expert" style="width:28px; height:28px; border-radius:50%; border: 2px solid #fff; object-fit:cover; position:relative; z-index:1;">
        </div>
      </div>
    </div>
  </div>

  <!-- Layer 2 & 3 Container (for overlapping) -->
  <div class="aw-footer-dark-section">
    <!-- Layer 2: Floating Banner -->
    <div class="container position-relative aw-banner-container">
      <div class="aw-footer-floating-banner">
        <div class="aw-banner-content">
          <h2 class="aw-banner-title">Experience superior<br>safaris</h2>
          <p class="aw-banner-subtitle">150+ custom itineraries per search.</p>
          <button data-open-planner="true" class="aw-btn-white">Get started</button>
        </div>
        <div class="aw-banner-image">
          <img src="images/footer/travel.png" alt="Travel Globe">
        </div>
      </div>
    </div>

    <!-- Layer 3: Deep Black Footer Base -->
    <div class="aw-footer-base-layer">
      <div class="container" style="max-width: 1200px;">
        <div class="row">
          <!-- Logo & Address Column -->
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="aw-footer-brand">
              <!-- Using an inverted or white text logo -->
              <img src="assets/logo/attwood-logo.png" alt="Attwood Travel Agency" class="aw-footer-base-logo" style="filter: brightness(0) invert(1); max-height:40px;">
            </div>
            <div class="aw-footer-address mt-4">
              <p>Attwood Travel Agency Ltd<br>Nairobi, Kenya<br>East Africa</p>
              
              <div class="d-flex gap-4 mt-4 aw-contact-block">
                <div>
                  <span class="d-block aw-contact-label">Phone number</span>
                  <a href="tel:+254757139239" class="aw-contact-val">+254 757 139 239</a>
                </div>
                <div>
                  <span class="d-block aw-contact-label">Email</span>
                  <a href="mailto:info@filaoadventures.co.ke" class="aw-contact-val">info@attwood.co.ke</a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Links Columns -->
          <div class="col-lg-8">
            <div class="row">
              <div class="col-6 col-md-4 mb-4">
                <h4 class="aw-footer-col-title">Quick links</h4>
                <ul class="aw-footer-links">
                  <li><a href="destinations">Destinations</a></li>
                  <li><a href="tours">Tours</a></li>
                  <li><a href="about">About us</a></li>
                  <li><a href="safaris">Safaris</a></li>
                  <li><a href="contact">Contact us</a></li>
                </ul>
              </div>
              <div class="col-6 col-md-4 mb-4">
                <h4 class="aw-footer-col-title">Social</h4>
                <ul class="aw-footer-links">
                  <li><a href="https://www.facebook.com/share/16HsWzXEFA/" target="_blank">Facebook</a></li>
                  <li><a href="https://www.instagram.com" target="_blank">Instagram</a></li>
                  <li><a href="https://www.linkedin.com" target="_blank">LinkedIn</a></li>
                  <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                  <li><a href="https://youtube.com" target="_blank">Youtube</a></li>
                </ul>
              </div>
              <div class="col-12 col-md-4 mb-4">
                <h4 class="aw-footer-col-title">Legal</h4>
                <ul class="aw-footer-links">
                  <li><a href="booking-terms">Terms of service</a></li>
                  <li><a href="privacy-policy">Privacy policy</a></li>
                  <li><a href="cookie-policy">Cookie policy</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Copyright Bottom -->
        <div class="aw-footer-copyright text-center">
          <p>&copy; <?php echo date('Y'); ?> Attwood Travel Agency Ltd. All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nlForm = document.getElementById('footerNewsletterForm');
    const nlFeedback = document.getElementById('footerNewsletterFeedback');
    
    if (nlForm) {
        nlForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = nlForm.querySelector('input[name="email"]');
            const btn = nlForm.querySelector('button[type="submit"]');
            
            if(!emailInput.value) return;
            
            const originalBtnText = btn.innerText;
            btn.innerText = 'Sending...';
            btn.disabled = true;
            
            const formData = new FormData();
            formData.append('email', emailInput.value);
            
            fetch('ajax_subscribe.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.innerText = originalBtnText;
                btn.disabled = false;
                nlFeedback.style.display = 'block';
                
                if (data.status === 'success') {
                    nlFeedback.style.backgroundColor = '#d4edda';
                    nlFeedback.style.color = '#155724';
                    nlFeedback.style.border = '1px solid #c3e6cb';
                    nlFeedback.innerHTML = data.message;
                    nlForm.reset();
                } else {
                    nlFeedback.style.backgroundColor = '#f8d7da';
                    nlFeedback.style.color = '#721c24';
                    nlFeedback.style.border = '1px solid #f5c6cb';
                    nlFeedback.innerHTML = data.message || 'Error subscribing. Please try again.';
                }
                
                setTimeout(() => {
                    nlFeedback.style.display = 'none';
                }, 5000);
            })
            .catch(err => {
                console.error(err);
                btn.innerText = originalBtnText;
                btn.disabled = false;
                nlFeedback.style.display = 'block';
                nlFeedback.style.backgroundColor = '#f8d7da';
                nlFeedback.style.color = '#721c24';
                nlFeedback.style.border = '1px solid #f5c6cb';
                nlFeedback.innerHTML = 'Network error. Please try again later.';
            });
        });
    }
});
</script>
"""

with open(footer_path, 'w', encoding='utf-8') as f:
    f.write(new_footer)

print("Rewrote footer.php with 3-layer architecture.")
