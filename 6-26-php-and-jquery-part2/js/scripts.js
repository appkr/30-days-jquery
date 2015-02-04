var Actors = {

  init: function(config) {
    this.config = config;

    this.setupTemplate();
    this.bindEvents();

    $.ajaxSetup({
      url: "index.php",
      type: "POST"
    })
  },

  bindEvents: function() {
    this.config.letterSelection.on("change", this.fetchActors);
    this.config.actorsList.on("click", "li", this.displayActorInfo);
    this.config.actorInfo.on("click", "span.close", this.closeOverlay);
  },

  setupTemplate: function() {
    this.config.actorListTemplate = Handlebars.compile(this.config.actorListTemplate);
    this.config.actorInfoTemplate = Handlebars.compile(this.config.actorInfoTemplate);
    Handlebars.registerHelper('fullName', function(actor) {
      return actor.first_name + " " + actor.last_name;
    });
  },

  fetchActors: function() {
    var self = Actors;

    $.ajax({
      data: self.config.form.serialize(),
      dataType: "json",
      success: function(results) {
        self.config.actorsList.empty();
        if (results[0]) {
          self.config.actorsList.append(self.config.actorListTemplate(results));
        } else {
          $("<li></li>", {
            text: "Nothing returned"
          }).appendTo(self.config.actorsList);
        }
      }
    });
  },

  displayActorInfo: function(e) {
    var self = Actors;

    self.config.actorInfo.slideUp(300);

    $.ajax({
      data: {actor_id: $(this).data("actor_id")},
      dataType: "json"
    }).done(function(results) {
      self.config.actorInfo.html(self.config.actorInfoTemplate(results)).slideDown(300);
    });

    e.preventDefault();
  },

  closeOverlay: function() {
    Actors.config.actorInfo.slideUp(300);
  }

};