import os
import re

files_to_fix = [
    'why-us.php',
    'careers.php',
    'corporate.php',
    'best-time-to-visit.php',
    'travel-confidence.php',
    'travel-insurance.php',
    'best-price-guarantee.php',
    'booking-terms.php',
    'privacy-policy.php'
]

base_dir = 'e:/xampp/htdocs/attwood'

def replace_cta(match):
    full_text = match.group(0)
    
    # extract bg image
    bg_match = re.search(r"url\(['\"]?(.*?)['\"]?\)", full_text)
    bg_url = bg_match.group(1) if bg_match else 'oldattwood/img/slider/slide4.jpg'
    
    # extract h2 text
    h2_match = re.search(r"<h2[^>]*>(.*?)</h2>", full_text, re.DOTALL)
    h2_text = h2_match.group(1).strip() if h2_match else 'Start Planning Your Dream Safari'
    
    # extract p text
    p_match = re.search(r"<p[^>]*>(.*?)</p>", full_text, re.DOTALL)
    p_text = p_match.group(1).strip() if p_match else 'Let our specialists craft a custom itinerary perfectly suited to your preferences.'
    
    new_cta = f"""<section style="background-image:url('{bg_url}'); background-size:cover; background-position:center; position:relative; padding:100px 0;">
  <div style="position:absolute; inset:0; background:rgba(30,18,8,0.75);"></div>
  <div class="container" style="max-width:900px; position:relative; z-index:2; text-align:center;">
    <h2 style="font-family:var(--aw-font-body); font-size:clamp(36px,5vw,50px); font-weight:800; color:#fff; margin-bottom:20px;">{h2_text}</h2>
    <p style="font-family:var(--aw-font-ui); font-size:18px; color:rgba(255,255,255,0.85); margin-bottom:40px;">{p_text}</p>
    <button data-open-planner="true" class="aw-btn-primary" style="padding:16px 40px; font-size:16px;">Start Planning Now</button>
  </div>
</section>"""
    return new_cta

for f in files_to_fix:
    path = os.path.join(base_dir, f)
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as file:
            content = file.read()
            
        new_content = re.sub(r'<section class="fa-cta-banner".*?</section>', replace_cta, content, flags=re.DOTALL)
        
        if new_content != content:
            with open(path, 'w', encoding='utf-8') as file:
                file.write(new_content)
            print(f"Fixed CTA in {f}")
        else:
            print(f"No match found or unchanged in {f}")
    else:
        print(f"File not found: {f}")
