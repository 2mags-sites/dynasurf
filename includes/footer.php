        <footer>
            <div class="container">
                <div class="footer-content">
                    <div class="footer-column">
                        <h4>Core Services</h4>
                        <ul>
                            <li><a href="/hydraulic-ram-repair">Hydraulic Ram Repair</a></li>
                            <li><a href="/cylinder-tube-honing">Cylinder Tube Honing</a></li>
                            <li><a href="/hydraulic-hose-manufacturing">Hydraulic Hose Manufacturing</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h4>Legal</h4>
                        <ul>
                            <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                            <li><a href="/privacy-policy">Privacy Policy</a></li>
                            <li><a href="/cookie-policy">Cookie Policy</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/blog/">News</a></li>
                            <li><a href="/contact">Contact</a></li>
                        </ul>
                    </div>

                    <div class="footer-column footer-contact">
                        <h4>Contact Info</h4>
                        <p>📞 01270 763032</p>
                        <p><a href="https://wa.me/<?php echo SITE_WHATSAPP_LINK; ?>" target="_blank" rel="noopener" style="color: inherit; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#25D366" style="vertical-align: middle; margin-right: 5px;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg><?php echo SITE_WHATSAPP; ?></a></p>
                        <p>📍 Millbuck Way, Sandbach</p>
                        <p>⏰ Mon-Thu: 7:15am-4:30pm</p>
                        <p>⏰ Fri: 7:15am-12noon</p>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p>&copy; <?php echo date('Y'); ?> Dynasurf (UK) Ltd. All rights reserved. | Precision Engineering Since 1971</p>
                </div>
            </div>
        </footer>
    <!-- Contact Form Modal (for AJAX submissions) -->
    <div id="contact-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Quick Contact</h2>
            <form id="quick-contact-form">
                <div class="form-group">
                    <label for="contact-name">Name *</label>
                    <input type="text" id="contact-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="contact-email">Email *</label>
                    <input type="email" id="contact-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact-phone">Phone</label>
                    <input type="tel" id="contact-phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="contact-message">Message *</label>
                    <textarea id="contact-message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
            <div id="contact-response" style="display: none;"></div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="assets/js/dyna.js"></script>
    <script>

        // Handle dropdown toggle on desktop
        document.querySelectorAll('.dropdown > a[href="#"]').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault(); // Always prevent default for dropdown toggles
            });
        });

        // Smooth Scrolling for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');

                // Skip if it's just "#" or empty, or if it's a dropdown toggle
                if (href === '#' || href === '' || href.length <= 1 ||
                    this.closest('.dropdown') && this.nextElementSibling?.classList.contains('dropdown-menu')) {
                    return;
                }

                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // FAQ Accordion Toggle
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.closest('.faq-item');
                const answer = faqItem.querySelector('.faq-answer');
                const isActive = faqItem.classList.contains('active');

                // Close all other FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                    item.querySelector('.faq-answer').style.maxHeight = null;
                });

                // Toggle current item
                if (!isActive) {
                    faqItem.classList.add('active');
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                }
            });
        });

        // Contact Form AJAX Submission
        const contactForm = document.getElementById('quick-contact-form');
        const contactModal = document.getElementById('contact-modal');
        const contactResponse = document.getElementById('contact-response');

        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;

                // Show loading state
                submitButton.textContent = 'Sending...';
                submitButton.disabled = true;
                contactResponse.style.display = 'none';

                fetch('/includes/contact-handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    contactResponse.style.display = 'block';
                    if (data.success) {
                        contactResponse.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                        contactForm.reset();
                        setTimeout(() => {
                            if (contactModal) {
                                contactModal.style.display = 'none';
                            }
                        }, 2000);
                    } else {
                        contactResponse.innerHTML = '<div class="alert alert-error">' + data.message + '</div>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    contactResponse.style.display = 'block';
                    contactResponse.innerHTML = '<div class="alert alert-error">An error occurred. Please try again.</div>';
                })
                .finally(() => {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                });
            });
        }

        // Contact Modal Controls
        const closeModal = document.querySelector('.modal .close');
        if (closeModal) {
            closeModal.addEventListener('click', function() {
                contactModal.style.display = 'none';
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            if (e.target === contactModal) {
                contactModal.style.display = 'none';
            }
        });

        // Quick contact trigger (can be used by other elements)
        function openQuickContact() {
            if (contactModal) {
                contactModal.style.display = 'block';
            }
        }

        // Add click handlers for quick contact buttons
        document.querySelectorAll('[data-action="quick-contact"]').forEach(button => {
            button.addEventListener('click', openQuickContact);
        });

        // Form Validation Enhancement
        function validateForm(form) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('error');
                    isValid = false;
                } else {
                    field.classList.remove('error');
                }
            });

            // Email validation
            const emailFields = form.querySelectorAll('input[type="email"]');
            emailFields.forEach(field => {
                if (field.value && !isValidEmail(field.value)) {
                    field.classList.add('error');
                    isValid = false;
                }
            });

            return isValid;
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Add real-time validation to form fields
        document.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('error');
                } else {
                    this.classList.remove('error');
                }

                if (this.type === 'email' && this.value && !isValidEmail(this.value)) {
                    this.classList.add('error');
                } else if (this.type === 'email') {
                    this.classList.remove('error');
                }
            });

            field.addEventListener('input', function() {
                if (this.classList.contains('error') && this.value.trim()) {
                    this.classList.remove('error');
                }
            });
        });

        // Parallax Effect for Hero and Service Hero Gears Background
        const heroSections = document.querySelectorAll('.hero, .service-hero');
        if (heroSections.length > 0) {
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const rate = scrolled * 0.5; // Parallax speed

                // Apply transform to hero sections only
                heroSections.forEach(section => {
                    section.style.setProperty('--parallax-offset', rate + 'px');
                });
            });
        }

        // Back to Top Button (if exists)
        const backToTopButton = document.querySelector('.back-to-top');
        if (backToTopButton) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            });

            backToTopButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Print functionality
        function printPage() {
            window.print();
        }

        // Page load analytics (if needed)
        document.addEventListener('DOMContentLoaded', function() {
            // Track page load time
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log('Page load time:', loadTime + 'ms');

            // Initialize tooltips if they exist
            const tooltips = document.querySelectorAll('[data-tooltip]');
            tooltips.forEach(tooltip => {
                tooltip.addEventListener('mouseenter', function() {
                    const tooltipText = this.getAttribute('data-tooltip');
                    const tooltipElement = document.createElement('div');
                    tooltipElement.className = 'tooltip';
                    tooltipElement.textContent = tooltipText;
                    document.body.appendChild(tooltipElement);

                    const rect = this.getBoundingClientRect();
                    tooltipElement.style.left = rect.left + (rect.width / 2) - (tooltipElement.offsetWidth / 2) + 'px';
                    tooltipElement.style.top = rect.top - tooltipElement.offsetHeight - 10 + 'px';
                });

                tooltip.addEventListener('mouseleave', function() {
                    const tooltipElement = document.querySelector('.tooltip');
                    if (tooltipElement) {
                        tooltipElement.remove();
                    }
                });
            });
        });
    </script>

    <?php if (defined('IS_ADMIN') && IS_ADMIN): ?>
    <!-- Admin JavaScript -->
    <script src="/includes/admin-functions.js"></script>
    <script>
        // Additional admin-specific JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin mode active');
            // Removed duplicate admin UI elements - using renderAdminBar() instead
        });

        function clearCache() {
            if (confirm('Clear application cache?')) {
                fetch('/includes/admin-save.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=clear_cache'
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message || 'Cache cleared');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error clearing cache');
                });
            }
        }

        function toggleEditMode() {
            document.body.classList.toggle('admin-edit-mode');
            const isEditMode = document.body.classList.contains('admin-edit-mode');

            if (isEditMode) {
                // Add edit indicators to editable elements
                document.querySelectorAll('[data-editable]').forEach(element => {
                    element.style.outline = '2px dashed #007cba';
                    element.style.cursor = 'pointer';
                    element.title = 'Click to edit';
                });
            } else {
                // Remove edit indicators
                document.querySelectorAll('[data-editable]').forEach(element => {
                    element.style.outline = '';
                    element.style.cursor = '';
                    element.title = '';
                });
            }
        }

        // Download all JSON content files as ZIP
        function downloadContent() {
            const link = document.createElement('a');
            link.href = 'download-content.php';
            link.download = 'content-backup-' + new Date().toISOString().slice(0, 10) + '.zip';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            console.log('Initiating content download...');
        }
    </script>
    <?php endif; ?>

    <!-- Cookie Consent Banner -->
    <div id="cookie-banner" class="cookie-banner" style="display: none;">
        <div class="cookie-content">
            <p>We use cookies to improve your experience on our site. By continuing to use our website, you accept our use of cookies. <a href="/cookie-policy">Learn more</a></p>
            <div class="cookie-buttons">
                <button onclick="acceptCookies()" class="btn btn-primary">Accept</button>
                <button onclick="declineCookies()" class="btn btn-outline">Decline</button>
            </div>
        </div>
    </div>

    <style>
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--graphite);
            color: var(--chrome);
            padding: 1.5rem;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            border-top: 2px solid var(--laser-green);
        }

        .cookie-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .cookie-content p {
            margin: 0;
            flex: 1;
        }

        .cookie-content a {
            color: var(--laser-green);
            text-decoration: underline;
        }

        .cookie-buttons {
            display: flex;
            gap: 1rem;
        }

        .cookie-buttons .btn {
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .cookie-content {
                flex-direction: column;
                text-align: center;
            }

            .cookie-buttons {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script>
        // Check if user has already accepted/declined cookies
        function checkCookieConsent() {
            const consent = localStorage.getItem('cookieConsent');
            if (!consent) {
                document.getElementById('cookie-banner').style.display = 'block';
            }
        }

        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'accepted');
            document.getElementById('cookie-banner').style.display = 'none';
        }

        function declineCookies() {
            localStorage.setItem('cookieConsent', 'declined');
            document.getElementById('cookie-banner').style.display = 'none';
        }

        // Show banner on page load if needed
        window.addEventListener('load', checkCookieConsent);
    </script>

</body>
</html>