<?php include(__DIR__.'/../_partials/header.php');?>

<h1>Search Actors By Last Name</h1>

<form action="index.php" method="post" id="actor-selection">
  <select name="q" id="q">
    <?php
    $alphabet = str_split('abcdefghijklmnopqrstuvwxyz');
    foreach($alphabet as $letter) {
      $selected = (isset($_POST['q']) and $_POST['q'] == $letter) ? 'selected' : null;
      echo "<option value=\"{$letter}\" {$selected}>{$letter}</option>\n";
    }
    ?>
  </select>
  <button type="submit">Go !</button>
</form>

<ul class="actors-list">
  <?php
  if(isset($actors)) {
    foreach($actors as $actor) {
      echo <<<EOT
  <li data-actor_id="{$actor->actor_id}">
    <a href="actor.php?actor_id={$actor->actor_id}">{$actor->first_name} {$actor->last_name}</a>
  </li>\n
EOT;
    }
  }
  ?>
</ul>

<div class="actor-info">
  <script id="actor-info-template" type="text/x-handlebars-template">
    <p>{{film_info}}</p>
    <span class="close">X</span>
  </script>
</div>

<script id="actor-list-template" type="text/x-handlebars-template">
  {{#each this}}
    <li data-actor_id="{{actor_id}}">
      <a href="actor.php?actor_id={{actor_id}}">{{fullName this}}</a>
    </li>
  {{/each}}
</script>

<?php include(__DIR__.'/../_partials/footer.php');?>