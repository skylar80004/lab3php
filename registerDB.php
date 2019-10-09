<?php
include 'FieldValidator.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "labweb3";

try{

  //Connect to mysql database
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Validate empty fields
  $fieldValidator = new FieldValidator();
  if($fieldValidator->validateRegister($_POST["username"], $_POST["firstname"], $_POST["lastname"],
  $_POST["cellphone"], $_POST["telephone"], $_POST["password"],$_POST["password"]) ) {

    $userType = "UsuarioEstandar";
    $insert = "INSERT INTO users (id,firstname,lastname,cellphone,telephone,password,role) VALUES(?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($insert);
    $stmt->execute([ $_POST["username"], $_POST["firstname"], $_POST["lastname"],
    $_POST["cellphone"], $_POST["telephone"], $_POST["password"],$userType ]);

    $newURL = "login.php";
    header('Location: '.$newURL);

    echo '<script language="javascript">';
    echo 'alert("Usuario registrado correctamente")';
    echo '</script>';
  }
  else{
    echo "Campos vacios o formato incorrecto de campos";
  }

}
catch(PDOException $e){
  echo "Error: " . $e->getMessage();
}

 ?>
