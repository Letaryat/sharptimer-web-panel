import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';

const swiper = new Swiper('.swiper', {
  direction: 'horizontal',
  loop: true,
  slidesPerView: 2,
  spaceBetween: 10,
  pagination: {
    el: '.swiper-pagination',
  },
  breakpoints: {
    320: {
        slidesPerView: 1,

    },
    480: {
        slidesPerView: 1,

    },
    1024: {
        slidesPerView: 2,

    }
}
});
