<?php
session_start();
require './clases/claseEmail.php';

$message2 = $_GET['message2'] ?? '';

//SI LOS CAMPOS DEL FORMULARIO NO ESTAN VACIOS, SE ENVIA EL EMAIL
if (!empty($_POST['departamento']) && !empty($_POST['telefono']) && !empty($_POST['mensaje'])) {

    $obj = new claseEmail();
    $message2 = $obj->sendCv(); //SE EJECUTA LA FUNCION EMAIL
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
    <title>ÚNETE</title>
  </head>
  <body>

  <!--CABECERA-->
  <?php include 'partials/headerMain.php';?>
    <h1>TRABAJA CON NOSOTROS</h1>
  
 <section>
       <div class = "container">
           <h2>Forma parte de nuestro equipo</h2>
           <p>Si quieres formar parte de nuestro equipo no dudes en enviarnos tu CV. Podrás trabajar con nosotros en uno de los siguientes departamentos:
               logística/almacén, marketing, laboratorio.  </p>
               <p>Estudiaremos tu petición según el perfil solicitado y realizarás una entrevista con nosotros.</p>
               <p>Encontrarás un empleo estable con posibilidad de crecimiento.</p>
          <article>
            <form class="formu was-validated" action="work.php" method="POST" enctype="multipart/form-data">
              <h3>Envíanos tu CV <?php echo $user['nombre'] ?></h3>
              <h4><?php echo "<br>" . $message2 . "<br>"; ?></h4>
              <input type="text" name="departamento" class="form-control" placeholder="Departamento al que opta" required>
              <input type="text" name="telefono" class="form-control" placeholder="Indique su teléfono" required>
              <textarea name="mensaje" id="" cols="30" rows="10" placeholder="Sobre mí"></textarea><br>
              <label for="exampleInputFile">Adjuntar archivo</label> <br><br>
              <input type="file" name="adjunto" id="archivo-adjunto"><br><br>
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