<?php
require_once "vendor/econea/nusoap/src/nusoap.php";
require_once "config/connection.php";
require_once "models/User.php";

// Configuración del servicio SOAP
$server = new nusoap_server();
$namespace = 'UserListServiceSOAP'; // Cambia esto a tu propio namespace

// Define el servicio web y el método
$server->configureWSDL('UserListService', $namespace);
$server->register('getUserInfo', // Nombre del método
    array(), // Parámetros de entrada
    array('return' => 'tns:ArrayOfUserInfo'), // Parámetros de salida
    $namespace, // Namespace
    false, // SOAPAction
    'rpc', // Estilo
    'encoded', // Uso
    'Returns user information as an associative array.' // Descripción
);

// Definición del tipo de dato ArrayOfUserInfo
$server->wsdl->addComplexType(
    'ArrayOfUserInfo',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:UserInfo[]')
    ),
    'tns:UserInfo'
);

// Definición del tipo de dato UserInfo
$server->wsdl->addComplexType(
    'UserInfo',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id_user' => array('name' => 'id_user', 'type' => 'xsd:int'),
        'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'name' => array('name' => 'name', 'type' => 'xsd:string'),
        'lastname' => array('name' => 'lastname', 'type' => 'xsd:string'),
        'address' => array('name' => 'address', 'type' => 'xsd:string'),
        'email' => array('name' => 'email', 'type' => 'xsd:string'),
        'phone' => array('name' => 'phone', 'type' => 'xsd:string')
    )
);

function getUserInfo() {
  $user = new User();
  return $user->getAllUsers();
}

// Procesa la solicitud del cliente
$rawPostData = file_get_contents('php://input');
$server->service($rawPostData);

?>
