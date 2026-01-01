// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Scroll animations
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

document.querySelectorAll('.fade-in').forEach(el => {
    observer.observe(el);
});

// Header scroll effect and scroll to top button
let lastScrollY = window.scrollY;
const scrollToTopBtn = document.getElementById('scrollToTop');

window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > lastScrollY && window.scrollY > 100) {
        header.style.transform = 'translateY(-100%)';
    } else {
        header.style.transform = 'translateY(0)';
    }
    
    // Show/hide scroll to top button
    if (scrollToTopBtn) {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    }
    
    lastScrollY = window.scrollY;
});

if (scrollToTopBtn) {
    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Contact form enhancement
const contactForm = document.querySelector('.contact-form');

if (contactForm) {
    const submitBtn = contactForm.querySelector('.submit-btn');

    contactForm.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
        
        // Re-enable button after 3 seconds (in case of form submission issues)
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Send Message';
        }, 3000);
    });
}

// Mobile menu toggle
const mobileBtn = document.querySelector('.mobile-menu-btn');
const navMenu = document.querySelector('.nav-menu');

if (mobileBtn && navMenu) {
    mobileBtn.addEventListener('click', () => {
        mobileBtn.classList.toggle('active');
        navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    // Close mobile menu when a link is clicked
    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.getComputedStyle(mobileBtn).display !== 'none') {
                navMenu.style.display = 'none';
                mobileBtn.classList.remove('active');
            }
        });
    });
}

// Parallax effect for floating orbs
window.addEventListener('mousemove', (e) => {
    const orbs = document.querySelectorAll('.floating-orb');
    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;
    
    orbs.forEach((orb, index) => {
        const speed = (index + 1) * 0.5;
        orb.style.transform += ` translate(${x * speed}px, ${y * speed}px)`;
    });
});

// Dynamic gradient based on time of day
const updateGradient = () => {
    const hour = new Date().getHours();
    const body = document.body;
    
    if (hour >= 6 && hour < 12) {
        // Morning
        body.style.background = 'linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%)';
    } else if (hour >= 12 && hour < 18) {
        // Afternoon
        body.style.background = 'linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%)';
    } else {
        // Evening/Night
        body.style.background = 'linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%)';
    }
};

updateGradient();
setInterval(updateGradient, 60000); // Update every minute

/* --- Flow Dashboard Logic --- */
if (document.getElementById('dashboard')) {
    // Real data is now fetched via PHP. Simulation logic removed.

    // Interactive controls
    const controls = document.querySelector('.controls');
    if (controls) {
        controls.addEventListener('click', (e) => {
            if (e.target.classList.contains('control-button')) {
                e.target.style.background = 'linear-gradient(135deg, #5b86e5, #00d4ff)';
                e.target.textContent = 'Updating...';
                
                setTimeout(() => {
                    e.target.style.background = 'linear-gradient(135deg, #00d4ff, #5b86e5)';
                    e.target.textContent = e.target.textContent.replace('Updating...', 'Updated!');
                    
                    setTimeout(() => {
                        e.target.textContent = e.target.textContent.replace('Updated!', 'Update Location');
                    }, 1000);
                }, 1500);
            }
        });
    }

    // Enhanced dashboard interactivity
    document.querySelectorAll('.dashboard-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
        });
    });
}

/* --- Stats Counter Animation --- */
const statNumbers = document.querySelectorAll('.stat-number');
let hasAnimatedStats = false;

const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !hasAnimatedStats) {
            hasAnimatedStats = true;
            animateStats();
        }
    });
}, { threshold: 0.5 });

if (document.querySelector('.stats-section')) {
    statsObserver.observe(document.querySelector('.stats-section'));
}

function animateStats() {
    statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                stat.textContent = target + (stat.getAttribute('data-suffix') || '');
                clearInterval(timer);
            } else {
                stat.textContent = Math.floor(current) + (stat.getAttribute('data-suffix') || '');
            }
        }, 16);
    });
}

/* --- FAQ Accordion --- */
const faqQuestions = document.querySelectorAll('.faq-question');

faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
        const item = question.parentElement;
        
        // Optional: Close others
        // document.querySelectorAll('.faq-item').forEach(i => { if(i !== item) i.classList.remove('active'); });
        
        item.classList.toggle('active');
    });
});

/* --- Shop Logic --- */
const cart = [];

function addToCart(product) {
    cart.push(product);
    updateCartUI();
    console.log('Cart:', cart);
}

function updateCartUI() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        cartCount.textContent = cart.length;
        cartCount.classList.add('bump'); // Animation class (needs CSS)
        setTimeout(() => cartCount.classList.remove('bump'), 300);
    }
}

// Event delegation for product buttons
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
        const btn = e.target.classList.contains('add-to-cart-btn') ? e.target : e.target.closest('.add-to-cart-btn');
        const card = btn.closest('.product-card');
        
        if (card) {
            const product = {
                id: card.dataset.id,
                title: card.querySelector('.product-title').textContent,
                price: card.querySelector('.product-price').textContent
            };
            addToCart(product);
            
            // Visual feedback
            const originalText = btn.innerHTML;
            btn.innerHTML = '✓ Added';
            btn.style.background = 'linear-gradient(135deg, #00d4ff, #5b86e5)';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
            }, 1500);
        }
    }
});