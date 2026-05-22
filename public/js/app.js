// V-Store — Main JavaScript

document.addEventListener('DOMContentLoaded', () => {

    // ===== HAMBURGER MENU =====
    const hamburger = document.getElementById('hamburger');
    const navLinks  = document.querySelector('.nav-links');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('mobile-open');
            Object.assign(navLinks.style, isOpen ? {
                display: 'flex', flexDirection: 'column',
                position: 'absolute', top: '70px', left: '0', right: '0',
                background: 'rgba(10,10,10,0.98)', padding: '1rem 2rem', zIndex: '999'
            } : { display: '' });
        });
    }

    // ===== NAVBAR SCROLL =====
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.style.background = window.scrollY > 50
                ? 'rgba(10,10,10,1)'
                : 'rgba(10,10,10,0.95)';
        });
    }

    // ===== SEARCH OVERLAY =====
    const overlay     = document.getElementById('searchOverlay');
    const btnOpen     = document.getElementById('btnSearchOpen');
    const btnClose    = document.getElementById('searchClose');
    const searchInput = document.getElementById('searchInput');

    if (overlay && btnOpen) {
        btnOpen.addEventListener('click', () => {
            overlay.classList.add('open');
            setTimeout(() => searchInput && searchInput.focus(), 100);
        });
        btnClose && btnClose.addEventListener('click', () => overlay.classList.remove('open'));
        overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.classList.remove('open'); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') overlay.classList.remove('open'); });
    }

    // ===== SIZE SELECTOR — sync ke hidden input di form =====
    document.querySelectorAll('.size-options').forEach(group => {
        const productId = group.closest('.product-card')?.querySelector('[data-product]')?.dataset.product
                       || group.closest('[data-product-id]')?.dataset.productId;

        group.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', () => {
                // Cari form add-to-cart di kartu produk yang sama
                const card = radio.closest('.product-card');
                if (card) {
                    const sizeInput = card.querySelector('.selected-size');
                    if (sizeInput) sizeInput.value = radio.value;
                }
            });
        });
    });

    // ===== TOAST AUTO-DISMISS =====
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.style.transition = 'opacity 0.5s ease';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // ===== SCROLL REVEAL =====
    const revealEls = document.querySelectorAll('.product-card, .cat-card, .testi-card');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity    = '1';
                        entry.target.style.transform  = 'translateY(0)';
                    }, i * 60);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        revealEls.forEach(el => {
            el.style.opacity    = '0';
            el.style.transform  = 'translateY(24px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(el);
        });
    }

    // ===== ADD-TO-CART BUTTON FEEDBACK =====
    // Jalankan feedback visual saat form di-submit (sebelum navigasi)
    document.querySelectorAll('.add-cart-form, form:has(.btn-add-cart), form:has(.btn-quick-add)').forEach(form => {
        form.addEventListener('submit', function () {
            const btn = this.querySelector('.btn-add-cart, .btn-quick-add');
            if (!btn) return;
            const orig = btn.textContent;
            btn.textContent = '✓ Ditambahkan!';
            btn.style.cssText += '; background:var(--green) !important; color:#fff !important; border-color:var(--green) !important;';
        });
    });

    // ===== CART PAGE: konfirmasi hapus semua =====
    const clearForm = document.querySelector('form[action*="keranjang"]:has(button.btn-clear-cart)');
    // Sudah pakai onsubmit di blade, ini sebagai fallback
});