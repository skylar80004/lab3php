<?php

//TODO: Missing

include 'FieldValidator.php';
class dbConnection {

  public function __construct(){
    this->conn = null;
  }

  public function connect(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "labweb3";

    try{
      $this->conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    }
    catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }

  }

  public function login(){

    $fieldValidator = new FieldValidator();
    if(!$fieldValidator->isEmpty($_POST["username"]) &&
    !$fieldValidator->isEmpty($_POST["password"])){

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id AND password=:password");
      $stmt->execute(['id' => $_POST["username"],'password' => $_POST["password"]]);
      $user = $stmt->fetch();

      if (is_array($user))  {
        /*
        $_SESSION["userMember"] = $fetch["username"];
        $_SESSION["password"] = $fetch["password"];
        */
        echo 'Inicio de sesion correcto';
      }else {
        echo 'Nombre de usuario o contraseña incorrecta';
      }

  }
}


}


 ?>
