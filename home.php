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
    <title>HOME</title>
  </head>
  <body>

  <!--CABECERA-->
  <?php include 'partials/headerMain.php';?>
    <h1>Bienvenido</h1>

 <section>
       <div class = "container">
           <h2>Nuestra empresa</h2>
           <p>Agroplasma España (planta / laboratorio de fabricación) se inició a principios de 1983.
            La compañía se especializó en algas, cultivo de bacterias, extracción de plantas y
            formulaciones orgánicas y suplementos de nutrición vegetal líquidos a base de algas.
             La compañía desarrolló la tecnología conocida con el nombre I.C.E. Intercambio celular,
             transfiriendo nutrientes de las células bacterianas a las células vegetales,
              estimulando el crecimiento de las plantas y la capacidad de las plantas para
               absorber más nutrientes del suelo usando menos energía.</p>
               <br>
               <img src="https://media-exp1.licdn.com/dms/image/C561BAQH8XalWgFMK_Q/company-background_10000/0?e=2159024400&v=beta&t=o3aV002H6fMZr3nrcSg2L-G9hw3pJWOvBJd8bfEEHzE" width="70%">
               <br><br>
               <p>La marca de nuestros productos es FERTICELL, y nuestros productos se distribuyen
               hoy en EE. UU., México, España, Grecia, Turquía, América del Sur, Asia, Europa
                y algunos países de África.</p>
                <p>We also formulate special products according to customers request, both organic and inorganic</p>
          <p>Agroplasma SL España tiene más de 25 años de experiencia en el sector agrícola,
           desarrollando productos para la mejora del suelo, la desalinización y la descontaminación
            de suelos. En la actualidad, nuestro enfoque se ha centrado en la fabricación y distribución
            de productos de alta calidad y efectividad para la agricultura ecológica y convencional,
             la jardinería y la salud ambiental, al tiempo que obtenemos certificados internacionales.</p>
             <p>Nuestro enfoque de investigación y desarrollo está en la creación de fertilizantes orgánicos,
              materiales de hileras y correctores orgánicos. Los productos se basan en diferentes tipos
               de algas unicelulares, bacterias y extractos naturales de plantas de césped, semillas y
                minerales. Incorporamos las últimas tecnologías disponibles dentro de las disciplinas
                de microbiología, química y procesamiento industrial.</p>
          <article>
         
       </div>
   </section>
   <br><br><br>
<!-- FOOTER -->
<?php include 'partials/footer.php';?>
 <!--SCRIPTS -->
 <?php include 'partials/scripts.php';?>

  </body>
</html>