<?php

require 'functions.php';
connect();

$info = getActorInfo($_GET['actor_id']);

include 'views/actor.tmpl.php';