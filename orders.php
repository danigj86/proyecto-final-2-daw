<?php

session_start();

require 'database.php';

//verificar si existe la sesion
if (isset($_SESSION['user_id'])) {
    //recupero datos
    $records = $conn->prepare('SELECT id, nombre, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC); //Y CAPTURA LOS VALORES DE ESE USUARIO..

    $user = null;

    if (count($results) > 0) {
      $user = $results; //..Y LOS METEMOS EN USER, ASI PODEMOS USAR LOS VALORES $user['nombre'] etc
    }
 
}
?>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- LINKS CSS, BOOTSTRAP-->
    <?php require 'partials/links.php' ?>
    <title>PRODUCTS</title>
    
  </head>
  <body>

  <!--CABECERA-->
  <?php require 'partials/headerMain.php' ?>
  
    <h1>ORDERS</h1>
    <a href="makeorder.php">Make an order</a> or <a href="checkorders.php">Check orders</a>
    <section>
       <div class = "container">
           <h2>Request your order</h2>
           <p>In this section you can reserve an order. One of our agents will contact you as soon as possible to confirm the order.</p>
           <br>
           <br>
           <img src="assets/images/img2.jpg" width= "100%"  height="auto" style="border-radius: 20px">
           
       </div>
    </section>   
   
  
    
 <!--SCRIPTS -->
 <?php require 'partials/scripts.php' ?>
  </body>
</html>
