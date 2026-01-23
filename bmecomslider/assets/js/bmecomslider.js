class BMECOMSlider {
    constructor(element) {
        this.slider = element;
        this.slides = this.slider.querySelectorAll('.bmecom-slide');
        this.wrapper = this.slider.parentElement;
        this.arrows = this.wrapper.querySelector('.bmecom-slider-arrows');
        this.dotsContainer = this.wrapper.querySelector('.bmecom-slider-dots');
        this.settings = this.slider.dataset;
        this.currentIndex = 0;
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.init();
    }

    init() {
        const widgetElement = this.slider.closest('.elementor-widget');
        if (widgetElement) {
            widgetElement.classList.remove('elementor-invisible');
        }

        this.wrapper.classList.add(`animation-${this.settings.animation}`);
        this.loadSlideImages(0);
        this.setupDots();
        this.setupEventListeners();

        // Initial slide setup
        if (this.settings.animation === 'slide') {
            this.slider.style.transform = 'translateX(0%)';
        }

        if (this.dots && this.dots.length > 0) {
            this.dots[0].classList.add('active');
        }

        if (this.settings.autoplay === 'yes') {
            this.startAutoplay();
        }
    }

    setupDots() {
        if (!this.dotsContainer) return;
        this.slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.classList.add('bmecom-slider-dot');
            dot.addEventListener('click', () => this.showSlide(index));
            this.dotsContainer.appendChild(dot);
        });
        this.dots = this.dotsContainer.querySelectorAll('.bmecom-slider-dot');
    }

    setupEventListeners() {
        if (this.arrows) {
            this.arrows.querySelector('.next').addEventListener('click', () => this.nextSlide());
            this.arrows.querySelector('.prev').addEventListener('click', () => this.prevSlide());
        }

        if (this.settings.pauseOnHover === 'yes') {
            this.slider.addEventListener('mouseenter', () => this.stopAutoplay());
            this.slider.addEventListener('mouseleave', () => this.startAutoplay());
        }

        this.wrapper.addEventListener('keydown', (e) => this.handleKeyDown(e));
        this.slider.addEventListener('touchstart', (e) => this.handleTouchStart(e));
        this.slider.addEventListener('touchmove', (e) => this.handleTouchMove(e));
        this.slider.addEventListener('touchend', () => this.handleTouchEnd());
    }

    handleKeyDown(e) {
        if (e.key === 'ArrowLeft') {
            this.prevSlide();
        } else if (e.key === 'ArrowRight') {
            this.nextSlide();
        }
    }

    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
    }

    handleTouchMove(e) {
        this.touchEndX = e.touches[0].clientX;
    }

    handleTouchEnd() {
        const diff = this.touchStartX - this.touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                this.nextSlide();
            } else {
                this.prevSlide();
            }
        }
    }

    showSlide(index) {
        const animation = this.settings.animation;
        const oldIndex = this.currentIndex;

        if (index === oldIndex) return;

        this.loadSlideImages(index);

        if (this.slides[oldIndex]) {
            this.slides[oldIndex].classList.remove('active');
        }
        this.slides[index].classList.add('active');

        if (animation === 'slide') {
            this.slider.style.transform = `translateX(-${index * 100}%)`;
        }

        this.currentIndex = index;

        if (this.dots) {
            this.dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }
    }

    loadSlideImages(index) {
        const slide = this.slides[index];
        if (!slide || slide.dataset.backgroundType !== 'image' || !slide.dataset.desktopImage) return;

        // The CSS media queries now handle responsive images, so we just need to ensure the desktop image is loaded.
        slide.style.backgroundImage = `url(${slide.dataset.desktopImage})`;
    }

    nextSlide() {
        let newIndex = this.currentIndex + 1;
        if (this.settings.loop === 'yes' && newIndex >= this.slides.length) {
            newIndex = 0;
        } else if (newIndex >= this.slides.length) {
            return;
        }
        this.showSlide(newIndex);
    }

    prevSlide() {
        let newIndex = this.currentIndex - 1;
        if (this.settings.loop === 'yes' && newIndex < 0) {
            newIndex = this.slides.length - 1;
        } else if (newIndex < 0) {
            return;
        }
        this.showSlide(newIndex);
    }

    startAutoplay() {
        this.autoplayInterval = setInterval(() => {
            this.nextSlide();
        }, parseInt(this.settings.slideTiming, 10));
    }

    stopAutoplay() {
        clearInterval(this.autoplayInterval);
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const BMECOMSliderHandler = ($scope) => {
        const sliderElement = $scope.find('.bmecom-slider')[0];
        if (sliderElement) {
            new BMECOMSlider(sliderElement);
        }
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/bmecom-slider.default', BMECOMSliderHandler);
});
