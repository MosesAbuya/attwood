import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

# I will replace everything from /* MODERN PLAYFUL FOOTER (3-LAYER OVERLAP) */ to the end of the file.
parts = css_content.split('/* MODERN PLAYFUL FOOTER (3-LAYER OVERLAP) */')
base_css = parts[0]

new_css = """/* MODERN PLAYFUL FOOTER (3-LAYER OVERLAP) */
.aw-footer-modern {
  font-family: 'Inter', sans-serif;
  display: flex;
  flex-direction: column;
}

/* Layer 1: Newsletter Top */
.aw-footer-newsletter-layer {
  /* Background image set inline in HTML */
  padding: 80px 20px 200px 20px; /* huge bottom padding to make room for banner */
  position: relative;
}

.aw-footer-title {
  font-size: clamp(32px, 4vw, 48px);
  font-weight: 700;
  letter-spacing: -0.03em;
  margin-bottom: 10px;
}

.aw-footer-subtitle {
  font-size: 16px;
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
  border-color: var(--aw-accent-gold);
}

.aw-btn-dark {
  background: var(--aw-accent-gold);
  color: #000;
  border: none;
  padding: 15px 30px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s;
}

.aw-btn-dark:hover {
  opacity: 0.9;
}

/* Layer 2: Floating Banner */
.aw-banner-wrapper {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  transform: translateY(50%); /* EXACTLY straddles the boundary */
  z-index: 10;
}

.aw-footer-floating-banner {
  background: var(--aw-accent-gold); /* Yellow middle layer */
  border-radius: 24px;
  padding: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 30px 60px rgba(0,0,0,0.3);
  position: relative;
  overflow: hidden;
}

.aw-banner-content {
  position: relative;
  z-index: 2;
  max-width: 50%;
}

.aw-banner-title {
  color: #000;
  font-size: clamp(32px, 4vw, 42px);
  font-family: 'Inter', sans-serif !important;
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 15px;
  letter-spacing: -0.02em;
}

.aw-banner-subtitle {
  color: rgba(0,0,0,0.7);
  font-size: 16px;
  margin-bottom: 30px;
  font-weight: 500;
}

.aw-btn-white {
  background: #000;
  color: #fff;
  border: none;
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.aw-btn-white:hover {
  background: #222;
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
  transform: translateX(10%);
}

/* Layer 3: Black Base Layer */
.aw-footer-base-layer {
  background: #000000; /* Black bottom layer */
  color: #fff;
  padding: 200px 20px 40px 20px; /* Space for the bottom half of the straddling banner */
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
  color: var(--aw-accent-gold);
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
}
"""

with open(css_path, 'w', encoding='utf-8') as f:
    f.write(base_css + "\n/* ==========================================================================\n" + new_css)

print("Rewrote footer CSS.")
