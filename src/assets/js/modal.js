import $ from 'jquery';

export default class Modal {
  constructor(params = {}) {
    this.$modal = $('[data-ebi-semap-modal]');
    this.$opener = $('[data-ebi-modal-opener]');
    this.$closer = $('[data-ebi-modal-closer]');

    this.$currentModal = null;
  }

  init() {
    this.$opener.on('click.ebi.modal', (e) => {
      e.preventDefault();
      const $target = $(e.target).closest(this.$opener);
      const id = $target.attr('href') || $target.attr('data-href');
      const $modal = $(id);
      if ($modal.length) {
        $modal.addClass('-shown');
        this.$currentModal = $modal;
      }
    });

    this.$closer.on('click.ebi.modal', (e) => {
      if (this.$currentModal) {
        this.$currentModal.removeClass('-shown');
        this.$currentModal = null;
      }
    });
  }
}
