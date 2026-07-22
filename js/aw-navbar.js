document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById("awNavbar");
    const searchToggle = document.getElementById("aw-search-toggle");
    const searchBar = document.getElementById("aw-search-bar");
    const menuToggle = document.getElementById("aw-menu-toggle");
    let lastScrollTop = 0;

    // Scroll Behavior
    window.addEventListener("scroll", function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        
        if (currentScroll > 100) {
            if (currentScroll > lastScrollTop) {
                // Scrolling down
                navbar.classList.add("aw-scrolled-down");
                navbar.classList.remove("aw-scrolled-up");
            } else {
                // Scrolling up
                navbar.classList.add("aw-scrolled-up");
                navbar.classList.remove("aw-scrolled-down");
            }
        } else {
            // At the top
            navbar.classList.remove("aw-scrolled-down");
            navbar.classList.remove("aw-scrolled-up");
        }
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });

    // Search Toggle
    if (searchToggle && searchBar) {
        searchToggle.addEventListener("click", function(e) {
            e.preventDefault();
            searchBar.classList.toggle("active");
        });
    }

    // Mobile Menu Toggle
    if (menuToggle) {
        menuToggle.addEventListener("click", function(e) {
            e.preventDefault();
            navbar.classList.toggle("menu-open");
        });
    }

    // Mobile Accordion Dropdowns
    const dropdownToggles = document.querySelectorAll('.aw-has-dropdown > a');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) {
                e.preventDefault();
                this.parentElement.classList.toggle('active');
            }
        });
    });

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

});