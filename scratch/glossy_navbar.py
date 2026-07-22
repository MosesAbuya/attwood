import re

css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'r', encoding='utf-8') as f:
    css_content = f.read()

glossy_css = """
/* ============================================================
   41. GLOSSY FLOATING NAVBAR TWEAKS
   ============================================================ */

/* 1. Margin at the top so it floats */
.fa-site-header,
.fa-site-header.scrolled,
.fa-site-header.nav-sticky {
  top: 20px !important;
}

/* When scrolled down, maybe reduce the margin slightly, but keep it floating */
.fa-site-header.scrolled,
.fa-site-header.nav-sticky {
  top: 15px !important;
}

/* 2. Glossy Background & Bigger Padding & Center Alignment */
.fa-nav-row-inner {
  background: rgba(255, 255, 255, 0.15) !important;
  backdrop-filter: blur(15px) !important;
  -webkit-backdrop-filter: blur(15px) !important;
  border: 1px solid rgba(255, 255, 255, 0.3) !important;
  box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1) !important;
  
  /* Padding to make it bigger */
  padding: 12px 30px !important;
  
  /* Center items */
  justify-content: center !important;
  gap: 3vw !important; /* Space between logo, nav, and actions */
}

/* Also apply glossy when sticky, overriding previous solid backgrounds */
.fa-site-header.nav-sticky .fa-nav-row-inner,
.fa-site-header.scrolled .fa-nav-row-inner {
  background: rgba(255, 255, 255, 0.2) !important;
  backdrop-filter: blur(20px) !important;
  -webkit-backdrop-filter: blur(20px) !important;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
}

/* To ensure text is visible on glassy background, if needed */
.nav-top-link {
  font-weight: 600 !important;
  /* Re-add some padding so links don't look too squished */
  padding: 10px 10px !important;
  font-size: 12px !important;
}

/* Fix flex layout for Logo */
.fa-sticky-logo {
  margin-right: 0 !important; /* we use gap now */
}
.fa-sticky-logo img {
  max-height: 50px !important; /* slightly bigger logo */
}

/* White text to contrast with the glass background if it's over a dark hero */
/* Note: Wait, earlier I set text to black? If user wants glossy like search container, 
   the search container might have white text or dark text. I'll leave text color as is for now. */

"""

if "41. GLOSSY FLOATING NAVBAR TWEAKS" not in css_content:
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n" + glossy_css)
    print("Added glossy navbar tweaks")
else:
    print("Already added")
