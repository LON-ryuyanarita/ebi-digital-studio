import $ from 'jquery';
import 'scroll-behavior-polyfill';
// import Cookies from 'js-cookie';
import CreateCss from './createCss.js';
// import Top from './top.js';
import Header from './header.js';
import Carousel from './carousel.js';
import ShareUrl from './shareUrl.js';

// DOMContentLoaded
const DOMContentLoadedCallback = () => {
  window.onunload = function () {};
  const $window = $(window);
  const $document = $(document);
  const $html = $('html');
  const $root = $('body');

  const createCss = new CreateCss();

  // check enabled hover
  const hasTouchEvent = !!(
    'ontouchstart' in window || navigator.msPointerEnabled
  );
  $root.toggleClass('-enabledHover', !hasTouchEvent);

  // 100vh
  const setFillHeight = () => {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  };
  setFillHeight();

  // scrollbar
  const setScrollbarWidth = () => {
    $html.css('overflow', 'scroll');
    const scrollbarWidth =
      window.innerWidth - document.documentElement.clientWidth;
    document.documentElement.style.setProperty(
      '--scrollbar',
      `${scrollbarWidth}px`
    );
    $html.css('overflow', '');
  };
  setScrollbarWidth();

  const windowInfo = {};

  // debug::
  if (location.search.includes('debug=true')) {
    var tempX = 0;
    var tempY = 0;
    $root.css({
      'box-shadow': '0 0 1px inset #000',
      // 'min-width': '1440px',
    });
    $(window).on({
      'mousewheel.temp': function (e) {
        tempX += e.originalEvent.deltaX * -0.5;
        tempY += e.originalEvent.deltaY * -0.5;
        $root.css('transform', 'translate(' + tempX + 'px, ' + tempY + 'px)');
      }.bind(this),

      'keypress.temp': function (e) {
        if (e.keyCode == 32) {
          e.preventDefault();
          $root.css('transform', '');
          $(window).off('mousewheel.temp').off('keypress.temp');
        }
      }.bind(this),
    });
  }
  // ::debug

  const header = new Header();
  header.init();
  const carousel = new Carousel();
  carousel.init();
  const shareUrl = new ShareUrl();
  shareUrl.init();

  const handleScroll = () => {
    windowInfo.scrollX = window.scrollX;
    windowInfo.scrollY = window.scrollY;
  };

  const handleResize = () => {
    // device screen
    windowInfo.screenWidth = screen.width;
    windowInfo.screenHeight = screen.height;

    // browser window size
    windowInfo.windowWidth = window.innerWidth;
    windowInfo.windowHeight = window.innerHeight;
    const prevIsSpView = windowInfo.isSpView;
    windowInfo.isSpView = windowInfo.windowWidth <= 768;
    windowInfo.isMinPcView = windowInfo.windowWidth <= 1028;
    if (
      !hasTouchEvent ||
      (prevIsSpView !== undefined && prevIsSpView !== windowInfo.isSpView)
    ) {
      setFillHeight();
    }
    setScrollbarWidth();

    // webpage size
    windowInfo.pageWidth = document.documentElement.scrollWidth;
    windowInfo.pageHeight = document.documentElement.scrollHeight;

    handleScroll();
  };

  const handleLoad = () => {};

  window.addEventListener('scroll', handleScroll, { passive: true });
  window.addEventListener('resize', handleResize);
  window.addEventListener('load', handleLoad);
  // svgHeightSetterForIE.init();

  handleResize();
};

if (
  document.readyState === 'complete' ||
  (document.readyState !== 'loading' && !document.documentElement.doScroll)
) {
  DOMContentLoadedCallback();
} else {
  document.addEventListener('DOMContentLoaded', DOMContentLoadedCallback);
}
