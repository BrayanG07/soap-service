<?php
class Connection
{
  protected $dbHost;
  private $host = "localhost";
  private $database = "db_soap";
  private $user = "root";
  private $password = "";

  protected function connection()
  {
    try {
      $connect = $this->dbHost = new PDO(
        "mysql:host=$this->host;dbname=$this->database",
        $this->user,
        $this->password
      );

      return $connect;
      return $this->dbHost;
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  public function set_names() {
    return $this->dbHost->exec("SET NAMES 'utf8'");
  }
}
