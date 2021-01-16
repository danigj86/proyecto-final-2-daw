<?php
require './clases/claseCarrito.php';

$obj = new ClaseCarrito();
$productos = $obj->getProductos(); //capturamos a los productos


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATALOGO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--CSS-->
    <link rel="stylesheet" href="assets/styles.css">
   <style>
     
     @mixin clearfix() {
  &::after {
    display: block;
    content: "";
    clear: both;
        }
      }
   </style>
    
</head>

<body>
  <!--CABECERA -->
<?php include 'partials/header.php';?>
   
    <div class="container"> 
    <h2>Nuestro Productos</h2>
    
     <!--FOREACH PARA MOSTRAR PRODUCTOS -->
     <?php foreach ($productos as $producto): ?>

    <div  class="col-lg-4" style="float:left;">

     
     <div class="prod">
     

     <form action="agregar_carrito.php" method="POST">
     <br>
    <!-- HACEMOS UN CAMPO HIDDEN PARA CAPTURAR EL ID Y PASARLA POR EL FORMULARIO-->
     <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>" >
    
     <img src="<?php echo $producto["imagen"]; ?>" alt="moto" width="300px" height="300px">
     <h2><?php echo $producto['nombre']; ?></h2>
     <p><b>Precio: <?php echo $producto['precio']; ?> €/L</b></p>
     
     <p><b>Cantidad:</b></p>
     <input type="number" name="cantidad" value="1">
     <br><br>

    <input  type="submit" value="Agregar a carrito">
    

     </form>
     </div>
     
     </div>
<?php endforeach;?>
     </div>
</div></div>
<div class="clearfix"></div>
<br><br>

<!--FOOTER-->
<?php include 'partials/footer.php';?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>