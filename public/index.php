<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config/db.php';

$config=["settings" => [
  "displayErrorDetails" => true
]];

$app = new \Slim\App($config);

require __DIR__ . "/../src/routes/routes.php";

$app->run();



