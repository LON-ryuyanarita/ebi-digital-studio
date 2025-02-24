import $ from 'jquery';

export default class SeMap {
  constructor(params = {}) {
    this.$root = $('[data-ebi-semap]');
    this.$pointers = this.$root.find('[data-ebi-semap-pointer]');
    this.$nav = this.$root.find('[data-ebi-semap-thumb]');
  }

  init() {
    if (!this.$root.length) {
      return;
    }
    // this.$pointers.addClass('-current');

    this.$nav.on({
      'mouseenter.ebi.semap': (e) => {
        const $target = $(e.target).closest(this.$nav);
        const pointer = $target.attr('data-ebi-semap-thumb');
        this.$nav.addClass('-inactive');
        $target.removeClass('-inactive').addClass('-current');
        this.$pointers
          .addClass('-inactive')
          .filter(`[data-ebi-semap-pointer="${pointer}"]`)
          .removeClass('-inactive')
          .addClass('-current');
      },
      'mouseleave.ebi.semap': (e) => {
        this.$nav.removeClass('-inactive -current');
        this.$pointers.removeClass('-inactive -current');
      },
    });
    this.$pointers.on({
      'click.ebi.semap': (e) => {
        const $target = $(e.target).closest(this.$pointers);
        const thumb = $target.attr('data-ebi-semap-pointer');
        const $targetThumb = this.$nav.filter(
          `[data-ebi-semap-thumb="${thumb}"]`
        );
        $targetThumb.trigger('click.ebi.modal');
      },
      'mouseenter.ebi.semap': (e) => {
        const $target = $(e.target).closest(this.$pointers);
        const thumb = $target.attr('data-ebi-semap-pointer');
        this.$pointers.addClass('-inactive');
        $target.removeClass('-inactive').addClass('-current');
        this.$nav
          .addClass('-inactive')
          .filter(`[data-ebi-semap-thumb="${thumb}"]`)
          .removeClass('-inactive')
          .addClass('-current');
      },
      'mouseleave.ebi.semap': (e) => {
        this.$pointers.removeClass('-inactive -current');
        this.$nav.removeClass('-inactive -current');
      },
    });
  }
}
