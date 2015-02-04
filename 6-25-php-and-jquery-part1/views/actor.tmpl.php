<?php

include(__DIR__.'/../_partials/header.php');

$html = 'No results available';

if ($info) {
  $html =<<<EOT
  <h1>{$info->first_name} {$info->last_name}</h1>
  <p>{$info->film_info}</p>
EOT;
}

echo $html;

echo <<<EOT
  <p>
    <a href="index.php">Back</a>
  </p>
EOT;

include(__DIR__.'/../_partials/footer.php');
