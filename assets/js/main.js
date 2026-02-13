/**
 * Delta Growth Theme Main JavaScript
 *
 * @package Delta_Growth
 * @since Delta Growth 1.0
 */

(function($) {
	'use strict';

	/**
	 * Initialize all theme functionality when DOM is ready
	 */
	$(document).ready(function() {

		// Mobile menu toggle (if needed in future)
		initMobileMenu();

		// Smooth scroll for anchor links
		initSmoothScroll();

		// Initialize testimonials slider
		initTestimonialsSlider();

		// Add any additional initialization here

	});

	/**
	 * Initialize mobile menu functionality
	 */
	function initMobileMenu() {
		// Placeholder for mobile menu functionality
		// Can be expanded based on future requirements
		console.log('Delta Growth theme loaded');
	}

	/**
	 * Initialize smooth scrolling for anchor links
	 */
	function initSmoothScroll() {
		$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
			// On-page links
			if (
				location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
				location.hostname === this.hostname
			) {
				// Figure out element to scroll to
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					
					$('html, body').animate({
						scrollTop: target.offset().top - 100
					}, 800, function() {
						// Callback after animation
						// Must change focus!
						var $target = $(target);
						$target.focus();
						if ($target.is(':focus')) { // Checking if the target was focused
							return false;
						} else {
							$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
							$target.focus(); // Set focus again
						}
					});
				}
			}
		});
	}

	/**
	 * Initialize testimonials slider
	 */
	function initTestimonialsSlider() {
		const slider = $('.testimonials-slider');
		if (!slider.length) return;

		const track = slider.find('.testimonials-track');
		const slides = slider.find('.testimonial-slide');
		const prevBtn = slider.find('.slider-prev');
		const nextBtn = slider.find('.slider-next');
		const dotsContainer = slider.find('.slider-dots');

		if (!track.length || slides.length === 0) return;

		let currentIndex = 0;
		const totalSlides = slides.length;

		// Create dots
		slides.each(function(index) {
			const dot = $('<button>')
				.addClass('slider-dot')
				.attr('aria-label', 'Go to testimonial ' + (index + 1))
				.on('click', function() {
					goToSlide(index);
				});

			if (index === 0) {
				dot.addClass('active');
			}

			dotsContainer.append(dot);
		});

		const dots = dotsContainer.find('.slider-dot');

		// Update slider position
		function updateSlider() {
			track.css('transform', 'translateX(-' + (currentIndex * 100) + '%)');

			// Update dots
			dots.removeClass('active').eq(currentIndex).addClass('active');

			// Update button states
			prevBtn.prop('disabled', currentIndex === 0);
			nextBtn.prop('disabled', currentIndex === totalSlides - 1);
		}

		// Go to specific slide
		function goToSlide(index) {
			currentIndex = index;
			updateSlider();
		}

		// Next slide
		function nextSlide() {
			if (currentIndex < totalSlides - 1) {
				currentIndex++;
				updateSlider();
			}
		}

		// Previous slide
		function prevSlide() {
			if (currentIndex > 0) {
				currentIndex--;
				updateSlider();
			}
		}

		// Event listeners
		nextBtn.on('click', nextSlide);
		prevBtn.on('click', prevSlide);

		// Keyboard navigation
		slider.on('keydown', function(e) {
			if (e.key === 'ArrowLeft') {
				prevSlide();
			} else if (e.key === 'ArrowRight') {
				nextSlide();
			}
		});

		// Auto-play
		let autoplayInterval;

		function startAutoplay() {
			autoplayInterval = setInterval(function() {
				if (currentIndex < totalSlides - 1) {
					nextSlide();
				} else {
					currentIndex = 0;
					updateSlider();
				}
			}, 5000); // Change slide every 5 seconds
		}

		function stopAutoplay() {
			clearInterval(autoplayInterval);
		}

		// Start autoplay
		startAutoplay();

		// Pause autoplay on hover
		slider.on('mouseenter', stopAutoplay);
		slider.on('mouseleave', startAutoplay);

		// Pause autoplay on focus
		slider.on('focusin', stopAutoplay);
		slider.on('focusout', startAutoplay);

		// Touch/swipe support
		let touchStartX = 0;
		let touchEndX = 0;

		track.on('touchstart', function(e) {
			touchStartX = e.originalEvent.changedTouches[0].screenX;
		});

		track.on('touchend', function(e) {
			touchEndX = e.originalEvent.changedTouches[0].screenX;
			handleSwipe();
		});

		function handleSwipe() {
			const swipeThreshold = 50;
			const diff = touchStartX - touchEndX;

			if (Math.abs(diff) > swipeThreshold) {
				if (diff > 0) {
					// Swipe left - next slide
					nextSlide();
				} else {
					// Swipe right - previous slide
					prevSlide();
				}
			}
		}

		// Initialize
		updateSlider();
	}

})(jQuery);

