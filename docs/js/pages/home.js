/**
 * Home Page JavaScript
 * Juarez Proveeduria Industrial
 */

// ========================================
// PARALLAX EFFECT FOR EXPERTISE SECTION
// ========================================
(function() {
    const expertiseSection = document.querySelector('.expertise-section');

    if (!expertiseSection) return;

    const parallaxPattern = () => {
        const scrolled = window.pageYOffset;
        const sectionTop = expertiseSection.offsetTop;
        const sectionHeight = expertiseSection.offsetHeight;
        const windowHeight = window.innerHeight;

        // Check if section is in viewport
        if (scrolled + windowHeight > sectionTop && scrolled < sectionTop + sectionHeight) {
            // Calculate parallax offset (slower movement - 0.5 = half speed)
            const parallaxSpeed = 0.5;
            const yPos = (scrolled - sectionTop) * parallaxSpeed;

            // Apply transform to the ::before pseudo-element via CSS variable
            expertiseSection.style.setProperty('--parallax-offset', `${yPos}px`);
        }
    };

    // Listen to scroll with throttling for performance
    let parallaxTicking = false;
    window.addEventListener('scroll', () => {
        if (!parallaxTicking) {
            window.requestAnimationFrame(() => {
                parallaxPattern();
                parallaxTicking = false;
            });
            parallaxTicking = true;
        }
    });

    // Initialize on load
    parallaxPattern();
})();

// ========================================
// CAROUSEL FUNCTIONALITY
// ========================================
(function() {
    const track = document.getElementById('carouselTrack');
    const slides = document.querySelectorAll('.carousel-slide');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicatorsContainer = document.getElementById('carouselIndicators');

    if (!track || !slides.length) return;

    let currentIndex = 0;
    let autoplayInterval;
    const totalSlides = slides.length;

    // Determine slides visible based on screen size
    function getSlidesVisible() {
        if (window.innerWidth <= 480) return 1;
        if (window.innerWidth <= 768) return 2;
        if (window.innerWidth <= 992) return 3;
        return 4;
    }

    // Create indicators
    function createIndicators() {
        indicatorsContainer.innerHTML = '';
        const slidesVisible = getSlidesVisible();
        const totalIndicators = Math.ceil(totalSlides / slidesVisible);

        for (let i = 0; i < totalIndicators; i++) {
            const indicator = document.createElement('div');
            indicator.className = 'carousel-indicator';
            if (i === 0) indicator.classList.add('active');
            indicator.addEventListener('click', () => goToSlide(i * slidesVisible));
            indicatorsContainer.appendChild(indicator);
        }
    }

    // Update carousel position
    function updateCarousel() {
        const slidesVisible = getSlidesVisible();
        const slideWidth = 100 / slidesVisible;
        track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

        // Update indicators
        const indicators = indicatorsContainer.querySelectorAll('.carousel-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.remove('active');
            if (index === Math.floor(currentIndex / slidesVisible)) {
                indicator.classList.add('active');
            }
        });
    }

    // Go to specific slide
    function goToSlide(index) {
        const slidesVisible = getSlidesVisible();
        const maxIndex = totalSlides - slidesVisible;
        currentIndex = Math.max(0, Math.min(index, maxIndex));
        updateCarousel();
        resetAutoplay();
    }

    // Next slide
    function nextSlide() {
        const slidesVisible = getSlidesVisible();
        const maxIndex = totalSlides - slidesVisible;
        currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
        updateCarousel();
    }

    // Previous slide
    function prevSlide() {
        const slidesVisible = getSlidesVisible();
        const maxIndex = totalSlides - slidesVisible;
        currentIndex = currentIndex <= 0 ? maxIndex : currentIndex - 1;
        updateCarousel();
    }

    // Autoplay
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 4000);
    }

    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    function resetAutoplay() {
        stopAutoplay();
        startAutoplay();
    }

    // Event listeners
    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetAutoplay();
    });

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoplay();
    });

    // Pause on hover
    track.addEventListener('mouseenter', stopAutoplay);
    track.addEventListener('mouseleave', startAutoplay);

    // Handle resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            createIndicators();
            goToSlide(0);
        }, 250);
    });

    // Touch support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    track.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoplay();
    });

    track.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAutoplay();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchStartX - touchEndX > swipeThreshold) {
            nextSlide();
        } else if (touchEndX - touchStartX > swipeThreshold) {
            prevSlide();
        }
    }

    // Initialize
    createIndicators();
    updateCarousel();
    startAutoplay();
})();

// ========================================
// CONTACT FORM SUCCESS MESSAGE
// ========================================
(function() {
    // Check if redirected back with success parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'true') {
        // Show success message
        const message = document.querySelector('[data-lang="en"]')
            ? 'Thank you for your interest! We will contact you shortly.'
            : '¡Gracias por su interés! Nos pondremos en contacto con usted en breve.';

        alert(message);

        // Clean up URL
        window.history.replaceState({}, document.title, window.location.pathname + '#contact');
    }
})();
