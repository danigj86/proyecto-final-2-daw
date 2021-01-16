<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'pfdaw';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

//Con esto recuperamos valores del usuario de la sesion
if (isset($_SESSION['user_id'])) {
  //HACE UNA CONSULTA
  $records = $conn->prepare('SELECT id_cliente, nombre, email, password FROM users WHERE id_cliente = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC); //Y CAPTURA LOS VALORES DE ESE USUARIO..

  $user = null;

  if ($results > 0) {
      $user = $results; //..Y LOS METEMOS EN USER, ASI PODEMOS USAR LOS VALORES $user['nombre'] etc
  }
}

?>
