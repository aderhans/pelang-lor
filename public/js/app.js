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
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            const open = navMenu.classList.toggle('open');
            navToggle.classList.toggle('open', open);
            document.body.style.overflow = open ? 'hidden' : '';
        });
        // Close on link click
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('open');
                navToggle.classList.remove('open');
                document.body.style.overflow = '';
            });
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

});
