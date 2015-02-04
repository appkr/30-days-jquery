// Polyfill for Old Browser
if (typeof Object.create !== "function") {
  Object.create = function(obj) {
    function F() {};
    F.prototype = obj;
    return new F();
  }
}

(function($, window, document, undefined) {

  // Flickr Class
  var Flickr = {

    init: function(options, elem) {
      var self = this;

      self.elem = elem;
      self.$elem = $(elem);
      self.options = {};
      self.feed = [];

      if (typeof options !== "undefined") {
          self.options = (typeof options === "string")
            ? $.extend({}, $.fn.flickr.options, {method: options})
            : self.options = $.extend({}, $.fn.flickr.options, options);
      } else {
        self.options = $.fn.flickr.options;
      }

      self.url = "https://api.flickr.com/services/rest/?format=json&nojsoncallback=1&extras=description,owner_name,url_s,url_m,url_l&per_page=" + self.options.numRows * 4 + "&method=" + self.options.method + "&api_key=" + self.options.apiKey;

      self.run(1);
    },

    run: function(length) {
      var self = this;

      setTimeout(function() {
        self.fetch().done(function(results) {
          self.buildFragment(results.photos.photo);
          self.display.call(self);

          if (typeof self.options.onComplete === "function") {
            self.options.onComplete.apply(self.elem, arguments);
          }

          if (self.options.refresh) {
            self.run();
          }
        });
      }, length || self.options.refresh);
    },

    fetch: function() {
      return $.ajax({
        url: this.url,
        data: {method: this.method},
        dataType: "json"
      });
    },

    buildFragment: function(photos) {
      var self = this,
          i = 0,
          j = 0,
          k = 0,
          feed = [];

      for (len = Math.floor(photos.length/4); i < len; i++) {
        feed[i] = [];
        for (var j = 0; j < 4; j++, k++) {
          feed[i].push(photos[k]);
        }
      }

      self.feed = feed;
    },

    display: function() {
      var self = this;

      compileView = Handlebars.compile(self.options.template);

      if (self.options.transition === 'none' || ! self.options.transition) {
        self.$elem.html($.trim(compileView(self.feed)));
      } else {
        self.$elem[self.options.transition](500, function() {
          $(this).html($.trim(compileView(self.feed)))[self.options.transition](500);
        });
      }
    }

  };

  // jQuery Plugin
  $.fn.flickr = function(options) {
    return this.each(function() {
      var flickr = Object.create(Flickr);
      flickr.init(options, this);

      $.data(this, 'flickr', flickr);
    });
  };

  // Plugin Options
  $.fn.flickr.options = {
    apiKey: "d401046f072dae687da49de8cb79cf04",
    method: "flickr.interestingness.getList",
    template: $("#image-template").html(),
    numRows: 3,
    refresh: null,
    transition: "fadeToggle",
    onComplete: null
  };

})(jQuery, window, document);