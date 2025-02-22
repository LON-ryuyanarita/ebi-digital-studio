import $ from 'jquery';

export default class shareUrl {
  constructor(params = {}) {
    this.BASE_URL = 'https://xxx';

    this.$shareBtns = $('[data-ebi-share]');
    this.links = {
      x: 'https://x.com/intent/tweet?text={{TEXT}}&url={{URL}}&hashtags={{HASHTAGS}}',
      facebook: 'http://www.facebook.com/share.php?u={{URL}}',
      line: 'http://line.me/R/msg/text/?{{TEXT}} {{URL}}',
    };
  }

  init() {
    if (!this.$shareBtns.length) {
      return;
    }

    this.$shareBtns.each((index, e) => {
      const $target = $(e);
      const type = $target.attr('data-ebi-share');
      const url = $target.attr('data-ebi-share-url') || this.BASE_URL;
      const text = $target.attr('data-ebi-share-text') || '';
      const hashtags = $target.attr('data-ebi-share-hashtags') || '';

      switch (type) {
        case 'x':
          $target.attr(
            'href',
            this.links.x
              .replace(/{{URL}}/, encodeURIComponent(url))
              .replace(/{{TEXT}}/, encodeURIComponent(text))
              .replace(/{{HASHTAGS}}/, encodeURIComponent(hashtags))
          );
          break;
        case 'facebook':
          $target.attr(
            'href',
            this.links.facebook.replace(/{{URL}}/, encodeURIComponent(url))
          );
          break;
        case 'line':
          $target.attr(
            'href',
            this.links.line
              .replace(/{{URL}}/, encodeURIComponent(url))
              .replace(/{{TEXT}}/, encodeURIComponent(text))
          );
          break;
        default:
          break;
      }
    });
  }
}
