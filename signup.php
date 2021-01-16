<?php

require './clases/claseUsuario.php';

$message = $_GET['message'] ?? '';

//EMPIEZA EL REGISTRO: SI LOS CAMPOS NO ESTAN VACIOS..
if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $obj = new claseUsuario();
    $message = $obj->signUp($_POST['name'],$_POST['email'],$_POST['password'],$_POST['confirm_password'],$_POST['direccion'],$_POST['provincia']); //LLAMAMOS A LA FUNCION SIGNUP

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
     <!-- LINKS CSS, BOOTSTRAP-->
     <?php require 'partials/links.php'?>
  </head>
  <body>
     <!--CABECERA-->
    <?php require 'partials/header.php'?>

    <?php echo $message ?>


    <h2>Registro</h2>
    <span>o <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="name" type="text" placeholder="Introduce tu nombre" required>
      <input name="email" type="text" placeholder="Introduce tu email" required>
      <input name="password" type="password" placeholder="Introduce password" required>
      <input name="confirm_password" type="password" placeholder="Confirma tu password" required>
      <input name="direccion" type="text" placeholder="Tu dirección" required>
      <input name="provincia" type="text" placeholder="Provincia" required>
      <input type="submit" value="Submit">
    </form>

    <!--SCRIPTS -->
 <?php require 'partials/scripts.php'?>
  </body>
</html>
