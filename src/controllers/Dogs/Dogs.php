<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
$app = new \Slim\App;

$ruta="C:/xampp\htdocs\APIdogs\src\imagenesPerros";
$nombreCarpeta1="";
$nombreCarpeta="";
$i = 0;
$i1 = 0;
$fic;

$pila= array();
$pila1= array();
$host= gethostname();
$ip = gethostbyname($host);



//-------------------------------------------------------------------------------


//Una imagen de cada carpeta
$app->get('/OneDogOfEachBreed', function (Request $request, Response $response) {
    unArchivoAleatorioDeCadaCarpeta($GLOBALS["ruta"],$GLOBALS["nombreCarpeta"]);
    unset($GLOBALS["fic"][$GLOBALS["i"]-1]);
    print_r(json_encode($GLOBALS["fic"],JSON_PRETTY_PRINT)); 
    $GLOBALS["fic"]="";
});
function unArchivoAleatorioDeCadaCarpeta($ruta,$nombreCarpeta){
    $GLOBALS["pila"] = array();
    $directorio = opendir($ruta); 
    while ($archivo = readdir($directorio)) 
    {
        if (is_dir($ruta."/".$archivo))
        {
            if ($archivo != "." && $archivo != "..") {
                unArchivoAleatorioDeCadaCarpeta($ruta."/".$archivo,$archivo);
            }
        }else{
            array_push($GLOBALS["pila"], $archivo);
        }
    }
    $GLOBALS["fic"][$GLOBALS["i"]] = 
    array(
        "breed" => $nombreCarpeta,
        "image" => "http://".$GLOBALS["ip"]."/APIdogs/src/imagenesPerros/".$nombreCarpeta."/".str_replace(" ","%20",$GLOBALS["pila"] [array_rand($GLOBALS["pila"])])
    );
    $GLOBALS["i"]++;
}
//Fin Una imagen de cada carpeta



//-------------------------------------------------------------------------------



//Una imagen de todas las carpetas
$app->get('/OneDogRandom', function (Request $request, Response $response) {
    unPerroRandom($GLOBALS["ruta"],$GLOBALS["nombreCarpeta"]);
    $fic=
    array(
        "image" => "http://".$GLOBALS["ip"]."/APIdogs/src/imagenesPerros/".str_replace(" ","%20",$GLOBALS["pila"] [array_rand($GLOBALS["pila"])])
    );
    print_r(json_encode($fic,JSON_PRETTY_PRINT)); 
    $fic="";
    $i=0;
});
function unPerroRandom($ruta,$nombreCarpeta){
    $directorio = opendir($ruta); 
    while ($archivo = readdir($directorio)) 
    {
        if (is_dir($ruta."/".$archivo))
        {
            if ($archivo != "." && $archivo != "..") {
                unPerroRandom($ruta."/".$archivo,$archivo);
            }
        }else{
            array_push($GLOBALS["pila"], $nombreCarpeta."/".$archivo);
        }
    }
}
//Fin Una imagen de todas las carpetas



//-------------------------------------------------------------------------------



//Una imagen aleatoria de una raza
$app->get('/OneDogRandomOfOneBreed/{DogBreed}', function (Request $request, Response $response) {
    $GLOBALS["nombreCarpeta"] = $request->getAttribute('DogBreed');
    unPerroRandomDeUnaRaza($GLOBALS["ruta"],$GLOBALS["nombreCarpeta"]);
    $fic=
    array(
        "image" => "http://".$GLOBALS["ip"]."/APIdogs/src/imagenesPerros/".str_replace(" ","%20",$GLOBALS["pila"] [array_rand($GLOBALS["pila"])])
    );
    print_r(json_encode($fic,JSON_PRETTY_PRINT)); 
    $fic="";
    $i=0;
    $GLOBALS["nombreCarpeta"]="";
});
function unPerroRandomDeUnaRaza($ruta,$nombreCarpeta){
    $directorio = opendir($ruta."/".$nombreCarpeta); 
    while ($archivo = readdir($directorio)) 
    {
        if (is_dir($ruta."/".$archivo))
        {
            if ($archivo != "." && $archivo != "..") {
               unPerroRandomDeUnaRaza($ruta."/".$archivo,$archivo);
            }
        }else{
            array_push($GLOBALS["pila"], $nombreCarpeta."/".$archivo);
        }
    }
}
//Fin Una imagen aleatoria de una raza