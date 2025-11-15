// main.js - Custom JavaScript for K.L.A.S. Website

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile menu close on link click
    const mobileMenuLinks = document.querySelectorAll('.md\\:hidden a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Close mobile menu if Alpine.js is available
            if (window.Alpine) {
                // The menu state is managed by Alpine.js
                // This will be handled by Alpine's x-show directive
            }
        });
    });
    
    // Form validation enhancement
    const contactForm = document.querySelector('form[method="POST"]');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const requiredFields = contactForm.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            // Email validation
            const emailField = contactForm.querySelector('input[type="email"]');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    isValid = false;
                    emailField.classList.add('border-red-500');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Bitte füllen Sie alle Pflichtfelder aus. / Please fill in all required fields. / Lütfen tüm zorunlu alanları doldurun.');
                return false;
            }
        });
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Add loading state to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.classList.add('loading');
                submitButton.disabled = true;
                submitButton.textContent = submitButton.textContent + '...';
            }
        });
    });
    
    // Console message
    console.log('%cK.L.A.S. Dienstleistungs GmbH', 'color: #1e3a8a; font-size: 20px; font-weight: bold;');
    console.log('%cWebsite loaded successfully', 'color: #f97316; font-size: 12px;');
    
});
