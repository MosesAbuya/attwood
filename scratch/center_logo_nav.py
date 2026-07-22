import re

nav_path = 'e:/xampp/htdocs/attwood/includes/nav.php'
with open(nav_path, 'r', encoding='utf-8') as f:
    nav_content = f.read()

# I will parse the fa-subnav-inner <ul> and insert the logo in the middle.
# I will also hide the fa-logo-row completely, because we want the logo in the main nav!

# 1. Hide fa-logo-row
nav_content = nav_content.replace('<div class="fa-logo-row" id="faLogoRow">', '<div class="fa-logo-row d-none" id="faLogoRow">')

# 2. Add the centered logo list item
# We need to find where to insert it. The <ul> has:
# Destinations (<li>...</li>)
# Tours
# Safari Experiences
# --> INSERT HERE <--
# Activities
# We Recommend
# Blog

logo_html = """
          <!-- CENTERED LOGO -->
          <li class="nav-logo-center d-none d-lg-flex" style="align-items:center; padding: 0 30px;">
            <a href="/">
              <img src="oldattwood/img/logo.png" alt="Attwood Travel Agency Ltd" style="max-height:65px; transition:all 0.3s;" class="aw-center-logo-img">
            </a>
          </li>
"""

# Let's just use regex to find the end of Safari Experiences <li>
# Safari Experiences ends with </li> before <!-- ACTIVITIES -->
# Wait, let's look at the source of nav.php to be precise.
# Safari Experiences has a mega menu? Let's check.
