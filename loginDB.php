<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "labweb3";

try{

  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";

  $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id AND password=:password");
  $stmt->execute(['id' => $_POST["username"],'password' => $_POST["password"]]);
  $user = $stmt->fetch();

  if (is_array($user))  {
    /*
    $_SESSION["userMember"] = $fetch["username"];
    $_SESSION["password"] = $fetch["password"];
    */
    echo 'yes this member is registered';
  }else {
    echo 'Nombre de usuario o contraseña incorrecta';
  }

}
catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}


 ?>
