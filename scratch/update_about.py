import os

# Append to attwood-brand.css
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'a', encoding='utf-8') as f:
    f.write("""
/* ============================================================
   34. INTERNAL PAGE HERO
   ============================================================ */
.aw-page-hero {
  position: relative;
  background-size: cover;
  background-position: center;
  padding: 100px 0 80px;
}
.aw-page-hero .overlay {
  position: absolute; inset: 0; background: rgba(35,42,32,0.65);
}
.aw-page-hero-content {
  position: relative; z-index: 2;
}
.aw-page-hero h1 {
  font-family: var(--aw-font-display) !important;
  font-size: 56px; color: var(--aw-white) !important;
  margin-bottom: 20px;
  text-shadow: 0 4px 15px rgba(0,0,0,0.3);
}
.breadcrumb-aw {
  display: flex; justify-content: center; gap: 10px; font-family: var(--aw-font-body);
}
.breadcrumb-aw a { color: var(--aw-accent-gold) !important; font-weight: 700; }
.breadcrumb-aw .bc-current { color: var(--aw-white); }
.breadcrumb-aw .bc-sep { color: rgba(255,255,255,0.5); }
""")

# Update about.php content
about_path = 'e:/xampp/htdocs/attwood/about.php'
with open(about_path, 'r', encoding='utf-8') as f:
    about = f.read()

about = about.replace('breadcrumb-fa', 'breadcrumb-aw')

old_story = """<div style="font-size:16px;color:#4A4340;line-height:1.8;">
          <p>Founded in 2018, Attwood Travel Agency Ltd was born from a deep, enduring love of Africa's wild places. What started as a small operation guiding passionate travelers through Kenya's renowned national parks has grown into a full-service luxury travel company crafting journeys to over 15 destinations worldwide.</p>
          <p>But despite our growth, our core philosophy remains unchanged. We believe that every traveler deserves a safari designed specifically for them &mdash; one that reflects their pace, their interests, and their dreams.</p>
          <p>We are not a mass-market booking engine. We are a team of dedicated safari specialists and local experts who know the African bush intimately. We know which luxury camps offer the best views of the migration, which guides have an uncanny ability to spot leopards, and exactly when to visit each park for the optimal experience.</p>
          <p>When you travel with Attwood Travel Agency Ltd, you're not just taking a trip; you're embarking on a carefully curated journey designed to leave you with memories that will last a lifetime.</p>
        </div>"""

new_story = """<div style="font-size:16px;color:#4A4340;line-height:1.8;">
          <p>Attwood Travel Agency Ltd is Kenya's premier tour operator. We are the best Tour Company in Kenya, offering a wide variety of holiday packages to make your vacation unforgettable.</p>
          <p>We are a dedicated team that is passionate about wildlife and conservation. What started as a small passion project has evolved into the most trusted agency for East African tours.</p>
          <p>When you book with Attwood, you're not just a client you're family. We ensure value for money, honesty, and convenient booking for all your travel needs.</p>
        </div>"""

about = about.replace(old_story, new_story)

old_values = """<div class="col-md-4 mb-4 text-center">
        <div style="width:80px;height:80px;background:#FAF8F4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid #E5DDD0;">
          <i class="fa fa-leaf" style="font-size:32px;color:#628C52;"></i>
        </div>
        <h3 style="font-family:'Cormorant Garant',serif;font-size:24px;color:#1C1712;margin-bottom:16px;">Sustainable Tourism</h3>
        <p style="font-size:14.5px;color:#6B6358;line-height:1.7;">We partner only with eco-certified lodges and ensure our operations respect and protect the delicate environments we visit.</p>
      </div>
      <div class="col-md-4 mb-4 text-center">
        <div style="width:80px;height:80px;background:#FAF8F4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid #E5DDD0;">
          <i class="fa fa-users" style="font-size:32px;color:#C49018;"></i>
        </div>
        <h3 style="font-family:'Cormorant Garant',serif;font-size:24px;color:#1C1712;margin-bottom:16px;">Local Expertise</h3>
        <p style="font-size:14.5px;color:#6B6358;line-height:1.7;">Born in Kenya, we are powered by genuine local knowledge. Our guides are the best in the business, offering unmatched insight.</p>
      </div>
      <div class="col-md-4 mb-4 text-center">
        <div style="width:80px;height:80px;background:#FAF8F4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid #E5DDD0;">
          <i class="fa fa-star-o" style="font-size:32px;color:#9E3A25;"></i>
        </div>
        <h3 style="font-family:'Cormorant Garant',serif;font-size:24px;color:#1C1712;margin-bottom:16px;">Personalized Service</h3>
        <p style="font-size:14.5px;color:#6B6358;line-height:1.7;">Your journey, your way. We listen carefully to your requirements and build itineraries that exceed your expectations.</p>
      </div>"""

new_values = """<div class="col-md-4 mb-4 text-center">
        <div style="width:80px;height:80px;background:#FAF8F4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid #ff0000;">
          <i class="fa fa-handshake-o" style="font-size:32px;color:#02adfa;"></i>
        </div>
        <h3 style="font-family:'Pacifico',cursive;font-size:24px;color:#232a20;margin-bottom:16px;">Honesty</h3>
        <p style="font-size:15px;color:#6B6358;line-height:1.7;">This founds us where we can set the tone for the kind of travel that you want to create builds loyalty and trust in customers.</p>
      </div>
      <div class="col-md-4 mb-4 text-center">
        <div style="width:80px;height:80px;background:#FAF8F4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid #ff0000;">
          <i class="fa fa-diamond" style="font-size:32px;color:#e9d020;"></i>
        </div>
        <h3 style="font-family:'Pacifico',cursive;font-size:24px;color:#232a20;margin-bottom:16px;">Value for Money</h3>
        <p style="font-size:15px;color:#6B6358;line-height:1.7;">We are bound to fit our whole cost and quality to meet our customers' requirements, expectations, and satisfaction.</p>
      </div>
      <div class="col-md-4 mb-4 text-center">
        <div style="width:80px;height:80px;background:#FAF8F4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid #ff0000;">
          <i class="fa fa-mobile" style="font-size:36px;color:#769242;"></i>
        </div>
        <h3 style="font-family:'Pacifico',cursive;font-size:24px;color:#232a20;margin-bottom:16px;">Convenient Booking</h3>
        <p style="font-size:15px;color:#6B6358;line-height:1.7;">We allow you to book your services conveniently by paying a down payment to our Lipa Na Mpesa till number.</p>
      </div>"""

about = about.replace(old_values, new_values)

with open(about_path, 'w', encoding='utf-8') as f:
    f.write(about)

print("Updated css and about.php")
