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
        this.wrapper.classList.add(`animation-${this.settings.animation}`);
        this.setupDots();
        this.setupEventListeners();

        // Initial slide setup
        if (this.settings.animation === 'slide') {
             this.slider.style.transform = 'translateX(0%)';
        } else {
            this.slides[0].classList.add('active');
        }
        if (this.dots) {
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

        if (animation === 'slide') {
            this.slider.style.transform = `translateX(-${index * 100}%)`;
        } else {
            // This logic is for fade/zoom
            if (this.slides[oldIndex]) {
                 this.slides[oldIndex].classList.remove('active');
            }
            this.slides[index].classList.add('active');
        }

        this.currentIndex = index;

        if (this.dots) {
            this.dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }
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

document.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll('.bmecom-slider');
    sliders.forEach(slider => {
        new BMECOMSlider(slider);
    });
});
