<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
$app = new \Slim\App;

//Incluye los endpoints

//endpoint consulta desde carpeta de imagenes
require __DIR__ . "\Dogs\Dogs.php";

