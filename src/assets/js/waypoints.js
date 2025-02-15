import 'waypoints/lib/noframework.waypoints.min.js';
import $ from 'jquery';

export default class Waypoints {
  constructor(params = {}) {}

  init($wrapper) {
    this.$wrapper = $wrapper || $('body');
    this.$targets = this.$wrapper.find('[data-ebi-wp]');
    this.$targets.each((_i, el) => {
      const $this = $(el);
      if (!$this.data('wp') === 'finished') {
        return;
      }
      const waypoints = new Waypoint({
        element: $this[0],
        // context: $wrapper[0],
        handler: function (direction) {
          this.destroy();
          $this.data('wp', 'finished');

          if ($this.is('[data-ebi-wp="show"]')) {
            show($this);
            return;
          }

          if ($this.is('[data-ebi-wp="each"]')) {
            showEach($this);
            return;
          }

          show($this);
        },
        offset: function () {
          const h = document.documentElement.clientHeight;
          return h * 0.75;
        },
      });
      $this.data('wp', waypoints);
    });

    function show($target) {
      var delay = $target.attr('data-ebi-wp-delay') || 0;
      setTimeout(() => {
        $target.addClass('-shown');
      }, delay);
    }

    function showEach($target) {
      $target.find('[data-ebi-wp-eachitem]').each(function (i) {
        var $this = $(this);
        setTimeout(() => {
          $this.addClass('-shown');
        }, i * 200);
      });
    }
  }

  reset($wrapper) {
    const $targets = ($wrapper || $('body')).find('[data-ebi-wp]');
    $targets.each((_i, el) => {
      if ($(el).data('wp') && $(el).data('wp').destroy) {
        $(el).data('wp').destroy();
      }
    });

    $targets.removeClass('-shown');
  }

  refresh() {
    Waypoint.destroyAll();
    setTimeout(() => {
      this.init(this.$wrapper);
    }, 200);
  }
}
