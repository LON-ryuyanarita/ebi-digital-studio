import $ from 'jquery';

export default class Header {
  constructor(params = {}) {
    this.isShown = false;
    this.$root = $('[data-ebi-header]');
    this.$nav = $('[data-ebi-nav]');
    this.$toggle = $('[data-ebi-nav-toggle]');
    this.$opener = $('[data-ebi-nav-opener]');
    this.$closer = $('[data-ebi-nav-closer]');

    this.$newsWrapper = $('[data-ebi-header-news-wrapper]');
    this.$newsList = this.$newsWrapper.find('[data-ebi-header-news-list]');
    this.$newsItem = this.$newsWrapper.find('[data-ebi-header-news-item]');
  }

  init() {
    if (!this.$root.length) {
      return;
    }

    const setNews = () => {
      this.$newsList.empty();
      const newsItemStyle = window.getComputedStyle(this.$newsItem[0]);
      const width =
        this.$newsItem[0].offsetWidth +
        parseFloat(newsItemStyle.marginLeft) +
        parseFloat(newsItemStyle.marginRight);

      if (width) {
        const newsLength = Math.ceil((window.innerWidth * 2) / width);
        Array.from({ length: newsLength }).forEach(() => {
          const $clone = this.$newsItem.clone().addClass('-shown');
          this.$newsList.append($clone);
        });
      }
    };
    if (this.$newsItem[0]) {
      window.addEventListener('resize', () => {
        setNews();
      });
      setNews();
    }

    this.$toggle.on('click.ebi.header', () => {
      this.isShown = !this.isShown;
      this.$root.toggleClass('-opened', this.isShown);
    });

    this.$opener.on('click.ebi.header', () => {
      this.isShown = true;
      this.$root.toggleClass('-opened', this.isShown);
    });

    this.$closer.on('click.ebi.header', () => {
      this.isShown = false;
      this.$root.toggleClass('-opened', this.isShown);
    });
  }
}
