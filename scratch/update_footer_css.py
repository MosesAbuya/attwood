import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# Remove old .fa-footer styles roughly
css_content = re.sub(r'/\* ==+[\s\n]+FOOTER[\s\S]+?(?=/\* ==|$)', '', css_content)
css_content = re.sub(r'\.fa-footer\b[\s\S]*?(?=\n\n\n|\Z)', '', css_content)

new_css = """
/* ==========================================================================
   MODERN PLAYFUL FOOTER (3-LAYER OVERLAP)
   ========================================================================== */
.aw-footer-modern {
  font-family: 'Inter', sans-serif;
  background: #f8f9fa; /* slightly offwhite behind the white top section if needed */
  padding-top: 60px; /* Space above footer */
}

/* Layer 1: White Newsletter */
.aw-footer-newsletter-layer {
  background: #ffffff;
  border-radius: 40px 40px 0 0;
  padding: 80px 20px 180px 20px; /* Extra bottom padding to hide under banner */
}

.aw-footer-title {
  font-size: clamp(32px, 4vw, 48px);
  font-weight: 700;
  color: #000;
  letter-spacing: -0.03em;
  margin-bottom: 10px;
}

.aw-footer-subtitle {
  font-size: 16px;
  color: #666;
  margin-bottom: 30px;
}

.aw-newsletter-form-inline {
  display: flex;
  max-width: 500px;
  margin: 0 auto;
  gap: 15px;
}

.aw-input-wrapper {
  flex: 1;
  position: relative;
  display: flex;
  align-items: center;
}

.aw-input-wrapper i {
  position: absolute;
  left: 20px;
  font-size: 16px;
}

.aw-input-wrapper input {
  width: 100%;
  padding: 15px 20px 15px 45px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 15px;
  outline: none;
  transition: border-color 0.2s;
}

.aw-input-wrapper input:focus {
  border-color: #000;
}

.aw-btn-dark {
  background: #000;
  color: #fff;
  border: none;
  padding: 15px 30px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s;
}

.aw-btn-dark:hover {
  opacity: 0.8;
}

/* Container for overlapping sections */
.aw-footer-dark-section {
  position: relative;
}

/* Layer 2: Floating Banner */
.aw-banner-container {
  z-index: 10;
  margin-top: -120px; /* Pulls it up over the white section */
}

.aw-footer-floating-banner {
  background: linear-gradient(135deg, #111111, #1a1a1a);
  border-radius: 24px;
  padding: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 30px 60px rgba(0,0,0,0.15);
  position: relative;
  overflow: hidden;
}

.aw-banner-content {
  position: relative;
  z-index: 2;
  max-width: 50%;
}

.aw-banner-title {
  color: #fff;
  font-size: clamp(32px, 4vw, 42px);
  font-weight: 600;
  line-height: 1.1;
  margin-bottom: 15px;
  letter-spacing: -0.02em;
}

.aw-banner-subtitle {
  color: rgba(255,255,255,0.7);
  font-size: 16px;
  margin-bottom: 30px;
}

.aw-btn-white {
  background: #fff;
  color: #000;
  border: none;
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.aw-btn-white:hover {
  background: #eee;
}

.aw-banner-image {
  position: absolute;
  right: 0;
  top: 0;
  bottom: 0;
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.aw-banner-image img {
  height: 120%;
  width: auto;
  object-fit: cover;
  transform: translateX(10%); /* push it slightly off right edge */
}

/* Layer 3: Black Base Layer */
.aw-footer-base-layer {
  background: #000000;
  color: #fff;
  padding: 160px 20px 40px 20px; /* huge top padding to sit under banner */
  margin-top: -100px; /* pulls it up under the banner */
  position: relative;
  z-index: 1;
}

.aw-footer-address p {
  color: rgba(255,255,255,0.5);
  font-size: 13px;
  line-height: 1.6;
  margin-bottom: 0;
}

.aw-contact-label {
  color: rgba(255,255,255,0.4);
  font-size: 11px;
  margin-bottom: 4px;
}

.aw-contact-val {
  color: rgba(255,255,255,0.8);
  font-size: 13px;
  text-decoration: none;
  font-weight: 500;
}
.aw-contact-val:hover {
  color: #fff;
}

.aw-footer-col-title {
  color: rgba(255,255,255,0.4);
  font-size: 12px;
  font-weight: 500;
  margin-bottom: 25px;
}

.aw-footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.aw-footer-links li {
  margin-bottom: 15px;
}

.aw-footer-links a {
  color: rgba(255,255,255,0.8);
  text-decoration: none;
  font-size: 13px;
  transition: color 0.2s;
}

.aw-footer-links a:hover {
  color: #fff;
}

.aw-footer-copyright {
  border-top: 1px solid rgba(255,255,255,0.1);
  margin-top: 60px;
  padding-top: 30px;
  color: rgba(255,255,255,0.4);
  font-size: 12px;
}

/* Responsive */
@media (max-width: 768px) {
  .aw-footer-floating-banner {
    flex-direction: column;
    padding: 40px 30px;
    text-align: center;
  }
  .aw-banner-content {
    max-width: 100%;
    margin-bottom: 30px;
  }
  .aw-banner-image {
    position: relative;
    width: 100%;
    height: 200px;
    justify-content: center;
  }
  .aw-banner-image img {
    height: 100%;
    transform: none;
  }
  .aw-newsletter-form-inline {
    flex-direction: column;
  }
  .aw-footer-base-layer {
    padding-top: 100px; /* adjusted for mobile */
  }
}
"""

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(css_content + "\n\n" + new_css)

print("Updated attwood-brand.css with playful footer styles")
