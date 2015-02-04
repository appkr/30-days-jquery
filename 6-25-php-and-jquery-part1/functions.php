<?php

function connect() {
  global $pdo;
  $pdo = new PDO('mysql:host=localhost;dbname=sakila', 'root', '');
}

function getActorsByLastname($letter) {
  global $pdo;
  $stmt = $pdo->prepare(
    "SELECT actor_id, first_name, last_name FROM actor WHERE last_name LIKE :letter LIMIT 50"
  );
  $stmt->execute([':letter' => $letter . '%']);

  return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getActorInfo($actor_id) {
  global $pdo;
  $stmt = $pdo->prepare(
    "SELECT film_info, first_name, last_name FROM actor_info WHERE actor_id = :actor_id LIMIT 1"
  );
  $stmt->execute([':actor_id' => $actor_id]);

  return $stmt->fetch(PDO::FETCH_OBJ);
}
