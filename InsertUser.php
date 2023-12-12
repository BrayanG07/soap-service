<?php
require_once "vendor/econea/nusoap/src/nusoap.php";
require_once "config/connection.php";
require_once "models/User.php";

$namespace = "InsertUserSOAP";
$server = new soap_server();
$server->configureWSDL("InsertUser", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

// * Configurar parametros a recibir
$server->wsdl->addComplexType(
  "InsertUser",
  "complexType",
  "struct",
  "all",
  "",
  array(
    "username" => array("name" => "username", "type" => "xsd:string"),
    "password" => array("name" => "password", "type" => "xsd:string"),
    "name" => array("name" => "name", "type" => "xsd:string"),
    "lastname" => array("name" => "lastname", "type" => "xsd:string"),
    "email" => array("name" => "email", "type" => "xsd:string"),
    "phone" => array("name" => "phone", "type" => "xsd:string"),
    "address" => array("name" => "address", "type" => "xsd:string")
  )
);


// * Estructura de la respuesta
$server->wsdl->addComplexType(
  "InsertUserResponse",
  "complexType",
  "struct",
  "all",
  "",
  array(
    "answer" => array("name" => "answer", "type" => "xsd:boolean"),
    "error" => array("name" => "error", "type" => "xsd:string")
  )
);

$server->register(
  "InsertUserService",
  array("InsertUser" => "tns:InsertUser"),
  array("InsertUser" => "tns:InsertUserResponse"),
  $namespace,
  false,
  "rpc",
  "encoded",
  "Insert User"
);

// * Esta funcion apunta a la funcion InsertUserService del soap server
// * $request = contiene los valores del array que definimos en el addComplexType('InsertUser')
function InsertUserService($request)
{
  try {
    validateUser($request);

    $user = new User();
    $user->username = trim(strtolower($request["username"]));
    $user->password = password_hash($request["password"], PASSWORD_BCRYPT);;
    $user->name = $request["name"];
    $user->lastname = $request["lastname"];
    $user->email = trim(strtolower($request["email"]));
    $user->phone = $request["phone"];
    $user->address = $request["address"];
    $user->insertUser();

    return array("answer" => true, "error" => "");
  } catch (Exception $e) {
    return handlerErrorCatch($e);
  }
}

function validateUser($request)
{
  if (empty($request["username"])) {
    throw new Exception("El nombre de usuario no puede estar vacio", 400);
  }

  if (empty($request["password"])) {
    throw new Exception("La contrasena no puede estar vacia", 400);
  }

  if (empty($request["email"])) {
    throw new Exception("El nombre no puede estar vacio", 400);
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

$server->service(file_get_contents("php://input"));