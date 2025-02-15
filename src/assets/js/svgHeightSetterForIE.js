import $ from 'jquery';
import { UAParser } from 'ua-parser-js';

export default class SvgHeightSetterForIE {
  constructor(params = {}) {
  }

  init() {
    // for IE
    const uaParser = new UAParser();
    const isIE = uaParser.getBrowser().name === 'IE';
    const $svg = $('svg');
    if (isIE && $svg.length) {
      let timer = false;
      $(window).on('resize.ttr', function() {
        if (timer !== false) {
          clearTimeout(timer);
        }
        timer = setTimeout(function() {
          svgSizeCheck();
        }, 200);
      }).trigger('resize.ttr');
    }

    function svgSizeCheck() {
      $svg.each(function() {
        const $this = $(this);
        if ($this.css('display') == 'none') {
          return true;
        }
        const _width      = $this.width();
        const _viewBox    = this.viewBox.baseVal; // $this.context.viewBox.baseVal;
        const _viewWidth  = _viewBox.width;
        const _viewHeight = _viewBox.height;
        const _setHeight  = (_viewHeight * _width) / _viewWidth;
        $this.height(_setHeight);
      });
    }
  }
}
