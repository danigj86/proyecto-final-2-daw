<?php

session_start(); //INICIO UNA SESION
require './clases/claseUsuario.php';

$message = $_GET['message'] ?? '';

//SI LOS CAMPOS NO ESTAN VACIOS..
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    //HAGO LA CONSULTA..
    $obj = new claseUsuario();
    $message = $obj->login($_POST['email'], $_POST['password'] ); //LLAMAMOS A LA FUNCION LOGIN
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <!-- LINKS CSS, BOOTSTRAP-->
        <?php require 'partials/links.php'?>
    </head>
    <body>
        <!--CABECERA-->
        <?php require 'partials/header.php'?>

        <?php echo $message ?>


        <h2>Login</h2>
        <span>o <a href="signup.php">Registro</a></span>

        <form action="login.php" method="POST">
            <input name="email" type="email" placeholder="Enter your email" required>
            <input name="password" type="password" placeholder="Enter your Password" required>
            <input type="submit" value="Submit">
        </form>
        <!--SCRIPTS -->
        <?php require 'partials/scripts.php'?>
    </body>
</html>
