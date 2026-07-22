import re

js_path = 'e:/xampp/htdocs/attwood/js/aw-navbar.js'
with open(js_path, 'r', encoding='utf-8') as f:
    js_content = f.read()

new_js = """
    // Full Page Overlay Toggle
    const fullpageToggle = document.getElementById("aw-fullpage-toggle");
    const fullpageMenu = document.getElementById("aw-fullpage-menu");
    const fullpageClose = document.getElementById("aw-fullpage-close");

    if (fullpageToggle && fullpageMenu) {
        fullpageToggle.addEventListener("click", function(e) {
            e.preventDefault();
            fullpageMenu.classList.add("active");
            document.body.classList.add("aw-fp-noscroll");
        });
    }

    if (fullpageClose && fullpageMenu) {
        fullpageClose.addEventListener("click", function(e) {
            e.preventDefault();
            fullpageMenu.classList.remove("active");
            document.body.classList.remove("aw-fp-noscroll");
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape" && fullpageMenu && fullpageMenu.classList.contains("active")) {
            fullpageMenu.classList.remove("active");
            document.body.classList.remove("aw-fp-noscroll");
        }
    });
"""

if "aw-fullpage-toggle" not in js_content:
    # Insert before the last });
    parts = js_content.rsplit("});", 1)
    if len(parts) == 2:
        updated_js = parts[0] + new_js + "\n});"
        with open(js_path, 'w', encoding='utf-8') as f:
            f.write(updated_js)
        print("Added JS logic for fullpage overlay")
    else:
        print("Could not find ending block")
else:
    print("JS logic already exists")
