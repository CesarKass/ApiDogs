<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
$app = new \Slim\App;

//Incluye los endpoints
//endpoint Razas base de datos
//require __DIR__ . "\Dogs\DogBreed.php";

//endpoint consulta desde carpeta de imagenes
require __DIR__ . "\Dogs\Dogs.php";



//Ejemplos de endpoints
$app->get('/', function (Request $request, Response $response) {
  $response->getBody()->write("El api funciona");
  return $response;
});
$app->get('/hello', function (Request $request, Response $response) {
  return "Hola mundo";
});
$app->get('/hello/{nombre}', function (Request $request, Response $response) {
  $nombre = $request->getAttribute("nombre");
  return "Hola $nombre";
});
$app->get('/hello/{nombre}/{apellido}', function (Request $request, Response $response) {
  $nombre = $request->getAttribute("nombre");
  $apellido = $request->getAttribute("apellido");
  return "Hola $nombre $apellido";
});
$app->get('/hola/{nombre}[/{apellido}]', function (Request $request, Response $response) {
  $nombre = $request->getAttribute("nombre");
  $apellido = $request->getAttribute("apellido");
  return "Hola $nombre $apellido";
});