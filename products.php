<?php
session_start();

require 'functions.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- LINKS CSS, BOOTSTRAP-->
    <?php require 'partials/links.php'?>
    <title>PRODUCTOS</title>

  </head>
  <body>

  <!--CABECERA-->
  <?php require 'partials/headerMain.php'?>

    <h1>PRODUCTS</h1>

   <section>
       <div class = "container">
           <h2>Nuestros productos</h2>
           <p>La calidad de nuestros productos radica desde hace años en un componente patentado y exclusivo: Ferticell.
            Ferticell es un producto único con tecnología de avanzada que está compuesto por 16 tipos de algas y bacterias unicelulares que penetran instantáneamente en la hoja. Además, estabiliza las auxinas y las citoquininas dentro de la planta, lo cual es importante para el crecimiento de la planta y la producción de un cultivo homogéneo.
            Todos nuestros productos estrellas están compuestos a raíz de este componente. </p>
            <br>
            <h3>Principales productos:</h3>
          <article id="acc">
     <!-- ACORDEON -->
   <div id="accordion">
    <h3>Borum</h3>
    <div>
    <img src="assets/images/borum.jpg" width="300px" height="300px" alt=""><br><br>
      <p>
        Producto: Nutriente líquido para agricultura, sin productos químicos.
        Aplicación: agricultura, silvicultura, floricultura, fruticultura, plantas de interior, etc.</p>
        <p>
        Aplicación:
        Horticultura, frutales, cítricos, vid y olivo:
        Deficiencias débiles: 300-400 c.c. 100 litros de agua.
        Deficiencias moderadas: 600-800 c.c. 100 litros de agua.
        Deficiencias fuertes: 1000-1200 c.c 100 litros de agua.
        Cultivos extensivos:
        Remolacha, etc.: 6-10 litros por hectárea</p>
    </div>
    <h3>Ferrum</h3>
    <div>
    <img src="assets/images/ferrum.jpg" width="300px" height="300px" alt=""><br><br>
      <p>Se puede aplicar conjuntamente con muchos agroquímicos, lo que permite una fácil integración para los programas de protección de cultivos
         y elimina la necesidad de operaciones específicas de pulverización.</p>
        <p>
        Aplicación:
        Vegetales: 3-5 litros de hectárea
        Cereal: 2 - 5 litros de hectárea
        Manzana / Pera: 3 - 5 litros de hectárea
        Fruta general: 3 - 5 litros de hectárea
        Aceituna: 5 - 10 litros de hectárea
        Vides: 3 - 5 litros de hectárea.</p>
    </div>
    <h3>Phosphorum</h3>
    <div>
    <img src="assets/images/phosphorum.jpg" width="300px" height="300px" alt=""><br><br>
      <p>El fertilizante orgánico de fósforo Ferticell es un nutriente esencial requerido por las plantas que es el principal responsable del desarrollo vigoroso de las raíces y la producción de frutas y flores. Este producto es ideal para usar durante períodos de 
       rápido crecimiento en los que las plantas requieren grandes cantidades de fósforo.</p>
       <p>
        Aplicación:
        Vegetales: 3-5 litros de hectárea
        Cereal: 2 - 5 litros de hectárea
        Manzana / Pera: 3 - 5 litros de hectárea
        Fruta general: 3 - 5 litros de hectárea
        Aceituna: 5 - 10 litros de hectárea
        Vides: 3 - 5 litros de hectárea.</p>
    </div>
    <h3>Nitrogenum</h3>
    <div>
    <img src="assets/images/nitrogenum.jpg" width="300px" height="300px" alt=""><br><br>
      <p>Ferticell Nutri-Plus es un producto que contiene células activas de algas unicelulares de agua dulce con altos niveles de aminoácidos. Las células de algas son especialmente importantes en la nutrición de las plantas para aumentar los 
        rendimientos, la precocidad y la calidad en todos los cultivos.</p>
        <p>
        Aplicación:
        Vegetales: 3-5 litros de hectárea
        Cereal: 2 - 5 litros de hectárea
        Manzana / Pera: 3 - 5 litros de hectárea
        Fruta general: 3 - 5 litros de hectárea
        Aceituna: 5 - 10 litros de hectárea
        Vides: 3 - 5 litros de hectárea.</p>
    </div>
    <h3>Algae</h3>
    <div>
    <img src="assets/images/algae.jpg" width="300px" height="300px" alt=""><br><br>
      <p>Ferticell Universal es una solución altamente concentrada de extracto de algas de agua dulce. Agroplasma Inc.
       utiliza solo algas y bacterias unicelulares de grado alimenticio. Ferticell Universal utiliza un proceso de extracción patentado de estos organismos no vivos para promover una alta actividad en las poblaciones nativas de
        micro flora con fuentes de alimentos como el carbono y las fitohormonas.</p>
        <p>
        Aplicación:
        Vegetales: 3-5 litros de hectárea
        Cereal: 2 - 5 litros de hectárea
        Manzana / Pera: 3 - 5 litros de hectárea
        Fruta general: 3 - 5 litros de hectárea
        Aceituna: 5 - 10 litros de hectárea
        Vides: 3 - 5 litros de hectárea.</p>
    </div>
   </div>
<!--FIN ACORDEON -->
    </article>
  </div>

   </section>
   <br><br><br>
   <!-- FOOTER -->
  <?php include 'partials/footer.php';?>


 <!--SCRIPTS -->
 <?php require 'partials/scripts.php'?>
  </body>
</html>