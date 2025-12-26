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
    if (window.scrollY > 300) {
        scrollToTopBtn.classList.add('visible');
    } else {
        scrollToTopBtn.classList.remove('visible');
    }
    
    lastScrollY = window.scrollY;
});

scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Contact form enhancement
const contactForm = document.querySelector('.contact-form');
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

// Mobile menu toggle
const mobileBtn = document.querySelector('.mobile-menu-btn');
const navMenu = document.querySelector('.nav-menu');

mobileBtn.addEventListener('click', () => {
    navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
});

// Close mobile menu when a link is clicked
navMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.getComputedStyle(mobileBtn).display !== 'none') {
            navMenu.style.display = 'none';
        }
    });
});

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
    // Simulate live data updates
    function updateWeatherData() {
        const temp = document.getElementById('temp');
        const humidity = document.getElementById('humidity');
        const wind = document.getElementById('wind');
        const pressure = document.getElementById('pressure');
        
        if (!temp) return;

        // Simulate small fluctuations in data
        const currentTemp = parseInt(temp.textContent);
        const newTemp = currentTemp + (Math.random() - 0.5) * 2;
        temp.textContent = Math.round(newTemp) + '°C';
        
        const currentHumidity = parseInt(humidity.textContent);
        const newHumidity = Math.max(0, Math.min(100, currentHumidity + (Math.random() - 0.5) * 5));
        humidity.textContent = Math.round(newHumidity) + '%';
        
        // Add visual feedback for data updates
        [temp, humidity, wind, pressure].forEach(el => {
            if(el) {
                el.style.color = '#5b86e5';
                setTimeout(() => {
                    el.style.color = '#00d4ff';
                }, 300);
            }
        });
    }

    // Update data every 30 seconds for demo
    setInterval(updateWeatherData, 30000);

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