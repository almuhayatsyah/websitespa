import './bootstrap';

// ──────────────────────────────────────────────
// Navbar: scroll effect
// ──────────────────────────────────────────────
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// ──────────────────────────────────────────────
// Mobile Menu Toggle
// ──────────────────────────────────────────────
const menuBtn = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        menuBtn.setAttribute('aria-expanded', String(!isOpen));
    });
}

// ──────────────────────────────────────────────
// FAQ Accordion
// ──────────────────────────────────────────────
document.querySelectorAll('.faq-trigger').forEach(trigger => {
    trigger.addEventListener('click', () => {
        const item = trigger.closest('.faq-item');
        const content = item.querySelector('.faq-body');
        const icon = trigger.querySelector('.faq-icon');
        const isOpen = item.classList.contains('open');

        // Close all others
        document.querySelectorAll('.faq-item.open').forEach(openItem => {
            openItem.classList.remove('open');
            openItem.querySelector('.faq-body').style.maxHeight = '0';
            openItem.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
        });

        // Toggle current
        if (!isOpen) {
            item.classList.add('open');
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.style.transform = 'rotate(45deg)';
        }
    });
});

// ──────────────────────────────────────────────
// Intersection Observer: animate on scroll
// ──────────────────────────────────────────────
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
