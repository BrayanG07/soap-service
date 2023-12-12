<?php
require_once "vendor/econea/nusoap/src/nusoap.php";
require_once "config/connection.php";
require_once "models/User.php";

$server = new nusoap_server();
$namespace = 'UserListServiceSOAP';

// Define el servicio web y el método
$server->configureWSDL('UserListService', $namespace);
$server->register(
    'getUserInfo', // Nombre del método
    array(), // Parámetros de entrada
    array('return' => 'tns:ArrayOfUserInfo'), // Parámetros de salida
    $namespace,
    false, // SOAPAction
    'rpc', // Estilo
    'encoded', // Uso
    'Returns user information from user.'
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

function getUserInfo()
{
    try {
        $user = new User();
        return $user->getAllUsers();
    } catch (Exception $e) {
        return handlerErrorCatch($e);
    }
}

function handlerErrorCatch(Exception $e)
{
    if ($e->getCode() == 400) {
        header('HTTP/1.1 400 Bad Request', true, 400);
        return array("answer" => false, "error" => $e->getMessage());
    }

    header('HTTP/1.1 500 Internal Server Error', true, 500);
    return array("answer" => false, "error" => $e->getMessage());
}

// Procesa la solicitud del cliente
$server->service(file_get_contents('php://input'));
