import 'slick-carousel';
import $ from 'jquery';

export default class Carousel {
  constructor(params = {}) {}

  init($root, nav) {
    this.$root = $root || $('body');
    this.$carousel = this.$root.find('[data-ebi-carousel]');
    if (!this.$carousel.length) {
      return;
    }

    this.$carousel.each((_, e) => {
      const $this = $(e);
      const $wrapper = $this.closest('[data-ebi-carousel-wrapper]');
      const $btns = $wrapper.find('[data-ebi-carousel-btns]');
      const $indicator = $wrapper.find('[data-ebi-carousel-indicator]');
      const $total = $wrapper.find('[data-ebi-carousel-total]');
      const $slide = $this.find('.latest__item');

      $indicator.text(1);
      $total.text($slide.length);

      let options = {
        variableWidth: true,
        infinite: false,
        arrows: true,
        appendArrows: $btns,
        prevArrow: '<button class="-prev" type="button"><i /></button>',
        nextArrow: '<button class="-next" type="button"><i /></button>',
        dots: false,
      };
      $this.on('beforeChange', (event, slick, currentSlide, nextSlide) => {
        $indicator.text(nextSlide + 1);
      });
      $this.slick(options);
    });
  }
}
