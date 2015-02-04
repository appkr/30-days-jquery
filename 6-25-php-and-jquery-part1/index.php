<?php

require 'functions.php';

if (isset($_POST['q'])) {
  connect();
  $actors = getActorsByLastname($_POST['q']);
}

include 'views/index.tmpl.php';