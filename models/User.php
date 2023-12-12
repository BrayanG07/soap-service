<?php
class User extends Connection
{
  public $id;
  public $name;
  public $lastname;
  public $username;
  public $password;
  public $email;
  public $phone;
  public $address;

  public function insertUser()
  {
    $this->existEmail($this->email);
    $this->existUsername($this->username);

    $connect = parent::connection();
    parent::set_names();

    $sql = "INSERT INTO tbl_user (username, password, name, lastname, email, phone, address, status) VALUES (?, ?, ?, ?, ?, ?, ?, '1')";
    $stmt = $connect->prepare($sql);

    $stmt->bindParam(1, $this->username);
    $stmt->bindParam(2, $this->password);
    $stmt->bindParam(3, $this->name);
    $stmt->bindParam(4, $this->lastname);
    $stmt->bindParam(5, $this->email);
    $stmt->bindParam(6, $this->phone);
    $stmt->bindParam(7, $this->address);
    $stmt->execute();
  }

  public function getAllUsers()
  {
    $connect = parent::connection();
    parent::set_names(); // SETEANDO UTF8

    $sql = "SELECT id_user, username, name, lastname, address, email, phone FROM tbl_user";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function existEmail($email)
  {
    $connect = parent::connection();
    parent::set_names(); // SETEANDO UTF8


    $query = $connect->prepare("SELECT COUNT(*) as quantity FROM tbl_user WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result['quantity'] > 0) {
      throw new Exception('El email '.$email.' ya está registrado en la base de datos', 400);
    }
  }

  public function existUsername($username)
  {
    $connect = parent::connection();
    parent::set_names(); // SETEANDO UTF8


    $consulta = $connect->prepare("SELECT COUNT(*) as quantity FROM tbl_user WHERE username = :username");
    $consulta->bindParam(':username', $username, PDO::PARAM_STR);
    $consulta->execute();

    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado['quantity'] > 0) {
      throw new Exception('El nombre de usuario '. $username .' ya existe en la base de datos', 400);
    }
  }
}
