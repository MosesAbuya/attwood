import re

blog_path = 'e:/xampp/htdocs/attwood/blog.php'
with open(blog_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Make blog cards playful
content = content.replace('fa-blog-card', 'aw-blog-card')
content = content.replace('bc-image-wrap', 'aw-blog-img-wrap')
content = content.replace('bc-body', 'aw-blog-body')
content = content.replace('bc-title', 'aw-blog-title')
content = content.replace('bc-meta', 'aw-blog-meta')
content = content.replace('bc-excerpt', 'aw-blog-excerpt')
content = content.replace('bc-footer', 'aw-blog-footer')

with open(blog_path, 'w', encoding='utf-8') as f:
    f.write(content)

# Define aw-blog-card in attwood-brand.css
css_path = 'e:/xampp/htdocs/attwood/css/attwood-brand.css'
with open(css_path, 'a', encoding='utf-8') as f:
    f.write("""
/* ============================================================
   35. BLOG CARDS
   ============================================================ */
.aw-blog-card {
  display: flex; flex-direction: column; background: var(--aw-white);
  border-radius: var(--aw-radius-md); overflow: hidden;
  box-shadow: var(--aw-shadow-card); border: 1px solid var(--aw-border);
  transition: var(--aw-transition); height: 100%;
}
.aw-blog-card:hover {
  transform: translateY(-5px); box-shadow: var(--aw-shadow-hover);
}
.aw-blog-img-wrap {
  position: relative; height: 240px; overflow: hidden;
}
.aw-blog-img-wrap img {
  width: 100%; height: 100%; object-fit: cover; transition: var(--aw-transition);
}
.aw-blog-card:hover .aw-blog-img-wrap img { transform: scale(1.05); }
.aw-blog-body { padding: 25px; display: flex; flex-direction: column; flex: 1; }
.aw-blog-meta {
  font-family: var(--aw-font-ui); font-size: 13px; font-weight: 600;
  color: var(--aw-accent-sky); margin-bottom: 10px; display: flex; gap: 15px;
}
.aw-blog-meta i { color: var(--aw-primary); }
.aw-blog-title a {
  font-family: var(--aw-font-body); font-size: 22px; font-weight: 800;
  color: var(--aw-text-dark) !important; line-height: 1.3;
}
.aw-blog-title a:hover { color: var(--aw-primary) !important; }
.aw-blog-excerpt {
  font-size: 15px; color: var(--aw-text-muted); margin-top: 15px; margin-bottom: 20px;
}
.aw-blog-footer {
  margin-top: auto; border-top: 1px dashed var(--aw-border); padding-top: 15px;
}
.aw-blog-footer a {
  font-family: var(--aw-font-playful); font-size: 18px; color: var(--aw-primary) !important;
  font-weight: 700;
}
""")

print("Updated blog.php and CSS")
