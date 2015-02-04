<?php

// Run php server before run this script
// > php -S localhost:8888

$data = time() . ' ' . $_POST['content'] . PHP_EOL;
$res = file_put_contents('data.txt', $data, FILE_APPEND);

header("Content-type: application/json; charset=utf-8");
echo json_encode(['data' => $data]);