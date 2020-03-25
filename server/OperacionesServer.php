<?php

require_once("../nusoap/lib/nusoap.php"); //importamos la libreria de nusoap
require_once("Operaciones.php");  //llamamos a la clase del metodo que vamos a exponer

//direccion del server, en este caso se maneja en local
$url_server = "https://localhost/webServicesSoapPhp/versionamiento/WebServicesSoapPhp/server/OperacionesServer.php";

//creamos el server con nusoap
$server = new soap_server();

$server -> configureWSDL("operacionesserver",$url_server);  //configuramos para el wsdl

//Registramos el metodo de la clase que vamos a exponer (crea el xml wsdl)
$server -> register(

    "Operaciones.suma",
    array("operador1" => "xsd:int", "operador2" => "xsd:int"),
    array("return" => "xsd:string"),
    false,
    false,
    "rpc",
    "encoded",
    "Obtiene la operacion"

);

@$server -> service(file_get_contents("php://input"));

?>