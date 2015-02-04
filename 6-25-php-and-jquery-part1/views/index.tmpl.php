<?php include(__DIR__.'/../_partials/header.php');?>

<h1>Search Actors By Last Name</h1>

<form action="index.php" method="post">
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

<?php if(isset($actors)) : ?>
  <ul class="actors-list">
    <?php
      foreach($actors as $actor) {
        echo "<li data-actor_id=\"{$actor->actor_id}\"><a href=\"actor.php?actor_id={$actor->actor_id}\">{$actor->first_name} {$actor->last_name}</a></li>\n";
      }
    ?>
  </ul>
<?php endif; ?>

<?php include(__DIR__.'/../_partials/footer.php');?>