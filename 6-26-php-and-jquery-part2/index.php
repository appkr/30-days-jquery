<?php

require 'functions.php';

if (isset($_POST['q'])) {
  connect();
  $actors = getActorsByLastname($_POST['q']);

  if (isXHR()) {
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($actors);
    die();
  }
} else if (isset($_POST['actor_id'])) {
  connect();
  $info = getActorInfo($_POST['actor_id']);
  echo json_encode($info);
  die();
}

include 'views/index.tmpl.php';