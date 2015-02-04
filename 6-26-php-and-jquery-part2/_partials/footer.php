  </div>

  <script src="../jquery.js"></script>
  <script src="../handlebars-v2.0.0.js"></script>
  <script src="./js/scripts.js"></script>
  <script>
    (function($) {
      Actors.init({
        letterSelection: $("#q"),
        form: $("#actor-selection"),
        actorListTemplate: $("#actor-list-template").html(),
        actorInfoTemplate: $("#actor-info-template").html(),
        actorsList: $("ul.actors-list"),
        actorInfo: $("div.actor-info")
      });
    })(jQuery);
  </script>
</body>
</html>