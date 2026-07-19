// =====================================================
// Desa Pelang Lor — Main JavaScript
// =====================================================

document.addEventListener('DOMContentLoaded', function () {

    // ---- Navbar: scroll effect ----
    const navbar = document.getElementById('navbar');
    if (navbar) {
        const onScroll = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // ---- Navbar: mobile toggle ----
    const navToggle = document.getElementById('navToggle');
    const navMenu   = document.getElementById('navMenu');

    function closeNavMenu() {
        if (navMenu) navMenu.classList.remove('open');
        if (navToggle) navToggle.classList.remove('open');
        // Never lock body scroll — menu is static overlay
    }

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const open = navMenu.classList.toggle('open');
            navToggle.classList.toggle('open', open);
        });

        // Auto-close when user scrolls the page
        window.addEventListener('scroll', () => {
            if (navMenu.classList.contains('open')) closeNavMenu();
        }, { passive: true });

        // Close when clicking outside the navbar area
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !navToggle.contains(e.target)) {
                closeNavMenu();
            }
        });

        // Close on link click
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeNavMenu);
        });
    }

    // ---- Profil Desa: Tab switching (supports both .profil__tab-btn and .p-tab) ----
    const tabBtns   = document.querySelectorAll('.profil__tab-btn, .p-tab');
    const tabPanels = document.querySelectorAll('.profil__tab-panel, .p-panel');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanels.forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            const panel = document.getElementById('tab-' + target);
            if (panel) panel.classList.add('active');
        });
    });


    // ---- Scroll Reveal ----
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach(el => observer.observe(el));
    }

    // ---- Stats counter animation ----
    const statsValues = document.querySelectorAll('.stats__value');
    if (statsValues.length) {
        const counterObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    animateCounter(e.target);
                    counterObs.unobserve(e.target);
                }
            });
        }, { threshold: 0.5 });
        statsValues.forEach(el => counterObs.observe(el));
    }

    function animateCounter(el) {
        const text  = el.textContent.trim();
        const numMatch = text.match(/[\d,]+/);
        if (!numMatch) return;
        const raw   = numMatch[0].replace(',', '');
        if (isNaN(raw)) return;
        const end   = parseInt(raw);
        const dur   = 1200;
        const start = performance.now();
        const suffix = text.replace(numMatch[0], '');
        const prefix = text.indexOf(numMatch[0]) > 0 ? text.substring(0, text.indexOf(numMatch[0])) : '';

        const tick = (now) => {
            const prog = Math.min((now - start) / dur, 1);
            const ease = 1 - Math.pow(1 - prog, 3);
            const val  = Math.floor(ease * end);
            el.textContent = prefix + val.toLocaleString('id-ID') + suffix;
            if (prog < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    }

    // ---- Smooth scroll for anchor links ----
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = parseInt(getComputedStyle(document.documentElement)
                    .getPropertyValue('--nav-h')) || 72;
                window.scrollTo({
                    top: target.getBoundingClientRect().top + window.scrollY - offset - 16,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ---- Flash message auto-hide ----
    document.querySelectorAll('.flash').forEach(flash => {
        setTimeout(() => {
            flash.style.transition = 'opacity .5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 4000);
    });

    // ---- Add reveal class to sections ----
    document.querySelectorAll(
        '.stats__card, .layanan__card, .berita__card, .struktur-card, .info-step'
    ).forEach((el, i) => {
        el.classList.add('reveal');
        el.style.transitionDelay = (i * 60) + 'ms';
    });

    // ---- Admin: mobile sidebar toggle ----
    const adminSidebarToggle  = document.getElementById('adminSidebarToggle');
    const adminSidebarHamburger = document.getElementById('adminSidebarHamburger');
    const adminSidebar        = document.querySelector('.admin-sidebar');
    const adminOverlay        = document.getElementById('adminSidebarOverlay');

    function toggleAdminSidebar() {
        const isOpen = adminSidebar && adminSidebar.classList.toggle('open');
        if (adminSidebarHamburger) adminSidebarHamburger.classList.toggle('open', isOpen);
        if (adminOverlay) adminOverlay.classList.toggle('active', isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    }

    if (adminSidebarToggle) {
        adminSidebarToggle.addEventListener('click', toggleAdminSidebar);
    }

    if (adminOverlay) {
        adminOverlay.addEventListener('click', () => {
            if (adminSidebar) adminSidebar.classList.remove('open');
            if (adminSidebarHamburger) adminSidebarHamburger.classList.remove('open');
            adminOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Close admin sidebar on link click (mobile)
    if (adminSidebar) {
        adminSidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    adminSidebar.classList.remove('open');
                    if (adminSidebarHamburger) adminSidebarHamburger.classList.remove('open');
                    if (adminOverlay) adminOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    }

});
