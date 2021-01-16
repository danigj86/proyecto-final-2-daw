<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome to you WebApp</title>
        <!-- LINKS CSS, BOOTSTRAP-->
        <?php require 'partials/links.php' ?>
    </head>
    <body>
        <!--CABECERA-->
        <?php require 'partials/header.php' ?>


        <h2>Por favor, ingrese o registre una cuenta</h2>

        <a href="login.php">Login</a> o
        <a href="signup.php">Registro</a>
        <!--SCRIPTS -->
        <?php require 'partials/scripts.php' ?>

        <section>
            <div class="container">
                <img src="assets/images/logo.png" width= "40%"  height="auto" style="margin: auto;" >
                <h3>Bienvenido a nuestra plataforma.</h3>
                <p> Si deseas ver nuestra gama de productos, contactar con nosotros, ver nuestra ubicación o realizar un pedido, por favor ingresa con tu cuenta. 
                Si aún no estas registrado, regístrate para acceder a nuestra plataforma.
                Si deseas trabajar con nosotros, entra en la sección "únete" para enviarnos tu CV.</p>
            </div>
        </section>
    </body>
</html>
