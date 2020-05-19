<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

//Consultar todas las razas
$app->get('/allDogBreeds', function (Request $request, Response $response) {
  $sql="SELECT * FROM razas";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->query($sql);
    if ($resultado->rowCount()>0) {
      $dogs=$resultado->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($dogs);
    }
    else{
      echo json_encode("No hay razas registradas");
    }
  } catch (PDOException $e) {
    echo '{"error": {"text":'.$e->getMessage().'}';
  }

  $resultado= null;
  $db=null;
});