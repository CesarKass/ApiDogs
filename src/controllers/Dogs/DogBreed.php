<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;
//ENDPOINT con Base de datos
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

//Consultar una raza
$app->get('/OneDogBreeds/{IdDogBreed}', function (Request $request, Response $response) {
  $idRaza = $request->getAttribute('IdDogBreed');
  $sql="SELECT * FROM razas WHERE idRaza=$idRaza";
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

//Crear nueva raza
$app->post('/NewDogBreed/new', function (Request $request, Response $response) {
  $nombreRaza = $request->getParam('NewDogBreed');
  $sql="INSERT INTO razas (NombreRaza) VALUES (:NewDogBreed)";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->bindParam(':NewDogBreed',$nombreRaza);
    $resultado->execute();
    echo json_encode("Nueva raza registrada");
} catch (PDOException $e) {
  echo '{"error": {"text":'.$e->getMessage().'}';
}
$resultado= null;
$db=null;
});

//Modificar raza
$app->put('/ModifyDogBreed/{IdDogBreed}', function (Request $request, Response $response) {
  $idRaza = $request->getAttribute('IdDogBreed');
  $nombreRaza = $request->getParam('DogBreed');

  $sql="UPDATE razas SET NombreRaza = :DogBreed WHERE idRaza = $idRaza";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->bindParam(':DogBreed',$nombreRaza);
    $resultado->execute();
    echo json_encode("Raza Actualizada");
} catch (PDOException $e) {
  echo '{"error": {"text":'.$e->getMessage().'}';
}
$resultado= null;
$db=null;
});

//Eliminar raza
$app->delete('/DeleteDogBreed/{IdDogBreed}', function (Request $request, Response $response) {
  $idRaza = $request->getAttribute('IdDogBreed');

  $sql="DELETE FROM razas WHERE idRaza = $idRaza";
  try {
    $db = new db();
    $db = $db->conectDB();
    $resultado = $db->prepare($sql);
    $resultado->execute();
    if ($resultado->rowCount()>0) {
      echo json_encode("Raza Eliminada");
    }else{
      echo json_encode("No existe raza con ese ID");
    }
} catch (PDOException $e) {
  echo '{"error": {"text":'.$e->getMessage().'}';
}
$resultado= null;
$db=null;
});