<?php


require_once("../nusoap/lib/nusoap.php"); //importamos la libreria de nusoap

//Obtenemos la direccion del wsdl, normalmente se encuentra en el servidor
$url_wsdl = "https://localhost/webServicesSoapPhp/versionamiento/WebServicesSoapPhp/server/OperacionesServer.php?wsdl";

//creamos cliente con nusoap
$client = new nusoap_client($url_wsdl, 'wsdl');

//Verificamos que no existan errores
$error = $client->getError();

if($error){
    echo "<h2>Por favor veriricar la direccion url del wsdl</h2><pre>" . $error . "</pre>";
}

//Llamando al metodo suma y pasando parametros
$parametros = array("operador1"=>10, "operador2"=>10);  //parametros que recibe el metodo suma

$result = $client->call("Operaciones.suma",$parametros);

if($client->fault){
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}else{
    $error = $client -> getError();
    if ($error) {
        echo "<h2>Error: </h2><pre>" . $error . "</pre>";
    }else{
        echo "<h2>Main</h2>";
        echo $result;
    }
}

// show soap request and response
echo "<h2>Request</h2>";
echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
echo "<h2>Response</h2>";
echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";










?>