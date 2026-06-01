/*--- SWIPER ---*/

import Swiper from 'swiper';
import 'swiper/css';
import { Navigation, Pagination, Autoplay, FreeMode } from 'swiper/modules';

Swiper.use([Navigation, Pagination, Autoplay, FreeMode]);

const swiperOptionsAnchorsSlider = {
	loop: false,
	slidesPerView: 'auto',
	spaceBetween: 32,
	freeMode: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
};

const swiperReviews = {
	loop: false,
	slidesPerView: 'auto',
	spaceBetween: 0,
	freeMode: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
};

document.addEventListener('DOMContentLoaded', () => {
	const mySwiperContainer = document.querySelector('.mySwiper');
	if (mySwiperContainer) {
		new Swiper(mySwiperContainer, swiperOptionsAnchorsSlider);
	}

	const slidersContainer = document.querySelector('.sliders');
	if (slidersContainer) {
		new Swiper(slidersContainer, swiperReviews);
	}
});

/*--- GENERYCZNE SWIPERY ---*/
document.addEventListener('DOMContentLoaded', () => {
	const swipers = document.querySelectorAll('.swiper');

	if (swipers.length > 0) {
		swipers.forEach((container) => {
			// logos-swiper ma osobną konfigurację marquee poniżej
			if (container.classList.contains('logos-swiper')) return;

			new Swiper(container, {
				slidesPerView: 1,
				spaceBetween: 30,
				loop: true,
				pagination: {
					el: container.querySelector('.swiper-pagination'),
					clickable: true,
				},
				navigation: {
					nextEl: container.querySelector('.swiper-button-next'),
					prevEl: container.querySelector('.swiper-button-prev'),
				},
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {
	const swipers = document.querySelectorAll('.usage-swiper');

	if (swipers.length > 0) {
		swipers.forEach((container) => {
			new Swiper(container, {
				slidesPerView: 3,
				spaceBetween: 30,
				loop: true,
				allowTouchMove: false,
				speed: 1000,
				autoplay: {
					delay: 1000,
					disableOnInteraction: false,
				},
				pagination: {
					el: container.querySelector('.swiper-pagination'),
					clickable: true,
				},
				navigation: {
					nextEl: container.querySelector('.swiper-button-next'),
					prevEl: container.querySelector('.swiper-button-prev'),
				},
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {
	const swipers = document.querySelectorAll('.reviews-swiper');

	if (swipers.length > 0) {
		swipers.forEach((container) => {
			new Swiper(container, {
				slidesPerView: 1,
				spaceBetween: 30,
				loop: true,
				pagination: {
					el: container.querySelector('.swiper-pagination'),
					clickable: true,
				},
				navigation: {
					nextEl: container.querySelector('.swiper-button-next'),
					prevEl: container.querySelector('.swiper-button-prev'),
				},
			});
		});
	}
});

document.addEventListener('DOMContentLoaded', () => {
	const swipers = document.querySelectorAll('.offer-swiper');

	if (swipers.length > 0) {
		swipers.forEach((container) => {
			const swiper = new Swiper(container, {
				slidesPerView: 3,
				spaceBetween: 32,
				pagination: {
					el: container.querySelector('.swiper-pagination'),
					clickable: true,
				},
				navigation: {
					nextEl: container.querySelector('.swiper-button-next'),
					prevEl: container.querySelector('.swiper-button-prev'),
				},
				breakpoints: {
					0: { slidesPerView: 1.1, spaceBetween: 20 },
					768: { slidesPerView: 2.2, spaceBetween: 30 },
					1024: { slidesPerView: 3.2, spaceBetween: 32 },
				},
				on: {
					init: function () {
						updateFirstVisibleSlide(this, container);
					},
					slideChange: function () {
						updateFirstVisibleSlide(this, container);
					},
				},
			});

			function updateFirstVisibleSlide(swiperInstance, swiperContainer) {
				const allSlides = swiperContainer.querySelectorAll('.swiper-slide');
				allSlides.forEach((slide) => {
					slide.classList.remove('first-visible-slide');
				});

				if (swiperInstance.slides[swiperInstance.activeIndex]) {
					swiperInstance.slides[swiperInstance.activeIndex].classList.add('first-visible-slide');
				}
			}
		});
	}
});

/*--- LOGOS MARQUEE ---*/
window.addEventListener('load', () => {
	const swipers = document.querySelectorAll('.logos-swiper');
	if (!swipers.length) return;

	swipers.forEach((container) => {
		if (container.swiper) {
			container.swiper.destroy(true, true);
		}

		new Swiper(container, {
			slidesPerView: 'auto',
			spaceBetween: 24,
			loop: true,
			loopedSlides: container.querySelectorAll('.swiper-slide').length,
			loopAdditionalSlides: container.querySelectorAll('.swiper-slide').length,
			allowTouchMove: false,
			freeMode: true,
			freeModeMomentum: false,
			speed: 7000,
			autoplay: {
				delay: 1,
				disableOnInteraction: false,
				pauseOnMouseEnter: false,
				waitForTransition: false,
			},
			observer: true,
			observeParents: true,
			observeSlideChildren: true,
		});
	});
});