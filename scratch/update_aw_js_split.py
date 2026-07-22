import re

js_path = 'e:/xampp/htdocs/attwood/js/aw-navbar.js'
with open(js_path, 'r', encoding='utf-8') as f:
    js_content = f.read()

new_js = """
    // Mega Menu Split Pane Logic
    const megaMenus = document.querySelectorAll('.aw-mega-split');
    
    megaMenus.forEach(menu => {
        const sidebarItems = menu.querySelectorAll('.aw-sidebar-list li');
        const contentPanes = menu.querySelectorAll('.aw-mega-pane');
        const imgDisplay = menu.querySelector('.aw-mega-img-display');
        const links = menu.querySelectorAll('.aw-pane-links a');
        const closeBtn = menu.querySelector('.aw-mega-close');
        
        let currentDefaultImg = imgDisplay ? imgDisplay.src : '';

        // Sidebar Clicks
        sidebarItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Update active sidebar
                sidebarItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                // Update active pane
                const targetId = this.getAttribute('data-target');
                contentPanes.forEach(pane => {
                    if (pane.id === targetId) {
                        pane.classList.add('active');
                    } else {
                        pane.classList.remove('active');
                    }
                });

                // Update default image
                const newDefaultImg = this.getAttribute('data-default-img');
                if (newDefaultImg && imgDisplay) {
                    currentDefaultImg = newDefaultImg;
                    imgDisplay.src = currentDefaultImg;
                }
            });
        });

        // Hover Links for Image Swap
        links.forEach(link => {
            link.addEventListener('mouseenter', function() {
                const hoverImg = this.getAttribute('data-hover-img');
                if (hoverImg && imgDisplay) {
                    imgDisplay.src = hoverImg;
                }
            });

            link.addEventListener('mouseleave', function() {
                if (imgDisplay && currentDefaultImg) {
                    imgDisplay.src = currentDefaultImg;
                }
            });
        });

        // Close Button
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const parentItem = this.closest('.aw-nav-item.aw-has-megamenu');
                if (parentItem) {
                    parentItem.classList.remove('active');
                }
            });
        }
    });
"""

if "Mega Menu Split Pane Logic" not in js_content:
    parts = js_content.rsplit("});", 1)
    if len(parts) == 2:
        updated_js = parts[0] + new_js + "\n});"
        with open(js_path, 'w', encoding='utf-8') as f:
            f.write(updated_js)
        print("Added JS logic for split-pane mega menus")
    else:
        print("Could not find ending block")
else:
    print("JS logic already exists")
