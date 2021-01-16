<?php
session_start();
require './clases/claseEmail.php';

$message2 = $_GET['message2'] ?? '';

//SI LOS CAMPOS DEL FORMULARIO NO ESTAN VACIOS, SE ENVIA EL EMAIL
if (!empty($_POST['asunto']) && !empty($_POST['telefono']) && !empty($_POST['mensaje'])) {

    $obj = new claseEmail();
    $message2 = $obj->sendEmail(); //SE EJECUTA LA FUNCION EMAIL
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- LINKS CSS, BOOTSTRAP-->
    <?php require 'partials/links.php'?>
    <title>CONTACTO</title>
  </head>
  <body>

  <!--CABECERA-->
  <?php include 'partials/headerMain.php';?>
    <h1>CONTACTO</h1>
    
 <section>
       <div class = "container">
           <h2>Sobre nosotros</h2>
           <p>La calidad de nuestros productos radica desde hace años en un componente patentado y exclusivo: Ferticell.
              Ferticell es un producto único con tecnología de avanzada que está compuesto por 16 tipos de algas y bacterias unicelulares que penetran instantáneamente en la hoja. Además, estabiliza las auxinas y las citoquininas dentro de la planta, lo cual es importante para el crecimiento de la planta y la producción de un cultivo homogéneo. </p>
          <article>
            <br><br>
            <h2>Ven a visitarnos</h2>
          <iframe id="art" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3199.241722633175!2d-4.500732185362822!3d36.692728881442825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72fa0b70fa48d3%3A0xd90fee3ad5291ae8!2sAgroplasma!5e0!3m2!1ses!2ses!4v1577728455977!5m2!1ses!2ses"></iframe>
          </article>
          <article>
            <form class="formu was-validated" action="about.php" method="POST" >
              <h3>Contacte con nosotros <?php echo $user['nombre'] ?></h3>
              <h4><?php echo "<br>" . $message2 . "<br>"; ?></h4>
              <input type="text" name="asunto" class="form-control" placeholder="Asunto" required>
              <input type="text" name="telefono" class="form-control" placeholder="Indique su telefono" required>
              <textarea name="mensaje" id="" cols="30" rows="10" placeholder="Escriba su mensaje aquí"></textarea><br>
              <input type="submit" value="Enviar">
            </form>
          </article>
       </div>
   </section>
   <br><br><br>
<!-- FOOTER -->
<?php include 'partials/footer.php';?>
 <!--SCRIPTS -->
 <?php include 'partials/scripts.php';?>

  </body>
</html>