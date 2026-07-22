import re

js_path = 'e:/xampp/htdocs/attwood/js/aw-navbar.js'
with open(js_path, 'r', encoding='utf-8') as f:
    js_content = f.read()

new_js = """
    // Mega Menu Click Toggle
    const megaTriggers = document.querySelectorAll(".aw-mega-trigger");
    megaTriggers.forEach(trigger => {
        trigger.addEventListener("click", function(e) {
            e.preventDefault();
            const parentItem = this.parentElement;
            
            // Close others
            document.querySelectorAll('.aw-nav-item.aw-has-megamenu').forEach(item => {
                if (item !== parentItem) {
                    item.classList.remove('active');
                }
            });

            // Toggle current
            parentItem.classList.toggle("active");
        });
    });

    // Close Mega Menu when clicking outside
    document.addEventListener("click", function(e) {
        if (!e.target.closest('.aw-nav-item.aw-has-megamenu')) {
            document.querySelectorAll('.aw-nav-item.aw-has-megamenu').forEach(item => {
                item.classList.remove('active');
            });
        }
    });
"""

if "Mega Menu Click Toggle" not in js_content:
    parts = js_content.rsplit("});", 1)
    if len(parts) == 2:
        updated_js = parts[0] + new_js + "\n});"
        with open(js_path, 'w', encoding='utf-8') as f:
            f.write(updated_js)
        print("Added JS click logic for mega menus")
    else:
        print("Could not find ending block")
else:
    print("JS logic already exists")

# Also let's review the close button logic
# Sometimes pointer-events from overlays capture the click. 
# It's fixed by the CSS z-index we added.
